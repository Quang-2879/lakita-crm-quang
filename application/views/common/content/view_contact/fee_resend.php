<?php if ($rows['fee_resend'] != NULL) { ?>
    <tr>
        <td class="text-right"> Cước chuyển hoàn (đ) </td>
        <td>  
            <?php echo number_format($rows['fee_resend'],0,",",".")." VNĐ"; ?>
        </td>
    </tr>
<?php } ?>