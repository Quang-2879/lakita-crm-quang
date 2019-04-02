<tr class="filter_date_date_receive_lakita">
    <td class="text-right">  Ngày nhận tiền Lakita: </td>
    <td>
 <input type="text" class="form-control daterangepicker" name="filter_date_date_receive_lakita" style="position: static"
        <?php if (filter_has_var(INPUT_GET, 'filter_date_date_receive_lakita')) { ?>
                   value="<?php echo filter_input(INPUT_GET, 'filter_date_date_receive_lakita') ;?>"
               <?php }?>
               />
    </td>
</tr>