<div class="modal fade" id="template-edit-category-textarea" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">
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
                        <a href="#tag-textarea-config" aria-controls="tag-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('brief_introduction');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <!-- 设置 -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tag-textarea-config">
                        <form method="post" name="editfrmcategorytextarea" id="editfrmcategorytextarea" action="">
                            <input type="hidden" name="table" value="" class="form-control table">
                            <input type="hidden" name="field" value="" class="form-control field">
                            <input type="hidden" name="id" value="" class="form-control id">
                            <input type="hidden" name="type" value="" class="form-control type">
                            <input type="hidden" name="module_name" value="" class="form-control module_name">


                                    <textarea name="textareacontent" class="form-control textarea  textareacontent" style="min-height:188px;"></textarea>

                                <div class="clearfix blank20"> </div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="savecategorytextarea" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- 标签信息弹出框 -->
<script type="text/javascript">
    var currenteditor1;
    $(document).ready(function () {
        $("[name=savecategorytextarea]").click(function(e) {
            e.preventDefault();
            var content=$('#editfrmcategorytextarea .textareacontent').val();
            data = $('#editfrmcategorytextarea').serialize();
            $.ajaxSetup ({ async: false });
            $.post('<?php echo url("template/editcategorytemplate");?>',data,function(res){
                editcatrgroy['Node'].html(content);
            });

        });
    });
</script>