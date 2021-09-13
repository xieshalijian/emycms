<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class archive_admin extends admin
{
    function init()
    {
        $this->check_pw();
        $this->_langtemplate=lang::getistemplate();
    }

    function show_action()
    {
        chkpw('template_visual');
        if (front::get('aid')){
            //获取已经购买的插件
            $this->view->returndata=service::getInstance()->getlogin();
            $aid=front::get('aid');
            $archivedata= archive::getInstance()->getrow($aid,'');
            $tempname =@$archivedata['template'];
            if (!$tempname){
                $tempname = category::gettemplate($archivedata['catid'], 'showtemplate',true,config::get('template_dir'));
            }
            $tempname=str_replace(".html","",$tempname);
            $url=config::get('site_url')."index.php?case=archive&act=show&pageset=1&isvisual=1&aid=".$aid.'&url='.lang::getisadmin();;
            $url=service::dkUrl($url);


            lang::settistemplate(lang::getisadmin());
            load_lang('system.php','system_custom.php');
            //判断商品
            front::$isvalue=true;
            $cateshopping=category::getInstance()->getrow("catid='".$archivedata['catid']."'");
            if($cateshopping['isshopping']){
                $tempheader= template_shopping('header.html');
                $tempfooter=template_shopping('footer.html');                $this->view->isshopping=1;
                $dir = config::get('template_shopping_dir');
            }else{
                $tempheader= template('header.html');
                $tempfooter=template('footer.html');                $this->view->isshopping=0;
                $dir = config::get('template_dir');
            }
            //加载头部
            //$tempheader=$this->view->getvisualhead($dir);
            //加载底部文件
            //$tempfooter=$this->view->getvisualfooter($dir);

            $tempcontent = curlservice::curl_template($url);
            $tempcontent=service::getherf($tempcontent);
            if (front::post("refreshrigt")){
                lang::settistemplate($this->_langtemplate);
                echo $tempcontent;exit;
            }

            lang::settistemplate($this->_langtemplate);


            //链接需要修改  只针对商品内页  批量替换
            $tempheader=service::getherf($tempheader);
            $tempfooter=service::getherf($tempfooter);
            //var_dump($file);
            $this->view->tempname = $tempname;
            $this->view->tempcontent = $tempcontent;
            $this->view->tempheader = $tempheader;
            $this->view->tempfooter = $tempfooter;
            $content = $this->view->adminfetch();
            echo($content);
        }
        exit;
    }

    function list_action()
    {
        chkpw('template_visual');
        if (front::get('catid')){
            //获取已经购买的插件
            $this->view->returndata=service::getInstance()->getlogin();
            $catid=front::get('catid');
            $categorydata= category::getInstance()->getrow('catid='.$catid);
            $tempname = @$categorydata['template'];
            if (!$tempname){
                    $tempname = category::gettemplate($categorydata['catid'],'listtemplate',true,isset($this->view->_style)?$this->view->_style:null);
            }
            $tempname=str_replace(".html","",$tempname);
            $url=config::get('site_url')."index.php?case=archive&act=list&pageset=1&isvisual=1&catid=".$catid.'&url='.lang::getisadmin();

            $url=service::dkUrl($url);

            $tempcontent = curlservice::curl_template($url);
            $tempcontent=service::getherf($tempcontent);
            if (front::post("refreshrigt")){
                lang::settistemplate($this->_langtemplate);
                echo $tempcontent;exit;
            }
            lang::settistemplate(lang::getisadmin());
            load_lang('system.php','system_custom.php');

            //判断商品
            front::$isvalue=true;
            if($categorydata['isshopping']){
                $tempheader= template_shopping('header.html');
                $tempfooter=template_shopping('footer.html');                $this->view->isshopping=1;
                $dir = config::get('template_shopping_dir');
            }
            else{
                $tempheader= template('header.html');
                $tempfooter=template('footer.html');                $this->view->isshopping=0;
                $dir = config::get('template_dir');
            }
            //加载头部
            //$tempheader=$this->view->getvisualhead($dir);
            //加载底部文件
            //$tempfooter=$this->view->getvisualfooter($dir);


            lang::settistemplate($this->_langtemplate);
            //链接需要修改  只针对商品内页  批量替换
            $tempheader=service::getherf($tempheader);
            $tempfooter=service::getherf($tempfooter);
            //var_dump($file);
            $this->view->tempname = $tempname;
            $this->view->tempcontent = $tempcontent;
            $this->view->tempheader = $tempheader;
            $this->view->tempfooter = $tempfooter;

            $content = $this->view->adminfetch();
            echo($content);
        }
        exit;
    }

    function sitemap_action()
    {
        chkpw('template_visual');
        //获取已经购买的插件
        $this->view->returndata=service::getInstance()->getlogin();


        lang::settistemplate(lang::getisadmin());
        load_lang('system.php','system_custom.php');

        //判断商品
        front::$isvalue=true;

        $tempheader= template('header.html');
        $tempfooter=template('footer.html');
        $this->view->isshopping=0;
        $dir = config::get('template_dir');

        $tempcontent= @file_get_contents(ROOT . '/data/template/'. $dir . '/system/sitemap.html');
        /*增加解析*/
        $tempcontent=$this->view->viewcompile($tempcontent);
        $path=ROOT . '/cache/view/template/'.lang::getisadmin().'/'.$dir.'/system';
        $cacheFile=$path.'/#sitemap.html';
        if (file_exists($cacheFile)){
            unlink($cacheFile);
        };
        if (!file_exists($cacheFile)){
            if (!file_exists( $path )) {mkdir ($path,0777,true );}
            file_put_contents($cacheFile, $tempcontent);
        }
        $tempcontent=$this->view->_eval($cacheFile,true);

        if (front::post("refreshrigt")){
            lang::settistemplate($this->_langtemplate);
            echo $tempcontent;exit;
        }


        lang::settistemplate($this->_langtemplate);
        //链接需要修改  只针对商品内页  批量替换
        $tempheader=service::getherf($tempheader);
        $tempfooter=service::getherf($tempfooter);
        //var_dump($file);
        $this->view->tempname = "system-sitemap";
        $this->view->tempcontent = $tempcontent;
        $this->view->tempheader = $tempheader;
        $this->view->tempfooter = $tempfooter;

        $content = $this->view->adminfetch();
        echo($content);
        exit;
    }


    function end()
    {
        $this->render();
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
