<link href="{$template_path}/visual/modules/common/scroll-content-list/css/style-1.css" rel="stylesheet">

    <div class="scroll-content-list-title">
    {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}

    <h4 class="scroll-content-list-h4 scroll-content-list-h4-$_id">
        <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
            {$cat['catname']}
        </a>
    </h4>
    {if $cat['subtitle']}
    <p class="scroll-content-list-p scroll-content-list-p-$_id">
    <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
                {$cat['subtitle']}
            </span>
    </p>
{/if}
    {/loop}
    </div>

<style type="text/css">
    h4.scroll-content-list-h4-$_id a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    h4.scroll-content-list-h4-$_id a:hover {
        color:$_link-hover-color;
    }
    p.scroll-content-list-p-$_id  {
        font-size:$_p-size;
        color:$_p-color;
    }
    p.scroll-content-list-p-$_id:hover {
        color:$_p-hover-color;
    }
</style>