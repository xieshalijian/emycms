<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class weixin_admin extends admin{

    public $db_weixin = null;

    function init(){
        $this->db_weixin = new weixin();
    }

    function add_action(){
        if (front::post('submit')) {
            $post = front::$post;
            $post['token'] = strtoupper(md5(uniqid(rand())));
            $post['addtime'] = date('Y-m-d H:i:s');
            if($this->db_weixin->rec_insert($post)) {
                $id = $this->db_weixin->insert_id();
                front::redirect(url('weixin/add2/id/'.$id, true));
            }else{
                alerterror(lang_admin('add_to').lang_admin('failure'));
            }
        }
        //$this->view->token = md5(uniqid(rand()));
    }

    function add2_action(){
        $id = intval(front::$get['id']);
        $data = $this->db_weixin->getrow($id);
        $this->view->data = $data;
    }

    function add3_action(){
        if (front::post('submit')) {
            $id = intval(front::$post['id']);
            $post['appid'] = front::$post['appid'];
            $post['appsecret'] = front::$post['appsecret'];
            $post['name'] = front::$post['name'];
            $post['oldid'] = front::$post['oldid'];
            $post['weixinid'] = front::$post['weixinid'];
            if($this->db_weixin->rec_update($post,$id)){
                front::redirect(url('weixin/list', true));
            }else{
                alerterror(lang_admin('preservation').lang_admin('failure'));
            }
        }
        $id = intval(front::$get['id']);
        $row = $this->db_weixin->getrow($id);
        $this->view->data = $row;
    }

    function chktest_action(){
        $id = intval(front::$get['id']);
        $row = $this->db_weixin->getrow($id);
        echo $row['checksuc'];
        exit;
    }

    function list_action(){
        $where = '';
        $ordre='`id` DESC';
        $this->view->data = $this->db_weixin->getrows($where,'',$ordre,'*');
        //var_dump($this->view->data);
    }

    function del_action(){
        $id = intval(front::$get['id']);
        if($this->db_weixin->rec_delete($id)){
            front::redirect(url('weixin/list/', true));
        }else{
            alerterror(lang_admin('delete').lang_admin('failure'));
        }
    }

    function end() {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
