
<div class="modal fade" id="template-category-shop-tag" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_shopcategory">

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
                <div class="tab-content" name="shop_category_modal_show">

                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveshopcategory" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="template-old-category-shop-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  name="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tag-shoop-config" aria-controls="tag-categoryshop-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('set_up');?>
                        </a>
                    </li>
                    <li role="presentation" name="tag-categoryshop-template">
                        <a href="#tag-categoryshop-template" aria-controls="tag-categoryshop-template" role="tab" data-toggle="tab">
                            <?php echo lang_admin('label_template');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">

                <?php
                $tplarray=include(ROOT.'/template/'.config::get('template_shopping_dir').'/tpltag/tag.config.php');
                $tplarray=$tplarray['shopcategory'];
                $tag_config=isset($data['setting'])?$data['setting']:"";
                $template_shop_dir=config::getadmin('template_shopping_dir');
                ?>
                <!-- 设置 -->
                <div class="tab-content">
                    <div class="blank20"></div>
                    <div role="tabpanel" class="tab-pane active" id="tag-shoop-config">
                        <form method="post" name="frmshopcategory" id="frmshopcategory" action="">
                            <input type="hidden" name="tagfrom" value="shopcategory" class="form-control">
                            <input type="hidden" name="id" value="" class="form-control id">

                            <div class="row" >

                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('remarks');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <input placeholder="<?php echo lang_admin('please_enter_the_signature_name_of_the_field_target');?>" type="text" name="remarksname" value="" class="remarksname form-control">

                                </div>

                                <div class="clearfix blank20">
                                </div>


                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('column');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <?php echo form::select('catid', (isset($tag_config['catid'])?$tag_config['catid']:0), category::optionshopping());?>
                                </div>

                                <div class="clearfix blank20"></div>

                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('number_of_headings');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <input placeholder="<?php echo lang_admin('please_enter_the_caption_text_restriction');?>" type="text" name="titlenum" value="" class="titlenum form-control" oninput="value=value.replace(/[^\d]/g,'')">

                                </div>
                                <div class="clearfix blank20"> </div>
                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('number_of_column_words');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <input placeholder="<?php echo lang_admin('please_enter_text_restrictions_on_cover_content');?>" type="text" name="textnum" value="" class="textnum form-control" oninput="value=value.replace(/[^\d]/g,'')">

                                </div>
                                <div class="clearfix blank20"> </div>
                                <input name="tagtemplate" class="tagtemplate" id="tagtemplate" type="hidden" value="">
                                <!--  <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                      <?php echo lang_admin('label_template');?>
                                  </div>
                                  <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                      <p class="p-tips"><i class="icon-info"></i> <?php echo lang_admin('if_you_are_not_familiar_with_the_operation_please_do_not_modify_the_following_options');?></p>
                                      <div class="clearfix blank5"> </div>
                                      <?php echo form::select('tagtemplate', isset($tag_config['tagtemplate'])?$tag_config['tagtemplate']:"", $tplarray);?>
                                  </div>-->
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <!-- 标签 -->
                    <div role="tabpanel" class="tab-pane" id="tag-categoryshop-template">
                        <?php if (is_array($tplarray)) foreach ($tplarray as $key=>$val){ $tagimg=str_replace(".html","",$val);?>
                            <div class="tag-preview" name="tagimglist">
                                <img src="/template/<?php echo $template_shop_dir;?>/tpltag/<?php echo $tagimg;?>.jpg" alt="<?php echo $val;?>" data-tagname="<?php echo $val;?>" name="shoptagimg">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveshopcategory" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 标签弹出框 -->
<script type="text/javascript">
    var template_getshopcategory='<?php echo url("template/getcategory/shop/1");?>';
    var currenteditor1;
    $(document).ready(function () {
        var isoldcategoryshop=false;
        $('body.edit .visual-right').on("click","[data-target='#template-category-shop-tag']",function(e) {
            e.preventDefault();
            visual_left_btn();//边栏收缩
            currenteditor1 = $(this).parent().parent().parent().siblings('.view');
            var eText = currenteditor1.find(' .tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) ) {
                $("[name='template_lading']").attr("style","display: block;");
                $('#template-category-shop-tag').attr('style','display:block');
                $('#template-category-shop-tag').addClass("modal-right");
                //打开标签选中
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getmodulestag");?>',{'tag':eText,'num':1},function(res){
                    $('#template-old-category-shop-tag').modal('hide');
                    //弹出框的导航栏增加
                    tabslist(res,'shopcategory');
                    //生成栏目弹出框的  动态内容
                    shopcategoryhtml(res);
                },'json');
            }else{
                //打开的老的弹出框
                isoldcategoryshop=true;
                //打开标签选中
                $("#tag-categoryshop-template").removeAttr("style");
                $("[name='tag-categoryshop-template']").removeAttr("style");
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getshoptag");?>',{'tag':eText},function(res){
                    //弹出框
                    $('#template-category-shop-tag').modal('hide');
                    console.log(res);
                    if(res.tagname!="" && res.tagname!=undefined) {
                        currenteditor1.find('.tag .tagname').html(res.tagname);     //修改html的内容
                    }

                    $('#frmshopcategory .id').val(res.id);
                    $('#frmshopcategory .remarksname').val(res.setting.remarksname);
                    $('#frmshopcategory .textnum').val(res.setting.textnum);
                    $('#frmshopcategory .titlenum').val(res.setting.titlenum);
                    $('#frmshopcategory .catid').val(res.setting.catid);
                    $('#frmshopcategory .tagtemplate').val(res.setting.tagtemplate);

                    //循环选中
                    $("[name='tagimg']").each(function(i, obj){
                        if($(obj).data('tagname')==res.setting.tagtemplate){
                            $(obj).parent().addClass("active");
                        }else{
                            $(obj).parent().removeClass("active");
                        }
                    });
                },'json');
                $('#template-old-category-shop-tag').modal('show');
            }
        });

        //针对模块拖出组件  创建新的插件
        $('body.edit .visual-right').on("click","[data-target='#template-old-category-shop-tag']",function(e) {
            e.preventDefault();
            currenteditor1 = $(this).parent().parent().parent().siblings('.view');
            var eText = currenteditor1.find('.tagname').html();
            //打开的老的弹出框
            isoldcategoryshop=true;
            //打开标签选中
            $("#tag-template").removeAttr("style");
            $("[name='tag-template']").removeAttr("style");
            //弹出框
            $('#template-category-shop-tag').modal('hide');
            //隐藏新版栏目弹出框
            $.ajaxSetup (  { async: true });
            $.post('<?php echo url("template/getshoptag");?>',{'tag':eText},function(res){
                console.log(res);
                if(res.tagname!="" && res.tagname!=undefined) {
                    currenteditor1.find('.tag .tagname').html(res.tagname);     //修改html的内容
                }
                $('#frmshopcategory .id').val(res.id);
                $('#frmshopcategory .remarksname').val(res.setting.remarksname);
                $('#frmshopcategory .textnum').val(res.setting.textnum);
                $('#frmshopcategory .titlenum').val(res.setting.titlenum);
                $('#frmshopcategory .catid').val(res.setting.catid);
                $('#frmshopcategory .tagtemplate').val(res.setting.tagtemplate);

                //循环选中
                $("[name='tagimg']").each(function(i, obj){
                    if($(obj).data('tagname')==res.setting.tagtemplate){
                        $(obj).parent().addClass("active");
                    }else{
                        $(obj).parent().removeClass("active");
                    }
                });
            },'json');
        });


        //图片选择
        $("[name=shoptagimg]").click(function(e) {
            $("#frmshopcategory .tagtemplate").val($(this).data("tagname"));
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

        $("[name=saveshopcategory]").click(function(e) {
            e.preventDefault();
            if (isoldcategoryshop){
                isoldcategoryshop=false;

                if($('#frmshopcategory .textnum').val() == ''){
                    alert("<?php echo lang_admin('please_fill_in_the_text_restrictions');?>");
                    $('#frmshopcategory .textnum').focus();
                    return false;
                }
                if( $("#frmshopcategory .tagtemplate").val() == ''){
                    alert("<?php echo lang_admin('please_choose').lang_admin('template_tags');?>");
                    return false;
                }
                if($('#frmshopcategory .titlenum').val() == ''){
                    alert("<?php echo lang_admin('please_fill_in_the_caption_text_restriction');?>");
                    $('#frmshopcategory .titlenum').focus();
                    return false;
                }
                if($('#frmshopcategory .catid').val()=='0'){
                    alert("<?php echo lang_admin('please_select_the_column');?>");
                    $('#frmshopcategory .catid').focus();
                    return false;
                }
                data = $('#frmshopcategory').serialize();
                $.post('<?php echo url("template/saveshoptag");?>',data,function(res){
                    $('#frmshopcategory')[0].reset();
                    $('#frmshopcategory .id').val('');
                    currenteditor1.html(res);
                });
            }else{
                $("input[name='tag-tabid-shopcategory']").each(function(){
                var id=$(this).val();
                if($('#frmshopcategory'+id+' [name=textnum]').val() == ''){
                    alert("<?php echo lang_admin('please_fill_in_the_text_restrictions');?>");
                    istab($(this).val());
                    $('#frmshopcategory'+id+' [name=textnum]').focus();
                    return false;
                }
                if($('#frmshopcategory'+id+' [name=titlenum]').val() == ''){
                    alert("<?php echo lang_admin('please_fill_in_the_caption_text_restriction');?>");
                    istab(id);
                    $('#frmshopcategory'+id+' [name=titlenum]').focus();
                    return false;
                }
                if($('#frmshopcategory'+id+' [name=catid]').val() == '0'){
                    alert("<?php echo lang_admin('please_select_the_column');?>");
                    istab(id);
                    $('#frmshopcategory'+id+' [name=catid]').focus();
                    return false;
                }
                data = $('#frmshopcategory'+id).serialize();
                $.ajaxSetup (
                    {
                        async: false
                    });
                var savemoduletagurl='<?php echo url("template/savemoduletag");?>';
                if (visualcatid>0){
                    savemoduletagurl+="&catid="+visualcatid;
                }
                if (visualaid>0){
                    savemoduletagurl+="&aid="+visualaid;
                }
                $.post(savemoduletagurl,data,function(res){
                    $('#frmshopcategory'+id)[0].reset();
                    $('#frmshopcategory'+id+' .id').val('');
                    savemodule('frmshopcategory',id,res,currenteditor1);

                });

            });
            }
            publicalert=false;  //还原
            ready_all();
            saveLayout();
        });
    });



</script>