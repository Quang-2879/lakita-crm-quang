<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Check_L8
 *
 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 */
class Check_L8 extends MY_Table {

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    public function init() {
        $this->controller_path = 'CODS/check_L8';
        $this->view_path = 'cod/check_L8';
        $this->sub_folder = 'CODS';
        /*
         * Liệt kê các trường trong bảng
         * - nếu type = text thì không cần khai báo
         * - nếu không muốn hiển thị ra ngoài thì dùng display = none
         * - nếu trường nào cần hiển thị đặc biệt (ngoại lệ) thì để là type = custom
         */
        $list_item = array(
            'id' => array(
                'name_display' => 'ID đối soát',
                'display' => 'none'
            ),
            'stt' => array(
                'name_display' => 'STT',
                'order' => '1'
            ),
            'code' => array(
                'name_display' => 'Mã bill',
                'order' => '1'
            ),
            'money' => array(
                'type' => 'currency',
                'name_display' => 'Số tiền Viettel thu',
                'order' => '1'
            ),
            'price_purchase' => array(
                'type' => 'currency',
                'name_display' => 'Số tiền giao cho Viettel',
                'order' => '1'
            ),
            'name' => array(
                'name_display' => 'Họ tên'),
            'phone' => array(
                'name_display' => 'Số điện thoại'),
            'address' => array(
                'name_display' => 'Địa chỉ'),
            'date_deliver_success' => array(
                'name_display' => 'Ngày phát thành công'),
            'time' => array(
                'type' => 'datetime',
                'name_display' => 'Ngày tải file đối soát',
                'order' => '1',
            ),
            'duplicate_id' => array(
                'name_display' => 'Contact bị trùng',
                'display' => 'none'
            ),
            'is_match' => array(
                'name_display' => 'Contact đúng thông tin mã vận đơn',
                'display' => 'none'
            ),
            'L8_check' => array(
                'type' => 'custom',
                'name_display' => 'Đã lưu'
            )
        );
        $this->set_list_view($list_item);
        $this->set_model('l8_check_model');
        $this->load->model('l8_check_model');
    }

    /*
     * override lại hàm show_table của lớp cha
     */

    protected function show_table() {
        parent::show_table();
        /*
         * Nếu có điều kiện đặc biệt thì thêm vào $row class css đặc biệt khi hiển thị
         * ví dụ: giá khóa học lớn hơn 4 triệu thì báo đỏ
         */
        foreach ($this->data['rows'] as &$value) {
            $class = '';
            if ($value['is_match'] == 0) {
                $class .= ' duplicate';
            }
            if ($value['duplicate_id'] > 0) {
                $class .= ' duplicate_bill';
            }
            if ($class != '') {
                $value['warning_class'] = $class;
            }
            $value['code'] = '<a href="https://www.viettelpost.com.vn/Tracking?KEY=' . $value['code'] . '" target="_blank"> ' . $value['code'] . '</a>';
        }
        unset($value);
    }

    /*
     * override lại hàm ở lớp cha, không cho xoá dòng đối soát đúng thông tin
     */

    function delete_item() {
        $post = $this->input->post();
        if (!empty($post['item_id'])) {
            $where = array('id' => $post['item_id']);
            $item = $this->{$this->model}->load_all(array('where' => $where));
            if (!empty($item) && ($item[0]['is_match'] == 0 || $item[0]['duplicate_id'] > 0)) {
                $this->{$this->model}->delete($where);
                echo '1';
            }
        }
    }

    /*
     * override lại hàm ở lớp cha, không cho xoá dòng đối soát đúng thông tin
     */

    function delete_multi_item() {
        $post = $this->input->post();
        if (!empty($post['item_id'])) {
            foreach ($post['item_id'] as $value) {
                $where = array('id' => $value);
                $item = $this->{$this->model}->load_all(array('where' => $where));
                if (!empty($item) && ($item[0]['is_match'] == 0 || $item[0]['duplicate_id'] > 0)) {
                    $this->{$this->model}->delete($where);
                } else {
                    show_error_and_redirect('Không thể xóa contact đúng thông tin vận đơn!', '', FALSE);
                    break;
                }
            }
        }
        show_error_and_redirect('Xóa thành công các dòng đã chọn!');
    }

    /*
     * Các dòng đối soát chưa lưu (nháp)
     */

    function index($offset = 0) {
        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                )
            ),
            'right_filter' => array(
                'is_match' => array(
                    'type' => 'binary',
                ),
                'duplicate_id' => array(
                    'type' => 'binary',
                )
            )
        );
        $conditional['where'] = array('L8_check' => '0');
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        //echoQuery();
        $data = $this->data;
        $data['slide_menu'] = 'cod/check_L8/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát L8';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát L8';
        $data['content'] = 'cod/check_L8/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    /*
     * Các dòng đối soát hôm nay
     */

    function today($offset = 0) {
        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                ),
                'L8_check' => array(
                    'type' => 'binary',
                ),
            ),
            'right_filter' => array(
                'is_match' => array(
                    'type' => 'binary',
                ),
                'duplicate_id' => array(
                    'type' => 'binary',
                )
            )
        );
        $conditional = array();
        $conditional['where']['time >'] = strtotime(date('d-m-Y'));
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        //echoQuery();
        $data = $this->data;
        $data['slide_menu'] = 'cod/check_L8/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát L8';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát L8';
        $data['content'] = 'cod/check_L8/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    /*
     * Tất cả các dòng đối soát 
     */

    function view_all($offset = 0) {
        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                ),
                'L8_check' => array(
                    'type' => 'binary',
                ),
            ),
            'right_filter' => array(
                'is_match' => array(
                    'type' => 'binary',
                ),
                'duplicate_id' => array(
                    'type' => 'binary',
                )
            )
        );
        $conditional = array();
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        //echoQuery();
        $data = $this->data;
        $data['slide_menu'] = 'cod/check_L8/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát L8';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát L8';
        $data['content'] = 'cod/check_L8/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    /*
     * Hiển thị modal sửa item
     */

    function show_edit_item($inputData = []) {
        /*
         * type mặc định là text nên nếu là text sẽ không cần khai báo
         */
        $this->list_edit = array(
            'left_table' => array(
                'id' => array(
                    'type' => 'disable'
                ),
                'code' => array(
                    'type' => 'disable'
                ),
                'money' => array(),
                'price_purchase' => array()
            ),
            'right_table' => array(
                'name' => array(
                    'type' => 'disable'
                ),
                'phone' => array(
                    'type' => 'disable'
                ),
                'time' => array(
                    'type' => 'custom'
                )
            ),
        );
        parent::show_edit_item();
    }

    function action_edit_item($id) {
        $post = $this->input->post();
        if (isset($post['edit_money'])) {
            $param['money'] = $post['edit_money'];
        }
        if (isset($post['edit_price_purchase'])) {
            $param['price_purchase'] = $post['edit_price_purchase'];
            $input = array();
            $input['where'] = array('id' => $id);
            $billID = $this->{$this->model}->load_all($input);
            if ($billID[0]['contact_id'] > 0) {
                $where = array('id' => $billID[0]['contact_id']);
                $data = array('price_purchase' => $post['edit_price_purchase']);
                $this->contacts_model->update($where, $data);
                //call log
                $data = array();
                $data['contact_id'] = $billID[0]['contact_id'];
                $data['staff_id'] = $this->user_id;
                $data['time'] = time();
                $data['content_change'] = 'Giá tiền mua: ' . $billID[0]['price_purchase'] . ' ====> ' . $post['edit_price_purchase'] . ' (sửa khi đối soát)';
                $this->load->model('call_log_model');
                $this->call_log_model->insert($data);
            }
        }
        if (isset($post['edit_money']) && isset($post['edit_price_purchase']) && $post['edit_money'] == $post['edit_price_purchase']) {
            $param['is_match'] = 1;
        } else {
            $param['is_match'] = 0;
        }
        $this->{$this->model}->update(array('id' => $id), $param);
        show_error_and_redirect('Sửa mã Bill thành công!');
    }

    public function upload_file() {
        $data = $this->data;
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $okExtensions = array('xls', 'xlsx');
            $fileParts = explode('.', $fileName);
            if (!in_array(strtolower(end($fileParts)), $okExtensions)) {
                echo 'Vui lòng chọn file đúng định dạng!';
                die;
            }
            $targetFile = APPPATH . '../public/upload/L8/' . date('Y-m-d-H-i') . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            move_uploaded_file($tempFile, $targetFile);
            $this->_import_L8($targetFile);
        } else {
            $data['slide_menu'] = 'cod/check_L8/slide-menu';
            $data['top_nav'] = 'manager/common/top-nav';
            $data['content'] = 'cod/check_L8/upload';
            $this->load->view(_MAIN_LAYOUT_, $data);
        }
//        $post = $this->input->post();
//        if (isset($post['submit'])) {
//            $file_path = '';
//            $config['upload_path'] = './public/upload/L8';
//            $config['allowed_types'] = 'xls|xlsx';
//            $config['max_size'] = '100000';
//            $config['file_name'] = date('Y-m-d-H-i');
//            $this->load->library('upload', $config);
//            if ($this->upload->do_upload('file')) {
//                $data = $this->upload->data();
//                $file_path = $data['full_path'];
//                $this->_import_L8($file_path);
//            } else {
//                $error = $this->upload->display_errors();
//                echo $error;
//            }
//        } else {
//            $data['slide_menu'] = 'cod/check_L8/slide-menu';
//            $data['top_nav'] = 'cod/common/top-nav';
//            $data['content'] = 'cod/check_L8/upload';
//            $this->load->view(_MAIN_LAYOUT_, $data);
//        }
    }

    private function _import_L8($file_path) {
        $this->load->helper('date_helper');
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A10:G7700');

        /*
         * Mảng lưu các thông tin contact L8 của Viettel.
         * Cần lưu hết thông tin để check trùng (đề phòng
         * trường hợp người dùng tải trùng file)
         */
        $receiveCOD = array();
        foreach ($data1 as $row) {
            list($stt, $code_cross_check, $date_sending, $service, $destination, $date_deliver_success, $money) = $row;
            $stt = intval($stt);
            if ($stt > 0) {
                $money = preg_replace('/\D+/', '', $money);
                $money = intval($money);
                $receiveCOD[] = array(
                    'stt' => $stt,
                    'custom_code' => 'MKI17',
                    'date_deliver_success' => date('d/m/Y', timestamp_from_format($date_deliver_success)),
                    'code' => $code_cross_check,
                    'ma_ky' => date('d/Y'),
                    'money' => $money);
            } else {
                break;
            }
        }
        foreach ($receiveCOD as $key => $value) {
            /*
             * Tìm kiếm trong bảng contact xem có mã vận đơn không
             * - Nếu có thì hiển thị thêm thông tin khách hàng
             * - Nếu không thì bỏ trống thông tin khách hàng, đồng thời báo đỏ
             */
            $input = array();
            $input['select'] = 'code_cross_check, price_purchase, name, phone, address, id';
            $input['where'] = array('code_cross_check' => $value['code'], 'ordering_status_id' => _DONG_Y_MUA_);
            $contact = $this->contacts_model->load_all($input);
            /*
             * Nếu có thì hiển thị thêm thông tin khách hàng
             */
            if (!empty($contact)) {
                $receiveCOD[$key]['contact_id'] = $contact[0]['id'];
                $receiveCOD[$key]['name'] = $contact[0]['name'];
                $receiveCOD[$key]['phone'] = $contact[0]['phone'];
                $receiveCOD[$key]['address'] = $contact[0]['address'];
                $receiveCOD[$key]['price_purchase'] = h_caculate_money($contact);
                /*
                 * Số tiền ĐVGH thu và số tiền giao cho ĐVGH phải khớp
                 */
                if (h_caculate_money($contact) == $value['money']) {
                    $receiveCOD[$key]['is_match'] = 1;
                } else {
                    $receiveCOD[$key]['is_match'] = 0;
                }
            }
            /*
             * Nếu không thì bỏ trống thông tin khách hàng, đồng thời báo đỏ (is_match = 0)
             */ else {
                $receiveCOD[$key]['is_match'] = 0;
            }
            /*
             * Tìm kiếm trong bảng l8_check_model xem có dòng đối soát chưa
             * - Nếu chưa thì duplicate_id = 0 
             * - Nếu có rồi thì duplicate_id > 0
             */
            $receiveCOD[$key]['duplicate_id'] = $this->_find_duplicate_cross_id($value);
            $receiveCOD[$key]['time'] = time();
            $this->{$this->model}->insert($receiveCOD[$key]);
        }
        // echoQuery();
        redirect(base_url('cod/doi-soat-l8.html'));
    }

    function confirm_check_l8() {
        $post = $this->input->post();

        if (empty($post['item_id'])) {
            $error = ('Vui lòng chọn đơn hàng!');
            show_error_and_redirect($error, '', false);
        }
        foreach ($post['item_id'] as $value) {
            //lọc contact khớp
            $input = array();
            $input['where'] = array('id' => $value);
            $code_cross = $this->{$this->model}->load_all($input);
            if ($code_cross[0]['is_match'] == 0 || $code_cross[0]['duplicate_id'] > 0 || $code_cross[0]['L8_check'] == 1) {
                $msg = 'Vui lòng chọn mã vận đơn trùng khớp, không bị trùng lặp và chưa lưu!';
                show_error_and_redirect($msg, '', false);
            }
        }

        $this->load->model('call_log_model');
        //print_arr($post['contact_id']);
        foreach ($post['item_id'] as $value) {
            $input = array();
            $input['where'] = array('id' => $value);
            $code_cross = $this->{$this->model}->load_all($input);
            /*
             * Update trường L8_check = 1
             */
            $where2 = array('id' => $value);
            $data2 = array('L8_check' => '1');
            $this->{$this->model}->update($where2, $data2);


            /*
             * Kiểm tra xem contact L8 đã upload từ trước chưa, 
             * nếu đã upload từ trước rồi (tức là có trạng thái cod_status là đã thu lakita)
             * thì bỏ qua
             */
            $input = array();
            $input['select'] = 'cod_status_id';
            $input['where'] = array('code_cross_check' => $code_cross[0]['code']);
            $contact = $this->contacts_model->load_all($input);
            if ($contact[0]['cod_status_id'] == _DA_THU_LAKITA_) {
                continue;
            }

            /*
             * Cập nhật trạng thái đã thu lakita
             */
            $date_deliver_success = strtotime(str_replace('/', '-', $code_cross[0]['date_deliver_success']));
            $where = array('code_cross_check' => $code_cross[0]['code']);
            $data = array('date_receive_lakita' => time(),
                'cod_status_id' => _DA_THU_LAKITA_,
                'last_activity' => time(),
                'date_deliver_success' => $date_deliver_success,
                'date_expect_receive_cod' => '0');
            if (!empty($post['date_receive_lakita'])) {
                $data['date_receive_lakita'] = strtotime($post['date_receive_lakita']) + 3600*14;
            }
            $this->contacts_model->update($where, $data);

            /*
             * Cập nhật lịch sử chăm sóc
             */
            $param['contact_id'] = $code_cross[0]['contact_id'];
            $param['staff_id'] = $this->user_id;
            $param['cod_status_id'] = _DA_THU_LAKITA_;
            $param['time'] = time();
            $this->call_log_model->insert($param);
            // echo $this->db->last_query();
        }
        //$this->_put_L8_to_MOL($receiveCOD);
        $msg = 'Cập nhật thành công contact!';
        show_error_and_redirect($msg);
    }

    private function _find_duplicate_cross_id($bill) {
        $duplicate = 0;
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array(
            // 'stt' => $bill['stt'],
            //'custom_code' => $bill['custom_code'],
            //'date_deliver_success' => $bill['date_deliver_success'],
            'code' => $bill['code'],
                //'ma_ky' => $bill['ma_ky'],
                //'money' => $bill['money']
        );
        $duplicae_id = $this->{$this->model}->load_all($input);
        if (!empty($duplicae_id)) {
            $duplicate = $duplicae_id[0]['id'];
        }
        return $duplicate;
    }

    private function _import_L8_old($file_path) {
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A11:F7700');

        /*
         * Mảng lưu các thông tin contact L8 của Viettel.
         * Cần lưu hết thông tin để check trùng (đề phòng
         * trường hợp người dùng tải trùng file)
         */
        $receiveCOD = array();
        foreach ($data1 as $row) {
            list($stt, $custom_code, $date_deliver_success, $code_cross_check, $ma_ky, $money) = $row;
            $stt = intval($stt);
            if ($stt > 0) {
                $money = str_replace(',', '', $money);
                $money = intval($money);
                $receiveCOD[] = array(
                    'stt' => $stt,
                    'custom_code' => $custom_code,
                    'date_deliver_success' => $date_deliver_success,
                    'code' => $code_cross_check,
                    'ma_ky' => $ma_ky,
                    'money' => $money);
            } else {
                break;
            }
        }
        foreach ($receiveCOD as $key => $value) {
            /*
             * Tìm kiếm trong bảng contact xem có mã vận đơn không
             * - Nếu có thì hiển thị thêm thông tin khách hàng
             * - Nếu không thì bỏ trống thông tin khách hàng, đồng thời báo đỏ
             */
            $input = array();
            $input['select'] = 'code_cross_check, price_purchase, name, phone, address, id';
            $input['where'] = array('code_cross_check' => $value['code'], 'ordering_status_id' => _DONG_Y_MUA_);
            $contact = $this->contacts_model->load_all($input);
            /*
             * Nếu có thì hiển thị thêm thông tin khách hàng
             */
            if (!empty($contact)) {
                $receiveCOD[$key]['contact_id'] = $contact[0]['id'];
                $receiveCOD[$key]['name'] = $contact[0]['name'];
                $receiveCOD[$key]['phone'] = $contact[0]['phone'];
                $receiveCOD[$key]['address'] = $contact[0]['address'];
                $receiveCOD[$key]['price_purchase'] = h_caculate_money($contact);
                /*
                 * Số tiền ĐVGH thu và số tiền giao cho ĐVGH phải khớp
                 */
                if (h_caculate_money($contact) == $value['money']) {
                    $receiveCOD[$key]['is_match'] = 1;
                } else {
                    $receiveCOD[$key]['is_match'] = 0;
                }
            }
            /*
             * Nếu không thì bỏ trống thông tin khách hàng, đồng thời báo đỏ (is_match = 0)
             */ else {
                $receiveCOD[$key]['is_match'] = 0;
            }
            /*
             * Tìm kiếm trong bảng l8_check_model xem có dòng đối soát chưa
             * - Nếu chưa thì duplicate_id = 0 
             * - Nếu có rồi thì duplicate_id > 0
             */
            $receiveCOD[$key]['duplicate_id'] = $this->_find_duplicate_cross_id($value);
            $receiveCOD[$key]['time'] = time();
            $this->{$this->model}->insert($receiveCOD[$key]);
        }
        // echoQuery();
        redirect(base_url('cod/doi-soat-l8.html'));
    }

}
