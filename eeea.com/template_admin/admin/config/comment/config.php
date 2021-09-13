


<form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
    <div class="main-right-box">
        <h5>                   <?php echo lang_admin('comment_manage');?>                           <!--工具栏-->
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
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['comment']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("comment",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['comment']['message']) && $from['comment']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['comment']['message'];?>" data-original-title="<?php echo $from['comment']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['comment_list']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("comment_list",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['comment_list']['message']) && $from['comment_list']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['comment_list']['message'];?>" data-original-title="<?php echo $from['comment_list']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['comment_num']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("comment_num",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['comment_num']['message']) && $from['comment_num']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['comment_num']['message'];?>" data-original-title="<?php echo $from['comment_num']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['comment_user']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("comment_user",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['comment_user']['message']) && $from['nav_top']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['comment_user']['message'];?>" data-original-title="<?php echo $from['comment_user']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['comment_time']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("comment_time",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['comment_time']['message']) && $from['comment_time']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['comment_time']['message'];?>" data-original-title="<?php echo $from['comment_time']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['comment_switch']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("comment_switch",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['comment_switch']['message']) && $from['comment_switch']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['comment_switch']['message'];?>" data-original-title="<?php echo $from['comment_switch']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['comment_title']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("comment_title",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['comment_title']['message']) && $from['comment_title']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['comment_title']['message'];?>" data-original-title="<?php echo $from['comment_title']['message'];?>"></span>
                        <?php };?>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $from['reply_comment']['remarks'];?>：</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php    echo form::getform("reply_comment",$from,null,$data); ?>
                        <!-- 提示信息 -->
                        <?php if(isset($from['reply_comment']['message']) && $from['reply_comment']['message']!='') { ?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php echo $from['reply_comment']['message'];?>" data-original-title="<?php echo $from['reply_comment']['message'];?>"></span>
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




