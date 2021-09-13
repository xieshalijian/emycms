<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class image_admin extends admin {

    function init() {
    	chkpw('archive_image');
    }

    function listdir_action() {
    	
        $file_dir = ROOT .rtrim(config::get('html_prefix'),'/'). '/upload/images/';
        $dir_arr = array();
        if ($ch = opendir($file_dir)) {
            while ($dir = readdir($ch)) {
                if (!strstr('..', $dir) && preg_match('/\d{6}/', $dir))
                    $dir_arr[$dir] = $dir;
            }
        }
        rsort($dir_arr);
        $this->view->dir_arr = $dir_arr;
        return $dir_arr;
    }

    static function listdir() {
        $file_dir = ROOT .rtrim(config::get('html_prefix'),'/'). '/upload/images/';
        $dir_arr = array();
        if ($ch = @opendir($file_dir)) {
            while ($dir = readdir($ch)) {
                if (!strstr('..', $dir) && preg_match('/\d{6}/', $dir))
                    $dir_arr[$dir] = $dir;
            }
        }
        rsort($dir_arr);
        return $dir_arr;
    }

    function listimg_action() {
        if (!front::get('dir'))
            return;
        $image_dir = ROOT . rtrim(config::get('html_prefix'),'/').'/upload/images/' . front::get('dir');
        if (!is_dir($image_dir))
            return;
        $handle = opendir($image_dir); //当前目录
        $img_array = array();
        while (false !== ($file = readdir($handle))) { //遍历该php文件所在目录
            list($filesname, $kzm) = explode(".", $file); //获取扩展名
            if ($kzm == "gif" or $kzm == "jpg" or $kzm == "png") { //文件过滤
                if (!is_dir('./' . $file)) { //文件夹过滤
                    $img_arr[] = $file; //把符合条件的文件名存入数组
                }
            }
        }
        $limit = 20;
        if (!front::get('page'))
            $page = 1;
        else
            $page = front::get('page');
        if(is_array($img_arr)){
            $countimgarr=count($img_arr);
        }else{
            $countimgarr=0;
        }
        if($countimgarr>0){
            $total = ceil( $countimgarr/ $limit = 20);
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
        $list_img_arr = array();
        if(is_array($img_arr)){
            foreach ($img_arr as $k => $v) {
                if (in_array($k, $tmp))
                    $list_img_arr[] = $v;
            }
        }

        $this->view->list_img_arr = $list_img_arr;
        $this->view->link_str = listPage($total, $limit, $page);
        return $img_arr;
    }

    function deleteimg_action() {
        if (!front::get('dir') || !front::get('imgname'))
            return;
        $img = ROOT . rtrim(config::get('html_prefix'),'/').'/upload/images/' . front::get('dir') . '/' . str_replace('___', '.', front::get('imgname'));
        if (!file_exists($img))
            front::flash(lang_admin('picture').lang_admin('nonentity'));
        if (!unlink($img))
            front::flash(lang_admin('deleete').lang_admin('failure').'，'.lang_admin('please_check_permissions'));
        else
            front::flash(lang_admin('picture').lang_admin('ondelete'));
        front::redirect(url::modify('act/listimg/dir/' . front::get('dir')));
    }

    function end() {
        //$this->render('index.php');
        $this->render();
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
