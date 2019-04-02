<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Test2 extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function test13() {
        $input['select'] = 'name,email,phone,date_rgt,course_code,price_purchase,call_status_id,ordering_status_id,cod_status_id,marketer_id,channel_id,source_id';
        $input['where'] = array('date_rgt >' => 1504198800, 'date_rgt <' => 1522515600,'duplicate_id' => '0');
        $input['order'] = array('date_rgt' => 'asc');
        $contact = $this->contacts_model->load_all($input);

        echo '<table>';
        foreach ($contact as $value) {
            echo '<tr>';
            echo '<td>' . $value['name'] . '</td><td>' . $value['email'] . '</td><td>' . $value['phone'] . '</td><td>' . $value['date_rgt'] . '</td><td>' . $value['course_code'] . '</td><td>' . $value['price_purchase'] . '</td>';
            switch ($value['call_status_id']) {
                case 0:
                    echo '<td>Chưa gọi</td>';
                    break;
                case 1:
                    echo '<td>Số máy sai</td>';
                    break;
                case 2:
                    echo '<td>Không nghe máy</td>';
                    break;
                case 3:
                    echo '<td>Nhầm máy</td>';
                    break;
                case 4:
                    echo '<td>Đã liên lạc được</td>';
                    break;
                default:
                    echo '<td>không xác định</td>';
            }
            
            switch ($value['ordering_status_id']) {
                case 0:
                    echo '<td>chưa chăm sóc</td>';
                    break;
                case 1:
                    echo '<td>Bận gọi lại sau</td>';
                    break;
                case 2:
                    echo '<td>Chăm sóc sau 1 thời gian nữa</td>';
                    break;
                case 3:
                    echo '<td>Từ chối mua</td>';
                    break;
                case 4:
                    echo '<td>Đồng ý mua</td>';
                    break;
                case 5:
                    echo '<td>Contact chết</td>';
                    break;
                case 6:
                    echo '<td>Lát nữa gọi lại</td>';
                    break;
                default:
                    echo '<td>không xác định</td>';
            }

            switch ($value['cod_status_id']) {
                case 0:
                    echo '<td>Chưa giao hàng</td>';
                    break;
                case 1:
                    echo '<td>Đang giao hàng</td>';
                    break;
                case 2:
                    echo '<td>Đã thu COD</td>';
                    break;
                case 3:
                    echo '<td>Đã thu Lakita</td>';
                    break;
                case 4:
                    echo '<td>Hủy đơn</td>';
                    break;
                default:
                    echo '<td>không xác định</td>';
            }
            
            $this->load->model('staffs_model');
            
            echo '<td>'.$this->staffs_model->find_staff_name($value['marketer_id']).'</td>';
            
            switch ($value['channel_id']) {
                case 2:
                    echo '<td>Facebook Ads</td>';
                    break;
                case 3:
                    echo '<td>Google Adwords</td>';
                    break;
                case 5:
                    echo '<td>Email getresponse</td>';
                    break;
                case 6:
                    echo '<td>Cốc cốc</td>';
                    break;
                case 7:
                    echo '<td>Kênh SEO</td>';
                    break;
                case 8:
                    echo '<td>Social</td>';
                    break;
                case 9:
                    echo '<td>lakita.vn</td>';
                    break;
                case 10:
                    echo '<td>GDN</td>';
                    break;
                default:
                    echo '<td></td>';
            }
            
             switch ($value['source_id']) {
                case 1:
                    echo '<td>Marketing Online</td>';
                    break;
                case 2:
                    echo '<td>TVTS thu thập</td>';
                    break;
                case 3:
                    echo '<td>Hotline 1900</td>';
                    break;
                case 4:
                    echo '<td>Chatbot lakita.vn</td>';
                    break;
                case 5:
                    echo '<td>Contact vãng lai</td>';
                    break;
                case 6:
                    echo '<td>Contact vãng lai</td>';
                    break;
                default:
                    echo '<td>Inbox</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    
    function test() {
        $this->load->model('campaign_model');
        $this->load->model('campaign_cost_model');
        $this->load->model('adset_model');
        $this->load->model('adset_cost_model');
        $this->load->model('contacts_model');

        $start_date = mktime(0, 0, 0, 11, 1, 2017);
        $end_date = mktime(0, 0, 0, 12, 1, 2017);
        
        //  1512082800
        //echo mktime(0, 0, 0, 12, 1, 2017);die;
        $input_adset_list = array();
        $input_adset_list['select'] = 'DISTINCT(adset_id)';
        $input_adset_list['where'] = array('time >=' => $start_date, 'time <=' => $end_date);
        $input_adset_list['order'] = array('adset_id' => 'ASC');

        $adset_list = $this->adset_cost_model->load_all($input_adset_list);

        $campaign_list = array();

        foreach ($adset_list as $key => $value) {
            $campaign_id = $this->adset_model->load_all(array('where' => array('id' => $value['adset_id'])));
            if (!in_array($campaign_id[0]['campaign_id'], $campaign_list)) {
                $campaign_list[] = $campaign_id[0]['campaign_id'];
            }
        }

        $campaign = array();

        foreach ($campaign_list as $key => $value) {
            $campaign_infor = $this->campaign_model->load_all(array('where' => array('id' => $value, 'channel_id' => 2)));
            if (!empty($campaign_infor)) {
                $campaign[] = $campaign_infor[0];
            }
        }

         echo '<pre>';
        print_r($campaign);
        
        
        unset($campaign[8]);
        unset($campaign[22]);


//        $input_campaign['where'] = array('channel_id' => 2, 'campaign_id_facebook !=' => '', 'time >=' => 1512082800);
//        $campaign = $this->campaign_model->load_all($input_campaign);

        $course_list = array();


        foreach ($campaign as $value) {
            $course = explode('_', $value['name']);
            if (!array_key_exists($course[1], $course_list)) {

                $course_list[$course[1]]['campaign'][] = $value['id'];
            } else {
                $course_list[$course[1]]['campaign'][] = $value['id'];
            }
        }

        echo '<pre>';
        print_r($course_list);
//        die;

        foreach ($course_list as $key => $value) {
            $spend = 0;
            foreach ($value['campaign'] as $key2 => $value2) {
                $a = $this->campaign_cost_model->load_all(array('where' => array('campaign_id' => $value2, 'time >=' => $start_date, 'time <=' => $end_date)));
                if (!empty($a)) {
                    foreach ($a as $key3 => $value3) {
                        $spend += $value3['spend'];
                    }
                }
            }
            $course_list[$key]['marketing_spend'] = $spend;

            $get = 0;
            $contact = $this->contacts_model->load_all(array('where' => array('channel_id' => 2, 'course_code' => $key, 'cod_status_id' => 3, 'date_receive_lakita >=' => $start_date, 'date_receive_lakita <=' => $end_date)));
            if (!empty($contact)) {
                foreach ($contact as $key4 => $value4) {
                    $get += $value4['price_purchase'];
                }
            }
            $course_list[$key]['get'] = $get;
        }


        
        echo '<table>';
        
        foreach ($course_list as $key5 => $value5){
            echo '<tr>';
            echo '<td>'.$key5.'</td><td>'.number_format($value5['get'], 0, ",", ".") . " VNĐ" .'</td><td>'.number_format($value5['marketing_spend'], 0, ",", ".") . " VNĐ" .'</td><td>'.number_format($value5['get'] - $value5['marketing_spend'], 0, ",", ".") . " VNĐ" .'</td>' ;
            echo '</tr>';
        }
        
        echo '</table>';

        echo '<pre>';
        print_r($course_list);
        die;




        echo '<table>';
        echo '<tr>';
        echo '<td>';
        echo '<pre>';
        print_r($campaign);
        echo '</td>';
        echo '<td>';
        echo '<pre>';
        print_r($course_list);
        echo '</td>';
        echo '</tr>';
        echo '</table>';
    }

}
