<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class menu extends table {
    public $name='menu';
    static $me;
    public static function getInstance() {
        if (!self::$me) {
            $class=new menu();
            self::$me=$class;
        }
        return self::$me;
    }

    function getcols($act) {
        return '*';
    }

    function get_form() {
        return array(
            'status'=>array(
                'selecttype'=>'radio',
                'select'=>form::arraytoselect(array(0=>lang_admin('no'),1=>lang_admin('yes'))),
                'default'=>0,
            ),
        );
    }

    public static function getmenu(){
       $menudata=menu::getInstance()->getrows(null,0);
       $menudata_status=array();
       foreach ($menudata as $val){
           $menudata_status[$val['listkey']]=array("status"=>$val['status'],"listorder"=>$val['listorder']);
       }
       return $menudata_status;
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.