<?php if(config::getadmin('mobile_open')==1 || config::getadmin('mobile_open')==2) { ?>
    <?php if(config::getadmin('wap_special_php')=='1')  { ?>
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

<div class="main-right-box">
<h5>{lang_admin('special_mobile_html')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

    <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=config&act=system&set=dynamic&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="btn btn-primary" data-dataurlname="{lang_admin('dynamic')}">
        <?php echo lang_admin('dynamic');?>
    </a>

    <a class="btn btn-default"href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=cache&act=make_special&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('topic_generation_html')}">
        <?php echo lang_admin('pc_html');?></a>
    </a>

    <hr />

    <div class="cache-html">
        <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3 pull-left cache-html-side">
            <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=wapcache&act=make_index&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('mobile_home_page_generation')} Html">{lang_admin('mobile_home_page_generation')}</a>
            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=wapcache&act=make_show&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('mobile_content_generation')} Html">{lang_admin('mobile_content_generation')}</a>
            <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=wapcache&act=make_list&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('mobile_column_generation')} Html">{lang_admin('mobile_column_generation')}</a>
            <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=wapcache&act=make_type&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('type_generation_of_mobile_phones')} Html">{lang_admin('type_generation_of_mobile_phones')}</a>
            <a class="active" href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=wapcache&act=make_special&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('mobile_theme_generation')} Html">{lang_admin('mobile_theme_generation')}</a>
            <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=wapcache&act=make_tag&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('mobile_label_generation')} Html">{lang_admin('mobile_label_generation')}</a>

        </div>
        <div class="col-xs-12 col-sm-7 col-md-9 col-lg-9 pull-right cache-html-content">



<form name="typeform" method="post" action="<?php echo front::$uri;?>" onsubmit="return returnform(this);">

    <div class="alert alert-warning alert-danger" role="alert">
        <span class="glyphicon glyphicon-warning-sign"></span>	<strong>{lang_admin('recommendation')}</strong> 	{lang_admin('just_generate_special')}
    </div>
    {lang_admin('special')}
    <div class="clearfix blank20"></div>
<?php
	$archive=archive::getInstance();
	echo form::select('specialid',get('specialid'),special::option());
	?>
    <div class="clearfix blank20"></div>
    <div class="clearfix line"></div>
    <div class="clearfix blank20"></div>
    <input  name="submit" value="1" type="hidden">
    <?php echo form::submit(lang_admin('update'));
    ?>
</form>
        </div>
    </div>
</div>
    <div class="blank30"></div>
</div>

 <?php } else { ?>
        <div class="main-right-box">
            <h5>{lang_admin('special_mobile_html')}</h5>
            <div class="blank20"></div>
            <div class="box" id="box">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="glyphicon glyphicon-warning-sign"></span>

                    <strong><?php echo lang_admin('tips');?>！</strong>


                    {lang_admin('mobile_special_usage_static_is_not_set')}， <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=config&act=system&set=dynamic&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('dynamic');?>" class="btn btn-info">
                        <?php echo lang_admin('go_set_up');?></a>
                </div>
            </div>
        </div>

    <?php } ?>
<?php } else { ?>
    <div class="main-right-box">
        <h5>{lang_admin('content_mobile_html')}</h5>
        <div class="blank20"></div>
        <div class="box" id="box">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-warning-sign"></span>

                <strong><?php echo lang_admin('tips');?>！</strong>
                {lang_admin('not_wap_set_up')}， <a title="" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=config&act=system&set=dynamic&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="{lang_admin('mobile_version')}" class="btn btn-info">{lang_admin('go_set_up')}</a>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (session::get("cahe_wap_make_special")){?>
    <div class="cache-box">
        <div class="cache-view"  >
            <h3 >{lang_admin('being_generated')}： </h3>
            <iframe class="autotype" name="view" id="view"  src="<?php echo url::create('wapcache/make_special/getshowstatic/1'); ?>" width="100%" height="180" color="#fff"></iframe>
            <div class="blank30"></div>
        </div>
    </div>
<?php };?>

<?php if (session::get("cahe_wap_make_special")){?>
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
                        gotoinurl('{url("wapcache/make_special")}');
                    },5000);
                    clearInterval(timer);

                }
            }, 100);
        };
        $(".autotype").autotype();
        //-->
    </script>
<?php };?>