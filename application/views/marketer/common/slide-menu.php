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
        <h3><?php
            if (isset($role_name)) {
                echo $role_name;
            }
            ?>
        </h3>
        <ul class="nav side-menu">
            <li><a href="<?php echo base_url('marketer/view_all'); ?>"><i class="fa fa-bars"></i> 
                    Danh sách toàn bộ contact
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('MANAGERS/campaign'); ?>">
                    <i class="fa fa-calendar" aria-hidden="true"></i> Quản lý campaign <span class="fa fa-chevron-down"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('MANAGERS/adset'); ?>">
                    <i class="fa fa-cogs" aria-hidden="true"></i> Quản lý Adset </a>
            </li>
            <li>
                <a href="<?php echo base_url('MANAGERS/ad'); ?>">
                    <i class="fa fa-cog" aria-hidden="true"></i> Quản lý Ad </a>
            </li>
            <li>
                <a href="<?php echo base_url('MANAGERS/link'); ?>">
                    <i class="fa fa-link" aria-hidden="true"></i> Quản lý link <span class="fa fa-chevron-down"></span>
                </a>
            </li>
        </ul>
    </div>
<!--    <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="e_commerce.html">E-commerce</a></li>
                    <li><a href="projects.html">Projects</a></li>
                    <li><a href="project_detail.html">Project Detail</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="profile.html">Profile</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="page_403.html">403 Error</a></li>
                    <li><a href="page_404.html">404 Error</a></li>
                    <li><a href="page_500.html">500 Error</a></li>
                    <li><a href="plain_page.html">Plain Page</a></li>
                    <li><a href="login.html">Login Page</a></li>
                    <li><a href="pricing_tables.html">Pricing Tables</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="#level1_1">Level One</a>
                    <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#level1_2">Level One</a>
                    </li>
                </ul>
            </li>
            <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
        </ul>
    </div>-->
</div>
<!-- /sidebar menu -->
