
<?php if(file_exists(ROOT."/lib/table/special.php")) { ?>

<div class="modal fade" id="template-special-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_special">

                </ul>
            </div>
            <div class="modal-body">
                <!--加载进度条-->
                <div class="index-lading" name="template_lading" style="display: none;">
                    <div class="loadEffect">
                        <div><span></span></div>
                        <div><span></span></div>
                        <div><span></span></div>
                        <div><span></span></div>
                    </div>
                </div>
                <!-- 设置 -->
                <div class="tab-content" name="special_modal_show">

                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveSpecial" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="template-old-special-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tag-special-config" aria-controls="tag-special-config" role="tab" data-toggle="tab">
<?php echo lang_admin('special_label_attributes');?>
                        </a>
                    </li>
                    <li role="presentation" name="tag-special-template" >
                        <a href="#tag-special-template" aria-controls="tag-special-template" role="tab" data-toggle="tab">
                            <?php echo lang_admin('label_template');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <?php
                if (get("isshopping")){
                    $template_dir=config::get('template_shopping_dir');
                }else{
                    $template_dir=config::get('template_dir');
                }
                $tplarray=include(ROOT.'/template/'.config::get('template_dir').'/tpltag/tag.config.php');
                $tplarray=$tplarray['special'];
                $tag_config=$data['setting'];
                ?>
                <!-- 设置 -->
                <div class="tab-content">
                    <div class="blank20"></div>
                    <div role="tabpanel" class="tab-pane active" id="tag-special-config">
                      <form method="post" name="frmspecial" id="frmspecial" action="">
                    <input type="hidden" name="tagfrom" value="special" class="form-control">
                    <input type="hidden" name="id" value="" class="form-control id">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                           <?php echo lang_admin('remarks');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <input placeholder="<?php echo lang_admin('please_enter_the_topic_label_name');?>" type="text" name="remarksname" value="" class="remarksname form-control">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('please_enter_the_topic_label_name');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php echo form::select('spid', $tag_config['spid'], special::option(lang_admin('all_special')));?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('whether_to_call_the_subtitle_silently');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="spname" name="spname" class="form-control select spname">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('whether_to_call_the_subtitle_silently');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('subtitle');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="subtitle" name="subtitle" class="form-control select subtitle">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('whether_to_call_the_subtitle_silently');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('special_banner');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="spimage" name="spimage" class="form-control select spimage">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('whether_to_call_the_description_picture');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('special_content');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="spcontent" name="spcontent" class="form-control select spcontent">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('whether_to_invoke_the_topic_description');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('number_of_intercepted_words');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <input type="text" id="len" name="len" value="-1" class="len form-control">
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('1_no_limit_0_no_call');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <input name="tagtemplate" class="tagtemplate" id="tagtemplate" type="hidden" value="">
                        <!--<div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                            <?php /*echo lang_admin('label_template');*/?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php /*echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);*/?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title=""
                                  title="<?php /*echo lang_admin('label_template');*/?>文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_special_*.html!">
                                    </span>
                        </div>-->
                    </div>
                </form>
                    </div>
                    <!-- 标签 -->
                    <div role="tabpanel" class="tab-pane" id="tag-special-template">

                        <?php if (is_array($tplarray)) foreach ($tplarray as $key=>$val){ $tagimg=str_replace(".html","",$val);?>
                            <div class="tag-preview" name="tagimglist">
                                <img src="/template/<?php echo $template_dir;?>/tpltag/<?php echo $tagimg;?>.jpg" alt="<?php echo $val;?>" data-tagname="<?php echo $val;?>" name="tagimg" />
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveSpecial" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- 标签弹出框 -->
<script type="text/javascript">
    var specialHandle;
    var template_getspecial='<?php echo url("template/getspecial");?>';
    $(document).ready(function () {
        var isoldspecial=false;
        $('body.edit .visual-right').on("click","[data-target='#template-special-tag']",function(e) {
            e.preventDefault();
            specialHandle = $(this).parent().parent().parent().parent().find('.view');
            var eText = specialHandle.find('.tag .tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) ) {
                $("[name='template_lading']").attr("style","display: block;");
                $('#template-special-tag').attr('style','display:block');
                $('#template-special-tag').addClass("modal-right");
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getmodulestag");?>', {'tag': eText, 'num': 1}, function (res) {
                    //隐藏old版栏目弹出框
                    $('#template-old-special-tag').modal('hide');
                    //弹出框的导航栏增加
                    tabslist(res, 'special');
                    //生成栏目弹出框的  动态内容
                    specialhtml(res);
                }, 'json');
            }
            else{
                //打开的老的弹出框
                isoldspecial=true;
                //打开标签选中
                $("[name='tag-special-template']").removeAttr("style");
                //隐藏新版栏目弹出框
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/gettag");?>',{'tag':eText},function(res){
                    //console.log(res);
                    //弹出框
                    $('#template-special-tag').modal('hide');
                    if(res.tagname!="" && res.tagname!=undefined) {
                        specialHandle.find('.tag .tagname').html(res.tagname);     //修改html的内容
                    }
                    $('#frmspecial .id').val(res.id);
                    $('#frmspecial .name').val(res.name);
                    $('#frmspecial .spid').val(res.setting.spid);
                    $('#frmspecial .spname').val(res.setting.spname);
                    $('#frmspecial .subtitle').val(res.setting.subtitle);
                    $('#frmspecial .spimage').val(res.setting.spimage);
                    $('#frmspecial .spcontent').val(res.setting.spcontent);
                    $('#frmspecial .len').val(res.setting.len);
                    $('#frmspecial .remarksname').val(res.setting.remarksname);
                    //循环选中
                    $("[name='tagimg']").each(function(i, obj){
                        if($(obj).data('tagname')==res.setting.tagtemplate){
                            $(obj).parent().addClass("active");
                        }else{
                            $(obj).parent().removeClass("active");
                        }
                    });
                },'json');
                $('#template-old-special-tag').modal('show');
            }
        });

        $("[name=saveSpecial]").click(function(e) {
            e.preventDefault();
            if (isoldspecial) {
                data = $('#frmspecial').serialize();
                $.post('<?php echo url("template/savetag");?>', data, function (res) {
                    $('#frmspecial')[0].reset();
                    $('#frmspecial .id').val('');
                    specialHandle.html(res);
                });
            }
            else {
                $("input[name='tag-tabid-special']").each(function(){
                    var id=$(this).val();
                    data = $('#frmspecial'+id).serialize();
                    $.ajaxSetup (  { async: false });
                    var savemoduletagurl='<?php echo url("template/savemoduletag");?>';
                    if (visualcatid>0){
                        savemoduletagurl+="&catid="+visualcatid;
                    }
                    if (visualaid>0){
                        savemoduletagurl+="&aid="+visualaid;
                    }
                    if (visualtypeid>0){
                        savemoduletagurl+="&typeid="+visualtypeid;
                    }
                    if (visualspid>0){
                        savemoduletagurl+="&spid="+visualspid;
                    }
                    $.post(savemoduletagurl,data,function(res){
                        $('#frmspecial'+id)[0].reset();
                        $('#frmspecial'+id+' .id').val('');
                        savemodule('frmspecial',id,res,specialHandle);
                        ready_all();
                    });

                });
            }
            publicalert=false;  //还原
            ready_all();
            saveLayout();
        });

        //图片选择
        $("[name=tagimg]").click(function(e) {
            $("#frmspecial .tagtemplate").val($(this).data("tagname"));
            $("[name=tagimglist]").removeClass("active");
            $(this).parent().addClass("active");
        });

    });
</script>

<?php }?>