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
	$.ajax({
			type: "get",
			url: aidurl,
			async: true,
			success: function (data) {
				if (data == '-1') {
					shopingstatic = false;
					$("#shop-price").after('<p>商品信息有误,请联系客服！</p>');
				}
				var archivedata = JSON.parse(data);
				orice = archivedata.shoppingprice.newprice;
				$("#shop-oldprice").text(archivedata.shoppingprice.oldprice);
				if (archivedata.shoppingprice.oldpricestatic == '1') {
					$("#shop-price").text(orice.toFixed(2));
					$("#combintshop-price").text(orice.toFixed(2));
					$("#combinedshopping-price").html(orice.toFixed(2));
				} else {
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
	});

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
	$.ajax({
		type: "get",
		url: setfieldNameurl + '&field=' + field,
		async: false,
		success: function (data) {
			var fieldName=JSON.parse(data);
			var fieldNameArray=fieldName.split(",");
			var datanamefield=field.toString().split(",");
			for(var index=0;index<datanamefield.length;index++){
				$('#'+datanamefield[index]).html('<dt>'+fieldNameArray[index]+'</dt>'+'<dd class="shop-type-list"></dd>');
			}
		}
	});
}
//类型加载
function setleixing(field,setleixingurl,aid){

	var url=setleixingurl+'&aid='+aid;
	$.ajax({
		type: "get",
		url: url,
		async: true,
		success: function (data) {
			var archiveData=JSON.parse(data);
			var datanamefield=field.toString().split(",");
			for(var index=0;index<datanamefield.length;index++){
				if (archiveData[datanamefield[index]] == 'num'|| archiveData[datanamefield[index]]==''
					|| archiveData[datanamefield[index]]==undefined ){
					$('#'+datanamefield[index]).attr("style","display:none");
				}else{
					var dataarray=archiveData[datanamefield[index]].split("\r\n");
					for(var i=0;i<dataarray.length;i++){
						var newdataarray=dataarray[i].toString().split(",");
						var fieldtype=newdataarray[0].toString().split(":");
						var onclickprice="onclickprice(this,'"+newdataarray[1]+"','"+newdataarray[2]+"','"+datanamefield[index]+"','"+fieldtype[1]+"','"+fieldtype[0]+"','"+newdataarray[3]+"')";

						var htmldata='<button name="'+datanamefield[index]+'" id="img'+datanamefield[index]+fieldtype[0]+'" onclick="'+onclickprice+'" type="button" data-switch-toggle="animate" class="btn">'+fieldtype[1]+'</button>';
						$('#'+datanamefield[index]).find('dd.shop-type-list').append(htmldata);
						var butteid=datanamefield[index]+fieldtype[0];
						if(newdataarray[3]!=""){
                            Exists(newdataarray[3],butteid,fieldtype[1])
                        }
					}
				}
			}
		}
	});
}
//校验文件是否存在  插入图片
function Exists(url,butteid,fieldtype) {
	$.ajax(url, {
		type: 'get',
		timeout: 1000,
		success: function () {
			var htmldata = '<img src=' + url + ' width="30" height="30" alt=' + fieldtype + '>';
			$("#img" + butteid).prepend(htmldata);
		},
		error: function () {
			return false;
		}
	});

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
				$(".show_products1-l").html(oldlightgallery[0]);
				$(".gallery-thumbs").attr("style","display: block;");
				var galleryThumbs = new Swiper('.gallery-thumbs', {
					spaceBetween: 10,
					slidesPerView: 4,
					//loop: true,
					freeMode: true,
					loopedSlides: 5, //looped slides should be the same
					watchSlidesVisibility: true,
					watchSlidesProgress: true,
				});
				var galleryTop = new Swiper('.gallery-top', {
					spaceBetween: 10,
					loop:true,
					loopedSlides: 5, //looped slides should be the same
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					thumbs: {
						swiper: galleryThumbs,
					},
				});

			}else{
				//清空相同类型的
				for(var i=0;i<oldlightgallerylode.length;i++){
					oldlightgallerylodeArry=oldlightgallerylode[i].split(","); //字符分割
					if(buttonname==oldlightgallerylodeArry[0]){
						oldlightgallerylode.splice(i,1);
					}
				}
				$(".show_products1-l").html(oldlightgallery[oldlightgallerylode[oldlightgallerylode.length-1]]);
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

//图片轮播切换
var oldlightgallery=[];//保存的图片
var oldlightgallerylode=[];//保存顺序
function  setlightgallery(imageurl,val,type){
	if (imageurl !=""){
		if (oldlightgallery.length==0){
			oldlightgallery[0]=$(".show_products1-l").html();
		}
		if($.inArray(type+","+val,oldlightgallerylode)>=0){
			oldlightgallerylode.splice($.inArray(type+","+val,oldlightgallerylode),1);
		}
		var htmlstr="<div class=\"swiper-lazy shopping-custom-pic\">\n" ;
		htmlstr+="<a href=\"\" rel=\"lightbox['roadtrip']\"><img src=\""+imageurl+"\" alt=\"{$pic['alt']}\" /></a>\n";
		htmlstr+="</div>";
		oldlightgallerylode[oldlightgallerylode.length]=type+","+val;
		oldlightgallery[type+","+val]=htmlstr;
		/*$(".show_products1-l").html(htmlstr);*/
		$(".swiper-shop-pic").html(htmlstr);
		$(".gallery-thumbs").attr("style","display: none;");
		/*$("#lightgallery").html(htmlstr);*/
	}

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
function getshoping(aid,buy){
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
		window.location.href=getshopingurl+aid+"&datatype="+datatype+"&buy="+buy+"&thisnum="+thisnum;
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
		var combineddata=combined.split("-");
		for(var index=0;index<combineddata.length;index++) {
			var newcombineddata=combineddata[index].split("#");  //获取出下标0 aid，数量和 下标1  类型
			var array_combineddata=newcombineddata[0].split(",");  //数组下标0是 aid   1是数量
			var url = setleixingurl + '&aid=' + array_combineddata[0];
			$.ajax({
				type: "get",
				url: url,
				async: false,
				success: function (data) {
					var archiveData=JSON.parse(data);
					//重新获取价格
					$.ajax({
						type: "get",
						url: priceurl+'&aid='+ archiveData['aid'],
						async: false,
						success: function (pricedata) {
							pricedata=JSON.parse(pricedata);
							archiveData['attr2']=pricedata.shoppingprice.newprice;
						}
					});
					var showtype="";//显示的类型
					var showprice="";//显示的价格
					var buytype="";//购买的类型
					if(newcombineddata[1]!=""){
						newcombineddata=newcombineddata[1].split(";");  //区分多个类型
						for(var i=0;i<newcombineddata.length;i++) {
							var newcombineddatatype=newcombineddata[i].split(":");//my_shop_model,3:定位,jia,2
							var oldfielddata=newcombineddatatype[0].split(",");//my_shop_model,3:
							if(archiveData[oldfielddata[0]] !=''){
								var newfielddata=archiveData[oldfielddata[0]].split("\n");
								for (var j = 0; j < newfielddata.length;j++) {
									var newnewfielddata=newfielddata[j].split(":");//1:定位,+,2,
									if(newnewfielddata[0]==oldfielddata[1]){
										buytype=buytype==''?oldfielddata[0]+","+newnewfielddata[0]+":":buytype+';'+oldfielddata[0]+","+newnewfielddata[0]+":";
										newnewfielddata=newnewfielddata[1].split(",");
										showtype=showtype==''?newnewfielddata[0]:showtype+'-'+newnewfielddata[0];
										if(newnewfielddata[1]=='+'){
											archiveData['attr2']=parseFloat(archiveData['attr2'])+parseFloat(newnewfielddata[2]);
										}else if(newnewfielddata[1]=='-'){
											archiveData['attr2']=parseFloat(archiveData['attr2'])-parseFloat(newnewfielddata[2]);
										}else if(newnewfielddata[1]=='*'){
											archiveData['attr2']=parseFloat(archiveData['attr2'])*parseFloat(newnewfielddata[2]);
										}
										else if(newnewfielddata[1]=='/'){
											archiveData['attr2']=parseFloat(archiveData['attr2'])/parseFloat(newnewfielddata[2]);
										}
										if(newnewfielddata[1] == '+'){
											newnewfielddata[1]='jia';
										}else if(newnewfielddata[1] == '-'){
											newnewfielddata[1]='jian';
										}else if(fh == '*'){
											newnewfielddata[1]='chen';
										}else if(newnewfielddata[1] == '/'){
											newnewfielddata[1]='chu';
										}
										else{
											newnewfielddata[1]=newnewfielddata[1];
										}
										buytype=buytype+newnewfielddata[0]+","+newnewfielddata[1]+","+newnewfielddata[2];
									}
								}
							}
						}
					}
					showprice=archiveData['attr2'];
					var  htmldata="<div class=\"col-lg-2 col-md-2 col-xs-4\"><div class=\"row\"><div class=\"combination-shopping-list-swiper\">";
					htmldata+="<img src='"+archiveData['thumb']+"' class=\"img-responsive\">" ;
					htmldata+="<p>"+archiveData['title']+"</p>" ;
					htmldata+="<p>"+showtype+"</p>" ;
					htmldata+="<p>" ;
					htmldata+="<label class=\"checkbox-inline\">" ;
					var onclickdata="clickcombinedshopping("+archiveData['aid']+",'"+buytype+"',"+showprice+",this)";
					htmldata+="<input type=\"checkbox\" onclick=\""+onclickdata+"\" value=\"option1\"> "+unit+" "+ showprice;
					htmldata+="</label>" ;
					htmldata+="</p>" ;
					htmldata+="</div></div></div>";
					$("#getcombineddata").append(htmldata);
				}
			});
		}

	}
}
//勾选的组合商品
var combinedshopping=new Array();
function clickcombinedshopping(aid,buytype,combinedprice,obj) {
	var price=$("#combinedshopping-price").html();
	//勾上
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
		async : false,
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