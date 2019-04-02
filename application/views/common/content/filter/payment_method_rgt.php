<tr class="filter_payment_method_rgt">
    <td class="text-right"> Hình thức thanh toán </td>
    <td>
        <select class="form-control selectpicker" name="filter_payment_method_rgt[]" multiple>
            <?php
            if (isset($payment_method_rgt)) {
                foreach ($payment_method_rgt as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>" 
                    <?php
                    if (isset($_GET['filter_payment_method_rgt'])) {
                        foreach ($_GET['filter_payment_method_rgt'] as $value2) {
                            if ($value2 == $value['id']) {
                                echo 'selected';
                                break;
                            }
                        }
                    }
                    ?>>
                                <?php echo $value['method']; ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
    </td>
</tr>