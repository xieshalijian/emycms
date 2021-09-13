<link href="{$template_path}/visual/modules/common/scroll-pic-list/css/style-1.css" rel="stylesheet">
<div class="col-md-12">
    <div class="scroll-pic-list-index-title scroll-pic-list-index-title-$_id">
{loop plugins::categoryinfo($_catid,$_titlenum) $cat}
<h4>
    <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
        {$cat['catname']}
    </a>
</h4>
        {if $cat['subtitle']}
<p class="scroll-pic-list-p-$_id">
    <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
                {$cat['subtitle']}
            </span>
</p>
        {/if}
{/loop}
</div>
</div>
<style type="text/css">
    .scroll-pic-list-index-title-$_id h4.scroll-pic-list-h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .scroll-pic-list-index-title-$_id h4.scroll-pic-list-h4 a:hover {
        color:$_link-hover-color;
    }
    .scroll-pic-list-index-title-$_id p.scroll-pic-list-p p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .scroll-pic-list-index-title-$_id p.scroll-pic-list-p:hover {
        color:$_p-hover-color;
    }
</style>