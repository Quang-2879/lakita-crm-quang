<ul class="nav-list list-inline display-flex">
    <li>
        <a data-filter=".97" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>public/images/new.png"> 
            <span> Danh sách contact mới (<?php echo $this->L['L1']; ?>)
<!--            <sup> <span class="badge bg-red"> <?php echo $this->L['L1']; ?> </span> </sup>-->
            </span>
        </a>
    </li>
    <li>
        <a data-filter=".97" href="<?php echo base_url('quan-ly/xem-tat-ca-contact.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/view-all.png"> 
            <span> Danh sách toàn bộ contact (<?php echo $this->L['all']; ?>)
<!--<sup> <span class="badge bg-red"> <?php echo $this->L['all']; ?> </span> </sup>-->
            </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('quan-ly/them-contact.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/add-contact.png"> 
            <span> Thêm mới contact </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('quan-ly/xem-bao-cao-tu-van-tuyen-sinh.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/tvts.png"> 
            <span> Xem báo cáo TVTS </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('quan-ly/xem-bao-cao-doanh-thu.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/dollar.png"> 
            <span> Xem báo cáo doanh thu  </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('config/course'); ?>">
            <img src="<?php echo base_url(); ?>public/images/courses.png"> 
            <span> Cài đặt khóa học </span>
        </a>
    </li>
</ul>
<ul class="nav-list list-inline display-flex">
    <li>
        <a href="<?php echo base_url('tu-van-tuyen-sinh/contact-con-cuu-duoc.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/can-save.png"> 
            <span>Danh sách contact còn cứu được  (<?php echo $this->L['can_save']; ?>) </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('tu-van-tuyen-sinh/contact-co-lich-hen.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/call-back.png"> 
            <span> Danh sách contact có lịch hẹn gọi lại  (<?php echo $this->L['has_callback']; ?>) </span>
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
     <li>
        <a href="<?php echo base_url('cod/tracking'); ?>">
            <img src="<?php echo base_url(); ?>public/images/tracking.png"> 
            <span style="font-size: 15px; font-weight: bold; color: red;"> Theo dõi đơn hàng Viettel </span> 
        </a>
    </li>
      <li>
        <a href="<?php echo base_url('cod/tai-file-doi-soat-l8.html'); ?>">
            <img src="<?php echo base_url(); ?>public/images/L8.png"> 
            <span> Tải file đối soát Viettel L8 </span>
        </a>
    </li>
</ul>
<ul class="nav-list list-inline display-flex">
     <li>
        <a href="<?php echo base_url('MANAGERS/landingpage'); ?>">
            <img src="<?php echo base_url(); ?>public/images/landing-page.png">  
            <span> Quản lý landing page </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('home/logout'); ?>">
            <img src="<?php echo base_url(); ?>public/images/logout.png"> 
            <span> Đăng xuất  </span>
        </a>
    </li>
</ul>
