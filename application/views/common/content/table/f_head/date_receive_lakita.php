<th class="order_date_print_cod tbl_date_print_cod" id="th_tbl_date_print_cod">
    <input type="text" class="order_date_print_cod hidden" name="order_date_receive_lakita"
           value="<?php echo (isset($_GET['order_date_receive_lakita']) && $_GET['order_date_receive_lakita'] != '') ? $_GET['order_date_receive_lakita'] : '0'; ?>" />
    Ngày nhận COD
    <?php
    if (isset($_GET['order_date_receive_lakita']) && $_GET['order_date_receive_lakita'] == 'DESC')
        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
    else if (isset($_GET['order_date_receive_lakita']) && $_GET['order_date_receive_lakita'] == 'ASC')
        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
    else
        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
    ?>
</th>