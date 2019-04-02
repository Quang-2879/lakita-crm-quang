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
        <h1> Danh sách contact chờ duyệt chuyển hoàn ngày <?php echo date('d-m-Y'); ?> </h1>

        <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="background: #0C812D; color: #fff"> 
                        ID 
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Họ tên
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Email
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Số điện thoại
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Địa chỉ
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Ngày đăng ký
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Mã bill
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($contacts as $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['id']; ?>
                        </td>
                        <td>
                            <?php echo $value['name']; ?>
                        </td>
                        <td>
                            <?php echo $value['email']; ?>
                        </td>
                        <td>
                            <?php echo $value['phone']; ?>
                        </td>
                        <td>
                            <?php echo $value['address']; ?>
                        </td>
                        <td>
                            <?php echo date('d/m/Y H:i:s', $value['date_rgt']); ?>
                        </td>
                        <td>
                            <?php echo $value['code_cross_check']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>



        <h1> Danh sách contact đang giao hàng khác  (<?php echo count($contact_other);?>)</h1>

        <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="background: #0C812D; color: #fff"> 
                        ID 
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Họ tên
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Email
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Số điện thoại
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Địa chỉ
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Ngày đăng ký
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Mã bill
                    </th>
                    <th style="background: #0C812D; color: #fff">
                        Trạng thái
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($contact_other as $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['id']; ?>
                        </td>
                        <td>
                            <?php echo $value['name']; ?>
                        </td>
                        <td>
                            <?php echo $value['email']; ?>
                        </td>
                        <td>
                            <?php echo $value['phone']; ?>
                        </td>
                        <td>
                            <?php echo $value['address']; ?>
                        </td>
                        <td>
                            <?php echo date('d/m/Y H:i:s', $value['date_rgt']); ?>
                        </td>
                        <td>
                            <?php echo $value['code_cross_check']; ?>
                        </td>
                        <td>
                            <?php echo $value['status_viettel']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

    </body>
</html>

