<tr class="tbl_bank">
    <td class="text-right"> Đã gủi thông tin tài khoản Lakita cho khách vào học?</td>
    <td class="position-relative">  
        <?php if ($rows['id_lakita'] == 0) { ?>
            <button class="btn btn-warning btn-send-account-other-email" contact_id="<?php echo $rows['id']; ?>"> Gửi đến email hoặc Sđt khác</button>
            <button class="btn btn-success btn-send-account-lakita" contact_id="<?php echo $rows['id']; ?>">Gửi email</button>
            <div class="input-group other-email" style="display: none">
                <input type="text" class="form-control email_send_lakita" placeholder="Nhập email" />
                <input type="text" class="form-control phone_send_lakita" placeholder="Nhập SĐT" />
            </div><!-- /input-group -->

        <?php } else { ?>
            <p>Contact đã kích hoạt</p>
        <?php } ?>
    </td>
</tr>
