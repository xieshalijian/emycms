<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/print/css/style.css" rel="stylesheet">
<div class="claerfix col-md-12">
<p class="visual-print-tools $_text-align">
    <a href="javascript:CallPrint('print');">
        <i class="glyphicon glyphicon-print"></i>
    </a>
    <a href="javascript:doZoom(14)">
        <span class="column-title cmseasyedit" cmseasy-id="small" cmseasy-table="lang" cmseasy-field="template">
        {lang('small')}
            </span>
    </a>
    <a href="javascript:doZoom(18)">
        <span class="column-title cmseasyedit" cmseasy-id="middle" cmseasy-table="lang" cmseasy-field="template">
        {lang('middle')}
            </span>
    </a>
    <a href="javascript:doZoom(20)">
        <span class="column-title cmseasyedit" cmseasy-id="big" cmseasy-table="lang" cmseasy-field="template">
        {lang('big')}
            </span>
    </a>
</p>
</div>
<style type="text/css">

    .visual-print-tools {
        background:$_background-color;
    }
    .visual-print-tools:hover {
        background:$_background-hover-color;
    }

    .visual-print-tools a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .visual-print-tools a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>


<script src="<?php echo $base_url;?>/common/plugins/font-print/c_tool.js"></script>