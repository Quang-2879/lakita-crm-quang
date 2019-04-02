$(function () {
    var url = $("#base_url").val() + "sale/noti_contact_recall";
    var i = 0;
    setInterval(noti, 10000);
    function noti() {
        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#num_noti').html(data.num_noti);
                var content_noti = '';
                $.each(data.contacts_noti, function () {
                    content_noti += '<li class="content_noti">';
                    content_noti += '<a href="#" class="edit_contact" contact_id="' + this.id + '" title="Chăm sóc contact"> ' +
                            this.name + ' - ' + this.phone + ' - Thời gian gọi lại ' + this.date_recall + '</a>';
                    content_noti += '</li>';
                });
                $('#noti_contact_recall').html(content_noti);
                if (data.num_noti > 0) {
                    if (i++ === 0) {
                        var originTitle = 'CONTACT CẦN GỌI LẠI';
                    } else {
                        var originTitle = $("title").text().substring(3);
                    }
                    var title = '(' + data.num_noti + ') ' + originTitle;
                    $("title").text(title);
                }
                if (typeof data.sound !== 'undefined') {
                    $("#notificate_sound")[0].play();
                    notify = new Notification(
                            'Có contact mới đăng ký',
                            {
                                body: 'Click vào đây để xem ngay!',
                                icon: $("#base_url").val() + 'public/images/logo2.png',
                                tag: 'http://crm2.lakita.vn/quan-ly/trang-chu.html',
                                sound: $("#base_url").val() + 'public/mp3/new-contact.mp3',
                                image: $("#base_url").val() + 'public/images/recall.jpg'
                            }
                    );
                }
            }
        });
    }
});