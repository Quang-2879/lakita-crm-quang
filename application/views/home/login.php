<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> CRM LAKITA </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://crm2.lakita.vn/style/images/favicon.png" type="image/x-icon" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>style/css/home/login.css?ver=<?php echo _VER_CACHED_;?>">
    </head>
    <body>
        <div class="animated"></div>
        <div class="container">
            <div class="row login_box">
                <div class="col-md-12 col-xs-12" align="center">
                    <div class="outter"><img src="<?php echo base_url(); ?>public/images/logo.png" class="image-circle"/></div>   
                    <h1> ĐĂNG NHẬP HỆ THỐNG CRM - LAKITA</h1>
                </div>
                <div class="col-md-12 col-xs-12 login_control">
                    <form id="form-login" action="<?php echo base_url(); ?>home/action_login" method="POST">
                        <div class="control">
                            <div class="label">Username</div>
                            <input type="text" class="form-control" name="username" placeholder="username" />
                        </div>

                        <div class="control">
                            <div class="label">Mật khẩu</div>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu"/>
                        </div>
                        <input type="hidden" id="get-url-variable" value="<?php echo $this->initGetVariable ?>" />
                        <div align="center">
                            <button class="btn btn-orange btn-login">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="particles-js"></div>

        <div class="redirect" style="display:none;">
            <div class="body">
                <span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <div class="base">
                    <span></span>
                    <div class="face"></div>
                </div>
            </div>
            <div class="longfazers">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <h1> Đang chuyển trang ..... </h1>
        </div>
        <?php $this->load->view("common/hidden_input"); ?>
        <?php $this->load->view("common/content/notification"); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
        <script src="<?php echo base_url(); ?>style/js/home/particles.min.js"></script>
        <script src="<?php echo base_url(); ?>style/js/home/login.min.js?ver=<?php echo _VER_CACHED_;?>"></script>
    </body>
</html>