<!-- URL xóa 1 dòng -->
<input type="hidden" value="<?php echo base_url() . $this->controller_path . '/delete_item' ?>" id="url_delete_item" />

<!-- URL xóa nhiều dòng -->
<input type="hidden" value="<?php echo base_url() . $this->controller_path . '/delete_multi_item' ?>" id="url_delete_multi_item" />

<!-- URL sửa dòng -->
<input type="hidden" value="<?php echo base_url().$this->controller_path.'/show_edit_item'?>" id="url_edit_item" />

<!-- URL hiện tại (dùng trong trường hợp redirect về trang web cũ) -->
<input type="hidden" value="" id="curr_url" />

<!-- Base URL -->
<input type="hidden" value="<?php echo base_url();?>" id="base_url" />