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
$str .= '<h1> Báo cáo TVTS ngày ' . date('d-m-Y') .'</h1>
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr><th style="background: none; border: none;"></th>';
foreach ($staffs as $value) {
    if ($value['L1'] > 0) {
        $str .= "<th>" . $value['name'] . "</th>";
    }
}
$str .= '<th>  Tổng </th>  </tr>  </thead>  <tbody>';
$report = array(
    array('L1', 'L1', $L1),
    array('LC', 'LC', $LC),
    array('L2', 'L2', $L2),
    array('Còn cứu được', 'CON_CUU_DUOC', $CON_CUU_DUOC),
    array('Từ chối mua', 'TU_CHOI_MUA', $TU_CHOI_MUA),
    array('L6', 'L6', $L6),
    array('Đã thu COD', 'DA_THU_COD', $DA_THU_COD),
    array('Hủy đơn', 'HUY_DON', $HUY_DON),
    array('L8', 'L8', $L8),
);
foreach ($report as $values) {
    list($name, $value2, $total) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($staffs as $value) {
        if ($value['L1'] > 0) {
            $str .= "<td style='text-align:center'>$value[$value2]</td>";
        }
    }
    $str .= " <td style='text-align:center'> $total </td> </tr>";
}
$report2 = array(
    array('L2/L1', 'L2', 'L1', ($L1 != 0) ? round(($L2 / $L1) * 100, 2) : 'không thể chia cho 0', 90),
    array('L6/L2', 'L6', 'L2', ($L2 != 0) ? round(($L6 / $L2) * 100, 2) : 'không thể chia cho 0', 80),
    array('L8/L6', 'L8', 'L6', ($L6 != 0) ? round(($L8 / $L6) * 100, 2) : 'không thể chia cho 0', 80),
    array('L8/L1', 'L8', 'L1', ($L1 != 0) ? round(($L8 / $L1) * 100, 2) : 'không thể chia cho 0', 60),
    array('L8/L2', 'L8', 'L2', ($L2 != 0) ? round(($L8 / $L2) * 100, 2) : 'không thể chia cho 0', 60),
    array('Hủy đơn/L6', 'HUY_DON', 'L6', ($L6 != 0) ? round(($HUY_DON / $L6) * 100, 2) : 'không thể chia cho 0', 0),
    array('LC/L1', 'LC', 'L1', ($L1 != 0) ? round(($LC / $L1) * 100, 2) : 'không thể chia cho 0', 0),
    array('0.5/L1', 'CON_CUU_DUOC', 'L1', ($L1 != 0) ? round(($CON_CUU_DUOC / $L1) * 100, 2) : 'không thể chia cho 0', 0),
);
foreach ($report2 as $values) {
    list($name, $tu_so, $mau_so, $total, $limit) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($staffs as $value) {
        if ($value['L1'] > 0) {
            $str .= " <td ";
            if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) < $limit && $limit > 0) {
                $str .= 'style="background-color: #a71717;color: #fff; text-align:center"';
            } else if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) >= $limit && $limit > 0) {
                $str .= 'style="background-color: #0C812D;color: #fff; text-align:center"';
            }
            $str .= ">";
            $str .= ($value[$mau_so] != 0) ? round(($value[$tu_so] / $value[$mau_so]) * 100, 2) . '%' : 'không thể chia cho 0';
            $str .= "</td>";
        }
    }
    $str .= "<td";
    if ($total < $limit && $limit > 0) {
        $str .= ' style="background-color: #a71717;color: #fff; text-align:center"';
    } else if ($total >= $limit && $limit > 0) {
        $str .= ' style="background-color: #0C812D;color: #fff; text-align:center"';
    } else
        $str .= ' style="text-align:center"';
    $str .= ">";
    $str .= $total . "%";
}
$str .= "</td> </tr>  </tbody> </table> ";

/*===================================== LŨY KẾ ==========================================*/
$str .= '<h1> Lũy kế từ đầu tháng </h1>';
$str .= '<table border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr><th style="background: none; border: none;"></th>';
foreach ($staffs as $value) {
    if ($value['L1_luyke'] > 0) {
        $str .= "<th>" . $value['name'] . "</th>";
    }
}
$str .= '<th>  Tổng </th>  </tr>  </thead>  <tbody>';
$report = array(
    array('L1_luyke', 'L1_luyke', $L1_luyke),
    array('LC_luyke', 'LC_luyke', $LC_luyke),
    array('L2_luyke', 'L2_luyke', $L2_luyke),
    array('Còn cứu được_luyke', 'CON_CUU_DUOC_luyke', $CON_CUU_DUOC_luyke),
    array('Từ chối mua_luyke', 'TU_CHOI_MUA_luyke', $TU_CHOI_MUA_luyke),
    array('L6_luyke', 'L6_luyke', $L6_luyke),
    array('Đã thu COD_luyke', 'DA_THU_COD_luyke', $DA_THU_COD_luyke),
    array('Hủy đơn_luyke', 'HUY_DON_luyke', $HUY_DON_luyke),
    array('L8_luyke', 'L8_luyke', $L8_luyke),
);
foreach ($report as $values) {
    list($name, $value2, $total) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($staffs as $value) {
        if ($value['L1_luyke'] > 0) {
            $str .= "<td style='text-align:center'>$value[$value2]</td>";
        }
    }
    $str .= " <td style='text-align:center'> $total </td> </tr>";
}
$report2 = array(
    array('L2/L1_luyke', 'L2_luyke', 'L1_luyke', ($L1_luyke != 0) ? round(($L2_luyke / $L1_luyke) * 100, 2) : 'không thể chia cho 0', 90),
    array('L6/L2_luyke', 'L6_luyke', 'L2_luyke', ($L2_luyke != 0) ? round(($L6_luyke / $L2_luyke) * 100, 2) : 'không thể chia cho 0', 80),
    array('L8/L6_luyke', 'L8_luyke', 'L6_luyke', ($L6_luyke != 0) ? round(($L8_luyke / $L6_luyke) * 100, 2) : 'không thể chia cho 0', 80),
    array('L8/L1_luyke', 'L8_luyke', 'L1_luyke', ($L1_luyke != 0) ? round(($L8_luyke / $L1_luyke) * 100, 2) : 'không thể chia cho 0', 60),
    array('L8/L2_luyke', 'L8_luyke', 'L2_luyke', ($L2_luyke != 0) ? round(($L8_luyke / $L2_luyke) * 100, 2) : 'không thể chia cho 0', 60),
    array('Hủy đơn/L6_luyke', 'HUY_DON_luyke', 'L6_luyke', ($L6_luyke != 0) ? round(($HUY_DON_luyke / $L6_luyke) * 100, 2) : 'không thể chia cho 0', 0),
    array('LC/L1_luyke', 'LC_luyke', 'L1_luyke', ($L1_luyke != 0) ? round(($LC_luyke / $L1_luyke) * 100, 2) : 'không thể chia cho 0', 0),
    array('0.5/L1_luyke', 'CON_CUU_DUOC_luyke', 'L1_luyke', ($L1_luyke != 0) ? round(($CON_CUU_DUOC_luyke / $L1_luyke) * 100, 2) : 'không thể chia cho 0', 0),
);
foreach ($report2 as $values) {
    list($name, $tu_so, $mau_so, $total, $limit) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($staffs as $value) {
        if ($value['L1_luyke'] > 0) {
            $str .= " <td ";
            if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) < $limit && $limit > 0) {
                $str .= 'style="background-color: #a71717;color: #fff; text-align:center"';
            } else if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) >= $limit && $limit > 0) {
                $str .= 'style="background-color: #0C812D;color: #fff; text-align:center"';
            }
            $str .= ">";
            $str .= ($value[$mau_so] != 0) ? round(($value[$tu_so] / $value[$mau_so]) * 100, 2) . '%' : 'không thể chia cho 0';
            $str .= "</td>";
        }
    }
    $str .= "<td";
    if ($total < $limit && $limit > 0) {
        $str .= ' style="background-color: #a71717;color: #fff; text-align:center"';
    } else if ($total >= $limit && $limit > 0) {
        $str .= ' style="background-color: #0C812D;color: #fff; text-align:center"';
    } else
        $str .= ' style="text-align:center"';
    $str .= ">";
    $str .= $total . "%";
}
$str .= "</td> </tr>  </tbody> </table> ";


$str .= "</body> </html>";

$ci = & get_instance();
$ci->load->library("email");
$ci->email->from('cskh@lakita.vn', "lakita.vn");
//$emailTo = 'chuyenbka@gmail.com';
  $emailTo = 'chuyenbka@gmail.com, ngoccongtt1@gmail.com, '
                . 'trinhnv@bkindex.com, tund@bkindex.com, hoangthuy100995@gmail.com';
$ci->email->to($emailTo);
$ci->email->subject('Báo cáo TVTS ngày ' . date('d-m-Y') . ' (by cron job)');
$ci->email->message($str);
$ci->email->send();
