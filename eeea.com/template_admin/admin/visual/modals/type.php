
<?php if(file_exists(ROOT."/lib/table/type.php")) { ?>

<div class="modal fade" id="template-type-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_type">

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
                <div class="tab-content" name="type_modal_show">

                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveType" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="template-old-type-tag" tabindex="-1" role="dialog"
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
                        <a href="#tag-type-config" aria-controls="tag-type-config" role="tab" data-toggle="tab">
<?php echo lang_admin('type_label_attributes');?>
                        </a>
                    </li>
                    <li role="presentation" name="tag-type-template" >
                        <a href="#tag-type-template" aria-controls="tag-type-template" role="tab" data-toggle="tab">
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
                $tplarray=$tplarray['type'];
                $tag_config=$data['setting'];
                ?>
                <!-- 设置 -->
                <div class="tab-content">
                <div class="blank20"></div>
                <div role="tabpanel" class="tab-pane active" id="tag-type-config">

                   <form method="post" name="frmtype" id="frmtype" action="">
                    <input type="hidden" name="tagfrom" value="type" class="form-control">
                    <input type="hidden" name="id" value="" class="form-control id">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                           <?php echo lang_admin('remarks');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <input placeholder="<?php echo lang_admin('please_enter_the_name_of_the_type_label');?>" type="text" name="remarksname" value="" class="remarksname form-control">

                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('type');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">

                            <?php echo form::select('typeid', $tag_config['typeid'],type::option(0,lang_admin('all_type')));?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('title');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="spname" name="tyname" class="form-control select tyname">
                                <option value="1" >
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
                                <option value="1" >
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
<?php echo lang_admin('type_picture');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="tyimage" name="tyimage" class="form-control select tyimage">
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
                            <select id="typecontent" name="typecontent" class="form-control select tycontent">
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
                      <!--  <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                            <?php /*echo lang_admin('label_template');*/?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php /*echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);*/?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title="<?php /*echo lang_admin('label_template');*/?>文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_type_*.html!">
                                    </span>
                        </div>-->
                    </div>
                </form>
                </div>
                <!-- 标签 -->
                <div role="tabpanel" class="tab-pane" id="tag-type-template">
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
                <button name="saveType" type="button"    class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- 标签弹出框 -->
<script type="text/javascript">
    var typeHandle;
    var template_gettype='<?php echo url("template/gettype");?>';
    $(document).ready(function () {
        var isoldtype=false;
        $('body.edit .visual-right').on("click","[data-target='#template-type-tag']",function(e) {
            e.preventDefault();
            typeHandle = $(this).parent().parent().parent().parent().find('.view');
            var eText = typeHandle.find('.tag .tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            var _tag_buymodules=new RegExp('cmseasyg_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) ) {
                $("[name='template_lading']").attr("style","display: block;");
                $('#template-type-tag').attr('style','display:block');
                $('#template-type-tag').addClass("modal-right");
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getmodulestag");?>', {'tag': eText, 'num': 1}, function (res) {
                    //隐藏old版栏目弹出框
                    $('#template-old-type-tag').modal('hide');
                    //弹出框的导航栏增加
                    tabslist(res, 'type');
                    //生成栏目弹出框的  动态内容
                    typehtml(res);
                }, 'json');
            }
            else{
                //打开的老的弹出框
                isoldtype=true;
                //打开标签选中
                $("[name='tag-type-template']").removeAttr("style");
                //隐藏新版栏目弹出框
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/gettag");?>', {'tag': eText}, function (res) {

                    //弹出框
                    $('#template-type-tag').modal('hide');
                    if(res.tagname!="" && res.tagname!=undefined) {
                        typeHandle.find('.tag .tagname').html(res.tagname);     //修改html的内容
                    }
                    $('#frmtype .id').val(res.id);
                    $('#frmtype .name').val(res.name);
                    $('#frmtype .typeid').val(res.setting.typeid);
                    $('#frmtype .remarksname').val(res.setting.remarksname);
                    $('#frmtype .tyname').val(res.setting.tyname);
                    $('#frmtype .subtitle').val(res.setting.subtitle);
                    $('#frmtype .tyimage').val(res.setting.tyimage);
                    $('#frmtype .typecontent').val(res.setting.typecontent);
                    $('#frmtype .len').val(res.setting.len);
                    //循环选中
                    $("[name='tagimg']").each(function(i, obj){
                        if($(obj).data('tagname')==res.setting.tagtemplate){
                            $(obj).parent().addClass("active");
                        }else{
                            $(obj).parent().removeClass("active");
                        }
                    });
                }, 'json');
                $('#template-old-type-tag').modal('show');
            }
        });
        //图片选择
        $("[name=tagimg]").click(function(e) {
            $("#frmtype .tagtemplate").val($(this).data("tagname"));
            $("[name=tagimglist]").removeClass("active");
            $(this).parent().addClass("active");
        });

        //提示弹到指定位置
        function istab(id){
            $('[name=tab-li]').removeClass('active');
            $('#tab-li-'+id+'').addClass('active');
            $('[name=tab-show]').removeClass('active');
            $('#tag-show-'+id+'').addClass('active');
        }

        $("[name=saveType]").click(function(e) {
            e.preventDefault();
            if (isoldtype) {
                data = $('#frmtype').serialize();
                $.post('<?php echo url("template/savetag");?>', data, function (res) {
                    $('#frmtype')[0].reset();
                    $('#frmtype .id').val('');
                    typeHandle.html(res);
                });
            }
            else{
                $("input[name='tag-tabid-type']").each(function(){
                    var id=$(this).val();
                    data = $('#frmtype'+id).serialize();
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
                    $.post(savemoduletagurl,data,function(res){
                        $('#frmtype'+id)[0].reset();
                        $('#frmtype'+id+' .id').val('');
                        savemodule('frmtype',id,res);
                        ready_all();
                    });

                });
            }
            publicalert=false;  //还原
            ready_all();
            saveLayout();
        });
    });
</script>

<?php }?>
