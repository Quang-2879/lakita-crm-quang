<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Responsive email</title>
        <style type="text/css">
            body {margin: 10px 0; padding: 0 10px; background: #F9F2E7; font-size: 13px;}
            table {border-collapse: collapse;}
            td {font-family: arial, sans-serif; color: #333333; padding: 10px; border: 1px solid #ddd;}
            th{padding: 10px; border: 1px solid #ddd;}
        </style>
    </head>
    <body>
        <h1> Báo cáo tỉ lệ convert theo sản phẩm ngày <?php echo date('d-m-Y'); ?> </h1>

        <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="background: none"></th>
                    <?php
                    $report = array('L1_td' => 0, 'L2/L1_td' => '90%', 'L6/L2_td' => '80%');
                    foreach ($report as $key => $value) {
                        ?>
                        <th style="background: #0C812D; color: #fff">
                            <?php echo $key; ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($courses as $value) {
                    if ($value['L1_td'] > 0) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value['course_code']; ?>
                            </td>
                            <?php
                            foreach ($report as $key2 => $value2) {
                                ?>
                                <td <?php if (intval($value[$key2]) < intval($value2)) echo 'style="background-color: #a71717;color: #fff;"'; ?>>
                                    <?php echo $value[$key2]; ?>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td> Tỉ lệ tổng </td>
                    <td> <?php echo $L1_td; ?> </td>
                    <td <?php if ($L1_td > 0 && round(($L2_td / $L1_td) * 100, 2) < 90) echo 'style="background-color: #a71717;color: #fff;"'; ?>> 
                        <?php echo ($L1_td != 0) ? round(($L2_td / $L1_td) * 100, 2) . '%' : 'Không thể chia cho 0'; ?> 
                    </td>
                    <td <?php if ($L2_td > 0 && round(($L6_td / $L2_td) * 100, 2) < 80) echo 'style="background-color: #a71717;color: #fff;"'; ?>> 
                        <?php echo ($L2_td != 0) ? round(($L6_td / $L2_td) * 100, 2) . '%' : 'Không thể chia cho 0'; ?> 
                    </td>
                </tr>
            </tbody>
        </table>

        <h1> Báo cáo tỉ lệ convert theo sản phẩm từ đầu tháng đến giờ (tính theo ngày nhận contact) </h1>
        <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="background: none"></th>
                    <?php
                    $report = array('L1' => 0, 'L8' => 0, 'L2/L1' => '90%', 'L6/L2' => '80%', 'L8/L6' => '90%', 'L8/L1' => '60%');
                    foreach ($report as $key => $value) {
                        ?>
                        <th style="background: #0C812D; color: #fff">
                            <?php echo $key; ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($courses as $value) {
                    if ($value['L1'] > 0) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value['course_code']; ?>
                            </td>
                            <?php
                            foreach ($report as $key2 => $value2) {
                                ?>
                                <td <?php if (intval($value[$key2]) < intval($value2)) echo 'style="background-color: #a71717;color: #fff;"'; ?>>
                                    <?php echo $value[$key2]; ?>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td> Tỉ lệ tổng </td>
                    <td> <?php echo $L1; ?> </td>
                    <td> <?php echo $L8; ?> </td>
                    <td <?php if (round(($L2 / $L1) * 100, 2) < 90) echo 'style="background-color: #a71717;color: #fff;"'; ?>> 
                        <?php echo ($L1 != 0) ? round(($L2 / $L1) * 100, 2) . '%' : 'Không thể chia cho 0'; ?> 
                    </td>
                    <td <?php if (round(($L6 / $L2) * 100, 2) < 80) echo 'style="background-color: #a71717;color: #fff;"'; ?>> 
                        <?php echo ($L2 != 0) ? round(($L6 / $L2) * 100, 2) . '%' : 'Không thể chia cho 0'; ?> 
                    </td>
                    <td <?php if (round(($L8 / $L6) * 100, 2) < 90) echo 'style="background-color: #a71717;color: #fff;"'; ?>> 
                        <?php echo ($L6 != 0) ? round(($L8 / $L6) * 100, 2) . '%' : 'Không thể chia cho 0'; ?> 
                    </td>
                    <td <?php if (round(($L8 / $L1) * 100, 2) < 60) echo 'style="background-color: #a71717;color: #fff;"'; ?>> 
                        <?php echo ($L1 != 0) ? round(($L8 / $L1) * 100, 2) . '%' : 'Không thể chia cho 0'; ?> 
                    </td>
                </tr>
                <tr>
                    <td> Tổng doanh thu </td>
                    <td colspan="6"> <h1> <?php echo number_format($sumL8, 0, ",", ".") . " VNĐ"; ?></h1></td>
                </tr>
            </tbody>
        </table>

    </body>
</html>

