<tr class="filter_date_date_confirm">
    <td class="text-right"> Ngày chốt đơn: </td>
    <td>
 <input type="text" class="form-control daterangepicker" name="filter_date_date_confirm" style="position: static"
        <?php if (filter_has_var(INPUT_GET, 'filter_date_date_confirm')) { ?>
                   value="<?php echo filter_input(INPUT_GET, 'filter_date_date_confirm') ;?>"
               <?php }?>
               />
    </td>
</tr>