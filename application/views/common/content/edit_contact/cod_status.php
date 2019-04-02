<tr>
    <td class="text-right"> Chọn trạng thái giao COD </td>
    <td>  
        <select class="form-control selectpicker cod_status_id" name="cod_status_id">
            <option value="0"> Chọn trạng thái giao COD </option>
            <?php
            foreach ($cod_status as $key => $value) {
                ?>
                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['cod_status_id']) echo 'selected'; ?>>
                    <?php echo $value['name']; ?>
                </option>
                <?php
            }
            ?>
        </select>
    </td>
</tr>