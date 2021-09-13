


<form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
    <div class="main-right-box">
        <h5>                   <?php echo lang_admin('user_manage_settings');?>                           <!--工具栏-->
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



        <div class="blank30"></div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['reg_on']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("reg_on",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['reg_on']['message']) && $from['reg_on']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['reg_on']['message'];?>" data-original-title="<?php echo $from['reg_on']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['site_login']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("site_login",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['site_login']['message']) && $from['site_login']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['site_login']['message'];?>" data-original-title="<?php echo $from['site_login']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>
                <?php   if(file_exists(ROOT."/lib/table/invite.php")) {?>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['invitation_registration']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("invitation_registration",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['invitation_registration']['message']) && $from['invitation_registration']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['invitation_registration']['message'];?>" data-original-title="<?php echo $from['invitation_registration']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>
                <?php };?>


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
</form>




