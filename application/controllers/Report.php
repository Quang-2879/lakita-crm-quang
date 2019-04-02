<?php

/*
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */

/**
 * Description of Report
 *
 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 */
class Report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        ini_set('max_execution_time', 300);
        if ($this->input->is_cli_request()) {
            show_error('Access denied', 403);
        } 
		//else {
          //  echo '1';
        //}
    }

    function send_report_sale_daily() {
        $get = [];
        $data = [];
        $input = array();
        $input['where'] = array('role_id' => 1);
        $staffs = $this->staffs_model->load_all($input);

        $conditionArr = array(
            'CHUA_GOI' => array(
                'where' => array('call_status_id' => '0'),
                'sum' => 0
            ),
            'L1' => array(
                'where' => array('date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L2' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L6' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L8' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_, 'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'LC' => array(
                'where' => array('(`call_status_id` = ' . _SO_MAY_SAI_ . ' OR `call_status_id` = ' . _NHAM_MAY_ .
                    ' OR `ordering_status_id` = ' . _CONTACT_CHET_ . ')' => 'NO-VALUE',
                    'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'CON_CUU_DUOC' => array(
                'where' => array('(`call_status_id` = ' . _KHONG_NGHE_MAY_ .
                    ' OR `ordering_status_id` in (' . _BAN_GOI_LAI_SAU_ . ' , ' . _CHAM_SOC_SAU_MOT_THOI_GIAN_ . ',' . _LAT_NUA_GOI_LAI_ . '))' => 'NO-VALUE',
                    'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'DANG_GIAO_HANG' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DANG_GIAO_HANG_, 'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'HUY_DON' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _HUY_DON_, 'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'TU_CHOI_MUA' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _TU_CHOI_MUA_,
                    'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'DA_THU_COD' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_COD_, 'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L1_luyke' => array(
                'where' => array('date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'L2_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'L6_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'L8_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'LC_luyke' => array(
                'where' => array('(`call_status_id` = ' . _SO_MAY_SAI_ . ' OR `call_status_id` = ' . _NHAM_MAY_ .
                    ' OR `ordering_status_id` = ' . _CONTACT_CHET_ . ')' => 'NO-VALUE',
                    'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'CON_CUU_DUOC_luyke' => array(
                'where' => array('(`call_status_id` = ' . _KHONG_NGHE_MAY_ .
                    ' OR `ordering_status_id` in (' . _BAN_GOI_LAI_SAU_ . ' , ' . _CHAM_SOC_SAU_MOT_THOI_GIAN_ . ',' . _LAT_NUA_GOI_LAI_ . '))' => 'NO-VALUE',
                    'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'DANG_GIAO_HANG_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DANG_GIAO_HANG_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'HUY_DON_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _HUY_DON_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'TU_CHOI_MUA_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _TU_CHOI_MUA_,
                    'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'DA_THU_COD_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_COD_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
        );

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
        }

        // print_arr($conditionArr);

        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }

        $data['staffs'] = $staffs;
        $data['content'] = 'report/send_report';
        $this->load->view('report/send_report', $data);
    }

    function send_report_revenue_daily() {
        $this->load->helper('manager_helper');

        $input = array();
        $this->load->model('courses_model');
        $courses = $this->courses_model->load_all($input);
        $conditionArr = array(
            'L7' => array(
                'where' => array('date_receive_cod >=' => strtotime(date('d-m-Y')),
                    'cod_status_id' => _DA_THU_COD_
                ),
                'sum' => 0
            ),
            'L8' => array(
                'where' => array('date_receive_lakita >=' => strtotime(date('d-m-Y')),
                    'cod_status_id' => _DA_THU_LAKITA_
                ),
                'sum' => 0
            ),
            'L7_luyke' => array(
                'where' => array('date_receive_cod >=' => strtotime(date('01-m-Y')),
                    'cod_status_id' => _DA_THU_COD_
                ),
                'sum' => 0
            ),
            'L8_luyke' => array(
                'where' => array('date_receive_lakita >=' => strtotime(date('01-m-Y')),
                    'cod_status_id' => _DA_THU_LAKITA_
                ),
                'sum' => 0
            ),
        );
        $L7L8 = 0;
        $L7L8_luyke = 0;
        foreach ($courses as $key => $value) {
            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                $conditional['select'] = 'course_code, cod_status_id, price_purchase';
                $conditional['where']['course_code'] = $value['course_code'];
                foreach ($value2['where'] as $key3 => $value3) {
                    $conditional['where'][$key3] = $value3;
                }
                $_L7 = $this->contacts_model->load_all($conditional);
                $courses[$key][$key2] = sum_L8($_L7);
                $conditionArr[$key2]['sum'] += $courses[$key][$key2];
            }
            $courses[$key]['L7L8'] = $courses[$key]['L7'] + $courses[$key]['L8'];
            $L7L8 += $courses[$key]['L7L8'];
            $courses[$key]['L7L8_luyke'] = $courses[$key]['L7_luyke'] + $courses[$key]['L8_luyke'];
            $L7L8_luyke += $courses[$key]['L7L8_luyke'];
        }
        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }

        $data['L7L8'] = $L7L8;
        $data['L7L8_luyke'] = $L7L8_luyke;
        $data['courses'] = $courses;
        $this->load->view('report/view_report_revenue', $data);
    }

    public function pending2() {

        require_once APPPATH . 'libraries/simple_html_dom.php';
        $this->load->model('viettel_log_model');
        $input = array();
        $input['distinct'] = 'code_cross_check';
        $input['where'] = array('cod_status_id' => _DANG_GIAO_HANG_, 'is_hide' => '0', 'provider_id' => 1);
        $input['order'] = array('date_print_cod' => 'DESC');
        $contacts = $this->contacts_model->load_all($input);
        foreach ($contacts as $contact) {
            $html = file_get_html('https://www.viettelpost.com.vn/Tracking?KEY=' . $contact['code_cross_check']);
            /*
             * Cập nhật trạng thái giao hàng viettel
             */
            if (!is_object($html->find('div[id=dnn_ctr507_Main_ViewKQ_PanelItem]', 0))) {
                continue;
            }
            $stt = $html->find('div[id=dnn_ctr507_Main_ViewKQ_PanelItem]', 0)->find("#dnn_ctr507_Main_ViewKQ_RepeaterView_Label5_0", 0)->plaintext;
            $where = ['code_cross_check' => $contact['code_cross_check']];
            $data = ['viettel_tracking_status' => $stt];
            $this->contacts_model->update($where, $data);

            /*
             * Chèn data vào bảng log
             */
            $rs = $html->find('div[id=dnn_ctr507_Main_ViewKQ_PanelItem] ul', 0);
            if (is_object($rs)) {
                foreach ($rs->find('li') as $row) {
                    $code_cross_check = $contact['code_cross_check'];
                    $dateInfo = strtotime(str_replace('/', '-', $row->find('span', 0)->plaintext));
                    $status = $row->find('span', 1)->plaintext;
                    $destination = $row->find('span', 2)->plaintext;
                    $insert = array(
                        'code_cross_check' => $code_cross_check,
                        'date_info' => $dateInfo,
                        'status' => $status,
                        'destination' => $destination
                    );
                    $input = array();
                    $input['where'] = ['code_cross_check' => $code_cross_check, 'date_info' => $dateInfo];
                    if (empty($this->viettel_log_model->load_all($input))) {
                        $this->viettel_log_model->insert($insert);
                    }
                }
            }
        }
    }

    public function pending3() {
	
        $this->load->helper('bill_helper');
        $this->load->model('call_log_model');
        $this->load->model('L7_check_model');
        $input = array();
        $input['select'] = 'code_cross_check';
        $input['where'] = array('cod_status_id' => _DANG_GIAO_HANG_, 'is_hide' => '0', 'provider_id' => 1);
		//,'date_print_cod >' => 1521910800
        $input['order'] = array('id' => 'asc');
		$input['limit']=[90,0];
		//$input['limit']=array('lm' => 2,'os'=> 2);
		//$input['OFFSET']=0;
        $contacts_1 = $this->contacts_model->load_all($input);
         $input['limit']=[90,90];
        $contacts_2 = $this->contacts_model->load_all($input);
        $all_code_cross_check_1 = [];
        $all_code_cross_check_2 = [];
        require_once APPPATH . 'libraries/simple_html_dom.php';
		$trackingText_1="";
        $trackingText_2 = '';	
        foreach ($contacts_1 as $value) {
            $trackingText_1 .= $value['code_cross_check'] . ',';
            $all_code_cross_check_1[] = $value['code_cross_check'];
        }
		 foreach ($contacts_2 as $value) {
            $trackingText_2 .= $value['code_cross_check'] . ',';
            $all_code_cross_check_2[] = $value['code_cross_check'];
        }
//var_dump($trackingText_1);
//var_dump($trackingText_2);
//echo count($contacts_1)+count($contacts_2);
//exit;
     //   echo $trackingText;
        	
        $html = file_get_html('https://www.viettelpost.com.vn/Tracking?KEY=' . $trackingText_1);
        //var_dump($html); exit;
       // echo $html;die;
       $rs = $html->find('div[id=dnn_ctr507_Main_ViewKQ_PanelList]', 0);
        $contact_warning = array();
        $contact_other = array();
        $contact_success = array();
        $contact_cancel = array();
        $contact_other_key = 0;
        $viettel_code_cross_check =array();
		
		
        foreach ($rs->find('tr') as $key => $row) {
            if ($key == 0) {
                continue;
            }
            $code_cross_check = trim($row->find('td', 0)->plaintext);
            $status_date = strtotime(str_replace('/', '-', trim($row->find('td', 4)->plaintext)));
            $status = trim($row->find('td', 5)->plaintext);
            $weight = trim($row->find('td', 6)->plaintext);
            $viettel_code_cross_check[] = $code_cross_check;
            if ($status == 'Thanh cong - phat thanh cong' || $status == 'Phát thành công') {
                $where = array('code_cross_check' => $code_cross_check);
                $data = array('cod_status_id' => _DA_THU_COD_, 'date_receive_cod' => time(), 'date_expect_receive_cod' => '0', 'last_activity' => time(),'customer_care_staff_id' => $this->_get_customer_care_id_auto(),'date_customer_care_handover' => time());
                $this->contacts_model->update($where, $data);
                $input_success = array();
                $input_success['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_success['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactSuccessArr = $this->contacts_model->load_all($input_success);
                foreach ($contactSuccessArr as $contactSuccess) {
                    $contact_success[] = $contactSuccess;
                }
            } else if ($status == 'Thanh cong chuyen tra nguoi gui' || $status == 'CHuyển trả người gửi' ||  $status == 'Chuyển hoàn bưu cục gốc') {
                $where = array('code_cross_check' => $code_cross_check);
                $data = array('cod_status_id' => _HUY_DON_, 'date_expect_receive_cod' => '0', 'date_receive_cancel_cod' => time(), 'last_activity' => time());
                $this->contacts_model->update($where, $data);
                $input_cancel = array();
                $input_cancel['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_cancel['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactCancelArr = $this->contacts_model->load_all($input_cancel);
                foreach ($contactCancelArr as $contactCancel) {
                    $contact_cancel[] = $contactCancel;
                }
            } else if ($status == 'Chờ duyệt Chuyển hoàn') {
                $input_warning = array();
                $input_warning['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_warning['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactWarningArr = $this->contacts_model->load_all($input_warning);
                foreach ($contactWarningArr as $contactWarning) {
                    $contact_warning[] = $contactWarning;
                }
            } else {
                $input_other = array();
                $input_other['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_other['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactOtherArr = $this->contacts_model->load_all($input_other);
                foreach ($contactOtherArr as $contactOther) {
                    $contact_other[$contact_other_key] = $contactOther;
                    $contact_other[$contact_other_key]['status_viettel'] = $status;
                    $contact_other_key++;
                }
            }

            if ($status == 'Thanh cong - phat thanh cong' || $status == 'Phát thành công' || $status == 'Thanh cong chuyen tra nguoi gui' || $status == 'CHuyển trả người gửi') {
                $input = array();
                $input['select'] = 'code_cross_check, price_purchase, name, phone, address, id';
                $input['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contact = $this->contacts_model->load_all($input);
                $contact_id = $contact[0]['id'];
                $name = $contact[0]['name'];
                $phone = $contact[0]['phone'];
                $address = $contact[0]['address'];
                $price_purchase = $contact[0]['price_purchase'];
                $insert = array('code' => $code_cross_check, 'status' => $status, 'weight' => $weight, 'status_date' => $status_date,
                    'contact_id' => $contact_id, 'name' => $name, 'phone' => $phone, 'address' => $address,
                    'price_purchase' => $price_purchase, 'time' => time(), 'L7_check' => 1);
                $this->L7_check_model->insert($insert);

                /*
                 * Cập nhật lịch sử chăm sóc
                 */
                if ($status == 'Thanh cong - phat thanh cong' || $status == 'Phát thành công') {
                    $cod_status_id = _DA_THU_COD_;
                }
                if ($status == 'Thanh cong chuyen tra nguoi gui' || $status == 'CHuyển trả người gửi') {
                    $cod_status_id = _HUY_DON_;
                }
                $param['contact_id'] = $contact_id;
                $param['staff_id'] = 33;
                $param['cod_status_id'] = $cod_status_id;
                $param['time'] = time();
                $this->call_log_model->insert($param);
            }
        }
		
		if(!empty($contacts_2)){
			
		$html = file_get_html('https://www.viettelpost.com.vn/Tracking?KEY=' . $trackingText_2);
       $rs = $html->find('div[id=dnn_ctr507_Main_ViewKQ_PanelList]', 0);
			        foreach ($rs->find('tr') as $key => $row) {
            if ($key == 0) {
                continue;
            }
            $code_cross_check = trim($row->find('td', 0)->plaintext);
            $status_date = strtotime(str_replace('/', '-', trim($row->find('td', 4)->plaintext)));
            $status = trim($row->find('td', 5)->plaintext);
            $weight = trim($row->find('td', 6)->plaintext);
            $viettel_code_cross_check[] = $code_cross_check;
            if ($status == 'Thanh cong - phat thanh cong' || $status == 'Phát thành công') {
                $where = array('code_cross_check' => $code_cross_check);
                $data = array('cod_status_id' => _DA_THU_COD_, 'date_receive_cod' => time(), 'date_expect_receive_cod' => '0', 'last_activity' => time());
                $this->contacts_model->update($where, $data);
                $input_success = array();
                $input_success['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_success['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactSuccessArr = $this->contacts_model->load_all($input_success);
                foreach ($contactSuccessArr as $contactSuccess) {
                    $contact_success[] = $contactSuccess;
                }
            } else if ($status == 'Thanh cong chuyen tra nguoi gui' || $status == 'CHuyển trả người gửi' ||  $status == 'Chuyển hoàn bưu cục gốc') {
                $where = array('code_cross_check' => $code_cross_check);
                $data = array('cod_status_id' => _HUY_DON_, 'date_expect_receive_cod' => '0', 'date_receive_cancel_cod' => time(), 'last_activity' => time());
                $this->contacts_model->update($where, $data);
                $input_cancel = array();
                $input_cancel['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_cancel['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactCancelArr = $this->contacts_model->load_all($input_cancel);
                foreach ($contactCancelArr as $contactCancel) {
                    $contact_cancel[] = $contactCancel;
                }
            } else if ($status == 'Chờ duyệt Chuyển hoàn') {
                $input_warning = array();
                $input_warning['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_warning['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactWarningArr = $this->contacts_model->load_all($input_warning);
                foreach ($contactWarningArr as $contactWarning) {
                    $contact_warning[] = $contactWarning;
                }
            } else {
                $input_other = array();
                $input_other['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_other['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contactOtherArr = $this->contacts_model->load_all($input_other);
                foreach ($contactOtherArr as $contactOther) {
                    $contact_other[$contact_other_key] = $contactOther;
                    $contact_other[$contact_other_key]['status_viettel'] = $status;
                    $contact_other_key++;
                }
            }

            if ($status == 'Thanh cong - phat thanh cong' || $status == 'Phát thành công' || $status == 'Thanh cong chuyen tra nguoi gui' || $status == 'CHuyển trả người gửi') {
                $input = array();
                $input['select'] = 'code_cross_check, price_purchase, name, phone, address, id';
                $input['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contact = $this->contacts_model->load_all($input);
                $contact_id = $contact[0]['id'];
                $name = $contact[0]['name'];
                $phone = $contact[0]['phone'];
                $address = $contact[0]['address'];
                $price_purchase = $contact[0]['price_purchase'];
                $insert = array('code' => $code_cross_check, 'status' => $status, 'weight' => $weight, 'status_date' => $status_date,
                    'contact_id' => $contact_id, 'name' => $name, 'phone' => $phone, 'address' => $address,
                    'price_purchase' => $price_purchase, 'time' => time(), 'L7_check' => 1);
                $this->L7_check_model->insert($insert);

                /*
                 * Cập nhật lịch sử chăm sóc
                 */
                if ($status == 'Thanh cong - phat thanh cong' || $status == 'Phát thành công') {
                    $cod_status_id = _DA_THU_COD_;
                }
                if ($status == 'Thanh cong chuyen tra nguoi gui' || $status == 'CHuyển trả người gửi') {
                    $cod_status_id = _HUY_DON_;
                }
                $param['contact_id'] = $contact_id;
                $param['staff_id'] = 33;
                $param['cod_status_id'] = $cod_status_id;
                $param['time'] = time();
                $this->call_log_model->insert($param);
            }
        }
			
		}
		
		
		
		$all_code_cross_check = array_merge($all_code_cross_check_1, $all_code_cross_check_2);
        $vietel_not_send = array_diff($all_code_cross_check, $viettel_code_cross_check);
        $contact_not_send = array();
        if (!empty($vietel_not_send)) {

            $vietel_not_send = ReArrangeBillCheck($vietel_not_send);

            foreach ($vietel_not_send as $code_cross_check) {
                $input_not_send = array();
                $input_not_send['select'] = 'id, name, email, phone, address, price_purchase, date_rgt, code_cross_check';
                $input_not_send['where'] = array('code_cross_check' => $code_cross_check, 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
                $contact_not_send[] = $this->contacts_model->load_all($input_not_send)[0];
            }
        }

		
		
		
		
		
		
		
		
        $data_load = [];
        $data_load['total_contacts'] = count($contacts_1)+count($contacts_2);
        $data_load['contacts'] = ($contact_warning);
        $data_load['contact_other'] = ($contact_other);
        $data_load['contact_success'] = ($contact_success);
        $data_load['contact_cancel'] = ($contact_cancel);
        $data_load['contact_not_send'] = $contact_not_send;
                //ReArrangeContactsByBillCheck($contact_not_send);
        $str = $this->load->view('cod/waiting_cancel_list/index', $data_load, true);
        //$emailTo = 'chuyenpn@lakita.vn';
        $emailTo = ' ngoccongtt1@gmail.com, trinhnv@lakita.vn, tund@bkindex.com, hoangthuy100995@gmail.com, lakitavn@gmail.com';
        $this->load->library("email");
        $this->email->from('cskh@lakita.vn', "lakita.vn");
        $this->email->to($emailTo);
        $this->email->subject('BÁO CÁO COD NGÀY ' . date('d-m-Y') . ' (BY CLI & CRON JOB)');
        $this->email->message($str);
        $this->email->send();
    }

    public function pending4() {

        $contacts_1 = array();
        $contacts_2 = array();
        $contact_warning = array( 0 => array('id' => '', 'name' => '', 'phone' => '', 'address' => '', 'code_cross_check' => ''));
        $contact_other = array( 0 => array('id' => '', 'name' => '', 'phone' => '', 'address' => '', 'code_cross_check' => '', 'status_viettel' => ''));
        $contact_success = array( 0 => array('id' => '', 'name' => '', 'phone' => '', 'address' => '', 'code_cross_check' => '', 'price_purchase' => 0));
        $contact_cancel = array( 0 => array('id' => '', 'name' => '', 'phone' => '', 'address' => '', 'code_cross_check' => '', 'date_rgt' => 0));
        $contact_not_send = array( 0 => array('id' => 1, 'name' => 'a', 'phone' => 'a', 'address' => 'a', 'code_cross_check' => 'a'));
        
        $data_load = [];
        $data_load['total_contacts'] = count($contacts_1) + count($contacts_2);
        $data_load['contacts'] = ($contact_warning);
        $data_load['contact_other'] = ($contact_other);
        $data_load['contact_success'] = ($contact_success);
        $data_load['contact_cancel'] = ($contact_cancel);
        $data_load['contact_not_send'] = $contact_not_send;
        //ReArrangeContactsByBillCheck($contact_not_send);
       
        $str = $this->load->view('cod/waiting_cancel_list/index', $data_load, true);
        //$emailTo = 'thanhloc1302@gmail.com';
        $emailTo = 'ngoccongtt1@gmail.com, trinhnv@lakita.vn, tund@bkindex.com, hoangthuy100995@gmail.com, lakitavn@gmail.com';
        $this->load->library("email");
         $this->email->from('cskh@lakita.vn', "lakita.vn");
        // $this->email->from('thanhloc.aka.mrb1302@gmail.com', "lakita.vn");
        $this->email->to($emailTo);
        $this->email->subject('BÁO CÁO COD VNPOST NGÀY ' . date('d-m-Y') . ' (BY CLI & CRON JOB)');
        $this->email->message($str);
        $this->email->send();
    }
    
    function send_report_product_daily() {
        $get = [];
        $input = array();
        $this->load->model('courses_model');
        $courses = $this->courses_model->load_all($input);

        $conditionArr = array(
            'L1' => array(
                'where' => array('date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L2' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L6' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L8' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_, 'date_handover >=' => strtotime(date("d-m-Y"))),
                'sum' => 0
            ),
            'L1_luyke' => array(
                'where' => array('date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'L2_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'L6_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
            'L8_luyke' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_, 'date_handover >=' => strtotime(date("1-m-Y"))),
                'sum' => 0
            ),
        );

        foreach ($courses as $key => $value) {
            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                $conditional['where']['course_code'] = $value['course_code'];
                foreach ($value2['where'] as $key3 => $value3) {
                    $conditional['where'][$key3] = $value3;
                }
                $courses[$key][$key2] = $this->_query_for_report($get, $conditional);
                $conditionArr[$key2]['sum'] += $courses[$key][$key2];
            }
        }

        // print_arr($conditionArr);

        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }

        $data['courses'] = $courses;
        $this->load->view('report/send_report_product_daily', $data);
    }

    function view_general_report() {
        $this->load->helper('manager_helper');
        $input = array();
        $input['where'] = array('active' => '1');
        $this->load->model('courses_model');
        $courses = $this->courses_model->load_all($input);
        $get = [];
        
        $today = strtotime(date("d-m-Y"));
        $thisMonth = strtotime(date("01-m-Y"));
        $endDate = time();//strtotime(date("14-01-2018"));
        $conditionArr = array(
            'L1_td' => array(
                'where' => array('date_handover >=' => ($today)),
                'sum' => 0
            ),
            'L2_td' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >=' => ($today)),
                'sum' => 0
            ),
            'L6_td' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_, 'date_handover >=' => ($today)),
                'sum' => 0
            ),
            'L1' => array(
                'where' => array('date_handover >=' => $thisMonth, 'date_handover <=' => $endDate),
                'sum' => 0
            ),
            'L2' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'date_handover >=' => $thisMonth, 'date_handover <=' => $endDate),
                'sum' => 0
            ),
            'L6' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_
                    , 'date_handover >=' => $thisMonth,  'date_handover <=' => $endDate),
                'sum' => 0
            ),
            'L8' => array(
                'where' => array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
                    'cod_status_id' => _DA_THU_LAKITA_, 'date_handover >=' => $thisMonth, 'date_handover <=' => $endDate),
                'sum' => 0
            )
        );

        $sumL8 = 0;
        foreach ($courses as $key => $value) {

            /*
             * Tính số L1, L2, L6, L8 theo từng khóa học
             */

            foreach ($conditionArr as $key2 => $value2) {
                $conditional = array();
                $conditional['where']['course_code'] = $value['course_code'];
                if (isset($value2['where'])) {
                    foreach ($value2['where'] as $key3 => $value3) {
                        $conditional['where'][$key3] = $value3;
                    }
                }
                $courses[$key][$key2] = $this->_query_for_report($get, $conditional);
                $conditionArr[$key2]['sum'] += $courses[$key][$key2];
            }

//            if ($courses[$key]['L1'] == 0 || $courses[$key]['L1_td'] == 0) {
//                unset($courses[$key]);
//                continue;
//            }

            $courses[$key]['L2/L1_td'] = ($courses[$key]['L1_td'] != 0) ? round(($courses[$key]['L2_td'] / $courses[$key]['L1_td']) * 100, 2) . '%' : 'Không thể chia cho 0';
            $courses[$key]['L6/L2_td'] = ($courses[$key]['L2_td'] != 0) ? round(($courses[$key]['L6_td'] / $courses[$key]['L2_td']) * 100, 2) . '%' : 'Không thể chia cho 0';

            $courses[$key]['L2/L1'] = ($courses[$key]['L1'] != 0) ? round(($courses[$key]['L2'] / $courses[$key]['L1']) * 100, 2) . '%' : 'Không thể chia cho 0';
            $courses[$key]['L6/L2'] = ($courses[$key]['L2'] != 0) ? round(($courses[$key]['L6'] / $courses[$key]['L2']) * 100, 2) . '%' : 'Không thể chia cho 0';
            $courses[$key]['L8/L6'] = ($courses[$key]['L6'] != 0) ? round(($courses[$key]['L8'] / $courses[$key]['L6']) * 100, 2) . '%' : 'Không thể chia cho 0';
            $courses[$key]['L8/L1'] = ($courses[$key]['L1'] != 0) ? round(($courses[$key]['L8'] / $courses[$key]['L1']) * 100, 2) . '%' : 'Không thể chia cho 0';


            /*
             * Tính doanh thu theo từng khóa học
             */
            $conditional = array();
            $conditional['select'] = 'course_code, cod_status_id, price_purchase';
            $conditional['where']['date_handover >='] = $thisMonth;
            $conditional['where']['date_handover <='] = $endDate;
            $conditional['where']['course_code'] = $value['course_code'];
            $conditional['where']['cod_status_id'] = _DA_THU_LAKITA_;
            $_L8 = $this->contacts_model->load_all($conditional);
            $money = sum_L8($_L8);
            $courses[$key]['sumL8'] = number_format($money, 0, ",", ".") . " VNĐ";
            $sumL8 += $money;
        }
        // echo $this->db->last_query();

        foreach ($conditionArr as $key => $value) {
            $data[$key] = $value['sum'];
        }
        $data['sumL8'] = $sumL8;

        $data['content'] = 'report/view_general_report';

        // $this->load->view('report/view_general_report', $data);

        usort($courses, function($a, $b) {
            return $a['L1'] - $b['L1'];
        });

        foreach ($courses as $key => $course) {
            if ($course['L1'] == 0) {
                unset($courses[$key]);
            }
        }
        $data['courses'] = $courses;
        $str = $this->load->view('report/view_general_report', $data, true);
        $this->load->library("email");
        $this->email->from('cskh@lakita.vn', "lakita.vn");
        //$emailTo = 'chuyenbka@gmail.com';
        $emailTo = 'chuyenbka@gmail.com, ngoccongtt1@gmail.com, trinhnv@lakita.vn, tund@bkindex.com, hoangthuy100995@gmail.com';
        $this->email->to($emailTo);
        $this->email->subject('Báo cáo tổng hợp ngày ' . date('d-m-Y') . ' (by cron job)');
        $this->email->message($str);
        $this->email->send();
    }

    function json_pivot_table() {
        $this->load->model('call_status_model');
        $this->load->model('ordering_status_model');
        $this->load->model('cod_status_model');
        $this->load->model('providers_model');
        $this->load->model('payment_method_rgt_model');
        $input = array();
        $input['select'] = 'call_status_id, ordering_status_id, cod_status_id, sale_staff_id, course_code, '
                . 'provider_id, date_rgt, price_purchase, payment_method_rgt, date_receive_lakita';
        $input['where'] = array('date_rgt >=' => 1483203600, 'is_hide' => '0');
        $test = $this->contacts_model->load_all($input);
        $rs = [];
        foreach ($test as $key => $value) {
            $rs[$key]['C3'] = '1';
            $rs[$key]['L2'] = ($value['call_status_id'] == 4) ? '1' : '0';
            $rs[$key]['L6'] = ($value['ordering_status_id'] == 4) ? '1' : '0';
            $rs[$key]['L7'] = ($value['cod_status_id'] == 2) ? '1' : '0';
            $rs[$key]['L7L8'] = ($value['cod_status_id'] == 3 || $value['cod_status_id'] == 2) ? '1' : '0';
            $rs[$key]['L8'] = ($value['cod_status_id'] == 3) ? '1' : '0';
            $rs[$key]['TVTS'] = $this->staffs_model->find_staff_name($value['sale_staff_id']);
            $rs[$key]['Mã khóa học'] = $value['course_code'];
            //  $rs[$key]['Trạng thái gọi'] = $this->call_status_model->find_call_status_desc($value['call_status_id']);
            //$rs[$key]['Trạng thái đơn hàng'] = $this->ordering_status_model->find_ordering_status_desc($value['ordering_status_id']);
            //$rs[$key]['Trạng thái giao hàng'] = $this->cod_status_model->find_cod_status_desc($value['cod_status_id']);
            $rs[$key]['Đơn vị giao hàng'] = $this->providers_model->find_provider_name($value['provider_id']);
            $rs[$key]['Tháng đăng ký'] = date('Y-m', $value['date_rgt']);
            $rs[$key]['Tháng nhận tiền'] = date('Y-m', $value['date_receive_lakita']);
            $rs[$key]['Ngày đăng ký'] = date('Y-m-d', $value['date_rgt']);
            $rs[$key]['Giá mua khóa học'] = ($value['price_purchase']);
            $rs[$key]['Hinh thức thanh toán'] = $this->payment_method_rgt_model->find_payment_method_rgt_desc($value['payment_method_rgt']);
        }
        echo $response = json_encode($rs);
        die;
        $fp = fopen(APPPATH . '../public/results.json', 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);
        die;
    }

    function json_pivot_table_2($offset = 0) {
        $get = $this->input->get();
        $this->load->model('call_status_model');
        $this->load->model('ordering_status_model');
        $this->load->model('cod_status_model');
        $this->load->model('providers_model');
        $this->load->model('payment_method_rgt_model');
        $conditional['select'] = 'phone, cod_status_id, sale_staff_id, course_code, '
                . 'provider_id, date_rgt, price_purchase, payment_method_rgt, date_receive_lakita';
        if ((isset($get['filter_date_date_rgt']) && $get['filter_date_date_rgt'] == '')) {
            $conditional['where'] = array('date_rgt >=' => strtotime(date('Y-m-01 00:00:00')), 'cod_status_id' => 3, 'is_hide' => '0');
        } else {
            $conditional['where'] = array('cod_status_id' => 3, 'is_hide' => '0');
        }
        $data_pagination = $this->_query_all_from_get($get, $conditional, 10000, $offset);
        $contacts = $data_pagination['data'];
        $rs = [];
        foreach ($contacts as $key => $value) {
            $rs[$key]['TVTS'] = $this->staffs_model->find_staff_name($value['sale_staff_id']);
            $rs[$key]['Mã khóa học'] = $value['course_code'];
            $rs[$key]['Ngày đăng ký'] = date('Y-m-d', $value['date_rgt']);
            $rs[$key]['Giá mua khóa học'] = ($value['price_purchase']);
        }
        echo json_encode($rs);
        die;
    }

   

    public function GetContactReceiveCodTomorrow() {
        $this->load->model('cod_status_model');
        $input = [];
        $data_load['cod_status'] = $this->cod_status_model->load_all($input);
        $today = strtotime(date('d-m-Y'));
        $tomorrow = $today + 24 * 3600 - 1;
        $input = array();
        $input['select'] = 'id, name, phone, address, course_code, cod_status_id, date_expect_receive_cod, code_cross_check';
        $input['where'] = array("((`date_expect_receive_cod` >= $today AND `date_expect_receive_cod` <= $tomorrow AND `cod_status_id` = '0') "
            . "OR (`date_expect_receive_cod` > 0 AND `date_expect_receive_cod` <= $tomorrow AND `cod_status_id` = '1'))" => 'NO-VALUE');
        $contacts = $this->contacts_model->load_all($input);
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
        $data_load['total_contacts'] = count($contacts);
        $data_load['contacts'] = $contacts;
        $str = $this->load->view('CODS/contact-expect-receive-cod/index', $data_load, true);
        if (!empty($contacts)) {
            $emailTo = 'chuyenpn@lakita.vn, ngoccongtt1@gmail.com, trinhnv@lakita.vn, lakitavn@gmail.com';
            $this->load->library("email");
            $this->email->from('cskh@lakita.vn', "lakita.vn");
            $this->email->to($emailTo);
            $this->email->subject('CONTACT DỰ KIẾN GIAO HÀNG VÀ YÊU CẦU PHÁT LẠI VÀO HÔM NAY (BY CLI & CRON JOB)');
            $this->email->message($str);
            $this->email->send();
        }
    }

    public function UpdateCampaignAccountFb() {
        $this->load->model('campaign_model');
        $input = [];
        // $input['where'] = ['active' => '1'];
        $campaigns = $this->campaign_model->load_all($input);
        foreach ($campaigns as $campaign) {
            if ($campaign['campaign_id_facebook'] != '') {
                $url = 'https://graph.facebook.com/v3.1/' . $campaign['campaign_id_facebook'] . '?fields=account_id&access_token=' . ACCESS_TOKEN;
                $spend = get_fb_request($url);
                if (!empty($spend)) {
                    $where = array('campaign_id_facebook' => $spend->id);
                    $data = array('account_fb_id' => $spend->account_id);
                    $this->campaign_model->update($where, $data);
                }
            }
        }
    }

    public function UpdateAdsetAccountFb() {
        $this->load->model('adset_model');
        $input = [];
        // $input['where'] = ['active' => '1'];
        $campaigns = $this->adset_model->load_all($input);
        foreach ($campaigns as $campaign) {
            if ($campaign['adset_id_facebook'] != '') {
                $url = 'https://graph.facebook.com/v3.1/' . $campaign['adset_id_facebook'] . '?fields=account_id&access_token=' . ACCESS_TOKEN;
                $spend = get_fb_request($url);
                if (!empty($spend)) {
                    $where = array('adset_id_facebook' => $spend->id);
                    $data = array('account_fb_id' => $spend->account_id);
                    $this->adset_model->update($where, $data);
                }
            }
        }
    }

    public function UpdateAdAccountFb() {
        $this->load->model('ad_model');
        $input = [];
        // $input['where'] = ['active' => '1'];
        $campaigns = $this->ad_model->load_all($input);
        foreach ($campaigns as $campaign) {
            if ($campaign['ad_id_facebook'] != '') {
                $url = 'https://graph.facebook.com/v3.1/' . $campaign['ad_id_facebook'] . '?fields=account_id&access_token=' . ACCESS_TOKEN;
                $spend = get_fb_request($url);
                if (!empty($spend)) {
                    $where = array('ad_id_facebook' => $spend->id);
                    $data = array('account_fb_id' => $spend->account_id);
                    $this->ad_model->update($where, $data);
                }
            }
        }
    }

    public function UpdateCampaignChannel() {
        $this->load->model('campaign_model');
        $this->load->model('adset_model');
        $input = [];
        $campaigns = $this->campaign_model->load_all($input);
        foreach ($campaigns as $campaign) {
            $input = [];
            $input['select'] = 'id';
            $input['where'] = array('campaign_id' => $campaign['id']);
            $adsets = $this->adset_model->load_all($input);
            foreach($adsets as $adset){
                $where = array('id' => $adset['id']);
                $data = array('channel_id' => $campaign['channel_id']);
                $this->adset_model->update($where, $data);
            }
        }
    }
     public function UpdateAdsetChannel() {
        $this->load->model('adset_model');
        $this->load->model('ad_model');
        $input = [];
        $adsets = $this->adset_model->load_all($input);
        foreach ($adsets as $adset) {
            $input = [];
             $input['select'] = 'id';
            $input['where'] = array('adset_id' => $adset['id']);
            $ads = $this->ad_model->load_all($input);
            foreach($ads as $ad){
                $where = array('id' => $ad['id']);
                $data = array('channel_id' => $adset['channel_id']);
                $this->ad_model->update($where, $data);
            }
        }
    }

}
