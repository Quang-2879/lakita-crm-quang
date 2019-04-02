<tr class="filter_tbl_cod_level">
    <td class="text-right"> Contact đã </td>
    <td>
        <input type="checkbox" name="l8_c3" value="4" data-off-text="Đăng ký" data-on-text="Thu Lakita" data-handle-width="100" <?php if (isset($_GET['l8_c3'])) { ?>
                   checked="checked" <?php } ?>>
    </td>
</tr>
<script>
    $("[name='l8_c3']").bootstrapSwitch();
</script>
