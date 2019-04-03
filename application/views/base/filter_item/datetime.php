<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */


$date_name = 'filter_date_' . $key;

?>

<tr class="filter_date_date_rgt">

    <td class="text-right"> <?php echo h_find_name_display($key, $this->list_view); ?>  : </td>

    <td>

        <input type="text" class="form-control daterangepicker2" name="<?php echo $date_name; ?>" style="position: static"

        <?php if (filter_has_var(INPUT_GET, $date_name)) { ?>

                   value="<?php echo filter_input(INPUT_GET, $date_name) ;?>"

               <?php } ?> 

               />

    </td>

</tr>