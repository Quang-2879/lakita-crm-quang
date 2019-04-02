<?php if (isset($cod_status)) { ?>
    <tr class="filter_tbl_cod_status">
        <td class="text-right"> Trạng thái giao hàng </td>
        <td>
            <select class="form-control ordering_status_id selectpicker" name="filter_cod_status_id[]" multiple>
                <?php
                foreach ($cod_status as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>"
                    <?php
                    if (isset($_GET['filter_cod_status_id'])) {
                        foreach ($_GET['filter_cod_status_id'] as $value2) {
                            if ($value2 == $value['id']) {
                                echo 'selected';
                                break;
                            }
                        }
                    }
                    ?>>
                                <?php echo $value['name']; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </td>
    </tr>
<?php } ?>