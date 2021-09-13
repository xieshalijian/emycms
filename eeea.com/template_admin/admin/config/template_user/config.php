

    <form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
        <div class="main-right-box">
            <div class="box" id="box">
            <h5>                   <?php echo lang_admin('template_user_dir');?>                           <!--工具栏-->
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
                    <li role="presentation" class="tag_template">
                        <a data-dataurlname="<?php echo lang_admin('template_manage');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template');?>"   href="#tag1" name="<?php echo lang_admin('template_manage');?>" role="tab" data-toggle="tab">
                            <?php echo lang_admin('template_manage');?>
                        </a>
                    </li>


                    <li role="presentation" class="tag_template_user active">
                        <a data-dataurlname="<?php echo lang_admin('template_other');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template_user');?>"   href="#tag1" name="<?php echo lang_admin('template_other');?>" role="tab" data-toggle="tab">
                            <?php echo lang_admin('template_other');?>
                        </a>
                    </li>

                    <?php if(file_exists(ROOT."/lib/table/shopping.php")){ ?>
                        <li role="presentation" class="tag_template_shopping">
                            <a data-dataurlname="<?php echo lang_admin('commodity_template');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template_shop');?>"   href="#tag1" name="<?php echo lang_admin('commodity_template');?>" role="tab" data-toggle="tab">
                                <?php echo lang_admin('commodity_template');?>
                            </a>
                        </li>
                    <?php };?>

                    <?php if(config::getadmin('mobile_open')==1) { ?>
                        <li role="presentation" class="tag_template_mobile ">
                            <a data-dataurlname="<?php echo lang_admin('template_mobile');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template_mobile');?>"   href="#tag1" name="<?php echo lang_admin('template_mobile');?>" role="tab" data-toggle="tab">
                                <?php echo lang_admin('template_mobile');?>
                            </a>
                        </li>
                    <?php };?>
                    <?php if(config::getadmin('template_view')==1) { ?>
                        <li role="presentation" class="tag_template_online ">
                            <a data-dataurlname="<?php echo lang_admin('template_online');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('expansion/buytemplate');?>"   href="#tag1" name="<?php echo lang_admin('template_online');?>" role="tab" data-toggle="tab">
                                <?php echo lang_admin('template_online');?>
                            </a>
                        </li>
                    <?php };?>
                    <?php if(config::getadmin('buymodules_view')==1) { ?>
                        <li role="presentation" class="tag_buymodules_online ">
                            <a data-dataurlname="<?php echo lang_admin('buymodules_online');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('expansion/buymodules');?>"   href="#tag1" name="<?php echo lang_admin('buymodules_online');?>" role="tab" data-toggle="tab">
                                <?php echo lang_admin('buymodules_online');?>
                            </a>
                        </li>
                    <?php };?>
                </ul>
            <div class="blank30"></div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tag1" name="tagdiv">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['template_admin_dir']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php  echo form::input("template_admin_dir",$data['template_admin_dir'],"readonly='readonly'");?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['template_admin_dir']['message']) && $from['template_admin_dir']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['template_admin_dir']['message'];?>" data-original-title="<?php echo $from['template_admin_dir']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['template_user_dir']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("template_user_dir",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['template_user_dir']['message']) && $from['template_user_dir']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['template_user_dir']['message'];?>" data-original-title="<?php echo $from['template_user_dir']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                </div>

            </div>
    </form>


