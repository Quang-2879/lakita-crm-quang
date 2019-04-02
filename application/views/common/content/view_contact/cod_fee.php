<?php if ($rows['cod_fee'] != NULL) { ?>
    <tr>
        <td class="text-right"> Cước vận đơn (đ) </td>
        <td>  
            <?php echo number_format($rows['cod_fee'],0,",",".")." VNĐ"; ?>
        </td>
    </tr>
<?php } ?>