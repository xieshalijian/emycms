
<div id="formModel" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="icon-close"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                           <?php echo lang_admin('form');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <form method="post" name="frmform" id="frmform" action="">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                           <?php echo lang_admin('select_form');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select class="form-control select selectform" name="selectform"  id="selectform">
                                <option value="">
                                    <?php echo lang_admin("please_choose");?>
                                </option>
                                <?php
                                $tables=array();
                                $forms=tdatabase::getInstance()->getTables();
                                foreach($forms as $form) {
                                    if(preg_match('/^'.config::getdatabase('database','prefix').'(my_\w+)/xi',$form['name'],$res))
                                        $tables[]=$res[1];
                                }
                                $sets = settings::getInstance()->getrow(array('tag' => 'table-fieldset'));
                                $sets=phpox_unserialize($sets['value']);
                                $newname="cname_".lang::getisadmin();
                                foreach ($tables as $key=>$val){ ;?>
                                    <option value="<?php echo $val;?>">
                                        <?php echo (is_array($sets) && isset($sets[$val]))?$sets[$val]['myform'][$newname]:"无";?>
                                    </option>
                                <?php };?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveformmodel" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('body.edit .visual-right').on("click","[data-target='#formModel']",function(e) {
            e.preventDefault();
            currenteditor1 = $(this).parent().parent().parent().siblings('.view');
            var eText = currenteditor1.find('.tagname').html();
            eText=$.trim(eText);
            eText = eText.replace("{", "");
            eText = eText.replace("}", "");
            eText = eText.replace("cmseasy_form_", "");
            $('#frmform .selectform').val(eText);
        });

        $("[name=saveformmodel]").click(function(e) {
            if($('#frmform .selectform').val() == ''){
                alert("<?php echo lang_admin('please_choose').lang_admin('form');?>");
                $('#frmform .selectform').focus();
                return false;
            }
            data = $('#frmform').serialize();
            $.post('<?php echo url("template/savetagform");?>',data,function(res){
                currenteditor1.html(res);
            });
        });
    });

</script>