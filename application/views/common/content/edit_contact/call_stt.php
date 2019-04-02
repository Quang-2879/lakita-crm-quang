<tr>
    <td class="text-right"> Trạng thái gọi </td>
    <td>  
        <select class="form-control call_status_id selectpicker" name="call_status_id">
            <?php
            foreach ($call_status as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['call_status_id']) echo 'selected'; ?>>
                    <?php echo $value['name']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>