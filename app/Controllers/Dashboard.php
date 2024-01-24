<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\VacationModel;

class Dashboard extends BaseController
{
	public function __construct() {
		$this->employeeModel = new EmployeeModel();
		$this->VacationModel    	= new VacationModel();
        $this->vacationsData    	= $this->VacationModel->vacationsData();
        $this->applyVacation    	= $this->VacationModel->applyVacation();
	}

    public function index()
	{
		
	$user_dept = session()->get('user')['user_dept'];
	$user_type = session()->get('user')['user_type'];

	if($user_type == "dept_user"){
		$cont_active 	= $this->employeeModel->count_employee("no", false, $user_dept, "active");
		$cont_ter 		= $this->employeeModel->count_employee(false, false, $user_dept, "no");
		$cont_fly 		= $this->employeeModel->count_employee("yes", "mocha", $user_dept, "active");
		$cont_tot 		= $this->employeeModel->count_employee(false, false, $user_dept, "active");
		$man_power 		= $this->employeeModel->count_employee(false, "man_power", $user_dept, "active");
	}else{
		$cont_active 	= $this->employeeModel->count_employee("no", false, false, "active");
		$cont_ter 		= $this->employeeModel->count_employee(false, false, false, "no");
		$cont_fly 		= $this->employeeModel->count_employee("yes", "mocha", false, "active");
		$cont_tot 		= $this->employeeModel->count_employee(false, false, false, false);
		$man_power 		= $this->employeeModel->count_employee(false, "man_power", false, "active");
	}

		// $datanmp = $this->employeeModel
		// 							->select('*')
		// 							->where('status','active')
		// 							->where('iqama_exp_g BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)')
		// 							->findAll();

		if ($user_dept == 'user_dept') {
			$datanmp = $this->employeeModel
										->select('*')
										->where('status','active')
										->where('DATEDIFF(iqama_exp_g, NOW()) <= ', '1')
										->where('dept',$user_dept)
										->findAll();
		} else {
			$datanmp = $this->employeeModel
										->select('*')
										->where('status','active')
										->where('DATEDIFF(iqama_exp_g, NOW()) <= ', '1')
										->findAll();
		}
		
		
		$data = [
			'cont_active' 	=> $cont_active,
			'cont_ter' 		=> $cont_ter,
			'cont_fly' 		=> $cont_fly,
			'cont_tot' 		=> $cont_tot,
			'man_power' 	=> $man_power,
			'epry_chk_qry' 	=> $datanmp,
			'vacations' 	=> $this->applyVacation,
		];

		/*echo "<pre>";
		print_r ($data);
		echo "</pre>";
		exit();*/

        return view('dashboardView', $data);
	}

	public function dashboardView()
    {
        return view('dashboardView');
    }
    
}
