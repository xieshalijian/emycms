<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/category/category-title/css/style.css" rel="stylesheet">

<h1 class="category-title category-title-$_id $_text-align">
 <span cmseasy-id="{front::get('catid')}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                {$category[$catid]['catname']}
                </span>
</h1>

<style type="text/css">

    .category-title-$_id {
        display:block !important;
        font-size:$_title-size;
        color:$_title-color;
    }
    .category-title-$_id:hover {
        color:$_title-hover-color;
    }

</style>
