<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-relevant-txt/css/style.css" rel="stylesheet">
{if is_array($likenews)}
<div class="content-relevant content-relevant-$_id">
    <div class="content-relevant-title">
        <h4>
            {$archive['tag']}    <span class=" cmseasyedit" cmseasy-id="relatedcontent" cmseasy-table="lang" cmseasy-field="template">
                            {lang('relatedcontent')}
                        </span>
        </h4>

    </div>
    <div class="content-relevant-list">
        {loop $likenews $item}
        <div class="col-sm-$_align-number">
            <div class="row">
                <div class="content-relevant-list-item">
                    <div class="content-relevant-list-item-date">
                            <span>
                                {=sdate($item['adddate'],'d')}
                            </span>
                        <p>
                            {=sdate($item['adddate'],'Y-m')}
                        </p>
                    </div>
                    <div class="content-relevant-list-item-text">
                        <h4>
                            <a title="{$item['title']}" href="{archive::url($item)}" target="_blank" cmseasy-id="{a$item['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit ">
                                {$item['title']}
                            </a>
                        </h4>
                        <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="intro" class="cmseasyedit textarea">
                            {cut(strip_tags($item['introduce']),$_intro-number)}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {/loop}
    </div>
</div>
{/if}
<style type="text/css">
    .content-relevant-$_id {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .content-relevant-$_id .content-relevant-title h4 {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-relevant-$_id .content-relevant-title h4:hover {
        color:$_title-hover-color;
    }
    .content-relevant-$_id .content-relevant-title p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .content-relevant-$_id .content-relevant-title p:hover {
        color:$_subtitle-hover-color;
    }
    .content-relevant-$_id .content-relevant-list-item {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .content-relevant-$_id .content-relevant-list-item:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .content-relevant-$_id .content-relevant-list-text h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .content-relevant-$_id .content-relevant-list-text:hover h4 a {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
    .content-relevant-$_id .content-relevant-list-text p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-relevant-$_id .content-relevant-list-text:hover p {
        color:$_p-hover-color;
    }
</style>