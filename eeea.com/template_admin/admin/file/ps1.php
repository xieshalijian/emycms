<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{lang_admin('picture_gallery')}</title>
<link href="./common/js/upimg/dialog.css" rel="stylesheet" type="text/css"/>
    <link href="./common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./common/js/upimg/jquery.js"></script>
<script type="text/javascript" src="./common/js/upimg/dialog.js"></script>
<script type="text/javascript" language="JavaScript">
	var filemanage_filecheck_select_allno = "{lang_admin('the_album_is_empty_please_re_select_it')}";
	var filemanage_filecheck_select_max = "{lang_admin('sorry_the_selection_failed_exceeding_the_maximum_number_of_currently_allowed_choices')}";
	var filemanage_js_album_select_err = "{lang_admin('sorry_no_relevant_files_have_been_selected_please_go_back_and_re_select')}";
	var fheight="405";
	var loadurl="index.php?case=file&act=piclist1&admin_dir=<?php echo config::getadmin('admin_dir');?>";
	$(document).ready(function(){
		var h = parseInt(fheight);
		$('#mainbodybottonauto').css({height:h-39});
		$("#fileloading").ajaxStart(function(){
			$(this).show();
		}).ajaxStop(function() {
			$(this).hide();
		});
	})

	function refile(){

		var albumlist=$('input:[name="albumlist"]').val();
		var albumiswidthlist=$('input:[name="albumiswidthlist"]').val();
		if(albumlist){
			filename=albumlist.substring(0,albumlist.length-1);
			iswidtharray=albumiswidthlist.substring(0,albumiswidthlist.length-1);
			parent.refile(filename,iswidtharray);
		}else{
			alert(filemanage_js_album_select_err);
			return false;
		}
	}

	function picload(amid,page){
		if (amid=='0') {
			$('#albumlist').html(filemanage_filecheck_select_allno);
			return false;
		}
		var loadingurl=loadurl + '&amid=' + amid + '&page=' + page + '&freshid=' + Math.random();
		$.get(loadingurl, function(data){
			$('#albumlist').html(data);
			var albumidlist=$('input:[name="albumidlist"]').val();
			if (albumidlist){

				var albumlist=$('input:[name="albumlist"]').val();

				var albumiswidthlist=$('input:[name="albumiswidthlist"]').val();
				var albumidarray = albumidlist.split('|');
				var albumarray = albumlist.split('|');
				var albumiswidtharray = albumiswidthlist.split('|');
				var gidstr=null;
				var htmlse=null;
				var htmlvol=null;
				for (var i = 0; i < albumidarray.length; i++){

					if (albumidarray[i]){

						gidstr="#"+albumidarray[i]+" .panel_checkbox";

						htmlvol=$("#"+albumidarray[i]).html();

						htmlse="<li id=\""+albumidarray[i]+"\" onclick=\"alselected('"+albumidarray[i]+"','"+albumarray[i]+"','undefined',"+albumiswidtharray[i]+");\">"+htmlvol+"</li>";
						$(htmlse).replaceAll("#"+albumidarray[i]);
						$(gidstr).show();
					}
				}
			}
		});
	}

	function alselected(gid,imgpath,setype,iswidth){
		var gidstr="#"+gid+" .panel_checkbox";

		var maxs=$('input:[name="max"]').val();

		var albumlist=$('input:[name="albumlist"]').val();

		var albumidlist=$('input:[name="albumidlist"]').val();

		var albumiswidthlist=$('input:[name="albumiswidthlist"]').val();

		var htmlvol=$("#"+gid).html();
		if (setype=='selected'){

			if (maxs<1){
				alert(filemanage_filecheck_select_max);
				return false;
			}

			var htmlse="<li id=\""+gid+"\" onclick=\"alselected('"+gid+"','"+imgpath+"','undefined',"+iswidth+");\">"+htmlvol+"</li>";
			$(htmlse).replaceAll("#"+gid);
			$(gidstr).show();

			var nowid=Number(maxs)-1;
			$('input:[name="max"]').val(nowid);

			var albumlist=albumlist+imgpath+'|';
			$('input:[name="albumlist"]').val(albumlist);

			var albumidlist=albumidlist+gid+'|';
			$('input:[name="albumidlist"]').val(albumidlist);

			var albumiswidthlist=albumiswidthlist+iswidth+'|';
			$('input:[name="albumiswidthlist"]').val(albumiswidthlist);

		}else{

			var htmlse="<li id=\""+gid+"\" onclick=\"alselected('"+gid+"','"+imgpath+"','selected',"+iswidth+");\">"+htmlvol+"</li>";
			$(htmlse).replaceAll("#"+gid);
			$(gidstr).hide();

			var maxnowid=Number(maxs)+1;
			$('input:[name="max"]').val(maxnowid);

			var albumlist=albumlist.replace(imgpath+"|","");
			$('input:[name="albumlist"]').val(albumlist);

			var albumidlist=albumidlist.replace(gid+"|","");
			$('input:[name="albumidlist"]').val(albumidlist);

			var albumiswidthlist=albumiswidthlist.replace(iswidth+"|","");
			$('input:[name="albumiswidthlist"]').val(albumiswidthlist);
		}
	}
</script>
</head>

<body>
<input type="hidden" name="max" value="{front::get('max')}"/>
<input type="hidden" name="albumlist" value=""/>
<input type="hidden" name="albumidlist" value=""/>
<input type="hidden" name="albumiswidthlist" value=""/>
<div id="select" class="windowselecttop">
	<span id="amidlist">
	{lang_admin('gallery_list')}：<select size="1" name="amid" id="amid"  onchange="picload(this.value,1)" class="form-control">
		<option value="0">{lang_admin('please_select_the_gallery')}</option>
                     <?php foreach($image_dir as $k => $v) { ?>
  <option value="<?php echo $v;?>"><?php echo $v;?></option>
  <?php } ?>
			</select>

	</span>
	<span id="fileloading" class="fileloading">{lang_admin('the_album_is_loading')}...</span>
</div>
<div id="mainbodybottonauto" class="managebottonadd">
	<div class="albumlist" id="albumlist">{lang_admin('please_select_an_existing_directory_from_the_drop_down_menu_above')}<br/>
		{lang_admin('if_your_directory_does_not_have_files_it_is_recommended_to_go_to_the_upload_files_column_first_upload_files_and_then_use_this_function_down_menu_above')}<br/>
		{lang_admin('tip_click_picture_selection_to_select_different_catalogues_and_multiple_pictures')}<br/></div>
</div>
<div class="blank10"></div>
<div id="downbotton">
	<div id="subbotton">
		<table border="0" width="100%">
			<tr id="bottonsubmit">
				<td id="center">
					<table border="0" style="margin: 0 auto;">
						<tr>
                            <input  name="Submit" value="1" type="hidden">
							<td><input type="submit" id="submitbotton" onclick="javascript:refile();" value="{lang_admin('confirm_to_add_files')}" class="buttonface" title="{lang_admin('confirm_to_add_files')}"/></td>
							<td>&nbsp;&nbsp;</td>
							<td><input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="{lang_admin('return_to_the_edit_window')}" class="buttonface2"  title="{lang_admin('return_to_the_edit_window')}" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
<!-- {getCopyRight()} -->
</body>
</html>