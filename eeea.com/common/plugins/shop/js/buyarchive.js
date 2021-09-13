//获取标题和按钮
function gettitle(url){
	$("[name='YNarchive']").each(function () {
		var aid=$(this).val();
		url=url+"&aid="+aid;
		$.get(url, function(data){
			var data=JSON.parse(data);
			$("#YNarchive"+aid).parent().append(data);
		});
	});
}
//购买
function shoppingarchive(url,message){
	if (confirm(message)){
		$.get(url, function(data){
			var data=JSON.parse(data);
			alert(data['message']);
			if(data['static']){
				window.location.reload();
			}else{
				window.location.href =data['gotourl'];
			}
		});
	}
}
