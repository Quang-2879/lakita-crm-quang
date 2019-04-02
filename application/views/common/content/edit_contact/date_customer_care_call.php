<?php if ($rows['date_customer_care_call'] > 0) { ?>
    <tr>
        <td class="text-right">  Ngày chăm sóc khách hàng gọi lần đầu </td>
        <td>  
            <input type="text" class="form-control" placeholder="<?php echo date(_DATE_FORMAT_, $rows['date_customer_care_call']); ?>" disabled/>
        </td>
    </tr>
<?php } ?>

