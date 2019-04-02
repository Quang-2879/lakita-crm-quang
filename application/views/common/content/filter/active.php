<tr class="filter_tbl_cod_level">
    <td class="text-right"> Đã kích hoạt chưa ? </td>
    <td>
        <input type="checkbox" name="active" value="1" data-off-text="Chưa kích hoạt" data-on-text="Đã kích hoạt" data-handle-width="100" <?php if (isset($_GET['active'])) { ?>
                   checked="checked" <?php } ?>>
    </td>
</tr>
<script>
    $("[name='active']").bootstrapSwitch();
</script>
