<tr class="filter_date_date_last_calling">
    <td class="text-right"> Ngày gọi cuối cùng: </td>
    <td>
 <input type="text" class="form-control daterangepicker" name="filter_date_date_last_calling" style="position: static"
        <?php if (filter_has_var(INPUT_GET, 'filter_date_date_last_calling')) { ?>
                   value="<?php echo filter_input(INPUT_GET, 'filter_date_date_last_calling') ;?>"
               <?php }?>
               />
    </td>
</tr>