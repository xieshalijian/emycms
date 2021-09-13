<link href="{$template_path}/visual/modules/special/special-title/css/style-1.css" rel="stylesheet">
<div class="special-title special-title-$_id">
{loop plugins::specialinfo($_spid) $special}
<p cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="subtitle" class="cmseasyedit ">
    {$special['subtitle']}
</p>
<div class="clearfix"></div>
<h1 cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="title" class="cmseasyedit ">
    {$special['title']}
</h1>
{/loop}
</div>
<style special="text/css">
    .special-title-$_id h1 {
        font-size:$_title-size;
        color:$_title-color;
    }
    .special-title-$_id h1:hover {
        color:$_title-hover-color;
    }
    .special-title-$_id p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .special-title-$_id p:hover {
        color:$_subtitle-hover-color;
    }
</style>
