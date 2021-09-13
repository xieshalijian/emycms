$(function () {

    var getsearch_catid_static=false;
    if($('#parentid').length >0){
        if (!getsearch_catid_static){
            //加载栏目下拉
            var getsearch_catid_url='./index.php?case=archive&act=getsearch_catid&ajax=1&shopping='+public_shopping;
            $.ajax({
                type: "get",
                url: getsearch_catid_url,
                async: true,
                success: function (data) {
                    /*$('#parentid').html(data);
                    var elem=$('#parentid');
                    if(document.createEvent){
                        e.initMouseEvent("mousedown");
                        elem[0].dispatchEvent(e);
                    }else if(element.fireEvent){
                        elem[0].fireEvent("onmousedown");
                    }*/
                    $('#parentid').html(data);
                    $('#parentid').selectpicker("refresh");
                    $('#parentid').selectpicker('render');
                    getsearch_catid_static=true;
                }
            });
        }
    }
    //加载栏目
    var getsearch_catidshopping_static=false;
    if($('#catidshopping').length >0){
        if (!getsearch_catidshopping_static){
            //加载栏目下拉
            var getsearch_catid_url='./index.php?case=archive&act=getsearch_catid&ajax=1&shopping='+public_shopping;
            $.ajax({
                type: "get",
                url: getsearch_catid_url,
                async: true,
                success: function (data) {
                    $('#catidshopping').html(data);
                    $('#catidshopping').selectpicker("refresh");
                    $('#catidshopping').selectpicker('render');
                    getsearch_catidshopping_static=true;
                }
            });
        }
    }


});


function checkform(obj) {
    if($('#parentid').length >0) {
        var checkParam = $('#parentid').find('option:selected');
        // 选中的ID集合
        var checkId = [];
        for (var i = 0; i < checkParam.length; i++) {
            checkId.push($(checkParam[i]).val());
        }
        var e_id = checkId.join(',');
        $('[name=parentid]').val(e_id);
    }
    if($('#catidshopping').length >0) {
        var checkParam = $('#catidshopping').find('option:selected');
        // 选中的ID集合
        var checkId = [];
        for (var i = 0; i < checkParam.length; i++) {
            checkId.push($(checkParam[i]).val());
        }
        var e_id = checkId.join(',');
        $('[name=catidshopping]').val(e_id);
    }

    returnform(obj);
    return  false;
}