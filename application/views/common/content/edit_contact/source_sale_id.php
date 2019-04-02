<tr>
    <td class="text-right">  Nguồn bán </td>
    <td>  <div class="radio">
        <label class="radio-inline">
            <input type="radio" name="source_sale_id" value="1" <?php if($rows['source_sale_id'] == 1){echo 'checked="checked"';} ?>> Lakita
        </label>
        </div>
        <div class="radio">
        <label class="radio-inline">
            <input type="radio" name="source_sale_id" value="2" <?php if($rows['source_sale_id'] == 2){echo 'checked="checked"';} ?>> Ngoài
        </label>
            </div>
        <div class="radio">
        <label class="radio-inline">
            <input type="radio" name="source_sale_id" value="3" <?php if($rows['source_sale_id'] == 3){echo 'checked="checked"';} ?>> Thầy
        </label>
        </div>
    </td>
</tr>