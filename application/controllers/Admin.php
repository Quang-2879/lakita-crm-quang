<?php

/*
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($offset = 0) {
        $data = $this->get_all_require_data();
        $get = $this->input->get();
        /*
         * Điều kiện lấy contact :
         * lấy tất cả contact nên $conditional là mảng rỗng
         *
         */
        $conditional = [];
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);

        /*
         * Lấy link phân trang và danh sách contacts
         */
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['contacts'] = $data_pagination['data'];
        $data['total_contact'] = $data_pagination['total_row'];

        /*
         * Filter ở cột trái và cột phải
         */
//        $data['left_col'] = array('tu_van', 'duplicate', 'course_code', 'sale', 'date_rgt', 'date_handover', 'payment_method_rgt');
//        $data['right_col'] = array('call_status', 'ordering_status', 'cod_status', 'provider');

        /*
         * Các trường cần hiện của bảng contact (đã có default)
         */
        $this->table .= 'call_stt ordering_stt action';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */
        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact',
            'a_delete_one_contact', 'a_retrieve_contact'
        );

        $data['titleListContact'] = 'Danh sách contact mới';
        $data['actionForm'] = 'manager/divide_contact';
        $informModal = 'manager/modal/divide_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'manager/modal/divide_one_contact';
        $data['outformModal'] = explode(' ', $outformModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function delete_one_contact() {
        $post = $this->input->post();
        if (!empty($post['contact_id'])) {
            $where = array('id' => $post['contact_id']);
            $data = array('is_hide' => 1);
            $this->contacts_model->update($where, $data);
            echo '1';
        }
    }

    function delete_forever_one_contact() {
        $post = $this->input->post();
        if (!empty($post['contact_id'])) {
            $where = array('id' => $post['contact_id']);
            $this->contacts_model->delete($where);
            echo '1';
        }
    }

    function retrieve_contact() {
        $post = $this->input->post();
        if (!empty($post['contact_id'])) {
            $where = array('id' => $post['contact_id']);
            $data = array(
                'call_status_id' => 0,
                'ordering_status_id' => 0,
                'sale_staff_id' => 0,
                'cod_status_id' => 0,
                'date_handover' => 0,
                'date_confirm' => 0,
                'date_print_cod' => 0,
                'date_receive_cod' => 0,
                'date_receive_cancel_cod' => 0,
                'date_receive_lakita' => 0,
                'is_hide' => 0,
                'last_activity' => time());
            $this->contacts_model->update($where, $data);

            $data2 = array();
            $data2['contact_id'] = $post['contact_id'];
            $data2['staff_id'] = $this->user_id;
            $data2['time'] = time();
            $statusArr = array('call_status_id', 'ordering_status_id', 'cod_status_id', 'payment_method_rgt', 'provider_id');
            foreach ($statusArr as $value) {
                $data2[$value] = "-1";
            }
            $data2['content_change'] = 'Thu hồi contact';
            $this->load->model('call_log_model');
            $this->call_log_model->insert($data2);
            echo '1';
        }
    }

    private function get_all_require_data() {
        $require_model = array(
            'staffs' => array(
                'where' => array(
                    'role_id' => 1,
                    'active' => 1
                )
            ),
            'courses' => array(
                'where' => array(
                    'active' => 1
                )
            ),
            'call_status' => array(),
            'ordering_status' => array(),
            'cod_status' => array(),
            'providers' => array(),
            'payment_method_rgt' => array()
        );
        return array_merge($this->data, $this->_get_require_data($require_model));
    }

}
