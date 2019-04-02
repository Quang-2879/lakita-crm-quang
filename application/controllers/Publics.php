<?php


class Publics extends CI_Controller {

    public function getEmail() {
        $post = $this->input->post('email');
        $time = date('d-m-Y-h-i-s');
        $myfile = fopen(APPPATH . "../public/get-email/" . $time . ".txt", "w") or die("Unable to open file!");
        fwrite($myfile, $post);
        fclose($myfile);
    }

    public function test() {         
        $emailTo = 'chuyenbka@gmail.com';
        $this->load->library("email");
        $this->email->from('cskh@lakita.vn', "lakita.vn");
        $this->email->to($emailTo);
        $this->email->subject('hihi123');
        $this->email->message('haha');
        $this->email->send();
    }

    public function index() {

//        Api::init(
//                '1659071634411828', // App ID
//                '70eadeff70366b88905151df276ed844', 'EAAXk6rdtETQBABFZBrxwbGNe7ZAr1NpVadlVbCXZCocrC0TAaSX1ZBJTHmL7ZCdSkcsPE8URqBYsAXKgoibZAiZCfo5x9RZAcPHDuZB0uQFSNC9nrJdloOvtANPRSG0x6c6nl9O9FKUPxiL0ddDoXZAcIX1S7eZCv49Q51t2bQAHTXBd0bfCZBhLoOK2CGoZCSBfjlpYZD' // Your user access token
//        );
//
//        $me = new AdAccountUser('me');
//        $my_adaccount = $me->getAdAccounts()->current();



        $access_token = 'EAAXk6rdtETQBAPOhGenIU6T7daqqgSniZArnfG9cmVDYZA7PeX0fSZCoZAZAk2ZA0fNhe7A8B6GPlvftCfjD0cyzopXOZCIyRNWQi3D3nvmZAg8vBz3tKnosgXwfDjPtuEcD9kuDZBTaFG6WGs0HZCtwoedixZCYCpo2wk01JYP4ZALfIn7phnt7mLER';
        $ad_account_id = 'act_512062118812690';
        $app_secret = '70eadeff70366b88905151df276ed844';
        $app_id = '1659071634411828';

        Api::init($app_id, $app_secret, $access_token);

        $fields = array(
            'reach',
            'spend',
        );
        $params = array(
            'level' => 'campaign',
            'filtering' => array(array('field' => 'adgroup.delivery_info', 'operator' => 'IN', 'value' => array('active', 'limited',
                        'scheduled', 'pending_review', 'recently_rejected', 'rejected', 'inactive', 'not_delivering',
                        'not_published', 'rejected', 'completed', 'recently_completed', 'archived', 'permanently_deleted'))),
            'breakdowns' => array()
        );
        print_arr((new AdAccount($ad_account_id))->getInsights(
                        $fields, $params
                )->getResponse()->getContent(), JSON_PRETTY_PRINT);
    }
    
     function view_pivot_table() {
        $this->load->view('pivot_table');
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
}
