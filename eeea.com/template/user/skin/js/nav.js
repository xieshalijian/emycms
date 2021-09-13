$(document).ready(function(){


    $(window).scroll(function () 
    {
        var htmlTop = $(document).scrollTop();
        if ( htmlTop > 10) {
            $("#nav").addClass("mini");
        }
        else {
            $("#nav").removeClass("mini");
        }
    });


	var _width = $(window).width(); 

	if(_width < 768){			
		$("#nav a.toogle,.s1-menu a.toogle").click(function(){
			event.preventDefault();
		});
		 
			$(".nav-btn").click(function(){
				if ($("#nav .nav1").is(":hidden")){
					$(this).addClass("open");
					$("#nav .nav1").slideDown();
				}else{			
					$(this).removeClass("open");
					$("#nav .nav1").slideUp();
					$("#nav .nav2").slideUp();
					$("#nav .nav3").slideUp();
					$("#nav .nav4").slideUp();
					$("#nav .nav5").slideUp();
				}
			});
			$("#nav .one a.aa").click(function(){
				if ($(this).siblings("#nav .nav2").is(":hidden")){
					$("#nav .nav2").slideUp();
					$("#nav .nav1 a").removeClass("on");
					$(this).addClass("on");
					$(this).siblings("#nav .nav2").slideDown();
					$("#nav .nav3").slideUp();
					$("#nav .nav4").slideUp();
					$("#nav .nav5").slideUp();
				}else{
					$("#nav .one a.aa ,#nav .tow a.bb ,#nav .tree a.cc ,#nav .four a.dd").removeClass("on");
					$(this).siblings("#nav .nav2").slideUp();
					$("#nav .nav3").slideUp();
					$("#nav .nav4").slideUp();
					$("#nav .nav5").slideUp();
				}
			}); 
			$("#nav .tow a.bb").click(function(){
				if ($(this).siblings("#nav .nav3").is(":hidden")){
					$("#nav .nav3").slideUp();
					$("#nav .tow a.bb").removeClass("on");
					$(this).addClass("on");
					$(this).siblings("#nav .nav3").slideDown();
					$("#nav .nav4").slideUp();
					$("#nav .nav5").slideUp();
				}else{			
					$("#nav .tow a.bb ,#nav .tree a.cc ,#nav .four a.dd").removeClass("on");
					$(this).siblings("#nav .nav3").slideUp();
					$("#nav .nav4").slideUp();
					$("#nav .nav5").slideUp();
				}
			}); 
			$("#nav .tree a.cc").click(function(){
				if ($(this).siblings("#nav .nav4").is(":hidden")){
					$("#nav .nav4").slideUp();
					$("#nav .tree a.cc").removeClass("on");
					$(this).addClass("on");
					$(this).siblings("#nav .nav4").slideDown();
					$("#nav .nav5").slideUp();
				}else{			
					$("#nav .tree a.cc ,#nav .four a.dd").removeClass("on");
					$(this).siblings("#nav .nav4").slideUp();
					$("#nav .nav5").slideUp();
				}
			}); 
			$("#nav .four a.dd").click(function(){
				if ($(this).siblings("#nav .nav5").is(":hidden")){
					$("#nav .nav5").slideUp();
					$("#nav .four a.dd").removeClass("on");
					$(this).addClass("on");
					$(this).siblings("#nav .nav5").slideDown();
				}else{			
					$("#nav .four a.dd").removeClass("on");
					$(this).siblings("#nav .nav5").slideUp();
				}
			});

						$(".nav-btn2").click(function(){
				if ($(".s1-menu").is(":hidden")){
					$(this).addClass("open");
					$(".s1-menu").slideDown();
				}else{			
					$(this).removeClass("open");
					$(".s1-menu").slideUp();
					$(".s1-menu .nav2").slideUp();
					$(".s1-menu .nav3").slideUp();
					$(".s1-menu .nav4").slideUp();
					$(".s1-menu .nav5").slideUp();
				}
			});
			$(".s1-menu .one a.aa").click(function(){
				if ($(this).siblings(".s1-menu .nav2").is(":hidden")){
					$(".s1-menu .nav2").slideUp();
					$(".s1-menu a").removeClass("on");
					$(this).addClass("on");
					$(this).siblings(".s1-menu .nav2").slideDown();
					$(".s1-menu .nav3").slideUp();
					$(".s1-menu .nav4").slideUp();
					$(".s1-menu .nav5").slideUp();
				}else{
					$(".s1-menu .one a.aa ,.s1-menu .tow a.bb ,.s1-menu .tree a.cc ,.s1-menu .four a.dd").removeClass("on");
					$(this).siblings(".s1-menu .nav2").slideUp();
					$(".s1-menu .nav3").slideUp();
					$(".s1-menu .nav4").slideUp();
					$(".s1-menu .nav5").slideUp();
				}
			}); 
			$(".s1-menu .tow a.bb").click(function(){
				if ($(this).siblings(".s1-menu .nav3").is(":hidden")){
					$(".s1-menu .nav3").slideUp();
					$(".s1-menu .tow a.bb").removeClass("on");
					$(this).addClass("on");
					$(this).siblings(".s1-menu .nav3").slideDown();
					$(".s1-menu .nav4").slideUp();
					$(".s1-menu .nav5").slideUp();
				}else{			
					$(".s1-menu .tow a.bb ,.s1-menu .tree a.cc ,.s1-menu .four a.dd").removeClass("on");
					$(this).siblings(".s1-menu .nav3").slideUp();
					$(".s1-menu .nav4").slideUp();
					$(".s1-menu .nav5").slideUp();
				}
			}); 
			$(".s1-menu .tree a.cc").click(function(){
				if ($(this).siblings(".s1-menu .nav4").is(":hidden")){
					$(".s1-menu .nav4").slideUp();
					$(".s1-menu .tree a.cc").removeClass("on");
					$(this).addClass("on");
					$(this).siblings(".s1-menu .nav4").slideDown();
					$(".s1-menu .nav5").slideUp();
				}else{			
					$(".s1-menu .tree a.cc ,.s1-menu .four a.dd").removeClass("on");
					$(this).siblings(".s1-menu .nav4").slideUp();
					$(".s1-menu .nav5").slideUp();
				}
			}); 
			$(".s1-menu .four a.dd").click(function(){
				if ($(this).siblings(".s1-menu .nav5").is(":hidden")){
					$(".s1-menu .nav5").slideUp();
					$(".s1-menu .four a.dd").removeClass("on");
					$(this).addClass("on");
					$(this).siblings(".s1-menu .nav5").slideDown();
				}else{			
					$(".s1-menu .four a.dd").removeClass("on");
					$(this).siblings(".s1-menu .nav5").slideUp();
				}
			});

		}else{	
			$(".one").mouseover(function(){
				$(this).children(".nav2").slideDown(200);
			});
			$(".one").mouseleave(function(){
				$(".nav2").stop();
				$(".nav2").hide();
			});
			$(".tow").mouseover(function(){
				$(this).children(".nav3").slideDown(200);
			});
			$(".tow").mouseleave(function(){
				$(".nav3").stop();
				$(".nav3").hide();
			});
			$(".tree").mouseover(function(){
				$(this).children(".nav4").slideDown(200);
			});
			$(".tree").mouseleave(function(){
				$(".nav4").stop();
				$(".nav4").hide();
			});
			$(".four").mouseover(function(){
				$(this).children(".nav5").slideDown(200);
			});
			$(".four").mouseleave(function(){
				$(".nav5").stop();
				$(".nav5").hide();
			});
		}
 });