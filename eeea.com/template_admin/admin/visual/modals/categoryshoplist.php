<div class="modal fade" id="template-category-shop-list" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="icon-close"></i>
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang_admin('attribute');?>
                </h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tag-list-config" aria-controls="tag-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('category_info');?>
                        </a>
                    </li>
                </ul>

                <!-- 设置 -->
                <div class="tab-content">
                    <div class="blank20"></div>
                    <div role="tabpanel" class="tab-pane active" id="tag-list-config">
                        <form method="post" name="frmcategoryshoplist" id="frmcategoryshoplist" action="">
                            <input type="hidden" name="id" value="" class="form-control id">
                            <input type="hidden" name="name" value="" class="form-control name">
                            <input type="hidden" name="newmodulesname" value="" class="form-control newmodulesname">
                            <input type="hidden" name="catid" value="" class="form-control catid">
                            <div class="row">
                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('name');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <input type="text" name="catname" value="" class="catname form-control">

                                </div>

                                <div class="clearfix blank20"> </div>

                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('subtitle');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <input type="text" class="subtitle form-control" name="subtitle" id="subtitle" />
                                </div>

                                <div class="clearfix blank20"></div>

                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('news_coverage');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <?php $root = config::getadmin('base_url') . '/ueditor';?>
                                    <script id="shopcategorycontent" name="shopcategorycontent" type="text/plain"></script>
                                    <script type="text/javascript">
                                        window.UEDITOR_HOME_URL = "{$root}/";
                                        var ue_shopcategorycontent;
                                        $(function(){
                                            UE.delEditor('shopcategorycontent');
                                            ue_shopcategorycontent = UE.getEditor('shopcategorycontent',{
                                                autoHeightEnabled : false
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="clearfix blank20"> </div>
                                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                                    <?php echo lang_admin('column_pictures');?>
                                </div>
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    {form::upload_thumb('shopimage','')}
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
                <button name="savecategoryshoplist" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
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
        $('body.edit .visual-right').on("click","[data-target='#template-category-shop-list']",function(e) {
            e.preventDefault();
            currenteditor1 = $(this).parent().parent().parent().siblings('.view');
            var eText = currenteditor1.find('.tagname').html();

            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) ) {
                isoldcategorylist=false;
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getmodulestaglist");?>', {'tag': eText}, function (res) {
                    $('#frmcategoryshoplist .id').val(res.id);
                    $('#frmcategoryshoplist .catid').val(res.catid);
                    $('#frmcategoryshoplist .newmodulesname').val(res.newmodulesname);
                    $('#frmcategoryshoplist .catname').val(res.cateorydata.catname);
                    $('#frmcategoryshoplist .subtitle').val(res.cateorydata.subtitle);
                    if (res.cateorydata.image!="" && res.cateorydata.image!=undefined) {
                        $('#shopimage_preview').find('img').attr('src',res.cateorydata.image);
                        $('#shopimage').val(res.cateorydata.image);
                    }else{
                        $('#shopimage_preview').find('img').attr('src','./common/js/ajaxfileupload/pic.png');
                        $('#shopimage').val('');
                    }
                    ue_shopcategorycontent.ready(function() {//编辑器初始化完成再赋值
                        ue_shopcategorycontent.setContent('');  //赋值给UEditor
                        ue_shopcategorycontent.setContent(res.cateorydata.categorycontent);  //赋值给UEditor
                    });

                }, 'json');
            }
            else{
                isoldcategorylist=true;
                $.ajaxSetup (  { async: true });
                $.post('<?php echo url("template/getshoptaglist");?>', {'tag': eText}, function (res) {
                    $('#shopcategorycontent .id').val(res.id);
                    $('#shopcategorycontent .name').val(res.name);
                    $('#shopcategorycontent .catid').val(res.setting.catid);
                    $('#shopcategorycontent .catname').val(res.cateorydata.catname);
                    $('#shopcategorycontent .subtitle').val(res.cateorydata.subtitle);
                    $('#shopcategorycontent .newmodulesname').val(res.newmodulesname);
                    if (res.cateorydata.image!="" && res.cateorydata.image!=undefined) {
                        $('#shopimage_preview').find('img').attr('src',res.cateorydata.image);
                        $('#shopimage').val(res.cateorydata.image);
                    }else{
                        $('#shopimage_preview').find('img').attr('src','./common/js/ajaxfileupload/pic.png');
                        $('#shopimage').val('');
                    }
                    ue_shopcategorycontent.ready(function() {//编辑器初始化完成再赋值
                        ue_shopcategorycontent.setContent('');  //赋值给UEditor
                        ue_shopcategorycontent.setContent(res.cateorydata.categorycontent);  //赋值给UEditor
                    });

                }, 'json');
            }
        });

        $("[name=savecategoryshoplist]").click(function(e) {
            e.preventDefault();
            if (isoldcategorylist){
                if($('#shopcategorycontent .catname').val() == ''){
                    alert("<?php echo lang_admin('the_name_cannot_be_empty');?>");
                    $('#shopcategorycontent .catname').focus();
                    return false;
                }

                data = $('#shopcategorycontent').serialize();
                $.post('<?php echo url("template/saveshoptaglist");?>',data,function(res){
                    $('#shopcategorycontent')[0].reset();
                    $('#shopcategorycontent .id').val('');
                    if (res!="" && res!=undefined)
                    currenteditor1.html(res);
                });
            }
            else{
                if($('#shopcategorycontent .catname').val() == ''){
                    alert("<?php echo lang_admin('the_name_cannot_be_empty');?>");
                    $('#shopcategorycontent .catname').focus();
                    return false;
                }
                data = $('#shopcategorycontent').serialize();
                $.ajaxSetup (  { async: false });
                $.post('<?php echo url("template/savemoduletaglist");?>',data,function(res){
                    $('#shopcategorycontent')[0].reset();
                    $('#shopcategorycontent .id').val('');
                    if (res!="" && res!=undefined)
                    currenteditor1.html(res);
                });
            }
            cmseasyedit();
            cmseasyeditimg();
        });
    });



</script>
<style type="text/css">
    #editcategorycontent {min-height:500px;}
</style>