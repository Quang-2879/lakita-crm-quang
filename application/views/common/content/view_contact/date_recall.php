<?php if ($rows['date_recall'] > 0) { ?>
    <tr>
        <td class="text-right"> Ngày khách hẹn gọi lại </td>
        <td>   <?php
            if ($rows['date_recall'] > 0) {
                echo date(_DATE_FORMAT_, $rows['date_recall']);
            }
            ?>  
        </td>
    </tr>
<?php } 