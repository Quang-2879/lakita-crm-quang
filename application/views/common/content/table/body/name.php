<td class="center tbl_name">
    <?php
    if ($value['cod_status_id'] == _HUY_DON_ || $value['ordering_status_id'] == _TU_CHOI_MUA_ || $value['ordering_status_id'] == _CONTACT_CHET_ || $value['call_status_id'] == _SO_MAY_SAI_ || $value['call_status_id'] == _NHAM_MAY_) {
        echo '<i class="fa fa-ban" aria-hidden="true"></i> ';
    }
    ?>
    <?php echo $value['name']; ?> 
    <?php if (isset($value['star']) && $value['star'] > 1) { ?>
        <sup> <span 
                class="badge badge-star ajax-request-modal" 
                data-controller="<?php echo $controller; ?>"
                data-contact-id ="<?php echo $value['id']; ?>"
                data-modal-name="view-all-contact-courses-div"
                data-url="common/ViewAllContactCourse">
                    <?php echo $value['star']; ?>
            </span></sup>
    <?php } ?>
</td>
