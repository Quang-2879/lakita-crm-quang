<?php if (isset($call_status)) { ?>
    <tr>
        <td class="text-right"> Trạng thái gọi </td>
        <td>
            <select class="form-control call_status_id selectpicker" name="filter_call_status_id[]" multiple>
                <?php
                foreach ($call_status as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>" 
                    <?php
                    if (isset($_GET['filter_call_status_id'])) {
                        foreach ($_GET['filter_call_status_id'] as $value2) {
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