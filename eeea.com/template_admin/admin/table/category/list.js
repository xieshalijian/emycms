$(function () {

    if($('#copytolang').length >0){
        $('#copytolang').selectpicker("refresh");
        $('#copytolang').selectpicker('render');
    }
    $('#add_content_column').click(function() {
        //新增内容栏目
        addcatrgoty(0);
    });
    $('#add_commodity_column').click(function() {
        //新增商品栏目
        addcatrgoty(1);
    });
    //复制框
    $('[name="catrgoty_copy"]').click(function(){
        //复制
        $("[name=iscopysubcolumn]").val($('#is_copy_subcolumn').val());
        $("[name=iscopycontent]").val($('#is_copy_content').val());
        $('#mycopyModal').modal('hide');
        $(".modal-backdrop.fade").hide();
        returnform($('#listform'));
    });

    var getcategoryoption_static=false;
    if($('#catid').length >0){
        if (!getcategoryoption_static){
            //加载栏目下拉
            var getcategoryoption_url='./index.php?case=category&act=getcategoryoption&ajax=1';
            $.ajax({
                type: "get",
                url: getcategoryoption_url,
                async: true,
                success: function (data) {
                    $('#catid').html(data);
                    $('#catid').selectpicker("refresh");
                    $('#catid').selectpicker('render');
                    getcategoryoption_static=true;
                }
            });
        }
    };


    //加载栏目列表
    /* var getcategorylist_url='./index.php?case=category&act=getcategorylist&admin_dir='+public_admin_dir+'&site='+public_site;
     $.ajax({
         type: "get",
         url: getcategorylist_url,
         async: true,
         success: function (data) {
             $("[name=loading_category]").remove();
             $("#listtable").html(data);
         }
     });*/
});

