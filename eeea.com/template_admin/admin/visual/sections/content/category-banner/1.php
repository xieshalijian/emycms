<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/category-banner/css/style.css" rel="stylesheet">


<div class="category-banner clearfix">
    {if $category[$catid]['banner']}
    <div class="category-banner-img category-banner-img-$_id">
        <img cmseasy-id="{$catid}" cmseasy-table="category" cmseasy-field="banner" class="cmseasyeditimg" src="{$category[$catid]['banner']}">
    </div>
    {/if}
    <div class="category-banner-title category-banner-title-$_id">
        <div class="container $_text-align">
        <h1 cmseasy-id="{$catid}" cmseasy-table="category" cmseasy-field="catname" class="clearfix cmseasyedit position-move">
            {$category[$catid]['catname']}
        </h1>

        <div class="clearfix"></div>

        <p cmseasy-id="{$catid}" cmseasy-table="category" cmseasy-field="subtitle" class="clearfix cmseasyedit position-move">
            {$category[$catid]['subtitle']}
        </p>

    </div>
</div>
</div>
<style type="text/css">

    .category-banner {
        height: $_height;
        background:$_background-color;
    }
.category-banner-img-$_id {
    height: $_height;
}
    .category-banner-title-$_id h1 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .category-banner-title-$_id h1:hover {
        color:$_title-hover-color;
    }

    .category-banner-title-$_id p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }

    .category-banner-title-$_id p:hover {
        color:$_subtitle-hover-color;
    }


</style>
