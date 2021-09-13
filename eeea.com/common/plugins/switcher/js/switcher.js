/*-----------------------------------------------------------------------------------
/* Styles Switcher
-----------------------------------------------------------------------------------*/

window.console = window.console || (function(){
	var c = {}; c.log = c.warn = c.debug = c.info = c.error = c.time = c.dir = c.profile = c.clear = c.exception = c.trace = c.assert = function(){};
	return c;
})();


jQuery(document).ready(function($) {

		// Layout Switcher
		$(".boxed" ).click(function(){
			$("#layout" ).attr("href", "css/boxed.css" );
			return false;
		});

		$("#layout-switcher").on('change', function() {
			$('#layout').attr('href', $(this).val() + '.css');
		});;

		
		// Style Switcher	
		$('#style-switcher').animate({
			right: '-288px'
		});
		
		$('#style-switcher h2 a').click(function(e){
			e.preventDefault();
			var div = $('#style-switcher');
			console.log(div.css('right'));
			if (div.css('right') === '-288px') {
				$('#style-switcher').animate({
					right: '0px'
				}); 
			} else {
				$('#style-switcher').animate({
					right: '-288px'
				});
			}
		});
		
		$('.colors li a').click(function(e){
			e.preventDefault();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
		});

		//加载的时候出现
		$('.sidebar').css('backgroundImage',getCookie("sidebar_backgroundImage"));
		$('.bg li a').click(function(e){
			e.preventDefault();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
			var bg = $(this).css('backgroundImage');
			$('.sidebar').css('backgroundImage',bg);
			Setcookie("sidebar_backgroundImage", bg);//存到cookie
		});

	//加载的时候出现
	$('.sidebar-bg').css('backgroundImage',getCookie("sidebar-bg_backgroundImage"));
		$('.bgsolid li a').click(function(e){
			e.preventDefault();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
			var bg = $(this).css('backgroundImage');
			$('.sidebar-bg').css('backgroundImage',bg)
			Setcookie("sidebar-bg_backgroundImage", bg);//存到cookie
		});
		
		$('#reset a').click(function(e){
			var bg = $(this).css('backgroundImage');
			$('.sidebar').css('backgroundImage','url(./common/plugins/switcher/images/bg/01.jpg)');
			$('.sidebar-bg').css('backgroundImage','linear-gradient(45deg, #333, #000)')
		})
			

	});


function Setcookie (name, value) {
	//设置名称为name,值为value的Cookie
	var expdate = new Date();   //初始化时间
	expdate.setTime(expdate.getTime() + 30 * 60 * 1000 * 999);   //时间单位毫秒
	document.cookie = name + "=" + value + ";expires=" + expdate.toGMTString() + ";path=/";

	//即document.cookie= name+"="+value+";path=/";  时间默认为当前会话可以不要，但路径要填写，因为JS的默认路径是当前页，如果不填，此cookie只在当前页面生效！
}
function getCookie(c_name) {
//判断document.cookie对象里面是否存有cookie
	if (document.cookie.length > 0) {
		c_start = document.cookie.indexOf(c_name + "=")
		//如果document.cookie对象里面有cookie则查找是否有指定的cookie，如果有则返回指定的cookie值，如果没有则返回空字符串
		if (c_start != -1) {
			c_start = c_start + c_name.length + 1
			c_end = document.cookie.indexOf(";", c_start)
			if (c_end == -1) c_end = document.cookie.length
			return unescape(document.cookie.substring(c_start, c_end))
		}
	}
	return "";
}

