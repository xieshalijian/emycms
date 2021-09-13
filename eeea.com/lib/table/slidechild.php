<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class slidechild  extends table {
    public $name='slide_child';
    static $me;
    public static function getInstance() {
        if (!self::$me) {
            $class=new slidechild();
            self::$me=$class;
        }
        return self::$me;
    }

    function getcols($act) {
        return '*';
    }

    function get_form() {
        return array(


        );
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.