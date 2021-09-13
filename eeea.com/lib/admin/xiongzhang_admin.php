<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class xiongzhang_admin extends admin
{


    function end()
    {
        $this->render();
    }

    function index_action()
    {
        if (isset(front::$post['dosubmit']) && front::$post['dosubmit']) {
            $api = 'http://data.zz.baidu.com/urls?appid='.front::$post['appid'].'&token='.front::$post['token'].'&type=realtime';
            config::modify(array('xiongzhang_appid'=>front::$post['appid']));
            config::modify(array('xiongzhang_token'=>front::$post['token']));
            $ch = curl_init();
            $urls = front::$post['urls'];
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
            echo $result;
            exit;
        }
        $cate = category::getInstance();
        $archive = archive::getInstance();
        $row = $archive->countGroup("checked=1", 'catid');
        //var_dump($row);
        $mcounts = array_to_hashmap($row, 'catid', 'num');
        //var_dump($mcounts);

        /*$sql = "select catid,count(*) as num from ".config::get('database','prefix')."archive WHERE checked=1 AND state=1 GROUP BY catid order by catid asc";

        $rs = $cate->query($sql);
        var_dump($rs);
        while($row = $cate->fetch_array($rs)){
            var_dump($row);
        }*/
        //var_dump($cate->category);
        $str = config::get('site_url') . "\n";
        if (is_array($cate->category) && !empty($cate->category)) {
            foreach ($cate->category as $cat) {
                $page_size = config::get('list_pagesize');
                $ispage = $cat['ispages'];
                if (abs(intval($cat['attr3'])) > 0) {
                    $page_size = abs(intval($cat['attr3']));
                }
                $mcounts[$cat['catid']]=isset($mcounts[$cat['catid']])?$mcounts[$cat['catid']]:0;
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
        $this->view->urls = $str;
    }

    function getArchiveUrl($catid,$limit=25)
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
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.