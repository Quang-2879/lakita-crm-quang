<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/js/pivot/pivot.css">-->
<script type="text/javascript" src="<?php echo base_url(); ?>style/js/pivot/pivot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>style/js/pivot/export_renderers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>style/js/pivot/d3_renderers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>style/js/pivot/c3_renderers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>style/js/pivot/pivot_table.min.js"></script>
<style>
    body {font-family: Verdana;}
    .node {
        border: solid 1px white;
        font: 10px sans-serif;
        line-height: 12px;
        overflow: hidden;
        position: absolute;
        text-indent: 2px;
    }
    .c3-line, .c3-focused {stroke-width: 3px !important;}
    .c3-bar {stroke: white !important; stroke-width: 1;}
    .c3 text { font-size: 12px; color: grey;}
    .tick line {stroke: white;}
    .c3-axis path {stroke: grey;}
    .c3-circle { opacity: 1 !important; }
    .c3-xgrid-focus {visibility: hidden !important;}
</style>
<form action="#" method="GET" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>
<h2> Báo cáo doanh thu theo TVTS </h2>
<div id="output" style="margin: 30px;"> </div>
<h2> Báo cáo doanh thu theo khóa học </h2>
<div id="output-2" style="margin: 30px;">  </div>