<!-- top navigation -->
<style>
    .content_noti{
        width: 500px !important;
        line-height: 30px;}
    </style>

    <div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right"> 
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $this->session->userdata('image_staff'); ?>" alt=""> <?php echo $this->session->userdata('name'); ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="<?php echo base_url(); ?>">Danh sách đăng ký</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>sale/has_callback">Top doanh thu</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>sale/can_save">Báo cáo doanh thu</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . $controller . '/ChangePassword'; ?>"> Đổi mật khẩu </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>home/logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->