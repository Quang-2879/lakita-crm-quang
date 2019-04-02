<tr>
    <td class="text-right"> Contact đúng thông tin mã vận đơn </td>
    <td>
        <select class="form-control real_filter selectpicker" name="correct_cod">
            <option value="0" <?php if (!filter_has_var(INPUT_GET, 'correct_cod')) { ?> selected="selected" <?php } ?>> Chọn contact đúng thông tin mã vận đơn </option>
            <option value="yes" <?php
            if (filter_has_var(INPUT_GET, 'correct_cod') && filter_input(INPUT_GET, 'correct_cod') == 'yes') {
                echo 'selected';
            }
            ?>> Có </option>
            <option value="no" <?php
            if (filter_has_var(INPUT_GET, 'correct_cod') && filter_input(INPUT_GET, 'correct_cod') == 'no') {
                echo 'selected';
            }
            ?>>  Không </option>
        </select>
    </td>
</tr>