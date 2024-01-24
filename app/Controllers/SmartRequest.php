<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SmartRequestModel;
use Config\Services;
use App\Libraries\UseFullSnippets;
use App\Models\LocationModel;
use App\Models\EmployeeModel;

class SmartRequest extends BaseController
{

	public function __construct()
    {
        $this->SmartRequestModel	= new SmartRequestModel();
        $this->validation           = Services::validation();
        $this->snippets             = new UseFullSnippets();
        $this->locationModel        = new LocationModel();
        $this->employeeModel        = new EmployeeModel();
        $this->user_type            = session()->get('user')['user_type'];
        $this->user_dept            = session()->get('user')['emp_data']['dept'];
        $this->emptype				= session()->get('user')['emp_data']['emptype'];
        $this->emp_id				= session()->get('user')['emp_data']['emp_id'];
        $this->fname				= session()->get('user')['emp_data']['name'];
    }

    public function index()
    {
        //
    }

    public function smartrequestList()
    {	
    	if ($this->user_type == "administrator") {
    		$SmartRequestList = $this->SmartRequestModel
                        ->list()
                        ->select('smart_request.*,smt_request_status.status')
                        ->join('smt_request_status', "smart_request.inv_no = smt_request_status.inv_no AND smt_request_status.status = (SELECT smt_request_status.status FROM smt_request_status WHERE smart_request.inv_no = smt_request_status.inv_no ORDER BY smt_request_status.id DESC LIMIT 1)", 'left')
                        ->groupBy('smart_request.inv_no')
                        ->get()
                        ->getResultArray();
    	} elseif ($this->user_type == "dept_user" AND $this->emptype == "Manager" AND $this->user_dept == "Finance") {
    		$SmartRequestList = $this->SmartRequestModel
                        ->list()
                        ->select('smart_request.*,smt_request_status.status')
                        ->join('smt_request_status', "smart_request.inv_no = smt_request_status.inv_no AND smt_request_status.status = (SELECT smt_request_status.status FROM smt_request_status WHERE smart_request.inv_no = smt_request_status.inv_no ORDER BY smt_request_status.id DESC LIMIT 1)", 'left')
                        ->where('smt_request_status.status','Finance')
                        ->orWhere('smt_request_status.status ','reject')
                        ->orWhere('smt_request_status.status ','approve')
                        ->groupBy('smart_request.inv_no')
                        ->get()
                        ->getResultArray();
    	} elseif ($this->user_type == "employee" AND $this->dept == "Finance") {
    		$SmartRequestList = $this->SmartRequestModel
                        ->list()
                        ->select('smart_request.*,smt_request_status.status')
                        ->join('smt_request_status', "smart_request.inv_no = smt_request_status.inv_no AND smt_request_status.status = (SELECT smt_request_status.status FROM smt_request_status WHERE smart_request.inv_no = smt_request_status.inv_no ORDER BY smt_request_status.id DESC LIMIT 1)", 'left')
                        ->where('smt_request_status.status' , 'approve')
                        ->groupBy('smart_request.inv_no')
                        ->get()
                        ->getResultArray();
    	} elseif ($this->user_type == "gm") {
    		$SmartRequestList = $this->SmartRequestModel
                        ->list()
                        ->select('smart_request.*,smt_request_status.status')
                        ->join('smt_request_status', "smart_request.inv_no = smt_request_status.inv_no AND smt_request_status.status = (SELECT smt_request_status.status FROM smt_request_status WHERE smart_request.inv_no = smt_request_status.inv_no ORDER BY smt_request_status.id DESC LIMIT 1)", 'left')
                        ->where('smt_request_status.status','Management')
                        ->orWhere('smt_request_status.status ','reject')
                        ->orWhere('smt_request_status.status ','approve')
                        ->groupBy('smart_request.inv_no')
                        ->get()
                        ->getResultArray();
    	} else {
    		$SmartRequestList = $this->SmartRequestModel
                        ->list()
                        ->select('smart_request.*,smt_request_status.status')
                        ->join('smt_request_status', "smart_request.inv_no = smt_request_status.inv_no WHERE smart_request.department = '".$this->user_dept."' AND smt_request_status.status = (SELECT smt_request_status.status FROM smt_request_status WHERE smart_request.inv_no = smt_request_status.inv_no ORDER BY smt_request_status.id DESC LIMIT 1)", 'left')
                        ->groupBy('smart_request.inv_no')
                        ->get()
                        ->getResultArray();
    	}
        $data = [
            'request_list'		=> $SmartRequestList,
            'serial'			=> $this->SmartRequestModel->serial_chk()->orderBy("id DESC")->limit("1")->get()->getRowArray(),
            'number_pad'		=> $this->snippets,
            ];
        return view('smartrequest/request_list', $data);
    }

    public function requestDelete($id)
    {   
        if ($this->SmartRequestModel->request_delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'SmartRequest',
                'action_done'       =>  'Delete Request',
                'remarks'           =>  'User id :'.$id,
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

    public function mrequestAdd($id)
    {
    	$serial = $this->SmartRequestModel->serial_chk()->orderBy("id DESC")->limit("1")->get()->getRowArray()['sr'];

    	if ($serial !== $id) {
            $newinv = "SMT".$this->snippets->number_pad(str_replace("SMT","",/*(int)*/$serial)+1,8);
            $this->db->table('sm_request_sr')->insert(['sr'=> $newinv]);
            return redirect()->to('/smart/request/create/'.$newinv);
        }

        if ($this->request->getPost()) {
        	$id 			= $this->request->getPost('inv_no');
			$inv_no      	= $this->request->getPost('inv_no');
			$location   	= $this->request->getPost('location');
			$sub_type   	= $this->request->getPost('sub_type');
			$dept   		= session()->get('user')['emp_data']['dept'];
			$prep_by   		= session()->get('user')['emp_data']['name'];
			$item_name      = $this->request->getPost('item_name');
			$quantity      	= $this->request->getPost('quantity');
			$product_price	= $this->request->getPost('product_price');
			$itmvalue      	= $this->request->getPost('itmvalue');
			$vat_rate      	= $this->request->getPost('vat_rate');
			$vat_val      	= $this->request->getPost('vat_val');
			$amount      	= $this->request->getPost('amount');
			$idiscount      = $this->request->getPost('idiscount');
			$total_cost     = $this->request->getPost('total_cost');
			$discount      	= $this->request->getPost('discount');
			$created_at    	= (!empty($id)?date('Y-m-d H:i:s'):'');
            $dataArray = array();
            for ($i = 0; $i < count($this->request->getPost('item_name')); $i++) {
	            $dataStore = array(
	            	// 'mid'      		=> (!empty($mid) ? $mid : 0),
					'inv_no'      	=> (!empty($inv_no) ? $inv_no : 0),
	            	'sub_type'  	=> (!empty($sub_type) ? $sub_type : 0),
	            	'department'  	=> (!empty($dept) ? $dept : 0),
	            	'prep_by'  		=> (!empty($prep_by) ? $prep_by : 0),
	                'item_name'     => (!empty($item_name[$i]) ? $item_name[$i] : 0),
	            	'location'  	=> (!empty($location[$i]) ? $location[$i] : 0),
	                'quantity'      => (!empty($quantity[$i]) ? $quantity[$i] : 0),
	                'product_price' => (!empty($product_price[$i]) ? $product_price[$i] : 0),
	                'itmvalue'      => (!empty($itmvalue[$i]) ? $itmvalue[$i] : 0),
	                'vat_rate'      => (!empty($vat_rate[$i]) ? $vat_rate[$i] : 0),
	                'vat_val'      	=> (!empty($vat_val[$i]) ? $vat_val[$i] : 0),
	                'amount'      	=> (!empty($amount[$i]) ? $amount[$i] : 0),
	                'idiscount'     => (!empty($idiscount[$i]) ? $idiscount[$i] : 0),
	                'total_cost'    => (!empty($total_cost[$i]) ? $total_cost[$i] : 0),
	                'discount'      => (!empty($discount) ? $discount : 0),
            		'created_at'    => (!empty($created_at) ? $created_at : 0),
	            );
	            array_push($dataArray, $dataStore);
            }
            if (!$this->SmartRequestModel->request_create($dataArray)) {
                $this->session->setFlashData('error','Smart Request not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'SmartRequest',
                'action_done'       =>  'New Request',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            
            $statuslog = array(
                'inv_no'       		=>  $id,
                'emp_id'       		=>  session()->get('user')['emp_data']['emp_id'],
                'emp_name'       	=>  session()->get('user')['emp_data']['name'],
                'created_at'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('smt_request_status')->insert($statuslog);

            $this->session->setFlashData('success','Smart Request are added successfully!');
            return redirect()->to('/smart/request/view/'.$id);
        } else {
        	$data = [
                'subject_type'  => $this->SmartRequestModel
					                	->subject_type()
					                    ->orderBy("`sub_type` REGEXP '^[^A-Za-z]'" , "ASC")
					                    ->orderBy("sub_type")
					                    ->get()
					                    ->getResultArray(),
                'locations'     => $this->locationModel->locations_list()
										->groupBy('sections.id')
										->orderBy("`section_name` REGEXP '^[^A-Za-z]'" , "ASC")
					                    ->orderBy("section_name")
										->get()
										->getResultArray(),

            ];
      		return view('smartrequest/new_request', $data);
        }
    }


    public function mrequestView($id)
    {   
        if ($this->request->getPost()) {
        	$emp_dept = $this->employeeModel->where('emp_id',$this->request->getPost('approv_by'))->first(['dept']);
        	// $dataPost = $this->request->getPost();

        	if ($emp_dept == 'Finance') {
        		$dataArray = [
        			'emp_id'		=> $this->emp_id,
        			'inv_no'		=> $id,
        			'emp_name'		=> $this->fname,
        			'status'		=> $this->request->getPost('status'),
        		];
        		$this->db->table('smart_request')->where('id',$id)->update(['discount'=>$this->request->getPost('discount')]);
            } elseif ($this->emptype == "Manager" AND $this->user_dept == "Finance" ) {
                $dataArray = [
        			'emp_id'		=> $this->emp_id,
        			'inv_no'		=> $id,
        			'emp_name'		=> $this->fname,
        			'status'		=> $this->request->getPost('status'),
        			'note'			=> $this->request->getPost('note'),
        		];
            } elseif ($this->user_type == "gm" ) {
            	$dataArray = [
        			'emp_id'		=> $this->emp_id,
        			'inv_no'		=> $id,
        			'emp_name'		=> $this->fname,
        			'status'		=> $this->request->getPost('status'),
        			'note'			=> $this->request->getPost('note'),
        		];
            } else {
            	$dataArray = [
        			'emp_id'		=> $this->emp_id,
        			'inv_no'		=> $id,
        			'emp_name'		=> $this->fname,
        			'status'		=> $this->request->getPost('status'),
        		];
        		$this->db->table('smart_request')->where('id',$id)->update(['discount'=>$this->request->getPost('discount')]);
            }


            if (!$this->SmartRequestModel->smt_status_create($dataArray)) {
                $this->session->setFlashData('error','Smart Request not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'SmartRequest',
                'action_done'       =>  'Open Request',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $statuslog = array(
                'inv_no'       		=>  $id,
                'emp_id'       		=>  session()->get('user')['emp_data']['emp_id'],
                'emp_name'       	=>  session()->get('user')['emp_data']['name'],
                'created_at'        =>  date('Y-m-d H:i:s'),
            );
            $this->session->setFlashData('success','Smart Request are added successfully!');
            return redirect()->to('/smart/request/view/'.$id);
        } else {
			if ($this->emptype == "Manager" AND $this->user_dept <> "Finance" ) {
				$slctypqry = $this->db->table('employees')->where('dept','Finance')->where('status','active')->where('emptype','Manager')->get()->getResultArray();
			} elseif ($this->emptype == "Manager" AND $this->user_dept == "Finance") {
				$slctypqry = $this->db->table('employees')->where('emp_id','2')->get()->getResultArray();
			} elseif ($this->user_type == "gm") {
				$slctypqry = $this->db->table('employees')->where('emp_id','2')->get()->getResultArray();
			} else {
				$slctypqry = $this->db->table('employees')->where('dept',$this->user_dept)->where('status','active')->where('emptype','Manager')->get()->getResultArray();
			}
        	foreach ($slctypqry as $val) {
        	    $values[] = "<option value=\"".$val['emp_id']."\">".$val['name']."</option>";
        	}
        	$data = [
                'invSum'  		=> $this->SmartRequestModel
					                	->list()
					                	->select("*")
					                	->selectSum('total_cost','subtotal')
                    					->selectSum('vat_val','tvat_val')
                    					->selectSum('discount','tdiscount')
                    					->where('inv_no', $id)
					                    ->get()
					                    ->getRowArray(),
                'invview'     	=> $this->SmartRequestModel
										->list()
                    					->where('inv_no', $id)
					                    ->get()
					                    ->getResultArray(),
				'selecttype'	=> implode(",",$values),
				'status'		=> $this->db->table('smt_request_status')
										->select("*")
				                        ->select('smt_request_status.status AS smtstatus, smt_request_status.note AS smtnote')
				                        ->join('employees', "smt_request_status.emp_id = employees.emp_id")
				                        ->where('inv_no', $id)
				                        ->orderBy("smt_request_status.id DESC")
				                        ->limit("1")
				                        ->get()
				                        ->getRowArray(),
				'attach_count' 	=> $this->SmartRequestModel
										->smt_attachment()
										->selectCount('id')
										->where('inv_no', $id)
				                        ->get()
				                        ->getRowArray(),
				'attachments' 	=> $this->SmartRequestModel
										->smt_attachment()
										->where('inv_no', $id)
				                        ->get()
				                        ->getResultArray(),

            ];
      		return view('smartrequest/view_request', $data);
        }
    }

    // Upload file
	public function fileUpload(){
		$data = array();
		// Read new token and assign to $data['token']
		$data['token'] = csrf_hash();
		## Validation
		$validation = \Config\Services::validation();
		$input = $validation->setRules([
			'file' => 'uploaded[file]|max_size[file,5120]|ext_in[file,jpeg,jpg,png,pdf],'
		]);
		if ($validation->withRequest($this->request)->run() == FALSE){
			$data['success'] = 2;
			$data['error'] = $validation->getError('file');// Error response
		}else{
			if($file = $this->request->getFile('file')) {
				if ($file->isValid() && ! $file->hasMoved()) {
					// Get file name and extension
					$name = $file->getName();
					$ext = $file->getClientExtension();
					$path = "./app-assets/assets/smt_attachment/";
					// Get random file name
					$newName = $file->getRandomName();
					// Store data to database
					$dataStore = array(
						'inv_no'      	=> $this->request->getPost('invno'),
						'attachment'    => $newName,
						'docu_ext'    	=> $ext
					);
					$this->SmartRequestModel->add_smt_attachment($dataStore);
					// $this->db->table('smt_attachment')->insert($dataStore);
					// Store file in public/uploads/ folder
					$file->move($path, $newName);
					// Response
					$data['success'] = 1;
					$data['message'] = 'Uploaded Successfully!';
				// $data['message'] = $count;
				}else{
					// Response
					$data['success'] = 2;
					$data['message'] = 'File not uploaded.'; 
				}
			}else{
				// Response
				$data['success'] = 3;
				$data['message'] = 'File not uploaded.';
			}
		}
		return $this->response->setJSON($data);
	}


}
