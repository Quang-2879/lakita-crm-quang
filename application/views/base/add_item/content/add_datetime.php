<tr>
    <td class = "text-right"> <?php echo h_find_name_display($key, $this->list_view); ?></td>
    <td style="position: relative;">
        <input type="text" class="form-control datepicker date_recall" name="add_<?php echo $key; ?>" />
        <a href = "#" class = "reset_datepicker btn btn-primary"> Reset</a>
    </td>
</tr>