<div id="template-edit-category-strgrade" class="modal fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">
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
                        <a href="#tag-text-config" aria-controls="tag-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('text');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <!-- 设置 -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="tag-text-config">
                        <form method="post" name="editfrmcategorystrgrade" id="editfrmcategorystrgrade" action="">
                            <input type="hidden" name="table" value="" class="form-control table">
                            <input type="hidden" name="field" value="" class="form-control field">
                            <input type="hidden" name="id" value="" class="form-control id">
                            <input type="hidden" name="type" value="" class="form-control type">
                            <input type="hidden" name="module_name" value="" class="form-control module_name">
                            <div class="row">
                                <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('grade');?></div>
                                    <div class="col-xs-12 col-sm-7 col-md-9 col-lg-5 text-left">
                                        <label class="checkbox-inline">
                                        <input name="grade" type="radio" value="0" class="radio"> </label>0
                                        <label class="checkbox-inline"><input name="grade" type="radio" value="1" class="radio"></label>1
                                        <label class="checkbox-inline"><input name="grade" type="radio" value="2" class="radio"></label>2
                                        <label class="checkbox-inline"><input name="grade" type="radio" value="3" class="radio"></label>3
                                        <label class="checkbox-inline"><input name="grade" type="radio" value="4" class="radio"></label>4
                                        <label class="checkbox-inline"><input name="grade" type="radio" value="5" class="radio"></label>5                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="对内容进行评级，将以五角星显示级别！"></span>

                                    </div>
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
                <button name="savecategorystrgrade" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- 标签信息弹出框 -->
<script type="text/javascript">
    var currenteditor1;
    $(document).ready(function () {
        $("[name=savecategorystrgrade]").click(function(e) {
            e.preventDefault();
           var content=$("input[name=grade]:checked").val();
            data = $('#editfrmcategorystrgrade').serialize();
            $.ajaxSetup (  { async: false });
            $.post('<?php echo url("template/editcategorytemplate");?>',data,function(res){
                editcatrgroy['Node'].html(res);
                editcatrgroy['Node'].attr("cmseasy-grade",content);
            });

        });
    });



</script>