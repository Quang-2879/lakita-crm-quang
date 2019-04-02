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

class Marketers extends MY_Table {

    public function __construct() {

        parent::__construct();

        $this->init();

        $this->load->model('campaign_cost_model');

        $this->load->model('campaign_model');



    }



    public function init() {

        $this->controller_path = 'MANAGERS/' . $this->controller;

        $this->view_path = 'MANAGERS/' . $this->controller;

        $this->sub_folder = 'MANAGERS';

        $list_view = array(

//            'id' => array(

//                'name_display' => 'ID marketer',

//                'order' => '1'

//            ),

            'active' => array(

                'type' => 'binary',

                'name_display' => 'Hoạt động'

            ),

            'username' => array(

                'name_display' => 'Username',

                'order' => '1',

                'display' => 'none'

            ),

            'name' => array(

                'name_display' => 'Họ tên',

                'order' => '1'

            ),

            'email' => array(

                'name_display' => 'Email',

                'order' => '1',

                'display' => 'none'

            ),

            'phone' => array(

                'name_display' => 'Số điện thoại',

                'order' => '1',

                'display' => 'none'

            ),

            'password' => array(

                'name_display' => 'Mật khẩu',

                'display' => 'none'

            ),

            're_password' => array(

                'name_display' => 'Nhập lại mật khẩu',

                'display' => 'none'

            ),

            'total_C3' => array(

                'name_display' => 'Số C3',

            ),

            'spend' => array(

                'type' => 'currency',

                'name_display' => 'Tổng số tiền tiêu',

            ),

            'pricepC3' => array(

                'type' => 'currency',

                'name_display' => 'Giá C3',

            ),

            'channel' => array(

                'name_display' => 'Kênh',

                'order' => '1',

                'display' => 'none'

            ),

        );

        $this->set_list_view($list_view);

        $this->set_model('staffs_model');

    }



    protected function show_table() {

        parent::show_table();

        $get = $this->input->get();

        $date_form = '';

        $date_end = '';

        if (!isset($get['date_from']) && !isset($get['date_end'])) {

            $date_form = strtotime(date('d-m-Y', strtotime("-1 days")));

            $date_end = strtotime(date('d-m-Y', strtotime("-1 days"))) + 24 * 3600 - 1;

        } else {

            $date_form = strtotime($get['date_from']);

            $date_end = strtotime($get['date_end']) + 24 * 3600 - 1;

        }

        foreach ($this->data['rows'] as &$value) {

//            if ($value['active'] == 0) {

//                $value['warning_class'] = 'inactive';

//            }

            /*

             * Lấy số C3

             */

            $input = array();

            $input['select'] = 'id';

            $input['where'] = array('marketer_id' => $value['id'], 'date_rgt >=' => $date_form, 'date_rgt <=' => $date_end);



            if (!empty($get['filter_custom_arr_multi_channel_id'])) {



                $input['where_in']['channel_id'] = $get['filter_custom_arr_multi_channel_id'];

            }

            $total_C3 = $this->contacts_model->load_all($input);

            // echoQuery();

            $value['total_C3'] = count($total_C3);

            /*

             * Lấy budget (tạm tính theo kênh facebook)

             * 1. Lấy các campaign (fb) của từng marketer

             * 2. Tính tổng budget

             */

            $value['spend'] = 0;

            $input = array();

            $input['where'] = array('marketer_id' => $value['id']);

            $campaigns = $this->campaign_model->load_all($input);

            if (!empty($campaigns)) {

                foreach ($campaigns as $value2) {

                    $input = array();

                    $input['select'] = 'spend';

                    $input['where'] = array('campaign_id' => $value2['id'], 'time >=' => $date_form, 'time <=' => $date_end);

                    $campaigncost = $this->campaign_cost_model->load_all($input);

                    $value['spend'] += h_caculate_campaign_spend($campaigncost);

                }

                $value['pricepC3'] = ($value['total_C3'] > 0) ? round($value['spend'] / $value['total_C3']) : '#N/A';

            } else {

                $value['spend'] = '0';

                $value['pricepC3'] = '0';

            }

        }

        unset($value);

        usort($this->data['rows'], function($a, $b) {

            return $b['total_C3'] - $a['total_C3'];

        });

    }



    /*

     * Ghi đè hàm xóa lớp cha

     */



    function delete_item() {

        die('Không thể xóa, liên hệ admin để biết thêm chi tiết');

    }



    function delete_multi_item() {

        show_error_and_redirect('Không thể xóa, liên hệ admin để biết thêm chi tiết', '', FALSE);

    }



    public function index($offset = 0) {

        $this->load->model('channel_model');

        $input = array();

        $input['where'] = array('active' => '1');

        $channels = $this->channel_model->load_all($input);

        $this->data['channel'] = $channels;



        $this->list_filter = array(

            'left_filter' => array(

                'date' => array(

                    'type' => 'custom',

                ),

                'channel' => array(

                    'type' => 'custom'

                ),

            ),

            'right_filter' => array(

                'active' => array(

                    'type' => 'binary',

                ),

            )

        );

        $conditional = array();

        $conditional['where']['role_id'] = '6';

//        $get = $this->input->get();

//        if (!isset($get['filter_binary_active']) || $get['filter_binary_active'] == '0') {

//            $conditional['where']['active'] = 1;

//        }

        $this->set_conditional($conditional);

        $this->set_offset($offset);

        $this->show_table();

        $data = $this->data;

        $data['slide_menu'] = 'marketing/common/slide-menu';

        $data['top_nav'] = 'manager/common/top-nav';

        $data['list_title'] = 'Danh sách các Marketers';

        $data['edit_title'] = 'Sửa thông tin Marketer';

        $data['content'] = 'base/index';

        $this->load->view(_MAIN_LAYOUT_, $data);

    }



    /*

     * Hiển thị modal thêm item

     */



    function show_add_item() {

        /*

         * type mặc định là text nên nếu là text sẽ không cần khai báo

         */

        $this->list_add = array(

            'left_table' => array(

                'username' => array(

                ),

                'password' => array(

                    'type' => 'password'

                ),

                're_password' => array(

                    'type' => 'password'

                )

            ),

            'right_table' => array(

                'name' => array(

                ),

                'email' => array(

                ),

                'phone' => array(

                ),

                'active' => array(

                ),

            ),

        );

        parent::show_add_item();

    }



    function action_add_item() {

        $post = $this->input->post();

        if (!empty($post)) {

            if ($this->{$this->model}->check_exists(array('username' => $post['add_username']))) {

                redirect_and_die('username đã tồn tại!');

            }

            if ($post['add_active'] != '0' && $post['add_active'] != '1') {

                redirect_and_die('Trạng thái hoạt động là 0 hoặc 1!');

            }

            if ($post['add_password'] != $post['add_re_password']) {

                redirect_and_die('Mật khẩu xác nhận không đúng!');

            }

            $paramArr = array('username', 'name', 'email', 'phone', 'active');

            foreach ($paramArr as $value) {

                if (isset($post['add_' . $value])) {

                    $param[$value] = $post['add_' . $value];

                }

            }

            $param['role_id'] = 6;

            $param['password'] = md5(md5($post['add_password']));

            $this->{$this->model}->insert($param);

            show_error_and_redirect('Thêm marketer thành công!');

        }

    }



    function show_edit_item($inputData = []) {

        /*

         * type mặc định là text nên nếu là text sẽ không cần khai báo

         */

        $this->list_edit = array(

            'left_table' => array(

                'id' => array(

                    'type' => 'disable'

                ),

                'username' => array(),

                'password' => array(

                    'type' => 'password'

                ),

                're_password' => array(

                    'type' => 'password'

                )

            ),

            'right_table' => array(

                'name' => array(),

                'email' => array(),

                'phone' => array(

                ),

                'active' => array(

                )

            ),

        );

        parent::show_edit_item();

    }



    function action_edit_item($id) {

        $post = $this->input->post();

        if (!empty($post)) {

            $input = array();

            $input['where'] = array('id' => $id);

            $curr_item = $this->{$this->model}->load_all($input);

            if ($post['edit_username'] != $curr_item[0]['username'] && $this->{$this->model}->check_exists(array('username' => $post['edit_username']))) {

                redirect_and_die('Username đã tồn tại!');

            }

            if ($post['edit_password'] != '' && ($post['edit_password'] != $post['edit_re_password'])) {

                redirect_and_die('Mật khẩu xác nhận không đúng!');

            }

            $paramArr = array('username', 'name', 'email', 'phone', 'active');

            foreach ($paramArr as $value) {

                if (isset($post['edit_' . $value])) {

                    $param[$value] = $post['edit_' . $value];

                }

            }

            if ($post['edit_password'] != '') {

                $param['password'] = md5(md5($post['edit_password']));

            }

            $this->{$this->model}->update($input['where'], $param);

        }

        show_error_and_redirect('Sửa thông tin marketer thành công!');

    }



}

