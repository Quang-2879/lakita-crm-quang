var url = $("#base_url").val() + "sale/noti_contact_recall";
noti = () => {
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        success: data => {
            $('#num_noti').html(data.num_noti);
            var content_noti = ``;
            $.each(data.contacts_noti, function () {
                content_noti += `<li class="content_noti">`;
                content_noti += `<a href="#"
                                    title="Chăm sóc contact"
                                    class="ajax-request-modal"
                                    data-contact-id ="${this.id}"
                                    data-modal-name="edit-contact-modal"
                                    data-url="common/show_edit_contact_modal"> ${this.name}  - ${this.phone} - Thời gian gọi lại ${this.date_recall} 
                                    </a>`;
                content_noti += `</li>`;
            });
            $('#noti_contact_recall').html(content_noti);
            if (data.num_noti > 0) {
                var title = '(' + data.num_noti + ')  CONTACT CẦN GỌI LẠI';
                $("title").text(title);
            }
            if (typeof data.sound !== 'undefined') {
                $("#notificate_sound")[0].play();
                notify = new Notification(
                        data.message,
                        {
                            body: 'Click vào đây để xem ngay!',
                            icon: $("#base_url").val() + 'public/images/logo2.png',
                            tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
                            sound: $("#base_url").val() + 'public/mp3/new-contact.mp3',
                            image: data.image
                        }
                );
                var append = ` <div style="position: fixed; right:10px; bottom: 10px; z-index: 999999999; 
                                    background-color: #fff; display: inline-block; width: 30%; border-radius: 5px" class="my-notify">
                                        <div style="position:absolute; right: 5px; top:5px; cursor: pointer" class="close-notify"> 
                                            <i class="fa fa-times-circle" style="font-size: 18px;" aria-hidden="true"></i> 
                                        </div>    
                                        <div style="float:left; width: 35%; padding: 2%">
                                            <img src="https://crm2.lakita.vn/public/images/logo2.png" style="width: 70%"/>
                                        </div>
                                        <div style="float:left; width:65%; padding: 2%">
                                            <h4> ${data.message} </h4>
                                            <div>
                                                <img src="${data.image}" style="width: 90%"/>
                                            </div>
                                        </div>
                                   </div>`;

                $('body').append(append);
                setTimeout(function () {
                    $(".my-notify").remove();
                }, 10000);
            }
        }
    });
};
var notiContactRecall = '';
if($("#input_controller").val() == 'cod' || $("#input_controller").val() == 'sale') {
    notiContactRecall = setInterval(noti, 10000);
}