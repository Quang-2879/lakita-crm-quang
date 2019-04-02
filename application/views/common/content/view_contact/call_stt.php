<tr>
    <td class="text-right">  Trạng thái gọi </td>
    <td>  <?php
        foreach ($call_status as $key => $value) {
            if ($value['id'] == $rows['call_status_id']) {
                echo $value['name'];
                break;
            }
        }
        ?> 
    </td>
</tr>