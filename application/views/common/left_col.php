<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url(); ?>" class="site_title">
                <img src="<?php echo base_url(); ?>style/img/logo4.png" class="logo"/>
                <span class="paddingleft10">CRM LAKITA!</span>
            </a>
        </div>
        <div class="clearfix"></div>
        <?php if (isset($slide_menu)) {
            $this->load->view($slide_menu);
        }
        ?>

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a href="<?php echo base_url(); ?>home/logout" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> 
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>