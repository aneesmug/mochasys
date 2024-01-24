<?php

namespace App\Models;

use CodeIgniter\Model;

class CustCardModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'custcards';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $allowedFields        = ['cust_no','injazat_no','sectin_nme','exp_date','status'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $validationRules = [
        'injazat_no'        => 'required',
        'sectin_nme'        => 'required',
        'exp_date'          => 'required',
    ];
    protected $validationMessages = [
        'injazat_no'        =>['required'   =>'Injazat No is required'],
        'sectin_nme'        =>['required'   =>'Must be select store location.'],
        'exp_date'          =>['required'   =>'Expiry date is required'],
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
