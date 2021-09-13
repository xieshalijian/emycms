$(function(){
    $('[name="my_cache_modal"]').click(function(){
        var modal = $(this).data("modal-url");
        open_mode(modal,false)
    });
});

function getHtml(modal,is_static) {
    var url = './index.php?case=cache&act=doGetHtml_' + modal + '&admin_dir=' + public_admin_dir + '&site=' + public_site;
    if (is_static){
        url+="&is_static=1";
    }
    $.ajax({
        url: url,
        success: function (result) {
            result =  JSON.parse(result);
            if (result.status){
                var html="";
                //console.log(result.data);
                $.each(result.data, function (index, val) {
                    html+='<p>';
                    html+='<a style="cursor: pointer;"';
                    if (val.hasOwnProperty('is_static')){
                        html+=' name="'+val.is_static+'" ';
                    }
                    html+='data-url="'+val.content.url+'" class="html-link" data-name="'+val.name+'">'+val.name+'</a>';
                    html+='</p>';
                });
                $("[name=doGetHtml]").append(html);
                createHtml();
                if ($("[name=all_button]").length > 0) {
                    $("[name=all_button]").trigger('click');
                }
            }
        }
    });
}

function createHtml() {
    $(".html-link").click(function() {
        const name = $(this).text();
        const title = $(this).data("name");
        const html_loading = $(".html-loading");
        const html_loading_h = html_loading.height();
        html_loading.html(
            '<p style="font-size:16px;" class="createing">'+name+'生成中...</p><div class="html-list"></div>'
        );
        const url = $(this).data("url");
        $.ajax({
            url: url,
            success: function (result) {
                result =  JSON.parse(result);
                if (result.data=="" || result.data==null){
                    //没设置生成内容
                    $(".createing").text(title+'生成完成');
                    var p='<p><a target="_blank" href="#">'+result.fail+'</a></p>';
                    $(".html-list").append(p);
                }else{
                    const len = result.data.length;
                    $.each(result.data, function (index, val) {
                        $.ajax({
                            url: val.url,
                            data:{'admin_lang':admin_lang,'template_lang':template_lang},
                            success: function (res) {
                                try{
                                    res =  JSON.parse(res);
                                    createHtmlCallback(val, res,title,html_loading_h,len);
                                }catch (e) {
                                    res={"suc":0,"fail":1};
                                    createHtmlCallback(val, res,title,html_loading_h,len);
                                }
                            },
                            error:function(xhr,state,errorThrown){
                                res={"suc":0,"fail":1};
                                createHtmlCallback(val, res,title,html_loading_h,len);
                            }
                        });
                    });
                }
            }
        });
    });
}

function  createHtmlCallback(val, res,title,html_loading_h,len) {
    const html_loading = $(".html-loading");
    const html_list = html_loading.find('.html-list');
    let order = html_list.find('p').length + 1;
    var p='<p><span style="color: #00b7ee;">('+order+'/'+len+')</span>&nbsp;'+(res.suc>0?val.suc:val.fail)+'</p>';
    html_list.append(p);
    if (order === len) {
        $(".createing").text(title+'生成完成');
    }
    var scrolltop = html_list.height() - html_loading_h + 40;
    scrolltop && html_loading.scrollTop(scrolltop);
};

function open_mode(modal,is_static){
    //打开生成模态框
    $("[name=doGetHtml]").html("");
    $('#my_cache_modal').modal('show');
    $(".html-loading").html('');
    getHtml(modal,is_static);
}