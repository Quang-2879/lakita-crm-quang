<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewReport
 *
 * @author phong
 */

require_once APPPATH. 'controllers/Manager.php';

class ViewReport extends Manager {

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
    }

    public function ViewGeneralReport() {
        $period = hGetTimeRange(strtotime(date('Y-m-01')),strtotime(date('Y-m-t')));
        $period2 = [];
        foreach ($period as $dayName => $dayTimeStamp) {
            $input = array();
            $input['select'] = 'id';
            $input['where'] = array('date_rgt >=' => $dayTimeStamp,
                'date_rgt <=' => $dayTimeStamp + 24 * 3600 - 1, 'is_hide' => '0');
            $period2[$dayName]['C3ThisMonth'] = count($this->contacts_model->load_all($input));
            $lastMonth = strtotime('-1 month', $dayTimeStamp);
            $input = array();
            $input['select'] = 'id';
            $input['where'] = array('date_rgt >=' => $lastMonth,
                'date_rgt <=' => $lastMonth + 24 * 3600 - 1, 'is_hide' => '0');
             $period2[$dayName]['C3LastMonth'] = count($this->contacts_model->load_all($input));
        }

        $startDate = strtotime(date('Y-m-01'));
        $startDateLastMonth = strtotime('-1 month', strtotime(date('Y-m-01')));

        $i = 1;
        $luyKe = [];
        foreach ($period as $dayName => $dayTimeStamp) {
            $input = array();
            $input['select'] = 'id';
            $input['where'] = array('date_rgt >=' => $startDate,
                'date_rgt <=' => $dayTimeStamp + 24 * 3600 - 1, 'is_hide' => '0');
            $luyKe[$dayName]['C3ThisMonth'] = count($this->contacts_model->load_all($input));            
            $luyKe[$dayName]['KPI'] = MARKETING_KPI_PER_DAY * $i++;
            $lastMonth = strtotime('-1 month', $dayTimeStamp);
            $input = array();
            $input['select'] = 'id';
            $input['where'] = array('date_rgt >=' => $startDateLastMonth,
                'date_rgt <=' => $lastMonth + 24 * 3600 - 1, 'is_hide' => '0');
             $luyKe[$dayName]['C3LastMonth'] = count($this->contacts_model->load_all($input));
        }

        $marketers = $this->staffs_model->GetActiveMarketers();
        foreach ($marketers as $key => $marketer) {
            foreach ($period as $dayName => $dayTimeStamp) {
                $input = array();
                $input['select'] = 'id';
                $input['where'] = array('date_rgt >=' => $dayTimeStamp,
                'date_rgt <=' => $dayTimeStamp + 24 * 3600 - 1, 'is_hide' => '0',
                    'marketer_id' => $marketer['id']);
                $marketers[$key]['Number'][$dayName]['C3'] = count($this->contacts_model->load_all($input));
                $marketers[$key]['Number'][$dayName]['KPI'] = $marketer['targets'];
            }
        }
        uasort($marketers, function($a, $b){
            $length = count($a['Number']);
            $last = ($length < 10) ? '0'.$length : $length;
            return -$a['Number'][$last]['C3'] + $b['Number'][$last]['C3'];
        });

        // print_arr($marketers);
        $data['marketers'] = $marketers;
        $data['luyKe'] = $luyKe;
        $data['period'] = $period2;
        $data['slide_menu'] = 'manager/common/menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['content'] = 'MANAGERS/ViewReport/view-general-report-chart';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

}
