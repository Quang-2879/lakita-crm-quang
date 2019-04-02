<tr class="filter_date_rgt_from">
    <td class="text-right"> Ngày phát sinh từ: </td>
    <td>
        <input type="text" class="form-control datepicker" name="filter_date_happen_from"
        <?php if (isset($_GET['filter_date_happen_from'])) { ?>
                   value="<?php echo $_GET['filter_date_happen_from']; ?>"
               <?php } ?> />
    </td>
</tr>
<tr class="filter_date_rgt_end">
    <td class="text-right"> đến: </td>
    <td>
        <input type="text" class="form-control datepicker" name="filter_date_happen_end"
               <?php if (isset($_GET['filter_date_happen_end'])) { ?>
                   value="<?php echo $_GET['filter_date_happen_end']; ?>"
               <?php } ?> />
    </td>
</tr>