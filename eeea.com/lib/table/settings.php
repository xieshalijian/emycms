<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class settings extends table {
    private static $me;
    public static function getInstance() {
        if(!self::$me) {
            $class = new settings();
            self::$me=$class;
        }
        return self::$me;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.