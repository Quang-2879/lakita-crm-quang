
<?php if (isset($marketers)) { ?>
    <tr>
        <td class="text-right"> Chọn marketer </td>
        <td>
            <select class="form-control marketer_id selectpicker" name="filter_marketer_id[]" multiple>
                <?php
                foreach ($marketers as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>" 
                    <?php
                    if (isset($_GET['filter_marketer_id'])) {
                        foreach ($_GET['filter_marketer_id'] as $value2) {
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