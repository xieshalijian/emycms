<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class user extends table
{
    static $me;

    public static function getInstance()
    {

        if (!self::$me) {
            $class = new user();
            self::$me = $class;
        }
        return self::$me;
    }

    function getcols($act)
    {
        switch ($act) {
            case  'list':
                return 'userid,username,integration,adddatetime,menoy,nickname,groupid,headimage,collect,expired_time' . $this->mycols();
            case 'modify':
                return 'userid,password,username,adddatetime,integration,nickname,menoy,groupid,qq,e_mail,tel,address,checked,headimage,collect,expired_time' . $this->mycols();
            case 'manage':
                return 'userid,username,integration,adddatetime,nickname,groupid,menoy,checked,isblock,headimage,collect,expired_time';
            default:
                return '1';
        }
    }

    function get_form()
    {
        return array(
            'groupid' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(usergroup::option()),
            ),
            'checked' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(form::yesornotoarray(lang_admin('to_examine'))),
            ),
        );
    }

    function get_form_field()
    {
        return array(
            'groupid' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(usergroup::option()),
            ),
            'checked' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(form::yesornotoarray(lang_admin('to_examine'))),
            ),
        );
    }

    //积分增加
    static function setintegration($moeny,$username=''){
        $moeny=floatval($moeny);
        $cs = new user();
        if($username==''){
            $username=session::get('username');
        }
        $sps = $cs->getrows("username='".$username."'", 1);
        if(usergroup::isadministrator($sps[0]['groupid'])=='0'){
            $moeny=floatval($sps[0]['integration'])+floatval($moeny);
        }else{
            $moeny=0;
        }
        $moenyarray = array('integration' => $moeny);
        if(usergroup::isadministrator($sps[0]['groupid'])=='0') {
            $dj = new usergroup();
            //判断是否商户组
            $where=null;
            if (usergroup::getismerchant($sps[0]['groupid'])){
                $where="ismerchant=1";
            }
            $djs = $dj->getrows($where, 99, 'integrationclaim ASC');
            $moenyarray['groupid'] = $sps['groupid'];
            foreach ($djs as $g) {
                if ($moeny >= $g['integrationclaim']) {
                    $moenyarray['groupid'] = $g['groupid'];
                }
            }
        }
        $cs->rec_update($moenyarray, "username='".$username."'");
    }

    //积分减少
    static function editintegration($moeny){
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if(usergroup::isadministrator($sps[0]['groupid'])=='0'){
            $moeny=floatval($sps[0][integration])-floatval($moeny);
        }else{
            $moeny=0;
        }
        $moenyarray = array('integration' => $moeny);
        $cs->rec_update($moenyarray, "username='".session::get('username')."'");
    }

    //优惠劵变更
    static function setcouponidnum($couponid,$num=1,$statu='+'){
        $user = new user();
        $couponidnum=$user->getcouponidnum();
        if($couponidnum !=''){
            if( strpos($couponidnum, $couponid) !== false){
                $source = explode(",",trim($couponidnum));
                for($index=0;$index<count($source);$index++){
                    $sourcearry=explode(":",trim($source[$index]));
                    if($sourcearry[0]==$couponid){
                        if($statu=='+'){
                            $sourcearry[1]=(int)$sourcearry[1]+$num;
                        }else{
                            $sourcearry[1]=(int)$sourcearry[1]-$num;
                            $sourcearry[2]=(int)$sourcearry[2]+$num;
                        }
                    }
                        if($index==0){
                            $couponidnum=$sourcearry[0].':'. $sourcearry[1].':'. $sourcearry[2];
                        }else{
                            $couponidnum=$couponidnum.','.$sourcearry[0].':'. $sourcearry[1].':'.$sourcearry[2];
                        }

                }
            }else{
                $couponidnum=$couponidnum.','.$couponid.':'.$num.':0';
            }
        }else{
            $couponidnum=$couponid.':'.$num.':0';
        }

        //修改用户的优惠劵
        $setuserdata = array('couponidnum' => $couponidnum);
        $user->rec_update($setuserdata, "username='".session::get('username')."'");
    }

    //查询当前用户优惠劵
    static function getcouponidnum() {
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if (isset($sps[0]['couponidnum']))
            return $sps[0]['couponidnum'];
        else
            return '';
    }

    //查询当前用户积分
    static function getintegration() {
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if (isset($sps[0]['integration']))
            return $sps[0]['integration'];
        else
            return 0;
    }
    //查询当前用户头像
    static function getuserheadimg($userid) {
        $cs = new user();
        $sps = $cs->getrows("userid='".$userid."'", 1);
        if (isset($sps[0]['headimage']))
            return $sps[0]['headimage'];
        else
            return "";
    }

    //查询当前用户余额
    static function getmenoy() {
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if (isset($sps[0]['menoy']))
            return round($sps[0]['menoy'],2);
        else
            return 0;
    }

    //收藏增删
    static function setcollect($couponid){
        $user = new user();
        $usercollect=$user->getcollect();
        $messagelist='1';
        if($usercollect !=''){
            if($usercollect==$couponid ||  strpos($usercollect, ",".$couponid) !== false
                ||  strpos($usercollect, $couponid.",") !== false){
                $source = explode(",",trim($usercollect));
                $usercollect='';  //先清空
                for($index=0;$index<count($source);$index++){
                    $collect_array = explode(':',$source[$index]);
                    if($collect_array[0] !=$couponid) {
                        $usercollect=$usercollect.','.$source[$index];
                    }
                }
                if( strpos($usercollect, ',') !== false){
                    $usercollect = substr($usercollect,1,strlen($usercollect));
                }
                $messagelist='0';
            }else{
                $usercollect=$usercollect.','.$couponid.':'.time();
            }
        }else{
            $usercollect=$couponid.':'.time();
        }

        //修改用户的收藏
        $setuserdata = array('collect' => $usercollect);
        $user->rec_update($setuserdata, "username='".session::get('username')."'");

        return $messagelist;
    }
    //收藏增删
    static function setcollectbuytemplate($couponid){
        $user = new user();
        $usercollect=$user->getcollectbuytemplate();
        $messagelist='1';
        if($usercollect !=''){
            if( strpos($usercollect, $couponid) !== false){
                $source = explode(",",trim($usercollect));
                $usercollect='';  //先清空
                for($index=0;$index<count($source);$index++){
                    if($source[$index]!=$couponid) {
                        $usercollect=$usercollect.','.$source[$index];
                    }
                }
                if( strpos($usercollect, ',') !== false){
                    $usercollect = substr($usercollect,1,strlen($usercollect));
                }
                $messagelist='0';
            }else{
                $usercollect=$usercollect.','.$couponid;
            }
        }else{
            $usercollect=$couponid;
        }

        //修改用户的收藏
        $setuserdata = array('collectbuytemplate' => $usercollect);
        $user->rec_update($setuserdata, "username='".session::get('username')."'");

        return $messagelist;
    }

    //查询当前用户头像
    static function getuserimg($username) {
        $cs = new user();
        $sps = $cs->getrows("username='".$username."'", 1);
        if (isset($sps[0]['headimage']))
            return $sps[0]['headimage'];
        else
            return 0;
    }

    //查询收藏商品
    static function getcollect() {
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if (isset($sps[0]['collect']))
            return $sps[0]['collect'];
        else
            return '';
    }
    //查询收藏在线模板
    static function getcollectbuytemplate() {
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if (isset($sps[0]['collectbuytemplate']))
            return $sps[0]['collectbuytemplate'];
        else
            return '';
    }

    //查询用户名称
    static function getusername($userid) {
        $cs = new user();
        $sps = $cs->getrows("userid='".$userid."'", 1);
        if (isset($sps[0]['username']))
            return $sps[0]['username'];
        else
            return '';
    }

    //查询邮箱
    static function getuseremail($userid) {
        $cs = new user();
        $sps = $cs->getrows("userid='".$userid."'", 1);
        if (isset($sps[0]['e_mail']))
            return $sps[0]['e_mail'];
        else
            return '';
    }
    //查询手机号
    static function getusertel($userid) {
        $cs = new user();
        $sps = $cs->getrows("userid='".$userid."'", 1);
        if (isset($sps[0]['tel']))
            return $sps[0]['tel'];
        else
            return '';
    }

    //查询用户所在的用户组ID
    public static function getuserid() {
        $cs = new user();
        if (front::get("ajax")){
            $username= cookie::get('login_username');
        }else{
            $username=session::get('username');
        }
        $sps = $cs->getrows("username='".$username."'", 1);
        if (isset($sps[0]['groupid']))
            return $sps[0]['groupid'];
        else
            return '';
    }

    //通过用户名称模糊查多个用户id
    static function getusernameTouserid($username) {
        $cs = new user();
        $sps = $cs->getrows("username like '%".$username."%'", 999);
        $useriddata="";
        if (is_array($sps)){
            foreach ($sps as $key=>$val){
                if($useriddata ==""){
                    $useriddata=$val['userid'];
                }else{
                    $useriddata=$useriddata.','.$val['userid'];
                }
            }
        }
        return $useriddata;
    }

    //返回当前用户id
    public static function getusersid() {
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if (isset($sps[0]['userid']))
            return $sps[0]['userid'];
        else
            return '';
    }

    //返回当前用户已读通知
    static function getnotifiid() {
        $cs = new user();
        $sps = $cs->getrows("username='".session::get('username')."'", 1);
        if (isset($sps[0]['notifiid']))
            return $sps[0]['notifiid'];
        else
            return '';
    }

    public static function option()
    {
            if(session::get("useroption_".lang::getisadmin()) && !front::get("ajax")){
                return session::get("useroption_".lang::getisadmin());
            }
            $sp = new user();
            $sps = $sp->getrows('groupid!=101 and groupid!=1000', 500);
            $options = array(0 => lang_admin('please_choose').'...');
            foreach ($sps as $sp) {
                $options[$sp['userid']] = $sp['username'];
            }
            if (!front::get("ajax")) {
                session::set("useroption_" . lang::getisadmin(), $options);
            }
            return $options;
    }

    public static function user_option()
    {
            if(session::get("user_option_".lang::getisadmin()) && !front::get("ajax")){
                return session::get("user_option_".lang::getisadmin());
            }
            $usergroup=usergroup::getInstance()->getrows("isadministrator=0",0,"groupid asc","groupid");
             $usergroup_id="";
            foreach ($usergroup as $val){
                $usergroup_id.=($usergroup_id=="")?$val['groupid']:",".$val['groupid'];
            }
            $sp = new user();
            $sps = $sp->getrows('groupid in ('.$usergroup_id.')', 0);
            $options = array(0 => lang_admin('please_choose').'...');
            foreach ($sps as $sp) {
                $options[$sp['userid']] = $sp['username'];
            }
            if (!front::get("ajax")) {
                session::set("user_option_" . lang::getisadmin(), $options);
            }
            return $options;
    }

    public static function deletesession(){

        if (session::get("useroption_".lang::getisadmin())) {
            session::del("useroption_" . lang::getisadmin());
        }
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.