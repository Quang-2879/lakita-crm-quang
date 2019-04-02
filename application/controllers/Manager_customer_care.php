<?php

class Manager_customer_care extends MY_Controller {

    public $L = array();

    public function __construct() {
        parent::__construct();
    }

    function report($offset = 0) {
        $data = $this->_get_all_require_data();

        $get = $this->input->get();

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
                'DUOC_PHAN' => array(
                    'where' => array('is_hide' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                ),
                'CHUA_GOI' => array(
                    'where' => array('is_hide' => '0', 'customer_care_call_id' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                ),
                'DA_GOI' => array(
                    'where' => array('is_hide' => '0', 'customer_care_call_id !=' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                ),
                'DA_KICH_HOAT' => array(
                    'where' => array('is_hide' => '0', 'id_lakita !=' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                ),
                'CHUA_KICH_HOAT' => array(
                    'where' => array('is_hide' => '0', 'id_lakita' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                )
            );
        } else {
            $conditionArr = array(
                'DUOC_PHAN' => array(
                    'where' => array('is_hide' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                ),
                'CHUA_GOI' => array(
                    'where' => array('is_hide' => '0', 'customer_care_call_id' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                ),
                'DA_GOI' => array(
                    'where' => array('is_hide' => '0', 'customer_care_call_id !=' => '0', 'date_customer_care_call >' => $startDate, 'date_customer_care_call <' => $endDate),
                    'sum' => 0
                ),
                'DA_KICH_HOAT' => array(
                    'where' => array('is_hide' => '0', 'id_lakita !=' => '0', 'date_active >' => $startDate, 'date_active <' => $endDate),
                    'sum' => 0
                ),
                'CHUA_KICH_HOAT' => array(
                    'where' => array('is_hide' => '0', 'id_lakita' => '0', 'date_customer_care_handover >' => $startDate, 'date_customer_care_handover <' => $endDate),
                    'sum' => 0
                )
            );
        }
        $get = array();

        $input = array();
        if ($this->role_id == 10) {
            $input['where'] = array('id' => $this->user_id);
        } else {
            $input['where'] = array('role_id' => 10);
        }
        $staffs = $this->staffs_model->load_all($input);

        foreach ($staffs as $key => $value) {
            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                $conditional['where']['customer_care_staff_id'] = $value['id'];
                foreach ($value2['where'] as $key3 => $value3) {
                    $conditional['where'][$key3] = $value3;
                }
                $data['staffs'][$key][$key2] = $this->_query_for_report($get, $conditional);
                $conditionArr[$key2]['sum'] += $data['staffs'][$key][$key2];
            }
        }
        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }
        
        $input = array();
        $input['select'] = 'id';
        $input['where']['cod_status_id'] = 2;
        $input['where']['date_receive_cod >'] = $startDate;
        $input['where']['date_receive_cod <'] = $endDate;
        $input['where']['is_hide'] = '0';
        $data['bought'] = count($this->contacts_model->load_all($input));
        
        $input = array();
        $input['select'] = 'id';
        $input['where']['cod_status_id'] = 3;
        $input['where']['date_receive_lakita >'] = $startDate;
        $input['where']['date_receive_lakita <'] = $endDate;
        $input['where']['is_hide'] = '0';
        $data['bought'] += count($this->contacts_model->load_all($input));
        
        $input = array();
        $input['select'] = 'id';
        $input['where']['id_lakita !='] = '0';
        $input['where']['customer_care_staff_id'] = '0';
        $input['where']['date_active >'] = $startDate; 
        $input['where']['date_active <'] = $endDate;
        $input['where']['is_hide'] = '0';
        $data['active_themselves'] = count($this->contacts_model->load_all($input));
        
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['left_col'] = array('date_happen', 'tic_report');
        $data['right_col'] = array();
        $data['load_js'] = array('m_view_report');
        $data['content'] = 'manager_customer_care/report_customer_care';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    private function _get_all_require_data() {
        $require_model = array(
            'staffs' => array(
                'where' => array(
                    'role_id' => 10,
                    'active' => 1
                )
            ),
            'courses' => array(
                'where' => array('active' => '1'),
                'order' => array(
                    'course_code' => 'ASC'
                )
            ),
            'customer_care_call_stt' => array(),
            'transfer_logs' => array(),
            'call_status' => array('order' => array('sort' => 'ASC')),
            'ordering_status' => array('order' => array('sort' => 'ASC')),
            'cod_status' => array(),
            'payment_method_rgt' => array(),
        );
        return array_merge($this->data, $this->_get_require_data($require_model));
    }

    public function transfer_contact() {
        $post = $this->input->post();
        $list = isset($post['contact_id']) ? $post['contact_id'] : array();
        $this->_action_transfer_contact($post['customer_care_id'], $list);
    }

    public function transfer_one_contact() {
        $post = $this->input->post();
        $this->_action_transfer_contact($post['customer_care_id'], array($post['contact_id']));
    }

    private function _action_transfer_contact($customer_care_transfer_id, $contact_id) {
        if ($customer_care_transfer_id == 0) {
            redirect_and_die('Vui lòng chọn nhân viên CSKH!');
        }
        if (empty($contact_id)) {
            redirect_and_die('Vui lòng chọn contact!');
        }

        $data = array(
            'customer_care_staff_id' => $customer_care_transfer_id,
            'last_activity' => time()
        );

        foreach ($contact_id as $value) {
            $where = array('id' => $value);
            $this->contacts_model->update($where, $data);
        }

        $this->load->model('Staffs_model');
        $staff_name = $this->Staffs_model->find_staff_name($sale_transfer_id);
        $msg = 'Chuyển nhượng thành công cho nhân viên <strong>' . $staff_name . '</strong>';
        show_error_and_redirect($msg, $_SERVER['HTTP_REFERER'], true);
    }

}
