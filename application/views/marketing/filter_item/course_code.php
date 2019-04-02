    <tr>
        <td class="text-right"> Mã khóa học? </td>
        <td>
            <select class="form-control channel_id selectpicker" name="filter_arr_multi_course_code[]" multiple>
                <?php
                foreach ($courses as $key => $value) {
                    ?>
                    <option value="<?php echo $value['course_code']; ?>" 
                    <?php
                    if (isset($_GET['filter_arr_multi_course_code'])) {
                        foreach ($_GET['filter_arr_multi_course_code'] as $value2) {
                            if ($value2 == $value['course_code']) {
                                echo 'selected';
                                break;
                            }
                        }
                    }
                    ?>>
                                <?php echo $value['course_code']; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </td>
    </tr>
