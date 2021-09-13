<link href="{$template_path}/visual/modules/common/about-three/css/style-2.css" rel="stylesheet">
<div class="col-md-12">
    <div class="about-three-right">
    <div class="swiper-container about-slide-nav about-slide-nav-$_id">
        <div class="swiper-wrapper">
            {loop archive($_catid,$_typeid,$_spid,$_area,$_length,$_ordertype,$_limit,$_image,$_attr1,$_son,$_wheretype,$_tpl,$_intro_len,$_istop) $archive}
            <div class="swiper-slide">
                <div cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit about-slide-nav-tiem">
                    {$archive['title']}
                </div>
            </div>
            {/loop}
        </div>
    </div>
    <div class="swiper-container about-slide-content">
        <div class="swiper-wrapper">
            {loop archive($_catid,$_typeid,$_spid,$_area,$_length,$_ordertype,$_limit,$_image,$_attr1,$_son,$_wheretype,$_tpl,$_intro_len,$_istop) $archive}
            <div class="swiper-slide">
                <div class="about-slide-content-item">
                    <div class="about-three-right-img">
                        <a title="{$archive['stitle']}" href="{$archive['url']}">
                            <img cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="content" class="cmseasyeditimg swiper-lazy" src="{$archive['thumb']}" />
                        </a>
                    </div>
                    <div class="about-three-right-text about-three-right-text-$_id">
                        <div class="about-three-right-text2 about-three-right-text2-$_id">
                            <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="intro" class="cmseasyedit textarea">
                                {$archive['intro']}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {/loop}
        </div>
    </div>
</div>
</div>
<script src="{$template_path}/visual/modules/common/about-three/js/about-three.js" type="text/javascript"></script>
<style type="text/css">
    .about-three-right-text-$_id .about-three-right-text2 p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .about-three-right-text-$_id .about-three-right-text2 p:hover {
        color:$_p-hover-color;
    }
    .about-three-right-text2-$_id:before{background: url({$template_path}/visual/modules/common/about-three/images/1.png) center center no-repeat;}
    .about-three-right-text2-$_id:after{background: url({$template_path}/visual/modules/common/about-three/images/2.png) center center no-repeat;}
</style>