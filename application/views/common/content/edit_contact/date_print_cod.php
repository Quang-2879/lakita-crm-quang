<tr class="tbl_cod">
    <td class="text-right">  Ngày in COD </td>
    <td>  
        <?php
        if ($rows['date_print_cod'] > 0) {
            echo date(_DATE_FORMAT_, $rows['date_print_cod']);
        }
        ?>
    </td>
</tr>