<?php if ($rows['date_receive_lakita'] > 0) { ?>
    <tr>
        <td class="text-right">  Ngày nhận tiền Lakita </td>
        <td>  <?php
            if ($rows['date_receive_lakita'] > 0)
                echo date(_DATE_FORMAT_, $rows['date_receive_lakita']);
            ?> 
        </td>
    </tr>
<?php } ?>