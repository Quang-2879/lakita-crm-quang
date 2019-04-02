<td class="center tbl_cod_status">
    <?php
    if ($value['cod_status_id'] == 0 && $value['payment_method_rgt'] == 2) {
        echo 'Chưa chuyển khoản';
    } else {
        foreach ($cod_status as $key2 => $value2) {
            if ($value2['id'] == $value['cod_status_id']) {
                echo $value2['name'];
                break;
            }
        }
    }
    ?>
</td>