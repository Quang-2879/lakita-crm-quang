<?php if (isset($channel)) { ?>
    <tr>
        <td class="text-right"> Kênh quảng cáo </td>
        <td>
            <select class="form-control channel_id selectpicker" name="filter_channel_id[]" multiple>
                <?php
                foreach ($channel as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>" 
                    <?php
                    if (isset($_GET['filter_channel_id'])) {
                        foreach ($_GET['filter_channel_id'] as $value2) {
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