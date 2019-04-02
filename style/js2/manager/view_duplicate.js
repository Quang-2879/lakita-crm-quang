/*
$("a.view_duplicate").on('click', function (e) {
    e.preventDefault();
   // alert(1);
    var duplicate_id = $(this).attr("duplicate_id");
   // console.log(url);
    $.ajax({
        url: $("#base_url").val() + "manager/view_duplicate",
        type: "POST",
        data: {
            duplicate_id: duplicate_id
        },
        success: function (data) {
            // console.log(data);
            $("div.view_duplicate").html("").html(data);
        },
        complete: function () {
            $(".view_duplicate_modal").modal("show");
        }
    });
});

*/