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
            <li class="dropdown-hover">
                <a><i class="fa fa-bars"></i> Danh sách contact 
                    <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 10px!important; width: auto !important;"></i>
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="fa fa-home" style="width: auto !important"></i> &nbsp;  &nbsp;
                            Danh sách contact mới (chưa gọi bao giờ) được phân cho bạn</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('tu-van-tuyen-sinh/contact-co-lich-hen.html'); ?>">
                            <i class="fa fa-calendar" style="width: auto !important"></i> &nbsp;  &nbsp;
                            Danh sách contact có lịch hẹn gọi lại tính đến thời điểm này </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('tu-van-tuyen-sinh/contact-con-cuu-duoc.html'); ?>">
                            <i class="fa fa-bookmark" style="width: auto !important"></i> &nbsp;  &nbsp;
                            Danh sách contact còn cứu được </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('tu-van-tuyen-sinh/xem-tat-ca-contact.html'); ?>">
                             <i class="fa fa-globe" style="width: auto !important"></i> &nbsp;  &nbsp;
                            Danh sách toàn bộ contact 
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('tu-van-tuyen-sinh/tim-kiem-contact.html'); ?>"><i class="fa fa-search"></i> Tìm kiếm contact </a>
            </li>
            <li>
                <a href="<?php echo base_url('tu-van-tuyen-sinh/them-contact.html'); ?>"><i class="fa fa fa-user">+</i> Thêm mới contact </a>
            </li>
            <li>
                <a href="<?php echo base_url('tu-van-tuyen-sinh/xem-bao-cao.html'); ?>">
                    <i class="fa fa-list"></i> Xem báo cáo <span class="fa fa-chevron-down"></span>
                </a>
            </li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->
