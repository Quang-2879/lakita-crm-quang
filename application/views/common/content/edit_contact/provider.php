<tr class="tbl_cod">
    <td class="text-right"> Chọn đơn vị giao hàng </td>
    <td>  
        <select class="form-control selectpicker" name="provider_id">
            <option value="0"> Chọn đơn vị giao hàng </option>
            <?php
            foreach ($providers as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['provider_id']) echo 'selected'; ?>>
                    <?php echo $value['name']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>