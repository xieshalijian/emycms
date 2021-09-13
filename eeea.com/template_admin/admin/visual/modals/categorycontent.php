<div class="modal fade bs-example-modal-lg" id="template-edit-category-content" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">

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
                        <a href="#tag-edit-category-config" aria-controls="tag-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('text');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                

                <!-- 设置 -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tag-edit-category-config">
                        <form method="post" name="editfrmcategorycontent" id="editfrmcategorycontent" action="">
                            <input type="hidden" name="table" value="" class="form-control table">
                            <input type="hidden" name="field" value="" class="form-control field">
                            <input type="hidden" name="id" value="" class="form-control id">
                            <input type="hidden" name="type" value="" class="form-control type">
                            <input type="hidden" name="module_name" value="" class="form-control module_name">


                                    <?php $root = config::getadmin('base_url') . '/ueditor';?>
                                    <script id="editcategorycontent" name="editcategorycontent" type="text/plain"></script>
                                    <script type="text/javascript">
                                        window.UEDITOR_HOME_URL = "{$root}/";
                                        var ue_editcategorycontent;
                                        $(function(){
                                            UE.delEditor('editcategorycontent');
                                            ue_editcategorycontent = UE.getEditor('editcategorycontent',{
                                                autoHeightEnabled : false
                                            });
                                        });
                                    </script>

                                <div class="clearfix blank20"> </div>
                                <div class="clearfix"></div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="savecategorycontent" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- 标签信息弹出框 -->
<script type="text/javascript">
    var currenteditor1;
    $(document).ready(function () {
        $("[name=savecategorycontent]").click(function(e) {
            e.preventDefault();
            var content=ue_editcategorycontent.getContent();
            data = $('#editfrmcategorycontent').serialize();
            $.ajaxSetup (  { async: false });
            $.post('<?php echo url("template/editcategorytemplate");?>',data,function(res){
                editcatrgroy['Node'].html(content);
            });

        });
    });
</script>

<style type="text/css">
    #editcategorycontent {min-height:500px;}
</style>