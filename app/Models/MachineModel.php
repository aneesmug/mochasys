<?php

namespace App\Models;

use CodeIgniter\Model;

class MachineModel extends Model
{
    /*protected $DBGroup              = 'default';
    protected $table                = 'machines';
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

        return $this->db->table('machines')
                        ->select('machines.*')
                        ->select('sections.*')
                        ->select('machines.id AS iid')
                        ->select('machines.status AS mstatus')
                        ->select('sections.section_name AS mlocation')
                        ->select('count(machine_inv.mid) AS totalInv')
                        ->join('sections','machines.location_id=sections.id')
                        ->join('machine_inv', 'machines.id=machine_inv.mid', 'left')
                        ->groupBy('machines.id')
                        ;
    }

    public function machine_create($postData = array())
    {//Done
        return $this->db->table('machines')->insert($postData);
    }

    public function machine_update($data, $id)
    {// Done
        return $this->db->table('machines')->where('id',$id)->update($data);
    }

    public function machine_delete($id)
    {//Done
        return $this->db->table('machines')->where('id',$id)->delete();
    }
    /*End Machine Handling*/

    /*Start Location Handling*/
    public function location_list()
    {//Done
        return $this->db->table('sections');
    }
    /*End Location Handling*/

    /*Start Brand Handling*/
    public function brand_list()
    {//Done
        return $this->db->table('brand_name');
    }

    public function brand_create($postData = array())
    {//Done
        return $this->db->table('brand_name')->insert($postData);
    }
    /*End Brand Handling*/

    /*Start Invoice Handling*/
    public function invoice_list()
    {//Done
        // return $this->db->table('machine_inv');
        return $this->db->table('machine_inv')
                        ->select('machine_inv.*')
                        ->select('sections.*')
                        ->select('machine_inv.id AS iid')
                        ->select('sections.section_name AS mlocation')
                        ->join('sections','machine_inv.location_id=sections.id')
                        ->selectSum('total_cost','subtotal')
                        ->selectSum('vat_val','tvat_val');
                        // ->where('machines.status','1');
    }

    public function invoiceOpen()
    {//Done
        // return $this->db->table('machine_inv');
        return $this->db->table('machine_inv')
                        ->select('machine_inv.*')
                        ->select('machine_inv.id AS iid')
                        ->select('sections.section_name AS mlocation')
                        ->select('machines.name_mach')
                        ->join('sections','machine_inv.location_id=sections.id')
                        ->join('machines','machine_inv.mid=machines.id')

                        ;
    }

    public function invoice_create($postData = array())
    {//Done
        return $this->db->table('machine_inv')->insertBatch($postData);
    }

    public function invoice_update($data, $id)
    {// Done
        return $this->db->table('machine_inv')->where('id',$id)->update($data);
    }

    public function invoice_delete($id)
    {//Done
        return $this->db->table('machine_inv')->where('inv_no',$id)->delete();
    }
    /*End Invoice Handling*/

    /*Start Invoice Handling*/
    public function transfer_list()
    {//Done
        // return $this->db->table('machine_inv');
        return $this->db->table('machine_trans')
                        ->select('machine_trans.*')
                        ->select('nloc.section_name AS mnlocation')
                        ->select('oloc.section_name AS molocation')
                        ->join('sections AS nloc','machine_trans.location=nloc.id')
                        ->join('sections AS oloc','machine_trans.old_location=oloc.id')
                        ->join('machines','machine_trans.mid=machines.id');
    }

    public function transfer_create($postData = array())
    {//Done
        return $this->db->table('machine_trans')->insert($postData);
    }

    public function transfer_update($data, $id)
    {// Done
        return $this->db->table('machine_trans')->where('id',$id)->update($data);
    }

    public function transfer_delete($id)
    {//Done
        return $this->db->table('machine_trans')->where('inv_no',$id)->delete();
    }
    /*End Invoice Handling*/

}
