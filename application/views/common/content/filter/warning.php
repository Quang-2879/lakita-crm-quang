<tr>
    <td class="text-right"> Cảnh báo </td>
    <td>
        <select class="form-control filter selectpicker" name="filter_warning_cod">
            <option value="0"> Lựa chọn cảnh báo </option>
            <option value="yellow" 
            <?php
            if (isset($_GET['filter_warning_cod']) && $_GET['filter_warning_cod'] == 'yellow') {
                echo 'selected';
            }
            ?>> 
                Báo vàng </option>
            <option value="red" 
            <?php
            if (isset($_GET['filter_warning_cod']) && $_GET['filter_warning_cod'] == 'red') {
                echo 'selected';
            }
            ?>> 
                Báo đỏ </option>
        </select>
    </td>
</tr>
