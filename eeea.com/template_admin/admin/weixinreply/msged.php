<style type="text/css">
    .table {font-size:14px;}
</style>

<div class="main-right-box">
<h5>{lang_admin('wechat_public_number')}<a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=weixinreply&act=list&id=1&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-secondary pull-right" >{lang_admin('return')}</a></h5>
<div class="blank20"></div>
<div class="box" id="box">

<script type="text/javascript">
var base_url = '{config::getadmin('site_url')}';
</script>
<div class="tags" style="margin-bottom:20px;">
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
      onsubmit="return returnform(this)">
<input type="hidden" name="wid" id="wid" value="<?php echo intval(front::get('wid'));?>" />
<input type="hidden" name="pid" id="pid" value="<?php echo intval(front::get('pid'));?>" />
  <div id="tagscontent" class="right_box">
      <div class="table-responsive">
          <table class="table table-hover">
      <tr class="s_out" >
        <td width="19%" align="right" valign="top">{lang_admin('mold')}</td>
        <td width="1%">&nbsp;</td>
        <td width="70%" id="caidanbox">
            <div class="form-inline">
                <div class="form-group">
                    <select name="typeid" id="typeid" onchange="changetype()" class="select form-control">
          <option value="3" {if $data['typeid']==3}selected{/if}>{lang_admin('written_reply')}</option>
          <option value="4" {if $data['typeid']==4}selected{/if}>{lang_admin('graphic_reply')}</option>
          <option value="5" {if $data['typeid']==5}selected{/if}>{lang_admin('website_content_push')}</option>
        </select>
                </div>
            </div>
		<div class="caidantype_3" style="display:{if $data['typeid']!=3 && $data['typeid']}none{/if};">
		<dl>
			<div class="blank10"></div>
			<dd>
                <div class="form-inline">
                    <div class="form-group">
				<textarea name="txt" cols="100" class="textarea gens nonull form-control" value="{$data['txt']}" placeholder="{lang_admin('please_fill_in_the_reply')}" >{$data['txt']}</textarea>
                    </div>
                </div>
                        <span class="hotspot" onmouseover="tooltip.show('{lang_admin('wechat_can_identify_the_phone_number_and_support_direct_dialing_by_clicking_on_the_phone_number')}');" onmouseout="tooltip.hide();"><img src="{$skin_admin_path}/images/visual/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
			</dd>
		</dl>
		</div>
		<div class="caidantype_5" style="display:{if $data['typeid']!=5}none{/if}">
		<dl>
			<dt><div class="blank10"></div></dt>
			<dd>
			
		<select name="catid" id="catid" class="select">
        <?php
			$option = array(0=>lang_admin('all_columns'));
			$catids = category::option(0,'tolast',$option);
			if (is_array($catids) && !empty($catids)){
            foreach ($catids as $catid=>$catname){
			?>
            <option {if $data['catid']==$catid}selected{/if} value="{$catid}">{$catname}</option>
		<?php
		}
			}
			?>
		</select>
			</dd>
		</dl>
		<dl>
			<div class="blank10"></div>
			<dd>
				<input name='num' type='text'  value='{lang_admin('fill_in_the_number_of_push_items_up_to_10')}' class="form-control" placeholder="{lang_admin('fill_in_the_number_of_push_items_up_to_10')}" /><span class="hotspot" onmouseover="tooltip.show('{lang_admin('fill_in_the_number_of_push_items_up_to_10')}');" onmouseout="tooltip.hide();"><img src="{$skin_admin_path}/images/visual/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
			</dd>
		</dl>
		</div>
        
        <?php
        $tmparr = explode('|',$data['imgtext']);
		$i = 1;
		if(is_array($tmparr) && !empty($tmparr)){
			foreach($tmparr as $str){
				$tmp = explode('*',$str);
		?>
		<div id="tuwen{$i}" class="caidantype_4" style="display:{if $data['typeid']!=4}none{/if}">
			<div class="blank30"></div>
			<h3 class="" sliding="1">{lang_admin('graphic_and_textual_contents')}[{$i}]</h3>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
                  <script type="text/javascript">
                 $(function(){
					var swfu_{$i};
					var settings_{$i} = {
						callback_data_des: 'pic{$i}',
						flash_url : "{$base_url}/common/swfupload/swfupload.swf",
						upload_url: "{url('tool/uploadimage2/site/'.front::get('site'),false)}",
						post_params: {"PHPSESSID" : "<?php echo session_id();?>"},
						file_size_limit : "{ini_get('upload_max_filesize')}B",
						file_types : "*.jpg;*.gif;*.png;*.bmp",
						file_types_description : "{lang_admin('picture')}", //All Files
						file_upload_limit : 100,
						file_queue_limit : 0,
						custom_settings : {
			                progressTarget : "fsUploadProgress",
			                cancelButtonId : "btnCancel1"
			            },
						debug: false,
			
						// Button settings
						//button_image_url: "/cmseasy/common/swfupload/botton.png",
						button_width: "39",
						button_height: "18",
						button_placeholder_id: "spanButtonPlaceHolder_{$i}",
						//button_text: '<span class="theFont">上传</span>',
						//button_text_style: ".theFont{float:left;display:block;color:#529fd0;font-size:14px;width:160px;height:40px;line-height:22px;font-weight:bold;}",
						//button_text_left_padding: 7,
						//button_text_top_padding: 5,
						button_disabled : false,
						button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
						button_cursor: SWFUpload.CURSOR.HAND,
			
						// The event handler functions are defined in handlers.js
						file_queued_handler : fileQueued,
						file_queue_error_handler : fileQueueError,
						file_dialog_complete_handler : fileDialogComplete,
						upload_start_handler : uploadStart,
						upload_progress_handler : uploadProgress,
						upload_error_handler : uploadError,
						upload_success_handler : uploadSuccess,
						upload_complete_handler : uploadComplete,
						queue_complete_handler : queueComplete	// Queue plugin event
					};
					swfu_{$i} = new SWFUpload(settings_{$i});
							 });
                </script>
<div class="img_upload">
                <input type="text" name="pic[]" id="pic{$i}"   class="form-control"  value='{$tmp[2]}' class="form-control" placeholder="{lang_admin('please_fill_in_the_picture_calling_address')}" ><a href="#" onclick="gotourl(this)"   data-dataurl='javascript:deletdisplayimg({$i});' class='displayimg_del'><img src="{$skin_admin_path}/images/no.gif" width="12" height="12" style="margin:2px 20px 0px 10px;" /></a><span class="hotspot" onmouseover="tooltip.show('{lang_admin('fill_in_the_picture_call_address')}');" onmouseout="tooltip.hide();"><img src="{$skin_admin_path}/images/visual/remind.gif" alt="" width="14" height="20" style="margin: -3px 5px 0px 0px; /"></span>
                <span style="float:left;" id="spanButtonPlaceHolder_{$i}"></span>
                <input id="btnCancel{$i}" type="button" value="{lang_admin('cancel')}" disabled="disabled" style="display:none;" />
</div>
           
     
				</dd>
			</dl>
            <div style="clear:both;"></div>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
					<input name='twname[]' type='text'   class="form-control"  value='{$tmp[0]}' class="form-control" placeholder="{lang_admin('please_fill_in_the_title')}"><span class="hotspot" onmouseover="tooltip.show('{lang_admin('fill_in_the_title')}');" onmouseout="tooltip.hide();"><img src="{$skin_admin_path}/images/visual/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
				<input name='twurl[]' type='text' value='{$tmp[1]}'  class="text nonull input" placeholder="{lang_admin('please_fill_in_the_content_link_address')}" /><span class="hotspot" onmouseover="tooltip.show('{lang_admin('fill_in_the_content_link')}');" onmouseout="tooltip.hide();"><img src="{$skin_admin_path}/images/visual/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
            <?php
			if($i == 1){
			?>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
					<textarea name="intro" class="textarea"  value="{$data['intro']}" placeholder="{lang_admin('please_fill_in_the_description')}" >{$data['intro']}</textarea><span class="hotspot" onmouseover="tooltip.show('{lang_admin('description_content_will_not_be_displayed_when_multitext_content_is_displayed')}');" onmouseout="tooltip.hide();"><img src="{$skin_admin_path}/images/visual/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
            <?php
			}
			?>
		</div>
        <?php
		$i++;
        }
		}
		?>
        <div id="moreimg"></div>
		<div class="caidantype_4" style="display:{if $data['typeid']!=4}none{/if}">
			<dl>
				<dt><div class="blank10"></div>
				</dt>
				<dd>
				<a href="#" onclick="gotourl(this)"   data-dataurl="javascript:void();" onclick="return weixin_adddisplayimg();" class="btn_b">{lang_admin('adding_graphic_content')}</a>
				<span id="loadtxt"></span>
				<span class='tips'>&nbsp;&nbsp;&nbsp;{lang_admin('add_up_to_8_graphics_and_text_content')}</span>
				</dd>
			</dl>
		</div>
        
		</td>
      </tr>
    </table></div>
  </div>
    <div class="blank30"></div>
    <div class="line"></div>
    <div class="blank30"></div>
    <input  name="submit" value="1" type="hidden">
    <input type="submit" value="{lang_admin('submitted')}" class="btn btn-primary btn-lg" />
  
</form>
</div>
<script type="text/javascript">
var num = <?php echo count($tmparr)?count($tmparr):1;?>;
function weixin_adddisplayimg(){
	var i=0;
	$("input[name*='displayimg']").each(function(){
		i++;
	});
	if(i>7){
		alert("{lang_admin('add_up_to_8_graphics_and_text_content')}");
		return false;
	}
	return adddisplayimg();
}

function adddisplayimg() {
	$('#loadtxt').html("{lang_admin('loading')}");
	num++;
	$.ajax({
		url: '<?php echo url('weixinmenu/addtuwen');?>',
		type: "POST",
		data: 'num=' + num,
		success: function(data) {
			//alert(data);
			$('#moreimg').append(data);
			$('#loadtxt').html('');
		}
	});
	return false;
}

function deletdisplayimg(i){
	//alert($('#tuwen'+i));
	$('#tuwen'+i).remove();
	num--;
}

function changetype(){
	var type=$('#typeid').val();
	$("[class*=caidantype_]").hide();
	$(".caidantype_"+type).show();
}
</script>

<div class="blank30"></div>
</div>
</div>