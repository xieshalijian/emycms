

<link href="{$template_path}/visual/modules/common/left-pic-and-right-content/css/style-1.css" rel="stylesheet">
<div class="left-pic-and-right-content-title left-pic-and-right-content-title-$_id">
    {loop plugins::categoryinfo($_catid) $cat}

    <h4>
        <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
            {$cat['catname']}
        </a>
    </h4>
    {if $cat['subtitle']}
    <p>
    <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
                {$cat['subtitle']}
            </span>
    </p>
{/if}
    {/loop}
</div>
<style>
    .left-pic-and-right-content-title-$_id h4,
    .left-pic-and-right-content-title-$_id h4 a {
        color:$_link-color;
        border-color:$_link-border-color;
        background-color:$_link-background-color;
        font-size:$_link-font-size;
        border-radius:$_link-border-radius;
    }
    .left-pic-and-right-content-title-$_id h4 a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
    }
    .left-pic-and-right-content-title-$_id p  {
        color:$_p-color;
        font-size:$_p-size;
    }
    .left-pic-and-right-content-title-$_id p:hover {
        color:$_p-hover-color;
    }
</style>

