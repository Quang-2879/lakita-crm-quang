<tr>
    <td class="text-right">
        Chọn ad
    </td>
    <td>
        <select class="form-control selectpicker" name="edit_<?php echo $key; ?>">
            <option value="0"> Chọn ad </option>
            <?php foreach ($arr as $key => $value) {
                ?>
                <option value="<?php echo $value['id'] ?>"
                        <?php if ($value['id'] == $row['landingpage_id']) echo 'selected= "selected"'; ?>> 
                            <?php echo $value['url'] ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>
