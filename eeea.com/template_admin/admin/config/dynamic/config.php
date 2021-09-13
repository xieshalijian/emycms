<style type="text/css">
    .alert {margin:0px;}
    #pc_html_info {display:none;}
</style>


<form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
    <div class="main-right-box">
        <div class="box" id="box">
            <h5>                   <?php echo lang_admin('dynamic_and_static_set_up');?>                           <!--工具栏-->
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
                <li role="presentation" class="active">
                    <a href="#tag1" aria-controls="tag1" role="tab" data-toggle="tab">
                        <?php echo lang_admin('parameter_setting');?>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tag2" aria-controls="tag2" role="tab" data-toggle="tab">
                        <?php echo lang_admin('dynamic_and_static_set_up');?>
                    </a>
                </li>
                <li role="presentation">
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
            <div class="blank30"></div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">
                    <div class="row">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['cache_make_open']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("cache_make_open",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['cache_make_open']['message']) && $from['cache_make_open']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['cache_make_open']['message'];?>" data-original-title="<?php echo $from['cache_make_open']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['list_cache']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("list_cache",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['list_cache']['message']) && $from['list_cache']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['list_cache']['message'];?>" data-original-title="<?php echo $from['list_cache']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['list_cache_time']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("list_cache_time",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['list_cache_time']['message']) && $from['list_cache_time']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['list_cache_time']['message'];?>" data-original-title="<?php echo $from['list_cache_time']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['group_on']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("group_on",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['group_on']['message']) && $from['group_on']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['group_on']['message'];?>" data-original-title="<?php echo $from['group_on']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['group_count']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("group_count",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['group_count']['message']) && $from['group_count']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['group_count']['message'];?>" data-original-title="<?php echo $from['group_count']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['group_count']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("group_count",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['group_count']['message']) && $from['group_count']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['group_count']['message'];?>" data-original-title="<?php echo $from['group_count']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>


                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['share']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("share",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['share']['message']) && $from['share']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['share']['message'];?>" data-original-title="<?php echo $from['share']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['show_top_text']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("show_top_text",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['show_top_text']['message']) && $from['show_top_text']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['show_top_text']['message'];?>" data-original-title="<?php echo $from['show_top_text']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>


                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['nav_top']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("nav_top",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['nav_top']['message']) && $from['nav_top']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['nav_top']['message'];?>" data-original-title="<?php echo $from['nav_top']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['shield_right_key']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("shield_right_key",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['shield_right_key']['message']) && $from['shield_right_key']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['shield_right_key']['message'];?>" data-original-title="<?php echo $from['shield_right_key']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['nav_blank']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("nav_blank",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['nav_blank']['message']) && $from['nav_blank']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['nav_blank']['message'];?>" data-original-title="<?php echo $from['nav_blank']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['onerror_pic']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("onerror_pic",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['onerror_pic']['message']) && $from['onerror_pic']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['onerror_pic']['message'];?>" data-original-title="<?php echo $from['onerror_pic']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>


                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['manage_pagesize']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("manage_pagesize",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['manage_pagesize']['message']) && $from['manage_pagesize']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['manage_pagesize']['message'];?>" data-original-title="<?php echo $from['manage_pagesize']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>


                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['list_pagesize']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("list_pagesize",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['list_pagesize']['message']) && $from['list_pagesize']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['list_pagesize']['message'];?>" data-original-title="<?php echo $from['list_pagesize']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>


                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['like_news']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("like_news",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['like_news']['message']) && $from['like_news']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['like_news']['message'];?>" data-original-title="<?php echo $from['like_news']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>


                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['archive_introducelen']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("archive_introducelen",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['archive_introducelen']['message']) && $from['archive_introducelen']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['archive_introducelen']['message'];?>" data-original-title="<?php echo $from['archive_introducelen']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>



                    </div>





                </div>
                <div role="tabpanel" class="tab-pane" id="tag2" name="tagdiv">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['html_prefix']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("html_prefix",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['html_prefix']['message']) && $from['html_prefix']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['html_prefix']['message'];?>" data-original-title="<?php echo $from['html_prefix']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['list_index_php']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("list_index_php",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['list_index_php']['message']) && $from['list_index_php']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['list_index_php']['message'];?>" data-original-title="<?php echo $from['list_index_php']['message'];?>"></span>
                            <?php };?>
                            <?php if($data['list_index_php']=='1'){?>
                                &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="index" ><?php echo lang_admin('generating_static_state');?></a>
                            <?php }; ?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['list_page_php']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("list_page_php",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['list_page_php']['message']) && $from['list_page_php']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['list_page_php']['message'];?>" data-original-title="<?php echo $from['list_page_php']['message'];?>"></span>
                            <?php };?>
                            <?php  if($data['list_page_php']=='1'){?>
                                &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="list" ><?php echo lang_admin('generating_static_state');?></a>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['show_page_php']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("show_page_php",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['show_page_php']['message']) && $from['show_page_php']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['show_page_php']['message'];?>" data-original-title="<?php echo $from['show_page_php']['message'];?>"></span>
                            <?php };?>
                            <?php if( $data['show_page_php']=='1'){?>
                                &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="show" ><?php echo lang_admin('generating_static_state');?></a>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
					<?php  if(file_exists(ROOT."/lib/table/type.php")) { ?>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['list_type_php']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("list_type_php",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['list_type_php']['message']) && $from['list_type_php']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['list_type_php']['message'];?>" data-original-title="<?php echo $from['list_type_php']['message'];?>"></span>
                            <?php };?>
                            <?php  if( $data['list_type_php']=='1'){?>
                                &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="type" ><?php echo lang_admin('generating_static_state');?></a>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
					 <?php };?>
                    <?php  if(file_exists(ROOT."/lib/table/special.php")) { ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['list_special_php']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("list_special_php",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['list_special_php']['message']) && $from['list_special_php']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['list_special_php']['message'];?>" data-original-title="<?php echo $from['list_special_php']['message'];?>"></span>
                                <?php };?>
                                <?php  if($data['list_special_php']=='1'){?>
                                    &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="special" ><?php echo lang_admin('generating_static_state');?></a>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                    <?php };?>
                    <?php  if(file_exists(ROOT."/lib/table/tag.php")) { ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['tag_html']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("tag_html",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['tag_html']['message']) && $from['tag_html']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['tag_html']['message'];?>" data-original-title="<?php echo $from['tag_html']['message'];?>"></span>
                                <?php };?>
                                <?php  if($data['tag_html']=='1'){?>
                                    &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="tag" ><?php echo lang_admin('generating_static_state');?></a>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                    <?php };?>

                    <?php if(config::getadmin('mobile_open')==1) { ?>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wap_html_prefix']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("wap_html_prefix",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['wap_html_prefix']['message']) && $from['wap_html_prefix']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['wap_html_prefix']['message'];?>" data-original-title="<?php echo $from['wap_html_prefix']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wap_index_php']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("wap_index_php",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['wap_index_php']['message']) && $from['wap_index_php']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['wap_index_php']['message'];?>" data-original-title="<?php echo $from['wap_index_php']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wap_list_page_php']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("wap_list_page_php",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['wap_list_page_php']['message']) && $from['wap_list_page_php']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['wap_list_page_php']['message'];?>" data-original-title="<?php echo $from['wap_list_page_php']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wap_show_page_php']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("wap_show_page_php",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['wap_show_page_php']['message']) && $from['wap_show_page_php']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['wap_show_page_php']['message'];?>" data-original-title="<?php echo $from['wap_show_page_php']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
						<?php  if(file_exists(ROOT."/lib/table/type.php")) { ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wap_type_php']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("wap_type_php",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['wap_type_php']['message']) && $from['wap_type_php']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['wap_type_php']['message'];?>" data-original-title="<?php echo $from['wap_type_php']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
						<?php };?>
						<?php  if(file_exists(ROOT."/lib/table/special.php")) { ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wap_special_php']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("wap_special_php",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['wap_special_php']['message']) && $from['wap_special_php']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['wap_special_php']['message'];?>" data-original-title="<?php echo $from['wap_special_php']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
						<?php };?>
						<?php  if(file_exists(ROOT."/lib/table/tag.php")) { ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wap_tag_html']['remarks'];?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php    echo form::getform("wap_tag_html",$from,null,$data); ?>
                                <!-- 提示信息 -->
                                <?php if(isset($from['wap_tag_html']['message']) && $from['wap_tag_html']['message']!='') { ?>
                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                          title="<?php echo $from['wap_tag_html']['message'];?>" data-original-title="<?php echo $from['wap_tag_html']['message'];?>"></span>
                                <?php };?>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
						<?php };?>
                    <?php }?>

                    <style type="text/css">
                        .alert {margin:0px;}
                        #urlrewrite_info {display:none;}
                    </style>
                    <div class="clearfix blank20"></div>
                </div>
       

            <div class="clearfix"></div>

        </div>
            <div class="blank20"></div>
            <div class="line"></div>
            <div class="blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <div class="form-group">
                        <input  name="dosubmit" value="1" type="hidden">
                        <input class="btn btn-primary btn-lg" type="submit" value="{lang_admin('preservation')}">
                    </div>
                </div>
            </div>
    </div>
</form>


<?php  if (front::get('mache_type')){ ?>
    <script>
        var mode="<?php echo front::get('mache_type'); ?>";
        open_mode(mode,true);
    </script>
<?php  } ?>
<?php  if ($set=="dynamic"){ ?>
    <style>
        .html-name {color:#fff;}
        .html-name a {display:block; color:#fff;}
        .html-loading {overflow-y: scroll; background:#333;height:460px;border:1px solid rgba(0,0,0,0.3); color:#fff;}
        .html-name p {margin-bottom: 8px;
            border: 1px solid rgba(255,255,255,0.3);
            padding-left: 15px; position: relative;}
        .html-name p:hover {background:#333;border-color: #333;}
        .html-name p:hover:after {content: "\e098"; position: absolute; top:0px; right:0px; width:20px; height:20px;font-family: 'Simple-Line-Icons' !important; color:#fff; font-size:14px;}
        .html-name {height:460px; overflow-y: scroll;}
    </style>
    <div class="modal fade" id="my_cache_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                    </button>
                    <h4>
                        <?php echo lang_admin('generating_static_state');?>
                    </h4>
                </div>
                <div class="modal-body  " data-url="seo/html" data-dataurl="" data-refresh="1" data-tablerefresh="undefined" data-tablerefresh-type="undefined" data-load="" data-title="<?php echo lang_admin('generating_static_state');?>" style="overflow: hidden;">
                    <div class="col-md-5 html-name" name="doGetHtml">

                    </div>
                    <div class="modal-html">
                        <div class="col-md-7 html-loading">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 当前页面的js -->
    <script>var admin_lang='<?php echo lang::getisadmin();?>';var template_lang='<?php echo lang::getistemplate();?>';</script>
    <script type="text/javascript" src="<?php echo $base_url.'/template_admin/'.front::$view->_style;?>/config/system_dynamic.js"></script>
<?php } ?>


