<?php if ($rows['code_cross_check'] != '') { ?>
    <tr>
        <td class="text-right"> Mã Bill </td>
        <td> 
            <?php if ($rows['provider_id'] == 1) { ?>
                <a href="https://www.viettelpost.com.vn/Tracking?KEY=<?php echo $rows['code_cross_check']; ?>" target="_blank">
                    <?php echo $rows['code_cross_check']; ?></a>
            <?php } elseif ($rows['provider_id'] == 8) { ?>
                <a href="http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key=<?php echo $rows['code_cross_check']; ?>" target="_blank">
                    <?php echo $rows['code_cross_check']; ?></a>
            <?php } elseif ($rows['code_cross_check'] != '') {
                echo $rows['code_cross_check'];
            } ?>		
        </td>
    </tr>
<?php } ?>