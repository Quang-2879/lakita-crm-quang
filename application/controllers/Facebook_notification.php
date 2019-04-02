<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Facebook_notification
 *
 * @author phong
 */
class Facebook_notification extends CI_Controller {

    function index() {
//        if ($_GET['hub_verify_token'] === 'lakita2018') {
//            echo $_GET['hub_challenge'];
//        }
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
                    '1633196606750778' => 'https://lakita.vn/ky-thuat-quyet-toan-thue.html',
                    '1242593289171565' => 'https://lakita.vn/quyet-toan-thue-tu-a-den-z.html',
                    '1298443350192736' => 'https://lakita.vn/ky-thuat-quyet-toan-thue.html',
                    '1062159213912728' => 'https://lakita.vn/lap-bao-cao-tai-chinh-2017.html',
                    '1665697290129137' => 'https://lakita.vn/tron-bo-lap-bao-cao-tai-chinh-2017.html',
                    '1441397425925456' => 'https://lakita.vn/bi-quyet-lam-chu-excel-2017.html',
                    '1436597719799600' => 'https://lakita.vn/ke-toan-cho-nguoi-moi-bat-dau.html',
                    '1331503243639074' => 'https://lakita.vn/combo-ke-toan-excel-van-phong-2017.html',
                    '1732177853493516' => 'https://lakita.vn/bao-hiem-xa-hoi-tien-luong-thue-thu-nhap-ca-nhan-2018.html',
                    '1739851282726831' => 'https://lakita.vn/combo-qua-khung-tet-nguyen-dan.html'
                ];

                $replyComment = '';
                if (!empty($comment->entry[0]->changes[0]->value->parent)) {
                    $replyComment .= '<br> Trả lời comment: ' . $comment->entry[0]->changes[0]->value->parent->message .
                            '<br> của ' . $comment->entry[0]->changes[0]->value->parent->message->from->name;
                }
                $page = json_decode(file_get_contents('https://graph.facebook.com/v2.11/' . $pageId[0] . '?access_token=' . ACCESS_TOKEN));
                $urlTitle = isset($url[$pageId[0]]) ? $url[$pageId[0]] : $page->title;




                $uid = $comment->entry[0]->changes[0]->value->from->id;
                $fullSizePicture = (('https://graph.facebook.com/v2.11/' . $uid . '/picture?width=500'));


                $this->load->library("email");
                $this->email->from('cskh@lakita.vn', "lakita.vn");
               // $this->email->to('chuyenbka@gmail.com, ngoccongtt1@gmail.com, trinhnv@lakita.vn, phuongtravel46@gmail.com, maiduong250695@gmail.com');
                 $this->email->to('thanhloc1302@gmail.com');
                $this->email->subject('Có cmt fb mới ở landing page ' . $page->title . ' (' . date(_DATE_FORMAT_) . ')');

                $uMessage = $comment->entry[0]->changes[0]->value->message;
                $uName = $comment->entry[0]->changes[0]->value->from->name;


                $this->email->message('<table cellspacing="0" class="MsoTableGrid" style="border-collapse:collapse; border:undefined"> <tbody> <tr> <td style="vertical-align:top; width:134.75pt"> <p style="margin-left:0in; margin-right:0in"><span style="font-size:11pt"><span style="font-family:Roboto"><img src="' . $fullSizePicture . '" style="height:271px; width:271px"/></span></span> </p></td><td style="vertical-align:top; width:600pt"> <p style="margin-left:1in; margin-right:0in"><span style="font-size:11pt"><span style="font-family:Roboto">' . $uName . '</span></span> </p><p style="margin-left:1in; margin-right:0in"><span style="font-size:11pt"><span style="background-color:white"><span style="font-family:Roboto"><strong><span style="font-size:24.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:#222222">' . $uMessage . '</span></span></span></strong></span></span></span> </p><p style="margin-left:1in; margin-right:0in">&nbsp;</p><a style="margin-left:1in; margin-right:0in" href="' . $urlTitle . '"> Landing Page: ' . $page->title . '</a><p style="margin-left:1in; margin-right:0in">' . $replyComment . '</p></td></tr></tbody></table>');
                $this->email->send();
                $this->email->clear(TRUE);


                require_once APPPATH . 'libraries/Pusher.php';
                $options = array(
                    'cluster' => 'ap1',
                    'encrypted' => true
                );
                $pusher = new Pusher(
                        '32b339fca68db27aa480', '32f6731ad5d48264c579', '490390', $options
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

}
