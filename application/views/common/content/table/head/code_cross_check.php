<th class="order_code_cross_check tbl_code_cross_check" id="th_tbl_code_cross_check">
    <input type="text" class="order_code_cross_check hidden" name="order_code_cross_check"
           value="<?php echo (isset($_GET['order_code_cross_check'])) ? $_GET['order_code_cross_check'] : '0'; ?>" />
    Mã vận đơn 
    <?php
    if (isset($_GET['order_code_cross_check']) && $_GET['order_code_cross_check'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_code_cross_check']) && $_GET['order_code_cross_check'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>