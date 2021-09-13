<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class table_category extends table_mode
{
    function vaild()
    {
        if (!front::post('catname') && !front::post('batch_add')) {
            front::flash(lang_admin('fill_in_the_category_title_etc'));
            return false;
        }
        if (!front::post('langid')) {
            front::flash(lang_admin('please_choose').lang_admin('language_pack'));
            return false;
        }
        if (!front::post('htmldir'))
            front::$post['htmldir'] = pinyin::get2(front::post('catname'));
        return true;
    }

    function view_before(&$data = null)
    {
        $rank = new rank();
        $rank = $rank->getrow('catid=' . front::get('id'));
        if (is_array($rank))
            $data['_ranks'] = unserialize($rank['ranks']);
        else $data['_ranks'] = array();
        unset($data['ranks']);
    }

    function save_after($categoryid = '')
    {
        if (isset(front::$post['_ranks']) && front::$post['_ranks']) {
            $_ranks = serialize(front::post('_ranks'));
            $rank = new rank();
            if (is_array($rank->getrow(array('catid' => front::get('id')))))
                $rank->rec_update(array('ranks' => $_ranks), 'catid=' . $categoryid);
            else
                $rank->rec_insert(array('catid' => front::get('id'), 'ranks' => $_ranks));
        } else {
            $rank = new rank();
            $rank->rec_delete('catid=' . $categoryid);
        }

        //自动加入到用户组配置
        $usergroup=usergroup::getInstance()->getrow('groupid='.user::getuserid());
        if (is_array($usergroup)){
            $groupid=$usergroup['groupid'];
            unset($usergroup['groupid']);
            $powerlist=unserialize($usergroup['powerlist']);
            $powerlist[$categoryid]=1;
            session::set('roles', $powerlist);
            $powerlist=serialize($powerlist);
            usergroup::getInstance()->rec_update(array("powerlist"=>$powerlist),"groupid=".$groupid);
        }

        //保存之后 自动生成
        cache_make::get_make_list($categoryid,false);
        //删除首页缓存
        $fileurl_path=ROOT . '/'.lang::getistemplate().'/index-' . lang::getistemplate() . '.php';
        if (file_exists($fileurl_path))
        unlink($fileurl_path);

        //xml自动生成
        if (config::getadmin("met_sitemap_auto"))make_xml();

    }

    function save_before()
    {
        parent::save_before();

        //自定义字段允许HTML
        if (is_array(front::$post) && !empty(front::$post)) {
            foreach (front::$post as $k => $v) {
                if (preg_match('/^my_/is', $k)) {
                    front::$post[$k] = htmlspecialchars_decode(front::$post[$k]);
                }
            }
        }

        if (isset(front::$post['htmlrule1']) && front::$post['htmlrule1'] != '') {
            front::$post['htmlrule'] = front::$post['htmlrule1'];
        }
        if (isset(front::$post['listhtmlrule1']) && front::$post['listhtmlrule1'] != '') {
            front::$post['listhtmlrule'] = front::$post['listhtmlrule1'];
        }
        if (isset(front::$post['showhtmlrule1']) && front::$post['showhtmlrule1'] != '') {
            front::$post['showhtmlrule'] = front::$post['showhtmlrule1'];
        }
        front::$post['categorycontent'] = stripcslashes(htmlspecialchars_decode(front::$post['categorycontent']));
        front::$post['module'] = 'article';
        front::$post['listorder'] =isset(front::$post['listorder'])?intval(front::$post['listorder']):0;
        //var_dump(front::$post['categorycontent']);exit;

        if (front::$post['savehttppic']) {
            //front::$post['content'] = stripslashes(front::$post['content']);
            front::$post['categorycontent'] = stripcslashes(htmlspecialchars_decode(front::$post['categorycontent']));
            front::$post['categorycontent'] = preg_replace_callback('%(<img\s[^>|/>]*?src\s*=\s*["|\']?)([^"|\'|\s>]*)%is', 'savepic', front::$post['categorycontent']);
            //front::$post['content'] = addslashes(front::$post['content']);
            front::$post['categorycontent'] = stripcslashes(htmlspecialchars_decode(front::$post['categorycontent']));
        }
    }

    function delete_before($id = '')
    {
        $tbname = config::getdatabase('database', 'prefix') . 'archive';
        $categoryid = front::$get['id'];
        $where = "catid = '$categoryid'";
        $arc = new archive();
        $arcdata=$arc->getrows($where,0);
        if(count($arcdata)>0){
            $arc->query("DELETE FROM $tbname WHERE $where");
        }

        if (config::get("cache_make_open")){
            $cache_path = category::url($id, front::$get['page'] > 1 ? front::$get['page'] : null,
                lang::getisadmin(),false);
            $cache_path = category::url_rule($cache_path);
            $cache_path=dirname($cache_path);
            if ($cache_path!=ROOT){
                front::remove($cache_path);
            }
        }

    }

    function edit_before(){
        //修改模板触发清空可视化缓存
        if (front::post('template') && front::get('id')) {
            $category = new category();
            $category_data = $category->getrow(array("catid"=>front::get('id')));
            if($category_data['template']!=front::post('template')){
                front::remove(ROOT.'/cache/template_admin');
            }
        }
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.