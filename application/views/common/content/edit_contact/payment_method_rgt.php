<tr>
    <td class="text-right">  Hình thức thanh toán  </td>
    <td>  
        <select class="form-control selectpicker edit_payment_method_rgt" name="payment_method_rgt">
            <?php
            foreach ($payment_method_rgt as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['payment_method_rgt']) echo 'selected'; ?>>
                    <?php echo $value['method']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>