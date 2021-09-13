<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/logo/css/style.css" rel="stylesheet">


<div class="visual_logo visual_logo-$_id">
    <a href="<?php echo $base_url;?>/">
        <img src="{get('site_logo')}" class="img-responsive cmseasyeditimg" cmseasy-id="site_logo" cmseasy-table="config" src="{config::get('site_logo')}" alt="{get('sitename')}" />
    </a>
</div>


<style type="text/css">
.visual_logo-$_id {
    height: $_height;
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual_logo-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
</style>