<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class cache_act extends act
{
    function init()
    {
        $this->check_admin();
    }

    function ctsitemap_action()
    {
        category::getInstance()->sitemap();
      /*  echo '<script>alert("' . lang('generated_site_map_success') . '");gotoinurl("index.php?case=index&act=index&admin_dir=' . config::getadmin('admin_dir') . '");</script>';
        exit;*/
        $return_data=array("suc"=>1);
        echo json_encode($return_data);
        exit;
        /*alertinfo(lang('generated_site_map_success'), front::$from);*/
        //front::flash(lang('successful_generation'),lang('sitemap'),lang('！'));
        //front::redirect(front::$from);
        /*echo "<script>alert('生成网站地图成功!');window.close();</script>";
        exit;*/
    }

    function check_admin()
    {
        if (cookie::get('login_username') && cookie::get('login_password')) {
            $user = new user();
            $user = $user->getrow(array('username' => cookie::get('login_username')));
            $roles = cache::get('roles',true);
            if ($roles && is_array($user) && cookie::get('login_password') == front::cookie_encode($user['password'])) {
                $this->view->user = $user;
                front::$user = $user;
            } else {
                $user = null;
            }
        }

        if (!isset($user) || !is_array($user)) {
            front::redirect(url::create('admin/login'));
        }
    }

    function index_action()
    {
        $case = 'archive';
        $act = 'list';
        $_GET = array('case' => $case, 'act' => $act);
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
