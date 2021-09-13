
<!--Banner选择弹出框-->
<style type="text/css">
    .table>tbody>tr>td { vertical-align:middle;}
    .modal-body .btn-default {padding: 6px 12px;}
    .nav-tabs>li>a {color:#f5f5f5;}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {background-color: #49494a !important; color:#f5f5f5;margin-bottom: -2px;}
    .content-nav-tabs {margin-bottom: 8px;}
    .modal-body .input-group-addon-slide {background: #393939 !important;}
    .modal-body .input-group-addon-slide div.btn-gray {border:none; background-color:transparent;}
    .file-input-new {margin-right:0px;}
</style>
<div class="modal fade" id="template-slide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="icon-close"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('slide');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">

                <form name="slideform" id="slideform"  action="#" method="post">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr class="th">
                                <th class="s_out"></th>
                                <th class="catid text-center"><?php echo lang_admin('id');?></th>
                                <th class="catid"><?php echo lang_admin('name');?></th>
                                <th class="catname"><?php echo lang_admin('adddate');?></th>
                                <th class="catname"><?php echo lang_admin('dosomething');?></th>
                            </tr>
                            </thead>
                            <input type="hidden" name="slide_config_id"  value="0"/>
                            <tbody id="slide_body">
                            <!---->
                            </tbody>

                        </table>
                    </div>
                    <div class="blank30"></div>
                    <a class="btn btn-primary" href="<?php echo $base_url;?>/index.php?admin_dir=<?php echo config::getadmin('admin_dir',true);?>&site=default&gotoinurl=slide/add"
                       target="_blank" ><?php echo lang_admin('add_slide');?></a>
                </form>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveslide" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>



<!--Banner主表编辑弹出框-->
<div class="modal fade" id="template-slide-edit" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="icon-close"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('edit_slide');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="blank30"></div>
                <form name="slide_edit_form" id="slide_edit_form"  action="#" method="post">
                    <input type="hidden" name="id"  value="0" class="form-control id">
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_name');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <input type="text" name="name"  value="" class="form-control name" disabled>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_width');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <input type="text" name="slide_width"  value="" class="form-control slide_width">
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_height');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <input type="text" name="slide_height"  value="" class="form-control slide_height">
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_time');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <input type="text" name="slide_time"  value="" class="form-control slide_time">
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_style_position');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <select  name="slide_style_position" class="form-control select slide_style_position ">
                                <option value="0"><?php echo lang_admin('be_at_the_left_side');?></option>
                                <option value="1"><?php echo lang_admin('centered');?></option>
                                <option value="2"><?php echo lang_admin('be_at_the_right');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_text_color');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <div id="slide_text_color" class="input-group slide_text_color">
                                <input type="text" name="slide_text_color"  value="" class="form-control ">
                                <span class="input-group-addon">
                                   <i></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_input_bg');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <div id="slide_input_bg" class="input-group">
                                <input type="text" name="slide_input_bg"  value="" class="form-control slide_input_bg">
                                <span class="input-group-addon">
                                 <i></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_input_color');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <div id="slide_input_color" class="input-group">
                                <input type="text" name="slide_input_color"  value="" class="form-control slide_input_color">
                                <span class="input-group-addon">
                                     <i></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_btn_hover_color');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <div id="slide_btn_hover_color" class="input-group">
                                <input type="text" name="slide_btn_hover_color"  value="" class="form-control slide_btn_hover_color">
                                <span class="input-group-addon">
                                    <i></i>
                                 </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_btn_color');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <div id="slide_btn_color" class="input-group">
                                <input type="text" name="slide_btn_color"  value="" class="form-control slide_btn_color">
                                <span class="input-group-addon">
                                     <i></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_btn_width');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <input type="text" name="slide_btn_width"  value="" class="form-control slide_btn_width">
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_btn_height');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <input type="text" name="slide_btn_height"  value="" class="form-control slide_btn_height">
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_btn_shape');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <select name="slide_btn_shape" class="form-control select slide_btn_shape">
                                <option value="" selected=""><?php echo lang_admin('please_choose');?>...</option>
                                <option value="1" >圆形</option>
                                <option value="2" >方形</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_button_size');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <input type="text" name="slide_button_size"  value="" class="form-control slide_button_size">
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 text-right"><?php echo lang_admin('slide_button_color');?></div>
                        <div class="col-xs-7 col-sm-8 col-md-8 col-lg-8 text-left">
                            <div id="slide_button_color" class="input-group">
                                <input type="text" name="slide_button_color"  value="" class="form-control slide_button_color">
                                <span class="input-group-addon">
                                     <i></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveslide_edit" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<!--Banner片的Banner表编辑弹出框-->

<!--Banner图片编辑弹出框-->
<div class="modal fade" id="template-slide-child-edit" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="icon-close"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('edit_slide_pic');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="blank30"></div>
                <form name="slide_edit_child_form" id="slide_edit_child_form"  action="#" method="post">
                    <input type="hidden" name="slide_sid" value="0">
                    <input type="hidden" name="slide_num" value="1">
                    <div id="slidebody" style="padding:0px 30px;">
                        <div name="slide"  id="slide1">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="add_slide_child" type="button" class="btn btn-primary" ><?php echo lang_admin('add');?>
                    <button name="saveslide_child_edit" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                    </button>
            </div>
        </div>
    </div>
</div>
<!--Banner图片编辑弹出框-->

<!-- 标签弹出框 -->
<script type="text/javascript" id="slideJs">
    function slide_chang(obj){
        $("input[name='slidecheckbox']:checked").each(function () {
            $(this).prop("checked",false);
        });
        $(obj).prop("checked",true);
    }

    var currenteditor1;
    $(document).ready(function () {
        $(".modal-backdrop.fade").hide();
        $('body.edit .visual-right').on("click","[data-target='#template-slide']",function(e) {
            e.preventDefault();
            currenteditor1 = $(this).parent().parent().parent().siblings('.view');
            var eText = currenteditor1.find('.tagname').html();
            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_buymodules');
            var _tag_sections=new RegExp('tag_sections');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) || _tag_sections.test(eText)) {
                $.post('<?php echo url("template/getmodulestag");?>', {'tag': eText, 'num': 1}, function (res) {
                    slide_list(res[0]['slidename'],res[0]);
                }, 'json');
            }else{
                slide_list(eText);//列表加载
            }
        });

        //保存Banner片选择的
        $("[name=saveslide]").click(function(e) {
            e.preventDefault();

            var  slidename="";
            $("input[name='slidecheckbox']:checked").each(function () {
                if ($(this).is(":checked")){
                    slidename=$(this).val();
                }
            });
            if (slidename==""){
                alert('请选择Banner片！');
                return;
            }
            var slide_config_id=$('[name=slide_config_id]').val();
            var modulesname=$("[name=slidenewmodulesname]").val();
            var slidtagfrom=$("[name=slidtagfrom]").val();
            var slidid=$("[name=slidid]").val();
            $.ajaxSetup ({ async: false });
            $.post('<?php echo url("template/save_slide");?>',{'slide_config_id':slide_config_id,'slidename':slidename,"modulesname":modulesname,"tagfrom":slidtagfrom,"id":slidid},function(res){

                if (!publicalert){
                    currenteditor1.html(res);
                }else{
                    if (nosortablepublicvisual){
                        var thishtml=$('#visual-right').html();
                        var publictagname=$("[name=slidmodulesname]").val();
                        thishtml=thishtml.replace(publictagname,'<div id="publictagname"></div>');
                        $('#visual-right').html(thishtml);
                        $("#publictagname").parent().parent().html(res);
                        oldvisual=$("#visual-right").html();   //记录
                    }else
                    if (publicprev.length>0) {
                        var nextdata=publicprev.next().html();
                        var publictagname=$("[name=slidmodulesname]").val();
                        nextdata=nextdata.replace(publictagname,'<div id="publictagname"></div>');
                        publicprev.next().html(nextdata);
                        $("#publictagname").parent().parent().html(res);
                        oldvisual=$(".visual-right").html();   //记录
                    }else
                    if (publicnext.length>0) {
                        var nextdata=publicnext.prev().html();
                        var publictagname=$("[name=slidmodulesname]").val();
                        nextdata=nextdata.replace(publictagname,'<div id="publictagname"></div>');
                        publicnext.prev().html(nextdata);
                        $("#publictagname").parent().parent().html(res);
                        oldvisual=$(".visual-right").html();   //记录
                    }
                    else  if (publicparent.length>0) {
                        var parentdata=publicparent.html();
                        var publictagname=$("[name=slidmodulesname]").val();
                        parentdata=parentdata.replace(publictagname,'<div id="publictagname"></div>');
                        publicparent.html(parentdata);
                        $("#publictagname").parent().parent().html(res);
                        oldvisual=$("#visual-right").html();   //记录
                    }
                }
                publicalert=false;  //还原
                ready_all();
                saveLayout();
            });

        });

        //保存编辑的Banner片
        $("[name=saveslide_edit]").click(function(e) {
            e.preventDefault();
            if ($('#slide_edit_form .name').val()==""){
                alert('请输入Banner片名称！');
                $('#slide_edit_form .name').focus();
                return;
            }
            if ($('#slide_edit_form .slide_time').val()==""){
                alert('请输入切换时间！');
                $('#slide_edit_form .name').focus();
                return;
            }

            data = $('#slide_edit_form').serialize();
            $.ajaxSetup ({ async: true });
            $.post('<?php echo url("slide/saveslide");?>',data,function(res){
                console.log(res);
            });
        });

        //保存编辑的Banner片-子表
        $("[name=saveslide_child_edit]").click(function(e) {
            e.preventDefault();
            data = $('#slide_edit_child_form').serialize();
            $.ajaxSetup ({ async: true });
            $.post('<?php echo url("slide/saveslide_child");?>',data,function(res){
                console.log(res);
            });
        });

        //新增子表Banner片
        $("[name=add_slide_child]").click(function(e) {
            var slide_num=$("[name=slide_num]").val();
            var newslide_num=parseInt(slide_num)+1;
            var htmltrl='<div name="slide" id="slide'+newslide_num+'">';

            htmltrl+='<div class="row"><a class="btn btn-primary"><?php echo lang_admin("slide");?>'+newslide_num;
            htmltrl+='</a>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="delete_slide('+newslide_num+',0)"   value="<?php echo lang_admin('del_slide');?>" class="btn btn-default"/></div>';

            htmltrl+='<div class="clearfix blank20"></div>';

            htmltrl+='<div class="row">';
            htmltrl+='<ul class="nav nav-tabs content-nav-tabs" role="tablist">';
            <?php foreach (lang::getlang() as $lang){  ?>
            htmltrl+='<li role="presentation" class="<?php if($lang['langurlname']==lang::getisadmin()){  ?>active<?php };?>">';
            htmltrl+='<a href="#slide-<?php echo $lang['langurlname'];?>-'+newslide_num+'" aria-controls="slide-<?php echo $lang['langurlname'];?>-'+newslide_num+'" role="tab" data-toggle="tab">';
            htmltrl+='<?php echo $lang["langname"];?>';
            htmltrl+='</a>';
            htmltrl+='</li>';
            <?php };?>
            htmltrl+='</ul>';

            <!-- Tab panes -->
            htmltrl+='<div class="tab-content">';
            <?php foreach (lang::getlang() as $lang){  ?>
            htmltrl+='<div role="tabpanel" class="tab-pane <?php if($lang['langurlname']==lang::getisadmin()){  ?>active<?php };?>" id="slide-<?php echo $lang['langurlname'];?>-'+newslide_num+'">';
            htmltrl+='<div class="input-group">';
            htmltrl+='<span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_pic_title');?></span>';
            htmltrl+='<input type="text" name="slide_title[<?php echo $lang['langurlname'];?>]['+newslide_num+']"   value="" class="form-control ">';
            htmltrl+='</div>';
            htmltrl+='<div class="clearfix blank20"></div>';
            htmltrl+='<div class="input-group">';
            htmltrl+='<span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_pic_subtitle');?></span>';
            htmltrl+='<input type="text" name="slide_subtitle[<?php echo $lang['langurlname'];?>]['+newslide_num+']"   value="" class="form-control ">';
            htmltrl+='</div>';
            htmltrl+='<div class="clearfix blank20"></div>';
            htmltrl+='<div class="input-group">';
            htmltrl+='<span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_input_text');?></span>';
            htmltrl+='<input type="text" name="slide_butname[<?php echo $lang['langurlname'];?>]['+newslide_num+']"   value="" class="form-control ">';
            htmltrl+='</div>';
            htmltrl+='<div class="clearfix blank20"></div>';
            htmltrl+='<div class="input-group">';
            htmltrl+=' <span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_pic_link');?></span>';
            htmltrl+='<input type="text" name="slide_url[<?php echo $lang['langurlname'];?>]['+newslide_num+']"   value="" class="form-control ">';
            htmltrl+='</div>';
            htmltrl+='<div class="clearfix blank20"></div>';
            htmltrl+='</div>';
            <?php };?>
            htmltrl+='</div>';
            htmltrl+='<div class="clearfix"></div>';
            htmltrl+='<img src="" style="max-width:100%;">';
            htmltrl+='<div class="clearfix blank5"></div>';
            htmltrl+='<div class="input-group">';
            htmltrl+='<span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_pic_url');?> </span>';
            htmltrl+='<input id="slide_path'+newslide_num+'" name="slide_path'+newslide_num+'" value="" type="text" class="form-control">';
            htmltrl+='<span class="input-group-addon">';
            htmltrl+='<input id="file_slide_path'+newslide_num+'" name="file_slide_path'+newslide_num+'" type="file" class="form-control">';
            htmltrl+='</span>';
            htmltrl+='</div>';
            htmltrl+='</div>';
            htmltrl+='</div>';
            htmltrl+='</div>';


            $("#slidebody").append(htmltrl);
            $("#file_slide_path"+newslide_num ).fileinput( {
                uploadUrl: "<?php echo url('tool/uploadimage3',false);?>",
                allowedFileExtensions: [ 'jpg', 'png', 'gif' ],
                maxFileSize: 200000,
                language: 'zh',
                maxFilesNum: 1,
                maxFileCount: 1,
                showPreview: false,
                showCaption: false,
                showUploadedThumbs: false
            } ).on('fileerror', function ( event, data, msg ) {
                alert( msg );
            } ).on('fileuploaded', function ( event, data, previewId, index ) {
                response = data.response;
                if (response['file_slide_path'+newslide_num].code == '0' ) {
                    $('#slide_path'+newslide_num).val(response['file_slide_path'+newslide_num].name);
                    $('#slide_path'+newslide_num).parent().parent().find('img').attr("src",response['file_slide_path'+newslide_num].name);
                } else {
                    alert( response['file_slide_path'+newslide_num].msg );
                }
            } );
            $("[name=slide_num]").val(newslide_num);
        });
    });
    //列表加载
    function slide_list(eText,modulesdata) {
        $("#slide_body").html("");
        //打开标签选中
        $.post('<?php echo url("template/gettag_slide");?>',{'tag':eText},function(res){
            console.log(res['slide']);
            $('[name=slide_config_id]').val(res['id']);
            res=res['slide'];
            var html="";
            for (var key in res) {
                html+='<tr>';
                if (res[key]['state'])
                    html+='<td class="s_out"><input onclick="slide_chang(this)" type="checkbox" name="slidecheckbox" value="'+res[key]['name']+'" checked class="checkbox" /></td>';
                else
                    html+='<td class="s_out"><input onclick="slide_chang(this)" type="checkbox" name="slidecheckbox" value="'+res[key]['name']+'"  class="checkbox" /></td>';

                html+='<td class="catid text-center">'+res[key]['id']+'</td>';
                html+='<td class="catname">'+res[key]['name']+'</td>';
                html+='<td class="catname">'+res[key]['addtime']+'</td>';
                html+='<td class="manage text-center">';
                html+='<a class="btn btn-default" title="<?php echo lang_admin('edit_slide');?>" data-target="#template-slide-edit" role="button" data-toggle="modal" onclick="slide_edit('+res[key]['id']+')"><?php echo lang_admin('edit_slide');?></a>   ';
                html+='<a class="btn btn-default" title="<?php echo lang_admin('edit_slide_pic');?>" data-target="#template-slide-child-edit"  onclick="slide_child_edit('+res[key]['id']+')" role="button" data-toggle="modal"><?php echo lang_admin('edit_slide_pic');?></a>';;
                html+='</td>';
                html+='</tr>';
            }
            $("#slide_body").append(html);
        },'json');

        if (modulesdata!="" && modulesdata!=undefined){
            var modulesnamehtml='<input type="hidden" name="slidenewmodulesname" value="'+modulesdata['newmodulesname']+'" class="form-control newmodulesname">';
            modulesnamehtml+='<input type="hidden" name="slidmodulesname" value="'+modulesdata['modulesname']+'" class="form-control newmodulesname">';
            modulesnamehtml+='<input type="hidden" name="slidtagfrom" value="'+modulesdata['tagfrom']+'" class="form-control">';
            modulesnamehtml+='<input type="hidden" name="slidid" value="'+modulesdata['id']+'" class="form-control id">';
            $("#slide_body").append(modulesnamehtml);
        }
    }
    //主表加载
    function slide_edit(id){
        if (id>0){
            //打开Banner片编辑框  加载数据
            $.post('<?php echo url("slide/getslide");?>',{'id':id},function(res){
                res= JSON.parse(res);
                console.log(res);
                $('#slide_edit_form .id').val(res.id);
                $('#slide_edit_form .name').val(res.name);
                $('#slide_edit_form .slide_width').val(res.slide_width);
                $('#slide_edit_form .slide_height').val(res.slide_height);
                $('#slide_edit_form .slide_time').val(res.slide_time);
                $('#slide_edit_form .slide_style_position').val(res.slide_style_position);
                $('#slide_edit_form .slide_text_color').val(res.slide_text_color);
                $('#slide_edit_form .slide_input_bg').val(res.slide_input_bg);
                $('#slide_edit_form .slide_input_color').val(res.slide_input_color);
                $('#slide_edit_form .slide_btn_hover_colorlist').val(res.slide_btn_hover_colorlist);
                $('#slide_edit_form .slide_btn_color').val(res.slide_btn_color);
                $('#slide_edit_form .slide_btn_width').val(res.slide_btn_width);
                $('#slide_edit_form .slide_btn_height').val(res.slide_btn_height);
                $('#slide_edit_form .slide_btn_shape').val(res.slide_btn_shape);
                $('#slide_edit_form .slide_button_size').val(res.slide_button_size);
                $('#slide_edit_form .slide_button_color').val(res.slide_button_color);
            });
        }
    }
    //子表加载
    function slide_child_edit(sid){
        if (sid>0){
            $("[name=slide_sid]").val(sid);  //先保存sid
            //打开Banner片编辑框  加载数据
            $.post('<?php echo url("slide/getslide_child");?>',{'sid':sid},function(res){
                res= JSON.parse(res);
                console.log(res);
                if (res.length>0) {
                    $("[name=slide_num]").val(res.length);
                    $("#slidebody").html("");//清空
                    for (var i=1;i<=res.length;i++) {
                        htmltrl='<div name="slide" id="slide'+i+'">';
                        htmltrl+='<input type="hidden" name="slide_id'+i+'" value="'+res[(i-1)].id+'">';
                        htmltrl+='<div class="row"><a class="btn btn-primary"><?php echo lang_admin("slide");?>'+i;
                        htmltrl+='</a>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="delete_slide('+i+','+res[(i-1)].id+')"   value="<?php echo lang_admin('del_slide');?>" class="btn btn-default"/></div>';

                        htmltrl+='<div class="clearfix blank20"></div>';

                        htmltrl+='<div class="row">';
                        htmltrl+='<ul class="nav nav-tabs content-nav-tabs" role="tablist">';
                        <?php foreach (lang::getlang() as $lang){  ?>
                        htmltrl+='<li role="presentation" class="<?php if($lang['langurlname']==lang::getisadmin()){  ?>active<?php };?>">';
                        htmltrl+='<a href="#slide-<?php echo $lang['langurlname'];?>-'+i+'" aria-controls="slide-<?php echo $lang['langurlname'];?>-'+i+'" role="tab" data-toggle="tab">';
                        htmltrl+='<?php echo $lang["langname"];?>';
                        htmltrl+='</a>';
                        htmltrl+='</li>';
                        <?php };?>
                        htmltrl+='</ul>';

                        <!-- Tab panes -->
                        htmltrl+='<div class="tab-content">';
                        <?php foreach (lang::getlang() as $lang){  ?>
                        htmltrl+='<div role="tabpanel" class="tab-pane <?php if($lang['langurlname']==lang::getisadmin()){  ?>active<?php };?>" id="slide-<?php echo $lang['langurlname'];?>-'+i+'">';
                        htmltrl+='<div class="input-group">';
                        htmltrl+='<span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_pic_title');?></span>';
                        htmltrl+='<input type="text" name="slide_title[<?php echo $lang['langurlname'];?>]['+i+']"   value="'+(res[(i-1)]['slide_title'].hasOwnProperty('<?php echo $lang['langurlname'];?>')?isnull(res[(i-1)]['slide_title']['<?php echo $lang['langurlname'];?>']):res[(i-1)]['slide_title'])+'" class="form-control ">';
                        htmltrl+='</div>';
                        htmltrl+='<div class="clearfix blank20"></div>';
                        htmltrl+='<div class="input-group">';
                        htmltrl+='<span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_pic_subtitle');?></span>';
                        htmltrl+='<input type="text" name="slide_subtitle[<?php echo $lang['langurlname'];?>]['+i+']"   value="'+(res[(i-1)]['slide_subtitle'].hasOwnProperty('<?php echo $lang['langurlname'];?>')?isnull(res[(i-1)]['slide_subtitle']['<?php echo $lang['langurlname'];?>']):res[(i-1)]['slide_subtitle'])+'" class="form-control ">';
                        htmltrl+='</div>';
                        htmltrl+='<div class="clearfix blank20"></div>';
                        htmltrl+='<div class="input-group">';
                        htmltrl+='<span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_input_text');?></span>';
                        htmltrl+='<input type="text" name="slide_butname[<?php echo $lang['langurlname'];?>]['+i+']"   value="'+(res[(i-1)]['slide_butname'].hasOwnProperty('<?php echo $lang['langurlname'];?>')?isnull(res[(i-1)]['slide_butname']['<?php echo $lang['langurlname'];?>']):res[(i-1)]['slide_butname'])+'" class="form-control ">';
                        htmltrl+='</div>';
                        htmltrl+='<div class="clearfix blank20"></div>';
                        htmltrl+='<div class="input-group">';
                        htmltrl+=' <span class="input-group-addon" id="basic-addon1"><?php echo lang_admin('slide_pic_link');?></span>';
                        htmltrl+='<input type="text" name="slide_url[<?php echo $lang['langurlname'];?>]['+i+']"   value="'+(res[(i-1)]['slide_url'].hasOwnProperty('<?php echo $lang['langurlname'];?>')?isnull(res[(i-1)]['slide_url']['<?php echo $lang['langurlname'];?>']):res[(i-1)]['slide_url'])+'" class="form-control ">';
                        htmltrl+='</div>';
                        htmltrl+='<div class="clearfix blank20"></div>';
                        htmltrl+='</div>';
                        <?php };?>
                        htmltrl+='</div>';
                        htmltrl+='<div class="clearfix"></div>';
                        htmltrl+='<img src="'+res[(i-1)].slide_path+'" style="max-width:100%;">';
                        htmltrl+='<div class="clearfix blank5"></div>';
                        htmltrl+='<div class="input-group">';

                        htmltrl+='<input id="slide_path'+i+'" name="slide_path'+i+'" value="'+res[(i-1)].slide_path+'" type="text" class="form-control">';
                        htmltrl+='<span class="input-group-addon input-group-addon-slide">';
                        htmltrl+='<input id="file_slide_path'+i+'" name="file_slide_path'+i+'" type="file" class="form-control">';
                        htmltrl+="<script>$(function(){ ";
                        htmltrl+='$("#file_slide_path'+i+'").fileinput( {';
                        htmltrl+='uploadUrl: "<?php echo url('tool/uploadimage3',false);?>",';
                        htmltrl+='allowedFileExtensions: [ "jpg", "png", "gif" ],';
                        htmltrl+='maxFileSize: 200000,';
                        htmltrl+='language: "zh",';
                        htmltrl+='maxFilesNum: 1,';
                        htmltrl+='maxFileCount: 1,';
                        htmltrl+='showPreview: false,';
                        htmltrl+='showCaption: false,';
                        htmltrl+='showUploadedThumbs: false';
                        htmltrl+='} ).on( "fileerror", function ( event, data, msg ) {';
                        htmltrl+='alert( msg );';
                        htmltrl+='} ).on("fileuploaded", function ( event, data, previewId, index ) {';
                        htmltrl+='response = data.response;';
                        htmltrl+='console.log(response);';
                        htmltrl+='if (response.file_slide_path'+i+'.code =="0" ) {';
                        htmltrl+='$("[name=slide_path'+i+']").val(response.file_slide_path'+i+'.name);';
                        htmltrl+='$("[name=slide_path'+i+']").parent().parent().find("img").attr("src",response.file_slide_path'+i+'.name);';
                        htmltrl+='}else {';
                        htmltrl+='alert( response["file_slide_path'+i+'"].msg );';
                        htmltrl+='}';
                        htmltrl+='} );';
                        htmltrl+=" });<\/script>";
                        htmltrl+='</span>';
                        htmltrl+='</div>';
                        htmltrl+='</div>';
                        htmltrl+='<div class="clearfix blank20"></div>';
                        htmltrl+='<div class="row"><div class="clearfix line"></div></div>';
                        htmltrl+='<div class="clearfix blank20"></div>';
                        $("#slidebody").append(htmltrl);

                    }
                }
            });
        }
    }
    //删除Banner
    function  delete_slide(num_id,slide_id) {
        if($("[name=slide]").length==1){
            alert("<?php echo lang_admin('only_one_slide_cannot_be_deleted');?>");
        }else{
            if(slide_id>0){
                $.get("<?php echo url('slide/deletechild',true);?>",{'id':slide_id},function () {
                    alert("<?php echo lang_admin('successful_deletion');?>！");
                });
                $("#slide"+num_id).remove();
            }else{
                $("#slide"+num_id).remove();
                alert("<?php echo lang_admin('successful_deletion');?>！");
            }


        }

    }
    //判断不能为null
    function isnull(conent){
        if (conent==null ||conent=="null"){
            return "";
        }else{
            return conent;
        }
    }

</script>

<!--取色-->
<script type="text/javascript">
    $(function () {
        $('#slide_text_color').colorpicker();
        $('#slide_input_bg').colorpicker();
        $('#slide_input_color').colorpicker();
        $('#slide_btn_hover_color').colorpicker();
        $('#slide_btn_color').colorpicker();
        $('#slide_button_color').colorpicker();
    });
</script>

