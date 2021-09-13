<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');
class logistics_admin extends admin {
    protected $_table;
    function init() {
        $this->table=front::get('table');
        if (preg_match('/^my_/',$this->table)) {
            form_admin::init();
            $this->_table=new defind($this->table);
        }
        else $this->_table=new $this->table;
        $this->_table->getFields();
        $this->view->form=$this->_table->get_form();
        $this->tname=lang_admin($this->table);
        if($this->table=='logistics')
            $this->tname=lang_admin('distribution_mode');
        $this->_pagesize=config::get('manage_pagesize');
        $this->view->table=$this->table;
        $this->view->primary_key=$this->_table->primary_key;
        if (!front::get('page')) front::$get['page']=1;
        $this->Exc=$this->table == 'templatetag'?true : false;
        $manage='table_'.$this->table;
        if (preg_match('/^my_/',$this->table)) $manage='table_form';
        $this->manage=new $manage;
    }
    function list_action() {
    	chkpw('order_logistics');
        $set1=settings::getInstance();
        $sets1=$set1->getrow(array('tag'=>'table-'.$this->table));
        $setsdata1=isset($sets1['value'])?unserialize($sets1['value']):"";
        $this->view->settings=$setsdata1;
        $where=null;
        $ordre='`id` DESC';
        $limit=((front::get('page') -1) * $this->_pagesize).','.$this->_pagesize;
        $this->_view_table=$this->_table->getrows($where,$limit,$ordre,'*');
    }
    function add_action() {
        if (front::post('submit') &&$this->manage->vaild()) {
            $this->manage->filter($this->Exc);
            $this->manage->add_before($this);
            $this->manage->save_before();
            $insert=$this->_table->rec_insert(front::$post);
            $_insertid = $this->_table->insert_id();
            if ($insert <1) {
                front::flash("{$this->tname}".lang_admin('add_to').lang_admin('failure')."！");
            }
            else {
                $this->manage->save_after($_insertid);
                $info='';
                front::flash("{$this->tname}".lang_admin('add_to').lang_admin('success')."！$info");
                front::redirect(url::modify('act/list',true));
            }
        }
        $this->_view_table=array();
        $this->_view_table['data']=array();
    }
    function edit_action() {
        if (front::post('submit') &&$this->manage->vaild()) {
            $this->manage->filter($this->Exc);
            $this->manage->edit_before();
            $this->manage->save_before();
            $update=$this->_table->rec_update(front::$post,front::get('id'));
            if ($update <1) {
                front::flash("{$this->tname}".lang_admin('modify').lang_admin('failure')."！");
            }
            else {
                $this->manage->save_after(front::get('id'));
                $info='';
                front::flash("{$this->tname}".lang_admin('modify').lang_admin('success')."！$info");
                $from=session::get('from');
                session::del('from');
                if (!front::post('onlymodify')) front::redirect(url::modify('act/list',true));
            }
        }
        if (!session::get('from')) session::set('from',front::$from);
        if (!front::get('id')) exit("PAGE_NOT FOUND!");
        $this->_view_table=$this->_table->getrow(front::get('id'),'1',$this->_table->getcols('modify'));
        if (!is_array($this->_view_table)) exit("PAGE_NOT FOUND!");
        $this->manage->view_before($this->_view_table);
    }
    function show_action() {
        front::check_type(front::$get['id']);
        $this->_view_table=$this->_table->getrow(front::$get['id'],1,'1 desc',$this->_table->getcols('modify'));
    }
    function batch_action() {
        if (front::post('batch') &&front::post('select')) {
            $select=implode(',',front::post('select'));
            $select=$this->_table->primary_key.' in ('.$select.')';
            if (front::post('batch') == 'check') {
                $check=$this->_table->rec_update(array('checked'=>1),$select);
                if ($check >0) front::flash("{$this->tname}".lang_admin('to_examine').lang_admin('complete')."！");
                else front::flash("{$this->tname}".lang_admin('not_audited')."！");
            }
            elseif (front::post('batch') == 'move'&&front::post('typeid')) {
                if (in_array(front::post('typeid'),front::post('select'))) front::flash(lang_admin('cannot_be_moved_to_this_category'));
                else {
                    $check=$this->_table->rec_update(array('parentid'=>front::post('typeid')),$select);
                    if ($check >0) front::flash(lang_admin('type_move_successfully'));
                    else front::flash(lang_admin('no_type_was_moved'));
                }
            }
            elseif (front::post('batch') == 'move'&&front::post('catid')) {
                if (in_array(front::post('catid'),front::post('select'))) front::flash(lang_admin('can_not_move_to_this_column'));
                else {
                    $check=$this->_table->rec_update(array('parentid'=>front::post('catid')),$select);
                    if ($check >0) front::flash(lang_admin('column_moved_successfully'));
                    else front::flash(lang_admin('no_columns_have_been_moved'));
                }
            }
            elseif (front::post('batch') == 'movelist'&&front::post('catid')) {
                $check=$this->_table->rec_update(array('catid'=>front::post('catid')),$select);
                if ($check >0) front::flash(lang_admin('move_successfully'));
                else front::flash(lang_admin('no_content_has_been_moved'));
            }
            elseif (front::post('batch') == 'recommend'&&front::post('attr1')) {
                $check=$this->_table->rec_update(array('attr1'=>front::post('attr1')),$select);
                if ($check >0) front::flash(lang_admin('setup_recommendation_successful'));
                else front::flash(lang_admin('no_content_is_set'));
            }
            elseif (front::post('batch') == 'deletestate') {
                $deletestate=$this->_table->rec_update(array('state'=>-1),$select);
                if ($deletestate >0) front::flash("{$this->tname}".lang_admin('has_been_moved_to_the_Recycle_Bin')."！");
                else front::flash("{$this->tname}".lang_admin('not_moved_to_the_Recycle_Bin')."！");
            }
            elseif (front::post('batch') == 'restore') {
                $deletestate=$this->_table->rec_update(array('state'=>0),$select);
                if ($deletestate >0) front::flash("{$this->tname}".lang_admin('has_been_restored')."！");
                else front::flash("{$this->tname}".lang_admin('not_restored')."！");
            }
            elseif (front::post('batch') == 'delete') {
                foreach (front::post('select') as $id) {
                    $this->manage->delete_before($id);
                }
                $delete=$this->_table->rec_delete($select);
                if ($delete >0) front::flash(lang_admin('success').lang_admin('delete')."{$this->tname}！");
                else front::flash("{$this->tname}".lang_admin('delete').lang_admin('failure')."！");
            }
            elseif (front::post('batch') == 'addtospecial') {
                $add=$this->_table->rec_update(array('spid'=>front::post('spid')),$select);
            }
            elseif (front::post('batch') == 'removefromspecial') {
                $add=$this->_table->rec_update(array('spid'=>null),$select);
            }
        }
        if (front::post('batch') == 'listorder') {
            $orders=front::post('listorder');
            if (is_array($orders)) foreach ($orders as $id=>$order) {
                    $this->_table->rec_update(array('listorder'=>$order),$id);
                }
        }
        front::redirect(front::$from);
    }
    function delete_action() {
        $this->manage->delete_before(front::get('id'));
        $delete=$this->_table->rec_delete(front::get('id'));
        if ($delete) front::flash("{$this->tname}".lang_admin('delete').lang_admin('success')."！");
        front::redirect(url::modify('act/list/table/'.$this->table.'/bid/'.session::get('bid')));
    }
    function setting_action() {
        $this->_view_table=false;
        $set=settings::getInstance();
        $sets=$set->getrow(array('tag'=>'table-'.$this->table));
        $data=unserialize($sets['value']);
        if (front::post('submit')) {
            $var=front::$post;
            unset($var['submit']);
            $set->rec_replace(array('value'=>serialize($var),'tag'=>'table-'.$this->table,'array'=>var_export($var,true)));
            front::flash("{$this->tname}".lang_admin('configuration_successful')."！");
        }
        $this->view->settings=$data;
    }
    function view($table) {
        $this->view->data=$table['data'];
        $this->view->field=$table['field'];
    }
    function end() {
        if (!isset($this->_view_table)) return;
        if (!isset($this->_view_table['data'])) $this->_view_table['data']=$this->_view_table;
        $this->_view_table['field']=$this->_table->getFields();
        $this->view->fieldlimit=$this->_table->getcols(front::$act == 'list'?'manage': 'modify');
        $this->view($this->_view_table);
    /*    if (front::post('onlymodify')) $this->render();
        else
        if (front::get('main')) $this->render();
        else $this->render('index.php');*/
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
