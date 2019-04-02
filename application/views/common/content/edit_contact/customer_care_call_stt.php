<tr>
    <td class="text-right"> Trạng thái gọi </td>
    <td>  
        <select class="form-control call_status_id selectpicker" name="customer_care_call_id">
            <?php
            foreach ($customer_care_call_stt as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['customer_care_call_id']) echo 'selected'; ?>>
                    <?php echo $value['name']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>