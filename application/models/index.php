<?php
$is_mobile = false;
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)) || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')
) {
    $is_mobile = true;
}
$mobile = ($is_mobile == true) ? 'yes' : 'no';
//get data
$ref = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
$domain = isset($_SERVER["HTTP_HOST"]) ? 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] : '';
session_start();

@$_SESSION['id']=isset($_GET["id"])?$_GET["id"] : 837;
$id = $_SESSION['id'];
@$_SESSION['id_campaign']=isset($_GET["id_campaign"])?$_GET["id_campaign"] : $_SESSION['id_campaign'];
$id_campaign =$_SESSION['id_campaign']; 

@$_SESSION['id_landingpage']=isset($_GET["id_landingpage"])?$_GET["id_landingpage"] : $_SESSION['id_landingpage'];
$id_landingpage = $_SESSION['id_landingpage'];
$preview = isset($_GET["preview"]) ? $_GET["preview"] : "-100";
@$_SESSION['code_chanel']=isset($_GET["code_chanel"])?$_GET["code_chanel"] : $_SESSION['code_chanel'];
$code_chanel =$_SESSION['code_chanel']; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TRỌN BỘ HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH NĂM 2016 - lakita.vn</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta property="og:url"           content="http://lapbctc2016.lakita.vn" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="TRỌN BỘ HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH NĂM 2016 - lakita.vn" />
        <meta property="og:description"   content="Hệ thống đào tạo trực tuyến lakita – Cùng bạn vươn xa Học Online qua Video bài giảng - Học Online thỏa thích mọi lúc, mọi nơi - Học trên mọi thiết bị - Học với giảng viên, chuyên gia hàng đầu trong lĩnh vực - Hóa đơn chứng từ - Làm chủ hóa đơn chứng từ" />
        <meta property="og:image"         content="http://lakita.vn/data/source/courses/268x150/tron-bo-huong-dan-lap-bao-cao-tai-chinh-nam-2016.png" />
        <meta name="description" content="Hệ thống đào tạo trực tuyến lakita – Cùng bạn vươn xa Học Online qua Video bài giảng - Học Online thỏa thích mọi lúc, mọi nơi - Học trên mọi thiết bị - Học với giảng viên, chuyên gia hàng đầu trong lĩnh vực - Hóa đơn chứng từ - Làm chủ hóa đơn chứng từ" />
        <link rel="icon" href="favicon.ico" />

        <script src="lakita/js/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="lakita/js/0b216c5f11.js"></script>
        <script src="lakita/js/lktclock.js" type="text/javascript"></script>
        <script src="lakita/js/jquery.form.js"></script>
        <link href="lakita/css/gg-font.css" rel="stylesheet" type="text/css" />
        <link rel ="stylesheet" type="text/css" href="style.index2.lakita.css" />
        <link rel ="stylesheet" type="text/css" href="styles.css" />
        <link rel ="stylesheet" type="text/css" href="media.css" />
        <link rel ="stylesheet" type="text/css" href="define.css" />
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=315347858825221";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </head>
    <body style="overflow-x: hidden">
        <header>
            <form role="form" id="fr_save_c2" style="display: none;"  method="post" name="fr_save_c2" action="lakita/save_c2.php">
                <?php
                echo "<INPUT TYPE='hidden' class='e_domain_ref' NAME='http_referer' VALUE='" . $ref . "'>";
                echo "<INPUT TYPE='hidden' NAME='domain' VALUE='" . $domain . "'>";
                echo "<INPUT TYPE='hidden' NAME='id_camp_landingpage' VALUE='" . $id . "'>";
                echo "<INPUT TYPE='hidden' NAME='preview' VALUE='" . $preview . "'>";
                echo "<INPUT TYPE='hidden' NAME='code_chanel' VALUE='" . $code_chanel . "'>";
                echo "<INPUT TYPE='hidden' NAME='id_campaign' VALUE='" . $id_campaign . "'>";
                echo "<INPUT TYPE='hidden' NAME='id_landingpage' VALUE='" . $id_landingpage . "'>";
                ?>
                <button  type="submit" id="bt_submit_c2" class=" e_btn_submit reg_bt btn btn-ows btn-large"></button>
            </form>
            <nav class="navbar">
                <div class="container-fluid nav-menu">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="http://lamchuhoadonchungtu1.lakita.vn/" id="a-img"><img src="img/index/logo.png"></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="#link_bondiemkhacbiet">Bốn điểm khác biệt</a></li>
                            <li><a href="#link_loiich">Lợi ích</a></li>
                            <li><a href="#link_giangvien">Giảng viên</a></li>
                            <li><a href="#link_decuong">Đề cương khóa học</a></li>
                            <li><a href="#register_now">Đăng kí ngay</a></li>
                            <li><a href="#link_vechungtoi">Về lakita</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li> <a href="#register_now"><button class="btn btn-success" type="button">Đăng kí ngay</button></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <div class="gr1">
                <h3 style="    color: #fff;"><strong>TRỌN BỘ HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH NĂM 2016</strong>
                </h3>
                <p>Khóa học dành cho nhân viên hành chính văn phòng kiêm kế toán trong doanh nghiệp vừa, nhỏ</p>
            </div>
            <!--        <div class="trans"></div>-->
            <div class="play_hidden hidden-sm hidden-xs">
                <div id="play_demo_1" style="display: none;">
                    <video height="100%"  src="http://lapbctc2016.lakita.vn/trailer.mp4" type="video/mp4"
                           id="player0"
                           controls="controls"
                           >
                    </video>
                </div>

            </div>
            <img src="demo.png" class="play-btn hidden-sm hidden-xs"/>
        </header>
        <div class="container" id="link_bondiemkhacbiet">
            <div class="group2 row">
                <div class="col-md-3 gr2-col-1 col-sm-6 col-xs-12">
                    <img src="img/index2/Layer-2.png">
                    <h4><strong>Cầm tay chỉ việc
                        </strong></h4>
                    <div id="gr2-text">
                        <p>Các bài giảng được thiết kế theo dạng cầm tay chỉ việc, học viên có thể thực hành, áp dụng được ngay vào trong công việc</p>
                    </div>
                </div>
                <div class="col-md-3 gr2-col-1 col-sm-6 col-xs-12">
                    <img src="img/index2/Layer-3.png">
                    <h4><strong>Dễ xem lại và sử dụng</strong></h4>
                    <div id="gr2-text">
                        <p>46 video bài giảng, thao tác với 9h học online. Giải đáp trong 68 giờ</p>
                    </div>
                </div>
                <div class="col-md-3 gr2-col-1 col-sm-6 col-xs-12">
                    <img src="img/index2/Layer-4.png">
                    <h4><strong>Học Online</strong></h4>
                    <div id="gr2-text">
                        <p>Mọi thời điểm, mô hình học tiên tiến, tương tác liên tục: cùng thầy và hàng trăm học viên</p>
                    </div>
                </div>
                <div class="col-md-3 gr2-col-1 col-sm-6 col-xs-12">
                    <img src="img/index2/Layer-5.png">
                    <h4><strong>Kinh nghiệm thực tiễn</strong></h4>
                    <div id="gr2-text">
                        <p>Thực tiễn từ kinh nghiệm tại Doanh Nghiệp</p>
                    </div>
                </div>
                </section>
            </div>
        </div>
        <div class="container-fluid" id="link_loiich">
            <div class="group3 row">
                <div class="gr3-row-1">
                    <h2><strong>BẠN SẼ BỎ LỠ ĐIỀU GÌ NẾU KHÔNG THAM GIA KHÓA HỌC NÀY?</strong></h2>
                    <img src="img/index2/gr3-img1.png">
                </div>
                <div class="row gr3-row-2">
                    <div class="col-xs-12 col-sm-5 col-sm-offset-1">
                        <video height="100%"  src="http://lapbctc2016.lakita.vn/kt400-bai2.mp4" type="video/mp4"
                               id="player1"
                               controls="controls">
                        </video>
                    </div>
                    <div class="col-xs-12 col-sm-5 gr3-row2-2">
                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> Tăng kỹ năng trong công việc, học tập</strong></p>
                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> Cơ hội thăng tiến và phát triển nghề nghiệp kế toán</strong></p>
                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> 46 video bài giảng hướng dẫn chi tiết với 9h học online</strong> </p>
                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> 100 tình huống thực tế tại doanh nghiệp </strong></p>
                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> Thầy Cô trực tiếp trả lời thắc mắc của học viên</strong></p>
                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> Được hỗ trợ thường xuyên với đội ngũ trợ giảng chuyên nghiệp</strong></p>
                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> Hướng dẫn lập đúng và 08 bước kiểm tra Bảng cân đối phát sinh</strong></p>
<!--                        <p><i class="fa fa-check" aria-hidden="true"></i><strong> Quà tặng giá trị : 01 File Excel kiểm tra báo cáo tài chính cho Doanh nghiệp, 14 file excel phục vụ quyết toán thuế 2016 </strong></p>-->
                        <a href="#register_now"><button id="gr3-dangki" type="button">Đăng kí ngay</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="group4 container" id="link_giangvien">
            <h1 id="gr4-gv">GIẢNG VIÊN</h1>
            <div class="row">
                <div class="col-xs-12 col-sm-6 text-center" id="GV">
                    <img src="img/index2/ChiNhung.png" class="img-responsive">
                    <p class="name_teacher"><strong>Giảng viên Phạm Thị Nhung</strong></p>
                </div>
                <div class="col-xs-12 col-sm-6" id="kinhnghiem">
                    <ul>
                        <li> <img src="http://biquyetlamchuexcel5.lakita.vn/img/bul-list.png"> <span> Chứng chỉ kế toán quốc tế CAT</span></li>
                        <li> <img src="http://biquyetlamchuexcel5.lakita.vn/img/bul-list.png">
                            <span>
                                Kế toán tổng hợp tại chi nhánh công ty TNHH Dịch vụ Thực phẩm và Giải khát Cánh Diều Xanh, thuộc tập đoàn Tập đoàn Liên Thái Bình Dương (Imex Pan Pacific Group).
                            </span>
                        </li>
                        <li> <img src="http://biquyetlamchuexcel5.lakita.vn/img/bul-list.png"><span> 4 năm kinh nghiệm ở vị trí kế toán tổng hợp kiêm phụ trách toàn bộ mảng thuế </span></li>
                    </ul>
                </div>
            </div>
        </div>
          <div class="container-fluid group5" id="link_decuong">
            <div class="container">
                <h2 class="span-text">NỘI DUNG KHÓA HỌC</h2>
            </div>
           <div class="row my-row-5">
                <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                    <div class="chapter-title">
                        <div> Phần 1: 08 nhiệm vụ kế toán cần thực hiện tại thời điểm cuối kỳ </div>
                    </div>
                    <ul>
                        <li>  <span class="bold">Bài 1:</span> Giới thiệu khóa học</li>
                        <li>  <span class="bold">Bài 2:</span> 08 nhiệm vụ cần thực hiện cuối kỳ</li>
                        <li>  <span class="bold">Bài 3:</span> Thực hành hạch toán tiền lương và các khoản trích theo lương (phần 1)</li>
                        <li>  <span class="bold">Bài 4:</span> Thực hành hạch toán tiền lương và các khoản trích theo lương (phần 2)</li>
                        <li>  <span class="bold">Bài 5:</span> Nhiệm vụ số 2: Lập bảng tính khấu hao TSCĐ và bút toán trích khấu hao</li>
                        <li>  <span class="bold">Bài 6:</span> Nhiệm vụ số 3: Phân bổ Công cụ dụng cụ, chi phí trả trước</li>
                        <li>  <span class="bold">Bài 7:</span> Thực hành lập bảng phân bổ và bút toán phân bổ CCDC và Chi phí trả trước (bằng excel)</li>
                        <li>  <span class="bold">Bài 8:</span> Nhiệm vụ số 4: Trích trước chi phí</li>
                        <li>  <span class="bold">Bài 9:</span> Nhiệm vụ số 5: Kết chuyển thuế GTGT được khấu trừ (1331 - 3331) </li>
                        <li>  <span class="bold">Bài 10:</span> Nhiệm vụ 6: Tập hợp chi phí giá vốn hàng bán </li>
                        <li>  <span class="bold">Bài 11:</span> Nhiệm vụ 7: Tạm tính và hạch toán thuế TNDN phải nộp </li>
                        <li>  <span class="bold">Bài 12:</span> Nhiệm vụ 8: Các bút toán kết chuyển cuối kỳ sang tài khoản 911 </li>
                    </ul>
                    <div class="chapter-title">
                        <div> Phần 2: Hướng dẫn lập và 09 bước kiểm tra bảng Cân đối phát sinh tài khoản</div>
                    </div>
                    <ul>

                        <li>  <span class="bold">Bài 13:</span> Hướng dẫn lập bảng cân đối phát sinh tài khoản (Phần 1)</li>
                        <li>  <span class="bold">Bài 14:</span>  Hướng dẫn lập bảng cân đối phát sinh tài khoản (Phần 2) </li>
                        <li>  <span class="bold">Bài 15:</span>  Kiểm tra bảng CĐPS (KT1, KT2) </li>
                        <li>  <span class="bold">Bài 16:</span> Kiểm tra bảng CĐPS - Kiểm tra nhóm tài khoản kho 152,153,154,155,156 </li>
                        <li>  <span class="bold">Bài 17:</span> Kiểm tra bảng CĐPS - Kiểm tra nhóm tài khoản tài sản và khấu hao (211,214)</li>
                        <li>  <span class="bold">Bài 18:</span> Kiểm tra số 6: Tài khoản tiền mặt (TK 111 ), tiền gửi ngân hàng (TK 112) </li>
                        <li>  <span class="bold">Bài 19:</span> Kiểm tra số 7: Nhóm các tài khoản công nợ (Phải thu, phải trả) </li>
                        <li>  <span class="bold">Bài 20:</span> Kiểm tra số 8: Kiểm tra tài khoản Doanh thu TK 511,521 </li>
                        <li>  <span class="bold">Bài 21:</span> Kiểm tra tài khoản Thuế GTGT 1331,3331 </li>
                    </ul>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <div class="chapter-title" style="height: 57px;">
                        <div> Phần 3: Hướng dẫn lập bảng cân đối kế toán</div>
                    </div>
                    <ul>

                        <li>  <span class="bold">Bài 22:</span> Tìm hiểu về Báo cáo tài chính </li>
                        <li>  <span class="bold">Bài 23:</span> Ý nghĩa, mục đích của Bảng Cân đối kế toán </li>
                        <li>  <span class="bold">Bài 24:</span> Căn cứ lập và lưu ý khi Lập bảng cân đối kế toán </li>
                        <li>  <span class="bold">Bài 25:</span> Kết cầu và ý nghĩa từng chỉ tiêu trên CĐKT</li>
                        <li>  <span class="bold">Bài 26:</span> Cách lập bảng CĐKT (Phần 1) </li>
                        <li>  <span class="bold">Bài 27:</span> Cách lập bảng CĐKT (Phần 2) </li>
                        <li>  <span class="bold">Bài 28:</span> Thực hành lập bảng CĐKT trên excel (Phần 1) </li>
                        <li>  <span class="bold">Bài 29:</span> Thực hành lập bảng CĐKT trên excel (Phần 2) </li>
                        <li>  <span class="bold">Bài 30:</span> Thực hành lập bảng CĐKT trên excel (Phần 3) </li>
                    </ul>
                    <div class="chapter-title" style="height: 57px;">
                        <div> Phần 4:  Hướng dẫn lập báo cáo kết quả kinh doanh</div>
                    </div>
                    <ul>
                        <li>  <span class="bold">Bài 31:</span> Ý nghĩa và kết cấu của Báo cáo kết quả Kinh Doanh </li>
                        <li>  <span class="bold">Bài 32:</span> Hướng dẫn tính thuế TNDN (Phần 1) </li>
                        <li>  <span class="bold">Bài 33:</span> Hướng dẫn tính thuế TNDN (Phần 2) </li>
                        <li>  <span class="bold">Bài 34:</span> Cách lập báo cáo kết quả Kinh Doanh (Phần 1) </li>
                        <li>  <span class="bold">Bài 35:</span> Cách lập báo cáo kết quả Kinh Doanh (Phần 2) </li>
                        <li>  <span class="bold">Bài 36:</span> Thực hành lập Báo Cáo KQKD (Phần 1) </li>
                        <li>  <span class="bold">Bài 37:</span> Thực hành lập Báo Cáo KQKD (Phần 2) </li>
                    </ul>
                    <div class="chapter-title" style="height: 57px;">
                        <div> Phần 5:  Hướng dẫn lập báo cáo lưu chuyển tiền tệ</div>
                    </div>
                    <ul>
                        <li>  <span class="bold">Bài 38:</span> Ý nghĩa Báo cáo lưu chuyển tiền tệ </li>
                        <li>  <span class="bold">Bài 39:</span> Cách lập Báo Cáo lưu chuyển tiền tệ (Phần 1)</li>
                        <li>  <span class="bold">Bài 40:</span> Cách lập Báo Cáo lưu chuyển tiền tệ (Phần 2) </li>
                        <li>  <span class="bold">Bài 41:</span> Thực hành Báo Cáo lưu chuyển tiền tệ (Phần 1) </li>
                        <li>  <span class="bold">Bài 42:</span> Thực hành Báo Cáo lưu chuyển tiền tệ (Phần 2) </li>
                    </ul>
                    <div class="chapter-title" style="height: 57px;">
                        <div> Phần 6: Hướng dẫn lập thuyết minh báo cáo tài chính</div>
                    </div>
                    <ul>
                        <li>  <span class="bold">Bài 43:</span> Mối quan hệ giữa 3 Báo cáo: CĐKT, KQKD và Lưu chuyển tiền tệ </li>
                        <li>  <span class="bold">Bài 44:</span> Ý nghĩa, cách lập Thuyết minh BCTC </li>
                        <li>  <span class="bold">Bài 45:</span> Thực hành lập thuyết minh báo cáo tài chính (Phần 1) </li>
                        <li>  <span class="bold">Bài 46:</span> Thực hành lập thuyết minh báo cáo tài chính (Phần 2) </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="carousel slide" id="carousel-example-generic" data-ride="carousel" style=" margin-bottom:30px">
            <h1 class="text-center"><strong>CẢM NHẬN HỌC VIÊN</strong></h1>
            <div class="carousel-inner" role="listbox">
                <div class="item" align="center">
                    <img class="img-responsive" alt="HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH lakita" src="img/index2/nguyenthihang1.png">
                    <p>Nguyễn Thị Hằng</p>
                    <p>Chuyên viên kế toán tại Công ty cổ phần thương mại và vận tải Đông Hải</p>
                    <p id="cmt">"Tôi cảm thấy tốt và tôi nhận được những thông tin hữu ích mà mình mong muốn"</p>
                </div>
                <div class="item active" align="center">
                    <img class="img-responsive" alt="HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH lakita" src="img/index2/nguyenthihuyen1.png">
                    <p>Nguyễn Thị Huyền</p>
                    <p>Công ty TNHH TM xuất nhập khẩu quốc tế Nam Trung</p>
                    <p id="cmt">"Khóa học thật sự có ý nghĩa. Nó giúp tôi củng cố thêm kiến thức về kế toán"</p>
                </div>
                <div class="item" align="center">
                    <img class="img-responsive" alt="HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH lakita" src="img/index2/le-thi-nhan.jpg">
                    <p>Lê Thị Nhàn</p>
                    <p>Công ty Cổ phần Đầu tư và Xây dựng Lạc Hồng</p>
                    <p id="cmt">"Đầu tiên tôi xin gửi lời cảm ơn tới giảng viên Phạm Thị Nhung trong thời gian qua đã quan tâm,
                        nhiệt tình hướng dẫn và giảng dạy cho tôi. Tôi đã tiếp thu được nhiều kiến thức bổ ích phục vu cho việc
                        làm hiện tại ở doanh nghiệp của mình. Bài giảng rõ ràng, giảng viên thân thiện giảng dạy dễ hiểu , tiếp
                        thu kiến thức nhanh. Hy vọng trung tâm sẽ mở rộng để có nhiều học viên mới ra trường sẽ tiếp cận thực tế
                        nhanh và dễ dàng kiếm việc."</p>
                </div>
                <div class="item" align="center">
                    <img class="img-responsive" alt="HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH lakita" src="img/index2/luu-tuan-anh.jpg">
                    <p>Lưu Tuấn Anh</p>
                    <p>Nhân viên văn phòng - Ngân hàng TMCP Đại Chúng Việt Nam</p>
                    <p id="cmt">"Giảng viên hỗ trợ nhiệt tình, giảng dạy dễ hiểu, kiến thức mang tính thực tế, ứng dụng cao trong
                        toán/tài chính của ngân hàng."</p>
                </div>
                <div class="item" align="center">
                    <img class="img-responsive" alt="HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH lakita" src="img/index2/vuthikimnga.jpg">
                    <p>Vũ Thị Kim Nga</p>
                    <p></p>
                    <p id="cmt">"Buổi học thật bổ ích, qua buổi học này tôi đã học được rất nhiều kinh nghiệm trong lĩnh vực kế toán"</p>
                </div>

                <div class="item" align="center">
                    <img class="img-responsive" alt="HƯỚNG DẪN LẬP BÁO CÁO TÀI CHÍNH lakita" src="img/index2/phamthihai2.png">
                    <p>Phạm Thị Hải</p>
                    <p>"Kế toán tại Công ty TNHH sản xuất, thương mại, dịch vụ Vĩnh Xuyên"</p>
                    <p id="cmt">Buổi học nhiều ý nghĩa, giúp em học hỏi được nhiều kinh nghiệm thực tế giúp ích cho doanh nghiệp của mình</p>
                </div>
            </div>
            <a href="#carousel-example-generic" class="left carousel-control" role="button" data-slide="prev">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a href="#carousel-example-generic" class="right carousel-control" role="button" data-slide="next">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <div class="container register" id="register_now">
            <h1 class="text-center"> <strong> ĐĂNG KÍ MUA KHOÁ HỌC NGAY </strong></h1>
            <div class="row">
                <div class="col-md-2 col-md-offset-5 hr"></div>
            </div>
            <!--    <div class="row">
                    <div class="col-md-10 col-md-offset-1 register-notice">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    </div>
                </div>-->
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <h1 class="text-center">
                        Để nhận được ưu đãi lên đến <span class="red promotion"> 44.69% </span>
                    </h1>
                    <div class="text-center margin-top-45">
                        <span class="price_root"> 895.000</span>
                        <span class="price_sale"> 495.000 vnd</span>
                    </div>
                    <div class="register-notice-2">
                        <p class="text-center font-size-26"> <strong>Áp dụng đến hết <span class="fullyear">28/11/2016</span> </strong> </p>
                        <p class="text-center font-size-30">  <strong>NHANH TAY LÊN !</strong> </p>
                        <p class="text-center font-size-30">  <strong>Thời gian ưu đãi còn</strong> </p>
                    </div>
                    <div class="count-down row text-center">
                        <div class="col-sm-3 hidden-xs">
                            <div class="num-wrap">
                                <p class="num-day"> 00 </p>
                                <p class="txt-time"> Ngày </p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                            <div class="num-wrap">
                                <p class="num-hour"> 00 </p>
                                <p class="txt-time"> Giờ </p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                            <div class="num-wrap">
                                <p class="num-minute"> 00 </p>
                                <p class="txt-time"> Phút </p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                            <div class="num-wrap">
                                <p class="num-second"> 00 </p>
                                <p class="txt-time"> Giây </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 margin-top-50 padding-left-50" id="register">
                    <form class="LeadPanel_form promo-panel_action e_submit e_form_submit" action="lakita/save_c3.php" method="post" name="fr_register">
                        <!--                        <div class="my-form">
                                                    <input type="text" class="form-input" name="name" placeholder="Họ tên" value=""/>
                                                </div>
                                                <div class="hr"></div>
                                                <div class="my-form">
                                                    <input  class="form-input" type="email" name="email" placeholder="Email" value=""/>
                                                </div>
                                                <div class="hr"></div>
                                                <div class="my-form">
                                                    <input  class="form-input" type="tel" name="phone" placeholder="Số điện thoại" value=""/>
                                                </div>
                                                <div class="hr"></div>
                                                <div class="my-form">
                                                    <input  class="form-input" name="tinh" placeholder="Tỉnh thành"/>
                                                </div>
                                                <div class="hr"></div>
                                                <div class="my-form">
                                                    <input  class="form-input" name="quan" placeholder="Quận huyện"/>
                                                </div>
                                                <div class="hr"></div>
                                                <div class="my-form">
                                                    <input  class="form-input" name="dia_chi" placeholder="Địa chỉ" value=""/>
                                                </div>
                                                <div class="hr"></div>
                        
                                                <div class="row margin-top-10">
                                                    <div class="col-sm-4 col-md-offset-8 col-xs-12">
                                                        <button id="form-submit" class="LeadPanel_action button radius e_btn_submit reg_bt btn btn-success btn-lg my-btn btn-block">ĐĂNG KÝ NGAY</button>
                                                    </div>
                        
                                                </div>-->
                        <div class="span7 curse-form-box  animated delay1 flipInX">
                            
                            <div class="cont">
                               
                                <form id="dang-ky" class="LeadPanel_form promo-panel_action e_submit e_form_submit" action="lakita/save_c3.php" method="post" name="fr_register">
                                   
                                    <div class="row-fluid">
                                        <div class="span12 wrap-icon-fullname1">
                                            <input class="input-large LeadPanel_form_name" type="text" required="" placeholder="Họ tên" name="name" id="name">
                                        </div>

                                    </div>	
                                    <div class="row-fluid hidden">
                                        <div class="span12 wrap-icon-email1">
                                            <input type="email" name="email" id="email" class="input-large LeadPanel_form_name" required="" placeholder="Email" value="NO_PARAM@gmail.com">
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12 wrap-icon-phone1">
                                            <input class="input-large LeadPanel_form_name" required="" placeholder="Số điện thoại" type="tel" name="phone" id="phone">
                                        </div>
                                    </div>			  

                                    <div class="row-fluid hidden">
                                        <div class="span6 wrap-icon-province1">
                                            <input class="input-large LeadPanel_form_company" id="tinh" type="text" name="tinh" required="" placeholder="Tỉnh thành" value="NO_PARAM">
                                        </div>
                                        <div class="span6 wrap-icon-district1">
                                            <input class="input-large LeadPanel_form_company" id="quan" type="text" name="quan" required="" placeholder="Quận huyện" value="NO_PARAM">
                                        </div>

                                    </div>				  
                                    <div class="row-fluid">
                                        <div class="span12 wrap-icon-address1">
                                            <input class="input-large LeadPanel_form_company" id="dia_chi" type="text" name="dia_chi" required="" placeholder="Địa chỉ nhận khóa học">
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12 text-center">
                                            <input class="btn btn-large btn-primary LeadPanel_action button radius e_btn_submit reg_bt" type="submit" name="some_name" value="Đăng ký ngay" id="form-submit">
                                        </div>
                                    </div>  
                                    <input type="hidden" name="content" value="1">
                                    <?php
                                    echo "<INPUT TYPE='hidden' class='e_domain_ref' NAME='http_referer' VALUE='" . $ref . "'>";
                                    echo "<INPUT TYPE='hidden' NAME='domain' VALUE='" . $domain . "'>";
                                    echo "<INPUT TYPE='hidden' NAME='id_camp_landingpage' VALUE='" . $id . "'>";
                                    echo "<INPUT TYPE='hidden' NAME='pview' VALUE='" . $preview . "'>";
                                    echo "<INPUT TYPE='hidden' NAME='code_chanel' VALUE='" . $code_chanel . "'>";
                                    echo "<INPUT TYPE='hidden' NAME='id_campaign' VALUE='" . $id_campaign . "'>";
                                    echo "<INPUT TYPE='hidden' NAME='id_landingpage' VALUE='" . $id_landingpage . "'>";
                                    echo "<INPUT TYPE='hidden' NAME='is_mobile' VALUE='" . $mobile . "'>";
                                    ?> 
                                </form>
                            </div>
                        </div>
                        <input  type="hidden" name="content" value="1" />
                        <?php
                        echo "<INPUT TYPE='hidden' class='e_domain_ref' NAME='http_referer' VALUE='" . $ref . "'>";
                        echo "<INPUT TYPE='hidden' NAME='domain' VALUE='" . $domain . "'>";
                        echo "<INPUT TYPE='hidden' NAME='id_camp_landingpage' VALUE='" . $id . "'>";
                        echo "<INPUT TYPE='hidden' NAME='preview' VALUE='" . $preview . "'>";
                        echo "<INPUT TYPE='hidden' NAME='code_chanel' VALUE='" . $code_chanel . "'>";
                        echo "<INPUT TYPE='hidden' NAME='id_campaign' VALUE='" . $id_campaign . "'>";
                        echo "<INPUT TYPE='hidden' NAME='id_landingpage' VALUE='" . $id_landingpage . "'>";
                        echo "<INPUT TYPE='hidden' NAME='is_mobile' VALUE='" . $mobile . "'>";
                        ?>
                    </form>
                </div>
            </div>
        </div>


        <!------------------------ nav-down ----------------------------------------->
        <section class="nav-down hidden-xs hidden-sm">
            <!-- Top Bar -->
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="logo" href="#"><img src="img/index2/logooo.png" alt="logo"></a>
                        </div>
                        <div class="col-md-6">
                            <ul class="btns-top">
                                <li><a href="#" class="" style="    color: #E50000;    font-size: 11pt;    font-weight: 600;">HOTLINE: 1900 6361 95 - 04 7306 2468</a></li>
                                <li><a href="#register_now" class="btn btn-large btn-primary">ĐĂNG KÝ NGAY</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Bar -->
        </section>

        <!--------------------- wrap-fixed --------------------------------->
        <div class="wrap_fixed_bottom hidden-xs">
            <div class="tag_hotline"><span>Hotline</span><span class="arrow_hotline"> &nbsp;</span></div>

            <div class="main_nav_hotline site">
                <ul style="display: inline-flex;  ">
                    <li><img alt="" src="http://media.bizwebmedia.net/Sites/105084/data/banners/call.png?0" style="width: 16px; height: 16px;    vertical-align: text-top;">&nbsp;1900 6361 95 - 04 7306 2468</li>
                    <li><img alt="" src="http://media.bizwebmedia.net/Sites/105084/data/banners/fb.jpg?0" style="width: 16px; height: 16px;    vertical-align: text-top;">&nbsp;<a style="    color: #232323;" href="https://www.facebook.com/H%E1%BB%8Dc-K%E1%BA%BF-To%C3%A1n-Online-228989934154215/" target="_blank">FANPAGE HỌC KẾ TOÁN ONLINE</a></li>
                </ul>
                <ul style="display: inline-flex;     width: 300px; ">
                    <div class="fb-like fb_iframe_widget" data-href="https://www.facebook.com/H%E1%BB%8Dc-K%E1%BA%BF-To%C3%A1n-Online-228989934154215/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2FExcelThucTien&amp;layout=standard&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=false"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f24bf2f6a211d74" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="https://www.facebook.com/plugins/like.php?action=like&amp;app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FfTmIQU3LxvB.js%3Fversion%3D42%23cb%3Df2700d1fb6e263%26domain%3Dbiquyetlamchuexcel5.lakita.vn%26origin%3Dhttp%253A%252F%252Fbiquyetlamchuexcel5.lakita.vn%252Ff8184300c67324%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2FExcelThucTien&amp;layout=standard&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=false" style="border: none; visibility: visible; width: 0px; height: 0px;" class=""></iframe></span></div>
                </ul>
            </div>
            <div class="nttkm hidden-xs" style="width:250px;float:right;">
                <div class="nttkm-title">
                    <span class="show_dkntt" style="padding-right:0px; color: #fff;font-weight: bold;font-size: 14px;">
                        <img alt="" src="http://media.bizwebmedia.net/Sites/105084/data/banners/gift_mocskin.png" style="width: 16px; height: 16px;    vertical-align: text-top;">
                        <a style="    color: #fff;" href="#register_now">
                            ĐĂNG KÝ NGAY
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="fb-comments" data-href="http://lapbctc2016499.lakita.vn" data-width="100%" data-numposts="10" data-order-by="reverse_time"></div>
        </div>
  <!-- *************************************************************Popup*************************************************************************-->
    <div id="Popup" class="popup-wrapper" style="display: none;">
        <div class="popup-loading">
            <div class="loading-container">
                <span>
                    Hệ thống đang xử lý, vui lòng đợi trong giây lát...
                </span>
            </div>
        </div>
    </div>
    <style>
        .popup-wrapper {
            position: fixed;
            bottom: 0;
            right: 0;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 8010;
            background: url(http://lakita.vn/styles/v2.0/img/modal_overlay.png);
        }
        .popup-wrapper .popup-loading{
            background-color: white;
            opacity: 0.7;
            filter:alpha(opacity=70);
            height: 100%;
            width: 100%;
            z-index: 21;
            position: absolute;
            top: 0px;
            left: 0px;

        }
        .popup-wrapper .popup-loading .loading-container{
            position: relative;
            height: 100%;
            background: url(http://www.shopdowntowneaston.com/images/loading.gif) center center no-repeat;
        }
        .popup-wrapper .popup-loading .loading-container span{
            position: absolute;
            top: 58%;
            left: 30%;
            opacity: 1;
            z-index: 1000000000000;
            font-size: 28px;
            font-weight: bold;
        }
    </style>
<!-- *************************************************************Popup (end)**********************************************************************-->
    <script src="lakita/js/save_contact.js" type="text/javascript"></script>
    <!-- html5 player (start) -->
    <script src="http://lakita.vn/styles/html5/build/mediaelement-and-player.min.js"></script>
    <link rel="stylesheet" href="http://lakita.vn/styles/html5/build/mediaelementplayer.min.css" />
    <script>
            $('audio,video').mediaelementplayer({
                //mode: 'shim',
                success: function (player, node) {
                    $('#' + node.id + '-mode').html('mode: ' + player.pluginType);
                }
            });
    </script>

    <!-- html5 player (end) -->
    <script>
        var lastScrollTop = 0;
        $(window).scroll(function (event) {
            var st = $(this).scrollTop();
            if (st > lastScrollTop) {
                $(".nav-down").hide();
            } else {
                $(".nav-down").show(200);
            }
            lastScrollTop = st;
        });
    </script>
</body>
</html>
