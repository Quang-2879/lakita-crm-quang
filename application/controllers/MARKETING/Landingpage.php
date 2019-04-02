<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Landingpage
 *
 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 */
class Landingpage extends MY_Controller{
    
    function index($offset){
        /*
         * Mảng data từ MY_Controller lưu những biến chung, ví dụ:
         * 1. controller
         * 2. method...
         */
        $data = $this->data;
        /*
         * Lấy biến $_GET khi thực hiện các thao tác như
         * 1. Lọc
         * 2. Sắp xếp
         * 3. Tìm kiếm...
         */
        $get = $this->input->get();
        $conditional = array();
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset, 'courses_model');
        /*
         * Lấy link phân trang và danh sách contacts
         */
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row'], 4, 'MANAGERS/manage_course/index');
        $data['courses'] = $data_pagination['data'];
        $data['total_courses'] = $data_pagination['total_row'];

        $data['slide_menu'] = 'manager/common/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['content'] = 'manager/manage_course/index';
        $tableArr = 'course_id course_code course_name price_root price_sale website note active action';
        $data['load_js'] = array(
            'm_manage_course', 'm_delete_course'
        );
        $data['table'] = explode(' ', $tableArr);
        $this->load->view(_MAIN_LAYOUT_, $data);
    }
    //put your code here
}
