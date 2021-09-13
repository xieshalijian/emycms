

    <form method="post" action="<?php echo uri();?>" name="config_form" id="config_form" onsubmit="return returnform(this);">
        <div class="main-right-box">
            <div class="box" id="box">
            <h5>                   <?php echo lang_admin('template_manage');?>                           <!--工具栏-->
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
                    <li role="presentation" class="tag_template  active ">
                        <a data-dataurlname="<?php echo lang_admin('template_manage');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template');?>"   href="#tag1" name="<?php echo lang_admin('template_manage');?>" role="tab" data-toggle="tab">
                            <?php echo lang_admin('template_manage');?>
                        </a>
                    </li>


                    <li role="presentation" class="tag_template_user ">
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
                                                        <?php if(trim($data['template_dir'])==trim($template_val['remark_name']) ) { ?>
                                                            class="btn" checked="checked" disabled="disabled" value="<?php echo lang_admin('used');?>"
                                                        <?php }else{ ?>
                                                             class="btn" onclick="setTemplate_dir('<?php echo $template_val['remark_name'];?>')" value="<?php echo lang_admin('application');?><?php } ?>">

                                                        <?php if(trim($data['template_dir'])==trim($template_val['remark_name']) ) { ?>
                                                            <?php if(($isvisual)) { ?>
                                                                <a class="text-danger" href="<?php echo $base_url;?>/index.php?case=template&act=visual&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="btn-visual" target="_blank"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;<?php echo lang_admin('visual');?></a>
                                                            <?php } else { ?>
                                                                <a class="btn btn-default" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=templatetag&tagfrom=content&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('template_label_list');?>"><?php echo lang_admin('template_tags');?></a>
                                                            <?php } ?>
                                                        <?php } elseif ($data['template_dir']!=$template_val['remark_name']) { ?>
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

                                                            <?php if(trim($data['template_dir'])!=trim($template_val['remark_name']) ) { ?>
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
                                                            <?php if(trim($data['template_dir'])==trim($template_val['remark_name']) ) { ?>
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
                        <?php echo form::hidden("template_dir",$data['template_dir']);?>
                    </div>

                </div>
            </div>
        </div>

        </div>
    </form>




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
