<?php if($rows['date_last_calling'] > 0) { ?>
<tr>
    <td class="text-right"> Ngày gọi gần nhất </td>
    <td>  <?php
        if ($rows['date_last_calling'] > 0)
            echo date(_DATE_FORMAT_, $rows['date_last_calling']);
        ?> 
    </td>
</tr>
<?php } ?>