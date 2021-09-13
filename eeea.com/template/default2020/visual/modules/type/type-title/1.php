<link href="{$template_path}/visual/modules/type/type-title/css/style-1.css" rel="stylesheet">
{loop plugins::typeinfo($_typeid) $type}
<p cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="subtitle" class="cmseasyedit type-title-p-$_id">
    {$type['subtitle']}
</p>
<div class="clearfix"></div>
<h1 cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit type-title-h1-$_id">
    {$type['typename']}
</h1>
{/loop}
<style type="text/css">
    h1.type-title-h1-$_id {
        font-size:$_title-size;
        color:$_title-color;
    }
    h1.type-title-h1-$_id:hover {
        color:$_title-hover-color;
    }
    p.type-title-p-$_id {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    p.type-title-p-$_id:hover {
        color:$_subtitle-hover-color;
    }
</style>
