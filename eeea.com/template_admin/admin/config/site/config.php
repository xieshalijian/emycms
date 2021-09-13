

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
                <li class="active">
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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong>网站基本信息</strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['stop_site']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("stop_site",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['stop_site']['message']) && $from['stop_site']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['stop_site']['message'];?>" data-original-title="<?php echo $from['stop_site']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['user_outtime']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("user_outtime",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['user_outtime']['message']) && $from['user_outtime']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['user_outtime']['message'];?>" data-original-title="<?php echo $from['user_outtime']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['site_url']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_url",$from,null,$data); ?>

                            <!-- 提示信息 -->
                            <?php if(isset($from['site_url']['message']) && $from['site_url']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_url']['message'];?>" data-original-title="<?php echo $from['site_url']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['sitename']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("sitename",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['sitename']['message']) && $from['sitename']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['sitename']['message'];?>" data-original-title="<?php echo $from['sitename']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['fullname']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("fullname",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['fullname']['message']) && $from['fullname']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['fullname']['message'];?>" data-original-title="<?php echo $from['fullname']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['site_keyword']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_keyword",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['site_keyword']['message']) && $from['site_keyword']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_keyword']['message'];?>" data-original-title="<?php echo $from['site_keyword']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['site_description']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_description",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['site_description']['message']) && $from['site_description']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_description']['message'];?>" data-original-title="<?php echo $from['site_description']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['site_logo']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_logo",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['site_logo']['message']) && $from['site_logo']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_logo']['message'];?>" data-original-title="<?php echo $from['site_logo']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['site_ico']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_ico",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['site_ico']['message']) && $from['site_ico']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_ico']['message'];?>" data-original-title="<?php echo $from['site_ico']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="clearfix blank20"></div>
                    <div class="line"></div>
                    <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong>网站底部信息</strong></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                </div>
            </div>
            <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['site_right']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_right",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['site_right']['message']) && $from['site_right']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_right']['message'];?>" data-original-title="<?php echo $from['site_right']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['site_icp']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_icp",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['site_icp']['message']) && $from['site_icp']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_icp']['message'];?>" data-original-title="<?php echo $from['site_icp']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['icp_url']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("icp_url",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['icp_url']['message']) && $from['icp_url']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['icp_url']['message'];?>" data-original-title="<?php echo $from['icp_url']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['site_beian_number']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("site_beian_number",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['site_beian_number']['message']) && $from['site_beian_number']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['site_beian_number']['message'];?>" data-original-title="<?php echo $from['site_beian_number']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['saic_pic']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("saic_pic",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['saic_pic']['message']) && $from['saic_pic']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['saic_pic']['message'];?>" data-original-title="<?php echo $from['saic_pic']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="clearfix blank20"></div>
                    <div class="clearfix blank20"></div>
                    <div class="line"></div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"> <strong><?php echo lang_admin('contact_information');?> </strong></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['address']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("address",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['address']['message']) && $from['address']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['address']['message'];?>" data-original-title="<?php echo $from['address']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['tel']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("tel",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['tel']['message']) && $from['tel']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['tel']['message'];?>" data-original-title="<?php echo $from['tel']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['mobile']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("mobile",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['mobile']['message']) && $from['mobile']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['mobile']['message'];?>" data-original-title="<?php echo $from['mobile']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['fax']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("fax",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['fax']['message']) && $from['fax']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['fax']['message'];?>" data-original-title="<?php echo $from['fax']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['email']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("email",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['email']['message']) && $from['email']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['email']['message'];?>" data-original-title="<?php echo $from['email']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['complaint_email']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("complaint_email",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['complaint_email']['message']) && $from['complaint_email']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['complaint_email']['message'];?>" data-original-title="<?php echo $from['complaint_email']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>


                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['postcode']['remarks'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform("postcode",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['postcode']['message']) && $from['postcode']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['postcode']['message'];?>" data-original-title="<?php echo $from['postcode']['message'];?>"></span>
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




