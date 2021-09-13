


        <form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
            <div class="main-right-box">
                <h5>                   <?php echo lang_admin('set_up');?>                           <!--工具栏-->
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
                <?php
                if (is_array($from))
                    foreach ($configtitle as $titlekey=>$titleval){  ?>
                        <li role="presentation" class="tag_<?php echo $titlekey;?> <?php if ($titlekey==$set){ ?> active <?php } ?>">
                            <?php if($titlekey=="template_online"){?>
                                <a data-dataurlname=" <?php echo $titleval;?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('expansion/buytemplate');?>"   href="#tag1" name="<?php echo $titlekey;?>" role="tab" data-toggle="tab">
                                    <?php echo $titleval;?>
                                </a>
                            <?php }elseif($titlekey=="buymodules_online"){ ?>
                                <a data-dataurlname=" <?php echo $titleval;?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('expansion/buymodules');?>"   href="#tag1" name="<?php echo $titlekey;?>" role="tab" data-toggle="tab">
                                    <?php echo $titleval;?>
                                </a>
                            <?php }else{ ?>
                                <a data-dataurlname=" <?php echo $titleval;?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/'.$titlekey);?>"   href="#tag1" name="<?php echo $titlekey;?>" role="tab" data-toggle="tab">
                                    <?php echo $titleval;?>
                                </a>
                            <?php };?>
                        </li>
                    <?php }?>
            </ul>
            <div class="blank30"></div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['isdebug']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("isdebug",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['isdebug']['message']) && $from['isdebug']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['isdebug']['message'];?>" data-original-title="<?php echo $from['isdebug']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['lang_type']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("lang_type",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['lang_type']['message']) && $from['lang_type']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['lang_type']['message'];?>" data-original-title="<?php echo $from['lang_type']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['nav_top']['remarks'];?>：</div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['shield_right_key']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("shield_right_key",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['shield_right_key']['message']) && $from['nav_top']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['shield_right_key']['message'];?>" data-original-title="<?php echo $from['shield_right_key']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['nav_blank']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("nav_blank",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['nav_blank']['message']) && $from['nav_top']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['nav_blank']['message'];?>" data-original-title="<?php echo $from['nav_blank']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['isecoding']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("isecoding",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['isecoding']['message']) && $from['isecoding']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['isecoding']['message'];?>" data-original-title="<?php echo $from['isecoding']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['template_view']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("template_view",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['template_view']['message']) && $from['template_view']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['template_view']['message'];?>" data-original-title="<?php echo $from['template_view']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['ueditor_open']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ueditor_open",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ueditor_open']['message']) && $from['ueditor_open']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ueditor_open']['message'];?>" data-original-title="<?php echo $from['ueditor_open']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['history_num']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("history_num",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['history_num']['message']) && $from['history_num']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['history_num']['message'];?>" data-original-title="<?php echo $from['history_num']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['show_top_text']['remarks'];?>：</div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['onerror_pic']['remarks'];?>：</div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['thumb_width']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("thumb_width",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['thumb_width']['message']) && $from['thumb_width']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['thumb_width']['message'];?>" data-original-title="<?php echo $from['thumb_width']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['thumb_height']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("thumb_height",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['thumb_height']['message']) && $from['thumb_height']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['thumb_height']['message'];?>" data-original-title="<?php echo $from['thumb_height']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['manage_pagesize']['remarks'];?>：</div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['list_pagesize']['remarks'];?>：</div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['like_news']['remarks'];?>：</div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['search_time']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("search_time",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['search_time']['message']) && $from['search_time']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['search_time']['message'];?>" data-original-title="<?php echo $from['search_time']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['maxhotkeywordnum']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("maxhotkeywordnum",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['maxhotkeywordnum']['message']) && $from['maxhotkeywordnum']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['maxhotkeywordnum']['message'];?>" data-original-title="<?php echo $from['maxhotkeywordnum']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['archive_introducelen']['remarks'];?>：</div>
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

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['ecoding']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ecoding",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ecoding']['message']) && $from['ecoding']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ecoding']['message'];?>" data-original-title="<?php echo $from['ecoding']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['qrcodes']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qrcodes",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qrcodes']['message']) && $from['qrcodes']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qrcodes']['message'];?>" data-original-title="<?php echo $from['qrcodes']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['buymodules_view']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("buymodules_view",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['buymodules_view']['message']) && $from['buymodules_view']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['buymodules_view']['message'];?>" data-original-title="<?php echo $from['buymodules_view']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['extend_view']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("extend_view",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['extend_view']['message']) && $from['extend_view']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['extend_view']['message'];?>" data-original-title="<?php echo $from['extend_view']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['opguestadd']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("opguestadd",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['opguestadd']['message']) && $from['opguestadd']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['opguestadd']['message'];?>" data-original-title="<?php echo $from['opguestadd']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['html_wow']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("html_wow",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['html_wow']['message']) && $from['html_wow']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['html_wow']['message'];?>" data-original-title="<?php echo $from['html_wow']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['share']['remarks'];?>：</div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['hotsearch']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("hotsearch",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['hotsearch']['message']) && $from['hotsearch']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['hotsearch']['message'];?>" data-original-title="<?php echo $from['hotsearch']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['video_url']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("video_url",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['video_url']['message']) && $from['video_url']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['video_url']['message'];?>" data-original-title="<?php echo $from['video_url']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['cache_make_open']['remarks'];?>：</div>
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

                </div>
            </div>
        </div>
        </form>




