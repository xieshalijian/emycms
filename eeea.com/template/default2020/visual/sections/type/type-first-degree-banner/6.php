<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/type/type-first-degree-banner/css/style.css" rel="stylesheet">

<div class="type-first-degree-banner type-first-degree-banner-$_id">
    {if $type[$topid]['banner']}
    <div class="type-first-degree-banner-img">
        <img src="{$type[$topid]['banner']}"  cmseasy-id="{$type[$topid]['typeid']}" cmseasy-table="type" cmseasy-field="banner" class="cmseasyeditimg img-responsive">
    </div>
    {/if}
    <div class="type-first-degree-banner-title type-first-degree-banner-title-$_id">
        <div class="container $_text-align">
            <h1 cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="title" class="clearfix cmseasyedit position-move">
                {$type['typename']}
            </h1>
            <div class="clearfix"></div>
            <p cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="subtitle" class="clearfix cmseasyedit position-move">
                {$type['subtitle']}
            </p>
        </div>
    </div>
</div>


<style type="text/css">

    .type-first-degree-banner-$_id {
        height: $_height;
        background:$_background-color;
    }

    .type-first-degree-banner-$_id .type-first-degree-banner-title  h1 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .type-first-degree-banner-$_id .type-first-degree-banner-title h1:hover {
        color:$_title-hover-color;
    }

    ..type-first-degree-banner-$_id .type-first-degree-banner-title p  {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }

    .type-first-degree-banner-$_id .type-first-degree-banner-title p:hover {
        color:$_subtitle-hover-color;
    }

    .type-first-degree-banner-$_id .type-first-degree-banner-title h1:after {
        background:$_title-color;
    }
    .type-first-degree-banner-$_id .type-first-degree-banner-title h1:hover:after {
        background:$_title-hover-color;
    }
</style>