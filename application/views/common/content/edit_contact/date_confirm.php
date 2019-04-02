  <tr>
                    <td class="text-right">  Ngày chốt đơn </td>
                    <td>  
                        <input type="text" class="form-control" 
                        <?php if ($rows['date_confirm'] > 0) { ?>
                                   placeholder="<?php echo date(_DATE_FORMAT_, $rows['date_confirm']); ?>" 
                               <?php } ?>
                               disabled />
                    </td>
                </tr>