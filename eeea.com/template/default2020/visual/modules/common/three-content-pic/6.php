<link href="{$template_path}/visual/modules/common/three-content-pic/css/style-3.css" rel="stylesheet">
<div class="col-md-12">
    <div class="three-content-pic-content three-content-pic-content-$_id">
    <div class="row">
        {loop archive($_catid,$_typeid,$_spid,$_area,$_length,$_ordertype,$_limit,$_image,$_attr1,$_son,$_wheretype,$_tpl,$_intro_len,$_istop) $archive}
        <div class="col-sm-4">
            <div class="three-content-pic-content-item">
                <div class="three-content-pic-content-img">
                    <a title="{$archive['stitle']}" href="{$archive['url']}">
                        <img alt="{$archive['stitle']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="thumb" class="cmseasyeditimg lazy" src="{$archive['thumb']}" />
                    </a>
                </div>
                <div class="three-content-pic-content-text">
                    <span>{=sdate($archive['adddate'],'Y.m.d')}</span>
                    <h4>
                        <a title="{$archive['stitle']}" href="{$archive['url']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit ">
                            {$archive['title']}
                        </a>
                    </h4>
                    <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="adddate" class="cmseasyedit content ">
                        {$archive['intro']}
                    </p>
                </div>
            </div>
        </div>
        {/loop}
    </div>
</div>
</div>
<style type="text/css">
    .three-content-pic-content-$_id .three-content-pic-content-item .three-content-pic-content-text h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item:hover .three-content-pic-content-text h4 a,
    .three-content-pic-content-$_id .three-content-pic-content-item .three-content-pic-content-text h4 a:hover {
        color:$_link-hover-color;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item .three-content-pic-content-text span {
        color:$_link-color;
        font-size:$_p-size;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item:hover .three-content-pic-content-text span {
        color:$_link-hover-color;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item .three-content-pic-content-text p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item:hover .three-content-pic-content-text p,
    .three-content-pic-content-$_id .three-content-pic-content-item .three-content-pic-content-text p:hover {
        color:$_p-hover-color;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item .three-content-pic-content-text .more {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background-color:$_btn-background-color ;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item .three-content-pic-content-text .more:hover,
    .three-content-pic-content-$_id .three-content-pic-content-item:hover .three-content-pic-content-text .more  {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        background-color:$_btn-background-hover-color;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item {
        border-color:$_link-border-color;
        background-color:$_background-color;
    }
    .three-content-pic-content-$_id .three-content-pic-content-item:hover {
        border-color:$_link-hover-border-color;
        background-color:$_background-hover-color;
    }
</style>