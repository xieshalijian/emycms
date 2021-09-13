<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/category/category-subtitle/css/style.css" rel="stylesheet">

<div class="category-subtitle category-subtitle-$_id $_text-align">
<span cmseasy-id="{front::get('catid')}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                {$category[$catid]['subtitle']}
                </span>
</div>

<style type="text/css">

    .category-subtitle-$_id {
        display:block !important;
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .category-subtitle-$_id {
        color:$_title-hover-color;
    }

</style>
