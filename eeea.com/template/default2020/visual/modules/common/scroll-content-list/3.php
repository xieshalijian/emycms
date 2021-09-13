<link href="{$template_path}/visual/modules/common/scroll-content-list/css/style-3.css" rel="stylesheet">
<div class="col-md-12">
    <div class="swiper-container scroll-content-list-container scroll-content-list-container-$_id">
        <div class="swiper-wrapper">
            {loop archive($_catid,$_typeid,$_spid,$_area,$_length,$_ordertype,$_limit,$_image,$_attr1,$_son,$_wheretype,$_tpl,$_intro_len,$_istop) $archive}
            <div class="swiper-slide scroll-content-list-item">
                <div class="scroll-content-list-img">

                    <a title="{$archive['stitle']}" href="{$archive['url']}">
                        <img alt="{$archive['stitle']}" src="{$archive['thumb']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="thumb" class="cmseasyeditimg lazy" />
                    </a>

                </div>
                <div class="scroll-content-list-text">

                    <h4>
                        <a title="{$archive['stitle']}" href="{$archive['url']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit ">
                            {$archive['title']}
                        </a>
                    </h4>

                    <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="subtitle" class="cmseasyedit ">
                        {$archive['subtitle']}
                    </p>

                    <div class="clearfix products-buy">
                            <span class="pull-left"{if config::get('show_pice')==0 } style="display:none;"{/if}>
                                {lang('unit')} {$archive['oldprice']}
                            </span>
                        <span class="pull-right">
                                <a class="add-to-cart" onclick="buyshop('{url('archive/doorders/aid/',true)}','{url('archive/getarchiveType',false)}','{$archive['aid']}')">
                                    <i class="btnCart icon-basket"></i>
                                </a>
                                {getcollect($archive['aid'])}
                            </span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            {/loop}
        </div>
        <div class="swiper-pagination scroll-content-list-container-pagination"></div>
    </div>
</div>

<script type="text/javascript">
    var mySwiper = new Swiper ('.scroll-content-list-container', {
        loop: true,
        slidesPerView : $_list-number,
        slidesPerGroup : $_list-number,
        spaceBetween : 10,
        grabCursor: true,
        autoHeight: true,
        navigation: {nextEl: '.scroll-content-list-container-button-next',prevEl: '.scroll-content-list-container-button-prev',},
        pagination: {el: '.scroll-content-list-container-pagination',clickacla: true,},
    });
</script>
<style type="text/css">
    .scroll-content-list-container-$_id .scroll-content-list-item .scroll-content-list-text h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-item .scroll-content-list-text h4 a:hover {
        color:$_link-hover-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-item .scroll-content-list-text p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-item .scroll-content-list-text p:hover {
        color:$_p-hover-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .more {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background-color:$_btn-background-color ;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .more:hover,.scroll-content-list-container .scroll-content-list-item:hover .scroll-content-list-text .more  {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        background-color:$_btn-background-hover-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .products-buy .pull-left {
        font-size:$_price-size;
        color:$_price-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .products-buy .pull-left:hover {
        color:$_price-hover-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .products-buy .pull-right a i {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .products-buy .pull-right .content-collection i {
        font-size:$_btn-size;
        color:$_btn-text-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .products-buy .pull-right a.add-to-cart:hover i {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
    .scroll-content-list-container-$_id .scroll-content-list-text .products-buy .pull-right .content-collection:hover i,
    .scroll-content-list-container-$_id .scroll-content-list-text .products-buy .pull-right .content-collection i.glyphicon-heart {
        color:$_btn-background-hover-color;
    }
</style>