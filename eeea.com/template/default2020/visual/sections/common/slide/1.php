<div class="row">
    <!-- Swiper -->
    <div class="swiper-container swiper-container-$_id">
        <div class="swiper-wrapper">
            {loop getslide_child($_id) $data}
            <div class="swiper-slide">
                <div class="slide-item">
                    <a href="{$data['slide_url']}" target="_blank"><img  src="{$data['slide_path']}" alt="{$data['slide_title']}"></a>
                    <div class="slide-item-text  $_slide_style_position">
                        <div class="container">
                            {if $data['slide_title']}<h2>{$data['slide_title']}</h2>{/if}
                            {if $data['slide_subtitle']}<p class="$_slide_style_position">{$data['slide_subtitle']}</p>{/if}
                            {if $data['slide_url']}<a href="{$data['slide_url']}" target="_blank" class="btn slide-btn">{$data['slide_butname']}</a>{/if}
                        </div>
                    </div>
                </div>
            </div>
            {/loop}
        </div>
        <div class="swiper-pagination swiper-pagination-$_id"></div>
        <div class="swiper-button-next swiper-button-next-$_id"><span class="glyphicon glyphicon-menu-right"></span></div>
        <div class="swiper-button-prev swiper-button-prev-$_id"><span class="glyphicon glyphicon-menu-left"></span></div>
    </div>
</div>
<script>
    var myswiper = new Swiper('.swiper-container-$_id', {
        slidesPerView: 1,
        spaceBetween: 1,
        loop: true,
        lazy: true,
        pagination: {
            el: '.swiper-pagination-$_id',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next-$_id',
            prevEl: '.swiper-button-prev-$_id',
        },
        autoplay: {
            delay: $_slide_time000,
            stopOnLastSlide: false,
            disableOnInteraction: true,
        },
    });
</script>
<style type="text/css">


    /* 幻灯*/
    .swiper-container-$_id {
        width: 100%;
        height: 100%;
        background:#ccc;
    }
    .swiper-container-$_id .slide-item {
        position: relative;
    }
    .swiper-container-$_id .slide-item img {
        width: 100%;
        height: auto;
        max-width: 100%;
        max-height: 100%;
        margin:0px auto;
    }
    .swiper-container-$_id .swiper-button-prev-$_id,
    .swiper-container-$_id .swiper-button-next-$_id {
        opacity: 0;
        position: absolute;
        top: 50%;
    }
    .swiper-container-$_id:hover .swiper-button-prev-$_id,
    .swiper-container-$_id:hover .swiper-button-next-$_id {
        width:calc($_slide_button_size + 30px);
        height:calc($_slide_button_size + 30px);
        line-height:calc($_slide_button_size + 30px);
        opacity: 1;
        transition: all .3s linear;
        background-color:rgba(0,0,0,0.5);
        background-image:none;
        font-size:$_slide_button_size;
        text-align:center;
        border-radius: 50px;
        color:$_slide_button_color;
    }
    .swiper-container-$_id .slide-item-text {
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
    .swiper-container-$_id .slide-item-text h2 {
        padding: 0;
        color: $_slide_text_color;
        font-size: $_slide_title_size;
        font-style: normal;
        line-height: 1.8;

        letter-spacing: 1px;
        display: inline-block;
    }
    .swiper-container-$_id .slide-item-text p {
        margin:0px auto;
        padding: 0;
        color: $_slide_text_color;
        font-size: $_slide_subtitle_size;
        line-height: 1.6;
        font-weight: 300;
        margin-bottom: 40px;
        letter-spacing: 1px;
    }
    .swiper-container-$_id .slide-item-text a.slide-btn {
        color: $_slide_input_color;
        cursor: pointer;
        font-weight: 400;
        font-size: 14px;
        line-height: 15px;
        text-align: center;
        padding: 17px 30px;
        white-space: nowrap;
        letter-spacing: 1px;
        background: $_slide_input_bg;
        display: inline-block;
        text-decoration: none;
        text-transform: uppercase;
        border: none;
        -webkit-animation-delay: 2s;
        animation-delay: 2s;
        -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
        transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
    }
    .swiper-container-$_id .slide-item-text a.slide-btn:hover,
    .swiper-container-$_id .slide-item-text a.slide-btn:active {
        color: #ffffff;
        background: #222222;
        -webkit-transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
        transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
    }
    .swiper-container-$_id .slide-item-text h2 {
        transition: all 500ms ease-in-out 1000ms;
        position: relative;
        left: 50%;
        opacity: 0;
    }
    .swiper-container-$_id .slide-item-text p {
        transition: all 800ms ease-in-out 1500ms;
        position: relative;
        left: 50%;
        opacity: 0;
    }
    .swiper-container-$_id .slide-item-text a {
        transition: all 1200ms ease-in-out 2000ms;
        position: relative;
        left: 25%;
        opacity: 0;
    }
    .swiper-container-$_id .swiper-slide-active .slide-item-text h2 {
        left: 0;
        opacity: 1;
    }
    .swiper-container-$_id .swiper-slide-active .slide-item-text p {
        left: 0;
        opacity: 1;
    }
    .swiper-container-$_id .swiper-slide-active .slide-item-text a {
        left: 0;
        opacity: 1;
    }



    .swiper-container-$_id .slide-item-text h2 {
        font-size:$_slide_title_size;
    }
    .swiper-container-$_id .slide-item-text p {
        font-size:$_slide_subtitle_size;
    }
    .swiper-container-$_id .slide-item-text h2,
    .swiper-container-$_id .slide-item-text p{
        color:$_slide_text_color;
    }
    .swiper-container-$_id .slide-item-text a.slide-btn {
        background:$_slide_input_bg;
        color:$_slide_input_color;
    }
    .swiper-pagination-$_id .swiper-pagination-bullet {
        width:$_slide_btn_width;
        height:$_slide_btn_height;
        background:$_slide_btn_color;
        opacity: 1;
        transition: all .3s linear;
        $_slide_btn_shape
    }
    .swiper-pagination-$_id .swiper-pagination-bullet-active{
        background:$_slide_btn_hover_color;
    }
    .swiper-container-$_id  .swiper-button-prev-$_id,
    .swiper-container-$_id  .swiper-button-next-$_id{
        color:$_slide_button_color;
        font-size:$_slide_button_size;
        width:$_slide_button_size;
        height:$_slide_button_size;
    }
</style>


