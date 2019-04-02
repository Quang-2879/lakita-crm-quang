<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course
 *
 * @author CHUYENPN
 */
class Contacts extends MY_Table {

    public function __construct() {
        parent::__construct();
        $this->controller_path = 'contacts';
          $this->sub_folder = 'MANAGERS';
    }

    public function index($offset = 0) {
        $conditional = array(
            'where' => array('id >' => 1000)
        );
        $list_view = array(
            'id' => array('display' => 'ID contact'),
            'name' => array('display' => 'Họ tên'),
            'address' => array('display' => 'Địa chỉ'),
            'course_code' => array('display' => 'Mã khóa học', 'load_custom' => 1),
            'price_purchase' => array('type' => 'currency', 'display' => 'Giá mua'),
            'date_rgt' => array('type' => 'datetime', 'display' => 'Ngày đăng ký'),
        );
        $this->list_search = explode(' ', 'id course_code name_course');
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->set_model('contacts_model');
        $this->set_list_view($list_view);
      
        $this->show_table();
        $data = $this->data;

        /*
         * Nếu có điều kiện đặc biệt thì thêm vào $row class css đặc biệt khi hiển thị
         */
        foreach ($data['rows'] as &$value) {
            if ($value['duplicate_id'] > 0) {
                $value['warning_class'] = 'duplicate';
            }
        }
        unset($value);
        $data['slide_menu'] = 'cod/common/slide-menu';
        $data['top_nav'] = 'cod/common/top-nav';
        $data['list_title'] = 'Danh sách các contact';
        $data['content'] = 'contacts/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

}
