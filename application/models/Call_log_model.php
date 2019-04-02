<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact_model
 *
 * @author CHUYEN
 */
class Call_log_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'call_log';
    }

    public function load_all_call_log($input_call_log) {
        $this->load->model('Call_status_model');
        $this->load->model('Ordering_status_model');
        $this->load->model('Cod_status_model');
        $this->load->model('Providers_model');
        $this->load->model('Staffs_model');
        $call_logs = $this->load_all($input_call_log);
        foreach ($call_logs as $key => $value) {
            $call_logs[$key]['call_status_id'] = $value['call_status_id'];
            $call_logs[$key]['ordering_status_id'] = $value['ordering_status_id'];
            $call_logs[$key]['cod_status_id'] = $value['cod_status_id'];
            $call_logs[$key]['provider_id'] = $value['provider_id'];
            $call_logs[$key]['call_status_desc'] = $this->Call_status_model->find_call_status_desc($value['call_status_id']);
            $call_logs[$key]['ordering_status_desc'] = $this->Ordering_status_model->find_ordering_status_desc($value['ordering_status_id']);
            $call_logs[$key]['cod_status_desc'] = $this->Cod_status_model->find_cod_status_desc($value['cod_status_id']);
            $call_logs[$key]['provider_name'] = $this->Providers_model->find_provider_name($value['provider_id']);
            $call_logs[$key]['staff_name'] = $this->Staffs_model->find_staff_name($value['staff_id']);
        }
        return $call_logs;
    }

}
