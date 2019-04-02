<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author Beto
 */
class Test extends CI_Controller {
	function test4(){		$uMessage = '01652138689';				$email = '';                $phone = '';                if (preg_match("/([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}/ix", $uMessage, $matches)) {                    $email = $matches[0];                }                if (preg_match("/(\\+84|0)\\d{9,10}/", $uMessage, $matches)) {                    $phone = $matches[0];                }				var_dump($email);				var_dump($phone);	}
    function test3(){ $this->load->model('staffs_model');        $input = array();        $input['where']['active'] = 1;        $input['where_in']['role_id'] = [1,2,6];        $staffs = $this->staffs_model->load_all($input);        echo '<pre>';        print_r($staffs);        foreach ($staffs as $key => $value){            $where = array('id' => $value['id']);            $data = array();            $data['password'] = md5(md5($value['username'].'_'.$value['id'].$value['id']));            $this->staffs_model->update($where,$data);        }
    }


    public function test1() {
        //echo date('d-m-y',1528682735);
        $this->load->model('contacts_model');
        $input = array();
        $input['select'] = 'id,name,email,phone,address,course_code,date_rgt';
        $input['where']['date_active'] = '';
        $input['where']['cod_status_id >'] = 1;
        $input['where']['cod_status_id <'] = 4;
        $input['order']['id'] = 'desc';
        $contact = $this->contacts_model->load_all($input);
        echo '<table>';
        foreach ($contact as $value) {
            echo '<tr><td>' . $value['id'] . '</td><td>' . $value['name'] . '</td><td>' . $value['email'] . '</td><td>' . $value['phone'] . '</td><td>' . $value['address'] . '</td><td>' . $value['course_code'] . '</td><td>' . $value['date_rgt'] . '</td></tr>';
        }
        echo '</table>';
    }

    public function index() {

//--URL đến Webservice
        $url = 'http://buudienhanoi.com.vn/Nhanh/BDHNNhanh.asmx?wsdl';
//--Tùy chọn để khởi tạo đối tượng SOAP client
        $options = array(
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_BOTH
        );
//--Tạo đối tượng SOAP client
        $client = new SoapClient($url, $options);
//--Lấy danh sách các hàm mà Webservice hỗ trợ (Cái này không cần thiết, tùy bạn có muốn xem thì lấy, không thì thôi)
        $functionList = $client->__getFunctions();
//--Ví dụ webservice có cung cấp hàm GetDealToDay(int iCityID,string strMerchantName, string strPassword)
//--Mình gọi hàm này từ webservice
        echo '<pre>';
        print_r($functionList);
        die;

//$param = array('Ma' => 'Lakita#BDHN');
        $param = array(
            'SoDonHang' => '155',
            'HoTenNguoiGui' => 'lakita',
            'DiaChiNguoiGui' => 'lakita',
            'DienThoaiNguoiGui' => '0123456789',
            'TenKhoHang' => 'lakita',
            'DiaChiKhoHang' => 'lakita',
            'DienThoaiLienHeKhoHang' => 'lakita',
            'HoTenNguoiNhan' => 'lakita',
            'DiaChiNguoiNhan' => 'lakita',
            'DienThoaiNguoiNhan' => '0123456789',
            'TongTrongLuong' => 2, //null
            'TongCuoc' => 2, //null
            'TongTienPhaiThu' => 295000,
            'NgayGiao' => '06/01/2018',
            'TinhThanh' => 'ha noi',
            'QuanHuyen' => 'hoang mai',
            'PhuongThuc' => 1,
            'NoiDungHang' => 'a',
            'MaPhien' => 'E12C3A30-41FF-4F25-A4E3-963E6E490A51',
            'MaBuuGui' => 'VNPOST01061801',
            'DonHangDoiTra' => FALSE //null
        );

//$result = $client->KetNoi($param);
        $result = $client->ThemYeuCauThuGom($param);

        print_r($result);

//$results = $client->GetDealToDay(array('iCityID'=>1,'strMerchantName'=>'sinhvienit.net','strPassword'=>'không nhớ')); 
//=>$results sẽ chứa kết quả webservice trả về.
//thử print_r ra xem :v
    }

    public function index2() {
        echo phpinfo();
    }

}
