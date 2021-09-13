<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta name="Generator" content="CmsEasy 7_7_5_20210905_UTF8" />
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo get('sitename'); ?>	-	<?php if($pass) { ?><?php echo lang_admin('fill_in_database_information');?><?php } else { ?><?php echo lang_admin('detecting_database_links');?><?php } ?></title>
    <link rel="shortcut icon" href="<?php echo $base_url;?>/favicon.ico" type="image/x-icon" />
    <!-- 调用样式表 -->
    <link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url;?>/common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery.min.js"></script>

    <style type="text/css">

        body {
            font-size:14px;
            line-height:180%;
            background:#EEEEEE;
        }
        a:link {
            text-decoration:none;
        }
        a:visited {
            text-decoration:none;
        }
        a:hover {
            text-decoration:none;
        }
        a:active {
            text-decoration:none;
        }
        * {
            outline: none;
        }
        :focus {
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

        .install {
            position: absolute;
            left:0; right:0;
            z-index:999;
            width:588px;
            margin: 15px auto;
            max-width: 100%;
        }
        @media (max-width: 768px) {
            .install {
                width:100%;
            }
        }
        .version {float:right; font-size:8px;color:#888;padding-bottom: 10px;}
        .install-box {
            background-color: white;
            border: 1px solid #e5e5e5;
            border-radius: 2px;
            clear: both;
            background-color: #fff;
            box-shadow: 0 .126rem .26rem rgba(0,0,0,.066)!important;box-sizing: border-box;
            padding: 0px 25px 25px 25px;
        }
        .logo {
            text-align: center;
            margin: 50px 0px 5px 0px;
            padding-bottom:25px;
            border-bottom:1px solid #eee;
        }
        .logo img {width:188px;}
        .form-group label {position: relative;}
        .tips {
            color: #ccc;
            cursor:help
        }
        .tooltip {
            width:188px;
            text-align:left;
        }
        .install-content h3 {margin:15px 0px;padding:15px 0px;border-bottom:1px solid #eee;font-size: 150%;
            line-height: 150%;font-weight:500;}
        .form-control {border-radius: 2px;}
        .blank5, .blank10, .blank20,.blank30 { clear: both; height: 5px; }
        .blank10 { height: 10px; }
        .blank20 { height: 20px; }
        .blank30 { height: 30px; }
        .padding10 { padding: 10px; }
        .readpact {margin:15px;padding:15px 0px;border-top:1px solid #eee;}
        .readpact label a {color: #666; font-weight:normal; font-size:0.8rem;}
        .install-content .btn {background:#fff;border:1px solid #ccc;border-radius: 2px;}
        .install-content .btn-install {color: #fff;
            background-color: #009cff;
            border-color: #009cff;border-radius: 2px;font-size: 1.385rem;
            height: 3.385rem;
            padding: 0 1.538rem;}
        .install-content .btn-install:hover {opacity: 0.8;}
        .install-content h3.autotype {font-size:1.2rem;}
        .copy {font-size:0.8rem;color:#ccc;padding:10px 0px;}
        #view { height:180px;min-height:180px; overflow:hidden; padding: 10px;background: #fff;border: 1px solid #CCC;line-height: 200%; font-size:12px; color:#888; }
        .copy a {color:#ccc;}
    </style>

</head>
<body>


<div class="install">
    <small class="version">V.<?php echo _VERCODE;?></small>
    <div class="install-box">
        <div class="logo">
            <a href="https://www.cmseasy.cn/" target="_blank"><img src="./images/logo.png"></a>
        </div>
        <div class="install-content">
            <h3 class="autotype"><?php echo lang_admin('installing_data_sheet');?></h3>
            <iframe name="view" id="view"  src="<?php echo url::create('install/database'); ?>" width="100%" height="180" color="#888"></iframe>

            <div class="blank30"></div>
        </div>
        </form>
    </div>
    <div class="copy pull-right"><?php echo getCopyRight();?></div>
</div>

</div>



<script language="javascript" type="text/javascript">
    function changebutton(){
        document.getElementById('installbutton').value="<?php echo lang_admin('installation_is_in_progress');?>";
    }
</script>

<script type="text/javascript">
    <!--
    //信息<?php echo lang_admin('tips');?>框
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    //-->
</script>

<script type="text/javascript">
    <!--
    $.fn.autotype = function() {
        var $text = $(this);

        console.log('$text:', $text);
        var str = $text.html(); //返回被选 元素的内容
        console.log('str:', str);
        var index = 0;
        var x = $text.html('');
        console.log('x:', x);
        //$text.html()和$(this).html('')有区别

        var timer = setInterval(function() {
            //substr(index, 1) 方法在字符串中抽取从index下标开始的一个的字符
            var current = str.substr(index, 1);

            if (current == '<') {
                //indexOf() 方法返回">"在字符串中首次出现的位置。
                index = str.indexOf('>', index) + 1;
            } else {
                index++;
            }

            //console.log(["0到index下标下的字符",str.substring(0, index)],["符号",index & 1 ? '_': '']);
            //substring() 方法用于提取字符串中介于两个指定下标之间的字符
            $text.html(str.substring(0, index) + (index & 1 ? '_' : ''));
            index > $text.html().length + 10 && (index = 0);
            /*if(index >= str.length){
                clearInterval(timer);

            }*/
        }, 100);
    };
    $(".autotype").autotype();
    //-->
</script>

</body>
</html>