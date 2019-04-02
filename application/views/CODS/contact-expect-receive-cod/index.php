<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Contact dự kiến giao hàng / yêu cầu phát lại </title>
        <style type="text/css">
            body {margin: 10px 0; padding: 0 10px; background: #F9F2E7; font-size: 13px;}
            table {border-collapse: collapse;}
            td {font-family: arial, sans-serif; color: #333333; padding: 10px; border: 1px solid #ddd;}
            th{padding: 10px; border: 1px solid #ddd;}
        </style>
    </head>
    <body>
        <h1> Có tổng số <?php echo $total_contacts; ?> contacts dự kiến giao hàng / yêu cầu phát lại hôm nay:  </h1>
        <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="background: #0C812D; color: #fff">
                        Họ tên
                    </th>

                    <th style="background: #0C812D; color: #fff">
                        Số điện thoại
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Mã khóa học
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Địa chỉ
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Trạng thái giao hàng
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Ngày dự kiến giao hàng / yêu cầu phát lại
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Mã bill
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Ghi chú
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($contacts as $value) {
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo 'https://crm2.lakita.vn/home/index?view_detail_contact='.$value['id']?>"><?php echo $value['name']; ?> </a>
                        </td>
                        <td>
                            <?php echo $value['phone']; ?>
                        </td>
                        <td>
                            <?php echo $value['course_code']; ?>
                        </td>
                        <td>
                            <?php echo $value['address']; ?>
                        </td>
                        <td class="center tbl_cod_status">
                            <?php
                            foreach ($cod_status as $key2 => $value2) {
                                if ($value2['id'] == $value['cod_status_id']) {
                                    echo $value2['name'];
                                    break;
                                }
                            }
                            ?>
                        </td>
                        <td class="center tbl_date_expect_receive_cod">
                            <?php if ($value['date_expect_receive_cod'] > 0) echo date('d/m/Y', $value['date_expect_receive_cod']); ?>
                        </td>
                        <td>
                            <a href="https://www.viettelpost.com.vn/Tracking?KEY=<?php echo $value['code_cross_check']; ?>" target="_blank">
                                <?php echo $value['code_cross_check']; ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $value['last_note']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
