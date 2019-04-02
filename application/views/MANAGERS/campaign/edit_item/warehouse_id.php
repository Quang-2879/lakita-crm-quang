<tr id="warehouse-row" <?php if ($row['channel_id'] != 5) echo 'style="display: none;"'; else { echo 'style="display: contents;"'; } ?> >

    <td class="text-right">

        Chọn kho email

    </td>

    <td>

        <select class="form-control" name="edit_<?php echo $key;?>">

            <option value="0"> Chọn kho email </option>

            <?php foreach ($arr as $key => $value) {

                ?>
                <option value="<?php echo $value['id'] ?>" 

                    <?php if($value['id'] == $row['warehouse_id']) echo 'selected= "selected"';?>> <?php echo $value['name'] ?>

                </option>

                <?php

            }

            ?>

        </select>

    </td>

</tr>

<script type="text/javascript">
    $('#channel-val').change(function() {
        if ($(this).val() == 5) {
                if ($('#warehouse-row').css('display') == 'none') {
                    $('#warehouse-row').css('display', 'contents');
                }
            }
            else {
                if ($('#warehouse-row').css('display') == 'contents') {
                    $('#warehouse-row').css('display', 'none');
                }
            }
    });
</script>
