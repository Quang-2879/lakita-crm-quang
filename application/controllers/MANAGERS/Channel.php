<?php

require_once("application/core/MY_Table.php");

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



/**

 * Description of Channel

 *

 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>

 */

class Channel extends MY_Table {



    public function __construct() {

        parent::__construct();

        $this->init();

        $this->load->model('channel_cost_model');

    }



    public function init() {

        $this->controller_path = 'MANAGERS/channel';

        $this->view_path = 'MANAGERS/channel';

        $this->sub_folder = 'MANAGERS';

        /*

         * Liệt kê các trường trong bảng

         * - nếu type = text thì không cần khai báo

         * - nếu không muốn hiển thị ra ngoài thì dùng display = none

         * - nếu trường nào cần hiển thị đặc biệt (ngoại lệ) thì để là type = custom

         */

        $list_item = array(

//            'id' => array(

//                'name_display' => 'ID Channel'

//            ),

            'active' => array(

                'type' => 'binary',

                'name_display' => 'Hoạt động'

            ),

            'code' => array(

                'name_display' => 'Mã kênh',

                'order' => '1'

            ),

            'name' => array(

                'name_display' => 'Tên kênh',

                'order' => '1',

                'display' => 'none'

            ),

            'desc' => array(

                'name_display' => 'Mô tả',

                'display' => 'none'

            ),

            'spend' => array(

                'type' => 'currency',

                'name_display' => 'Đã tiêu',

            ),

//            'total_C1' => array(

//                'type' => 'currency',

//                'name_display' => 'Số C1',

//            ),

//            'total_C2' => array(

//                'type' => 'currency',

//                'name_display' => 'Số C2',

//            ),

            'total_C3' => array(

                'name_display' => 'Số C3',

            ),

//            'C2pC1' => array(

//                'name_display' => 'C2/C1',

//            ),

//            'C3pC2' => array(

//                'name_display' => 'C3/C2',

//            ),

//            'pricepC1' => array(

//                'name_display' => 'giá C1',

//            ),

//            'pricepC2' => array(

//                'name_display' => 'giá C2',

//            ),

            'pricepC3' => array(

                'type' => 'currency',

                'name_display' => 'giá C3',

            ),

            'L6' => array(

                'name_display' => 'L6',

            ),

            'L8' => array(

                'name_display' => 'L8',

            ),

             'pricepL6' => array(

                'type' => 'currency',

                'name_display' => 'giá L6',

            ),

            'pricepL8' => array(

                'type' => 'currency',

                'name_display' => 'giá L8',

            ),

            'time' => array(

                'type' => 'datetime',

                'name_display' => 'Ngày tạo',

                'order' => '1',

                'display' => 'none'

            )

        );

        $this->set_list_view($list_item);

        $this->set_model('channel_model');

        $this->load->model('channel_model');

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



    protected function show_table() {

        parent::show_table();

        $get = $this->input->get();

        /*

         * Nếu có điều kiện đặc biệt thì thêm vào $row class css đặc biệt khi hiển thị

         * ví dụ: giá khóa học lớn hơn 4 triệu thì báo đỏ

         */



        $date_form = '';

        $date_end = '';

        if (!isset($get['date_from']) && !isset($get['date_end'])) {

            $date_form = strtotime(date('d-m-Y', strtotime("-1 days")));

            $date_end = strtotime(date('d-m-Y', strtotime("-1 days")));

        } else {

            $date_form = strtotime($get['date_from']);

            $date_end = strtotime($get['date_end']);

        }



        $this->load->model('account_fb_model');

        foreach ($this->data['rows'] as &$value) {



            /*

             * Lấy số C3 & số tiền tiêu

             */

            $total_c3 = array();

            $total_c3['select'] = 'id';

            $total_c3['where'] = array(

                'channel_id' => $value['id'],

                'date_rgt >=' => $date_form,

                'date_rgt <=' => $date_end + 24 * 3600 - 1,

                'is_hide' => '0');

            $value['total_C3'] = count($this->contacts_model->load_all($total_c3));



//            $this->load->model('c2_model');

//            $total_c2 = array();

//            $total_c2['select'] = 'id';

//            $total_c2['where'] = array(

//                'channel_id' => $value['id'],

//                'date_rgt >=' => $date_form,

//                'date_rgt <=' => $date_end + 24 * 3600 - 1);

//            $value['total_C2'] = count($this->c2_model->load_all($total_c2));



            $input = array();

            $input['where'] = array('channel_id' => $value['id'], 'time >=' => $date_form, 'time <=' => $date_end);

            $channel_cost = $this->channel_cost_model->load_all($input);

            $channel_cost = h_caculate_channel_cost($channel_cost);

            if (!empty($channel_cost)) {

                $value['total_C1'] = $channel_cost['total_C1'];

                //  $value['total_C2'] = $channel_cost['total_C2'];

//                $value['C2pC1'] = ($value['total_C1'] > 0) ? round($value['total_C2'] / $value['total_C1'] * 100) . '%' : '#N/A';

//                $value['C3pC2'] = ($value['total_C2'] > 0) ? round($value['total_C3'] / $value['total_C2'] * 100) . '%' : '#N/A';

                $value['spend'] = $channel_cost['spend'];

//                $value['pricepC1'] = ($value['total_C1'] > 0) ? round($value['spend'] / $value['total_C1']) : '#N/A';

//                $value['pricepC2'] = ($value['total_C2'] > 0) ? round($value['spend'] / $value['total_C2']) : '#N/A';

                $value['pricepC3'] = ($value['total_C3'] > 0) ? round($value['spend'] / $value['total_C3']) : '#N/A';

            } else {

                $value['total_C3'] = '#NA';

//                $value['total_C1'] = '#NA';

//                $value['total_C2'] = '#NA';

//                $value['C2pC1'] = '#NA';

//                $value['C3pC2'] = '#NA';

                $value['spend'] = '#NA';

//                $value['pricepC1'] = '#NA';

//                $value['pricepC2'] = '#NA';

                $value['pricepC3'] = '#NA';

            }



            $total_L6 = array();

            $total_L6['select'] = 'id';

            $total_L6['where'] = array(

                'channel_id' => $value['id'],

                'date_rgt >=' => $date_form,

                'date_rgt <=' => $date_end + 24 * 3600 - 1,

                'call_status_id' => _DA_LIEN_LAC_DUOC_,

                'ordering_status_id' => _DONG_Y_MUA_);

            $value['L6'] = count($this->contacts_model->load_all($total_L6));

            $value['pricepL6'] = ($value['L6'] > 0) ? round($value['spend'] / $value['L6']) : ( ($value['spend'] > 0) ? 9999999999 : '#N/A');



            /*

             * L8

             */

            $total_L8 = array();

            $total_L8['select'] = 'id';

            $total_L8['where'] = array(

                'channel_id' => $value['id'],

                'date_rgt >=' => $date_form,

                'date_rgt <=' => $date_end + 24 * 3600 - 1,

                'call_status_id' => _DA_LIEN_LAC_DUOC_,

                'ordering_status_id' => _DONG_Y_MUA_,

                'cod_status_id' => _DA_THU_LAKITA_);

            $value['L8'] = count($this->contacts_model->load_all($total_L8));

            $value['pricepL8'] = ($value['L8'] > 0) ? round($value['spend'] / $value['L8']) : ( ($value['spend'] > 0) ? 9999999999 : '#N/A');

        }

        unset($value);

    }



    function index($offset = 0) {

        $this->list_filter = array(

            'left_filter' => array(

                'date' => array(

                    'type' => 'custom',

                ),

            ),

            'right_filter' => array(

                'active' => array(

                    'type' => 'binary',

                ),

            )

        );

        $conditional = array('order' => array('id' => 'ASC'));

        $get = $this->input->get();

//        if (!isset($get['filter_binary_active']) || $get['filter_binary_active'] == '0') {

//            $conditional['where']['active'] = 1;

//        }

        $this->set_conditional($conditional);

        $this->set_offset($offset);

        $this->show_table();

        //echoQuery();

        $data = $this->data;

        $data['slide_menu'] = 'marketing/common/slide-menu';

        $data['top_nav'] = 'manager/common/top-nav';

        $data['list_title'] = 'Danh sách kênh quảng cáo';

        $data['edit_title'] = 'Sửa thông tin kênh quảng cáo';

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

                'code' => array(

                ),

                'name' => array(

                )

            ),

            'right_table' => array(

                'desc' => array(

                    'type' => 'textarea'

                )

            ),

        );

        parent::show_add_item();

    }



    function action_add_item() {

        $post = $this->input->post();

        if (!empty($post)) {

            /*

             * Kiểm tra mã channel đã tồn tại chưa 

             */

            if ($this->{$this->model}->check_exists(array('code' => $post['add_code']))) {

                redirect_and_die('Mã kênh đã tồn tại!');

            }

            $paramArr = array('code', 'name', 'desc');

            foreach ($paramArr as $value) {

                if (isset($post['add_' . $value])) {

                    $param[$value] = $post['add_' . $value];

                }

            }

            $param['time'] = time();

            $this->{$this->model}->insert($param);

            show_error_and_redirect('Thêm kênh quảng cáo thành công!');

        }

    }



    /*

     * Hiển thị modal sửa item

     */



    function show_edit_item($inputData = []) {

        /*

         * type mặc định là text nên nếu là text sẽ không cần khai báo

         */

        $this->list_edit = array(

            'left_table' => array(

                'code' => array(

                ),

                'name' => array(),

            ),

            'right_table' => array(

                'desc' => array(

                    'type' => 'textarea'

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

            /*

             * Kiểm tra mã channel đã tồn tại chưa 

             */

            $input = array();

            $input['where'] = array('id' => $id);

            $curr_code = $this->{$this->model}->load_all($input);

            if ($post['edit_code'] != $curr_code[0]['code'] && $this->{$this->model}->check_exists(array('code' => $post['edit_code']))) {

                redirect_and_die('Mã kênh đã tồn tại!');

            }

            $paramArr = array('code', 'name', 'desc', 'active');

            foreach ($paramArr as $value) {

                if (isset($post['edit_' . $value])) {

                    $param[$value] = $post['edit_' . $value];

                }

            }

            $this->{$this->model}->update($input['where'], $param);

        }

        show_error_and_redirect('Sửa mã Bill thành công!');

    }



}

