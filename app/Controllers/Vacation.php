<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\VacationModel;
use App\Models\SalaryModel;
use CodeIgniter\Exceptions\PageNotFoundException;



class Vacation extends BaseController
{
	public function __construct()
	{
        $this->employeeModel    = new EmployeeModel();
		$this->VacationModel    = new VacationModel();
        $this->SalaryModel      = new SalaryModel();
        $this->employeeMod      = $this->employeeModel->employeeMod();
        $this->applyVacation    = $this->VacationModel->applyVacation();
        $this->vacationsData    = $this->VacationModel->vacationsData();
	}

    public function index()
    {

        /*$data = $this->VacationModelData
                        ->select('emp_id, user_update')
                        ->where('emp_id','152')
                        ->get()
                        ->getResultArray();

        echo "<pre>";
        var_dump( $data );
        exit();*/
    }

    public function register($id)
    {

        $emp            = $this->employeeModel->where('id',$id)->first();
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
                    'replacement_per'   => $this->request->getPost('replacement_per'),
                    'fly_type'          => $this->request->getPost('fly_type'),
                    'vac_strt_date'     => $this->request->getPost('vac_strt_date'),
                    'return_date'       => $this->request->getPost('return_date'),
                    'joining_date'      => $this->request->getPost('joining_date'),
                    'vac_type'          => $vac_type,
                    'empgid'            => $id,
                    'next_vac_date'     => $next_vac_date,
                    'last_vac_date'     => $last_vac_date,
                ];
                $this->db->transBegin();
                if ( !$this->applyVacation->insert($AplyVacData) ) {
                    $this->session->setFlashData('errors', "There's some errors");
                    return redirect()->to('/employee/view/'.$id)->withInput();
                }
                $this->db->transCommit();
                /*Start Insert log history*/
                $accesslog = array(
                    'action_page'       =>  'Vacation',
                    'action_done'       =>  'Register new vacation',
                    'remarks'           =>  $this->db->insertID(),
                    'user_name'         =>  $this->session->get('user')['id'],
                    'entry_date'        =>  date('Y-m-d H:i:s'),
                );
                $this->db->table('accesslog')->insert($accesslog);
                /*End Insert log history*/
                $this->session->setFlashData('success', "Vacation request applied successfully!");
                return redirect()->to('/employee/view/'.$id);
            } else {
                $this->session->setFlashData('error', "Your vacation selective days ($vacdays) not matched with your balance vacation days (".$balance_days.").");
                return redirect()->to('/employee/view/'.$id);
            }
        } else {
            $this->session->setFlashData('error', "Your vacation days already extends from Vacation days.");
            return redirect()->to('/employee/view/'.$id);
        }
        
        return redirect()->to('/employee/view/'.$id);
    }

    public function updateHr($id)
    {

        $vac_strt_date  = $this->request->getPost('vac_strt_date');
        $return_date    = $this->request->getPost('return_date');
        $lastvacdtls    = $this->applyVacation
                                ->select('*')
                                ->where('id', $id)
                                ->orderBy('id','DESC')
                                ->limit('1')
                                ->get()
                                ->getRowArray();
        
        $flydatetime    = strtotime(date('M d Y', strtotime(date('M d Y', strtotime(str_replace('/', '-', $vac_strt_date))))));
        $returndatetime = strtotime(date('M d Y', strtotime(date('M d Y', strtotime(str_replace('/', '-', $return_date))))));   
        $secs           = $returndatetime - $flydatetime;// == <seconds between the two times>
        $vacdays        = $secs / 86400;
        $updated_at     = (!empty($id)?date('Y-m-d H:i:s'):'');
        $empid          = $this->employeeModel->where('emp_id', $this->request->getPost('emp_id'))->first();
        
        $vacyear        = preg_replace("/[^0-9]/","",$empid['vac_period']);
        $lastvac        = $this->applyVacation
                            ->select('*')
                            ->selectSum('vacdays','SUMDAYS')
                            ->where("`vac_strt_date` >= CONCAT(YEAR(NOW()), '-01-01') AND `vac_strt_date`  < CONCAT(YEAR(NOW()), '-01-01') + INTERVAL '".$vacyear."' YEAR")
                            ->where('status','approve')
                            ->where('emp_id',$empid['emp_id'])
                            ->get()
                            ->getRowArray();
        $totsumday      = (count($lastvac)>'0')?$lastvac['SUMDAYS']:"0";

        if ($lastvacdtls['vac_type'] == "Encashed") {
            $vacday         = $empid['vacation_days'] - $totsumday;
        } else {
            $vacday         = ($this->request->getPost('fly_type') <> 'emergency') ? $vacdays : "0";
        }

        $vacday = (session()->get('user')['user_type']!=='dept_user')?$vacday:"";

        $AplyVacData = [
            'permit_fee'        => $this->request->getPost('permit_fee'),
            'ticket_pay'        => $this->request->getPost('ticket_pay'),
            'status'            => $this->request->getPost('status'),
            'hr_note'           => $this->request->getPost('hr_note'),
            'last_vac_date'     => $this->request->getPost('last_vac_date'),
            'review'            => $this->request->getPost('review'),
            'replacement_per'   => $this->request->getPost('replacement_per'),
            'vac_strt_date'     => $vac_strt_date,
            'return_date'       => $return_date,
            'vacdays'           => $vacday,
            'updated_at'        => $updated_at,
        ];

        $this->db->transBegin();
        if ( !$this->applyVacation->where('id',$id)->update($AplyVacData) ) {
            $this->session->setFlashData('error', "There's some errors");
            return redirect()->to('/vacation/applied/list')->withInput();
        }
        if ($lastvacdtls['vac_type'] <> "Encashed") {
            $this->employeeMod->where('id',$empid['id'])->update(['fly' => 'yes'] );
        }
        $this->db->transCommit();
        /*Start Insert log history*/
        $accesslog = array(
            'action_page'       =>  'Vacation',
            'action_done'       =>  'update Vacation from HR',
            'remarks'           =>  'Vacation ID :' .$id,
            'user_name'         =>  $this->session->get('user')['id'],
            'entry_date'        =>  date('Y-m-d H:i:s'),
        );
        $this->db->table('accesslog')->insert($accesslog);
        /*End Insert log history*/
        $this->session->setFlashData('success', "Vacation details are updated successfully!");
        return redirect()->to('/vacation/applied/list');

    }

    public function delete_vac($id)
    { 
        if ($this->applyVacation->where('id', $id)->delete()) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Vacation',
                'action_done'       =>  'Delete vacation',
                'remarks'           =>  'Vacation ID :' .$id,
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

    public function list()
    {
        $data = [
            'vacations'     => $this->applyVacation,
            'replacement'   => $this->employeeModel,
        ];
        return view('vacation/vacation_list', $data);
    }

    public function view($id)
    {
        $vacData        = $this->applyVacation
                            ->select('*')
                            ->where('id',$id)
                            ->get()
                            // ->getRowArray();
                            ->getResultArray()['0'];
                            // ->getResult();
        $emp            = $this->employeeMod->where('emp_id',$vacData['emp_id'])->get()->getResultArray()['0'];
        $empsalary      = $this->SalaryModel->where('emp_id',$vacData['emp_id'])->orderBy('id','DESC')->limit('1')->first();

        $vacyear        = preg_replace("/[^0-9]/","",$emp['vac_period']);
        $lasty          = ($vacyear=="2") ? "- INTERVAL 1 YEAR" : "" ;

        $lastvac        = $this->applyVacation
                            ->select('*')
                            ->selectSum('vacdays','SUMDAYS')
                            ->where("vac_strt_date >= CONCAT(YEAR(NOW()), '-01-01') ".$lasty." AND vac_strt_date  < CONCAT(YEAR(NOW()), '-01-01') + INTERVAL 1 YEAR")
                            // ->where("`vac_strt_date` >= CONCAT(YEAR(NOW()), '-01-01') AND `vac_strt_date`  < CONCAT(YEAR(NOW()), '-01-01') + INTERVAL '".$vacyear."' YEAR")
                            ->where('status','approve')
                            ->where('emp_id',$emp['emp_id'])
                            ->get()
                            ->getRowArray();
        if (!$vacData) {
                throw PageNotFoundException::forPageNotFound('Vacation Not Found');
        } else {
            $data = [
                'employee'      => $emp,
                'vacation'      => $vacData,
                'salary'        => $empsalary,
                'totvac'        => $lastvac,
            ];
        }
        return view('vacation/vacation_view', $data);
    }
}
