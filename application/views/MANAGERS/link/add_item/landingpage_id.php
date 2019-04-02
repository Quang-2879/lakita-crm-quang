<tr>
    <td class="text-right">
        Chọn landing page
    </td>
    <td>

            <select class="form-control selectpicker pull-right" name="add_<?php echo $key; ?>">
                <option value="0"> Chọn landing page </option>
                <?php foreach ($arr as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id'] ?>" data-url="<?php echo $value['url'] ?>"> <?php echo $value['landingpage_code'] . ' - ' . $value['url'] ?></option>
                    <?php
                }
                ?>
            </select>
<!--            <div class="input-group-btn" id="basic-addon2"> <button class="btn btn-success btn-preview"> Xem trước landingpage </button> </div>-->
   
    </td>
</tr>
