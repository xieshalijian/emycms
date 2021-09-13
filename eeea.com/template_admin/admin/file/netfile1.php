<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{lang_admin('network_pictures')}</title>
<link href="./common/js/upimg/dialog.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./common/js/upimg/jquery.js"></script>
<script type="text/javascript" src="./common/js/upimg/dialog.js"></script>
    <link href="./common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="JavaScript">
	var filemanage_js_upfile_zoomsize  = "{lang_admin('sorry_the_size_of_the_picture_is_invalid_or_wrong_please_fill_in_the_integer_type')}";
	var filemanage_js_upfile_driname_err  = "{lang_admin('sorry_document_address_is_not_filled_in_please_go_back_and_choose_again')}";
	var filemanage_js_upfile_ok = "{lang_admin('congratulations_file_added_successfully')}";
	var filemanage_js_upfile_no = "{lang_admin('sorry_file_addition_failed')}";
	var fheight="405";
	$(window).load(function(){
		var h = parseInt(fheight);
		$('#mainbodybottonauto').css({height:h-39});
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
		var inputstr='<td class="trtitle02" id="upfilepath"><input type="text" name="upfilepath" maxlength="200" size="50" class="infoInput form-control"> "{lang_admin('must_start_with_http')}"</td>';
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
</script>
</head>

<body class="bodyflow">
<form name="upfile" id="upfile" method="post" action="index.php?case=file&act=netfilesave1&admin_dir={get('admin_dir',true)}" >
<div id="mainbodybottonauto" class="managebottonadd">
	<div class="maindobycontent">
		<div class="maneditcontent">
			<table class="formtablewin">
				<tr class="trstyle2">
					<td class="trtitle01">{lang_admin('please_fill_in_the_website')}</td>
					<td class="trtitle02" id="upfilepath"><input type="text" name="upfilepath" maxlength="200" size="30" class="infoInput form-control">
				    {lang_admin('must_start_with_http')}</td>
				</tr>
                 <tr class="trstyle2">
				  <td class="trtitle01">{lang_admin('caption')}</td>
					<td class="trtitle02" id="upfilepath">
				    <input type="text" name="alt" id="alt" size="10" class="form-control" />
				    {lang_admin('width')}
				    <input name="width" type="text" id="width" size="5" class="form-control" />
				    {lang_admin('height')}
				    <input name="height" type="text" id="height" size="5" class="form-control" /></td>
				</tr>
				<tr class="trstyle2">
					<td class="trtitle01"></td>
					<td class="trtitle02">{lang_admin('the_allowable_file_formats_are_jpg_png_and_gif')}</td>
				</tr>
			</table>
			<table class="formtablewin displaynone" id="resulttable">
				<tr class="trstyle3">

					<td class="trtitle01">{lang_admin('added_successfully')}</td>
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
				<td id="center">
					<table border="0" style="margin: 0 auto;">
						<tr >
							<td><input type="submit" name="Submit"  id="submitbotton" value="{lang_admin('confirm_to_add_files')}" class="buttonface" title="{lang_admin('confirm_to_add_files')}"/></td>
							<td>&nbsp;&nbsp;</td>
							<td><input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="{lang_admin('return_to_the_edit_window')}" class="buttonface2"  title="{lang_admin('return_to_the_edit_window')}" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
<!-- {getCopyRight()} -->
</body>
</html>