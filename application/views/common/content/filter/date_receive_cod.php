<tr class="filter_date_date_receive_cod">
    <td class="text-right">  Ngày nhận tiền COD: </td>
    <td>
 <input type="text" class="form-control daterangepicker" name="filter_date_date_receive_cod" style="position: static"
        <?php if (filter_has_var(INPUT_GET, 'filter_date_date_receive_cod')) { ?>
                   value="<?php echo filter_input(INPUT_GET, 'filter_date_date_receive_cod') ;?>"
               <?php }?>
               />
    </td>
</tr>