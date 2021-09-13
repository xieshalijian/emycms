$(function () {
    //加载栏目
    var getsearch_catidshopping_static=false;
    if($('#catidshopping').length >0){
        if (!getsearch_catidshopping_static){
            //加载栏目下拉
            var getsearch_catid_url='./index.php?case=archive&act=getsearch_catid&ajax=1&shopping='+public_shopping;
            getsearch_catid_url+='&catid='+search_catid;
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
    };

    var getsearch_catid_static=false;

    if($('#catid').length >0){
        if (!getsearch_catid_static){
            //加载栏目下拉
            var getsearch_catid_url='./index.php?case=archive&act=getsearch_catid&ajax=1&shopping='+public_shopping;
            getsearch_catid_url+='&catid='+search_catid;
            $.ajax({
                type: "get",
                url: getsearch_catid_url,
                async: true,
                success: function (data) {
                    $('#catid').html(data);
                    $('#catid').selectpicker("refresh");
                    $('#catid').selectpicker('render');
                    getsearch_catid_static=true;
                }
            });
        }
    };
    //加载搜索条件  --分类
    var getsearch_typeid_static=false;
    if($('#typeid').length >0){
        if (!getsearch_typeid_static){
            //加载栏目下拉
            var getsearch_typeid_url='./index.php?case=archive&act=getsearch_typeid&ajax=1&shopping='+public_shopping;
            getsearch_typeid_url+='&typeid='+search_typeid;
            $.ajax({
                type: "get",
                url: getsearch_typeid_url,
                async: true,
                success: function (data) {
                    $('#typeid').html(data);
                    $('#typeid').selectpicker("refresh");
                    $('#typeid').selectpicker('render');
                    getsearch_typeid_static=true;
                }
            });
        }
    };

    //加载搜索条件  --专题
    var getsearch_spid_static=false;
    if($('#spid').length >0){
        if (!getsearch_spid_static){
            //加载栏目下拉
            var getsearch_spid_url='/index.php?case=archive&act=getsearch_spid&ajax=1&shopping='+public_shopping;
            getsearch_spid_url+='&spid='+search_spid;
            $.ajax({
                type: "get",
                url: getsearch_spid_url,
                async: true,
                success: function (data) {
                    $('#spid').html(data);
                    $('#spid').selectpicker("refresh");
                    $('#spid').selectpicker('render');
                    getsearch_spid_static=true;
                }
            });
        }
    };

});


$(function () {
    $("#sopingfield").attr("style","display:none");
    //显示商品字段
    getshoppingcatid();
    //编辑栏目的时候
    $("#catidshopping").change(function () {
        //显示商品字段
        getshoppingcatid();
        //tag重新加载
        /* gettaglist($(this).val());*/
    });
    //组合商品的栏目加载
    getshoppingtypecatid();
    //组合商品加载
    getshopping();
    //弹出框确认键
    $('#btn_pay').click(function () {
        if(shopingtype.length>0){
            var newshoppingtype="";   //返回的隐藏类型
            var newshowshoppingtype="";  //返回的类型
            for(var i=0;i<shopingtype.length;i++){
                if(shopingtype[i]!=''){
                    if(newshoppingtype==''){
                        newshoppingtype=prevshoopingid+",1#"+shopingtype[i]; //+,1 的原因是  默认买一个
                    }else{
                        newshoppingtype=newshoppingtype+";"+shopingtype[i];
                    }
                    var datafiledname=shopingtype[i].split(":");
                    datafiledname=datafiledname[1].split(",");
                    if(newshowshoppingtype==""){
                        newshowshoppingtype=datafiledname[0];
                    }else{
                        newshowshoppingtype+="-"+datafiledname[0];
                    }
                }
            }
        }else{
            newshoppingtype=prevshoopingid+",1#";
        }
        $(thisbutton).parent().find('input[type="text" ]').val(newshowshoppingtype);
        $(thisbutton).parent().find('input[name="hiddenshopping"]').val(newshoppingtype);
        $("#closmode").trigger("click");  //关闭弹出框
    });
    //加载购买链接
    loadbuyurl();
    //切换城市下拉框 --市
    $("#province_id").change(function () {
        //获取城市信息  --市
        getarea_city($("#province_id").val());
        //获取城市信息  --县
        getarea_section(0)
    });
    //切换城市下拉框 --区
    $("#city_id").change(function () {
        getarea_section($("#city_id").val());
    });
});




