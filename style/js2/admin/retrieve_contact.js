/* 
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */

/*
 $(document).on('click', 'a.retrieve-contact', function (e) {
 var r = confirm("Bạn có chắc chắn muốn thu hồi contact này không?");
 if (r == true) {
 var del = $(this);
 var contact_id = $(this).attr("contact_id");
 e.preventDefault();
 $.ajax({
 type: "POST",
 url: $("#base_url").val() + "admin/retrieve_contact",
 data: {
 contact_id: contact_id
 },
 success: data => {
 if (data === '1')
 {
 alert('Thu hồi thành công contact');
 //del.parent().parent().hide();
 location.reload();
 } else {
 alert(data);
 }
 },
 error: errorThrown => alert(errorThrown)
 });
 }
 });
 */

$(".action-contact-admin").confirm({
    theme: 'supervan', // 'material', 'bootstrap',
    title: "Bạn có chắc chắn với hành động này?",
    content: '',
    buttons: {
        confirm: {
            text: 'Có',
            action: function () {
                var _this = this.$target;
                var contactID = _this.attr("data-contact-id");
                var url = $("#base_url").val() + _this.attr("data-url");
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        contact_id: contactID
                    },
                    success: data => {
                        if (data === '1')
                        {
                            $.alert({
                                theme: 'modern',
                                title: _this.attr("data-answer"),
                                content: '',
                                 buttons: {
                                     confirm: {
                                         text: 'OK',
                                         action: function(){
                                              location.reload(); 
                                         }
                                     }
                                 }
                            });
                        } else {
                            alert(data);
                        }
                    },
                    error: errorThrown => alert(errorThrown)
                });
            }},
        cancel: {
            text: 'Nope',
            action: function () {
            }}
    }
});
