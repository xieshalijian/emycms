<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/type/type-banner/css/style.css" rel="stylesheet">

<div class="typ-banner typ-banner-$_id">
    {if $type['banner']}
    <div class="typ-banner-img">
        <img src="{$type['banner']}"  cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="banner" class="cmseasyeditimg img-responsive">
    </div>
    {/if}
    <div class="typ-banner-title typ-banner-title-$_id">
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

    .typ-banner-$_id {
        height: $_height;
        background:$_background-color;
    }

    .typ-banner-$_id .typ-banner-title  h1 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .typ-banner-$_id .typ-banner-title h1:hover {
        color:$_title-hover-color;
    }

    ..typ-banner-$_id .typ-banner-title p  {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }

    .typ-banner-$_id .typ-banner-title p:hover {
        color:$_subtitle-hover-color;
    }

    .typ-banner-$_id .typ-banner-title h1:after {
        background:$_title-color;
    }
    .typ-banner-$_id .typ-banner-title h1:hover:after {
        background:$_title-hover-color;
    }
</style>