$(document).ready(function(){
    $(document).on('click', '.select_provider', function(e){
         $("#action_contact").removeClass("form-inline");
         e.preventDefault();
         $(".edit_multi_cod_contact").modal("show");
    });
});