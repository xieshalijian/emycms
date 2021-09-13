<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="CmsEasy 7_7_5_20210905_UTF8" />
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo config::getadmin('sitename'); ?> - <?php echo lang_admin('backstage_manage');?></title>
    <link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url;?>/common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $skin_admin_path;?>/css/admin.css?version=<?php echo _VERCODE;?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo $base_url;?>/common/js/jquery/jquery.min.js?version=<?php echo _VERCODE;?>"></script>
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery-migrate.min.js"></script>

</head>
<body>
<!--主体-->
<div class="wrapper">
    <!-- 左侧 ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
    <div class="sidebar">
        <div class="sidebar-bg">
            <div class="sidebar-header">
                <div class="logo clearfix">
                    <a href="<?php echo $base_url;?>/index.php?admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="logo-text float-left text-center">
                        <div class="logo-img">
                            <img src="<?php echo $skin_admin_path;?>/images/logo.png" alt="CmsEasy"/>
                        </div>
                        <span class="text align-middle" style="padding-right:50px;">
                            <?php if(session::get('ver') != 'corp'){ ?>CMSEASY<?php } else { ?>Administer<?php } ?>
                        </span>
                    </a>
                    <a id="sidebarToggle" href="javascript:;" class="nav-toggle">
                        <i data-toggle="expanded" class="toggle-icon ft-disc"></i>
                    </a>
                </div>
            </div>
            <div class="sidebar-content">
                <div class="nav-container">
                    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
                        <li class="has-sub open active">
                            <a onclick="gotohome()" href="#">
                                <i class="icon-home"></i>
                                <span class="menu-title"><?php echo lang_admin('home_page');?></span>
                            </a>
                        </li>
                        <?php
                        $menu = admin_menu::allmenu();
                        $menu_status = menu::getmenu();
                        $i = 0;
                        $class1 = '';
                        $corp_arry=array("order","seo_consumption_add","seo_consumption_shop_add");
                        foreach ($menu as $ns => $ms) {
                            if (!chkpower($ms['0']) || (array_key_exists($ms['0'], $menu_status) && !$menu_status[$ms['0']]['status']) ) {
                                continue;
                            }
                            if (in_array($ms['0'],$corp_arry) && session::get('ver') != 'corp') {
                                continue;
                            }
                            ?>
                            <li class="has-sub <?php echo $ms['0'];?> <?php if(is_array($ms['1'])) { ?>nav-glyphicon<?php } ?>" name="<?php echo $ms['0'];?>">
                                <a href="#"  <?php if(!is_array($ms['1'])) { ?> onclick="gotourl(this)" data-dataurl=" <?php echo $ms['1'];?>" title="<?php echo $ns;?>"  data-dataurlname="<?php echo $ns;?>" <?php } ?> >
                                    <?php if($ns == lang_admin('add')) { ?><i class="icon-note"></i>
                                    <?php } elseif ($ns == lang_admin('manage')) { ?><i class="icon-grid"></i>
                                    <?php } elseif ($ns == lang_admin('shopping')) { ?><i class="icon-basket-loaded"></i>
                                    <?php } elseif ($ns == lang_admin('interactive')) { ?><i class="icon-bubbles"></i>
                                    <?php } elseif ($ns == lang_admin('seo')) { ?><i class="icon-graph"></i>
                                    <?php } elseif ($ns == lang_admin('extend')) { ?><i class="icon-puzzle"></i>
                                    <?php } elseif ($ns == lang_admin('template')) { ?><i class="icon-screen-desktop"></i>
                                    <?php } elseif ($ns == lang_admin('user')) { ?><i class="icon-users"></i>
                                    <?php } elseif ($ns == lang_admin('security')) { ?><i class="icon-umbrella"></i>
                                        <?php } elseif ($ns == lang_admin('sidebar')) { ?><i class="icon-equalizer"></i>
                                    <?php } else { ?>
                                        <i class="icon-settings"></i>
                                    <?php } ?>
                                    <span class="menu-title"><?php echo $ns;?></span></a>
                                <?php if(is_array($ms['1'])) { ?>
                                    <ul class="menu-content nav_<?php echo $i;?>">
                                        <?php
                                        foreach($ms['1'] as $n => $m) {
                                            if (!chkpower($m['0']) || (array_key_exists($m['0'], $menu_status) && !$menu_status[$m['0']]['status'])) {
                                                continue;
                                            }
                                            if (in_array($m['0'],$corp_arry) && session::get('ver') != 'corp') {
                                                continue;
                                            }
                                            $rm = preg_quote($m['1']);
                                            if (preg_match("@$rm@i", $_SERVER['REQUEST_URI'])) {
                                                $curr_ns = $ns;
                                                $curr_n = $n;
                                                $curr_i = $i;
                                            }
    if ($n==lang_admin('coupon') && !config::get('coupon_show')) continue;
                                            $str='seo_coupon,seo_express,refund_list,seo_consumption';
                                            if( ((session::get('ver') == 'corp') && (strstr($str,$m['0']) !== false) )
                                                || ((session::get('ver') != 'corp') && (strstr($str,$m['0']) != true) )
                                                || (session::get('ver') == 'corp')) {
                                                ?>
                                                <li>
                                                    <a href="#" title="<?php echo $n;?>" onclick="gotourl(this)" data-dataurl="<?php echo $m['1'];?>" data-dataurlname="<?php echo $n;?>" data-dataurlname="<?php echo $ns;?>" class="menu-item menu-item_<?php echo $i;?>"><?php echo $n;?></a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                <?php } ?>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>
                        <li class="has-sub logout">
                            <a href="<?php echo $base_url;?>/index.php?case=index&act=logout&admin_dir=<?php echo config::getadmin('admin_dir',true);?>">
                                <i class="icon-power"></i>
                                <span class="menu-title"><?php echo lang_admin('sign_out');?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery-form.js"></script>
    <script type="text/javascript">
        var public_admin_dir="<?php echo get('admin_dir',true);?>";
        var public_site="<?php echo front::get('site')?front::get('site'):"default";?>";
        var public_shopping=0;
        checkleft("<?php echo $_SERVER['REQUEST_URI'];?>");//左边导航栏选中  打开页面选中一次
        //首页的单击事件
        function gotohome(){
            //单击首页先修改历史记录全部关闭
            $.ajax({
                type: "get",
                url: "<?php echo url('history/historyindex',true);?>",
                async: true,
                success: function (data) {
                }
            });
            window.location.href="<?php echo $base_url;?>/index.php?admin_dir=<?php echo get('admin_dir',true);?>&site=default";
        }
        //全站链接的单击事件
        function gotourl(obj){
            var dataurl = $(obj).data('dataurl');   //跳转url
            var dataurlname = $(obj).data('dataurlname');   //跳转url的名称
            //是否商品
            if(dataurl.indexOf("shopping=1")==-1){
                public_shopping=0;
            }else{
                public_shopping=1;
            }
            //保存浏览 记录
            if(dataurlname!="" && dataurl!=""){
                $.ajax({
                    type: "get",
                    url: "<?php echo url('history/historyadd',true);?>" ,
                    data:{'urlname':dataurlname,"userurl":dataurl},
                    async: false,
                    success: function (data) {
                    }
                });
            }
            if(dataurl!=""){
                $("#index_lading").attr("style","display: block;");
                $.ajax({
                    type: "get",
                    url: dataurl,
                    async: true,
                    success: function (data) {
                        $("#index_connent").html(data);
                        checkleft(dataurl);//左边导航栏选中
            show_tooltip();//信息提示框
                        fullscreen();  //全屏
                        $("#index_lading").attr("style","display: none;");
                    }
                });
            }
        }
        //全站链接的跳转事件
        function gotoinurl(url){
            if(url!="" && url!="#"){
                $("#index_lading").attr("style","display: block;");
                $.ajax({
                    type: "get",
                    url: url,
                    async: true,
                    success: function (data) {
                        $("#index_connent").html(data);
                        checkleft(url); //左边导航栏选中
            show_tooltip();//信息提示框
                        fullscreen();  //全屏
                    }
                });
            }
        }
    //信息提示框
        function show_tooltip(){
            $('[data-toggle="tooltip"]').tooltip();
        }
        // 用于form表单提交后不跳转
        function returnform(obj) {
            $("#index_lading").attr("style","display: block;");
            $(obj).ajaxSubmit(function(message) {
                $("#index_connent").html(message);
                $("#index_lading").attr("style","display: none;");
            });
            return false;
        }
        //左边选中
        function checkleft(dataurl){
            //关闭加载中
            $("#index_lading").attr("style","display: none;");
        }
        //打开页面   判断是否有记录正在的打开
        $(function(){
            <?php if(isset($gotoinurl) && $gotoinurl){ ?>
            gotoinurl('<?php echo $gotoinurl;?>');
            <?php };?>
        });
        //去掉同级open
        $("#main-menu-navigation li").each(function(){
            $(this).click(function(){
                $("li").removeClass("open");
                $(this).addClass("open");
            });
        });
    </script>
    <!-- 顶部导航 ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
    <script type="text/javascript">
        $(function () {
            $('.nav_<?php echo (isset($curr_i)?$curr_i:'');?>').addClass('in');
        });
    </script>
    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="container-fluid">
            <div class="row">
                <div class="navbar-header" id="navbar-header">
                    <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
                        <span class="sr-only">Toggle navigation</span><span class="icon-list"></span>
                    </button>
                    <a id="fullScreen"><span class="icon-size-fullscreen"></span></a>
                    <a id="exitFullScreen" style="display:none;"><span class="icon-size-actual"></span></a>
                    <form class="form-inline pull-left backstage-search" onsubmit="return false;">
                        <input type="text" class="form-control" id="AdminSearch" value="" placeholder="<?php echo lang_admin('function_search');?>" onkeydown="onKeyDown(event)">
                        <button onclick="AdminSearchModal(this)"  class="btn btn-default search-btn" data-toggle="modal" data-target="#AdminSearchModal" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </form>
                </div>
                <script type="text/javascript">
                    $("#search_name").bind("keypress",function(){
                        document.getElementById("search_click").click();
                    });
                    //设置类型按钮
                    function AdminSearchModal(obj) {
                        var url="<?php echo url('archive/searAdminTitle/sear_name',false);?>"+$(obj).prev().val();
                        $.ajax({
                            type: "get",
                            url: url,
                            async: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                var htmlstr="";
                                if(data.length>0){
                                    $.each(data, function (key, val) {
                                        htmlstr+="<div class=\"col-xs-12 col-xm-6 col-md-4\"><div class=\"row\"><a href=\"#\" onclick=\"gotourl(this);$('#AdminSearchModal').modal('hide')\"   data-dataurl='"+val['titleURL']+"'>"+val['title']+"</a></div></div>";
                                    });
                                }else{
                                    htmlstr+="<h5 class=\"text-center\"><?php echo lang_admin('no_data');?></h5>";
                                }
                                $("#title_serach_data").html(htmlstr);
                            }
                        });
                    }
                </script>
                <div id="navbar" class="navbar-collapse collapse pull-right">
                    <ul class="nav navbar-top-links navbar-right">
                        <!--预览-->
                        <li><a href="<?php echo $base_url;?>/" target="_blank" class="btn btn-view"><?php echo lang_admin('preview');?></a></li>
                        <!--动静态-->
                        <li class="dropdown">
                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('config/system/set/dynamic');?>" data-dataurlname="<?php echo lang_admin('static_state');?>">
                                <i class="icon-rocket"></i>
                                <?php echo lang_admin('static_state');?>
                            </a>
                        </li>
                        <!--更新缓存-->
                        <li>
                            <a href="<?php echo url::create('config/remove');?>" class="on"  data-dataurlname="<?php echo lang_admin('cache');?>">
                                <i class="icon-refresh"></i>
                                <?php echo lang_admin('cache');?>
                            </a>
                        </li>
                        <!--在线升级-->
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('update/index');?>" data-dataurlname="<?php echo lang_admin('online_upgrade');?>">
                                <i class="icon-cloud-download"></i>
                                <?php echo lang_admin('upgrade');?>
                            </a>
                        </li>
                        <?php if(session::get('ver') != 'corp'){ ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="glyphicon glyphicon-tasks"></i>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu tasks">
                                    <li>
                                        <a href="https://www.cmseasy.cn/" target="_blank"><?php echo lang_admin('software_official_network');?></a>
                                    </li>
                                    <li>
                                        <a href="https://www.cmseasy.cn/service/" target="_blank"><?php echo lang_admin('purchase_authorization');?></a>
                                    </li>
                                    <li>
                                        <a href="https://www.cmseasy.org/" target="_blank"><?php echo lang_admin('question_exchange');?></a>
                                    </li>
                                    <li>
                                        <a href="https://www.cmseasy.cn/chm/quick/" target="_blank">
                                            <?php echo lang_admin('quick_get_start');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.cmseasy.cn/chm/" target="_blank">
                                            <?php echo lang_admin('online_tutorials');?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo getlangimg(lang::getisadmin());?>" width="20"> <?php echo getlangurlname(lang::getisadmin());?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu tasks admin-lang-menu">
                                <?php if(is_array(getlang()))
                                    foreach(getlang() as $d) { ?>
                                        <li>
                                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('config/setadminlang/langurl/'.$d['langurlname']);?>">
                                                <img src="<?php echo $d['langimg'];?>" width="20">
                                                <?php echo $d['langname'];?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <li>
                                    <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=language&act=list&admin_dir=<?php echo get('admin_dir',true);?>&site=default"  data-dataurlname="<?php echo lang_admin('language_list');?>">
                                        <span class="icon-note"></span>
                                        <?php echo lang_admin('editorial_language');?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo $user['headimage'];?>"class="img-responsive img-circle headimage pull-left" />
                                <?php echo $user['username'];?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu user">
                                <li>
                                    <a href="<?php echo $base_url;?>/index.php?case=user&act=edit&table=user">
                                        <?php echo lang_admin('editorial_materials');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url;?>/index.php?case=index&act=logout&admin_dir=<?php echo config::getadmin('admin_dir',true);?>">
                                        <?php echo lang_admin('sign_out');?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php if(session::get('ver') != 'corp' && session::get('crg') != 'corp' ){ ?>
                            <li>
                                <!--商业版-->
                                <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=copyright_client&act=buycopyright&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('commercial_authorization');?>" class="buy-license">
                                    <i class="icon-badge"></i>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- 右侧 --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="main-panel">
        <div class="main-content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row" id="index_connent" name="index_connent">
                        <?php
                        $this->render();
                        ?>
                    </div>
                    <div class="copy"><?php echo getCopyRight();?></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="blank30"></div>
    </div>
</div>
<!--设置边栏-->
<div id="style-switcher">
    <h2><a href="#"><i class="icon-magic-wand"></i></a></h2>
    <h2 class="close"><a href="#"><i class="glyphicon glyphicon-remove" title="<?php echo lang_admin('delete');?>"></i></a></h2>
    <div>
        <h3><?php echo lang_admin('sidebar_background_picture');?></h3>
        <ul class="colors bg" id="bg">
            <li><a href="#" class="bg1"></a></li>
            <li><a href="#" class="bg2"></a></li>
            <li><a href="#" class="bg3"></a></li>
            <li><a href="#" class="bg4"></a></li>
            <li><a href="#" class="bg5"></a></li>
            <li><a href="#" class="bg6"></a></li>
            <li><a href="#" class="bg7"></a></li>
            <li><a href="#" class="bg8"></a></li>
        </ul>
        <h3><?php echo lang_admin('sidebar_color');?></h3>
        <ul class="colors bgsolid" id="bgsolid">
            <li><a href="#" class="black-bg" title="black"></a></li>
            <li><a href="#" class="blue-bg" title="blue"></a></li>
            <li><a href="#" class="orange-bg" title="orange"></a></li>
            <li><a href="#" class="navy-bg" title="navy"></a></li>
            <li><a href="#" class="green-bg" title="green"></a></li>
            <li><a href="#" class="rainbow-bg" title="rainbow"></a></li>
        </ul>
    </div>
</div>
<!--顶部辅助保存-->
<script type="text/javascript">
    <!--
    $(document).ready(function(){
        $(window).scroll(function() {
            var top = $("#index_connent").offset().top; //获取指定位置
            var scrollTop = $(window).scrollTop();  //获取当前滑动位置
            if(scrollTop > top){                 //滑动到该位置时执行代码

                $(".content-eidt-nav").addClass("sabit");

                $(".sabit #fullscreen-btn").css("display","inline-block");
                $(".sabit #content-eidt-nav-btn").css("display","inline-block");

            }else{
                $(".content-eidt-nav").removeClass("sabit");
                $("#fullscreen-btn").css("display","none");
                $(".fixed #fullscreen-btn").css("display","inline-block");
                $("#content-eidt-nav-btn").css("display","none");
            }
        });
    });
    //-->
</script>
<!--全屏-->
<script type="text/javascript">
    fullscreen();
    function fullscreen() {
        var fullscreen = false;
        let btn = document.getElementById('fullscreen-btn');
        let fullarea = document.getElementById('box')
        btn.addEventListener('click',function(){
            if (fullscreen) {
                // 退出全屏
                $(".content-eidt-nav").removeClass("fixed");
                $(".content-eidt-nav").css({
                    "background-color":"#ffffff"
                });
                $(".content-eidt-nav.sabit").css({
                    "padding-right":"15px",
                });
                $(".fixed #fullscreen-btn").css("display","none");
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            } else {
                // 进入全屏
                $("#box").css({
                    "overflow":"hidden",
                    "overflow-y":"auto"
                });
                $(".content-eidt-nav").addClass("fixed");

                $(".fixed #fullscreen-btn").css("display","inline-block");

                if (fullarea.requestFullscreen) {
                    fullarea.requestFullscreen();
                } else if (fullarea.webkitRequestFullScreen) {
                    fullarea.webkitRequestFullScreen();
                } else if (fullarea.mozRequestFullScreen) {
                    fullarea.mozRequestFullScreen();
                } else if (fullarea.msRequestFullscreen) {
                    // IE11
                    fullarea.msRequestFullscreen();
                }
            }
            fullscreen = !fullscreen;
        });
        //导航的叉叉
        $("#content-eidt-nav-btn").click(function(){
            $(".content-eidt-nav").removeClass("sabit");
        });
    }
</script>
<!-- 上传框 -->
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/locales/zh.js" type="text/javascript"></script>
<link href="<?php echo $base_url;?>/common/plugins/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">

<script src="<?php echo $base_url;?>/common/js/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo $base_url;?>/common/js/admin.js?version=<?php echo _VERCODE;?>"></script>
<!-- Bootstrap core JavaScript -->
<script src="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<!--浏览记录-->
<link href="<?php echo $base_url;?>/common/plugins/swiper/css/swiper.min.css" rel="stylesheet" >
<script src="<?php echo $base_url;?>/common/plugins/swiper/js/swiper.min.js"></script>
<!-- 菜单栏背景切换 -->
<script src="<?php echo $base_url;?>/common/plugins/switcher/js/switcher.js"></script>
<script type="text/javascript">
    <!--
    $("#style-switcher").click(function addCSS(){
        var link = document.createElement('link');
        link.type = 'text/css';
        link.rel = 'stylesheet';
        link.href = '<?php echo $base_url;?>/common/plugins/switcher/css/switcher.css';
        document.getElementsByTagName("head")[0].appendChild(link);
    });
    //-->
</script>
<!-- 返回顶部 -->
<script type="text/javascript">
    $(function() {
//当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
    $(window).scroll(function(){
        if ($(window).scrollTop()>100){
            $("#back-top").fadeIn(1000);
        }
        else
        {
            $("#back-top").fadeOut(500);
        }
    });
//当点击跳转链接后，回到页面顶部位置
    $("#back-top").click(function(){
        $('body,html').animate({scrollTop:0},500);
        return false;
    });
    });
</script>
<a href="#" id="back-top"><i class="glyphicon glyphicon-arrow-up"></i></a>
<!--边栏收缩-->
<script type="text/javascript">
    //左侧菜单收缩
    $(function() {
        $('.nav-toggle').on('click',function(){
            var toggle_icon= $(this).find('.toggle-icon');
            var toggle = toggle_icon.attr('data-toggle');
            if(toggle === 'expanded'){
                $('.wrapper').addClass('nav-collapsed');
                $('.nav-toggle').find('.toggle-icon').removeClass('ft-disc').addClass('ft-circle');
                toggle_icon.attr('data-toggle', 'collapsed');
               /* if(compact_menu_checkbox.length > 0){
                    compact_menu_checkbox.prop('checked',true);
                }*/
            }else{
                $('.wrapper').removeClass('nav-collapsed menu-collapsed');
                $('.nav-toggle').find('.toggle-icon').removeClass('ft-circle').addClass('ft-disc');
                toggle_icon.attr('data-toggle', 'expanded');
                /*if(compact_menu_checkbox.length > 0){
                    compact_menu_checkbox.prop('checked',false);
                }*/
            }
        });
    });
</script>
<script type="text/javascript">
    <!--
    //标签页
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
    //去掉虚线框
    function bluring() {
        if (event.srcElement.tagName == "A" || event.srcElement.tagName == "IMG") document.body.focus();
    }
    document.onfocusin = bluring;
    //点击<?php echo lang_admin('close');?><?php echo lang_admin('tips');?>信息层
    function turnoff(obj) {
        document.getElementById(obj).style.display = "none";
    }
    //-->
</script>
<!-- 判断后台地址 -->
<?php if(config::getadmin('admin_dir')=='admin') { ?>
    <div class="message-admin-dir alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
        <span class="glyphicon glyphicon-warning-sign"></span>
        <strong><?php echo lang_admin('tips');?></strong>
        <?php echo lang_admin('there_is_a_serious_risk_in_the_name_of_the_backstage_manage_folder_of_the_website_i_suggest_you_amend_it_as_soon_as_possible');?>
        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('config/system/set/security');?>" class="btn btn-danger"><?php echo lang_admin('modify');?></a>
    </div>
    </div>
    <script type="text/javascript">
        <!--
        function lick() {
            $(".message-admin-dir").hide();
        }
        window.setTimeout("lick()", 3000);
        //-->
    </script>
<?php } ?>
<!-- 操作信息提示框 -->
<?php if (hasflash()) { ?>
    <div class="message alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
        <span class="glyphicon glyphicon-warning-sign"></span> <?php echo showflash(); ?>
        <div class="message-bottom"></div>
    </div>
<?php } ?>
<!-- 判断浏览器 -->
<script src="<?php echo $base_url;?>/common/js/jquery/plugins/jquery-browser/jquery-browser.js"></script>
<!-- 加载进度条 -->
<script src="<?php echo $base_url;?>/common/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    {
        function getElementsByClass(key) {
            var arr = new Array();
            var tags = document.getElementsByTagName("*");
            for (var i = 0; i < tags.length; i++) {
                if (tags[i].className.match(new RegExp('(\\s|^)' + key + '(\\s|$)'))) {
                    arr.push(tags[i]);
                }
            }
            return arr;
        }
    }
</script>
<!-- 窗口全屏 -->
<script type="text/javascript">
    <!--
    $(function(){
        //全屏
        $("#fullScreen").on("click",function(){
            fullScreen();
        });
        //退出全屏
        $("#exitFullScreen").on("click",function(){
            exitFullscreen();
        })
    });
    //全屏
    function fullScreen() {
        var element = document.documentElement;
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.msRequestFullscreen) {
            element.msRequestFullscreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen();
        }
    }
    //退出全屏
    function exitFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
    //监听window是否全屏，并进行相应的操作,支持esc键退出
    window.onresize = function() {
        var isFull=!!(document.webkitIsFullScreen || document.mozFullScreen ||
            document.msFullscreenElement || document.fullscreenElement
        );//!document.webkitIsFullScreen都为true。因此用!!
        if (isFull==false) {
            $("#exitFullScreen").css("display","none");
            $("#fullScreen").css("display","");
        }else{
            $("#exitFullScreen").css("display","");
            $("#fullScreen").css("display","none");
        }
    }
    //-->
</script>
<!-- 关键词搜索 -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="AdminSearchModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <h4>
                    <?php echo lang_admin("function_list");?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="blank10"></div>
                <forme onsubmit="return false;">
                    <div id="title_serach_data"></div>
                </forme>
                <div class="blank10"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closmode" class="btn btn-danger" data-dismiss="modal"><?php echo lang_admin("close");?></button>
            </div>
        </div>
    </div>
</div>
<!-- 搜索框伸缩 -->
<style type="text/css">
    #AdminSearch {
        width:0px;
        -webkit-transition:.3s;
        -moz-transition:.3s;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#AdminSearch").click(function(){
            $(this).css("width","210px");
        });
        $(".search-btn").click(function(){
            $("#AdminSearch").css("width","0px");
        });
    });
</script>

</body>
</html>