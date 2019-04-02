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
class Tvts extends MY_Table {

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    public function init() {
        $this->controller_path = 'MANAGERS/tvts';
        $this->view_path = 'MANAGERS/course';
        $this->sub_folder = 'MANAGERS';
        $list_view = array(
            'id' => array(
                'name_display' => 'ID TVTS',
                'order' => '1'
            ),
            'username' => array(
                'name_display' => 'Username',
                'order' => '1'
            ),
            'name' => array(
                'name_display' => 'Họ tên',
                'order' => '1'
            ),
            'email' => array(
                'name_display' => 'Email',
                'order' => '1'
            ),
            'phone' => array(
                'name_display' => 'Số điện thoại',
                'order' => '1'
            ),
            'active' => array(
                'type' => 'custom',
                'name_display' => 'Hoạt động',
                'order' => '1'
            ),
        );
        $this->set_list_view($list_view);
        $this->set_model('staffs_model');
    }
    
    function delete_item() {
        die('Không thể xóa, liên hệ admin để biết thêm chi tiết');
    }

    function delete_multi_item() {
        show_error_and_redirect('Không thể xóa, liên hệ admin để biết thêm chi tiết', '', FALSE);
    }


    public function index($offset = 0) {
        $conditional = array('where' => array('role_id' => '1'));
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        $data = $this->data;
        $data['slide_menu'] = 'cod/common/slide-menu';
        $data['top_nav'] = 'cod/common/top-nav';
        $data['list_title'] = 'Danh sách các TVTS';
        $data['edit_title'] = 'Sửa thông tin TVTS';
        $data['content'] = 'base/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function show_edit_item() {
        /*
         * type mặc định là text nên nếu là text sẽ không cần khai báo
         */
        $this->list_edit = array(
            'left_table' => array(
                'id' => array(
                    'type' => 'disable'
                ),
                'username' => array(),
                'name' => array()
            ),
            'right_table' => array(
                'email' => array(),
                'phone' => array(
                    'type' => 'datetime'
                ),
                'active' => array(
                    'type' => 'custom'
                )
            ),
        );
        parent::show_edit_item();
    }

    protected function show_table() {
        parent::show_table();
        /*
         * Nếu có điều kiện đặc biệt thì thêm vào $row class css đặc biệt khi hiển thị
         * ví dụ: giá khóa học lớn hơn 4 triệu thì báo đỏ
         */
        foreach ($this->data['rows'] as &$value) {
            if ($value['active'] == 0) {
                $value['warning_class'] = 'inactive';
            }
        }
        unset($value);
    }

}
