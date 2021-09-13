$(function(){
    //点击菜单箭头变化
    $(".menu-list-categroy .sidebar-menu a").each(function(){
        $(this).click(function(){
            var Oele = $(this).children('.menu-expand');
            if($(Oele)){
                if($(Oele).hasClass('glyphicon-chevron-right')){
                    $(Oele).removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
                }else{
                    $(Oele).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
                }
            }

            //选中增加active
            if(! $(this).hasClass('panel-heading')){
                $(".menu-list-categroy .sidebar-menu a").removeClass('active');
                $(this).addClass('active');
            }
        });
    });
})