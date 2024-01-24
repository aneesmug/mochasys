<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Models\UserModel;

class RolePermission extends BaseController
{
 public function __construct()
    {
        $this->PermissionModel   = new PermissionModel();
        $this->UserModel            = new UserModel();
    }

    public function index()
    {
     
    }

    public function update($id){

        if ($this->request->getPost()) {
            $fk_module_id = $this->request->getPost('fk_module_id');
            $create       = $this->request->getPost('create');
            $read         = $this->request->getPost('read');
            $update       = $this->request->getPost('update');
            $delete       = $this->request->getPost('delete');
            $new_array = array();
            for ($m = 0; $m < sizeof($fk_module_id/*[0]*/); $m++) {
                for ($i = 0; $i < sizeof($fk_module_id[$m]); $i++) {
                    for ($j = 0; $j < sizeof($fk_module_id[$m][$i]); $j++) {
                        $dataStore = array(
                            'role_id'       => $id,
                            'module_id'     => $fk_module_id[$m][$i][$j],
                            'r_create'      => (!empty($create[$m][$i][$j]) ? $create[$m][$i][$j] : 0),
                            'r_read'        => (!empty($read[$m][$i][$j]) ? $read[$m][$i][$j] : 0),
                            'r_update'      => (!empty($update[$m][$i][$j]) ? $update[$m][$i][$j] : 0),
                            'r_delete'      => (!empty($delete[$m][$i][$j]) ? $delete[$m][$i][$j] : 0),
                        );
                        array_push($new_array, $dataStore);
                    }
                }
            }

            /*echo "<pre>";
            print_r($new_array);
            exit();*/

            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Role Permission',
                'action_done'       =>  'update',
                'remarks'           =>  'Role id :'.$id,
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            if($this->PermissionModel->create($new_array)){
                // $id = $this->db->insertID();
                $this->session->setFlashData('success', "Role permission updated successfully!");
                return redirect()->to('/permission/edit/'.$id);
            }
            else{
                $this->session->setFlashData('error', "Pleasr try again");
                return redirect()->to('/permission/edit/'.$id);
            }

        } else {
           $data = [
            'modules'           => $this->PermissionModel->module_list2(),
            'sub_module'        => $this->PermissionModel->sub_module(),
            'role_permission'   => $this->PermissionModel->role_permission(),
            ];
            return view('permission/role_edit_form', $data);
        }
    }

    public function usersList()
    {
        $data = [
            'userLists'         => $this->UserModel
                                            ->select('sec_role.type,users.*,employees.dept AS edept')
                                            ->join('sec_role','sec_role.id=users.user_role')
                                            ->join('employees','employees.emp_id=users.emp_id')
                                            ->findAll(),
            'roles'             => $this->PermissionModel
                                            ->role_list()
                                            ->orderBy("type REGEXP '^[^A-Za-z]' ASC, type")
                                            ->get()
                                            ->getResultArray(),
            'userassignLists'   => $this->UserModel
                                            ->select('`sec_role`.`type`')
                                            ->selectCount('`users`.`user_role`')
                                            ->join('sec_role','sec_role.id=users.user_role')
                                            ->groupBy('`users`.`user_role`')
                                            ->findAll(),
            ];
        // dd($data['userLists']);
        return view('permission/users', $data);
    }

    public function secEdit()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $data = [
                'type'          => $this->request->getPost('type'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Role Permission',
                'action_done'       =>  'Security role name',
                'remarks'           =>  'Sec :'.$id,
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            if (!$this->PermissionModel->role_update($data, $id)) {
                $this->session->setFlashData('error','Not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            $this->session->setFlashData('success','Details are updated successfully!');
            return redirect()->to('/permission/users/list');
        }
    }


    public function secAdd()
    {
        if ($this->request->getPost()) {
            if (!$this->PermissionModel->role_sec_create(['type'  => $this->request->getPost('type')])) {
                $this->session->setFlashData('error','Not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Role Permission',
                'action_done'       =>  'Add Security role',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Details are added successfully!');
            return redirect()->to('/permission/users/list');
        }
    }

    public function role_delete($id)
    { 
        
        if (!$this->PermissionModel->role_delete($id)) {
            $this->session->setFlashData('error','Not updated, becuse there are some error!');
            return redirect()->back()->withInput();
        }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Role Permission',
                'action_done'       =>  'Delete role',
                'remarks'           =>  'Role id :'.$id,
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
        $this->session->setFlashData('success','Role will be deleted successfully!');
        return redirect()->to('/permission/users/list');
        
    }
    
    public function userEdit()
    {
        if ($this->request->getPost()) {

            $id = $this->request->getPost('id');
            $data = [
                'fullname'      => $this->request->getPost('fullname'),
                'dept'          => $this->request->getPost('dept'),
                'user_role'     => $this->request->getPost('user_role'),
                'email'         => $this->request->getPost('email'),
                'mobile'        => $this->request->getPost('mobile'),
                'user_type'     => $this->request->getPost('user_type'),
                'status'        => $this->request->getPost('status'),
                'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];
            if (!$this->PermissionModel->user_update($data, $id)) {
                $this->session->setFlashData('error','User not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Role Permission',
                'action_done'       =>  'Edit User',
                'remarks'           =>  'User id :'.$id,
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','User details are updated successfully!');
            return redirect()->to('/permission/users/list');
        }
    }

    public function delete_user($id)
    { 
        if ($this->UserModel->where('id', $id)->delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Role Permission',
                'action_done'       =>  'Delete User',
                'remarks'           =>  'User id :'.$id,
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $data = [
                'status'    => 'success',
                'message'   => 'Record Deleted Successfully ...',
                'token'     => csrf_hash()
            ];
        } else {
            $data = [
                'status'        => 'error',
                'message'       => 'Unable to delete this record ...',
                'token'         => csrf_hash()
            ];
        }
        return $this->response->setJSON($data);
    }

    public function modules()
    {
        $data = [
            'modules'           => $this->PermissionModel
                                            ->module_list()
                                            // ->orderBy("`name` REGEXP '^[^A-Za-z]' ASC, `name`")
                                            // ->orderBy("`mid` ASC, mid")
                                            ->get()
                                            ->getResultArray(),
            'sub_modules'       => $this->PermissionModel
                                            ->sub_module_list()
                                            // ->orderBy("mid REGEXP '^[^A-Za-z]' ASC, type")
                                            ->get()
                                            ->getResultArray(),
            ];
        return view('permission/modules', $data);
    }

    public function moduleAdd()
    {

        if ($this->request->getPost()) {
            $data = [
                'name'          => $this->request->getPost('name'),
                'icon'          => $this->request->getPost('icon'),
                'directory'     => $this->request->getPost('directory'),
                'description'   => $this->request->getPost('description'),
                'status'        => 1,
            ];
            if (!$this->PermissionModel->module_create($data)) {
                $this->session->setFlashData('error','Module not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Module',
                'action_done'       =>  'Add new module',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Module are added successfully!');
            return redirect()->to('/permission/module/list');
        }
    }

    public function moduleEdit()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $data = [
                'name'          => $this->request->getPost('name'),
                'icon'          => $this->request->getPost('icon'),
                'directory'     => $this->request->getPost('directory'),
                'description'   => $this->request->getPost('description'),
                'status'        => $this->request->getPost('status'),
                // 'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->PermissionModel->module_update($data, $id)) {
                $this->session->setFlashData('error','Module not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Module',
                'action_done'       =>  'Edit module',
                'remarks'           =>  'module id :'.$id,
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Module details are updated successfully!');
            return redirect()->to('/permission/module/list');
        }
    }

    public function moduleDelete($id)
    { 
        if (!$this->PermissionModel->module_delete($id)) {
            $this->session->setFlashData('error','Not updated, becuse there are some error!');
            return redirect()->back()->withInput();
        }
        /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Module',
                'action_done'       =>  'Delete module',
                'remarks'           =>  'Role id :'.$id,
                'user_name'         =>   $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
        $this->session->setFlashData('success','Module will be deleted successfully!');
        return redirect()->to('/permission/module/list');
        
    }

    public function subModuleAdd()
    {

        if ($this->request->getPost()) {
            $data = [
                'name'          => $this->request->getPost('name'),
                'icon'          => $this->request->getPost('icon'),
                'directory'     => $this->request->getPost('directory'),
                'description'   => $this->request->getPost('description'),
                'mid'           => $this->request->getPost('mid'),
                'status'        => 1,
            ];
            if (!$this->PermissionModel->sub_module_create($data)) {
                $this->session->setFlashData('error','Sub-Module not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Module',
                'action_done'       =>  'Add new Sub-Module',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Sub-Module are added successfully!');
            return redirect()->to('/permission/module/list');
        }
    }

    public function subModuleEdit()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $data = [
                'mid'           => $this->request->getPost('mid'),
                'name'          => $this->request->getPost('name'),
                'icon'          => $this->request->getPost('icon'),
                'directory'     => $this->request->getPost('directory'),
                'description'   => $this->request->getPost('description'),
                'status'        => $this->request->getPost('status'),
                // 'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->PermissionModel->sub_module_update($data, $id)) {
                $this->session->setFlashData('error','Module not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Module',
                'action_done'       =>  'Edit sub module',
                'remarks'           =>  'Sub-Module id :'. $id,
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Module details are updated successfully!');
            return redirect()->to('/permission/module/list');
        }
    }

    public function subModuleDelete($id)
    { 
        if (!$this->PermissionModel->sub_module_delete($id)) {
            $this->session->setFlashData('error','Not updated, becuse there are some error!');
            return redirect()->back()->withInput();
        }
        /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Module',
                'action_done'       =>  'Delete sub module',
                'remarks'           =>  'Sub-Module id :'. $id,
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
        $this->session->setFlashData('success','Sub-Module will be deleted successfully!');
        return redirect()->to('/permission/module/list');
        
    }



}
