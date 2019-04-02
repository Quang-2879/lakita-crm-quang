<?php if ($rows['weight_envelope'] != NULL) { ?>
    <tr <?php
    if ($rows['weight_envelope'] > 50) {
        echo 'class="bgred"';
    }
    ?>>
        <td class="text-right"> Khối lượng đơn hàng (g) </td>
        <td>  
    <?php echo $rows['weight_envelope']; ?>
        </td>
    </tr>
<?php
} 