<link href="{$template_path}/visual/modules/common/tag-list/css/style.css" rel="stylesheet">


<div class="hot-tag hot-tag-$_id">
    <div class="title">
        <h4 class=" cmseasyedit" cmseasy-id="hot_tags" cmseasy-table="lang" cmseasy-field="template">
            {lang('hot_tags')}
        </h4>
    </div>
    <div class="hot-tag-list">
        {loop tags(0,0,10) $tag}
        <a href="{$tag['url']}" style="color:{$tag['tag_txtcolor']};size:{$tag['tag_txtsize']}">
            {$tag['tag']}
        </a>
        {/loop}
    </div>
</div>

<style type="text/css">
    .hot-tag-$_id .title {
        border-left-color:$_background-border-color;
    }
    .hot-tag-$_id .title p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .hot-tag-$_id .title p:hover {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .hot-tag-$_id .title h4 {
        font-size:$_title-size;
        color:$_title-color;
    }
    .hot-tag-$_id .title h4:hover {
        color:$_title-hover-color;
    }
    .hot-tag-$_id .hot-tag-list a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .hot-tag-$_id .hot-tag-list a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>



