<?php defined('ROOT') or exit('Can\'t Access !'); ?>


<!-- Bootstrap core Javascript
================================================== -->

<script src="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/js/bootstrap.min.js"></script>



<script type="text/javascript">
    <!--
    function setpraise(aid,hrefname,obj) {
//点赞
        $.get(hrefname,{'aid':aid},function(data,status){
            if(data != '') {
                data = JSON.parse(data);
                if(data[0]=='1'){
                    alert("<?php echo lang('praise_success');?>");
                    $(obj).val("<?php echo lang('cancel_some_praise');?>");
                }else{
                    alert("<?php echo lang('cancel_some_praise');?>");
                    $(obj).val("lang('point-like')");
                }
                $(obj).next('span').html(data[1]);
            }
        });
    }

    function setcollect(couponid,hrefname,obj) {
//收藏
        $.get(hrefname,{'couponid':couponid},function(data,status){
            if(data != '') {
                data = JSON.parse(data);
//显示提示信息
                if(data=='1'){
                    alert("<?php echo lang('successful_collection');?>");
                    $(obj).val("<?php echo lang('cancel_collection');?>");
                    $(obj).attr('class','glyphicon glyphicon-heart collection-btn   ');
                }else{
                    alert("<?php echo lang('the_collection_has_been_cancelled');?>");
                    $(obj).val("<?php echo lang('collection');?>");
                    $(obj).attr('class','icon-heart collection-btn');
                }
            }
        });
    }
    //-->
</script>

<!--购买下载-->
<script src="<?php echo $base_url;?>/common/plugins/shop/js/buyarchive.js?version=<?php echo _VERCODE;?>"></script>



<?php if(config::get('lang_open')=='1') { ?>
<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="myModalLang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="myModalLabel"><?php echo lang('please_choose_the_browsing_language');?></h5>
            </div>
            <div class="modal-body">
                <?php if(get('lang_type')=='1') { ?><a id="StranLink" name="StranLink">繁體</a><?php } ?>
                <?php if(is_array(getlang()))
foreach(getlang() as $d) { ?>
                <a <?php if(config::get('list_index_php')==1) { ?>name="setlang" data-langurl="<?php echo $d['langurlname'];?>" <?php } else { ?>href="<?php if($d['domain']) { ?><?php echo $d['domain'];?><?php echo url('archive/setlang/langurl/'.$d['langurlname']);?><?php } else { ?><?php echo url('archive/setlang/langurl/'.$d['langurlname']);?><?php } ?>" <?php } ?> ><img src="<?php echo $d['langimg'];?>" width="20"> <?php echo $d['langname'];?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- 繁简切换 -->
<?php if(get('lang_type')=='1') { ?><script type="text/javascript" src="<?php echo $base_url;?>/common/js/common.js"></script><?php } ?>
<?php } ?>




<?php if(config::get('site_push')=='1') { ?>
<script type="text/javascript">
    <!--
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
    //-->
</script>
<?php } ?>


<!-- 导航下拉缩小高度 -->
<script type="text/javascript">
    <!--
    $(document).ready(function(){
        $(window).scroll(function() {
            var top = $(".visual-slide,.banner,.banner2,.banner3,.banner4,.cbanner").offset().top; //获取指定位置
            var scrollTop = $(window).scrollTop();  //获取当前滑动位置
            if(scrollTop > top){                 //滑动到该位置时执行代码
                $(".navbar").addClass("active");
            }else{
                $(".navbar").removeClass("active");
            }
        });
    });

    $(function(){
        var cubuk_seviye = $(document).scrollTop();
        var header_yuksekligi = $('.navbar').outerHeight();

        $(window).scroll(function() {
            var kaydirma_cubugu = $(document).scrollTop();

            if (kaydirma_cubugu > header_yuksekligi){$('.navbar').addClass('gizle');}
            else {$('.navbar').removeClass('gizle');}

            if (kaydirma_cubugu > cubuk_seviye){$('.navbar').removeClass('sabit');}
            else {$('.navbar').addClass('sabit');}

            cubuk_seviye = $(document).scrollTop();
        });
    });
    //-->
</script>


<?php if(config::get('html_wow')=='1') { ?>
<!-- wow动态效果 -->
<link rel="stylesheet" href="<?php echo $base_url;?>/common/plugins/animate/css/animate.min.css" />
<script src="<?php echo $base_url;?>/common/plugins/animate/js/wow.min.js"></script>
<script type="text/javascript">
    <!--
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
        new WOW().init();
    };
    //-->
</script>
<?php } ?>

<?php if(get('share')=='1') { ?>
<!-- 百度分享 -->
<script type="text/javascript">
    <!--
    window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"100"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
    //-->
</script>
<?php } ?>



<script src="<?php echo $base_url;?>/common/js/admin.js"></script>

<!-- 鼠标滑过展开一级菜单/一级菜单可点击 -->
<script type="text/javascript">
    <!--
    $(function () {
        $(".dropdown,.dropdown-submenu").mouseover(function () {
            $(this).addClass("open");
        });
        $(".dropdown,.dropdown-submenu").mouseleave(function(){
            $(this).removeClass("open");
        })
    });
    $(document).ready(function(){
        var _width = $(window).width();
        if(_width < 768){
            $("#navbar a.toogle").click(function(){
                event.preventDefault();
            });
        }
    });
    //-->
</script>



<?php if(config::get('qrcodes')=='1') { ?>
<script type="text/javascript" src="<?php echo $base_url;?>/common/plugins/qrcode/jquery.qrcode.min.js"></script>
<script type="text/javascript">
    <!--
    $(function() {
        $('#qrcode').qrcode({text: window.location.href});
    });
    //-->
</script>
<?php } ?>

<?php if(config::get('site_login')=='1') { ?>
<span id="head_login"><?php echo login_js();?></span>
<script type="text/javascript">
    <!--
    login.innerHTML=head_login.innerHTML;head_login.innerHTML="";
    //-->
</script>
<?php } ?>
