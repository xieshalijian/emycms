
<div class="modal fade" id="template-content-shop-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_shopcontent">

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
                <div class="tab-content" name="shop_content_modal_show">

                </div>

            </div><div class="modal-footer">
                <button  type="button"  name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveshopcontent" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="template-old-content-shop-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" name="close" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tag-content-config" aria-controls="tag-content-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('set_up');?>
                        </a>
                    </li>
                    <li role="presentation" name="tag-content-template">
                        <a href="#tag-content-template" aria-controls="tag-content-template" role="tab" data-toggle="tab">
                            <?php echo lang_admin('label_template');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">

                <div class="tab-content">
                    <div class="blank20"></div>
                    <div role="tabpanel" class="tab-pane active" id="tag-contentshop-config">
                        <form method="post" id="frmshopcontent" name="frmshopcontent" action="">
                            <input type="hidden" name="id" class="id" value="">
                            <input type="hidden" name="tagfrom" value="shopcontent" class="form-control">

                            <div class="row">

                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('remarks');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <input placeholder="<?php echo lang_admin('please_enter_the_signature_name_of_the_field_target');?>" type="text" name="remarksname" value="" class="remarksname form-control">

                                    <div class="clearfix blank20">
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('column');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <?php echo form::select('catid', (isset($tag_config['catid'])?$tag_config['catid']:0), category::optionshopping());?>
                                    </div>
                                    <div class="clearfix blank20">
                                    </div>

                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('subcolumn');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <select id="son" name="son" class="form-control select son">
                                            <option value="1">
                                                <?php echo lang_admin('yes');?>
                                            </option>
                                            <option value="0">
                                                <?php echo lang_admin('no');?>
                                            </option>

                                        </select>
                                    </div>

                                    <div class="clearfix blank20">
                                    </div>

                                    <?php if(file_exists(ROOT."/lib/table/type.php")) { ?>
                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('type');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <?php echo form::select('typeid', isset($tag_config['typeid'])?$tag_config['typeid']:0, type::option());?>
                                    </div>
                                    <div class="clearfix blank20">
                                    </div>
                                    <?php }?>

                                    <?php if(file_exists(ROOT."/lib/table/special.php")) { ?>
                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('special');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <?php echo form::select('spid', isset($tag_config['spid'])?$tag_config['spid']:0, special::option());?>
                                    </div>
                                    <div class="clearfix blank20">
                                    </div>
                                    <?php }?>

                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('number_of_caption_intercepted_words');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <input type="text" name="length" id="length" value="20" class="length form-control" oninput="value=value.replace(/[^\d]/g,'')">
                                    </div>

                                    <div class="clearfix blank20">
                                    </div>

                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('introduction_of_intercepted_words');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <input type="text" name="introduce_length" id="introduce_length" value="-1" class="form-control introduce_length">
                                    </div>

                                    <div class="clearfix blank20">
                                    </div>

                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('sort');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <select id="ordertype" name="ordertype" class="form-control ordertype select">
                                            <option value="adddate-desc">
                                                <?php echo lang_admin('contact_informationupdate_in_reverse_chronological_order');?>
                                            </option>
                                            <option value="aid-desc">
                                                <?php echo lang_admin('latest_in_reverse_order_of_aids');?>
                                            </option>
                                            <option value="aid-asc">
                                                <?php echo lang_admin('earliest_in_order_of_aids');?>
                                            </option>
                                            <option value="view-desc">
                                                <?php echo lang_admin('hottest_in_reverse_order_of_view');?>
                                            </option>
                                            <option value="comment_num-desc">
                                                <?php echo lang_admin('comments_in_reverse_order_of_comment_num');?>
                                            </option>
                                            <option value="rand()">
                                                <?php echo lang_admin('random');?>
                                            </option>
                                        </select>
                                    </div>

                                    <div class="clearfix blank20">
                                    </div>

                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('call_top_content');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <select id="istop" name="istop" class="form-control istop select">
                                            <option value="0">
                                                <?php echo lang_admin('no');?>
                                            </option>
                                            <option value="1">
                                                <?php echo lang_admin('yes');?>
                                            </option>
                                        </select>
                                    </div>

                                    <div class="clearfix blank20">
                                    </div>

                                    <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                        <?php echo lang_admin('number_of_call_records');?>
                                    </div>
                                    <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                        <input type="text" name="limit" id="limit" value="3" class="limit form-control" oninput="value=value.replace(/[^\d]/g,'')">
                                    </div>
                                </div>
                                <div class="row" style="display:none ">
                                    <input   type="text" name="tagcontent" id="tagcontent" value=" " class="name form-control">
                                    <input   type="text" name="onlymodify" id="onlymodify" value=" " class="name form-control">
                                </div>
                                <div class="clearfix blank20">
                                </div>

                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('thumbnail');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <input type="checkbox" value="1" class="thumb"  id="thumbcheckbox"  >
                                    <input type="hidden" name="thumb" id="thumb" value="off" />
                                    <script>
                                        $("#thumbcheckbox").click(function(){
                                            if ($(this).is(":checked")) {
                                                $("[name=thumb]").val("on");
                                            } else {
                                                $("[name=thumb]").val("off");
                                            }
                                        });
                                    </script>
                                </div>

                                <div class="clearfix blank20">
                                </div>

                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('recommendation_bit');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <?php
                                    $tplarray=include(ROOT.'/template/'.config::get('template_shopping_dir').'/tpltag/tag.config.php');
                                    $tplarray=$tplarray['shopcontent'];
                                    $template_shop_dir=config::getadmin('template_shopping_dir');

                                    $set=settings::getInstance();
                                    $sets=$set->getrow(array('tag'=>'table-archive'));
                                    $ds=(isset($sets['value']) && $sets['value'])?unserialize($sets['value']):array();
                                    $ds['attr1']=isset($ds['attr1'])?$ds['attr1']:"";
                                    preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%s',$ds['attr1'],$result,PREG_SET_ORDER);
                                    $sdata=array();
                                    foreach ($result as $res) $sdata[$res['1']]=$res['2'];
                                    $tag_config['attr1']=isset($tag_config['attr1'])?$tag_config['attr1']:"";
                                    echo form::select('attr1', $tag_config['attr1'], $sdata);
                                    ?>
                                </div>

                                <div class="clearfix blank20">
                                </div>
                                <input name="tagtemplate" class="tagtemplate" id="tagtemplate" type="hidden" value="">
                                <!-- <div class="row tag-template">
                                     <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                         <?php echo lang_admin('label_template');?>
                                     </div>
                                     <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                         <p class="p-tips"><i class="icon-info"></i> <?php echo lang_admin('if_you_are_not_familiar_with_the_operation_please_do_not_modify_the_following_options');?></p>
                                         <div class="clearfix blank5"> </div>
                                         <?php echo form::select('tagtemplate', isset($tag_config['tagtemplate'])?$tag_config['tagtemplate']:"", $tplarray);?>
                                     </div>
                                 </div>-->
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>

                    <!-- 标签 -->
                    <div role="tabpanel" class="tab-pane" id="tag-contentshop-template">
                        <?php if (is_array($tplarray)) foreach ($tplarray as $key=>$val){ $tagimg=str_replace(".html","",$val);?>
                            <div class="tag-preview" name="tagimglist">
                                <img src="/template/<?php echo $template_shop_dir;?>/tpltag/<?php echo $tagimg;?>.jpg" alt="<?php echo $val;?>" data-tagname="<?php echo $val;?>" name="tagimg">
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
                <button name="saveshopcontent" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var currenteditor;
    var template_getshopcontent='<?php echo url("template/getcontent/shop/1");?>';
    $(document).ready(function () {
        var isoldcontentshop=false;
        $('body.edit .visual-right').on("click", "[data-target='#template-content-shop-tag']", function (e) {
            e.preventDefault();
            visual_left_btn();//边栏收缩
            currenteditor = $(this).parent().parent().parent().parent().find('.view');
            var eText = currenteditor.find('.tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');

            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) ) {
                $("[name='template_lading']").attr("style","display: block;");
                $('#template-content-shop-tag').addClass("modal-right");
                isoldcontentshop=false;
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getmodulestag");?>', {'tag': eText}, function (res) {
                    $('#template-old-content-shop-tag').modal('hide');
                    console.log(res);
                    //弹出框的导航栏增加
                    tabslist(res, 'shopcontent');
                    //生成栏目弹出框的  动态内容
                    shopcontenthtml(res);
                }, 'json');
            }else{
                //打开的老的弹出框
                isoldcontentshop=true;
                //打开标签选中
                $("#tag-contentshop-template").removeAttr("style");
                $("[name='tag-contentshop-template']").removeAttr("style");
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getshoptag");?>',{'tag':eText},function(res){
                    //弹出框
                    $('#template-content-shop-tag').modal('hide');
                    console.log(res);
                    if(res.tagname!="" && res.tagname!=undefined) {
                        currenteditor.find('.tag .tagname').html(res.tagname);     //修改html的内容
                    }

                    $('#frmshopcontent .id').val(res.id);
                    $('#frmshopcontent .remarksname').val(res.setting.remarksname);
                    $('#frmcontent #tagcontent').val(res.tagcontent);
                    $('#frmcontent #onlymodify').val(res.setting.onlymodify);
                    $('#frmshopcontent .catid').val(res.setting.catid);
                    $('#frmshopcontent .son').val(res.setting.son);
                    $('#frmshopcontent .typeid').val(res.setting.typeid);
                    $('#frmshopcontent .spid').val(res.setting.spid);
                    $('#frmshopcontent .length').val(res.setting.length);
                    $('#frmshopcontent .introduce_length').val(res.setting.introduce_length);
                    $('#frmshopcontent .ordertype').val(res.setting.ordertype);
                    $('#frmshopcontent .istop').val(res.setting.istop);
                    $('#frmshopcontent .limit').val(res.setting.limit);

                    $('#frmcontent #thumbcheckbox').attr('checked',res.setting.thumb=='1');
                    if (res.setting.thumb=='1' || res.setting.thumb=='on'){
                        $('#frmcontent #thumb').val('on');
                    }else{
                        $('#frmcontent #thumb').val('off');
                    }
                    if (res.setting.attr1==0){
                        res.setting.attr1="";
                    }
                    $('#frmshopcontent #attr1').val(res.setting.attr1);
                    $('#frmshopcontent .tagtemplate').val(res.setting.tagtemplate);

                    //循环选中
                    $("[name='tagimg']").each(function(i, obj){
                        if($(obj).data('tagname')==res.setting.tagtemplate){
                            $(obj).parent().addClass("active");
                        }else{
                            $(obj).parent().removeClass("active<?php echo $val;?>");
                        }
                    });
                },'json');
                $('#template-old-content-shop-tag').modal('show');
            }
        });

        $('body.edit .visual-right').on("click", "[data-target='#template-old-content-shop-tag']", function (e) {
            e.preventDefault();
            currenteditor = $(this).parent().parent().parent().parent().find('.view');
            var eText = currenteditor.find('.tagname').html();
                //打开的老的弹出框
                isoldcontentshop=true;
                //打开标签选中
                $("#tag-contentshop-template").removeAttr("style");
                $("[name='tag-contentshop-template']").removeAttr("style");
                //弹出框
                $('#template-content-shop-tag').modal('hide');
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getshoptag");?>',{'tag':eText},function(res){
                    console.log(res);
                    if(res.tagname!="" && res.tagname!=undefined) {
                        currenteditor.find('.tag .tagname').html(res.tagname);     //修改html的内容
                    }
                    $('#frmshopcontent .id').val(res.id);
                    $('#frmshopcontent .remarksname').val(res.setting.remarksname);
                    $('#frmcontent #tagcontent').val(res.tagcontent);
                    $('#frmcontent #onlymodify').val(res.setting.onlymodify);
                    $('#frmshopcontent .catid').val(res.setting.catid);
                    $('#frmshopcontent .son').val(res.setting.son);
                    $('#frmshopcontent .typeid').val(res.setting.typeid);
                    $('#frmshopcontent .spid').val(res.setting.spid);
                    $('#frmshopcontent .length').val(res.setting.length);
                    $('#frmshopcontent .introduce_length').val(res.setting.introduce_length);
                    $('#frmshopcontent .ordertype').val(res.setting.ordertype);
                    $('#frmshopcontent .istop').val(res.setting.istop);
                    $('#frmshopcontent .limit').val(res.setting.limit);

                    $('#frmcontent #thumbcheckbox').attr('checked',res.setting.thumb=='1');
                    if (res.setting.thumb=='1' || res.setting.thumb=='on'){
                        $('#frmcontent #thumb').val('on');
                    }else{
                        $('#frmcontent #thumb').val('off');
                    }
                    if (res.setting.attr1==0){
                        res.setting.attr1="";
                    }
                    $('#frmshopcontent #attr1').val(res.setting.attr1);
                    $('#frmshopcontent .tagtemplate').val(res.setting.tagtemplate);

                    //循环选中
                    $("[name='tagimg']").each(function(i, obj){
                        if($(obj).data('tagname')==res.setting.tagtemplate){
                            $(obj).parent().addClass("active");
                        }else{
                            $(obj).parent().removeClass("active<?php echo $val;?>");
                        }
                    });
                },'json');
        });

        //图片选择
        $("[name=tagimg]").click(function (e) {
            $("#frmshopcontent .tagtemplate").val($(this).data("tagname"));
            $("[name=tagimglist]").removeClass("archive");
            $(this).parent().addClass("archive");
        });

        //提示弹到指定位置
        function istab(id) {
            $('[name=tab-li]').removeClass('active');
            $('#tab-li-' + id + '').addClass('active');
            $('[name=tab-show]').removeClass('active');
            $('#tag-show-' + id + '').addClass('active');
        }

        $("[name=saveshopcontent]").click(function (e) {
            e.preventDefault();
            if (isoldcontentshop) {
                isoldcontentshop=false;

                if($('#frmshopcontent .catid').val()=='0'){
                    alert("<?php echo lang_admin('please_select_the_column');?>");
                    $('#frmshopcontent .catid').focus();
                    return false;
                }
                if( $("#frmshopcontent .tagtemplate").val() == ''){
                    alert("<?php echo lang_admin('please_choose').lang_admin('template_tags');?>");
                    return false;
                }
                data = $('#frmshopcontent').serialize();

                $.post('<?php echo url("template/saveshoptag");?>',data,function(res){
                    $('#frmshopcontent')[0].reset();
                    $('#frmshopcontent .id').val('');

                    currenteditor.html(res);
                });
            }else{
                $("input[name='tag-tabid-shopcontent']").each(function () {
                    var id = $(this).val();
                    if ($('#frmshopcontent' + id + ' [name=catid]').val() == '0') {
                        alert("<?php echo lang_admin('please_select_the_column');?>");
                        istab(id);
                        $('#frmshopcontent' + id + ' [name=catid]').focus();
                        return false;
                    }
                    data = $('#frmshopcontent' + id).serialize();
                    $.ajaxSetup(
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
                    $.post(savemoduletagurl, data, function (res) {
                        $('#frmshopcontent' + id)[0].reset();
                        $('#frmshopcontent' + id + ' .id').val('');

                        savemodule('frmshopcontent',id,res,currenteditor);
                        ready_all();
                    });

                });
            }
            publicalert = false;  //还原
            ready_all();
            saveLayout();
        });
    });


</script>