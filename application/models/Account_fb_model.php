<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_model
 *
 * @author CHUYEN
 */
class Account_fb_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'account_fb';
    }
    
    public function getAccountArr(){
        $result = [];
        $accounts = $this->load_all([]);
        foreach ($accounts as $account){
            $result[$account['fb_id_account']] = $account['name'];
        }
        return $result;
    }
    
    public function getAccountTimeZone($fbId){
        $timeZone = 'VN';
        $input = array();
        $input['select'] = 'time_zone';
        $input['where'] = array('fb_id_account' => $fbId);
        $account = $this->load_all($input);
        if(!empty($account)){
            $timeZone = $account[0]['time_zone'];
        }
        return $timeZone;
    }
    
}
