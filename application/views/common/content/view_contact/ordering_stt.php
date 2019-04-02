<tr>
    <td class="text-right">   Trạng thái đơn hàng </td>
    <td>  <?php
        foreach ($ordering_status as $key => $value) {
            if ($value['id'] == $rows['ordering_status_id']) {
                echo $value['name'];
                break;
            }
        }
        ?> 
    </td>
</tr>