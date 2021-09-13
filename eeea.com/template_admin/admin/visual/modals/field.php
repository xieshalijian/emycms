
<div class="modal fade" id="template-field-tag" tabindex="-1" role="dialog"
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
                    <?php echo lang_admin('custom_field_properties');?>
                    </a>
                    </li>
                    </ul>
            </div>
            <div class="modal-body">
                <div class="clearfix blank20"></div>
                <form method="post" name="frmField" id="frmField" action="">
                    <input name="newmodulesname"  type="hidden" value="">
                    <input name="id"  type="hidden" value="">

                        <h5>
                            <?php echo lang_admin('selection_field');?>
                        </h5>

                            <select class="fields form-control" style="width: 100%; height: 380px;" name="fields[]" id="fields" multiple="multiple">
                                <optgroup label="<?php echo lang_admin('selection_by_ctrl_a');?>">
                                </optgroup>
                                <optgroup label="<?php echo lang_admin('select_by_ctrl_or_shift');?>">
                    <?php
                    $sets = setting::getInstance();
                    $fields = setting::$var['archive'];
                    $newcname='cname_'.lang::getisadmin();
                    if(is_array($fields) && !empty($fields)){
                        foreach ($fields as $f){
                            if ($f['isshoping'])continue;
                            ?>
                            <option value="<?php echo $f['name'];?>"><?php echo $f[$newcname];?></option>
                            <?php
                        }
                    }
                    ?>
                                </optgroup>
                            </select>

                    <div class="clearfix blank20"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button id="saveFieldStyle" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var fieldHandel;

    $(document).ready(function () {

    $('body.edit .visual-right').on("click", "[data-target='#template-field-tag']", function (e) {
            e.preventDefault();
            fieldHandel = $(this).parent().parent().parent().parent().find('.view');
            var eText = fieldHandel.find('.tag .tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            var _tag_sections=new RegExp('tag_sections');
            if(_tag_sections.test(eText) )
            {
                $('#template-field-tag').addClass("modal-right");
                $.ajaxSetup (  { async: true });
                var getlisttag='<?php echo url("template/getmodulestag/isshopping/".get('isshopping'));?>';
                if (visualaid>0){
                    getlisttag+="&aid="+visualaid;
                }
                $.post(getlisttag, {'tag': eText}, function (res) {
                    console.log(res);
                    $('#frmField [name=newmodulesname]').val(res[0].newmodulesname);
                    $('#frmField [name=id]').val(res[0].id);
                    $('#frmField .fields').val(res[0].fields);
                }, 'json');
            }

        });

        $("#saveFieldStyle").click(function (e) {
            e.preventDefault();
            data = $("#frmField").serialize();
            //template/getfieldlist
            $.ajaxSetup({
                async: false
            });
            $.post('<?php echo url("template/savemoduletag");?>', data, function (res) {
                fieldHandel.html(res);
            });
            /*cmseasyeditimg();
            cmseasyedit();
            saveLayout();
            window.location.reload();*/
        });
    });

</script>