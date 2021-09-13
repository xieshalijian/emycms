<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class table_user extends table_mode
{
    function save_before()
    {
        if (front::post('passwordnew')) front::$post['password'] = md5(trim(front::post('passwordnew')));
       if (front::post('expired_time')){
           front::$post['expired_time'] = strtotime(front::post('expired_time'));
       }
    }

    function delete_before($id = '')
    {
        $user = new user();
        $row = $user->getrow(front::get('id'));
        if ($row['username'] == config::get('install_admin')) {
            front::flash(lang_admin('cannot_delete_an_installation_administrator'));
            front::redirect(front::$from);
        }
        if (front::get('id') == front::$user['userid']) {
            front::flash(lang_admin('cannot_delete_current_user'));
            front::redirect(front::$from);
        }
        if (is_array(front::post('select')) && in_array(front::$user['userid'], front::post('select'))) {
            front::flash(lang_admin('cannot_delete_current_user'));
            front::redirect(front::$from);
        }
    }

    function mail_before()
    {
        $user = new user();
        $user_arr = front::post('select');
        if (is_array($user_arr)) {
            $echo = '';
            foreach ($user_arr as $id) {
                $row = $user->getrow($id);
                $echo .= $row['e_mail'] . ',';
            }
            echo substr($echo, 0, -1);
        } else {
            $row = $user->getrow(front::get('id'));
            echo $row['e_mail'];
        }
    }

    function sms_before()
    {
        $user = new user();
        $user_arr = front::post('select');
        if (is_array($user_arr)) {
            $echo = '';
            foreach ($user_arr as $id) {
                $row = $user->getrow($id);
                if($row['tel'])
                    $echo .= $row['tel'] . ',';
            }
            echo substr($echo, 0, -1);
        } elseif($user_arr) {
            $row = $user->getrow(front::get('id'));
            if($row['tel'])
                echo $row['tel'];
        }
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.