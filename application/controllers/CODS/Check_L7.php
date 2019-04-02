<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Check_L7
 *
 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 */
class Check_L7 extends MY_Table {

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    public function init() {
        $this->controller_path = 'CODS/check_L7';
        $this->view_path = 'cod/check_L7';
        $this->sub_folder = 'CODS';
        /*
         * Liệt kê các trường trong bảng
         * - nếu type = text thì không cần khai báo
         * - nếu không muốn hiển thị ra ngoài thì dùng display = none
         * - nếu trường nào cần hiển thị đặc biệt (ngoại lệ) thì để là type = custom
         */
        $list_item = array(
            'id' => array(
                'name_display' => 'ID đối soát'
            ),
            'code' => array(
                'name_display' => 'Mã bill',
                'order' => '1'
            ),
            'status' => array(
                'type' => 'custom',
                'name_display' => 'Trạng thái',
            ),
            'cod_status_id' => array(
                'name_display' => 'cod_status_id',
                'display' => 'none'
            ),
            'price_purchase' => array(
                'type' => 'currency',
                'name_display' => 'Giá mua',
            ),
            'name' => array(
                'name_display' => 'Họ tên'),
            'phone' => array(
                'name_display' => 'Số điện thoại'),
            'address' => array(
                'name_display' => 'Địa chỉ'),
            'status_date' => array(
                'type' => 'datetime',
                'name_display' => 'Ngày trạng thái',
                'order' => '1',
            ),
            'time' => array(
                'type' => 'datetime',
                'name_display' => 'Ngày tải file đối soát',
                'order' => '1',
                'display' => 'none'
            ),
            'is_match' => array(
                'name_display' => 'Contact đúng thông tin mã vận đơn',
                'display' => 'none'
            ),
            'duplicate_id' => array(
                'name_display' => 'Contact bị trùng',
                'display' => 'none'
            ),
            'L7_check' => array(
                'type' => 'custom',
                'name_display' => 'Đã lưu'
            ),
        );
        $this->set_list_view($list_item);
        $this->set_model('l7_check_model');
        $this->load->model('l7_check_model');
    }

    /*
     * override lại hàm ở lớp cha, không cho edit dòng đối soát cước
     */

    function show_edit_item() {
        die('Không thể chỉnh sửa!');
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
        }
        unset($value);
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
        $conditional['where'] = array('L7_check' => '0');
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        $data = $this->data;
        $data['slide_menu'] = 'cod/check_L7/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát L7';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát L7';
        $data['content'] = 'cod/check_L7/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function view_all($offset = 0) {
        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                ),
                'status_date' => array(
                    'type' => 'datetime',
                ),
                'status' => array(
                    'type' => 'custom'
                ),
                'L7_check' => array(
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
        $data = $this->data;
        $data['slide_menu'] = 'cod/check_L7/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát L7';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát L7';
        $data['content'] = 'cod/check_L7/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function today($offset = 0) {
        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                ),
                'L7_check' => array(
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
        $data = $this->data;
        $data['slide_menu'] = 'cod/check_L7/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát L7';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát L7';
        $data['content'] = 'cod/check_L7/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    public function upload_file() {
        $data = $this->data;
        // $post = $this->input->post();
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $okExtensions = array('xls', 'xlsx');
            $fileParts = explode('.', $fileName);
            if (!in_array(strtolower(end($fileParts)), $okExtensions)) {
                echo 'Vui lòng chọn file đúng định dạng!';
                die;
            }
            $targetFile = APPPATH . '../public/upload/L7/' . date('Y-m-d-H-i') . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            move_uploaded_file($tempFile, $targetFile);
            $this->_import_L7($targetFile);
        } else {
            $data['slide_menu'] = 'cod/check_L7/slide-menu';
            $data['top_nav'] = 'manager/common/top-nav';
            $data['content'] = 'cod/check_L7/upload';
            $this->load->view(_MAIN_LAYOUT_, $data);
        }
//        if (!empty($post)) {
//            print_arr($post);
//            $file_path = '';
//            $targetFile = './public/upload/L7';
//            $config['allowed_types'] = 'xls|xlsx';
//            $config['max_size'] = '100000';
//            $config['file_name'] = date('Y-m-d-H-i');
//            $tempFile = $_FILES['file']['tmp_name'];
//            $fileName = $_FILES['file']['name'];
//            $targetPath = getcwd() . '/uploads/';
//            $targetFile = $targetPath . $fileName;
//            $file = move_uploaded_file($tempFile, $targetFile);
//            print_arr($file);
//            $this->_import_L7($file_path);
//
//            $this->load->library('upload', $config);
//            if ($this->upload->do_upload('file')) {
//                $data = $this->upload->data();
//                $file_path = $data['full_path'];
//                $this->_import_L7($file_path);
//            } else {
//                $error = $this->upload->display_errors();
//                echo $error;
//            }
//        } else {
//            $data['slide_menu'] = 'cod/check_L7/slide-menu';
//            $data['top_nav'] = 'cod/common/top-nav';
//            $data['content'] = 'cod/check_L7/upload';
//            $this->load->view(_MAIN_LAYOUT_, $data);
//        }
    }

    private function _import_L7($file_path) {
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A1:G7700');
        $receiveCOD = array();
        foreach ($data1 as $row) {
            $stt = $row[0];
            if ($stt != '') {
                if ($row[5] == 'Thanh cong - phat thanh cong' || $row[5] == 'Phát thành công') {
                    $receiveCOD[] = array('code' => $row[0], 'status' => $row[5],
                        'cod_status_id' => _DA_THU_COD_, 'weight' => intval($row[6]), 'status_date' => strtotime(str_replace('/', '-', $row[4])));
                } else if ($row[5] == 'Thanh cong chuyen tra nguoi gui' || $row[5] == 'CHuyển trả người gửi') {
                    $receiveCOD[] = array('code' => $row[0], 'status' => $row[5],
                        'cod_status_id' => _HUY_DON_, 'weight' => intval($row[6]), 'status_date' => strtotime(str_replace('/', '-', $row[4])));
                } else {
                    continue;
                }
            } else {
                break;
            }
        }
        foreach ($receiveCOD as $key => $value) {
            $input = array();
            $input['select'] = 'code_cross_check, price_purchase, name, phone, address, id';
            $input['where'] = array('code_cross_check' => $value['code'], 'call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_);
            $contact = $this->contacts_model->load_all($input);
            if (!empty($contact)) {
                $receiveCOD[$key]['contact_id'] = $contact[0]['id'];
                $receiveCOD[$key]['name'] = $contact[0]['name'];
                $receiveCOD[$key]['phone'] = $contact[0]['phone'];
                $receiveCOD[$key]['address'] = $contact[0]['address'];
                $receiveCOD[$key]['price_purchase'] = $contact[0]['price_purchase'];
            } else {
                $receiveCOD[$key]['is_match'] = 0;
            }
            $receiveCOD[$key]['duplicate_id'] = $this->_find_duplicate_l7_id($value);
            $receiveCOD[$key]['time'] = time();
            $this->{$this->model}->insert($receiveCOD[$key]);
        }
        redirect(base_url('cod/doi-soat-l7.html'));
    }

    function confirm_check_l7() {
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
            if ($code_cross[0]['is_match'] == 0 || $code_cross[0]['duplicate_id'] > 0 || $code_cross[0]['L7_check'] == 1) {
                $msg = 'Vui lòng chọn mã vận đơn trùng khớp, không bị trùng lặp và chưa lưu!';
                show_error_and_redirect($msg, '', false);
            }
        }

        $this->load->model('call_log_model');
        foreach ($post['item_id'] as $value) {
            /*
             * Lấy ra toàn thông tin đối soát
             */
            $input = array();
            $input['where'] = array('id' => $value);
            $code_cross = $this->{$this->model}->load_all($input);
            /*
             * Update trường L7_check = 1
             */
            $where2 = array('id' => $value);
            $data2 = array('L7_check' => '1');
            $this->{$this->model}->update($where2, $data2);


            /*
             * Kiểm tra xem contact L7 đã upload từ trước chưa, 
             * nếu đã upload từ trước rồi (tức là có trạng thái cod_status là đã thu COD)
             * thì bỏ qua
             */
            $input = array();
            $input['select'] = 'cod_status_id';
            $input['where'] = array('code_cross_check' => $code_cross[0]['code']);
            $contact = $this->contacts_model->load_all($input);
            if ($code_cross[0]['cod_status_id'] == _DA_THU_COD_ && ($contact[0]['cod_status_id'] == _DA_THU_COD_ || $contact[0]['cod_status_id'] == _DA_THU_LAKITA_)) {
                continue;
            }
            if ($code_cross[0]['cod_status_id'] == _HUY_DON_ && $contact[0]['cod_status_id'] == _HUY_DON_) {
                continue;
            }

            /*
             * Cập nhật trạng thái đã thu COD hoặc hủy đơn
             */
            $where = array('code_cross_check' => $code_cross[0]['code']);
            $data = array('date_receive_cod' => time(),
                'cod_status_id' => $code_cross[0]['cod_status_id'],
                'date_expect_receive_cod' => '0',
                'last_activity' => time());
            $this->contacts_model->update($where, $data);

            /*
             * Cập nhật lịch sử chăm sóc
             */
            $param['contact_id'] = $code_cross[0]['contact_id'];
            $param['staff_id'] = $this->user_id;
            $param['cod_status_id'] = $code_cross[0]['cod_status_id'];
            $param['time'] = time();
            $this->call_log_model->insert($param);
        }
        $msg = 'Cập nhật thành công contact!';
        show_error_and_redirect($msg);
    }

    private function _find_duplicate_l7_id($bill) {
        $duplicate = 0;
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array(
            'code' => $bill['code'],
            'cod_status_id' => $bill['cod_status_id']
        );
        $duplicae_id = $this->{$this->model}->load_all($input);
        if (!empty($duplicae_id)) {
            $duplicate = $duplicae_id[0]['id'];
        }
        return $duplicate;
    }

    /*
     * ghi đè filter lớp cha
     */

    protected function _get_query_condition_arr($get) {
        $parent = parent::_get_query_condition_arr($get);
        if (isset($get['filter_status_L7']) && $get['filter_status_L7'] != '') {
            if ($get['filter_status_L7'] == 'phat-thanh-cong') {
                $parent['input_get']['group_start_like']['status'] = 'Ph&aacute;t th&agrave;nh c&ocirc;ng';
                $parent['input_get']['group_end_or_like']['status'] = 'Ph&aacute;t th&agrave;nh c&ocirc;ng';
            }
            if ($get['filter_status_L7'] == 'huy-don') {
                $parent['input_get']['like']['status'] = 'CHuyển trả người gửi';
            }
        }
        return array(
            'input_get' => $parent['input_get'],
            'has_user_order' => $parent['has_user_order']
        );
    }

}
