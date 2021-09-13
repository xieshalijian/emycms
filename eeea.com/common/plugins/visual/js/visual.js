function supportstorage() {
    if (typeof window.localStorage=='object')
        return true;
    else
        return false;
}

function handleSaveLayout1() {
    var e = $(".visual-right").html();
    if (!stopsave && e != window.demoHtml) {
        stopsave++;
        window.demoHtml = e;
        saveLayout1();
        stopsave--;
    }
}


function handleSaveLayout() {
    var e = $(".visual-right").html();
    if (e != window.demoHtml) {
        saveLayout();
        window.demoHtml = e
    }
}

var layouthistory;
function saveLayout1(){
    var data = layouthistory;
    if (!data) {
        data={};
        data.count = 0;
        data.list = [];
    }
    if (data.list.length>data.count) {
        for (i=data.count;i<data.list.length;i++)
            data.list[i]=null;
    }
    data.list[data.count] = window.demoHtml;
    data.count++;
    if (supportstorage()) {
        localStorage.setItem("layoutdata",JSON.stringify(data));
    }
    layouthistory = data;
    //console.log(data);
    /*$.ajax({
    type: "POST",
    url: "/build/saveLayout",
    data: { layout: $('.visual-right').html() },
    success: function(data) {
        //updateButtonsVisibility();
    }
});*/
}


function handleJsIds() {
    handleModalIds();
    handleAccordionIds();
    handleCarouselIds();
    handleTabsIds()
}


//自动生成class类
function handleJsClass(e,t) {
    /*div = $(e.target).find('.view>div');*/
    div = $(e.target)
    //console.log(div);
    div.each(function() {
        var eritdiv=new Array();
        $(this).removeClass(
            function(index, classname){
                //console.log(index);
                arr = classname.split(' ');
                var r = '';
                for(key in arr){
                    var _divid=new RegExp('(\\$)_divid');
                    if(_divid.test(arr[key]))
                    {
                        r += arr[key] + " ";
                        eritdiv.push(arr[key]);
                    }
                }
                return r;
            });
        var t = randomNumber();
        if (eritdiv.length>0){
            var Newstr="";
            $.each(eritdiv, function(index, value){
                var re = new RegExp("(\\$)_divid","g");
                Newstr+= value.replace(re, t)+"";
            });
            if (Newstr!=""){
                $(this).addClass(Newstr);
            }
        }
    });
}


function handleAccordionIds() {
    var e = $(".visual-right #myAccordion");
    var t = randomNumber();
    var n = "panel-" + t;
    var r;
    e.attr("id", n);
    e.find(".panel").each(function(e, t) {
        r = "panel-element-" + randomNumber();
        $(t).find(".panel-title").each(function(e, t) {
            $(t).attr("data-parent", "#" + n);
            $(t).attr("href", "#" + r)
        });
        $(t).find(".panel-collapse").each(function(e, t) {
            $(t).attr("id", r)
        })
    })
}

function handleCarouselIds() {
    var e = $(".visual-right #myCarousel");
    var t = randomNumber();
    var n = "carousel-" + t;
    e.attr("id", n);
    e.find(".carousel-indicators li").each(function(e, t) {
        $(t).attr("data-target", "#" + n)
    });
    e.find(".left").attr("href", "#" + n);
    e.find(".right").attr("href", "#" + n)
}

function handleModalIds() {
    var e = $(".visual-right #myModalLink");
    var t = randomNumber();
    var n = "modal-container-" + t;
    var r = "modal-" + t;
    e.attr("id", r);
    e.attr("href", "#" + n);
    e.next().attr("id", n)
}

function handleTabsIds() {
    var e = $(".visual-right #myTabs");
    var t = randomNumber();
    var n = "tabs-" + t;
    e.attr("id", n);
    e.find(".tab-pane").each(function(e, t) {
        var n = $(t).attr("id");
        var r = "panel-" + randomNumber();
        $(t).attr("id", r);
        $(t).parent().parent().find("a[href=#" + n + "]").attr("href", "#" + r)
    })
}

function randomNumber() {
    return randomFromInterval(1, 1e6)
}

function randomFromInterval(e, t) {
    return Math.floor(Math.random() * (t - e + 1) + e)
}

function gridSystemGenerator() {
    $(".lyrow .preview input").bind("keyup",
        function() {
            var e = 0;
            var t = "";
            var n = false;
            var r = $(this).val().split(" ", 12);
            $.each(r,
                function(r, i) {
                    if (!n) {
                        if (parseInt(i) <= 0) n = true;
                        e = e + parseInt(i);
                        t += '<div class="col-md-' + i + '"><div class="row column ui-sortable"></div></div>'
                    }
                });
            if (e == 12 && !n) {
                $(this).parent().next().children().html(t);
                $(this).parent().prev().show()
            } else {
                $(this).parent().prev().hide()
            }
        })
}

function configurationElm(e, t) {
    $(".visual-right").delegate(".configuration > a", "click", function(e) {
        e.preventDefault();
        var t = $(this).parent().next().next().children();
        $(this).toggleClass("active");
        t.toggleClass($(this).attr("rel"))
    });
    $(".visual-right").delegate(".configuration .dropdown-menu a", "click", function(e) {
        e.preventDefault();
        var t = $(this).parent().parent();
        var n = t.parent().parent().next().next().children();
        t.find("li").removeClass("active");
        $(this).parent().addClass("active");
        var r = "";
        t.find("a").each(function() {
            r += $(this).attr("rel") + " "
        });
        t.parent().removeClass("open");
        n.removeClass(r);
        n.addClass($(this).attr("rel"))
    })
}

function clearDemo() {
    if (confirm("是否删除组件标签？")) {
        //获取删除的组件名称
        $(".visual-right").find('.view .tagname').each(function () {
            var modulesname= $(this).html();
            var str = /({|#\[#)tag_(modules_shop_category|modules_shop_content|buymodules_shop_category|buymodules_shop_content|buymodules_content|modules_content|buymodules_category|modules_category)_(.*?)_(.*?)_(.*?)(}|#]#)/g;
            modulesname=modulesname.match(str);
            if (modulesname!="" && modulesname!=null){
                //删除组件配置
                $.post(deletemoduletag_url,{"modulesname":modulesname[0]},function(res){});
            }

        });

        $(".visual-right").empty();
        oldvisual=$("#visual-right").html();
        layouthistory = null;
        if (supportstorage())
            localStorage.removeItem("layoutdata");

    }

}

function removeMenuClasses() {
    $("#menu-layoutit li button").removeClass("active")
}

function changeStructure(e, t) {
    $("#download-layout ." + e).removeClass(e).addClass(t)
}

function cleanHtml(e) {
    $(e).parent().append($(e).children().html())
}

function downloadLayoutSrc() {
    formatSrc = getLayoutSrc();
    $("#download-layout").html(formatSrc);
    $("#downloadModal textarea").empty();
    $("#downloadModal textarea").val(formatSrc)
}

function undoLayout() {
    var data = layouthistory;
    //console.log(data);
    if (data) {
        if (data.count<2) return false;
        window.demoHtml = data.list[data.count-2];
        data.count--;
        $('.visual-right').html(window.demoHtml);
        if (supportstorage()) {
            localStorage.setItem("layoutdata",JSON.stringify(data));
        }
        return true;
    }
    return false;
}

function redoLayout() {
    var data = layouthistory;
    if (data) {
        if (data.list[data.count]) {
            window.demoHtml = data.list[data.count];
            data.count++;
            $('.visual-right').html(window.demoHtml);
            if (supportstorage()) {
                localStorage.setItem("layoutdata",JSON.stringify(data));
            }
            return true;
        }
    }
    return false;
}

function ReplaceAll(str, sptr, sptr1){
    while (str.indexOf(sptr) >= 0){
        str = str.replace(sptr, sptr1);
    }
    return str;
}


function getLayoutSrc() {
    var e = "";
    var visual_right=$(".visual-right").html();
    var reg=/<script[^>]*>.*(?=<\/script>)<\/script>/gi;
    visual_right=visual_right.replace(reg,'');
    $("#download-layout").children().html(visual_right);
    var t = $("#download-layout").children();
    t.find('.view .tagname').each(function(i){
        code = $(this).html();
        code = ReplaceAll(code,'#[#','{');
        code = ReplaceAll(code,'#]#','}');
        $(this).html(code);
    });
    var ss=t.html();
    t.find('.tag').each(function(i){
        $(this).html($(this).find('.tagname').html());
    });
    t.find('.view .nav').each(function(i){
        $(this).replaceWith("{"+$(this).attr('rel')+"}");
    });

    //后台语言
    t.find('.showlangadmin').each(function(i){
        code = $(this).data("lang_name");
        code="{langadmin_"+code+"}";
        $(this).removeAttr("data-lang_name");
        $(this).removeClass("showlangadmin");
        $(this).html(code);
    });
    //前台语言
    t.find('.showlang').each(function(i){
        code = $(this).data("lang_name");
        code="{langtemplate_"+code+"}";
        $(this).removeAttr("data-lang_name");
        $(this).removeClass("showlang");
        $(this).html(code);
    });
    //get方法
    t.find('.showgetread').each(function(i){
        code = $(this).data("getread");
        code="{getread_"+code+"}";
        $(this).removeAttr("data-getread");
        $(this).removeClass("showgetread");
        $(this).html(code);
    });
    //过滤cmseasyedit
    t.find('.cmseasyedit').each(function(i){
        $(this).removeAttr("cmseasy-id");
        $(this).removeAttr("cmseasy-table");
        $(this).removeAttr("cmseasy-field");
        $(this).removeClass("cmseasyedit");
    });

    //源码输入框转换
    t.find('.view .visua-code-show').each(function(i){
        code = $(this).siblings('.visua-code').html();
        $(this).siblings('.visua-code').remove();
        $(this).replaceWith(code);
    });

    t.find('.view .custtag').each(function(i){
        $(this).replaceWith("{"+$(this).attr('rel')+"}");
    });


    //大括号转码
    t.find('.view .viewarea').each(function(i){
        code = $(this).siblings('.codearea').html();
        code = ReplaceAll(code,'#[#','{');
        code = ReplaceAll(code,'#]#','}');
        $(this).siblings('.codearea').remove();
        $(this).replaceWith(code);
    });

    t.find(".preview, .configuration, .drag, .remove,.edit").remove();
    t.find("var.selected").remove();
    t.find(".lyrow").addClass("removeClean");
    /* t.find(".box-element").addClass("removeClean");*/
    t.find(".element-box").addClass("removeClean");
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".lyrow .removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".removeClean").each(function() {
        cleanHtml(this)
    });
    t.find(".removeClean").remove();
    $("#download-layout .column").removeClass("ui-sortable");
    $("#download-layout .row-fluid").removeClass("clearfix").children().removeClass("column");
    if ($("#download-layout .container").length > 0) {
        changeStructure("row-fluid", "row")
    }
    //console.log($("#download-layout").html());
    formatSrc = $.htmlClean($("#download-layout").html(), {
        format: true,
        allowedAttributes: [["id"], ["preload"],["target"],["width"],["height"],["style"],["face"],["src"],["autoplay"],["controls"],['color'],['size'],["class"], ["data-toggle"], ["data-target"], ["data-parent"], ["role"], ["data-dismiss"], ["data-icomoon"],["aria-labelledby"], ["aria-hidden"], ["data-slide-to"], ["data-slide"],["data-src"],["data-sub-html"],["data-ride"],["data-sub-html"],["role"],["aria-hidden"],["onerror"],["href"],["center"],["aria-expanded"],["script"],["link"],["rel"],["placeholder"],["onfocus"],["onblur"],["onclick"]]
    });
    formatSrc = formatSrc.replace(/\(&quot;/g,"('");
    formatSrc = formatSrc.replace(/&quot;\)/g,"')");
    return formatSrc;
}

function getLayoutSrcTwo() {
    var e = "";
    var visual_right=$(".visual-right").html();
    var reg=/<script[^>]*>.*(?=<\/script>)<\/script>/gi;
    visual_right=visual_right.replace(reg,'');
    $("#download-layout").children().html(visual_right);
    var t = $("#download-layout").children();
    //大括号转码
    t.find('.view .viewarea').each(function(i){
        code = $(this).siblings('.codearea').html();
        code = ReplaceAll(code,'#[#','{');
        code = ReplaceAll(code,'#]#','}');
        $(this).html(code);
    });
    //大括号转码
    t.find('.view .codearea').each(function(i){
        code = $(this).html();
        code = ReplaceAll(code,'{','#[#');
        code = ReplaceAll(code,'}','#]#');
        $(this).html(code);
    });
    //后台语言
    t.find('.showlangadmin').each(function(i){
        code = $(this).data("lang_name");
        code="{langadmin_"+code+"}";
        $(this).removeAttr("data-lang_name");
        $(this).removeClass("showlangadmin");
        $(this).html(code);
    });
    //前台语言
    t.find('.showlang').each(function(i){
        code = $(this).data("lang_name");
        code="{langtemplate_"+code+"}";
        $(this).removeAttr("data-lang_name");
        $(this).removeClass("showlang");
        $(this).html(code);
    });
    //get方法
    t.find('.showgetread').each(function(i){
        code = $(this).data("getread");
        code="{getread_"+code+"}";
        $(this).removeAttr("data-getread");
        $(this).removeClass("showgetread");
        $(this).html(code);
    });


    t.find('.tag').each(function(i){
        var tagnamecode=$(this).find('.tagname').html();
        if (tagnamecode!="" && tagnamecode!=undefined ){
            tagnamecode=ReplaceAll(tagnamecode,'{','#[#');
            tagnamecode=ReplaceAll(tagnamecode,'}','#]#');
            tagnamecode='<span class="removeClean tagname">'+tagnamecode+'</span>';
            var code=$(this).find('.tagname').html();
            tagnamecode=ReplaceAll(tagnamecode,'#[#','{');
            tagnamecode=ReplaceAll(tagnamecode,'#]#','}');
            $(this).html(tagnamecode+code);
        }
    });

    t.find('.tag').each(function(i){
        var tagnamecode=$(this).find('.tagname').html();
        if (tagnamecode!="" && tagnamecode!=undefined ) {
            tagnamecode = ReplaceAll(tagnamecode, '{', '#[#');
            tagnamecode = ReplaceAll(tagnamecode, '}', '#]#');
            tagnamecode = '<span class="removeClean tagname">' + tagnamecode + '</span>';
            var code = $(this).find('.tagname').html();
            $(this).html(tagnamecode + code);
        }
    });

    t.find('.view .viewarea').each(function(i){
        code = $(this).siblings('.codearea').html();
        code = ReplaceAll(code,'#[#','{');
        code = ReplaceAll(code,'#]#','}');
        $(this).html(code);
    });

    formatSrc =$("#download-layout").children().html();
    formatSrc = formatSrc.replace(/\(&quot;/g,"('");
    formatSrc = formatSrc.replace(/&quot;\)/g,"')");
    return formatSrc;
}


var currentDocument = null;
var timerSave = 2e3;
var stopsave = 0;
var startdrag = 0;
var demoHtml = $(".visual-right").html();


$(window).resize(function() {
    $("body").css("min-height", $(window).height() - 90);
    $(".visual-right").css("min-height", $(window).height() - 160)
});

//清空规则
function restoreData(){
    return false;
    if (supportstorage()) {
        layouthistory = JSON.parse(localStorage.getItem("layoutdata"));
        if (!layouthistory) return false;
        window.demoHtml = layouthistory.list[layouthistory.count-1];
        if (window.demoHtml) $(".visual-right").html(window.demoHtml);
    }

}
//判断框颜色   空框加上颜色  右侧拖拽功能
/*
function setbackcolor2(){

    $("#visual-right .lyrow .view .ui-sortable").each(function(j){
        if($(this).find(".element-box").length>0){
            $(this).removeAttr('style');
        }else{
            $(this).css({
                "background-color":"rgb(250, 255, 189,  0.5)",
                "min-height":"40px"
            });
        }
    });
    // container-fluid-box 不能拖入  container-box
    $(".container-fluid-box").each(function(j,e){
        //全屏不能拖入全屏
        if( $(this).find(".container-fluid-box").length>0){
            //全屏不能拖入全屏
            $(this).find(".container-fluid-box").remove();
            //全屏 不能拖入宽屏
            $(this).find(".container-box").remove();
           /!* stopsave++;
            if (undoLayout()) initContainer();
            stopsave--;*!/
        }
    });
    $(".container-box").each(function(j,e){
        //宽屏 不能拖入全屏  //宽屏 不能拖入宽屏
        if( $(this).find(".container-fluid-box").length>0 || $(this).find(".container-box").length>0){
              //宽屏 不能拖入全屏
            $(this).find(".container-fluid-box").remove();
             //宽屏 不能拖入宽屏
             $(this).find(".container-box").remove();
          /!*  stopsave++;
            if (undoLayout()) initContainer();
            stopsave--;*!/
        }
    });
    oldvisual=$(".visual-right").html();
}
*/

/*拖动规则*/
var nosortable=false;
var ritghnosortable=false;
var nosortablepublicvisual;
var nosortablepublicnext;
var nosortablepublicprev;
var nosortablepublicparent;
function initContainer(){
    $(".visual-right,.visual-right .column").sortable({
        connectWith: ".visual-right .column",
        opacity: 1,
        handle: ".drag",
        start: function(e,t) {
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        change: function(e, t) {
            //在指定的地方 增加上下箭头
            /*$('.ui-sortable-placeholder').before("<div class=\"ui-sortable-helper-arrow-bottom\">\n" +
                    "        <span class=\"arrow arrow-down\"></span>\n" +
                    "    </div>\n"); */
            checkcopyui();
        },
        beforeStop: function(e,t) {
            publicprev=$(".ui-sortable-helper-arrow-bottom").prev();  //获取上一个节点
            publicnext=$(".ui-sortable-helper-arrow-bottom").next().next().next();  //获取下一个
            //拖动结束 先删 上下箭头
            publicparent=$(".ui-sortable-helper-arrow-bottom").parent();  //获取父级
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
        },
        stop: function(e,t) {
            if(stopsave>0) stopsave--;
            startdrag = 0;
            //如果在非法位置 则移动到下面
            if(nosortable){
                var copyui;
                if (nosortablepublicnext.length>0){
                    copyui=nosortablepublicnext.prev();
                    $('[name=copyui]').after(copyui.clone());
                    nosortablepublicnext.prev().remove();
                    copyui.remove();
                }
                else if (nosortablepublicprev.length>0){
                    copyui=nosortablepublicprev.next();
                    $('[name=copyui]').after(copyui.clone());
                    nosortablepublicprev.next().remove();
                    copyui.remove();
                }
                else if (nosortablepublicparent.length>0){
                    copyui=nosortablepublicparent.html();
                    $('[name=copyui]').after(copyui);
                    nosortablepublicparent.html("");
                }
                $('[name=copyui]').remove();
            }
            /*公用校验
             if (jkpublic()){
                 $(".visual-right").html(oldvisual);
             }else{*/
            setbackcolorl(); //判断框颜色  判断宽屏和全屏  还原
            oldvisual=$(".visual-right").html();
            /*}*/
        }
    });
    configurationElm();
}
//拖出 弹出框和节点获取
var publicalert=false;
var publicprev;
var publicnext;
var publicparent;
function alerttag(targethtml) {
    $('.page-loading').attr("style","display: block;");
    var str = /({|#\[#)tag_(buymodules|modules|sections)_(slide|shop_category|shop_content|shop_category|shop_content|guestbook|comment|content|content|category|category|commoncss|shop_commoncss|commoncss|shop_commoncss|special|shop_special|type|shop_type)_(.*?)_(.*?)_(.*?)(}|#]#)/g;
    var sectionsstr = /({|#\[#)tag_(sections)_(announ|slide|content|content|category|category|commoncss|commoncss|comment|guestbook|special|type|common)_(.*?)_(.*?)(}|#]#)/g;
    var targethtmldata=targethtml.match(str);
    var targetsectionshtmldata=targethtml.match(sectionsstr);
    if (targethtmldata==null){
        targethtmldata=targetsectionshtmldata;
    }
    if(targethtmldata!=null){
        if (targethtmldata.length>0){
            //增加条件
            publicalert=true;
            var visual_right=$(".visual-right").html();
            visual_right= ReplaceAll(visual_right,'#[#','{');
            visual_right = ReplaceAll(visual_right,'#]#','}');
            var tagnum=tagpatch(visual_right,targethtmldata[0]);
            tagnum=2;  //大于1 则会新增 新版本固定新增
            var slide = new RegExp('_slide');
            //边栏收缩
            if ($("#visual-left-btn").hasClass('closed')) {
                $('.visual-left').animate({left: '-280px'});
                $("#visual-left-btn").removeClass('closed');
                $('#visual-right').animate({'margin-left': '0px'});
                $('#visual-top').animate({'margin-left': '0px'});
                $('#visual-bottom').animate({'margin-left': '0px'});
                $('#visual-left-btn').animate({left: '50px'});
            }
            var isslide=false;
            for (var i = 0; i < targethtmldata.length; i++) {
                if(slide.test(targethtmldata[i])){
                    isslide=true;
                }
            }
            $.ajaxSettings.async = false;
            $.post(template_gettag, {'tag': targethtmldata,"num":targethtmldata.length,"inserttag":tagnum}, function (res) {
                var iscategory=false;
                var isshopcategory=false;
                var istype=false;
                var isshoptype=false;
                var isshopspecial=false;
                var isspecial=false;
                var iscontent=false;
                var isshopcontent=false;
                var iscommoncss=false;
                var isshopcommoncss=false;
                for (var i = 0; i < res.length; i++) {
                    if(res[i].tagfrom=="commoncss"){
                        iscommoncss=true;
                    }
                    else  if(res[i].tagfrom=="shopcommoncss"){
                        isshopcommoncss=true;
                    }
                    else  if(res[i].tagfrom=="shopcategory"){
                        isshopcategory=true;
                    }
                    else  if(res[i].tagfrom=="shopcontent"){
                        isshopcontent=true;
                    }
                    else  if(res[i].tagfrom=="shoptype"){
                        isshoptype=true;
                    }
                    else  if(res[i].tagfrom=="shopspecial"){
                        isshopspecial=true;
                    }
                    else  if(res[i].tagfrom=="category"){
                        iscategory=true;
                    }
                    else  if(res[i].tagfrom=="content"){
                        iscontent=true;
                    }
                    else  if(res[i].tagfrom=="type"){
                        istype=true;
                    }
                    else  if(res[i].tagfrom=="special"){
                        isspecial=true;
                    }
                }

                $('.page-loading').attr("style","display: none;");
                if (isslide) {
                    slide_list(res[0]['slidename'],res[0]);
                    //打开弹出框
                    $('#template-slide').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if((iscategory && iscommoncss) || (iscontent && iscategory) || (iscontent && iscommoncss)) {
                    //混合模式  //弹出框的导航栏增加
                    tabslist(res,'mixing');
                    //生成栏目弹出框的  动态内容
                    mixinghtml(res);
                    $('#template-mixing-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-mixing-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if((isshopcategory && isshopcommoncss) || (isshopcontent && isshopcommoncss)|| (isshopcontent && isshopcategory)) {   //商品混合模式
                    //弹出框的导航栏增加
                    tabslist(res,'shopmixing');
                    //生成栏目弹出框的  动态内容
                    shopmixinghtml(res);
                    $('#template-mixing-shop-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-mixing-shop-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if (iscommoncss) {
                    //弹出框的导航栏增加
                    tabslist(res,'commoncss');
                    //生成栏目弹出框的  动态内容
                    commoncsshtml(res);
                    $('#template-commoncss-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-commoncss-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(isshopcommoncss) {
                    //弹出框的导航栏增加
                    tabslist(res,'shopcommoncss');
                    //生成栏目弹出框的  动态内容
                    shopcommoncsshtml(res);
                    $('#template-commoncss-shop-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-commoncss-shop-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(isshopcategory) {
                    //弹出框的导航栏增加
                    tabslist(res,'shopcategory');
                    //生成栏目弹出框的  动态内容
                    shopcategoryhtml(res);
                    $('#template-category-shop-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-category-shop-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(isshopcontent) {
                    //弹出框的导航栏增加
                    tabslist(res,'shopcontent');
                    //生成栏目弹出框的  动态内容
                    shopcontenthtml(res);
                    $('#template-content-shop-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-content-shop-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(isshoptype) {
                    //弹出框的导航栏增加
                    tabslist(res,'shoptype');
                    //生成栏目弹出框的  动态内容
                    shoptypethtml(res);
                    $('#template-type-shop-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-type-shop-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(isshopspecial) {
                    //弹出框的导航栏增加
                    tabslist(res,'shopspecial');
                    //生成专题弹出框的  动态内容
                    shopspecialhtml(res);
                    $('#template-special-shop-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-special-shop-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(iscategory) {
                    //弹出框的导航栏增加
                    tabslist(res,'category');
                    //生成栏目弹出框的  动态内容
                    categoryhtml(res);
                    $('#template-category-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-category-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(iscontent) {
                    //弹出框的导航栏增加
                    tabslist(res,'content');
                    //生成栏目弹出框的  动态内容
                    contenthtml(res);
                    $('#template-content-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-content-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(istype) {
                    //弹出框的导航栏增加
                    tabslist(res,'type');
                    //生成栏目弹出框的  动态内容
                    typehtml(res);
                    $('#template-type-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-type-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                else if(isspecial) {
                    //弹出框的导航栏增加
                    tabslist(res,'special');
                    //生成栏目弹出框的  动态内容
                    specialhtml(res);
                    $('#template-special-tag').removeClass("modal-right");
                    //打开弹出框
                    $('#template-special-tag').modal({
                        backdrop: 'static',//点击空白处不关闭
                        keyboard: false,//按下ESC时不关闭
                        show: true//默认不显示
                    });
                }
                cmseasyedit();
            }, 'json');

        }
    }
}

//返回出现次数
function tagpatch(s, re) {
    re = eval("/" + re + "/ig")
    return s.match(re) ? s.match(re).length : 0;
}
//生成混合弹出框的  动态内容
function  mixinghtml(res){
    if (res!=""){
        $.post(template_getmixing, {'mixingconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=mixing_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成混合商品弹出框的  动态内容
function  shopmixinghtml(res){
    if (res!=""){
        $.post(template_getshopmixing, {'mixingconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=shop_mixing_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成栏目弹出框的  动态内容
function  categoryhtml(res){
    if (res!=""){
        $.post(template_getcategory, {'categroyconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=category_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成商品栏目弹出框的  动态内容
function  shopcategoryhtml(res){
    if (res!=""){
        $.post(template_getshopcategory, {'categroyconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=shop_category_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成分类弹出框的  动态内容
function  typehtml(res){
    if (res!=""){
        $.post(template_gettype, {'typeconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=type_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成专题弹出框的  动态内容
function  specialhtml(res){
    if (res!=""){
        $.post(template_getspecial, {'specialconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=special_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成商品栏目弹出框的  动态内容
function  shopspecialhtml(res){
    if (res!=""){
        $.post(template_getshopspecial, {'specialconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=shop_special_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成商品栏目弹出框的  动态内容
function  shoptypethtml(res){
    if (res!=""){
        $.post(template_getshoptype, {'typeconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=shop_type_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}

//生成内容弹出框的  动态内容
function  contenthtml(res){
    if (res!=""){
        $.post(template_getcontent, {'contentconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=content_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成css弹出框的  动态内容
function  commoncsshtml(res,isliststyle){
    if (res!=""){
        $.post(template_getcommoncss, {'commoncssconfig': res,"isliststyle":isliststyle}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=commoncss_modal_show]").html(showhtml);
            commoncssstagimg();
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成css弹出框的  动态内容
function  shopcommoncsshtml(res){
    if (res!=""){
        $.post(template_getshopcommoncss, {'commoncssconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=shop_commoncss_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成商品内容弹出框的  动态内容
function  shopcontenthtml(res){
    if (res!=""){
        $.post(template_getshopcontent, {'contentconfig': res}, function (showhtml) {
            showhtml=JSON.parse(showhtml);
            $("[name=shop_content_modal_show]").html(showhtml);
            $("[name='template_lading']").attr("style","display: none;");
        });
    }
}
//生成导航
function  tabslist(res,tabletype,isliststyle) {
    if (res!=""){
        var tabshtml="";
        for(var i=0;i<res.length;i++){
            if (res[i].hasOwnProperty('listtemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-listtemplate'";
                if(!isliststyle){
                    tabshtml+=" class='active'>";
                }else{
                    tabshtml+=" >";
                }
                tabshtml+="<a href='#tag-show-listtemplate'  aria-controls='tag-show-listtemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('annountemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-annountemplate'";
                if(!isliststyle){
                    tabshtml+=" class='active'>";
                }else{
                    tabshtml+=" >";
                }
                tabshtml+="<a href='#tag-show-annountemplate'  aria-controls='tag-show-annountemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('commentagtemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-commentagtemplate'";
                if(!isliststyle){
                    tabshtml+=" class='active'>";
                }else{
                    tabshtml+=" >";
                }
                tabshtml+="<a href='#tag-show-commentagtemplate'  aria-controls='tag-show-commentagtemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('typetemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-typetemplate'"
                if(!isliststyle){
                    tabshtml+=" class='active'>";
                }else{
                    tabshtml+=" >";
                };
                tabshtml+="<a href='#tag-show-typetemplate'  aria-controls='tag-show-typetemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('specialtemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-specialtemplate'";
                if(!isliststyle){
                    tabshtml+=" class='active'>";
                }else{
                    tabshtml+=" >";
                }
                tabshtml+="<a href='#tag-show-specialtemplate'  aria-controls='tag-show-specialtemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('guestbooktemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-guestbooktemplate'";
                if(!isliststyle){
                    tabshtml+=" class='active'>";
                }else{
                    tabshtml+=" >";
                }
                tabshtml+="<a href='#tag-show-guestbooktemplate'  aria-controls='tag-show-guestbooktemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            if (i==0 && (isliststyle || ((!res[i].hasOwnProperty('listtemplate')) && (!res[i].hasOwnProperty('annountemplate'))
                && (!res[i].hasOwnProperty('commentagtemplate')) && (!res[i].hasOwnProperty('typetemplate'))
                && (!res[i].hasOwnProperty('specialtemplate')) && (!res[i].hasOwnProperty('guestbooktemplate')))) ){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-"+res[i].id+"' class='active'>";
            }else{
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-"+res[i].id+"' >";
            }
            tabshtml+="<a href='#tag-show-"+res[i].id+"'  aria-controls='tag-show-"+res[i].id+"' role='tab' data-toggle='tab'>";
            tabshtml+=res[i].title+"</a>";
            tabshtml+="</li>";

            if (res[i].hasOwnProperty('fields')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-fields'>";
                tabshtml+="<a href='#tag-show-fields'  aria-controls='tag-show-fields' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            tabshtml+="<input type='hidden' name='tag-tabid-"+tabletype+"' value='"+res[i].id+"'>";

        }
        $("[name=navigation_modal_tabs_"+tabletype+"]").html(tabshtml);
    }
}
//生成config导航
function  tabsconfiglist(res,tabletype) {
    if (res!=""){
        var tabshtml="";
        for(var i=0;i<res.length;i++){
            if (res[i].hasOwnProperty('listtemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-listtemplate' class='active'>";
                tabshtml+="<a href='#tag-show-listtemplate'  aria-controls='tag-show-listtemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('annountemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-annountemplate' class='active'>";
                tabshtml+="<a href='#tag-show-annountemplate'  aria-controls='tag-show-annountemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('commentagtemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-commentagtemplate' class='active'>";
                tabshtml+="<a href='#tag-show-commentagtemplate'  aria-controls='tag-show-commentagtemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('typetemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-typetemplate' class='active'>";
                tabshtml+="<a href='#tag-show-typetemplate'  aria-controls='tag-show-typetemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('specialtemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-specialtemplate' class='active'>";
                tabshtml+="<a href='#tag-show-specialtemplate'  aria-controls='tag-show-specialtemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            else if (res[i].hasOwnProperty('guestbooktemplate')){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-guestbooktemplate' class='active'>";
                tabshtml+="<a href='#tag-show-guestbooktemplate'  aria-controls='tag-show-guestbooktemplate' role='tab' data-toggle='tab'>";
                tabshtml+=res[i].selecttitle+"</a>";
                tabshtml+="</li>";
            }
            if (i==0 && (!res[i].hasOwnProperty('listtemplate')) && (!res[i].hasOwnProperty('annountemplate'))
                && (!res[i].hasOwnProperty('commentagtemplate')) && (!res[i].hasOwnProperty('typetemplate'))
                && (!res[i].hasOwnProperty('specialtemplate')) && (!res[i].hasOwnProperty('guestbooktemplate'))){
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-"+i+"' class='active'>";
            }else{
                tabshtml+="<li role='presentation' name='tab-li' id='tab-li-"+i+"' >";
            }
            tabshtml+="<a href='#tag-show-"+i+"'  aria-controls='tag-show-"+i+"' role='tab' data-toggle='tab'>";
            tabshtml+=res[i]+"</a>";
            tabshtml+="</li>";
            tabshtml+="<input type='hidden' name='tag-tabid-"+tabletype+"' value='"+i+"'>";
        }
        $("[name=navigation_modal_tabs_"+tabletype+"]").html(tabshtml);
    }
}
//判断框颜色   空框加上颜色
function setbackcolorl(){
    $("#visual-right .column").each(function(j){
        if($(this).find("div,a,p,span,li,ul,dl,dt,dd,h1,h2,h3,h4,h5,h6,em,i").length>0){
            $(this).removeAttr('style');

        }else{
            $(this).css({
                "background-color":"rgb(250, 255, 189,  0.5)",
                "min-height":"40px",
                "outline":"1px dotted #0084d8"
            });

        }
    });
    oldvisual=$(".visual-right").html();
}
//保存判断框颜色   去掉全部颜色
function savebackcolorl(){
    $("#visual-right .ui-sortable").each(function(j){
        $(this).removeAttr('style');
    });
}

//可视化编辑区域刷新
function  refreshrigt(url){
    if (url!=""){
        $.post(url,{"refreshrigt":true}, function (showhtml) {
            $("#visual-right").html(showhtml);
            ready_all();
            setbackcolorl();
        });
    }
}

//拖入规则
var oldvisual=null;  //还原的页面
$(document).ready(function() {
    visual_init();  //提取加载方法
    setbackcolorl();  //判断框颜色
    oldvisual=$("#visual-right").html(); //先加载
    langClass();//lang文字处理
});

//判断宽屏和全屏,grid-box   公用校验
function jkpublic () {
    var modulesstate=false;

    $(".visual-right .container-fluid-box").each(function(j,e){
        /* 全屏里面不能拖入全屏 */
        if ($(this).find(".container-fluid-box").length>0) {
            modulesstate=true;
        }
    });
    $(".visual-right .container-box").each(function(j,e){
        /* 宽屏里面不能拖入宽屏和全屏*/
        if ( $(this).find(".container-box").length>0 || $(this).find(".container-fluid-box").length>0) {
            modulesstate=true;
        }
    });
    $(".visual-right .grid-box").each(function(j,e){
        //全屏， 宽屏 grid-box 不能插入grid-box
        if ($(this).find(".container-box").length>0 ||  $(this).find(".container-fluid-box").length>0
            || ($(this).parents('.container-box').length==0 && $(this).parents('.container-fluid-box').length==0
                && $(this).attr("style")!="display: none;")){
            modulesstate=true;
        }
    });

    $(".visual-right .container-fluid").each(function(j,e){
        // 全屏 不能拖入 container-fluid
        if ($(this).find(".container-fluid").length>0 ){
            modulesstate=true;
        }
    });
    return modulesstate;
}

function checkcopyui(){
    //先删原来的上下箭头
    $('.ui-sortable-helper-arrow-bottom').remove();

    if ($.trim(oldvisual)==""){
        $('[name=copyui]').remove();
        $('.ui-sortable-helper-arrow-bottom').remove();
        nosortablepublicvisual=true;
        $("#visual-right").append("<div name='copyui'></div>");
        $('[name=copyui]').before("<div class=\"ui-sortable-helper-arrow-bottom\">\n" +
            "        <span class=\"arrow arrow-down\"></span>\n" +
            "    </div>\n");
    }
    else if (jkpublic()){
        nosortablepublicvisual=false;
        $('[name=copyui]').remove();
        var parentsDiyi=$('.ui-sortable-placeholder').parents('.view');
        $(parentsDiyi[(parentsDiyi.length-1)]).parent().after("<div name='copyui'></div>");
        $('[name=copyui]').before("<div class=\"ui-sortable-helper-arrow-bottom\">\n" +
            "        <span class=\"arrow arrow-down\"></span>\n" +
            "    </div>\n");
        nosortable=true;
    }
    else{
        nosortablepublicvisual=false;
        nosortable=false;
        $('.ui-sortable-placeholder').before("<div class=\"ui-sortable-helper-arrow-bottom\">\n" +
            "        <span class=\"arrow arrow-down\"></span>\n" +
            "    </div>\n");
    }

    nosortablepublicnext=$(".ui-sortable-placeholder").next();  //获取下一个
    nosortablepublicprev=$(".ui-sortable-placeholder").prev();  //获取上一个
    nosortablepublicparent=$(".ui-sortable-placeholder").parent();  //获取父级
}

function visual_init(){
    restoreData();
    $("body").css("min-height", $(window).height() - 90);
    $(".visual-right").css("min-height", $(window).height() - 160);
    $(".visual-right, .visual-right .column").sortable({
        connectWith: ".column",
        opacity: .35,
        handle: ".drag",
        cursor: 'move',
        tolerance: "pointer"
    });
    //布局拖入规则
    //全屏宽屏拖入规则
    $(".visual-left #tab_3 .lyrow").draggable({
        connectToSortable: ".visual-right",
        helper: "clone",
        handle: ".drag",
        start: function(e,t) {
            handleJsClass(e,t);
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        drag: function(e, t) {
            checkcopyui();
            t.helper.width(400);
        },
        stop: function(e, t) {
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
            $(".visual-right .column").sortable({
                opacity: .35,
                connectWith: ".column",
                start: function(e,t) {
                    if (!startdrag) stopsave++;
                    startdrag = 1;
                },
                stop: function(e,t) {
                    if(stopsave>0) stopsave--;
                    startdrag = 0;
                }
            });
            if(stopsave>0) stopsave--;
            startdrag = 0;
            setbackcolorl(); //判断框颜色  判断宽屏和全屏  还原
            //$(e.toElement).css("background","red");   拖入的位置节点
            cmseasyedit();
            cmseasyeditimg();
        }
    });
    //分栏拖入规则
    $(".visual-left #tab_3 .grid-box").draggable({
        connectToSortable: ".visual-right .column",
        helper: "clone",
        handle: ".drag",
        start: function(e,t) {
            handleJsClass(e,t);
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        drag: function(e, t) {
            checkcopyui();
            t.helper.width(400);
        },
        stop: function(e, t) {
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
            $(".visual-right .column").sortable({
                opacity: .35,
                connectWith: ".column",
                start: function(e,t) {
                    if (!startdrag) stopsave++;
                    startdrag = 1;
                },
                stop: function(e,t) {
                    if(stopsave>0) stopsave--;
                    startdrag = 0;
                }
            });
            if(stopsave>0) stopsave--;
            startdrag = 0;
            setbackcolorl(); //判断框颜色  判断宽屏和全屏  还原
            //$(e.toElement).css("background","red");   拖入的位置节点
        }
    });
    //模块拖入规则
    $(".visual-left #tab_2 .element-box ").draggable({
        connectToSortable: ".visual-right .column",
        helper: "clone",
        handle: ".drag",
        start: function(e,t) {
            handleJsClass(e,t);
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        drag: function(e, t) {
            checkcopyui();
            t.helper.width(125);
            /* $(t.helper[0]).html("<div class=\"ui-sortable-helper-arrow-top\">\n" +
                 "        <span class=\"arrow arrow-up\"></span>\n" +
                 "    </div>\n" +
                 "    <div class=\"ui-sortable-helper-arrow-bottom\">\n" +
                 "        <span class=\"arrow arrow-down\"></span>\n" +
                 "    </div>\n");*/
        },
        stop: function(e, t) {
            alerttag(e.target.innerHTML);  //弹出框编辑标签
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
            handleJsIds();
            if(stopsave>0) stopsave--;
            startdrag = 0;
            setbackcolorl(); //判断框颜色  判断宽屏和全屏  还原
            cmseasyedit();//加载悬浮
        }
    });
    //组件拖入规则
    $(".visual-left #tab_1 .lyrow").draggable({
        connectToSortable: ".visual-right",
        helper: "clone",
        handle: ".drag",
        start: function(e,t) {
            handleJsClass(e,t);
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        drag: function(e, t) {
            checkcopyui();
            t.helper.width(239);
        },
        stop: function(e,t) {
            alerttag(e.target.innerHTML);  //弹出框编辑标签
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
            handleJsIds();
            if(stopsave>0) stopsave--;
            startdrag = 0;
            setbackcolorl();  //判断框颜色

        }
    });
    //组件小版块拖入规则
    $(".visual-left #tab_1 .element-box").draggable({
        connectToSortable: ".visual-right .column",
        helper: "clone",
        handle: ".drag",
        start: function(e,t) {
            handleJsClass(e,t);
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        drag: function(e, t) {
            checkcopyui();
            t.helper.width(239);
        },
        stop: function(e,t) {
            alerttag(e.target.innerHTML);  //弹出框编辑标签
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
            handleJsIds();
            if(stopsave>0) stopsave--;
            startdrag = 0;
            setbackcolorl();  //判断框颜色

        }
    });
    //购买组件拖入规则
    $(".visual-left #tab_4 .lyrow").draggable({
        connectToSortable: ".visual-right",
        helper: "clone",
        handle: ".drag",
        start: function(e,t) {
            handleJsClass(e,t);
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        drag: function(e, t) {
            checkcopyui();
            t.helper.width(239)
        },
        stop: function(e,t) {
            alerttag(e.target.innerHTML);  //弹出框编辑标签
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
            handleJsIds();
            if(stopsave>0) stopsave--;
            startdrag = 0;
            setbackcolorl();  //判断框颜色
        }
    });
    //购买组件小版块拖入规则
    $(".visual-left #tab_4 .element-box").draggable({
        connectToSortable: ".visual-right .column",
        helper: "clone",
        handle: ".drag",
        start: function(e,t) {
            handleJsClass(e,t);
            if (!startdrag) stopsave++;
            startdrag = 1;
        },
        drag: function(e, t) {
            checkcopyui();
            t.helper.width(239)
        },
        stop: function(e,t) {
            alerttag(e.target.innerHTML);  //弹出框编辑标签
            //拖动结束 先删 上下箭头
            $('.ui-sortable-helper-arrow-bottom').remove();
            handleJsIds();
            if(stopsave>0) stopsave--;
            startdrag = 0;
            setbackcolorl();  //判断框颜色
        }
    });
    initContainer();


    $("[data-target='#downloadModal']").click(function(e) {
        e.preventDefault();
        downloadLayoutSrc()
    });
    $("#download").click(function() {
        downloadLayout();
        return false
    });
    $("#downloadhtml").click(function() {
        downloadHtmlLayout();
        return false
    });
    $("#edit").click(function() {
        $("body").removeClass("devpreview sourcepreview");
        $("body").addClass("edit");
        removeMenuClasses();
        $(this).addClass("active");
        return false
    });
    $("#clear").unbind("click").click(function(e) {
        e.preventDefault();
        clearDemo()
    });
    $("#devpreview").click(function() {
        $("body").removeClass("edit sourcepreview");
        $("body").addClass("devpreview");
        removeMenuClasses();
        $(this).addClass("active");
        return false
    });
    $("#sourcepreview").click(function() {
        $("body").removeClass("edit");
        $("body").addClass("devpreview sourcepreview");
        removeMenuClasses();
        $(this).addClass("active");
        return false
    });
    $(".nav-header").click(function() {
        $(".visual-left .boxes, .visual-left .rows").hide();
        $(this).next().slideDown()
    });
    //removeElm();
    //console.log('2222');
    configurationElm();
    gridSystemGenerator();
    setInterval(function() {handleSaveLayout1()}, timerSave);

    $('#undo').click(function(){
        stopsave++;
        //console.log(stopsave);
        if (undoLayout()) initContainer();
        stopsave--;
    });
    $('#redo').click(function(){
        stopsave++;
        if (redoLayout()) initContainer();
        stopsave--;
    });

}


//拖拽保存
function savemodule(formname,id,res,currenteditor) {
    if (!publicalert){
        currenteditor.html(res);
    }else{
        if (nosortablepublicvisual){
            var thishtml=$('#visual-right').html();
            var publictagname=$('#'+formname+id+' .modulesname').val();
            thishtml=thishtml.replace(publictagname,'<div id="publictagname"></div>');
            $('#visual-right').html(thishtml);
            $("#publictagname").parent().parent().html(res);
            oldvisual=$("#visual-right").html();   //记录
        }
        else if (publicprev.length>0) {
            var nextdata=publicprev.next().html();
            var publictagname=$('#'+formname+id+' .modulesname').val();
            nextdata=nextdata.replace(publictagname,'<div id="publictagname"></div>');
            publicprev.next().html(nextdata);
            $("#publictagname").parent().parent().html(res);
            oldvisual=$("#visual-right").html();   //记录
        }else
        if (publicnext.length>0) {
            var nextdata=publicnext.prev().html();
            var publictagname=$('#'+formname+id+' .modulesname').val();
            nextdata=nextdata.replace(publictagname,'<div id="publictagname"></div>');
            publicnext.prev().html(nextdata);
            $("#publictagname").parent().parent().html(res);
            oldvisual=$("#visual-right").html();   //记录
        }
        else  if (publicparent.length>0) {
            var parentdata=publicparent.html();
            var publictagname=$('#'+formname+id+' .modulesname').val();
            parentdata=parentdata.replace(publictagname,'<div id="publictagname"></div>');
            publicparent.html(parentdata);
            $("#publictagname").parent().parent().html(res);
            oldvisual=$("#visual-right").html();   //记录
        }
    }
}

function  closemodules() {
    //关闭  拖出的时候调用   关闭模态框
    $("[name=close]").click(function(e) {
        isoldcategory=false;
        if (publicalert){
            if(nosortablepublicvisual){
                $("#visual-right").html("");
                oldvisual=$("#visual-right").html();
            }
            else if (publicprev.length>0) {
                publicprev.next().remove();
            }else
            if (publicnext.length>0) {
                publicnext.prev().remove();
            }else
            if (publicparent.length>0) {
                publicparent.html('');
                setbackcolorl();
            }
            publicalert=false;  //还原

            //获取删除的组件名称
            $("#template-category-tag [name=newmodulesname]").each(function () {
                var modulesname=$(this).val();
                var _tag_buymodules=new RegExp('tag_buymodules');
                var _tag_modules=new RegExp('tag_modules');
                if(_tag_buymodules.test(modulesname) ||  _tag_modules.test(modulesname) ) {
                    //删除组件配置
                    $.post(deletemoduletag_url, {"modulesname": modulesname}, function (res) {
                    });
                }
            });
            //获取混合组件--删除的组件名称
            $("#template-mixing-tag [name=newmodulesname]").each(function () {
                var modulesname=$(this).val();
                var _tag_buymodules=new RegExp('tag_buymodules');
                var _tag_modules=new RegExp('tag_modules');
                if(_tag_buymodules.test(modulesname) ||  _tag_modules.test(modulesname) ) {
                    //删除组件配置
                    $.post(deletemoduletag_url, {"modulesname": modulesname}, function (res) {
                    });
                }
            });
            //获取幻灯片
            var slidemodulesname=$("#template-slide [name=slidenewmodulesname]").val();
            var _tag_sections=new RegExp('tag_sections');
            if(_tag_sections.test(slidemodulesname)) {
                //删除组件配置
                $.post(deletemoduletag_url, {"modulesname": slidemodulesname}, function (res) {
                });
            }

            var commoncssmodulesname=$("#template-commoncss-tag [name=newmodulesname]").val();
            var _tag_sections=new RegExp('tag_sections');
            if(_tag_sections.test(commoncssmodulesname)) {
                //删除组件配置
                $.post(deletemoduletag_url, {"modulesname": commoncssmodulesname}, function (res) {
                });
            }
        }
    });
}

//lang文字处理
function langClass() {
    $("#visual-left .removelangadmin").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlangadmin");
        $(this).remove();
    });
    $("#visual-left .removelang").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlang");
        $(this).remove();
    });
    $("#visual-right .removelangadmin").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlangadmin");
        $(this).remove();
    });
    $("#visual-right .removelang").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlang");
        $(this).remove();
    });
    $("#visual-bottom .removelangadmin").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlangadmin");
        $(this).remove();
    });
    $("#visual-bottom .removelang").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlang");
        $(this).remove();
    });
    $("#visual-top .removelangadmin").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlangadmin");
        $(this).remove();
    });
    $("#visual-top .removelang").each(function(){
        var lang_name=$(this).html();
        $(this).parent().attr("data-lang_name",lang_name);
        $(this).parent().addClass("showlang");
        $(this).remove();
    });

    //get方法
    $("#visual-left .removegetread").each(function(){
        var getread=$(this).html();
        $(this).parent().attr("data-getread",getread);
        $(this).parent().addClass("showgetread");
        $(this).remove();
    });
    $("#visual-right .removegetread").each(function(){
        var getread=$(this).html();
        $(this).parent().attr("data-getread",getread);
        $(this).parent().addClass("showgetread");
        $(this).remove();
    });
    $("#visual-top .removegetread").each(function(){
        var getread=$(this).html();
        $(this).parent().attr("data-getread",getread);
        $(this).parent().addClass("showgetread");
        $(this).remove();
    });
    $("#visual-bottom .removegetread").each(function(){
        var getread=$(this).html();
        $(this).parent().attr("data-getread",getread);
        $(this).parent().addClass("showgetread");
        $(this).remove();
    });

}