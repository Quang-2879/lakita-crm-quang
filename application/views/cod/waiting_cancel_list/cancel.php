<h1> Danh sách contact hủy đơn (<?php echo count($contact_cancel); ?>)</h1>
<?php if (empty($contact_cancel)) { ?>
    
<?php } else { ?>
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
            foreach ($contact_cancel as $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['id']; ?>
                    </td>
                    <td>
                        <?php echo $value['name']; ?>
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
                        <a href="https://www.viettelpost.com.vn/Tracking?KEY=<?php echo $value['code_cross_check']; ?>" target="_blank">
                            <?php echo $value['code_cross_check']; ?>
                        </a>
                    </td>
                    <td>
                        <?php echo isset($value['status_viettel']) ? $value['status_viettel'] : ''; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
