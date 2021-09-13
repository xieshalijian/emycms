<style type="text/css">
    #index_lading {z-index:-1;}
    .tab-content .alert {font-size:1.0rem;}
    .cache-html {position: relative;}
    .cache-html-side {
        position: relative; z-index:5;
    }
    .cache-html-side a {display:block; padding:5px 30px; border:1px solid #eee; border-radius: 3px; margin: 0px 30px 10px 0px; height:38px; overflow:hidden;}

    .cache-html-side a:hover {background:#888; box-shadow: 0 3px 0 0 rgba(0, 0, 0, 0.01), 0 5px 8px 0 rgba(0, 0, 0, 0.02); color:#fff; }
    .cache-html-side a.active:hover,.cache-html-side a.active {background:#fff;margin-right:-16px;border-radius: 3px 0px 0px 3px; border-right:none; box-shadow: -2px 5px 3px 0 rgba(0, 0, 0, 0.01), -5px 2px 5px 0 rgba(0, 0, 0, 0.02);color:#333;}

    .cache-html-content {position: relative; height:460px; border-left:1px solid #eee; z-index:2; padding-left:30px;}
    @media(max-width:468px) {
        .cache-html-content {margin:0px;}
        .cache-html-side {width:100%; clear:both; position: inherit; }
    }
    .cache-box {position: fixed; z-index:99999; top:0px; right:0px; bottom:0px; left:0px; background:rgba(0,0,0,0.5)}
    .cache-view {padding:15px; width:60%; margin:20% auto; box-shadow: 0 6px 0 0 rgba(0, 0, 0, 0.01), 0 15px 32px 0 rgba(0, 0, 0, 0.06);}
    .cache-view h3 {font-size:1.0rem;}
    .cache-view #view { height:180px;min-height:180px; overflow:hidden; padding: 10px;background: #333; color:#fff; border: 1px solid #eee;line-height: 200%; font-size:12px; border-radius: 3px; }
    .autotype {color:#fff;}
</style>
<div class="cache-box">
<div class="cache-view" >
    <h3 class="autotype">{lang_admin('being_generated')}： </h3>
    <iframe name="view" id="view"  src="<?php echo url::create('cache/cache_make_all'); ?>" width="100%" height="180" color="#fff"></iframe>
    <div class="blank30"></div>
</div>
</div>


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
            if(index >= str.length){
                setTimeout(function(){//3秒后跳转
                    gotoinurl("{uri()}");
                },3000);
                clearInterval(timer);

            }
        }, 100);
    };
    $(".autotype").autotype();
    //-->
</script>