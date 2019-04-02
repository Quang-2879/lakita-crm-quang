$(document).on('click', '.create-adset-from-fb', function (e) {
    e.preventDefault();
    $(".add-name-from-fb").val($(this).attr("adset-name"));
    $(".add-adset-id-from-fb").val($(this).attr("id-fb"));
    $campaignOption = ' <select class="form-control selectpicker" name="add_campaign_id" tabindex="-98"> ' +
            '<option value="'+ $(this).attr("campaign-crm-id") +'" selected="selected"> '+ $(this).attr("campaign-name-facebook") +'</option>' +
            '</select>';
     $(".select-campaign-fetch").html("");
    $(".select-campaign-fetch").append($campaignOption);
    console.log($(this).attr("id-fb"));
    $(".add_item_from_fb_modal").modal("show");
});
