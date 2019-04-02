<tr>
    <td class="text-right">
        <?php echo h_find_name_display($key, $this->list_view); ?>
    </td>
    <td>
        <select class="form-control select_course_code selectpicker" name="edit_<?php echo $key; ?>">
            <option value="0"> Chọn <?php echo h_find_name_display($key, $this->list_view); ?> </option>
            <?php foreach ($arr as $key => $value) {
                ?>
                <option value="<?php echo $value['course_code'] ?>" 
                <?php
                if ($value['course_code'] == $row['course_code']) {
                    echo 'selected = "selected"';
                }
                ?>> <?php echo $value['course_code'] ?></option>
                        <?php
                    }
                    ?>
        </select>
    </td>
<tr>
