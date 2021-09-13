<link href="{$template_path}/visual/modules/common/scroll-columns-list/css/style.css" rel="stylesheet">

<div class="col-md-12">
    <div class="swiper-container scroll-columns-list-swiper scroll-columns-list-swiper-$_id">
        <div class="swiper-wrapper">
            {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
            {loop categories($cat['catid']) $cat}
            <div class="swiper-slide scroll-columns-list-item">
                <div class="scroll-columns-list-img">
                    <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank">
                        <img alt="{$cat['catname']}" src="{$cat['image']}" class="cmseasyeditimg" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="image" />
                    </a>
                </div>
                <div class="scroll-columns-list-text">
                    <h4>
                        <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank">
                            <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
                {$cat['htmldir']}
            </span>
                            <strong cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
                                {$cat['catname']}
                            </strong>
                        </a>
                    </h4>
                    {if $cat['subtitle']}
                    <span class="scroll-columns-list-text-subtitle cmseasyedit" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">
                        {$cat['subtitle']}
                    </span>
                    {/if}
                    <div cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="categorycontent" class="scroll-columns-list-text-p cmseasyedit content ">
                        {cut(strip_tags($cat['categorycontent']),$_textnum)}
                    </div>

                    <a class="more">
                        <span class=" cmseasyedit" cmseasy-id="more" cmseasy-table="lang" cmseasy-field="template">
                        {langtemplate_more}
                        </span>
                    </a>

                </div>
            </div>
            {/loop}
            {/loop}
        </div>
        <div class="swiper-pagination scroll-columns-list-swiper-pagination"></div>
    </div>
</div>
<script src="{$template_path}/visual/modules/common/scroll-columns-list/js/scroll-columns-list.js" type="text/javascript"></script>
<style type="text/css">
    .scroll-columns-list-swiper-$_id .scroll-columns-list-item .scroll-columns-list-text h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .scroll-columns-list-swiper-$_id .scroll-columns-list-item .scroll-columns-list-text h4 a:hover {
        color:$_link-hover-color;
    }
    .scroll-columns-list-swiper-$_id .scroll-columns-list-item .scroll-columns-list-text-p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .scroll-columns-list-swiper-$_id .scroll-columns-list-item .scroll-columns-list-text-p:hover {
        color:$_p-hover-color;
    }
    .scroll-columns-list-swiper-$_id .scroll-columns-list-item .scroll-columns-list-text {
        border:$_border
    }
    .scroll-columns-list-swiper-$_id .scroll-columns-list-item .scroll-columns-list-text .more {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background-color:$_btn-background-color ;
    }
    .scroll-columns-list-swiper-$_id .scroll-columns-list-item .scroll-columns-list-text .more:hover,
    .scroll-columns-list-swiper-$_id .s1-item-2:hover .scroll-columns-list-text .more  {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        background-color:$_btn-background-hover-color;
    }

</style>
