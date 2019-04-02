<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
<!--            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>-->

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $this->session->userdata('image_staff'); ?>" alt=""> <?php echo $this->session->userdata('name'); ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="<?php echo base_url(); ?>">Danh sách contact mới (chưa gọi bao giờ) được phân cho bạn</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>sale/has_callback">Danh sách contact có lịch hẹn gọi lại tính đến thời điểm này </a></li>
                        <li><a href="<?php echo base_url(); ?>sale/can_save">Danh sách contact còn cứu được </a></li>
                        <li><a href="form.html" class="transfer_contact"> Chuyển nhượng toàn bộ contact cho nhân viên </a></li>
                         <li><a href="<?php echo base_url(); ?>sale/view_all_contact">Danh sách toàn bộ contact </a></li>
                        <li><a href="<?php echo base_url(); ?>home/logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                    </ul>
                </li>

                <!--                <li role="presentation" class="dropdown">
                                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                  </a>
                                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <li>
                                      <a>
                                        <span class="image"><img src="<?php echo base_url(); ?>style/images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                          <span>John Smith</span>
                                          <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                      </a>
                                    </li>
                                    <li>
                                      <a>
                                        <span class="image"><img src="<?php echo base_url(); ?>style/images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                          <span>John Smith</span>
                                          <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                      </a>
                                    </li>
                                    <li>
                                      <a>
                                        <span class="image"><img src="<?php echo base_url(); ?>style/images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                          <span>John Smith</span>
                                          <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                      </a>
                                    </li>
                                    <li>
                                      <a>
                                        <span class="image"><img src="<?php echo base_url(); ?>style/images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                          <span>John Smith</span>
                                          <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                      </a>
                                    </li>
                                    <li>
                                      <div class="text-center">
                                        <a>
                                          <strong>See All Alerts</strong>
                                          <i class="fa fa-angle-right"></i>
                                        </a>
                                      </div>
                                    </li>
                                  </ul>
                                </li>-->
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->