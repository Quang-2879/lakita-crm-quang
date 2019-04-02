<th class="order_date_recall tbl_date_recall" id="f_th_tbl_date_recall">
    <input type="text" class="order_date_recall hidden" name="order_date_recall"
           value="<?php echo (isset($_GET['order_date_recall'])) ? (($_GET['order_date_recall'] == '') ? 0 : $_GET['order_date_recall']) : '0'; ?>" />
    Ngày khách hẹn gọi lại
    <?php
    if (isset($_GET['order_date_recall']) && $_GET['order_date_recall'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_date_recall']) && $_GET['order_date_recall'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>