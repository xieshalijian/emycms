<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
ignore_user_abort(true);
set_time_limit(0);

class crontab_act extends act {

    public function init(){
        $token = config::get('cookie_password');
        if(front::get('token') != $token){
            @file_put_contents(CACHE_DIR . '/data/warning.log',@file_get_contents(CACHE_DIR . '/data/warning.log').lang('not_background_request').$_SERVER['REQUEST_URI']."\r\n");
        }
    }

    public function xiongzhang_action(){

        $cate = category::getInstance();
        $archive = archive::getInstance();
        $row = $archive->countGroup("checked=1", 'catid');
        $mcounts = array_to_hashmap($row, 'catid', 'num');
        $str = config::get('site_url') . "\n";
        if (is_array($cate->category) && !empty($cate->category)) {
            foreach ($cate->category as $cat) {
                $page_size = config::get('list_pagesize');
                $ispage = $cat['ispages'];
                if (abs(intval($cat['attr3'])) > 0) {
                    $page_size = abs(intval($cat['attr3']));
                }
                $pages = ceil($mcounts[$cat['catid']] / $page_size);
                if ($ispage) {
                    for ($i = 1; $i <= $pages; $i++) {
                        $str .= config::get('site_url') . ltrim($cate->url($cat['catid'], $i), '/') . "\n";
                    }
                } else {
                    $str .= config::get('site_url') . ltrim($cate->url($cat['catid']), '/') . "\n";
                }
                $str .= $this->getArchiveUrl($cat['catid']);
            }
        }

        $appid = config::get('xiongzhang_appid');
        $token = config::get('xiongzhang_token');
        $api = 'http://data.zz.baidu.com/urls?appid='.$appid.'&token='.$token.'&type=realtime';
        $ch = curl_init();
        $urls = $str;
        $options = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $urls,
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        //@file_put_contents(CACHE_DIR . '/data/xiongzhang1.log',@file_get_contents(CACHE_DIR . '/data/xiongzhang1.log').date('Y-m-d').":::::\r\n请求:".$str."\r\n返回:".$result."\r\n=================\r\n");
        file_put_contents(CACHE_DIR . '/data/xiongzhang.log',date('Y-m-d'));
    }

    private function getArchiveUrl($catid,$limit=25)
    {
        $str = '';
        $archive = archive::getInstance();
        $cols = "aid,linkto,iswaphtml,htmlrule,catid";
        $rows = $archive->getrows(array("catid"=>$catid,"checked"=>1,"state"=>1),$limit,'aid desc',$cols);
        if(is_array($rows) && !empty($rows)){
            foreach ($rows as $row){
                $str .= config::get('site_url') .ltrim(archive::url($row), '/')."\n";
            }
        }
        return $str;
    }

    public function end(){

    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
