<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
abstract class act
{
    public $cache_path;

    function __construct()
    {
        $this->filter();
        //$o = new ReflectionClass('front');
        //var_dump($o->getDefaultProperties());
        if((front::$case == 'template' && (front::$act == 'visual' || front::$act == 'getnav'
            || front::$act == 'getmodular'|| front::$act == 'getmodals'|| front::$act == 'getmodules'
            || front::$act == 'getbuymodules'|| front::$act == 'getlayouts'|| front::$act == 'savemoduletag'
                || front::$act == 'savemoduletaglist')) ||
            ((front::$case == 'archive'|| front::$case == 'special'|| front::$case == 'type'
                || front::$case == 'guestbook'|| front::$case == 'comment'|| front::$case == 'announ')
                && (front::get('admin_dir')==config::get('admin_dir'))
                && (front::$act == 'show' || front::$act == 'list' || front::$act == 'index'
                    || front::$act == 'sitemap'))){
            $this->view = new visualview($this);
        }else {
            $this->view = new view($this);
        }
        $this->base_url = config::get('base_url');
        front::$view = $this->view;
        load_lang('system.php','system_custom.php');
        load_admin_lang('system_admin.php','system_admin_custom.php');
        load_custom_admin_lang('cn');
        load_modules_lang('system_modules.php');

        if (front::$case != 'install') {
            if (!self::installed()) {
                echo '<script>window.location.href="index.php?case=install&admin_dir=' . config::get('admin_dir') . '&site=default";</script>';
            }

            if (!front::$admin) {
                $site = config::get('stop_site');
                if ($site == '2') {
                    template_user('system/close.html');
                    exit;
                }elseif(!myconfig::getadmin("agreement")){
                    template_user('system/agreement_close.html');
                    exit;
                } elseif ($site == '3') {
                    template_user('system/suspend.html');
                    exit;
                }
            }

            //new stsession(new sessionox());//初始化DB 存储SESSION
            register_shutdown_function('session_write_close');

            $user = new user();
            $row = $user->getrow('userid>0');
            if (!is_array($row)) {
                exit(lang('database_connection_failed').lang('please_check_the_configuration_file'));
            }
            //var_dump($_COOKIE);

            new setting();
            $this->view->user = null;
			$this->view->userid = 0;
            $this->view->username = lang('tourist');
            $this->view->usergroupid = 1000;
            if (cookie::get('login_username') && cookie::get('login_password')) {
                //$user=new user();
                $user = $user->getrow(array('username' => cookie::get('login_username')));
                if (is_array($user) && cookie::get('login_password') == front::cookie_encode($user['password'])) {
                    $this->view->user = $user;
                    $this->cur_user = $user;
                    $this->view->userid = $user['userid'];
                    $this->view->username = $user['username'];
                    $this->view->usergroupid = $user['groupid'];
                    front::$user = $user;
                }
            }
        }

    }

    static function installed()
    {
        if (file_exists(ROOT . '/data/locked')) return true;
        else return false;
    }

    function init()
    {

    }

    function end()
    {
    }

    function check_pw()
    {

        /*include(ROOT . '/lib/admin/template_.php');

        $md5_file_check = md5_file(ROOT . '/lib/inc/view.php');
        if (0 && $md5_file_check != $check_code['view_phpcheck']) {  //WWW
            exit(phpox_decode('act'));
        }*/
    }

    function fetch($tpl = null,$static=false,$template_cache=false,$head_foot=false)
    {
        if(front::$case == 'template' && front::$act == 'visual'){
            return $this->view->adminfetch($tpl,$static);
        }
        return $this->view->fetch($tpl,$static,$template_cache,$head_foot);
    }

    function render($tpl = null,$cache=false)
    {

        //$获取静态下的缓存路径
        $pageset=front::get('pageset');  //$pageset防止可视化调用到缓存
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        if (front::get("case")=="archive"  && front::get("act")=="list" && !$pageset && !front::$ismobile && $cache_make_open){
            $catid=front::get("catid");
            $cache_path = category::url($catid, front::$get['page'] > 1 ? front::$get['page'] : null,
                lang::getistemplate(),false);
            $cache_path = category::url_rule($cache_path);
            $cache_path=str_replace('.html','.php',$cache_path);
            //不存在的情况则生成
            if (!file_exists($cache_path)) {
                cache_make::get_make_list($catid,false);
            }
            $content=$this->view->compile_public(file_get_contents($cache_path),true);
            file_put_contents($cache_path, $content);
            $content=$this->view->_eval($cache_path,true);
            $state=false;
        }
        elseif (front::get("case")=="archive"  && front::get("act")=="show" && !$pageset && !front::$ismobile  && $cache_make_open){
            $aid=front::get("aid");
            $archive=archive::getInstance()->getrow("aid=".$aid);
            $cache_path = archive::url($archive, front::$get['page'] > 1 ? front::$get['page'] : null, lang::getistemplate(),false);
            $cache_path = archive::url_rule($cache_path);
            $cache_path=str_replace('.html','.php',$cache_path);
            //不存在的情况则生成
            if (!file_exists($cache_path)) {
                cache_make::get_make_show($aid);
            }
            $content=$this->view->compile_public(file_get_contents($cache_path),true);
            file_put_contents($cache_path, $content);
            $content=$this->view->_eval($cache_path,true);
            $state=false;
        }
        elseif (front::get("case")=="type"  && front::get("act")=="list"  && !$pageset && !front::$ismobile && $cache_make_open){
            $typeid=front::get("typeid");
            $cache_path = type::url($typeid, front::$get['page'] > 1 ? front::$get['page'] : 1, lang::getistemplate(),false);
            $cache_path = type::url_rule($cache_path);
            $cache_path=str_replace('.html','.php',$cache_path);
            //不存在的情况则生成
            if (!file_exists($cache_path)) {
                cache_make::get_make_type($typeid,false);
            }
            $content=$this->view->compile_public(file_get_contents($cache_path),true);
            file_put_contents($cache_path, $content);
            $content=$this->view->_eval($cache_path,true);
            $state=false;
        }
        elseif (front::get("case")=="special"  && front::get("act")=="show"  && !front::get("cache_make")  && !$pageset && !front::$ismobile && $cache_make_open){
            $specialid=front::get("spid");
            $special = special::getInstance()->getrow("spid=".$specialid);

            $cache_path = special::url($special['spid'],$special['ishtml'],front::$get['page'] > 1 ? front::$get['page'] : 1,$special['htmldir'],lang::getistemplate(),false);
            $cache_path = type::url_rule($cache_path);
            $cache_path=str_replace('.html','.php',$cache_path);
            //不存在的情况则生成
            if (!file_exists($cache_path)) {
                cache_make::get_make_special($specialid,false);
            }
            $content=$this->view->compile_public(file_get_contents($cache_path),true);
            file_put_contents($cache_path, $content);
            $content=$this->view->_eval($cache_path,true);
            $state=false;
        }
        elseif (front::get("case")=="tag"  && front::get("act")=="show" && !front::get("cache_make") && !$pageset && !front::$ismobile && $cache_make_open){
            $tag_name=front::get("tag");
            $tag_data = tag::getInstance()->getrow("tagname='".$tag_name."'");
            $cache_path = tag::url($tag_name,front::$get['page'] > 1 ? front::$get['page'] : 1,lang::getistemplate(),false);
            $cache_path = tag::url_rule($cache_path);
            $cache_path=str_replace('.html','.php',$cache_path);
            //不存在的情况则生成
            if (!file_exists($cache_path)) {
                cache_make::get_make_tag($tag_data['tagid'],false);
            }
            $content=$this->view->compile_public(file_get_contents($cache_path),true);
            file_put_contents($cache_path, $content);
            $content=$this->view->_eval($cache_path,true);
            $state=false;
        }
        elseif(!front::$admin && ((front::get("case")=="index"  && front::get("act")=="index") || (front::get("case")==""  && front::get("act")==""))
            && !$pageset && !front::$ismobile && $cache_make_open){
            $cache_path=ROOT . '/'.lang::getistemplate().'/index-' . lang::getistemplate() . '.php';
            //不存在的情况则生成
            if (!file_exists($cache_path)) {
                cache_make::get_make_index(lang::getistemplate(),lang::getisadmin(),false);
            }
            $content=$this->view->compile_public(file_get_contents($cache_path),true);
            file_put_contents($cache_path, $content);

            $content=$this->view->_eval($cache_path,true);
            $state=false;
        }
        else{
            $content = $this->view->fetch($tpl,true);
            $state=true;
        }

        //获取浏览记录  后台显示 首页方法不一样  打印也不需要
        if($tpl!="index.php" && $tpl!='table/orders/view.php' && !(front::get('case')== 'invoice' && front::get('act')=='view')
            && front::$admin && get("case")!="install"&& get("act")!="login" && $state){
            $history=getuserhistory("");
            if($history!=""){
                $content=$history.$content;   //组合 增加到头部
            }
        }
        //操作信息提示框
        if (hasflash()) {
            $content.='<div class="message">';
            $content.=' <div class="alert alert-danger alert-dismissible fade in" role="alert">';
            $content.='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            $content.='<span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>';
            $content.=' <span class="glyphicon glyphicon-warning-sign"></span>'.showflash();;
            $content.=' </div>';
            $content.=' <div class="message-bottom"></div>';
            $content.=' </div>';
         }
        if(front::get('admin_dir')==config::getadmin("admin_dir")
            && front::$admin && front::$case!="install"){
            $content.='<script> window.location.href ="#index_connent";</script>'; //t跳到子窗口的顶部
        }
        if ($cache){
                return $content;
        }else
        echo $content;
        if ($this->cache_path) {
            $path = $this->cache_path;
            tool::mkdir(dirname($path));
            file_put_contents($path, $content);
        }

        exit;
    }

    function filter()
    {
        if (front::get('page')) front::check_type(front::get('page'));
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
