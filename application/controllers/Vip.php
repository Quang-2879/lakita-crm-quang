<?php

/**
 * Description of Common
 *
 * @author CHUYEN
 */
class Vip extends MY_Controller {

    public $L = array();

    function __construct() {
        parent::__construct();
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('call_status_id' => '0', 'sale_staff_id' => '0', 'is_hide' => '0');
        $this->L['L1'] = count($this->contacts_model->load_all($input));
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('is_hide' => '0');
        $this->L['all'] = count($this->contacts_model->load_all($input));
        $this->_loadCountListContact();
    }

    function index($offset = 0) {
        $data = $this->get_all_require_data();
        $get = $this->input->get();
        /*
         * Điều kiện lấy contact :
         * contact ở trang chủ là contact chưa được phân cho TVTS nào và chua gọi lần nào
         *
         */

        $conditional['where'] = array('call_status_id' => '0', 'sale_staff_id' => '0', 'is_hide' => '0');
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

        $data['titleListContact'] = 'Danh sách contact mới';
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

    function delete_item() {
        $post = $this->input->post();

//        var_dump($post);die;

        if (empty($post['item_id'])) {
            redirect_and_die('Vui lòng chọn contact!');
        }

        $where = array('id' => $post['item_id']);
        $data = array('is_hide' => 1, 'last_activity' => time());
        $this->contacts_model->update($where, $data);

        echo 1;
        die;

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

    private function _loadCountListContact() {

        $this->L['has_callback'] = 'Tùy từng TVTS';


        $this->L['can_save'] = 'Tùy từng TVTS';

        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('ordering_status_id' => _DONG_Y_MUA_, 'cod_status_id' => '0',
            'date_expect_receive_cod <' => strtotime('tomorrow'), 'payment_method_rgt' => '1', 'is_hide' => '0');
        $this->L['L6'] = count($this->contacts_model->load_all($input));

        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('cod_status_id' => _DANG_GIAO_HANG_, 'payment_method_rgt' => '1', 'is_hide' => '0');
        $this->L['pending'] = count($this->contacts_model->load_all($input));

        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
            'cod_status_id' => '0', 'payment_method_rgt >' => '1', 'is_hide' => '0');
        $this->L['transfer'] = count($this->contacts_model->load_all($input));
    }

    // </editor-fold>
}
