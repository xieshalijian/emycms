<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
include_once('version.php');
class admin_menu
{
    static $menu = array();
    static function get()
    {
        if (front::get('mod')) {
            $mod = front::get('mod');
            session::set('mod', $mod);
        }
        if (front::get('act')) {
            $act = front::get('act');
            session::set('act', $act);
        }
        if (front::get('table')) {
            $table = front::get('table');
            session::set('table', $table);
        }
        if (front::get('set')) {
            $set = front::get('set');
            session::set('set', $set);
        }
        if (front::get('tagfrom')) {
            $tagfrom = front::get('tagfrom');
            session::set('tagfrom', $tagfrom);
        }
        if (front::get('item')) {
            $item = front::get('item');
            session::set('item', $item);
        }
        $mod = session::get('mod');
        switch ($mod) {
            case 'system':
                $menu = self::fetch('全局设置,数据库管理,数据维护');
                break;
            case 'config':
                $menu = self::fetch('网站设置,多站点设置');
                break;
            case 'content':
                $menu = self::fetch('栏目管理,内容管理,分类管理,专题管理');
                break;
            case 'cache':
                $menu = self::fetch('生成管理,手机版生成');
                break;
            case 'order':
                $menu = self::fetch('订单管理');
                break;
            case 'user':
                $menu = self::fetch('用户管理,用户组管理,推广联盟');
                break;
            case 'func':
                $menu = self::fetch('公告管理,留言评论,投票管理,数据管理,文件防护,网站安全');
                break;
            case 'defined':
                $menu = self::fetch('自定义字段,自定义表单');
                break;
            case 'help':
                $menu = self::fetch('模板管理,添加标签,标签列表');
                break;
            case 'seo':
                $menu = self::fetch('微信公众号,内容链接管理,友情链接管理,邮件管理,推广联盟');
                break;
            case 'data':
                $menu = self::fetch('数据管理,安全防护');
                break;
            case 'map':
                $menu = self::fetch('网站设置,数据库管理,数据维护,内容管理,生成管理,栏目管理,分类管理,专题管理,幻灯片管理,用户管理,用户组管理,公告管理,自定义字段,自定义表单,订单管理,留言管理,专题管理,评论管理,投票管理,数据备份,批量替换,模板管理,添加标签,标签列表,内容链接管理,推广联盟,友情链接管理,邮件管理,内容链接管理,推广联盟,友情链接管理,系统管理,客服中心,账号管理,生成代码');
                break;
            default:
                $menu = self::fetch('常用操作');
                break;
        }
        if (empty($menu)) {
            return;
        }
        $menu = array_merge($menu, self::$menu);
        if (front::get('mod')) {
            foreach ($menu as $menu_1) {
                foreach ($menu_1 as $menu_2) {
                    if ($menu_2)
                        break;
                }
                if ($menu_2)
                    break;
            }
            front::redirect($menu_2);
        }
        return $menu;
    }
    /**
     * @param $string
     * @return array
     */
    static function fetch($string)
    {
        $names = explode(',', $string);
        $allmenu = self::allmenu();
        $menus = array();
        foreach ($names as $key) {
            $menus[$key] = $allmenu[$key];
        }
        //var_dump($menus);
        return $menus;
    }
    static function allmenu()
    {
        $menu = array(
            lang_admin('add') => array(
                'add',
                array(
                    lang_admin('adding_content') => array('archive_add',url::create('table/add/table/archive')),
                    lang_admin('add_columns') => array('category_add',url::create('table/add/table/category')),
                  /*  lang_admin('adding_type') => array('mtype_add',url::create('table/add/table/type')),*/
                 /*   lang_admin('adding_special') => array('special_add',url::create('table/add/table/special')),*/
                )
            ),
            lang_admin('manage') => array(
                'manage',
                array(
                    lang_admin('content_manage') => array('archive_manage',url::create('table/list/table/archive')),
                    lang_admin('column_manage') => array('category_manage',url::create('table/list/table/category')),
               /*     lang_admin('type_manage') => array('mtype_manage',url::create('table/list/table/type')),*/
                  /*  lang_admin('special_manage') => array('special_manage',url::create('table/list/table/special')),*/
                )
            ),
            lang_admin('interactive') => array(
                'interactive',
                array(
                  /*  lang_admin('leaving_a_message') => array('func_book',url::create('table/list/table/guestbook')),*/
                    lang_admin('comment') => array('func_comment_list',url::create('table/list/table/comment')),
                   /* lang_admin('form') => array('defined_form',url::create('form/listform')),*/
                  /*  lang_admin('vote') => array('func_ballot',url::create('table/list/table/ballot')),*/
                    lang_admin('customer_service_list') => array('system_template',url::create('config/system/set/customer')),
                    /*  lang_admin('give_the_thumbsup') => array('user_zanarchivelist',url::create('usermanage/zanarchivelist/manage/archive')),*/
                    /*  lang_admin('collection') => array('user_collectlist',url::create('usermanage/collectlist/manage/user')),*/
                )
            ),
            lang_admin('seo') => array(
                'seo',
                array(
                  /*  lang_admin('internal_link') => array('seo_linkword',url::create('table/list/table/linkword')),*/
                    lang_admin('url_rules') => array('category_htmlrule',url::create('table/htmlrule/table/category')),
                    lang_admin('friendship_link') => array('seo_friendlink',url::create('table/list/table/friendlink')),
                    /*lang_admin('tag') => array('seo_tag',url::create('table/list/table/tag')),*/
                    lang_admin('hot_keywords') => array('archive_hotsearch',url::create('index/hotsearch')),
              /*      lang_admin('web_spider') => array('seo_status',url::create('stats/list/table/stats')),*/
                    lang_admin('dynamic_and_static') => array('cache',url::create('config/system/set/dynamic')),

                )
            ),
            lang_admin('template') => array('template',url::create('config/system/set/template')),
            lang_admin('extend') => array('system_extend',url::create('expansion/index')),
            lang_admin('user') => array(
                'user',
                array(
                    lang_admin('user_list') => array('user_manage',url::create('table/list/table/user')),
                    lang_admin('user_group') => array('user_group',url::create('table/list/table/usergroup')),
                   /* lang_admin('login_api') => array('user_ologin',url::create('ologin/list/table/ologin')),*/
                 /*   lang_admin('invitation_code') => array('user_invite',url::create('invite/list')),*/
                )
            ),
            lang_admin('security') => array(
                'security',
                array(
                   /* lang_admin('safety_protection') => array('func_filecheck',url::create('filecheck/filecheck/action/file_check')),*/
                    lang_admin('website_security') => array('config',url::create('config/system/set/security')),
                    lang_admin('manage_data') => array('func_data',url::create('database/baker')),
                    lang_admin('online_upgrade') => array('func_update',url::create('update/index')),
                )
            ),
            lang_admin('set_up') => array(
                'set_up',
                array(
                    lang_admin('essential_information') => array('config',url::create('config/system/set/site/')),
                    lang_admin('mobile_version') => array('config',url::create('config/system/set/phonesite')),
                    lang_admin('banner_pic') => array('config',url::create('slide/list')),
                    //lang_admin('global_settings') => array('config',url::create('config/index')),
                )
               ),
            lang_admin('sidebar') => array('menu',url::create('menu/list')
            ),
            lang_admin('thank') => array('thank',url::create('index/thank')),
        );
        //提取安装扩展的meun
        $apps_data=apps::getInstance()->getrows("installed=1",0);
        if (is_array($apps_data))
        foreach ($apps_data as $val){
            $meun_path=ROOT.'/apps/'.$val['id'].'/menu/config.php';
            if(file_exists($meun_path)){
                $menu=include  $meun_path;
            }
        }

        //排序
        $listorder_menu=array();
        $menudata=menu::getmenu();
        foreach ($menu as $key=>$val){
            if (isset($menudata[$val[0]])){
                $listorder_menu[]=array("data"=> array($key=>$menu[$key]),"listorder"=>$menudata[$val[0]]['listorder']);
            }
        }
        array_multisort(array_column($listorder_menu,'listorder'),SORT_ASC,$listorder_menu);

        //排序后的
        $new_menu=array();
        foreach ($listorder_menu as $key=>$val){
            $new_menu=array_merge($new_menu,$val['data']);
        }

        return $new_menu;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
