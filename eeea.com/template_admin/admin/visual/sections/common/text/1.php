<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/text/css/style.css" rel="stylesheet">



<div class="visual-text visual-text-$_id">
    $_text
</div>

<style type="text/css">
.visual-text-$_id {
    font-size:$_p-size;
    color:$_p-color;
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual-text-$_id:hover {
    color:$_p-hover-color;
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
</style>