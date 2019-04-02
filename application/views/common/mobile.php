<div class="container fontsize30" id="annount">
    <p> Bạn đang muốn thực hiện cuộc gọi đến : 
    <p> <strong>  <span class="contact_name"></span> </strong> </p>
    </p>
    <a href="tel:01689953142" title="Gọi" class="fontsize30">Click để gọi ngay!</a>
</div>

<script>
    setInterval(function () {
        $.ajax({
            url: $("#base_url").val() + 'common/get_phone_to_mobile',
            type:'POST',
            success: function (result) {
                var contact = JSON.parse(result);
                $("span.contact_name").text(contact.name);
                $('#annount a').attr('href', 'tel:'+ contact.phone);
            }
        });
    }, 1000);
</script>

<div> 
<a href="<?php echo base_url(); ?>home/logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a>
</div>