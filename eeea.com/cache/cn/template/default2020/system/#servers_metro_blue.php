<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<?php
if(config::get('serverlistp')=='right'){
$_serverlistpcss='left';
$_float = 'right:0;';
$_float1 = 'left:-160px;';
$_float2 = 'left:-115px;';
}elseif(config::get('serverlistp')=='left'){
$_serverlistpcss='right';
$_float = 'left:0;';
$_float1 = 'right:-160px;';
$_float2 = 'right:-115px;';
}else{
$_serverlistpcss='left';
}
?>



<style type="text/css">
.izl-rmenu{position:fixed; <?php echo $_float;?> margin-right:20px; top:25%; padding-bottom:0px;  z-index:999; }
.izl-rmenu .sbtn{width:50px; height:50px; margin-bottom:1px; cursor:pointer; position:relative;}
@media (max-width: 486px) {
    .izl-rmenu {display:none;}
}

.izl-rmenu .btn-qq{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_qq.png) 0px 0px no-repeat; background-color:#06276a;color:#FFF;}
.izl-rmenu .btn-qq:hover{background-color:#26c79d;color:#FFF;}
.izl-rmenu .btn-qq .qq{background-color:#26c79d; position:absolute; width:110px; <?php echo $_float2;?> top:0px; line-height:38px; padding:15px 0px; color:#FFF; font-size:18px; text-align:center; display:none; border-radius: 10px 0px 10px 0px;box-shadow: 0 5px 20px 0 #999;}
.izl-rmenu .btn-qq a {color:#FFF;font-size:14px;}

.izl-rmenu .btn-wx{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_wx.png) 0px 0px no-repeat; background-color:#06276a;}
.izl-rmenu .btn-wx:hover{background-color:#26c79d;}
.izl-rmenu .btn-wx .pic{position:absolute; <?php echo $_float1;?> top:0px; display:none;width:140px;height:140px;box-shadow: 0 5px 20px 0 #999;}

.izl-rmenu .btn-phone{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_phone.png) 0px 0px no-repeat; background-color:#06276a;}
.izl-rmenu .btn-phone:hover{background-color:#26c79d;}
.izl-rmenu .btn-phone .phone{background-color:#ff811b; position:absolute; width:160px; <?php echo $_float1;?> top:0px; line-height:50px; color:#FFF; font-size:18px; text-align:center; display:none;}

.izl-rmenu .btn-ali{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_ali.png) 0px 0px no-repeat; background-color:#06276a;}
.izl-rmenu .btn-ali:hover{background-color:#26c79d;}
.izl-rmenu a.btn-ali,.izl-rmenu a.btn-ali:visited{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_ali.png) 0px 0px no-repeat; background-color:#06276a; text-decoration:none; display:block;}


.izl-rmenu .btn-wangwang{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_wangwang.png) 0px 0px no-repeat; background-color:#06276a; background-size:100% 100%;}
.izl-rmenu .btn-wangwang:hover{background-color:#26c79d;}
.izl-rmenu a.btn-wangwang,.izl-rmenu a.btn-wangwang:visited{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_wangwang.png) 0px 0px no-repeat; background-color:#06276a; text-decoration:none; display:block;}


.izl-rmenu .btn-skype{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_skype.png) 0px 0px no-repeat; background-color:#06276a;}
.izl-rmenu .btn-skype:hover{background-color:#26c79d;}
.izl-rmenu a.btn-skype,.izl-rmenu a.btn-skype:visited{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_skype.png) 0px 0px no-repeat; background-color:#06276a; text-decoration:none; display:block;}

.izl-rmenu .btn-web{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_web.png) 0px 0px no-repeat; background-color:#06276a;}

.izl-rmenu a.btn-web,.izl-rmenu a.btn-web:visited{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_web.png) 0px 0px no-repeat; background-color:#06276a; text-decoration:none; display:block;}
.izl-rmenu a.btn-web:hover{background-color:#26c79d;}

.izl-rmenu .btn-top{background:url(<?php echo $skin_path;?>/images/servers/metro_blue/r_top.png) 0px 0px no-repeat; background-color:#06276a; display:none;}
.izl-rmenu .btn-top:hover{background-color:#26c79d;}
</style>

<script language="javascript" type="text/javascript">
$(function(){
var tophtml="<div id=\"izl_rmenu\" class=\"izl-rmenu\"><div class='edit'>" +
        "<button type=\"button\" class=\"btn\" data-toggle=\"modal\" data-type=\"customer\" name=\"allconfig\" data-target=\"#template-allconfig-tag\">" +
        "<i class='glyphicon glyphicon-cog'></i>" +
        "</button></div><div class=\"sbtn btn-qq\"><div class=\"qq\"><?php if(config::get('qq1')) { ?><a rel=\"nofollow\" target=\"_blank\" href=\"tencent://Message/?Uin=<?php echo get('qq1');?>&websiteName=<?php echo get('site_url');?>=&Menu=yes\"><i class=\"icon-user\"></i>	<?php echo get('qq1name');?></a><?php } ?><?php if(config::get('qq2')) { ?><br /><a rel=\"nofollow\" target=\"_blank\" href=\"tencent://Message/?Uin=<?php echo get('qq2');?>&websiteName=<?php echo get('site_url');?>=&Menu=yes\"><i class=\"icon-user\"></i>	<?php echo get('qq2name');?></a><?php } ?><?php if(config::get('qq3')) { ?><br /><a rel=\"nofollow\" target=\"_blank\" href=\"tencent://Message/?Uin=<?php echo get('qq3');?>&websiteName=<?php echo get('site_url');?>=&Menu=yes\"><i class=\"icon-user\"></i>	<?php echo get('qq3name');?></a><?php } ?><?php if(config::get('qq4')) { ?><br /><a rel=\"nofollow\" target=\"_blank\" href=\"tencent://Message/?Uin=<?php echo get('qq4');?>&websiteName=<?php echo get('site_url');?>=&Menu=yes\"><i class=\"icon-user\"></i>	<?php echo get('qq4name');?></a><?php } ?><?php if(config::get('qq5')) { ?><br /><a rel=\"nofollow\" target=\"_blank\" href=\"tencent://Message/?Uin=<?php echo get('qq5');?>&websiteName=<?php echo get('site_url');?>=&Menu=yes\"><i class=\"icon-user\"></i>	<?php echo get('qq5name');?></a><?php } ?></div></div><?php if(config::get('wangwang')) { ?><a rel=\"nofollow\" href=\"http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo config::get('wangwang');?>&site=cntaobao&s=1&charset=utf-8\" target=\"_blank\" class=\"sbtn btn-wangwang\"></a><?php } ?><?php if(config::get('ali')) { ?><a rel=\"nofollow\" target=\"_blank\" href=\"http://amos.alicdn.com/msg.aw?v=2&uid=<?php echo config::get('ali');?>&site=cnalichn&s=10&charset=utf-8\" class=\"sbtn btn-ali\"></a><?php } ?><?php if(config::get('skype')) { ?><a rel=\"nofollow\" target=\"_blank\" href=\"skype:<?php echo config::get('skype');?>?call\" target=\"_blank\" class=\"sbtn btn-skype\"></a><?php } ?><div class=\"sbtn btn-wx\"><img class=\"pic\" src=\"<?php echo get('weixin_pic');?>\" onclick=\"window.location.href=\'http:\'\"/></div><div class=\"sbtn btn-phone\"><div class=\"phone\"><?php echo get('tel');?></div></div><div class=\"sbtn btn-top\"></div></div>";
$("#top").html(tophtml);
$("#izl_rmenu").each(function(){
$(this).find(".btn-qq").mouseenter(function(){
$(this).find(".qq").fadeIn("fast");
});
$(this).find(".btn-qq").mouseleave(function(){
$(this).find(".qq").fadeOut("fast");
});
$(this).find(".btn-wx").mouseenter(function(){
$(this).find(".pic").fadeIn("fast");
});
$(this).find(".btn-wx").mouseleave(function(){
$(this).find(".pic").fadeOut("fast");
});
$(this).find(".btn-phone").mouseenter(function(){
$(this).find(".phone").fadeIn("fast");
});
$(this).find(".btn-phone").mouseleave(function(){
$(this).find(".phone").fadeOut("fast");
});
$(this).find(".btn-top").click(function(){
$("html, body").animate({
"scroll-top":0
},"fast");
});
});
var lastRmenuStatus=false;
$(window).scroll(function(){//bug
var _top=$(window).scrollTop();
if(_top>200){
$("#izl_rmenu").data("expanded",true);
}else{
$("#izl_rmenu").data("expanded",false);
}
if($("#izl_rmenu").data("expanded")!=lastRmenuStatus){
lastRmenuStatus=$("#izl_rmenu").data("expanded");
if(lastRmenuStatus){
$("#izl_rmenu .btn-top").slideDown();
}else{
$("#izl_rmenu .btn-top").slideUp();
}
}
});
});
</script>
<div id="top"></div>
