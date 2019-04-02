<tr>
    <td class="text-right">  Nguồn contact </td>
    <td>  <?php
        foreach ($sources as $key => $value) {
            if ($value['id'] == $rows['source_id']) {
                echo $value['name'];
                break;
            }
        }
        ?> 
    </td>
</tr>