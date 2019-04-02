<tr class="filter_tbl_cod_level">
    <td class="text-right"> Loại báo cáo </td>
    <td>
        <input type="checkbox" name="tic_report" value="1" data-off-text="Phát sinh" data-on-text="TIC" data-handle-width="100" <?php if (isset($_GET['tic_report'])) { ?>
                   checked="checked" <?php } ?>>
    </td>
</tr>
<script>
    $("[name='tic_report']").bootstrapSwitch();
</script>
