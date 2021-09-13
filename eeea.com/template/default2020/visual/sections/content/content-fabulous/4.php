<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-fabulous/css/style.css" rel="stylesheet">
<div class="inline-block content-fabulous-$_id">
    {getraise($archive['praise'],$archive['aid'])}
    <div class="clearfix"></div>
</div>
<style type="text/css">
    .content-fabulous-$_id {
        vertical-align:top;
    }
    .content-fabulous-$_id .content-fabulous {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-fabulous-$_id .content-fabulous:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>
