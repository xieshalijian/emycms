<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-pic/css/style.css" rel="stylesheet">

<div class="swiper-container content-picture content-picture-$_id">
    <div class="swiper-wrapper">
        {loop $archive['pics'] $i $pic}
        <div class="swiper-slide">
            <div class="content-picture-tiem">
                <img cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="pics" class="cmseasyedit img " src="{$pic['url']}" alt="{$pic['alt']}">
            </div>
        </div>
        {/loop}
    </div>
    <div class="swiper-pagination content-pagination"></div>
</div>
<style type="text/css">
    .content-picture-$_id .swiper-pagination-bullet {
        width:$_width;
        height:$_height;
        padding:0px !important;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
        opacity:1 !important;
    }
    .content-picture-$_id .swiper-pagination-bullet-active {
        padding:0px !important;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
        opacity:1 !important;
    }
</style>
<script type="text/javascript">
    <!--
    var myswiper = new Swiper('.content-picture-$_id', {
        slidesPerView: 1,
        spaceBetween : 10,
        pagination: {
            el: '.swiper-pagination',
        },
        lazy: true,
        loop: true,
    });
    //-->
</script>

