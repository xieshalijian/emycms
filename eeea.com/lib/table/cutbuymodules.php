<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class cutbuymodules extends table
{

    public $name = 'b_buymodules';
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new cutbuymodules();
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
            'type' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array('common' => lang_admin('global_components'),'category' => lang_admin('column_component')
                ,'content' => lang_admin('content_components'),'form' => lang_admin('form_components'),'page' => lang_admin('page_components') )),
                'default' => 'common',
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