<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class cate extends table
{
    public $name = 'g_cate';
    static $me;

    function getcols($act)
    {
        return '*';
    }

    function get_form()
    {
        return array(

        );
    }

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new cate();
            self::$me = $class;
        }
        return self::$me;
    }

    public static function option()
    {
        $cate = self::getInstance();
        $rows = $cate->getrows(array('cattype'=>1),0,'sort=0,sort asc');
        $option = array_to_hashmap($rows,'catid','catname');
        return $option;
    }

    public static function url($catid)
    {
        return url('guestbook/index/catid/'.$catid,false);
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.