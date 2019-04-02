<tr>
    <td class="text-right">  Mã khóa học </td>
    <td>  
        <select class="form-control select_course_code selectpicker" name="course_code">
            <option value="0"> Chọn mã khóa học </option>
            <?php foreach ($courses as $key => $value) { ?>
                <option value="<?php echo $value['course_code']; ?>"
                        <?php if ($rows['course_code'] == $value['course_code']) echo "selected"; ?>>
                            <?php echo $value['course_code']; ?> 
                </option>
            <?php } ?>
        </select>
    </td>
</tr>