<?php

/**
 * Description of Sale
 *
 * @author CHUYEN
 * git ok
 */
class Cod extends MY_Controller {

    public $L = array();

    public function __construct() {
        parent::__construct();
        $this->data['top_nav'] = 'cod/common/top-nav';
        $data['time_remaining'] = 0;
        $input = array();
        $input['select'] = 'date_recall';
        $input['where']['date_recall >'] = time();
        $input['where']['cod_status_id >'] = '0';
        $input['order']['date_recall'] = 'ASC';
        $input['limit'] = array('1', '0');
        $noti_contact = $this->contacts_model->load_all($input);
        if (!empty($noti_contact)) {
            $time_remaining = $noti_contact[0]['date_recall'] - time();
            $data['time_remaining'] = ($time_remaining < 3600 * 3) ? $time_remaining : 0;
        }
        $this->load->vars($data);


        $this->load->model('L7_check_model');
        $this->_loadCountListContact();
    }

    function index($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where'] = array('ordering_status_id' => _DONG_Y_MUA_, 'cod_status_id' => '0',
            'date_expect_receive_cod <' => strtotime('tomorrow'), 'payment_method_rgt' => '1', 'is_hide' => '0');
        $conditional['order'] = array('date_confirm' => 'DESC');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['contacts'] = $data_pagination['data'];
        $data['total_contact'] = $data_pagination['total_row'];
        $data['left_col'] = array('sale', 'date_confirm');
        $data['right_col'] = array('provider');
        $this->table .= 'date_confirm date_expect_receive_cod note_cod';
        $data['table'] = explode(' ', $this->table); //array('selection', 'contact_id');

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            'c_check_edit_contact', 'c_select_provider');

        $data['titleListContact'] = 'Danh sách contact chưa giao hàng';
        $data['actionForm'] = 'common/action_edit_multi_cod_contact';
        $informModal = 'cod/modal/edit_multi_contact cod/modal/reset_provider';
        $data['informModal'] = explode(' ', $informModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function pending($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where'] = array('cod_status_id' => _DANG_GIAO_HANG_, 'payment_method_rgt' => '1', 'is_hide' => '0');
        $conditional['order'] = array('date_print_cod' => 'ASC','code_cross_check' => 'ASC');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['contacts'] = $data_pagination['data'];
        $data['total_contact'] = $data_pagination['total_row'];
        // echo $this->db->last_query();
        $data['left_col'] = array('date_confirm', 'date_print_cod');
        $data['right_col'] = array('provider');
        $this->table .= 'date_print_cod provider code_cross_check';
        $data['table'] = explode(' ', $this->table);
        /*
         * Các file js cần load
         */
        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            'c_select_provider', 'c_export_to_string', 'c_export_excel');


        $data['titleListContact'] = 'Danh sách contact đang giao hàng';
        $data['actionForm'] = 'common/action_edit_multi_cod_contact';
        $informModal = 'cod/modal/edit_multi_contact';
        $data['informModal'] = explode(' ', $informModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function tracking($offset = 0) {
        $this->load->model('viettel_log_model');
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where'] = array('payment_method_rgt' => '1', 'is_hide' => '0', 'provider_id' => 1);
        $conditional['order'] = array('date_print_cod' => 'DESC');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['total_contact'] = $data_pagination['total_row'];
        $contacts = $data_pagination['data'];
        foreach ($contacts as &$value) {
            $input = [];
            $input['where'] = ['code_cross_check' => $value['code_cross_check']];
            $input['order'] = ['date_info' => 'ASC', 'status' => 'ASC'];
            $value['vietel_log'] = $this->viettel_log_model->load_all($input);
        }
        unset($value);
        $data['contacts'] = $contacts;
        $data['left_col'] = array('date_print_cod', 'viettel_status');
        $data['right_col'] = array('cod_status');
        $this->table = 'contact_info viettel_log';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            'c_select_provider', 'c_export_to_string', 'c_export_excel');

        $data['titleListContact'] = 'Theo dõi hành trình dơn hàng Viettel';
        $data['actionForm'] = 'common/action_edit_multi_cod_contact';
        $informModal = 'cod/modal/edit_multi_contact';
        $data['informModal'] = explode(' ', $informModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function transfer($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where'] = array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
            'cod_status_id' => '0', 'payment_method_rgt >' => '1', 'is_hide' => '0');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['contacts'] = $data_pagination['data'];
        $data['total_contact'] = $data_pagination['total_row'];
        // echo $this->db->last_query();
        $data['left_col'] = array('date_confirm');
        $data['right_col'] = array('cod_status');
        $this->table .= 'date_confirm cod_status';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            'c_check_edit_contact', 'c_select_provider', 'c_export_to_string', 'c_export_excel');


        $data['titleListContact'] = 'Danh sách contact chuyển khoản';
        $data['actionForm'] = 'common/action_edit_multi_cod_contact';
        $informModal = 'cod/modal/edit_multi_contact';
        $data['informModal'] = explode(' ', $informModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    function export_for_send_provider() {
        /* ====================xuất file excel============================== */
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            show_error_and_redirect('Vui lòng chọn contact cần xuất file excel', '', 0);
        }
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setSize(11)->setBold(true)->setName('Times New Roman');
        //     ->getColor()->setRGB('FFFFFF')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size' => 15,
                'name' => 'Times New Roman'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('548235');
        $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle("A2:I100")->getFont()->setSize(15)->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(73);

        //set độ rộng của các cột
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(55);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);

        //set tên các cột cần in
        $columnName = 'A';
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'STT');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Mã Bill');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Nội dung');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Tên người nhận');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Số điện thoại người nhận');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Địa chỉ');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Số tiền thu');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName . $rowCount, 'Ghi chú');
        $rowCount++;

        //đổ dữ liệu ra file excel
        $contact_export = $this->_contact_export($post['contact_id']);
        foreach ($contact_export as $key => $value) {
            if ($value['cb'] > 1) {
                $course_name = 'Combo ' . $value['cb'] . ' khóa học';
            } else {
                $course_name = $value['course_name'];
            }
            $columnName = 'A';
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $key + 1);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['code_cross_check']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $course_name);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['price_purchase']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName . $rowCount, $value['note_cod']);
            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(35);
            $BStyle = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THICK,
                        'color' => array('rgb' => '151313')
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':' . $columnName . $rowCount)->applyFromArray($BStyle);
            $rowCount++;
        }
        foreach (range('A', $columnName) as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $fileName = FCPATH . 'public/upload/EmailViettel/02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d') . '.xlsx';
        if (file_exists($fileName)) {
            $fileName = FCPATH . 'public/upload/EmailViettel/02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d-H.i.s') . '.xlsx';
            $objWriter->save($fileName);
        } else {
            $objWriter->save($fileName);
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        die;
        /* ====================xuất file excel (end)============================== */
    }

    public function SendEmailToProvider() {
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            show_error_and_redirect('Vui lòng chọn contact cần xuất file excel', '', 0);
        }
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size' => 15,
                'name' => 'Times New Roman'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('548235');
        $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
        $objPHPExcel->getActiveSheet()->getStyle("A2:I100")->getFont()->setSize(15)->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(73);

        //set độ rộng của các cột

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(55);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);

        //set tên các cột cần in
        $columnName = 'A';
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'STT');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Mã Bill');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Nội dung');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Tên người nhận');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Số điện thoại người nhận');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Địa chỉ');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, 'Số tiền thu');
        $objPHPExcel->getActiveSheet()->SetCellValue($columnName . $rowCount, 'Ghi chú');
        $rowCount++;

        //đổ dữ liệu ra file excel
        $contact_export = $this->_contact_export($post['contact_id']);
        foreach ($contact_export as $key => $value) {
            //   if ($value['provider_id'] != 1) {
            //    show_error_and_redirect('Cần chọn đúng đơn vị giao hàng Viettel!', $post['back_location'], false);
            //      }
            if ($value['cb'] > 1) {
                $course_name = 'Combo ' . $value['cb'] . ' khóa học';
            } else {
                $course_name = $value['course_name'];
            }
            $columnName = 'A';
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $key + 1);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['code_cross_check']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $course_name);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['price_purchase']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName . $rowCount, $value['note_cod']);
            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(35);
            $BStyle = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THICK,
                        'color' => array('rgb' => '151313')
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':' . $columnName . $rowCount)->applyFromArray($BStyle);
            $rowCount++;
        }
        foreach (range('A', $columnName) as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $fileName = FCPATH . 'public/upload/EmailViettel/02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d') . '.xlsx';
        if (file_exists($fileName)) {
            $fileName = FCPATH . 'public/upload/EmailViettel/02.Lakita_gui_danh_sach_khach_hang v' . date('Y.m.d-H.i.s') . '.xlsx';
            $objWriter->save($fileName);
        } else {
            $objWriter->save($fileName);
        }
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '6000';
        $config['smtp_user'] = 'lakitavn@gmail.com';
        $config['smtp_pass'] = 'lakita2016';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;
        $this->load->library("email");
        $this->email->initialize($config);
        $this->email->from('cskh@lakita.vn', "lakita.vn");
        $this->email->to('dieuhanhminhkhai@gmail.com'); // dieuhanhminhkhai@gmail.com
        $this->email->subject('Lakita gửi danh sách đơn ngày ' . date('d/m/Y'));
        $this->email->message('Anh cho em gửi  danh sách COD ngày ' . date('d/m/Y') . '. Anh giúp em với ạ. Em cảm ơn ạ!');
        $this->email->attach($fileName);
        $this->email->send();

        show_error_and_redirect('Gửi email thành công', $post['back_location']);
    }
    
    function export_for_send_vnpost2() {
        $this->load->model('vnpost_key_model');
        $this->load->model('contacts_model');
        $this->load->model('Courses_model');
        $post = $this->input->post();

        $contacts = array();
        $i = 0;
        foreach ($post as $key => $value) {
            $input = array();
            $input['select'] = 'id, phone, code_cross_check, course_code, name, address, price_purchase, note_cod, provider_id';
            $input['where'] = array('id' => $key);
            $contact = $this->contacts_model->load_all($input);
            //tìm xem số đt của contact có trong mảng contacts hay chưa, 
            //nếu chưa thì thêm vào, nếu có thì cộng tiền
            $position = found_position_in_array($contact[0]['phone'], $contacts);
            if ($position == -1) {
                $contacts[$i] = array(
                    'id' => $contact[0]['id'],
                    'code_cross_check' => $contact[0]['code_cross_check'],
                    'course_code' => $contact[0]['course_code'],
                    'course_name' => $this->Courses_model->find_course_name($contact[0]['course_code']),
                    'name' => $contact[0]['name'],
                    'phone' => $contact[0]['phone'],
                    'address' => $contact[0]['address'],
                    'price_purchase' => $contact[0]['price_purchase'],
                    'note_cod' => $contact[0]['note_cod'],
                    'cb' => 1,
                    'provider_id' => $contact[0]['provider_id'],
                    'city' => substr($value[0], 3),
                    'district' => $value[1]
                );
                $i++;
            } else {
                $contacts[$position]['price_purchase'] += $contact[0]['price_purchase'];
                $contacts[$position]['course_name'] = 'Khóa học combo';
                $contacts[$position]['cb'] += 1;
            }
        }
        
         $no_provider = array();

          foreach ($contacts as $key => $value) {
          if($value['code_cross_check'] != '' && $value['provider_id'] == 8){

          $serviceClient = new SoapClient("http://buudienhanoi.com.vn/Nhanh/BDHNNhanh.asmx?WSDL");
          $obj_con = new stdClass();
          $obj = new stdClass();
          $ptDonHang = new stdClass();
          $ptThuDonHang = new stdClass();
          $obj_con->Ma = "Lakita#BDHN";
          $result_con = $serviceClient->KetNoi($obj_con);
          $verify = $result_con->KetNoiResult;

          $ptDonHang->SoDonHang = $value['code_cross_check'];
          $ptDonHang->HoTenNguoiGui = 'lakita';
          $ptDonHang->DiaChiNguoiGui = '701 CT1 skylight 125D Minh Khai, Hai Bà Trưng, Hà Nội';
          $ptDonHang->DienThoaiNguoiGui = '01663923279';
          $ptDonHang->TenKhoHang = 'lakita';
          $ptDonHang->DiaChiKhoHang = '701 CT1 skylight 125D Minh Khai, Hai Bà Trưng, Hà Nội';
          $ptDonHang->DienThoaiLienHeKhoHang = '01663923279';
          $ptDonHang->HoTenNguoiNhan = $value['name'];
          $ptDonHang->DiaChiNguoiNhan = $value['address'];
          $ptDonHang->DienThoaiNguoiNhan = $value['phone'];
          $ptDonHang->TongTrongLuong = '10';
          $ptDonHang->TongCuoc = $value['price_purchase'];
          $ptDonHang->TongTienPhaiThu = $value['price_purchase'];
          $ptDonHang->NgayGiao = date('m-d-Y', time());
          $ptDonHang->TinhThanh = $value['city'];
          $ptDonHang->QuanHuyen = $value['district'];
          $ptDonHang->PhuongThuc = '1';
          $ptDonHang->NoiDungHang = 'xfdf';
          $ptDonHang->MaPhien = $verify;
          $ptDonHang->DonHangDoiTra = 'false';
          $ptDonHang->MaHuyenPhat = '0';
          $ptDonHang->iddichvu = '1';
          $result = $serviceClient->TaoYeuCauThuGom2017($ptDonHang);

          $result_code = substr($result->TaoYeuCauThuGom2017Result, 0,2);
          if($result_code == 99){
          $data['contact_id'] = $value['id'];
          $data['itemID_vnpost'] = substr($result->TaoYeuCauThuGom2017Result, 3);
          $data['code_cross_check'] = $value['code_cross_check'];
          $data['time'] = time();
          $this->vnpost_key_model->insert($data);
          }

          }else{
          $no_provider[] = $value['name'] . ' - ' . $value['phone'];
          }
          }

          if(!empty($no_provider)){
          $str_no_provider = implode(', ', $no_provider);
          show_error_and_redirect('Những contact sau đơn vị vận chuyển không phải vnpost ' .$str_no_provider , 'contact-dang-giao-hang.html', 0);
          } else {
          show_error_and_redirect('Gửi thông tin thành công','contact-dang-giao-hang.html');
          }
    }

    function find_district() {
        $this->load->model('quanhuyen_model');
        $post = $this->input->post();
        
        $city_id = $post['city_id'];
        $id = substr($city_id, 0, 2);
        $input['where']['matp'] = $id;
        $quanhuyen = $this->quanhuyen_model->load_all($input);
        $data['quanhuyen'] = $quanhuyen;
        $this->load->view('cod/select_district',$data);
    }

    function export_for_send_vnpost() {
        $this->load->helper('common_helper');
        $this->load->model('vnpost_key_model');
        $this->load->model('tinhthanhpho_model');
        $post = $this->input->post();




        if (empty($post['contact_id'])) {
            show_error_and_redirect('Vui lòng chọn contact cần xuất file excel', '', 0);
        }

        $contact_export = $this->_contact_export($post['contact_id']);
        
        foreach ($contact_export as $key => $value){
            if($value['provider_id'] != 8){
                unset($contact_export[$key]);
            }
        }
        
        if(empty($contact_export)){
            show_error_and_redirect('Hãy chọn những contact có đơn vị giao hàng là VNPOST' , 'contact-dang-giao-hang.html', 0);
        }
        
        $data['contact_export'] = $contact_export;
        $data['city'] = $this->tinhthanhpho_model->load_all();
        $this->load->view('cod/select_city', $data);
        /**
         

         */
    }
    
    function export_for_print() {
        /* ====================xuất file excel============================== */
        $this->load->model('courses_model');
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            show_error_and_redirect('Vui lòng chọn contact cần xuất file excel', '', 0);
        }
                
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
        $template_file_print = $this->config->item('template_file_print');
        $objPHPExcel = $objPHPExcel->load($template_file_print);
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 3;
        $contact_export = $this->_contact_export($post['contact_id']);
        foreach ($contact_export as $key => $value) {
            if ($value['cb'] > 1) {
                $course_code = 'CB' . $value['cb'] . '00';
                $course_name = 'Combo '. $value['cb'] . ' khóa học';
            } else {
                $course_code = $value['course_code'];
                $course_name = $this->courses_model->find_course_name($value['course_code']);
            }
            $columnName = 'A';
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $key + 1);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $course_code);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, number_format($value['price_purchase'], 0, ",", ".") . " VNĐ");
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName++ . $rowCount, $value['note_cod']);
            $objPHPExcel->getActiveSheet()->SetCellValue($columnName . $rowCount, $course_name);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Contact_' . date('d/m/Y') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

    function view_all_contact($offset = 0) {
        $data = $this->_get_all_require_data();
        $get = $this->input->get();
        $conditional['where'] = array('ordering_status_id' => _DONG_Y_MUA_, 'is_hide' => '0');
        $data_pagination = $this->_query_all_from_get($get, $conditional, $this->per_page, $offset);
        $data['pagination'] = $this->_create_pagination_link($data_pagination['total_row']);
        $data['contacts'] = $data_pagination['data'];
        //print_arr($data['contacts']);
        $data['total_contact'] = $data_pagination['total_row'];
        $data['left_col'] = array('sale', 'date_print_cod', 'date_confirm', 'date_receive_cod', 'date_receive_lakita',);
        $data['right_col'] = array('provider', 'warning', 'payment_method_rgt', 'cod_status');
        $this->table .= 'date_print_cod provider code_cross_check cod_status';
        $data['table'] = explode(' ', $this->table);

        /*
         * Các file js cần load
         */

        $data['load_js'] = array(
            'common_view_detail_contact', 'common_real_filter_contact', 'common_edit_contact',
            'c_check_edit_contact', 'c_select_provider', 'c_export_to_string');

        $data['titleListContact'] = 'Danh sách toàn bộ contact';
        $data['actionForm'] = 'common/action_edit_multi_cod_contact';
        $informModal = 'cod/modal/edit_multi_contact';
        $data['informModal'] = explode(' ', $informModal);

        $data['content'] = 'common/list_contact';
        $this->load->view(_MAIN_LAYOUT_, $data);
    }

    public function export_to_string() {
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            $error = ('Vui lòng chọn đơn hàng!');
            show_error_and_redirect($error, '', false);
        }
        $result = '';
        foreach ($post['contact_id'] as $value) {
            $input = array();
            $input['select'] = 'code_cross_check';
            $input['where'] = array('id' => $value);
            $contact = $this->contacts_model->load_all($input);
            if ($contact[0]['code_cross_check'] != '') {
                $result .= trim($contact[0]['code_cross_check']) . ',' . PHP_EOL;
            }
        }
        $data['result'] = $result;
        $this->load->view('cod/modal/export_to_string', $data);
    }

    public function ResetBillCode() {
        $post = $this->input->post();
        if (empty($post['contact_id'])) {
            $error = ('Vui lòng chọn đơn hàng!');
            show_error_and_redirect($error, '', false);
        }
        $this->load->model('cod_cross_check_model');
        $today = date('dmy');
        $where = array('date_print_cod' => $today, 'provider_id' => $post['provider_id_reset']);
        $this->cod_cross_check_model->delete($where);

        foreach ($post['contact_id'] as $value) {
            $where = array('date_print_cod' => $today,
                'phone' => $this->contacts_model->get_contact_phone($value));
            $this->cod_cross_check_model->delete($where);

            $where = array('id' => $value);
            $data = array('code_cross_check' => '');
            $this->contacts_model->update($where, $data);
        }
        show_error_and_redirect('Đặt lại đơn hàng thành công!');
    }

    private function _get_all_require_data() {
        $require_model = array(
            'staffs' => array(
                'where' => array(
                    'role_id' => 1,
                    'active' => 1
                )
            ),
            'courses' => array(
                'where' => array('active' => '1'),
                'order' => array(
                    'course_code' => 'ASC'
                )
            ),
            'providers' => array(),
            'cod_status' => array(),
            'payment_method_rgt' => array()
        );
        return array_merge($this->data, $this->_get_require_data($require_model));
    }

    function read() {
        $this->load->library('PHPExcel');
        // $objPHPExcel = PHPExcel_IOFactory::load('C:/xampp/htdocs/CRM_GIT/public/upload/L7/data.xlsx');
        $objPHPExcel = PHPExcel_IOFactory::load('/home/lakita.com.vn/public_html/sub/crm2/public/upload/data.xlsx');
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A1:V5970');
        $str = 'INSERT INTO tbl_contact 
                                        (`name` ,
                                            `email` ,  
                                            `phone` ,
                                            `address`,
                                            `course_code` ,
                                            `price_purchase`,
                                            `payment_method_rgt` ,
                                            `date_rgt`,
                                            `date_handover` ,
                                            `date_last_calling` ,
                                            `date_confirm` ,
                                            `call_status_id` ,
                                            `ordering_status_id` ,
                                            `cod_status_id` ,
                                            `sale_staff_id` ,
                                            `matrix` ,
                                            `date_deliver_cod`,
                                            `date_receive_cod`,
                                            `date_receive_lakita`,
                                            `date_receive_cancel_cod`,
                                            `provider_id`,
                                            `code_cross_check`)
                                        VALUES 
                                         ';
        /* 0 `name` , 
          1 `email` ,
          2 `phone` ,
          3 `address`,
          4 `course_code` ,
          5 `price_purchase`,
          6 `payment_method_rgt` ,
          7 `date_rgt`,
          8 `date_handover` ,
          9 `date_last_calling` ,
          10 `date_confirm` ,
          11 `call_status_id` ,
          12 `ordering_status_id` ,
          13 `cod_status_id` ,
          14 `sale_staff_id` ,
          15`matrix` ,
          16`date_deliver_cod`,
          17`date_receive_cod`,
          18`date_receive_lakita`,
          19`date_receive_cancel_cod`,
          20`provider_id`,
          21 `code_cross_check` */
        // print_r($data1);
        foreach ($data1 as $row) {
            $str .= '(';
            foreach ($row as $key => $value) {
                $data = str_replace("'", "''", $value);
                if ($key == 7 || $key == 8 || $key == 9 || $key == 10 || $key == 16 || $key == 17 || $key == 18 || $key == 19)
                    $data = intval($data);
                if ($key == 21)
                    $str .= "'$data'";
                else
                    $str .= "'$data',";
            }
            $str .= '), <br>';
        }
        echo $str;
    }

    private function _contact_export($ids) {
        $this->load->model('Courses_model');
        $contacts = array();
        $i = 0;
        foreach ($ids as $value) {
            $input = array();
            $input['select'] = 'id, phone, code_cross_check, course_code, name, address, price_purchase, note_cod, provider_id';
            $input['where'] = array('id' => $value);
            $contact = $this->contacts_model->load_all($input);
            //tìm xem số đt của contact có trong mảng contacts hay chưa, 
            //nếu chưa thì thêm vào, nếu có thì cộng tiền
            $position = found_position_in_array($contact[0]['phone'], $contacts);
            if ($position == -1) {
                $contacts[$i] = array(
                    'id' => $contact[0]['id'],
                    'code_cross_check' => $contact[0]['code_cross_check'],
                    'course_code' => $contact[0]['course_code'],
                    'course_name' => $this->Courses_model->find_course_name($contact[0]['course_code']),
                    'name' => $contact[0]['name'],
                    'phone' => $contact[0]['phone'],
                    'address' => $contact[0]['address'],
                    'price_purchase' => $contact[0]['price_purchase'],
                    'note_cod' => $contact[0]['note_cod'],
                    'cb' => 1,
                    'provider_id' => $contact[0]['provider_id']
                );
                $i++;
            } else {
                $contacts[$position]['price_purchase'] += $contact[0]['price_purchase'];
                $contacts[$position]['course_name'] = 'Khóa học combo';
                $contacts[$position]['cb'] += 1;
            }
        }
        return $contacts;
    }

    public function test() {
//        $param = 'hih';
//        if ($param != 1) {
//            throw new Exception("$param should be an Foo instance.");
//        }
        // throw new Exception('Tự xác ở đây...');
        require_once APPPATH . "vendor/autoload.php";
        $client = new GuzzleHttp\Client(['base_uri' => 'https://sheets.googleapis.com/v4/spreadsheets/18x9FB074aMpgm66PbaPMtmol6HgG6eeidl3P5wJcH6w/values/Sheet1!A1:C?key=AIzaSyCdjll4ib79ZGtUEEEAxksl6zff2NkLCII']);
        $response = $client->request('GET');
        $body = $response->getBody();
        print_arr(GuzzleHttp\json_decode($body));
    }

    private function _loadCountListContact() {
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('ordering_status_id' => _DONG_Y_MUA_, 'cod_status_id' => '0',
            'date_expect_receive_cod <' => strtotime('tomorrow'), 'payment_method_rgt' => '1', 'is_hide' => '0');
        $this->L['L6'] = count($this->contacts_model->load_all($input));

        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('cod_status_id' => _DANG_GIAO_HANG_, 'payment_method_rgt' => '1', 'is_hide' => '0');
        $this->L['pending'] = count($this->contacts_model->load_all($input));

        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('call_status_id' => _DA_LIEN_LAC_DUOC_, 'ordering_status_id' => _DONG_Y_MUA_,
            'cod_status_id' => '0', 'payment_method_rgt >' => '1', 'is_hide' => '0');
        $this->L['transfer'] = count($this->contacts_model->load_all($input));


        $input = array();
        $input['select'] = 'id';
        $input['where'] = array('ordering_status_id' => _DONG_Y_MUA_, 'is_hide' => '0');
        $this->L['all'] = count($this->contacts_model->load_all($input));
    }

    public function report_cod_operation() {
        $this->load->helper('manager_helper');

        $this->load->helper('common_helper');
        $this->load->model('providers_model');
        $this->load->model('contacts_model');
        $get = $this->input->get();


        $provider = array();
        $provider[] = array(
            'id' => -1,
            'name' => 'Khác',
            'prefix' => 'khac'
        );
        $provider[] = array(
            'id' => 1,
            'name' => 'Viettel',
            'prefix' => 'viettel'
        );
        $provider[] = array(
            'id' => 0,
            'name' => 'Chuyển khoản ngân hàng',
            'prefix' => 'chuyen_khoan'
        );
        $provider[] = array(
            'id' => -2,
            'name' => 'Trung bình',
            'prefix' => 'avg'
        );
        
        $data = $this->_get_all_require_data();
        
        $typeDate = 'date_rgt';

        if ((!isset($get['filter_date_happen_from']) && !isset($get['filter_date_happen_end'])) || (isset($get['filter_date_happen_from']) && $get['filter_date_happen_from'] == '' && $get['filter_date_happen_end'] == '')) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $startDate = strtotime(date('1-m-Y'));

            $endDate = strtotime(date('d-m-Y'));
        } else {

            $startDate = strtotime($get['filter_date_happen_from']);

            $endDate = strtotime($get['filter_date_happen_end']);
        }
        $dateArray = h_get_time_range($startDate, $endDate);



        $report = array();

        foreach ($provider as $value) {
            $total = 0;
            foreach ($dateArray as $d_key => $d_value) {
                $input = array();
                $input['where'][$typeDate . ' >='] = $startDate;
                $input['where'][$typeDate . ' <='] = $d_value + 86400 - 1;
                $input['where']['payment_method_rgt !='] = 2;
                $input['where']['ordering_status_id'] = 4;
                $input['where']['cod_status_id'] = 4;

                $input2 = array();
                $input2['where'][$typeDate . ' >='] = $startDate;
                $input2['where'][$typeDate . ' <='] = $d_value + 86400 - 1;
                $input2['where']['payment_method_rgt !='] = 2;
                $input2['where']['ordering_status_id'] = 4;

                if ($value['id'] == 1) {
                    $input['where']['provider_id'] = 1;
                    $input2['where']['provider_id'] = 1;
                } elseif ($value['id'] == 0) {
                    $input = array();
                    $input['where'][$typeDate . ' >='] = $startDate;
                    $input['where'][$typeDate . ' <='] = $d_value + 86400 - 1;
                    $input['where']['payment_method_rgt'] = 2;
                    $input['where']['ordering_status_id'] = 4;
                    $input['where']['cod_status_id'] = 4;

                    $input2 = array();
                    $input2['where'][$typeDate . ' >='] = $startDate;
                    $input2['where'][$typeDate . ' <='] = $d_value + 86400 - 1;
                    $input2['where']['payment_method_rgt'] = 2;
                    $input2['where']['ordering_status_id'] = 4;
                } elseif ($value['id'] == -1) {
                    $input['where']['provider_id !='] = 1;
                    $input2['where']['provider_id !='] = 1;
                } else {
                    $input = array();
                    $input['where'][$typeDate . ' >='] = $startDate;
                    $input['where'][$typeDate . ' <='] = $d_value + 86400 - 1;
                    $input['where']['ordering_status_id'] = 4;
                    $input['where']['cod_status_id'] = 4;

                    $input2 = array();
                    $input2['where'][$typeDate . ' >='] = $startDate;
                    $input2['where'][$typeDate . ' <='] = $d_value + 86400 - 1;
                    $input2['where']['ordering_status_id'] = 4;
                }
                
                if(isset($get['filter_sale_id']) && !empty($get['filter_sale_id'])){
                    $input['where_in']['sale_staff_id'] = $get['filter_sale_id'];
                    $input2['where_in']['sale_staff_id'] = $get['filter_sale_id'];
                }
                
                
                $num_contact_del = count($this->contacts_model->load_all($input));
                $num_contact_l6 = count($this->contacts_model->load_all($input2));
                //echo $this->db->last_query();die;
                

                $report[$value['prefix']]['del'][$d_key] = $num_contact_del;
                $report[$value['prefix']]['L6'][$d_key] = $num_contact_l6;
            }
        }

        $report_percent = array();

        foreach ($dateArray as $d_key => $d_value) {
            foreach ($provider as $value) {
                $report_percent[$d_key][$value['prefix']] = ($report[$value['prefix']]['L6'][$d_key] > 0) ?
                        round(($report[$value['prefix']]['del'][$d_key] / $report[$value['prefix']]['L6'][$d_key]) * 100, 2) : 0;
            }
        }
//        echo '<pre>';
////        print_r($provider);
////        print_r($report);
//        print_r($report_percent);
//        die;

        $data['left_col'] = array('date_happen', 'sale');

        $data['right_col'] = array('channel');



        $data['startDate'] = isset($startDate) ? $startDate : '0';

        $data['endDate'] = isset($endDate) ? $endDate : '0';

        $data['per_day'] = $report_percent;

        $data['slide_menu'] = 'manager/common/menu';

        $data['top_nav'] = 'manager/common/top-nav';

        $data['content'] = 'cod/report_cod_operation';

        $this->load->view(_MAIN_LAYOUT_, $data);
    }

}
