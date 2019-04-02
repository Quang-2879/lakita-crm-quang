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
            <li>
                <a href="<?php echo base_url('cod/doi-soat-cod/xem-tat-ca.html'); ?>">
                    <i class="fa fa-globe" aria-hidden="true"></i> Danh sách tất cả các kết quả đối soát 
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('cod/doi-soat-cuoc.html'); ?>">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Kết quả đối soát chưa lưu 
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('cod/tai-file-doi-soat-cuoc.html'); ?>">
                    <i class="fa fa-upload" aria-hidden="true"></i>  Tải file cước phí COD 
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('cod/doi-soat-cod/ket-qua-doi-soat-hom-nay.html'); ?>">
                    <i class="fa fa-link" aria-hidden="true"></i> Danh sách kết quả đối soát ngày hôm nay
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- /sidebar menu -->
