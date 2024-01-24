<?php

namespace App\Models;

use CodeIgniter\Model;

class SmartRequestModel extends Model
{
    /*protected $DBGroup              = 'default';
    protected $table                = 'smartrequests';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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
    protected $afterDelete          = [];*/

    /*Start Machine Handling*/
    public function list()
    {// Done

        return $this->db->table('smart_request');
    }

    public function request_create($postData = array())
    {//Done
        return $this->db->table('smart_request')->insertBatch($postData);
    }

    public function request_update($data, $id)
    {// Done
        return $this->db->table('smart_request')->where('id',$id)->update($data);
    }

    public function request_delete($id)
    {//Done
        $this->db->table('smart_request')->where('inv_no',$id)->delete();
        return $this->db->table('smt_request_status')->where('inv_no',$id)->delete();
    }
    /*End Machine Handling*/

    public function serial_chk()
    {// Done
        return $this->db->table('sm_request_sr');
    }

    public function subject_type()
    {// Done
        return $this->db->table('smt_subject_type');
    }

    public function smt_attachment()
    {// Done
        return $this->db->table('smt_attachment');
    }

    public function add_smt_attachment($postData = array())
    {//Done
        return $this->db->table('smt_attachment')->insert($postData);
    }

    public function smt_status_create($postData = array())
    {//Done
        return $this->db->table('smt_request_status')->insert($postData);
    }
}
