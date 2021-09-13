


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


            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['mobile_open']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("mobile_open",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['mobile_open']['message']) && $from['mobile_open']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['mobile_open']['message'];?>" data-original-title="<?php echo $from['mobile_open']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['wap_logo']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("wap_logo",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['lang_type']['message']) && $from['wap_logo']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['wap_logo']['message'];?>" data-original-title="<?php echo $from['wap_logo']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['wap_style_color']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("wap_style_color",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['wap_style_color']['message']) && $from['wap_style_color']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['wap_style_color']['message'];?>" data-original-title="<?php echo $from['wap_style_color']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['wap_foot_nav']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("wap_foot_nav",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['wap_foot_nav']['message']) && $from['wap_foot_nav']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['wap_foot_nav']['message'];?>" data-original-title="<?php echo $from['wap_foot_nav']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['wap_foot_nav_position']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("wap_foot_nav_position",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['wap_foot_nav_position']['message']) && $from['wap_foot_nav_position']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['wap_foot_nav_position']['message'];?>" data-original-title="<?php echo $from['wap_foot_nav_position']['message'];?>"></span>
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
    </div>



