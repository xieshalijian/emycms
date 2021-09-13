<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/friendlink-logo/css/style.css" rel="stylesheet">


<div class="friendlink-logo friendlink-logo-$_id">
    {if count(friendlink('image',0,99))>0}
    <h5>{lang('links')}</h5>
    <div class="swiper-container friendlink-logo-swiper">
        <div class="swiper-wrapper">
            {loop friendlink('image',0,99) $flink}
            <div class="swiper-slide friendlink-logo-item">
                <a href="{$flink['url']}" title="{$flink['name']}" target="_blank"><img src="{$flink['logo']}" class="img-responsive"></a>
            </div>
            {/loop}
        </div>
        <div class="swiper-pagination friendlink-logo-swiper-pagination"></div>
    </div>
    {/if}
</div>

<script type="text/javascript">
    var mySwiper = new Swiper ('.friendlink-logo-swiper', {
        loop: true,
        slidesPerView : 10,
        slidesPerGroup : 1,
        spaceBetween : 10,
        lazy: true,
        grabCursor: true,
        autoHeight: true,
        breakpointsInverse: true,
        breakpoints: {
            320: {slidesPerView: 1,slidesPerGroup : 1,},
            480: {slidesPerView: 2,slidesPerGroup : 2,},
            768: {slidesPerView: 4,slidesPerGroup : 4,},
            992: {slidesPerView: 6,slidesPerGroup : 10,},
            1200: {slidesPerView: 10,slidesPerGroup : 10,},
        },
        pagination: {el: '.friendlink-logo-swiper-pagination',clickable: true,},
    });
</script>

<style type="text/css">
.visual_flash-$_id {
    height: $_height;
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual_flash-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
</style>