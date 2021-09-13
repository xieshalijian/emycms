<div id="template-edit-category-img" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">
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
                        <a href="#upload-img" aria-controls="#upload-img" role="tab" data-toggle="tab">
                            <?php echo lang_admin('picture');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <!-- 设置 -->
                <div class="tab-content" style="padding:0px 15px;">
                    <p class="tips">
                        <i class="icon-info"></i>
                        <?php echo lang_admin('click_the_picture_to_upload');?>
                    </p>
                    <div role="tabpanel" class="tab-pane active" id="upload-img">
                        <form method="post" name="editfrmcategoryimg" id="editfrmcategoryimg" action="">
                            <input type="hidden" name="table" value="" class="form-control table">
                            <input type="hidden" name="field" value="" class="form-control field">
                            <input type="hidden" name="id" value="" class="form-control id">
                            <input type="hidden" name="type" value="" class="form-control type">
                            <input type="hidden" name="module_name" value="" class="form-control module_name">


                            <?php echo form::upload_thumb('editimage','');?>

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
                <button name="savecategoryimg" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- 标签信息弹出框 -->
<script type="text/javascript">
    var currenteditor1;
    $(document).ready(function () {
        $("[name=savecategoryimg]").click(function(e) {
            e.preventDefault();
            var imageurl=$('#editimage').val();
            data = $('#editfrmcategoryimg').serialize();
            $.ajaxSetup (  { async: false });
            $.post('<?php echo url("template/editcategorytemplate");?>',data,function(res){
                editcatrgroy['Node'].attr("src",imageurl);
            });

        });
    });
</script>