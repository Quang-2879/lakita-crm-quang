<ul class="nav-list list-inline display-flex">
    <li>
        <a data-filter=".97" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>public/images/new.png"> 
            <span> Danh sách contact ngày hôm nay (<?php echo $this->L['C3'];?>)</span>
        </a>
    </li>
    <li>
        <a data-filter=".97" href="<?php echo base_url('marketer/view_all'); ?>">
            <img src="<?php echo base_url(); ?>public/images/view-all.png"> 
            <span> Danh sách toàn bộ contact (<?php echo $this->L['all'];?>)</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('MANAGERS/campaign'); ?>">
            <img src="<?php echo base_url(); ?>public/images/campaign.png">
            <span> Quản lý campaign</span>
        </a>
    </li>
</ul>
<ul class="nav-list list-inline display-flex">
    <li>
        <a href="<?php echo base_url('MANAGERS/adset'); ?>">
            <img src="<?php echo base_url(); ?>public/images/adset.png">
            <span> Quản lý Adset </span></a>
    </li>
    <li>
        <a href="<?php echo base_url('MANAGERS/ad'); ?>">
            <img src="<?php echo base_url(); ?>public/images/qc.png">
            <span> Quản lý Ad </span></a>
    </li>
    <li>
        <a href="<?php echo base_url('MANAGERS/link'); ?>">
            <img src="<?php echo base_url(); ?>public/images/link.png">
            <span> Quản lý link </span>
        </a>
    </li>
</ul>
<ul class="nav-list list-inline display-flex">
      <li>
        <a href="<?php echo base_url('MANAGERS/landingpage'); ?>">
            <img src="<?php echo base_url(); ?>public/images/landing-page.png">  
            <span> Quản lý landing page </span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('home/logout'); ?>">
            <img src="<?php echo base_url(); ?>public/images/logout.png"> 
            <span> Đăng xuất  </span>
        </a>
    </li>
</ul>
