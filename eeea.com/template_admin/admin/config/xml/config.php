



        <form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
            <div class="main-right-box">
                <div class="box" id="box">
                <h5>                   <?php echo lang_admin('generating_xml');?>                           <!--工具栏-->
                    <div class="content-eidt-nav pull-right">
                        <!--全屏-->
                        <a id="fullscreen-btn" class="btn btn-default" style="display: none;">
                            <i class="icon-frame"></i>
                            <?php echo lang_admin('container_fluid');?>
                        </a>
                        <span class="pull-right">
                            <!--保存-->
                                                <input name="submit" value="1" type="hidden">
                                                    <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> {lang_admin('preservation')}                        </button>
                            <!--返回列表-->
                           <a href="#" onclick="gotohome()" data-dataurlname="<?php echo lang_admin('home');?>" class="btn btn-default">
                                 <i class="glyphicon glyphicon-trash"></i>
                            </a>
                            <!--关闭工具栏-->
                            <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                                <i class="icon-close"></i>
                            </a>
                        </span>
                    </div>
                </h5>

            <div id="content-eidt-nav"></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation">
                            <a data-dataurlname="<?php echo lang_admin('parameter_setting');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/dynamic');?>" name="<?php echo lang_admin('parameter_setting');?>">
                                <?php echo lang_admin('parameter_setting');?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a data-dataurlname="<?php echo lang_admin('ynamic_and_static_set_up');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/dynamic');?>" name="<?php echo lang_admin('ynamic_and_static_set_up');?>">
                                <?php echo lang_admin('dynamic_and_static_set_up');?>
                            </a>
                        </li>

                        <li role="presentation" class="active">
                            <a data-dataurlname="<?php echo lang_admin('generating_xml');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/xml');?>" name="<?php echo lang_admin('generating_xml');?>">
                                <?php echo lang_admin('generating_xml');?>
                            </a>
                        </li>
                        <li role="presentation">
                            <a data-dataurlname="<?php echo lang_admin('site_map');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('cache/make_sitemap_map');?>" name="<?php echo lang_admin('site_map');?>">
                                <?php echo lang_admin('site_map');?>
                            </a>
                        </li>
                    </ul>
                    <div class="blank20"></div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="glyphicon glyphicon-warning-sign"></span>	 <strong>{lang_admin('xml_generation')} {lang_admin('address')}</strong>	<a href="{get('site_url')}sitemap.xml" target="_blank">{get('site_url')}sitemap.xml</a>
                    </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['xml_sitemap_auto']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("xml_sitemap_auto",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['xml_sitemap_auto']['message']) && $from['xml_sitemap_auto']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['xml_sitemap_auto']['message'];?>" data-original-title="<?php echo $from['xml_sitemap_auto']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin("过滤栏目及内容");?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <input type="hidden" name="xml_sitemap_not1" value="<?php echo $data['xml_sitemap_not1'];?>">
                            <input type="hidden" name="xml_sitemap_not2" value="<?php echo $data['xml_sitemap_not2'];?>">

                            <input class="config config_sitesystem xml_xml_sitemap_not1" type="checkbox"  <?php if ($data['xml_sitemap_not1']==1) echo "checked";?> value="1" />
                            <?php echo$from['xml_sitemap_not1']['remarks'];?>
                            <input class="config xml_sitemap_not2 xml_xml_sitemap_not2" type="checkbox"  <?php if ($data['xml_sitemap_not2']==1) echo "checked";?>  value="1" />
                            <?php echo$from['xml_sitemap_not2']['remarks'];?>

                            <!-- 提示信息 -->
                           <p class="tips-p">
                               网站地图生成的栏目仅限一级栏目和显示在导航栏上栏目。
                               不显示内容与栏目，都不会在网站地图中生成。
                           </p>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['xml_sitemap_lang']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("xml_sitemap_lang",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['xml_sitemap_lang']['message']) && $from['xml_sitemap_lang']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['xml_sitemap_lang']['message'];?>" data-original-title="<?php echo $from['xml_sitemap_lang']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>


                    <div class="blank30"></div>
                    <div class="line"></div>
                    <div class="blank30"></div>
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value=" {lang_admin('preservation')} " class="btn btn-primary" />
                    <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=cache&act=make_xml&admin_dir={get('admin_dir',true)}&site=default"
                       class="btn btn-default"  >
                        <?php echo lang_admin('generating_xml');?>
                    </a>
                </div>
            </div>
        </div>
            </div>
        </form>


<script>
    $(function () {
        $(".xml_xml_sitemap_not1").click(function() {
           if (  $(this).is(':checked')){
               $("[name=xml_sitemap_not1]").val(1);
           } else{
               $("[name=xml_sitemap_not1]").val(0);
           }
        });

        $(".xml_xml_sitemap_not2").click(function() {
            if (  $(this).is(':checked')){
                $("[name=xml_sitemap_not2]").val(1);
            } else{
                $("[name=xml_sitemap_not2]").val(0);
            }
        });
    })
</script>


