<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/blank/css/style.css" rel="stylesheet">


<div class="visual-code-box visual-code-box-$_id">
    <div class="visual-code"></div>
    <div class="visual-code-show">
        <div class="visual-code-show-content">
            {lang_admin('source_code')}
        </div>
    </div>
</div>


<style type="text/css">
.visual-code-box-$_id {
    height: $_height;
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual-code-box-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
</style>