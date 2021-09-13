<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/picture/css/style.css" rel="stylesheet">


<div class="picture picture-$_id">
    <a href="$_image-link" title="$_image-alt">
        <img alt="$_image-alt" src="$_image-url" class="img-responsive">
    </a>
</div>


<style type="text/css">
.picture-$_id {
    height: $_height;
    border-width:$_background-border-width;
    background:$_background-color;
    border-color:$_background-border-color;
}
.picture-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
</style>