<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class LocationModel extends Model
{
    public function locations_list()
    {// Done
        return $this->db->table('sections');
    }

    public function location_dvc_list()
    {// Done
        return $this->db->table('location_dvc');
    }

    public function location_create($postData = array())
    {//Done
        $validation                     = Services::validation();
        $validation->setRules(
                [
                    'section_name'      => 'required',
                    'dept'              => 'required',
                    'location_owner'    => 'required',
                    'b_license_exp'     => 'required',
                    'b_license_no'      => 'required',
                    'location_dist'     => 'required',
                    'latitude'          => 'required',
                    'longitude'         => 'required',
                    'location_name'     => 'required',
                ],
                [
                    'section_name'      => [ 'required' => 'Enter location name'],
                    'dept'              => [ 'required' => 'Select department name'],
                    'location_owner'    => [ 'required' => 'Enter location owner name'],
                    'b_license_exp'     => [ 'required' => 'Select Baldiya license exp.'],
                    'b_license_no'      => [ 'required' => 'Enter Baldiya license No.'],
                    'location_dist'     => [ 'required' => 'Enter district name'],
                    'latitude'          => [ 'required' => 'Enter Latitude'],
                    'longitude'         => [ 'required' => 'Enter Longitude'],
                    'location_name'     => [ 'required' => 'Enter location address'],
                ]
            );

        if ($validation->run($postData)) {
            return $this->db->table('sections')->insert($postData);
        }
    }

    public function location_update($postData, $id)
    {// Done
        $validation                     = Services::validation();
        $validation->setRules(
                [
                    'section_name'      => 'required',
                    'dept'              => 'required',
                    'location_owner'    => 'required',
                    'b_license_exp'     => 'required',
                    'b_license_no'      => 'required',
                    'location_dist'     => 'required',
                    'latitude'          => 'required',
                    'longitude'         => 'required',
                    'location_name'     => 'required',
                ],
                [
                    'section_name'      => [ 'required' => 'Enter location name'],
                    'dept'              => [ 'required' => 'Select department name'],
                    'location_owner'    => [ 'required' => 'Enter location owner name'],
                    'b_license_exp'     => [ 'required' => 'Select Baldiya license exp.'],
                    'b_license_no'      => [ 'required' => 'Enter Baldiya license No.'],
                    'location_dist'     => [ 'required' => 'Enter district name'],
                    'latitude'          => [ 'required' => 'Enter Latitude'],
                    'longitude'         => [ 'required' => 'Enter Longitude'],
                    'location_name'     => [ 'required' => 'Enter location address'],
                ]
            );

        if ($validation->run($postData)) {
            return $this->db->table('sections')->where('id',$id)->update($postData);
            // return $this->db->table('sections')->insert($postData);
        }
        
    }

    public function location_delete($id)
    {//Done
        return $this->db->table('sections')->where('id',$id)->delete();
    }

    /*public function create($data = array())
    {// Done
        $this->db->table('role_permission')->where('role_id', $data[0]['role_id'])->delete();
        return $this->db->table('role_permission')->insertBatch($data);
    }*/

    public function location_docu_list()
    {// Done
        return $this->db->table('location_docu');
    }

    public function location_machine_list()
    {// Done
        return $this->db->table('machines');
    }

    public function location_contract_list()
    {// Done
        return $this->db->table('location_contract');
    }

    public function contract_create($postData = array())
    {//Done
        $validation                     = Services::validation();
        $validation->setRules(
                [
                    'owner_name'        => 'required',
                    'owner_number'      => 'required',
                    'owner_email'       => 'required|valid_email',
                    'contract_no'       => 'required',
                    'start_cont_date'   => 'required',
                    'end_cont_date'     => 'required',
                    'rent'              => 'required',
                ],
                [
                    'owner_name'    => [ 'required' => 'Enter Owner name'],
                    'owner_number'      => [ 'required' => 'Enter owner contact No.'],
                    'owner_email'       => [ 'required' => 'Enter Email address'],
                    'contract_no'       => [ 'required' => 'Enter contract no'],
                    'start_cont_date'   => [ 'required' => 'Select Starting date'],
                    'end_cont_date'     => [ 'required' => 'Select Ending date'],
                    'rent'              => [ 'required' => 'Enter rent amount'],
                ]
            );

        if ($validation->run($postData)) {
            return $this->db->table('location_contract')->insert($postData);
        }
    }

    /*public function contract_update($data, $id)
    {// Done
        return $this->db->table('location_contract')->where('id',$id)->update($data);
    }*/



}
