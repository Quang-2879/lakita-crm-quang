$(document).on('click', '.create-campaign-from-fb', function (e) {
    e.preventDefault();
    $(".add-name-from-fb").val($(this).attr("campaign-name"));
    $(".add-campaign-id-from-fb").val($(this).attr("id-fb"));
    $(".add_item_from_fb_modal").modal("show");
});

$(document).on('click', '.create-campaign-from-fb-2', function (e) {
    e.preventDefault();
    var _this = $(this);
    $.confirm({
        theme: 'supervan', 
        title: 'Bạn có chắc chắn muốn tạo link này không?',
        content: 'Việc tạo link này đồng nghĩa với việc tạo các campaign, adset và ad tương ứng, \n\
                nếu chúng không tồn tại',
        buttons: {
            confirm: {
                text: 'Đồng ý',
                action: function () {
                    if (_this.parent().parent().find('select.select-landing-page').val() == 0) {
                        $.alert({
                            theme: 'modern',
                            type: 'red',
                            title: 'Có lỗi xảy ra!',
                            content: 'Vui lòng chọn landing page!'
                        });
                    } else {
                        $.ajax({
                            url: $("#url-add-item-from-fb-2").val(),
                            type: "POST",
                            beforeSend: () => $(".popup-wrapper").show(),
                            data: {
                                fb_account_id: _this.attr('fb-account-id'),
                                fb_campaign_id: _this.attr('fb-campaign-id'),
                                fb_campaign_name: _this.attr('fb-campaign-name'),
                                fb_adset_id: _this.attr('fb-adset-id'),
                                fb_adset_name: _this.attr('fb-adset-name'),
                                fb_ad_id: _this.attr('fb-ad-id'),
                                fb_ad_name: _this.attr('fb-ad-name'),
                                landing_page_id: _this.parent().parent().find('select.select-landing-page').val()
                            },
                            success: function (data) {
                                $.alert({
                                    theme: 'modern',
                                    title: 'Tạo thành công link',
                                    content: data
                                });
                                _this.text("Đã tạo");
                                _this.removeClass("btn-success");
                                _this.addClass("btn-danger");
                                _this.attr("disabled", "disabled");
                            },
                            complete: function () {
                                $(".popup-wrapper").hide();
                            },
                            error: function (error) {
                                $.alert({
                                    theme: 'modern',
                                    type: 'red',
                                    title: 'Có lỗi xảy ra!',
                                    content: error
                                });
                            }
                        });
                    }

                }},
            cancel: {
                text: 'Nope',
                action: function () {
                }},
            somethingElse: {
                text: 'Khác',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function () {

                }
            }
        }
    });
});

