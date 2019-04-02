<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sale
 *
 * @author CHUYEN
 */
class Sale extends MY_Controller {

    public $L = array();

    public function __construct() {
        parent::__construct();
        $this->data['top_nav'] = 'sale/common/top-nav';
        $data['time_remaining'] = 0;
        $input = array();
        $input['select'] = 'date_recall';
        $input['where']['sale_staff_id'] = $this->user_id;
        $input['where']['date_recall >'] = time();
        $input['order']['date_recall'] = 'ASC';
        $input['limit'] = array('1', '0');
        $noti_contact = $this->contacts_model->load_all($input);
        if (!empty($noti_contact)) {
            $time_remaining = $noti_contact[0]['date_recall'] - time();
            $data['time_remaining'] = ($time_remaining < 1800) ? $time_remaining : 0;
        }
        $this->load->vars($data);
        $this->_loadCountListContact();
    }

    function index($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();

        /*
         * Điều kiện lấy contact :
         * contact ở trang chủ là contact chưa gọi lần nào và contact là của riêng TVTS, sắp xếp theo ngày nhận contact
         *
         */
        $conditional['where'] = array('call_status_id' => '0', 'sale_staff_id' => $this->user_id, 'is_hide' => '0');
        $conditional['order'] = array('date_handover' => 'DESC');
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
        $data['left_col'] = array('tu_van', 'date_rgt');
        $data['right_col'] = array('course_code');

        /*
         * Các trường cần hiện của bảng contact (đã có default)
         */
        $this->table .= 'date_rgt date_handover';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            's_check_edit_contact', 's_transfer_contact', 's_show_script', 'm_view_duplicate'
        );

        $data['titleListContact'] = 'Danh sách contact mới';
        $data['actionForm'] = 'sale/transfer_contact';
        $informModal = 'sale/modal/transfer_multi_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'sale/modal/transfer_one_contact sale/modal/show_script';
        $data['outformModal'] = explode(' ', $outformModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function has_callback($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where'] = array(
            'date_recall >' => '0',
            // 'date_recall <' => strtotime('tomorrow'),
            'sale_staff_id' => $this->user_id,
            'is_hide' => '0');
        $conditional['where_not_in'] = array(
            'call_status_id' => $this->_get_stop_care_call_stt(),
            'ordering_status_id' => $this->_get_stop_care_order_stt());
        $conditional['order'] = array('date_recall' => 'DESC');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['total_contact'] = $data_pagination['total_row'];
        $contacts = $data_pagination['data'];
        $this->load->model('notes_model');
        foreach ($contacts as &$value) {
            $input = array();
            $input['where'] = array('contact_code' => $value['phone'] . '_' . $value['course_code']);
            $input['order'] = array('id' => 'DESC');
            $last_note = $this->notes_model->load_all($input);
            $notes = '';
            if (!empty($last_note)) {
                foreach ($last_note as $value2) {
                    $notes .= '<p>' . date('d/m/Y', $value2['time']) . ' ==> ' . $value2['content'] . '</p>';
                }
                $value['last_note'] = $notes;
            } else {
                $value['last_note'] = $notes;
            }
        }
        unset($value);
        $data['contacts'] = $contacts;

        $data['left_col'] = array('tu_van', 'date_rgt', 'date_last_calling');
        $data['right_col'] = array('course_code');

        $this->table = 'selection name phone last_note course_code price_purchase date_recall';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            's_check_edit_contact', 's_transfer_contact', 's_show_script'
        );

        $data['titleListContact'] = 'Danh sách contact có lịch hẹn gọi lại';
        $data['actionForm'] = 'sale/transfer_contact';
        $informModal = 'sale/modal/transfer_multi_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'sale/modal/transfer_one_contact sale/modal/show_script';
        $data['outformModal'] = explode(' ', $outformModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function can_save($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where']['sale_staff_id'] = $this->user_id;
        $conditional['where']['is_hide'] = '0';
        $conditional['where']['(`call_status_id` = ' . _KHONG_NGHE_MAY_ . ' OR `ordering_status_id` in (' . _BAN_GOI_LAI_SAU_ . ' , ' . _CHAM_SOC_SAU_MOT_THOI_GIAN_ . ',' . _LAT_NUA_GOI_LAI_ . '))'] = 'NO-VALUE';
        $conditional['order'] = array('date_last_calling' => 'DESC');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);

        //$data['contacts']
        $contacts = $data_pagination['data'];
        $this->load->model('notes_model');
        foreach ($contacts as &$value) {
            $input = array();
            $input['where'] = array('contact_code' => $value['phone'] . '_' . $value['course_code']);
            $input['order'] = array('id' => 'DESC');
            $last_note = $this->notes_model->load_all($input);
            $notes = '';
            if (!empty($last_note)) {
                foreach ($last_note as $value2) {
                    $notes .= '<p>' . date('d/m/Y', $value2['time']) . ' ==> ' . $value2['content'] . '</p>';
                }
                $value['last_note'] = $notes;
            } else {
                $value['last_note'] = $notes;
            }
        }
        unset($value);
        $data['contacts'] = $contacts;
        $data['total_contact'] = $data_pagination['total_row'];
        $data['left_col'] = array('tu_van', 'date_handover', 'date_last_calling');
        $data['right_col'] = array('ordering_status', 'course_code');

        $this->table = 'selection name phone last_note course_code price_purchase date_last_calling';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            's_check_edit_contact', 's_transfer_contact', 's_show_script'
        );

        $data['titleListContact'] = 'Danh sách contact còn cứu được';
        $data['actionForm'] = 'sale/transfer_contact';
        $informModal = 'sale/modal/transfer_multi_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'sale/modal/transfer_one_contact sale/modal/show_script';
        $data['outformModal'] = explode(' ', $outformModal);
        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function find_contact() {
        $get = $this->input->get();
        $conditional = ''; //' AND `sale_staff_id` = ' . $this->user_id;
        $data = $this->_common_find_all($get, $conditional);
        $table = 'selection contact_id name phone address course_code price_purchase ';
        $table .= 'date_rgt date_last_calling call_stt ordering_stt action';
        $data['table'] = explode(' ', $table);
        $data['content'] = 'sale/find_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    public function transfer_contact() {
        $post = $this->input->post();
        $list = isset($post['contact_id']) ? $post['contact_id'] : array();
        $note = $post['note'];
        $this->_action_transfer_contact($post['sale_id'], $list, $note);
    }

    public function transfer_one_contact() {
        $post = $this->input->post();
        $this->_action_transfer_contact($post['sale_id'], array($post['contact_id']), $post['note']);
    }

    function view_all_contact($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where'] = array('sale_staff_id' => $this->user_id, 'is_hide' => '0');
        $conditional['order'] = array('date_last_calling' => 'DESC');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['contacts'] = $data_pagination['data'];
        $data['total_contact'] = $data_pagination['total_row'];

        $data['left_col'] = array('tu_van', 'course_code', 'date_rgt', 'date_handover', 'date_last_calling');
        $data['right_col'] = array('call_status', 'ordering_status', 'cod_status');

        $this->table .= 'date_last_calling call_stt ordering_stt';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            's_check_edit_contact', 's_transfer_contact', 's_show_script', 'm_view_duplicate'
        );

        $data['titleListContact'] = 'Danh sách toàn bộ contact';
        $data['actionForm'] = 'sale/transfer_contact';
        $informModal = 'sale/modal/transfer_multi_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'sale/modal/transfer_one_contact sale/modal/show_script';
        $data['outformModal'] = explode(' ', $outformModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    public function add_contact() {
        $input = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Họ tên', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[2]|integer');
        $this->form_validation->set_rules('course_code', 'Mã khóa học', 'required|callback_check_course_code');
        $this->form_validation->set_rules('source_id', 'Nguồn contact', 'required|callback_check_source_id');
        if (!empty($input)) {
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_tempdata('message', 'Có lỗi xảy ra trong quá trình nhập liệu', 2);
                $this->session->set_tempdata('msg_success', 0, 2);
                $require_model = array(
                    'courses' => array(),
                    'sources' => array()
                );
                $data = array_merge($this->data, $this->_get_require_data($require_model));
                $data['content'] = 'sale/add_contact';
                $this->load->view(_MAIN_LAYOUT_, $data);
            } else {
                $param['name'] = $input['name'];
                $param['email'] = $input['email'];
                $param['address'] = $input['address'];
                $param['phone'] = trim($input['phone']);
                $param['course_code'] = $input['course_code'];
                $param['source_id'] = $input['source_id'];
                $param['payment_method_rgt'] = $input['payment_method_rgt'];
                $param['price_purchase'] = $input['price_purchase'];
                $param['sale_staff_id'] = $this->user_id;
                $param['date_rgt'] = time();
                $param['date_handover'] = time();
                $param['duplicate_id'] = $this->_find_dupliacte_contact($input['email'], $input['phone'], $input['course_code']);
                $param['last_activity'] = time();
                $param['source_sale_id'] = $input['source_sale_id'];
                if ($param['duplicate_id'] > 0) {
                    show_error_and_redirect('Contact bạn vừa thêm bị trùng, nên không thể thêm được nữa!', 0, $input['back_location']);
                }
                $id = $this->contacts_model->insert_return_id($param, 'id');
                $a = $this->contacts_backup_model->insert_return_id($param, 'id');
                if ($input['note'] != '') {
                    $param2 = array(
                        'contact_id' => $id,
                        'content' => $input['note'],
                        'time' => time(),
                        'sale_id' => $this->user_id,
                        'contact_code' => $this->contacts_model->get_contact_code($id)
                    );
                    $this->load->model('notes_model');
                    $this->notes_model->insert($param2);
                }
                $data2 = [];

                $data2['title'] = 'Có 1 contact mới đăng ký';
                $data2['message'] = 'Click để xem ngay';

                require_once APPPATH . 'libraries/Pusher.php';
                $options = array(
                    'cluster' => 'ap1',
                    'encrypted' => true
                );
                $pusher = new Pusher(
                        '32b339fca68db27aa480', '32f6731ad5d48264c579', '490390', $options
                );
                $pusher->trigger('my-channel', 'notice', $data2);
                show_error_and_redirect('Thêm thành công contact', $input['back_location']);
            }
        } else {
            $require_model = array(
                'courses' => array(),
                'sources' => array()
            );
            $data = array_merge($this->data, $this->_get_require_data($require_model));
            $data['content'] = 'sale/add_contact';
            $this->load->view(_MAIN_LAYOUT_, $data);
        }
    }

    function check_course_code($str) {
        if ($str == 'empty') {
            $this->form_validation->set_message('check_course_code', 'Vui lòng chọn {field}!');
            return false;
        }
        return true;
    }

    function check_source_id($str) {
        if ($str == 0) {
            $this->form_validation->set_message('check_source_id', 'Vui lòng chọn {field}!');
            return false;
        }
        return true;
    }

    function view_report() {
        $require_model = array(
            'courses' => array()
        );
        $data = array_merge($this->data, $this->_get_require_data($require_model));
        $get = $this->input->get();

        $conditional = array();
        $conditional['where']['sale_staff_id'] = $this->user_id;
        $data['L1'] = $this->_query_for_report($get, $conditional);

        $conditional = array();
        $conditional['where']['sale_staff_id'] = $this->user_id;
        $conditional['where']['call_status_id'] = _DA_LIEN_LAC_DUOC_;
        $data['L2'] = $this->_query_for_report($get, $conditional);

        $conditional = array();
        $conditional['where']['sale_staff_id'] = $this->user_id;
        $conditional['where']['call_status_id'] = _DA_LIEN_LAC_DUOC_;
        $conditional['where']['ordering_status_id'] = _DONG_Y_MUA_;
        $data['L6'] = $this->_query_for_report($get, $conditional);

        $conditional = array();
        $conditional['where']['sale_staff_id'] = $this->user_id;
        $conditional['where']['call_status_id'] = _DA_LIEN_LAC_DUOC_;
        $conditional['where']['ordering_status_id'] = _DONG_Y_MUA_;
        $conditional['where']['(`cod_status_id` = ' . _DA_THU_COD_ . ' OR `cod_status_id` = ' . _DA_THU_LAKITA_ . ')'] = 'NO-VALUE';
        $data['L7L8'] = $this->_query_for_report($get, $conditional);

        $data['left_col'] = array('course_code');
        $data['right_col'] = array('date_handover');

         // HuyNV BEGIN

         $input = array();
         $input['where'] = array('role_id' => 1,'active' => 1) ;
         $staffs = $this->staffs_model->load_all($input);

         /* Mảng chứa các ngày lẻ */
         if (isset($get['filter_date_happen_from']) && $get['filter_date_happen_from'] != '' && isset($get['filter_date_happen_end']) && $get['filter_date_happen_end'] != '') {
             $startDate = strtotime($get['filter_date_happen_from']);
             $endDate = strtotime($get['filter_date_happen_end']) + 86399;
         } else {
             $startDate = strtotime(date('01-m-Y'));
             $endDate = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
         }

         if (isset($get['tic_report'])) {
             $conditionArr = array(
                 'CHUA_GOI' => array(
                     'where' => array('call_status_id' => '0', 'date_rgt >' => $startDate, 'date_rgt <' => $endDate, 'is_hide' => '0'),
                     'sum' => 0
                 ),
                 'L1_' => array(
                     'where' => array('is_hide' => '0', 'date_handover >' => $startDate,'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'L2_' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'L6_' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_, 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'TU_CHOI_MUA' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _TU_CHOI_MUA_, 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'CHUA_GIAO_HANG_COD' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'payment_method_rgt' => '1', 'cod_status_id' => '0', 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'CHUA_GIAO_HANG_TRANSFER' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'payment_method_rgt >' => '1', 'cod_status_id' => '0', 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'DANG_GIAO_HANG' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _DANG_GIAO_HANG_, 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'DA_THU_COD' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _DA_THU_COD_, 'date_rgt >=' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'L8' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _DA_THU_LAKITA_, 'date_rgt >=' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'L7L8_' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         '(`cod_status_id` = ' . _DA_THU_COD_ . ' OR `cod_status_id` = ' . _DA_THU_LAKITA_ . ')' => 'NO-VALUE'),
                     'sum' => 0
                 ),
                 'HUY_DON' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _HUY_DON_, 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                     'sum' => 0
                 ),
                 'LC' => array(
                     'where' => array('is_hide' => '0', 'date_rgt >' => $startDate, 'date_rgt <' => $endDate,
                         '(`call_status_id` = ' . _SO_MAY_SAI_ . ' OR `call_status_id` = ' . _NHAM_MAY_ . ' OR `ordering_status_id` = ' . _CONTACT_CHET_ . ')' => 'NO-VALUE'),
                     'sum' => 0
                 ),
                 'CON_CUU_DUOC' => array(
                     'where' => array('is_hide' => '0', 'date_rgt >' => $startDate, 'date_rgt <' => $endDate,
                         '(`call_status_id` = ' . _KHONG_NGHE_MAY_ . ' OR `ordering_status_id` in (' . _BAN_GOI_LAI_SAU_ . ' , ' . _CHAM_SOC_SAU_MOT_THOI_GIAN_ . ',' . _LAT_NUA_GOI_LAI_ . '))' => 'NO-VALUE'),
                     'sum' => 0
                 ),
             );
         } else {
             $conditionArr = array(
                 'CHUA_GOI' => array(
                     'where' => array('call_status_id' => '0', 'date_handover >' => $startDate, 'date_handover <' => $endDate),
                     'sum' => 0
                 ),
                 'L1_' => array(
                     'where' => array('is_hide' => '0', 'date_handover >' => $startDate, 'date_handover <' => $endDate),
                     'sum' => 0
                 ),
                 'L2_' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >' => $startDate, 'date_handover <' => $endDate),
                     'sum' => 0
                 ),
                 'L6_' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_, 'date_confirm >' => $startDate, 'date_confirm <' => $endDate),
                     'sum' => 0
                 ),
                 'TU_CHOI_MUA' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _TU_CHOI_MUA_, 'date_confirm >' => $startDate, 'date_confirm <' => $endDate),
                     'sum' => 0
                 ),
                 'CHUA_GIAO_HANG_COD' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'payment_method_rgt' => '1', 'cod_status_id' => '0', 'date_print_cod >' => $startDate, 'date_print_cod <' => $endDate),
                     'sum' => 0
                 ),
                 'CHUA_GIAO_HANG_TRANSFER' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'payment_method_rgt >' => '1', 'cod_status_id' => '0', 'date_print_cod >' => $startDate, 'date_print_cod <' => $endDate),
                     'sum' => 0
                 ),
                 'DANG_GIAO_HANG' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _DANG_GIAO_HANG_, 'date_print_cod >' => $startDate, 'date_print_cod <' => $endDate),
                     'sum' => 0
                 ),
                 'DA_THU_COD' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _DA_THU_COD_, 'date_receive_cod >' => $startDate, 'date_receive_cod <' => $endDate),
                     'sum' => 0
                 ),
                 'L8' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _DA_THU_LAKITA_, 'date_receive_lakita >' => $startDate, 'date_receive_lakita <' => $endDate),
                     'sum' => 0
                 ),
                 'L7L8_' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         '(`cod_status_id` = ' . _DA_THU_COD_ . ' OR `cod_status_id` = ' . _DA_THU_LAKITA_ . ')' => 'NO-VALUE'),
                     'sum' => 0
                 ),
                 'HUY_DON' => array(
                     'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                         'cod_status_id' => _HUY_DON_, 'date_receive_cancel_cod >' => $startDate, 'date_receive_cancel_cod <' => $endDate),
                     'sum' => 0
                 ),
                 'LC' => array(
                     'where' => array('is_hide' => '0', 'date_handover >' => $startDate, 'date_handover <' => $endDate,
                         '(`call_status_id` = ' . _SO_MAY_SAI_ . ' OR `call_status_id` = ' . _NHAM_MAY_ . ' OR `ordering_status_id` = ' . _CONTACT_CHET_ . ')' => 'NO-VALUE'),
                     'sum' => 0
                 ),
                 'CON_CUU_DUOC' => array(
                     'where' => array('is_hide' => '0', 'date_handover >' => $startDate, 'date_handover <' => $endDate,
                         '(`call_status_id` = ' . _KHONG_NGHE_MAY_ . ' OR `ordering_status_id` in (' . _BAN_GOI_LAI_SAU_ . ' , ' . _CHAM_SOC_SAU_MOT_THOI_GIAN_ . ',' . _LAT_NUA_GOI_LAI_ . '))' => 'NO-VALUE'),
                     'sum' => 0
                 ),
             );
         }

         $get = array();

         foreach ($staffs as $key => $value) {
             foreach ($conditionArr as $key2 => $value2) {
                 $conditional = array();
                 $conditional['where']['sale_staff_id'] = $value['id'];
                 foreach ($value2['where'] as $key3 => $value3) {
                     $conditional['where'][$key3] = $value3;
                 }
                 $staffs[$key][$key2] = $this->_query_for_report($get, $conditional);
                 $conditionArr[$key2]['sum'] += $staffs[$key][$key2];
             }
             //  $conditionArr['L7L8']['sum'] = $conditionArr['DA_THU_COD']['sum'] + $conditionArr['L8']['sum'];
         }



         foreach ($conditionArr as $key => $value) {
             $data[$key] = $value['sum'];
         }

         // echo '<pre>';
         // var_dump($data['L1_']);
         // die;

         $data['staffs'] = $staffs;
         $data['startDate'] = $startDate;
         $data['endDate'] = $endDate;

         // HuyNV END

         /*
          * Các file js cần load
          */
        $data['load_js'] = array('common_real_filter_contact', 'm_view_report');
        $data['content'] = 'sale/view_report';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function show_script_modal() {
        $post = $this->input->post();
        $script_id = $post['script_id'];
        $input = array();
        $input['where'] = array('id' => $script_id);
        $this->load->model('scripts_model');
        $content = $this->scripts_model->load_all($input);
        echo html_entity_decode($content[0]['content']);
        //$this->load->view('sale/show_script');
    }

    function noti_contact_recall() {
        $input['select'] = 'id, name, phone, date_recall, sale_staff_id, cod_status_id';
        if ($this->role_id == 1) {
            $input['where']['sale_staff_id'] = $this->user_id;
        }
          if ($this->role_id == 2) {
            $input['where']['cod_status_id >'] = '0';
        }
        $input['where']['date_recall >'] = '0';
        $input['where']['date_recall <='] = time();
        $input['order']['date_recall'] = 'DESC';
        $noti_contact = $this->contacts_model->load_all($input);
        if (!empty($noti_contact)) {
            $result = array();
            if (time() - $noti_contact[0]['date_recall'] < 30) {
                $result['sound'] = 1;
                if ($noti_contact[0]['cod_status_id'] == 0) {
                    $result['image'] = base_url('public/images/recall.jpg');
                    $result['message'] = 'Có contact (sale) cần gọi lại ngay bây giờ!';
                } else {
                    $result['image'] = base_url('public/images/ship.png');
                    $result['message'] = 'Có contact (cod) cần gọi lại ngay bây giờ!';
                }
            }
            foreach ($noti_contact as &$value) {
                $value['date_recall'] = date('H:i j/n/Y', $value['date_recall']);
            }
            unset($value);
            $num_noti_contact = count($noti_contact);

            $result['num_noti'] = $num_noti_contact;
            $result['contacts_noti'] = $noti_contact;
            $this->renderJSON($result);
        }
    }

    private function _action_transfer_contact($sale_transfer_id, $contact_id, $note) {
        if ($sale_transfer_id == 0) {
            redirect_and_die('Vui lòng chọn nhân viên TVTS!');
        }
        if (empty($contact_id)) {
            redirect_and_die('Vui lòng chọn contact!');
        }
        $this->_check_contact_can_be_transfer($contact_id);
        $this->load->model('transfer_logs_model');
        $data = array(
            'sale_staff_id' => $sale_transfer_id,
            'date_transfer' => time(),
            'last_activity' => time()
        );

        foreach ($contact_id as $value) {
            $where = array('id' => $value);
            $this->contacts_model->update($where, $data);
            $this->transfer_logs_model->insert(array(
                'contact_id' => $value,
                'sale_id_1' => $this->user_id,
                'sale_id_2' => $sale_transfer_id,
                'time' => time()
            ));
        }
        if ($note != '') {
            $this->load->model('notes_model');
            foreach ($contact_id as $value) {
                $param2 = array();
                $param2 = array(
                    'contact_id' => $value,
                    'content' => $note,
                    'time' => time(),
                    'sale_id' => $this->user_id,
                    'contact_code' => $this->contacts_model->get_contact_code($value)
                );
                $this->notes_model->insert($param2);
            }
        }
        $this->load->model('Staffs_model');
        $staff_name = $this->Staffs_model->find_staff_name($sale_transfer_id);
        $msg = 'Chuyển nhượng thành công cho nhân viên <strong>' . $staff_name . '</strong>';
        show_error_and_redirect($msg, $_SERVER['HTTP_REFERER'], true);
    }

    private function _check_contact_can_be_transfer($list) {
        $transfered_contact = true;
        $name = '';
        foreach ($list as $value) {
            $input = array();
            $input['select'] = 'name, sale_staff_id, call_status_id, ordering_status_id';
            $input['where'] = array('id' => $value);
            $rows = $this->contacts_model->load_all($input);
            if ($rows[0]['sale_staff_id'] != $this->user_id) {
                $msg = 'Contact này không được phân cho bạn vì vậy bạn không thể chuyển nhượng contact này!';
                show_error_and_redirect($msg, $_SERVER['HTTP_REFERER'], false);
            }
            if (in_array($rows[0]['call_status_id'], $this->_get_stop_care_call_stt()) || in_array($rows[0]['ordering_status_id'], $this->_get_stop_care_order_stt())) {
                $name = $rows[0]['name'];
                $transfered_contact = false;
                break;
            }
        }
        if (!$transfered_contact) {
            $msg = 'Contact ' . $name . ' ở trạng thái không thể chăm sóc được nữa, vì vậy bạn không có quyền chuyển nhượng contact này!';
            show_error_and_redirect($msg, $_SERVER['HTTP_REFERER'], false);
        }

//        foreach ($list as $value) {
//            $input = array();
//            $input['where'] = array('id' => $value);
//            $rows = $this->contacts_model->load_all($input);
//            if ($rows[0]['duplicate_id'] > 0) {
//                $msg = 'Contact "' . $rows[0]['name'] . '" có id = ' . $rows[0]['id'] . ' bị trùng. '
//                        . 'Vì vậy không thể chuyển nhượng contact đó được! Vui lòng thực hiện lại';
//                show_error_and_redirect($msg, $_SERVER['HTTP_REFERER'], false);
//            }
//        }
        foreach ($list as $value) {
            $input = array();
            $input['where'] = array('id' => $value);
            $rows = $this->contacts_model->load_all($input);
            if (empty($rows)) {
                die('Không tồn tại khách hàng này! Mã lỗi : 30203');
            }
        }
    }

    private function _get_stop_care_call_stt() {
        $arr = array();
        $this->load->model("call_status_model");
        $stop_care_call_stt_where = array();
        $stop_care_call_stt_where['where'] = array('stop_care' => 1);
        $stop_care_call_stt_id = $this->call_status_model->load_all($stop_care_call_stt_where);
        if (!empty($stop_care_call_stt_id)) {
            foreach ($stop_care_call_stt_id as $value) {
                $arr[] = $value['id'];
            }
        }
        return $arr;
    }

    private function _get_stop_care_order_stt() {
        $arr = array();
        $this->load->model("ordering_status_model");
        $stop_care_order_stt_where = array();
        $stop_care_order_stt_where['where'] = array('stop_care' => 1);
        $stop_care_order_stt_id = $this->ordering_status_model->load_all($stop_care_order_stt_where);
        if (!empty($stop_care_order_stt_id)) {
            foreach ($stop_care_order_stt_id as $value) {
                $arr[] = $value['id'];
            }
        }
        return $arr;
    }

    private function _get_all_require_data() {
        $require_model = array(
            'staffs' => array(
                'where' => array(
                    'role_id' => 1,
                    'active' => 1
                )
            ),
            'courses' => array(
                'where' => array('active' => '1'),
                'order' => array(
                    'course_code' => 'ASC'
                )
            ),
            'transfer_logs' => array(),
            'call_status' => array('order' => array('sort' => 'ASC')),
            'ordering_status' => array('order' => array('sort' => 'ASC')),
            'cod_status' => array(),
            'payment_method_rgt' => array(),
        );
        return array_merge($this->data, $this->_get_require_data($require_model));
    }

    private function _loadCountListContact() {
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('call_status_id' => '0', 'sale_staff_id' => $this->user_id, 'is_hide' => '0');
        $this->L['L1'] = count($this->contacts_model->load_all($input));

        $input = array();
        $input['select'] = 'id';
        $input['where'] = array(
            'date_recall >' => '0',
            'sale_staff_id' => $this->user_id,
            'is_hide' => '0');
        $input['where_not_in'] = array(
            'call_status_id' => $this->_get_stop_care_call_stt(),
            'ordering_status_id' => $this->_get_stop_care_order_stt());
        $this->L['has_callback'] = count($this->contacts_model->load_all($input));

        $input = array();
        $input['select'] = 'id';
        $input['where']['sale_staff_id'] = $this->user_id;
        $input['where']['is_hide'] = '0';
        $input['where']['(`call_status_id` = ' . _KHONG_NGHE_MAY_ . ' OR `ordering_status_id` in (' . _BAN_GOI_LAI_SAU_ . ' , ' . _CHAM_SOC_SAU_MOT_THOI_GIAN_ . ',' . _LAT_NUA_GOI_LAI_ . '))'] = 'NO-VALUE';
        $this->L['can_save'] = count($this->contacts_model->load_all($input));


        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('sale_staff_id' => $this->user_id, 'is_hide' => '0');
        $this->L['all'] = count($this->contacts_model->load_all($input));
    }

}
