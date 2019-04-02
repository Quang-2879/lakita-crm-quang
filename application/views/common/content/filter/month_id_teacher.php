<tr class="filter_tbl_cod_level">
    <td class="text-right"> Lọc theo tháng phát sinh </td>
    <td>
        <input type="text" data-format="M/yyyy"  class="form-control datepicker" name="filter_month_id"
               <?php if (isset($_GET['filter_month_id'])) { ?>
                   value="<?php echo $_GET['filter_month_id']; ?>"
               <?php } ?> />


    </td>
</tr>


