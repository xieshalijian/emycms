<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{lang_admin('select_pictures')}</title>
<link href="./common/js/upimg/dialog.css" rel="stylesheet" type="text/css"/>
    <link href="./common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./common/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="./common/js/upimg/dialog.js"></script>
<script type="text/javascript" language="JavaScript">
	var mangerlist_filecheck_js_filedirok = "{lang_admin('folder_normal')}";
	var mangerlist_filecheck_js_filedirno = "{lang_admin('there_is_no_writable_permission_please_check_the_folder_permission_or_the_folder_does_not_exist')}";
	var iframename = "";
	var checkfrom="{front::get('checkfrom')}";
	var getbyid="{front::get('getbyid')}";
	var editiframename="";
	var fileinputid="{front::get('fileinputid')}";
	var filed_name="{front::get('filed_name')}";
	var digheight="460";
	var rootDIR="";
	var picview="index.php?case=file&act=ps&max={front::get('max')}&admin_dir=<?php echo config::getadmin('admin_dir');?>";
	var fileview="index.php?case=file&act=netfile&admin_dir=<?php echo config::getadmin('admin_dir');?>";
	$(document).ready(function(){
		var h = parseInt(digheight);
		var w = $(window).width();
		$('#mainwindowstr').css({width: w-15});
		//$('.upfilewindow').css({height:h-0});
	})

	function resetwindow(){
		parent.closeifram();
	}

	function fnUpdate(){
		$("#floatBoxBg").hide();
		$("#floatBox").hide();
	}

	function refile(filename,iswidth,alt,width,height){
		if (checkfrom=='edit'){
			checkimageinput(filename,fileinputid,alt,width,height);
		}else if(checkfrom=='input'){
			checkinput(filename,fileinputid);
		}else if(checkfrom=='function'){
			functionpic(filename,fileinputid,getbyid,iswidth);
		}else if(checkfrom=='picshow'){
			picshow(filename,fileinputid,getbyid,iswidth,width,height);
		}else if(checkfrom=='piclistshow'){
			piclistshow(filename,fileinputid,getbyid,iswidth,alt);
		}else if(checkfrom=='editwin'){
			checkimageeditor(filename,fileinputid);
		}
		parent.closeifram();
	}
	
	function refileswf(filename,iswidth,alt,width,height){

		//console.log(filename);
		if (checkfrom=='edit'){
			checkimageinput(filename,fileinputid,alt,width,height);
		}else if(checkfrom=='input'){
			checkinput(filename,fileinputid);
		}else if(checkfrom=='function'){
			functionpic(filename,fileinputid,getbyid,iswidth);
		}else if(checkfrom=='picshow'){
			picshow(filename,fileinputid,getbyid,iswidth,width,height);
		}else if(checkfrom=='piclistshow'){
			piclistshow(filename,fileinputid,getbyid,iswidth,alt);
		}else if(checkfrom=='editwin'){
			checkimageeditor(filename,fileinputid);
		}
	}

	function checkimageeditor(filename,inputnameID){
		var win = parent.frames[iframename].frames[editiframename];
		filename=rootDIR+filename;
		win.document.getElementById(inputnameID).value = filename;
		if (typeof(win.ImageDialog) != "undefined") {
			if (win.ImageDialog.getImageData) win.ImageDialog.getImageData();
			if (win.ImageDialog.showPreviewImage) win.ImageDialog.showPreviewImage(filename);
		}
		parent.closeifram();
	}

	function checkimageinput(filename,inputnameID,alt,width,height){
		var filenames = filename.split('|');
                var str = '';
                if(width){str = str + " width='"+width+"'";}
                if(height){str = str + " height='"+height+"'";}
		var src_tex='';
		for (var i = 0; i < filenames.length; i++){
			if(filenames[i].substr(0,7).toLowerCase() == 'http://'){
				src_tex+='<img src="'+filenames[i]+'" alt="'+alt+'" '+str+' /><br />';
			}else{
				src_tex+='<img src="'+rootDIR+filenames[i]+'" alt="'+alt+'" '+str+' /><br />';
			}
		}
		parent.getEditor(inputnameID).InsertHtml(src_tex);
		//parent.closeifram();
	}

	function checkinput(filename,inputnameID){
		//alert(filename);
		parent.frames[iframename].document.getElementById(inputnameID).value = filename;
		parent.closeifram();
	}

	function picshow(filename,inputnameID,getbyid,iswidth,width,height){
		if(filename.substr(0,7).toLowerCase() == 'http://'){
			parent.document.getElementById(inputnameID).value = filename;
		}else{
			parent.document.getElementById(inputnameID).value = rootDIR+filename;
		}
		parent.addpicshow(filename,getbyid,iswidth,width,height);
		//parent.closeifram();
	}
	
	function piclistshow(filename,inputnameID,getbyid,iswidth,alt){
		var filenames = filename.split('|');
		if (filed_name=="" || filed_name==undefined){
            filed_name="ic";
        }else{
            filed_name+="ic";
        }
		var src_tex='';
		var j = parseInt(parent.document.getElementById(filed_name).value)+1;
		for (var i = 0; i < filenames.length; i++){
			if(filenames[i].substr(0,7).toLowerCase() != 'http://'){
				filenames[i] = rootDIR+filenames[i];
			}
			parent.document.getElementById(getbyid).innerHTML = parent.document.getElementById(getbyid).innerHTML+'<div id="'+inputnameID+j+'_up" class="pics"><span id="'+inputnameID+j+'_preview"><img style="width:90px;" src="'+filenames[i]+'" border="0" /></span><div class="blank10"></div><div class="thumb-box"><div class="input-group"><input id="'+inputnameID+j+'" value="'+filenames[i]+'" class="form-control" name="'+inputnameID+'['+j+'][url]" /><span class="input-group-addon"><input class="thumb-del" id="'+inputnameID+j+'_del" onclick="pics_delete(\''+j+'\',\''+inputnameID+'\');" value=\"{lang_admin('delete')}\" type="button" name="delbutton" /></span></div><div class="blank10"></div><div class="input-group"><input id="'+inputnameID+'alt'+j+'" value="'+alt+'" class="form-control" name="'+inputnameID+'['+j+'][alt]" /><span  class="input-group-addon">{lang_admin('pic_alt')}</span></div></div>';
			parent.document.getElementById(filed_name).value = j;
			j = j + 1;
		}	   
		//parent.closeifram();
	}

	function functionpic(filename,inputnameID,getbyid,iswidth){
		parent.frames[iframename].addpicipnput(filename,inputnameID,getbyid,iswidth,iframename);
		parent.closeifram();
	}

	function selectfile(){
		var filename=$('.pp_description').html();
		var fileinputid="pic";
		if (checkfrom=='edit'){
			checkimageinput(filename);
		}else if(checkfrom=='input'){
			checkinput(filename,fileinputid);
		}else if(checkfrom=='function'){
			functionpic(filename,fileinputid);
		}
	}
	function flushiframe(getid){
		var url = (getid=='piclist') ? picview : fileview;
		document.getElementById(getid).src = url;
	}



</script>

<script type="text/javascript">
<!--
	$(function(){
 $(document).bind("click",function(e){
  var target  = $(e.target);
  if(target.closest("#floatBox").length == 0){
   $("#floatBox").hide();
  }
 }) 
})
//-->
</script>
</head>

<body>
<div class="centerrightwindow">
	<div id="mainwindowtab">
				<ul>
			<li class="hover" id="tabbottonul1" href="#body" onmousedown="javascript:windowsclass('#tabbottonul1','#tabcontentdiv1','tabbottonul','tabcontentdiv',1,4,'hover','hover2');">{lang_admin('upload_files')}</li>
            <li id="tabbottonul2" href="#body" onmousedown="javascript:windowsclass('#tabbottonul2','#tabcontentdiv2','tabbottonul','tabcontentdiv',2,4,'hover','hover2');flushiframe('netpic');">{lang_admin('network_pictures')}</li>
			<li id="tabbottonul3" href="#body" onmousedown="javascript:windowsclass('#tabbottonul3','#tabcontentdiv3','tabbottonul','tabcontentdiv',3,4,'hover','hover2');flushiframe('piclist');">{lang_admin('gallery_browsing_mode')}</li>
		</ul>
			</div>
	<div id="mainwindowstr">
		<div id="tabcontentdiv1" class="displaytrue">
            <iframe name="upfilewindow" class="upfilewindow" src="index.php?case=file&act=upfile1&admin_dir=<?php echo config::getadmin('admin_dir');?>" width="100%" height="535" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe>
        </div>
        <div id="tabcontentdiv2" class="displaynone">
            <iframe name="netpic" id="netpic" class="upfilewindow" src="#" width="100%" height="535" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe>
        </div>
		<div id="tabcontentdiv3" class="displaynone">
            <iframe name="piclist" id="piclist" class="upfilewindow" src="#" width="100%" height="535" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" style="height:535px;"></iframe>
        </div>
	</div>
</div>
<!-- {getCopyRight()} -->
</body>
</html>