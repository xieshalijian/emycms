
<div class="modal fade" id="template-mixing-shop-tag" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  name="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist" name="navigation_modal_tabs_shopmixing">

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
                <!-- 设置 -->
                <div class="tab-content" name="shop_mixing_modal_show">

                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" name="close" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button name="saveshopmixing" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- 标签弹出框 -->
<script type="text/javascript">
    var template_getshopmixing='<?php echo url("template/getmixing/shop/1");?>';
    var currenteditor1;
    $(document).ready(function () {
        var isoldmixing=false;
        $('body.edit .visual-right').on("click","[data-target='#template-mixing-shop-tag']",function(e) {
            $("[name='template_lading']").attr("style","display: block;");
            $('#template-mixing-shop-tag').addClass("modal-right");
            e.preventDefault();
            currenteditor1 = $(this).parent().parent().parent().siblings('.view');
            var eText = currenteditor1.find('.tag .tagname').html();
            //打开标签选中
            $.post('<?php echo url("template/getmodulestag");?>', {'tag': eText, 'num': 1}, function (res) {
                //弹出框的导航栏增加
                tabslist(res, 'shopmixing');
                //生成栏目弹出框的  动态内容
                shopmixinghtml(res);
            }, 'json');
        });


        //图片选择
        $("[name=tagimg]").click(function(e) {
            $("#frmshopmixing .tagtemplate").val($(this).data("tagname"));
            $("[name=tagimglist]").removeClass("active");
            $(this).parent().addClass("active");
        });

        //提示弹到指定位置
        function istab(id){
            $('[name=tab-li]').removeClass('active');
            $('#tab-li-'+id+'').addClass('active');
            $('[name=tab-show]').removeClass('active');
            $('#tag-show-'+id+'').addClass('active');
        }

        $("[name=saveshopmixing]").click(function(e) {
            e.preventDefault();
            $("input[name='tag-tabid-shopmixing']").each(function(){
                var id=$(this).val();
                if($('#frmshopmixing'+id+' [name=catid]').val() == '0'){
                    alert("<?php echo lang_admin('please_select_the_column');?>");
                    istab(id);
                    $('#frmshopmixing'+id+' [name=catid]').focus();
                    return false;
                }
                data = $('#frmshopmixing'+id).serialize();
                $.ajaxSetup ( {
                        async: false
                    });
                var savemoduletagurl='<?php echo url("template/savemoduletag");?>';
                if (visualcatid>0){
                    savemoduletagurl+="&catid="+visualcatid;
                }
                if (visualaid>0){
                    savemoduletagurl+="&aid="+visualaid;
                }
                $.post(savemoduletagurl,data,function(res){
                    $('#frmshopmixing'+id)[0].reset();
                    $('#frmshopmixing'+id+' .id').val('');
                    savemodule('frmshopmixing',id,res,currenteditor1);
                    ready_all();
                });

            });

            publicalert=false;  //还原
            ready_all();
            saveLayout();

        });
    });



</script>