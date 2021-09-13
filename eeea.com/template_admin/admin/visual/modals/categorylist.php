<div class="modal fade bs-example-modal-lg" id="template-category-list" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="icon-close"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tag-list-config" aria-controls="tag-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('category_info');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">


                <!-- 设置 -->
                <div class="tab-content">
                    <div class="blank20"></div>
                    <div role="tabpanel" class="tab-pane active" id="tag-list-config">
                        <form method="post" name="frmcategorylist" id="frmcategorylist" action="">
                            <input type="hidden" name="id" value="" class="form-control id">
                            <input type="hidden" name="name" value="" class="form-control name">
                            <input type="hidden" name="newmodulesname" value="" class="form-control newmodulesname">
                            <input type="hidden" name="catid" value="" class="form-control catid">

                            <div class="form-group">
                                <label><?php echo lang_admin('category_name');?></label>
                                <input type="text" name="catname" value="" class="catname form-control">
                                </div>

                            <div class="form-group">
                                <label>
                                    <?php echo lang_admin('subtitle');?></label>

                                    <input type="text" class="subtitle form-control" name="subtitle" id="subtitle" />
                            </div>
                            <div class="form-group">
                                <label>
                                    <?php echo lang_admin('news_coverage');?>
                                </label>

                                    <?php $root = config::getadmin('base_url') . '/ueditor';?>
                            </div>
                                    <script id="categorycontent" name="categorycontent" type="text/plain"></script>
                                    <script type="text/javascript">
                                        window.UEDITOR_HOME_URL = "{$root}/";
                                        var ue_categorycontent;
                                        $(function(){
                                            UE.delEditor('categorycontent');
                                            ue_categorycontent = UE.getEditor('categorycontent',{
                                                autoHeightEnabled : false
                                            });
                                        });
                                    </script>
                            <div class="form-group">
                                <label>
                                    <?php echo lang_admin('column_pictures');?>
                                </label>
                                    {form::upload_thumb('image','')}
                                </div>
                                <div class="clearfix blank20"> </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="savecategorylist" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- 标签信息弹出框 -->
<script type="text/javascript">
    var currenteditor1;
    $(document).ready(function () {
        var isoldcategorylist=false;
        $('body.edit .visual-right').on("click","[data-target='#template-category-list']",function(e) {
            e.preventDefault();
            currenteditor1 = $(this).parent().parent().parent().siblings('.view');
            var eText = currenteditor1.find('.tagname').html();

            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) ) {
                isoldcategorylist=false;
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getmodulestaglist");?>', {'tag': eText}, function (res) {
                    $('#frmcategorylist .id').val(res.id);
                    $('#frmcategorylist .catid').val(res.catid);
                    $('#frmcategorylist .newmodulesname').val(res.newmodulesname);
                    $('#frmcategorylist .catname').val(res.cateorydata.catname);
                    $('#frmcategorylist .subtitle').val(res.cateorydata.subtitle);
                    if (res.cateorydata.image!="" && res.cateorydata.image!=undefined) {
                        $('#image_preview').find('img').attr('src',res.cateorydata.image);
                        $('#image').val(res.cateorydata.image);
                    }else{
                        $('#image_preview').find('img').attr('src','./common/js/ajaxfileupload/pic.png');
                        $('#image').val('');
                    }
                    ue_categorycontent.ready(function() {//编辑器初始化完成再赋值
                        ue_categorycontent.setContent('');  //赋值给UEditor
                        ue_categorycontent.setContent(res.cateorydata.categorycontent);  //赋值给UEditor
                    });

                }, 'json');
            }
            else{
                isoldcategorylist=true;
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/gettaglist");?>', {'tag': eText}, function (res) {
                    $('#frmcategorylist .id').val(res.id);
                    $('#frmcategorylist .name').val(res.name);
                    $('#frmcategorylist .catid').val(res.setting.catid);
                    $('#frmcategorylist .catname').val(res.cateorydata.catname);
                    $('#frmcategorylist .subtitle').val(res.cateorydata.subtitle);
                    $('#frmcategorylist .newmodulesname').val(res.newmodulesname);
                    if (res.cateorydata.image!="" && res.cateorydata.image!=undefined) {
                        $('#image_preview').find('img').attr('src',res.cateorydata.image);
                        $('#image').val(res.cateorydata.image);
                    }else{
                        $('#image_preview').find('img').attr('src','./common/js/ajaxfileupload/pic.png');
                        $('#image').val('');
                    }
                    ue_categorycontent.ready(function() {//编辑器初始化完成再赋值
                        ue_categorycontent.setContent('');  //赋值给UEditor
                        ue_categorycontent.setContent(res.cateorydata.categorycontent);  //赋值给UEditor
                    });

                }, 'json');
            }
        });

        $("[name=savecategorylist]").click(function(e) {
            e.preventDefault();
            if (isoldcategorylist){
                if($('#frmcategorylist .catname').val() == ''){
                    alert("<?php echo lang_admin('the_name_cannot_be_empty');?>");
                    $('#frmcategorylist .catname').focus();
                    return false;
                }

                data = $('#frmcategorylist').serialize();
                $.post('<?php echo url("template/savetaglist");?>',data,function(res){
                    $('#frmcategorylist')[0].reset();
                    $('#frmcategorylist .id').val('');
                    if (res!="" && res!=undefined)
                    currenteditor1.html(res);
                });
            }
            else{
                if($('#frmcategorylist .catname').val() == ''){
                    alert("<?php echo lang_admin('the_name_cannot_be_empty');?>");
                    $('#frmcategorylist .catname').focus();
                    return false;
                }
                data = $('#frmcategorylist').serialize();
                $.ajaxSetup (  { async: false });
                $.post('<?php echo url("template/savemoduletaglist/shop/1");?>',data,function(res){
                    $('#frmcategorylist')[0].reset();
                    $('#frmcategorylist .id').val('');
                    if (res!="" && res!=undefined)
                    currenteditor1.html(res);
                });
            }
            cmseasyeditimg();
            cmseasyedit();
        });
    });



</script>
<style type="text/css">
    .edui-editor-iframeholder {min-height:500px;}
</style>