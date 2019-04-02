<tr class="filter_date_rgt_from">
    <td class="text-right"> Thời gian từ ngày: </td>
    <td>
        <input type="text" class="form-control datepicker" name="date_from"
        <?php if (filter_has_var(INPUT_GET, 'date_from')) { ?>
                   value="<?php echo filter_input(INPUT_GET, 'date_from'); ?>"
               <?php } ?> />
    </td>
</tr>
<tr class="filter_date_rgt_end">
    <td class="text-right"> đến: </td>
    <td>
        <input type="text" class="form-control datepicker" name="date_end"
               <?php if (filter_has_var(INPUT_GET, 'date_end')) { ?>
                   value="<?php echo filter_input(INPUT_GET, 'date_end'); ?>"
               <?php } ?> />
    </td>
</tr>