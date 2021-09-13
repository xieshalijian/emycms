<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class admin_act extends act
{
    function login_action()
    {
        $this->view->verifycodeSet = 'true';
        cookie::del('passinfo');
        $this->view->loginfalse = cookie::get('loginfalse' . md5($_SERVER['REQUEST_URI']));
        if (front::post('submit')) {
            if(config::get('verifycode') == 1 || session::get('admin_YNverification')>0) {
                if (!session::get('verify') || front::post('verify') <> session::get('verify')) {
                    front::flash(lang('verification_code'));
                    $this->render();
                    exit;
                }
            }else if(config::get('verifycode') == 2){
                if (!verify::checkGee()) {
                    front::flash(lang('verification_code'));
                    $this->render();
                    exit;
                }
            }
            session::set('verify', null);
            if (config::getadmin('mobilechk_enable') && config::getadmin('mobilechk_admin')) {
                $mobilenum = front::$post['mobilenum'];
                $smsCode = new SmsCode();
                if (!$smsCode->chkcode($mobilenum)) {
                    front::flash(lang('cell_phone_parity_error') . "<a href=''>" . lang('backuppage') . "</a>");
                    $this->render();
                    exit;
                }
            }
            $user = new user();
            $user = $user->getrow(array('username' => front::post('username'), 'password' => md5(front::post('password'))));
            if (is_array($user)) {
                $roles = usergroup::getRoles($user['groupid']);
                cache::set('roles', null,true);
                if ($roles) {
                    cache::set('roles', $roles,true);
                } else {
                    front::alert(lang('without_permission'));
                }
                if (!front::post('expire')) {
                    cookie::set('login_username', $user['username'],0);
                    cookie::set('login_password', front::cookie_encode($user['password']),0);
                } else {
                    $expire = time() + front::post('expire');
                    cookie::set('login_username', $user['username'], $expire);
                    cookie::set('login_password', front::cookie_encode($user['password']), $expire);
                }

                //清空后台缓存
                user::deletesession();
                category::deletesession();
                //提取分类
                if(file_exists(ROOT."/lib/table/type.php")) {
                    type::deletesession();
                }
                if(file_exists(ROOT."/lib/table/special.php")) {
                    special::deletesession();
                }
                session::set("logintime",time()); //记录登录时间
                setcookie("login_username",0,0,"/",".xqmaster.com",NULL,TRUE);
                setcookie("login_password",0,0,"/",".xqmaster.com",NULL,TRUE);
                //登陆成功  错误次数改为0
                session::set('admin_YNverification',0);
                session::set('username', $user['username']);
                //导入客服登陆
                if(file_exists(ROOT . '/celive/include/config.inc.php')) {
                    require_once ROOT . '/celive/include/config.inc.php';
                    require_once ROOT . '/celive/include/celive.class.php';
                    $login = new celive();
                    $login->auth();
                    $GLOBALS['auth']->login(front::post('username'), front::post('password'));
                    $GLOBALS['auth']->check_login1();
                }
                event::log(lang('backstage_login'), lang('success'));
                front::$user = $user;
                front::redirect(url('index/index',true));
            } elseif (!is_array(front::$user) || !isset(front::$isadmin)) {
                $loginfalsetime = intval(config::get('loginfalsetime'));
                if (!$loginfalsetime) $loginfalsetime = 3600;
                cookie::set('loginfalse' . md5($_SERVER['REQUEST_URI']), (int)cookie::get('loginfalse' . md5($_SERVER['REQUEST_URI'])) + 1, time() + $loginfalsetime);
                event::log('loginfalse', lang('failure') . ' user=' . front::post('username'));
                //登陆失败 错误次数加+1
                session::set('admin_YNverification',session::get("admin_YNverification")+1);
                alerterror(lang('password_error'));
            }
        }
        $this->render();
    }
    function remotelogin_action()
    {
        cookie::del('passinfo');
        $this->view->loginfalse = cookie::get('loginfalse' . md5($_SERVER['REQUEST_URI']));
        if (front::$args) {
            $user = new user();
            $args = xxtea_decrypt(base64_decode(front::$args), config::get('cookie_password'));
            if (inject_check($args)) {
                event::log('inject',$args);
                exit(lang('illegal_parameter'));
            }
            $user = $user->getrow(unserialize($args));
            if (is_array($user)) {
                if ($user['groupid'] == '2')
                    front::$isadmin = true;
                cookie::set('login_username', $user['username']);
                cookie::set('login_password', front::cookie_encode($user['password']));
                session::set('username', $user['username']);
                front::$user = $user;
            } elseif (!is_array(front::$user) || !isset(front::$isadmin)) {
                cookie::set('loginfalse' . md5($_SERVER['REQUEST_URI']), (int)cookie::get('loginfalse' . md5($_SERVER['REQUEST_URI'])) + 1, time() + 3600);
                event::log('loginfalse', lang('failure') . ' user=' . $user['username']);
                front::flash(lang('password_error'));
                front::refresh(url('admin/login', true));
            }
        }
        $this->render();
    }
    //登录错误次数限制访问
    function loginfalsemaxtimes()
    {
        if (cookie::get('loginfalse' . md5($_SERVER['REQUEST_URI'])) > 5 || event::loginfalsemaxtimes()) {
            front::flash(lang('wrong_too_many_times'));
            return true;
        }
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
