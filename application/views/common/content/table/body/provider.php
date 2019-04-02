<td class="tbl_provider_id">
    <?php
    foreach ($providers as $key2 => $value2) {
        ?>
        <?php
        if ($value2['id'] == $value['provider_id']) {
            echo $value2['name'];
            break;
        }
    }
    ?>
</td>