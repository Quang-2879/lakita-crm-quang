<?php $idCopy = h_generateRandomString();?>
<td class="center tbl_url btn-copy view_contact_phone" id-copy="<?php echo $idCopy?>">
    <?php echo $row['url']; ?> &nbsp;&nbsp;&nbsp;
     <input type="text" id="input-copy-<?php echo $idCopy?>" value="<?php echo trim($row['url']); ?>" />
     <sup> 
        <i class="fa fa-clipboard btn-copy" aria-hidden="true" ></i>
    </sup>
</td>

<!--
<td class="center tbl_url btn-copy view_contact_phone" id-copy="<?php echo $idCopy?>">
    <?php echo $row['url']; ?> &nbsp;&nbsp;&nbsp;
    <input type="text" id="input-copy-<?php echo $idCopy?>" value="<?php echo trim($row['url']); ?>" />
    <sup> 
        <i class="fa fa-clipboard btn-copy" aria-hidden="true" ></i>
    </sup>
</td>-->