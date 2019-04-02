<td class="tbl_call_stt">
    <?php
    if (isset($call_status)) {
        foreach ($call_status as $key2 => $value2) {
            if ($value2['id'] == $value['call_status_id']) {
                echo $value2['name'];
                break;
            }
        }
    }
    ?>
</td>