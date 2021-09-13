<link href="{$template_path}/visual/modules/common/left-pic-and-right-content/css/style-3.css" rel="stylesheet">
<div class="left-pic-and-right-content-left left-pic-and-right-content-left-$_id">
    {loop archive($_catid,$_typeid,$_spid,$_area,$_length,$_ordertype,$_limit,$_image,$_attr1,$_son,$_wheretype,$_tpl,$_intro_len,$_istop) $i $archive}
    <div class="left-pic-and-right-content-left-img">
        <a title="{$archive['stitle']}" href="{$archive['url']}">
            <img alt="{$archive['stitle']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="thumb" class="cmseasyeditimg lazy" src="{$archive['thumb']}" />
        </a>
    </div>
    <div class="left-pic-and-right-content-left-text">
        <div class="left-pic-and-right-content-item">
            <div class="left-pic-and-right-content-date">
                <h4>{=sdate($archive['adddate'],'Y')}</h4>
                <p>{=sdate($archive['adddate'],'m-d')}</p>
            </div>
            <div class="left-pic-and-right-content-text">
                <h4>
                    <a title="{$archive['stitle']}" href="{$archive['url']}"  cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit ">
                        {$archive['title']}
                    </a>
                </h4>
                <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="content" class="cmseasyedit content ">
                    {$archive['intro']}
                </p>
            </div>
        </div>
    </div>
    {/loop}
</div>
<style>
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item .left-pic-and-right-content-text h4,
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item .left-pic-and-right-content-text h4 a {
        color:$_link-color;
        border-color:$_link-border-color;
        background-color:$_link-background-color;
        font-size:$_link-font-size;
        border-radius:$_link-border-radius;
    }
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item .left-pic-and-right-content-text h4 a:hover,
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item:hover .left-pic-and-right-content-text h4 a  {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
    }
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item .left-pic-and-right-content-text p {
        color:$_p-color;
        font-size:$_p-size;
    }
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item .left-pic-and-right-content-text p:hover,
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item:hover .left-pic-and-right-content-text p {
        color:$_p-hover-color;
    }
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item {
        background:$_background-color;
    }
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item:hover {
        background:$_background-hover-color;
    }
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item .left-pic-and-right-content-text2 .more {
        border-radius:$_btn-border-radius;
        color:$_btn-text-color;
        font-size:$_btn-size;
        background:$_btn-background-color;
        border-color:$_btn-border-color;
    }
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item .left-pic-and-right-content-text2 .more:hover,
    .left-pic-and-right-content-left-$_id .left-pic-and-right-content-item:hover .left-pic-and-right-content-text2 .more {
        border-radius:$_btn-border-hover-radius;
        color:#333;
        background:$_btn-background-hover-color;
        border-color:$_btn-border-hover-color;
    }
</style>
