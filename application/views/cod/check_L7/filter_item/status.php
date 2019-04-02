<tr class="filter_provider">
    <td class="text-right"> Trạng thái  </td>
    <td>
        <select class="form-control real_filter selectpicker" name="filter_status_L7">
            <option value="" <?php
            if (!filter_has_var(INPUT_GET, 'filter_status_L7')) {
                echo 'selected="selected"';
            }
            ?>>
                Chọn trạng thái
            </option>
            <option value="phat-thanh-cong" <?php
            if (filter_has_var(INPUT_GET, 'filter_status_L7') && filter_input(INPUT_GET, 'filter_status_L7') == 'phat-thanh-cong') {
                echo 'selected="selected"';
            }
            ?>>
                Phát thành công
            </option>
            <option value="huy-don" <?php
            if (filter_has_var(INPUT_GET, 'filter_status_L7') && filter_input(INPUT_GET, 'filter_status_L7') == 'huy-don') {
                echo 'selected="selected"';
            }
            ?>>
                Chuyển trả người gửi (hủy đơn)
            </option>
        </select>
    </td>
</tr>