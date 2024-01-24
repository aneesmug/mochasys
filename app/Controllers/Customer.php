<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\SectionModel;
use App\Models\CustCardModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class Customer extends BaseController
{

 public function __construct() {
        $this->customerModel        = new CustomerModel();
        $this->sectionModel       = new SectionModel();
        $this->custCardModel       = new CustCardModel();
        $this->mpdf                 = new Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_top' => 20, 'margin_left' => 5, 'margin_right' => 5, 'orientation' => 'P' ]); /*['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 10, 'margin_top' => 10, 'margin_right' => 10, 'margin_bottom' => 1, 'orientation' => 'P' ]*/
    }

    public function index()
    {
        return view('customer/customer_list');
    }

    /********************Start Customer Query*********************/
    /*public function showEmployees()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'emp_no',
            1=>'birth_date',
            2=>'first_name',
            3=>'last_name',
            4=>'gender',
            5=>'hire_date',
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        $this->db->limit($length,$start);
        $employees = $this->db->get("employees");
        $data = array();
        foreach($employees->result() as $rows)
        {

            $data[]= array(
                $rows->emp_no,
                $rows->birth_date,
                $rows->first_name,
                $rows->last_name,
                $rows->gender,
                $rows->hire_date,
                '<a href="#" class="btn btn-warning mr-1">Edit</a>
                 <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );     
        }
        $total_employees = $this->totalEmployees();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function totalEmployees()
    {
        $query = $this->db->select("COUNT(*) as num")->get("employees");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }*/

    /********************Start Customer Query*********************/
    public function getCustomers()
    {
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
         $totalRecords = $this->customerModel
                ->select('id')
                ->countAllResults();

         ## Total number of records with filtering
         $totalRecordwithFilter = $this->customerModel
                ->select('id')
                ->orLike('full_name', $searchValue)
                ->orLike('injazat_no', $searchValue)
                ->orLike('acc_no', $searchValue)
                ->orLike('mobile', $searchValue)
                ->countAllResults();
         ## Fetch records
         $records = $this->customerModel
                ->select('*')
                ->orLike('full_name', $searchValue)
                ->orLike('injazat_no', $searchValue)
                ->orLike('acc_no', $searchValue)
                ->orLike('mobile', $searchValue)
                ->orderBy($columnName,$columnSortOrder)
                ->findAll($rowperpage, $start);

         $data = array();

         foreach($records as $record ){

            $viewButton = "<a href='".base_url('customer/view')."/".$record['id']."' class='btn btn-dark'><i class='ft ft-eye'></i></a>";
            $editButton = "<a href='".base_url('customer/edit')."/".$record['id']."' class='btn btn-info'><i class='ft ft-edit'></i></a>";
            $deleteButton = "<a href='javascript:void(0);' data-id='".$record['id']." ?>' class='btn btn-danger delete'><i class='ft ft-trash-2'></i></a>";
            $action = "<div class='btn-group' role='group' aria-label='Basic example'>".$viewButton." ".$editButton." ".$deleteButton."</div>";            

            $data[] = array( 
               "full_name"  =>$record['full_name'],
               "injazat_no" =>$record['injazat_no'],
               "acc_no"   =>$record['acc_no'],
               "mobile"    =>$record['mobile'],
               "updated_at" =>$record['updated_at'],
               "exp_date"   =>$record['exp_date'],
               "status"    =>$record['status'],
               "action"  =>$action,

            ); 
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            // "token" => csrf_hash() // New token hash
         );
         return $this->response->setJSON($response);
    }

    public function exportExcel()
    {
        $data = $this->customerModel->findAll();
        $file_name = 'data.xlsx';
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->mergeCells('A1:F1');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'All Customers Data');
        $sheet->setCellValue('A2', 'Customer Name');
        $sheet->setCellValue('B2', 'Injazat No.');
        $sheet->setCellValue('C2', 'Acc. No.');
        $sheet->setCellValue('D2', 'Mobile');
        $sheet->setCellValue('E2', 'Issue Date');
        $sheet->setCellValue('F2', 'Expiry Date');
        $count = 3;
        foreach($data as $row)
        {
            $sheet->setCellValue('A' . $count, $row['full_name']);
            $sheet->setCellValue('B' . $count, $row['injazat_no']);
            $sheet->setCellValue('C' . $count, $row['acc_no']);
            $sheet->setCellValue('D' . $count, $row['mobile']);
            $sheet->setCellValue('E' . $count, $row['updated_at']);
            $sheet->setCellValue('F' . $count, $row['exp_date']);
            $count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($file_name));
        flush();
        readfile($file_name);
        exit;
    }

    public function exportPdf()
    {
        $mpdf = $this->mpdf;
        $data['customers'] = $this->customerModel->findAll();
        $html=view('customer/exportPdf', $data);
        // $mpdf->SetHeader('Document Title|Center Text|{PAGENO}');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHTMLHeader('
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th width=90>Injazat No.</th>
                            <th width=80>Acc. No.</th>
                            <th width=90>Mobile</th>
                            <th width=140>IssueDate</th>
                            <th width=100>ExpDate</th>
                        </tr>
                        </thead>
                    </table>
                    ');
                        $mpdf->SetFooter('
                    <table width="100%">
                        <tr>
                            <td width="33%">{DATE j-m-Y}</td>
                            <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                            <td width="33%" style="text-align: right;">All Customers</td>
                        </tr>
                    </table>
                    ');
        $mpdf->WriteHTML($html);
        $file_name = "filename.pdf";
        $this->response->setHeader('Content-Type', 'application/pdf');
        ob_end_clean();
        $mpdf->Output($file_name,'D');
        // $mpdf->Output($file_name,'I');        
    }

    public function register()
    {
     if ($this->request->getPost()) {
      $this->customerModel->transBegin();
         if (!$this->customerModel->insert($this->request->getPost())) {
             $this->session->setFlashData('errors', $this->customerModel->errors());
             return redirect()->to('/customer/register')->withInput();
         }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Customer',
                'action_done'       =>  'Register new Customer',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
         $this->customerModel->transCommit();
         $this->session->setFlashData('success', "Customer Registered Successfully!");
         return redirect()->to('/customer/list'); 
     } else {

      $data = [
                'sections'  => $this->sectionModel
                    ->orderBy(" `section_name` REGEXP '^[^A-Za-z]'" , "ASC")
                    ->orderBy("section_name")
                    ->findAll(),
            ];

      return view('customer/customer_register', $data);
     }
    }

    public function view($id)
    {
        $customerData  = $this->customerModel->where('id',$id)->first();
        $cardData       = $this->custCardModel
                        ->where('cust_no',$customerData['id'])
                        ->findAll();
        
        if (!$customerData) {
                throw PageNotFoundException::forPageNotFound('Customer Not Found');
        } else {
            $data = [
                'customer'  => $customerData,
                'cards'   => $cardData,
                'sections'  => $this->sectionModel
                    ->orderBy(" `section_name` REGEXP '^[^A-Za-z]'" , "ASC")
                    ->orderBy("section_name")
                    ->findAll(),
            ];
        }
        return view('customer/customer_view', $data);
    }

    public function edit($id)
    {
        if ($this->request->getPost()) {
            if (!$this->customerModel->update($id, $this->request->getPost())) {
                $this->session->setFlashData('errors', $this->customerModel->errors());
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Customer',
                'action_done'       =>  'Edit customer',
                'remarks'           =>  'Customer id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('message','Customer details are updated successfully!');
            return redirect()->to('/employee/view/'.$id);
        }
        
         $data = [
                'customer'      => $this->customerModel->find($id),
                'sections'   => $this->sectionModel
                    ->orderBy(" `section_name` REGEXP '^[^A-Za-z]'" , "ASC")
                    ->orderBy("section_name")
                    ->findAll(),
                ];

        return view('customer/customer_edit', $data);
    }

    public function delete($id)
    { 
        if ($this->customerModel->where('id', $id)->delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Customer',
                'action_done'       =>  'Delete customer',
                'remarks'           =>  'Customer id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $data = [
                'status'    => 'success',
                'message'   => 'Record Deleted Successfully...',
                'token'     => csrf_hash()
            ];
        } else {
            $data = [
                'status'        => 'error',
                'message'       => 'Unable to delete this record...',
                'token'         => csrf_hash()
            ];
        }
        return $this->response->setJSON($data);
    }
    /********************End Customer Query*********************/
    /********************Start VIP Card Query*********************/
    public function update_card($id)
    {
     
     $lastresult = $this->custCardModel->where('cust_no',$id)->orderBy('`id`','DESC')->limit('1')->first();
     $this->custCardModel->update($lastresult['id'], ['status' => 'I']);

     $this->custCardModel->transBegin();
        if (!$this->custCardModel->insert($this->request->getPost())) {
            $this->session->setFlashData('errors', $this->custCardModel->errors());
            $this->session->setFlashData('error','VIP card not updated, becuse there are some error!');
            return redirect()->to("/customer/view/$id")->withInput();
        }
        /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Customer VIP Card',
                'action_done'       =>  'update card',
                'remarks'           =>  'Customer id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
        $this->custCardModel->transCommit();
        $this->session->setFlashData('success', "Customer VIP Card Updated Successfully!");
        return redirect()->to("/customer/view/$id");

    }

    public function add_card($id)
    { 
     $lastresult = $this->custCardModel->where('cust_no',$id)->orderBy('`id`','DESC')->limit('1')->first();
     $this->custCardModel->update($lastresult['id'], ['status' => 'I']);
     $lastinjazt = $this->customerModel->where('id',$id)->orderBy('`id`','DESC')->limit('1')->first();
     
     $data = [
      'injazat_no'  => $this->request->getPost('injazat_no'),
      'exp_date'   => $this->request->getPost('exp_date')
     ];

     $this->customerModel->update($lastinjazt['id'], $data);

     $this->custCardModel->transBegin();
        if (!$this->custCardModel->insert($this->request->getPost())) {
            $this->session->setFlashData('errors', $this->custCardModel->errors());
            $this->session->setFlashData('error','VIP card not registered, becuse there are some error!');
            return redirect()->to("/customer/view/$id")->withInput();
        }
        /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Customer',
                'action_done'       =>  'Add new VIP card'.$id,
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
        $this->custCardModel->transCommit();
        $this->session->setFlashData('success', "Customer VIP Card Registered Successfully!");
        return redirect()->to("/customer/view/$id");
    }

    public function delete_card($id)
    { 
        if ($this->custCardModel->where('id', $id)->delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Customer',
                'action_done'       =>  'Delete VIP card',
                'remarks'           =>  'Card id :'. $id, //$this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $data = [
                'status'    => 'success',
                'message'   => 'Record Deleted Successfully...',
                'token'     => csrf_hash()
            ];
        } else {
            $data = [
                'status'        => 'error',
                'message'       => 'Unable to delete this record...',
                'token'         => csrf_hash()
            ];
        }
        return $this->response->setJSON($data);
    }

    /********************End VIP Card Query*********************/



}
