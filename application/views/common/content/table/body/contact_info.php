<td class="center tbl_name">
    <table class="table table-bordered" style="color:#000;">
        <tbody>
            <tr>
                <td style="height: 40px;"> Họ tên </td>
                <td style="height: 40px;">
                    <?php
                    if ($value['cod_status_id'] == _HUY_DON_ || $value['ordering_status_id'] == _TU_CHOI_MUA_ || $value['ordering_status_id'] == _CONTACT_CHET_ || $value['call_status_id'] == _SO_MAY_SAI_ || $value['call_status_id'] == _NHAM_MAY_) {
                        echo '<i class="fa fa-ban" aria-hidden="true"></i> ';
                    }
                    ?>
                    <?php echo $value['name']; ?> 
                    <?php if (isset($value['star']) && $value['star'] > 1) { ?>
                        <sup><span 
                                class="badge badge-star ajax-request-modal" 
                                data-controller="<?php echo $controller; ?>"
                                data-contact-id ="<?php echo $value['id']; ?>"
                                data-modal-name="view-all-contact-courses-div"
                                data-url="common/ViewAllContactCourse">
                                    <?php echo $value['star']; ?>
                            </span></sup>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td style="height: 40px;"> ĐT </td>
                <td style="height: 40px;">
                    <?php echo h_phone_format($value['phone']); ?>  
                </td>
            </tr>
            <tr>
                <td style="height: 40px;"> Địa chỉ </td>
                <td style="height: 40px;">
                    <?php echo $value['address']; ?> 
                </td>
            </tr>
            <tr>
                <td style="height: 40px;"> Mã bill </td>
                <td style="height: 40px;">
                    <a href="https://www.viettelpost.com.vn/Tracking?KEY=<?php echo $value['code_cross_check']; ?>" 
                       target="_blank" style="color:#000;"><?php echo $value['code_cross_check']; ?></a>
                    <sup> 
                        <i class="fa fa-clipboard btn-copy" aria-hidden="true" data-clipboard-text="<?php echo trim($value['code_cross_check']); ?>"></i>
                    </sup>
                </td>
            </tr>
        </tbody>
    </table>
</td>
