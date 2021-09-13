<link href="{$template_path}/visual/modules/common/scroll-pic-list/css/style-3.css" rel="stylesheet">
<div class="col-md-12">
    <div class="swiper-container scroll-pic-list-swiper scroll-pic-list-swiper-$_id">
        <div class="swiper-wrapper">
            {loop archive($_catid,$_typeid,$_spid,$_area,$_length,$_ordertype,$_limit,$_image,$_attr1,$_son,$_wheretype,$_tpl,$_intro_len,$_istop) $i $archive}
            <div class="swiper-slide scroll-pic-list-swiper-item">
                <a title="{$archive['stitle']}" href="{$archive['url']}">
                    <img alt="{$archive['stitle']}" src="{$archive['thumb']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="thumb" class="cmseasyeditimg swiper-lazy" />
                </a>
            </div>
            {/loop}
        </div>
        <div class="swiper-pagination scroll-pic-list-swiper-pagination-$_id"></div>
    </div>
</div>

<script src="{$template_path}/visual/modules/common/scroll-pic-list/js/scroll-pic-list.js" type="text/javascript"></script>
<style type="text/css">
    .scroll-pic-list-swiper-$_id .scroll-pic-list-swiper-item {
        border:$_link-border-color;
    }
    .scroll-pic-list-swiper-$_id .scroll-pic-list-swiper-item:hover {
        border:$_link-border-hover-color;
    }

</style>