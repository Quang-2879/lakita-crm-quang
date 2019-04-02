Dropzone.options.dropzoneFileUpload = {
    dictDefaultMessage: "Thả file vào đây hoặc click vào đây để upload",
    acceptedFiles: ".xls, .xlsx",
    maxFilesize: 10,
    init: function () {
        this.on("addedfile",
                function () {
                    $(".popup-wrapper").show();
                }).on("success", function () {
            //console.log(e);
            location.href = $("#redirect-dropzone").val();
        }).on("error", function () {
            $(".popup-wrapper").hide();
        });
    }
};