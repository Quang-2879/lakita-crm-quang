<?php if($row['cod_status_id'] == _DA_THU_COD_) {?>
<th>
   <?php echo $row['status'];?>
</th>
<?php } else { ?>
<td class="center tbl_contact_id" style="background-color: #d16a6a; color: #fff;">
     <?php echo $row['status'];?>
</td>
<?php } 