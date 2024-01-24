<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\hijriGregorianConvert;

class EmployeeModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'employees';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    // protected $allowedFields        = ['name','emp_id','iqama','iqama_exp','iqama_exp_g','mobile','passport_number','passport_exp','email','g_number','dial_code','emg_mobile','emg_name','salary','dept','sectin_nme','emptype','country','vacation_days','joining_date','status','login_usr','fly','bank_name','iban','note','ter_note','ter_date','dob','vac_period','sex','blood_type','mar_status','t_shirt_size','emp_sup_type','avatar','address','insurance_no','insurance_exp','date_reg'];
    protected $allowedFields        = ['name','emp_id','iqama','iqama_exp','iqama_exp_g','mobile','passport','passport_exp','email','emg_mobile','emg_name','emp_relation','emg_address','salary','dept','sectin_nme','emptype','country','vacation_days','balance_days','joining_date','bank_name','iban','dob','vac_period','sex','blood_type','mar_status','t_shirt_size','emp_sup_type','avatar','address','insurance_no','insurance_exp'];

    // Dates
    protected $useTimestamps        = true;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    
    protected $dateFormat           = 'datetime';
    // Validation
    protected $validationRules = [
        
        'name'          => 'required|alpha_numeric_space|min_length[3]',
        // 'emp_id'        => 'required|is_unique[employees.emp_id]|numeric|min_length[4]',
        'emp_id'        => 'required|numeric|min_length[4]',
        // 'iqama'         => 'required|numeric|min_length[10]|is_unique[employees.iqama]',
        'iqama'         => 'required|numeric|min_length[10]',
        'iqama_exp'     => 'required',
        'mobile'        => 'required|numeric|min_length[10]',
        'emg_mobile'    => 'required',
        'emg_name'      => 'required|alpha_numeric_space|min_length[3]',
        'emg_name'      => 'required',
        'emg_address'   => 'required|min_length[6]',
        'salary'        => 'required|numeric',
        // 'email'         => 'required|valid_email|is_unique[employees.email]',
        'dept'          => 'required',
        'sectin_nme'    => 'required',
        'emptype'       => 'required',
        'country'       => 'required',
        'vacation_days' => 'required',
        'joining_date'  => 'required',
        'bank_name'     => 'required',
        'iban'          => 'required',
        'dob'           => 'required',
        'vac_period'    => 'required',
        'blood_type'    => 'required',
        't_shirt_size'  => 'required',
        'address'       => 'required',
        'emp_sup_type'  => 'required',
    ];

    protected $validationMessages = [
        'name'          =>[
            'required'              =>'Full Name is required',
            'min_length'            =>"Full name minimum length 3",
        ],
        'emp_id'        =>[
            'required'              =>'Employee ID is required',
            'is_unique'             =>'This number is already exists',
            'numeric'               =>'Only numeric is allow',
            'min_length'            =>"Employee ID minimum length 4",
        ],
        'iqama'         =>[
            'required'              =>'Iqama / ID is required',
            // 'is_unique'             =>'This number is already exists',
            'numeric'               =>'Only numeric is allow',
            'min_length'            =>"Employee ID minimum length 10",
        ],
        'iqama_exp'     =>['required'   =>'Iqama / ID expiry is required',],
        'mobile'        =>[
            'required'              =>'Mobile no is required',
            'numeric'               =>'Only numeric is allow',
            'min_length'            =>"Employee mobile no is minimum length 10",
        ],
        'emg_mobile'    =>['required'   =>'Emergency mobile is required',],
        'emg_name'      =>[
            'required'              =>'Emergency name is required',
            'min_length'            =>"Name minimum length 3",
        ],
        'emp_relation'  =>['required'   =>'Must be select relationship name.',
        ],
        'emg_address'      =>[
            'required'              =>'Emergency address is required',
            'min_length'            =>"Address minimum length 6",
        ],
        'salary'        =>[
            'required'              =>'Salary field is required',
            'numeric'               =>'Only numeric is allow',
        ],
        'dept'          =>['required'   =>'Department field is required'],
        'sectin_nme'    =>['required'   =>'Section field is required'],
        'emptype'       =>['required'   =>'Employee type is required'],
        'country'       =>['required'   =>'Nationality field is required'],
        'vacation_days' =>['required'   =>'Vacation days field is required'],
        'joining_date'  =>['required'   =>'Joining date is required'],
        'bank_name'     =>['required'   =>'Bank field is required'],
        'iban'          =>['required'   =>'IBAN field is required'],
        'dob'           =>['required'   =>'Date of birth is required'],
        'vac_period'    =>['required'   =>'Contract period is required'],
        'blood_type'    =>['required'   =>'Blood type is required'],
        't_shirt_size'  =>['required'   =>'Shirt size is required'],
        'address'       =>['required'   =>'Address field is required'],
        'emp_sup_type'  =>['required'   =>'Must be select Employee Sponsor'],
        
    ];
    
    protected $beforeInsert         = ['hijriGregorian'];
    protected $beforeUpdate         = ['hijriGregorian'];
    /*
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
    */

    public function transBegin() {
        return $this->db->transBegin();
    }
    public function transRollback() {
        return $this->db->transRollback();
    }
    public function transCommit() {
        return $this->db->transCommit();
    } 
    public function hijriGregorian($data)
    {
        $DateConv = new hijriGregorianConvert();
        if ($data['data']['iqama_exp']) {
            $data['data']['iqama_exp_g'] = $DateConv->HijriToGregorian($data['data']['iqama_exp'], "DD/MM/YYYY");
        }
        return $data;        
    }

    public function count_employee($fly=false, $emp_sup_type=false, $dept=false, $status=false)
    {
        $emp_data = $this->select('*')
                        ->where('fly', $fly)
                        ->where('emp_sup_type', $emp_sup_type)
                        ->where('dept', $dept)
                        ->where('status', $status)
                        ->countAllResults();
        return $emp_data;
    }

    public function employeeMod() {
        return $this->db->table('employees');
    }

}
