<tr class="filter_duplicate">
    <td class="text-right"> Contact bị trùng? </td>
    <td>
        <select class="form-control filter selectpicker" name="filter_duplicate_id">
            <option value="0" <?php if (!isset($_GET['filter_duplicate_id'])) { ?> selected="selected" <?php } ?>>  </option>
            <option value="yes" <?php if (isset($_GET['filter_duplicate_id']) && $_GET['filter_duplicate_id'] == 'yes') echo 'selected'; ?>> Có </option>
            <option value="no" <?php if (isset($_GET['filter_duplicate_id']) && $_GET['filter_duplicate_id'] == 'no') echo 'selected'; ?>>  Không </option>
        </select>
    </td>
</tr>