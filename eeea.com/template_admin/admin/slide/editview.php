<!-- 取色 -->
<link href="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet">
<script type="text/javascript" src="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>


<script type="text/javascript">
    $(function () {
        $('#slide_button_color').colorpicker();
    });
</script>


<div class="main-right-box">


    <form method="post" name="form1" action="<?php $data['id']=isset($data['id'])?$data['id']:"";echo url('slide/editview/id/'.$data['id'],true);?>" onsubmit="return returnform(this);">



        <div class="box" id="box">
            <h5>{lang_admin('edit_slide_pic')}
                <!--工具栏-->

                <div class="content-eidt-nav pull-right">
                    <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                        <i class="icon-frame"></i>
                        {lang_admin('container_fluid')}
                    </a>

                    <span class="pull-right">

                    <input  name="submit" value="1" type="hidden">
                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>



                    <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=slide&act=list&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="<?php echo lang_admin('slide');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>

 <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
					</a>
                </span>
                </div>
            </h5>
            <div class="blank30"></div>
            <input type="hidden" name="slide_sid" value="{$slide_sid}">
            <div id="slidebody">
                <?php if (is_array($data) && count($data)>0){
                    unset($data['id']);
                ?>
                    <input type="hidden" name="slide_num" value="<?php echo count($data);?>">
                    <?php
                    foreach ($data as $key=>$val){
                        $key=$key+1;
                        ?>
                        <div name="slide" id="slide{$key}">
                            <input type="hidden" name="slide_id{$key}" value="{$val['id']}">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                                    <a class="btn btn-primary">
                                        {lang_admin('slide')}{$key}
                                    </a>
                                </div>
                                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                    <a onclick="delete_slide({$key},{$val['id']})" class="btn btn-default">
                                        {lang_admin('delete')}
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix blank20"></div>
                            <!-- Nav tabs --><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <div class="row">
                                    <ul class="nav nav-tabs content-nav-tabs" role="tablist">
                                        <?php foreach (lang::getlang() as $lang){  ?>
                                            <li role="presentation" <?php if($lang['langurlname']==lang::getisadmin()){  ?>class="active" <?php };?>>
                                                <a href="#slide-<?php echo $lang['langurlname'];?>-{$key}"
                                                   aria-controls="slide-<?php echo $lang['langurlname'];?>-{$key}" role="tab" data-toggle="tab">
                                                    <?php echo $lang['langname'];?>
                                                </a>
                                            </li>
                                        <?php };?>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <?php foreach (lang::getlang() as $lang){  ?>
                                        <div role="tabpanel" class="tab-pane <?php if($lang['langurlname']==lang::getisadmin()){  ?>active<?php };?>"
                                             id="slide-<?php echo $lang['langurlname'];?>-{$key}">

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_title')}</span>
                                                <?php $slide_title=unserialize($val['slide_title']);  $new_slide_title=is_array($slide_title)?$slide_title[$lang['langurlname']]:$val['slide_title'];?>
                                                <input type="text" name="slide_title[<?php echo $lang['langurlname'];?>][{$key}]"   value="{$new_slide_title}" class="form-control ">
                                            </div>

                                            <div class="clearfix blank20"></div>

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_subtitle')}</span>
                                                <?php $slide_subtitle=unserialize($val['slide_subtitle']);  $new_slide_subtitle=is_array($slide_subtitle)?$slide_subtitle[$lang['langurlname']]:$val['slide_subtitle'];?>
                                                <input type="text" name="slide_subtitle[<?php echo $lang['langurlname'];?>][{$key}]"   value="{$new_slide_subtitle}" class="form-control ">
                                            </div>

                                            <div class="clearfix blank20"></div>

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_input_text')}</span>
                                                <?php $slide_butname=unserialize($val['slide_butname']);  $new_slide_butname=is_array($slide_butname)?$slide_butname[$lang['langurlname']]:$val['slide_butname'];?>
                                                <input type="text" name="slide_butname[<?php echo $lang['langurlname'];?>][{$key}]"   value="{$new_slide_butname}" class="form-control ">
                                            </div>

                                            <div class="clearfix blank20"></div>

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_link')}</span>
                                                <?php $slide_url=unserialize($val['slide_url']);  $new_slide_url=is_array($slide_url)?$slide_url[$lang['langurlname']]:$val['slide_url'];?>
                                                <input type="text" name="slide_url[<?php echo $lang['langurlname'];?>][{$key}]"   value="{$new_slide_url}" class="form-control ">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php };?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix "></div>
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-7 text-left">

                                    <img src="{$val['slide_path']}" style="max-width:90px;">
                                    <div class="blank10"></div>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_url')}</span>
                                        <input id="slide_path{$key}" name="slide_path{$key}" value="{$val['slide_path']}" type="text" class="form-control">
                                        <span class="input-group-addon">
                            <input id="file_slide_path{$key}" name="file_slide_path{$key}" type="file" class="form-control">
                    <script>
                        $( function () {
                            $( "#file_slide_path{$key}" ).fileinput( {
                                uploadUrl: "{url('tool/uploadimage3',false)}",
                                allowedFileExtensions: [ 'jpg', 'png', 'gif' ],
                                maxFileSize: 200000,
                                language: 'zh',
                                maxFilesNum: 1,
                                maxFileCount: 1,
                                showPreview: false,
                                showCaption: false,
                                showUploadedThumbs: false
                            } ).on( 'fileerror', function ( event, data, msg ) {
                                alert( msg );
                            } ).on( 'fileuploaded', function ( event, data, previewId, index ) {
                                response = data.response;
                                if ( response.file_slide_path{$key}.code == '0' ) {
                                    $('#slide_path{$key}').val(response.file_slide_path{$key}.name);
                                    $('#slide_path{$key}').parent().parent().find('img').attr("src",response.file_slide_path{$key}.name);
                                } else {
                                    alert( response.file_slide_path{$key}.msg );
                                }
                            } );
                        } );
                    </script>
                        </span>
                                    </div>

                                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="点击图片，上传！"></span>
                                </div>
                            </div>
                            <div class="clearfix blank20"></div>
                        </div>
                        <?php
                    }
                }
                else{
                    ?>
                    <input type="hidden" name="slide_num" value="1">
                    <div name="slide" id="slide1"> 
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                                <a class="btn btn-primary">
                                    {lang_admin('slide')}1
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                <a onclick="delete_slide(1,{$val['id']})" class="btn btn-default">
                                    {lang_admin('delete')}
                                </a>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <!-- Nav tabs --><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                        </div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <div class="row">
                                <ul class="nav nav-tabs content-nav-tabs" role="tablist">
                                    <?php foreach (lang::getlang() as $lang){  ?>
                                        <li role="presentation" <?php if($lang['langurlname']==lang::getisadmin()){  ?>class="active" <?php };?>>
                                            <a href="#slide-<?php echo $lang['langurlname'];?>-1"
                                               aria-controls="slide-<?php echo $lang['langurlname'];?>-1" role="tab" data-toggle="tab">
                                                <?php echo $lang['langname'];?>
                                            </a>
                                        </li>
                                    <?php };?>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?php foreach (lang::getlang() as $lang){  ?>
                                        <div role="tabpanel" class="tab-pane <?php if($lang['langurlname']==lang::getisadmin()){  ?>active<?php };?>"
                                             id="slide-<?php echo $lang['langurlname'];?>-1">

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_title')}</span>
                                                <input type="text" name="slide_title[<?php echo $lang['langurlname'];?>][1]"   value="{$val['slide_title']}" class="form-control ">
                                            </div>

                                            <div class="clearfix blank20"></div>

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_subtitle')}</span>
                                                <input type="text" name="slide_subtitle[<?php echo $lang['langurlname'];?>][1]"   value="{$val['slide_subtitle']}" class="form-control ">
                                            </div>

                                            <div class="clearfix blank20"></div>

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_input_text')}</span>
                                                <input type="text" name="slide_butname[<?php echo $lang['langurlname'];?>][1]"   value="{$val['slide_butname']}" class="form-control ">
                                            </div>

                                            <div class="clearfix blank20"></div>

                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_link')}</span>
                                                <input type="text" name="slide_url[<?php echo $lang['langurlname'];?>][1]"   value="{$val['slide_url']}" class="form-control ">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    <?php };?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix "></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-7 text-left">

                                <img src="{$val['slide_path']}" style="max-width:90px;">
                                <div class="blank10"></div>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_url')}</span>
                                    <input id="slide_path1" name="slide_path1" value="{$val['slide_path']}" type="text" class="form-control">
                                    <span class="input-group-addon">
                            <input id="file_slide_path1" name="file_slide_path1" type="file" class="form-control">
                    <script>
                        $( function () {
                            $( "#file_slide_path1" ).fileinput( {
                                uploadUrl: "{url('tool/uploadimage3',false)}",
                                allowedFileExtensions: [ 'jpg', 'png', 'gif' ],
                                maxFileSize: 200000,
                                language: 'zh',
                                maxFilesNum: 1,
                                maxFileCount: 1,
                                showPreview: false,
                                showCaption: false,
                                showUploadedThumbs: false
                            } ).on( 'fileerror', function ( event, data, msg ) {
                                alert( msg );
                            } ).on( 'fileuploaded', function ( event, data, previewId, index ) {
                                response = data.response;
                                if ( response.file_slide_path1.code == '0' ) {
                                    $('#slide_path1').val(response.file_slide_path1.name);
                                    $('#slide_path1').parent().parent().find('img').attr("src",response.file_slide_path1.name);
                                } else {
                                    alert( response.file_slide_path1.msg );
                                }
                            } );
                        } );
                    </script>
                        </span>
                                </div>

                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="点击图片，上传！"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                    </div>
                <?php  } ?>
            </div>

            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-3 col-lg-2 text-right">
                    <input  name="submit" value="1" type="hidden">
                    <input type="button" onclick="add_slide()" value="{lang_admin('添加幻灯')}" class="btn btn-primary"/>
                </div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">


                </div>
            </div>

            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>

            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-3 col-lg-2 text-left"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">

                    <input type="submit"   value="{lang_admin('submitted')}" class="btn btn-primary btn-lg"/>
                </div>
            </div>

        </div>
    </form>


    <div class="blank30"></div>

</div>
<script>
    function add_slide() {
        var slide_num=$("[name=slide_num]").val();
        var newslide_num=parseInt(slide_num)+1;
        var html=' <div  name="slide" id="slide'+newslide_num+'"><div class="row">';
        html+='<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><a class="btn btn-primary">{lang_admin('slide')}'+newslide_num;
        html+='</a></div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="button" onclick="delete_slide('+newslide_num+',0)" value="{lang_admin("delete")}" class="btn btn-default"/>';
        html+='</div></div><div class="clearfix blank20"></div>';
        html+='<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>';
        html+='<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        html+='<div class="row">';
        html+='<ul class="nav nav-tabs content-nav-tabs" role="tablist">';
        <?php foreach (lang::getlang() as $lang){  ?>
        html+='<li role="presentation" <?php if($lang['langurlname']==lang::getisadmin()){  ?>class="active" <?php };?>>';
        html+='<a href="#slide-<?php echo $lang['langurlname'];?>-'+newslide_num+'"';
        html+='aria-controls="slide-<?php echo $lang['langurlname'];?>-'+newslide_num+'" role="tab" data-toggle="tab">';
        html+='<?php echo $lang['langname'];?>';
        html+='</a>';
        html+='</li>';
            <?php };?>
        html+='</ul>';

        html+='<div class="tab-content">';
        <?php foreach (lang::getlang() as $lang){  ?>
        html+='<div role="tabpanel" class="tab-pane <?php if($lang['langurlname']==lang::getisadmin()){  ?>active<?php };?>"';
        html+='id="slide-<?php echo $lang['langurlname'];?>-'+newslide_num+'">';
        html+='<div class="input-group">';
        html+='<span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_title')}</span>';
        html+='<input type="text" name="slide_title[<?php echo $lang['langurlname'];?>]['+newslide_num+']" value="" class="form-control ">';
        html+='</div>';
        html+='<div class="clearfix blank20"></div>';

        html+='<div class="input-group">';
        html+='<span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_subtitle')}</span>';
        html+='<input type="text" name="slide_subtitle[<?php echo $lang['langurlname'];?>]['+newslide_num+']"  value="" class="form-control ">';
        html+='</div>';
        html+='<div class="clearfix blank20"></div>';

        html+='<div class="input-group">';
        html+='<span class="input-group-addon" id="basic-addon1">{lang_admin('slide_input_text')}</span>';
        html+='<input type="text" name="slide_butname[<?php echo $lang['langurlname'];?>]['+newslide_num+']"   value="" class="form-control ">';
        html+='</div>';
        html+='<div class="clearfix blank20"></div>';

        html+='<div class="input-group">';
        html+='<span class="input-group-addon" id="basic-addon1">{lang_admin('slide_pic_link')}</span>';
        html+='<input type="text" name="slide_url[<?php echo $lang['langurlname'];?>]['+newslide_num+']"   value="" class="form-control ">';
        html+='</div>';
        html+='<div class="clearfix"></div>';

        html+='</div>';
        <?php };?>
        html+='</div>';
        html+='</div>';
        html+='</div>';

        html+='<div class="clearfix"></div>';

        html+='<div class="row">';
        html+='<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>';
        html+='<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        html+='<img src="" style="max-width:90px;">';
        html+='<div class="blank10"></div>';
        html+='<div class="input-group">';
        html+='<span class="input-group-addon" id="basic-addon1">{lang_admin("slide_pic_url")}</span>';
        html+='<input id="slide_path'+newslide_num+'" name="slide_path'+newslide_num+'" value="" type="text" class="form-control">';
        html+='<span class="input-group-addon">';
        html+='<input id="file_slide_path'+newslide_num+'" name="file_slide_path'+newslide_num+'" type="file" class="form-control">';
        html+='</span>';
        html+='</div>';
        html+='<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="点击图片，上传！"></span>';
        html+='</div>';
        html+='</div>';


        html+='<div class="clearfix blank20"></div>';
        html+='</div>';

        $("#slidebody").append(html);
        $("#file_slide_path"+newslide_num ).fileinput( {
            uploadUrl: "{url('tool/uploadimage3',false)}",
            allowedFileExtensions: [ 'jpg', 'png', 'gif' ],
            maxFileSize: 200000,
            language: 'zh',
            maxFilesNum: 1,
            maxFileCount: 1,
            showPreview: false,
            showCaption: false,
            showUploadedThumbs: false
        } ).on( 'fileerror', function ( event, data, msg ) {
            alert( msg );
        } ).on( 'fileuploaded', function ( event, data, previewId, index ) {
            response = data.response;
            if (response['file_slide_path'+newslide_num].code == '0' ) {
                $('#slide_path'+newslide_num).val(response['file_slide_path'+newslide_num].name);
                $('#slide_path'+newslide_num).parent().parent().find('img').attr("src",response['file_slide_path'+newslide_num].name);
            } else {
                alert( response['file_slide_path'+newslide_num].msg );
            }
        } );
        $("[name=slide_num]").val(newslide_num);
    }

    function  delete_slide(num_id,slide_id) {
        if($("[name=slide]").length==1){
            alert("{lang_admin('only_one_slide_cannot_be_deleted')}");
        }else{
            if(slide_id>0){
                $.get("{url('slide/deletechild',true)}",{'id':slide_id},function () {
                    alert("{lang_admin('successful_deletion')}！");
                });
                $("#slide"+num_id).remove();
            }else{
                $("#slide"+num_id).remove();
                alert("{lang_admin('successful_deletion')}！");
            }


        }

    }
</script>

<style>
    #slidebody .file-input .btn-file {padding:0px !important;}
    #slidebody .tab-content .input-group .form-control {height:36px;}
    .tab-content {padding:15px 5px;}
    .content-nav-tabs>li>a, .content-nav-tabs>li.active>a, .content-nav-tabs>li.active>a:focus, .content-nav-tabs>li.active>a:hover {
        padding:5px 10px;
        font-size:14px;
    }
</style>

