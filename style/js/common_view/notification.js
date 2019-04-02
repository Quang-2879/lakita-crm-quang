/* 
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */
  var notify = '';
    Notification.requestPermission(function (p) {});
    setInterval(function () {
        $.ajax({
            url: $("#base_url").val()+"common/listen",
            success: function (data2) {
                console.log(data2);
                if (data2 === '1') {
                    $("#notificate")[0].play();
                    notify = new Notification(
                            'Có một contact mới đăng ký', 
                            {
                                body: 'Click vào đây để xem ngay!',
                                icon: 'http://lakita.vn/styles/v2.0/img/logo2.png', 
                                tag: 'http://crm2.lakita.vn/quan-ly/trang-chu.html', 
                                sound: 'http://lakita.vn/styles/wrong.mp3',
                                image: 'http://www.thecadillaclawyer.com/wp-content/uploads/2014/09/Facebook_like_thumb.png'
                            }
                    );
                    notify.onclick = function (event) {
                        event.preventDefault(); 
                        window.open('http://crm2.lakita.vn/quan-ly/trang-chu.html', '_blank');
                    };
                    if (($("#my-controller").val() === 'manager' && $("#my-action").val() === 'index')
                            || $("#my-controller").val() === 'marketing' && $("#my-action").val() === 'index') {
                        setTimeout(function () {
                            location.reload();
                        }, 4000);
                    }
                }
            }
        });
    }, 1000);