<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Channel
 *
 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 */
class Link extends MY_Table {

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    public function init() {
        $this->controller_path = 'MANAGERS/link';
        $this->view_path = 'MANAGERS/link';
        $this->sub_folder = 'MANAGERS';
        /*
         * Liệt kê các trường trong bảng
         * - nếu type = text thì không cần khai báo
         * - nếu không muốn hiển thị ra ngoài thì dùng display = none
         * - nếu trường nào cần hiển thị đặc biệt (ngoại lệ) thì để là type = custom
         */
        $list_item = array(
            'id' => array(
                'name_display' => 'ID Link',
                'display' => 'none'
            ),
            'url' => array(
                'type' => 'custom',
                'name_display' => 'URL',
                'order' => '1'
            ),
            'channel' => array(
                'name_display' => 'Kênh',
                'order' => '1'
            ),
            'campaign' => array(
                'name_display' => 'Chiến dịch',
                'order' => '1'
            ),
            'adset' => array(
                'name_display' => 'Adset',
                'order' => '1'
            ),
            'ad' => array(
                'name_display' => 'Ad',
                'order' => '1'
            ),
            'time' => array(
                'order' => '1',
                'type' => 'datetime',
                'name_display' => 'Ngày tạo'
            )
        );
        $this->set_list_view($list_item);
        $this->set_model('link_model');
        $this->load->model('link_model');
    }

    protected function show_table() {
        parent::show_table();
        $get = $this->input->get();
        /*
         * Nếu có điều kiện đặc biệt thì thêm vào $row class css đặc biệt khi hiển thị
         * ví dụ: giá khóa học lớn hơn 4 triệu thì báo đỏ
         */
        $date_form = '';
        $date_end = '';
        if (!isset($get['date_from']) && !isset($get['date_end'])) {
            $date_form = strtotime(date('d-m-Y', strtotime("-1 days")));
            $date_end = strtotime(date('d-m-Y', strtotime("-1 days")));
        } else {
            $date_form = strtotime($get['date_from']);
            $date_end = strtotime($get['date_end']);
        }
        $this->load->model('channel_model');
        $this->load->model('campaign_model');
        $this->load->model('adset_model');
        $this->load->model('ad_model');
        foreach ($this->data['rows'] as &$value) {
            $value['channel'] = $this->channel_model->find_channel_name($value['channel_id']);
            $value['campaign'] = $this->campaign_model->find_campaign_name($value['campaign_id']);
            $value['adset'] = $this->adset_model->find_adset_name($value['adset_id']);
            $value['ad'] = $this->ad_model->find_ad_name($value['ad_id']);
        }
        unset($value);
    }

    /*
     * Ghi đè hàm xóa lớp cha
     */

//    function delete_multi_item() {
//        show_error_and_redirect('Không thể xóa, liên hệ admin để biết thêm chi tiết', '', FALSE);
//    }

    function index($offset = 0) {
        $this->load->model('channel_model');
        $input = array();
        $input['where'] = array('active' => '1');
        $channels = $this->channel_model->load_all($input);
        $this->data['channel'] = $channels;

        $this->load->model('campaign_model');
        $input = array();
        $input['where'] = array('active' => 1, 'marketer_id' => $this->user_id);
        $this->data['campaign'] = $this->campaign_model->load_all($input);

        $this->load->model('adset_model');
        $input = array();
        $input['where'] = array('active' => 1, 'marketer_id' => $this->user_id);
        $this->data['adset'] = $this->adset_model->load_all($input);

        $this->load->model('ad_model');
        $input = array();
        $input['where'] = array('active' => 1, 'marketer_id' => $this->user_id);
        $this->data['ad'] = $this->ad_model->load_all($input);

        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                ),
                'channel' => array(
                    'type' => 'arr_multi'
                ),
                'campaign' => array(
                    'type' => 'arr_multi'
                ),
            ),
            'right_filter' => array(
                'adset' => array(
                    'type' => 'arr_multi'
                ),
                'ad' => array(
                    'type' => 'arr_multi'
                ),
            )
        );

        $conditional = array();
        $conditional['where']['marketer_id'] = $this->user_id;
//        $get = $this->input->get();
//        if (!isset($get['filter_binary_active']) || $get['filter_binary_active'] == '0') {
//            $conditional['where']['active'] = 1;
//        }
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        $data = $this->data;
        $data['slide_menu'] = 'marketer/common/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Danh sách các link đã tạo';
        $data['edit_title'] = 'Sửa thông tin link';
        $data['content'] = 'MANAGERS/link/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    /*
     * Hiển thị modal thêm item
     */

    function show_add_item() {
        /*
         * type mặc định là text nên nếu là text sẽ không cần khai báo
         */
        $this->load->model('channel_model');
        $input = array();
        $input['where'] = array('active' => 1);
        $channels = $this->channel_model->load_all($input);

        $this->load->model('landingpage_model');
        $input = array();
        $input['where'] = array('active' => 1);
        //$input['where_in'] = array('marketer_id' => ['0', $this->user_id]);
        $input['order'] = array('landingpage_code' => 'ASC');
        $landingpages = $this->landingpage_model->load_all($input);

        $this->list_add = array(
            'left_table' => array(
                'channel_id' => array(
                    'type' => 'array',
                    'value' => $channels,
                ),
                'campaign' => array(
                    'type' => 'custom'
                ),
            ),
            'right_table' => array(
                'landingpage_id' => array(
                    'type' => 'array',
                    'value' => $landingpages
                )
            ),
        );
        parent::show_add_item();
    }

    function action_add_item() {
        $post = $this->input->post();
        if (!empty($post)) {
            /*
             * Kiểm tra xem link có trong db chưa
             */
            $input = array();
            $paramArr = array('channel_id', 'campaign_id', 'adset_id', 'ad_id', 'landingpage_id');
            foreach ($paramArr as $value) {
                if (isset($post['add_' . $value])) {
                    $input['where'][$value] = $post['add_' . $value];
                } else {
                    $input['where'][$value] = 0;
                }
            }
            $input['where']['marketer_id'] = $this->user_id;
            $exist_link = $this->{$this->model}->load_all($input);
            if (!empty($exist_link)) {
                show_error_and_redirect('Đã tồn tại link, mời bạn kiểm tra lại!', '', false);
            } else {
                foreach ($paramArr as $value) {
                    if (isset($post['add_' . $value])) {
                        $param[$value] = $post['add_' . $value];
                    }
                }
                if (!isset($param['landingpage_id']) || $param['landingpage_id'] == 0) {
                    show_error_and_redirect('Vui lòng chọn landing page!', '', false);
                }
                $param['time'] = time();
                $param['marketer_id'] = $this->user_id;
                $link_id = $this->{$this->model}->insert_return_id($param, 'id');


                $input_ld = array();
                $input_ld['where'] = array('id' => $post['add_landingpage_id']);
                $this->load->model('landingpage_model');
                $lds = $this->landingpage_model->load_all($input_ld);

                $url = $lds[0]['url'] . '?link=' . $link_id;
                /*
                 * Cập nhật lại url
                 */
                $where = array('id' => $link_id);
                $data = array('url' => $url);
                $this->{$this->model}->update($where, $data);
                show_error_and_redirect('Link vừa tạo là ' . $url);
            }
        }
    }

    /*
     * Hiển thị modal sửa item
     */

    function show_edit_item($inputData = []) {
        /*
         * type mặc định là text nên nếu là text sẽ không cần khai báo
         */
        $this->load->model('channel_model');
        $input = array();
        $input['where'] = array('active' => 1);
        $channels = $this->channel_model->load_all($input);


        $this->load->model('campaign_model');
        $input = array();
        $input['where'] = array('active' => 1, 'marketer_id' => $this->user_id);
        $campaigns = $this->campaign_model->load_all($input);

        $this->load->model('adset_model');
        $input = array();
        $input['where'] = array('active' => 1, 'marketer_id' => $this->user_id);
        $adsets = $this->adset_model->load_all($input);

        $this->load->model('ad_model');
        $input = array();
        $input['where'] = array('active' => 1, 'marketer_id' => $this->user_id);
        $ads = $this->ad_model->load_all($input);

        $this->load->model('landingpage_model');
        $input = array();
        $input['where'] = array('active' => 1);
        $landingpages = $this->landingpage_model->load_all($input);

        $this->list_edit = array(
            'left_table' => array(
                'url' => array(
                    'type' => 'disable'
                ),
                'channel_id' => array(
                    'type' => 'array',
                    'value' => $channels,
                ),
                'campaign_id' => array(
                    'type' => 'array',
                    'value' => $campaigns,
                ),
                'adset_id' => array(
                    'type' => 'array',
                    'value' => $adsets,
                ),
                'ad_id' => array(
                    'type' => 'array',
                    'value' => $ads,
                ),
            ),
            'right_table' => array(
                'landingpage_id' => array(
                    'type' => 'array',
                    'value' => $landingpages
                )
            ),
        );
        parent::show_edit_item();
    }

    function action_edit_item($id) {
        $post = $this->input->post();
        if (!empty($post)) {
            $input['where'] = array('id' => $id);
            $paramArr = array('channel_id', 'campaign_id', 'adset_id', 'ad_id', 'landingpage_id');
            foreach ($paramArr as $value) {
                if (isset($post['edit_' . $value]) && $value == 'landingpage_id') {
                    $this->load->model('landingpage_model');
                    $input_page['select'] = 'url';
                    $input_page['where'] = array('id' => $post['edit_landingpage_id']);
                    $page_url = $this->landingpage_model->load_all($input_page);
                    $param['url'] = $page_url[0]['url'].'?link='.$id;
                    $param[$value] = $post['edit_' . $value];
                }elseif(isset($post['edit_' . $value])){
                    $param[$value] = $post['edit_' . $value];
                }
            }
            $this->{$this->model}->update($input['where'], $param);
        }
        show_error_and_redirect('Sửa link thành công!');
    }

    function get_campaign() {
        $post = $this->input->post();
        $this->load->model('campaign_model');
        $input = array();
        $input['where'] = array('channel_id' => $post['channel_id'], 'marketer_id' => $this->user_id, 'active' => '1');
        $campaigns = $this->campaign_model->load_all($input);
        $xhml = '';
        if (!empty($campaigns)) {
            $xhml .= '  <td class="text-right">
                            Chọn campagin
                        </td>
                        <td>
                            <select class="form-control selectpicker" name="add_campaign_id">
                                <option value="0"> Chọn campagin </option>';
            foreach ($campaigns as $value) {
                $xhml .= "<option value='{$value['id']}'> {$value['name']} </option>";
            }
            $xhml .= '      </select>
                        </td>
                      ';
        }
        echo $xhml;
    }

    function get_adset() {
        $post = $this->input->post();
        $this->load->model('adset_model');
        $input = array();
        $input['where'] = array('campaign_id' => $post['campagin_id'], 'active' => '1');
        $adsets = $this->adset_model->load_all($input);
        $xhml = '';
        if (!empty($adsets)) {
            $xhml .= '  <td class="text-right">
                            Chọn adset
                        </td>
                        <td>
                            <select class="form-control selectpicker" name="add_adset_id">
                                <option value="0"> Chọn adset </option>';
            foreach ($adsets as $value) {
                $xhml .= "<option value='{$value['id']}'> {$value['name']} </option>";
            }
            $xhml .= '      </select>
                        </td>
                      ';
        }
        echo $xhml;
    }

    function get_ad() {
        $post = $this->input->post();
        $this->load->model('ad_model');
        $input = array();
        $input['where'] = array('adset_id' => $post['adset_id'], 'active' => '1');
        $ads = $this->ad_model->load_all($input);
        $xhml = '';
        if (!empty($ads)) {
            $xhml .= '  <td class="text-right">
                            Chọn ad
                        </td>
                        <td>
                            <select class="form-control selectpicker" name="add_ad_id">
                                <option value="0"> Chọn adset </option>';
            foreach ($ads as $value) {
                $xhml .= "<option value='{$value['id']}'> {$value['name']} </option>";
            }
            $xhml .= '      </select>
                        </td>
                      ';
        }
        echo $xhml;
    }

    public function PreviewUrl() {
        $post = $this->input->post();
        $url = $post['landingpage_url'];

        $content = file_get_contents($url);

        echo '<iframe width="100%" height="500px"> ' . $content . '</iframe>';
    }

}
