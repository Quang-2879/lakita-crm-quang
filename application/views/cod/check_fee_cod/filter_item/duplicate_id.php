<tr>
    <td class="text-right"> Contact bị trùng mã vận đơn ? </td>
    <td>
        <select class="form-control real_filter selectpicker" name="filter_duplicate_id">
            <option value="0" <?php if (!filter_has_var(INPUT_GET, 'filter_duplicate_id')) { ?> selected="selected" <?php } ?>> Contact bị trùng mã vận đơn?  </option>
            <option value="yes" <?php
            if (filter_has_var(INPUT_GET, 'filter_duplicate_id') && filter_input(INPUT_GET, 'filter_duplicate_id') == 'yes') {
                echo 'selected';
            }
            ?>> Có </option>
            <option value="no" <?php
            if (filter_has_var(INPUT_GET, 'filter_duplicate_id') && filter_input(INPUT_GET, 'filter_duplicate_id') == 'no') {
                echo 'selected';
            }
            ?>>  Không </option>
        </select>
    </td>
</tr>