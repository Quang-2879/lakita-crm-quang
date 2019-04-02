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
$str .= '<table border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr><th style="background: none; border: none;"></th>';
foreach ($courses as $value) {
    if ($value['L1'] > 0) {
        $str .= "<th>" . $value['course_code'] . "</th>";
    }
}
$str .= '<th>  Tổng </th>  </tr>  </thead>  <tbody>';
$report = array(
    array('L1', 'L1', $L1),
    array('L2', 'L2', $L2),
    array('L6', 'L6', $L6),
    array('L8', 'L8', $L8),
);
foreach ($report as $values) {
    list($name, $value2, $total) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($courses as $value) {
        if ($value['L1'] > 0) {
            $str .= "<td style='text-align:center'>$value[$value2]</td>";
        }
    }
    $str .= " <td style='text-align:center'> $total </td> </tr>";
}
$report2 = array(
    array('L2/L1', 'L2', 'L1', ($L1 != 0) ? round(($L2 / $L1) * 100, 2) : 'không thể chia cho 0', 90),
    array('L6/L2', 'L6', 'L2', ($L2 != 0) ? round(($L6 / $L2) * 100, 2) : 'không thể chia cho 0', 80),
);
foreach ($report2 as $values) {
    list($name, $tu_so, $mau_so, $total, $limit) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($courses as $value) {
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


/*======================================= LŨY KẾ TỪ ĐẦU THÁNG =================================*/
//print_arr($courses);
$str .= '<h1> Lũy kế từ đầu tháng </h1>';
$str .= '<table border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr><th style="background: none; border: none;"></th>';
foreach ($courses as $value) {
    if ($value['L1_luyke'] > 0) {
        $str .= "<th>" . $value['course_code'] . "</th>";
    }
}
$str .= '<th>  Tổng </th>  </tr>  </thead>  <tbody>';
$report = array(
    array('L1_luyke', 'L1_luyke', $L1_luyke),
    array('L2_luyke', 'L2_luyke', $L2_luyke),
    array('L8_luyke', 'L8_luyke', $L8_luyke),
);
foreach ($report as $values) {
    list($name, $value2, $total) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($courses as $value) {
        if ($value['L1_luyke'] > 0) {
            $str .= "<td style='text-align:center'>$value[$value2]</td>";
        }
    }
    $str .= " <td style='text-align:center'> $total </td> </tr>";
}
$report2 = array(
    array('L2/L1_luyke', 'L2_luyke', 'L1_luyke', ($L1_luyke != 0) ? round(($L2_luyke / $L1_luyke) * 100, 2) : 'không thể chia cho 0', 90),
    array('L6/L2_luyke', 'L6_luyke', 'L2_luyke', ($L2_luyke != 0) ? round(($L6_luyke / $L2_luyke) * 100, 2) : 'không thể chia cho 0', 80),
    array('L8/L6_luyke', 'L8_luyke', 'L6_luyke', ($L6_luyke != 0) ? round(($L8_luyke / $L6_luyke) * 100, 2) : 'không thể chia cho 0', 90),
   );
foreach ($report2 as $values) {
    list($name, $tu_so, $mau_so, $total, $limit) = $values;
    $str .= "<tr> <td>  $name </td>";
    foreach ($courses as $value) {
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

//echo $str;

$ci = & get_instance();
$ci->load->library("email");
$ci->email->initialize($config);
$ci->email->from('cskh@lakita.vn', "lakita.vn");
  $emailTo = 'chuyenbka@gmail.com, ngoccongtt1@gmail.com, '
                . 'trinhnv@bkindex.com, tund@bkindex.com';
$ci->email->to($emailTo);
$ci->email->subject('Báo cáo L7, L8 theo sản phẩm ngày '.date('d-m-Y').' (by cron job)');
$ci->email->message($str);
$ci->email->send();
