<?php

class Api extends CI_Controller {

    function get_contact() {


        $this->load->model('Contacts_model');
        $get = $this->input->get();

        $input['select'] = 'id, name, email, phone, course_code, price_purchase, date_rgt, date_receive_lakita, date_receive_cod, cod_status_id';

        $input['where'] = array('date_rgt >' => $get['start_date'], 'date_rgt <' => $get['end_date'], 'cod_status_id >' => 1, 'cod_status_id <' => 4);


        $input['order'] = array('date_rgt' => 'desc');

        $contact = $this->Contacts_model->load_all($input);

        echo json_encode($contact);
    }

    function get_contact_and_contact_active() {


        $this->load->model('Contacts_model');
        $get = $this->input->get();
        //contact đã mua
        $input = array();
        $input['select'] = 'id, name, email, phone, course_code, price_purchase, date_rgt, date_receive_lakita, date_receive_cod, cod_status_id, id_lakita';
        $input['where'] = array('date_rgt >' => $get['start_date'], 'date_rgt <' => $get['end_date'], 'cod_status_id >' => 1, 'cod_status_id <' => 4);
        $input['order'] = array('date_rgt' => 'desc');

        $contact_bought = $this->Contacts_model->load_all($input);
        //contact đã kích hoạt
        $input['where'] = array('date_rgt >' => $get['start_date'], 'date_rgt <' => $get['end_date'], 'cod_status_id >' => 1, 'cod_status_id <' => 4, 'id_lakita' => '');
        $contact_active = $this->Contacts_model->load_all($input);


        //contact mua trên 2 khóa
        $this->load->model('contacts_model');
        $input = array();
        $input['select'] = 'name,email,date_rgt,phone,count(phone)';
        $input['where']['date_rgt >'] = $get['start_date'];
        $input['where']['date_rgt <'] = $get['end_date'];
        $input['where']['duplicate_id'] = '';
        $input['where']['is_hide'] = '0';
        $input['where']['ordering_status_id'] = 4;
        $input['where']['cod_status_id >'] = 1;
        $input['where']['cod_status_id <'] = 4;
        $input['group_by'] = array('phone');
        $input['having']['count(phone) >'] = 1;
        $contact_2courses = $this->contacts_model->load_all($input);

        //contact mua lại 
        $contact_re_buy = array();
        foreach ($contact_2courses as $value) {
            $input = '';
            $input['select'] = 'id';
            $input['where']['phone'] = $value['phone'];
            $input['where']['is_hide'] = '0';
            $input['where']['date_rgt <'] = $value['date_rgt'] - 172800;
            $input['where']['duplicate_id'] = '';
            $input['where']['ordering_status_id'] = 4;
            $input['where']['cod_status_id >'] = 1;
            $input['where']['cod_status_id <'] = 4;
            $input['order'] = array('id' => 'desc');
            $contact = '';
            $contact = $this->contacts_model->load_all($input);
            $count = count($contact);
            if ($count) {
                $contact_re_buy[] = $value;
            }
        }

        $result = array('da_mua' => $contact_bought,
            'da_kich_hoat' => $contact_active,
            'mua_tren_2' => $contact_2courses,
            'mua_lai' => $contact_re_buy
        );
        echo json_encode($result);
    }

    function get_id_lakita() {

 
        $input = [];
        $input['select'] = 'id,email,phone,course_code,date_rgt';
        $input['where'] = array('cod_status_id >' => 1, 'cod_status_id <' => 4, 'id_lakita' => '');
        $input['order'] = array('date_rgt' => 'desc');
        $input['limit'] = array(500,2500);
        $contact = $this->contacts_model->load_all($input);
        echo '<pre>';
     //   print_r($contact);die;
        $list_contact = array();
        foreach ($contact as $value) {
            $result = '';
            $result = file_get_contents('https://lakita.vn/api/check_exit_email?email=' . $value['email'] . '&phone=' . $value['phone'] . '&course_code=' . $value['course_code'] . '&date_rgt=' . $value['date_rgt']);
            $result = json_decode($result, true);
            
            if ($result['error'] == '0' && $result['active'] != 'FALSE') {
                $list_contact[] = $result;
                $where = array('id' => $value['id']);
                $data = array('id_lakita' => $result['active'][0]['id_lakita'], 'date_active' => $result['active'][0]['date_active'], 'customer_care_staff_id' => '');
                $this->contacts_model->update($where, $data);
            }
        }
        echo '<pre>';
        print_r($list_contact);

        echo '<script>alert("xong");</script>';
    }
    
    function update_id_lakita() {
        $post = $this->input->get();

//
//        $where = array('email' => $post['email'], 'phone' => $post['phone'], 'course_code' => $post['course_code']);
//        $data = array('id_lakita' => $post['id_lakita'], 'date_active' => $post['date_active']);
//        $this->contacts_model->update($where, $data);


        $input['select'] = 'id';
        $input['where'] = array('email' => $post['email'],
            'phone' => $post['phone'],
            'course_code' => $post['course_code'],
            'cod_status_id >' => 1,
            'cod_status_id <' => 4,
            'duplicate_id' => '0',
            'is_hide' => '0',
            'id_lakita' => '0');
        $contact = $this->contacts_model->load_all($input);
        if (empty($contact)) {
            $input['where'] = array('phone' => $post['phone'],
                'course_code' => $post['course_code'],
                'cod_status_id >' => 1,
                'cod_status_id <' => 4,
                'duplicate_id' => '',
                'is_hide' => '0',
                'id_lakita' => '');
            $contact = '';
            $contact = $this->contacts_model->load_all($input);
          
            if (empty($contact)) {
                $input['where'] = array('email' => $post['email'],
                    'course_code' => $post['course_code'],
                    'cod_status_id >' => 1,
                    'cod_status_id <' => 4,
                    'duplicate_id' => '',
                    'is_hide' => '0',
                    'id_lakita' => '');
                $contact = '';
                $contact = $this->contacts_model->load_all($input);
                echo 123;
                if (!empty($contact)) {
                    $where = array('id' => $contact[0]['id']);
                    $data = array('id_lakita' => $post['id_lakita'], 'date_active' => $post['date_active'],'customer_sale_staff_id' => 0);
                    $this->contacts_model->update($where, $data);
                }
            } else {
                $where = array('id' => $contact[0]['id']);
                $data = array('id_lakita' => $post['id_lakita'], 'date_active' => $post['date_active'],'customer_care_staff_id' => 0);
                $this->contacts_model->update($where, $data);
            }
        } else {
            $where = array('id' => $contact[0]['id']);
            $data = array('id_lakita' => $post['id_lakita'], 'date_active' => $post['date_active'],'customer_sale_staff_id' => 0);
            $this->contacts_model->update($where, $data);
        }
    }

}
