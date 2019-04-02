<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Cron extends CI_Controller {
    public function getEmail() {
        $post = $this->input->post('email');
        $time = date('d-m-Y-h-i-s');
        $myfile = fopen(APPPATH . "../public/get-email/" . $time . ".txt", "w") or die("Unable to open file!");
        fwrite($myfile, $post);
        fclose($myfile);
    }
}