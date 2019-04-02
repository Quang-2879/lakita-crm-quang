<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Send_email
 *
 * @author phong
 */
class Send_email extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function send_banking_info() {
        $post = $this->input->post();
        $result = array('success' => 0, 'message' => '');
        if (!empty($post)) {
            $email = $post['email'];
            //$emailCheck = json_decode(file_get_contents('http://api.lakita.vn/email/check?email=' . $email));
//if (!$emailCheck->result) {
            //    $result['message'] = 'Không tồn tại email này!';
            //    echo json_encode($result);
            //    die;
//}
            $content = $this->load->view('email_template/send_banking_info', $post, TRUE);
            //gửi email
            $this->load->library("email");
            $this->email->from('lakitacskh@gmail.com', "lakita@cskh");
            $this->email->to($post['email']);
            $this->email->subject('THÔNG TIN CHUYỂN KHOẢN LAKITA');
            $this->email->message($content);
            $this->email->send();

            //cập nhật đã gửi mail
            if (isset($post['contact_id'])) {
                $where = array('id' => $post['contact_id']);
            } else {
                $where = array('email' => $post['email']);
            }
            $data = array('send_banking_info' => 1);
            $this->contacts_model->update($where, $data);
            $result['success'] = 1;
        }
        echo json_encode($result);
    }

    public function send_account_lakita() {
        $post = $this->input->post();
        if (!empty($post) && isset($post['contact_id'])) {
            $this->db->select('name, course_code, email, phone, payment_method_rgt');
            $contacts = $this->contacts_model->find($post['contact_id']);
            if (!empty($contacts)) {
                $contact = $contacts[0];
                switch ($contact['course_code']) {
                    case 'KT610':
                        $contact['course_code'] = 'KT240';
                        break;
                    case 'KT620':
                        $contact['course_code'] = 'KT270';
                        break;
                    case 'KT630':
                        $contact['course_code'] = 'KT280';
                        break;
                    case 'KT460':
                        $contact['course_code'] = 'KT290';
                        break;
                    default:
                        break;
                }
                if (empty($post['email_send_lakita'])) {
                    $email = $contact['email'];
                } else {
                    $email = trim($post['email_send_lakita']);
                    $contact['email'] = $email;
                }

                if (!empty($post['phone_send_lakita'])) {
                    $phone = trim($post['phone_send_lakita']);
                    $contact['phone'] = $phone;
                }
                if ($contact['name'] == '' || $contact['email'] == '' || $contact['phone'] == '') {
                    $result = [];
                    $result['success'] = 0;
                    $result['message'] = 'Contact đã chọn không có tên hoặc số đt hoặc địa chỉ!  Vui lòng cập nhật thông tin khách hàng đầy đủ.';
                    echo json_encode($result);
                    die;
                }
//                $emailCheck = json_decode(file_get_contents('http://api.lakita.vn/email/check?email=' . $email));
//                if (!$emailCheck->result) {
//                    $result = [];
//                    $result['success'] = 0;
//                    $result['message'] = 'Không tồn tại email này!';
//                    echo json_encode($result);
//                    die;
//                }

                //tạo tài khoản
                $client = $this->_create_account_lakita($contact);
                //  print_arr($client);
                if ($client->success != 0) {
                    $contact['password'] = $client->password;
                    $content = $this->load->view('email_template/send_account_lakita', $contact, TRUE);

                    //gửi email
                    $this->load->library("email");
                    if ($this->role == 10) {
                        $this->email->from('lakitacskh@gmail.com', "lakita@cskh");
                    } else {
                        $this->email->from('lakitacskh@gmail.com', "lakita@cskh");
                    }
                    $this->email->to($contact['email']);
                    $this->email->subject('V/v: Thông báo tài khoản học tập và cách thức học tập trên hệ thống Lakita.vn');
                    $this->email->message($content);
                    $this->email->send();

                    //cập nhật đã gửi mail 
                    $id_lakita = $client->id_lakita;
                    $where = array('id' => $post['contact_id']);
                    $data = array('send_account_lakita' => 1, 'id_lakita' => $id_lakita, 'date_active' => time());
                    $this->contacts_model->update($where, $data);
                    echo json_encode($client);
                } else {
                    $id_lakita = $client->id_lakita;
                    $where = array('id' => $post['contact_id']);
                    $data = array('id_lakita' => $id_lakita);
                    $this->contacts_model->update($where, $data);
                    echo json_encode($client);
                }
            }
        }
    }

    public function SendLakitaAccountComboCourse() {
        $post = $this->input->post();
        $result = [];
        if (isset($post['contact_id']) && count($post['contact_id']) > 1) {
            $courseCode = [];
            $contactTmp = [];
            foreach ($post['contact_id'] as $contactId) {
                /*
                 * Kiểm tra xem các contact đã cập nhật lên L8 chưa, nếu chưa thì báo lỗi
                 */
                $input = [];
                $input['select'] = 'cod_status_id, course_code, email, phone, name, payment_method_rgt';
                $input['where'] = array('id' => $contactId);
                $contactTmp = $this->contacts_model->load_all($input);
                $courseCode[] = $contactTmp[0]['course_code'];
                if ($contactTmp[0]['payment_method_rgt'] == PAYMENT_METHOD_COD) {
                    $result['success'] = 0;
                    $result['message'] = 'Chỉ contact mua bằng chuyển khoản mới có thể tạo tài khoản tự động!';
                    echo json_encode($result);
                    die;
                }
                
                if($this->role_id == 10){
                    if ($contactTmp[0]['cod_status_id'] != _DA_THU_COD_ || $contactTmp[0]['cod_status_id'] != _DA_THU_LAKITA_) {
                        $result['success'] = 0;
                        $result['message'] = 'Chỉ contact đã nhận COD mới có thể tạo tài khoản tự động!';
                        echo json_encode($result);
                        die;
                    }
                }

                if ($contactTmp[0]['name'] == '' || $contactTmp[0]['email'] == '' || $contactTmp[0]['phone'] == '') {
                    //$result = [];
                    $result['success'] = 0;
                    $result['message'] = 'Contact đã chọn không có tên hoặc số đt hoặc địa chỉ! Vui lòng cập nhật thông tin khách hàng đầy đủ.';
                    echo json_encode($result);
                    die;
                }

                $email = $contactTmp[0]['email'];
                $emailCheck = json_decode(file_get_contents('http://api.lakita.vn/email/check?email=' . $email));
                if (!$emailCheck->result) {
                    $result['success'] = 0;
                    $result['message'] = 'Không tồn tại email này!';
                    echo json_encode($result);
                    die;
                }
            }
            $contact = [];
            $contact['name'] = $contactTmp[0]['name'];
            $contact['phone'] = $contactTmp[0]['phone'];
            $contact['email'] = $contactTmp[0]['email'];
            $contact['course_code'] = $courseCode;

            $client = $this->_create_account_lakita($contact);
            if ($client->success != 0) {
                $contact['password'] = $client->password;
                $content = $this->load->view('email_template/send_account_lakita', $contact, TRUE);

                //gửi email
                $this->load->library("email");
                $this->email->from('lakitacskh@gmail.com', "lakita@cskh");
                $this->email->to($contact['email']);
                $this->email->subject('V/v: Thông báo tài khoản học tập và cách thức học tập trên hệ thống Lakita.vn');
                $this->email->message($content);
                $this->email->send();
                //cập nhật đã gửi mail
                foreach ($post['contact_id'] as $contactId) {
                    $id_lakita = $client->id_lakita;
                    $where = array('id' => $contactId);
                    $data = array('send_account_lakita' => 1, 'id_lakita' => $id_lakita, 'date_active' => time());
                    $this->contacts_model->update($where, $data);
                }
                echo json_encode($client);
            } else {
                foreach ($post['contact_id'] as $contactId) {
                    $id_lakita = $client->id_lakita;
                    $where = array('id' => $contactId);
                    $data = array('id_lakita' => $id_lakita, 'date_active' => time());
                    $this->contacts_model->update($where, $data);
                }
                echo json_encode($client);
            }
        }
    }

    private function _create_account_lakita($contact) {
        require_once APPPATH . "libraries/Rest_Client.php";
        $config = array(
            'server' => 'https://lakita.vn/',
            'api_key' => 'RrF3rcmYdWQbviO5tuki3fdgfgr4',
            'api_name' => 'lakita-key'
        );
        $restClient = new Rest_Client($config);
        $uri = "account_api/create_new_account";
        $client = $restClient->post($uri, $contact);
        return $client;
    }

    private function createAccountLakitaCombo($contact) {
        require_once APPPATH . "libraries/Rest_Client.php";
        $config = array(
            'server' => 'https://lakita.vn/',
            'api_key' => 'RrF3rcmYdWQbviO5tuki3fdgfgr4',
            'api_name' => 'lakita-key'
        );
        $restClient = new Rest_Client($config);
        $uri = "account_api/create_new_account";
        $client = $restClient->post($uri, $contact);
        return $client;
    }

}
