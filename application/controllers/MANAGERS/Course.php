<?php

require_once("application/core/MY_Table.php");
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
class Course extends MY_Table {

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    public function init() {
        $this->controller_path = 'MANAGERS/course';
        $this->view_path  = 'MANAGERS/course';
        $this->sub_folder = 'MANAGERS';
        $list_view = array(
            'id' => array(
                'name_display' => 'ID khóa học',
                'order' => '1'
            ),
            'course_code' => array(
                'name_display' => 'Mã khóa học',
                'order' => '1'
            ),
            'name_course' => array(
                'name_display' => 'Tên khóa học',
                'order' => '1'
            ),
            'price' => array(
                'type' => 'currency',
                'name_display' => 'Giá gốc',
                'order' => '1',
            //'display' => 'none'
            ),
            'active' => array(
                'type' => 'custom',
                'name_display' => 'Hoạt động'),
        );
        $this->set_list_view($list_view);
        $this->set_model('courses_model');
        $this->load->model('courses_model');
    }

    public function index($offset = 0) {
        $conditional = array();
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        $data = $this->data;
        $data['slide_menu'] = 'cod/common/slide-menu';
        //$data['top_nav'] = 'cod/common/top-nav';
        if($this->role_id == 1){
			$data['top_nav'] = 'sale/common/top-nav';
			$data['slide_menu'] = 'sale/common/slide-menu';
		}
        $data['list_title'] = 'Danh sách các khóa học';
        $data['edit_title'] = 'Sửa thông tin khóa học';
        $data['content'] = 'base/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function edit_item() {
        /*
         * type mặc định là text nên nếu là text sẽ không cần khai báo
         */
        $this->list_edit = array(
            'left_table' => array(
                'id' => array(
                    'type' => 'disable'
                ),
                'course_code' => array(),
                'name_course' => array()
            ),
            'right_table' => array(
                'course_code' => array(),
                'active' => array()
            ),
        );
        parent::edit_item();
    }

    protected function show_table() {
        parent::show_table();
        /*
         * Nếu có điều kiện đặc biệt thì thêm vào $row class css đặc biệt khi hiển thị
         * ví dụ: giá khóa học lớn hơn 4 triệu thì báo đỏ
         */
        foreach ($this->data['rows'] as &$value) {
            if ($value['price'] > 4000000) {
                $value['warning_class'] = 'duplicate';
            }
        }
        unset($value);
    }
    
    function show_add_item() {

        /*

         * type mặc định là text nên nếu là text sẽ không cần khai báo

         */

        $this->load->model('courses_model');

        $input = array();

        $input['where'] = array('active' => 1);

        $input['order'] = array('course_code' => 'ASC');

        $courses = $this->courses_model->load_all($input);

        $this->list_add = array(
            'left_table' => array(
                'course_code' => array(),
                'name_course' => array(),
                'is_combo' => array('type' => 'array','value' => $courses)
            ),
            'right_table' => array(
                'price' => array(),
                'active' => array()
            ),
        );

        parent::show_add_item();
    }
    
    function action_add_item() {

        $post = $this->input->post();
            
        if (!empty($post)) {

            $post['add_course_code'] = $this->replace_str_to_url($post['add_course_code']);
            
            if ($this->{$this->model}->check_exists(array('course_code' => $post['add_course_code']))) {

                redirect_and_die('Mã khóa học đã tồn tại!');
            }

            if ($post['add_active'] != '0' && $post['add_active'] != '1') {

                redirect_and_die('Trạng thái hoạt động là 0 hoặc 1!');
            }
            

            
            $paramArr = array('course_code','name_course', 'price', 'active');

            foreach ($paramArr as $value) {

                if (isset($post['add_' . $value])) {

                    $param[$value] = $post['add_' . $value];
                }
            }
            
            /* xét xem có phải là combo hay không */ 
            if(isset($post['add_is_combo'])){
                $param['is_combo'] = 1;
                $param['combo_course'] = implode(',', $post['add_combo_course']);
            }else{
                $param['is_combo'] = 0;
                $param['combo_course'] = $param['course_code'];
            }
        
           
            $this->{$this->model}->insert($param);

            show_error_and_redirect('Thêm khóa thành công!');
        }
    }
    
    function show_edit_item($inputData = []) {
        $this->load->model('courses_model');

        $input = array();

        $input['where'] = array('active' => 1);

        $input['order'] = array('course_code' => 'ASC');

        $courses = $this->courses_model->load_all($input);
        $this->list_edit = array(
            'left_table' => array(
                'course_code' => array(),
                'name_course' => array(),
                'is_combo' => array('type' => 'array','value' => $courses)
            ),
            'right_table' => array(
                'price' => array(),
                'active' => array()
            ),
        );

        parent::show_edit_item();
    }
    
    function action_edit_item($id) {

        $post = $this->input->post();

        if (!empty($post)) {

            /*

             * Kiểm tra mã channel đã tồn tại chưa 

             */

            $input = array();

            $input['where'] = array('id' => $id);

            $curr_code = $this->{$this->model}->load_all($input);
            
            $post['edit_course_code'] = $this->replace_str_to_url($post['edit_course_code']);
            
            
            if ($post['edit_course_code'] != $curr_code[0]['course_code'] && $this->{$this->model}->check_exists(array('course_code' => $post['edit_course_code']))) {
                redirect_and_die('Mã khóa học đã tồn tại!');
            }

            $paramArr = array('course_code','name_course', 'price', 'active');

            foreach ($paramArr as $value) {

                if (isset($post['edit_' . $value])) {

                    $param[$value] = $post['edit_' . $value];
                }
            }
            
            /* xét xem có phải là combo hay không */ 
            if(isset($post['edit_is_combo'])){
                $param['is_combo'] = 1;
                $param['combo_course'] = implode(',', $post['edit_combo_course']);
            }else{
                $param['is_combo'] = 0;
                $param['combo_course'] = $param['course_code'];
            }
            
            $this->{$this->model}->update($input['where'], $param);
        }

        show_error_and_redirect('Sửa khóa học thành công!');
    }
    
}
