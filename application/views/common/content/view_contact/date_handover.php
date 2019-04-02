<?php if ($rows['date_handover'] > 0) { ?>
    <tr>
        <td class="text-right">   Ngày nhận contact </td>
        <td>  <?php
            if ($rows['date_handover'] > 0)
                echo date(_DATE_FORMAT_, $rows['date_handover']);
            ?> 
        </td>
    </tr>
<?php } ?>