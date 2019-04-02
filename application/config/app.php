<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config['show_profiler'] = TRUE;


/*
 * Đường dẫn tuyệt đối đến file in cod
 */


if (ENVIRONMENT == 'development') {
    $config['template_file_print'] = FCPATH . 'public/upload/01Templatever5.xlsx';
} else {
    $config['template_file_print'] = FCPATH. 'public/upload/01Templatever5.xlsx';
}

