

<link href="{$template_path}/visual/modules/common/three-content-and-btn/css/style-3.css" rel="stylesheet">
<div class="row">
{loop archive($_catid,$_typeid,$_spid,$_area,$_length,$_ordertype,$_limit,$_image,$_attr1,$_son,$_wheretype,$_tpl,$_intro_len,$_istop) $archive}
<div class="col-sm-4">
    <div class="three-content-and-btn-item three-content-and-btn-item three-content-and-btn-item-$_id">
        <div class="three-content-and-btn-img">
            <a href="{$archive['url']}" cmseasy-table="archive" cmseasy-field="thumb" class="cmseasyeditimg f-common-0005-img" cmseasy-id="{$archive['aid']}">
                <img src="{$archive['thumb']}" alt="{$archive['stitle']}">
            </a>
        </div>
        <div class="three-content-and-btn-text">

            <h4>
                <a title="{$archive['stitle']}" href="{$archive['url']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit ">
                    {$archive['title']}
                </a>
            </h4>
            <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="intro" class="cmseasyedit textarea">
                {$archive['intro']}
            </p>

        </div>
        <div class="three-content-and-btn-text2">
            <a href="{$archive['url']}" class="more">more  &gt;</a>
        </div>
    </div>
</div>
{/loop}
</div>


<style>
    .three-content-and-btn-item-$_id .three-content-and-btn-text h4,
    .three-content-and-btn-item-$_id .three-content-and-btn-text h4 a {
        color:$_link-color;
        border-color:$_link-border-color;
        background-color:$_link-background-color;
        font-size:$_link-font-size;
        border-radius:$_link-border-radius;
    }
    .three-content-and-btn-item-$_id .three-content-and-btn-text h4 a:hover,
    .three-content-and-btn-item-$_id:hover .three-content-and-btn-text h4 a  {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
    }
    .three-content-and-btn-item-$_id .three-content-and-btn-text p {
        font-size:$_p-size;
    }


    .three-content-and-btn-item-$_id .three-content-and-btn-text p:hover,
    .three-content-and-btn-item-$_id:hover .three-content-and-btn-text p {
        color:$_p-hover-color;
    }
    .three-content-and-btn-item-$_id {
        background:#FFFFFF;
    }
    .three-content-and-btn-item-$_id:hover {
        background:$_background-hover-color;
    }
    .three-content-and-btn-item-$_id .three-content-and-btn-text2 .more {
        border-radius:$_btn-border-radius;
        color:$_btn-text-color;
        font-size:$_btn-size;
        background:$_btn-background-color;
        border-color:$_btn-border-color;
    }

    .three-content-and-btn-item-$_id .three-content-and-btn-text2 .more:hover,
    .three-content-and-btn-item-$_id:hover .three-content-and-btn-text2 .more {
        border-radius:$_btn-border-hover-radius;
        color:#333;
        background:$_btn-background-hover-color;
        border-color:$_btn-border-hover-color;
    }
</style>



