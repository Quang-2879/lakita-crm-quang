<?php

/**
 * Description of Common
 *
 * @author CHUYEN
 */
class Manager extends MY_Controller {

    public $L = array();

    function __construct() {
        parent::__construct();
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('call_status_id' => '0', 'sale_staff_id' => '0', 'is_hide' => '0', 'duplicate_id' => '0');
        $this->L['L1'] = count($this->contacts_model->load_all($input));
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('call_status_id' => '0', 'sale_staff_id' => '0', 'is_hide' => '0', 'duplicate_id >' => '0');
        $this->L['L1_trung'] = count($this->contacts_model->load_all($input));
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('is_hide' => '0');
        $this->L['all'] = count($this->contacts_model->load_all($input));
    }

    function index($offset = 0) {
        $data = $this->get_all_require_data();
        //var_dump($data);
        $get = $this->input->get();
        /*
         * Điều kiện lấy contact :
         * contact ở trang chủ là contact chưa được phân cho TVTS nào và chua gọi lần nào
         *
         */
        $conditional['where'] = array('call_status_id' => '0', 'sale_staff_id' => '0', 'is_hide' => '0', 'duplicate_id' => '0');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        /*
         * Lấy danh sách contacts
         */
        $contacts = $data_pagination['data'];
        foreach ($contacts as &$value) {
            $value['marketer_name'] = $this->staffs_model->find_staff_name($value['marketer_id']);
        }
        unset($value);

        $data['contacts'] = $contacts;
        $data['progress'] = $this->GetProccessToday();
        // echo '<pre>';
        // print_r($data['progress']);
        // echo '</pre>';
        // die();
        $data['progressType'] = 'Tiến độ các team ngày hôm nay';

        $data['total_contact'] = $data_pagination['total_row'];
        /*
         * Lấy link phân trang
         */
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        /*
         * Filter ở cột trái và cột phải
         */
        $data['left_col'] = array('tu_van', 'duplicate', 'date_rgt');
        $data['right_col'] = array('course_code');

        /*
         * Các trường cần hiện của bảng contact (đã có default)
         */
        $this->table .= 'date_rgt matrix';
        $data['table'] = explode(' ', $this->table);

        $data['titleListContact'] = 'Danh sách contact mới không trùng';
        $data['actionForm'] = 'manager/divide_contact';
        $informModal = 'manager/modal/divide_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'manager/modal/divide_one_contact';
        $data['outformModal'] = explode(' ', $outformModal);
        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact',
            'm_delete_one_contact', 'm_divide_contact', 'm_view_duplicate', 'm_delete_multi_contact'
        );
        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }


    function new_duplicate($offset = 0) {
        $data = $this->get_all_require_data();
        //var_dump($data);
        $get = $this->input->get();
        /*
         * Điều kiện lấy contact :
         * contact ở trang chủ là contact chưa được phân cho TVTS nào và chua gọi lần nào
         *
         */

        $conditional['where'] = array('call_status_id' => '0', 'sale_staff_id' => '0', 'is_hide' => '0', 'duplicate_id >' => '0');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        /*
         * Lấy danh sách contacts
         */
        $contacts = $data_pagination['data'];
        foreach ($contacts as &$value) {
            $value['marketer_name'] = $this->staffs_model->find_staff_name($value['marketer_id']);
        }
        unset($value);

        $data['contacts'] = $contacts;
        $data['progress'] = $this->GetProccessToday();
        $data['progressType'] = 'Tiến độ các team ngày hôm nay';

        $data['total_contact'] = $data_pagination['total_row'];
        /*
         * Lấy link phân trang
         */
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        /*
         * Filter ở cột trái và cột phải
         */
        $data['left_col'] = array('tu_van', 'duplicate', 'date_rgt');
        $data['right_col'] = array('course_code');

        /*
         * Các trường cần hiện của bảng contact (đã có default)
         */
        $this->table .= 'date_rgt matrix';
        $data['table'] = explode(' ', $this->table);

        $data['titleListContact'] = 'Danh sách contact mới bị trùng';
        $data['actionForm'] = 'manager/divide_contact';
        $informModal = 'manager/modal/divide_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'manager/modal/divide_one_contact';
        $data['outformModal'] = explode(' ', $outformModal);
        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact',
            'm_delete_one_contact', 'm_divide_contact', 'm_view_duplicate', 'm_delete_multi_contact'
        );
        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }


    function view_all_contact($offset = 0) {
        $data = $this->get_all_require_data();

        /*
         * Lấy danh sách các marketer
         */

        $input = array();
        $input['where'] = array(
            'role_id' => 6,
            'active' => 1);
        $data['marketers'] = $this->staffs_model->load_all($input);

        $get = $this->input->get();
		
        /*
         * Điều kiện lấy contact :
         * lấy tất cả contact nên $conditional là mảng rỗng
         *
         */
        $conditional['where'] = array('is_hide' => '0');

        if (isset($get['export_all'])) {
            $post = [];
            $allContact = $this->_query_all_from_get($get, $conditional, 100000, $offset);
            //   echoQuery();die;
            foreach ($allContact['data'] as $value) {
                $post['contact_id'][] = $value['id'];
            }
            $this->ExportToExcel($post);
        }


        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        /*
         * Lấy link phân trang và danh sách contacts
         */
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $contacts = $data_pagination['data'];


        foreach ($contacts as &$value) {
            $value['marketer_name'] = $this->staffs_model->find_staff_name($value['marketer_id']);
        }
        unset($value);
        $data['contacts'] = $contacts;
        $data['progress'] = $this->GetProccessThisMonth();
        $data['progressType'] = 'Tiến độ các team tháng này';

        $data['total_contact'] = $data_pagination['total_row'];

        /*
         * Filter ở cột trái và cột phải
         */
        $data['left_col'] = array('course_code', 'sale', 'marketer', 'channel', 'payment_method_rgt', 'date_rgt', 'date_receive_cod', 'date_receive_lakita', 'date_handover');
        $data['right_col'] = array('source', 'call_status', 'ordering_status', 'cod_status', 'provider');

        /*
         * Các trường cần hiện của bảng contact (đã có default)
         */
        $this->table .= 'call_stt ordering_stt last_activity matrix';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */
        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact',
            'm_delete_one_contact', 'm_divide_contact', 'm_view_duplicate', 'm_delete_multi_contact'
        );

        $data['titleListContact'] = 'Danh sách toàn bộ contact';
        $data['actionForm'] = 'manager/divide_contact';
        $informModal = 'manager/modal/divide_contact';
        $data['informModal'] = explode(' ', $informModal);
        $outformModal = 'manager/modal/divide_one_contact';
        $data['outformModal'] = explode(' ', $outformModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }


    function view_pivot_table() {
        $data = $this->data;
        $data['left_col'] = array('date_rgt',);
        $data['load_js'] = array('m_pivot_table');
        $data['content'] = 'manager/pivot_table';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function view_duplicate() {
        $require_model = array(
            'staffs' => array(
                'where' => array(
                    'role_id' => 1
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
        $data = array_merge($this->data, $this->_get_require_data($require_model));
        $post = $this->input->post();
        $input = array();
        $input['where'] = array('duplicate_id' => $post['duplicate_id']);
        $input['limit'] = array('10', '0');
        $duplicate_contacts = $this->contacts_model->load_all($input);
        $data['rows'] = $duplicate_contacts;
        $input3 = array();
        $input3['where'] = array('id' => $post['duplicate_id']);
        $primary_contact = $this->contacts_model->load_all($input3);
        $data['primary_contact'] = $primary_contact;
        $data['total_contact'] = count($duplicate_contacts);
        $this->load->view('manager/modal/view_duplicate', $data);
    }

    // <editor-fold defaultstate="collapsed" desc="hàm add contact và các hàm phụ trợ">
    /* ========================  hàm add contact và các hàm phụ trợ =========================== */

    public function add_contact() {
        $input = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Họ tên', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[2]|integer');
        $this->form_validation->set_rules('course_code', 'Mã khóa học', 'required|callback_check_course_code');
        $this->form_validation->set_rules('source_id', 'Nguồn contact', 'required|callback_check_source_id');
        if (!empty($input)) {
            $result = array();
            if ($this->form_validation->run() == FALSE) {
                $result['success'] = 0;
                $result['message'] = 'Có lỗi xảy ra trong quá trình nhập liệu!';
                $require_model = array(
                    'courses' => array(
                        'where' => ['active' => '1'],
                        'order' => ['course_code' => 'ASC']
                    ),
                    'sources' => array()
                );
                $data = array_merge($this->data, $this->_get_require_data($require_model));
                //  $data['content'] = 'manager/add_contact';
                $data['content'] = 'common/modal/add_new_contact';
                $this->load->view('common/modal/add_new_contact', $data);
                $result['content'] = $this->load->view('common/modal/add_new_contact', $data, true);
                echo json_encode($result);
                die;
//                $this->session->set_tempdata('message', 'Có lỗi xảy ra trong quá trình nhập liệu', 2);
//                $this->session->set_tempdata('msg_success', 0, 2);
//                $this->_view_add_contact();
            } else {
                $param['name'] = $input['name'];
                $param['email'] = $input['email'];
                $param['address'] = $input['address'];
                $param['phone'] = trim($input['phone']);
                $param['course_code'] = $input['course_code'];
                $param['source_id'] = $input['source_id'];
                $param['payment_method_rgt'] = $input['payment_method_rgt'];
                $param['price_purchase'] = $input['price_purchase'];
                $param['date_rgt'] = time();
                $param['duplicate_id'] = $this->_find_dupliacte_contact($input['email'], $input['phone'], $input['course_code']);
                $param['last_activity'] = time();
                $param['source_sale_id'] = $input['source_sale_id'];
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
                $result['success'] = 1;
                $result['message'] = 'Thêm thành công contact!';
                echo json_encode($result);
                die;
            }
        } else {
            $this->_view_add_contact();
        }
    }

    private function _view_add_contact() {
        $require_model = array(
            'courses' => array(
                'where' => ['active' => '1'],
                'order' => ['course_code' => 'ASC']
            ),
            'sources' => array()
        );
        $data = array_merge($this->data, $this->_get_require_data($require_model));
        //  $data['content'] = 'manager/add_contact';
        $data['content'] = 'common/modal/add_new_contact';
        $this->load->view('common/modal/add_new_contact', $data);
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

    /* ========================  hàm add contact và các hàm phụ trợ (hết) =========================== */

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="hàm chia contact (chia riêng contact) và các hàm phụ trợ">
    /* ========================  hàm chia contact (chia riêng contact) và các hàm phụ trợ =========================== */
    function divide_contact() {
        $post = $this->input->post();

        $this->_action_divide_contact($post);
    }

    /*
     * Chia contact
     */

    private function _action_divide_contact($post) {
        $result = array();
        $this->load->model('Staffs_model');
        if (empty($post)) {
            $result['success'] = 0;
            $result['message'] = "Có lỗi xảy ra! Mã lỗi : 30201";
            echo json_encode($result);
            die;
        }
        if (!isset($post['contact_id'])) {
            $result['success'] = 0;
            $result['message'] = "Vui lòng chọn contact!";
            echo json_encode($result);
            die;
        }
        $sale_id = $post['sale_id'];
        $contact_ids = is_array($post['contact_id']) ? $post['contact_id'] : array($post['contact_id']);
        $note = $post['note'];
        if ($sale_id == 0) {
            $result['success'] = 0;
            $result['message'] = "Vui lòng chọn nhân viên TVTS!";
            echo json_encode($result);
            die;
        }
        if (empty($contact_ids)) {
            $result['success'] = 0;
            $result['message'] = "Vui lòng chọn contact!";
            echo json_encode($result);
            die;
        }
        $checkContactCanBeDivide = $this->_check_contact_can_be_divide($contact_ids);
        if (!empty($checkContactCanBeDivide)) {
            echo json_encode($checkContactCanBeDivide);
            die;
        }
        $data = array(
            'sale_staff_id' => $sale_id,
            'date_handover' => time(),
            'last_activity' => time()
        );
        foreach ($contact_ids as $value) {
            $where = array('id' => $value);
            $this->contacts_model->update($where, $data);
        }
        if ($note != '') {
            $this->load->model('notes_model');
            foreach ($contact_ids as $value) {
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
        $staff_name = $this->Staffs_model->find_staff_name($sale_id);

        $result['success'] = 1;
        $result['message'] = 'Phân contact thành công cho nhân viên ' . $staff_name;
        echo json_encode($result);
        die;
    }

    /*
     * Check điều kiện chia contact (Contact không bị trùng và contact chưa được phân cho ai)
     */

    private function _check_contact_can_be_divide($contact_ids) {
        $result = array();
        $this->load->model('Staffs_model');
        foreach ($contact_ids as $value) {
            $input = array();
            $input['select'] = 'sale_staff_id, id, duplicate_id, is_hide';
            $input['where'] = array('id' => $value);
            $rows = $this->contacts_model->load_all($input);

            if (empty($rows)) {
                $result['success'] = 0;
                $result['message'] = "Không tồn tại khách hàng này! Mã lỗi : 30203";
            }
            if ($rows[0]['is_hide'] == '1') {
                $result['success'] = 0;
                $result['message'] = "Contact này đã bị xóa, vì vậy không thể phân contact này được!";
            }

            if ($rows[0]['sale_staff_id'] > 0) {
                $name = $this->Staffs_model->find_staff_name($rows[0]['sale_staff_id']);
                $msg = 'Contact có id = ' . $rows[0]['id'] . ' đã được phân cho TVTS: ' . $name . '. Vì vậy không thể phân tiếp được nữa!';
                $result['success'] = 0;
                $result['message'] = $msg;
            }
//            if ($this->role_id == 3 && $rows[0]['duplicate_id'] > 0) {
//                $msg = 'Contact "' . $rows[0]['name'] . '" có id = ' . $rows[0]['id'] . ' bị trùng. '
//                        . 'Vì vậy không thể phân contact đó được! Vui lòng thực hiện lại';
//                $result['success'] = 0;
//                $result['message'] = $msg;
//            }
        }

        return $result;
    }

    /* ========================  hàm chia contact (chia riêng contact) và các hàm phụ trợ  (hết) =========================== */

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="hàm chia contact (chia đều contact) và các hàm phụ trợ">
    /* ========================  hàm chia contact (chia đều contact) và các hàm phụ trợ =========================== */
    function divide_contact_even() {
        $post = $this->input->post();
        if (empty($post)) {
            die('Có lỗi xảy ra! Mã lỗi : 30401');
        }
        $contact_ids = $post['contact_id'];

        if (count($contact_ids) == 0) {
            $msg = 'Không có contact nào được chọn';
            show_error_and_redirect($msg, base_url('manager'), false);
        }

        $this->_check_contact_can_be_divide($contact_ids);

        /* reset toàn bộ contact phân nháp trước đó mà người dùng chưa hủy nháp */
        $data1 = array('has_draft_divide' => '0');
        $this->contacts_model->update(array(), $data1);

        /* Lưu nháp các contact đã chọn */
        foreach ($contact_ids as $value) {
            $where = array('id' => $value);
            $data2 = array('has_draft_divide' => 1);
            $this->contacts_model->update($where, $data2);
        }

        $require_model = array(
            'contacts' => array(
                'where' => array('has_draft_divide' => 1),
                'order' => array('id' => 'DESC')
            ),
            'staffs' => array(
                'where' => array('role_id' => 1, 'active' => 1),
            ),
            'courses' => array()
        );
        $data = array_merge($this->data, $this->_get_require_data($require_model));

        $this->table .= 'date_rgt matrix';
        $data['table'] = explode(' ', $this->table);
        $data['content'] = 'manager/divide_contact_even';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function draft_divide_contact_even3() {
        $this->load->model('Staffs_model');
        $input = array();
        $input['where'] = array(
            'has_draft_divide' => 1
        );
        $input['order'] = array('id' => 'DESC');
        $contacts = $this->contacts_model->load_all($input);
        shuffle($contacts); //trộn đều các contact

        $post = $this->input->post();
        if (!empty($post['max_contact'])) {
            /* ================cập nhật contact max cho mỗi nhân viên ======================== */
            foreach ($post['max_contact'] as $key => $value) {
                if ($value == '' || intval($value) < 0) {
                    $name = $this->Staffs_model->find_staff_name($key);
                    $msg = 'Vui lòng điền số lượng contact tối đa cho nhân viên "' . $name . '". Tối thiểu là 0 contact.';
                    die($msg);
                }
                $data1 = array('max_contact' => $value);
                $where = array('id' => $key);
                $this->staffs_model->update($where, $data1);
            }
            $this->_common_load_view_draft_divide($contacts);
        } else {
            $this->_common_load_view_draft_divide($contacts);
        }
    }

    private function _common_load_view_draft_divide($contacts) {
        $require_model = array(
            'staffs' => array(
                'where' => array('role_id' => 1, 'active' => 1)
            ),
            'courses' => array()
        );
        $data = array_merge($this->data, $this->_get_require_data($require_model));

        foreach ($data['staffs'] as $key => $value) {
            $data['staffs'][$key]['count'] = 0;
        }

        $this->draft_divide_contact_even1($data['staffs'], $contacts, 0);

        foreach ($data['staffs'] as $key => $value) {
            $input = array();
            $input['where'] = array('draft_sale_staff_id' => $value['id']);
            $input['order'] = array('id' => 'DESC');
            $data['staffs'][$key]['contacts'] = $this->contacts_model->load_all($input);
            $data['staffs'][$key]['cancel_contact'] = 1;
        }
        $data['total_contact'] = count($contacts);
        $table = 'selection contact_id name phone address course_code price_purchase ';
        $table .= 'date_rgt matrix action';
        $data['table'] = explode(' ', $table);
        $data['load_js'] = array('m_cancel_contact');
        $data['content'] = 'manager/draft_divide_contact_even';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function draft_divide_contact_even1($staffs, $contacts, $i) {
        /*
         * Hàm đệ quy chia đều contact
         * Chia từng contact 1 cho các TVTS với số lượng max của từng TVTS
         * $i: số thứ tự của contact
         */
        $stop = true; // cờ kiểm tra dừng chia
        foreach ($staffs as $key => $value) {
            if (!isset($contacts[$i]))
                return false;
            if ($value['count'] < $value['max_contact']) {
                $where = array('id' => $contacts[$i]['id']);
                $data = array(
                    'draft_sale_staff_id' => $value['id']
                );
                $this->contacts_model->update($where, $data);
                $staffs[$key]['count'] ++;
                $i++;
                $stop = false;
            }
        }
        if (!$stop) {
            $this->draft_divide_contact_even1($staffs, $contacts, $i);
        }
    }

    function cancel_multi_contact() {
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            redirect_and_die('Vui lòng chọn Contact!');
        }
        foreach ($post['contact_id'] as $value) {
            $where = array('id' => $value);
            $data = array('has_draft_divide' => '0', 'draft_sale_staff_id' => '0');
            $this->contacts_model->update($where, $data);
        }
        $msg = 'Bỏ chọn contact thành công!';
        show_error_and_redirect($msg);
    }

    function cancel_one_contact() {
        $post = $this->input->post();
        $post['contact_id'];
        if ($post['contact_id'] > 0) {
            $where = array('id' => $post['contact_id']);
            $data = array('has_draft_divide' => '0', 'draft_sale_staff_id' => '0');
            if ($this->contacts_model->update($where, $data)) {
                echo 1;
            }
        }
    }

    function confirm_divide_contact_even() {
        $post = $this->input->post();
        if (isset($post['submit_ok']) && $post['submit_ok'] == 'OK') {
            $query1 = 'UPDATE `tbl_contact` set `sale_staff_id` = `draft_sale_staff_id`, `date_handover`=' . time()
                    . ', `last_activity` = ' . time() . ' WHERE `draft_sale_staff_id` > 0';
            $query2 = 'UPDATE `tbl_contact` set `draft_sale_staff_id` = 0, `has_draft_divide` = 0 WHERE `draft_sale_staff_id` > 0';
            $total = $this->contacts_model->query($query1);
            $this->contacts_model->query($query2);
            $msg = 'Phân thành công ' . $total . ' contact!';
            show_error_and_redirect($msg, base_url('manager'));
        }
        if (isset($post['submit_cancel']) && $post['submit_cancel'] == 'Cancel') {
            $query = 'UPDATE `tbl_contact` set `draft_sale_staff_id` = 0, `has_draft_divide` = 0 WHERE `draft_sale_staff_id` > 0';
            $this->contacts_model->query($query);
            $msg = 'Hủy bỏ thành công nghiệp vụ phân đều contact';
            show_error_and_redirect($msg, base_url('manager'));
        }
    }

    /* ========================  hàm chia contact (chia đều contact) và các hàm phụ trợ (hết) =========================== */

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="hàm xóa contact và các hàm phụ trợ">
    /* ========================  hàm xóa contact và các hàm phụ trợ =========================== */
    function delete_contact() {
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            redirect_and_die('Vui lòng chọn contact!');
        }
        $this->_check_contact_can_be_delete($post['contact_id']);
        foreach ($post['contact_id'] as $value) {
            $where = array('id' => $value);
            $data = array('is_hide' => 1, 'last_activity' => time());
            $this->contacts_model->update($where, $data);
        }
        $msg = 'Xóa thành công các contact vừa chọn!';
        show_error_and_redirect($msg);
    }

    function delete_one_contact() {
        $post = $this->input->post();
        if (!empty($post['contact_id'])) {
            $this->_check_contact_can_be_delete(array($post['contact_id']));
            $where = array('id' => $post['contact_id']);
            $data = array('is_hide' => 1, 'last_activity' => time());
            $this->contacts_model->update($where, $data);
            echo '1';
        }
    }

    private function _check_contact_can_be_delete($list) {
        $this->load->model('Staffs_model');
        foreach ($list as $value) {
            $input = array();
            $input['select'] = 'duplicate_id, sale_staff_id';
            $input['where'] = array('id' => $value);
            $rows = $this->contacts_model->load_all($input);
            if ($rows[0]['duplicate_id'] == 0) {
                redirect_and_die('Contact ' . $rows[0]['name'] . ' không bị trùng, vì vậy không thể xóa contact này!');
            }
            if ($rows[0]['sale_staff_id'] > 0) {
                $name = $this->Staffs_model->find_staff_name($rows[0]['sale_staff_id']);
                $msg = 'Contact này đã được bàn giao cho TVST: "' . $name . '", vì vậy không thể xóa contact này!';
                redirect_and_die($msg);
            }
        }
    }

    /* ========================  hàm xóa contact và các hàm phụ trợ (hết) =========================== */

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Tìm kiếm contact">
    function find_contact() {
        $get = $this->input->get();
        $data = $this->_common_find_all($get);
        $this->table .= 'date_rgt date_last_calling call_stt ordering_stt action';
        $data['table'] = explode(' ', $this->table);
        $data['content'] = 'manager/find_contact';
        $data['load_js'] = array('common_real_search');
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Báo cáo TVTS">
    function view_report_sale() {
        $require_model = array(
            'courses' => array()
        );
        $data = array_merge($this->data, $this->_get_require_data($require_model));
        $get = $this->input->get();

        $input = array();
     
        if ($this->role_id == 1) {
            $input['where'] = array('id' => $this->user_id);
        } else {
            $input['where'] = array('role_id' => 1, 'active' => 1);
        }
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
                'L1' => array(
                    'where' => array('is_hide' => '0', 'date_handover >' => $startDate, 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                    'sum' => 0
                ),
                'L2' => array(
                    'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_rgt >' => $startDate, 'date_rgt <' => $endDate),
                    'sum' => 0
                ),
                'L6' => array(
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
                'L7L8' => array(
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
                'L1' => array(
                    'where' => array('is_hide' => '0', 'date_handover >' => $startDate, 'date_handover <' => $endDate),
                    'sum' => 0
                ),
                'L2' => array(
                    'where' => array('is_hide' => '0', 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >' => $startDate, 'date_handover <' => $endDate),
                    'sum' => 0
                ),
                'L6' => array(
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
                'L7L8' => array(
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

        $data['staffs'] = $staffs;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['left_col'] = array('date_happen', 'tic_report');
        $data['right_col'] = array();
        $data['load_js'] = array('m_view_report');
        $data['content'] = 'manager/view_report';
        if($this->role_id == 1){
            $data['top_nav'] = 'sale/common/top-nav';
        }
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function view_report_sale_back_up() {
        $require_model = array(
            'courses' => array()
        );
        $data = array_merge($this->data, $this->_get_require_data($require_model));
        $get = $this->input->get();

        $input = array();
        $input['where'] = array('role_id' => 1);
        $staffs = $this->staffs_model->load_all($input);

        $conditionArr = array(
            'CHUA_GOI' => array(
                'where' => array('call_status_id' => '0'),
                'sum' => 0
            ),
            'L1' => array(
                'where' => array(),
                'sum' => 0
            ),
            'L2' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_),
                'sum' => 0
            ),
            'L6' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_),
                'sum' => 0
            ),
            'TU_CHOI_MUA' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _TU_CHOI_MUA_),
                'sum' => 0
            ),
            'CHUA_GIAO_HANG_COD' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'payment_method_rgt' => '1', 'cod_status_id' => '0'),
                'sum' => 0
            ),
            'CHUA_GIAO_HANG_TRANSFER' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'payment_method_rgt >' => '1', 'cod_status_id' => '0'),
                'sum' => 0
            ),
            'DANG_GIAO_HANG' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DANG_GIAO_HANG_),
                'sum' => 0
            ),
            'DA_THU_COD' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_COD_),
                'sum' => 0
            ),
            'L8' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_),
                'sum' => 0
            ),
            'L7L8' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    '(`cod_status_id` = ' . _DA_THU_COD_ . ' OR `cod_status_id` = ' . _DA_THU_LAKITA_ . ')' => 'NO-VALUE'),
                'sum' => 0
            ),
            'HUY_DON' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _HUY_DON_),
                'sum' => 0
            ),
            'LC' => array(
                'where' => array(
                    '(`call_status_id` = ' . _SO_MAY_SAI_ . ' OR `call_status_id` = ' . _NHAM_MAY_ . ' OR `ordering_status_id` = ' . _CONTACT_CHET_ . ')' => 'NO-VALUE'),
                'sum' => 0
            ),
            'CON_CUU_DUOC' => array(
                'where' => array(
                    '(`call_status_id` = ' . _KHONG_NGHE_MAY_ . ' OR `ordering_status_id` in (' . _BAN_GOI_LAI_SAU_ . ' , ' . _CHAM_SOC_SAU_MOT_THOI_GIAN_ . ',' . _LAT_NUA_GOI_LAI_ . '))' => 'NO-VALUE'),
                'sum' => 0
            ),
        );
        foreach ($staffs as $key => $value) {
            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                $conditional['where']['sale_staff_id'] = $value['id'];
                if (!count($get)) {
                    $conditional['where']['date_handover >='] = strtotime(date('01-m-Y'));
                }
                foreach ($value2['where'] as $key3 => $value3) {
                    $conditional['where'][$key3] = $value3;
                }
                $staffs[$key][$key2] = $this->_query_for_report($get, $conditional);
                $conditionArr[$key2]['sum'] += $staffs[$key][$key2];
            }
        }
        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }

//        echo '<pre>';
//        print_r($data);die;

        $data['staffs'] = $staffs;
        $data['left_col'] = array('date_handover');
        $data['right_col'] = array('course_code');
        $data['load_js'] = array('m_view_report');
        $data['content'] = 'manager/view_report';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Báo cáo doanh thu theo ngày nhận tiền">
    function view_report_revenue() {
        $this->load->helper('manager_helper');
        $data = $this->get_all_require_data();
        $get = $this->input->get();
        $input = array();
        $this->load->model('courses_model');
        $courses = $this->courses_model->load_all($input);
        $L7 = 0;
        $L8 = 0;
        $L7L8 = 0;
        /*
         * Lấy ngày nhận tiền và ngày phát thành công
         */
        $date_report_from = strtotime(date('01-m-Y'));
        $date_report_end = strtotime(date('t-m-Y'));
        if (isset($get['filter_custom_date_report']) && $get['filter_custom_date_report'] != '') {
            $dateArr = explode('-', $get['filter_custom_date_report']);
            $date_report_from = trim($dateArr[0]);
            $date_report_from = strtotime(str_replace("/", "-", $date_report_from));
            $date_report_end = trim($dateArr[1]);
            $date_report_end = strtotime(str_replace("/", "-", $date_report_end)) + 3600 * 24;
        }

        if (isset($get['filter_date_deliver_success']) && $get['filter_date_deliver_success'] != '') {
            $dateArr = explode('-', $get['filter_date_deliver_success']);
            $date_deliver_success_from = trim($dateArr[0]);
            $date_deliver_success_from = strtotime(str_replace("/", "-", $date_deliver_success_from));
            $date_deliver_success_end = trim($dateArr[1]);
            $date_deliver_success_end = strtotime(str_replace("/", "-", $date_deliver_success_end)) + 3600 * 24;
        }

        foreach ($courses as $key => $value) {
            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_receive_cod >='] = strtotime(date('01-m-Y'));
            } else {
                $conditional['where']['date_receive_cod >='] = $date_report_from;
                $conditional['where']['date_receive_cod <='] = $date_report_end;
            }
            $conditional['where']['course_code'] = $value['course_code'];
            $conditional['where']['cod_status_id'] = _DA_THU_COD_;

            // $_L7 = $this->contacts_model->load_all($conditional);
            $contact = $this->_query_all_from_get($get, $conditional, 50000, 0);
            $_L7 = $contact['data'];
            $courses[$key]['L7'] = sum_L8($_L7);
            $L7 += $courses[$key]['L7'];

            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_receive_lakita >='] = strtotime(date('01-m-Y'));
            } else {
                $conditional['where']['date_receive_lakita >='] = $date_report_from;
                $conditional['where']['date_receive_lakita <='] = $date_report_end;
            }
            $conditional['where']['course_code'] = $value['course_code'];
            $conditional['where']['cod_status_id'] = _DA_THU_LAKITA_;

            /*
             * Xem theo ngày phát thành công
             */
            if (isset($get['filter_date_deliver_success']) && $get['filter_date_deliver_success'] != '') {
                $conditional['where']['date_deliver_success >='] = $date_deliver_success_from;
                $conditional['where']['date_deliver_success <='] = $date_deliver_success_end;
            }

            // $_L8 = $this->contacts_model->load_all($conditional);
            $contact = $this->_query_all_from_get($get, $conditional, 50000, 0);
            $_L8 = $contact['data'];
            $courses[$key]['L8'] = sum_L8($_L8);
            $L8 += $courses[$key]['L8'];

            $courses[$key]['L7L8'] = $courses[$key]['L7'] + $courses[$key]['L8'];
            $L7L8 += $courses[$key]['L7L8'];
        }
        //  print_arr($courses);
        usort($courses, function($a, $b) {
            return $a['L7L8'] - $b['L7L8'];
        });
        $data['L7'] = $L7;
        $data['L8'] = $L8;
        $data['L7L8'] = $L7L8;

        $input = array();
        $staffs = $this->staffs_model->load_all($input);
        $L7_TVTS = 0;
        $L8_TVTS = 0;
        $L7L8_TVTS = 0;
        foreach ($staffs as $key => $value) {
            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_receive_cod >='] = strtotime(date('01-m-Y'));
            } else {
                $conditional['where']['date_receive_cod >='] = $date_report_from;
                $conditional['where']['date_receive_cod <='] = $date_report_end;
            }
            $conditional['where']['sale_staff_id'] = $value['id'];
            $conditional['where']['cod_status_id'] = _DA_THU_COD_;
            //$_L7 = $this->contacts_model->load_all($conditional);
            $contact = $this->_query_all_from_get($get, $conditional, 50000, 0);
            $_L7 = $contact['data'];

            $staffs[$key]['L7'] = sum_L8($_L7);
            $L7_TVTS += $staffs[$key]['L7'];

            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_receive_lakita >='] = strtotime(date('01-m-Y'));
            } else {
                $conditional['where']['date_receive_lakita >='] = $date_report_from;
                $conditional['where']['date_receive_lakita <='] = $date_report_end;
            }
            $conditional['where']['sale_staff_id'] = $value['id'];
            $conditional['where']['cod_status_id'] = _DA_THU_LAKITA_;
            //$_L8 = $this->contacts_model->load_all($conditional);
            $contact = $this->_query_all_from_get($get, $conditional, 50000, 0);
            $_L8 = $contact['data'];

            $staffs[$key]['L8'] = sum_L8($_L8);
            $L8_TVTS += $staffs[$key]['L8'];
            $staffs[$key]['L7L8'] = $staffs[$key]['L7'] + $staffs[$key]['L8'];
            $L7L8_TVTS += $staffs[$key]['L7L8'];
        }
        $data['left_col'] = array('provider');
        $data['L7_TVTS'] = $L7_TVTS;
        $data['L8_TVTS'] = $L8_TVTS;
        $data['L7L8_TVTS'] = $L7L8_TVTS;
        $data['staffs'] = $staffs;
        $data['courses'] = $courses;
        $data['content'] = 'manager/view_report_revenue';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Báo cáo doanh thu theo ngày đăng ký">
    function view_report_revenue_by_date_rgt() {
        $data = $this->data;
        $get = $this->input->get();
        $input = array();
        $this->load->model('courses_model');
        $courses = $this->courses_model->load_all($input);
        $L7 = 0;
        $L8 = 0;
        $L7L8 = 0;
        foreach ($courses as $key => $value) {
            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_rgt >='] = strtotime(date('01-m-Y'));
            }
            $conditional['where']['course_code'] = $value['course_code'];
            $conditional['where']['cod_status_id'] = _DA_THU_COD_;
            if (isset($get['filter_date_report_from']) && $get['filter_date_report_from'] != '') {
                $conditional['where']['date_rgt >='] = strtotime($get['filter_date_report_from']);
            }
            if (isset($get['filter_date_report_end']) && $get['filter_date_report_end'] != '') {
                $conditional['where']['date_rgt <='] = strtotime($get['filter_date_report_end']) + 3600 * 24;
            }
            $_L7 = $this->contacts_model->load_all($conditional);
            $courses[$key]['L7'] = sum_L8($_L7);
            $L7 += $courses[$key]['L7'];

            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_rgt >='] = strtotime(date('01-m-Y'));
            }
            $conditional['where']['course_code'] = $value['course_code'];
            $conditional['where']['cod_status_id'] = _DA_THU_LAKITA_;
            if (isset($get['filter_date_report_from']) && $get['filter_date_report_from'] != '') {
                $conditional['where']['date_rgt >='] = strtotime($get['filter_date_report_from']);
            }
            if (isset($get['filter_date_report_end']) && $get['filter_date_report_end'] != '') {
                $conditional['where']['date_rgt <='] = strtotime($get['filter_date_report_end']) + 3600 * 24;
            }
            $_L8 = $this->contacts_model->load_all($conditional);
            $courses[$key]['L8'] = sum_L8($_L8);
            $L8 += $courses[$key]['L8'];

            $courses[$key]['L7L8'] = $courses[$key]['L7'] + $courses[$key]['L8'];
            $L7L8 += $courses[$key]['L7L8'];
        }
        $data['L7'] = $L7;
        $data['L8'] = $L8;
        $data['L7L8'] = $L7L8;

        $input = array();
        $staffs = $this->staffs_model->load_all($input);
        $L7_TVTS = 0;
        $L8_TVTS = 0;
        $L7L8_TVTS = 0;
        foreach ($staffs as $key => $value) {
            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_rgt >='] = strtotime(date('01-m-Y'));
            }
            $conditional['where']['sale_staff_id'] = $value['id'];
            $conditional['where']['cod_status_id'] = _DA_THU_COD_;
            if (isset($get['filter_date_report_from']) && $get['filter_date_report_from'] != '') {
                $conditional['where']['date_rgt >='] = strtotime($get['filter_date_report_from']);
            }
            if (isset($get['filter_date_report_end']) && $get['filter_date_report_end'] != '') {
                $conditional['where']['date_rgt <='] = strtotime($get['filter_date_report_end']) + 3600 * 24;
            }
            $_L7 = $this->contacts_model->load_all($conditional);
            $staffs[$key]['L7'] = sum_L8($_L7);
            $L7_TVTS += $staffs[$key]['L7'];

            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_rgt >='] = strtotime(date('01-m-Y'));
            }
            $conditional['where']['sale_staff_id'] = $value['id'];
            $conditional['where']['cod_status_id'] = _DA_THU_LAKITA_;
            if (isset($get['filter_date_report_from']) && $get['filter_date_report_from'] != '') {
                $conditional['where']['date_rgt >='] = strtotime($get['filter_date_report_from']);
            }
            if (isset($get['filter_date_report_end']) && $get['filter_date_report_end'] != '') {
                $conditional['where']['date_rgt <='] = strtotime($get['filter_date_report_end']) + 3600 * 24;
            }
            $_L8 = $this->contacts_model->load_all($conditional);
            $staffs[$key]['L8'] = sum_L8($_L8);
            $L8_TVTS += $courses[$key]['L8'];

            $staffs[$key]['L7L8'] = $staffs[$key]['L7'] + $staffs[$key]['L8'];
            $L7L8_TVTS += $staffs[$key]['L7L8'];
        }
        $data['L7_TVTS'] = $L7_TVTS;
        $data['L8_TVTS'] = $L8_TVTS;
        $data['L7L8_TVTS'] = $L7L8_TVTS;
        $data['staffs'] = $staffs;
        $data['courses'] = $courses;
        $data['content'] = 'manager/view_report_revenue_by_date_rgt';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    // </editor-fold>

    /*
     * Hàm xem báo cáo tổng hợp theo loại (kênh, sản phẩm, TVTS, đơn vị giao hàng)
     * Tham số: loại báo cáo muốn xem
     * Đầu ra: không có
     */
    function view_general_report($view = 'course') {
        $this->load->helper('manager_helper');
        $model = '';
        $key_tb = '';
        $name_showing = '';
        switch ($view) {
            case 'course': {
                    $model = 'courses';
                    $prop = 'course_code';
                    $key_tb = 'course_code';
                    $name_showing = 'course_code';
                    break;
                }
            case 'tvts': {
                    $model = 'staffs';
                    $prop = 'sale_staff_id';
                    $key_tb = 'id';
                    $name_showing = 'name';
                    break;
                }
            case 'provider': {
                    $model = 'providers';
                    $prop = 'provider_id';
                    $key_tb = 'id';
                    $name_showing = 'name';
                    break;
                }
        }
        $this->_generate_report($model, $prop, $key_tb, $name_showing);
    }

    /*
     * Hàm tạo view xem báo cáo
     * Tham số:
     * $model: model tương ứng với loại báo cáo, ví dụ: báo cáo theo sản phẩm thì model là courses
     * $prop: tên trường tương ứng trong bảng tbl_contact, ví dụ: báo cáo theo sản phẩm thì trường tương ứng là courses_code
     * $key_tb: Khóa chính trong bảng tương ứng
     * $name_showing: trường tên của bảng đó
     */

    private function _generate_report($model, $prop, $key_tb, $name_showing) {
        $require_model = array(
            $model => array()
        );
        $data = array_merge($this->data, $this->_get_require_data($require_model));
        $model_data = $data[$model];
        $get = $this->input->get();

        $sumL8 = 0;
        $conditionArr = array(
            'L1' => array(
                'sum' => 0
            ),
            'L2' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_),
                'sum' => 0
            ),
            'L6' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_),
                'sum' => 0
            ),
            'L8' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_),
                'sum' => 0
            )
        );
        // print_arr($model_data);
        foreach ($model_data as $key => $value) {
            /*
             * Tính số L1, L2, L6, L8 theo từng khóa học
             */
            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                /* Điều kiện ràng buộc (khóa ngoại) */
                $conditional['where'][$prop] = $value[$key_tb];
                if (isset($value2['where'])) {
                    foreach ($value2['where'] as $key3 => $value3) {
                        $conditional['where'][$key3] = $value3;
                    }
                }
                //Mặc định là lấy dữ liệu từ đầu tháng
                if (!count($get)) {
                    $conditional['where']['date_handover >='] = strtotime(date("1-m-Y"));
                }
                $model_data[$key][$key2] = $this->_query_for_report($get, $conditional);
                $conditionArr[$key2]['sum'] += $model_data[$key][$key2];
            }

            if ($model_data[$key]['L1'] == 0) {
                unset($model_data[$key]);
                continue;
            }
            $model_data[$key]['L2/L1'] = ($model_data[$key]['L1'] != 0) ? round(($model_data[$key]['L2'] / $model_data[$key]['L1']) * 100, 2) . '%' : 'Không thể chia cho 0';
            $model_data[$key]['L6/L2'] = ($model_data[$key]['L2'] != 0) ? round(($model_data[$key]['L6'] / $model_data[$key]['L2']) * 100, 2) . '%' : 'Không thể chia cho 0';
            $model_data[$key]['L8/L6'] = ($model_data[$key]['L6'] != 0) ? round(($model_data[$key]['L8'] / $model_data[$key]['L6']) * 100, 2) . '%' : 'Không thể chia cho 0';
            $model_data[$key]['L8/L1'] = ($model_data[$key]['L1'] != 0) ? round(($model_data[$key]['L8'] / $model_data[$key]['L1']) * 100, 2) . '%' : 'Không thể chia cho 0';

            /*
             * Tính doanh thu theo từng khóa học
             */
            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            if (!count($get)) {
                $conditional['where']['date_handover >='] = strtotime(date("1-m-Y"));
            }
            if (isset($get['filter_date_handover_from']) && $get['filter_date_handover_from'] != '') {
                $conditional['where']['date_handover >='] = strtotime($get['filter_date_handover_from']);
            }
            if (isset($get['filter_date_handover_end']) && $get['filter_date_handover_end'] != '') {
                $conditional['where']['date_handover <='] = strtotime($get['filter_date_handover_end']) + 3600 * 24;
            }
            $conditional['where'][$prop] = $value[$key_tb];
            $conditional['where']['cod_status_id'] = _DA_THU_LAKITA_;
            $_L8 = $this->contacts_model->load_all($conditional);
            $money = sum_L8($_L8);
            $model_data[$key]['sumL8'] = number_format($money, 0, ",", ".") . " VNĐ";
            $sumL8 += $money;
        }
        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }

        $data['sumL8'] = $sumL8;
        $data['view'] = $model_data;
        $data['view_key'] = $key_tb;
        $data['name_showing'] = $name_showing;
        $data['prop'] = $prop;
        $data['left_col'] = array('course_code', 'date_handover');
        $data['right_col'] = array('date_last_calling');
        $data['load_js'] = array('m_view_report');
        $data['content'] = 'manager/view_general_report';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function click_see() {
        $post = $this->input->post();
        switch ($post['type']) {
            case 'L6/L2' : {
                    $this->_report_detail_by_sale($post);
                    break;
                }
            case 'L8/L6' : {
                    $this->_report_detail_by_cod($post);
                    break;
                }
        }
    }

    private function _report_detail_by_sale($post) {
        //print_arr($post);

        $input = array();
        $input['where'] = array('role_id' => 1);
        $staffs = $this->staffs_model->load_all($input);

        $conditionArr = array(
            'L2' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_),
                'sum' => 0
            ),
            'L6' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_),
                'sum' => 0
        ));
        foreach ($staffs as $key => $value) {
            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                $conditional['where']['sale_staff_id'] = $value['id'];
                foreach ($value2['where'] as $key3 => $value3) {
                    $conditional['where'][$key3] = $value3;
                }
                if ($post['course_code'] != 'total') {
                    $conditional['where']['course_code'] = $post['course_code'];
                }
                if (!isset($post['filter_date_handover_from'])) {
                    $conditional['where']['date_handover >='] = strtotime(date("1-m-Y"));
                }
                $staffs[$key][$key2] = $this->_query_for_report($post, $conditional);
                $conditionArr[$key2]['sum'] += $staffs[$key][$key2];
                //echoQuery();
            }
        }
        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }
        $data['course_code'] = $post['course_code'];
        $data['staffs'] = $staffs;
        $this->load->view('manager/report/view_report', $data);
    }

    private function _report_detail_by_cod($post) {
        //print_arr($post);
        $input = array();
        $this->load->model('providers_model');
        $providers = $this->providers_model->load_all($input);

        $conditionArr = array(
            'L6' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'L8' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
        ));
        foreach ($providers as $key => $value) {
            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                $conditional['where']['provider_id'] = $value['id'];
                foreach ($value2['where'] as $key3 => $value3) {
                    $conditional['where'][$key3] = $value3;
                }
                if ($post['course_code'] != 'total') {
                    $conditional['where']['course_code'] = $post['course_code'];
                }
                $providers[$key][$key2] = $this->_query_for_report($post, $conditional);
                $conditionArr[$key2]['sum'] += $providers[$key][$key2];
                //echoQuery();
            }
        }
        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }
        $data['course_code'] = $post['course_code'];
        $data['providers'] = $providers;
        $this->load->view('manager/report/view_report_cod', $data);
    }

    // <editor-fold defaultstate="collapsed" desc="get_all_require_data">
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
                ),
                'order' => array(
                    'course_code' => 'ASC'
                )
            ),
            'call_status' => array(),
            'ordering_status' => array(),
            'cod_status' => array(),
            'providers' => array(),
            'payment_method_rgt' => array(),
            'sources' => array(),
            'channel' => array()
        );
        return array_merge($this->data, $this->_get_require_data($require_model));
    }

    function test_report() {
        $content = file_get_contents('http://chuyenpn.com/crm/quan-ly/xem-bao-cao-tu-van-tuyen-sinh.html');
        var_dump($content);
    }

    function export_for_send_provider() {
        /* ====================xuất file excel============================== */
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            show_error_and_redirect('Vui lòng chọn contact cần xuất file excel', '', 0);
        }
        $this->load->model('call_status_model');
        $this->load->model('ordering_status_model');
        $this->load->model('cod_status_model');
        $this->load->model('notes_model');
        $this->load->model('staffs_model');
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setSize(11)->setBold(true)->setName('Times New Roman');
        //     ->getColor()->setRGB('FFFFFF')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size' => 15,
                'name' => 'Times New Roman'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('548235');
        $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle("A2:I100")->getFont()->setSize(15)->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(73);

        foreach (range('A', 'G') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }

        //set độ rộng của các cột
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);

        //set tên các cột cần in
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Contact id');
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Họ tên');
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'SĐT');
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Địa chỉ');
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 'Trạng thái gọi');
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, 'Trạng thái đơn hàng');
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, 'Trạng thái giao hàng');
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, 'Ma trận');
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, 'Ghi chú');
        $rowCount++;

        //đổ dữ liệu ra file excel
        foreach ($post['contact_id'] as $key => $value) {
            $input = array();
            $input['where'] = array('id' => $value);
            $contact = $this->contacts_model->load_all($input)[0];

            $all_note = '';
            $note = array();
            $note['where'] = array('contact_id' => $value);
            $notes = $this->notes_model->load_all($note);
            if (!empty($notes)) {
                foreach ($notes as $value2) {
                    $all_note .= 'Ngày: ' . date('H:i:s d/m/Y', $value2['time']) . ' - Người viết: '
                            . $this->staffs_model->find_staff_name($value2['sale_id']) . ' - Nội dung: ' . html_entity_decode($value2['content']);
                }
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $contact['id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $contact['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $contact['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $contact['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $contact['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $this->call_status_model->find_call_status_desc($contact['call_status_id']));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $this->ordering_status_model->find_ordering_status_desc($contact['ordering_status_id']));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $this->cod_status_model->find_cod_status_desc($contact['cod_status_id']));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $contact['matrix']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $all_note);
            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(35);
            $BStyle = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THICK,
                        'color' => array('rgb' => '151313')
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':H' . $rowCount)->applyFromArray($BStyle);
            $rowCount++;
        }
//die;
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        die;
        /* ====================xuất file excel (end)============================== */
    }

    // </editor-fold>

    protected function GetProccessToday() {

        //L6,L8 tính theo ngày
        $total = $this->GetProccessThisMonth();
        $total_marketing_day = round($total['marketing']['kpi']/30);
        $total_sale_day_L6 = round($total['sale']['kpi']/30);
        $total_day_L8 = round($total_sale_day_L6*KPI_L8);
        // echo '<pre>';
        // print_r($total);
        // echo '</pre>';
        // die();

        $progress = [];
        $inputContact = array();
        $inputContact['select'] = 'id';
        $inputContact['where'] = array('date_rgt >' => strtotime(date('d-m-Y')), 'is_hide' => '0');
        $today = $this->contacts_model->load_all($inputContact);
  
        $progress['marketing'] = array(
            'count' => count($today),
            'kpi' => $total_marketing_day,
            'name' => 'Marketing',
            'type' => 'C3'
        );
        $progress['marketing']['progress'] = round($progress['marketing']['count'] / $progress['marketing']['kpi'] * 100, 2);

        $inputContact = array();
        $inputContact['select'] = 'id';
        $inputContact['where'] = array('date_confirm >' => strtotime(date('d-m-Y')), 'is_hide' => '0');
        $today = $this->contacts_model->load_all($inputContact);
        $progress['sale'] = array(
            'count' => count($today),
            'kpi' => $total_sale_day_L6,
            'name' => 'TVTS',
            'type' => 'L6');
        $progress['sale']['progress'] = round($progress['sale']['count'] / $progress['sale']['kpi'] * 100, 2);

        // thêm hàng cod L8
        $inputContact = array();
        $inputContact['select'] = 'id';
        $inputContact['where'] = array('date_receive_lakita >' => strtotime(date('01-m-Y')), 'is_hide' => '0');
        $today = $this->contacts_model->load_all($inputContact);
        $progress['cod'] = array(
            'count' => count($today),
            'kpi' => $total_day_L8,
            'name' => 'COD',
            'type' => 'L8'
        );
        $progress['cod']['progress'] = round($progress['cod']['count'] / $progress['cod']['kpi'] * 100, 2);


        return $progress;
    }


    protected function GetProccessThisMonth() {

        // tính L6,L8 theo thang
        $total = 0;
        $this->load->model('staffs_model');
        $qr = $this->staffs_model->SumKPI();
        $total_month_L6 = round($qr[0]['kpi']*KPI_L6);
        $total_month_L8 = round($total_month_L6*0.9);


        $progress = [];
        $inputContact = array();
        $inputContact['select'] = 'id';
        $inputContact['where'] = array('date_rgt >' => strtotime(date('01-m-Y')), 'is_hide' => '0');
        $today = $this->contacts_model->load_all($inputContact);
        $progress['marketing'] = array(
            'count' => count($today),
            'kpi' => $qr[0]['kpi'],
            'name' => 'Marketing',
            'type' => 'C3');
        $progress['marketing']['progress'] = round($progress['marketing']['count'] / $progress['marketing']['kpi'] * 100, 2);

        $inputContact = array();
        $inputContact['select'] = 'id';
        $inputContact['where'] = array('date_confirm >' => strtotime(date('01-m-Y')), 'is_hide' => '0');
        $today = $this->contacts_model->load_all($inputContact);
        $progress['sale'] = array(
            'count' => count($today),
            'kpi' => $total_month_L6,
            'name' => 'TVTS',
            'type' => 'L6');
        $progress['sale']['progress'] = round($progress['sale']['count'] / $progress['sale']['kpi'] * 100, 2);

        $inputContact = array();
        $inputContact['select'] = 'id';
        $inputContact['where'] = array('date_receive_lakita >' => strtotime(date('01-m-Y')), 'is_hide' => '0');
        $today = $this->contacts_model->load_all($inputContact);
        $progress['cod'] = array(
            'count' => count($today),
            'kpi' => $total_month_L8,
            'name' => 'COD',
            'type' => 'L8'
        );

        $progress['cod']['progress'] = round($progress['cod']['count'] / $progress['cod']['kpi'] * 100, 2);

        return $progress;
    }


    protected function ExportToExcel($post) {
        /* ====================xuất file excel============================== */
        //$post = $this->input->post();

        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setSize(11)->setBold(true)->setName('Times New Roman');
        //     ->getColor()->setRGB('FFFFFF')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size' => 15,
                'name' => 'Times New Roman'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle("A1:R1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle("A1:R1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('548235');
        $objPHPExcel->getActiveSheet()->getStyle("A1:R1")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle("A2:R200")->getFont()->setSize(15)->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(73);


        //set tên các cột cần in
        $columnName = 'A';
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'STT');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Họ tên');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Số điện thoại');
//        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Địa chỉ');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Mã khóa học');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Ngày đăng ký');
//        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'TVTS');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Giá tiền mua');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Nguồn contact');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Marketer');
//        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Trạng thái gọi');
//        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Trạng thái đơn hàng');
//        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Trạng thái giao hàng');
//        $objPHPExcel->getActiveSheet()->SetCellValue($columnName . $rowCount, 'Ghi chú cuộc gọi');
        $rowCount++;

        //đổ dữ liệu ra file excel
        $i = 1;
        $this->load->model('sources_model');
        $this->load->model('call_status_model');
        $this->load->model('ordering_status_model');
        $this->load->model('cod_status_model');
        foreach ($post['contact_id'] as $value) {
            $input = array();
//            $input['select'] = 'id, name, email, phone, address, course_code, date_rgt, sale_staff_id, '
//                    . 'price_purchase, source_id, call_status_id, ordering_status_id, cod_status_id';
            $input['select'] = 'id, name, email, phone, course_code, date_rgt, price_purchase, source_id, marketer_id';
            $input['where'] = array('id' => $value);
            $contact = $this->contacts_model->load_all($input);

//            $this->load->model('notes_model');
//            $input2 = array();
//            $input2['where'] = array('contact_id' => $value);
//            $input2['order'] = array('id' => 'DESC');
//            $last_note = $this->notes_model->load_all($input2);
//            $notes = '';
//            if (!empty($last_note)) {
//                foreach ($last_note as $value2) {
//                    $notes .= date('d/m/Y', $value2['time']) . ' ==> ' . $value2['content'] . ' ------ ';
//                }
//            }
//            $notes = html_entity_decode($notes);

            $columnName = 'A';

            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $i++);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $contact[0]['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $contact[0]['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $contact[0]['phone']);
//            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $contact[0]['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $contact[0]['course_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, date('d/m/Y', $contact[0]['date_rgt']));
//            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $this->staffs_model->find_staff_name($contact[0]['sale_staff_id']));
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $contact[0]['price_purchase']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $this->sources_model->find_source_name($contact[0]['source_id']));
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $this->staffs_model->find_staff_name($contact[0]['marketer_id']));
//            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $this->call_status_model->find_call_status_desc($contact[0]['call_status_id']));
//            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $this->ordering_status_model->find_ordering_status_desc($contact[0]['ordering_status_id']));
//            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $this->cod_status_model->find_cod_status_desc($contact[0]['cod_status_id']));
//            $objPHPExcel->getActiveSheet()->SetCellValue($columnName . $rowCount, $notes);
            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(35);
            $BStyle = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THICK,
                        'color' => array('rgb' => '151313')
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':' . $columnName . $rowCount)->applyFromArray($BStyle);
            $rowCount++;
        }
        foreach (range('A', $columnName) as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Danh_sach_khach_hang v' . date('Y.m.d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        die;
        /* ====================xuất file excel (end)============================== */
    }

    // HuyNV Fix report operation
    function show_report_operation() {
        $this->load->helper('manager_helper');
        $this->load->helper('common_helper');
        $get = $this->input->get();

        $data = '';

        $typeKPI = array(
            'L7+L8' => 10000000,
            'marketing' => 2000000,
            'priceC3' => 50000,
            'C1' => 15400,
            'C2' => 530,
            'C3' => 60,
            'L1' => 30,
            'L2' => 30,
            'L6' => 30,
            'L8' => 30,
            'Hủy đơn / L6' => 5
        );

        if (isset($get['tic_report'])) {
            /* các loại báo cáo */
            $typeReport = array(
                'user' => 'date_rgt',
                'marketing' => 'time',
                'C3' => 'date_rgt',
                'L1' => 'date_rgt',
                'L2' => 'date_rgt',
                'L6' => 'date_rgt',
                'L7_revenue' => 'date_rgt',
                'L8_revenue' => 'date_rgt',
                're_buy' => 'date_rgt',
                'active' => 'date_rgt',
                'no_active' => 'date_rgt',
                'huydon' => 'date_rgt'
            );
        } else {
            /* các loại báo cáo */
            $typeReport = array(
                'user' => 'date_rgt',
                'marketing' => 'time',
                'C3' => 'date_rgt',
                'L1' => 'date_rgt',
                'L2' => 'date_rgt',
                'L6' => 'date_confirm',
                'L7_revenue' => 'date_receive_cod',
                'L8_revenue' => 'date_receive_lakita',
                're_buy' => 'date_rgt',
                'active' => 'date_active',
                'no_active' => 'date_rgt',
                'huydon' => 'date_receive_cancel_cod'
            );
        }

        /* Mảng chứa các ngày lẻ */
        if (isset($get['filter_date_happen_from']) && $get['filter_date_happen_from'] != '' && isset($get['filter_date_happen_end']) && $get['filter_date_happen_end'] != '') {
            $startDate = strtotime($get['filter_date_happen_from']);
            $endDate = strtotime($get['filter_date_happen_end']);
        } else {
            $startDate = strtotime(date('01-m-Y'));
            $endDate = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        }
        $dateArray = h_get_time_range($startDate, $endDate);

        $Report = array();

        foreach ($typeReport as $report_type => $typeDate) {
            $total = 0;
            $total2 = 0;
            foreach ($dateArray as $key => $time) {
                $week = $key;

                $input = array();

                $input['where'][$typeDate . ' >='] = $time;
                $input['where'][$typeDate . ' <='] = $time + 86400 - 1;

                // Số người đồng ý mua theo từng ngày
                if ($report_type == 'user') {
                    $input['select'] = 'phone';
                    $input['where']['ordering_status_id'] = _DONG_Y_MUA_;
                    $input['where']['duplicate_id'] = '';
                    $contact = '';
                    $contact_new = array();
                    $contact = $this->contacts_model->load_all($input);
                    foreach ($contact as $key => $value) {
                        $contact_new[] = $value['phone'];
                    }
                    $contact_new = array_unique($contact_new);

                    $array = array();
                    $array['value'] = count($contact_new);
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                // Số lượng C3 theo ngày
                if ($report_type == 'C3') {
                    $input['select'] = 'id';
                    $input['where']['is_hide'] = '0';
                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $array['value/kpi'] = round($array['value'] / $typeKPI['C3'], 2) * 100 . '%';
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $array['Lũy kế /kpi'] = round($array['Lũy kế'] / ($typeKPI['C3'] * date('t')), 2) * 100 . '%';
                    $Report[$report_type][$week] = $array;
                }

                // Số lượng L1 theo ngày
                if ($report_type == 'L1') {
                    $contact = '';
                    $input['select'] = 'id';
                    $input['where']['duplicate_id'] = '';

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                // Số lượng L2 theo ngày
                if ($report_type == 'L2') {
                    $input['select'] = 'id';
                    $input['where']['duplicate_id'] = '';
                    $input['where']['call_status_id'] = _DA_LIEN_LAC_DUOC_;

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                // Số lượng L6 theo ngày
                if ($report_type == 'L6') {
                    $input['select'] = 'id';
                    $input['where']['ordering_status_id'] = _DONG_Y_MUA_;

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                // Số lượng hủy đơn
                if ($report_type == 'huydon') {
                    $input['select'] = 'id';
                    $input['where']['cod_status_id'] = _HUY_DON_;
                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                // Doanh thu L7 & L8
                if ($report_type == 'L7_revenue' || $report_type == 'L8_revenue') {
                    $input['select'] = 'id,price_purchase';
                    if ($report_type == 'L7_revenue') {
                        $input['where']['cod_status_id'] = _DA_THU_COD_;
                    }

                    if ($report_type == 'L8_revenue') {
                        $input['where']['cod_status_id'] = _DA_THU_LAKITA_;
                    }
                    $contact = '';
                    $contact = $this->contacts_model->load_all($input);

                    $array1 = array();
                    $array1['value'] = sum_L8($contact);
                    $total += $array1['value'];
                    $array1['Lũy kế'] = $total;
                    $Report[$report_type]['revenue'][$week] = $array1;

                    $array2 = array();
                    $array2['value'] = count($contact);
                    $array2['value/kpi'] = round(count($contact) / $typeKPI['L8'], 2);
                    $total2 += $array2['value'];
                    $array2['Lũy kế'] = $total2;
                    $array2['Lũy kế /kpi'] = round($array2['Lũy kế'] / ($typeKPI['L8'] * date('t')), 2) * 100 . '%';
                    $Report[$report_type]['count'][$week] = $array2;
                }

                // Chi phi Marketing
                if ($report_type == 'marketing') {

                    //lấy chi cho fb ad
                    $this->load->model('campaign_cost_model');
                    $input['select'] = 'id,spend';
                    $marketing_fee = $this->campaign_cost_model->load_all($input);
                    $sum = 0;

                    // lấy chi cho Email getreponse
                    // month có định dạng yyyy-mm-01
                    $date_ex = explode('/', $key);
                    $month = $date_ex[2] . '-' . $date_ex[1] . '-01';

                    $number_days = date('t', $time);

                    $input = array(
                        'select' => array('value'),
                        'where' => array(
                            'month' => $month
                        )
                    );

                    $this->load->model('Cost_warehouse_model');

                    $data_res = $this->Cost_warehouse_model->load_all($input);


                    $spend_email = 0;
                    if (!empty($data_res)) {
                        foreach ($data_res as $value) {
                            $spend_each = $value['value'] / $number_days;
                            $spend_email += $spend_each;
                        }
                    }
                    //
                    // lấy chi cho google ads
                    // month có định dạng yyyy-mm-01
                    $date_ex = explode('/', $key);
                    $month = $date_ex[2] . '-' . $date_ex[1] . '-' . $date_ex[0];

                    $input = array(
                        'select' => array('value'),
                        'where' => array(
                            'date' => $month
                        )
                    );

                    $this->load->model('Cost_GA_campaign_model');

                    $data_res = $this->Cost_GA_campaign_model->load_all($input);


                    $spend_ga = 0;
                    if (!empty($data_res)) {
                        foreach ($data_res as $value) {
                            $spend_each = $value['value'];
                            $spend_ga += $spend_each;
                        }
                    }
                    //

                    foreach ($marketing_fee as $value) {
                        $sum += $value['spend'];
                    }
                    $sum += $spend_email;
                    $sum += $spend_ga;
                    $total += round($sum);
                    $array = array();
                    $array['value'] = round($sum);
                    $array['value/kpi'] = round($array['value'] / $typeKPI['marketing'], 2) * 100 . '%';
                    $array['Lũy kế'] = $total;
                    $array['Lũy kế /kpi'] = round($array['Lũy kế'] / ($typeKPI['marketing'] * date('t')), 2) * 100 . '%';
                    $Report[$report_type][$week] = $array;
                    // $total += $Report[$report_type][$week];
                }

                if ($report_type == 're_buy') {
                    $input['select'] = 'distinct(phone), date_rgt';

                    $input['where']['is_hide'] = '0';
                    $input['where']['duplicate_id'] = '';
                    $input['where']['ordering_status_id'] = 4;
                    $input['order'] = array('id' => 'desc');
                    $contact_list_buy = $this->contacts_model->load_all($input);

                    $contact_re_buy = array();
                    foreach ($contact_list_buy as $value) {
                        $input = '';
                        $input['select'] = 'phone,email,course_code,date_rgt';
                        $input['where']['phone'] = $value['phone'];
                        $input['where']['is_hide'] = '0';
                        $input['where']['duplicate_id'] = '';
                        $input['where']['ordering_status_id'] = 4;
                        $input['where']['date_rgt <'] = $value['date_rgt'] - 172800;
                        $input['order'] = array('id' => 'desc');

                        $contact = $this->contacts_model->load_all($input);

                        if (!empty($contact)) {
                            $contact_re_buy[] = $value;
                        }
                    }
                    $array = array();
                    $array['value'] = count($contact_re_buy);
                    // $array['value'] = $contact_re_buy;
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                if ($report_type == 'active') {
                    $input['select'] = 'id';
                    $input['where']['id_lakita !='] = '';
                    $input['where']['cod_status_id >'] = 1;
                    $input['where']['cod_status_id <'] = 4;
                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }
                if ($report_type == 'no_active') {
                    $input['select'] = 'id';
                    $input['where']['id_lakita'] = '';
                    $input['where']['cod_status_id >'] = 1;
                    $input['where']['cod_status_id <'] = 4;
                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }
            }
        }




        /* tầng doanh thu */
        $L7L8 = array();
        foreach ($Report['L7_revenue']['revenue'] as $key => $value) {
            $L7L8[$key]['value'] = $Report['L8_revenue']['revenue'][$key]['value'] + $value['value'];
            $L7L8[$key]['value/kpi'] = round($L7L8[$key]['value'] / $typeKPI['L7+L8'], 2) * 100 . '%';
            $L7L8[$key]['Lũy kế'] = $Report['L8_revenue']['revenue'][$key]['Lũy kế'] + $value['Lũy kế'];
            $L7L8[$key]['Lũy kế /kpi'] = round($L7L8[$key]['Lũy kế'] / ($typeKPI['L7+L8'] * date('t')), 2) * 100 . '%';
        }

        /* tầng maketing */
        /* chi marketing */
        $marketing_fee = $Report['marketing'];
        /* số C3 */
        $C3 = $Report['C3'];
        /* Giá C3 */
        $priceC3 = array();
        foreach ($Report['marketing'] as $key => $value) {
            $priceC3[$key]['value'] = ($Report['C3'][$key]['value'] > 0) ? round($value['value'] / $Report['C3'][$key]['value']) : 'N/A';
            $priceC3[$key]['value/kpi'] = round(str_replace('%', '', $priceC3[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['priceC3'], $typeKPI['C3'])), 2) * 100 . '%';
            $priceC3[$key]['Lũy kế'] = ($Report['C3'][$key]['Lũy kế'] > 0) ? round($value['Lũy kế'] / $Report['C3'][$key]['Lũy kế']) : 'N/A';
            $priceC3[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $priceC3[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['priceC3'] * date('t'), $typeKPI['C3'] * date('t'))), 2) * 100 . '%';
        }
        /* chất lượng C3 */
        $L8_C3 = array();
        foreach ($Report['L8_revenue']['count'] as $key => $value) {
            $L8_C3[$key]['value'] = h_get_progress($value['value'], $Report['C3'][$key]['value']);
            $L8_C3[$key]['value/kpi'] = round(str_replace('%', '', $L8_C3[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L8'], $typeKPI['C3'])), 2) * 100 . '%';
            $L8_C3[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['C3'][$key]['Lũy kế']);
            $L8_C3[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L8_C3[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L8'] * date('t'), $typeKPI['C3'] * date('t'))), 2) * 100 . '%';
        }

        /* tầng sale */
        /* chất lượng tổng L8/L1 */
        $L8_L1 = array();
        foreach ($Report['L8_revenue']['count'] as $key => $value) {
            $L8_L1[$key]['value'] = h_get_progress($value['value'], $Report['L1'][$key]['value']);
            $L8_L1[$key]['value/kpi'] = round(str_replace('%', '', $L8_L1[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L8'], $typeKPI['L1'])), 2) * 100 . '%';
            $L8_L1[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L1'][$key]['Lũy kế']);
            $L8_L1[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L8_L1[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L8'] * date('t'), $typeKPI['L1'] * date('t'))), 2) * 100 . '%';
        }
        /* Chất lượng contact L2/L1 */
        $L2_L1 = array();
        foreach ($Report['L2']as $key => $value) {
            $L2_L1[$key]['value'] = h_get_progress($value['value'], $Report['L1'][$key]['value']);
            $L2_L1[$key]['value/kpi'] = round(str_replace('%', '', $L2_L1[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L2'], $typeKPI['L1'])), 2) * 100 . '%';
            '__';
            $L2_L1[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L1'][$key]['Lũy kế']);
            $L2_L1[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L2_L1[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L2'] * date('t'), $typeKPI['L1'] * date('t'))), 2) * 100 . '%';
        }
        /* Chất lượng sale L6/L2 */
        $L6_L2 = array();
        foreach ($Report['L6'] as $key => $value) {
            $L6_L2[$key]['value'] = h_get_progress($value['value'], $Report['L2'][$key]['value']);
            $L6_L2[$key]['value/kpi'] = round(str_replace('%', '', $L6_L2[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L6'], $typeKPI['L2'])), 2) * 100 . '%';
            $L6_L2[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L2'][$key]['Lũy kế']);
            $L6_L2[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L6_L2[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L6'] * date('t'), $typeKPI['L2'] * date('t'))), 2) * 100 . '%';
        }

        // Chất lượng COD Hủy đơn / L6
        $fail_L6 = array();
        foreach ($Report['huydon'] as $key => $value) {
            $fail_L6[$key]['value'] = h_get_progress($value['value'], $Report['L6'][$key]['value']);
            $fail_L6[$key]['value/kpi'] = round(str_replace('%', '', $fail_L6[$key]['value']) / $typeKPI['Hủy đơn / L6'], 2) * 100 . '%';
            $fail_L6[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L6'][$key]['Lũy kế']);
            $fail_L6[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $fail_L6[$key]['Lũy kế']) / ($typeKPI['Hủy đơn / L6'] * date('t')), 2) * 100 . '%';
        }
        /* chỉ số arpu = doanh thu( L7 +l8) / số (L1) */
        /* nếu 1 khách hàng mua 3 lần bình thường tính là 3 L1 nhưng ở đây chỉ tính là 1 L1 */
        $arpu = array();
        foreach ($L7L8 as $key => $value) {
            if ($Report['user'][$key]['value'] != 0) {
                $arpu[$key]['value'] = round($value['value'] / $Report['user'][$key]['value'], 0);
            } else {
                $arpu[$key]['value'] = 'N/A';
            }
            $arpu[$key]['value/kpi'] = '__';
            if ($Report['user'][$key]['Lũy kế'] != 0) {
                $arpu[$key]['Lũy kế'] = round($value['Lũy kế'] / $Report['user'][$key]['Lũy kế'], 0);
            } else {
                $arpu[$key]['Lũy kế'] = 'N/A';
            }
            $arpu[$key]['Lũy kế /kpi'] = '__';
        }

        //Tầng chăm sóc khách hàng;
        $S1_S0 = array();
        foreach ($Report['active'] as $key => $value) {
            $S1_S0[$key]['value'] = $value['value'] . ' - ' . h_get_progress($value['value'], $Report['L7_revenue']['count'][$key]['value'] + $Report['L8_revenue']['count'][$key]['value']);
            $S1_S0[$key]['value/kpi'] = '__';
            $S1_S0[$key]['Lũy kế'] = $value['Lũy kế'] . ' - ' . h_get_progress($value['Lũy kế'], $Report['L7_revenue']['count'][$key]['Lũy kế'] + $Report['L8_revenue']['count'][$key]['Lũy kế']);
            $S1_S0[$key]['Lũy kế /kpi'] = '__';
        }
        //chưa kích hoạt
        $S1_S00 = array();
        foreach ($Report['no_active'] as $key => $value) {
            $S1_S00[$key]['value'] = $value['value'] . ' - ' . h_get_progress($value['value'], $Report['L7_revenue']['count'][$key]['value'] + $Report['L8_revenue']['count'][$key]['value']);
            $S1_S00[$key]['value/kpi'] = '__';
            $S1_S00[$key]['Lũy kế'] = $value['Lũy kế'] . ' - ' . h_get_progress($value['Lũy kế'], $Report['L7_revenue']['count'][$key]['Lũy kế'] + $Report['L8_revenue']['count'][$key]['Lũy kế']);
            $S1_S00[$key]['Lũy kế /kpi'] = '__';
        }

        $S5_S0 = array();
        foreach ($Report['re_buy'] as $key => $value) {
            $S5_S0[$key]['value'] = $value['value'] . ' - ' . h_get_progress($value['value'], $Report['L7_revenue']['count'][$key]['value'] + $Report['L8_revenue']['count'][$key]['value']);
            $S5_S0[$key]['value/kpi'] = '__';
            $S5_S0[$key]['Lũy kế'] = $value['Lũy kế'] . ' - ' . h_get_progress($value['Lũy kế'], $Report['L7_revenue']['count'][$key]['Lũy kế'] + $Report['L8_revenue']['count'][$key]['Lũy kế']);
            $S5_S0[$key]['Lũy kế /kpi'] = '__';
        }

        $Report3 = array(
            'Doanh thu (L7+L8)' => array_reverse($L7L8),
            'Chi phí marketing' => array_reverse($marketing_fee),
            'Số C3' => array_reverse($Report['C3']),
            'Giá C3' => array_reverse($priceC3),
            'Chất lượng C3 L8/C3' => array_reverse($L8_C3),
            'Chất lượng tổng L8/L1' => array_reverse($L8_L1),
            'Chất lượng contact L2/L1' => array_reverse($L2_L1),
            'Chất lượng sale L6/L2' => array_reverse($L6_L2),
            'Chất lượng COD (Hủy đơn)/L6' => array_reverse($fail_L6),
            'ARPU' => array_reverse($arpu),
            'Kích hoạt' => array_reverse($S1_S0),
            'Chưa kích hoạt' => array_reverse($S1_S00),
            'Mua lại' => array_reverse($S5_S0)
        );


        $data['left_col'] = array('date_happen', 'tic_report');
        $data['kpi'] = $typeKPI;
        $data['date'] = array_reverse($dateArray);
        $data['Report'] = $Report3;
        $data['startDate'] = isset($startDate) ? $startDate : '0';
        $data['endDate'] = isset($endDate) ? $endDate : '0';

        $data['content'] = 'manager/show_report_operation';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }


    function view_report_operation() {
        $this->load->helper('manager_helper');
        $this->load->helper('common_helper');
        $get = $this->input->get();

        $data = '';

        $typeKPI = array(
            'L7+L8' => 10000000,
            'marketing' => 2000000,
            'priceC3' => 50000,
            'C1' => 15400,
            'C2' => 530,
            'C3' => 60,
            'L1' => 30,
            'L2' => 30,
            'L6' => 30,
            'L8' => 30
        );

        if (isset($get['tic_report'])) {
            /* các loại báo cáo */
            $typeReport = array(
                'user' => 'date_rgt',
                'marketing' => 'time',
                'C3' => 'date_rgt',
                'L1' => 'date_rgt',
                'L2' => 'date_rgt',
                'L6' => 'date_rgt',
                'L7_revenue' => 'date_rgt',
                'L8_revenue' => 'date_rgt',
                're_buy' => 'date_rgt',
                'active' => 'date_rgt'
            );
        } else {
            /* các loại báo cáo */
            $typeReport = array(
                'user' => 'date_rgt',
                'marketing' => 'time',
                'C3' => 'date_rgt',
                'L1' => 'date_rgt',
                'L2' => 'date_rgt',
                'L6' => 'date_confirm',
                'L7_revenue' => 'date_receive_cod',
                'L8_revenue' => 'date_receive_lakita',
                're_buy' => 'date_rgt',
                'active' => 'date_active'
            );
        }

        /* Mảng chứa các ngày lẻ */
        if (isset($get['filter_date_happen_from']) && $get['filter_date_happen_from'] != '' && isset($get['filter_date_happen_end']) && $get['filter_date_happen_end'] != '') {
            $startDate = strtotime($get['filter_date_happen_from']);
            $endDate = strtotime($get['filter_date_happen_end']);
        } else {
            $startDate = strtotime(date('01-m-Y'));
            $endDate = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        }
        $dateArray = h_get_time_range($startDate, $endDate);

//         echo '<pre>';
//        print_r($dateArray);die;
        /* lấy mảng các loại contact */
        $Report = array();
        foreach ($typeReport as $report_type => $typeDate) {
            $total = 0;
            $total2 = 0;
            $kpix = 1;
            foreach ($dateArray as $key => $time) {
                $week = $key;

                $input = array();

                $input['where'][$typeDate . ' >='] = $time;
                $input['where'][$typeDate . ' <='] = $time + 86400 - 1;
                if ($report_type == 'user') {
                    $input['select'] = 'phone';
                    $input['where']['ordering_status_id'] = _DONG_Y_MUA_;
                    $input['where']['duplicate_id'] = '';
                    $contact = '';
                    $contact_new = array();
                    $contact = $this->contacts_model->load_all($input);
                    foreach ($contact as $key => $value) {
                        $contact_new[] = $value['phone'];
                    }
                    $contact_new = array_unique($contact_new);

                    $array = array();
                    $array['value'] = count($contact_new);
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                if ($report_type == 'C3') {
                    $input['select'] = 'id';
                    $input['where']['is_hide'] = '0';

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $array['value/kpi'] = round($array['value'] / $typeKPI['C3'], 2) * 100 . '%';
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $array['Lũy kế /kpi'] = round($array['Lũy kế'] / ($typeKPI['C3'] * date('t')), 2) * 100 . '%';
                    $kpix++;
                    $Report[$report_type][$week] = $array;
                }
                if ($report_type == 'L1') {
                    $contact = '';
                    $input['select'] = 'id';
                    $input['where']['duplicate_id'] = '';

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }
                if ($report_type == 'L2') {
                    $input['select'] = 'id';
                    $input['where']['duplicate_id'] = '';
                    $input['where']['call_status_id'] = _DA_LIEN_LAC_DUOC_;

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                if ($report_type == 'L6') {
                    $input['select'] = 'id';
                    $input['where']['ordering_status_id'] = _DONG_Y_MUA_;

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }        // HuyNV add huydon				//if ($report_type == 'huydon') {                //   $input['select'] = 'id';                //    $input['where']['cod_status_id'] = _HUY_DON_;                //    $array = array();                //    $array['value'] = count($this->contacts_model->load_all($input));                //    $total += $array['value'];                //    $array['Lũy kế'] = $total;                //    $Report[$report_type][$week] = $array;                //}				// HuyNV end huydon

                if ($report_type == 'L7_revenue' || $report_type == 'L8_revenue') {
                    $input['select'] = 'id,price_purchase';
                    if ($report_type == 'L7_revenue') {
                        $input['where']['cod_status_id'] = _DA_THU_COD_;
                    }

                    if ($report_type == 'L8_revenue') {
                        $input['where']['cod_status_id'] = _DA_THU_LAKITA_;
                    }
                    $contact = '';
                    $contact = $this->contacts_model->load_all($input);

                    $array1 = array();
                    $array1['value'] = sum_L8($contact);
                    $total += $array1['value'];
                    $array1['Lũy kế'] = $total;
                    $Report[$report_type]['revenue'][$week] = $array1;

                    $array2 = array();
                    $array2['value'] = count($contact);
                    $array2['value/kpi'] = round(count($contact) / $typeKPI['L8'], 2);
                    $total2 += $array2['value'];
                    $array2['Lũy kế'] = $total2;
                    $array2['Lũy kế /kpi'] = round($array2['Lũy kế'] / ($typeKPI['L8'] * $kpix), 2) * 100 . '%';
                    $kpix++;
                    $Report[$report_type]['count'][$week] = $array2;
                }
                if ($report_type == 'marketing') {
                    $this->load->model('campaign_cost_model');
                    $input['select'] = 'id,spend';
                    $marketing_fee = $this->campaign_cost_model->load_all($input);
                    $sum = 0;
                    foreach ($marketing_fee as $value) {
                        $sum += $value['spend'];
                    }
                    $total += $sum;
                    $array = array();
                    $array['value'] = $sum;
                    $array['value/kpi'] = round($array['value'] / $typeKPI['marketing'], 2) * 100 . '%';
                    $array['Lũy kế'] = $total;
                    $array['Lũy kế /kpi'] = round($array['Lũy kế'] / ($typeKPI['marketing'] * $kpix), 2) * 100 . '%';
                    $kpix++;
                    $Report[$report_type][$week] = $array;
                    // $total += $Report[$report_type][$week];
                }
                if ($report_type == 're_buy') {
                    $input['select'] = 'distinct(phone)';

                    $input['where']['is_hide'] = '0';
                    $input['where']['duplicate_id'] = '';
                    $input['where']['ordering_status_id'] = 4;
                    $input['order'] = array('id' => 'desc');
                    $contact_list_buy = $this->contacts_model->load_all($input);

                    $contact_re_buy = array();
                    foreach ($contact_list_buy as $value) {
                        $input = '';
                        $input['select'] = 'phone,email,course_code,date_rgt';
                        $input['where']['phone'] = $value['phone'];
                        $input['where']['is_hide'] = '0';
                        $input['where']['duplicate_id'] = '';
                        $input['where']['ordering_status_id'] = 4;
                        $input['order'] = array('id' => 'desc');
                        $contact = '';
                        $contact = $this->contacts_model->load_all($input);
                        $count = count($contact);
                        if ($count > 1) {
                            for ($i = 0; $i < $count - 1; $i++) {
                                if (($contact[0]['date_rgt'] - $contact[$i + 1]['date_rgt']) > 172800) {
                                    $contact_re_buy[] = $contact[$i];
                                    break;
                                }
                            }
                        }
                    }
                    $array = array();
                    $array['value'] = count($contact_re_buy);
                    // $array['value'] = $contact_re_buy;
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                if ($report_type == 'active') {
                    $input['select'] = 'id';
                    $input['where']['id_lakita !='] = '';
                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }
            }
            //   $Report[$report_type]['Lũy kế'] = $total;
//            if ($report_type == 'L8_revenue') {
//                $Report[$report_type]['count']['Lũy kế'] = $total2;
//            }
        }

        /* tầng doanh thu */
        $L7L8 = array();
        $kpix = 1;
        foreach ($Report['L7_revenue']['revenue'] as $key => $value) {
            $L7L8[$key]['value'] = $Report['L8_revenue']['revenue'][$key]['value'] + $value['value'];
            $L7L8[$key]['value/kpi'] = round($L7L8[$key]['value'] / $typeKPI['L7+L8'], 2) * 100 . '%';
            $L7L8[$key]['Lũy kế'] = $Report['L8_revenue']['revenue'][$key]['Lũy kế'] + $value['Lũy kế'];
            $L7L8[$key]['Lũy kế /kpi'] = round($L7L8[$key]['Lũy kế'] / ($typeKPI['L7+L8'] * date('t')), 2) * 100 . '%';
            $kpix++;
        }

        /* tầng maketing */
        /* chi marketing */
        $marketing_fee = $Report['marketing'];
        /* số C3 */
        $C3 = $Report['C3'];
        /* Giá C3 */
        $priceC3 = array();
        $kpix = 1;
        foreach ($Report['marketing'] as $key => $value) {
            $priceC3[$key]['value'] = ($Report['C3'][$key]['value'] > 0) ? round($value['value'] / $Report['C3'][$key]['value']) : 'N/A';
            $priceC3[$key]['value/kpi'] = round(str_replace('%', '', $priceC3[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['priceC3'], $typeKPI['C3'])), 2) * 100 . '%';
            $priceC3[$key]['Lũy kế'] = ($Report['C3'][$key]['Lũy kế'] > 0) ? round($value['Lũy kế'] / $Report['C3'][$key]['Lũy kế']) : 'N/A';
            $priceC3[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $priceC3[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['priceC3'] * $kpix, $typeKPI['C3'] * $kpix)), 2) * 100 . '%';
            $kpix++;
        }
        /* chất lượng C3 */
        $L8_C3 = array();
        $kpix = 1;
        foreach ($Report['L8_revenue']['count'] as $key => $value) {
            $L8_C3[$key]['value'] = h_get_progress($value['value'], $Report['C3'][$key]['value']);
            $L8_C3[$key]['value/kpi'] = round(str_replace('%', '', $L8_C3[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L8'], $typeKPI['C3'])), 2) * 100 . '%';
            $L8_C3[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['C3'][$key]['Lũy kế']);
            $L8_C3[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L8_C3[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L8'] * $kpix, $typeKPI['C3'] * $kpix)), 2) * 100 . '%';
            $kpix++;
        }

        /* tầng sale */
        /* chất lượng tổng L8/L1 */
        $L8_L1 = array();
        $kpix = 1;
        foreach ($Report['L8_revenue']['count'] as $key => $value) {
            $L8_L1[$key]['value'] = h_get_progress($value['value'], $Report['L1'][$key]['value']);
            $L8_L1[$key]['value/kpi'] = round(str_replace('%', '', $L8_L1[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L8'], $typeKPI['L1'])), 2) * 100 . '%';
            $L8_L1[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L1'][$key]['Lũy kế']);
            $L8_L1[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L8_L1[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L8'] * $kpix, $typeKPI['L1'] * $kpix)), 2) * 100 . '%';
            $kpix++;
        }
        /* Chất lượng contact L2/L1 */
        $L2_L1 = array();
        $kpix = 1;
        foreach ($Report['L2']as $key => $value) {
            $L2_L1[$key]['value'] = h_get_progress($value['value'], $Report['L1'][$key]['value']);
            $L2_L1[$key]['value/kpi'] = round(str_replace('%', '', $L2_L1[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L2'], $typeKPI['L1'])), 2) * 100 . '%';
            '__';
            $L2_L1[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L1'][$key]['Lũy kế']);
            $L2_L1[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L2_L1[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L2'] * $kpix, $typeKPI['L1'] * $kpix)), 2) * 100 . '%';
            $kpix++;
        }
        /* Chất lượng sale L6/L2 */
        $L6_L2 = array();
        $kpix = 1;
        foreach ($Report['L6'] as $key => $value) {
            $L6_L2[$key]['value'] = h_get_progress($value['value'], $Report['L2'][$key]['value']);
            $L6_L2[$key]['value/kpi'] = round(str_replace('%', '', $L6_L2[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L6'], $typeKPI['L2'])), 2) * 100 . '%';
            $L6_L2[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L2'][$key]['Lũy kế']);
            $L6_L2[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L6_L2[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L6'] * $kpix, $typeKPI['L2'] * $kpix)), 2) * 100 . '%';
            $kpix++;
        }  // HuyNV edit report
        /* Chất lượng cod L8/L6 */
        $L8_L6 = array();
        $kpix = 1;
        foreach ($Report['L8_revenue']['count'] as $key => $value) {
            $L8_L6[$key]['value'] = h_get_progress($value['value'], $Report['L6'][$key]['value']);
            $L8_L6[$key]['value/kpi'] = round(str_replace('%', '', $L8_L6[$key]['value']) / str_replace('%', '', h_get_progress($typeKPI['L8'], $typeKPI['L6'])), 2) * 100 . '%';
            $L8_L6[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L6'][$key]['Lũy kế']);
            $L8_L6[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L8_L6[$key]['Lũy kế']) / str_replace('%', '', h_get_progress($typeKPI['L8'] * $kpix, $typeKPI['L6'] * $kpix)), 2) * 100 . '%';
            $kpix++;
        }    // Hủy đơn (Hủy đơn / L6)		//foreach ($Report['huydon'] as $key => $value) {        //    $L8_L6[$key]['value'] = h_get_progress($value['value'], $Report['L6'][$key]['value']);        //    $L8_L6[$key]['value/kpi'] = round(str_replace('%', '', $L8_L6[$key]['value']) / $typeKPI['huydon'] , 2) * 100 . '%';        //    $L8_L6[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L6'][$key]['Lũy kế']);        //    $L8_L6[$key]['Lũy kế /kpi'] = round(str_replace('%', '', $L8_L6[$key]['Lũy kế']) / ($typeKPI['huydon'] * date('t')), 2) * 100 . '%';        //}				// HuyNV edit report end

        /* chỉ số arpu = doanh thu( L7 +l8) / số (L1) */
        /* nếu 1 khách hàng mua 3 lần bình thường tính là 3 L1 nhưng ở đây chỉ tính là 1 L1 */
        $arpu = array();
        $kpix = 1;
        foreach ($L7L8 as $key => $value) {
            if ($Report['user'][$key]['value'] != 0) {
                $arpu[$key]['value'] = round($value['value'] / $Report['user'][$key]['value'], 0);
            } else {
                $arpu[$key]['value'] = 'N/A';
            }
            $arpu[$key]['value/kpi'] = '__';
            if ($Report['user'][$key]['Lũy kế'] != 0) {
                $arpu[$key]['Lũy kế'] = round($value['Lũy kế'] / $Report['user'][$key]['Lũy kế'], 0);
            } else {
                $arpu[$key]['Lũy kế'] = 'N/A';
            }
            $arpu[$key]['Lũy kế /kpi'] = '__';
        }

        //Tầng chăm sóc khách hàng;
        $S1_S0 = array();
        $kpix = 1;
        foreach ($Report['active'] as $key => $value) {
            $S1_S0[$key]['value'] = h_get_progress($value['value'], $Report['L7_revenue']['count'][$key]['value'] + $Report['L8_revenue']['count'][$key]['value']);
            $S1_S0[$key]['value/kpi'] = '__';
            $S1_S0[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L7_revenue']['count'][$key]['Lũy kế'] + $Report['L8_revenue']['count'][$key]['Lũy kế']);
            $S1_S0[$key]['Lũy kế /kpi'] = '__';
        }

        $S5_S0 = array();
        $kpix = 1;
        foreach ($Report['re_buy'] as $key => $value) {
            $S5_S0[$key]['value'] = h_get_progress($value['value'], $Report['L7_revenue']['count'][$key]['value'] + $Report['L8_revenue']['count'][$key]['value']);
            $S5_S0[$key]['value/kpi'] = '__';
            $S5_S0[$key]['Lũy kế'] = h_get_progress($value['Lũy kế'], $Report['L7_revenue']['count'][$key]['Lũy kế'] + $Report['L8_revenue']['count'][$key]['Lũy kế']);
            $S5_S0[$key]['Lũy kế /kpi'] = '__';
        }
        $Report3['Doanh thu (L7+L8)'] = $L7L8;

        $Report3['Chi phí marketing'] = $marketing_fee;
        $Report3['Số C3'] = $Report['C3'];
        $Report3['Giá C3'] = $priceC3;
        $Report3['Chất lượng C3 L8/C3'] = $L8_C3;

        $Report3['Chất lượng tổng L8/L1'] = $L8_L1;
        $Report3['Chất lượng contact L2/L1'] = $L2_L1;
        $Report3['Chất lượng sale L6/L2'] = $L6_L2;
        $Report3['Chất lượng COD L8/L6'] = $L8_L6;


        $Report3['ARPU'] = $arpu;
        $Report3['Kích hoạt'] = $S1_S0;
        $Report3['Mua lại'] = $S5_S0;
//        echo '<pre>';
//        print_r($Report['re_buy']);
//         print_r($Report['L7_revenue']['count']);
//          print_r($Report['L8_revenue']['count']);die;
////        print_r($Report3);
//        //  print_r($dateArray);
//    //    die;
        $data['left_col'] = array('date_happen', 'tic_report');
        $data['kpi'] = $typeKPI;
        $data['date'] = $dateArray;
        $data['Report'] = $Report3;
        $data['startDate'] = isset($startDate) ? $startDate : '0';
        $data['endDate'] = isset($endDate) ? $endDate : '0';
        $data['content'] = 'manager/view_report_operation';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function view_report_sale_operation() {
        $this->load->helper('manager_helper');
        $this->load->helper('common_helper');
        $get = $this->input->get();

        $data = '';

        if (isset($get['tic_report'])) {
            $typeReport = array(
                'L1' => 'date_rgt',
                'L2' => 'date_rgt',
                'L6' => 'date_rgt',
                'L7_revenue' => 'date_rgt',
                'L8_revenue' => 'date_rgt',
            );
        } else {
            /* các loại báo cáo */
            $typeReport = array(
                'L1' => 'date_rgt',
                'L2' => 'date_rgt',
                'L6' => 'date_confirm',
                'L7_revenue' => 'date_receive_cod',
                'L8_revenue' => 'date_receive_lakita',
            );
        }

        /* Mảng chứa các ngày lẻ */
        if (isset($get['filter_date_happen_from']) && $get['filter_date_happen_from'] != '' && isset($get['filter_date_happen_end']) && $get['filter_date_happen_end'] != '') {
            $startDate = strtotime($get['filter_date_happen_from']);
            $endDate = strtotime($get['filter_date_happen_end']) + 86399;
        } else {
            $startDate = strtotime(date('01-m-Y'));
            $endDate = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
        }
        $dateArray = h_get_time_range($startDate, $endDate);

        /* lấy mảng các loại contact */
        $Report = array();
        foreach ($typeReport as $report_type => $typeDate) {
            $total = 0;
            $total2 = 0;
            $kpix = 1;
            foreach ($dateArray as $key => $time) {
                $week = $key;

                $input = array();

                $input['where'][$typeDate . ' >='] = $time;
                $input['where'][$typeDate . ' <='] = $time + 86400 - 1;
                if ($report_type == 'L1') {
                    $contact = '';
                    $input['select'] = 'id';
                    $input['where']['duplicate_id'] = '';

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }
                if ($report_type == 'L2') {
                    $input['select'] = 'id';
                    $input['where']['duplicate_id'] = '';
                    $input['where']['call_status_id'] = _DA_LIEN_LAC_DUOC_;

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                if ($report_type == 'L6') {
                    $input['select'] = 'id';
                    $input['where']['ordering_status_id'] = _DONG_Y_MUA_;

                    $array = array();
                    $array['value'] = count($this->contacts_model->load_all($input));
                    $total += $array['value'];
                    $array['Lũy kế'] = $total;
                    $Report[$report_type][$week] = $array;
                }

                if ($report_type == 'L7_revenue' || $report_type == 'L8_revenue') {
                    $input['select'] = 'id,price_purchase';
                    if ($report_type == 'L7_revenue') {
                        $input['where']['cod_status_id'] = _DA_THU_COD_;
                    }

                    if ($report_type == 'L8_revenue') {
                        $input['where']['cod_status_id'] = _DA_THU_LAKITA_;
                    }
                    $contact = '';
                    $contact = $this->contacts_model->load_all($input);

                    $array1 = array();
                    $array1['value'] = sum_L8($contact);
                    $total += $array1['value'];
                    $array1['Lũy kế'] = $total;
                    $Report[$report_type]['revenue'][$week] = $array1;

                    $array2 = array();
                    $array2['value'] = count($contact);
                    $total2 += $array2['value'];
                    $array2['Lũy kế'] = $total2;
                    $kpix++;
                    $Report[$report_type]['count'][$week] = $array2;
                }
            }
        }


        $L1 = $Report['L1'];
        $L8 = $Report['L8_revenue']['count'];

        /* tầng doanh thu */
        $L7L8 = array();

        foreach ($Report['L7_revenue']['revenue'] as $key => $value) {
            $L7L8[$key]['value'] = $Report['L8_revenue']['revenue'][$key]['value'] + $value['value'];
        }

        /* tầng sale */
        /* chất lượng tổng L8/L1 */
        $L8_L1 = array();
        foreach ($Report['L8_revenue']['count'] as $key => $value) {
            $L8_L1[$key]['value'] = str_replace("N/A", "0", str_replace("%", "", h_get_progress($value['value'], $Report['L1'][$key]['value'])));
        }
        /* Chất lượng sale L6/L2 */
        $L6_L2 = array();
        foreach ($Report['L6'] as $key => $value) {
            $L6_L2[$key]['value'] = str_replace("N/A", "0", str_replace("%", "", h_get_progress($value['value'], $Report['L2'][$key]['value'])));
        }

        /* Chất lượng contact L2/L1 */
        $L2_L1 = array();
        foreach ($Report['L2']as $key => $value) {
            $L2_L1[$key]['value'] = str_replace("N/A", "0", str_replace("%", "", h_get_progress($value['value'], $Report['L1'][$key]['value'])));
        }

        /* Chất lượng cod L8/L6 */
        $L8_L6 = array();
        foreach ($Report['L8_revenue']['count'] as $key => $value) {
            $L8_L6[$key]['value'] = str_replace("N/A", "0", str_replace("%", "", h_get_progress($value['value'], $Report['L6'][$key]['value'])));
        }

        $priceL8 = array();
        foreach ($L7L8 as $key => $value) {
            $priceL8[$key]['value'] = 0;
        }

        $Report3['L1'] = $L1;
        $Report3['L8'] = $L8;
        $Report3['L7L8'] = $L7L8;
        $Report3['L8/L1'] = $L8_L1;
        $Report3['L2/L1'] = $L2_L1;
        $Report3['L6/L2'] = $L6_L2;
        $Report3['L8/L6'] = $L8_L6;
        $Report3['priceL8'] = $priceL8;

        $a = array_keys($dateArray);

        $last_day = array_pop($a);



        $total = array();
        $total['L1'] = $Report['L1'][$last_day]['Lũy kế'];
        $total['L2'] = $Report['L2'][$last_day]['Lũy kế'];
        $total['L6'] = $Report['L6'][$last_day]['Lũy kế'];
        $total['L7'] = $Report['L7_revenue']['count'][$last_day]['Lũy kế'];
        $total['L8'] = $Report['L8_revenue']['count'][$last_day]['Lũy kế'];
        $total['revenue'] = $Report['L7_revenue']['revenue'][$last_day]['Lũy kế'] + $Report['L8_revenue']['revenue'][$last_day]['Lũy kế'];
        $total['priceL8'] = 0;
        $total['L2/L1'] = h_get_progress($total['L2'], $total['L1']);
        $total['L6/L2'] = h_get_progress($total['L6'], $total['L2']);
        $total['L8/L6'] = h_get_progress($total['L8'], $total['L6']);
        $total['L8/L1'] = h_get_progress($total['L8'], $total['L1']);



//         echo '<pre>';
//         print_r($total);
//         print_r($Report3);
//        print_r($Report);
//        print_r($dateArray);
//        die;

        $data['left_col'] = array('date_happen', 'marketer', 'tic_report');
        $data['report3'] = $Report3;
        $data['total'] = $total;
        $data['per_day'] = $dateArray;
        $data['slide_menu'] = 'manager/common/menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['content'] = 'manager/view_report_sale_operation';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function test() {

        $this->load->model('staffs_model');
        //tìm contact mới nhất xem cskh là ai

        $path = base_url('public/customer_care_id_index.txt');
        chmod($path, 0755);
        $fp = @fopen($path, "r");
        if (!$fp) {
            echo 0;
        } else {
            $customer_care_id_index = trim(file($path)[0]);
            var_dump(file($path));
            echo $path;
            echo '<br>';
            fclose($fh);
            $input['select'] = 'id';
            $input['where']['role_id'] = 10;
            $input['where']['active'] = 1;
            $input['order']['id'] = 'asc';
            $list_customer_care = $this->staffs_model->load_all($input);
            echo '<pre>';
            print_r($list_customer_care);
            $customer_care_id = 0;
            for ($i = 0; $i < count($list_customer_care); $i++) {

                if (($list_customer_care[$i]['id'] == $customer_care_id_index) && ($i < count($list_customer_care) - 1)) {
                    $customer_care_id = $list_customer_care[$i + 1]['id'];
                    break;
                } elseif (($list_customer_care[$i]['id'] == $customer_care_id_index) && ($i == count($list_customer_care)) - 1) {
                    $customer_care_id = $list_customer_care[0]['id'];
                    break;
                }
            }


            $myfile = fopen($path, "w") or die("Unable to open file!");
            fwrite($myfile, $customer_care_id);
            fclose($myfile);


            echo $customer_care_id;
        }
    }

}
