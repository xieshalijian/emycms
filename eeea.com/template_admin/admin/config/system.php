

<!-- 查看大图 -->
<script type="text/javascript">
    $(function() {
        enlargeImg();
    });
    //查看大图
    function enlargeImg() {
        $(".enlargeImg").click(function() {
            var imgSrc = $(this).attr('src');
            $(this).after("<div onclick='closeImg()' class='enlargeImg_wrapper'><img src='" + imgSrc + "'</div>");
            $('.enlargeImg_wrapper').fadeIn(200);
        })
    }
    //关闭并移除图层
    function closeImg() {
        $('.enlargeImg_wrapper').fadeOut(200).remove();
    }

</script>


<!-- 取色 -->
<link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>


    <h5>
        <?php echo lang_admin('set_up');?>
        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('config/index');?>" data-dataurlname="<?php echo lang_admin('set_up');?>" class="pull-right btn btn-default">
            <i class="icon-action-redo"></i>
        </a>
    </h5>
    <div class="box" id="box">
        <form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
            <div class="main-right-box">
                <h5>                   <?php echo lang_admin('set_up');?>                           <!--工具栏-->
                    <div class="content-eidt-nav pull-right">
                        <!--全屏-->
                        <a id="fullscreen-btn" class="btn btn-default" style="display: none;">
                            <i class="icon-frame"></i>
                            全屏                    </a>
                        <span class="pull-right">
                            <!--保存-->
                                                <input name="submit" value="1" type="hidden">
                                                    <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> 保存                        </button>
                            <!--返回列表-->
                           <a href="#" onclick="gotohome()" data-dataurlname="首页" class="btn btn-default">
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
                if (is_array($data))
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
                    <?php
                    if (is_array($data))
                    foreach ($data as $item){ ?>
                    <?php if($item['name']=='template_dir') { ?>
                        <!-- PC模板列表 -->
                        <style type="text/css">
                            #tag1 .col-xs-8.text-right,#tag1 .col-sm-8.text-right ,#tag1 .col-md-9.text-right ,#tag1 .col-lg-10.text-right,#tag1 .text-right,#tag2 .col-xs-8.text-right,#tag2 .col-sm-8.text-right ,#tag2 .col-md-9.text-right ,#tag2 .col-lg-10.text-right,#tag2 .text-right,#tag3 .col-xs-8.text-right,#tag3 .col-sm-8.text-right ,#tag3 .col-md-9.text-right ,#tag3 .col-lg-10.text-right,#tag3 .text-right {display:none;}
                            .btn-primary {box-shadow:none;}
                            .glyphicon-trash {color: rgba(0, 0, 0, 0.45);}
                            .content-eidt-nav {display:none;}
                        </style>
                        <!-- 修改名称 -->
                        <div class="modal fade" id="mytempateedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('renaming');?></h4>
                                    </div>
                                    <div class="modal-body" style="height:auto;padding:30px 30px 30px 50px;">
                                        <input type="hidden" id="old_templatename" value="">
                                        <input onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9_]/g,'')" onpaste="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')"
                                               oncontextmenu="value=value.replace(/[^\a-\z\A-\Z0-9_]/g,'')"
                                               type="text" name="new_templatename" id="new_templatename" id="new_templatename" value=""
                                               class="form-control" placeholder="<?php echo lang_admin('please_enter_the_name_of_the_template_file');?>">

                                    </div>
                                    <div class="modal-footer">
                                        <span class="pull-left" style="font-size:12px;color:#ccc;"><?php echo lang_admin('rename_tips');?></span>
                                        <button type="button" id="edit_templatename" class="btn btn-primary pull-right"><?php echo lang_admin('renaming');?></button>
                                        <button   type="button" id="copy_templatename" class="btn btn-primary pull-right"><?php echo lang_admin('copy');?></button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(function () {
                                //打开改名弹出框
                                $('[name="mytempateedit"]').click(function(){
                                    $("#new_templatename").val($(this).data('templatename'));
                                    $("#old_templatename").val($(this).data('templatename'));
                                    $("#edit_templatename").attr("style","display: block;");
                                    $("#copy_templatename").attr("style","display: none;");
                                    $("#myModalLabel").html("<?php echo lang_admin('renaming');?>");
                                    //打开购买弹出框
                                    $('#mytempateedit').modal('show');
                                });
                                //打开复制弹出框
                                $('[name="mytempatecopy"]').click(function(){
                                    $("#new_templatename").val($(this).data('templatename'));
                                    $("#old_templatename").val($(this).data('templatename'));

                                    $("#edit_templatename").attr("style","display: none");
                                    $("#copy_templatename").attr("style","display: block");
                                    $("#myModalLabel").html("<?php echo lang_admin('copy');?>");
                                    //打开购买弹出框
                                    $('#mytempateedit').modal('show');
                                });
                                //复制
                                $('#copy_templatename').click(function() {
                                    var new_templatename = $("#new_templatename").val();
                                    var old_templatename = $("#old_templatename").val();
                                    if (new_templatename=="" || new_templatename==undefined){
                                        alert("<?php echo lang_admin("the_name_cannot_be_empty");?>");return;
                                    }
                                    if(old_templatename==new_templatename){
                                        alert("<?php echo lang_admin("name").lang_admin("repetition");?>");return;
                                    }
                                    $.ajax({
                                        type: "get",
                                        url: "<?php echo url('template/copytemplatename',true);?>",
                                        data: {'new_templatename': new_templatename, "old_templatename": old_templatename},
                                        dataType: 'json',
                                        async: true,
                                        success: function (data) {
                                            if (data.static == 1) {
                                                //关闭服务器登录弹出框
                                                $('#mytempateedit').modal('hide');
                                                $(".modal-backdrop.fade").hide();
                                                alert(data.message);
                                                gotoinurl("/index.php?case=config&act=system&set=template&admin_dir=<?php echo get('admin_dir');?>");
                                            } else {
                                                alert(data.message);
                                            }
                                        }
                                    });
                                });
                                //改名
                                $('#edit_templatename').click(function() {
                                    var new_templatename = $("#new_templatename").val();
                                    var old_templatename = $("#old_templatename").val();
                                    if (new_templatename=="" || new_templatename==undefined){
                                        alert("<?php echo lang_admin("the_name_cannot_be_empty");?>");return;
                                    }
                                    $.ajax({
                                        type: "get",
                                        url: "<?php echo url('template/eidttemplatename',true);?>",
                                        data: {'new_templatename': new_templatename, "old_templatename": old_templatename},
                                        dataType: 'json',
                                        async: true,
                                        success: function (data) {
                                            if (data.static == 1) {
                                                //关闭服务器登录弹出框
                                                $('#mytempateedit').modal('hide');
                                                $(".modal-backdrop.fade").hide();
                                                alert(data.message);
                                                gotoinurl("/index.php?case=config&act=system&set=template&admin_dir=<?php echo get('admin_dir');?>");
                                            } else {
                                                alert(data.message);
                                            }
                                        }
                                    });
                                });
                            });
                        </script>

                        <div style="padding:0px 15px;">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <span class="glyphicon glyphicon-warning-sign"></span>	<strong><?php echo lang_admin('tips');?>！</strong></span>
                                <?php echo lang_admin('after_switching_the_template_if_the_original_data_is_not_replaced_by_the_template_data_the_label_in_the_template_needs_to_be_reset_otherwise_the_blank_will_appear_because_the_data_page_is_not_called_refer_to_the_tutorial');?>&nbsp;&nbsp;
                                <a class="btn btn-default" href="https://www.cmseasy.cn/chm/chang-jian/show-194.html" target="_blank"><?php echo lang_admin('see');?></a>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                        </div>
                        <div class="blank10"></div>

                        <div class="tempalte-list">
                            <?php if(is_array($template_pc_data))
                                foreach($template_pc_data as $template_val) { ?>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                        <div class="tempalte-box">
                                            <div class="tempalte-pic">
                                                <a class="tempalte-pic-view enlargeImg" src="<?php echo $base_url;?>/template/<?php echo $template_val['remark_name'];?>/skin/thumbnails.jpg">
                                                    <img class="img-responsive" src="<?php echo $base_url;?>/template/<?php echo $template_val['remark_name'];?>/skin/thumbnails.jpg" />
                                                </a>
                                            </div>
                                            <div class="tempalte-info">
                                                <p class="text-center">
                                                    <strong><?php echo trim($template_val['remark_name']);?></strong>
                                                </p>
                                                <p class="text-center">
                                                    <?php echo lang_admin('edition');?>：v.<?php echo $template_val['version'];?>
                                                    <?php if($template_val['is_version']){ ?>
                                                        &nbsp;&nbsp;
                                                        <a class="btn btn-default btn-sm" name="upgrade_template"  data-code="<?php echo $template_val['code'];?>"
                                                           data-remark_name="<?php echo $template_val['remark_name'];?>" href="#"> <?php echo lang_admin('upgrade') ?></a>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                            <div class="tempalte-btn">
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <button  type="submit"
                                                            <?php if(trim($item['key'])==trim($template_val['remark_name']) ) { ?>
                                                                class="btn" checked="checked" disabled="disabled" value="<?php echo lang_admin('used');?>"
                                                            <?php }else{ ?>
                                                                 class="btn" onclick="setTemplate_dir('<?php echo $template_val['remark_name'];?>')" value="<?php echo lang_admin('application');?><?php } ?>">

                                                            <?php if(trim($item['key'])==trim($template_val['remark_name']) ) { ?>
                                                                <?php if(($isvisual)) { ?>
                                                                    <a class="text-danger" href="<?php echo $base_url;?>/index.php?case=template&act=visual&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="btn-visual" target="_blank"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;<?php echo lang_admin('visual');?></a>
                                                                <?php } else { ?>
                                                                    <a class="btn btn-default" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=templatetag&tagfrom=content&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('template_label_list');?>"><?php echo lang_admin('template_tags');?></a>
                                                                <?php } ?>
                                                            <?php } elseif ($item['key']!=$template_val['remark_name']) { ?>
                                                                <i class="glyphicon glyphicon-retweet"></i> <?php echo lang_admin('application');?>
                                                            <?php } ?>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="dropup">
                                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu<?php echo $template_val['remark_name'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="glyphicon glyphicon-edit"></i> <?php echo lang_admin('dosomething');?> <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu<?php echo $template_val['remark_name'];?>">

                                                                <?php if(trim($item['key'])!=trim($template_val['remark_name']) ) { ?>
                                                                    <li>
                                                                        <a data-dataurl="<?php echo url('template/del/tplname/'.$template_val['remark_name'],1);?>" onClick="if(confirm('<?php echo lang_admin('are_you_sure_you_want_to_delete_it');?>')){ gotourl(this);}">
                                                                            <?php echo lang_admin('delete');?>
                                                                        </a>
                                                                    </li>
                                                                    <div class="line"></div>
                                                                <?php } ?>

                                                                <li>
                                                                    <a href="#"  name="mytempatecopy" data-templatename="<?php echo trim($template_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('copy_template');?>">
                                                                        <?php echo lang_admin('copy');?>
                                                                    </a>
                                                                </li>
                                                                <?php if(trim($item['key'])==trim($template_val['remark_name']) ) { ?>
                                                                    <li>
                                                                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=template&act=edit&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('edit_template');?>">
                                                                            <?php echo lang_admin('edit');?>
                                                                        </a>
                                                                    </li>
                                                                <?php }else{ ?>
                                                                    <div class="line"></div>
                                                                    <li>
                                                                        <a href="#"  name="mytempateedit" data-templatename="<?php echo trim($template_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('renaming');?>">
                                                                            <?php echo lang_admin('renaming');?>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <script type="text/javascript">
                                function setTemplate_dir(value){
                                    document.getElementById("template_dir").value=value;
                                }
                            </script>
                            <div class="blank10"></div>
                            <?php echo form::hidden($item['name'],$item['key']);?>
                        </div>

                    <?php }
                    elseif ($item['name']=='template_shopping_dir') { ?>
                    <style type="text/css">
                        .content-eidt-nav {display:none;}
                    </style>
                    <!-- 修改名称 -->
                    <div class="modal fade" id="myshoptempateedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                                    <h4 class="modal-title" id="myshopModalLabel"><?php echo lang_admin('edit');?></h4>
                                </div>
                                <div class="modal-body" style="height:auto;padding:30px 30px 30px 50px;">
                                    <input type="hidden" id="old_shoptemplatename" value="">
                                    <input onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9_]/g,'')" onpaste="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')"
                                           oncontextmenu="value=value.replace(/[^\a-\z\A-\Z0-9_]/g,'')"
                                           type="text" name="new_shoptemplatename" id="new_shoptemplatename" value=""
                                           class="form-control" placeholder="<?php echo lang_admin('please_enter_the_name_of_the_template_file');?>">

                                </div>
                                <div class="modal-footer">
                                    <span class="pull-left" style="font-size:12px;color:#ccc;"><?php echo lang_admin('rename_tips');?></span>
                                    <button type="button" id="edit_shoptemplatename" class="btn btn-primary pull-right"><?php echo lang_admin('renaming');?></button>
                                    <button   type="button" id="copy_shoptemplatename" class="btn btn-primary pull-right"><?php echo lang_admin('copy');?></button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            //打开改名弹出框
                            $('[name="myshoptempateedit"]').click(function(){
                                $("#new_shoptemplatename").val($(this).data('templatename'));
                                $("#old_shoptemplatename").val($(this).data('templatename'));
                                $("#edit_shoptemplatename").attr("style","display: block;");
                                $("#copy_shoptemplatename").attr("style","display: none;");
                                $("#myshopModalLabel").html("<?php echo lang_admin('renaming');?>");
                                //打开购买弹出框
                                $('#myshoptempateedit').modal('show');
                            });
                            //打开复制弹出框
                            $('[name="myshoptempatecopy"]').click(function(){
                                $("#new_shoptemplatename").val($(this).data('templatename'));
                                $("#old_shoptemplatename").val($(this).data('templatename'));

                                $("#edit_shoptemplatename").attr("style","display: none");
                                $("#copy_shoptemplatename").attr("style","display: block");
                                $("#myshopModalLabel").html("<?php echo lang_admin('copy');?>");
                                //打开购买弹出框
                                $('#myshoptempateedit').modal('show');
                            });
                            //复制
                            $('#copy_shoptemplatename').click(function() {
                                var new_shoptemplatename = $("#new_shoptemplatename").val();
                                var old_shoptemplatename = $("#old_shoptemplatename").val();
                                if (new_shoptemplatename=="" || new_shoptemplatename==undefined){
                                    alert("<?php echo lang_admin("the_name_cannot_be_empty");?>");return;
                                }
                                if(old_shoptemplatename==new_shoptemplatename){
                                    alert("<?php echo lang_admin("name").lang_admin("repetition");?>");return;
                                }
                                $.ajax({
                                    type: "get",
                                    url: "<?php echo url('template/copytemplatename',true);?>",
                                    data: {'new_templatename': new_shoptemplatename, "old_templatename": old_shoptemplatename},
                                    dataType: 'json',
                                    async: true,
                                    success: function (data) {
                                        if (data.static == 1) {
                                            //关闭服务器登录弹出框
                                            $('#myshoptempateedit').modal('hide');
                                            $(".modal-backdrop.fade").hide();
                                            alert(data.message);
                                            gotoinurl("/index.php?case=config&act=system&tagname=template_shopping_dir&set=template&admin_dir=<?php echo get('admin_dir');?>");
                                        } else {
                                            alert(data.message);
                                        }
                                    }
                                });
                            });
                            //改名
                            $('#edit_shoptemplatename').click(function() {
                                var new_shoptemplatename = $("#new_shoptemplatename").val();
                                var old_shoptemplatename = $("#old_shoptemplatename").val();
                                if (new_shoptemplatename=="" || new_shoptemplatename==undefined){
                                    alert("<?php echo lang_admin("the_name_cannot_be_empty");?>");return;
                                }
                                $.ajax({
                                    type: "get",
                                    url: "<?php echo url('template/eidttemplatename',true);?>",
                                    data: {'new_templatename': new_shoptemplatename, "old_templatename": old_shoptemplatename},
                                    dataType: 'json',
                                    async: true,
                                    success: function (data) {
                                        if (data.static == 1) {
                                            //关闭服务器登录弹出框
                                            $('#myshoptempateedit').modal('hide');
                                            $(".modal-backdrop.fade").hide();
                                            alert(data.message);
                                            gotoinurl("/index.php?case=config&act=system&tagname=template_shopping_dir&set=template&admin_dir=<?php echo get('admin_dir');?>");
                                        } else {
                                            alert(data.message);
                                        }
                                    }
                                });
                            });

                        });
                    </script>

                    <!-- 商城模板列表 -->
                    <div style="padding:0px 15px;">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <span class="glyphicon glyphicon-warning-sign"></span>	<strong><?php echo lang_admin('tips');?>！</strong></span>
                            <?php echo lang_admin('after_switching_the_template_if_the_original_data_is_not_replaced_by_the_template_data_the_label_in_the_template_needs_to_be_reset_otherwise_the_blank_will_appear_because_the_data_page_is_not_called_refer_to_the_tutorial');?>&nbsp;
                            &nbsp;<a class="btn btn-default" href="https://www.cmseasy.cn/chm/chang-jian/show-194.html" target="_blank"><?php echo lang_admin('see');?></a>
                        </div>
                    </div>

                    <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                    </div>
                    <div class="blank10"></div>
                    <div class="tempalte-list">
                        <?php if(is_array($template_shop_data))
                            foreach($template_shop_data as $template_shop_val) { ?>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                    <div class="tempalte-box">
                                        <div class="tempalte-pic">
                                            <a class="tempalte-pic-view enlargeImg" src="<?php echo $base_url;?>/template/<?php echo $template_shop_val['remark_name'];?>/skin/thumbnails.jpg">
                                                <img class="img-responsive" src="<?php echo $base_url;?>/template/<?php echo $template_shop_val['remark_name'];?>/skin/thumbnails.jpg" />
                                            </a>
                                        </div>

                                        <div class="tempalte-info">
                                            <p class="text-center">
                                                <strong><?php echo trim($template_shop_val['remark_name']);?></strong>
                                                <?php if($template_shop_val['is_version']){ ?>
                                                    <a class="btn btn-success" name="upgrade_template"  data-code="<?php echo $template_shop_val['code'];?>"
                                                       data-remark_name="<?php echo $template_shop_val['remark_name'];?>" href="#"> <?php echo lang_admin('upgrade') ?></a>
                                                <?php } ?>
                                            </p>
                                        </div>
                                        <div class="tempalte-btn">
                                            <div class="col-xs-6">
                                                <div class="row">
                                                    <button   type="submit"
                                                        <?php if(trim($item['key'])==trim($template_shop_val['remark_name']) ) { ?>
                                                            class="btn" checked="checked" disabled="disabled" value="<?php echo lang_admin('used');?>"
                                                        <?php }else{ ?>
                                                              class="btn" onclick="setTemplate_shopping_dir('<?php echo $template_shop_val['remark_name'];?>')" value="<?php echo lang_admin('application');?><?php } ?>">
                                                        <?php if(trim($item['key'])==trim($template_shop_val['remark_name']) ) { ?>
                                                            <a class="btn btn-default" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=templatetag&tagfrom=shopcontent&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('template_label_list');?>"><?php echo lang_admin('template_tags');?></a>
                                                        <?php } elseif ($item['key']!=$template_shop_val['remark_name']) { ?>
                                                            <i class="glyphicon glyphicon-retweet"></i> <?php echo lang_admin('application');?>
                                                        <?php } ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="row">
                                                    <div class="dropup">
                                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu<?php echo $template_shop_val['remark_name'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="glyphicon glyphicon-edit"></i> <?php echo lang_admin('dosomething');?> <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu<?php echo $template_shop_val['remark_name'];?>">
                                                            <?php if(trim($item['key'])!=trim($template_shop_val['remark_name']) ) { ?>
                                                                <li>
                                                                    <a data-dataurl="<?php echo url('template/del/tagname/template_shopping_dir/tplname/'.$template_shop_val['remark_name'],1);?>" onClick="if(confirm('<?php echo lang_admin('are_you_sure_you_want_to_delete_it');?>')){ gotourl(this);}">
                                                                        <?php echo lang_admin('delete');?>
                                                                    </a>
                                                                </li>
                                                                <div class="line"></div>
                                                            <?php } ?>
                                                            <li>
                                                                <a href="#"  name="myshoptempatecopy" data-templatename="<?php echo trim($template_shop_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('copy_template');?>"><?php echo lang_admin('copy');?></a>
                                                            </li>
                                                            <?php if(trim($item['key'])==trim($template_shop_val['remark_name']) ) { ?>
                                                                <div class="line"></div>
                                                                <li>
                                                                    <a href="#"  name="myshoptempateedit" data-templatename="<?php echo trim($template_shop_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('edit_template');?>"><?php echo lang_admin('renaming');?></a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if(trim($item['key'])!=trim($template_shop_val['remark_name']) ) { ?>
                                                                <li>
                                                                    <a href="#"  name="myshoptempateedit" data-templatename="<?php echo trim($template_shop_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('renaming');?>">
                                                                        <?php echo lang_admin('renaming');?>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>


                            <?php } ?>
                        <script type="text/javascript">
                            function setTemplate_shopping_dir(value){
                                document.getElementById("template_shopping_dir").value=value;
                            }
                        </script>
                        <div class="blank10"></div>
                        <?php echo form::hidden($item['name'],$item['key']);?>

                        <?php }
                    elseif ($item['name']=='template_mobile_dir') { ?>
                        <style type="text/css">
                            .content-eidt-nav {display:none;}
                        </style>
                        <!-- 修改名称 -->
                        <div class="modal fade" id="mywaptempateedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                                        <h4 class="modal-title" id="mywapModalLabel"><?php echo lang_admin('edit');?></h4>
                                    </div>
                                    <div class="modal-body" style="height:auto;padding:30px 30px 30px 50px;">
                                        <input type="hidden" id="old_waptemplatename" value="">
                                        <input onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9_]/g,'')" onpaste="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')"
                                               oncontextmenu="value=value.replace(/[^\a-\z\A-\Z0-9_]/g,'')"
                                               type="text" name="new_waptemplatename" id="new_waptemplatename" value=""
                                               class="form-control" placeholder="<?php echo lang_admin('please_enter_the_name_of_the_template_file');?>">

                                    </div>
                                    <div class="modal-footer">
                                        <span class="pull-left" style="font-size:12px;color:#ccc;"><?php echo lang_admin('rename_tips');?></span>
                                        <button type="button" id="edit_waptemplatename" class="btn btn-primary pull-right"><?php echo lang_admin('renaming');?></button>
                                        <button   type="button" id="copy_waptemplatename" class="btn btn-primary pull-right"><?php echo lang_admin('copy');?></button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(function () {
                                //打开改名弹出框
                                $('[name="mywaptempateedit"]').click(function(){
                                    $("#new_waptemplatename").val($(this).data('templatename'));
                                    $("#old_waptemplatename").val($(this).data('templatename'));
                                    $("#edit_waptemplatename").attr("style","display: block;");
                                    $("#copy_waptemplatename").attr("style","display: none;");
                                    $("#mywapModalLabel").html("<?php echo lang_admin('renaming');?>");
                                    //打开购买弹出框
                                    $('#mywaptempateedit').modal('show');
                                });
                                //打开复制弹出框
                                $('[name="mywaptempatecopy"]').click(function(){
                                    $("#new_waptemplatename").val($(this).data('templatename'));
                                    $("#old_waptemplatename").val($(this).data('templatename'));

                                    $("#edit_waptemplatename").attr("style","display: none");
                                    $("#copy_waptemplatename").attr("style","display: block");
                                    $("#mywapModalLabel").html("<?php echo lang_admin('copy');?>");
                                    //打开购买弹出框
                                    $('#mywaptempateedit').modal('show');
                                });
                                //复制
                                $('#copy_waptemplatename').click(function() {
                                    var new_waptemplatename = $("#new_waptemplatename").val();
                                    var old_waptemplatename = $("#old_waptemplatename").val();
                                    if (new_waptemplatename=="" || new_waptemplatename==undefined){
                                        alert("<?php echo lang_admin("the_name_cannot_be_empty");?>");return;
                                    }
                                    if(old_waptemplatename==new_waptemplatename){
                                        alert("<?php echo lang_admin("name").lang_admin("repetition");?>");return;
                                    }
                                    $.ajax({
                                        type: "get",
                                        url: "<?php echo url('template/copytemplatename',true);?>",
                                        data: {'new_templatename': new_waptemplatename, "old_templatename": old_waptemplatename},
                                        dataType: 'json',
                                        async: true,
                                        success: function (data) {
                                            if (data.static == 1) {
                                                //关闭服务器登录弹出框
                                                $('#mywaptempateedit').modal('hide');
                                                $(".modal-backdrop.fade").hide();
                                                alert(data.message);
                                                gotoinurl("/index.php?case=config&act=system&tagname=template_wap_dir&set=template&admin_dir=<?php echo get('admin_dir');?>");
                                            } else {
                                                alert(data.message);
                                            }
                                        }
                                    });
                                });
                                //改名
                                $('#edit_waptemplatename').click(function() {
                                    var new_waptemplatename = $("#new_waptemplatename").val();
                                    var old_waptemplatename = $("#old_waptemplatename").val();
                                    if (new_waptemplatename=="" || new_waptemplatename==undefined){
                                        alert("<?php echo lang_admin("the_name_cannot_be_empty");?>");return;
                                    }
                                    $.ajax({
                                        type: "get",
                                        url: "<?php echo url('template/eidttemplatename',true);?>",
                                        data: {'new_templatename': new_waptemplatename, "old_templatename": old_waptemplatename},
                                        dataType: 'json',
                                        async: true,
                                        success: function (data) {
                                            if (data.static == 1) {
                                                //关闭服务器登录弹出框
                                                $('#mywaptempateedit').modal('hide');
                                                $(".modal-backdrop.fade").hide();
                                                alert(data.message);
                                                gotoinurl("/index.php?case=config&act=system&tagname=template_wap_dir&set=template&admin_dir=<?php echo get('admin_dir');?>");
                                            } else {
                                                alert(data.message);
                                            }
                                        }
                                    });
                                });

                            });
                        </script>

                        <!--手机模板列表-->
                        <div style="padding:0px 15px;">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <span class="glyphicon glyphicon-warning-sign"></span>	<strong><?php echo lang_admin('tips');?>！</strong></span>
                                <?php echo lang_admin('after_switching_the_template_if_the_original_data_is_not_replaced_by_the_template_data_the_label_in_the_template_needs_to_be_reset_otherwise_the_blank_will_appear_because_the_data_page_is_not_called_refer_to_the_tutorial');?>&nbsp;
                                &nbsp;<a class="btn btn-default" href="https://www.cmseasy.cn/chm/chang-jian/show-194.html" target="_blank"><?php echo lang_admin('see');?></a>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                        </div>
                        <div class="blank10"></div>
                        <div class="tempalte-list">
                            <?php if(is_array($template_mobile_data))
                                foreach($template_mobile_data as $template_mobile_val) { ?>

                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                        <div class="tempalte-box">
                                            <div class="tempalte-pic">
                                                <a class="tempalte-pic-view enlargeImg" src="<?php echo $base_url;?>/template/<?php echo $template_mobile_val['remark_name'];?>/skin/thumbnails.jpg">
                                                    <img class="img-responsive" src="<?php echo $base_url;?>/template/<?php echo $template_mobile_val['remark_name'];?>/skin/thumbnails.jpg" />
                                                </a>
                                            </div>

                                            <div class="tempalte-info">
                                                <p class="text-center">
                                                    <strong><?php echo trim($template_mobile_val['remark_name']);?></strong>
                                                    <?php if($template_mobile_val['is_version']){ ?>
                                                        <a class="btn btn-success" name="upgrade_template"  data-code="<?php echo $template_mobile_val['code'];?>"
                                                           data-remark_name="<?php echo $template_mobile_val['remark_name'];?>" href="#"> <?php echo lang_admin('upgrade') ?></a>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                            <div class="tempalte-btn">
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <button   type="submit"
                                                            <?php if(trim($item['key'])==trim($template_mobile_val['remark_name']) ) { ?>
                                                                class="btn" checked="checked" disabled="disabled" value="<?php echo lang_admin('used');?>"
                                                            <?php }else{ ?>
                                                                  class="btn" onclick="setTemplate_mobile_dir('<?php echo $template_mobile_val['remark_name'];?>')" value="<?php echo lang_admin('application');?><?php } ?>">
                                                            <?php if(trim($item['key'])==trim($template_mobile_val['remark_name']) ) { ?>
                                                                <a class="btn btn-default" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=templatetag&tagfrom=shopcontent&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('template_label_list');?>"><?php echo lang_admin('template_tags');?></a>
                                                            <?php } elseif ($item['key']!=$template_mobile_val['remark_name']) { ?>
                                                                <i class="glyphicon glyphicon-retweet"></i> <?php echo lang_admin('application');?>
                                                            <?php } ?>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="dropup">
                                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenu<?php echo $template_mobile_val['remark_name'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="glyphicon glyphicon-edit"></i> <?php echo lang_admin('dosomething');?> <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu<?php echo $template_mobile_val['remark_name'];?>">
                                                                <?php if(trim($item['key'])!=trim($template_mobile_val['remark_name']) ) { ?>
                                                                    <li>
                                                                        <a data-dataurl="<?php echo url('template/del/tagname/template_wap_dir/tplname/'.$template_mobile_val['remark_name'],1);?>" onClick="if(confirm('<?php echo lang_admin('are_you_sure_you_want_to_delete_it');?>')){ gotourl(this);}">
                                                                            <?php echo lang_admin('delete');?>
                                                                        </a>
                                                                    </li>
                                                                    <div class="line"></div>
                                                                <?php } ?>
                                                                <li>
                                                                    <a href="#"  name="mywaptempatecopy" data-templatename="<?php echo trim($template_mobile_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('copy_template');?>"><?php echo lang_admin('copy');?></a>
                                                                </li>
                                                                <?php if(trim($item['key'])==trim($template_mobile_val['remark_name']) ) { ?>
                                                                    <div class="line"></div>
                                                                    <li>
                                                                        <a href="#"  name="mywaptempateedit" data-templatename="<?php echo trim($template_mobile_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('edit_template');?>"><?php echo lang_admin('renaming');?></a>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if(trim($item['key'])!=trim($template_mobile_val['remark_name']) ) { ?>
                                                                    <li>
                                                                        <a href="#"  name="mywaptempateedit" data-templatename="<?php echo trim($template_mobile_val['remark_name']);?>"  data-dataurlname="<?php echo lang_admin('renaming');?>">
                                                                            <?php echo lang_admin('renaming');?>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>


                                <?php } ?>
                            <script type="text/javascript">
                                function setTemplate_mobile_dir(value){
                                    document.getElementById("template_mobile_dir").value=value;
                                }
                            </script>
                            <div class="blank10"></div>
                            <?php echo form::hidden($item['name'],$item['key']);?>

                            <?php }
                    elseif($item['name']=="pc_html_info") { ?>
                            <div class="blank20"></div>
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                                <a class="btn btn-info"  href="#"  onclick="gotourl(this)"  data-dataurl="<?php echo url('cache/make_index');?>" data-dataurlname="<?php echo lang_admin('pc_html');?>">
                                    <?php if(config::getadmin('list_index_php')==1)  { ?>
                                        <?php echo lang_admin('static_html');?>

                                    <?php } else { ?>

                                        <?php echo lang_admin('pc_html');?>
                                    <?php } ?>
                                </a>
                                </a></div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-7 text-left">

                                <p class="text-danger" style="font-size:12px;">
                                    <?php echo lang_admin('html_attention');?>
                                </p>

                            </div>
                            <div class="blank20"></div>
                            <style type="text/css">
                                .alert {margin:0px;}
                                #pc_html_info {display:none;}
                            </style>
                        <?php }
                    elseif($item['name']=="wap_html_info") { ?>
                    <?php if(config::getadmin('mobile_open')==1 || ('mobile_open')==2) { ?>
                        <div class="blank20"></div>
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                            <a class="btn btn-info"  href="#"  onclick="gotourl(this)"  data-dataurl="<?php echo url('wapcache/make_index');?>" data-dataurlname="<?php echo lang_admin('wap_html');?>">
                                <?php if(config::getadmin('wap_index_php')==1 || ('wap_list_page_php')==1 || ('wap_show_page_php')==1 || ('wap_list_type_php')==1 || ('wap_list_special_php')==1)  { ?>
                                    <?php echo lang_admin('static_wap_html');?>
                                <?php } else { ?>
                                    <?php echo lang_admin('wap_html');?>
                                <?php } ?>
                            </a>
                        </div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        </div>
                        <div class="blank20"></div>
                        <style type="text/css">
                            .alert {margin:0px;}
                            #wap_html_info {display:none;}
                        </style>
                    <?php } else { ?>
                        <div style="display:none;">
                            <div style="display:none;">
                                <?php } ?>
                                <?php }
                    elseif($item['name']=="urlrewrite_info") { ?>
                                <?php if(config::getadmin('mobile_open')==1 || ('mobile_open')==2) { ?>
                                <?php } else { ?>
                            </div></div>
                    <?php } ?>
                        <!-- HTML生成请注意 -->
                        <div class="blank20"></div>
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5 text-left">
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <span class="glyphicon glyphicon-warning-sign"></span>

                                <strong><?php echo lang_admin('tips');?>！</strong></span>
                                <p class="text-danger">
                                    <?php echo lang_admin('pseudo_static_web_address');?>
                                </p>
                                <p>
                                    <?php echo lang_admin('if_you_dont_know_about_pseudo_static_please_close_it_install_patches_if_necessary');?>&nbsp;&nbsp;<a class="btn btn-gray" href="https://www.cmseasy.cn/plus/show-275.html" target="_blank"><?php echo lang_admin('patches');?></a>
                                </p>


                            </div>
                        </div>
                        <div class="blank20"></div>
                        <style type="text/css">
                            .alert {margin:0px;}
                            #urlrewrite_info {display:none;}
                        </style>
                    <?php }
                    elseif($item['name']=='sms_explain') { ?>
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

                    <?php }
                    elseif ($item['name']=='sms_manage') { ?>
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
                    <?php }
                    elseif ($item['name']=='pic_enable_info') { ?>
                        <div class="blank20"></div>
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                            <a class="btn btn-info"  href="#"  onclick="gotourl(this)"  data-dataurl="<?php echo url('cache/make_show');?>" data-dataurlname="<?php echo lang_admin('pc_html');?>">
                                拼图验证码所需id和key
                            </a>
                        </div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        </div>
                        <div class="blank20"></div>
                        <style type="text/css">
                            .alert {margin:0px;}
                            #pic_enable_info {display:none;}
                        </style>
                    <?php }
                    elseif ($item['name']=='mobilechk_enable_info') { ?>
                        <div class="blank20"></div>
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                            <a class="btn btn-info" href="http://pay.cmseasy.cn/reg.php" target="_blank">
                                如开通手机短信验证，请点击先购买短信！
                            </a>
                        </div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        </div>
                        <div class="blank20"></div>
                        <style type="text/css">
                            .alert {margin:0px;}
                            #mobilechk_enable_info {display:none;}
                        </style>
                    <?php }
                    else{  $item['selecttype']=isset($item['selecttype'])?$item['selecttype']:"";?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo ((isset($item['remarks']) && $item['remarks']!="")?$item['remarks']:lang_admin($item['name']));?>：</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php if($item['name']=='ditu_explain') { ?>
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
                                    <?php }
                                    elseif ($item['selecttype']=="select") {
                                        echo form::select($item['name'],$item['key'],$item['select'],'class="select"');
                                    } elseif ($item['selecttype']=="image") {
                                        echo form::upload_image($item['name'],$item['key']);
                                    } elseif ($item['selecttype']=="radio") {
                                        $_res="";
                                        foreach ($item['select'] as $rkey=>$rval){
                                            $_res .= form::radio($item['name'], $rkey, $rkey ==$item['key']) . $rval;
                                        }
                                        echo $_res;
                                    }elseif (!is_numeric($item['key']) && strlen(is_string($item['key']))>50 || $item['selecttype']=="textarea") {
                                        echo form::textarea($item['name'],$item['key'],' class="textarea"');
                                    }  elseif ($item['name']=="admin_dir") {
                                        echo form::input($item['name'],$item['key'],'onkeyup="value=value.replace(/[^\w\.\/]/ig,\'\')"');
                                    } else {
                                        if ("site_url"==$item['name']){
                                            $option="disabled";
                                        }
                                        else if ("template_admin_dir"==$item['name']){
                                            $option=" readonly='readonly' ";
                                        }
                                        else{
                                            $option="";
                                        }
                                        echo form::input($item['name'],$item['key'],$option);
                                    }?>
                                <!-- 提示信息 -->
                                <?php if(isset($item['message']) && $item['message']!='') { ?>
                                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                              title="<?php echo $item['message'];?>" data-original-title="<?php echo $item['message'];?>"></span>
                                <?php };?>
                                <?php if($item['name']=='watermark_pos') { ?>
                                        <!-- 水印设置 -->
                                        <?php echo template_admin('config/watermark_pos_select.php'); ?>
                                    <?php }
                                    elseif($item['name']=='ditu_APK'){?>
                                        <a href="https://lbsyun.baidu.com" target="_blank" class="btn-navy-sms"><?php echo lang_admin("registered_user");?></a>
                                    <?php }
                                    elseif($item['name']=='sms_username'){?>
                                        <a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn-navy-sms"><?php echo lang_admin("registered_user");?></a>
                                    <?php }
                                    elseif($item['name']=='gee_id'){?>
                                        <a href="https://account.geetest.com/register" target="_blank" class="btn-navy-sms"><?php echo lang_admin("registered_user");?></a>
                                    <?php   }
                                    elseif($item['name']=='list_index_php' && $item['key']=='1'){?>
                                        &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="index" ><?php echo lang_admin('generating_static_state');?></a>
                                    <?php }
                                    elseif($item['name']=='list_page_php' && $item['key']=='1'){?>
                                        &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="list" ><?php echo lang_admin('generating_static_state');?></a>
                                    <?php }
                                    elseif($item['name']=='show_page_php' && $item['key']=='1'){?>
                                        &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="show" ><?php echo lang_admin('generating_static_state');?></a>
                                    <?php }
                                    elseif($item['name']=='list_type_php' && $item['key']=='1'){?>
                                        &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="type" ><?php echo lang_admin('generating_static_state');?></a>
                                    <?php }
                                    elseif($item['name']=='list_special_php' && $item['key']=='1'){?>
                                        &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="special" ><?php echo lang_admin('generating_static_state');?></a>
                                    <?php }
                                    elseif($item['name']=='tag_html' && $item['key']=='1'){?>
                                        &nbsp;&nbsp;<a class="btn btn-success btn-sm" name="my_cache_modal" href="#"  data-modal-url="tag" ><?php echo lang_admin('generating_static_state');?></a>
                                    <?php };?>
                                </div>
                            </div>
                            <div class="clearfix blank20"></div>
                            <?php }?>
                            <?php }?>
                        </div>
                    </div>
                </div>
        </form>
    </div>

<?php  if (front::get('mache_type')){ ?>
    <script>
        var mode="<?php echo front::get('mache_type'); ?>";
        open_mode(mode,true);
    </script>
<?php  } ?>
<?php  if ($set=="dynamic"){ ?>
    <style>
        .html-name {color:#fff;}
        .html-name a {display:block; color:#fff;}
        .html-loading {overflow-y: scroll; background:#333;height:460px;border:1px solid rgba(0,0,0,0.3); color:#fff;}
        .html-name p {margin-bottom: 8px;
            border: 1px solid rgba(255,255,255,0.3);
            padding-left: 15px; position: relative;}
        .html-name p:hover {background:#333;border-color: #333;}
        .html-name p:hover:after {content: "\e098"; position: absolute; top:0px; right:0px; width:20px; height:20px;font-family: 'Simple-Line-Icons' !important; color:#fff; font-size:14px;}
        .html-name {height:460px; overflow-y: scroll;}
    </style>
<div class="modal fade" id="my_cache_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <h4>
                    <?php echo lang_admin('generating_static_state');?>
                </h4>
            </div>
            <div class="modal-body  " data-url="seo/html" data-dataurl="" data-refresh="1" data-tablerefresh="undefined" data-tablerefresh-type="undefined" data-load="" data-title="<?php echo lang_admin('generating_static_state');?>" style="overflow: hidden;">
                        <div class="col-md-5 html-name" name="doGetHtml">

                        </div>
                <div class="modal-html">
                    <div class="col-md-7 html-loading">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- 当前页面的js -->
    <script>var admin_lang='<?php echo lang::getisadmin();?>';var template_lang='<?php echo lang::getistemplate();?>';</script>
    <script type="text/javascript" src="<?php echo $base_url.'/template_admin/'.front::$view->_style;?>/config/system_dynamic.js"></script>
<?php } ?>

<?php  if ($set=="template" || $set=="template_shop" || $set=="template_mobile"){ ?>

    <!-- 在线模板下载-升级 -->
    <div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog" aria-labelledby="downModalLabel" data-backdrop="static" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="downModalLabel"><?php echo lang_admin('download_template');?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo lang_admin('file_size');?>：<span id="file-size">0</span> Bytes</p>
                    <!-- 进度条 -->
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0"
                             aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            <span id="imported-progress">0</span>%
                        </div>
                    </div>
                    <p id="statusText"><?php echo lang_admin('download_don_t_refresh');?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang_admin('close');?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            //模板升级弹出框
            $('[name="upgrade_template"]').click(function(){
                var is_upgrade = confirm("<?php echo lang_admin("confirm").lang_admin("yes").lang_admin("no").lang_admin('upgrade').lang_admin('template').'?'.lang_admin('升级前做好备份！');?>");
                var template_code=$(this).data("code");
                var remark_name=$(this).data("remark_name");
                if (is_upgrade){
                    upgradeloadFile(template_code,remark_name);
                }
            });
        });

        function updateState(progress) {
            $('#statusText').html(progress);
        }

            //升级下载模板
        function upgradeloadFile($f,remark_name) {
            var file_size = 0;
            var progress = 0;
            var filename = $f;
            console.log("Prepared to download");
            updateState("<?php echo lang_admin('start_downloading_template_files');?>");

            $('#upgradeModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            var def = $.get("<?php echo url('template/upgrade/action/prepare-download',true);?>", {'f': filename,'remark_name': remark_name}, null, 'json');
            def.then(function (res) {
                console.log(res);
                file_size = res.file_size;
                $('#file-size').html(file_size);
                console.log("started downloading");
                updateState("<?php echo lang_admin('start_downloading_template_files');?>");
                //isdownloading = false;
                //$('#myModal').modal('hide');
                //$('#info_res').html(res.msg);


                url = "<?php echo url('template/upgrade/action/start-download',true);?>";
                promise =  $.get(url,{'f': filename,'remark_name': remark_name} ,null, 'json');

                var interval_id = window.setInterval(function () {
                    $('#imported-progress').html(progress);
                    $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
                    if (progress >= 100) {
                        clearInterval(interval_id);
                        // 到此远程文件下载完成，继续其他逻辑
                        updateState("<?php echo lang_admin('download_successful_start_to_install_the_template');?>");
                        $.ajax({
                            url : "<?php echo url('template/upgrade/action/exzip',true);?>",
                            data: {'f': filename,'remark_name': remark_name},
                            dataType:'json',
                            type : 'GET'
                        }).done(function(res){
                            if(res['code'] === 0){
                                updateState("<?php echo lang_admin('installation_completed_2_seconds_later_jump_to_the_background');?>");
                                setTimeout("window.location.href='<?php echo get('admin_dir',true);?>';",2000);
                            }else{
                                updateState(res['msg']);
                            }
                        }).fail(showAjaxError);
                    } else {
                        $.ajax({
                            url: "<?php echo url('template/upgrade/action/get-file-size',true);?>",
                            data: {'f': filename,'remark_name': remark_name},
                            dataType: 'json',
                            type: 'get'
                        }).done(function (json) {
                            //console.log("Progress: "+json);
                            //console.log("Progress: "+json.size);
                            //console.log("Progress: "+file_size);
                            progress = (json.size / file_size * 100).toFixed(2);
                            updateProgress(progress);
                            console.log("Progress: " + progress);
                        }).fail(showAjaxError);
                    }
                }, 999);


                return promise;
            }, function (res) {
                updateState("<?php echo lang_admin('error_occurred');?>"+res.responseText);
                console.error(res);
            }).then(function (json) {
                // set progress to 100 when got the response
                progress = 100;
                console.log("<?php echo lang_admin('download_completed');?>");
                console.log(json);
            }, function (res) {
                updateState("<?php echo lang_admin('preparing');?>"+res.responseText);
                console.error(res);
            });
            return;
        }
    </script>
<?php } ?>

