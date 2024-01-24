<?php
namespace App\Controllers;

use App\Entities\User as UserEntity;
// use App\Models\ProfileModel;
use App\Models\UserModel;
use App\Libraries\hijriGregorianConvert;
use App\Libraries\dateDiff;
use App\Libraries\Ciqrcode;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VacationModel;
use App\Models\SalaryModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Services;

class User extends BaseController {
	private $userModel = null;
	public function __construct() {
		$this->userModel 			= new UserModel();
	    $this->employeeModel        = new EmployeeModel();
        $this->departmentModel      = new DepartmentModel();
        $this->VacationModel        = new VacationModel();
        $this->SalaryModel          = new SalaryModel();
        $this->DateConv             = new hijriGregorianConvert(); //$DateConv->HijriToGregorian($iqama_exp_up, $format);
        $this->dateDiff         	= new dateDiff();
        $this->VacationModel    	= new VacationModel();
        $this->vacationsData    	= $this->VacationModel->vacationsData();
        $this->applyVacation    	= $this->VacationModel->applyVacation();
        $this->email 				= Services::email();
	}

	public function check_register() {
		return view('user/user_check_register');
	}

	public function register() {
		$emp_id = $this->request->getGet('emp_id');
		if ($this->request->getPost()) {
			$this->userModel->transBegin();
			if (!$this->userModel->insert($this->request->getPost())) {
				$this->session->setFlashData('errors', $this->userModel->errors());
				return redirect()->to('/register?emp_id='.$emp_id)->withInput();
			}
			/*Start Insert log history*/
	        $accesslog = array(
	            'action_page'       =>  'Users',
	            'action_done'       =>  'Register new user',
	            'remarks'           =>  $this->db->insertID(),
	            'entry_date'        =>  date('Y-m-d H:i:s'),
	        );
	        $this->db->table('accesslog')->insert($accesslog);
	        /*End Insert log history*/
			$this->userModel->transCommit();
			$this->session->setFlashData('success', "User Registered Successfully!");
			return redirect()->to('/login');	
		}
		$result = $this->employeeModel->where('emp_id',$emp_id)->first();
		if (!$result) {
			throw PageNotFoundException::forPageNotFound('User record not found.');
		}
		$data = [ 'employee' => $result ];
		return view('user/user_register', $data);
	}

	public function login() {
		$user = $this->userModel->authenticate($this->request->getPost());
		if ($user) {
			$this->session->set('user', $user);
			/*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Login',
                'action_done'       =>  'Login user',
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
			$this->session->setFlashData('success' , 'LoggedIn Successfully!');
			$retVal = ($user['user_type'] == 'employee' ) ? redirect()->to('/employeedash') : redirect()->to('/dashboard') ;
			return $retVal;
		}
		$this->session->setFlashData('error', 'Unknown Email / Password or User not activate');
		return redirect()->to('/login')->withInput();
	}

	public function logout() {
		/*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'User',
                'action_done'       =>  'Employee logout',
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
		$this->session->remove('user');
		$this->session->setFlashData('success', 'LoggedOut Successfully!');
		return redirect()->to('login');
	}

	public function profile($id) {
		$profile = $this->profileModel->where('user_id', $id)->first();
		if (!$profile) {
			throw PageNotFoundException::forPageNotFound('User Not Found');
		}
		return view('profile', $profile);
	}

	public function update($id = null) {
		$profile = $this->profileModel->find($id);
		$user = $this->userModel->find(session()->get('user')['id']);
		$user->email = $this->request->getPost('email');
		if ($user->hasChanged('email')) {
			$this->session->setFlashData('danger' , "You are not allowed to change Email");
			return redirect()->back()->withInput();
		}
		if (!$profile or $profile['user_id'] != session()->get('user')['id']) {
			$this->session->setFlashData("success" , "You can not Update this user");
			return redirect()->back()->withInput();
		}

		if (!$this->profileModel->update($id, $this->request->getPost())) {
			$this->session->setFlashData('errors', $this->profileModel->errors());
			return redirect()->back()->withInput();
		}
		$this->session->setFlashData('success' , 'Profile Updated Successfully!');
		return redirect()->to('/users/' . $id . '/profile');
	}

	public function changePassword() {
		$id = session()->get('user')['id'];
		if (!$this->userModel->update($id, $this->request->getPost())) {
			$this->session->setFlashData('errors', $this->userModel->errors());
			return redirect()->back()->withInput();
		}
		$this->session->setFlashData('message', 'Password Updated Successfully!');
		return redirect()->to('/users/' . $id . '/profile');
	}

	public function updatePassword() {
		$id = $this->request->getPost('id');
		if (!$this->userModel->update($id, $this->request->getPost())) {
			$this->session->setFlashData('errors', $this->userModel->errors());
			return redirect()->back()->withInput();
		}
		$this->session->setFlashData('success', 'Password Updated Successfully!');
		return redirect()->to('/permission/users/list');
	}

	public function upload() {
		$file = $this->request->getFile('thumbnail');

		$user = session()->get('user');
		$profile = $this->profileModel->where(['user_id', $user['id']])->first();
		if ($file->move(WRITEPATH . 'uploads/images') && $this->profileModel->update($profile['id'], ['thumbnail' => $file->getClientName()])) {
			return redirect()->back()->withInput();
		}
		$this->session->setFlashData('success', 'Profile Thumbnail Updated Successfully!');
		return redirect()->to('/user/' . session()->get('id') . '/profile');
	}

	public function view()
    {

    	/*$this->email->setTo('aneesmug2007@yahoo.com');
    	$this->email->setFrom('anees@mochachino.co');
    	$this->email->setSubject('Test Subject');
    	$this->email->setMessage('Hello its email body');
    	if ($this->email->send()) {
    		echo "Email has send Successfully!";
    	} else{
    		$data = $this->email->printDebugger(['headers']);
    		print_r($data);
    	}
    	exit();*/
    	
    	$employee 		= $this->employeeModel->where('emp_id',session()->get('user')['emp_data']['emp_id'])->first();
        $getsalary    	= $this->SalaryModel->where('emp_id',$employee['emp_id'])->orderBy('id','desc')->limit(1)->first();

        $getyear      	= preg_replace("/[^0-9]/","",$employee['vac_period']);
        $lasty        	= ($getyear=="2") ? "- INTERVAL 1 YEAR" : "" ;
        
        $vacyear      	= ($employee['emp_sup_type'] == 'mocha') ? $getyear : 1 ;          
        $vacData      	= $this->applyVacation
	                        ->select('*')
	                        ->selectSum('vacdays','SUMDAYS')
	                        ->where("vac_strt_date >= CONCAT(YEAR(NOW()), '-01-01') ".$lasty." AND vac_strt_date  < CONCAT(YEAR(NOW()), '-01-01') + INTERVAL 1 YEAR")
	                        ->where('emp_id',$employee['emp_id'])
	                        ->get()
	                        ->getRowArray();
        if (!$employee) {
                throw PageNotFoundException::forPageNotFound('Employee Not Found');
        } else {
            $data = [
                'employee'  => $employee,
                'vacation'  => $vacData,
                'salary'    => $getsalary,
                'gdate'     => $this->DateConv,
                'vaclists'  => $this->VacationModel,
                'empsuprt'  => $this->employeeModel,
                'empreplace'=> $this->employeeModel, 
                'lastvac'   => $this->applyVacation,
                'dateDiff'  => $this->dateDiff,
            ];
        }
        return view('employee/employee_profile', $data);
    }


    public function applyVac()
    {
    	$employee 		= session()->get('user')['emp_data'];
        $emp            = $this->employeeModel->where('emp_id',$employee['emp_id'])->first();

    	if ($this->request->getPost()) {

	        $lastvacdate    = $this->applyVacation
	                                ->select('*')
	                                ->where('emp_id',$emp['emp_id'])
	                                ->orderBy('id','DESC')
	                                ->limit('1')
	                                ->get()
	                                ->getRowArray();
	        $vacyear = preg_replace("/[^0-9]/","",$emp['vac_period']);
	        /**********************************************/

	        $lastvac        = $this->applyVacation
	                                ->select('*')
	                                ->selectSum('vacdays','SUMDAYS')
	                                ->where("`vac_strt_date` >= CONCAT(YEAR(NOW()), '-01-01') AND `vac_strt_date`  < CONCAT(YEAR(NOW()), '-01-01') + INTERVAL '".$vacyear."' YEAR")
	                                ->where('emp_id',$emp['emp_id'])
	                                ->get()
	                                ->getRowArray();

	            $totsumday      = (count($lastvac)>'0')?$lastvac['SUMDAYS']:"0";
	            $vacday         = (count($lastvac)>'0')?$lastvac['vacdays']:"0";
	            $last_vac_date  = (count($lastvacdate)>'0')?$lastvacdate['vac_strt_date']:"";
	            $balance_days   = $emp['vacation_days'] - $totsumday; 

	            $vac_strt_date  = $this->request->getPost('vac_strt_date');
	            $return_date    = $this->request->getPost('return_date');
	            $vac_type       = $this->request->getPost('vac_type');
	            $next_vac_date  = date('Y-m-d', strtotime($vac_strt_date.' + '.$this->request->getPost('vac_period')));

	        if ($this->request->getPost('fly_type') !== "emergency") {    
	            $flydatetime    = strtotime(date('M d Y', strtotime(date('M d Y', strtotime(str_replace('/', '-', $vac_strt_date))))));
	            $returndatetime = strtotime(date('M d Y', strtotime(date('M d Y', strtotime(str_replace('/', '-', $return_date))))));   
	            $secs           = $returndatetime - $flydatetime;// == <seconds between the two times>
	            $vacdays        = $secs / 86400;
	        } else{
	            $vacdays="";
	        }
	        if($emp['vacation_days'] >= $totsumday){
	            if($vacdays <= $balance_days){
	                if($this->request->getPost('fly_type') == "Encashed"){
	                    $vac_type = "Encashed";
	                }
	                $AplyVacData = [
	                    'emp_id'            => $this->request->getPost('emp_id'),
	                    'emp_name'          => $this->request->getPost('emp_name'),
	                    'dept'              => $this->request->getPost('dept'),
	                    'fly_type'          => $this->request->getPost('fly_type'),
	                    'vac_strt_date'     => $this->request->getPost('vac_strt_date'),
	                    'return_date'       => $this->request->getPost('return_date'),
	                    'joining_date'      => $this->request->getPost('joining_date'),
	                    'vac_type'          => $vac_type,
	                    'empgid'            => session()->get('user')['emp_data']['id'],
	                    'next_vac_date'     => $next_vac_date,
	                    'last_vac_date'     => $last_vac_date,
	                ];

	                $this->db->transBegin();
	                if ( !$this->applyVacation->insert($AplyVacData) ) {
	                    $this->session->setFlashData('errors', "There's some errors");
	                    return redirect()->to('/vacation/apply')->withInput();
	                }
	                $this->db->transCommit();
	                /*Start Insert log history*/
		            $accesslog = array(
		                'action_page'       =>  'Apply Vacation',
		                'action_done'       =>  'Register new vacation',
		                'remarks'           =>  $this->db->insertID(),
		                'user_name'         =>  $this->session->get('user')['id'],
		                'entry_date'        =>  date('Y-m-d H:i:s'),
		            );
		            $this->db->table('accesslog')->insert($accesslog);
		            /*End Insert log history*/
	                $this->session->setFlashData('success', "Vacation request applied successfully!");
	                return redirect()->to('/employeedash');
	            } else {
	                $this->session->setFlashData('error', "Your vacation selective days ($vacdays) not matched with your balance vacation days (".$balance_days.").");
	                return redirect()->to('/vacation/apply');
	            }
	        } else {
	            $this->session->setFlashData('error', "Your vacation days already extends from Vacation days.");
	            return redirect()->to('/vacation/apply');
	        }
        }
        $checklastvac = $this->applyVacation->select('*')
                        ->where('emp_id',$employee['emp_id'])
                        // ->where('status','apply')
                        ->where('review','A')
                        ->orderBy('id','DESC')
                        ->limit('1')
                        ->get()
                        ->getRowArray();
        
        $data = (isset($checklastvac['review']) == 'A') ? ['status' => 'A'] : ['status' => 'C'];
        return view('vacation/vacation_register',$data);
    }

    public function edit()
    {
    	$id 		= session()->get('user')['emp_data']['id'];
        $employee 	= $this->employeeModel->find($id);
        
        if ($this->request->getPost()) {
            if (!$this->employeeModel->update($id, $this->request->getPost() )) {
                $this->session->setFlashData('errors', $this->employeeModel->errors());
                // $this->session->setFlashData('error','Employee not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Employee Profile',
                'action_done'       =>  'Edit employee details',
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Your profile details are updated successfully!');
            return redirect()->to('/employeedash');
        }

        $country    = $this->db->query("SELECT * FROM `country` ORDER BY `name` REGEXP '^[^A-Za-z]' ASC, name")->getResult();
        $cperiod    = $this->db->query("SELECT * FROM `contract_period`")->getResult();
        $banks      = $this->db->query("SELECT * FROM `banks` ORDER BY `name` REGEXP '^[^A-Za-z]' ASC, name")->getResult();
        $dept       = $this->departmentModel->getDepartment();
        $gDate      = $this->DateConv->HijriToGregorian("03/04/1443", "DD/MM/YYYY");
        $hDate      = $this->DateConv->GregorianToHijri("09-11-2021", "DD/MM/YYYY");
        
         $data = [
                'employee'      => $employee,
                'emp_country'   => $country,
                'department'    => $dept,
                'cperiod'       => $cperiod,
                'banks'         => $banks,
                ];

        return view('employee/employee_profile_edit', $data);
    }

}
