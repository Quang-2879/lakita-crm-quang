<?php if (isset($sources)) { ?>
    <tr>
        <td class="text-right"> Nguồn contact </td>
        <td>
            <select class="form-control source_id selectpicker" name="filter_source_id[]" multiple>
                <?php
                foreach ($sources as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>" 
                    <?php
                    if (isset($_GET['filter_source_id'])) {
                        foreach ($_GET['filter_source_id'] as $value2) {
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