<th class="order_date_rgt tbl_date_rgt" id="f_th_tbl_date_rgt">
    <input type="text" class="order_date_rgt hidden" name="order_date_rgt"
           value="<?php echo (isset($_GET['order_date_rgt'])) ? (($_GET['order_date_rgt'] != '') ? $_GET['order_date_rgt'] : '0') : '0'; ?>" />
    Ngày đăng ký
    <?php
    if (isset($_GET['order_date_rgt']) && $_GET['order_date_rgt'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_date_rgt']) && $_GET['order_date_rgt'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>