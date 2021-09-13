<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class file_admin extends admin {

    function init() {
        //chkpw('');自行加上chkpw验证权限
    }
    
    function delfile_action(){
        chkpw('file_del');
        if(front::$get['UD'] != 1){
            echo '2';exit;
        }
        if(front::$get['dfile'] == ''){
            echo '0';exit;
        }
        $f = str_ireplace(config::get('site_url'), '', front::$get['dfile']);
        $f = str_replace('.php', '', $f);
        if(@unlink(ROOT . '/'.$f)){
            echo 1;
        }else{
            echo 0;
        }
        exit;
    }

    function listdir_action() {
        $file_dir = ROOT .rtrim(config::get('html_prefix'),'/'). '/upload/images/';
        $dir_arr = array();
        if ($ch = opendir($file_dir)) {
            while ($dir = readdir($ch)) {
                if (!strstr('..', $dir))
                    $dir_arr[] = $dir;
            }
        }
        $this->view->dir_arr = $dir_arr;
        return $dir_arr;
    }

    function piclist_action() {
        if (!front::get('amid'))
            exit;
        $image_dir = ROOT .config::get('html_prefix').'/'. '/upload/images/' . front::get('amid');
        if (!is_dir($image_dir))
            exit;
        $handle = opendir($image_dir); //当前目录
        $img_array = array();
        while (false !== ($file = readdir($handle))) { //遍历该php文件所在目录
            list($filesname, $kzm) = explode(".", $file); //获取扩展名
            if ($kzm == "gif" or $kzm == "jpg" or $kzm == "png") { //文件过滤
                if (!is_dir('./' . $file)) { //文件夹过滤
                	//$img_arr[] = $file; //把符合条件的文件名存入数组
                    $img_arr['file'][] = $file; //把符合条件的文件名存入数组
                    $img_arr['time'][] = filemtime($image_dir.'/'.$file);
                }
            }
        }
        //rsort($img_arr);
        //var_dump($img_arr);
        @array_multisort($img_arr["time"], SORT_NUMERIC, SORT_DESC,$img_arr["file"], SORT_STRING, SORT_ASC);
        $img_arr = $img_arr['file'];
        $limit = 12;
        if (!front::get('page'))
            $page = 1;
        else
            $page = front::get('page');
        //
        if(is_array($img_arr)){
            $countimgarr=count($img_arr);
        }else{
            $countimgarr=0;
        }
        if($countimgarr>0){
            $total = ceil( $countimgarr/ $limit);
        }else{
            $total = 0;
        }
        if ($page < 1)
            $page = 1;
        if ($page > $total)
            $page = $total;
        $start = ($page - 1) * $limit;
        $end = $start + $limit - 1;
        $tmp = range($start, $end);
        echo '<input type="button"  onclick="javascript:piclangload(\''.front::get('lang').'\',1);" value="返回上一级" class="buttonface" title="返回上一级">';
        echo "<ul>";
        $i=1+$page*$limit;
        if($img_arr) {
            foreach ($img_arr as $k => $v) {
                if (in_array($k, $tmp)) {
                    $file = $v;
                    //var_dump(config::get('base_url'));
                    //var_dump($this->base_url);
                    $base_url = $this->base_url;
                    
                    $url = ROOT.$base_url .config::get('html_prefix').'/'.'upload/images/' . front::get('amid') . '/' . $file;
                    $file = $base_url .config::get('html_prefix').'/'. 'upload/images/' . front::get('amid') . '/' . $file;
                    $info = @getimagesize($url);
                    echo '<li title="'.lang_admin('resolving_power').':' . $info[0] . 'x' . $info[1] . '" id="albumpic' . $i . '" onclick="alselected(\'albumpic' . $i . '\',\'' . $file . '\',\'selected\',1);"><p><center><img src="' . $file . '" width="100" height="100"></center><span class="panel_checkbox"></span></p><p>'.lang_admin('resolving_power').':' . $info[0] . 'x' . $info[1] . '</p></li>';
                    $i++;
                }
            }
        }
        echo "</ul>";
        echo "<div class='clear'></div><div class='jspage'>".listPageJs($total, $limit, $page)."</div><div class='clear'></div>";
        exit;
    }

    function piclanglist_action() {
        if (!front::get('lang'))
            exit;
        $image_dir = ROOT .rtrim(config::get("html_prefix",front::get('lang')),'/'). '/upload/images/';
        $dir_arr = array();
        if ($ch = @opendir($image_dir)) {
            while ($dir = readdir($ch)) {
                if (!strstr('..', $dir) && preg_match('/\d{6}/', $dir))
                    $dir_arr[] = $dir;
            }
        }
        rsort($dir_arr);
        $limit = 12;
        if (!front::get('page'))
            $page = 1;
        else
            $page = front::get('page');
        if(is_array($dir_arr)){
            $countimgarr=count($dir_arr);
        }else{
            $countimgarr=0;
        }
        if($countimgarr>0){
            $total = ceil( $countimgarr/ $limit);
        }else{
            $total = 0;
        }
        if ($page < 1)
            $page = 1;
        if ($page > $total)
            $page = $total;
        $start = ($page - 1) * $limit;
        $end = $start + $limit - 1;
        $tmp = range($start, $end);
        echo "<ul>";
        $i=1+$page*$limit;
        if($dir_arr) {
            foreach ($dir_arr as $k => $v) {
                if (in_array($k, $tmp)) {
                    $file = $v;
                    echo '<li  id="albumpic' . $i . '" onclick="picload(\'' . $file . '\',1);"><p><div class="albumlist-folder"><i class="icon-folder-alt"></i></div><span class="panel_checkbox"></span></p><p>'.$v . '</p></li>';
                    $i++;
                }
            }
        }
        echo "</ul>";
        echo "<div class='clear'></div><div class='jspage'>".listPageJs($total, $limit, $page)."</div><div class='clear'></div>";
        exit;
    }

    function piclist1_action() {
        if (!front::get('amid'))
            exit;
        $image_dir = ROOT .config::get('html_prefix').'/'. '/upload/images/' . front::get('amid');
        if (!is_dir($image_dir))
            exit;
        $handle = opendir($image_dir); //当前目录
        $img_array = array();
        while (false !== ($file = readdir($handle))) { //遍历该php文件所在目录
            list($filesname, $kzm) = explode(".", $file); //获取扩展名
            if ($kzm == "gif" or $kzm == "jpg" or $kzm == "png") { //文件过滤
                if (!is_dir('./' . $file)) { //文件夹过滤
                    //$img_arr[] = $file; //把符合条件的文件名存入数组
                    $img_arr['file'][] = $file; //把符合条件的文件名存入数组
                    $img_arr['time'][] = filemtime($image_dir.'/'.$file);
                }
            }
        }
        //rsort($img_arr);
        //var_dump($img_arr);
        @array_multisort($img_arr["time"], SORT_NUMERIC, SORT_DESC,$img_arr["file"], SORT_STRING, SORT_ASC);
        $img_arr = $img_arr['file'];
        $limit = 8;
        if (!front::get('page'))
            $page = 1;
        else
            $page = front::get('page');
        $total = ceil(count($img_arr) / $limit);
        if ($page < 1)
            $page = 1;
        if ($page > $total)
            $page = $total;
        $start = ($page - 1) * $limit;
        $end = $start + $limit - 1;
        $tmp = range($start, $end);
        echo "<ul>";
        $i=1+$page*$limit;
        if($img_arr) {
            foreach ($img_arr as $k => $v) {
                if (in_array($k, $tmp)) {
                    $file = $v;
                    //var_dump(config::get('base_url'));
                    //var_dump($this->base_url);
                    $base_url = $this->base_url;
                    $url = $base_url .config::get('html_prefix').'/'.'upload/images/' . front::get('amid') . '/' . $file;
                    $file = $base_url .config::get('html_prefix').'/'. 'upload/images/' . front::get('amid') . '/' . $file;
                    $info = @getimagesize($url);
                    echo '<li title="'.lang_admin('resolving_power').':' . $info[0] . 'x' . $info[1] . '" id="albumpic' . $i . '" onclick="alselected(\'albumpic' . $i . '\',\'' . $file . '\',\'selected\',1);"><p><center><img src="' . $file . '" width="100" height="100"></center><span class="panel_checkbox">'.lang_admin('lang_selected').'</span></p><p>'.lang_admin('resolving_power').':' . $info[0] . 'x' . $info[1] . '</p></li>';
                    $i++;
                }
            }
        }
        echo "</ul>";
        echo "<div class='clear'></div><div class='jspage'>".listPageJs($total, $limit, $page)."</div><div class='clear'></div>";
        exit;
    }
    
    function updialog_action(){
        $this->view->isadmin = 0;
        if (cookie::get('login_username')&&cookie::get('login_password')) {
        	$user=new user();
        	$user=$user->getrow(array('username'=>cookie::get('login_username')));
        	$roles = cache::get('roles');
        	if ($roles && is_array($user)&&cookie::get('login_password')==front::cookie_encode($user['password'])) {
        		$this->view->isadmin = 1;
        	}
        }
        echo $this->view->fetch();
        exit;
    }

    function updialog1_action(){
        $this->view->isadmin = 0;
        if (cookie::get('login_username')&&cookie::get('login_password')) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username')));
            $roles = cache::get('roles');
            if ($roles && is_array($user)&&cookie::get('login_password')==front::cookie_encode($user['password'])) {
                $this->view->isadmin = 1;
            }
        }
        echo $this->view->fetch();
        exit;
    }

    function updialog2_action(){
        $this->view->isadmin = 0;
        if (cookie::get('login_username')&&cookie::get('login_password')) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username')));
            $roles = cache::get('roles');
            if ($roles && is_array($user)&&cookie::get('login_password')==front::cookie_encode($user['password'])) {
                $this->view->isadmin = 1;
            }
        }
        echo $this->view->fetch();
        exit;
    }

    function updialogflash_action(){
        $this->view->isadmin = 0;
        if (cookie::get('login_username')&&cookie::get('login_password')) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username')));
            $roles = cache::get('roles');
            if ($roles && is_array($user)&&cookie::get('login_password')==front::cookie_encode($user['password'])) {
                $this->view->isadmin = 1;
            }
        }
        echo $this->view->fetch();
        exit;
    }

    function updialog3_action(){
        $this->view->isadmin = 0;
        if (cookie::get('login_username')&&cookie::get('login_password')) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username')));
            $roles = cache::get('roles');
            if ($roles && is_array($user)&&cookie::get('login_password')==front::cookie_encode($user['password'])) {
                $this->view->isadmin = 1;
            }
        }
        echo $this->view->fetch();
        exit;
    }
    
    function upfile_action(){
        echo $this->view->fetch();
        exit;
    }

    function upfile1_action(){
        echo $this->view->fetch();
        exit;
    }

    function upfile2_action(){
        echo $this->view->fetch();
        exit;
    }

    function upfile3_action(){
        echo $this->view->fetch();
        exit;
    }

    function upfileflash_action(){
        echo $this->view->fetch();
        exit;
    }

    function upfile4_action(){
        echo $this->view->fetch();
        exit;
    }
    
    function netfile_action(){
        echo $this->view->fetch();
        exit;
    }

    function netfile1_action(){
        echo $this->view->fetch();
        exit;
    }

    function netfile2_action(){
        echo $this->view->fetch();
        exit;
    }

    function netfile3_action(){
        echo $this->view->fetch();
        exit;
    }

    function netfileflash_action(){
        echo $this->view->fetch();
        exit;
    }

    function netfilesave_action(){
        if ($_POST['upfilepath']) {
            $filename = $_POST['upfilepath'];
            if((strtolower(substr($filename, 0, 8))!='https://') && (strtolower(substr($filename, 0, 7))!='http://')  ){
                echo  lang_admin('must_start_with_HTTP_or_HTTPS');
                exit;
            }
            $ext = end(explode('.',$filename));
            if (!in_array($ext,array('jpg','png','gif'))) {
                echo lang_admin('type_of_not_allowed');
                exit;
            }
            echo $filename.'|img|1|'.front::$post['alt'].'|'.front::$post['width'].'|'.front::$post['height'];
            exit;
        }
    }

    function netfilesave1_action(){
        if ($_POST['upfilepath']) {
            $filename = $_POST['upfilepath'];
            if(strtolower(substr($filename, 0, 7))!='http://'){
                echo lang_admin('must_be_http');
                exit;
            }
            $ext = end(explode('.',$filename));
            if (!in_array($ext,array('jpg','png','gif'))) {
                echo lang_admin('type_of_not_allowed');
                exit;
            }
            echo $filename.'|img|1|'.front::$post['alt'].'|'.front::$post['width'].'|'.front::$post['height'];
            exit;
        }
    }

    function netfilesave2_action(){
        if ($_POST['upfilepath']) {
            $filename = $_POST['upfilepath'];
            if(strtolower(substr($filename, 0, 7))!='http://'){
                echo lang_admin('must_be_http');
                exit;
            }
            $ext = end(explode('.',$filename));
            if (!in_array($ext,array('mp4'))) {
                echo lang_admin('type_of_not_allowed');
                exit;
            }
            echo $filename.'|mp4|1|'.front::$post['autoplay'].'|'.front::$post['width'].'|'.front::$post['height'];
            exit;
        }
    }

    function netfilesave3_action(){
        if ($_POST['upfilepath']) {
            $filename = $_POST['upfilepath'];
            if(strtolower(substr($filename, 0, 7))!='http://'){
                echo lang_admin('must_be_http');
                exit;
            }
            $ext = end(explode('.',$filename));
            if (!in_array($ext,array('mp3'))) {
                echo lang_admin('type_of_not_allowed');
                exit;
            }
            echo $filename.'|mp3|1|'.front::$post['autoplay'].'|'.front::$post['width'].'|'.front::$post['height'];
            exit;
        }
    }

    function netfilesaveflash_action(){
        if ($_POST['upfilepath']) {
            $filename = $_POST['upfilepath'];
           /* if(strtolower(substr($filename, 0, 7))!='http://'){
                echo lang_admin('must_be_http');
                exit;
            }*/
            $ext = end(explode('.',$filename));
            if (!in_array($ext,array('swf'))) {
                echo lang_admin('type_of_not_allowed');
                exit;
            }
            echo $filename.'|swf|1|'.front::$post['autoplay'].'|'.front::$post['width'].'|'.front::$post['height'];
            exit;
        }
    }
    
    function ps_action(){
        //$this->view->image_dir = image_admin::listdir();
        $this->view->image_dir = lang::getlang_html_prefix();
        echo $this->view->fetch();
        exit;
    }
    function ps1_action(){
        $this->view->image_dir = image_admin::listdir();
        echo $this->view->fetch();
        exit;
    }

    function upfilesave1_action(){

    }
    
    function upfilesave_action(){
        if (is_array($_FILES['upfilepath'])) {
            $upload = new upload();
            $upload->dir = 'images';
            $upload->max_size = 200*1024*1024;
            $attachment = new attachment();
            $_file_type = str_replace(',','|',config::get('upload_filetype'));
            $file = $_FILES['upfilepath'];
            $file['name'] = strtolower($file['name']);
            if ($file['size'] > $upload->max_size) {
                echo lang_admin('attachment_exceeding_the_upper_limit')."(".ceil($upload->max_size / 102400)."K)！');";
                exit;
            }
            if (!front::checkstr(file_get_contents($file['tmp_name']))) {
                echo lang_admin('upload_failed').lang_admin('please_save_the_image_as_web_format');
                exit;
            }
            if (!$file['name'] || !preg_match('/\.('.$_file_type.')$/',$file['name'])){
                echo lang_admin('upload_failed').lang_admin('file_types_not_allowed');
                exit;
            }
            $filename = $upload->run($file);
            if(config::get('watermark_open')) {
                include_once ROOT.'/lib/plugins/watermark.php';
                imageWaterMark($filename,config::get('watermark_pos'),config::get('watermark_path'),null,5,"#FF0000",config::get('watermark_ts'),config::get('watermark_qs'));
            }
            if (!$filename) {
                echo lang_admin('attachment_save_failed');
                exit;
            }
			//$img_info = getimagesize($filename);
            echo $filename.'|img|1|'.front::$post['alt'].'|'.$img_info[0].'|'.$img_info[1];
            exit;
        }
    }
    
    function swfsave_action(){
        if (is_array($_FILES['Filedata'])) {
            $upload = new upload();
            $upload->dir = 'images';
            $upload->max_size = 2048000;
            $attachment = new attachment();
            $_file_type = str_replace(',','|',config::get('upload_filetype'));
            $file = $_FILES['Filedata'];
            $file['name'] = strtolower($file['name']);
            if ($file['size'] > $upload->max_size) {
                echo lang_admin('attachment_exceeding_the_upper_limit')."(".ceil($upload->max_size / 102400)."K)！');";
                exit;
            }
            if (!front::checkstr(file_get_contents($file['tmp_name']))) {
                echo lang_admin('upload_failed').lang_admin('please_save_the_image_as_web_format');
                exit;
            }
            if (!$file['name'] || !preg_match('/\.('.$_file_type.')$/',$file['name'])){
                echo lang_admin('upload_failed').lang_admin('file_types_not_allowed');
                exit;
            }
            $filename = $upload->run($file);
            if(config::get('watermark_open')) {
                include_once ROOT.'/lib/plugins/watermark.php';
                imageWaterMark($filename,config::get('watermark_pos'),config::get('watermark_path'),null,5,"#FF0000",config::get('watermark_ts'),config::get('watermark_qs'));
            }
            if (!$filename) {
                echo lang_admin('attachment_save_failed');
                exit;
            }
            echo 'ok_'.$filename;
            exit;
        }else{
            exit(lang_admin('add_file'));
        }
    }

    function deleteimg_action() {
        if (!front::get('dir') || !front::get('imgname'))
            return;
        $img = ROOT  .config::get('html_prefix').'/'. '/upload/images/' . front::get('dir') . '/' . str_replace('___', '.', front::get('imgname'));
        $img = str_replace('.php', '', $img);
        if (!file_exists($img))
            front::flash(lang_admin('picture').lang_admin('nonentity'));
        if (!unlink($img))
            front::flash(lang_admin('delete').lang_admin('failure').'，'.lang_admin('please_check_permissions'));
        else
            front::flash(lang_admin('picture').lang_admin('ondelete'));
        front::redirect(url::modify('act/listimg/dir/' . front::get('dir')));
    }

    function end() {
        $this->render();
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
