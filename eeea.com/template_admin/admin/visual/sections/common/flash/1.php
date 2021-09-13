<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/flash/css/style.css" rel="stylesheet">


<div class="visual-flash visual-flash-$_id">
    <object data="http://player.youku.com/player.php/sid/XNDA1MTIzOTM2MA==/v.swf" type="application/x-shockwave-flash" width="100%" height="100%">
        <param name="movie" value="http://player.youku.com/player.php/sid/XNDA1MTIzOTM2MA==/v.swf" />
        <param name="wmode" value="transparent" />
        <param name="autostart" value="0" />
    </object>
</div>

<style type="text/css">
.visual_flash-$_id {
    height: $_height;
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual_flash-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
</style>