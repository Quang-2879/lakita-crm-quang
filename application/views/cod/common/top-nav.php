<!-- ẩn tạm icon dẫn đến chức năng tải file đối soát l7,l8, cước để update chức năng tự động phân contact cho cskh -->
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <ul class="nav navbar-nav">
                <a href="<?php echo base_url(); ?>" class="logo">
                    <img src="<?php echo base_url(); ?>style/img/logo5.png" class="logo-fix">
                </a>

                <form action="<?php echo base_url() . $controller; ?>/search" class="form-search" method="GET">
                    <input type="text" class="form-control input-navbar-search" name="search_all" placeholder="Tìm mọi thứ...." 
                           value="<?php echo isset($_GET['search_all']) ? $_GET['search_all'] : ''; ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-navbar-search" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </form>
                <li class="dropdown-hover">
                    <a href="javascript:;" class="noti dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="position: relative"> 
                        <i class="fa fa-volume-control-phone" aria-hidden="true"></i> &nbsp;
                        Contact cần gọi lại <sup> <span class="badge bg-red" id="num_noti"></span> </sup>
                    </a>
                    <ul class="dropdown-menu" id="noti_contact_recall">
                    </ul>
                </li>
                <li class="dropdown-hover float-right">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $this->session->userdata('image_staff'); ?>" alt=""> <?php echo $this->session->userdata('name'); ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?php echo base_url(); ?>home/logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                    </ul>
                </li>
                <li class="dropdown mega-dropdown dropdown-hover pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> MENU <span class="caret"></span></a>				
                    <div id="filters" class="dropdown-menu mega-dropdown-menu">

                        <ul class="nav-list list-inline display-flex">
                            <li>
                                <a data-filter=".97" href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url(); ?>public/images/L6.png"> 
                                    <span> Danh sách contact đồng ý mua  (<?php echo $this->L['L6']; ?>)</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('cod/contact-dang-giao-hang.html'); ?>">
                                    <img src="<?php echo base_url(); ?>public/images/pending.png"> 
                                    <span>  Contact đang giao hàng  (<?php echo $this->L['pending']; ?>)</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('cod/contact-chuyen-khoan.html'); ?>">
                                    <img src="<?php echo base_url(); ?>public/images/banking.png"> 
                                    <span> Contact chuyển khoản  (<?php echo $this->L['transfer']; ?>) </span> 
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
                                    <span> Danh sách toàn bộ contact  (<?php echo $this->L['all']; ?>) </span>
                                </a>
                            </li>								<li>								<a href="<?php echo base_url('cod/report_cod_operation'); ?>">									<img src="<?php echo base_url(); ?>public/images/fee.png"> 									<span> Xem báo cáo COD  </span>								</a>							</li>
<!--                            <li>
                                <a href="<?php echo base_url('cod/tai-file-doi-soat-l7.html'); ?>">
                                    <img src="<?php echo base_url(); ?>public/images/compare.png"> 
                                    <span> Tải file đối soát Viettel L7   </span> 
                                </a>
                            </li>-->

                        </ul>
                        <ul class="nav-list list-inline display-flex">
<!--                            <li>
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
                            </li>-->
                            <li>
                                <a href="<?php echo base_url('home/logout'); ?>">
                                    <img src="<?php echo base_url(); ?>public/images/logout.png"> 
                                    <span> Đăng xuất  </span>
                                </a>
                            </li>
                        </ul>


                    </div>				
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->