<link href="{$template_path}/visual/modules/common/special-pic/css/style.css" rel="stylesheet">

<div class="special-pic special-pic-$_id">
    {loop plugins::specialinfo($_spid) $special}
    <a href="{$special['url']}" title="{$special['title']}">
        <div class="special-pic-text">
            <h2 cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="title" class="cmseasyedit ">
                {$special['title']}
            </h2>
            <p cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="subtitle" class="cmseasyedit ">
                {$special['subtitle']}
            </p>
        </div>
        <img src="{$special['banner']}" alt="{$special['title']}" cmseasy-id="$_spid" cmseasy-table="special" cmseasy-field="banner" class="img-responsive cmseasyeditimg" />
    </a>
    {/loop}
</div>

<style type="text/css">

    .special-pic-$_id a h2 {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }

    .special-pic-$_id a h2:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }

    .special-pic-$_id a h2 p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .special-pic-$_id a h2 p:hover {
        color:$_p-hover-color;
    }

    .special-pic-$_id {
        background:$_background-color;
    }

    .special-pic-$_id:hover {
        background:$_background-hover-color;
    }

</style>
