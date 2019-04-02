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
class Facebook_notification2 extends CI_Controller {

    function index() {

        if (file_get_contents('php://input')) {
            $comment = json_decode(file_get_contents('php://input'));
            $commentId = $comment->entry[0]->changes[0]->value->comment_id;
            $input = [];
            $input['where'] = array('comment_id' => $commentId);
            $this->load->model('facebook_comment_plugin_model');
            $commentExist = $this->facebook_comment_plugin_model->load_all($input);
            if (empty($commentExist)) {
                $this->facebook_comment_plugin_model->insert(['comment_id' => $commentId, 'time' => date(_DATE_FORMAT_)]);
                $commentContent = $comment->entry[0]->changes[0]->value->message;
                preg_match("/\d{8,12}/", $commentContent, $phoneArray);
                if (!empty($phoneArray)) {
//                    $this->load->library("email");
//                    $this->email->from('cskh@lakita.vn', "lakita.vn");
//                    //$this->email->to('chuyenbka@gmail.com, ngoccongtt1@gmail.com, trinhnv@lakita.vn, phuongtravel46@gmail.com, maiduong250695@gmail.com');
//                    $this->email->to('chuyenbka@gmail.com');
//                    $this->email->subject('Có cmt fb mới ở landing page ');
//                    //  $this->email->message('<table cellspacing="0" class="MsoTableGrid" style="border-collapse:collapse; border:undefined"> <tbody> <tr> <td style="vertical-align:top; width:134.75pt"> <p style="margin-left:0in; margin-right:0in"><span style="font-size:11pt"><span style="font-family:Roboto"><img src="'. $fullSizePicture .'" style="height:271px; width:271px"/></span></span> </p></td><td style="vertical-align:top; width:600pt"> <p style="margin-left:1in; margin-right:0in"><span style="font-size:11pt"><span style="font-family:Roboto">'.$uName.'</span></span> </p><p style="margin-left:1in; margin-right:0in"><span style="font-size:11pt"><span style="background-color:white"><span style="font-family:Roboto"><strong><span style="font-size:24.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:#222222">'.$uMessage.'</span></span></span></strong></span></span></span> </p><p style="margin-left:1in; margin-right:0in">&nbsp;</p><a style="margin-left:1in; margin-right:0in" href="' . $urlTitle . '"> Landing Page: ' . $page->title . '</a><p style="margin-left:1in; margin-right:0in">'.$replyComment.'</p></td></tr></tbody></table>');
//                    $this->email->message($commentContent . '<br> phone: ' . $phoneArray[0]);
//                    // $this->email->send();
//                    $this->email->clear(TRUE);
                    require_once APPPATH . "../public/lakita/Rest_client/Rest_Client.php";

                    $post = [];
                    $post['name'] = $comment->entry[0]->changes[0]->value->from->name;
                    $post['phone'] = $phoneArray[0];
                    $post['dia_chi'] = $comment->entry[0]->changes[0]->value->message . ' (khách comment trên bài viết)';
                    $post['course_code'] = 'L999';
                    $post['price_purchase'] = '395000';
                    $config = array(
                        'server' => 'https://crm2.lakita.vn/',
                        'api_key' => 'RrF3rcmYdWQbviO5tuki3fdgfgr4',
                        'api_name' => 'lakita-key'
                    );
                    $restClient = new Rest_Client($config);
                    $uri = "contact_api/add_contact";
                    $post['link_id'] = 0;
                    $restClient->post($uri, $post);
                }
            }
        }
    }

}
