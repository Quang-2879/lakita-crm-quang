<tr>
    <td class="text-right">  Ngày gọi gần nhất </td>
    <td>  
        <input type="text" class="form-control" 
               <?php if ($rows['date_last_calling'] > 0) { ?>
                   placeholder="<?php echo date(_DATE_FORMAT_, $rows['date_last_calling']); ?>" 
               <?php } ?>
               disabled/>
    </td>
</tr>