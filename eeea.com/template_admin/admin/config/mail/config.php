



<form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
    <div class="main-right-box">
        <div class="box" id="box">
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
                <li>
                    <a data-dataurlname="<?php echo lang_admin('essential_information');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/site');?>" name="<?php echo lang_admin('essential_information');?>">
                        <?php echo lang_admin('essential_information');?>
                    </a>
                </li>
                <li class="active">
                    <a data-dataurlname="<?php echo lang_admin('mail_serve');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/mail');?>" name="<?php echo lang_admin('mail_serve');?>">
                        <?php echo lang_admin('mail_serve');?>
                    </a>
                </li>
                <li>
                    <a data-dataurlname="<?php echo lang_admin('third_party_code');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('thirdparty/index');?>" name="<?php echo lang_admin('third_party_code');?>">
                        <?php echo lang_admin('third_party_code');?>
                    </a>
                </li>
                <li>
                    <a data-dataurlname="<?php echo lang_admin('map_settings');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/ditu');?>" name="<?php echo lang_admin('map_settings');?>">
                        <?php echo lang_admin('map_settings');?>
                    </a>
                </li>
            </ul>

            <div class="blank30"></div>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['smtp_mail_host']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("smtp_mail_host",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['smtp_mail_host']['message']) && $from['smtp_mail_host']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['smtp_mail_host']['message'];?>" data-original-title="<?php echo $from['smtp_mail_host']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['smtp_mail_port']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("smtp_mail_port",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['smtp_mail_port']['message']) && $from['smtp_mail_port']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['smtp_mail_port']['message'];?>" data-original-title="<?php echo $from['smtp_mail_port']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['smtp_mail_auth']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("smtp_mail_auth",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['smtp_mail_auth']['message']) && $from['smtp_mail_auth']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['smtp_mail_auth']['message'];?>" data-original-title="<?php echo $from['smtp_mail_auth']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['smtp_user_add']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("smtp_user_add",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['smtp_user_add']['message']) && $from['smtp_user_add']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['smtp_user_add']['message'];?>" data-original-title="<?php echo $from['smtp_user_add']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['smtp_mail_username']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("smtp_mail_username",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['smtp_mail_username']['message']) && $from['smtp_mail_username']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['smtp_mail_username']['message'];?>" data-original-title="<?php echo $from['smtp_mail_username']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['smtp_mail_password']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("smtp_mail_password",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['smtp_mail_password']['message']) && $from['smtp_mail_password']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['smtp_mail_password']['message'];?>" data-original-title="<?php echo $from['smtp_mail_password']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
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
                </div>
            </div>
        </div>
</form>




