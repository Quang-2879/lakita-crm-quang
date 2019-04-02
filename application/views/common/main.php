<?php $this->load->view('common/head'); ?>
<body class="nav-sm">  
    <?php $this->load->view('common/hidden_input'); ?>
    <?php
    if ($this->agent->is_mobile()) {
        $this->load->view('common/hidden_input');
        $this->load->view('common/mobile');
    } else {
        ?>
        <div class="container body">
            <div class="main_container">
                <?php
                if (isset($top_nav)) {
                    $this->load->view($top_nav);
                }
                ?>
                <div class="right_col" role="main">
<!--                    <div class="alert alert-dismissable">
                        <a href="#" class="btn btn-danger close btn-dismiss" data-dismiss="alert" aria-label="close">&times;</a>
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center"> Lời nhắn của quản lý </div>
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>-->
                    <?php
                    $this->load->view('common/alert.php');
                    $this->load->view($content);
                    if ($this->can_view_contact == 1) {
                      // $this->load->view('common/script/view_detail_contact');
                        $this->load->view('common/script/view_contact_star');
                    }
                    if ($this->can_edit_contact == 1) {
                        //$this->load->view('common/script/edit_contact');
                    }
                    ?>
                     <h3 class="red text-center" style="line-height: 1.42;"> <?php echo $mySlogan; ?> </h3>   
                </div>

                <?php $this->load->view('common/content/notification'); ?>
                <footer <?php if (isset($contacts) && count($contacts) == 0) echo 'class="fixed"'; ?>>
                    <div class="pull-right">
                        CRM LAKITA - BY <a href="https://www.facebook.com/chuyenbka" target="_blank">CHUYENPN</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
            </div>
        </div>
        <?php $this->load->view('common/right_context_menu'); ?>
        <?php $this->load->view('common/footer'); ?>
    <?php } ?>
</body>
</html> 

