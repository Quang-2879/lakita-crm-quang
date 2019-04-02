<script>
    $(document).ready(function () {
        $(document).on('click', 'input.input_save', function (e) {
            e.preventDefault();
            $("#form_item").attr("action", "<?php echo base_url() . $this->controller_path . '/confirm_check_fee_cod' ?>").attr("method", "POST");
            $("#form_item").submit();
        });
    });

</script>