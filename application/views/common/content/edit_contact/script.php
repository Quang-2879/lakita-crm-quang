<tr>
    <td class="text-right"> Lựa chọn kịch bản </td>
    <td>  
        <select class="form-control selectpicker select_script" name="script">
            <option value="0"> Chọn kịch bản </option>
            <?php
            foreach ($scripts as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['script']) echo 'selected'; ?>>
                    <?php echo $value['code']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>

