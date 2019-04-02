<?php if ($rows['date_confirm'] > 0) { ?>
    <tr>
        <td class="text-right">  Ngày chốt đơn </td>
        <td>  <?php
            if ($rows['date_confirm'] > 0)
                echo date(_DATE_FORMAT_, $rows['date_confirm']);
            ?> 
        </td>
    </tr>
<?php } ?>