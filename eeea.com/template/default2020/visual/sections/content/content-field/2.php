<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-field/css/style.css" rel="stylesheet">
<div class="visual-conent-field content-field content-field-$_id">
    <div class="codearea">
    </div>
    <div class="viewarea">
        <span><?php echo lang_admin('field_name');?>：</span><?php echo lang_admin('content_custom_fields');?>
    </div>
    </div>

<style type="text/css">
    .content-field-$_id {
        ont-size:$_p-size;
        color:$_p-color;
    }
    .content-field-$_id:hover {
        color:$_p-hover-color;
    }
</style>
