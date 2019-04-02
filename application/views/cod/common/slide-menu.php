<!-- menu profile quick info -->
<div class="profile">
    <div class="profile_pic">
        <img src="<?php echo $this->session->userdata('image_staff'); ?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Xin chào,</span>
        <h2> <?php echo $this->session->userdata('name'); ?></h2>
    </div>
</div>
<!-- /menu profile quick info -->
<br />
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3><?php if (isset($role_name)) echo $role_name; ?></h3>
        <ul class="nav side-menu">
            <li>
                <a href="<?php echo base_url('cod/contact-dang-giao-hang.html'); ?>"><i class="fa fa-truck"></i> Contact đang giao hàng </a>
            </li>
            <li>
                <a href="<?php echo base_url('cod/contact-chuyen-khoan.html'); ?>"><i class="fa fa-credit-card"></i> Contact chuyển khoản </a>
            </li>
            <li class="dropdown-hover">
                <a><i class="fa fa-check-circle-o"></i> Tải file đối soát
                    <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 10px!important; width: auto !important;"></i>
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('cod/tai-file-doi-soat-l7.html'); ?>">Tải file đối soát Viettel (L7) </a></li>
                    <li><a href="<?php echo base_url('cod/tai-file-doi-soat-l8.html'); ?>">Tải file đối soát Viettel (L8) </a></li>
                    <li><a href="<?php echo base_url('cod/tai-file-doi-soat-cuoc.html'); ?>">Tải file cước phí COD </a></li>
                </ul>
            </li>
            <li class="dropdown-hover">
                <a><i class="fa fa-compress"></i> Kết quả đối soát
                    <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 10px!important; width: auto !important;"></i>
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('cod/doi-soat-l7.html'); ?>"> Đối soát Viettel (L7) </a></li>
                    <li><a href="<?php echo base_url('cod/doi-soat-l8.html'); ?>"> Đối soát Viettel (L8) </a></li>
                    <li><a href="<?php echo base_url('cod/doi-soat-cuoc.html'); ?>"> Đối soát Cước </a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('cod/tim-kiem-contact.html'); ?>"><i class="fa fa-search"></i> Tìm kiếm contact </a>
            </li>
            <li><a href="<?php echo base_url('cod/xem-tat-ca-contact.html'); ?>"> <i class="fa fa-globe"></i>Danh sách toàn bộ contact </a></li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
