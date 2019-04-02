<th class="order_last_activity tbl_last_activity" id="f_th_tbl_last_activity">
    <input type="text" class="order_last_activity hidden" name="order_last_activity"
           value="<?php echo (isset($_GET['order_last_activity']) && $_GET['order_last_activity'] != '') ? $_GET['order_last_activity'] : '0'; ?>" />
    Cập nhật lần cuối
    <?php
    if (isset($_GET['order_last_activity']) && $_GET['order_last_activity'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_last_activity']) && $_GET['order_last_activity'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>