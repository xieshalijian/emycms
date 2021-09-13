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
<div class="blank20"></div>
<div class="box" id="box">
    <div class="cache-view">
<iframe id="I2" class="generation_html" id="generation_html" src="{$base_url}/sitemap.php" width="100%" height="600" frameborder="0" style="font-size:12px;color:#fff"></iframe>
    </div>
<div class="blank30"></div>
</div>
</div>