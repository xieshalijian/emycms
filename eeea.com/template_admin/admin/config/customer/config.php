





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
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ifonserver']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ifonserver",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ifonserver']['message']) && $from['ifonserver']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ifonserver']['message'];?>" data-original-title="<?php echo $from['ifonserver']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['server_template']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("server_template",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['server_template']['message']) && $from['server_template']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['server_template']['message'];?>" data-original-title="<?php echo $from['server_template']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['boxopen']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("boxopen",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['boxopen']['message']) && $from['boxopen']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['boxopen']['message'];?>" data-original-title="<?php echo $from['boxopen']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['serverlistp']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("serverlistp",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['serverlistp']['message']) && $from['serverlistp']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['serverlistp']['message'];?>" data-original-title="<?php echo $from['serverlistp']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['worktime']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("worktime",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['worktime']['message']) && $from['worktime']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['worktime']['message'];?>" data-original-title="<?php echo $from['worktime']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq1name']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq1name",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq1name']['message']) && $from['qq1name']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq1name']['message'];?>" data-original-title="<?php echo $from['qq1name']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq1']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq1",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq1']['message']) && $from['qq1']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq1']['message'];?>" data-original-title="<?php echo $from['qq1']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq2name']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq2name",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq2name']['message']) && $from['qq2name']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq2name']['message'];?>" data-original-title="<?php echo $from['qq2name']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq2']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq2",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq2']['message']) && $from['qq2']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq2']['message'];?>" data-original-title="<?php echo $from['qq2']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq3name']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq3name",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq3name']['message']) && $from['qq3name']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq3name']['message'];?>" data-original-title="<?php echo $from['qq3name']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq3']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq3",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq3']['message']) && $from['qq3']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq3']['message'];?>" data-original-title="<?php echo $from['qq3']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq4name']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq4name",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq4name']['message']) && $from['qq4name']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq4name']['message'];?>" data-original-title="<?php echo $from['qq4name']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq4']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq4",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq4']['message']) && $from['qq4']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq4']['message'];?>" data-original-title="<?php echo $from['qq4']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq5name']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq5name",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq5name']['message']) && $from['qq5name']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq5name']['message'];?>" data-original-title="<?php echo $from['qq5name']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['qq5']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("qq5",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['qq5']['message']) && $from['qq5']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['qq5']['message'];?>" data-original-title="<?php echo $from['qq5']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wangwangname']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("wangwangname",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['wangwangname']['message']) && $from['wangwangname']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['wangwangname']['message'];?>" data-original-title="<?php echo $from['wangwangname']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>


                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['wangwang']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("wangwang",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['wangwang']['message']) && $from['wangwang']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['wangwang']['message'];?>" data-original-title="<?php echo $from['wangwang']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['aliname']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("aliname",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['aliname']['message']) && $from['aliname']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['aliname']['message'];?>" data-original-title="<?php echo $from['aliname']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['ali']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("ali",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['ali']['message']) && $from['ali']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['ali']['message'];?>" data-original-title="<?php echo $from['ali']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['skypename']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("skypename",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['skypename']['message']) && $from['skypename']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['skypename']['message'];?>" data-original-title="<?php echo $from['skypename']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['skype']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("skype",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['skype']['message']) && $from['skype']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['skype']['message'];?>" data-original-title="<?php echo $from['skype']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo$from['weixin_pic']['remarks'];?>：</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php    echo form::getform("weixin_pic",$from,null,$data); ?>
                            <!-- 提示信息 -->
                            <?php if(isset($from['weixin_pic']['message']) && $from['weixin_pic']['message']!='') { ?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                      title="<?php echo $from['weixin_pic']['message'];?>" data-original-title="<?php echo $from['weixin_pic']['message'];?>"></span>
                            <?php };?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                </div>
            </div>
            </div>
        </div>
        </form>



