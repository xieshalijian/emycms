<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class cutbuytemplate extends table
{

    public $name = 'b_buytemplate';
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new cutbuytemplate();
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
            'iscorp' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => '是', 0 => '否')),
                'default' => '0',
            ),
            'isview' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(0 => '无', 1 => '可视化',2 => '自适应')),
                'default' => '0',
            ),
            'static' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => lang_admin('release'), 0 =>lang_admin('no_release'))),
                'default' => '0',
            ),
        );
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.