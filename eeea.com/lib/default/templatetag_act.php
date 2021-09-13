<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class templatetag_act extends act {
    function init() {
		$this->check_pw();
    }
    function get_action() {
        front::check_type(front::get('id'));
        $tagid=front::get('id');
        if (front::get('shopping')){
            echo tool::text_javascript(shoptemplatetag::tag($tagid));
        }else{
            echo tool::text_javascript(templatetag::tag($tagid));
        }
    }
    function test_action() {
        front::check_type(front::get('id'));
        $tagid=front::get('id');
        if (front::get('shopping')){
            echo shoptemplatetag::tag($tagid);
        }else{
            echo templatetag::tag($tagid);
        }
    }
    function visual_action() {
        if ($this->view->usergroupid != '888')
            throw new HttpErrorException(404,lang('page_does_not_exist'),404);
        $id=front::get('id');
        $tpl=str_replace('_d_','/',$id);
        $tpl=str_replace('#','',$tpl);
        $tpl=str_replace('_html','.html',$tpl);
        $content=file_get_contents(TEMPLATE.'/'.config::get('template_dir').'/'.$tpl);
        $content=front::$view->compile($content);

        $path=TEMPLATE.'/'.config::get('template_dir');
        $cacheFile=$path.'/#'.$tpl;
        if (!file_exists($cacheFile)){
            if (!file_exists( $path )) {mkdir ($path,0777,true );}
            file_put_contents($cacheFile, $content);
        }
        echo @front::$view->_eval($cacheFile);
        $this->render('../admin/system/tag_visual.php');
    }

    function tagmodules_action() {
       if (front::post('modulesname')){
           $content=templatetag::tagmodules(front::post('modulesname'),front::post('lang'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
    function shop_tagmodules_action() {
       if (front::post('modulesname')){
           $content=shoptemplatetag::tagmodules(front::post('modulesname'),front::post('lang'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
    function tagslide_action() {
       if (front::post('slidename') || front::post('out')){
           $content=templatetag::tagslide(front::post('slidename'),front::post('out'),front::post('isbuy'),front::post('issections'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
    function shop_tagslide_action() {
        if (front::post('slidename') || front::post('out')){
           $content=shoptemplatetag::tagslide(front::post('slidename'),front::post('out'),front::post('isbuy'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
    function tagform_action() {
       if (front::post('formname')){
           $content=templatetag::tagform(front::post('formname'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
    function tagbuymodules_action() {
       if (front::post('modulesname')){
           $content=templatetag::tagbuymodules(front::post('modulesname'),front::post('lang'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
    function shoo_tagbuymodules_action() {
       if (front::post('modulesname')){
           $content=shoptemplatetag::tagbuymodules(front::post('modulesname'),front::post('lang'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
    function tagsections_action() {
       if (front::post('sectionsname')){
           $content=templatetag::tagsections(front::post('sectionsname'),front::post('istemplate'),front::post('isshopping'),true);
           echo $content;
       }else{
           echo "";
       }
       exit;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
