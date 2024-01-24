<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'customers';
    protected $primaryKey           = 'id';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['full_name','injazat_no','mobile','acc_no','exp_date','shop_no'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $validationRules = [
        
        'full_name'         => 'required|alpha_numeric_space|min_length[3]',
        'injazat_no'        => 'required|numeric|min_length[6]',
        'mobile'            => 'required|numeric|min_length[10]',
        'acc_no'            => 'required',
        'exp_date'          => 'required',
        'shop_no'           => 'required',
    ];
    protected $validationMessages = [
        'full_name'         =>[
            'required'                      =>'Full Name is required',
            'min_length'                    =>"Full name minimum length 3",
        ],
        'injazat_no'        =>[
            'required'                      =>'Enjazat No is required',
            'numeric'                       =>'Only numeric is allow',
            'min_length'                    =>"Enjazat no must be minimum length 6",
        ],
        'mobile'            =>[
            'required'                      =>'Mobile no is required',
            'numeric'                       =>'Only numeric is allow',
            'min_length'                    =>"Customer Mobile number is minimum length 10",
        ],
        'acc_no'            =>['required'   =>'Account number is required'],
        'exp_date'          =>['required'   =>'Expiry date is required'],
        'shop_no'           =>['required'   =>'Location no is required'],
        
    ];

    public function transBegin() {
        return $this->db->transBegin();
    }

    public function transRollback() {
        return $this->db->transRollback();
    }
    
    public function transCommit() {
        return $this->db->transCommit();
    }


}
