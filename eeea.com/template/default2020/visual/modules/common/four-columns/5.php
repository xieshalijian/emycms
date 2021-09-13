<link href="{$template_path}/visual/modules/common/four-columns/css/style-1.css" rel="stylesheet">
{loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<div class="four-columns-item four-columns-item four-columns-item-$_id">
    <div class="four-columns-item-img">
        <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank">
            <img alt="{$cat['catname']}" src="{$cat['image']}" class="cmseasyeditimg" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="image" />
        </a>
    </div>
    <div class="four-columns-item-text">
        <h4>
            <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
                {$cat['catname']}
            </a>
        </h4>
        <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="categorycontent" class="cmseasyedit content ">
            {$cat['categorycontent']}
        </p>

    </div>
</div>
{/loop}

<style type="text/css">
    .four-columns-item-$_id .four-columns-item-text h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .four-columns-item-$_id .four-columns-item-text h4 a:hover {
        color:$_link-hover-color;
    }
    .four-columns-item-$_id .four-columns-item-text p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .four-columns-item-$_id .four-columns-item-text p:hover {
        color:$_p-hover-color;
    }
    .four-columns-item-$_id {
        border-color:$_link-border-color;
    }
    .four-columns-item-$_id:hover {
        border-color:$_link-border-hover-color;
    }
</style>