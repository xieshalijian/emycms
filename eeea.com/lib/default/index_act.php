<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class index_act extends act {
    function index_action() {
    	$this->check_pw();
        //判断数据库是否存在   兼容动静态和安装
        if(file_exists(ROOT."/data/locked")){
            $categorydata=category::getInstance()->getrow("isindex=1");
            if (is_array($categorydata)){
                if ($categorydata['langid']==lang::getlangid(lang::getistemplate())) {
                    if (config::get("list_page_php")==1){
                        $path=category::url($categorydata['catid']);
                        if (!preg_match('/\.[a-zA-Z]+$/', $path))
                            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                        $path = rtrim($path, '/');
                        $path = rtrim($path, '\\');
                        $path = str_replace('//', '/', $path);
                        $data = file_get_contents(ROOT.'/'.$path);
                        echo $data;
                        exit;
                    }
                    front::$get['catid']=$categorydata['catid'];
                    $archive_act=new archive_act();
                    $archive_act->init();
                    $archive_act->list_action();
                    $archive_act->end();
                   /* $data = file_get_contents(config::get('site_url')."index.php?case=archive&act=list&catid=".$categorydata['catid']);
                    echo  $data;exit;*/
                }
            }
        }

        if(config::get('list_index_php')==1 && front::get('t')!="wap"){
            $path='index-'.lang::getistemplate().'.html';
            if (!file_exists($path)) {
                template_user('system/cache_close.html');
                exit;
            }
            $data = file_get_contents(ROOT.'/'.$path); 
            echo $data;
            exit;
        }


    /*$_style = config::get('template_dir') ? config::get('template_dir') : 'default';
        if(!file_exists(TEMPLATE .'/'.$_style. '/index/index_'.lang::getistemplate().'.html')){
            copy(TEMPLATE.'/'.$_style . '/index/index.html',TEMPLATE .'/'.$_style. '/index/index_'.lang::getistemplate().'.html');
        }*/

    /*    $this->render('index/index_'.lang::getistemplate().'.html');
        exit;*/
    }
    function end() {
        if (front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
