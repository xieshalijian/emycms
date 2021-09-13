<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/sitemap/css/style.css" rel="stylesheet">

<div class="col-md-12 sitemap-list sitemap-list-$_id">
    <ul>
        <h2 class="oen">
            <a href="{$base_url}/">
                <span class=" cmseasyedit" cmseasy-id="homepage" cmseasy-table="lang" cmseasy-field="template">
                {lang('homepage')}
                    </span>
            </a>
        </h2>
        {loop categories_new_nav() $t}
        <div class="clearfix"></div>
        <h2 class="oen{if isset($topid) && $topid==$t['catid']} active{/if}{if count((array)$t['children'])} dropdown{/if}">
            <a href="{$t['url']}"{if config::get('nav_blank')==1} target=" _blank"{/if}{if  count((array)$t['children'])} class="toogle"{/if}>
            <span cmseasy-id="{$t['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                {$t['catname']}
            </span>
            {if count((array)$t['children'])}<span class="caret"></span>{/if}</a>
        </h2>
        {if count((array)$t['children'])}
        <ul class="two{if count((array)$t['children'])} open-list{/if}">
            {loop $t['children'] $t1}
            <li{if count((array)$t1['children'])} class="open-list-title"{/if}>
            <a title="{$t1['catname']}" href="{$t1['url']}" cmseasy-id="{$t1['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit{if  count((array)$t1['children'])} toogle{/if}">{$t1['catname']}</a>
            </li>
            {if count((array)$t1['children'])}
            <ul{if count((array)$t1['children'])} class="open-list"{/if}>
            {loop $t1['children'] $t2}
            <li{if count((array)$t2['children'])} class="open-list-title"{/if}>
            <a title="{$t2['catname']}" href="{$t2['url']}" cmseasy-id="{$t2['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit{if  count((array)$t2['children'])} toogle{/if}">{$t2['catname']}</a>
            </li>
            {if count((array)$t2['children'])}
            <ul{if count((array)$t2['children'])} class="open-list"{/if}>
            {loop $t2['children'] $t3}
            <li{if count((array)$t3['children'])} class="open-list-title"{/if}>
            <a title="{$t3['catname']}" href="{$t3['url']}" cmseasy-id="{$t3['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit{if  count((array)$t3['children'])} toogle{/if}">{$t3['catname']}</a>
            </li>
            {if count((array)$t3['children'])}
            <ul{if count((array)$t3['children'])} class="open-list"{/if}>
            {loop $t3['children'] $t4}
            <li>
                <a title="{$t4['catname']}" href="{$t4['url']}" cmseasy-id="{$t4['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">{$t4['catname']}</a>
            </li>
            {/loop}
        </ul>
        {/if}
        {/loop}
    </ul>
    {/if}
    {/loop}
    </ul>
    {/if}
    {/loop}
    </ul>
    {/if}
    {/loop}
    <div class="clearfix"></div>
    </ul>
</div>
<style type="text/css">
    .sitemap-list-$_id h2 {
        font-size:$_title-size;
        color:$_title-color;
        background:$_background-color;
    }
    .sitemap-list-$_id h2:hover {
        background:$_background-hover-color;
    }
    .sitemap-list-$_id h2:hover a {
        font-size:$_title-size;
        color:$_title-color;
    }
    .sitemap-list-$_id ul.open-list .open-list-title {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .sitemap-list-$_id ul.open-list .open-list-title:hover {
        color:$_subtitle-hover-color;
    }
    .sitemap-list-$_id li a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .sitemap-list-$_id li a:hover {
        color:$_link-hover-color;
    }
</style>
