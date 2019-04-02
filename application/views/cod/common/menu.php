<ul class="nav-list list-inline display-flex">
    <li>
        <a data-filter=".97" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>public/images/L6.png"> 
            <span> Danh sách contact đồng ý mua  (<?php echo $this->L['L6'];?>)</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('cod/contact-dang-giao-hang.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/pending.png"> 
            <span>  Contact đang giao hàng  (<?php echo $this->L['pending'];?>)</span>
        </a>
    </li>
    
    <li>
        <a href="<?php echo base_url('cod/contact-chuyen-khoan.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/banking.png"> 
            <span> Contact chuyển khoản  (<?php echo $this->L['transfer'];?>) </span> 
        </a>
    </li>
    
</ul>
<ul class="nav-list list-inline display-flex">
    <li>
        <a href="<?php echo base_url('cod/tracking'); ?>">
            <img src="<?php echo base_url(); ?>public/images/tracking.png"> 
            <span> Theo dõi đơn hàng Viettel </span> 
        </a>
    </li>
    
    <li>
        <a data-filter=".97" href="<?php echo base_url('cod/xem-tat-ca-contact.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/view-all.png"> 
            <span> Danh sách toàn bộ contact  (<?php echo $this->L['all'];?>) </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('cod/tai-file-doi-soat-l7.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/compare.png"> 
            <span> Tải file đối soát Viettel L7   </span> 
        </a>
    </li>
   
</ul>
<ul class="nav-list list-inline display-flex">
     <li>
        <a href="<?php echo base_url('cod/tai-file-doi-soat-l8.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/L8.png"> 
            <span> Tải file đối soát Viettel L8 </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('cod/tai-file-doi-soat-cuoc.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/fee.png"> 
            <span> Tải file cước phí COD </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('home/logout'); ?>">
            <img src="<?php echo base_url(); ?>public/images/logout.png"> 
            <span> Đăng xuất  </span>
        </a>
    </li>
</ul>
