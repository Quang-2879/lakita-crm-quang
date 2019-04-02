<script>
    $(document).ready(function () {
        $(document).on('click', 'input.input_save', function (e) {
            e.preventDefault();
            $("#form_item").attr("action", "<?php echo base_url() . $this->controller_path . '/confirm_check_L8' ?>").attr("method", "POST");
            $("#form_item").submit();
        });
    });
</script>
<style>
/*    .tbl_selection, .tbl_check_L8_id, .tbl_check_L8_stt{
        width: 33px !important;
    }*/
</style>
