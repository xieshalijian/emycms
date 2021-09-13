<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');
class slide extends table {
    public $name='slide';
    static $me;
    public static function getInstance() {
        if (!self::$me) {
            $class=new slide();
            self::$me=$class;
        }
        return self::$me;
    }
    function getcols($act) {
        return '*';
    }
    function get_form() {
        return array(
            'slide_style_position'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(array(0=>lang_admin('be_at_the_left_side'),1=>lang_admin('centered'),2=>lang_admin('be_at_the_right'))),
                'default'=>0,
            ),
            'slide_btn_shape'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(array(1=>lang_admin('circular'),2=>lang_admin('square'))),
                'default'=>2,
            ),
        );
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.