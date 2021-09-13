<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-relevant-pic/css/style.css" rel="stylesheet">



{if is_array($likenews)}
<div class="content-relevant content-relevant-$_id">
    <div class="content-relevant-title">
        <h4>
            {$archive['tag']}   <span class=" cmseasyedit" cmseasy-id="relatedcontent" cmseasy-table="lang" cmseasy-field="template">
                            {lang('relatedcontent')}
                        </span>
        </h4>

    </div>
    <div class="content-relevant-list-pic">
        <div class="row">
            {loop $likenews $item}
            <div class="col-sm-$_align-number">
                <div class="content-relevant-list-pic-item">
                    <div class="content-relevant-list-pic-img">
                        <a class="img-auto" href="{$item#['url']}" target="_blank">
                            <img alt="{$item['stitle']}" src="{$item['thumb']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="thumb" class="cmseasyedit img" />
                        </a>
                    </div>
                    <div class="content-relevant-list-pic-text">
                        <h4>
                            <a title="{$item['title']}" href="{archive::url($item)}" target="_blank" cmseasy-id="{a$item['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit ">
                                {$item['title']}
                            </a>
                        </h4>
                        <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="intro" class="cmseasyedit textarea">
                            {cut(strip_tags($item['introduce']),$_intro-number)}
                        </p>
                    </div>
                    <div class="content-relevant-list-pic-more">
                        <a href="{$item['url']}" target="_blank">
                                        <span class=" cmseasyedit" cmseasy-id="more" cmseasy-table="lang" cmseasy-field="template">
                                            {lang('more')}
                                        </span>
                        </a>
                    </div>
                </div>
            </div>
            {/loop}
        </div>
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
    .content-relevant-$_id .content-relevant-list-pic-item {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .content-relevant-$_id .content-relevant-list-pic-item:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .content-relevant-$_id .content-relevant-list-pic-text h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .content-relevant-$_id .content-relevant-list-pic-text:hover h4 a {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
    .content-relevant-$_id .content-relevant-list-pic-text p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-relevant-$_id .content-relevant-list-pic-text:hover p {
        color:$_p-hover-color;
    }
    .content-relevant-$_id .content-relevant-list-pic-more a {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-relevant-$_id .content-relevant-list-pic-item:hover .content-relevant-list-pic-more a {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>
