<th class="order_price_purchase tbl_price_purchase" id="th_tbl_price_purchase">
    <input type="text" class="order_price_purchase hidden" name="order_price_purchase"
           value="<?php echo (isset($_GET['order_price_purchase'])) ? $_GET['order_price_purchase'] : '0'; ?>" />
    Giá tiền mua
    <?php
//    if (isset($_GET['order_price_purchase']) && $_GET['order_price_purchase'] == 'DESC')
//        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
//    else if (isset($_GET['order_price_purchase']) && $_GET['order_price_purchase'] == 'ASC')
//        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
//    else
//        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>