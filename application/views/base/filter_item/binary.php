<?php
$name = 'filter_binary_' . $key;

?>
<tr>
    <td class="text-right"> <?php echo h_find_name_display($key, $this->list_view); ?> ? </td>
    <td>
        <select class="form-control real_filter selectpicker" name="<?php echo $name; ?>">
            <option value="0" <?php if (!filter_has_var(INPUT_GET, $name)) { ?> selected="selected" <?php } ?>> 
                <?php echo h_find_name_display($key, $this->list_view); ?> ?  
            </option>
            <option value="yes" <?php
            if (filter_has_var(INPUT_GET, $name) && filter_input(INPUT_GET, $name) == 'yes') {
                echo 'selected';
            }
            ?>> Có </option>
            <option value="no" <?php
            if (filter_has_var(INPUT_GET, $name) && filter_input(INPUT_GET, $name) == 'no') {
                echo 'selected';
            }
            ?>>  Không </option>
        </select>
    </td>
</tr>