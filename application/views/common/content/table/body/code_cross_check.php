<td class="center tbl_code_cross_check btn-copy" data-clipboard-text="<?php echo trim($value['code_cross_check']); ?>">
  <?php if($value['provider_id']==1)   {
 
  ?>
    <a href="https://www.viettelpost.com.vn/Tracking?KEY=<?php echo $value['code_cross_check']; ?>" target="_blank"><?php echo $value['code_cross_check']; ?></a>
  <?php } if($value['provider_id']==8) { 
  ?>
 
   <a href="http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key=<?php echo $value['code_cross_check']; ?>" target="_blank"><?php echo $value['code_cross_check']; ?></a>
  <?php } ?>
    <sup> 
        <i class="fa fa-clipboard btn-copy" aria-hidden="true" data-clipboard-text="<?php echo trim($value['code_cross_check']); ?>"></i>
    </sup>
</td>