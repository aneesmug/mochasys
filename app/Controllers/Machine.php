<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MachineModel;
use Config\Services;

class Machine extends BaseController
{
    public function __construct()
    {
        $this->MachineModel 		= new MachineModel();
        $this->validation           = Services::validation();
    }

    public function index()
    {

    }


    public function machineList()
    {
        $data = [
            'machines'             	=> $this->MachineModel
                                            ->list()
                                            ->get()
                                            ->getResultArray(),
            'brand_list'     		=> $this->MachineModel
                                            ->brand_list()
                                            ->orderBy("name REGEXP '^[^A-Za-z]' ASC, name")
                                            ->get()
                                            ->getResultArray(),
			'location_list'			=> $this->MachineModel
                                            ->location_list()
                                            ->distinct()
                                            ->groupBy('section_name')
                                            ->orderBy("section_name REGEXP '^[^A-Za-z]' ASC, section_name")
                                            ->get()
                                            ->getResultArray(),
            ];

            // dd($data['machines']);
            

        return view('machine/machines', $data);
    }

    public function view($id)
    {
        $data = [
            'machine'  				=> $this->MachineModel->list()
                                            ->where('machines.id',$id)
                                            ->get()
                                            ->getRowArray(),
            'brand_list'     		=> $this->MachineModel
                                            ->brand_list()
                                            ->orderBy("name REGEXP '^[^A-Za-z]' ASC, name")
                                            ->get()
                                            ->getResultArray(),
			'location_list'			=> $this->MachineModel
                                            ->location_list()
                                            ->distinct()
                                            ->groupBy('section_name')
                                            ->orderBy("section_name REGEXP '^[^A-Za-z]' ASC, section_name")
                                            ->get()
                                            ->getResultArray(),
			'invoices'				=> $this->MachineModel
                                            ->invoice_list()
                                            ->where('machine_inv.mid',$id)
                                            ->groupBy('machine_inv.inv_no')
                                            ->get()
                                            ->getResultArray(),
			'transfers'				=> $this->MachineModel
                                            ->transfer_list()
                                            ->where('machine_trans.mid',$id)
                                            ->get()
                                            ->getResultArray(),
            ];
            
            // dd($data['invoices']);

        
        return view('machine/machine_view', $data);
    }

    public function machineAdd()
    {
        if ($this->request->getPost()) {

            $data = [
                'name_mach'		=> $this->request->getPost('name_mach'),
                'm_id'       	=> $this->request->getPost('m_id'),
                'serial'     	=> $this->request->getPost('serial'),
                'made_year'   	=> $this->request->getPost('made_year'),
                'remarks'       => $this->request->getPost('remarks'),
                'maker_name'    => $this->request->getPost('maker_name'),
                'location_id' 	=> $this->request->getPost('location'),
                'created_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            /*print_r($data);
            exit();*/

            if (!$this->MachineModel->machine_create($data)) {
                $this->session->setFlashData('error','Machine not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Machine',
                'action_done'       =>  'Add new MachineModel',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Machine are added successfully!');
            return redirect()->to('/machine/list');
        }
    }


    public function machineEdit()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('machineid');

            $data = [
                'name_mach'		=> $this->request->getPost('name_mach'),
                'm_id'       	=> $this->request->getPost('m_id'),
                'serial'     	=> $this->request->getPost('serial'),
                'made_year'   	=> $this->request->getPost('made_year'),
                'remarks'       => $this->request->getPost('remarks'),
                'maker_name'    => $this->request->getPost('maker_name'),
                'location_id' 	=> $this->request->getPost('location'),
                'status'        => $this->request->getPost('status'),
                'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->MachineModel->machine_update($data, $id)) {
                $this->session->setFlashData('error','Machine not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Machine',
                'action_done'       =>  'Edit Machine',
                'remarks'           =>  'Machine id :'. $id,
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Machine are updated successfully!');
            return redirect()->to('/machine/view/'.$id);
        }
    }

    public function machineDelete($id)
    {   
        if ($this->MachineModel->machine_delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Machine',
                'action_done'       =>  'Delete Machine',
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


    public function brandAdd()
    {
        if ($this->request->getPost()) {
            $data = [
                'name'      => $this->request->getPost('name'),
                'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->MachineModel->brand_create($data)) {
                $this->session->setFlashData('error','Brand not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Machine',
                'action_done'       =>  'Add new Brand',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Brand are added successfully!');
            return redirect()->to('/machine/list');
        }
    }

    public function invAdd()
    {
        if ($this->request->getPost()) {
        	$id = $this->request->getPost('iid');

			$mid      		= $this->request->getPost('iid');
			$inv_no      	= $this->request->getPost('inv_no');
			$location_id   	= $this->request->getPost('location_id');
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
	            	'mid'      		=> (!empty($mid) ? $mid : 0),
					'inv_no'      	=> (!empty($inv_no) ? $inv_no : 0),
	            	'location_id'  	=> (!empty($location_id) ? $location_id : 0),
	                'item_name'     => (!empty($item_name[$i]) ? $item_name[$i] : 0),
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

            if (!$this->MachineModel->invoice_create($dataArray)) {
                $this->session->setFlashData('error','Invoice not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Machine',
                'action_done'       =>  'Add new Invoice',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Invoice are added successfully!');
            return redirect()->to('/machine/view/'.$id);
        }
    }

    public function viewInvoice($id)
    {
        $data = [
			'invoices'				=> $this->MachineModel
                                            ->invoiceOpen()
                                            ->where('machine_inv.inv_no',$id)
                                            ->get()
                                            ->getResultArray(),
			'invSum'				=> $this->MachineModel
                                            ->invoiceOpen()
                                            ->select('machine_inv.created_at AS invCreateDate')
                                            ->select('machine_inv.inv_no AS invno')
                                            ->where('machine_inv.inv_no',$id)
                                            ->selectSum('total_cost','subtotal')
                        					->selectSum('vat_val','tvat_val')
                        					->selectSum('discount','tdiscount')
                                            ->get()
                                            ->getRowArray(),
            ];

            // dd($data['invSum']);
        
        return view('machine/invoice_view', $data);
    }

    public function invDelete($id)
    {
        if ($this->MachineModel->invoice_delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Machine',
                'action_done'       =>  'Delete Machine Invoice',
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

    public function transferAdd()
    {
        if ($this->request->getPost()) {
            
            $id = $this->request->getPost('mid');
            $data = [
                'm_id'          => $this->request->getPost('m_id'),
                'mid'           => $this->request->getPost('mid'),
                'location'      => $this->request->getPost('location'),
                'old_location'  => $this->request->getPost('old_location'),
                'created_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->MachineModel->transfer_create($data)) {
                $this->session->setFlashData('error','Transfer not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Machine',
                'action_done'       =>  'Add new Transfer',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->db->table('machines')->where('id', $id)->update(['location_id'=> $this->request->getPost('location')] );
            $this->session->setFlashData('success','Transfer are added successfully!');
            return redirect()->to('/machine/view/'.$id);
        }
    }


}
