<td class="tbl_ordering_stt">
    <?php
    if (isset($ordering_status)) {
        foreach ($ordering_status as $key2 => $value2) {
            if ($value2['id'] == $value['ordering_status_id']) {
                if ($value['ordering_status_id'] == _DONG_Y_MUA_) {
                    foreach ($cod_status as $key3 => $value3) {
                        if ($value3['id'] == $value['cod_status_id']) {
                            echo $value3['name'];
                            break;
                        }
                    }
                } else {
                    echo $value2['name'];
                    break;
                }
            }
        }
    }
    ?>
</td>