<?php if ($rows['provider_id'] > 0) { ?>
    <tr>
        <td class="text-right"> Đơn vị giao hàng </td>
        <td>  
            <?php
            foreach ($providers as $key => $value) {
                if ($value['id'] == $rows['provider_id']) {
                    echo $value['name'];
                    break;
                }
            }
            ?>
        </td>
    </tr>
<?php
}?>