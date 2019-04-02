
<tr>
    <td class="text-right"> Hình thức thanh toán </td>
    <td>
        <?php
        if (isset($payment_method_rgt)) {
            foreach ($payment_method_rgt as $key => $value) {
                if ($value['id'] == $rows['payment_method_rgt']) {
                    echo $value['method'];
                    break;
                }
            }
        }
        ?>
    </td>
</tr>