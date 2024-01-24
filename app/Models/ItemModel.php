<?php

namespace App\Models;

use CodeIgniter\Model;


class ItemModel extends Model
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

    public function menu_item_list()
    {// Done

        return $this->db->table('menu_item')
                        ->select('menu_item.*')
                        ->select('menu_category.*')
                        ->select('menu_item.id AS iid')
                        ->select('menu_item.name_eng AS ienname')
                        ->select('menu_item.name_ar AS iarname')
                        ->select('menu_item.status AS istatus')
                        ->select('menu_category.name_eng AS cenname')
                        ->select('menu_category.name_ar AS carname')
                        ->join('menu_category','menu_item.category_id=menu_category.id');
                        // ->where('menu_item.status','1');
    }

    public function menu_item_create($postData = array())
    {//Done
        return $this->db->table('menu_item')->insert($postData);
    }

    public function menu_item_update($data, $id)
    {// Done
        return $this->db->table('menu_item')->where('id',$id)->update($data);
    }

    public function menu_item_delete($id)
    {//Done
        return $this->db->table('menu_item')->where('id',$id)->delete();
    }
    
    public function menu_category_list()
    {// Done
        return $this->db->table('menu_category');
    }

    public function menu_category_create($postData = array())
    {//Done
        return $this->db->table('menu_category')->insert($postData);
    }

    public function menu_category_update($data, $id)
    {// Done
        return $this->db->table('menu_category')->where('id',$id)->update($data);
    }

    public function menu_category_delete($id)
    {//Done
        return $this->db->table('menu_category')->where('id',$id)->delete();
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
