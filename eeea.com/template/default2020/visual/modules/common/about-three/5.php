<link href="{$template_path}/visual/modules/common/about-three/css/style-1.css" rel="stylesheet">
<div class="col-md-12">
    <div class="list-title list-title-$_id">
        {loop plugins::categoryinfo($_catid) $cat}
        {if $cat['subtitle']}
        <p>
            <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
                {$cat['subtitle']}
            </a>
        </p>
        {/if}
        <h4>
            <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                {$cat['catname']}
            </a>
        </h4>
        {/loop}
    </div>
</div>
<style type="text/css">
    .list-title-$_id h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .list-title-$_id h4 a:hover {
        color:$_link-hover-color;
    }
    .list-title-$_id p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .list-title-$_id p:hover {
        color:$_p-hover-color;
    }
</style>