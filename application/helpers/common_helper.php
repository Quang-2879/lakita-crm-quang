<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of common
 *
 * @author CHUYEN
 */
function redirect_and_die($message = 'có lỗi xảy ra') {
    echo '<script> alert("' . $message . '");</script>';
    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    die;
}
function find_source_sale_id($staff_id,$chanel_id){
    $this->load->model('staffs_model');
    $this->load->model('channel_model');
    $input = array();
    $input['where']['id'] = $staff_id;
    $staff = $this->staffs_model->load_all($input);
    
    $input = array();
    $input['where']['id'] = $chanel_id;
    $channel = $this->channel_model->load_all($input);
    
    if(!empty($staff) && !empty($channel)){
        if(($staff[0]['source_sale_id'] == 2 && $chanel[0]['source_sale_id'] == 1) || ($staff[0]['source_sale_id'] == 1 && $chanel[0]['source_sale_id'] == 2)){
            return 2;
        }else{
            return 1;
        }
    }else{
        return 1;
    }
    
}
function show_error_and_redirect($msg = '', $redirect = '', $msg_success = true) {
    $ci = & get_instance();
    $ci->session->set_tempdata('message', $msg, 2);
    if (!$msg_success) {
        $ci->session->set_tempdata('msg_success', 0, 2);
    }
    $redirect2 = $redirect;
    if ($redirect == '') {
        $redirect2 = $_SERVER['HTTP_REFERER'];
    }
    header('Location: ' . $redirect2);
    die;
}

function print_arr($myArr) {
    echo '<pre>';
    print_r($myArr);
    die;
}

function echoQuery() {
    $ci = & get_instance();
    echo $ci->db->last_query() . '<br>';
}

function h_caculate_money($contact) {
    $money = 0;
    if (is_array($contact)) {
        foreach ($contact as $value) {
            $money += $value['price_purchase'];
        }
    }
    return $money;
}

function display_money($money) {
    return number_format($money, 0, ",", ".");
}
function h_number_format($money) {
    return number_format($money, 0, ",", ".");
}

function found_position_in_array($phone, $contacts) {
    $result = -1;
    if (is_array($contacts) && !empty($contacts)) {
        foreach ($contacts as $key => $value) {
            if ($phone == $value['phone']) {
                $result = $key;
                break;
            }
        }
    }
    return $result;
}

function h_sum_money($contacts) {
    $sum = 0;
    foreach ($contacts as $value) {
        $sum += $value['price_purchase'];
    }
    return $sum;
}

function h_sum_money_1($contacts) {
    $sum = 0;
    foreach ($contacts as $value) {
        $sum += $value['money'];
    }
    return $sum;
}

function h_find_name_display($column_name, $list_view) {
    $name = '';
    foreach ($list_view as $key => $value) {
        if ($key == $column_name) {
            $name = $value['name_display'];
            break;
        }
    }
    return $name;
}

function get_total_campaign_info($rows) {
    $total_C3 = 0;
    $price_sum = 0;
    foreach ($rows as $value) {
        $total_C3 += $value['total_C3'];
        $price_sum += $value['price'];
    }
}

function h_get_time_range($startDate, $endDate) {
    $dateArray = array();
    for ($i = $startDate; $i <= $endDate; $i += 3600 * 24) {
        $date = date('d/m/Y', $i);
        $dateArray[$date] = $i;
    }
    return $dateArray;
}

function h_get_progress($tu_so, $mau_so) {
    return ($mau_so > 0) ?
            round(($tu_so / $mau_so) * 100, 2) . '%' : 'N/A';
}

function get_fb_request($url) {
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HEADER => FALSE,
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_ENCODING => '',
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36',
        CURLOPT_AUTOREFERER => TRUE,
        CURLOPT_CONNECTTIMEOUT => 150,
        CURLOPT_TIMEOUT => 150,
        CURLOPT_MAXREDIRS => 5,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => 0
    );
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    unset($options);
    return $http_code === 200 ? json_decode($response) : FALSE;
}

function h_caculate_channel_cost($channel_cost) {
    $costArr = array(
        'total_C1' => 0,
        'total_C2' => 0,
        'spend' => 0,
    );
    foreach ($channel_cost as $value) {
        $costArr['total_C1'] += $value['total_C1'];
        $costArr['total_C2'] += $value['total_C2'];
       // $costArr['total_C3'] += $value['total_C3'];
        $costArr['spend'] += $value['spend'];
    }
    return $costArr;
}

function h_caculate_campaign_spend($campaigns) {
    $spend = 0;
    foreach ($campaigns as $value) {
        $spend += $value['spend'];
    }
    return $spend;
}

function h_phone_format($phone) {
    if (strlen($phone) == 10) {
        $fisrtSection = substr($phone, 0, 4);
        $secondSection = substr($phone, 4, 3);
        $thirdSection = substr($phone, 7, 3);
        return $fisrtSection . '.' . $secondSection . '.' . $thirdSection;
    } else if (strlen($phone) == 11) {
        $fisrtSection = substr($phone, 0, 5);
        $secondSection = substr($phone, 5, 3);
        $thirdSection = substr($phone, 8, 3);
        return $fisrtSection . '.' . $secondSection . '.' . $thirdSection;
    } else {
        return $phone;
    }
}

function h_get_row_class($value) {
    $class = '';
    if ($value['duplicate_id'] > 0) {
        $class .= ' duplicate duplicate_' . $value['id'];
    }
    if ($value['date_transfer'] > 0) {
        $class .= ' has_transfer';
    }
    $dayDiff = floor((time() - $value['date_print_cod']) / (60 * 60 * 24));
    if ($dayDiff > 3 && $dayDiff <= 5 && $value['cod_status_id'] == _DANG_GIAO_HANG_) {
        $class .= ' bgyellow';
    }
    if ($dayDiff > 5 && $dayDiff <= 30 && $value['cod_status_id'] == _DANG_GIAO_HANG_) {
        $class .= ' bgred';
    }
    if ($value['weight_envelope'] > 50) {
        $class .= ' bgred';
    }
    if ($value['is_hide'] == 1) {
        $class .= ' is_hide';
    }
    if ($value['cod_status_id'] == _HUY_DON_ || $value['ordering_status_id'] == _TU_CHOI_MUA_ || $value['ordering_status_id'] == _CONTACT_CHET_ || $value['call_status_id'] == _SO_MAY_SAI_ || $value['call_status_id'] == _NHAM_MAY_) {
        $class .= ' ban';
    }
    if ($value['cod_status_id'] == _DA_THU_COD_) {
        $class .= ' receive-cod';
    }
    if ($value['cod_status_id'] == _DA_THU_LAKITA_) {
        $class .= ' receive-lakita';
    }
    return $class;
}

function h_generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getProgressBarClass($percent){
    $class = "";
    if($percent >= 90){
        $class = "progress-bar-success";
    }else if($percent >= 70 && $percent < 90){
        $class = "progress-bar-info";
    }else if($percent >= 50 && $percent< 70){
        $class = "progress-bar-warning";
    }else{
        $class = "progress-bar-danger";
    }
    return $class;
}

function hGetTimeRange($startDate, $endDate) {
    $dateArray = array();
    for ($i = $startDate; $i <= $endDate; $i += 3600 * 24) {
        $date = date('d', $i);
        $dateArray[$date] = $i;
    }
    return $dateArray;
}