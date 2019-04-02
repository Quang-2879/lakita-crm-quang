<tr class="filter_tbl_cod_level">
    <td class="text-right"> Lọc theo tháng phát sinh </td>
    <td>
        <select class="form-control cod_level_id filter selectpicker" name="filter_month_id">
              <option value="0"> Chọn tháng </option>
            <?php
            print_r($month_ids);
                foreach ($month_ids as $key => $value) {
                    ?>
                    <option value="<?php echo $value['month_id']; ?>"
                     <?php if (isset($_GET['filter_month_id']) && $value['month_id'] == $_GET['filter_month_id']) echo 'selected'; ?>>
                                <?php echo $value['month_id']; ?>
                    </option>
                    <?php
                }
                ?>
        </select>
    </td>
</tr>
