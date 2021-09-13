



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
                    <?php if(myconfig::getadmin('sms_on')=='0') { ?>
                        <script type="text/javascript">
                            $("input.mobilechk_enable, input.mobilechk_admin, input.mobilechk_reg, input.mobilechk_login, input.mobilechk_buy, input.mobilechk_form, input.mobilechk_comment, input.mobilechk_guestbook, input.sms_keyword, input.sms_maxnum, input.sms_reg_on, input.sms_guestbook_on, input.sms_form_admin_on, input.sms_guestbook_admin_on, select.sms_order_on, input.sms_order_admin_on, input.sms_consult_admin_on, input.sms_form_on").attr("disabled","disabled");
                            $(".tag_3").css("display","none");
                        </script>
                    <?php } ?>
                    <!-- 短信设置 -->
                    <div style="padding:0px 20px;">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <span class="glyphicon glyphicon-warning-sign"></span>	<?php echo lang_admin('tips');?></span>
                            <?php echo lang_admin('prior_to_recharging');?>&nbsp;&nbsp;<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn btn-gray"><?php echo lang_admin('registered_user');?></a>&nbsp;&nbsp;！<?php echo lang_admin('change_the_account_and_password_in_the_sms_settings_to_the_registered_user_and_password');?><?php echo lang_admin('at');?>&nbsp;&nbsp;
                            <a href="#tag2" aria-controls="#tag2" role="tab" data-toggle="tab" class="btn btn-default"><?php echo lang_admin('short_message_manage');?></a>&nbsp;&nbsp;<?php echo lang_admin('after_recharging_sms_it_can_be_used_properly');?>
                        </div>
                    </div>
                    <style type="text/css">
                        #sms_explain {display:none;}
                    </style>

                </div>
            </div>
        </div>
            </div>
        </form>



