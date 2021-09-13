<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<div class="row">
    <!-- Swiper -->
    <div class="swiper-container swiper-container-1">
        <div class="swiper-wrapper">
            <?php if(is_array(getslide_child(1)))
foreach(getslide_child(1) as $data) { ?>
            <div class="swiper-slide">
                <div class="slide-item">
                    <a href="<?php echo $data['slide_url'];?>" target="_blank"><img  src="<?php echo $data['slide_path'];?>" alt="<?php echo $data['slide_title'];?>"></a>
                    <div class="slide-item-text  text-left">
                        <div class="container">
                            <?php if($data['slide_title']) { ?><h2><?php echo $data['slide_title'];?></h2><?php } ?>
                            <?php if($data['slide_subtitle']) { ?><p class="text-left"><?php echo $data['slide_subtitle'];?></p><?php } ?>
                            <?php if($data['slide_url']) { ?><a href="<?php echo $data['slide_url'];?>" target="_blank" class="btn slide-btn"><?php echo $data['slide_butname'];?></a><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination swiper-pagination-1"></div>
        <div class="swiper-button-next swiper-button-next-1"><span class="glyphicon glyphicon-menu-right"></span></div>
        <div class="swiper-button-prev swiper-button-prev-1"><span class="glyphicon glyphicon-menu-left"></span></div>
    </div>
</div>
<script>
    var myswiper = new Swiper('.swiper-container-1', {
        slidesPerView: 1,
        spaceBetween: 1,
        loop: true,
        lazy: true,
        pagination: {
            el: '.swiper-pagination-1',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next-1',
            prevEl: '.swiper-button-prev-1',
        },
        autoplay: {
            delay: 5000,
            stopOnLastSlide: false,
            disableOnInteraction: true,
        },
    });
</script>
<style type="text/css">


    /* 幻灯*/
    .swiper-container-1 {
        width: 100%;
        height: 100%;
        background:#ccc;
    }
    .swiper-container-1 .slide-item {
        position: relative;
    }
    .swiper-container-1 .slide-item img {
        width: 100%;
        height: auto;
        max-width: 100%;
        max-height: 100%;
        margin:0px auto;
    }
    .swiper-container-1 .swiper-button-prev-1,
    .swiper-container-1 .swiper-button-next-1 {
        opacity: 0;
        position: absolute;
        top: 50%;
    }
    .swiper-container-1:hover .swiper-button-prev-1,
    .swiper-container-1:hover .swiper-button-next-1 {
        width:calc(50px + 30px);
        height:calc(50px + 30px);
        line-height:calc(50px + 30px);
        opacity: 1;
        transition: all .3s linear;
        background-color:rgba(0,0,0,0.5);
        background-image:none;
        font-size:50px;
        text-align:center;
        border-radius: 50px;
        color:#ffffff;
    }
    .swiper-container-1 .slide-item-text {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    .swiper-container-1 .slide-item-text h2 {
        padding: 0;
        color: #ffffff;
        font-size: 36px;
        font-style: normal;
        line-height: 1.8;

        letter-spacing: 1px;
        display: inline-block;
    }
    .swiper-container-1 .slide-item-text p {
        margin:0px auto;
        padding: 0;
        color: #ffffff;
        font-size: 20px;
        line-height: 1.6;
        font-weight: 300;
        margin-bottom: 40px;
        letter-spacing: 1px;
    }
    .swiper-container-1 .slide-item-text a.slide-btn {
        color: #ffffff;
        cursor: pointer;
        font-weight: 400;
        font-size: 14px;
        line-height: 15px;
        text-align: center;
        padding: 17px 30px;
        white-space: nowrap;
        letter-spacing: 1px;
        background: #00b7ee;
        display: inline-block;
        text-decoration: none;
        text-transform: uppercase;
        border: none;
        -webkit-animation-delay: 2s;
        animation-delay: 2s;
        -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
        transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
    }
    .swiper-container-1 .slide-item-text a.slide-btn:hover,
    .swiper-container-1 .slide-item-text a.slide-btn:active {
        color: #ffffff;
        background: #222222;
        -webkit-transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
        transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
    }
    .swiper-container-1 .slide-item-text h2 {
        transition: all 500ms ease-in-out 1000ms;
        position: relative;
        left: 50%;
        opacity: 0;
    }
    .swiper-container-1 .slide-item-text p {
        transition: all 800ms ease-in-out 1500ms;
        position: relative;
        left: 50%;
        opacity: 0;
    }
    .swiper-container-1 .slide-item-text a {
        transition: all 1200ms ease-in-out 2000ms;
        position: relative;
        left: 25%;
        opacity: 0;
    }
    .swiper-container-1 .swiper-slide-active .slide-item-text h2 {
        left: 0;
        opacity: 1;
    }
    .swiper-container-1 .swiper-slide-active .slide-item-text p {
        left: 0;
        opacity: 1;
    }
    .swiper-container-1 .swiper-slide-active .slide-item-text a {
        left: 0;
        opacity: 1;
    }



    .swiper-container-1 .slide-item-text h2 {
        font-size:36px;
    }
    .swiper-container-1 .slide-item-text p {
        font-size:20px;
    }
    .swiper-container-1 .slide-item-text h2,
    .swiper-container-1 .slide-item-text p{
        color:#ffffff;
    }
    .swiper-container-1 .slide-item-text a.slide-btn {
        background:#00b7ee;
        color:#ffffff;
    }
    .swiper-pagination-1 .swiper-pagination-bullet {
        width:50px;
        height:10px;
        background:#ffffff;
        opacity: 1;
        transition: all .3s linear;
        border-radius: 0;
    }
    .swiper-pagination-1 .swiper-pagination-bullet-active{
        background:#00b7ee;
    }
    .swiper-container-1  .swiper-button-prev-1,
    .swiper-container-1  .swiper-button-next-1{
        color:#ffffff;
        font-size:50px;
        width:50px;
        height:50px;
    }
</style>


