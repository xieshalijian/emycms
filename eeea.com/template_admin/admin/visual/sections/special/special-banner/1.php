<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/special/special-banner/css/style.css" rel="stylesheet">

<div class="special-banner special-banner-$_id">
    {if $special['banner']}
    <div class="special-banner-img">
        <img src="{$special['banner']}"  cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="banner" class="cmseasyeditimg img-responsive">
    </div>
{/if}
    <div class="special-banner-title special-banner-title-$_id">
        <div class="container $_text-align">
            <h1 cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="title" class="clearfix cmseasyedit position-move">
                {$special['title']}
            </h1>
            <div class="clearfix"></div>
            <p cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="subtitle" class="clearfix cmseasyedit position-move">
                {$special['subtitle']}
            </p>
        </div>
    </div>

</div>


<style type="text/css">

    .special-banner-$_id {
        height: $_height;
        background:$_background-color;
    }

    .special-banner-$_id .special-banner-title  h1 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .special-banner-$_id .special-banner-title h1:hover {
        color:$_title-hover-color;
    }

    ..special-banner-$_id .special-banner-title p  {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }

    .special-banner-$_id .special-banner-title p:hover {
        color:$_subtitle-hover-color;
    }

    .special-banner-$_id .special-banner-title h1:after {
        background:$_title-color;
    }
    .special-banner-$_id .special-banner-title h1:hover:after {
        background:$_title-hover-color;
    }
</style>