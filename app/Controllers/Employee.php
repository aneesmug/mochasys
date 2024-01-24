<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Ciqrcode;
use App\Libraries\hijriGregorianConvert;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\SalaryModel;
use App\Models\VacationModel;
use Config\Services;
/*use CodeIgniter\Config\response;*/
use CodeIgniter\Exceptions\PageNotFoundException;


class Employee extends BaseController
{
    public $DateConv;

    public function __construct()
    {
        $this->employeeModel        = new EmployeeModel();
        $this->departmentModel      = new DepartmentModel();
        $this->VacationModel        = new VacationModel();
        $this->SalaryModel          = new SalaryModel();
        $this->DateConv             = new hijriGregorianConvert(); //$DateConv->HijriToGregorian($iqama_exp_up, $format);
        /*$this->response             = new response();*/
        //$this->qr                   = new Ciqrcode(); //QR Code Generation
        $this->VacationModel        = new VacationModel();
        $this->vacationsData        = $this->VacationModel->vacationsData();
        $this->applyVacation        = $this->VacationModel->applyVacation();

        $this->user_dept            = session()->get('user')['user_dept'];
        $this->user_type            = session()->get('user')['user_type'];

        $this->validation           = Services::validation();
    }

    public function index()
    {
        
    }

    public function getSection()
    {
        $request    = service('request');
        $postData   = $request->getPost();
        $iddept     = $postData['department'];
        $section    = $this->departmentModel->getSectionFromDept($iddept);
        // Read new token and assing in $data['token']
        $data['token']      = csrf_hash();
        $data['section']    = $section;

        return $this->response->setJSON($data);
    }

    public function getContractPeriod()
    {
        $request    = service('request');
        $postData   = $request->getPost();
        $idper      = $postData['vac_period'];
        $cperiod    = $this->db->query("SELECT * FROM `contract_period` WHERE `period`='{$idper}' ")->getResult();
        $data['tokenCP']    = csrf_hash();
        $data['cperiod']    = $cperiod;

        return $this->response->setJSON($data);
    }

    public function register()
    {   
        $country    = $this->db->query("SELECT * FROM `country` ORDER BY `name` REGEXP '^[^A-Za-z]' ASC, name")->getResult();
        $cperiod    = $this->db->query("SELECT * FROM `contract_period`")->getResult();
        $banks      = $this->db->query("SELECT * FROM `banks` ORDER BY `name` REGEXP '^[^A-Za-z]' ASC, name")->getResult();
        $dept       = $this->departmentModel->getDepartment();
        $gDate      = $this->DateConv->HijriToGregorian("03/04/1443", "DD/MM/YYYY");
        $hDate      = $this->DateConv->GregorianToHijri("09-11-2021", "DD/MM/YYYY");
        
        $data = [
            'emp_country'   => $country,
            'department'    => $dept,
            'cperiod'       => $cperiod,
            'banks'         => $banks,
            'hdate'         => $hDate,
            'permission'    => $this->permission,
        ];
        
        if ($this->request->getPost()) {
            $this->employeeModel->transBegin();
            if (!$this->employeeModel->insert($this->request->getPost())) {
                $this->session->setFlashData('errors', $this->employeeModel->errors());
                return redirect()->to('/employee/register')->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Employee',
                'action_done'       =>  'Register new employee',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->employeeModel->transCommit();
            $this->session->setFlashData('success', "Employee Registered Successfully!");
            return redirect()->to('employee/list');
        } else {
            return view('employee/employee_register', $data);
        }
    }

    public function list()
    {
        $dept = $this->departmentModel->getDepartment();
        if ($this->user_type == 'dept_user') {
            $employees  = $this->employeeModel->where('status','active')->where('dept',$this->user_dept)->findAll();
        }else{
            $employees  = $this->employeeModel->where('status','active')->findAll();
        }
        $data = [
            'departments'   => $dept,
            'employees'     => $employees,
            'permission'    => $this->permission,
        ];
        return view('employee/employee_list', $data);
    }

    public function view($id)
    {
        $employeeData = $this->employeeModel->where('id',$id)->first();
        $getsalary    = $this->SalaryModel->where('emp_id',$employeeData['emp_id'])->orderBy('id','desc')->limit(1)->first();
        
        $getyear      = preg_replace("/[^0-9]/","",$employeeData['vac_period']);
        $lasty        = ($getyear=="2") ? "- INTERVAL 1 YEAR" : "" ;
        
        $vacyear      = ($employeeData['emp_sup_type'] == 'mocha') ? $getyear : 1 ;          
        $vacData      = $this->applyVacation
                        ->select('*')
                        ->selectSum('vacdays','SUMDAYS')
                        ->where("vac_strt_date >= CONCAT(YEAR(NOW()), '-01-01') ".$lasty." AND vac_strt_date  < CONCAT(YEAR(NOW()), '-01-01') + INTERVAL 1 YEAR")
                        ->where('emp_id',$employeeData['emp_id'])
                        ->get()
                        ->getRowArray();
        $builder    = $this->db->table('emp_docu');

        if (!$employeeData) {
                throw PageNotFoundException::forPageNotFound('Employee Not Found');
        } else {
            $data = [
                'employee'      => $employeeData,
                'vacation'      => $vacData,
                'salary'        => $getsalary,
                'gdate'         => $this->DateConv,
                'vaclists'      => $this->VacationModel,
                'empsuprt'      => $this->employeeModel,
                'empreplace'    => $this->employeeModel, 
                'lastvac'       => $this->applyVacation,
                'emp_docu'      => $builder,
                'permission'    => $this->permission,
            ];
        }
        return view('employee/employee_view', $data);
    }

    public function edit($id=null)
    {
        $employee = $this->employeeModel->find($id);
        
        if ($this->request->getPost()) {
            if (!$this->employeeModel->update($id, $this->request->getPost() )) {
                $this->session->setFlashData('errors', $this->employeeModel->errors());
                // $this->session->setFlashData('error','Employee not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Employee',
                'action_done'       =>  'Edit employee',
                'remarks'           =>  'Employee id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('message','Employee details are updated successfully!');
            return redirect()->to('/employee/view/'.$id);
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
                'permission'    => $this->permission,
                ];

        return view('employee/employee_edit', $data);
    }

    public function delete($id)
    { 
        if ($this->employeeModel->where('id', $id)->delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Employee',
                'action_done'       =>  'Delete employee',
                'remarks'           =>  'Employee id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
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

    public function deleteContent($id)
    { 
        // print_r($this->db->table('employee_temp_contants')->delete($id));
        // exit();

        if ($this->db->table('employee_temp_contants')->where('id',$id)->delete()) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Temp Contants',
                'action_done'       =>  'Delete contant',
                'remarks'           =>  'Contant id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
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

    public function getEmployeeIDExp()
    {
         $request = service('request');
         $postData = $request->getPost();
         $dtpostData = $postData['data'];
         $response = array();
         ## Read value
         $draw = $dtpostData['draw'];
         $start = $dtpostData['start'];
         $rowperpage = $dtpostData['length']; // Rows display per page
         $columnIndex = $dtpostData['order'][0]['column']; // Column index
         $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
         $searchValue = $dtpostData['search']['value']; // Search value

         ## Total number of records without filtering
         $totalRecords = $this->employeeModel
                ->select('id')
                ->countAllResults();

         ## Total number of records with filtering
         $totalRecordwithFilter = $this->employeeModel
                ->select('id')
                ->orLike('name', $searchValue)
                ->orLike('emp_id', $searchValue)
                ->orLike('mobile', $searchValue)
                ->orLike('iqama', $searchValue)
                ->orLike('dept', $searchValue)
                ->countAllResults();
         ## Fetch records
         $records = $this->employeeModel
                ->select('*')
                ->orLike('name', $searchValue)
                ->orLike('emp_id', $searchValue)
                ->orLike('mobile', $searchValue)
                ->orLike('iqama', $searchValue)
                ->orLike('dept', $searchValue)
                ->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);

         $data = array();

         foreach($records as $record ){

            $viewButton = "<a href='./view_customer.php?id=".$record['id']."' class='btn btn-dark square btn-min-width mr-1 mb-1 waves-effect waves-light'><i class='la la-eye'></i></a>";
            $editButton = "<a href='./edit_customer.php?id=".$record['id']."' class='btn btn-info square btn-min-width mr-1 mb-1 waves-effect waves-light'><i class='la la-pencil-square'></i></a>";
            $deleteButton = "<a href='javascript:void(0);' data-id='".$record['id']." ?>' data-tbl='Customers' class='btn btn-danger square btn-min-width mr-1 mb-1 waves-effect waves-light delete'><i class='la la-trash-o'></i></a>";
            $action = "<div class='btn-group' role='group' aria-label='Basic example'>".$viewButton." ".$editButton." ".$deleteButton."</div>";            

            $data[] = array( 
               "name"   => "<div class='media'><div class='media-left pr-1'><span class='avatar avatar-sm avatar-off rounded-circle'><img src='./app-assets/".$record['avatar']."'></span></div><div class='media-body media-middle'><a class='media-heading name'>".$record['name']."</a></div></div>",
               "emp_id" =>$record['emp_id'],
               "mobile" =>$record['mobile'],
               "iqama"  =>$record['iqama'],
               "dept"   =>$record['dept'],
               "action" =>$action,
            ); 
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "token" => csrf_hash() // New token hash
         );

         return $this->response->setJSON($response);
    }
 
    public function find()
    {
        $q = $this->request->getVar('q');
        $data = [
            'employees' => $this->employeeModel
                    ->groupStart()
                        ->like('mobile',$q)
                        ->orLike('emp_id',$q)
                        ->orLike('iqama',$q)
                        ->orLike('name',$q)
                        ->orLike('dept',$q)
                    ->groupEnd(),

            'pager'         => $this->employeeModel,
            'permission'    => $this->permission,
        ];
        return view('employee/search', $data);
    }

    public function qrcode($id)
    {
        $this->ciqrcode = new Ciqrcode(); //QR Code Generation
        $emp = $this->employeeModel->where('id',$id)->first();
        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = [255, 255, 255];
        $config['white']        = [255, 255, 255];
        $this->ciqrcode->initialize($config);
        /* QR Data  */
        $params['data']     = "http://mochasys.ddns.net/emp_card/index.php?hashcode=".$emp['emp_id']."&verification=".$emp['id']."";
        $params['level']    = 'QR_ECLEVEL_L';
        $params['size']     = 6;
        $this->ciqrcode->generate($params);
        // $this->response->setHeader('Content-Type', 'application/pdf');
        return view('/employee/view'.$id);
    }

    public function upload()
    {
        $emp_id     = session()->get('user')['emp_data']['emp_id'];
        $data       = $_POST["image"];
        $type       = $_POST["type"];
        $img_arr_a  = explode(";", $data);
        $img_arr_b  = explode(",", $img_arr_a[1]);
        $data       = base64_decode($img_arr_b[1]);
        $img_name   = time().".jpg";
        // $avatar_link = './app-assets/assets/'.$img_name;
        $avatar_link = './app-assets/assets/emp_pics/'.$img_name;
        file_put_contents($avatar_link, $data);
        $img_file   = $img_name;
        $builder    = $this->db->table('employee_temp_contants');
        // $emp_id = $this->employeeModel->where('id',$id)->first();
        $AplyVacData = [
                        'emp_id'    =>  $emp_id,
                        'type'      =>  $type,
                        'path'      =>  $avatar_link,
                    ];
        $store = $builder->insert($AplyVacData);
        /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Employee',
                'action_done'       =>  'Add new avatar',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
        $response = [
            'success'   => true,
            'data'      => $store,
            'message'   => "Image uploaded successfully."
        ];
       return $this->response->setJSON($response);
    }

    public function tempContant()
    {
        $builder    = $this->db->table('employee_temp_contants');
        $data = [
            'tempContant'       => $builder,
            'permission'        => $this->permission,
        ];
        return view('employee/contant_approvel_list', $data);
    }

    public function download($id){
        $builder = $this->db->table('employee_temp_contants')->where('id',$id)->get()->getRowArray();
        return $this->response->download($builder['path'], null);
    }

    public function contantStatus($id)
    {
        if ($this->request->getPost()) {
            
            $builder = $this->db->table('employee_temp_contants')->where('id',$id)->get()->getRowArray();
            $notes      = $this->request->getPost('notes');   
            $AplyData = ['status' => 'I', 'notes' => $notes];
            
            if ($builder['type'] == "Profile Picture") {
                // $status     = $this->request->getPost('status');
                $this->db->table('employees')->where('emp_id',$builder['emp_id'])->update(['avatar'=>$builder['path']]);
            } else {
                $this->db->table('emp_docu')->where('emp_id',$builder['emp_id'])->update(['status'=>'A']);
            }
                $this->db->table('employee_temp_contants')->where('id',$builder['id'])->update($AplyData);
                $this->session->setFlashData('success','Details are updated successfully!');
                return redirect()->to('/employee/contant/list');
        }
    }

    public function storeFile($id)
    {
        $employee = $this->employeeModel->where('id',$id)->first();
        if ($this->request->getFile('file')) {
            $file = $this->request->getFile('file');
            $validated = $this->validate(
                [
                    'file' => [
                        'uploaded[file]',
                        'mime_in[file,image/jpg,image/jpeg,image/png,application/pdf]',
                        'max_size[file,2048]',
                    ],
                ],
                [   // Errors
                    'file' => [
                        'mime_in'   => 'Please select only IMAGE or PDF file.',
                        'max_size'  => 'This file is too large of a file. Maximum allow only 2MB',
                    ],
                ]
            );
            if (!$validated) {
                $this->session->setFlashData('error', $this->validation->getErrors()['file']);
                return redirect()->to(base_url('/employee/view/'.$id));
            } else {
                $name = $file->getRandomName(); // Generate a new secure name
                $path = './app-assets/assets/emp_documents/';
                $file->move($path,$name);
                $data = [
                    'emp_id'    => $employee['emp_id'],
                    'pgid'      => $id,
                    'docu_typ'  => $this->request->getPost('docu_typ'),
                    'docu_ext'  => $file->getClientExtension(),
                    'path'      => $path.$name,
                    'status'    => "I",
                ];
                $dataTemp = [
                    'emp_id'    => $employee['emp_id'],
                    'type'  => $this->request->getPost('docu_typ'),
                    'path'      => $path.$name,
                    'status'    => 'A',
                ];
            $this->db->table('employee_temp_contants')->insert($dataTemp);
            $this->db->table('emp_docu')->insert($data);
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Employee',
                'action_done'       =>  'Add documents',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','File will be uploaded successfully!');
            return redirect()->to(base_url('/employee/view/'.$id));
            }
        }
        $this->session->setFlashData('error', 'Sorry, there was an error uploading your file.');
        return redirect()->to(base_url('/employee/view/'.$id));
    }

    public function employeeByDepartment()
    {   
        $q = $this->request->getVar('q');
        if (isset($q)) {
            $data = [
                'employees' => $this->employeeModel->groupStart()->orLike('dept',$q)->groupEnd(),
                'pager'     => $this->employeeModel,
                'permission'=> $this->permission,
            ];
            return view('employee/search_by_department', $data);
        } else {
            $employee = $this->db->table('employees')
                        ->selectCount('employees.dept', 'empcountgrp')
                        ->select('employees.dept, dept_clr.color')
                        ->join('dept_clr','employees.dept=dept_clr.dept')
                        ->where('employees.status','active')
                        ->groupBy('dept_clr.dept')
                        ->get()
                        ->getResultArray();
            $data = [
                'employees' => $employee,
                'permission'=> $this->permission,
            ];
            return view('employee/employee_by_department', $data);
        }
    }

    


}
