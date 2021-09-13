<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
set_time_limit(0);
class appconfig_admin extends admin
{

    function init()
    {
        $this->_table = new appconfig();
         if (!front::get('page'))
             front::$get['page'] = 1;
        $this->manage = new table_appconfig();
    }

    function edit_action()
    {
        $this->_view_table = $this->_table->getrows('appname="'.front::get('appname').'"',0);
        foreach ($this->_view_table as $key=>$val){
            if($val['type']==2 || $val['type']==3){
                $othervalue_list = trim($val['othervalue']);
                $othervalue_arr = explode("\r\n", $othervalue_list);
                $newothervalue=array();
                foreach ($othervalue_arr as $value){
                    $othervaluedata=explode("/", $value);
                    $newothervalue[$othervaluedata[0]]=$othervaluedata[1];
                }
                $this->_view_table[$key]['othervalue']=$newothervalue;
            }
            $appfiledname="";
            if($appfiledname==""){
                $appfiledname=$val['name'];
            }else{
                $appfiledname.=','.$val['name'];
            }
            $this->view->appfiledname = $appfiledname;
        }
        if (front::post('submit') && front::post('appfiledname')) {
            $appfilednamedata=explode(",", front::post('appfiledname'));
            foreach ($appfilednamedata as $val){
                $this->_table->rec_update(array("value"=>front::post($val)),array("appname"=>front::get('appname'),"name"=>$val));
            }
            front::flash(lang_admin('公用配置表').lang_admin('modify').lang_admin('success')."！");
            front::redirect(url(front::get('appname').'/list', true));
        }
        if (!is_array($this->_view_table))
            exit("PAGE_NOT FOUND!");
        $this->manage->view_before($this->_view_table);
    }


    function view($table)
    {
        $this->view->data = $table['data'];
        $this->view->field = $table['field'];
    }

    function end()
    {
        if (!isset($this->_view_table))
            return;
        if (!isset($this->_view_table['data']))
            $this->_view_table['data'] = $this->_view_table;
        $this->_view_table['field'] = $this->_table->getFields();
        $this->view->fieldlimit = $this->_table->getcols(front::$act == 'list' ? 'manage' : 'modify');
        $this->view($this->_view_table);
        $this->render();

    }



}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
