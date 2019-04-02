<th class="order_date_confirm tbl_date_confirm" id="f_th_tbl_date_confirm">
    <input type="text" class="order_date_confirm hidden" name="order_date_confirm"
           value="<?php echo (isset($_GET['order_date_confirm']) && $_GET['order_date_confirm'] != '') ? $_GET['order_date_confirm'] : '0'; ?>" />
    Ngày chốt đơn
    <?php
    if (isset($_GET['order_date_confirm']) && $_GET['order_date_confirm'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_date_confirm']) && $_GET['order_date_confirm'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>