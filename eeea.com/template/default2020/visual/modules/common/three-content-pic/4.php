<link href="{$template_path}/visual/modules/common/three-content-pic/css/style-1.css" rel="stylesheet">
<div class="col-md-12">
    <div class="index-title">
    {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<h4 class="index-title-h4-$_id">
    <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
        {$cat['catname']}
    </a>
</h4>
    {if $cat['subtitle']}
<p class="index-title-p-$_id">
    <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="categorycontent" class="cmseasyedit content ">
                {$cat['categorycontent']}
            </span>
</p>
    {/if}
{/loop}
    </div>
</div>
<style type="text/css">
    .three-content-pic .index-title h4.index-title-h4-$_id a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .three-content-pic .index-title h4.index-title-h4-$_id a:hover {
        color:$_link-hover-color;
    }
    .three-content-pic .index-title p.index-title-p-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }
    .three-content-pic .index-title p.index-title-p-$_id:hover {
        color:$_p-hover-color;
    }
</style>