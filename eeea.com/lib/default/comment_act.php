<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class comment_act extends act
{
    function init()
    {
        if (cookie::get('login_username') && cookie::get('login_password')) {
            $user = user::getInstance()->getrow(array('username' => cookie::get('login_username')));
            if (cookie::get('login_password') != front::cookie_encode($user['password'])) {
                unset($user);
            }else{
                $this->view->user = $user;
            }
        }
        $this->manage = new table_comment;
    }

    function add_action()
    {
        if (front::post('submit') && front::post('aid') && config::get('comment')) {

            if (config::get('verifycode') == 1) {
                if (!session::get('verify') || front::post('verify') <> session::get('verify')) {
                    //exit('1');
                    alerterror(lang('verification_code'));
                    return;
                }
            } else if (config::get('verifycode') == 2) {
                if (!verify::checkGee()) {
                    //exit('2');
                    alerterror(lang('verification_code'));
                    return;
                }
            }
            //exit;
            $arr=array("!","@","#","$","%","^","&","*","(",")","[","]","|",",",".","<",">","{","}","=","+","-","；","'","\"","www.","http:://","https:://");
            $a=0;
            foreach($arr as $key=>$value){
                if(strpos(front::post('content'),$value) || strpos(front::post('username'),$value)){
                    $a=1;
                }
            }
            if($a==1){
                alertinfo(lang('不能包含特殊字符'), front::$from);
                exit;
            }


            $ip = front::ip();
            $username = $this->cur_user['username'];

            $comment = new comment();
            $row = $comment->getrow("username='$username' OR ip='$ip'", "adddate DESC");
            //var_dump(time());
            if ($row['adddate'] && time() - strtotime($row['adddate']) <= intval(config::get('comment_time'))) {
                alerterror(lang('frequent_operation_please_wait'));
                return;
            }

            if (config::get('mobilechk_enable') && config::get('mobilechk_comment')) {
                $mobilenum = front::$post['mobilenum'];
                $smsCode = new SmsCode();
                if (!$smsCode->chkcode($mobilenum)) {
                    alertinfo(lang('cell_phone_parity_error'), front::$from);
                }
            }
            if (!front::post('username')) {
                /*front::flash(lang('请留下你的名字！'));
                front::redirect(front::$from);*/
                alertinfo(lang('please_leave_your_name'), front::$from);
            }
            if (!front::post('content')) {
                /*front::flash(lang('请填写评论内容！'));
                front::redirect(front::$from);*/
                alertinfo(lang('please_fill_in_the_comments'), front::$from);
            }
            $this->manage->filter();
            $this->manage->add_before($this);
            $this->manage->save_before();
            $archive = new archive();
            front::$post['state'] = intval(config::get('comment_ischeck'));
            front::$post['adddate'] = date('Y-m-d H:i:s');
            front::$post['userid'] = user::getusersid();
            $rs  = $comment->rec_insert(front::$post);
            //var_dump($rs);exit;
            $archive->rec_update('comment_num=comment_num+1', front::post('aid'));
            //front::flash(lang('提交成功！'));
            alertinfo(lang('comments_submitted_successfully'), front::$from);
            //front::redirect(front::$from);
        } else {
            front::flash(lang('comment_submission_failed'));
            front::redirect(front::$from);
        }
    }

    function list_action()
    {
        if (front::get("username") && front::get("pageset")){
            $user = user::getInstance()->getrow(array('username' =>front::get("username")));
            $this->view->user = $user;
        }
        front::check_type(front::get('aid'));
        $this->view->article = archive::getInstance()->getrow(front::get('aid'));
        $this->view->page = front::get('page') ? front::get('page') : 1;
        $this->pagesize = config::get('list_pagesize');
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $comment = new comment();
        $this->view->comments = $comment->getrows('state=1 and aid=' . front::get('aid'), $limit);
        $this->view->record_count = $comment->rec_count('state=1 and aid=' . front::get('aid'));
        front::$record_count = $this->view->record_count;
        $this->view->pages = ceil(front::$record_count / $this->pagesize);
        $this->view->archive=$this->view->article;
        $this->view->aid = front::get('aid');
    }

    function comment_js_action()
    {
        $comment = comment::getIns();
        $aid = intval(front::get('aid'));
        $comment_num = intval(config::get('comment_num'));
        $this->view->page = front::get('page') ? front::get('page') : 1;
        $limit = (($this->view->page - 1) * $comment_num) . ',' .$comment_num;
        $commentdata= $comment->getrows("state=1 and aid='$aid' and (( userid<>'". user::getusersid()."' and issee=0 ) or (userid='".user::getusersid()."'))", $limit, 'id desc');
        if(is_array($commentdata)){
            foreach ($commentdata as $key=>$value){
                if($value['isusersee']==1 && $value['userid']!=user::getusersid()){
                    $commentdata[$key]['reply']="";
                }
            }
        }
        $this->view->comments=$commentdata;
        $this->view->aid = $aid;
        echo tool::text_javascript($this->fetch());
        exit;
    }

    function digui(&$str, $id)
    {
        $comment = comment::getIns();
        $row = $comment->getrow($id);
        //var_dump($row);//exit;
        
        $str .= "<div class='add'>". nl2br($row['content']) . "<div class='clear'></div>";
		$str .= "<div class='bor'><div class='h'><span class='name'>{$row['username']}</span><span class='date'>{$row['adddate']}</span></div><div class='p'></div>";
        if ($row['rid']) {
            $this->digui($str, $row['rid']);
        }
        return $str;
    }

    function ajax_action()
    {
        front::check_type(front::get('aid'));
        $where = 'state=1 and aid=' . front::get('aid');
        $comment = comment::getIns();
        $p = intval(front::get('p'));
        if (!$p) $p = 1;
        $pagesize = config::get('list_pagesize');
        $count = $comment->rec_count($where);
        $limit = (($p - 1) * $pagesize) . ',' . $pagesize;
        $pages = ceil($count / $pagesize);
        $row = $comment->getrows($where, $limit, 'zannum desc,adddate desc');
        $i = 0;
        if (is_array($row) && !empty($row)) {
            foreach ($row as $arr) {
                //if($arr['rid']){
                //echo 11;
                //}
                //var_dump($arr['rid']);exit;
                if ($arr['rid']) {
                    $str = '';
                    $this->digui($str, $arr['rid']);
                    $row[$i]['content'] = $str . $arr['content'];
                } else {
                    $row[$i]['content'] = nl2br($arr['content']);
                }
                $i++;
            }
        }
        //var_dump($row);exit;
        $json = json_encode($row);
        echo $json;
        //$this->view->comments=$comment->getrows('state=1 and aid='.front::get('aid'),20,'1');
        //$this->view->aid=front::get('aid');
        //echo  tool::text_javascript($this->fetch());
        exit;
    }

    function zan_action()
    {
        if (!$this->cur_user['userid']) {
            exit('unsign');
        }
        $id = intval(front::get('id'));
        $aid = intval(front::get('aid'));
        $comment = comment::getIns();
        $row = $comment->getrow($id);
        $zannum = intval($row['zannum']) + 1;
        $comment->rec_update(array('zannum' => $zannum), $id);
        $zanlog = zanlog::getInstance();
        $zanlog->addlog($aid, $id, $this->cur_user['userid']);
        echo $zannum;
        exit;
    }

    function reply_action()
    {
        if (!$this->cur_user['username']) {
            alerterror(lang('please_log_in_first'));
        }
        $aid = intval(front::post('aid'));
        $rid = intval(front::post('rid'));
        $content = front::$post['content'];
        $comment = comment::getIns();
        $comment->rec_insert(array(
            'aid' => $aid,
            'content' => $content,
            'rid' => $rid,
            'userid' => $this->cur_user['userid'],
            'username' => $this->cur_user['username'],
            'adddate' => date('Y-m-d H:i:s'),
            'state' => intval(config::get('comment_ischeck')),
        ));

        $archive = new archive();
        $archive->rec_update('comment_num=comment_num+1', $aid);
        front::redirect($_SERVER['HTTP_REFERER']);
    }

    function del_action()
    {
        $id = intval(front::$get['id']);
        $comment = comment::getIns();
        $row = $comment->getrow($id);
        if ($row['username'] == front::$user['username'] && $comment->rec_delete($id)) {
            front::refresh(url('manage/commentlist/manage/comment'));
        } else {
            alerterror(lang('delete').lang('failure'));
        }
    }

    function delzan_action()
    {
        $id = intval(front::$get['id']);
        $zanlog = zanlog::getInstance();
        $row = $zanlog->getrow($id);
        if ($row['uid'] == front::$user['userid'] && $zanlog->rec_delete($id)) {

            $comment = comment::getIns();
            $arr = $comment->getrow($row['cid']);
            $zannum = abs(intval($arr['zannum']) - 1);
            $comment->rec_update(array('zannum' => $zannum), $row['cid']);

            front::refresh(url('manage/zanlist/manage/zanlog'));
        } else {
            alerterror(lang('delete').lang('failure'));
        }
    }

    function end()
    {
        if (front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
