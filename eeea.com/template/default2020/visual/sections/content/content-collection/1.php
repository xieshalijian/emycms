<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-collection/css/style.css" rel="stylesheet">
<div class="inline-block content-collection-$_id">
    {getcollect($archive['aid'])}
    <div class="clearfix"></div>
</div>
<style type="text/css">
    .content-collection-$_id {
        vertical-align:top;
    }
    .content-collection-$_id .content-collection {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-collection-$_id .content-collection:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>
