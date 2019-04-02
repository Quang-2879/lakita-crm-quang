<td class="center tbl_date_print_cod <?php
$date_print_cod = strtotime(date('Y-m-d', $value['date_print_cod']));
?>">
        <?php    if ($value['date_print_cod'] > 0) {
        echo date('d/m/Y H:i:s', $value['date_print_cod']);
    }
    ?> 
        <?php if (floor((time() - $value['date_print_cod']) / (60 * 60 * 24)) > 3 && $value['cod_status_id'] == _DANG_GIAO_HANG_) { ?>
        <sup> <span class="badge badge-star">
                <?php echo floor((time() - $value['date_print_cod']) / (60 * 60 * 24)); ?>
            </span></sup>
    <?php } ?>
</td>