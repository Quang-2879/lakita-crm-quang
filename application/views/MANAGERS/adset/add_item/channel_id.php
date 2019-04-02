<tr>
    <td class="text-right">
        Chọn kênh quảng cáo
    </td>
    <td>
        <select class="form-control selectpicker" name="add_<?php echo $key;?>">
            <option value="0"> Chọn kênh quảng cáo </option>
            <?php foreach ($arr as $key => $value) {
                ?>
                <option value="<?php echo $value['id'] ?>"> <?php echo $value['name'] ?></option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>
