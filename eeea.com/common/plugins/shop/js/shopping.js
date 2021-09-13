//商品价格获取
var shopingtype=new Array();
//商品单价
var orice= 0;
var shopingstatic=true;
var getshopingurl='';

function getshopping(aid,aidurl,myfield,setfieldNameurl,setleixingurl,shopingurl){
	//获取价格  销售量  库存
	/*var url='{url("archive/getarchiveprice/aid/".$archive["aid"])}';*/
	getshopingurl=shopingurl;
	var aidurldata="";
	var localStoragename="aidurl"+aid;
   if (localgetItem(localStoragename)!=null){
	   aidurldata=localgetItem(localStoragename);
   }else{
       archivedata={"shoppingprice":{"oldpricestatic":0}};
   }

   if (archivedata.shoppingprice.oldpricestatic==0) {
	   $.ajax({
		   type: "get",
		   url: aidurl,
		   async: false,
		   success: function (data) {
               localgetItem(localStoragename,data);
			   aidurldata=data;
		   }
	   });
   }
   if (aidurldata!=""){
	   if (aidurldata == '-1') {
		   shopingstatic = false;
		   $("#shop-price").after('<p>商品信息有误,请联系客服！</p>');
	   }
	   var archivedata = JSON.parse(aidurldata);
	   orice = archivedata.shoppingprice.newprice;
	   $(".shop-oldprice").find('span').text(archivedata.shoppingprice.oldprice);
	   if (archivedata.shoppingprice.oldpricestatic == '1') {
		   $("#shop-price").text(orice.toFixed(2));
		   $("#combintshop-price").text(orice.toFixed(2));
		   $("#combinedshopping-price").html(orice.toFixed(2));
		   $(".shop-oldprice").find('span').css({
               "text-decoration":"line-through",
               "color":"#333"
           });
		   $(".shop-oldprice dd").css({"color":"#333","font-size":"18px"});
	   } else {
		   $("#combintshop-price").text(archivedata.shoppingprice.oldprice.toFixed(2));
		   $("#combinedshopping-price").html(archivedata.shoppingprice.oldprice.toFixed(2));
		   $("#shop-price").parent().parent().attr('style', 'display: none');
	   }
	   $("#shop-salesnum").text(archivedata[0].salesnum);
	   if (archivedata[0].inventory <= 0) {
		   $("#shop-inventory").text('库存不足！');
		   $("#shop-inventory").css('color', 'red');
		   $("[name='buy']").attr("style", "background-color:grey;border-color:grey;color: white;");
		   $("[name='buy']").removeAttr('onclick');
		   $("[name='buy']").unbind('click');    //兼容IE 解除onclick事件
		   $("[name='buy']").removeAttr('data-toggle');
	   } else {
		   $("#shop-inventory").text(archivedata[0].inventory);
	   }
   }


	//获取分类
	var dataname=new Array();
	var data=myfield;
	var datanamefield=data.split(",");
	for(var index=0;index<datanamefield.length;index++){
		dataname[index]=datanamefield[index];
	}
	if(dataname.length>0){
		for(var index=0;index<dataname.length;index++){
			var	htmldata='<div class="visual-conent-car-btn">';

			var fieldname=dataname[index];
			htmldata+='<div id="'+fieldname+'" class="shop-type-info"><p></p></div>';

			htmldata+='</div>';
			$('#columntype').append(htmldata);
		}
		//设置名字
		setfieldName(dataname,setfieldNameurl);
		//加载按钮
		setleixing(dataname,setleixingurl,aid);
	}
}

//获取名字
function setfieldName(field,setfieldNameurl){
	setfieldNameurl=setfieldNameurl + '&field=' + field;
	var setfieldNameurldata="";
	var localStoragename="setfieldNameurl"+field.toString().replace(/,/g,'');
	if (localgetItem(localStoragename)!=null){
		setfieldNameurldata=localgetItem(localStoragename);
	}else{
		$.ajax({
			type: "get",
			url: setfieldNameurl,
			async: false,
			success: function (data) {
                localgetItem(localStoragename,data);
				setfieldNameurldata=data;
			}
		});
	}
	if (setfieldNameurldata!="" && setfieldNameurldata!="null"){
		var fieldName=JSON.parse(setfieldNameurldata);
		var fieldNameArray=fieldName.split(",");
		var datanamefield=field.toString().split(",");
		for(var index=0;index<datanamefield.length;index++){
			$('#'+datanamefield[index]).html('<dt>'+fieldNameArray[index]+'</dt>'+'<dd class="shop-type-list"></dd>');
		}
	}
}
//类型加载
function setleixing(field,setleixingurl,aid){

	var url=setleixingurl+'&aid='+aid+'&field='+field;
	var setleixingdata="";
	var localStoragename="setleixing"+field.toString().replace(/,/g,'')+aid;
	if (localgetItem(localStoragename)!=null){
		setleixingdata=localgetItem(localStoragename);
	}else{
		$.ajax({
			type: "get",
			url: url,
			async: false,
			success: function (data) {
                localgetItem(localStoragename,data);
				setleixingdata=data;
			}
		});
	}
	if (setleixingdata!="" && setleixingdata!="null"){
		var archiveData=JSON.parse(setleixingdata);
		for(var index=0;index<archiveData.length;index++){
			if (!archiveData[index]['display']){
				$('#'+archiveData[index]['name']).attr("style","display:none");
			}else{
				if (archiveData[index]['append']!="") {
					for(var i=0;i<archiveData[index]['append'].length;i++){
						if (archiveData[index]['append'][i]['appendhtml']!="") {
							$('#' + archiveData[index]['name']).find('dd.shop-type-list').append(archiveData[index]['append'][i]['appendhtml']);
						}
						if (archiveData[index]['append'][i]['Existstype']) {
							Exists(archiveData[index]['append'][i]['Exists1'],archiveData[index]['append'][i]['Exists2'],archiveData[index]['append'][i]['Exists3']);
						}
					}
				}
			}
		}
	}
}
//校验文件是否存在  插入图片
function Exists(url,butteid,fieldtype) {
	var Existsdata="";
    var localStoragename="setleixing"+url.toString().replace(/\/|\./g,'');
	if (localgetItem(localStoragename)!=null){
		Existsdata=localgetItem(localStoragename);
	}else{
		$.ajax({
			type: "get",
			url: url,
			async: false,
			success: function () {
                localgetItem(localStoragename,1);
				Existsdata=1;
			}
		});
	}
	if (Existsdata!="" && Existsdata==1){
		var htmldata = '<img src=' + url + ' width="30" height="30" alt=' + fieldtype + '>';
		$("#img" + butteid).prepend(htmldata);
	}


}

function  onclickprice(obj,fh,num,buttonname,val,key,imageurl) {
	if(fh == '+'){
		fh='jia';
	}else if(fh == '-'){
		fh='jian';
	}else if(fh == '*'){
		fh='chen';
	}else if(fh == '/'){
		fh='chu';
	}else{
		fh=fh;
	}
	//var orice='{$archive['attr2']}';
	var nocolor=true;    //选中颜色判断
	if(shopingtype.length==0){
		shopingtype[0]=buttonname+','+key+":"+val+","+fh+","+num;
		//图片轮播切换
		setlightgallery(imageurl,val,buttonname);
	}else{
		var ischunzai=true;
		for(var i=0;i<shopingtype.length;i++){
			var savenameArry= new Array(); //定义一数组
			savenameArry=shopingtype[i].split(":"); //字符分割
			savenameArry=savenameArry[0].split(","); //字符分割
			if(savenameArry[0]==buttonname){
				if(key==savenameArry[1]){
					shopingtype.splice(i,1);
                    oldlightgallery[val]="";
					oldlightgallerylode.splice($.inArray(buttonname+","+val,oldlightgallerylode),1);
					nocolor=false;
				}else{
					shopingtype[i]=buttonname+','+key+":"+val+","+fh+","+num;
				}
				ischunzai=false;
			}
		}
		if (ischunzai){
			shopingtype[shopingtype.length]=buttonname+','+key+":"+val+","+fh+","+num;
			//图片轮播切换
			setlightgallery(imageurl,val,buttonname);
		}else if(nocolor){
			//图片轮播切换
			setlightgallery(imageurl,val,buttonname);
		}else{
			//图片轮播还原
			if(shopingtype.length==0 || oldlightgallerylode.length==0){
				$(".shopping-pics").html(oldlightgallery[0]);
				Initializationshopping();
			}else{
				//清空相同类型的
				for(var i=0;i<oldlightgallerylode.length;i++){
					oldlightgallerylodeArry=oldlightgallerylode[i].split(","); //字符分割
					if(buttonname==oldlightgallerylodeArry[0]){
						oldlightgallerylode.splice(i,1);
					}
				}
				$(".shopping-pics-big-item").html(oldlightgallery[oldlightgallerylode[oldlightgallerylode.length-1]]);
			}
		}
	}
	var combinedtype="";//组合商品的类型
	//组合商品类型循环出来
	if(shopingtype.length>0){
		for(var i=0;i<shopingtype.length;i++){
			savenameArry=shopingtype[i].split(":"); //字符分割
			savenameArry=savenameArry[1].split(","); //字符分割
			combinedtype=combinedtype==""?savenameArry[0]:combinedtype+'-'+savenameArry[0];
		}
	}

	$("#combintshop-type").html(combinedtype); //组合商品类型;
	setprice(shopingtype,orice);  //计算价格
	$("[name="+buttonname+"]").css({"border-color":"#ccc","border-width":"1px","margin":"1px 6px 16px 1px"});
	$("[name="+buttonname+"]").removeClass("btn-focus");
	if(nocolor){
		$(obj).css({"border-color":"#FF6801","border-width":"2px","margin":"0px 5px 15px 0px"});
		$(obj).addClass("btn-focus");
	}

}

var oldlightgallery=[];//保存的图片
var oldlightgallerylode=[];//保存顺序
function  setlightgallery(imageurl,val,type){
	if (imageurl !=""){
		if (oldlightgallery.length==0){
			oldlightgallery[0]=$(".shopping-pics").html();
		}
		if($.inArray(type+","+val,oldlightgallerylode)>=0){
			oldlightgallerylode.splice($.inArray(type+","+val,oldlightgallerylode),1);
		}
		var htmlstr="<div class=\"shopping-pics-big-item\">\n" ;
		htmlstr+="<a><img src=\""+imageurl+"\" alt=\"{$pic['alt']}\" /></a>\n";
		htmlstr+="</div>";
		oldlightgallerylode[oldlightgallerylode.length]=type+","+val;
		oldlightgallery[type+","+val]=htmlstr;
		$(".shopping-pics-big-item").html(htmlstr);
		$('[name=shopping-video-shop]').attr("style",'display:block');
		/*$(".gallery-thumbs").attr("style","display: none;");*/
	}else{
		$(".shopping-pics").html(oldlightgallery[0]);
		$('[name=shopping-video-shop]').attr("style",'display:block');
		Initializationshopping();
	}

}

//图片轮播 --商品内页调用
function Initializationshopping(){
	$('.shopping-pics-small-item').click(function() {
		var shopimg=$(this).find('img').data('imgurl');
		//图片轮播还原
		if(oldlightgallery.length>0){
			$(".shopping-pics").html(oldlightgallery[0]);
			Initializationshopping();
		}
		$('.shopping-pics-big-item').attr('style',"display:none");
		$('.shopping-pics-big-item').each(function(){
			if (shopimg==$(this).find('img').data('imgurl')) {
				$(this).attr("style",'display:block');
			}
		});
		$('.shopping-pics-small-item').removeClass('active');
		$('.shopping-pics-small-item').each(function(){
			if (shopimg==$(this).find('img').data('imgurl')) {
				$(this).addClass('active');
			}
		});
		$('[name=shopping-video-shop]').attr("style",'display:block');
	});
	$('[name=shopping-video-shop]').click(function() {
		$('.shopping-pics-big-item').attr('style',"display:none");
		$('.shopping-pics-big-item').each(function(index){
			if (index==0) {
				$(this).attr("style",'display:block');
				$(this).find('video').trigger('play');
				$(this).find('video').currentTime=0;
			}
		});
		$('[name=shopping-video-shop]').attr("style",'display:none');
	});
}

function setprice(data,price){
	if(data.length==0){
		$("#shop-price").text(price);
		var oldcombinedprice=$("#combintshop-price").html();  //组合单价获取
		var newcombinedprice=$("#combinedshopping-price").html();  //组合价格获取
		newcombinedprice=parseFloat(newcombinedprice)-parseFloat(oldcombinedprice)+parseFloat(price);
		$("#combinedshopping-price").html(newcombinedprice.toFixed(2));
		$("#combintshop-price").text(price.toFixed(2));
	}else{
		for(var i=0;i<data.length;i++){
			var savenameArry= new Array(); //定义一数组
			savenameArry=data[i].split(":"); //字符分割
			savenameArry=savenameArry[1].split(","); //字符分割
			if(savenameArry[1] == 'jia'){
				price=parseFloat(price)+parseFloat(savenameArry[2]);
			}else if(savenameArry[1] == 'jian'){
				price=parseFloat(price)-parseFloat(savenameArry[2]);
			}else if(savenameArry[1] == 'chen'){
				price=parseFloat(price)*parseFloat(savenameArry[2]);
			}else if(savenameArry[1] == 'chu'){
				price=parseFloat(price)/parseFloat(savenameArry[2]);
			}
			$("#shop-price").text(price.toFixed(2));
		}
		var oldcombinedprice=$("#combintshop-price").html();  //组合单价获取
		var newcombinedprice=$("#combinedshopping-price").html();  //组合价格获取
		newcombinedprice=parseFloat(newcombinedprice)-parseFloat(oldcombinedprice)+parseFloat(price);
		$("#combinedshopping-price").html(newcombinedprice.toFixed(2));
		$("#combintshop-price").text(price.toFixed(2));
	}
}
//加入购物车
function getshoping(aid,buy,isproxy){
	if (!shopingstatic){
		alert('价格有误不可购买，请联系客服');
		return;
	}
	//获取到数量
	var thisnum=$("#thisnum").val();
	var datatype="";
	for(var i=0;i<shopingtype.length;i++){
		if (i==0){
			datatype=shopingtype[i];
		}else{
			datatype=datatype+";"+shopingtype[i];   //点隔开多个
		}
	}

	if(buy){
        if (isproxy){
            window.location.href=getshopingurl+aid+"&datatype="+datatype+"&buy="+buy+"&thisnum="+thisnum+"&isproxy="+isproxy;
        }else{
            window.location.href=getshopingurl+aid+"&datatype="+datatype+"&buy="+buy+"&thisnum="+thisnum;
		}
	}else{
		var hrefname=getshopingurl+aid+"&datatype="+datatype+"&thisnum="+thisnum;
		$.get(hrefname,function(data,status){
			$("#datasurss").text(data);
			$('#myModalShop').modal('show');
			getorders();  //更新悬浮购物车
		});
	}
};

//购买数量
function setmin(){
	var thisnum=parseInt($('#thisnum').val())-1;
	if(thisnum<1){
		alert('数量不能小于1！');
		return false;
	}
	$("#thisnum").val(thisnum);
}
function setadd(getshoppinginventoryurl){
	//获取购物车商品数量
	$.get(getshoppinginventoryurl, function(data){
		var shoppinginventory=parseInt(data);

		var thisnum=parseInt($('#thisnum').val())+1;
		var inventory=parseInt($('#shop-inventory').text())-shoppinginventory;
		if(thisnum>inventory){
			alert('数量不能大于库存！');
			return false;
		}
		var thisnum=$("#thisnum").val();
		thisnum=parseInt(thisnum)+1;
		$("#thisnum").val(thisnum);
	});
}
function setthisnum(inventory,getshoppinginventoryurl){
	//获取购物车商品数量
	$.get(getshoppinginventoryurl, function(data) {
		var shoppinginventory=parseInt(data);
		inventory=parseInt(inventory)-shoppinginventory;
		if (parseInt($("#thisnum").val()) > inventory) {
			alert('购买数量不能大于库存！');
			$("#thisnum").val(inventory);
		}
		if (parseInt($("#thisnum").val()) < 1) {
			alert('最低购买一个！');
			$("#thisnum").val(1);
		}
	});
}

/////////////////////////////////组合购买-begin//////////////////////////////////////////
function getcombinedshopping(combined,setleixingurl,unit,priceurl){
	//遍历出组合的商品
	if(combined !=''){
		$("#shop_container").removeAttr('style');
		$("#getcombineddata").html("");
        combined = escape(combined); //对字符串进行编码，* @ - _ + . / 这几个字符除外
		url = setleixingurl + '&combined=' + combined;
		var getcombinedshoppingdata="";
		var localStoragename="setleixingurl"+combined.toString().replace(/,|#/g,'');
		if (localgetItem(localStoragename)!=null){
			getcombinedshoppingdata=localgetItem(localStoragename);
		}
		else{
			$.ajax({
				type: "get",
				url: url,
				async: false,
				success: function (data) {
                    localgetItem(localStoragename,data);
					getcombinedshoppingdata=data;
				}
			});
		}
		if (getcombinedshoppingdata!="" && getcombinedshoppingdata!="null"){
			var archiveData=JSON.parse(getcombinedshoppingdata);
			if (archiveData.length>0){
				for(var i=0;i<archiveData.length;i++){
					$("#getcombineddata").append(archiveData[i]);
				}
			}

		}


	}
}
//勾选的组合商品
var combinedshopping=new Array();
function clickcombinedshopping(aid,buytype,combinedprice,obj) {
	var price=$("#combinedshopping-price").html();
	//勾上
	/*alert($(obj).get(0).checked);
	alert($(obj).prop("checked"));*/
	if($(obj).is(":checked")){
		price=parseFloat(price)+parseFloat(combinedprice);
		if(combinedshopping.length==0){
			combinedshopping[0]={'aid':aid,'buytype':buytype};
		}else{
			combinedshopping[combinedshopping.length]={'aid':aid,'buytype':buytype};
		}
	}else{
		for(var i=0;i<combinedshopping.length;i++){
			if(combinedshopping[i]['buytype']==buytype && combinedshopping[i]['aid']==aid){
				//去除勾选的
				combinedshopping.splice(i,1);
				price=parseFloat(price)-parseFloat(combinedprice);
			}
		}
	}
	$("#combinedshopping-price").html(price);  //勾选组合总价
}
//组合购买  buy
function buycombinedshopping(hrefurl,message,aid) {
	if(combinedshopping.length>0){
		//先加入购物车本身的商品
		// 获取到数量
		var thisnum=$("#thisnum").val();
		var datatype="";
		for(var i=0;i<shopingtype.length;i++){
			if (i==0){
				datatype=shopingtype[i];
			}else{
				datatype=datatype+";"+shopingtype[i];   //点隔开多个
			}
		}
		var hrefname=getshopingurl+aid+"&datatype="+datatype+"&thisnum="+thisnum;
		$.ajax({
			type: "get",
			url: hrefname,
			async: false,
			success: function (data) {
			}
		});
		for(var i=0;i<combinedshopping.length;i++){
			var hrefname=getshopingurl+combinedshopping[i]['aid']+"&datatype="+combinedshopping[i]['buytype']+"&thisnum=1";
			$.ajax({
				type: "get",
				url: hrefname,
				async: false,
				success: function (data) {
				}
			});
		}
		window.location.href=hrefurl;
	}else{
		alert(message);
	}

}

/////////////////////////////////组合购买-end//////////////////////////////////////////


/////////////////////////////////通用-begin//////////////////////////////////////////

//加入购物车  默认无类型  数量1
function buyshop(shopingurl,shopdataurl,aid){  //buyshop({url('archive/doorders/aid/',true)},{url('archive/getarchiveType',false)},aid)
	var getshoppingurl=shopdataurl+"&aid="+aid;  //查询商品库存
	$.ajax({
		type : "get",
		url : getshoppingurl,
		async : true,
		success : function(data) {
			var archiveData = JSON.parse(data);  //商品信息
			var inventory = parseInt(archiveData['inventory']);
			if (inventory>0) {
				//商品库存大于0  就可以加入购物车
				var hrefname=shopingurl+aid+"&datatype=&thisnum=1";   //加入购物车链接
				$.get(hrefname,function(data){
					$('#myModalShop').modal('show');
					getorders();  //更新悬浮购物车
				});
			} else {
				alert('商品库存不足！');
			}
		}
	});

};
//在线模板加入购物车  默认  数量1
function gobuytemplate(buytemplateurl,obj,static){  //buyshop({url('archive/doorders/aid/',true)},{url('archive/getarchiveType',false)},aid)
		var hrefname=buytemplateurl;   //加入购物车链接
		if (static==true){
			$(obj).attr("onclick","gobuytemplate('"+buytemplateurl+"',this,false)");
			$(obj).text("取消购物车");
		}else{
			$(obj).attr("onclick","gobuytemplate('"+buytemplateurl+"',this,true)");
			$(obj).text("加入购物车");
		}
		$.get(hrefname,function(data){
			$('#myModalShop').modal('show');
			getorders();  //更新悬浮购物车
		});
};

/////////////////////////////////通用-end//////////////////////////////////////////
//加载购买链接
function loadbuyurl(buyurl){
	$.each(buyurl, function (key, value) {
		var htmlstr=  " <a target=\"_blank\" href=\""+value['buyurls']+"\"  class=\"go-buy\">"+value['buyurlname']+"</a>";
		$("#buyurl").prepend(htmlstr);
	});
}


function localsetItem(localStoragename,data) {
    if (window.localStorage) {
        localStorage.setItem(localStoragename,data);
    }
}
function localgetItem(localStoragename) {
    if (window.localStorage) {
       return localStorage.getItem(localStoragename);
    } else {
       return null;
    }
}