
<?php if ($rows['date_customer_care_handover'] > 0) { ?>
    <tr>
        <td class="text-right"> Ngày chăm sóc khách hàng nhận contact </td>
        <td>  
            <?php
            echo date(_DATE_FORMAT_, $rows['date_customer_care_handover']);
            ?>
        </td>
    </tr>
<?php } ?>
