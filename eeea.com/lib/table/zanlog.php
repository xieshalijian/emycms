<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class zanlog extends table {
    private static $_id;

    function getcols($act) {
        return '*';
    }
    function get_verify() {
        return array(
        );
    }

    function get_form() {
        return array(
        );
    }
    function get_form_field() {
    }
    public function get_where($act) {
    }
    public static function getInstance() {
        if(!self::$_id){
            self::$_id = new zanlog();
        }
        return self::$_id;
    }
    public function addlog($aid,$cid,$uid){
        return $this->rec_insert(array(
            'aid' => $aid,
            'cid' => $cid,
            'uid' => $uid,
            'addtime' => time(),
        ));
    }
    static function url($info,$page=null,$relative=false) {
    }
    static function countarchiveformtype($catid) {
    }
    static function countarchiveformcategory($catid) {
    }
    function getattrs($att_order=1) {
    }
    static function getgrade($grade) {
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.