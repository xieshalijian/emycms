<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class comment_admin extends admin
{
    function init()
    {
        $this->check_pw();
        $this->_langtemplate=lang::getistemplate();
    }


    function list_action()
    {
        chkpw('template_visual');

        //获取已经购买的插件
        $this->view->returndata=service::getInstance()->getlogin();

        $tempname="comment/list";
        $aid=front::get('aid');
        $url=config::get('site_url')."index.php?case=comment&act=list&aid=".$aid."&pageset=1&isvisual=1".'&url='.lang::getisadmin();;
        $url=service::dkUrl($url);

        lang::settistemplate(lang::getisadmin());
        load_lang('system.php','system_custom.php');

        //判断商品
        front::$isvalue=true;
        $tempheader= template('header.html');
        $tempfooter=template('footer.html');
        $this->view->isshopping=0;
        $tempcontent = curlservice::curl_template($url);
        $tempcontent=service::getherf($tempcontent);
        if (front::post("refreshrigt")){
            lang::settistemplate($this->_langtemplate);
            echo $tempcontent;exit;
        }
        //最后恢复前台语言包
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
        exit;
    }

    function end()
    {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
