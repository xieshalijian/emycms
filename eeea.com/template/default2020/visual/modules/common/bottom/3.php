<link href="{$template_path}/visual/modules/common/bottom/css/style-3.css" rel="stylesheet">
<div class="foot-ul foot-ul-3 foot-ul-3-$_id">
    {loop plugins::categoryinfo($_catid,$_titlenum) $cat}

            <h4>
                <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                    {$cat['catname']}
                </a>
            </h4>

            <ul>
                {loop categories($cat['catid']) $cat}
                <li>
                    <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                        {$cat['catname']}
                    </a>
                </li>
                {/loop}
            </ul>
    {/loop}
</div>
<style type="text/css">
    .foot-ul-3-$_id ul h4 a {
        font-size:$_title-size;
        color:$_title-color;
    }
    .foot-ul-3-$_id ul h4 a:hover {
        color:$_title-hover-color;
    }
    .foot-ul-3-$_id ul li a {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .foot-ul-3-$_id ul li a:hover {
        color:$_subtitle-hover-color;
    }
</style>