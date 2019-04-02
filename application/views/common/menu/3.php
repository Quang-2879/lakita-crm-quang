<ul class="nav-list list-inline display-flex">

    <li>

        <a data-filter=".97" href="<?php echo base_url(); ?>">

            <img src="<?php echo base_url(); ?>public/images/new.png"> 

            <span> Danh sách contact mới không trùng (<?php echo $this->L['L1'];?>)

<!--            <sup> <span class="badge bg-red"> <?php echo $this->L['L1'];?> </span> </sup>-->

            </span>

        </a>

    </li>
<li>

        <a data-filter=".97" href="<?php echo base_url().'/quan-ly/contact-moi-trung.html'; ?>">

            <img src="<?php echo base_url(); ?>public/images/new.png"> 

            <span> Danh sách contact mới bị trùng (<?php echo $this->L['L1_trung'];?>)


            </span>

        </a>

    </li>
    <li>

        <a data-filter=".97" href="<?php echo base_url('quan-ly/xem-tat-ca-contact.html'); ?>">

            <img src="<?php echo base_url(); ?>public/images/view-all.png"> 

            <span> Danh sách toàn bộ contact (<?php echo $this->L['all'];?>)

<!--<sup> <span class="badge bg-red"> <?php echo $this->L['all'];?> </span> </sup>-->

            </span>

        </a>

    </li>

   

</ul>

<ul class="nav-list list-inline display-flex">

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

        <a href="<?php echo base_url('MANAGERS/teacher'); ?>">

            <img src="<?php echo base_url(); ?>public/images/courses.png"> 

            <span> Cài đặt giảng viên</span>

        </a>

    </li>

     <li>

        <a href="<?php echo base_url('MANAGERS/ViewReport/ViewGeneralReport'); ?>">

            <img src="<?php echo base_url(); ?>public/images/view-general-report.png"> 

            <span> Xem báo cáo tổng hợp  </span>

        </a>

    </li>

    <li>

        <a href="<?php echo base_url('manager/show_report_operation'); ?>">

            <img src="<?php echo base_url(); ?>public/images/report.png"> 

            <span> Xem báo cáo vận hành  </span>

        </a>

    </li>

<!-- <li>

        <a href="<?php echo base_url('home/logout'); ?>">

            <img src="<?php echo base_url(); ?>public/images/logout.png"> 

            <span> Đăng xuất  </span>

        </a>

    </li>-->

</ul>

<ul class="nav-list list-inline display-flex">

    <li>

        <a href="<?php echo base_url('manager/view_report_sale_operation'); ?>">

            <img src="<?php echo base_url(); ?>public/images/L8.jpg"> 

            <span> Xem báo cáo vận hành TVTS  </span>

        </a>

    </li>
 <li>

        <a class="add-new-contact-modal" href="<?php echo base_url('quan-ly/them-contact.html'); ?>">

            <img src="<?php echo base_url(); ?>public/images/add-contact.png"> 

            <span> Thêm mới contact </span>

        </a>

    </li>
    <li>

        <a href="<?php echo base_url('home/logout'); ?>">

            <img src="<?php echo base_url(); ?>public/images/logout.png"> 

            <span> Đăng xuất  </span>

        </a>

    </li>

</ul>

