<th class="order_date_last_calling tbl_date_last_calling" id="th_tbl_date_last_calling">
    <input type="text" class="order_date_last_calling hidden" name="order_date_last_calling"
           value="<?php echo (isset($_GET['order_date_last_calling']) && $_GET['order_date_last_calling'] != '') ? $_GET['order_date_last_calling'] : '0'; ?>" />
    Ngày gọi gần nhất
    <?php
    if (isset($_GET['order_date_last_calling']) && $_GET['order_date_last_calling'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_date_last_calling']) && $_GET['order_date_last_calling'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>