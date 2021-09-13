

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
                    <!-- 短信管理页面 -->
                    <script type="text/javascript">
                        jQuery(function($){
                            $("#demo_btn").click(function(){
                                $("#demo_div").attr("src",
                                    "demo.php?pattern="+$("#ifocus_pattern").val()+"&width="+$("#ifocus_width").val()+"&height="+$("#ifocus_height").val()+
                                    "&number="+$("#ifocus_number").val()+"&time="+$("#ifocus_time").val());
                            });
                            $('#sms_manage').load('<?php echo url('sms/manage');?>');
                        });
                        var base_url = '<?php echo config::getadmin('site_url');?>';
                        sms_manage_static=true;
                    </script>
                    <div id="sms_manage">
                    </div>
                    <style type="text/css">
                        input#sms_manage {display:none;}
                    </style>
                    <!--  -->
                </div>
            </div>
        </div>
            </div>
        </form>



