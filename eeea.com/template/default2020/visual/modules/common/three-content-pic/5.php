<link href="{$template_path}/visual/modules/common/three-content-pic/css/style-2.css" rel="stylesheet">
<div class="col-md-12">
    <div class="index-title">
    <ul class="index-title index-title-$_id">
    {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
    {loop categories($cat['catid']) $cat}
    <li>
        <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
            {$cat['catname']}
        </a>
    </li>
    {/loop}
{/loop}
</ul>
    </div>
</div>
<style type="text/css">
    ul.index-title-$_id li a {
        color:$_link-color;
        border-color:$_link-border-color;
        background-color:$_link-background-color;
        font-size:$_link-font-size;
        border-radius:$_link-border-radius;
    }
    ul.index-title-$_id li a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        background-color:$_link-background-hover-color;
    }

</style>