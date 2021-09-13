<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
error_reporting(0);
	function _get_url_data($ip,$condition,$url){
		$req=$condition;
		$header = "POST $url HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: ".strlen($req) ."\r\n\r\n";
		$fp = @stream_socket_client ($ip.':80',$errno,$errstr,30);
		if(!$fp){
		}else{
			while(!feof($fp)){
				fputs($fp,$header .$req);
				$res = fgets ($fp,204800);
			}
		}
		@fclose ($fp);
		return $res;
	}
	function ce_get_url_content($domain,$condition,$url,$file){
		$file_contents = file_get_contents($url);
		if($file_contents){
			return $file_contents;
		}else{
			/*$ch = curl_init();
			$timeout = 60;
			curl_setopt ($ch,CURLOPT_URL,$url);
			curl_setopt ($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);*/
            $file_contents=service::cmseayurl($url);
			if($file_contents){
				return $file_contents;
			}
		}
		$file_contents=_get_url_data($domain,$condition,$file);
		return $file_contents;
	}
	include('../inc/version.php');
	$_GET['version'] = _VERSION;
	if($_GET['type'] == 'remoteinf'){
		$f = 'http://info.cmseasy.cn/server/remoteinf.php?from=ce3&domain='.$_SERVER['HTTP_HOST'].'&version='.$_GET['version'].'&sinf='.$_SERVER['SCRIPT_FILENAME'].'&sip='.$_SERVER['SERVER_ADDR'].'&output='.$_GET['output'];
		$s = @ce_get_url_content('info.cmseasy.cn','from=ce3&domain='.$_SERVER['HTTP_HOST'].'&version='.$_GET['version'].'&sinf='.$_SERVER['SCRIPT_FILENAME'].'&sip='.$_SERVER['SERVER_ADDR'].'&output='.$_GET['output'].'',$f,'http://info.cmseasy.cn/server/remoteinf.php');
	}elseif($_GET['type'] == 'officialinf'){
	    $file = dirname(dirname(dirname(__FILE__))).'/cache/data/inf.txt';
		$f = 'http://info.cmseasy.cn/server/officialinf.php?from=ce3';
		if(file_exists($file) && time() - filemtime($file) < 86400){
		    $s = file_get_contents($file);
        }else{
            $s = @ce_get_url_content('info.cmseasy.cn','from=ce3',$f,'http://info.cmseasy.cn/server/officialinf.php');
            file_put_contents($file,$s);
        }
	}
	if(!empty($s)){
		echo $s;
	}else{
		if($_GET['type'] == 'remoteinf'){
			echo '<li><a href="https://www.cmseasy.cn"><span style="color:green;">'.lang('official_self_help_inquiry').'</span></a></li>';
			echo '<script type="text/javascript" src="http://info.cmseasy.cn/server/remoteinf.php?from=ce3&domain='.$_SERVER["HTTP_HOST"].'&version='.$_GET["version"].'&sinf='.$_SERVER["SCRIPT_FILENAME"].'&sip='.$_SERVER["SERVER_ADDR"].'"></script>';
		}elseif($_GET['type'] == 'officialinf'){
			echo '<li><a href="https://www.cmseasy.cn">'.lang('access_to_official_information').'</a></li>';
		}
	}
?>
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.