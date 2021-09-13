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
    <h5>{lang_admin('generating_xml')}</h5>

    <div class="box" id="box">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation">
                <a data-dataurlname="<?php echo lang_admin('parameter_setting');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/dynamic');?>" name="<?php echo lang_admin('parameter_setting');?>">
                    <?php echo lang_admin('parameter_setting');?>
                </a>
            </li>
            <li role="presentation">
                <a data-dataurlname="<?php echo lang_admin('ynamic_and_static_set_up');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/dynamic');?>" name="<?php echo lang_admin('ynamic_and_static_set_up');?>">
                    <?php echo lang_admin('ynamic_and_static_set_up');?>
                </a>
            </li>
            <li role="presentation" class="active">
                <a data-dataurlname="<?php echo lang_admin('rewrite');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/dynamic');?>" name="<?php echo lang_admin('rewrite');?>">
                    <?php echo lang_admin('rewrite');?>
                </a>
            </li>
            <li role="presentation">
                <a data-dataurlname="<?php echo lang_admin('generating_xml');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/xml');?>" name="<?php echo lang_admin('generating_xml');?>">
                    <?php echo lang_admin('generating_xml');?>
                </a>
            </li>
            <li role="presentation" class="active">
                <a data-dataurlname="<?php echo lang_admin('site_map');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('cache/make_sitemap_map');?>" name="<?php echo lang_admin('site_map');?>">
                    <?php echo lang_admin('site_map');?>
                </a>
            </li>
        </ul>
        <div class="blank20"></div>

        <div class="cache-html">


                <form name='formxmlmap' method='post' action='<?php echo url('cache/make_google') ?>' onsubmit="return returnform(this);">

                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="glyphicon glyphicon-warning-sign"></span>	 <strong>{lang_admin('xml_generation')} {lang_admin('address')}</strong>	<a href="{get('site_url')}sitemap.xml" target="_blank">{get('site_url')}sitemap.xml</a>
                    </div>

                    <div class="blank20"></div>
                    <div class="line"></div>
                    <div class="blank20"></div>
                    <input  name="submit" value="1" type="hidden">
                    <input   type='submit' id='submit' value="{lang_admin('generate')}" class="btn btn-primary btn-lg">


                </form>
                <div class="blank30"></div>

        </div>
    </div>
</div>