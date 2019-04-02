<?php if(count($_GET)){?>
<script>
    $(function(){
         $(".pagination a").each(
           function(){
               var curr_href = $(this).attr("href");
               $(this).attr('href', curr_href + "<?php echo '?' . http_build_query($_GET, '', "&"); ?>");
           }); 
    });
</script>
<?php }?>