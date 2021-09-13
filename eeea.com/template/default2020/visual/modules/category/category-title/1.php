<link href="{$template_path}/visual/modules/category/category-title/css/style-1.css" rel="stylesheet">
<div class="col-md-12">
    {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
    <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit category-title-p-$_id">
        {$special['subtitle']}
    </p>
    <div class="clearfix"></div>
    <h1 cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit category-title-h1-$_id">
        {$cat['catname']}
    </h1>
</div>
{/loop}
<style type="text/css">
    h1.category-title-h1-$_id {
        font-size:$_title-size;
        color:$_title-color;
    }
    h1.category-title-h1-$_id:hover {
        color:$_title-hover-color;
    }
    p.category-title-p-$_id {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    p.category-title-p-$_id:hover {
        color:$_subtitle-hover-color;
    }
</style>
