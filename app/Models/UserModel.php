<?php 

namespace App\Models;

use App\Models\ProfileModel;
use App\Models\EmployeeModel;
use App\Models\PermissionModel;
use CodeIgniter\Model;

class UserModel extends Model {
	protected $DBGroup = "default";
	protected $table = "users";
	protected $primaryKey = 'id';
	protected $allowedFields = [
						'emp_id',
						'fullname',
						'mobile',
						'email',
						'user_type',
						'password'
					];
	protected $useTimestamps = true;
	// protected $returnType = 'App\Entities\User';
	protected $validationRules = [
		'emp_id' 				=> 'required|numeric|is_unique[users.emp_id]',
		'fullname' 				=> 'required|min_length[3]',
		'mobile' 				=> 'required|numeric|min_length[10]|max_length[10]|is_unique[users.mobile]', 
		'email' 				=> 'required|valid_email|is_unique[users.email]',
		'password'    	 		=> 'required|min_length[5]',
        // 'pass_confirm' 			=> 'required_with[password]|matches[password]',
		/*'username' 				=> 'required|alpha_numeric|min_length[3]',
		'dept' 					=> 'required',
		'old_password' 			=> 'required_without[username]|verify[username,]',
		'password' 				=> 'required|min_length[8]',
		'password_confirmation'	=> 'required|matches[password]'*/
	];

	protected $validationMessages = [
		'emp_id' 			=> [
			'required' 		=> 'Employee ID must be required',
			'numeric' 		=> 'Employee ID must be in numbers',
			'is_unique'		=> 'Employee ID already registrd in system',
			],
		'fullname' 			=> [
			'required' 		=> 'Full name is required',
			'min_length' 	=> 'Full name is too short',
			],
		'mobile' 			=> [
			'required' 		=> 'Mobile no. is required',
			'numeric' 		=> 'Mobile no. must be in numbers',
			'is_unique'		=> 'Mobile no. already registrd in system',
			/*'min_length' 	=> 'Must be in minimum numbers 10 allowd',
			'max_length' 	=> 'Must be in maximum numbers 10 allowd',*/
			],
		'email' 			=> [
			'required' 		=> 'Email is required',
			'valid_email'	=> 'Must be enter valid Email addess',
			'is_unique'		=> 'Email ID already registrd in system',
			],
		'password' 			=> [
			'required' 		=> 'Password is required',
			'min_length' 	=> 'Must be enter in minimum length 6.',
			],
		];

	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];
	// protected $afterInsert 	= ['updateProfile'];
	public function transBegin() {
		return $this->db->transBegin();
	}
	public function transRollback() {
		return $this->db->transRollback();
	}
	public function transCommit() {
		return $this->db->transCommit();
	}
	public function hashPassword($data) {
		$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		return $data;
	}
	public function updateProfile($data) {
		$profileModel = new ProfileModel();
		$profileModel->insert(['user_id' => $data['id']]);
	}
	public function authenticate($user) {
		$password = $user['password'];
		$empModel = new EmployeeModel();
		$user = $this->getWhere(['email' => $user['email'], 'status' => true]);
		if ($user->resultID->num_rows > 0) {
			$user = $user->getRow();
			$verify = password_verify($password, $user->password);
			if ($verify) {
				$checkPermission = $this->db->table('role_permission')
						        	->select("
						            sub_module.directory, 
						            role_permission.module_id, 
						            role_permission.r_create, 
						            role_permission.r_read, 
						            role_permission.r_update, 
						            role_permission.r_delete
						            ")
						            ->join('sub_module', 'sub_module.id = role_permission.module_id', 'full')
						            ->where('role_permission.role_id', $user->user_role)
						            ->where('sub_module.status', 1)
						            ->groupStart()
						                ->where('r_create', 1)
						                ->orWhere('r_read', 1)
						                ->orWhere('r_update', 1)
						                ->orWhere('r_delete', 1)
						            ->groupEnd()
						            ->get()
						            ->getResultArray();
				$permission = array();
		        if(!empty($checkPermission))
		            foreach ($checkPermission as $value) {
		                $permission[$value['directory']] = array(
		                    'create' => $value['r_create'],
		                    'read'   => $value['r_read'],
		                    'update' => $value['r_update'],
		                    'delete' => $value['r_delete']
		                );
		            }
				return [
					'id' 			=> $user->id,
					'fullname' 		=> $user->fullname,
					'user_role' 	=> $user->user_role,
					'user_type' 	=> $user->user_type,
					'user_dept'		=> $user->dept,
					/*'username' 		=> $user->username,*/
					'email' 		=> $user->email,
					'emp_data' 		=> $empModel->where('emp_id',$user->emp_id)->first(),
					'permission' 	=> json_encode($permission),
					// 'permission' 	=> $permission,
					'isAdmin' 		=> (($user->user_role == 1)?true:false),
					'status' 		=> true,
					'isLoggedIn'	=> true
				];
			} else {
				return false;
			}
		}
		return false;
	}
	
	private function _update_last_login($id){
		$data = [
			'last_login' => date("Y-m-d H:i:s"),
		];

		return $this->db->update($this->_table, $data, ['id' => $id]);
	}

	
}
