<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

class slide_act extends act
{

    function init()
    {
        $this->_slide=new slide();
        $this->_slide_child=new slidechild();
        $this->manage=new table_slide();
    }


    //查询下拉框
    function getsearch_catid_action(){
        //获取全部幻灯片绑定的栏目id
        $slidedata =  $this->_slide->getrows(null, 0,'id asc ');
        $catid="";
        foreach ($slidedata as $val){
            if ($val['banner_catid'])
                $catid.=($catid==""?$val['banner_catid']:",".$val['banner_catid']);
        }

        if (front::get("shopping")) {
            $data=category::getoptionshopping();
        }else{
            $data=category::getoptionconnent();
        }
        $select="";
        $data[0]=lang_admin('please_choose')."...";
        //过滤掉catid
        $carid_array = explode(',',$catid);
        $thiscarid_array = isset(front::$get['catid'])?explode(',',front::$get['catid']):array();
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";
            if (is_array($carid_array) && in_array($k,$carid_array) && !in_array($k,$thiscarid_array)) {
                $select .= ' disabled ';
            }
            elseif (is_array($thiscarid_array) && in_array($k,$thiscarid_array) && $k!=0) {
                $select .= ' selected ';
            }
            $select .= ">$d</option>";


        }
        echo $select;
        exit;
    }

    function getsearch_typeid_action(){
        //提取分类
        if(!file_exists(ROOT."/lib/table/type.php")) {
            return "";exit;
        }
        //获取全部幻灯片绑定的栏目id
        $slidedata =  $this->_slide->getrows(null, 0,'id asc ');
        $typeid="";
        foreach ($slidedata as $val){
            if ($val['banner_typeid'])
                $typeid.=($typeid==""?$val['banner_typeid']:",".$val['banner_typeid']);
        }

        $data=type::getoption();
        $select="";
        $data[0]=lang_admin('please_choose')."...";
        //过滤掉catid
        $typeid_array = explode(',',$typeid);
        $thistypeid_array = isset(front::$get['typeid'])?explode(',',front::$get['typeid']):array();
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";
            if (is_array($typeid_array) && in_array($k,$typeid_array) && !in_array($k,$thistypeid_array)) {
                $select .= ' disabled ';
            }
            elseif (is_array($thistypeid_array) &&  in_array($k,$thistypeid_array) && $k!=0) {
                $select .= ' selected="selected" ';
            }
            $select .= ">$d</option>";
        }
        echo $select;
        exit;
    }


    function end($cache=false)
    {
        $this->render();
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
