<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
set_time_limit(0);
class history_admin extends admin
{

    function init()
    {

    }

    //新增点击路径 增加记录
    function historyadd_action(){
        if(!front::get('urlname') || !front::get('userurl') || !(isset(front::$user['userid']) && front::$user['userid'])){
           exit;
        }
        //全改为  未选择状态
        history::getInstance()->rec_update("static=0","langid=".lang::getlangid(lang::getisadmin()));
        //存在的话 改状态为打开
        $historydata=history::getInstance()->getrow("urlname='".front::get('urlname')."' and userid=".front::$user['userid']);
        if(is_array($historydata))
        if(count($historydata)>0){
            history::getInstance()->rec_update("static=1,langid=".lang::getlangid(lang::getisadmin()),"urlname='".front::get('urlname')."'");
            exit;
        }
        //不存在就新增  但是要判断数量  超过就减去最早的记录
        $historyolddata=history::getcouponidnum();
        if(count($historyolddata)>=config::getadmin("history_num")){
            $oldid=0;
            foreach ($historyolddata as $val){
                if(!$oldid){
                    $oldid= $val['id'];
                }else if($val['id']<$oldid){
                    $oldid= $val['id'];
                }
            }
            //删除最早的tag
            history::getInstance()->rec_delete("id=".$oldid);
        }
        $historydata=array(
            'userid'=>user::getusersid(),
            'urlname'=>front::get('urlname'),
            'url'=>htmlspecialchars_decode(front::get('userurl')),
            'static'=>'1',
            'langid'=>lang::getlangid(lang::getisadmin())
        );
        history::getInstance()->rec_insert($historydata);
        exit;
    }
    //删除用户浏览记录
    function historyrome_action(){

         if(!front::get('dataurlid')){
             exit;
         }
        history::getInstance()->rec_delete("id=".front::get('dataurlid'));
        exit;
    }
    //清空用户浏览记录
    function historyromeall_action(){
         if(front::get('id')==""){
             exit;
         }
        history::getInstance()->rec_delete("id <>'".front::get('id')."' and userid=".user::getusersid()." and langid=".lang::getlangid(lang::getisadmin()));
        exit;
    }
    //用户进入首页  其他状态全关闭
    function historyindex_action(){
        history::getInstance()->rec_update("static=0","langid=".lang::getlangid(lang::getisadmin()));
        exit;
    }

    function end()
    {

    }



}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
