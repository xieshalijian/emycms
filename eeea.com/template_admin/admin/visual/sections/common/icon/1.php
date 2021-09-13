<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/icon/css/style.css" rel="stylesheet">

<a title="$_link-name" href="$_link-href" class="visual-inline-block visual-ico visual-ico-$_id"{if $_isblank ==1 } target="_blank"{/if}>
        $_icon
</a>

<style type="text/css">
    .visual-ico-$_id {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .visual-ico-$_id:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
    .visual-ico-$_id i {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .visual-ico-$_id:hover i {
        color:$_link-hover-color;
    }
</style>