<th class="order_date_print_cod tbl_date_print_cod" id="th_tbl_date_print_cod">
    <input type="text" class="order_date_print_cod hidden" name="order_date_receive_cod"
           value="<?php echo (isset($_GET['order_date_receive_cod']) && $_GET['order_date_receive_cod'] != '') ? $_GET['order_date_receive_cod'] : '0'; ?>" />
    Ngày nhận COD
    <?php
    if (isset($_GET['order_date_receive_cod']) && $_GET['order_date_receive_cod'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_date_receive_cod']) && $_GET['order_date_receive_cod'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>