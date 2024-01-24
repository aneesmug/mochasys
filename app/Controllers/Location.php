<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UseFullSnippets;
use App\Models\DepartmentModel;
use App\Models\LocationModel;
use CodeIgniter\Config\validation;
use Config\Services;
use chillerlan\QRCode\{QRCode, QROptions};

/*use App\Libraries\Ciqrcode;*/


class Location extends BaseController
{

 public function __construct()
    {
        $this->locationModel        = new LocationModel();
        $this->departmentModel      = new DepartmentModel();
        $this->validation           = Services::validation();
        $this->tlv                  = new UseFullSnippets();
    }

    public function locationList()
    {
        $locations = $this->locationModel->locations_list()
              ->select('sections.*')
              ->select('count(machines.location_id) AS totalDvc')
              ->join('machines', 'machines.location_id=sections.id', 'left')
              ->groupBy('sections.id')
              ->get()
              ->getResultArray();
        // dd($locations);
        $data = [
            'locations'     => $locations,
            'permission'     => $this->permission,
        ];
        return view('location/locations_list', $data);
    }

    public function registerLocation()
    {
        $dataPost = [
            'section_name'     => $this->request->getPost('section_name'),
            'dept'       => $this->request->getPost('dept'),
            'location_owner'     => $this->request->getPost('location_owner'),
            'camera_in'      => $this->request->getPost('camera_in'),
            'camera_out'      => $this->request->getPost('camera_out'),
            'b_license_exp'     => $this->request->getPost('b_license_exp'),
            'b_license_no'     => $this->request->getPost('b_license_no'),
            'location_dist'     => $this->request->getPost('location_dist'),
            'bulding_base'     => $this->request->getPost('bulding_base'),
            'bulding_size'     => $this->request->getPost('bulding_size'),
            't_bulding_size'     => $this->request->getPost('t_bulding_size'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'      => $this->request->getPost('longitude'),
            'location_name'     => $this->request->getPost('location_name'),
            'municipality'     => $this->request->getPost('municipality'),
            'sub_municipality'    => $this->request->getPost('sub_municipality'),
        ];
        $data = [
            'departments' => $this->departmentModel->getDepartment(),
            'permission'    => $this->permission,
        ];
        if ($this->request->getPost()) {
            if (!$this->locationModel->location_create($dataPost)) {
             $this->session->setFlashData('errors', $this->validation->getErrors());
                return redirect()->to('/location/register')->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Location',
                'action_done'       =>  'Add new location',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success', "Location Registered Successfully!");
            return redirect()->to('/location/register');
        } else {
            return view('location/location_register', $data);
        }
    }

    public function view($id)
    {
        $data = [
            'location'  => $this->locationModel->locations_list()
                                                    ->select('sections.*, sections.id as loc_id')
                                                    ->select('location_img.*')
                                                    ->select('count(machines.location_id) AS totalDvc')
                                                    ->join('machines', 'machines.location_id=sections.id', 'left')
                                                    ->join('location_img','location_img.location_id=sections.id', 'left')
                                                    ->where('sections.id',$id)
                                                    ->get()
                                                    ->getRowArray(),
            'departments' => $this->departmentModel->getDepartment(),
            'loc_contract'  => $this->locationModel->location_contract_list()->where('location_id',$id)->get()->getResultArray(),
            'loc_document'  => $this->locationModel->location_docu_list()->where('location_id',$id)->get()->getResultArray(),
            'loc_machines'  => $this->locationModel->location_machine_list()->where('location_id',$id)->get()->getResultArray(),
            'location_list' => $this->locationModel->locations_list()->groupBy('section_name')->get()->getResultArray(),
            'permission'    => $this->permission,
            ];
            
        
        if (!$data['location']['in']) {
            $insrtData = [
                'location_id'   => $id,
                'in'            => './app-assets/assets/location_pics/default_in.jpg',
                'out'           => './app-assets/assets/location_pics/default_in.jpg',
            ];
            $this->db->table('location_img')->insert($insrtData);
        }
        // dd($data['loc_machines']);
        return view('location/location_view', $data);
    }

    public function qrcode($id)
    {
        $loc = $this->locationModel->locations_list()->where('id',$id)->get()->getRowArray();
        $options = new QROptions([
            'version'           => 4,
            'eccLevel'          => QRCode::ECC_L,
            'imageBase64'       => false,
            'logoSpaceWidth'    => 0,
            'scale'             => 6,
            'imageTransparent'  => false,
            'outputType'        => QRCode::OUTPUT_IMAGE_JPG,
        ]);
        $data = "https://www.google.com/maps?q={$loc['latitude']},{$loc['longitude']}";
        $qrcode = new QRCode($options);
        $this->response->setHeader('Content-Type', 'image/png');
        return $qrcode->render($data);
        // $qrcode->addByteSegment($data);        
    }

    public function editLocation($id)
    {   
        $dataPost = [
            'section_name'          => $this->request->getPost('section_name'),
            'dept'                  => $this->request->getPost('dept'),
            'location_owner'        => $this->request->getPost('location_owner'),
            'camera_in'             => $this->request->getPost('camera_in'),
            'camera_out'            => $this->request->getPost('camera_out'),
            'b_license_exp'         => $this->request->getPost('b_license_exp'),
            'b_license_no'          => $this->request->getPost('b_license_no'),
            'location_dist'         => $this->request->getPost('location_dist'),
            'bulding_base'          => $this->request->getPost('bulding_base'),
            'bulding_size'          => $this->request->getPost('bulding_size'),
            't_bulding_size'        => $this->request->getPost('t_bulding_size'),
            'latitude'              => $this->request->getPost('latitude'),
            'longitude'             => $this->request->getPost('longitude'),
            'location_name'         => $this->request->getPost('location_name'),
            'municipality'          => $this->request->getPost('municipality'),
            'sub_municipality'      => $this->request->getPost('sub_municipality'),
            'updated_at'            => (!empty($id)?date('Y-m-d H:i:s'):''),
        ];

        if ($this->request->getPost()) {
            if (!$this->locationModel->location_update($dataPost, $id)) {
                $this->session->setFlashData('errors', $this->validation->getErrors());
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Location',
                'action_done'       =>  'Edit location',
                'remarks'           =>  'Location id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Location details are updated successfully!');
            return redirect()->to('/location/view/'.$id);
            // return redirect()->to('/location/edit/'.$id);
        }
        
         $data = [
                'location'      => $this->locationModel->locations_list()->where('id',$id)->get()->getRowArray(),
                'departments'   => $this->departmentModel->getDepartment(),
                'permission'    => $this->permission,
                ];

        return view('location/location_edit', $data);
    }

    public function deleteLocation($id)
    { 
        if ($this->locationModel->location_delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Location',
                'action_done'       =>  'Delete location',
                'remarks'           =>  'Location id :'. $id, //$this->db->insertID(),
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
                'status'    => 'error',
                'message'   => 'Unable to delete this record ...',
                'token'     => csrf_hash()
            ];
        }
        return $this->response->setJSON($data);
    }


    public function registerContract($loc_id)
    {
        $dataPost = [
            'location_id'           => $loc_id,
            'owner_name'            => $this->request->getPost('owner_name'),
            'owner_number'          => $this->request->getPost('owner_number'),
            'owner_email'           => $this->request->getPost('owner_email'),
            'contract_no'           => $this->request->getPost('contract_no'),
            'start_cont_date'       => $this->request->getPost('start_cont_date'),
            'end_cont_date'         => $this->request->getPost('end_cont_date'),
            'rent'                  => $this->request->getPost('rent'),
            'others'                => $this->request->getPost('others'),
            'service'               => $this->request->getPost('service'),
            'elect_prc'             => $this->request->getPost('elect_prc'),
            'water_prc'             => $this->request->getPost('water_prc'),
            'incuranse_prc'         => $this->request->getPost('incuranse_prc'),
        ];
        $data = [
            'departments'   => $this->departmentModel->getDepartment(),
            'permission'    => $this->permission,
        ];
        if ($this->request->getPost()) {
            if (!$this->locationModel->contract_create($dataPost)) {
                $this->session->setFlashData('errors', $this->validation->getErrors());
                return redirect()->to('location/view/'.$loc_id)->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Location',
                'action_done'       =>  'Add new location',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('sections')->where('id',$loc_id)->update(['location_owner' => $this->request->getPost('owner_name')]);
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success', "Location Contract Registered Successfully!");
            return redirect()->to('location/view/'.$loc_id);
        } else {
            return view('location/location_register', $data);
        }
    }


    public function storeFile($id)
    {        
        if ($this->request->getFile('file')) {
            $file = $this->request->getFile('file');
            $validated = $this->validate(
                [
                    'file' => [
                        'uploaded[file]',
                        'mime_in[file,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.ms-excel,application/vnd.ms-excel.sheet.macroEnabled.12,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                        'max_size[file,4096]',
                    ],
                ],
                [   // Errors
                    'file' => [
                        'mime_in'   => 'Please select only IMAGE or PDF file.',
                        'max_size'  => 'This file is too large of a file. Maximum allow only 4MB',
                    ],
                ]
            );
            if (!$validated) {
                $this->session->setFlashData('error', $this->validation->getErrors()['file']);
                return redirect()->to(base_url('/location/view/'.$id));
            } else {
                $name = $file->getRandomName(); // Generate a new secure name
                $path = './app-assets/assets/location_documents/';
                $file->move($path,$name);
                $data = [
                    'location_id'   => $id,
                    'docu_typ'      => $this->request->getPost('docu_typ'),
                    'docu_ext'      => $file->getClientExtension(),
                    'path'          => $path.$name,
                ];
            $this->db->table('location_docu')->insert($data);
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Location',
                'action_done'       =>  'Add documents',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','File will be uploaded successfully!');
            return redirect()->to(base_url('/location/view/'.$id));
            }
        }
        $this->session->setFlashData('error', 'Sorry, there was an error uploading your file.');
        return redirect()->to(base_url('/location/view/'.$id));
    }

    public function download($id){
        $builder = $this->db->table('location_docu')->where('id',$id)->get()->getRowArray();
        return $this->response->download($builder['path'], null);
    }

    public function uploadImg()
    {
        // $loc_id     = session()->get('user')['emp_data']['emp_id'];
        $loc_id     = $_POST["loc_id"];
        $data       = $_POST["image"];
        $type       = $_POST["type"];
        $imgPosition = $_POST["imgPosition"];
        $img_arr_a  = explode(";", $data);
        $img_arr_b  = explode(",", $img_arr_a[1]);
        $data       = base64_decode($img_arr_b[1]);
        $img_name   = time().".jpg";
        $image_link = './app-assets/assets/location_pics/'.$img_name;
        file_put_contents($image_link, $data);
        $img_file   = $img_name;        

        if ($imgPosition == "in") {
            $store = $this->db->table('location_img')->where('location_id',$loc_id)->update(['in' => $image_link]);
        } elseif ($imgPosition == "out") {
            $store = $this->db->table('location_img')->where('location_id',$loc_id)->update(['out' => $image_link]);
        }

        // $store = $builder->insert($AplyVacData);
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



    public function loadMachines($id)
    {   
        $location_list = $this->locationModel->locations_list()->groupBy('section_name')->get()->getResultArray();
        $locList = array();
        foreach ($location_list as $value) {
            $locList[] = "<option value='".$value['id']."'>".$value['section_name']."</option>";
        }

        $request = service('request');
        $postData = $request->getVar();
        // $postData = $request->getPost();
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
        $totalRecords = $this->locationModel->location_machine_list()
            ->select('id')
            ->where('location_id',$id)
            ->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->locationModel->location_machine_list()
            ->select('id')
            ->orLike('name_mach', $searchValue)
            // ->orLike('m_id', $searchValue)
            ->where('location_id',$id)
            ->countAllResults();
        ## Fetch records 
        $records = $this->locationModel->location_machine_list()
            ->select('*')
            ->orLike('name_mach', $searchValue)
            // ->orLike('m_id', $searchValue)
            ->orderBy($columnName,$columnSortOrder)
            ->where('location_id',$id)
            ->get($rowperpage, $start)->getResultArray();
        $data = array();

        $x = 1;
        foreach($records as $record ){

        $viewButton = "<a href='".base_url('machine/view')."/".$record['id']."' class='btn btn-dark' target='_blank'><i class='ft ft-eye'></i></a>";
        $editButton = "<a href='javascript:void(0);' class='btn btn-info transferMachine' data-mchid='".$record['id']."' data-m_id='".$record['m_id']."' data-location='".$record['location_id']."' ><i class='ft ft-repeat'></i></a>";

        $action = "<div class='btn-group' role='group' aria-label='Basic example'>".$viewButton." ".$editButton."</div>";

        $data[] = array( 
           "id"         => $x++,
           "name_mach"  => $record['name_mach'],
           "m_id"       => $record['m_id'],
           "transferTo" => "<select name='transferTo' class='transferTo".$record['id']."'><option value=''>Select location</option>".implode(" ",$locList)."</select>",
           "action"     => $action,
        ); 
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
         );
         return $this->response->setJSON($response);
    }

    public function transferToLocation()
    {
        if($this->request->getPost('type')=="3")
        {
            $dataArray = [
                'm_id'          => $this->request->getPost('m_id'),
                'mid'           => $this->request->getPost('mid'),
                'location'      => $this->request->getPost('location'),
                'old_location'  => $this->request->getPost('old_location')
            ];
            if ($this->db->table('machine_trans')->insert($dataArray)) {
                $this->db->table('machines')->where('id',$this->request->getPost('mid'))->update(['location_id' => $this->request->getPost('location')]);
                echo json_encode(array(
                    "token"         => csrf_hash(),
                    "statusCode"    => 200
                ));
            }
        }
    }

    public function statusLocat()
    {
        if($this->request->getPost('type')=="close")
        {
            $id         = $this->request->getPost('locid');
            $action     = $this->request->getPost('action');
            $updated_at = date('Y-m-d H:i:s');
            if ($this->db->table('sections')->where('id',$id)->update(['status' => $action, 'updated_at' => $updated_at])) {
                echo json_encode(array(
                    "token"         => csrf_hash(),
                    "statusCode"    => 200
                ));
            }
        }
    }


    public function contractEdit()
    {
        $id = $this->request->getPost('contid');
        if($this->request->getPost('type')=="Contractupdate"){
                $dataPost = [
                'location_id'           => $this->request->getPost('location_id'),
                'owner_name'            => $this->request->getPost('owner_name'),
                'owner_number'          => $this->request->getPost('owner_number'),
                'owner_email'           => $this->request->getPost('owner_email'),
                'contract_no'           => $this->request->getPost('contract_no'),
                'start_cont_date'       => $this->request->getPost('e_start_date'),
                'end_cont_date'         => $this->request->getPost('e_end_date'),
                'rent'                  => $this->request->getPost('rent'),
                'others'                => $this->request->getPost('others'),
                'service'               => $this->request->getPost('service'),
                'elect_prc'             => $this->request->getPost('elect_prc'),
                'water_prc'             => $this->request->getPost('water_prc'),
                'incuranse_prc'         => $this->request->getPost('incuranse_prc'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];
            if ($this->db->table('location_contract')->where('id',$id)->update($dataPost)) {
                echo json_encode(array(
                    "token"         => csrf_hash(),
                    "message"       => "Contract informations has been update successfully !",
                    "statusCode"    => 200
                ));
            }
        }
    }












    /*******************Saudi VAT E-Invoice QR*********************/
    /*public function qrcode_vat()
    {
        $company_name   = 'شركة موكاتشينو';
        $vat_no         = '300235101700003';
        $totalAmnt      = '1000';
        $totalvat       = $totalAmnt / 100 * 15;

        $dataToEncode = [
            [1, $company_name],
            [2, $vat_no],
            [3, date('c')],
            [4, $totalAmnt],
            [5, $totalvat]
        ];
        $data = base64_encode($this->tlv->getTLV($dataToEncode));
        $options = new QROptions([
            'version'           => 7,
            'eccLevel'          => QRCode::ECC_L,
            'imageBase64'       => false,
            'logoSpaceWidth'    => 0,
            'scale'             => 6,
            'imageTransparent'  => false,
            'outputType'        => QRCode::OUTPUT_IMAGE_JPG,
        ]);
        $qrcode = new QRCode($options);
        $this->response->setHeader('Content-Type', 'image/png');
        return $qrcode->render($data);
    }*/
    /*******************Saudi VAT E-Invoice QR*********************/


}




