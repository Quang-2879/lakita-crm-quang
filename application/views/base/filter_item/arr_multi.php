<?php

/*

 * Ghi chú các tham số

 * @key: tên key của trường hiển thị ở trường lọc

 * @field: trường sẽ lọc trong bảng đó (ví dụ: marketer_id, channel_id, course_code). Mặc định là 'id'

 * @field_name: tên trường hiển thị (dùng để hiển thị trong ô combo box). Mặc định là 'name'

 * @get_name: tên trường sẽ get (cần nối thêm chuỗi filter_arr_multi để phân biệt với các loại filter khác)

 */


$field = isset($value['field']) ? $value['field'] : ($key.'_id');

$field_name = isset($value['field_name']) ? $value['field_name'] : 'name';

$get_name = 'filter_arr_multi_' . $field;

$table_id = isset($value['table_id']) ? $value['table_id'] : 'id';

?>

<tr>

    <td class="text-right"> <?php echo h_find_name_display($key, $this->list_view); ?> ?  </td>

    <td>

        <select class="form-control channel_id selectpicker" name="<?php echo $get_name; ?>[]" multiple>

            <?php

            foreach ($$key as $value) {

                ?>

                <option value="<?php echo $value[$table_id]; ?>" 

                <?php

                if ((filter_has_var(INPUT_GET, $get_name))) {

                    foreach ($_GET[$get_name] as $value2) {

                        if ($value2 == $value[$table_id]) {

                            echo 'selected';

                            break;

                        }

                    }

                }

                ?>>

                <?php echo $value[$field_name]; ?>

                </option>

                <?php

            }

            ?>

        </select>

    </td>

</tr>

