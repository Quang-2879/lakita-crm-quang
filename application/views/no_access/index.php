<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
    <head>
        <title>No access</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <script src="<?php echo base_url(); ?>style/js/common/jquery.min.js"></script>
        <link href="<?php echo base_url(); ?>style/noaccess/css/style.css?ver=<?php echo time();?>" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <!-----start-wrap--------->
        <div class="wrap">
            <!-----start-content--------->
            <div class="content">
                <!-----start-logo--------->
                <div class="logo">
                    <h1><a href="#"><img src="<?php echo base_url(); ?>style/noaccess/images/logo.jpg" width="20%"/></a></h1>
                    <span><img src="<?php echo base_url(); ?>style/noaccess/images/signal.png"/>
                        Bạn không có quyền truy cập vào trang này. Vui lòng quay lại trang chủ. Nếu không thể quay lại trang chủ thì tài khoản của bạn 
                        đã bị khóa!
                    </span>
                </div>
                <!-----end-logo--------->
                <!-----start-search-bar-section--------->
                <div class="buttom">
                    <div class="seach_bar">
                        <p>Trờ về  <span><a href="<?php echo base_url(); ?>">trang chủ</a></span> </p>
                        <p style="margin: 1.6em 0em 0.9em 0em;">Hoặc  <span><a href="<?php echo base_url('home/logout'); ?>">đăng xuất</a></span> </p>
                    </div>
                </div>
                <!-----end-sear-bar--------->
            </div>

        </div>
        <!---------end-wrap---------->
    </body>
</html>