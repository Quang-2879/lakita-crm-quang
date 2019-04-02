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
                <a href="<?php echo base_url('teacher/trang-chu.html'); ?>"><i class="fa fa-bars"></i> Danh sách đăng ký <span class="fa fa-chevron-down"></span></a>
            </li>
            <li>
                <a href="<?php echo base_url('teacher/top_revenue'); ?>"><i class="fa fa-line-chart"></i> Top doanh thu </a>
            </li>
            <li>
                <a href="<?php echo base_url('teacher/View_Report'); ?>"><i class="fa fa-list"></i> Báo cáo doanh thu <span class="fa fa-chevron-down"></span></a>
            </li>

        </ul>
    </div>
</div>
<!-- /sidebar menu -->
