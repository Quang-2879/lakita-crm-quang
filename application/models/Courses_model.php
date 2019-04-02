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
class Courses_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'courses';
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

    function find_course_name($course_code) {
        $name = '';
        $input2 = array();
        $input2['where'] = array('course_code' => $course_code);
        $courses = $this->load_all($input2);
        if (!empty($courses)) {
            $name = $courses[0]['name_course'];
        }
        return $name;
    }

    function find_course_price_root($course_code) {
        $price = 600000;
        $input2 = array();
        $input2['where'] = array('course_code' => $course_code);
        $courses = $this->load_all($input2);
        if (!empty($courses)) {
            $price = $courses[0]['price'];
        }
        return $price;
    }

}
