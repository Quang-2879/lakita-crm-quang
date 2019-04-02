
<tr>
    <td class="text-right">  Trạng thái giao hàng </td>
    <td> 
        <?php
        foreach ($cod_status as $key2 => $value2) {
            if ($value2['id'] == $rows['cod_status_id']) {
                echo $value2['name'];
                break;
            }
        }
        ?>
    </td>
</tr>
