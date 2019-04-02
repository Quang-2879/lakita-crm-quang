<?php

class FB_notification extends CI_Controller {

    function index() {
        // verification
        // if ($_GET['hub_verify_token'] === 'huynv') {
        // 			echo $_GET['hub_challenge'];
        // 		}
        //
  			if (file_get_contents('php://input')) {
            $comment = json_decode(file_get_contents('php://input'));
            $commentId = $comment->entry[0]->changes[0]->value->id;
            $pageId = explode('_', $commentId);
            $input = [];
            $input['where'] = array('comment_id' => $commentId);
            $this->load->model('facebook_comment_plugin_model');
            $commentExist = $this->facebook_comment_plugin_model->load_all($input);
            if (empty($commentExist)) {
                $this->facebook_comment_plugin_model->insert(['comment_id' => $commentId, 'time' => date(_DATE_FORMAT_)]);
                $url = [
                    '1732177853493516' => 'https://lakita.vn/bao-hiem-xa-hoi-tien-luong-thue-thu-nhap-ca-nhan-2018.html',
                    '1298443350192736' => 'https://lakita.vn/ky-thuat-quyet-toan-thue.html',
                    '1242593289171565' => 'https://lakita.vn/quyet-toan-thue-tu-a-den-z.html',
                    '1778639972164393' => 'https://lakita.vn/lap-bao-cao-tai-chinh-2016.html',
                    '1062159213912728' => 'https://lakita.vn/lap-bao-cao-tai-chinh-2017.html',
                    '1665697290129137' => 'https://lakita.vn/tron-bo-lap-bao-cao-tai-chinh-2017.html',
                    '1526592320757326' => 'https://lakita.vn/tron-bo-lap-bao-cao-tai-chinh-2017-trinhbtk2.html',
                    '1820232718010252' => 'https://lakita.vn/tron-bo-lap-bao-cao-tai-chinh-2017-345k.html',
                    '1270921559703857' => 'https://lakita.vn/cach-xac-dinh-chi-phi-hop-ly.html',
                    '1784191251590929' => 'https://lakita.vn/cach-xac-dinh-chi-phi-hop-ly-candh.html',
                    '1567273619971559' => 'https://lakita.vn/quan-tri-ke-toan.html',
                    '1883385008373014' => 'https://lakita.vn/quan-tri-ke-toan-candh.html',
                    '1281082322018331' => 'https://lakita.vn/bao-cao-tai-chinh-nang-cao.html',
                    '2054579071235903' => 'https://lakita.vn/bao-cao-tai-chinh-nang-cao-candh.html',
                    '1499953153417907' => 'https://lakita.vn/tron-bo-quyet-toan-thue-tu-a-den-z.html',
                    '1572938529454084' => 'https://lakita.vn/tron-bo-quyet-toan-thue-tu-a-den-z-dangph.html',
                    '1765719676802437' => 'https://lakita.vn/tron-bo-quyet-toan-thue-tu-a-den-z-candh1.html',
                    '1478323028949878' => 'https://lakita.vn/tron-bo-quyet-toan-thue-tu-a-den-z-candh2.html',
                    '1436597719799600' => 'https://lakita.vn/ke-toan-cho-nguoi-moi-bat-dau.html',
                    '1574470682649315' => 'https://lakita.vn/ke-toan-cho-nguoi-moi-bat-dau-hanhnm.html',
                    '1356504991125130' => 'https://lakita.vn/ke-toan-danh-cho-giam-doc.html',
                    '1441397425925456' => 'https://lakita.vn/bi-quyet-lam-chu-excel-2017.html',
                    '1370473353071832' => 'https://lakita.vn/excel-tu-a-den-z.html',
                    '1331503243639074' => 'https://lakita.vn/combo-ke-toan-excel-van-phong-2017.html',
                    '1530375550351116' => 'https://lakita.vn/combo-qua-khung-dip-giang-sinh.html',
                    '1789918514418799' => 'https://lakita.vn/quan-tri-tai-chinh-ke-toan.html',
                    '1341661405963380' => 'https://lakita.vn/yoga-danh-cho-nguoi-lam-van-phong.html',
                    '1542421495847416' => 'https://lakita.vn/yoga-danh-cho-nguoi-lam-van-phong-2.html',
                    '1455312594567068' => 'https://lakita.vn/yoga-danh-cho-nguoi-lam-van-phong-6.html',
                    '1622160844507152' => 'https://lakita.vn/yoga-danh-cho-nguoi-lam-van-phong-3.html',
                    '1628748463856832' => 'https://lakita.vn/yoga-danh-cho-nguoi-lam-van-phong-4.html',
                    '1625298554180109' => 'https://lakita.vn/yoga-danh-cho-nguoi-lam-van-phong-5.html',
                    '1739851282726831' => 'https://lakita.vn/combo-qua-khung-tet-nguyen-dan.html',
                    '1584950161542159' => 'https://lakita.vn/tron-bo-thuc-hanh-ke-toan-tong-hop-tren-phan-mem-excel.html',
                    '1594205084033500' => 'https://lakita.vn/chia-se-tat-tan-tat-kinh-nghiem-bao-ve-giai-trinh-so-lieu-khi-thanh-tra-thue.html',
                    '2391237814250616' => 'https://lakita.vn/tron-bo-ky-thuat-lap-kiem-tra-phan-tich-bctc.html',
                    '1872401092812322' => 'https://lakita.vn/chia-se-tat-tan-tat-kinh-nghiem-bao-ve-giai-trinh-so-lieu-khi-thanh-tra-thue-2.html',
                    '2170475322979155' => 'https://lakita.vn/phat-hien-rui-do-tiem-an-khi-quyet-toan-3-luat-thue-2017.html',
                    '1930688790275091' => 'https://lakita.vn/combo-qua-khung-chao-mung-30-04.html',
                    '1493559494083709' => 'https://lakita.vn/tron-bo-ky-thuat-huong-dan-quyet-toan-thue-tncn.html',
                    '1716745115079717' => 'https://lakita.vn/tron-bo-ky-thuat-huong-dan-quyet-toan-thue-tncn-2.html',
                    '1904310999621597' => 'https://lakita.vn/thuc-hanh-ke-toan-tong-hop-tren-phan-mem-Fast-va-Misa.html',
                    '1816066965082975' => 'https://lakita.vn/thanh-thao-xu-ly-chung-tu-ke-toan-trong-doanh-nghiep.html',
                    '2433309940019922' => 'https://lakita.vn/thuc-hanh-ke-toan-thue-quyet-toan-va-toi-uu-thue-trong-doanh-nghiep.html',
                    '1929555897075109' => 'https://lakita.vn/nghiep-vu-xuat-nhap-khau-va-khai-bao-hai-quan.html',
                    '1639856656137841' => 'https://lakita.vn/nghiep-vu-xuat-nhap-khau-va-khai-bao-hai-quan-2.html',
                    '1738925839528753' => 'https://lakita.vn/nghiep-vu-hanh-chinh-ky-nang-van-phong-va-quan-ly-nhan-su-thuc-te.html',
                    '1795839820470546' => 'https://lakita.vn/tao-ung-dung-va-lam-ke-toan-tong-hop-tren-phan-mem-excel.html',
                    '1956370551042759' => 'https://lakita.vn/ke-toan-thue-thuc-hanh.html',
                    '1574818002626968' => 'https://lakita.vn/hoc-ke-toan-bat-dau-tu-con-so-0.html',
                    '1643160289146308' => 'https://lakita.vn/tuyen-dung-nhan-su-marketing.html',
                    '1704484796325483' => 'https://lakita.vn/hoc-ke-toan-nha-hang-tu-a-den-z.html',
                    '1801368463315592' => 'https://lakita.vn/cam-nang-dao-tao-thu-ky-tro-ly-hanh-chinh-chuyen-nghiep.html',
                    '2234617613277308' => 'https://lakita.vn/thuc-hanh-lam-ke-toan-tong-hop-thuc-te-tren-phan-mem-ke-toan-Misa.html',
                    '2574533979244883' => 'https://lakita.vn/bi-quyet-kinh-nghiem-dau-tu-chung-khoan.html',
                    '2172669879452202' => 'https://lakita.vn/khoa-hoc-ke-toan-cho-nguoi-moi-bat-dau.html',
                    '1809534295835085' => 'https://lakita.vn/thuc-hanh-nghiep-vu-ke-toan-tong-hop-tren-excel.html',
                    '2327540280620873' => 'https://lakita.vn/nghiep-vu-BHXH-tien-luong-thue-tncn.html',
                    '2313619335332757' => 'https://lakita.vn/khoa-hoc-tieng-han-cho-nguoi-moi-bat-dau.html',
                    '2083433138366035' => 'https://lakita.vn/bao-hiem-xa-hoi-tien-luong-thue-tncn-2018.html',
					'2413642248709073' => 'https://lakita.vn/thuc-hanh-ke-toan-tong-hop-thuong-mai-dich-vu.html',
                    '2043011409093546' => 'https://lakita.vn/khoa-hoc-online-de-tro-thanh-kiem-toan-vien-doc-lap.html',
					'1972873759426617' => 'https://lakita.vn/combo-5-khoa-hoc-tieng-nhat-cho-nguoi-moi-bat-dau.html',
					'1944636142319630' => 'https://lakita.vn/bi-kip-lam-giau-tu-46-mon-an-vat.html',
					'1921096021342729' => 'https://lakita.vn/tron-bo-lap-bao-cao-tai-chinh-2019.html',
					'2225870520770445' => 'http://kinhdoanhanvat.lakita.vn/',
					'1898177100230940' => 'https://lakita.vn/thuc-hanh-ke-toan-chi-phi-gia-thanh-trong-doanh-nghiep.html',
					'1970151599740666' => 'https://lakita.vn/eating-clean-cho-nguoi-viet.html',
					'2267012346665385' => 'https://lakita.vn/tron-bo-quyet-toan-thue-tu-a-den-z-3.html'
                ];

                $replyComment = '';
                if (!empty($comment->entry[0]->changes[0]->value->parent)) {
                    $replyComment .= '<br> Trả lời comment: ' . $comment->entry[0]->changes[0]->value->parent->message .
                            '<br> của ' . $comment->entry[0]->changes[0]->value->parent->message->from->name;
                }
                $page = json_decode(file_get_contents('https://graph.facebook.com/v2.11/' . $pageId[0] . '?access_token=' . ACCESS_TOKEN));
                $urlTitle = isset($url[$pageId[0]]) ? $url[$pageId[0]] : $pageId[0];




                $uid = $comment->entry[0]->changes[0]->value->from->id;
                $fullSizePicture = (('https://graph.facebook.com/v2.11/' . $uid . '/picture?width=500'));


                $this->load->library("email");
                $this->email->from('cskh@lakita.vn', "lakita.vn");
                $this->email->to('kenshiner96@gmail.com, ngoccongtt1@gmail.com, trinhnv@lakita.vn, haiyen2102197@gmail.com, thuhoa.meetc@gmail.com');
                //$this->email->to('thanhloc1302@gmail.com, kenshiner96@gmail.com');
                $this->email->subject('Có cmt fb mới ở landing page ' . $urlTitle . ' (' . date(_DATE_FORMAT_) . ')');

                $uMessage = $comment->entry[0]->changes[0]->value->message;
                $uName = $comment->entry[0]->changes[0]->value->from->name;

                $email = '';
                $phone = '';
                if (preg_match("/([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}/ix", $uMessage, $matches)) {
                    $email = $matches[0];
                }
                if (preg_match("/(\\+84|0)\\d{9,10}/", $uMessage, $matches1)) {
                    $phone = $matches1[0];
                }

                if (!empty($phone)) {
                    $this->load->model('landingpage_model');
                    $input = array();
                    $input['where']['url'] = $urlTitle;
                    $course = $this->landingpage_model->load_all($input);
                    if (!empty($course)) {
                        $param['name'] = $uName;
                        $param['email'] = $email;
                        $param['address'] = $urlTitle;
                        $param['phone'] = $phone;
                        $param['course_code'] = $course[0]['course_code'];
                        $param['date_rgt'] = time();
                        $param['source_id'] = 1;
                        $param['channel_id'] = 2;
                        $param['landingpage_id'] = $course[0]['id'];
                        $param['payment_method_rgt'] = 0;
                        $param['price_purchase'] = $course[0]['price'];
                        $param['sale_staff_id'] = 0;
                        $param['date_handover'] = 0;
                        $param['duplicate_id'] = $this->_find_dupliacte_contact($email, $phone, $course[0]['course_code']);
                        $param['last_activity'] = time();
                        $param['source_sale_id'] = 1;
                        $this->contacts_model->insert($param);
                        $this->contacts_backup_model->insert($param);
                    }
                }


                $this->email->message('<table cellspacing="0" class="MsoTableGrid" style="border-collapse:collapse; border:undefined"> <tbody> <tr> <td style="vertical-align:top; width:134.75pt"> <p style="margin-left:0in; margin-right:0in"><span style="font-size:11pt"><span style="font-family:Roboto"><img src="' . $fullSizePicture . '" style="height:271px; width:271px"/></span></span> </p></td><td style="vertical-align:top; width:600pt"> <p style="margin-left:1in; margin-right:0in"><span style="font-size:11pt"><span style="font-family:Roboto">' . $uName . '</span></span> </p><p style="margin-left:1in; margin-right:0in"><span style="font-size:11pt"><span style="background-color:white"><span style="font-family:Roboto"><strong><span style="font-size:24.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:#222222">' . $uMessage . '</span></span></span></strong></span></span></span> </p><p style="margin-left:1in; margin-right:0in">&nbsp;</p><a style="margin-left:1in; margin-right:0in" href="' . $urlTitle . '"> Landing Page: ' . $urlTitle . '</a><p style="margin-left:1in; margin-right:0in">' . $replyComment . '</p></td></tr></tbody></table>');

                if ($this->email->send()) {
                    echo 'ok';
                }
                $this->email->clear(TRUE);


                require_once APPPATH . 'libraries/Pusher.php';
                $options = array(
                    'cluster' => 'ap1',
                    'encrypted' => true
                );
                $pusher = new Pusher(
                        'e37045ff133e03de137a', 'f3707885b7e9d7c2718a', '428500', $options
                );

                $data2 = [];
                $data2['title'] = 'Có comment FB mới ở landing page';
                $data2['message'] = $page->title;
                $data2['image'] = $fullSizePicture;
                $data2['url'] = $urlTitle;
                $pusher->trigger('my-channel', 'notice', $data2);
            }
        }
    }




    private function _find_dupliacte_contact($email = '', $phone = '', $course_code = '') {
        $dulicate = 0;
        $input = array();
        $input['select'] = 'id';
        $input['where'] = array(
            'phone' => $phone,
            'course_code' => $course_code
        );
        $input['order'] = array('id', 'ASC');
        $rs = $this->contacts_model->load_all($input);
        if (count($rs) > 0) {
            $dulicate = $rs[0]['id'];
        }
        return $dulicate;
    }
}

?>
