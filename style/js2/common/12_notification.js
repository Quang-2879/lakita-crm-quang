/*
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */
/* global Notification */
/*
 var notify = '';
 Notification.requestPermission(function (p) {});
 setInterval(function () {
 $.ajax({
 url: $("#base_url").val() + "cron/listen",
 success: data2 => {
 //console.log(data2);
 if (data2 === '1') {
 $("#notificate")[0].play();
 notify = new Notification(
 'Có một contact mới đăng ký',
 {
 body: 'Click vào đây để xem ngay!',
 icon: $("#base_url").val() + 'public/images/logo2.png',
 tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
 sound: $("#base_url").val() + 'public/mp3/new-contact.mp3',
 image: $("#base_url").val() + 'public/images/contact-us.jpg'
 }
 );
 notify.onclick = function (event) {
 event.preventDefault();
 window.open('https://crm2.lakita.vn/quan-ly/trang-chu.html', '_blank');
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
 */
Pusher.logToConsole = true;
var pusher = new Pusher('32b339fca68db27aa480', {
    cluster: 'ap1',
    encrypted: true
});
var channel = pusher.subscribe('my-channel');
channel.bind('notice', function (data) {
    $("#notificate")[0].play();
    n = new Notification(
            data.title,
            {
                body: data.message,
                icon: $("#base_url").val() + 'public/images/logo2.png',
                tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
                sound: $("#base_url").val() + 'public/mp3/new-contact.mp3',
                image: data.image,
                "data": data.url || ''
            });
    n.onclick = function (e) {
        window.location.href = e.target.data;
    };
//    var append = ` <div style="position: fixed; right:10px; bottom: 10px; z-index: 999999999; 
//         background-color: #fff; display: inline-block; width: 30%; border-radius: 5px" class="my-notify">
//        <div style="position:absolute; right: 5px; top:5px; cursor: pointer" class="close-notify"> 
//            <i class="fa fa-times-circle" style="font-size: 18px;" aria-hidden="true"></i> 
//        </div>    
//        <div style="float:left; width: 35%; padding: 2%">
//            <img src="https://crm2.lakita.vn/public/images/logo2.png" style="width: 70%"/>
//        </div>
//        <div style="float:left; width:65%; padding: 2%">
//            <h4> ${data.title} </h4>
//            <p> ${data.message} </p>
//            <div>
//                <img src="${data.image}" style="width: 90%"/>
//            </div>
//        </div>
//    </div>`;
//
//    $('body').append(append);
//    setTimeout(function () {
//        $(".my-notify").remove();
//    }, 10000);

    if (($("#input_controller").val() === 'manager' && $("#input_method").val() === 'index')
            || $("#input_controller").val() === 'marketing' && $("#input_method").val() === 'index') {
        setTimeout(function () {
            location.reload();
        }, 4000);
    }
});

channel.bind('callLog', function (data) {


//    var append = ` <div style="position: fixed; right:10px; bottom: 10px; z-index: 999999999; 
//         background-color: #fff; display: inline-block; width: 30%; border-radius: 5px" class="my-notify">
//         <div style="position:absolute; right: 5px; top:5px; cursor: pointer" class="close-notify"> 
//                <i class="fa fa-times-circle" style="font-size: 18px;" aria-hidden="true"></i> 
//         </div>       
//         <div style="float:left; width: 35%; padding: 2%">
//            <img src="https://crm2.lakita.vn/public/images/logo2.png" style="width: 70%"/>
//        </div>
//        <div style="float:left; width:65%; padding: 2%">
//            <h4> ${data.title} </h4>
//            <p> ${data.message} </p>
//            <div>
//                <img src="${data.image}" style="width: 90%"/>
//            </div>
//        </div>
//    </div>`;
//
//    $('body').append(append);
//    setTimeout(function () {
//        $(".my-notify").remove();
//    }, 10000);

    if (data.success == '1') {
        $("#call-log-L6-sound")[0].play();
        n = new Notification(
                data.title,
                {
                    body: data.message,
                    icon: $("#base_url").val() + 'public/images/logo2.png',
                    tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
                    image: data.image
                });
    } else {
        $("#call-log-sound")[0].play();
    }
});

$(document).on("click", ".close-notify", function () {
    $(".my-notify").remove();
});