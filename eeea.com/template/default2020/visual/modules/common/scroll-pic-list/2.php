<link href="{$template_path}/visual/modules/common/scroll-pic-list/css/style-2.css" rel="stylesheet">
<div class="col-md-12">
    <ul class="scroll-pic-list-index-title-ul scroll-pic-list-index-title-ul-$_id">
    {loop plugins::categoryinfo($_catid,$_titlenum) $cat}
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
<style type="text/css">
    .scroll-pic-list-index-title-ul-$_id li a {
        color:$_link-color;
        border-color:$_link-border-color;
        background-color:$_link-background-color;
        font-size:$_link-font-size;
        border-radius:$_link-border-radius;
    }
    .scroll-pic-list-index-title-ul-$_id li a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        background-color:$_link-background-hover-color;
    }

</style>