<?php

$str = '';
$str .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Responsive email</title>
    <style type="text/css">
      body {margin: 10px 0; padding: 0 10px; background: #F9F2E7; font-size: 13px;}
      table {border-collapse: collapse;}
      td {font-family: arial, sans-serif; color: #333333; padding: 10px;}
      th{padding: 10px;}
    </style>
  </head>
  <body>
';
$str .= '<h1> Báo cáo doanh thu ngày ' . date('d-m-Y') . ' (tính theo ngày nhận tiền)</h1>
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="background: none"></th>';

foreach ($courses as $value) {
    if ($value['L7L8'] > 0) {
        $str .= '<th>' . $value['course_code'] . ' </th>';
    }
}
$str .= '<th>
                Tổng
            </th>
        </tr>
    </thead>
    <tbody>';
$report = array(
    array('L7', 'L7', $L7),
    array('L8', 'L8', $L8),
    array('L7+L8', 'L7L8', $L7L8)
);
foreach ($report as $values) {
    list($name, $value2, $total) = $values;
    $str .= ' <tr>  <td> ' . $name . '</td>';
    foreach ($courses as $value) {
        if ($value['L7L8'] > 0) {
            $str .= '<td>' . number_format($value[$value2], 0, ",", ".") . " VNĐ" . '</td>';
        }
    }
    $str .= '<td>' . number_format($total, 0, ",", ".") . " VNĐ" . '</td></tr>';
}
$str .= '</tbody></table>';


/*================================================= lũy kế ============================================ */
$str .= '<h1> Lũy kế từ đầu tháng (tính theo ngày nhận tiền)</h1>';
$str .= '<table border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="background: none"></th>';
foreach ($courses as $value) {
    if ($value['L7L8_luyke'] > 0) {
        $str .= '<th>' . $value['course_code'] . ' </th>';
    }
}
$str .= '<th>
                Tổng
            </th>
        </tr>
    </thead>
    <tbody>';
$report = array(
    array('L7_luyke', 'L7_luyke', $L7_luyke),
    array('L8_luyke', 'L8_luyke', $L8_luyke),
    array('L7+L8_luyke', 'L7L8_luyke', $L7L8_luyke)
);
foreach ($report as $values) {
    list($name, $value2, $total) = $values;
    $str .= ' <tr>  <td> ' . $name . '</td>';
    foreach ($courses as $value) {
        if ($value['L7L8_luyke'] > 0) {
            $str .= '<td>' . number_format($value[$value2], 0, ",", ".") . " VNĐ" . '</td>';
        }
    }
    $str .= '<td>' . number_format($total, 0, ",", ".") . " VNĐ" . '</td></tr>';
}
$str .= '</tbody></table>';



$str .= "</body> </html>";



$ci = & get_instance();
$ci->load->library("email");
$ci->email->from('cskh@lakita.vn', "lakita.vn");
  $emailTo = 'chuyenbka@gmail.com, ngoccongtt1@gmail.com, '
                . 'trinhnv@bkindex.com, tund@bkindex.com';
$ci->email->to($emailTo);
$subject = 'Báo cáo doanh thu L7, L8 ngày ' . date('d-m-Y') . ' (by cron job)';
$ci->email->subject($subject);
$ci->email->message($str);
$ci->email->send();
