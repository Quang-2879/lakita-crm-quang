<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author Beto
 */
class Test1 extends CI_Controller {

    function index() {
        
    }
    
    function test2(){
        $day = '01-03-2018';
        $today = strtotime(date('d-m-Y', strtotime($day))); //tính theo giờ Mỹ
        $today_fb_format = date('Y-m-d', strtotime($day));
        
        $url = 'https://graph.facebook.com/v2.11/23842872586490362' .
                        '/insights?fields=spend,reach,outbound_clicks&level=account'
                        . '&time_range={"since":"' . $today_fb_format . '","until":"' . $today_fb_format . '"}&access_token=' . ACCESS_TOKEN;
                $spend = get_fb_request($url);
                 $param['time'] = $today;
              //  $param['campaign_id'] = $value['id'];
                $param['spend'] = isset($spend->data[0]->spend) ? $spend->data[0]->spend : 0;
                $param['total_C1'] = isset($spend->data[0]->reach) ? $spend->data[0]->reach : 0;
                $param['total_C2'] = isset($spend->data[0]->outbound_clicks[0]->value) ? $spend->data[0]->outbound_clicks[0]->value : 0;
                echo '<pre>';
                print_r($spend);
                 var_dump($param);die;
    }
            
    function get_mkt() {
        $this->load->model('staffs_model');
        $input['select'] = 'id,name';
        $input['where'] = array('role_id' => 6, 'active' => 1);
        $input['order'] = array('id' => 'asc');
        $mkt = $this->staffs_model->load_all($input);
        echo json_encode($mkt);
    }

    function test() {
        $input['select'] = 'phone,email,course_code';
        $input['where'] = array(
            'date_rgt >' => 1519862400,
            'date_rgt <' => 1522454400,
            'is_hide' => '0',
            'duplicate_id' => '',
            'ordering_status_id' => 4
        );
        $input['group_by'] = array('phone');
        $input['having'] = array('count(id) >' => 1);
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
                    if ($contact[$i]['date_rgt'] - $contact[$i + 1]['date_rgt'] < 172800) {
                        $contact_re_buy[] = $contact[$i];
                    }
                }
            }
        }
        
        echo '<pre>';
        
        print_r($contact_re_buy);
    }

}
