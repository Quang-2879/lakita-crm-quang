<th class="order_date_handover tbl_date_handover" id="th_tbl_date_handover">
    <input type="text" class="order_date_handover hidden" name="order_date_handover"
           value="<?php echo (isset($_GET['order_date_handover']) && $_GET['order_date_handover'] != '') ? $_GET['order_date_handover'] : '0'; ?>" />
    Ngày được phân contact
    <?php
    if (isset($_GET['order_date_handover']) && $_GET['order_date_handover'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_date_handover']) && $_GET['order_date_handover'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>