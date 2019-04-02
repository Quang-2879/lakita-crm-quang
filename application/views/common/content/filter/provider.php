<tr class="filter_provider">
    <td class="text-right"> Chọn đơn vị giao hàng </td>
    <td>
        <select class="form-control provider_id filter selectpicker" name="filter_provider_id">
            <option value="0"> Chọn đơn vị giao hàng </option>
            <?php
            if (isset($providers)) {
                foreach ($providers as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>"
                            <?php if (isset($_GET['filter_provider_id']) && $value['id'] == $_GET['filter_provider_id']) echo 'selected'; ?>>
                                <?php echo $value['name']; ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
    </td>
</tr>