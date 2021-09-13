 <div class="modal fade" id="template-allconfig-tag" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_allconfig">
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
                <div class="blank30"></div>
                <!-- 设置 -->
                <div class="tab-content" name="allconfig_modal_show">

                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveallconfig" type="button" class="btn btn-primary" data-dismiss="modal">
                    <?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 标签弹出框 -->
<script type="text/javascript">
    $(document).ready(function () {
        $('[name="allconfig"]').click(function(){
            $("[name='template_lading']").attr("style","display: block;");
            $('#template-allconfig-tag').addClass("modal-right");
            var type=$(this).data("type");
            //打开标签选中
            $.post('<?php echo url("template/getconfig");?>',{'type':type}, function (res) {
                //弹出框的导航栏增加
                tabsconfiglist(res.tabs, 'allconfig');
                //生成栏目弹出框的  动态内容
                $("[name='allconfig_modal_show']").html(res.content);
                $("[name='template_lading']").attr("style","display: none;");
            }, 'json');
        });
    });


    $("[name=saveallconfig]").click(function(e) {
        e.preventDefault();
        $("input[name='tag-tabid-allconfig']").each(function(){
            var id=$(this).val();
            data = $('#frmallconfig'+id).serialize();
            $.ajaxSetup (
            {
                async: false
            });
            var savealllconfiggurl='<?php echo url("template/saveallconfig");?>';
            if (visualcatid>0){
                savealllconfiggurl+="&catid="+visualcatid;
            }
            if (visualaid>0){
                savealllconfiggurl+="&aid="+visualaid;
            }
            $.post(savealllconfiggurl,data,function(res){
                res=JSON.parse(res);
                if (res.static){
                    saveLayout();
                    window.location.reload();
                }else{
                    alert(res.message);
                }
            });

        });

    });



</script>