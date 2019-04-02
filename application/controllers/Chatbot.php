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
class Chatbot extends CI_Controller {

    public function buyCourse() {
        $post = $this->input->post();
        $this->load->library("email");
        $this->email->from('cskh@lakita.vn', "lakita.vn");
        $this->email->to('chuyenbka@gmail.com, ngoccongtt1@gmail.com, trinhnv@lakita.vn, phuongtravel46@gmail.com, maiduong250695@gmail.com');
        // $this->email->to('chuyenbka@gmail.com');
        $this->email->subject('Có khách hàng đăng ký khóa học tại chatbot lakita.vn');
        $data = '';
        $data .= '<strong> Họ tên: </strong>' . $post['first_name'] . ' ' . $post['last_name'] . '<br>';
        $data .= '<strong> ĐT: </strong>' . $post['phone'] . '<br>';
        $data .= '<strong> Khóa học đăng ký: </strong>' . $post['name_course'];
        $this->email->message($data);
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
        $data2['title'] = 'Có khách hàng đăng ký khóa học tại chatbot lakita.vn';
        $data2['message'] = 'Đã gửi mail!';
        $data2['image'] = $post['profile_pic_url'];
        $pusher->trigger('my-channel', 'notice', $data2);
    }

    public function sendEmail() {
        $post = $this->input->post();
        $this->load->library("email");
        $this->email->from('cskh@lakita.vn', "lakita.vn");
        $this->email->to('chuyenbka@gmail.com, ngoccongtt1@gmail.com, trinhnv@lakita.vn, phuongtravel46@gmail.com, maiduong250695@gmail.com');
       //  $this->email->to('chuyenbka@gmail.com');
        $this->email->subject($post['tieu_de']);
        $data = '';
        $data .= '<strong> Họ tên: </strong>' . $post['first_name'] . ' ' . $post['last_name'] . '<br>';
        $data .= '<strong> ĐT: </strong>' . $post['phone'] . '<br>';
        $data .= '<strong> Email: </strong>' . $post['email'] . '<br>';
        $data .= '<strong> Nội dung: </strong>' . $post['loi_nhan'];
        $this->email->message($data);
        $this->email->send();
        $this->email->clear(TRUE);


      
    }

}
