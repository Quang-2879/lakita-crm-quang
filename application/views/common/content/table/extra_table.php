<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <table class="table extra-table">
            <tbody>
                <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right">  Email </td>
                    <td class="extra-view-contact-email">  <?php echo $value['email']; ?> </td>
                </tr>
                <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right"> Ngày đăng ký </td>
                    <td class="extra_view_contact_phone">  
                        <?php echo date('d/m/Y H:i:s', $value['date_rgt']); ?>
                    </td>
                </tr>
                 <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right">  Ma trận  </td>
                    <td>   <?php
                        if ($value['matrix'] != '') {
                            echo $value['matrix'];
                        } else {
                            echo isset($value['marketer_name']) ? $value['marketer_name'] : '';
                        }
                        ?> 
                    </td>
                </tr>
                 <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right">  TVTS </td>
                    <td class="extra_view_course_code">  <?php
                        foreach ($staffs as $key2 => $value2) {
                            if ($value2['id'] == $value['sale_staff_id']) {
                                echo $value2['name'];
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right"> Trạng thái gọi </td>
                    <td>  <?php
                        if (isset($call_status)) {
                            foreach ($call_status as $key2 => $value2) {
                                if ($value2['id'] == $value['call_status_id']) {
                                    echo $value2['name'];
                                    break;
                                }
                            }
                        }
                        ?> 
                    </td>
                </tr> 
                <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right">  Trạng thái đơn hàng </td>
                    <td> <?php
                        if (isset($ordering_status)) {
                            foreach ($ordering_status as $key2 => $value2) {
                                if ($value2['id'] == $value['ordering_status_id']) {
                                    if ($value['ordering_status_id'] == _DONG_Y_MUA_) {
                                        foreach ($cod_status as $key3 => $value3) {
                                            if ($value3['id'] == $value['cod_status_id']) {
                                                echo $value3['name'];
                                                break;
                                            }
                                        }
                                    } else {
                                        echo $value2['name'];
                                        break;
                                    }
                                }
                            }
                        }
                        ?> 
                    </td>
                </tr>  
                 <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right"> Trạng thái giao hàng </td>
                    <td>  <?php
                        if ($value['cod_status_id'] == 0 && $value['payment_method_rgt'] == 2) {
                            echo 'Chưa chuyển khoản';
                        } else {
                            foreach ($cod_status as $key2 => $value2) {
                                if ($value2['id'] == $value['cod_status_id']) {
                                    echo $value2['name'];
                                    break;
                                }
                            }
                        }
                        ?>  
                    </td>
                </tr>
                 <tr class="<?php echo h_get_row_class($value); ?>">
                    <td class="text-right"> Hình thức thanh toán </td>
                    <td>  
                        <?php
                        if (isset($payment_method_rgt)) {
                            foreach ($payment_method_rgt as $key2 => $value2) {
                                if ($value2['id'] == $value['payment_method_rgt']) {
                                    echo $value2['method'];
                                    break;
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>