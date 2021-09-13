

<link href="{$template_path}/visual/modules/common/three-content-and-btn/css/style-1.css" rel="stylesheet">
<div class="three-content-and-btn-title col-md-12">
    {loop plugins::categoryinfo($_catid) $cat}
    <h4 class="index-title-h4 index-title-h4-$_id">
        <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
            {$cat['catname']}
        </a>
    </h4>
    {if $cat['subtitle']}
    <p class="index-title-p index-title-p-$_id">
     <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
                {$cat['subtitle']}
            </span>
    </p>
{/if}
    {/loop}
</div>
<style>
    h4.index-title-h4-$_id,
    h4.index-title-h4-$_id a {
        color:$_link-color;
        border-color:$_link-border-color;
        background-color:$_link-background-color;
        font-size:$_link-font-size;
        border-radius:$_link-border-radius;
    }
    h4.index-title-h4-$_id a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
    }
    p.index-title-p-$_id {
        color:$_p-color;
        font-size:$_p-size;
    }
    p.index-title-p-$_id:hover {
        color:$_p-hover-color;
    }
</style>

