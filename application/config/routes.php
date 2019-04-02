<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['dang-nhap.html'] = 'home/index';

$route['quan-ly/trang-chu.html'] = 'manager/index';
$route['quan-ly/contact-moi-trung.html'] = 'manager/new_duplicate';
$route['quan-ly/xem-tat-ca-contact.html'] = 'manager/view_all_contact';
$route['quan-ly/contact-dang-phan-nhap.html'] = 'manager/draft_divide_contact_even3';
$route['quan-ly/tim-kiem-contact.html'] = 'manager/find_contact';
$route['quan-ly/them-contact.html'] = 'manager/add_contact';
$route['quan-ly/xem-bao-cao-tu-van-tuyen-sinh.html'] = 'manager/view_report_sale';
$route['quan-ly/xem-bao-cao-doanh-thu.html'] = 'manager/view_report_revenue';
$route['quan-ly/bao-cao-tong-hop.html'] = 'manager/view_general_report/course';

$route['tu-van-tuyen-sinh/trang-chu.html'] = 'sale/index';
$route['tu-van-tuyen-sinh/contact-co-lich-hen.html'] = 'sale/has_callback';
$route['tu-van-tuyen-sinh/contact-con-cuu-duoc.html'] = 'sale/can_save';
$route['tu-van-tuyen-sinh/xem-tat-ca-contact.html'] = 'sale/view_all_contact';
$route['tu-van-tuyen-sinh/tim-kiem-contact.html'] = 'sale/find_contact';
$route['tu-van-tuyen-sinh/them-contact.html'] = 'sale/add_contact';
$route['tu-van-tuyen-sinh/xem-bao-cao.html'] = 'sale/view_report';

$route['giang-vien/danh-sach-da-dang-ky.html'] = 'teacher';
$route['giang-vien/doanh-thu-theo-khoa.html'] = 'teacher/top_revenue';
$route['giang-vien/tong-doanh-thu-theo-thang.html'] = 'teacher/view_report';

$route['cod/trang-chu.html'] = 'cod/index';
$route['cod/contact-dang-giao-hang.html'] = 'cod/pending';
$route['cod/contact-chuyen-khoan.html'] = 'cod/transfer';
$route['cod/tim-kiem-contact.html'] = 'cod/find_contact';
$route['cod/xem-tat-ca-contact.html'] = 'cod/view_all_contact';


$route['cod/tai-file-doi-soat-l7.html'] = 'CODS/check_L7/upload_file';
$route['cod/doi-soat-l7.html'] = 'CODS/check_L7';
$route['cod/doi-soat-l7/xem-tat-ca.html'] = 'CODS/check_L7/view_all';
$route['cod/doi-soat-l7/ket-qua-doi-soat-hom-nay.html'] = 'CODS/check_L7/today';


$route['cod/tai-file-doi-soat-l8.html'] = 'CODS/check_L8/upload_file';
$route['cod/doi-soat-l8.html'] = 'CODS/check_L8';
$route['cod/doi-soat-l8/xem-tat-ca.html'] = 'CODS/check_L8/view_all';
$route['cod/doi-soat-l8/ket-qua-doi-soat-hom-nay.html'] = 'CODS/check_L8/today';

$route['cod/tai-file-doi-soat-cuoc.html'] = 'CODS/check_fee_cod/upload_file';
$route['cod/doi-soat-cuoc.html'] = 'CODS/check_fee_cod';
$route['cod/doi-soat-cod/xem-tat-ca.html'] = 'CODS/check_fee_cod/view_all';
$route['cod/doi-soat-cod/ket-qua-doi-soat-hom-nay.html'] = 'CODS/check_fee_cod/today';

$route['cod/tim-kiem-contact.html'] = 'cod/find_contact';
$route['cod/xem-tat-ca-contact.html'] = 'cod/view_all_contact';

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
