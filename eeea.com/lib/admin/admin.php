<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');
abstract class admin extends act
{
    function __construct()
    {
        if (ADMIN_DIR != config::get('admin_dir')) {
            config::modify(array('admin_dir' => ADMIN_DIR));
            front::flash(lang_admin('lang_background').lang_admin('catalog').lang_admin('lang_change'));
        }
        if (front::$case != 'xiongzhang')
            front::$rewrite = false;
        parent::__construct();
        $this->check_admin();
    }
    function check_admin()
    {
        if (session::get('logintime')){
            $newdata=floor(intval(intval(time())-intval(session::get("logintime")))/6000);
            $user_outtime=config::getadmin("user_outtime");
            if ($newdata>$user_outtime && $user_outtime!=0){
                session::set("logintime",0);
                cache::set('roles', null,true);
                front::redirect(url::create('admin/login'));
            }
        }

        if (cookie::get('login_username') && cookie::get('login_password')) {
            $user = new user();
            $user = $user->getrow(array('username' => cookie::get('login_username')));
            $roles = cache::get('roles',true);
            if ($roles && is_array($user) && cookie::get('login_password') == front::cookie_encode($user['password'])) {
                $this->view->user = $user;
                front::$user = $user;
                session::set("logintime",time());
            } else {
                $user = null;
            }
        }
        if (!isset($user) || !is_array($user) || !cookie::get('login_username') ) {
            front::redirect(url::create('admin/login'));
        }
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
