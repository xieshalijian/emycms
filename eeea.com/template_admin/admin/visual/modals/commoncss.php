<div class="modal fade" id="template-commoncss-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_commoncss">

                </ul>
            </div>
            <div class="modal-body">
                <!--加载进度条-->
                <div class="index-lading" name="template_lading" style="display: none;">
                    <div class="loadEffect">
                        <div><span></span></div>
                        <div><span></span></div>
                        <div><span></span></div>
                        <div><span></span></div>
                    </div>
                </div>

                <div class="tab-content" name="commoncss_modal_show">

                </div>

            </div>
            <div class="modal-footer">
                <button  type="button"  name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="savecommoncss" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var currenteditor;
    var template_getcommoncss='<?php echo url("template/getcommoncss/isshopping/".get('isshopping'));?>';
    $(document).ready(function () {
        $('body.edit .visual-right').on("click", "[data-target='#template-commoncss-tag']", function (e) {
            $("[name='template_lading']").attr("style","display: block;");
            e.preventDefault();
            currenteditor = $(this).parent().parent().parent().parent().find('.view');
            var eText = currenteditor.find('.tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            var _tag_sections=new RegExp('tag_sections');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText) ||  _tag_sections.test(eText) )
            {
                $('#template-commoncss-tag').addClass("modal-right");
                $.ajaxSetup (  { async: true });
                var getmodulestag='<?php echo url("template/getmodulestag/isshopping/".get('isshopping'));?>';
                if (visualcatid>0){
                    getmodulestag+="&catid="+visualcatid;
                }
                if (visualaid>0){
                    getmodulestag+="&aid="+visualaid;
                }
                if (visualspid>0){
                    getmodulestag+="&spid="+visualspid;
                }
                if (visualtypeid>0){
                    getmodulestag+="&typeid="+visualtypeid;
                }
                $.post(getmodulestag, {'tag': eText}, function (res) {
                    $('#template-old-content-tag').modal('hide');
                    console.log(res);
                    //弹出框的导航栏增加
                    tabslist(res,'commoncss',true);
                    //生成栏目弹出框的  动态内容
                    commoncsshtml(res,true);
                }, 'json');
            }

        });

        //提示弹到指定位置
        function istab(id) {
            $('[name=tab-li]').removeClass('active');
            $('#tab-li-' + id + '').addClass('active');
            $('[name=tab-show]').removeClass('active');
            $('#tag-show-' + id + '').addClass('active');
        }

        $("[name=savecommoncss]").click(function (e) {
            e.preventDefault();
            $("input[name='tag-tabid-commoncss']").each(function () {
                var id = $(this).val();
                data = $('#frmcommoncss' + id).serialize();

                //判断自定义字段
                var fields_data=$('#frmcommoncss_fields_' + id).serialize();
                if (fields_data.length>0){
                    data+=fields_data;
                }
                //console.log(data);

                $.ajaxSetup({
                    async: false
                });

                var savemoduletagurl='<?php echo url("template/savemoduletag/isshopping/".get('isshopping'));?>';
                if (visualcatid>0){
                    savemoduletagurl+="&catid="+visualcatid;
                }
                if (visualaid>0){
                    savemoduletagurl+="&aid="+visualaid;
                }
                if (visualspid>0){
                    savemoduletagurl+="&spid="+visualspid;
                }
                if (visualtypeid>0){
                    savemoduletagurl+="&typeid="+visualtypeid;
                }
                $.post(savemoduletagurl, data, function (res) {
                    $('#frmcommoncss' + id)[0].reset();
                    $('#frmcommoncss' + id + ' .id').val('');
                    savemodule('frmcommoncss',id,res,currenteditor);
                });
            });
            publicalert = false;  //还原
            saveLayout();
            refreshrigt(refreshrigt_url);//可视化编辑区域刷新

        });
    });

    function commoncssstagimg(){
        //图片选择
        $("[name=commoncssstagimg]").click(function(e) {
            $("[name='listtemplate']").val($(this).data("tagname"));
            $("[name='shoplisttemplate']").val($(this).data("tagname"));
            $("[name='annountemplate']").val($(this).data("tagname"));
            $("[name='shopannountemplate']").val($(this).data("tagname"));
            $("[name='typetemplate']").val($(this).data("tagname"));
            $("[name='shoptypetemplate']").val($(this).data("tagname"));
            $("[name='specialtemplate']").val($(this).data("tagname"));
            $("[name='shopspecialtemplate']").val($(this).data("tagname"));
            $("[name=listtagimgcommoncsss]").removeClass("active");
            $(this).parent().addClass("active");
        });
    }


</script>