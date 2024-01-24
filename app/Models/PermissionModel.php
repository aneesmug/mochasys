<?php

namespace App\Models;

use CodeIgniter\Model;


class PermissionModel extends Model
{
    /*protected $DBGroup              = 'default';
    protected $table                = 'permissions';
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

    public function permission_list()
    {
        $query = $this->db->table('modules')->where('status',1)->get();
        if ($query->getNumRows() > 0) {
            return $query->getResultArray();
        }
        return false;
    }
    
    public function module_list2()
    {   // Done
        $query = $this->db->table('modules')->where('status',1)->get();
        if ($query->getNumRows() > 0) {
            return $query->getResultArray();
        }
        return false;
    }
    
    public function sub_module()
    {// Done
        return $this->db->table('sub_module');
    }
    
    public function role_permission()
    {// Done
        return $this->db->table('role_permission');
    }
    
    public function create($data = array())
    {// Done
        $this->db->table('role_permission')->where('role_id', $data[0]['role_id'])->delete();
        return $this->db->table('role_permission')->insertBatch($data);
    }

    public function role_list()
    {// Done
        return $this->db->table('sec_role');
    }

    public function role_update($data, $id)
    {// Done
        return $this->db->table('sec_role')->where('id',$id)->update($data);
    }

    public function role_sec_create($postData = array())
    {//Done
        return $this->db->table('sec_role')->insert($postData);
    }

    public function role_delete($id)
    {//Done
        return $this->db->table('sec_role')->where('id',$id)->delete();
    }

    public function user_update($data, $id)
    {// Done
        return $this->db->table('users')->where('id',$id)->update($data);
    }

    public function module_list()
    {// Done
        return $this->db->table('modules');
    }

    public function module_create($postData = array())
    {//Done
        return $this->db->table('modules')->insert($postData);
    }

    public function module_update($data, $id)
    {// Done
        return $this->db->table('modules')->where('id',$id)->update($data);
    }

    public function module_delete($id)
    {//Done
        return $this->db->table('modules')->where('id',$id)->delete();
    }
    
    public function sub_module_list()
    {// Done
        return $this->db->table('sub_module');
    }

    public function sub_module_create($postData = array())
    {//Done
        return $this->db->table('sub_module')->insert($postData);
    }

    public function sub_module_update($data, $id)
    {// Done
        return $this->db->table('sub_module')->where('id',$id)->update($data);
    }

    public function sub_module_delete($id)
    {//Done
        return $this->db->table('sub_module')->where('id',$id)->delete();
    }

    

    public function user_count(){
        $query = $this->db->query('select * from sec_role');  
        return $query->num_rows();
    }

    public function user_list(){
        $this->db->select('*');
        $this->db->from('sec_role');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    public function user(){
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    
    

    
    public function insert_user_entry($data = array()){
        $this->db->insert('sec_role',$data);
        return $insert_id = $this->db->insert_id();
    }
    public function userdata_editdata($id){
        $this->db->select('*');
        $this->db->from('sec_role');
        $this->db->where('id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function update_role($data,$id){
        $this->db->where('id',$id);
        $this->db->update('sec_role',$data);
        return true;
    }
    
    public function delete_role_permission($id){
        $this->db->where('role_id',$id);
        $this->db->delete('role_permission');
        return true;
    }
    

    public function role_edit($id = null){
       return $roleAcc = $this->db->select('role_permission.*,sub_module.name')
            ->from('role_permission')
            ->join('sub_module','sub_module.id=role_permission.fk_module_id')
            ->where('role_permission.role_id',$id)
            ->get()
            ->result();
    }
    
    public function moduleinfo($id){
     return $info = $this->db->select('*')->from('module')->where('id',$id)->where('status',1)->get()->row();
    }
    //module list
    /*public function module_list(){
       return $module = $this->db->select('*')
            ->from('module')
            ->get()
            ->result();  
    }*/
    // menu info id wise
    public function menuinfo($id){
         return $info = $this->db->select('*')->from('sub_module')->where('id',$id)->where('status',1)->get()->row();
    }
}
