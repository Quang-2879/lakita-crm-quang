<tr>
    <td class="text-right">  Ngày khách hẹn gọi lại </td>
    <td> 
        <div class="input-group">
           <input type="text" class="form-control datetimepicker date_recall" name="date_recall"
        <?php if ($rows['date_recall'] > 0) { ?>
                   value="<?php echo date('d-m-Y H:i', $rows['date_recall']); ?>"
               <?php } ?> /> 
            <div class="input-group-btn">
                <button class="reset_datepicker btn btn-primary"> Reset</button>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
    </td>
</tr>