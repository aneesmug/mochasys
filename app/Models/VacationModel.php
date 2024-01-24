<?php

namespace App\Models;

use CodeIgniter\Model;

class VacationModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'vacations';
    /*protected $primaryKey           = 'id';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['emp_id','date','user_update','return_date','vacdays','arrived_date','permit_no','remarks','review','note','SUMDAYS'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';*/

    /*public function transBegin() {
        return $this->db->transBegin();
    }
    public function transRollback() {
        return $this->db->transRollback();
    }
    public function transCommit() {
        return $this->db->transCommit();
    }*/

    public function applyVacation()
    {        
        return $this->db->table('apply_vacation');
    }

    public function vacationsData()
    {        
        return $this->db->table('vacations');
    }
    

}
