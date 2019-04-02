<div class="pagination">

    <?php echo $this->pagination_link; ?>

</div>

<div class="number_paging"> 

    <?php echo 'Hiển thị ' . $this->begin_paging . ' - ' . $this->end_paging . ' của ' . $this->total_paging . ' bản ghi'; ?>

</div>

<a class="add_item btn btn-primary" href="#"> Thêm 1 dòng mới bằng tay </a>  

<!--<a class="add-item-fetch btn btn-primary" href="#"> Thêm 1 dòng mới từ FB </a> -->
<a class="btn btn-primary" href="<?php echo base_url('MANAGERS/campaign/cost'); ?>"> Nhập phí cho Google Adword Campaign </a> 