
<form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
    <div class="main-right-box">

        <div class="box" id="box">
            <h5>
                {lang_admin('website_security')}
                <!--工具栏-->
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

            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('config/system/set/security')}" data-dataurlname="{lang_admin('website_security')}">
                        {lang_admin('website_security')}
                    </a>
                </li>
                <li>
                    <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('adminlogs/manage')}" data-dataurlname="{lang_admin('log_manage')}">
                        {lang_admin('log_manage')}
                    </a>
                </li>
                <li>
                    <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('database/str_replace')}" data-dataurlname="{lang_admin('replace_strings')}">
                        {lang_admin('replace_strings')}
                    </a>
                </li>

            </ul>
            <div class="blank30"></div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong><?php echo lang_admin('website_security');?></strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['admin_dir']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::input("admin_dir",$data['admin_dir'],'onkeyup="value=value.replace(/[^\w\.\/]/ig,\'\')"'); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['admin_dir']['message']) && $from['admin_dir']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['admin_dir']['message'];?>" data-original-title="<?php echo $from['admin_dir']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['isdebug']['remarks'];?></div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['session_ip']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("session_ip",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['session_ip']['message']) && $from['session_ip']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['session_ip']['message'];?>" data-original-title="<?php echo $from['session_ip']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>


                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ipcheck_enable']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("ipcheck_enable",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ipcheck_enable']['message']) && $from['ipcheck_enable']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ipcheck_enable']['message'];?>" data-original-title="<?php echo $from['ipcheck_enable']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['admin_nologin']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("admin_nologin",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['admin_nologin']['message']) && $from['admin_nologin']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['admin_nologin']['message'];?>" data-original-title="<?php echo $from['admin_nologin']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['loginfalsetime']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("loginfalsetime",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['loginfalsetime']['message']) && $from['loginfalsetime']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['loginfalsetime']['message'];?>" data-original-title="<?php echo $from['loginfalsetime']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['cookie_password']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("cookie_password",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['cookie_password']['message']) && $from['cookie_password']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['cookie_password']['message'];?>" data-original-title="<?php echo $from['cookie_password']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ueditor_open']['remarks'];?></div>
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
                    <div class="clearfix line"></div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong><?php echo lang_admin('search');?></strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>



                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['hotsearch']['remarks'];?></div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['search_time']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <div class="input-group">
                                <?php    echo form::getform("search_time",$from,null,$data); ?>
                                <div class="input-group-addon"><?php echo lang_admin('minute');?> </div>
                            </div>
                            <!-- 提示信息 -->
                            <?php if(isset($from['search_time']['message']) && $from['search_time']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['search_time']['message'];?>" data-original-title="<?php echo $from['search_time']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['maxhotkeywordnum']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <div class="input-group">
                                <?php    echo form::getform("maxhotkeywordnum",$from,null,$data); ?>
                                <div class="input-group-addon"><?php echo lang_admin('second');?> </div>
                            </div>
                            <!-- 提示信息 -->
                            <?php if(isset($from['maxhotkeywordnum']['message']) && $from['maxhotkeywordnum']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['maxhotkeywordnum']['message'];?>" data-original-title="<?php echo $from['maxhotkeywordnum']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="clearfix line"></div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong><?php echo lang_admin('other');?></strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['template_view']['remarks'];?></div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['buymodules_view']['remarks'];?></div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['extend_view']['remarks'];?></div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['html_wow']['remarks'];?></div>
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['opguestadd']['remarks'];?></div>
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


                    <div class="clearfix blank20"></div>
                    <div class="line"></div>
                    <div class="clearfix blank20"></div>
                    <!--验证码-->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong><?php echo lang_admin('verification_code');?></strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['verifycode']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("verifycode",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['verifycode']['message']) && $from['verifycode']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['verifycode']['message'];?>" data-original-title="<?php echo $from['verifycode']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="blank20"></div>
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                        <strong>
                            <?php echo lang_admin('polar_verification_background_ID');?>
                        </strong>
                    </div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    </div>
                    <div class="blank20"></div>
                    <style type="text/css">
                        .alert {margin:0px;}
                        #pic_enable_info {display:none;}
                    </style>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['gee_id']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("gee_id",$from,null,$data); ?>
                            <a href="https://auth.geetest.com/register" target="_blank" class="btn-navy-sms"><?php echo lang_admin("registered_user");?></a>
                            <!-- 提示信息 -->
                            <?php if(isset($from['gee_id']['message']) && $from['gee_id']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['gee_id']['message'];?>" data-original-title="<?php echo $from['gee_id']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['gee_key']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("gee_key",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['gee_key']['message']) && $from['gee_id']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['gee_key']['message'];?>" data-original-title="<?php echo $from['gee_key']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>


                    <div class="clearfix blank20"></div>
                    <div class="line"></div>
                    <div class="clearfix blank20"></div>

                    <!--敏感字符-->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong><?php echo lang_admin('filtering_sensitive_vocabulary');?></strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['filter_word']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php echo form::getform("filter_word",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['filter_word']['message']) && $from['filter_word']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['filter_word']['message'];?>" data-original-title="<?php echo $from['filter_word']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['filter_x']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php echo form::getform("filter_x",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['filter_x']['message']) && $from['filter_x']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['filter_x']['message'];?>" data-original-title="<?php echo $from['filter_x']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="clearfix blank20"></div>
                    <div class="line"></div>
                    <div class="clearfix blank20"></div>

                    <!--附件-->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong><?php echo lang_admin('enclosure');?></strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['upload_max_filesize']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <div class="input-group">
                                <?php    echo form::getform("upload_max_filesize",$from,null,$data); ?>
                                <div class="input-group-addon"><?php echo lang_admin('M');?> </div>
                            </div>
                            <!-- 提示信息 -->
                            <?php if(isset($from['upload_max_filesize']['message']) && $from['upload_max_filesize']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['upload_max_filesize']['message'];?>" data-original-title="<?php echo $from['upload_max_filesize']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>

                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['is_attachment_intro']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php    echo form::getform("is_attachment_intro",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['is_attachment_intro']['message']) && $from['is_attachment_intro']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['is_attachment_intro']['message'];?>" data-original-title="<?php echo $from['is_attachment_intro']['message'];?>"></span>
                            <?php };?>
                            <p class="tips-p">对上传的文件名自动进行重命名，重命名文件名称有利于减少异常</p>
                        </div>
                    </div>

                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['attachment_time']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <div class="input-group">
                                <input type="text" name="attachment_time" id="attachment_time" value="<?php echo $data['attachment_time'];?>" class="form-control "onkeyup="this.value=this.value.replace(/[^\d]/g,'') ">
                                <div class="input-group-addon"><?php echo lang_admin('day');?> </div>
                            </div>

                            <!-- 提示信息 -->
                            <?php if(isset($from['attachment_time']['message']) && $from['attachment_time']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['attachment_time']['message'];?>" data-original-title="<?php echo $from['attachment_time']['message'];?>"></span>
                            <?php };?>
                            <p class="tips-p">必须输入整数，对购买的下载文件进行时间限制，0为不限制</p>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['attachment_ip']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php echo form::getform("attachment_ip",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['attachment_ip']['message']) && $from['attachment_ip']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['attachment_ip']['message'];?>" data-original-title="<?php echo $from['attachment_ip']['message'];?>"></span>
                            <?php };?>
                            <p class="tips-p">对上传的文件名自动进行重命名，重命名文件名称有利于减少异常</p>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>


                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['upload_filetype']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php echo form::getform("upload_filetype",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['upload_filetype']['message']) && $from['upload_filetype']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['upload_filetype']['message'];?>" data-original-title="<?php echo $from['upload_filetype']['message'];?>"></span>
                            <?php };?>
                            <p class="tips-p">对上传的文件进行ip限制，空为不限制,多个逗号分隔</p>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="blank20"></div>
                    <div class="line"></div>
                    <div class="blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-8 text-left">
                            <div class="form-group">
                                <input  name="dosubmit" value="1" type="hidden">
                                <input class="btn btn-primary btn-lg" type="submit" value="{lang_admin('preservation')}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            #bagsize {display:inline-block; width:auto;}
        </style>
    </div>
</form>