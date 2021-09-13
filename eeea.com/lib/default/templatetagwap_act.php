<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class templatetagwap_act extends act {
    function init() {
		$this->check_pw();
    }
    function get_action() {
        front::check_type(front::get('id'));
        $tagid=front::get('id');
        echo tool::text_javascript(templatetagwap::tag($tagid));
    }
    function test_action() {
        front::check_type(front::get('id'));
        $tagid=front::get('id');
        echo templatetagwap::tag($tagid);
    }
    function visual_action() {
        if ($this->view->usergroupid != '888')
            throw new HttpErrorException(404,lang('page_does_not_exist'),404);
        $id=front::get('id');
        $tpl=str_replace('_d_','/',$id);
        $tpl=str_replace('#','',$tpl);
        $tpl=str_replace('_html','.html',$tpl);
        $content=file_get_contents(TEMPLATE.'/'.config::get('template_mobile_dir').'/'.$tpl);

        $content=front::$view->compile($content);

        $path=TEMPLATE.'/'.config::get('template_mobile_dir');
        $cacheFile=$path.'/#'.$tpl;
        if (!file_exists($cacheFile)){
            if (!file_exists( $path )) {mkdir ($path,0777,true );}
            file_put_contents(iconv("utf-8", "gbk",$cacheFile), $content);
        }

        echo @front::$view->_eval($cacheFile);

        $this->render('../admin/system/tag_visual.php');
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
