<?php $order_name = "order_new_{$key}";
?>
<th class="<?php echo $order_name . ' f_tbl_' . $this->controller . '_' . $key; ?>" id="<?php echo 'f_th_' . $key; ?>">
    <input type="text" class="<?php echo $order_name; ?> hidden" name="<?php echo $order_name; ?>"
           value="<?php echo (filter_has_var(INPUT_GET, $order_name)) ? 
                   ((filter_input(INPUT_GET, $order_name) != '') ? filter_input(INPUT_GET, $order_name) : '0') : '0'; ?>" />
           <?php echo $value['name_display'] ?>
           <?php
           if (filter_has_var(INPUT_GET, $order_name) && filter_input(INPUT_GET, $order_name) == 'DESC') {
               echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
           } else if (filter_has_var(INPUT_GET, $order_name) && filter_input(INPUT_GET, $order_name) == 'ASC') {
               echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
           } else {
               echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
           }
           ?>
</th>
