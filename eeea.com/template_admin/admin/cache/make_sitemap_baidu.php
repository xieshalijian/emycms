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
    <h5>{lang_admin('generating_baidu_map_xml')}</h5>

    <div class="box" id="box">
        <div class="blank20"></div>

        <div class="cache-html">
            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3 pull-left cache-html-side">

                <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=cache&act=make_sitemap_google&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('generating_google_map_xml')}">
                    {lang_admin('generating_google_map_xml')}
                </a>
                <a class="active" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=cache&act=make_sitemap_baidu&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('generating_baidu_map_xml')}">
                    {lang_admin('generating_baidu_map_xml')}
                </a>
                <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=cache&act=make_sitemap_map&admin_dir={get('admin_dir',true)}&site=default" >
                    {lang_admin('site_map')} Html
                </a>

            </div>
            <div class="col-xs-12 col-sm-7 col-md-9 col-lg-9 pull-right cache-html-content">

                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="glyphicon glyphicon-warning-sign"></span>	 <strong>{lang_admin('generating_baidu_map_xml')} {lang_admin('address')}</strong>	<a href="{get('site_url')}sitemap.txt" target="_blank">{get('site_url')}sitemap.txt</a>
                </div>

                <div class="blank30"></div>

                <form name='formxmlmap' method='post' action='<?php echo url('cache/make_baidu') ?>' onsubmit="return returnform(this);">

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('total_output_quantity')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <input name='XmlOutNum' id='XmlOutNum' value='50000' class="form-control" />
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('total_map_output')}"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('number_of_links_per_page')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <input name='XmlMaxPerPage' value='50000' id='XmlMaxPerPage' class="form-control" />
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('the_number_of_links_per_page_should_not_exceed_100')}"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('update_frequency')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <input name='frequency' id='frequency' value='144' class="form-control" />
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('update_cycle_in_minutes')}"></span>
                        </div>
                    </div>


                    <div class="blank30"></div>
                    <div class="line"></div>
                    <div class="blank30"></div>
                    <input  name="submit" value="1" type="hidden">
                    <input   type='submit' id='submit' value="{lang_admin('generate')}" class="btn btn-primary btn-lg">
                </form>
                <div class="blank30"></div>
            </div>
        </div>
    </div>
</div>