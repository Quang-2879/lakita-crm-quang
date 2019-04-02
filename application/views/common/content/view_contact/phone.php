<?php $idCopy = h_generateRandomString();?>
<tr>
    <td class="text-right"> Số điện thoại </td>
    <td class="view_contact_phone" id-copy="<?php echo $idCopy?>">  
        <?php echo h_phone_format($rows['phone']); ?> 
        <input type="text" id="input-copy-<?php echo $idCopy?>" value="<?php echo $rows['phone'];?>" />
    </td>
</tr>