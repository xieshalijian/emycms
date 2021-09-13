
<div class="modal fade code-config" id="codeModel" tabindex="-1" role="dialog"
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
                    <?php echo lang_admin('code');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form method="post" id="frmcodeModel" name="frmcodeModel" action="">
                        <input type="hidden" name="tagfrom" value="" class="form-control">
                        <input type="hidden" name="modulesname" value="" class="form-control modulesname">
                        <input type="hidden" name="newmodulesname" value="" class="form-control newmodulesname">
                        <input type="hidden" name="id" value="" class="form-control id">
                        <textarea rows="50" id="codecontent" style="height: 300px;" placeholder="<?php echo lang_admin('enter_the_code_here');?>"
                              name="codecontent" type="text" class="form-control"></textarea>
                    </form>
                </div>
            </div>
            <div class="modal-footer  form-inline">
 
<div class="checkbox pull-left">
    <label>
      <input type="checkbox" id="code-checkbox" name="code-checkbox"> <?php echo lang_admin('hide');?>
    </label>
  </div>
                <button  type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button id="btn_saveCode" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var codeHandel;

    function htmlspecialchars(str){
        str = str.replace(/&/g, '&amp;');
        str = str.replace(/</g, '&lt;');
        str = str.replace(/>/g, '&gt;');
        str = str.replace(/"/g, '&quot;');
        str = str.replace(/'/g, '&#039;');
        return str;
    }

    function htmlspecialchars_decode(str){
        str = str.replace(/&amp;/g, '&');
        str = str.replace(/&lt;/g, '<');
        str = str.replace(/&gt;/g, '>');
        str = str.replace(/&quot;/g, "''");
        str = str.replace(/&#039;/g, "'");
        return str;
    }


    $(document).ready(function () {
        // alert($('#download-layout').html());

        $('body.edit .visual-right').on("click", "[data-target='#codeModel']", function (e) {
            e.preventDefault();
            codeHandel = $(this).parent().parent().parent().parent().find('.view');
            var eText = codeHandel.find('.tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            $.ajaxSetup (  { async: true });
            $.post('<?php echo url("template/getmodulestag");?>', {'tag': eText}, function (res) {
                console.log(res);
                $("#codeModel [name=tagfrom]").val(res[0].tagfrom);
                $("#codeModel [name=modulesname]").val(res[0].modulesname);
                $("#codeModel [name=newmodulesname]").val(res[0].newmodulesname);
                $("#codeModel [name=id]").val(res[0].id);
                $('.code-config #codecontent').val(htmlspecialchars_decode(res[0].codecontent));
            }, 'json');
        });

        $("#code-checkbox").click(function(){
                 $(".visual-code,.visual-code-show").toggleClass("hidden");
            });

        $("#btn_saveCode").click(function(e) {
            e.preventDefault();
            data = $('#frmcodeModel').serialize();
            $.ajaxSetup({
                async: false
            });
            var savemoduletagurl='<?php echo url("template/savemoduletag");?>';
            if (visualcatid>0){
                savemoduletagurl+="&catid="+visualcatid;
            }
            if (visualaid>0){
                savemoduletagurl+="&aid="+visualaid;
            }
            $.post(savemoduletagurl, data, function (res) {
                $("#codeModel [name=tagfrom]").val("");
                $("#codeModel [name=modulesname]").val("");
                $("#codeModel [name=newmodulesname]").val("");
                $("#codeModel [name=id]").val("");
                $('.code-config #codecontent').val("");
                savemodule('frmcodeModel',"",res,codeHandel);
            });
            publicalert = false;  //还原
            ready_all();
            saveLayout();
        });

    });
</script>