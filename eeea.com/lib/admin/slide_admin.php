<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');
class slide_admin extends admin
{
    function init()
    {
        $this->_slide=new slide();
        $this->_slide_child=new slidechild();
        $this->manage=new table_slide();
        $this->_pagesize = config::getadmin('manage_pagesize');
        $this->view->form = $this->_slide->get_form();
        $this->view->field = $this->_slide->getFields();
    }
    function list_action()
    {
        if (!front::get('page'))
            front::$get['page'] = 1;
        $limit = ((front::get('page') - 1) * $this->_pagesize) . ',' . $this->_pagesize;
        $slidedata =  $this->_slide->getrows(null, $limit,'id asc ');
        $this->view->data=$slidedata;
        $this->view->record_count = $this->_slide->record_count;
        $this->view->token = Phpox_token::grante_token('table_del');
    }
    function add_action()
    {
        if (front::post('submit')) {
            if(is_array($this->_slide->getrow(array("name"=>front::$post['name'])))){
                front::flash(lang_admin("slide_name").lang_admin("repetition"));
                front::redirect(url::modify('act/add', true));
            }
            front::$post['addtime']=date('Y-m-d H:i:s', time());
            if($this->_slide->rec_insert(front::$post)) {
                front::flash(lang_admin('slide').lang_admin('add').lang_admin('success')."！");
                front::redirect(url('slide/list/', true));
            }else{
                alerterror(lang_admin('addition_failed'));
            }
        }
        $this->view->data=array("");
    }
    function edit_action()
    {
        if (front::post('submit')) {
            if($this->_slide->rec_update(front::$post,intval(front::$get['id']))) {
                front::flash(lang_admin('slide').lang_admin('modify').lang_admin('success')."！");
                front::redirect(url('slide/list/', true));
            }else{
                alerterror(lang_admin('edit_failed'));
            }
        }
        $this->view->data= $this->_slide->getrow('id='.front::get('id'), 'id desc', $this->_slide->getcols('modify'));
    }
    function saveslide_action(){
        if (front::post('id')) {
            $id=front::post('id');
            unset(front::$post['id']);
            if($this->_slide->rec_update(front::$post,intval($id))) {
                echo lang_admin('slide').lang_admin('modify').lang_admin('success')."！";
                exit;
            }
        }
        echo lang_admin('slide').lang_admin('modify').lang_admin('failure')."！";
        exit;
    }
    function saveslide_child_action(){
        $slide_num=front::post('slide_num');
        $slide_sid=front::post('slide_sid');
        $langdata=lang::getlang();
        if ($slide_num && $slide_sid){
            for ($i=1; $i<=$slide_num; $i++)
            {
                if (!array_key_exists('slide_path'.$i,front::$post)){
                    continue;
                }
                if (is_array($langdata))
                    foreach ($langdata as $lang){
                        front::$post['slide_title'.$i][$lang['langurlname']]=front::$post['slide_title'][$lang['langurlname']][$i];
                        front::$post['slide_subtitle'.$i][$lang['langurlname']]=front::$post['slide_subtitle'][$lang['langurlname']][$i];
                        front::$post['slide_butname'.$i][$lang['langurlname']]=front::$post['slide_butname'][$lang['langurlname']][$i];
                        front::$post['slide_url'.$i][$lang['langurlname']]=front::$post['slide_url'][$lang['langurlname']][$i];
                    }
                $new_data=array(
                    "slide_sid"=>$slide_sid,
                    "slide_title"=>serialize(front::post('slide_title'.$i)),
                    "slide_subtitle"=>serialize(front::post('slide_subtitle'.$i)),
                    "slide_butname"=>serialize(front::post('slide_butname'.$i)),
                    "slide_url"=>serialize(front::post('slide_url'.$i)),
                    "slide_path"=>front::post('slide_path'.$i),
                );
                if(front::post('slide_id'.$i)){
                    $where="id=".front::post('slide_id'.$i);
                    $this->_slide_child->rec_update($new_data,$where);
                }else{
                    $this->_slide_child->rec_insert($new_data);
                }
            }
            echo "幻灯片".lang_admin('modify').lang_admin('success')."！";
            exit;
        }
        echo "幻灯片".lang_admin('modify').lang_admin('failure')."！";
        exit;
    }
    function editview_action()
    {
        if (front::post('submit')) {
            $slide_num=front::post('slide_num');
            $slide_sid=front::post('slide_sid');
            $langdata=lang::getlang();
            if ($slide_num && $slide_sid){
                for ($i=1; $i<=$slide_num; $i++)
                {
                    if (!array_key_exists('slide_path'.$i,front::$post)){
                        continue;
                    }
                    if (is_array($langdata))
                        foreach ($langdata as $lang){
                            front::$post['slide_title'.$i][$lang['langurlname']]=front::$post['slide_title'][$lang['langurlname']][$i];
                            front::$post['slide_subtitle'.$i][$lang['langurlname']]=front::$post['slide_subtitle'][$lang['langurlname']][$i];
                            front::$post['slide_butname'.$i][$lang['langurlname']]=front::$post['slide_butname'][$lang['langurlname']][$i];
                            front::$post['slide_url'.$i][$lang['langurlname']]=front::$post['slide_url'][$lang['langurlname']][$i];
                        }
                    $new_data=array(
                        "slide_sid"=>$slide_sid,
                        "slide_title"=>serialize(front::post('slide_title'.$i)),
                        "slide_subtitle"=>serialize(front::post('slide_subtitle'.$i)),
                        "slide_butname"=>serialize(front::post('slide_butname'.$i)),
                        "slide_url"=>serialize(front::post('slide_url'.$i)),
                        "slide_path"=>front::post('slide_path'.$i),
                    );
                    if(front::post('slide_id'.$i)){
                        $where="id=".front::post('slide_id'.$i);
                        $this->_slide_child->rec_update($new_data,$where);
                    }else{
                        $this->_slide_child->rec_insert($new_data);
                    }
                }
                front::flash(lang_admin('slide').lang_admin('edit').lang_admin('success')."！");
            }
            front::redirect(url('slide/list/', true));
        }
        $this->view->data= $this->_slide_child->getrows('slide_sid='.front::get('id'),0,'id asc');
        $this->view->slide_sid=front::get('id');
    }
    function delete_action()
    {
        if (!Phpox_token::is_token('table_del', front::$get['token'])) {
            exit(lang_admin('token_error'));
        }
        $this->manage->delete_before(front::get('id'));
        $delete = $this->_slide->rec_delete(front::get('id'));
        if ($delete) {
            front::flash(lang_admin('slide').lang_admin('delete').lang_admin('success')."！");
            event::log(lang_admin('delete').lang_admin('slide').",ID=" . front::get('id'), lang_admin('success'));
        }
        front::redirect(url('slide/list/', true));
    }
    function deletechild_action()
    {
        if (front::get('id')){
            $delete = $this->_slide_child->rec_delete(front::get('id'));
            echo $delete;
        }
        exit;
    }
    function batch_action()
    {
        if (front::post('batch') && front::post('select')) {
            $str_select = implode(',', front::post('select'));
            $slide_select = 'id' . ' in (' . $str_select . ')';
            $slide_child_select = 'slide_sid' . ' in (' . $str_select . ')';
            if (front::post('batch') == 'delete') {
                $delete = $this->_slide_child->rec_delete($slide_child_select);
                $delete = $this->_slide->rec_delete($slide_select);
                if ($delete > 0) {
                    front::flash(lang_admin('successful_deletion'));
                    event::log(lang_admin('del_slide')."，ID=" . $str_select, lang_admin('success'));
                } else
                    front::flash(lang_admin('deletion_failed'));
            }
        }
        front::redirect(url::modify('act/list', true));
    }
    function getslide_action(){
        if (front::post('id')){
            $row=slide::getInstance()->getrow('id='.front::post('id'));
            echo json_encode($row);
        }
        exit;
    }
    function getslide_child_action(){
        if (front::post('sid')){
            $data=slidechild::getInstance()->getrows('slide_sid='.front::post('sid'),0,'id asc');
            if (is_array($data))
                foreach ($data as $key=>$val){
                    $data[$key]['slide_title']=unserialize($val['slide_title']);
                    $data[$key]['slide_subtitle']=unserialize($val['slide_subtitle']);
                    $data[$key]['slide_butname']=unserialize($val['slide_butname']);
                    $data[$key]['slide_url']=unserialize($val['slide_url']);
                }
            echo json_encode($data);
        }
        exit;
    }
    function end()
    {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
