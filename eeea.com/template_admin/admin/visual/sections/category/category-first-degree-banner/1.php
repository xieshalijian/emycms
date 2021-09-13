<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/category/category-first-degree-banner/css/style.css" rel="stylesheet">

<div class="category-first-degree-banner clearfix">
    {if $category[$topid]['banner']}
<div class="category-first-degree-banner-img category-first-degree-banner-img-$_id">
<img cmseasy-id="{$category[$topid]['catid']}" cmseasy-table="category" cmseasy-field="banner" class="cmseasyeditimg" src="{$category[$topid]['banner']}">
</div>
    {/if}
<div class="category-first-degree-banner-title category-first-degree-banner-title-$_id">
    <div class="container  $_text-align">
        <h1 cmseasy-id="{$catid}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
            {$category[$catid]['catname']}
        </h1>
        <div class="clearfix"></div>

        <p cmseasy-id="{$catid}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
            {$category[$catid]['subtitle']}
        </p>

    </div>
</div>
</div>
<style type="text/css">
    .category-first-degree-banner {
        height: $_height;
        background:$_background-color;
    }
    .category-first-degree-banner-img-$_id {
        height: $_height;
    }
    .category-first-degree-banner-title-$_id h1 {
        font-size:$_title-size;
        color:$_title-color;

    }

    .category-first-degree-banner-title-$_id h1:hover {
        color:$_title-hover-color;

    }

    .category-first-degree-banner-title-$_id p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }

    .category-first-degree-banner-title-$_id p:hover {
        color:$_subtitle-hover-color;
    }


</style>
