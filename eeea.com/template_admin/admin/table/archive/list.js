$(function () {
    if($('#copytolang').length >0){
        $('#copytolang').selectpicker("refresh");
        $('#copytolang').selectpicker('render');
    }
    if($('#attr1').length >0){
        $('#attr1').selectpicker("refresh");
        $('#attr1').selectpicker('render');
    }
    //加载搜索条件  --栏目列表
    var getleftlistform_url='./index.php?case=archive&act=getleftlistform&shopping='+public_shopping;
    $.ajax({
        type: "get",
        url: getleftlistform_url,
        async: true,
        success: function (data) {
            $("[name=loading_archive]").remove();
            $("#leftlistform").html(data);
        }
    });

    //加载专题下拉
    var getspecialoption_static=false;
    if($('#specialid').length >0){
        if (!getspecialoption_static){
            //加载分类下拉
            var getspecialoption_url='/index.php?case=special&act=getspecialoption&ajax=1';
            $.ajax({
                type: "get",
                url: getspecialoption_url,
                async: true,
                success: function (data) {
                    $('#specialid').html(data);
                    $('#specialid').selectpicker("refresh");
                    $('#specialid').selectpicker('render');
                    getspecialoption_static=true;
                }
            });
        }
    };

    //加载分类下拉
    var gettypeoption_static=false;
    if($('#typeid').length >0){
        if (!gettypeoption_static){
            //加载分类下拉
            var gettypeoption_url='./index.php?case=type&act=gettypeoption&ajax=1';
            $.ajax({
                type: "get",
                url: gettypeoption_url,
                async: true,
                success: function (data) {
                    $('#typeid').html(data);
                    $('#typeid').selectpicker("refresh");
                    $('#typeid').selectpicker('render');
                    gettypeoption_static=true;
                }
            });
        }
    };


    //加载栏目下拉
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


    //加载搜索条件  --栏目
    var getsearch_catid_static=false;
    if($('#search_catid').length >0){
        if (!getsearch_catid_static){
            //加载栏目下拉
            var getsearch_catid_url='./index.php?case=archive&act=getsearch_catid&ajax=1&shopping='+public_shopping;
            $.ajax({
                type: "get",
                url: getsearch_catid_url,
                async: true,
                success: function (data) {
                    $('#search_catid').html(data);
                    getsearch_catid_static=true;
                }
            });
        }
    };

    //加载搜索条件  --分类
    var getsearch_typeid_static=false;
    if($('#search_typeid').length >0){
        if (!getsearch_typeid_static){
            //加载栏目下拉
            var getsearch_typeid_url='./index.php?case=archive&act=getsearch_typeid&ajax=1&shopping='+public_shopping;
            $.ajax({
                type: "get",
                url: getsearch_typeid_url,
                async: true,
                success: function (data) {
                    $('#search_typeid').html(data);
                    getsearch_typeid_static=true;
                }
            });
        }
    };


    //加载搜索条件  --专题
    var getsearch_spid_static=false;
    if($('#search_spid').length >0){
        if (!getsearch_spid_static){
            //加载栏目下拉
            var getsearch_spid_url='/index.php?case=archive&act=getsearch_spid&ajax=1&shopping='+public_shopping;
            $.ajax({
                type: "get",
                url: getsearch_spid_url,
                async: true,
                success: function (data) {
                    $('#search_spid').html(data);
                    getsearch_spid_static=true;
                }
            });
        }
    };

    //加载搜索条件  --作者
    var getsearch_userid_static=false;
    if($('#search_userid').length >0){
        if (!getsearch_userid_static){
            //加载栏目下拉
            var getsearch_userid_url='/index.php?case=archive&act=getsearch_userid&ajax=1&shopping='+public_shopping;
            $.ajax({
                type: "get",
                url: getsearch_userid_url,
                async: true,
                success: function (data) {
                    $('#search_userid').html(data);
                    getsearch_userid_static=true;
                }
            });
        }
    };

    $(".search-criteria-btn").click(function(){
        $(".search-criteria").toggle(500);
    });

    //复制
    $('[name="archive_copy"]').click(function(){
        var checkParam = $('#copytolang_catid').find('option:selected');
        // 选中的ID集合
        var checkId = [];
        for (var i=0;i<checkParam.length;i++) {
            checkId.push($(checkParam[i]).val());
        }
        var copytolang_catid = checkId.join(',');
        if (copytolang_catid==0){
            alert('<?php echo lang_admin("please_select_the_column");?>');
        }else{
            //复制
            $("[name=copylangcatid]").val(copytolang_catid);
            $('#mycopyModal').modal('hide');
            $(".modal-backdrop.fade").hide();
            returnform($('#listform'));
        }
    })

});

