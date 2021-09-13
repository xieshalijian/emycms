<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class weixinmenu  extends table {

    public $name='weixinmenu';

    function getsubmenu($pid){
        $where = array('pid'=>$pid);
        $ordre='sort=0,`sort` ASC';
        return $this->getrows($where,'',$ordre,'*');
    }

    static function getTypeName($typeid){
        switch ($typeid){
            case 1:
                return lang_admin('menu');
            case 2:
                return lang_admin('open_the_web_site');
            case 3:
                return lang_admin('written_reply');
            case 4:
                return lang_admin('graphic_reply');
            case 5:
                return lang_admin('website_content_push');
            default:
                return '';
        }
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.