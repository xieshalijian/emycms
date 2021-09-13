

        <form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
            <div class="main-right-box">
                <div class="box" id="box">
                <h5>                   <?php echo lang_admin('map_settings');?>                           <!--工具栏-->
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
                        <li>
                            <a data-dataurlname="<?php echo lang_admin('mail_serve');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/mail');?>" name="<?php echo lang_admin('mail_serve');?>">
                                <?php echo lang_admin('mail_serve');?>
                            </a>
                        </li>
                        <li>
                            <a data-dataurlname="<?php echo lang_admin('third_party_code');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('thirdparty/index');?>" name="<?php echo lang_admin('third_party_code');?>">
                                <?php echo lang_admin('third_party_code');?>
                            </a>
                        </li>
                        <li class="active">
                            <a data-dataurlname="<?php echo lang_admin('map_settings');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/ditu');?>" name="<?php echo lang_admin('map_settings');?>">
                                <?php echo lang_admin('map_settings');?>
                            </a>
                        </li>
                    </ul>

                    <div class="blank30"></div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_APK']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_APK",$from,null,$data); ?>
                            <a href="https://lbsyun.baidu.com" target="_blank" class="btn-navy-sms"><?php echo lang_admin("registered_user");?></a>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_APK']['message']) && $from['ditu_APK']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_APK']['message'];?>" data-original-title="<?php echo $from['ditu_APK']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_width']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_width",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_width']['message']) && $from['ditu_width']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_width']['message'];?>" data-original-title="<?php echo $from['ditu_width']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_height']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_height",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_height']['message']) && $from['ditu_height']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_height']['message'];?>" data-original-title="<?php echo $from['ditu_height']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_center_left']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_center_left",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_center_left']['message']) && $from['ditu_center_left']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_center_left']['message'];?>" data-original-title="<?php echo $from['ditu_center_left']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_center_right']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_center_right",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_center_right']['message']) && $from['ditu_center_right']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_center_right']['message'];?>" data-original-title="<?php echo $from['ditu_center_right']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_level']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_level",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_level']['message']) && $from['ditu_level']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_level']['message'];?>" data-original-title="<?php echo $from['ditu_level']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_title']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_title",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_title']['message']) && $from['ditu_title']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_title']['message'];?>" data-original-title="<?php echo $from['ditu_title']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_content']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_content",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_content']['message']) && $from['ditu_content']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_content']['message'];?>" data-original-title="<?php echo $from['ditu_content']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_maker_left']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_maker_left",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_maker_left']['message']) && $from['ditu_maker_left']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_maker_left']['message'];?>" data-original-title="<?php echo $from['ditu_maker_left']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_maker_right']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ditu_maker_right",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ditu_maker_right']['message']) && $from['ditu_maker_right']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ditu_maker_right']['message'];?>" data-original-title="<?php echo $from['ditu_maker_right']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ditu_explain']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <!-- 地图设置提示 -->
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    <?php echo lang_admin('instructions');?>：<br />
                    1、<?php echo lang_admin('first_click');?>	<a href="https://api.map.baidu.com/lbsapi/getpoint/index.html" class="btn btn-gray" target="_blank">&nbsp;<?php echo lang_admin('button');?>&nbsp;</a>	，<?php echo lang_admin('get_map_values');?>；<br />
                    2、<?php echo lang_admin('data_includes_current_level_current_coordinate_point');?>；<br />
                    3、<?php echo lang_admin('longitudinal_value_before_comma_of_coordinate_point');?>；<br />
                    4、<?php echo lang_admin('latitude_after_comma_of_coordinate_points');?>；<br />
                    5、<?php echo lang_admin('copy_the_latitude_and_longitude_values_to_the_latitude_and_longitude_input_box_in_the_background_and_submit_them');?><br />
                    6、<?php echo lang_admin('the_map_call_code_is');?> {&nbsp;template 'ditu.html'&nbsp;} ,<?php echo lang_admin('after_copying_please_delete_the_blanks');?>
                    <style type="text/css">
                        #ditu_explain {display:none;}
                    </style>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                </div>
            </div>
        </div>
            </div>
        </form>




