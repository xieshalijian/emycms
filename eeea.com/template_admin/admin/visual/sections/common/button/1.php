<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/button/css/style.css" rel="stylesheet">

<a href="$_link-href" class="visual-button visual-button-$_id"{if $_isblank==1} target="_blank"{/if}>
    $_link-name
</a>


<style type="text/css">
    .visual-button-$_id {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
        padding-top:$_padding_top;
        padding-right:$_padding_right;
        padding-bottom:$_padding_bottom;
        padding-left:$_padding_left;
    }
    .visual-button-$_id:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>