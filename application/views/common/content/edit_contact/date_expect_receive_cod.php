<tr class="tbl_cod">
    <td class="text-right">Ngày dự kiến giao hàng (sale) / ngày khách hẹn phát lại (cod)</td>
    <td> 
        <div class="input-group">
            <input type="text" class="form-control datepicker" name="date_expect_receive_cod" 
            <?php if ($rows['date_expect_receive_cod'] > 0) { ?>
                       value="<?php echo date('d-m-Y', $rows['date_expect_receive_cod']); ?>"
                   <?php } ?> />  
            <div class="input-group-btn">
                <button class="reset_datepicker btn btn-primary"> Reset</button>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
    </td>
</tr>