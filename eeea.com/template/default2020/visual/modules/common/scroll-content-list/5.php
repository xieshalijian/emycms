<link href="{$template_path}/visual/modules/common/scroll-content-list/css/style-2.css" rel="stylesheet">

    <div class="scroll-content-list-title">
<ul class="scroll-content-list-title-ul scroll-content-list-title-ul-$_id">
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

<style type="text/css">
    ul.scroll-content-list-title-ul-$_id li a {
        color:$_link-color;
        border-color:$_link-border-color;
        background-color:$_link-background-color;
        font-size:$_link-font-size;
        border-radius:$_link-border-radius;
    }
    ul.scroll-content-list-title-ul-$_id a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        background-color:$_link-background-hover-color;
    }

</style>