<div class="modal fade" id="template-commoncss-shop-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_shopcommoncss">

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
                <div class="tab-content" name="shop_commoncss_modal_show">

                </div>

            </div>
            <div class="modal-footer">
                <button  type="button"  name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveshopcommoncss" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var currenteditor;
    var template_getshopcommoncss='<?php echo url("template/getcommoncss/shop/1");?>';
    $(document).ready(function () {
        var isoldcommoncss=false;
        $('body.edit .visual-right').on("click", "[data-target='#template-commoncss-shop-tag']", function (e) {
            $("[name='template_lading']").attr("style","display: block;");
            e.preventDefault();
            currenteditor = $(this).parent().parent().parent().parent().find('.view');
            var eText = currenteditor.find('.tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            var _tag_buymodules=new RegExp('tag_buymodules');
            var _tag_modules=new RegExp('tag_modules');
            var _tag_sections=new RegExp('tag_sections');
            if(_tag_buymodules.test(eText) ||  _tag_modules.test(eText)||  _tag_sections.test(eText) )
            {
                $('#template-commoncss-shop-tag').addClass("modal-right");
                $.ajaxSetup (  { async: true });
                var getmodulestag='<?php echo url("template/getmodulestag");?>';
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
                    tabslist(res,'shopcommoncss');
                    //生成栏目弹出框的  动态内容
                    shopcommoncsshtml(res);
                }, 'json');
            }

        });

        $("[name=saveshopcommoncss]").click(function (e) {
            e.preventDefault();
            $("input[name='tag-tabid-shopcommoncss']").each(function () {
                var id = $(this).val();

                data = $('#frmshopcommoncss' + id).serialize();
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
                if (visualspid>0){
                    savemoduletagurl+="&spid="+visualspid;
                }
                if (visualtypeid>0){
                    savemoduletagurl+="&typeid="+visualtypeid;
                }
                $.post(savemoduletagurl, data, function (res) {
                    $('#frmshopcommoncss' + id)[0].reset();
                    $('#frmshopcommoncss' + id + ' .id').val('');
                    savemodule('frmshopcommoncss',id,res,currenteditor);
                });

            });
            publicalert = false;  //还原
            saveLayout();
            refreshrigt(refreshrigt_url);//可视化编辑区域刷新
        });
    });


</script>