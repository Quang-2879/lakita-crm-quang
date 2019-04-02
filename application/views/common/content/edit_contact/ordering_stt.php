<tr>
    <td class="text-right">  Trạng thái đơn hàng </td>
    <td>  
        <select class="form-control ordering_status_id selectpicker" name="ordering_status_id">
            <?php
            foreach ($ordering_status as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['ordering_status_id']) echo 'selected'; ?>>
                    <?php echo $value['name']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>