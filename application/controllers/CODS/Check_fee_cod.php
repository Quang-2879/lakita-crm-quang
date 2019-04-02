<?php

/**
 * Description of Check_fee_cod
 *
 * @author Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 */
class Check_fee_cod extends MY_Table {

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    public function init() {
        $this->controller_path = 'CODS/check_fee_cod';
        $this->view_path = 'cod/check_fee_cod';
        $this->sub_folder = 'CODS';
        /*
         * Liệt kê các trường trong bảng
         * - nếu type = text thì không cần khai báo
         * - nếu không muốn hiển thị ra ngoài thì dùng display = none
         * - nếu trường nào cần hiển thị đặc biệt (ngoại lệ) thì để là type = custom
         */
        $list_item = array(
            'id' => array(
                'name_display' => 'ID cước phí'
            ),
            'stt' => array(
                'name_display' => 'STT',
                'order' => '1'
            ),
            'code' => array(
                'name_display' => 'Mã bill',
                'order' => '1'
            ),
            'fee' => array(
                'type' => 'currency',
                'name_display' => 'Phí vận đơn',
                'order' => '1'
            ),
            'fee_resend' => array(
                'type' => 'currency',
                'name_display' => 'Phí chuyển hoàn',
                'order' => '1'
            ),
            'weight_envelope' => array(
                'name_display' => 'Khối lượng đơn hàng'),
            'name' => array(
                'name_display' => 'Họ tên'),
            'phone' => array(
                'name_display' => 'Số điện thoại'),
            'cod_status' => array(
                'name_display' => 'Trạng thái giao hàng'),
            'time' => array(
                'type' => 'datetime',
                'name_display' => 'Ngày tải file đối soát',
                'order' => '1'
            ),
            'duplicate_id' => array(
                'name_display' => 'Contact bị trùng',
                'display' => 'none'
            ),
            'is_match' => array(
                'name_display' => 'Contact đúng thông tin mã vận đơn',
                'display' => 'none'
            ),
            'fee_check' => array(
                'type' => 'custom',
                'name_display' => 'Đã lưu?'
            )
        );
        $this->set_list_view($list_item);
        $this->set_model('fee_cod_check_model');
        $this->load->model('fee_cod_check_model');
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
            if ($value['weight_envelope'] > 50) {
                $class .= ' bgred';
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
     * override lại hàm ở lớp cha, không cho edit dòng đối soát cước
     */

    function show_edit_item($inputData = []) {
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

//    function delete_multi_item() {
//        $post = $this->input->post();
//        if (!empty($post['item_id'])) {
//            foreach ($post['item_id'] as $value) {
//                $where = array('id' => $value);
//                $item = $this->{$this->model}->load_all(array('where' => $where));
//                if (!empty($item) && ($item[0]['is_match'] == 0 || $item[0]['duplicate_id'] > 0)) {
//                    $this->{$this->model}->delete($where);
//                } else {
//                    show_error_and_redirect('Không thể xóa contact đúng thông tin vận đơn!', '', FALSE);
//                    break;
//                }
//            }
//        }
//        show_error_and_redirect('Xóa thành công các dòng đã chọn!');
//    }

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
        $conditional['where'] = array('fee_check' => '0');
        $this->set_conditional($conditional);
        $this->set_offset($offset);
        $this->show_table();
        $data = $this->data;
        $data['slide_menu'] = 'cod/check_fee_cod/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát cước';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát cước';
        $data['content'] = 'cod/check_fee_cod/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    /*
     * Các dòng đối soát ngày hôm nay
     */

    function today($offset = 0) {
        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                ),
                'fee_check' => array(
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
        $data['slide_menu'] = 'cod/check_fee_cod/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát cước';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát cước';
        $data['content'] = 'base/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function view_all($offset = 0) {
        $this->list_filter = array(
            'left_filter' => array(
                'time' => array(
                    'type' => 'datetime',
                ),
                'fee_check' => array(
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
        $data['slide_menu'] = 'cod/check_fee_cod/slide-menu';
        $data['top_nav'] = 'manager/common/top-nav';
        $data['list_title'] = 'Kết quả đối soát cước';
        $data['edit_title'] = 'Sửa thông tin dòng đối soát cước';
        $data['content'] = 'base/index';
        $this->load->view(_MAIN_LAYOUT_, $data);
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
            $targetFile = APPPATH . '../public/upload/CUOC/' . date('Y-m-d-H-i') . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            move_uploaded_file($tempFile, $targetFile);
            $this->_import_fee_cod($targetFile);
        } else {
            $data['slide_menu'] = 'cod/check_fee_cod/slide-menu';
            $data['top_nav'] = 'manager/common/top-nav';
            $data['content'] = 'cod/check_fee_cod/upload';
            $this->load->view(_MAIN_LAYOUT_, $data);
        }
        $post = $this->input->post();
        if (isset($post['submit'])) {
            $file_path = '';
            $config['upload_path'] = './public/upload/CUOC';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = '100000';
            $config['file_name'] = date('Y-m-d-H-i');
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $data = $this->upload->data();
                $file_path = $data['full_path'];
                $this->_import_fee_cod($file_path);
            } else {
                $error = $this->upload->display_errors();
                echo $error;
            }
        } else {
            $data['slide_menu'] = 'cod/check_fee_cod/slide-menu';
            $data['top_nav'] = 'cod/common/top-nav';
            $data['content'] = 'cod/check_fee_cod/upload';
            $this->load->view(_MAIN_LAYOUT_, $data);
        }
    }

    private function _import_fee_cod($file_path) {
        $this->load->model('cod_status_model');
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);

        $rowIdCod = 0; //số thứ tự của dòng đối soát COD
        
        $sheet = $objPHPExcel->getActiveSheet();

        foreach ($sheet->getColumnIterator() as $row) {
            foreach ($row->getCellIterator() as $key => $cell) {
                if($key > 12 && $cell->getCalculatedValue() == '1'){
                    $rowIdCod = $key; 
                    break;
                }
            }
        }
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray("A$rowIdCod:I770");
        $fee = array();
        foreach ($data1 as $row) {
            list($stt, $code_cross_check, $ngay_gui, $noi_den, $dich_vu, $weight_envelope, $G, $H, $money) = $row;
            if($stt == 'Cộng:'){
                break;
            }
            $stt = intval($stt);
            $money = preg_replace('/\D+/', '', $money);
            $money = str_pad($money, 5,'0');

            $findme = 'CH';
            $pos = strpos($code_cross_check, $findme);
            //   echo $mystring. '----' . var_dump($pos). '<br>';
            if ($pos === 0) { //cước chuyển hoàn
                if ($stt > 0) {
                    $fee[] = array(
                        'stt' => $stt,
                        'ngay_gui' => $ngay_gui,
                        'ma_phieu_gui' => $code_cross_check,
                        'code' => substr($code_cross_check, 2),
                        'noi_den' => $noi_den,
                        'dich_vu' => $dich_vu,
                        'weight_envelope' => $weight_envelope,
                        'fee_resend' => $money,
                        'fee' => 0);
                }
            } else {
                if ($stt > 0) {
                    $fee[] = array(
                        'stt' => $stt,
                        'ngay_gui' => $ngay_gui,
                        'ma_phieu_gui' => $code_cross_check,
                        'code' => $code_cross_check,
                        'noi_den' => $noi_den,
                        'dich_vu' => $dich_vu,
                        'weight_envelope' => $weight_envelope,
                        'fee' => $money,
                        'fee_resend' => 0);
                }
            }
        }
        // print_arr($fee);
        foreach ($fee as $key => $value) {
            $input = array();
            $input['select'] = 'code_cross_check, price_purchase, name, phone, address, id, cod_status_id';
            $input['where'] = array('code_cross_check' => $value['code'], 'ordering_status_id' => _DONG_Y_MUA_);
            $contact = $this->contacts_model->load_all($input);
            if (!empty($contact)) {
                $fee[$key]['contact_id'] = $contact[0]['id'];
                $fee[$key]['name'] = $contact[0]['name'];
                $fee[$key]['phone'] = $contact[0]['phone'];
                $fee[$key]['address'] = $contact[0]['address'];
                $fee[$key]['cod_status'] = $this->cod_status_model->find_cod_status_desc($contact[0]['cod_status_id']);
            } else {
                $fee[$key]['is_match'] = 0;
            }
            if ($fee[$key]['weight_envelope'] > 90) {
                $fee[$key]['is_match'] = 0;
            }
            $fee[$key]['time'] = time();
            $fee[$key]['duplicate_id'] = $this->_find_duplicate_fee_id($value);
            $this->fee_cod_check_model->insert($fee[$key]);
        }
        redirect(base_url('cod/doi-soat-cuoc.html'));
    }

    function confirm_check_fee_cod() {
        $post = $this->input->post();
        /*
         * biến post lên chung là item_id[]
         */
        if (empty($post['item_id'])) {
            $error = ('Vui lòng chọn đơn hàng!');
            show_error_and_redirect($error, '', false);
        }
        $contacts = array();
        foreach ($post['item_id'] as $key => $value) {
            //lọc contact khớp
            $input = array();
            $input['where'] = array('id' => $value);
            $code_cross = $this->{$this->model}->load_all($input);
            if ($code_cross[0]['is_match'] == 0 || $code_cross[0]['duplicate_id'] > 0 || $code_cross[0]['fee_check'] == 1) {
                $msg = 'Vui lòng chọn mã vận đơn trùng khớp, không bị trùng lặp và chưa lưu!';
                show_error_and_redirect($msg, '', false);
            }
            $contacts[$key]['fee'] = $code_cross[0]['fee'];
            $contacts[$key]['fee_resend'] = $code_cross[0]['fee_resend'];
            $contacts[$key]['weight_envelope'] = $code_cross[0]['weight_envelope'];
            $contacts[$key]['code_cross_check'] = $code_cross[0]['code'];
            $contacts[$key]['id'] = $value;
        }

        $this->load->model('call_log_model');
        foreach ($contacts as $value) {
            $where = array('code_cross_check' => $value['code_cross_check']);
            $input = array();
            $input['select'] = 'id, cod_fee, fee_resend';
            $input['where'] = $where;
            $curr_contact = $this->contacts_model->load_all($input);
            $curr_fee = $curr_contact[0]['cod_fee'];
            $fee = $curr_fee + $value['fee'];

            $curr_fee_resend = $curr_contact[0]['fee_resend'];
            $fee_resend = $curr_fee_resend + $value['fee_resend'];

            $data = array('cod_fee' => $fee,
                'fee_resend' => $fee_resend,
                'weight_envelope' => $value['weight_envelope'],
                'last_activity' => time());
            $this->contacts_model->update($where, $data);

            $where2 = array('id' => $value['id']);
            $data2 = array('fee_check' => '1');
            $this->fee_cod_check_model->update($where2, $data2);

            $param['contact_id'] = $curr_contact[0]['id'];
            $param['staff_id'] = $this->user_id;
            $param['content_change'] = 'Cước vận đơn: ' . $fee . ' - Cước chuyển hoàn: ' . $fee_resend;
            $param['time'] = time();
            $this->call_log_model->insert($param);
            // echo $this->db->last_query();
        }
        $msg = 'Cập nhật thành công contact!';
        show_error_and_redirect($msg);
    }

    private function _find_duplicate_fee_id($fee) {
        $fee['fee'] = ($fee['fee'] == 0) ? '0' : $fee['fee'];
        $fee['fee_resend'] = ($fee['fee_resend'] == 0) ? '0' : $fee['fee_resend'];
        $duplicate = 0;
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array(
            'fee' => $fee['fee'],
            'fee_resend' => $fee['fee_resend'],
            'code' => $fee['code'],
        );
        $duplicae_id = $this->fee_cod_check_model->load_all($input);
        if (!empty($duplicae_id)) {
            $duplicate = $duplicae_id[0]['id'];
        }
        return $duplicate;
    }

    private function _import_fee_cod_old($file_path) {
        $this->load->model('cod_status_model');
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A8:I770');
        //print_arr($data1);
        $fee = array();
        foreach ($data1 as $row) {
            list($stt, $ngay_gui, $code_cross_check, $noi_den, $dich_vu, $weight_envelope, $G, $H, $money) = $row;
            $stt = intval($stt);
            $money = str_replace(',', '', $money);
            $money = str_replace('(', '', $money);
            $money = str_replace(')', '', $money);
            $money = intval($money);

            $findme = 'CH';
            $pos = strpos($code_cross_check, $findme);
            //   echo $mystring. '----' . var_dump($pos). '<br>';
            if ($pos === 0) { //cước chuyển hoàn
                if ($stt > 0) {
                    $fee[] = array(
                        'stt' => $stt,
                        'ngay_gui' => $ngay_gui,
                        'ma_phieu_gui' => $code_cross_check,
                        'code' => substr($code_cross_check, 2),
                        'noi_den' => $noi_den,
                        'dich_vu' => $dich_vu,
                        'weight_envelope' => $weight_envelope,
                        'fee_resend' => $money,
                        'fee' => 0);
                }
            } else {
                if ($stt > 0) {
                    $fee[] = array(
                        'stt' => $stt,
                        'ngay_gui' => $ngay_gui,
                        'ma_phieu_gui' => $code_cross_check,
                        'code' => $code_cross_check,
                        'noi_den' => $noi_den,
                        'dich_vu' => $dich_vu,
                        'weight_envelope' => $weight_envelope,
                        'fee' => $money,
                        'fee_resend' => 0);
                }
            }
        }
        // print_arr($fee);
        foreach ($fee as $key => $value) {
            $input = array();
            $input['select'] = 'code_cross_check, price_purchase, name, phone, address, id, cod_status_id';
            $input['where'] = array('code_cross_check' => $value['code'], 'ordering_status_id' => _DONG_Y_MUA_);
            $contact = $this->contacts_model->load_all($input);
            if (!empty($contact)) {
                $fee[$key]['contact_id'] = $contact[0]['id'];
                $fee[$key]['name'] = $contact[0]['name'];
                $fee[$key]['phone'] = $contact[0]['phone'];
                $fee[$key]['address'] = $contact[0]['address'];
                $fee[$key]['cod_status'] = $this->cod_status_model->find_cod_status_desc($contact[0]['cod_status_id']);
            } else {
                $fee[$key]['is_match'] = 0;
            }
            if ($fee[$key]['weight_envelope'] > 50) {
                $fee[$key]['is_match'] = 0;
            }
            $fee[$key]['time'] = time();
            $fee[$key]['duplicate_id'] = $this->_find_duplicate_fee_id($value);
            $this->fee_cod_check_model->insert($fee[$key]);
        }
        redirect(base_url('cod/doi-soat-cuoc.html'));
    }

}
