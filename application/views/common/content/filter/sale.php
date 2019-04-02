<tr class="filter_sale_id">
    <td class="text-right"> Tư vấn tuyển sinh </td>
    <td>
        <select class="form-control selectpicker" name="filter_sale_id[]" multiple>
            <?php foreach ($staffs as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>"
                <?php
                if (isset($_GET['filter_sale_id'])) {
                    foreach ($_GET['filter_sale_id'] as $value2) {
                        if ($value2 == $value['id']) {
                            echo 'selected';
                            break;
                        }
                    }
                }
                ?>>
                            <?php echo $value['name']; ?>
                </option>
            <?php } ?>
        </select>
    </td>
</tr>