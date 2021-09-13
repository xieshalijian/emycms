

(function ($) {
    "use strict";

    $(document).ready(function () {
		$(".dropdown-button").dropdown();
		$("#visual-left-btn").click(function(){
			if($(this).hasClass('closed')){
				$('.visual-left').animate({left: '-330px'});
				$(this).removeClass('closed');
				$('#visual-right').animate({'margin-left' : '0px'});
				$('#visual-top').animate({'margin-left' : '0px'});
				$('#visual-bottom').animate({'margin-left' : '0px'});
				$('#visual-left-btn').animate({left: '50px'});
			}
			else{
			    $(this).addClass('closed');
				$('.visual-left').animate({left: '0px'});
				$('#visual-left-btn').animate({left: '330px'});
				$('#visual-right').animate({'margin-left' : '330px'});
				$('#visual-top').animate({'margin-left' : '330px'});
				$('#visual-bottom').animate({'margin-left' : '330px'});
			}
            //组件加载
            if ($(this).data("name")=="load_modules"){
				setTimeout("load_modules()",500);
            }
		});

		$(".nav-tabs-a a").click(function(){
			if(!$("#visual-left-btn").hasClass('closed')){
				$("#visual-left-btn").addClass('closed');
				$('.visual-left').animate({left: '0px'});
				$('#visual-left-btn').animate({left: '330px'});
				$('#visual-right').animate({'margin-left' : '330px'});
				$('#visual-top').animate({'margin-left' : '330px'});
				$('#visual-bottom').animate({'margin-left' : '330px'});
			}
			//组件加载
			if ($(this).data("name")=="load_modules"){
				setTimeout("load_modules()",500);
			}
			//模板加载
			if ($(this).data("name")=="load_modular"){
				setTimeout("load_modular()",500);
			}
			//布局加载
			if ($(this).data("name")=="load_layouts"){
				setTimeout("load_layouts()",500);
			}
			//组件市场加载
			if ($(this).data("name")=="load_buymodules"){
				setTimeout("load_buymodules()",500);
			}
		});

		//层属性打开
		$('body.edit .visual-right').on("click","[data-target='#div-config']",function(e) {
			//边栏收缩
			if($("#visual-left-btn").hasClass('closed')){
				$('.visual-left').animate({left: '-330px'});
				$("#visual-left-btn").removeClass('closed');
				$('#visual-right').animate({'margin-left' : '0px'});
				$('#visual-top').animate({'margin-left' : '0px'});
				$('#visual-bottom').animate({'margin-left' : '0px'});
				$('#visual-left-btn').animate({left: '50px'});
			}
		});
		//栏目打开
		$('body.edit .visual-right').on("click","[data-target='#template-category-tag']",function(e) {
			//边栏收缩
			if($("#visual-left-btn").hasClass('closed')){
				$('.visual-left').animate({left: '-330px'});
				$("#visual-left-btn").removeClass('closed');
				$('#visual-right').animate({'margin-left' : '0px'});
				$('#visual-top').animate({'margin-left' : '0px'});
				$('#visual-bottom').animate({'margin-left' : '0px'});
				$('#visual-left-btn').animate({left: '50px'});

			}
		});
		//商品栏目打开
		$('body.edit .visual-right').on("click","[data-target='#template-category-shop-tag']",function(e) {
			//边栏收缩
			if($("#visual-left-btn").hasClass('closed')){
				$('.visual-left').animate({left: '-330px'});
				$("#visual-left-btn").removeClass('closed');
				$('#visual-right').animate({'margin-left' : '0px'});
				$('#visual-top').animate({'margin-left' : '0px'});
				$('#visual-bottom').animate({'margin-left' : '0px'});
				$('#visual-left-btn').animate({left: '50px'});

			}
		});
		//内容打开
		$('body.edit .visual-right').on("click","[data-target='#template-content-tag']",function(e) {
			//边栏收缩
			if($("#visual-left-btn").hasClass('closed')){
				$('.visual-left').animate({left: '-330px'});
				$("#visual-left-btn").removeClass('closed');
				$('#visual-right').animate({'margin-left' : '0px'});
				$('#visual-top').animate({'margin-left' : '0px'});
				$('#visual-bottom').animate({'margin-left' : '0px'});
				$('#visual-left-btn').animate({left: '50px'});

			}
		});
		//商品内容打开
		$('body.edit .visual-right').on("click","[data-target='#template-content-shop-tag']",function(e) {
			//边栏收缩
			if($("#visual-left-btn").hasClass('closed')){
				$('.visual-left').animate({left: '-330px'});
				$("#visual-left-btn").removeClass('closed');
				$('#visual-right').animate({'margin-left' : '0px'});
				$('#visual-top').animate({'margin-left' : '0px'});
				$('#visual-bottom').animate({'margin-left' : '0px'});
				$('#visual-left-btn').animate({left: '50px'});

			}
		});
    });

	//$(".dropdown-button").dropdown();
	
}(jQuery));
