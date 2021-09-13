<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class hprose_admin extends admin
{

    public function saveCate($cate){
        if(is_array($cate) && !empty($cate)) {
            $obj = cate::getInstance();
            foreach ($cate as $item) {
                if (isset($item['catid']) && $item['catid']) {
                    $obj->rec_update(array(
                        'catname' => $item['catname'],
                        'sort' => $item['sort'],
                    ), array('catid' => $item['catid']));
                } else {
                    $res = $obj->rec_insert(array(
                        'catname' => $item['catname'],
                        'sort' => $item['sort'],
                        'cattype' => 1,
                        'num' => 0,
                    ));
                }
            }
            return lang_admin('save_successfully');
        }
        return lang_admin('no_data');
    }

    public function delCate($catid){
        $obj = cate::getInstance();
        $catid = intval($catid);
        $obj->rec_delete(array('catid' => $catid));
        return lang_admin('delete').lang_admin('success');
    }

    public function getCateList(){
        $obj = cate::getInstance();
        $rows = $obj->getrows(array('cattype'=>1),0,'sort=0,sort asc');
        return $rows;
    }

    public function handle_action(){
        include_once(ROOT.'/lib/plugins/hprose/Hprose.php');
        $hprose = new \Hprose\Http\Server();
        $hprose->debug = true;
        $hprose->crossDomain = true;
        $hprose->addMethods(array('getCateList','saveCate','delCate'),$this);
        $hprose->handle();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
