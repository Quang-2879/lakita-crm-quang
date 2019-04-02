<tr class="tbl_bank">
    <td class="text-right"> Đã gủi email tài khoản ngân hàng cho khách ?</td>
    <td class="position-relative">  
        <div class="input-group">
            <input type="text" class="form-control" disabled="disabled" 
                   value="<?php echo ($rows['send_banking_info'] == 1) ? 'Rồi' : 'Chưa'; ?>" />
            <div class="input-group-btn">
                <button class="btn btn-success btn-fixed btn-send-banking-info" contact_id="<?php echo $rows['id']; ?>"> Click để gửi email</button>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
    </td>
</tr>