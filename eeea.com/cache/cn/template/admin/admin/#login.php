<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="CmsEasy 7_7_5_20210905_UTF8" />
    <meta charset="utf-8">
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo getTitle(isset($archive)?$archive:"",isset($category)?$category:"",isset($catid)?$catid:"",isset($type)?$type:"");?></title>
    <link rel="shortcut icon" href="<?php echo $base_url;?>/favicon.ico" type="image/x-icon"/>
    <link href="<?php echo $base_url;?>/common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">

        * {outline: none;}
        :focus{
            outline:none;
        }
        .btn:focus,
        .btn:active:focus,
        .btn.active:focus,
        .btn.focus,
        .btn:active.focus,
        .btn.active.focus {
            outline: none;
            border-color: transparent;
            box-shadow:none;
        }

        body { background:#EEE url(<?php echo $skin_admin_path;?>/images/bg-grey.jpg) center 30% no-repeat;  overflow:hidden;}

        .box-box {position:relative; width:100vw; height:100vh}
        .box {
            width:380px;
            position: absolute;
            margin: auto;  position: absolute;  top: 0; left: 0; bottom: 0; right: 0;
            height:580px;
        }

        h1 {
            font-size: 30px;
            font-weight: 700;
            text-shadow: 0 1px 4px rgba(0,0,0,.2);
        }
        #loginform {/*background:rgba(255,255,255,.6);  margin-top:30px; */ padding:30px;  border-radius: 5px;}


        input {
            width: 100%;
            height: 42px;
            padding: 0 15px;
            background:rgba(255,255,255,.5);
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 0px;
            border: 1px solid #3d3d3d; /* browsers that don't support rgba */
            border: 1px solid rgba(0,0,0,.2);
            -moz-box-shadow: 0 2px 8px 0 rgba(0,0,0,.1) inset;
            -webkit-box-shadow: 0 2px 8px 0 rgba(0,0,0,.1) inset;
            box-shadow: 0 2px 8px 0 rgba(0,0,0,.1) inset;
            font-size: 14px;
            color: #333;
            text-shadow: 0 1px 2px rgba(0,0,0,.1);
            -o-transition: all .2s;
            -moz-transition: all .2s;
            -webkit-transition: all .2s;
            -ms-transition: all .2s;
            background:#2d2d2d\9;
        }


        .button {display:block; width:100%; text-align:center;  padding:0px; line-height:50px; background:#06276a; border:none; border-radius: 3px; color:#fff;  }
        .button:hover {box-shadow: 0 5px 15px 0 rgba(0,0,0,.2); background:#060D33;}

        a.help {color:#ccc;font-size:0.8em; text-decoration:none;
        }
        a.help:hover {color:#06276a;}

        .logo {line-height:60px; margin:0px auto;  text-align:center; color:#06276a; font-size:1.4rem; padding-left:66px; background:url(<?php echo $skin_admin_path;?>/images/logo-login.png) 88px center no-repeat;}

        .copy {float:left; color:#ccc;font-size:0.6em;}
        .copy a {color:#ccc;}
        .copy a:hover {color:#fff;}
        .blank5, .blank10, .blank20,.blank30 { clear: both; height: 5px; }
        .blank10 { height: 10px; }
        .blank20 { height: 20px; }
        .blank30 { height: 30px; }

        .alert {
            position:absolute;left:0px; top:0px; width:100%;height:100%;background:#f25648;
            filter: alpha(opacity=90);/*IE*/padding:88px 0px;text-align:center;color:#fff;
            z-index:99;
        }
        .alert a {color:#fff;font-size:bold;font-size:22px;}
        button#hidden {border:none; background:none; color:#fff; font-size:20px; font-weight:bold; margin-bottom:55px;}

        #holder {
            position: absolute;
            top: 0%;
            right:0%;
            bottom:0%;
            left: 0%;
            overflow: hidden;
            z-index:1;
        }

        .input-group {position: relative; height:72px; }

        .username,.password {position: absolute;  width: 252px; left:0px; top:0px; padding-left:50px;background:#fff;}
        .input-group .input-group-addon {position: absolute; left:0px; top:0px;width:40px; height:30px; padding-top:12px;background:#fff; z-index:9;-moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 0px;
            border: 1px solid rgba(0,0,0,.2);
            -moz-box-shadow: 0 2px 8px 0 rgba(0,0,0,.1) inset;
            -webkit-box-shadow: 0 2px 8px 0 rgba(0,0,0,.1) inset;
            box-shadow: 0 2px 8px 0 rgba(0,0,0,.1) inset;
            font-size: 16px;
            color: #999;
            text-align:center;
        }

        input:-webkit-autofill {
            -webkit-box-shadow : 0 0 0px 1000px white inset ;
            border : 1px solid #CCC !important ;
        }

        .vercode {float:right; color:#ccc; font-size:0.6em;}
    </style>
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#hidden").click(function(){
                $(".alert").hide(1000);
            });
        });
    </script>
    <!-- 图片加载 -->
    <script type="text/javascript">
        document.addEventListener("error", function (e) {
            var elem = e.target;
            if (elem.tagName.toLowerCase() == 'img') {
                elem.src = "<?php echo $base_url ;?><?php echo get('onerror_pic');?>";
            }
        }, true);

    </script>
</head>
<body>

<!--[if lt IE 9]>
<div class="alert">
    <button type="button" id="hidden">&#215;&nbsp;<?php echo lang_admin('close');?><?php echo lang_admin('tips');?></button>
    <h3>
        <?php echo lang_admin('browser_detection');?>
    </h3>
    <p>&nbsp;</p>
    <p>
        <?php echo lang_admin('recommended_installation');?>：<a href="https://browser.360.cn/se/" target="_blank"><strong>306</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.google.cn/intl/zh-CN/chrome/" target="_blank"><strong>Google</strong></a>
    </p>
</div>
<![endif]-->

<div class="box-box">

    <div class="box" id="box">

        <div class="logo"><?php echo lang_admin('login_back_end_manage');?></div>

        <?php
        if(!get('submit')) flash();
        if(!get('submit') || hasflash()) {
            ?>

            <form name="loginform" id="loginform" action="<?php echo uri();?>" method="post" autocomplete="off">
                <div class="vercode">V.<?php echo _VERCODE;?></div>
                <div class="blank10"></div>
                <input type="hidden" name="submit" value="<?php echo lang_admin('submitted');?>">
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><i class="icon-user"></i></span>
                    <input autocomplete="off" name="username" type="text" id="username" class="username" placeholder="<?php echo lang_admin('username');?>" tabindex="1" autocomplete="off" required autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><i class="icon-lock"></i></span>
                    <input autocomplete="off" name="password" type="password" id="password" class="password" placeholder="<?php echo lang_admin('password');?>" tabindex="2" autocomplete="off" required>
                </div>

                <?php if(config::getadmin('mobilechk_enable') && config::getadmin('mobilechk_admin')) { ?>
                <style type="text/css">
                    #tel {float:left;
                        width:148px;
                        margin:10px 0px;
                        height:38px;
                        line-height:38px;
                        padding:0px 10px;
                        border:1px solid #ccc;
                        border-radius: 5px;
                    }
                    #select {width:290px;}
                    #btm_sendMobileCode { float:right; width:120px; border:1px solid #ccc; height:38px; line-height:38px; margin:10px 0px; padding:0px 10px;border-radius: 5px;}
                    #mobilenum {clear:both; width:278px; border:1px solid #ccc; height:38px; line-height:38px; padding:0px 10px;border-radius: 5px;}
                </style>

                <script src="<?php echo $base_url;?>/js/mobilechk.js"></script>
                <input placeholder="<?php echo lang_admin('tel');?>" type='text' id="tel"  name="tel" value="" tabindex="3" class="form-control" />
                <input id="btm_sendMobileCode" onclick="sendMobileCode('<?php echo url('tool/smscode',false);?>',$('#tel'));" type="button" value="<?php echo lang_admin('send_cell_phone_verification_code');?>" />
                <div class="blank20"></div>
                <input type='text' placeholder="<?php echo lang_admin('please_enter_the_phone_verification_code');?>" id="mobilenum" name="mobilenum" />
                <div class="blank20"></div>
                <?php } ?>
                <!--后台登陆密码错误1次后显示验证码-->
                <?php if((config::getadmin('verifycode')=='1' || session::get('admin_YNverification')>0)) { ?>
                <style type="text/css">
                    #verify {
                        float:left;
                        width:220px;
                        height:30px;
                        margin-bottom: 30px;
                    }
                    #checkcode {float:right; height:32px;}
                </style>

                <?php echo verify();?><input type='text' id="verify"  tabindex="3" onKeyUp="value=value.replace(/[\W]/g,'')" name="verify" placeholder="验证码" />
                <div class="blank5"></div>
                <?php } ?>


                <?php if(config::getadmin('verifycode') == 2) { ?>
                <link rel="stylesheet" href="<?php echo $base_url;?>/common/dialog/reveal.css">
                <script type="text/javascript" src="<?php echo $base_url;?>/common/dialog/jquery.reveal.js"></script>
                <script type="text/javascript">
                    //WWW
                    var submit=false;
                    $(document).ready(function(){
                        $('#loginform').submit(function(e){
                            if(submit==false) {
                                $('#verify-dialog').reveal();
                                return false;
                            }
                        });
                    });
                </script>

                <script src="https://static.geetest.com/static/tools/gt.js"></script>
                <script type="text/javascript">
                    var handlerPopup = function (captchaObj) {
                        captchaObj.onSuccess(function () {
                            var validate = captchaObj.getValidate();
                            submit=true;
                            setTimeout( function(){
                                    $('#verify-dialog').hide();
                                },
                                2000);
                            setTimeout( function(){
                                    $('.show-dialog').click();
                                },
                                1000);
                        });
                        $("#popup-submit").click(function () {
                            //captchaObj.show();
                        });
                        captchaObj.appendTo("#verifycode_embed");
                    };

                    $.ajax({
                        url : '<?php echo url('tool/geetest',0);?>',
                        type: "get",
                        dataType: "json",
                        success: function (data) {
                        initGeetest({
                            gt: data.gt,
                            challenge: data.challenge,
                            product: "embed",
                            offline: !data.success
                        }, handlerPopup);
                    }
                    });
                </script>

                <div  id="verify-dialog" class="reveal-modal">
                    <h5><?php echo lang_admin('please_complete_the_following_validation_first');?></h5>
                    <div class="blank10"></div>
                    <a class="close-reveal-modal">×</a>
                    <div id="verifycode_embed"></div>
                </div>
                <?php } ?>



                <button class="button" type="submit"><?php echo lang_admin('login');?></button>
                <div style="margin-top:10px;text-align:right;">
                    <a title="<?php echo lang_admin('findpassword');?>" target="_blank" href="<?php echo $base_url;?>/index.php?case=user&act=getpass" class="help"><?php echo lang_admin('findpassword');?></a>
                    <span class="copy"><?php echo getCopyRight();?></span>
                </div>


            </form>



            <?php
        }
        if(get('submit')) {
        if(hasflash()) {
            echo '<div style="clear:both;margin:50px 0px;text-align:center;color:red;font-size:16px;font-weight:bold;color:red;">';
            echo flash();
        } else { ?>
        <div style="margin:50px 0px;padding-top:5px; text-align:center;font-size:16px;font-weight:bold;color:#fff;">
            <?php echo lang_admin('loginsuccess');?>
            <meta http-equiv="refresh" content="2;url=<?php echo $admin_url;?>&site=<?php echo front::get('site')?>">
            <?php
            }
            echo '</div>';
            }
            ?>

        </div>
    </div>
</body>
</html>
