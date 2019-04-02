
<?php if ($rows['date_customer_care_handover'] > 0) { ?>
    <tr>
        <td class="text-right"> Ngày chăm sóc khách hàng nhận contact </td>
        <td>  
            <input type="text" class="form-control" placeholder="<?php echo date(_DATE_FORMAT_, $rows['date_customer_care_handover']); ?>" disabled/>
        </td>
    </tr>
<?php } ?>
