<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class history extends table
{

    public $name = 'user_history';
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new history();
            self::$me = $class;
        }
        return self::$me;
    }

    function getcols($act)
    {
        switch ($act) {
            case 'manage':
                return '*';
            default:
                return '*';
        }
    }

    //查询当前用户所有的浏览记录
    static function getcouponidnum() {
        $history = new history();
        $historydata = $history->getrows("userid='".user::getusersid()."'",0);
        return $historydata;
    }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.