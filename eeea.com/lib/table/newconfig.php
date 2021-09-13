<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class newconfig extends table
{

    public $name = 'newconfig';
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new newconfig();
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

    function get_form()
    {
        return array(
            'type' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array('text' => '文本框')),
                'default' => '0',
            ),
        );
    }




}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.