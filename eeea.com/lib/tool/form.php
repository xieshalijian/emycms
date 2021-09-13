<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class form
{
    static function input($name, $value = null, $option = null,$check = null)
    {
        return $input = "<input type=\"text\" name=\"$name\" id=\"$name\" value=\"$value\" class=\"form-control $check\"  $option/>";
    }

    static function hidden($name, $value = null, $option = null,$check = null)
    {
        return $input = "<input type=\"hidden\" name=\"$name\" id=\"$name\" value=\"$value\"  class=\"form-control $check \" $option/>";
    }

    static function password($name, $value = null, $option = null,$check = null)
    {
        return $input = "<input type=\"password\" name=\"$name\" id=\"$name\" value=\"$value\"  class=\"form-control $check \" $option/>";
    }

    static function textarea($name, $value = null, $option = null,$check = null)
    {
        return $input = "<textarea name=\"$name\" id=\"$name\" class=\"form-control textarea $check \" $option>$value</textarea>";
    }

    static function select($name, $value, $data, $option = null)
    {
        $select = "<select id=\"$name\" name=\"$name\"  class=\"form-control select $name\" $option>";

        //var_dump($data);
        if (!isset($data[0]) && !isset($data[""])) {
            $select .= "<option value=\"\">".lang("please_choose")."...</option>";
        }
        if (@$data[0] == null || (isset($data[0]) && !$data[0]))
            unset($data[0]);
        if (isset($_GET['table']) && $_GET['table'] == 'category') {
            $category = category::getInstance();
            $subids = $category->sons(isset($_GET['id'])?$_GET['id']:null);
        }
        if (isset($_GET['table']) && $_GET['table'] == 'type') {
            $category = type::getInstance();
            $subids = $category->sons(isset($_GET['id'])?$_GET['id']:null);
        }
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";
            if ($k == $value) {
                $select .= ' selected ';
            } else if (isset($_GET['id']) && isset($_GET['table']) && ($_GET['table'] == 'category' || $_GET['table'] == 'type') && !preg_match('/(htmlrule|isnav|ismobilenav)/is', $name)) {
                if ($_GET['id'] == $k || in_array($k, $subids)) {
                    $select .= ' disabled ';
                }
            }
            $select .= ">$d</option>";
            //$select.="<option value=\"$k\" ".($k == $value ?'selected': '').">$d</option>";
        }
        $select .= "</select>";
        return $select;
    }

    static function radio($name, $value, $checked = null, $option = null)
    {
        $checked = $checked ? 'checked="checked" ' : '';
        return "<label class=\"checkbox-inline\"><input name=\"$name\" type=\"radio\" value=\"$value\" class=\"radio\" $checked $option>	</label>";
    }

    static function checkbox($name, $value, $checked = null, $option = null)
    {
        $checked = $checked ? 'checked="checked" ' : '';
        return $input = "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"$name\" id=\"$name\" class=\"checkbox\" value=\"$value\" $checked $option>	</label>&nbsp;&nbsp;&nbsp;";
    }

    static function checkbox2($name, $value, $checked = null, $option = null)
    {
        $checked = $checked ? 'checked="checked" ' : 'checked="checked" ';
        return $input = "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"$name\" id=\"$name\" class=\"checkbox\" value=\"$value\" $checked $option>	</label>&nbsp;&nbsp;&nbsp;";
    }

    static function submit($value=null)
    {
        if(!$value){
            $value=lang('submit_on');
        }
        return "<input type=\"submit\" value=\"$value\" class=\"btn btn-primary btn-lg\" >";
    }

    static function date($name, $value)
    {
        return "<script language=\"javascript\">
$(document).ready(function()
	{
	var yearFrom=1990;
	var yearTo=2030;
	$('#$name').datepicker(
		{
		dateFormat: 'yy-mm-dd',
		buttonImage: '" . front::$view->base_url . "/images/calendar.png',
		buttonText: '".lang("please_choose").lang("datetime")."',
		buttonImageOnly: true,
		showOn: 'both',
		yearRange: yearFrom+':'+yearTo,
		clearText:'".lang("clear")."',
		closeText:'".lang("close")."',
		prevText:'".lang("previous_month")."',
		nextText:'".lang("next_month")."',
		currentText:' ',
		monthNames:['".lang("january")."','".lang("february")."',
		'".lang("march")."','".lang("april")."','".lang("may")."','".lang("june")."',
		'".lang("july")."','".lang("august")."','".lang("september")."','".lang("october")."',
		'".lang("november")."','".lang("december")."']
	}
		);
}
);
</script>\r\n" . self::input($name,
                $value);
    }

    static function doDef($res)
    {
        return $res[1];
    }

    public static function getform($name, $form, $field, $data,$check=null)
    {
        if (!$field){
            $field=array();
        }
		//var_dump($name);
        $newselectname='select_'.lang::getistemplate();
        if (get('table') && isset(setting::$var[get('table')][$name])){
            $form[$name]['select']=isset($form[$name]['select'])?$form[$name]['select']:"";
            if($form[$name]['select']==""){
                $form[$name] = setting::$var[get('table')][$name];
            }else{
                $newselect=$form[$name]['select'];
                $form[$name] = setting::$var[get('table')][$name];
                $form[$name]['select']=$newselect;
            }
        }
		//var_dump($form[$name]);
        if (get('form') && isset(setting::$var[get('form')][$name]) && $form[$name]['select']=="" )
            $form[$name] = setting::$var[get('form')][$name];
		//var_dump($form[$name]);
        if (isset($form[$name]['default'])) {
            if ((int)PHP_VERSION >= 7) {
                $form[$name]['default'] = preg_replace_callback('/\{\?([^}]+)\}/', "self::doDef", $form[$name]['default']);
            } else {
                $form[$name]['default'] = preg_replace('/\{\?([^}]+)\}/e', "eval('return $1;')", $form[$name]['default']);
            }
        }
        if (!isset($data[$name]) && isset($form[$name]['default']))
            $data[$name] = @$form[$name]['default'];
        if (preg_match('/templat/', $name) && empty($data[$name]))
            $data[$name] = @$form[$name]['default'];
        //var_dump($field);

        if (@$form[$name]['filetype'] == 'image') {
            $return = form::upload_image($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'file') {
            $return = form::upload_file($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'video') {
            $return = form::upload_video($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'image1') {
            $return = form::upload_image1($name, front::post($name) ? front::post($name) : @$data[$name]);
        }
        elseif (@$form[$name]['filetype'] == 'image2') {
            $return = form::upload_image2($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'image_mui') {
            $return = form::upload_imagemui($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'thumb') {
            $return = form::upload_thumb($name, front::post($name) ? front::post($name) : @$data[$name]);
        }
        elseif (@$form[$name]['selecttype'] == 'select') {
            //var_dump($form[$name]);

            if(isset($form[$name][$newselectname]) && $form[$name][$newselectname]!=""){    //区分表单的多选  和  内容的多选
                preg_match_all('%\((.*?)\)(\S+)%s', $form[$name][$newselectname], $result, PREG_SET_ORDER);
            }else{
                if (is_array($form[$name]["select"])){
                    $sdata=$form[$name]["select"];
                }else {
                    preg_match_all('%\((.*?)\)\((.*?)\)%s', $form[$name]["select"], $result, PREG_SET_ORDER);
                    $sdata = array();
                    foreach ($result as $res) $sdata[$res[1]] = $res[2];
                }
            }

            //var_dump($result);
			//var_dump($sdata)
            $return = form::select($name, front::post($name) ? front::post($name) : @$data[$name], $sdata, ' class="form-control select"');
        }
        elseif (@$form[$name]['selecttype'] == 'radio') {

            if(isset($form[$name][$newselectname]) && $form[$name][$newselectname]!=""){    //区分表单的多选  和  内容的多选
                preg_match_all('%\((.*?)\)(\S+)%s', $form[$name][$newselectname], $result, PREG_SET_ORDER);
            }else{
                if (is_array($form[$name]['select'])){
                    $result=$form[$name]['select'];
                    $_res = '';
                    foreach ($result as $result_key=>$result_val) $_res .= form::radio($name, $result_key, $result_key == (front::post($name) ? front::post($name) : @$data[$name])) . $result_val;
                }else{
                    preg_match_all('/\(([\d\w]+)\)\((.*?)\)/m', $form[$name]['select'], $result, PREG_SET_ORDER);
                    $_res = '';
                    foreach ($result as $res) $_res .= form::radio($name, $res[1], $res[1] == (front::post($name) ? front::post($name) : @$data[$name])) . $res[2];
                }
            }
            $return = $_res;
        }
        elseif (@$form[$name]['selecttype'] == 'checkbox') {

            if(isset($form[$name][$newselectname]) && $form[$name][$newselectname]!=""){    //区分表单的多选  和  内容的多选
                $form[$name]['select']=$form[$name][$newselectname];
            }
            preg_match_all('/\(([\d\w]+)\)(\S+)/is', $form[$name]['select'], $result, PREG_SET_ORDER);
            $_res = '';
            $values = front::post($name) ? front::$post[$name] : @$data[$name];
            if (is_string($values))
                $values = explode(',', $values);
            if (!$values)
                $values = array();
            foreach ($result as $res) $_res .= $res[2] . form::checkbox($name . '[]', $res[1], in_array($res[1], $values)) . "";
            return $_res;
        }
        elseif (@$form[$name]['selecttype'] == 'checkbox2') {
            preg_match_all('/\(([\d\w]+)\)(\S+)/is', $form[$name]['select'], $result, PREG_SET_ORDER);
            $_res = '';
            $values = front::post($name) ? front::$post[$name] : @$data[$name];
            if (is_string($values))
                $values = explode(',', $values);
            if (!$values)
                $values = array();
            foreach ($result as $res) $_res .= $res[2] . form::checkbox2($name . '[]', $res[1], in_array($res[1], $values)) . "";
            return $_res;
        }
        elseif (@$field[$name]['type'] == 'text' || @$form[$name]['selecttype']=="textarea") {
            //var_dump($field);
            $option="";
            if ($name=="introduce"){
                $option="maxlength='".config::get('archive_introducelen')."'";
            }
            $return = form::textarea($name, front::post($name) ? front::post($name) : @$data[$name], $option);
        }
        elseif (@$field[$name]['type'] == 'bigtext') {
            //var_dump($field);
            $return = form::textarea($name, front::post($name) ? front::post($name) : @$data[$name], '');
        }
        elseif ((isset($form[$name]['type']) &&@$field[$name]['type'] == 'mediumtext') ||
            (isset($form[$name]['type']) && $form[$name]['type'] == 'mediumtext')) {
            //var_dump($field);
            $return = form::ueditor($name, front::post($name) ? front::post($name) : @$data[$name]);
        }
        elseif (@$field[$name]['type'] == 'datetime' or @$field[$name]['type'] == 'date') {
            $return = form::date($name, front::post($name) ? front::post($name) : @$data[$name]);
        }
        else {
            $placeholder = '';
            if (isset($form[$name]['placeholder'])) {
                $placeholder = 'placeholder="' . $form[$name]['placeholder'] . '"';
            }
            $return = form::input($name, front::post($name) ? front::post($name) : @$data[$name], $placeholder,$check);
        }

        if (isset($field[$name]['notnull']) && $field[$name]['notnull'])
            $return .= "";
        if (@$form[$name]['tips']) {
            if ((int)PHP_VERSION >= 7) {
                $tips = preg_replace_callback('/\{\?([^}]+)\}/', "self::doDef", $form[$name]['tips']);
            } else {
                $tips = preg_replace('/\{\?([^}]+)\}/e', "eval('return $1;')", $form[$name]['tips']);
            }


            $return .= "" . $tips;
        }
        return $return;
    }

    static function select_option($name, $form, $value)
    {
        $newselectname='select_'.lang::getistemplate();
        preg_match_all('/\(([\d\w]+)\)(\S+)/im', $form[$newselectname], $result, PREG_SET_ORDER);
        $values = explode(',', trim($value, ','));
        $res = array();
        foreach ($values as $key => $rs) {
            //$res[$key]=$result[$rs][2];
            foreach ($result as $a => $b) {
                if ($b[1] == $rs) {
                    $res[$key] = $b[2];
                }
            }
        }
        return implode(',', $res);
    }

    //栏目图片和内容缩略图
    static function upload_thumb($name, $value)
    {

        $cut_url = url('tool/cut_image', false);
        $img_url = './common/js/ajaxfileupload/pic.png';
        if ((front::$act == 'edit' ||  front::$act == 'viewdata')&& $value) {
            /*if(strtolower(substr($value,0,7)) != 'http://'){
                $img_url = $value;
            }else{
                $img_url = $value;
            }*/
            $img_url = $value;
        }
        $res = "
        <div style=\"clear:both\"></div><div style=\"clear:both;border: 1px dashed #ccc; border-radius:3px; \">
        <a title=\"".lang('select_files')."\" onclick=\"javascript:windowsdig('".lang('select_files')."','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow&admin_dir=".config::getadmin('admin_dir')."','900px','480px','iframe')\" href=\"#body\"><span id=\"{$name}_preview\"><img src=\"$img_url\" class=\"img-responsive\" onerror='this.src=\"common/js/ajaxfileupload/pic.png\"' /></span></a></div><div class=\"blank10\"></div><div class=\"thumb-box\"><div class=\"input-group\"><span class=\"input-group-addon\"><a title=\"".lang('select_files')."\" onclick=\"javascript:windowsdig('".lang('select_files')."','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow&admin_dir=".config::getadmin('admin_dir')."','900px','480px','iframe')\" href=\"#body\">".lang('select_files')."</a></span><input name=\"$name\"  id=\"$name\" value=\"$value\"  class=\"form-control\" />" .
            '<span class="input-group-addon"><input value=" '.lang('delete').' " class="thumb-del" title="'.lang('delete').'" id="' . $name . '_del" onclick="pics_delete(\'\',\'' . $name . '\');document.getElementById(\'' . $name . '_preview\').innerHTML=\'<img src=\\\'common/js/ajaxfileupload/pic.png\\\' style=\\\'max-width:90px\\\'>\';" value="'.lang('delete').'" type="button" name="delbutton" class="btn btn-gray" /></span></div></div>';

        
        return $res;
    }

    //可视化缩略图
    static function upload_viualimag($name, $value)
    {

        $cut_url = url('tool/cut_image', false);
        $img_url = './common/js/ajaxfileupload/pic.png';
        if ($value) {
            $img_url = $value;
        }
        $res = "
        <div style=\"clear:both\"></div><div style=\"clear:both;float:left;margin-right:10px;\">
        <a title=\"".lang('select_files')."\" onclick=\"javascript:windowsdig('".lang('select_files')."','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow&admin_dir=".config::getadmin('admin_dir')."','900px','480px','iframe')\" href=\"#body\"><span id=\"{$name}_preview\"><img src=\"$img_url\" class=\"img-responsive\" onerror='this.src=\"common/js/ajaxfileupload/pic.png\"' /></span></a></div><div class=\"blank10\"></div><div class=\"thumb-box\"><div class=\"input-group\"><input name=\"custom[$name][value]\"  id=\"$name\" value=\"$value\"  class=\"form-control\" />" .
            '<span class="input-group-addon"><input value=" '.lang('delete').' " class="thumb-del" title="'.lang('delete').'" id="' . $name . '_del" onclick="pics_delete(\'\',\'' . $name . '\');document.getElementById(\'' . $name . '_preview\').innerHTML=\'<img src=\\\'common/js/ajaxfileupload/pic.png\\\' style=\\\'max-width:90px\\\'>\';" value="'.lang('delete').'" type="button" name="delbutton" class="btn btn-gray" /></span></div></div>';


        return $res;
    }

    //可视化视频
    static function upload_viualvideo($name, $value)
    {
        $base_url=front::$view->base_url;
        $res = "<span id=\"{$name}_info\"></span>
        <input name=\"custom[$name][value]\"  id=\"$name\"  value=\"$value\" class=\"form-control\" />";
        $res .= "<div class='blank10'></div><a href=\"javascript:;\" class=\"file\">".lang('select_files')."
            <input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" accept=\"video/*\">
        </a>
    <input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload_file/site/' . front::get('site'), false) . "','#{$name}_loading');\" value=\"".lang("upload")."\" class=\"btn btn-gray  thumb-del\" />
    <img id=\"{$name}_loading\" src=\"{$base_url}/images/loading.gif\" width='30' style=\"display:none;\">
    <input class=\"btn btn-gray thumb-del\" value=\"".lang('delete')."\" type=\"button\" name=\"delbutton\"  onclick=\"{$name}_delect(get('{$name}').value)\" />";
        $res.="<script>";
        $res.="function {$name}_delect(id) { 
        $.ajax({
            url: '".url('tool/deleteattachment/site/'.front::get('site'),false)."&id='+id,
            type: 'GET',
            dataType: 'text',
            timeout: 10000,
            error: function(){

            },
            success: function(data){
               $('#".$name."').val('');
                get('attachment_path').value='';
                get('attachment_intro').value='';
                get('attachment_path_i').innerHTML='';
                get('file_info').innerHTML='';
            }
        });
    }";
        $res.="</script>";
	        return $res;
    }

    //图片上传字段
    static function upload_image($name, $value)
    {
        //////file-input版////
        $uploadUrl = url('tool/uploadimage3',false);
        $res = "";
        $base_url = front::$view->base_url;
        $res .= <<<EOT
        <img src="$value" style="max-width:90px;">
        <div class="blank10"></div>
        <div class="input-group">
        <input id="{$name}" name="{$name}" value="$value" type="text" class="form-control">
        <span class="input-group-addon">
        <input id="file_{$name}" name="file_{$name}" type="file" class="form-control">
        </span>
        </div>
<script>
    $( function () {
        $( "#file_{$name}" ).fileinput( {
            uploadUrl: '$uploadUrl',
            allowedFileExtensions: [ 'jpg', 'png', 'gif', 'ico' ],
            maxFileSize: 200000,
            language: 'zh',
            maxFilesNum: 1,
            maxFileCount: 1,
            showPreview: false,
            showCaption: false,
            showUploadedThumbs: false
        } ).on( 'fileerror', function ( event, data, msg ) {
            alert( msg );
        } ).on( 'fileuploaded', function ( event, data, previewId, index ) {
            response = data.response;
            if ( response.file_{$name}.code == '0' ) {
                $('#{$name}').val(response.file_{$name}.name);
                 $('#{$name}').parent().find('img').attr("src",response.file_{$name}.name);
            } else {
                alert( response.file_{$name}.msg );
            }
        } );
    } );
</script>
EOT;
        //////////编辑器版 /////
        /*$res = "";
        $res .= '<input type="text" id="'.$name.'" name="'.$name.'" />';
        $res .= '<input type="button" id="btnup_'.$name.'" value="上传图片"/>';
        $res .= <<< EOT
        <script>
    var _editor;
    $(function() {
        //重新实例化一个编辑器，防止在上面的editor编辑器中显示上传的图片或者文件
        _editor = UE.getEditor('upload_ue');
        _editor.ready(function () {
            //设置编辑器不可用
            _editor.setDisabled('insertimage');
            //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
            _editor.hide();
            //侦听图片上传
            _editor.addListener('beforeInsertImage', function (t, arg) {
                $("#{$name}").attr("value", arg[0].src);
                //图片预览
                //$(".form-post .pic-show").show();
                //$("#preview").attr("src", arg[0].src);
            })
        });
        $('#btnup_{$name}').click(function () {
            dlg = _editor.getDialog("insertimage");
            dlg.render();
            dlg.open();
        });

    });
</script>
EOT;*/


        //////////file版//
		/*$cut_url = url('tool/cut_image', false);
        $img_url = './common/js/ajaxfileupload/pic.png';
		$img_url = $value;
        //栏目图片上传
        $res = "<a title=\"选择文件\" onclick=\"javascript:windowsdig('选择文件','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow','900px','480px','iframe')\" href=\"#body\"><span id=\"{$name}_preview\" class=\"pull-left\"><img src=\"$img_url\" class=\"img-responsive\" onerror='this.src=\"common/js/ajaxfileupload/pic.png\"' /></span><div class=\"blank10\"></div></a>
           <div class=\"row\"><div class=\"col-xs-8 col-sm-8 col-md-9 col-lg-10 text-right\"><input name=\"$name\"  id=\"$name\" value=\"$value\"  class=\"form-control\" />" .
            '</div><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left"><input value=" 删除 " class="btn btn-primary" title="删除" id="' . $name . '_del" onclick="pics_delete(\'\',\'' . $name . '\');document.getElementById(\'' . $name . '_preview\').innerHTML=\'<img src=\\\'./common/js/ajaxfileupload/pic.png\\\' style=\\\'max-width:90px\\\'>\';" value="删除" type="button" name="delbutton" class="btn btn-gray" /></div></div>';
        return $res;*/
		return $res;
    }

    static function upload_imagemui($name, $value)
    {

        $res = lang('address')."：<input name=\"$name\"  id=\"$name\" value=\"$value\"  class=\"form-control\" />";
        $img_url = './common/js/ajaxfileupload/pic.png';
        if (front::$act == 'edit' && $value) {
            $img_url = $value;
        }
        $res .= "
	<a title=\"".lang('select_files')."\" onclick=\"javascript:windowsdig('".lang('select_files')."','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow','900px','480px','iframe')\" href=\"#body\"><img src=\"{$img_url}\" id=\"{$name}_preview\" onerror='this.src=\"common/js/ajaxfileupload/pic.png\"'/><div class=\"blank10\"></div></a>";
        $res .= '</div>';
        return $res;
    }

    //可视化音频上传字段
    static function upload_viualaudio($name, $value)
    {
        $res = "<span id=\"{$name}_info\"></span>
        <input name=\"custom[$name][value]\"  id=\"$name\"  value=\"$value\" class=\"form-control\" />";
        $res .= "<div class='blank10'></div><a href=\"javascript:;\" class=\"file\">".lang('select_files')."
            <input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" accept=\"audio/*\">
        </a>
    <input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload_file/site/' . front::get('site'), false) . "','#{$name}_loading');\" value=\"".lang("upload")."\" class=\"btn btn-gray  thumb-del\" />
    <img id=\"{$name}_loading\" src=\"{$base_url}/images/loading.gif\" width='30' style=\"display:none;\">
    <input class=\"btn btn-gray thumb-del\" value=\"".lang('delete')."\" type=\"button\" name=\"delbutton\"  onclick=\"{$name}_delect(get('{$name}').value)\" />";
        $res.="<script>";
        $res.="function {$name}_delect(id) {
        $.ajax({
            url: '".url('tool/deleteattachment/site/'.front::get('site'),false)."&id='+id,
            type: 'GET',
            dataType: 'text',
            timeout: 10000,
            error: function(){

            },
            success: function(data){
               $('#".$name."').val('');
                get('attachment_path').value='';
                get('attachment_intro').value='';
                get('attachment_path_i').innerHTML='';
                get('file_info').innerHTML='';
            }
        });
    }";
        $res.="</script>";
	        return $res;
    }

    static function upload_image3($name, $value)
    {
        $res = "<div class=\"blank10\"></div><span id=\"{$name}_preview\"></span>
	<br>
	".lang('address')."：<input name=\"$name\"  id=\"$name\" value=\"$value\" size=\"50\"/>";
        if (front::$act == 'edit' && $value) {
            $res .= "<script>image_preview('$name','$value');</script>
	";
        }
        $res .= "<br>
	".lang("upload")."：<input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" style=\"width:400px\" onchange=\"image_preview('$name',this.value,1)\"/>
	&nbsp;&nbsp;<input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload3/site/' . front::get('site'),
                false) . "','#{$name}_loading');\" value=\"".lang("upload")."\" class=\"btn btn-gray\" />
		<img id=\"uploading\" src=\"{$base_url}/images/loading.gif\" width='30' style=\"display:none;\">";
        return $res;
    }

    static function upload_image1($name, $value)
    {
        $res = "<div class=\"blank10\"></div><span id=\"{$name}_preview\"></span>
	<br>
	".lang('address')."：<input name=\"$name\"  id=\"$name\" value=\"$value\" size=\"50\"/>";
        if (front::$act == 'edit' && $value) {
            $res .= "<script>image_preview('$name','$value');</script>
	".lang("change")."：";
        }
        $res .= "<br>
	".lang("upload")."：<input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" style=\"width:400px\" onchange=\"image_preview('$name',this.value,1)\"/>
	&nbsp;&nbsp;<input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload1/site/' . front::get('site'),
                false) . "','#{$name}_loading');\" value=\"".lang("upload")."\" class=\"btn btn-gray\" />
		<img id=\"uploading\" src=\"{$base_url}/images/loading.gif\" width='30' style=\"display:none;\">";
        return $res;
    }

    static function getuploadhtml($i, $name, $purl, $value)
    {
        $cname = $name;
        $name = $name . $i;
        $res = '<div id="' . $name . '_up" class="pics"><span id="' . $name . '_preview"></span><br><br>'.lang('address').'：<input name="' . $name . '" id="' . $name . '" value="' . $value . '" size="50"/> <input type="button" id="' . $name . '_del" class=\"btn btn-gray\" name="delbutton" value="'.lang('delete').'" onclick="pics_delete(' . $i . ',\'' . $cname . '\');" style="display:;"><br><br>';
        $res .= "<script>image_preview('{$name}','$value');</script>".lang("change")."：";
        $res .= '<input type="file" name="' . $name . '_upload" id="' . $name . '_upload" style="width:400px" onchange="image_preview(\'' . $name . '\',this.value,1)"/>&nbsp;&nbsp;<input type="button" name="' . $name . 'upload" id="' . $name . 'upload' . $i . '" onclick="return ajaxFileUpload2(\'' . $name . '_upload\',\'' . $purl . '\',\'#' . $cname . '_loading\');" value="'.lang("upload").'" class="btn btn-gray" /></div>';
        return $res;
    }

	//内页多图
    static function upload_image2($name, $value)
    {
        $res = "<div id=\"uploadarea\">";
        if (front::$act == 'edit' && $value) {
            $pics = unserialize($value);
            $i = -1;
            if (is_array($pics) && !empty($pics)) {
                foreach ($pics as $k => $v) {
                    $i++;
                    $res .= form::getuploadhtml($k, 'pics', url('tool/upload2/site/' . front::get('site'), false), $v);
                }
                $i++;
            }
            $res .= form::getuploadhtml(++$i, 'pics', url('tool/upload2/site/' . front::get('site'), false), '');
        } else {
            $res .= "<div id=\"pics0_up\" class=\"pics\"><span id=\"{$name}0_preview\"></span><div class=\"blank10\"></div><input name=\"{$name}0\"  id=\"{$name}0\" value=\"$value\"  class=\"form-control\" /> <input type=\"button\" id=\"{$name}0_del\" name=\"delbutton\" value=\"".lang('delete')."\" onclick=\"pics_delete('0','{$name}');\" class=\"btn btn-gray\" style=\"display:none;\">";
            $res .= "<input type=\"file\" name=\"{$name}0_upload\" id=\"{$name}0_upload\" style=\"width:400px\" onchange=\"image_preview('{$name}0',this.value,1)\"/><input type=\"button\" name=\"{$name}0upload\"  id=\"{$name}0upload\" onclick=\"return ajaxFileUpload2('{$name}0_upload','" . url('tool/upload2/site/' . front::get('site'), false) . "','#{$name}0_loading','{$name}');\" value=\"".lang("upload")."\" class=\"btn btn-gray thumb-del\" /></div>";
        }
        $res .= "</div>";
        return $res;
    }

    //附件
    static function upload_file($name, $value)
    {
        $base_url=isset($base_url)?$base_url:"";
        $res = "<span id=\"{$name}_info\"></span>
	<input name=\"$name\"  id=\"$name\" value=\"$value\" class=\"form-control\" />";
        $res .= "<div class='blank10'></div><a href=\"javascript:;\" class=\"file\">".lang('select_files')."
        <input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\">
    </a>
    
<input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload_file/site/' . front::get('site'), false) . "','#{$name}_loading');\" value=\"".lang("upload")."\" class=\"btn btn-gray  thumb-del\" />
<img id=\"{$name}_loading\" src=\"{$base_url}/images/loading.gif\" width='30' style=\"display:none;\">
<input class=\"btn btn-gray thumb-del\" value=\"".lang('delete')."\" type=\"button\" name=\"delbutton\"  onclick=\"attachment_delect(get('{$name}upload').value)\" />";
        return $res;
    }

    static function upload_video($name, $value)
    {
        $base_url=isset($base_url)?$base_url:"";
        $res = "<span id=\"{$name}_info\"></span>
        <input name=\"$name\"  id=\"$name\"  value=\"$value\" class=\"form-control\" />";
            $res .= "<div class='blank10'></div><a href=\"javascript:;\" class=\"file\">".lang('select_files')."
            <input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" accept=\"video/*\">
        </a>
    
    <input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload_file/site/' . front::get('site'), false) . "','#{$name}_loading');\" value=\"".lang("upload")."\" class=\"btn btn-gray  thumb-del\" />
    <img id=\"{$name}_loading\" src=\"{$base_url}/images/loading.gif\" width='30' style=\"display:none;\">
    <input class=\"btn btn-gray thumb-del\" value=\"".lang('delete')."\" type=\"button\" name=\"delbutton\"  onclick=\"attachment_delect(get('{$name}upload').value)\" />";
            return $res;
    }

    static function editor($name, $value = '')
    {
        $fckeditor = new fckeditor($name);
        $fckeditor->Value = $value;
        /*if(preg_match('/^my_/is', $name)){
            $fckeditor->ToolbarSet = "MyForm";
        }*/
        return $fckeditor->CreateHtml() . "
		<br>
	<a href=\"javascript:;\" class=\"fckeditor_height_add_sub\" onclick=\"javascript:heightAdd('$name');\">+</a>
	<a href=\"javascript:;\" class=\"fckeditor_height_add_sub\" onclick=\"javascript:heightSub('$name');\">-</a>
                ";
    }

    static function ueditor($name, $value = '')
    {
        $root = config::getadmin('base_url') . '/ueditor';
        $str = <<< EOT
    <script id="$name" name="$name" type="text/plain">$value</script>
    <script type="text/javascript">
	window.UEDITOR_HOME_URL = "{$root}/";
	$(function(){
	    UE.delEditor('$name');
        var ue_$name = UE.getEditor('$name',{
            autoHeightEnabled : false
        });
	});
    </script>
EOT;
        return $str;
    }

    static function arraytoselect($array)
    {
        $res = '';
        if (is_array($array) && !empty($array))
            foreach ($array as $key => $value) $res .= "($key)($value) ";
        return $res;
    }

    static function yesornotoarray($str)
    {
        return array(1 => $str, 0 => '不' . $str);
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.