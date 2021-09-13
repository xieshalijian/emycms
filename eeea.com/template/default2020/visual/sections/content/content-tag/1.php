
<div class="content-tag content-tag-$_id">
     <span class="content-statistics-title cmseasyedit" cmseasy-id="tag" cmseasy-table="lang" cmseasy-field="template">
                    {lang('tag')}
                </span>
    <span class="content-statistics-title">
        ：</span>
        {loop tags($catid,10) $tag}
        <a href="{$tag['url']}" style="color:{$tag['tag_txtcolor']};size:{$tag['tag_txtsize']}">
            {$tag['tag']}
        </a>
        {/loop}
    </div>

<style type="text/css">

    .content-tag-$_id .content-statistics-title {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-tag-$_id .content-statistics-title:hover {
        color:$_title-hover-color;
    }

</style>