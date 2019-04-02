<?php



/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



/**

 * Description of Staff_model

 *

 * @author CHUYEN

 */

class Staffs_model extends MY_Model {

    public function __construct() {

        parent::__construct();

        $this->table = 'staff';

    }


    function update_where_in($where_in = array(), $data = array()) {

        foreach ($where_in as $key => $value) {

            $this->db->where_in($key, $value);

        }

        $this->db->update($this->table, $data);

        if ($this->db->affected_rows() >= 0) {

            return true;

        } else {

            return false;
        }

    }


    public function find_staff_name($id) {

        $name = '';

        $input2 = array();

        $input2['where'] = array('id' => $id);

        $staffs = $this->load_all($input2);

        if (!empty($staffs)) {

            $name = $staffs[0]['name'];

        }

        return $name;

    }


    public function GetStaffImage($id) {

        $name = '';

        $input2 = array();

        $input2['where'] = array('id' => $id);

        $staffs = $this->load_all($input2);

        if (!empty($staffs)) {

            $name = $staffs[0]['image'];

        }

        return $name;

    }



    public function GetActiveMarketers() {

        $input2 = array();

        $input2['where'] = array('role_id' => MARKETER_ROLE_ID, 'active' => '1');

        return $staffs = $this->load_all($input2);

    }


    public function SumTarget(){
        $this->db->select_sum('targets');
        $this->db->where('role_id', '6');
        $this->db->where('active', '1');
        $query = $this->db->get('staff');
        return $query->result_array();

        // return $query->row();
    }

    public function SumKPI(){
        $this->db->select_sum('kpi');
        $this->db->where('role_id', '6');
        $this->db->where('active', '1');
        $query = $this->db->get('staff');
        return $query->result_array();
    }

}

