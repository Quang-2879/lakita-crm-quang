<tr class="filter_tu_van">
    <td class="text-right"> Contact cần tư vấn (comment facebook)? </td>
    <td>
        <select class="form-control filter selectpicker" name="filter_tu_van">
            <option value="0" <?php if (!isset($_GET['filter_tu_van'])) { ?> selected="selected" <?php } ?>>  </option>
            <option value="yes" <?php if (isset($_GET['filter_tu_van']) && $_GET['filter_tu_van'] == 'yes') echo 'selected'; ?>> Có </option>
            <option value="no" <?php if (isset($_GET['filter_tu_van']) && $_GET['filter_tu_van'] == 'no') echo 'selected'; ?>>  Không </option>
        </select>
    </td>
</tr>