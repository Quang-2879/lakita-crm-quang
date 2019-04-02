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
            <!--            <li <?php
            $controller = $this->uri->rsegment(2);
            if ($controller == 'index')
                echo 'class="active"';
            ?>>
                            <a><i class="fa fa-home"></i> Trang chủ
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo base_url(); ?>">Danh sách contact mới đăng ký </a></li>
                                
                            </ul>
                        </li>-->
            <li><a href="<?php echo base_url('quan-ly/xem-tat-ca-contact.html'); ?>"><i class="fa fa-globe"></i> 
                    Danh sách toàn bộ contact
                </a>
            </li>
            <li class="dropdown-hover">
                <a><i class="fa fa-edit"></i> Phân / Xóa Contact 
                    <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 10px!important; width: auto !important;"></i>
                    <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a class="divide_contact">Phân riêng contact cho một TVTS</a></li>
                    <li><a href="#" class="divide_contact_even">Phân đều contact cho các TVTS</a></li>
                    <li><a class="cancel_multi_contact">Hủy phân nháp các contact đã chọn</a></li>
                    <li><a href="<?php echo base_url('quan-ly/contact-dang-phan-nhap.html'); ?>">Các contact đang phân nháp (chưa hủy nháp)</a></li>
                    <li><a id="delete_contact">Xóa các contact đã chọn </a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('quan-ly/tim-kiem-contact.html'); ?>"><i class="fa fa-search"></i> Tìm kiếm contact </a>
            </li>
            <li>
                <a href="<?php echo base_url('quan-ly/them-contact.html'); ?>"><i class="fa fa fa-user">+</i> Thêm mới contact </a>
            </li>
            <li class="dropdown-hover">
                <a>
                    <i class="fa fa-line-chart"></i> Các loại báo cáo 
                    <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 10px!important; width: auto !important;"></i><span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li>
                        <a href="<?php echo base_url('quan-ly/xem-bao-cao-tu-van-tuyen-sinh.html'); ?>">
                            Xem báo cáo TVTS 
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('quan-ly/xem-bao-cao-doanh-thu.html'); ?>">
                            Xem báo cáo doanh thu 
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('manager/view_pivot_table'); ?>">
                            Xem báo cáo doanh thu (phát sinh và lũy kế)
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('quan-ly/bao-cao-tong-hop.html'); ?>">
                            Xem báo cáo tổng hợp 
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-hover"><a><i class="fa fa-cog"></i>Cài đặt <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('config/sale'); ?>">Cài đặt TVTS</a></li>
                    <li><a href="<?php echo base_url('config/course'); ?>">Cài đặt Khóa học</a></li>
                    <li><a href="fixed_sidebar.html">Cài đặt lọc contact</a></li>
                    <li><a href="fixed_footer.html">Fixed Footer</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
