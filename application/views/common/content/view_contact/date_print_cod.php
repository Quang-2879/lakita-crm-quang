<?php if ($rows['date_print_cod'] > 0) { ?>
    <tr <?php
    $dayDiff = floor((time() - $rows['date_print_cod']) / (60 * 60 * 24));
    if ($dayDiff > 3 && $dayDiff <= 5 && $rows['cod_status_id'] == _DANG_GIAO_HANG_) {
        echo 'class="bgyellow"';
    }
    if ($dayDiff > 5 && $dayDiff <= 30 && $rows['cod_status_id'] == _DANG_GIAO_HANG_) {
        echo 'class="bgred"';
    }
    ?>>
        <td class="text-right">  Ngày in COD </td>
        <td>  
            <?php
            if ($rows['date_print_cod'] > 0) {
                echo date(_DATE_FORMAT_, $rows['date_print_cod']);
            }
            ?>
        </td>
    </tr>
    <?php
}