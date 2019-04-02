<tr>
    <td class="text-right">
        Chọn chiến dịch quảng cáo
    </td>
    <td>
        <select class="form-control selectpicker" name="edit_<?php echo $key;?>">
            <option value="0"> Chọn chiến dịch quảng cáo </option>
            <?php foreach ($arr as $key => $value) {
                ?>
                <option value="<?php echo $value['id'] ?>" <?php if($value['id'] == $row['campaign_id']) echo 'selected= "selected"';?>> <?php echo $value['name'] ?></option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>
