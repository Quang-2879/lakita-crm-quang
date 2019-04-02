<tr>

    <td class="text-right">

        Chọn khóa học

    </td>

    <td>

        <select id="channel-val" class="form-control selectpicker" name="add_<?php echo $key;?>">

            <option value="0"> Chọn khóa học </option>

            <?php foreach ($arr as $key => $value) {

                ?>

                <option value="<?php echo $value['id'] ?>"> <?php echo $value['course_code'] ?></option>

                <?php

            }

            ?>

        </select>

    </td>

</tr>