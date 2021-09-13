<div class="modal fade" id="template-edit-category-time" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">
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
                        <a href="#tag-time-config" aria-controls="tag-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('time');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">


                <!-- 设置 -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="tag-time-config">
                        <form method="post" name="editfrmcategorytime" id="editfrmcategorytime" action="">
                            <input type="hidden" name="table" value="" class="form-control table">
                            <input type="hidden" name="field" value="" class="form-control field">
                            <input type="hidden" name="id" value="" class="form-control id">
                            <input type="hidden" name="type" value="" class="form-control type">
                            <input type="hidden" name="module_name" value="" class="form-control module_name">


                                    {form::date('timecontent','')}

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
                <button name="savecategorytime" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>



<!-- 标签信息弹出框 -->
<script type="text/javascript">
    var currenteditor1;
    $(document).ready(function () {
        $("[name=savecategorytime]").click(function(e) {
            e.preventDefault();
            var content=$('#editfrmcategorytime #timecontent').val();
            data = $('#editfrmcategorytime').serialize();
            $.ajaxSetup ({ async: false });
            $.post('<?php echo url("template/editcategorytemplate");?>',data,function(res){
                editcatrgroy['Node'].html(content);
            });

        });
    });
</script>

