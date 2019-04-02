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
                //console.log(data2);
                if (data2 === '1') {
                    $("#notificate")[0].play();
                    notify = new Notification(
                            'Có một contact mới đăng ký', 
                            {
                                body: 'Click vào đây để xem ngay!',
                                icon: $("#base_url").val() + 'public/images/logo2.png',
                                tag: 'http://crm2.lakita.vn/quan-ly/trang-chu.html', 
                                sound: $("#base_url").val() +'public/mp3/new-contact.mp3',
                                image: $("#base_url").val() + 'public/images/contact-us.jpg'
                            }
                    );
                    notify.onclick = function (event) {
                        event.preventDefault(); 
                        window.open('http://crm2.lakita.vn/quan-ly/trang-chu.html', '_blank');
                    };
                    if (($("#input_controller").val() === 'manager' && $("#input_method").val() === 'index')
                            || $("#input_controller").val() === 'marketing' && $("#input_method").val() === 'index') {
                        setTimeout(function () {
                            location.reload();
                        }, 4000);
                    }
                }
            }
        });
    }, 3000);