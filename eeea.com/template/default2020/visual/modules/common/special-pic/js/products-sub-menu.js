$(document).ready(function(){
    $(".loop-products-banner-nav").mouseover(function(){
        $(".loop-products-banner-nav .loop-products-shop-nav").show();
    });
    $(".loop-products-banner-nav").mouseleave(function(){
        $(".loop-products-banner-nav .loop-products-shop-nav").hide();
    });
    $(function() {
        $('.loop-products-banner-nav .loop-products-shop-nav').on('mouseenter', function() {
            $(".loop-products-nav_right").removeClass('hide');
        }).on('mouseleave', function() {
            $(".loop-products-nav_right").addClass('hide');
            $(".loop-products-nav_right_sub").addClass('hide');
        }).on('mouseenter', 'li', function(e) {
            var li_data = $(this).attr('data-id');
            $(".loop-products-nav_right_sub").addClass('hide');
            $('.loop-products-nav_right_sub[data-id="' + li_data + '"]').removeClass('hide');
        })
    })
});