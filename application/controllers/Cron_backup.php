<?php



/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



/**

 * Description of Cron

 *

 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>

 */

class Cron extends CI_Controller {



    public function __construct() {

        parent::__construct();

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        ini_set('max_execution_time', 300);

//        if (!$this->input->is_cli_request()) {

//            die('Bạn không có quyền truy cập vào trang web này');

//        } else {

//            echo '1';

//        }

    }



    public function index() {

        echo 'yes';

    }



    public function update_campain_cost($day = '0') {

        if ($day == '0') {

            $day = "-1 days";

        }

        $this->load->model('campaign_cost_model');

        $today = strtotime(date('d-m-Y', strtotime($day))); //tính theo giờ Mỹ

        $today_fb_format = date('Y-m-d', strtotime($day));

        /*

         * Lấy danh sách tất cả campain đang hoạt động

         */

        $this->load->model('campaign_model');

        $input = array();

        $input['where'] = array('active' => 1, 'channel_id' => 2);

        $campaigns = $this->campaign_model->load_all($input);

        foreach ($campaigns as $value) {

            /*

             * Kiểm tra xem đã tồn tại giá ngày hôm nay chưa (nếu có rồi thì bỏ qua)

             */

            if ($value['campaign_id_facebook'] != '') {

                $where = array('campaign_id' => $value['id'], 'time' => $today);

                $this->campaign_cost_model->delete($where);

                $url = 'https://graph.facebook.com/v2.11/' . $value['campaign_id_facebook'] .

                        '/insights?fields=spend,reach,clicks&level=account'

                        . '&time_range={"since":"' . $today_fb_format . '","until":"' . $today_fb_format . '"}&access_token=' . ACCESS_TOKEN;

                $spend = get_fb_request($url);

                $param['time'] = $today;

                $param['campaign_id'] = $value['id'];

                $param['spend'] = isset($spend->data[0]->spend) ? $spend->data[0]->spend : 0;

                $param['total_C1'] = isset($spend->data[0]->reach) ? $spend->data[0]->reach : 0;

                $param['total_C2'] = isset($spend->data[0]->clicks) ? $spend->data[0]->clicks : 0;

                $this->campaign_cost_model->insert($param);

            }

        }

    }



    public function update_channel_cost($day = '0') {

        if ($day == '0') {

            $day = "-1 days";

        }



        $this->load->model('channel_cost_model');

        $today = strtotime(date('d-m-Y', strtotime($day))); //tính theo giờ Mỹ

        $today_fb_format = date('Y-m-d', strtotime($day));



        $this->load->model('channel_model');

//        $input = array();

//        $input['where'] = array('active' => 1);

//        $channels = $this->channel_model->load_all($input);

        //Kênh facebook



        /*

         * Kiểm tra xem đã tồn tại giá ngày hôm nay chưa (nếu có rồi thì bỏ qua)

         */

        $where = array('channel_id' => 2, 'time' => $today);

        $this->channel_cost_model->delete($where);

        $accountFBADS = [

            'Lakita_cu' => '512062118812690',

            'Lakita_3.0' => '600208190140429',

            'Lakita_K3' => '817360198425226'];

        $param['spend'] = 0;

        $param['total_C1'] = 0;

        $param['total_C2'] = 0;



        foreach ($accountFBADS as $value2) {

            $url = 'https://graph.facebook.com/v2.11/act_' . $value2 . '/' .

                    'insights?fields=spend,reach,clicks&level=account'

                    . '&time_range={"since":"' . $today_fb_format . '","until":"' . $today_fb_format . '"}&access_token=' . ACCESS_TOKEN;

            $spend = get_fb_request($url);

            $param['spend'] += isset($spend->data[0]->spend) ? $spend->data[0]->spend : 0;

            $param['total_C1'] += isset($spend->data[0]->reach) ? $spend->data[0]->reach : 0;

            $param['total_C2'] += isset($spend->data[0]->clicks) ? $spend->data[0]->clicks : 0;

        }

        $param['time'] = $today;

        $param['channel_id'] = 2;

        $this->channel_cost_model->insert($param);

    }



    public function update_adset_cost($day = '0') {

        if ($day == '0') {

            $day = "-1 days";

        }



        $this->load->model('adset_cost_model');

        $today = strtotime(date('d-m-Y', strtotime($day))); //tính theo giờ Mỹ

        $today_fb_format = date('Y-m-d', strtotime($day));

        /*

         * Lấy danh sách tất cả adset đang hoạt động

         */

        $this->load->model('adset_model');

        $input = array();

        $input['where'] = array('active' => 1, 'channel_id' => 2);

        $adsets = $this->adset_model->load_all($input);

        foreach ($adsets as $value) {

            /*

             * Kiểm tra xem đã tồn tại giá ngày hôm nay chưa (nếu có rồi thì bỏ qua)

             */

            if ($value['adset_id_facebook'] != '') {

                $where = array('adset_id' => $value['id'], 'time' => $today);

                $this->adset_cost_model->delete($where);

                $url = 'https://graph.facebook.com/v2.11/' . $value['adset_id_facebook'] .

                        '/insights?fields=spend,reach,clicks&level=account'

                        . '&time_range={"since":"' . $today_fb_format . '","until":"' . $today_fb_format . '"}&access_token=' . ACCESS_TOKEN;

                $spend = get_fb_request($url);

                $param['time'] = $today;

                $param['adset_id'] = $value['id'];

                $param['spend'] = isset($spend->data[0]->spend) ? $spend->data[0]->spend : 0;

                $param['total_C1'] = isset($spend->data[0]->reach) ? $spend->data[0]->reach : 0;

                $param['total_C2'] = isset($spend->data[0]->clicks) ? $spend->data[0]->clicks : 0;

                $this->adset_cost_model->insert($param);

            }

        }

    }



    public function update_ad_cost($day = '0') {

        if ($day == '0') {

            $day = "-1 days";

        }



        $this->load->model('ad_cost_model');

        $today = strtotime(date('d-m-Y', strtotime($day))); //tính theo giờ Mỹ

        $today_fb_format = date('Y-m-d', strtotime($day));

        /*

         * Lấy danh sách tất cả ad đang hoạt động

         */

        $this->load->model('ad_model');

        $input = array();

        $input['where'] = array('active' => 1, 'channel_id' => 2);

        $adsets = $this->ad_model->load_all($input);

        foreach ($adsets as $value) {

            /*

             * Kiểm tra xem đã tồn tại giá ngày hôm nay chưa (nếu có rồi thì bỏ qua)

             */

            if ($value['ad_id_facebook'] != '') {

                $where = array('ad_id' => $value['id'], 'time' => $today);

                $this->ad_cost_model->delete($where);

                $url = 'https://graph.facebook.com/v2.11/' . $value['ad_id_facebook'] .

                        '/insights?fields=spend,reach,clicks&level=account'

                        . '&time_range={"since":"' . $today_fb_format . '","until":"' . $today_fb_format . '"}&access_token=' . ACCESS_TOKEN;

                $spend = get_fb_request($url);

                if (!empty($spend)) {

                    $param['time'] = $today;

                    $param['ad_id'] = $value['id'];

                    $param['spend'] = isset($spend->data[0]->spend) ? $spend->data[0]->spend : 0;

                    $param['total_C1'] = isset($spend->data[0]->reach) ? $spend->data[0]->reach : 0;

                    $param['total_C2'] = isset($spend->data[0]->clicks) ? $spend->data[0]->clicks : 0;

                    $this->ad_cost_model->insert($param);

                }

            }

        }

    }



    function test_cost_campaign() {

        for ($i = 1; $i <= 2; $i++) {

            $day = "-" . $i . " days";

            $this->update_campain_cost($day);

        }

    }



    function test_cost_channel() {

        for ($i = 1; $i <= 2; $i++) {

            $day = "-" . $i . " days";

            $this->update_channel_cost($day);

        }

    }



    function test_cost_adset() {

        for ($i = 1; $i <= 2; $i++) {

            $day = "-" . $i . " days";

            $this->update_adset_cost($day);

        }

    }



    function test_cost_ads() {

        for ($i = 1; $i <= 2; $i++) {

            $day = "-" . $i . " days";

            $this->update_ad_cost($day);

        }

    }



function get_id_lakita() {



        // for ($i = 0; $i <= 10; $i++) {

        $input = [];

        $input['select'] = 'id,email,phone,course_code,id_lakita,create_date_id_lakita';

        $input['where'] = array('id_lakita' => '', 'cod_status_id >' => 1, 'cod_status_id <' => 4);

        $input['order'] = array('date_receive_lakita' => 'desc');

        $input['limit'] = array(1000, 4000);

        $contact = $this->contacts_model->load_all($input);

        foreach ($contact as $value) {

            $id_lakita = '';

            $id_lakita = file_get_contents('https://lakita.vn/api/check_exit_email?email=' . $value['email'] . '&phone=' . $value['phone'] . '&course_code=' . $value['course_code']);

            $id_lakita = json_decode($id_lakita, true);





            if ($id_lakita != 0) {

                $where = array('id' => $value['id']);

                $data = array('id_lakita' => $id_lakita['id'], 'create_date_id_lakita' => $id_lakita['create_date']);

                $this->contacts_model->update($where, $data);

            }

            //  }

        }

//        echo '<pre>';

//        print_r($contact);



        echo '<script>alert("xong");</script>';

    }



//    function listen() {

//        if (!$this->input->is_ajax_request()) {

//            redirect();

//        }

//        $userID = $this->session->userdata('user_id');

//        if (!isset($userID)) {

//            $location = 'dang-nhap.html';

//            if (strpos($location, '/') !== 0 || strpos($location, '://') !== FALSE) {

//                if (!function_exists('site_url')) {

//                    $this->load->helper('url');

//                }

//                $location = site_url($location);

//            }

//            $script = "window.location='{$location}';";

//            $this->output->enable_profiler(FALSE)

//                    ->set_content_type('application/x-javascript')

//                    ->set_output($script);

//        } else {

//            $this->load->helper('cookie');

//            $myfile = fopen(APPPATH . "../public/last_reg.txt", "r") or die("Unable to open file!");

//            $last_id_txt = fgets($myfile);

//            $last_id = get_cookie('last_id');

//            if (!$last_id) {

//                set_cookie('last_id', $last_id_txt, 3600 * 48);

//                echo '0';

//                die;

//            }

//            if ($last_id != $last_id_txt) {

//                echo '1';

//                set_cookie('last_id', $last_id_txt, 3600 * 48);

//            } else {

//                echo '0';

//            }

//            fclose($myfile);

//        }

//    }



    public function SyncActiveCampaign() {

        $this->load->model('campaign_model');

        $accountFBADS = [

            'Lakita_cu' => '512062118812690',

            'Lakita_3.0' => '600208190140429',

            'Lakita_K3' => '817360198425226'

        ];

        foreach ($accountFBADS as $account) {

            $url = 'https://graph.facebook.com/v2.11/act_' . $account . '/campaigns?fields=["delivery_info{start_time,status}","created_time","name","account_id"]&limit=5000&access_token=' . FULL_PER_ACCESS_TOKEN;

            $spend = get_fb_request($url);

            foreach ($spend->data as $value) {

                if ($value->delivery_info->status == 'active') {

                    $dateFbCreate = isset($value->created_time) ? strtotime($value->created_time) : 0;

                    $where = array('campaign_id_facebook' => $value->id);

                    $data = array('active' => '1', 'date_fb_create' => $dateFbCreate,

                        'name' => $value->name, 'account_fb_id' => $value->account_id);

                    $this->campaign_model->update($where, $data);

                } else {

                    $dateFbCreate = isset($value->created_time) ? strtotime($value->created_time) : 0;

                    $where = array('campaign_id_facebook' => $value->id);

                    $data = array('active' => '0', 'date_fb_create' => $dateFbCreate,

                        'name' => $value->name, 'account_fb_id' => $value->account_id);

                    $this->campaign_model->update($where, $data);

                }

            }

        }

    }



    public function SyncActiveAdset() {

        $this->load->model('adset_model');

        $accountFBADS = [

            'Lakita_cu' => '512062118812690',

            'Lakita_3.0' => '600208190140429',

            'Lakita_K3' => '817360198425226'

        ];

        foreach ($accountFBADS as $account) {

            $url = 'https://graph.facebook.com/v2.11/act_' . $account . '/adsets?fields=["delivery_info{start_time,status}","created_time","name","account_id"]&limit=5000&access_token=' . FULL_PER_ACCESS_TOKEN;

            $spend = get_fb_request($url);

            foreach ($spend->data as $value) {

                if ($value->delivery_info->status == 'active') {

                    $dateFbCreate = isset($value->created_time) ? strtotime($value->created_time) : 0;

                    $where = array('adset_id_facebook' => $value->id);

                    $data = array('active' => '1', 'date_fb_create' => $dateFbCreate,

                        'name' => $value->name, 'account_fb_id' => $value->account_id);

                    $this->adset_model->update($where, $data);

                } else {

                    $dateFbCreate = isset($value->created_time) ? strtotime($value->created_time) : 0;

                    $where = array('adset_id_facebook' => $value->id);

                    $data = array('active' => '0', 'date_fb_create' => $dateFbCreate,

                        'name' => $value->name, 'account_fb_id' => $value->account_id);

                    $this->adset_model->update($where, $data);

                }

            }

        }

    }



    public function SyncActiveAd() {

        $this->load->model('ad_model');

        $accountFBADS = [

            'Lakita_cu' => '512062118812690',

            'Lakita_3.0' => '600208190140429',

            'Lakita_K3' => '817360198425226'

        ];

        foreach ($accountFBADS as $account) {

            $url = 'https://graph.facebook.com/v2.11/act_' . $account . '/ads?fields=["delivery_info{start_time,status}","created_time","name","account_id"]&limit=5000&access_token=' . FULL_PER_ACCESS_TOKEN;

            $spend = get_fb_request($url);

            foreach ($spend->data as $value) {

                if ($value->delivery_info->status == 'active') {

                    $dateFbCreate = isset($value->created_time) ? strtotime($value->created_time) : 0;

                    $where = array('ad_id_facebook' => $value->id);

                    $data = array('active' => '1', 'date_fb_create' => $dateFbCreate,

                        'name' => $value->name, 'account_fb_id' => $value->account_id);

                    $this->ad_model->update($where, $data);

                } else {

                    $dateFbCreate = isset($value->created_time) ? strtotime($value->created_time) : 0;

                    $where = array('ad_id_facebook' => $value->id);

                    $data = array('active' => '0', 'date_fb_create' => $dateFbCreate,

                        'name' => $value->name, 'account_fb_id' => $value->account_id);

                    $this->ad_model->update($where, $data);

                }

            }

        }

    }



    public function GetAllCampaign() {

        $result = [];

        $url = 'https://graph.facebook.com/v2.11/act_512062118812690/ads?fields=id,name,created_time,status&limit=5000&access_token=' . ACCESS_TOKEN;

        $spend = get_fb_request($url);

        if (!empty($spend)) {

            $result = json_decode(json_encode($spend->data), true);

            if (isset($spend->paging->next)) {

                // $url = 'https://graph.facebook.com/v2.11/act_512062118812690/adsets?fields=id,name,created_time,status&limit=1000&access_token=' . ACCESS_TOKEN;

                $spend2 = get_fb_request($spend->paging->next);

                print_arr($spend2);

            }

        }

        print_arr($result);

    }



//    public function GetActiveAdset() {

//        $url = 'https://graph.facebook.com/v2.11/act_512062118812690/adsets?fields=id,name,created_time,status&limit=500&access_token=' . ACCESS_TOKEN;

//        $spend = get_fb_request($url);

//        $this->load->model('adset_model');

//        foreach ($spend->data as $value) {

//            if ($value->status != 'ACTIVE') {

//                $where = array('adset_id_facebook' => $value->id);

//                $data = array('active' => '0');

//                $this->adset_model->update($where, $data);

//            }

//        }

//    }

//

//    public function GetActiveAds() {

//        $url = 'https://graph.facebook.com/v2.11/act_512062118812690/ads?fields=id,name,created_time,status&limit=500&access_token=' . ACCESS_TOKEN;

//        $spend = get_fb_request($url);

//        $this->load->model('ad_model');

//        foreach ($spend->data as $value) {

//            if ($value->status != 'ACTIVE') {

//                $where = array('ad_id_facebook' => $value->id);

//                $data = array('active' => '0');

//                $this->ad_model->update($where, $data);

//            }

//        }

//    }

}

