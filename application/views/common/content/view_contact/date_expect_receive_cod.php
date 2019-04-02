  <?php if ($rows['date_expect_receive_cod'] > 0) { ?>
                <tr>
                    <td class="text-right">  Ngày dự kiến giao hàng </td>
                    <td>  
                        <?php
                        echo date(_DATE_FORMAT_, $rows['date_expect_receive_cod']);
                        ?>
                    </td>
                </tr>
            <?php } ?>