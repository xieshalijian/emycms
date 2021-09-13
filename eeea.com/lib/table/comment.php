<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class comment extends table
{
    public static $_self;

    public $name = 'a_comment';

    public static function getIns(){
        if(!self::$_self){
            self::$_self = new comment();
        }
        return self::$_self;
    }

    function get_form() {
        return array(
            'isusersee'=>array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => lang_admin('yes'), 0 => lang_admin('no'))),
                'default' => 1,
            ),
        );
    }

    static function countcomment($aid)
    {
        $com = new comment();
        return $com->rec_count("state=1 and aid='$aid' and (( userid<>'". user::getusersid()."' and issee=0 ) or (userid='".user::getusersid()."'))") ;
    }

    function countcommentstate($aid)
    {
        $com = new comment();
        return $com->rec_count(array('aid'=>intval($aid),'state'=>'1'));
    }

    function getcols($act = '')
    {
        return '*';
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.