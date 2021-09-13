<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{lang_admin('picture_upload')}</title>
<link href="./common/js/upimg/dialog.css" rel="stylesheet" type="text/css"/>
    <link href="./common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./common/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="./common/js/upimg/dialog.js"></script>
<script type="text/javascript" src="./js/swfobject.js"></script>
<script type="text/javascript">
            var swfVersionStr = "10.0.0";
			var xiSwfUrlStr = "js/upimg/playerProductInstall.swf";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "mpupload";
            attributes.name = "mpupload";
            attributes.align = "middle";
            swfobject.embedSWF("js/upimg/mpupload.swf", "flashContent", "570", "380", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);
 </script>
<script type="text/javascript" language="JavaScript">
	var filemanage_js_upfile_zoomsize  = "{lang_admin('sorry_the_size_of_the_picture_is_invalid_or_wrong_please_fill_in_the_integer_type')}";
	var filemanage_js_upfile_driname_err  = "{lang_admin('sorry_no_upload_file_has_been_selected_please_go_back_and_choose_again')}";
	var filemanage_js_upfile_ok = "{lang_admin('congratulations_file_upload_was_successful')}";
	var filemanage_js_upfile_no = "{lang_admin('sorry_file_upload_failed_please_check_whether_the_file_has_writable_permission_or_the_file_is_invalid_file_upload_was_successful')}";
	var fheight="auto";
	$(window).load(function(){
		var h = parseInt(fheight);
		$('#mainbodybottonauto').css({height:h-0});
		var options = {
			beforeSubmit: formverify,
			success:saveResponse
		}
		$('#upfile').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	});

	function formverify(formData, jqForm, options) {
		var queryString = $.param(formData);
		var get=urlarray(queryString);
		if(get['upfilepath']=='') {
			document.upfile.upfilepath.focus();
			alert(filemanage_js_upfile_driname_err);
			return false;
		}
	}

	function saveResponse(options){
		//console.log(options);
		var inputstr='<td class="trtitle02" id="upfilepath"><input type="file" name="upfilepath" maxlength="200" size="50" class="infoInput"></td>';
		$("#upfilepath").replaceWith(inputstr);

		var strarray = options.split('|');
		if (strarray[1]!=undefined){
			$("#resulttable").removeClass('displaynone');
			if (strarray[1]=='img'){
				if (strarray[2]=='1'){
					var upresult='<td class="trtitle02" id="upresult"><a onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#" onclick="gotourl(this)"   data-dataurl="#body" hidefocus="true"><img src="'+ strarray[0] + '" width="100"></a></td>';
				}else{
					var upresult='<td class="trtitle02" id="upresult"><a onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#" onclick="gotourl(this)"   data-dataurl="#body" hidefocus="true"><img src="'+ strarray[0] + '" height="100"></a></td>';
				}
				$("#upresult").replaceWith(upresult);
			}else{
				var upresult='<td class="trtitle02" id="upresult"><a class="lnglist" onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#" onclick="gotourl(this)"   data-dataurl="#body" hidefocus="true">' + strarray[0] + '</a></td>';
				$("#upresult").replaceWith(upresult);
			}
			$("#title").val("");
			alert(filemanage_js_upfile_ok);
		}else{
			alert(strarray[0]);
		}
	}
	function refile(filename,iswidth,alt,width,height){
		parent.refile(filename,iswidth,alt,width,height);
	}
	function refileswf(obj){
		var arr = obj.split('|');
		for(i=0;i<arr.length;i++){
			if(arr[i] != ''){
				parent.refileswf(arr[i],1,'',0,0);
			}
		}
		top.closeifram();
		//parent.refile(filename,iswidth,alt,width,height);
	}
	function getUploadAddress(){
		return "<?php echo 'http://'.$_SERVER['HTTP_HOST'].url('file/swfsave/'.session_name().'/'.session_id()); ?>";
	}

	function insertPics(){
		swfobject.getObjectById("mpupload").insertPic();
	}
</script>
</head>


<body class="bodyflow">
<div style="width:100%;padding:5px 0px 0px 10px;position: fixed;top:0px;background:white;z-index:999;">
<input type="submit" class="buttonface"  onclick="$('#single').css('display','block');$('#muti').css('display','none');" value="{lang_admin('single_file_upload')}"/> <input type="submit" class="buttonface2" onclick="$('#single').css('display','none');$('#muti').css('display','block');" value="{lang_admin('multi')}" />
</div>
<div id="muti" style="width:100%;display:none;position: fixed;top:-14px;z-index:1;">
<div id="flashContent" style="width:100%;">
  <center>
  <script type="text/javascript">
				var pageHost = ((document.location.protocol == "https:") ? "https://" :	"http://");
				document.write("<a href="#" onclick="gotourl(this)"   data-dataurl='http://www.adobe.com/go/getflashplayer'><img src='"
								+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
			</script>
			</center>
</div>

  <div id="subbotton"><center>
<input type="button" name="Submit" id="submitbotton" value="{lang_admin('confirmation_file_upload_file_upload')}" class="buttonface" title="{lang_admin('confirmation_file_upload_file_upload')}" onclick="insertPics()"/>&nbsp;
&nbsp;&nbsp;<input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="{lang_admin('return_to_the_edit_window')}" class="buttonface2"  title="{lang_admin('return_to_the_edit_window')}" /></center>
  </div>

</div>
<div id="single" style="display:block">
<form name="upfile" id="upfile" method="post" enctype="multipart/form-data" action="index.php?case=file&act=upfilesave&admin_dir={get('admin_dir',true)}">
<div id="mainbodybottonauto" class="managebottonadd" style="height:301px; margin-top:65px;">
	<div class="maindobycontent">
		<div class="maneditcontent">
			<table class="formtablewin">
				<tr class="trstyle2">
					<td class="trtitle01">{lang_admin('select_local_files')}</td>
					<td class="trtitle02" id="upfilepath"><input type="file" name="upfilepath" maxlength="200" size="50" class="infoInputa" style="boder:none;"></td>
				</tr>
                <tr class="trstyle2">
				  <td class="trtitle01">{lang_admin('picture_information')}</td>
					<td class="trtitle02" id="upfilepath">{lang_admin('explain')}
				    <input type="text" name="alt" id="alt" />
				    {lang_admin('width')}
				    <input name="width" type="text" id="width" size="10" />
				    {lang_admin('height')}
				    <input name="height" type="text" id="height" size="10" /></td>
				</tr>
				<tr class="trstyle2">
					<td class="trtitle01"></td>
					<td class="trtitle02">{lang_admin('1_the_size_of_the_selected_file_is_not_more_than_10_mb_and_the_file_formats_allowed_to_be_uploaded_are_jpg_png_and_gif')}<br>{lang_admin('2_the_remote_folder_saved_by_the_file_is_upload_images_upload_year_and_month')}</td>
				</tr>
			</table>
			<table class="formtablewin displaynone" id="resulttable">
				<tr class="trstyle3">

					<td class="trtitle01">{lang_admin('upload_success')}</td>
					<td class="trtitle02" id="upresult"><img src="images/pic.png" width="100px" height="100px"></td>
				</tr>
				<tr class="trstyle2">
					<td class="trtitle01"></td>
					<td class="trtitle02">{lang_admin('tip_click_on_the_above_results_select_the_file_and_close_the_window')}</td>
				</tr>
			</table>

		</div>
	</div>
</div>
<div id="downbotton">
	<div id="subbotton">
		<table border="0" width="100%">
			<tr id="bottonsubmit">

							<td align="right"><input type="submit" name="Submit" id="submitbotton" value="{lang_admin('confirmation_file_upload_file_upload')}" class="buttonface" title="{lang_admin('confirmation_file_upload_file_upload')}"/>&nbsp;&nbsp;</td>

							<td align="left"><input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="{lang_admin('return_to_the_edit_window')}" class="buttonface2"  title="{lang_admin('return_to_the_edit_window')}" /></td>


			</tr>
		</table>
	</div>
</div>
</form>
</div>
<!-- {getCopyRight()} -->
</body>
</html>