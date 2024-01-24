<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'sections';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['section_name','dept','location_owner','camera_in','camera_out','b_license_exp','b_license_no','location_dist','bulding_base','bulding_size','t_bulding_size','latitude','longitude','location_name','municipality','sub_municipality'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';


}
