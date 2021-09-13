<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class slideconfig extends table {
    public $name='slide_config';
    static $me;
    public static function getInstance() {
        if (!self::$me) {
            $class=new slideconfig();
            self::$me=$class;
        }
        return self::$me;
    }

    function getcols($act) {
        return '*';
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.