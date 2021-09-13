<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class category extends table
{
    public $name = 'b_category';
    static $me;
    static $parent_array;
    static $parent_son_array;
    static $parent_template_array;
    static $parent_connent_array;
    static $parent_shopping_array;
    static $parent_shopping_son_array;
    static $parent_lang_array;

    function getcols($act)
    {
        return '*';
    }

    function get_form()
    {
        return array(
            'langid'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(lang::option()),
                'default'=>lang::getlangid(lang::getisadmin()),
            ),
            'ishtml' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('inherit'), 1 => lang_admin('generate'),
                    2 => lang_admin('no_generate'))),
                'default' => 0,
            ),
            'isshow' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('normal_display'), 0 =>lang_admin('forbidden'))),
                'default' => '1',
            ),
            'ispages' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('paging'), 0 => lang_admin('single_page'))),
                'default' => 1,
            ),
            'isshopping' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('no'), 1 => lang_admin('yes'))),
                'default' => 0,
            ),
            'includecatarchives' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('include'), 0 => lang_admin('no_include'))),
                'default' => 1,
            ),
            'isecoding' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('inherit'), 1 => lang_admin('lang_open'), 2 => lang_admin('lang_no_open'))),
                'default' => 0,
            ),
            'scategory' => array(//'tips'=>"&nbsp;被调用的格式 categories(\$catid,'标记')",
            ),
            'image' => array(
                'filetype' => 'thumb',
            ),
            'banner' => array(
                'filetype' => 'thumb',
            ),
            'template' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'))}",
            ),
            'templateshopping' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_shoppingtpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'))}",
            ),
            'listtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'listtemplate')}",
            ),
            'listshoppingtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_shoppingtpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'listtemplate')}",
            ),
            'showtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_tpl_list('archive/show')),
                'default' => "{?category::gettemplate(get('id'),'showtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'showshoppingtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_shoppingtpl_list('archive/show')),
                'default' => "{?category::gettemplate(get('id'),'showtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'templatewap' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->mobile_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplatewap',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'))}",
            ),
            'listtemplatewap' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->mobile_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplatewap',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'listtemplate')}",
            ),
            'showtemplatewap' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->mobile_tpl_list('archive/show')),
                'default' => "{?category::gettemplate(get('id'),'showtemplatewap',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'showform' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(get_my_tables_list()),
                'default' => "0",
            ),
            'isnav' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => lang_admin('show'), 0 => lang_admin('no_show'))),
                'default' => 1,
            ),
            'ismobilenav' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => lang_admin('show'), 0 => lang_admin('no_show'))),
                'default' => 1,
            ),
            'htmlrule' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(getHtmlRule('category')),
                'default' => '',
            ),
            'listhtmlrule' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(getHtmlRule('category')),
                'default' => '',
            ),
            'showhtmlrule' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(getHtmlRule('archive')),
                'default' => '',
            ),
            'categorycontent' => array(
                'type' => 'mediumtext',
            ),
            'nofollow' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('enabling'), 0 => lang_admin('forbidden'))),
                'default' => '0',
            ),
            'subListorder' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(0 =>lang_admin('release_time'),1 => lang_admin('edit_time'),2 => lang_admin('hottest'),3 => lang_admin('comment_most'))),
                'default' => '0',
            ),
            'contentrank' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(  'updatedate ASC'=> lang_admin('modification_time_positive_order'),
                    'updatedate DESC'=> lang_admin('modification_time_reverse_order'),
                    'adddate ASC' => lang_admin('add_time_positive_order'),
                    'adddate DESC'=> lang_admin('add_time_reverse_order_'),
                    'view ASC'=> lang_admin('browsing_volume_positive_order'),
                    'view DESC'=> lang_admin('browse_volume_reverse_order'),
                    'listorder ASC'=> lang_admin('by_serial_number_positive_order'),
                    'listorder DESC'=>lang_admin('number_in_reverse_order'),
                    'aid ASC'=> lang_admin('by_id_positive_order'),
                    'aid DESC'=> lang_admin('by_id_in_reverse_order'))),
                'default' => 'updatedate DESC',
            ),
            'isblank' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(0 => lang_admin('no'),1 => lang_admin('yes'))),
                'default' => '0',
            ),
            'isscreening' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('join_screening'), 0 => lang_admin('unfilter'))),
                'default' => '0',
            ),
            'isindex' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('no'), 1 => lang_admin('yes'))),
                'default' => 0,
            ),

        );
    }

    function get_form_field()
    {
        return array(
            'langid'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(lang::option(0,'tolast')),
                'default'=>lang::getlangid(lang::getisadmin()),
            ),
            'ishtml' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('inherit'), 1 => lang_admin('generate'),
                    2 => lang_admin('no_generate'))),
                'default' => 0,
            ),
            'isshow' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('normal_display'), 0 =>lang_admin('forbidden'))),
                'default' => '1',
            ),
            'ispages' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('paging'), 0 => lang_admin('single_page'))),
                'default' => 1,
            ),
            'isshopping' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('no'), 1 => lang_admin('yes'))),
                'default' => 0,
            ),
            'includecatarchives' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('include'), 0 => lang_admin('no_include'))),
                'default' => 1,
            ),
            'isecoding' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('inherit'), 1 => lang_admin('lang_open'), 2 => lang_admin('lang_no_open'))),
                'default' => 0,
            ),
            'scategory' => array(//'tips'=>"&nbsp;被调用的格式 categories(\$catid,'标记')",
            ),
            'image' => array(
                'filetype' => 'thumb',
            ),
            'template' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'))}",
            ),
            'templateshopping' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_shoppingtpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'))}",
            ),
            'listtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'listtemplate')}",
            ),
            'listshoppingtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_shoppingtpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'listtemplate')}",
            ),
            'showtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_tpl_list('archive/show')),
                'default' => "{?category::gettemplate(get('id'),'showtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'showshoppingtemplate' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_shoppingtpl_list('archive/show')),
                'default' => "{?category::gettemplate(get('id'),'showtemplate',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'templatewap' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->mobile_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplatewap',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'))}",
            ),
            'listtemplatewap' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->mobile_tpl_list('archive/list')),
                'default' => "{?category::gettemplate(get('id'),'listtemplatewap',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'listtemplate')}",
            ),
            'showtemplatewap' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->mobile_tpl_list('archive/show')),
                'default' => "{?category::gettemplate(get('id'),'showtemplatewap',false)}",
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'showform' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(get_my_tables_list()),
                'default' => "0",
            ),
            'isnav' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => lang_admin('show'), 0 => lang_admin('no_show'))),
                'default' => 1,
            ),
            'ismobilenav' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => lang_admin('show'), 0 => lang_admin('no_show'))),
                'default' => 1,
            ),
            'htmlrule' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(getHtmlRule('category')),
                'default' => '',
            ),
            'listhtmlrule' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(getHtmlRule('category')),
                'default' => '',
            ),
            'showhtmlrule' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(getHtmlRule('archive')),
                'default' => '',
            ),
            'categorycontent' => array(
                'type' => 'mediumtext',
            ),
            'nofollow' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('enabling'), 0 => lang_admin('forbidden'))),
                'default' => '0',
            ),
            'subListorder' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(0 =>lang_admin('release_time'),1 => lang_admin('edit_time'),2 => lang_admin('hottest'),3 => lang_admin('comment_most'))),
                'default' => '0',
            ),
            'contentrank' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(  'updatedate ASC'=> lang_admin('modification_time_positive_order'),
                    'updatedate DESC'=> lang_admin('modification_time_reverse_order'),
                    'adddate ASC' => lang_admin('add_time_positive_order'),
                    'adddate DESC'=> lang_admin('add_time_reverse_order_'),
                    'view ASC'=> lang_admin('browsing_volume_positive_order'),
                    'view DESC'=> lang_admin('browse_volume_reverse_order'),
                    'listorder ASC'=> lang_admin('by_serial_number_positive_order'),
                    'listorder DESC'=>lang_admin('number_in_reverse_order'),
                    'aid ASC'=> lang_admin('by_id_positive_order'),
                    'aid DESC'=> lang_admin('by_id_in_reverse_order'))),
                'default' => 'updatedate DESC',
            ),
            'isblank' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(0 => lang_admin('no'),1 => lang_admin('yes'))),
                'default' => '0',
            ),
            'isscreening' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('join_screening'), 0 => lang_admin('unfilter'))),
                'default' => '0',
            ),

        );
    }

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new category();
            $class->init();
            self::$me = $class;
        }
        return self::$me;
    }

    //栏目ID  $conent商品类型  all所有  conent只要内容栏目  shop商品 $mystatu是否包含自己
    public static function categories_new_nav($id = 0,$conent="all",$mystatu = false)
    {
        $cache_id =lang::getistemplate().'/category/'.$id.'/categories_new_nav-'.$id.'-'.$conent;
        if (cache::get($cache_id)){
            return cache::get($cache_id);
        }else {
            $class = new category();

            $where = 'isnav=1 and langid = "'.lang::getlangid(lang::getistemplate()).'"';
            if ($id>0 && $class->sonall($id,$mystatu,lang::getistemplate())!=""){
                $where.=" and catid in (".$class->sonall($id,$mystatu).")";
            }
            if (!file_exists(ROOT."/lib/table/shopping.php") || $conent=="conent"){
                $where.=" and isshopping=0 ";
            }
            if ($conent=="shop" && file_exists(ROOT."/lib/table/shopping.php")){
                $where.=" and isshopping=1";
            }
            $cats=array();
            $_category = $class->getrows($where, 1000, 'listorder=0,listorder desc','catid,parentid,catname,nofollow,isblank,isshow');

            foreach($_category as $key=>$category){
                if (!$category['isshow']){
                    continue;
                }
                if ($category['nofollow']){
                    $nofollow = '" rel="nofollow';
                }else{
                    $nofollow = '';
                }
                if ($category['isblank']){
                    $target = '" target="_blank';
                }else{
                    $target = '';
                }
                $_category[$key]['url'] = category::url($category['catid']).$nofollow.$target;
                $_category[$key]['children']=array();
                $cats[$category['catid']]=$_category[$key];
            }
            $tree = array(); //格式化好的树
            foreach ($cats as $key=>$item){
                if (isset($cats[$item['parentid']]))
                    $cats[$item['parentid']]['children'][] = &$cats[$item['catid']];
                else
                    $tree[] = &$cats[$item['catid']];
            }
            if($id==0 && $conent=="all"){
                foreach ($tree as $key=>$item)
                    if ($item['parentid']>0) unset($tree[$key]);
            }
            cache::set($cache_id, $tree);
            return $tree;
        }

    }

    function init()
    {
        $_category = $this->getrows(null, 0, 'listorder=0,listorder asc');
        $category = array();
        foreach ($_category as $one) {
            if (!front::$admin && !$one['isshow']) continue;
            $category[$one['catid']] = $one;
        }
        $this->category = $category;
        $parent = array();
        foreach ($category as $one) {
            if ($one['catid']!=$one['parentid'])
                $parent[$one['catid']] = $one['parentid'];
        }
        $this->parent = $parent;
        $this->tree = new tree($parent);
    }

    function son($id, $langurlname = '')
    {
        //增加语言包过滤
        $langurlname=$langurlname==""?lang::getisadmin():$langurlname;
        $parent=category::getInstance()->parent_son_array($langurlname);
        $this->parent = $parent;
        $this->tree = new tree($parent);
        return $this->tree->get_son($id);
    }
    function parent_son_array($langurlname){
        if ( !self::$parent_son_array ||!isset(self::$parent_son_array[$langurlname]) || self::$parent_son_array[$langurlname]=="") {
            $where = '  langid = "'.lang::getlangid($langurlname).'"';
            $_category = category::getInstance()->getrows($where, 0, 'listorder=0,listorder asc');
            $category = array();
            foreach ($_category as $one) {
                if (!front::$admin && !$one['isshow']) continue;
                $category[$one['catid']] = $one;
            }
            $this->category = $category;
            $parent = array();
            foreach ($category as $one) {
                $parent[$one['catid']] = $one['parentid'];
            }
            self::$parent_son_array[$langurlname] = $parent;
        }
        return self::$parent_son_array[$langurlname];
    }

    function shoppingson($id)
    {
        $parent=category::getInstance()->parent_shopping_array();
        $this->parent = $parent;
        $this->tree = new tree($parent);
        return $this->tree->get_son($id);
    }
    function parent_shopping_array(){
        if (!self::$parent_shopping_array) {
            //增加语言包过滤
            $where = 'isshopping=1 and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            $_category = $this->getrows($where, 1000, 'listorder=0,listorder asc');
            $category = array();
            foreach ($_category as $one) {
                if (!front::$admin && !$one['isshow']) continue;
                $category[$one['catid']] = $one;
            }
            $this->category = $category;
            $parent = array();
            foreach ($category as $one) {
                $parent[$one['catid']] = $one['parentid'];
            }
            self::$parent_shopping_array = $parent;
        }
        return self::$parent_shopping_array;
    }


    function connentson($id)
    {
        $parent=category::getInstance()->parent_connent_array();
        $this->parent = $parent;
        $this->tree = new tree($parent);
        return $this->tree->get_son($id);
    }
    function parent_connent_array(){
        if (!self::$parent_connent_array) {
            //增加语言包过滤
            $where = 'isshopping=0 and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            $_category = $this->getrows($where, 1000, 'listorder=0,listorder desc');
            $category = array();
            foreach ($_category as $one) {
                if (!front::$admin && !$one['isshow']) continue;
                $category[$one['catid']] = $one;
            }
            $this->category = $category;
            $parent = array();
            foreach ($category as $one) {
                $parent[$one['catid']] = $one['parentid'];
            }
            self::$parent_connent_array = $parent;
        }
        return self::$parent_connent_array;
    }


    //前台栏目获取
    function templateson($id)
    {
        $parent=category::getInstance()->parent_template_array();
        $this->parent = $parent;
        $this->tree = new tree($parent);
        return $this->tree->get_son($id);
    }
    function parent_template_array(){
        if (!self::$parent_template_array) {
            //增加语言包过滤
            $where = '  langid = "'.lang::getlangid(lang::getistemplate()).'"';
            $_category = $this->getrows($where, 0, 'listorder=0,listorder desc');
            $category = array();
            foreach ($_category as $one) {
                if (!front::$admin && !$one['isshow']) continue;
                $category[$one['catid']] = $one;
            }
            $this->category = $category;
            $parent = array();
            foreach ($category as $one) {
                $parent[$one['catid']] = $one['parentid'];
            }
            self::$parent_template_array = $parent;
        }
        return self::$parent_template_array;
    }



    function sons($id)
    {
        if (!isset($this->tree)) $this->init();
        $sons = array();
        $this->tree->get_sons($id, $sons);
        return $sons;
    }

    function langsons($id)
    {
        $this->langinit();
        $sons = array();
        $this->tree->get_sons($id, $sons);
        return $sons;
    }

    function langinit()
    {
        $parent=category::getInstance()->parent_lang_array();
        $this->parent = $parent;
        $this->tree = new tree($parent);
    }
    function parent_lang_array(){
        if (!self::$parent_lang_array) {
            //增加语言包过滤
            $_category = $this->getrows( '  langid = "'.lang::getlangid(lang::getisadmin()).'"', 1000, 'listorder=0,listorder asc');
            $category = array();
            foreach ($_category as $one) {
                if (!front::$admin && !$one['isshow']) continue;
                $category[$one['catid']] = $one;
            }
            $this->category = $category;
            $parent = array();
            foreach ($category as $one) {
                $parent[$one['catid']] = $one['parentid'];
            }
            self::$parent_lang_array = $parent;
        }
        return self::$parent_lang_array;
    }


    public static function hasson($id)
    {
        return self::getInstance()->tree->has_son($id);
    }

    function getparents($id, $up = true)
    {
        if (!isset($this->tree)) $this->init();
        return $this->tree->get_parents($id);
    }

    static function getparentsid($id, $up = true)
    {
        $category = self::getInstance();
        if (!isset($category->tree)) $category->init();
        return $category->tree->get_parents($id);
    }

    function getparent($id)
    {
        if (isset($this->tree->parent[$id])) return $this->tree->parent[$id];
        else return false;
    }

    function getposition($id)
    {
        if (!isset($this->tree)) $this->init();
        $position = $this->tree->get_parents($id);
        return $position;
    }

    function getposition1($id)
    {
        if (!isset($this->tree)) $this->init();
        $position = $this->tree->get_parents1($id);
        return $position;
    }

    static function gettopparent($id)
    {
        $position = self::getInstance()->getposition($id);
        return $position[count($position) - 1];
    }

    function htmlpath($id)
    {
        if (!isset($this->tree)) $this->init();
        $positions = $this->tree->get_parents($id);
        $path = array();
        foreach ($positions as $_id) {
            if ($_id && isset($this->category[$_id])) $path[] = $this->category[$_id]['htmldir'];
        }
        return implode('/', $path);
    }

    static function option($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0, &$langurlname = '')
    {
        if(session::get("option_category_modules_".lang::getisadmin())){
            return session::get("option_category_modules_".lang::getisadmin());
        }
        /*   $category = self::getInstance();
        if (is_array($category->son($catid,$langurlname)))
            foreach ($category->son($catid,$langurlname) as $_catid) {
                if (!self::check($_catid, $tag)) continue;
                $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
                $option[$_catid] = $strpre . $category->category[$_catid]['catname'];
                if (is_array($category->son($_catid,$langurlname))) {
                    $level++;
                    self::option($_catid, $tag, $option, $level);
                    $level--;
                }
            }*/
        $option=self::optionall($catid,$tag,$option,$level,$langurlname);
        session::set("option_category_modules_".lang::getisadmin(),$option);
        return $option;
    }

    static function getoption($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0)
    {
        if(session::get("categoryoption_".lang::getisadmin()) && !front::get("ajax")){
            return session::get("categoryoption_".lang::getisadmin());
        }
        $option=self::option($catid,$tag,$option,$level);
        if (!front::get("ajax")) {
            session::set("categoryoption_" . lang::getisadmin(), $option);
        }
        return $option;
    }

    static function getfieldoption($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0, $langurlname = '')
    {
        $langurlname=$langurlname==""?lang::getisadmin():$langurlname;
        if(session::get("categoryoption_".$langurlname)){
            return session::get("categoryoption_".$langurlname);
        }
        $option=self::option($catid,$tag,$option,$level,$langurlname);
        session::set("categoryoption_".$langurlname,$option);
        return $option;
    }

    //获取所有子栏目id     $mystatu是否包含自己
    static function sonall($catid,$mystatu = false,$langurlname = ''){
        $langurlname=$langurlname==""?lang::getisadmin():$langurlname;
        $cache_id =lang::getistemplate().'/category/all/sonall-'.$catid.'-'.($mystatu?1:0);
        if (cache::get($cache_id))
            return cache::get($cache_id);
        else {
            //增加语言包过滤
            $category = self::getInstance();
            $category->sonall=isset($category->sonall)?$category->sonall:"";
            if (is_array($category->son($catid,$langurlname)))
                foreach ($category->son($catid,$langurlname) as $_catid) {
                    if ($category->sonall != "") {
                        $category->sonall .= ',' . $_catid;
                    } else {
                        $category->sonall .= $_catid;
                    }
                    if (is_array($category->son($_catid,$langurlname))) {
                        $category->sonall($_catid,$langurlname);
                    }
                }
            if ($mystatu) {
                if ($category->sonall != "") {
                    $category->sonall .= ',' . $catid;
                } else {
                    $category->sonall .= $catid;
                }
            }
            cache::set($cache_id, $category->sonall);
            return $category->sonall;
        }
    }

    static function optionconnent($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0)
    {
        $category = self::getInstance();
        if (is_array($category->connentson($catid))) foreach ($category->connentson($catid) as $_catid) {
            if (!self::check($_catid, $tag)) continue;
            if (!chkpower($_catid)) continue;
            $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
            $option[$_catid] = $strpre . $category->category[$_catid]['catname'];
            if (is_array($category->connentson($_catid))) {
                $level++;
                self::optionconnent($_catid, $tag, $option, $level);
                $level--;
            }
        }
        return $option;
    }

    static function optionall($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0,$langurlname = '')
    {
        $category = self::getInstance();
        if (is_array($category->son($catid,$langurlname)))
            foreach ($category->son($catid,$langurlname) as $_catid) {
                if (!self::check($_catid, $tag)) continue;
                $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
                $option[$_catid] = $strpre . $category->category[$_catid]['catname'];
                if (is_array($category->son($_catid,$langurlname))) {
                    $level++;
                    self::optionall($_catid, $tag, $option, $level,$langurlname);
                    $level--;
                }
            }
        return $option;
    }


    static function getoptionconnent($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0)
    {
        if(!front::get("ajax") && session::get("optionconnent_".lang::getisadmin())){
            return session::get("optionconnent_".lang::getisadmin());
        }
        $option=self::optionconnent($catid,$tag,$option,$level);
        if (!front::get("ajax")) {
            session::set("optionconnent_" . lang::getisadmin(), $option);
        }
        return $option;
    }

    static function optionshopping($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0,$langurlname = '')
    {
        $category = self::getInstance();
        if (is_array($category->sonshopping($catid,$langurlname)))
            foreach ($category->sonshopping($catid,$langurlname) as $_catid) {
                if (!self::check($_catid, $tag)) continue;
                if (!chkpower($_catid)) continue;
                $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
                $option[$_catid] = $strpre . $category->category[$_catid]['catname'];
                if (is_array($category->sonshopping($_catid,$langurlname))) {
                    $level++;
                    self::optionshopping($_catid, $tag, $option, $level,$langurlname);
                    $level--;
                }
            }
        return $option;
    }

    static function getoptionshopping($catid = 0, $tag = 'all', &$option = array(0 => '请选择...'), &$level = 0)
    {
        if(session::get("optionshopping_".lang::getisadmin()) && !front::get("ajax")){
            return session::get("optionshopping_".lang::getisadmin());
        }
        $option=self::optionshopping($catid,$tag,$option,$level);
        if (!front::get("ajax")){
            session::set("optionshopping_".lang::getisadmin(),$option);
        }
        return $option;
    }

    function sonshopping($id,$langurlname="")
    {
        $langurlname=$langurlname==""?lang::getisadmin():$langurlname;
        $parent=category::getInstance()->parent_shopping_son_array($langurlname);
        $this->parent = $parent;
        $this->tree = new tree($parent);
        return $this->tree->get_son($id);
    }
    function parent_shopping_son_array($langurlname){
        if (!self::$parent_shopping_son_array  || !isset(self::$parent_shopping_son_array[$langurlname])  || self::$parent_shopping_son_array[$langurlname]=="") {
            $where = '  langid = "'.lang::getlangid($langurlname).'"';
            $where.= ' and  (isshopping=1 or parentid <> "0")';
            $_category = $this->getrows($where, 0, 'listorder=0,listorder desc');
            $category = array();
            foreach ($_category as $key=>$one) {
                if (!front::$admin && !$one['isshow']) continue;
                $category[$one['catid']] = $one;
            }
            $this->category = $category;
            $parent = array();
            foreach ($category as $one) {
                $parent[$one['catid']] = $one['parentid'];
            }
            self::$parent_shopping_son_array[$langurlname] = $parent;
        }
        return self::$parent_shopping_son_array[$langurlname];
    }

    /* static function optionshopping($tag = 'all', &$option = array(0 => '请选择...'), &$level = 0)
     {
         $catid=0;
         $category = self::getInstance();
         if (is_array($category->sonshopping($catid)))
             foreach ($category->sonshopping($catid) as $_catid) {
             if (!self::check($_catid, $tag)) continue;
             $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
             $option[$_catid] = $strpre . $category->category[$_catid]['catname'];
             if (is_array($category->sonshopping($_catid))) {
                 $level++;
                 self::optiontemplate($_catid, $tag, $option, $level);
                 $level--;
             }
         }
         return $option;
     }

     function sonshopping($id)
     {
         $_category = $this->getrows('isshopping=1 or parentid <> "0"', 1000, 'listorder=0,listorder asc');
         $category = array();
         $_lang =new lang();
         $_langdata= $_lang->getrows('langurlname="'.lang::getisadmin().'"', 1, 'id asc');
         foreach ($_category as $key=>$one) {
             if($_langdata[0]['id'] != $_category[$key]['langid']){
                 unset($_category[$key]);
                 continue;
             }
             if (!front::$admin && !$one['isshow']) continue;
             $category[$one['catid']] = $one;
         }
         $this->category = $category;
         $parent = array();
         foreach ($category as $one) {
             $parent[$one['catid']] = $one['parentid'];
         }
         $this->parent = $parent;
         $this->tree = new tree($parent);
         return $this->tree->get_son($id);
     }*/

    static function name($catid)
    {
        $category = self::getInstance();
        $categorydata=$category->getrow('catid='.$catid);
        if (is_array($categorydata)){
            return $categorydata['catname'];
        }
        // if (isset($category->category[$catid]['catname'])) return $category->category[$catid]['catname'];
        return '';
    }

    static function categorypages($catid)
    {
        $category = self::getInstance();
        if (isset($category->category[$catid]['attr3'])) return $category->category[$catid]['attr3'];
        else return '';
    }

    static function image($catid)
    {
        $category = self::getInstance();
        if (isset($category->category[$catid]['image'])) return view::get_base_url() . '/' . $category->category[$catid]['image'];
        else return '';
    }

    static function num($catid)
    {
        $category = self::getInstance();
        $catids = $category->sons($catid);
        //var_dump($catids);
        if($catids) {
            $where = "catid in($catid," . implode(',', $catids) . ")";
        }else{
            $where = "catid = '$catid'";
        }
        $arc = archive::getInstance();
        return $arc->rec_count($where);
    }
     //$state为false的时候代表动态下的缓存路径
    static function url($catid, $page = null,$lang='',$state=true)
    {
        //var_dump(front::$get);
        $category = self::getInstance();
        if ($lang==""){
            $lang=lang::getisadmin();
        }
        if (@$category->category[$catid]['linkto']) return $category->category[$catid]['linkto'];
        if (front::$ismobile == true) {
            if (config::getadmin('wap_html_prefix')) {
                $wap_html_prefix = '/' . trim(config::getadmin('wap_html_prefix'), '/');
            }
            if (front::$rewrite) {
                if (!$page) {
                    return config::get('site_url') . 'list-wap-'. $catid.'-'.$lang. '.htm';
                } else {
                    return config::get('site_url') . 'list-wap-' . $catid .'-'. $page.'-'.$lang.'.htm';
                }
            }
            if (!category::getiswaphtml($catid)) {
                if (!$page) {
                    return url::create('archive/list/t/wap/catid/' . $catid);
                } else {
                    return url::create('archive/list/t/wap/catid/' . $catid . '/page/' . $page);
                }
            }
            else {
                $rule = category::gethtmlrule($catid, 'listhtmlrule');
                //自定义url
                if ($category->category[$catid]['set_htmlrule']){
                    $rule_list=explode("/",$rule);
                    if (is_array($rule_list) && count($rule_list)>0){
                        $rule="";
                        $rule_list[count($rule_list)-1]=$category->category[$catid]['set_htmlrule'];
                        foreach ($rule_list as $val){
                            if ($rule=="")
                                $rule=$val;
                            else
                                $rule.='/'.$val;
                        }

                    }
                }

                $rule = str_replace('{$caturl}', $category->htmlpath($catid), $rule);
                $rule = str_replace('{$dir}', $category->category[$catid]['htmldir'], $rule);
                $rule = str_replace('{$catid}', $catid, $rule);
                $rule=str_replace('{$lang}',$lang,$rule);
                if ($category->category[$catid]['ispages'] && !$page) $page = 1;
                if ($page) $rule = str_replace('{$page}', $page, $rule);
                else $rule = preg_replace('/\(.*?\)/', '', $rule);
                $rule = preg_replace('%/\.html$%', '/index.html', $rule);
                $rule = preg_replace('/[\(\)]/', '', $rule);
                $rule = preg_replace('%[\\/]index\.htm(l)?%', '', $rule);
                $rule = rtrim($rule, '/');
                $rule = trim($rule, '\\');
                if ($relative) return $wap_html_prefix . '/' . $rule;
                $rule = str_replace('/1.html', '/', $rule);
                $base_url=view::get_base_url();
                if ($base_url!=""){
                    $path=$base_url.$wap_html_prefix .'/'. $rule;
                }else{
                    $path=$wap_html_prefix .'/'. $rule;
                }
                //echo $path;
                return $path;
            }
        }
        if (config::getadmin('html_prefix')) $html_prefix = '/' . trim(config::get('html_prefix'), '/');
        if ($state && (!category::getishtml($catid)  || front::$isvalue || front::$rewrite)) {
            if (!$page){
                return url::create('archive/list/catid/' . $catid,false);
            }else {
                return url::create('archive/list/catid/' . $catid . '/page/' . $page,false);
            }
        }
        else {
            $rule = category::gethtmlrule($catid, 'listhtmlrule');
            //自定义url
            if (isset($category->category[$catid]['set_htmlrule']) && $category->category[$catid]['set_htmlrule']){
                $rule_list=explode("/",$rule);
                if (is_array($rule_list) && count($rule_list)>0){
                    $rule="";
                    $rule_list[count($rule_list)-1]=$category->category[$catid]['set_htmlrule'];
                    foreach ($rule_list as $val){
                        if ($rule=="")
                            $rule=$val;
                        else
                            $rule.='/'.$val;
                    }

                }
            }

            $category = self::getInstance();
            $category->init();
            $rule = str_replace('{$caturl}', $category->htmlpath($catid), $rule);
            $category->category[$catid]['htmldir']=isset($category->category[$catid]['htmldir'])?$category->category[$catid]['htmldir']:"";
            $rule = str_replace('{$dir}', $category->category[$catid]['htmldir'], $rule);
            $rule = str_replace('{$catid}', $catid, $rule);
            $rule=str_replace('{$lang}',$lang,$rule);
            $category->category[$catid]['ispages']=isset($category->category[$catid]['ispages'])?$category->category[$catid]['ispages']:"";
            if ($category->category[$catid]['ispages'] && !$page) {
                $page = 1;
            }
            if ($page) {
                $rule = str_replace('{$page}', $page, $rule);
            } else {
                $rule = preg_replace('/\(.*?\)/', '', $rule);
            }
            //echo '<script>alert("'.$rule.'");</script>';
            $rule = preg_replace('%/\.html$%', '/index.html', $rule);
            $rule = preg_replace('/[\(\)]/', '', $rule);
            $rule = preg_replace('%[\\/]index\.htm(l)?%', '', $rule);
            $rule = rtrim($rule, '/');
            $rule = trim($rule, '\\');
            $rule = str_replace('/1.html', '/', $rule);
            $base_url=view::get_base_url();
            if ($base_url!=""){
                $path=$base_url.$html_prefix .'/'. $rule;
            }else{
                $path=$html_prefix .'/'. $rule;
            }
            return $path;
        }
    }

    //url生成规则
    static  function  url_rule($path){
        $base_url=view::get_base_url();
        if ($base_url == '/') {
            $path = ROOT . substr($path, 1);
        } else {
            $path = ROOT . str_replace($base_url, '', $path);
        }
        if (strpos($path,'.html') == false){
            $path.="1.html";
        }
        if (!preg_match('/\.[a-zA-Z]+$/', $path))
            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
        $path = rtrim($path, '/');
        $path = rtrim($path, '\\');
        $path = str_replace('//', '/', $path); 
        return $path;
    }

    static function getpositionlink($catid)
    {
        $category = self::getInstance();
        if (!isset($category->category[$catid])) return;
        $position = $category->getposition($catid);
        $links = array();
        if (!$catid) return $links;
        foreach ($position as $order => $id) {
            $links[$order]['id'] = $id;
            $links[$order]['name'] = @$category->category[$id]['catname'];
            $links[$order]['url'] = self::url($id);
        }
        return $links;
    }

    static function getpositionlink1($catid)
    {
        $category = self::getInstance();
        if (!isset($category->category[$catid])) return;
        $position = $category->getposition($catid);
        $links = array();
        if (!$catid) return $links;
        foreach ($position as $order => $id) {
            $links['id'] = $id;
            $links['name'] = @$category->category[$id]['catname'];
            $links['url'] = self::url($id);
            break;
        }
        return $links;
    }

    static function getpositionlink2($catid)
    {
        $category = self::getInstance();
        if (!isset($category->category[$catid])) return;
        $position = $category->getposition1($catid);
        $links = array();
        if (!$catid) return $links;
        foreach ($position as $order => $id) {
            $links[$order]['id'] = $id;
            $links[$order]['name'] = @$category->category[$id]['catname'];
            $links[$order]['url'] = self::url($id);
        }
        return $links;
    }

    static function isshopping($catid){
        $category = self::getInstance()->getrow('catid='.$catid);
        if (is_array($category))
            if ($category['isshopping'])
                return true;
        return false;
    }

    static function gettemplate($catid, $tag = 'listtemplate', $up = true,$_style=null,$archive=false)
    {
        if (!$catid && front::get('parentid')) $catid = front::get('parentid');
        $category = self::getInstance();
        if (@$category->category[$catid]['template']  && !$archive && $tag == 'listtemplate' && ($_style==null || file_exists(TEMPLATE . '/' . $_style . '/' . $category->category[$catid]['template'])
                || (file_exists(TEMPLATE . '/'.$category->category[$catid]['template'])))) return $category->category[$catid]['template'];
        if (@$category->category[$catid][$tag] && ($_style==null ||  file_exists(TEMPLATE . '/' . $_style . '/' . $category->category[$catid][$tag])
                || (file_exists(TEMPLATE . '/'.$category->category[$catid][$tag]))  || (file_exists(TEMPLATE .'/'.config::get('template_shopping_dir'). '/'.$category->category[$catid][$tag])) ))
            return $category->category[$catid][$tag];
        if (!$up) return;
        $parents = $category->getparents($catid, true);
        ksort($parents);
        foreach ($parents as $pid) {
            if ($pid == $catid) continue;
            if (@$category->category[$pid][$tag] &&  ($_style==null ||  file_exists(TEMPLATE . '/' . $_style . '/' . $category->category[$pid][$tag])
                    || (file_exists(TEMPLATE . '/'.$category->category[$pid][$tag]))))
                return $category->category[$pid][$tag];
        }
        $default = array(
            'listtemplate' => 'archive/list.html',
            'showtemplate' => 'archive/show.html',
        );
        if (isset($default[$tag])) return $default[$tag];
    }

    static function gettemplatewap($catid, $tag = 'listtemplatewap', $up = true,$_style=null)
    {
        //echo 11;
        if (!$catid && front::get('parentid')) $catid = front::get('parentid');
        $category = self::getInstance();
        if (@$category->category[$catid]['templatewap'] && $tag == 'listtemplatewap' && ($_style==null || file_exists(TEMPLATE . '/' . $_style . '/' . $category->category[$catid]['templatewap'])
                || (file_exists(TEMPLATE . '/'.$category->category[$catid]['templatewap']))))return $category->category[$catid]['templatewap'];
        if (@$category->category[$catid][$tag] && ($_style==null ||  file_exists(TEMPLATE . '/' . $_style . '/' . $category->category[$catid][$tag])
                || (file_exists(TEMPLATE . '/'.$category->category[$catid][$tag])))) return $category->category[$catid][$tag];
        if (!$up) return;
        //echo 22;
        $parents = $category->getparents($catid, true);
        ksort($parents);
        foreach ($parents as $pid) {
            if ($pid == $catid) continue;
            if (@$category->category[$pid][$tag]  &&  ($_style==null ||  file_exists(TEMPLATE . '/' . $_style . '/' . $category->category[$pid][$tag])
                    || (file_exists(TEMPLATE . '/'.$category->category[$pid][$tag])))) return $category->category[$pid][$tag];
        }
        $default = array(
            'listtemplatewap' => 'archive/list.html',
            'showtemplatewap' => 'archive/show.html',
        );
        //echo 11;
        if (isset($default[$tag])) return $default[$tag];
    }

    static function gethtmlrule($catid, $tag = 'listhtmlrule')
    {
        if (!$catid && front::get('parentid')) $catid = front::get('parentid');
        $category = self::getInstance();

        if (@$category->category[$catid]['htmlrule'] && $tag == 'listhtmlrule') return $category->category[$catid]['htmlrule'];
        if (@$category->category[$catid]['showhtmlrule'] && $tag == 'showhtmlrule') return $category->category[$catid]['showhtmlrule'];
        $parents = $category->getparents($catid, true);
        ksort($parents);
        foreach ($parents as $pid) {
            if ($pid == $catid) continue;
            if (@$category->category[$pid][$tag]) return $category->category[$pid][$tag];
        }
        $default = array(
            'listhtmlrule' => '{$dir}/{$page}.html',
            'showhtmlrule' => '{$dir}/show-{$aid}-{$page}.html',
        );
        if (isset($default[$tag])) return $default[$tag];
    }

    static function getishtml($catid)
    {
        $category = self::getInstance();
        if (@$category->category[$catid]['ishtml'] == '2' || @$category->category[$catid]['ishtml'] == '') return false;
        if (config::getadmin('list_page_php') == '1') return true;
        if (config::getadmin('list_page_php') == '2') return false;

        if (@$category->category[$catid]['ishtml'] == '1') return true;
        $parents = $category->getparents($catid, true);
        ksort($parents);
        foreach ($parents as $pid) {
            if ($pid == $catid) continue;
            if (@$category->category[$pid]['ishtml'] == '1') return true;
            if (@$category->category[$pid]['ishtml'] == '2') return false;
        }
        return false;
    }

    static function getiswaphtml($catid)
    {
        if (config::getadmin('wap_list_page_php') == '1') return true;
        if (config::getadmin('wap_list_page_php') == '2') return false;
        $category = self::getInstance();
        if (@$category->category[$catid]['iswaphtml'] == '1') return true;
        $parents = $category->getparents($catid, true);
        ksort($parents);
        foreach ($parents as $pid) {
            if ($pid == $catid) continue;
            if (@$category->category[$pid]['iswaphtml'] == '1') return true;
            if (@$category->category[$pid]['iswaphtml'] == '2') return false;
        }
        return false;
    }

    static function getarcishtml($arc)
    {
        if (config::getadmin('show_page_php') == '1') return true;
        if (config::getadmin('show_page_php') == '2') return false;
        if (isset($arc['ishtml']) && $arc['ishtml']) return true;
        if (isset($arc['catid']) && self::getishtml($arc['catid'])) return true;
        return false;
    }

    static function getarciswaphtml($arc)
    {
        if (config::getadmin('wap_show_page_php') == '1') return true;
        if (config::getadmin('wap_show_page_php') == '2') return false;
        if ($arc['iswaphtml']) return true;
        if (self::getiswaphtml($arc['catid'])) return true;
        return false;
    }

    static function getattr($categoryid, $attr)
    {
        $category = self::getInstance();
        if (@$category->category[$categoryid][$attr]) return $category->category[$categoryid][$attr];
        $parents = $category->getparents($categoryid, true);
        ksort($parents);
        foreach ($parents as $pid) {
            if ($pid == $categoryid) continue;
            if (@$category->category[$pid][$attr]) return $category->category[$categoryid][$attr];
        }
        return false;
    }

    static function getwidthofthumb($catid)
    {
        $width = self::getattr($catid, 'thumb_width');
        if (!$width) $width = config::get('thumb_width');
        return $width;
    }

    static function getheightofthumb($catid)
    {
        $height = self::getattr($catid, 'thumb_height');
        if (!$height) $height = config::get('thumb_height');
        return $height;
    }

    //栏目ID  $mystatu是否包含自己
    public static function getcategorydata_new($_catid = 0,$mystatu = false)
    {
        if (session::get("categorydata_new_".lang::getisadmin()) && !front::get("ajax")) {
            return session::get("categorydata_new_".lang::getisadmin());
        }
        $class = new category();
        $where = 'langid = "'.lang::getlangid(lang::getisadmin()).'"';
        if ($_catid>0){
            $where.=" and catid in (".$class->sonall($_catid,$mystatu).")";
        }
        $cats=array();
        $_category = $class->getrows($where, 1000, '`listorder` desc,1');
        foreach($_category as $key=>$category){
            $_category[$key]['url'] = category::url($category['catid']);
            $cats[$category['catid']]=$_category[$key];
        }

        $tree = array(); //格式化好的树
        foreach ($cats as $key=>$item)
            if (isset($cats[$item['parentid']]))
                $cats[$item['parentid']]['children'][] = &$cats[$item['catid']];
            else
                $tree[] = &$cats[$item['catid']];

        if( $_catid==0){
            foreach ($tree as $key=>$item)
                if ($item['parentid']>0) unset($tree[$key]);
        }
        if (!front::get("ajax")) {
            session::set("categorydata_new_" . lang::getisadmin(), $tree);
        }
        return $tree;
    }

    //栏目列表
    public static function gethtmlcategorydata_new($tree,$children=false,$leveldiv=0,$token=""){

        $html = '';
        foreach($tree as $t)
        {
            if (chkpower($t['catid']) || usergroup::getusergropadmin(user::getuserid())) {
                if ($t['children'] == '') {
                    $html .= '<tr onmouseover="m_over(this)" onmouseout="m_out(this)" lang="' . $leveldiv . '" ';
                    $html .= ($children ? 'name="leveldiv" style="display:none"' : "") . '" >';
                    $html .= '<input type="hidden" id="catid' . $t['catid'] . '" name="catid' . $t['catid'] . '" value="' . $t['catid'] . '" >';
                    $html .= '<input type="hidden" id="isshopping' . $t['catid'] . '" name="isshopping' . $t['catid'] . '" value="' . $t['catid'] . '" >';
                    $html .= '<td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="' . $t['catid'] . '" name="select[]"></td>';
                    $html .= '<td class="htmldir">' . $t['catid'] . '</td>';
                    $html .= '<td class="sort"><input type="text" name="listorder' . $t['catid'] . '" id="listorder' . $t['catid'] . '" value="' . $t['listorder'] . '"  onchange="setchange(\'' . $t['catid'] . '\');" class="form-control "></td>';

                    $html .= '<td class="catname">';
                    $html .= '<a class="child"></a><div class="input-group">';
                    $html .= '';
                    $fhcatname = "";
                    for ($i = 0; $i <= $leveldiv; $i++) {
                        if ($i == 0) {
                            continue;
                        } else if ($i == 1) {
                            $fhcatname = "<span class=\"input-group-addon indent\"></span><span class=\"input-group-addon indent\"></span>";
                        } else {
                            $fhcatname = "<span class=\"input-group-addon indent\"></span>" . $fhcatname;
                        }
                    }
                    $html .= $fhcatname . '<input type="text" name="catname' . $t['catid'] . '" id="catname' . $t['catid'] . '" value="' . $t['catname'] . '"  onchange="setchange(\'' . $t['catid'] . '\');" class="form-control ">';
                    $html .= '</div></td>';
                    $html .= '<td class="htmldir">';
                    $html .= '<span class="hotspot" onmouseover="tooltip.show(\'' . lang_admin('column_file_storage_directory_directory_must_be_in_english_or_pinyin_no_space_in_the_middle') . '\');" onmouseout="tooltip.hide();">' . $t['htmldir'] . '</span>';
                    $html .= '</td>';
                    $html .= '<td class="isnav text-center">';
                    $html .= '<span class="hotspot" onmouseover="tooltip.show(\'' . lang_admin('choose_whether_the_column_is_displayed_in_navigation_only_for_top_level_columns') . '\');" onmouseout="tooltip.hide();">';
                    $html .= '<select id="isnav' . $t['catid'] . '" name="isnav' . $t['catid'] . '"   onchange="setchange(\'' . $t['catid'] . '\');" class="form-control select isnav" >';
                    $html .= '<option value="1" ' . ($t['isnav'] ? 'selected' : '') . '>' . lang_admin('show') . '</option>';
                    $html .= '<option value="0" ' . ($t['isnav'] ? '' : 'selected') . '>' . lang_admin('no_show') . '</option>';
                    $html .= '</select></span></td>';
                    $html .= '<td class="text-center">';
                    $html .= '<span class="' . ($t['isshopping'] ? 'category-list-shopping-icon">' . lang_admin('commodity') : '">' . lang_admin('content')) . '</span></td>';
                    $html .= '<td class="manage">';
                    if (chkpower($t['catid'])) {
                        $html .= ' <a  href="#" onclick="gotourl(this)"   data-dataurl="' . ($t['isshopping'] ? url("table/edit/table/category/id/" . $t['catid'] . "/shopping/1") : url("table/edit/table/category/id/" . $t['catid'])) . '"';
                        $html .= ' title="' . lang_admin('edit') . '" class="btn btn-gray" data-dataurlname="' . lang_admin('edit_column') . '">' . lang_admin('edit') . '</a>';
                    }
                    $html .= '<div class="btn-group">';
                    $html .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    $html .= lang_admin('more') . '<span class="caret"></span>';
                    $html .= '</button>';
                    $html .= '<ul class="dropdown-menu">';
                    $html .= ' <li><a href="' . url("archive/list/catid/" . $t['catid'], false) . '" target="_blank" title="' . lang_admin('see') . '">' . lang_admin('see') . '</a></li>';
                    $html .= ' <li><a  href="#" onclick="gotourl(this)"   data-dataurl="' . ($t['isshopping'] ? url("table/copy/table/category/id/" . $t['catid'] . "/shopping/1") : url("table/copy/table/category/id/" . $t['catid'])) . '"';
                    $html .= 'title="' . lang_admin('copy_column') . '" data-dataurlname="' . lang_admin('copy_column') . '">' . lang_admin('copy') . '</a></li>';
                    if ($t['isshopping']) {
                        $html .= '<li><a href="#" onclick="gotourl(this)"   data-dataurl="' . url("table/list/table/archive/catid/" . $t['catid'] . "/shopping/1") . '" title="' . lang_admin('content_management') . '" data-dataurlname="' . lang_admin('content_management') . '">' . lang_admin('administration') . '</a></li>';
                    } else {
                        $html .= '<li><a href="#" onclick="gotourl(this)"   data-dataurl="' . url("table/list/table/archive/catid/" . $t['catid']) . '" title="' . lang_admin('administration') . '">' . lang_admin('administration') . '</a></li>';
                    }
                    $html .= '<li role="separator" class="divider"></li>';
                    $html .= '<li><a onclick="if(confirm(\'' . lang_admin('are_you_sure_you_want_to_delete_it') . '\')){gotourl(this);}" href="#"';
                    $html .= 'data-dataurl="' . url("table/delete/table/category/id/" . $t['catid'] . "/token/" . $token) . '"';
                    $html .= ' title="' . lang_admin('delete') . '">' . lang_admin('delete') . '</a></li>';
                    $html .= '</ul>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '</tr>';
                } else {
                    $html .= '<tr onmouseover="m_over(this)" onmouseout="m_out(this)" lang="' . $leveldiv . '" ';
                    $html .= ($children ? 'name="leveldiv" style="display:none"' : "") . '" >';
                    $html .= '<input type="hidden" id="catid' . $t['catid'] . '" name="catid' . $t['catid'] . '" value="' . $t['catid'] . '" >';
                    $html .= '<input type="hidden" id="isshopping' . $t['catid'] . '" name="isshopping' . $t['catid'] . '" value="' . $t['catid'] . '" >';
                    $html .= '<td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="' . $t['catid'] . '" name="select[]"></td>';
                    $html .= '<td class="htmldir">' . $t['catid'] . '</td>';
                    $html .= '<td class="sort"><input type="text" name="listorder' . $t['catid'] . '" id="listorder' . $t['catid'] . '" value="' . $t['listorder'] . '"  onchange="setchange(\'' . $t['catid'] . '\');" class="form-control "></td>';
                    $indenta = "";
                    for ($i = 0; $i <= $leveldiv; $i++) {
                        if ($i == 0) {
                            continue;
                        } else if ($i == 1) {
                            $indenta = "<span class=\"input-group-addon indent\"></span>";
                        } else {
                            $indenta = "<span class=\"input-group-addon indent\"></span>" . $indenta;
                        }
                    }
                    $html .= '<td class="catname">';
                    $html .= $indenta . '<a onclick="child(this);loadowncategory(' . $t['catid'] . ',this);" title="' . lang_admin('click_to_expand_and_close') . '" class="child">';
                    $html .= ' <i class="glyphicon glyphicon-menu-down"></i>';
                    $html .= ' </a>';
                    $html .= '<a onclick="child(this);loadowncategory(' . $t['catid'] . ',this);" title="' . lang_admin('click_to_expand_and_close') . '" class="child" style="display:none;"><i class="glyphicon glyphicon-menu-up"></i></a>';
                    $html .= '<div class="input-group">';
                    $html .= '<input type="text" name="catname' . $t['catid'] . '" id="catname' . $t['catid'] . '" value="' . $t['catname'] . '"  onchange="setchange(\'' . $t['catid'] . '\');" class="form-control ">';
                    $html .= '</div></td>';
                    $html .= '<td class="htmldir">';
                    $html .= '<span class="hotspot" onmouseover="tooltip.show(\'' . lang_admin('column_file_storage_directory_directory_must_be_in_english_or_pinyin_no_space_in_the_middle') . '\');" onmouseout="tooltip.hide();">' . $t['htmldir'] . '</span>';
                    $html .= '</td>';
                    $html .= '<td class="isnav text-center">';
                    $html .= '<span class="hotspot" onmouseover="tooltip.show(\'' . lang_admin('choose_whether_the_column_is_displayed_in_navigation_only_for_top_level_columns') . '\');" onmouseout="tooltip.hide();">';
                    $html .= '<select id="isnav' . $t['catid'] . '" name="isnav' . $t['catid'] . '"   onchange="setchange(\'' . $t['catid'] . '\');" class="form-control select isnav" >';
                    $html .= '<option value="1" ' . ($t['isnav'] ? 'selected' : '') . '>' . lang_admin('show') . '</option>';
                    $html .= '<option value="0" ' . ($t['isnav'] ? '' : 'selected') . '>' . lang_admin('no_show') . '</option>';
                    $html .= '</select></span></td>';
                    $html .= '<td class="text-center">';
                    $html .= '<span class="' . ($t['isshopping'] ? 'category-list-shopping-icon">' . lang_admin('commodity') : '">' . lang_admin('content')) . '</span> ';
                    $html .= '</td>';
                    $html .= '<td class="manage">';
                    if (chkpower($t['catid'])) {
                        $html .= ' <a  href="#" onclick="gotourl(this)"   data-dataurl="' . ($t['isshopping'] ? url("table/edit/table/category/id/" . $t['catid'] . "/shopping/1") : url("table/edit/table/category/id/" . $t['catid'])) . '"';
                        $html .= ' title="' . lang_admin('edit') . '" class="btn btn-gray" data-dataurlname="' . lang_admin('edit_column') . '">' . lang_admin('edit') . '</a>';
                    }
                    $html .= '<div class="btn-group">';
                    $html .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    $html .= lang_admin('more') . '<span class="caret"></span>';
                    $html .= '</button>';
                    $html .= '<ul class="dropdown-menu">';
                    $html .= ' <li><a href="' . url("archive/list/catid/" . $t['catid'], false) . '" target="_blank" title="' . lang_admin('see') . '">' . lang_admin('see') . '</a></li>';
                    $html .= ' <li><a  href="#" onclick="gotourl(this)"   data-dataurl="' . ($t['isshopping'] ? url("table/copy/table/category/id/" . $t['catid'] . "/shopping/1") : url("table/copy/table/category/id/" . $t['catid'])) . '"';
                    $html .= 'title="' . lang_admin('copy_column') . '" data-dataurlname="' . lang_admin('copy_column') . '">' . lang_admin('copy') . '</a></li>';
                    if ($t['isshopping']) {
                        $html .= '<li><a href="#" onclick="gotourl(this)"   data-dataurl="' . url("table/list/table/archive/catid/" . $t['catid'] . "/shopping/1") . '" title="' . lang_admin('content_management') . '" data-dataurlname="' . lang_admin('content_management') . '">' . lang_admin('administration') . '</a></li>';
                    } else {
                        $html .= '<li><a href="#" onclick="gotourl(this)"   data-dataurl="' . url("table/list/table/archive/catid/" . $t['catid']) . '" title="' . lang_admin('administration') . '">' . lang_admin('administration') . '</a></li>';
                    }
                    $html .= '<li role="separator" class="divider"></li>';
                    $html .= '<li><a onclick="if(confirm(\'' . lang_admin('are_you_sure_you_want_to_delete_it') . '\')){gotourl(this);}" href="#"';
                    $html .= 'data-dataurl="' . url("table/delete/table/category/id/" . $t['catid'] . "/token/" . $token) . '"';
                    $html .= ' title="' . lang_admin('delete') . '">' . lang_admin('delete') . '</a></li>';
                    $html .= '</ul>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '</tr>';
                    // $html .=self::gethtmlcategorydata_new($t['children'],true,$leveldiv+1);
                }
            }
        }
        return $html;
    }
    //栏目最大ID
    public static function maxid_new(){
        $type = self::getInstance();
        $_category=$type->getrow(null,"catid desc ");
        if (is_array($_category))
            return $_category['catid'];

        return 0;
    }

    static function getcategorydata($_catid = 0, &$data = array(), &$level = 0)
    {
        $category = self::getInstance();
        $categorys = $category->son($_catid);
        foreach ($categorys as $catid) {
            $info_ = $category->category[$catid];
            $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
            // $info_['catname'] = $strpre . $info_['catname'] . '<font color="Blue">' . (self::check($catid, 'islast') ? ('(' . countarchiveformcategory($catid) . ')') : '') . '</font>';
            $info_['catname'] = $strpre . $info_['catname'] ;
            $info_['level'] = $level;
            $data[] = $info_;
            if (is_array($category->son($catid))) {
                $level++;
                self::getcategorydata($catid, $data, $level);
                $level--;
            }
        }
        return $data;
    }
    static function getgetcategorydata($_catid = 0, &$data = array(), &$level = 0)
    {
        if(session::get("categorydata_".lang::getisadmin())){
            return session::get("categorydata_".lang::getisadmin());
        }
        $option=self::getcategorydata($_catid,$data,$level);
        session::set("categorydata_".lang::getisadmin(),$option);
        return $option;
    }

    static function getshoppingcategorydata($_catid = 0, &$data = array(), &$level = 0)
    {
        $category = self::getInstance();
        $categorys = $category->shoppingson($_catid);
        foreach ($categorys as $catid) {
            if (!chkpower($catid)) continue;
            $info_ = $category->category[$catid];
            $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
            $info_['catname'] = $strpre . $info_['catname'];
            if(!category::hasson($catid)){
                $info_['catname'].= '<font color="Blue">' . (self::check($catid, 'islast') ? ('(' . countarchiveformcategory($catid) . ')') : '') . '</font>';
            }

            $info_['level'] = $level;
            $data[] = $info_;
            if (is_array($category->son($catid))) {
                $level++;
                self::getshoppingcategorydata($catid, $data, $level);
                $level--;
            }
        }
        return $data;
    }
    static function catshoppingcategorydata($_catid = 0, &$data = array(), &$level = 0)
    {
        if(session::get("catshoppingcategorydata_".lang::getisadmin()) && !front::get("ajax")){
            return session::get("catshoppingcategorydata_".lang::getisadmin());
        }
        $option=self::getshoppingcategorydata($_catid,$data,$level);
        if (!front::get("ajax")) {
            session::set("catshoppingcategorydata_" . lang::getisadmin(), $option);
        }
        return $option;
    }

    static function getconnentcategorydata($_catid = 0, &$data = array(), &$level = 0)
    {
        $category = self::getInstance();
        $categorys = $category->connentson($_catid);
        foreach ($categorys as $catid) {
            if (!chkpower($catid)) continue;
            $info_ = $category->category[$catid];
            $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
            $info_['catname'] = $strpre . $info_['catname'] ;
            if(!category::hasson($catid)){
                $info_['catname'].=  '<font color="Blue">' . (self::check($catid, 'islast') ? ('(' . countarchiveformcategory($catid) . ')') : '') . '</font>';
            }

            $info_['level'] = $level;
            $data[] = $info_;
            if (is_array($category->son($catid))) {
                $level++;
                self::getconnentcategorydata($catid, $data, $level);
                $level--;
            }
        }
        return $data;
    }
    static function catconnentcategorydata($_catid = 0, &$data = array(), &$level = 0)
    {
        if(session::get("catconnentcategorydata_".lang::getisadmin())  && !front::get("ajax")){
            return session::get("catconnentcategorydata_".lang::getisadmin());
        }
        $option=self::getconnentcategorydata($_catid,$data,$level);
        if (!front::get("ajax")) {
            session::set("catconnentcategorydata_" . lang::getisadmin(), $option);
        }
        return $option;
    }


    static function listcategorydata($_catid = 0, &$data = array(), &$level = 0)
    {
        $category = self::getInstance();
        $categorys = $category->son($_catid);
        foreach ($categorys as $catid) {
            $info_ = $category->category[$catid];
            $strpre = $level > 0 ? str_pad('', $level * 12, '&nbsp;') . '└&nbsp;' : '';
            $info_['catname'] = $strpre . $info_['catname'];
            $info_['url'] = category::url($info_['catid']);
            $info_['level'] = $level;
            $info_['parentid'] = $category->getparent($info_['catid']);
            $data[] = $info_;
            if (is_array($category->son($catid))) {
                $level++;
                self::listcategorydata($catid, $data, $level);
                $level--;
            }
        }
        return $data;
    }

    static function check($catid, $tag = 'isnotlast')
    {
        $_category = self::getInstance();
        $category = $_category->category[$catid];
        $category['islast']=isset($category['islast'])?$category['islast']:"";
        if ($tag == 'islast' && !$category['islast']) return false;
        if ($tag == 'isnotlast' && $category['islast']) return false;
        if ($tag == 'tolast') {
            if (isset($_category->category[$catid]['islast']) && $_category->category[$catid]['islast']) return true;
            $sons = $_category->sons($catid);
            foreach ($sons as $tid) {
                if (isset($_category->category[$tid]['islast']) && $_category->category[$tid]['islast']) return true;
            }
            return false;
        }
        return true;
    }

    static function htmlcache($catid)
    {
    }

    static function sitemap($path=null, $filename = null)
    {
        if(!isset($path)){
            $path = ROOT.'/sitemap/';
        }
        $filename = 'index-'.lang::getisadmin().'.html';
        category::listcategorydata(0, $arr, $level);
        front::$view->archive = $arr;
        $html = front::$view->fetch('system/sitemap.html',true);
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        file_put_contents($path.$filename, $html);
    }

    static function listdata($parentid = 0, $limit = 10, $order = 'catid asc', $where = null, $includeson = true)
    {
        $category = new category();
        $where = 'parentid=' . ($parentid ? $parentid : '0') . ($where ? ' and ' . $where : '');
        $categories = $category->getrows($where, $limit, $order);
        foreach ($categories as $order => $category) {
            $categories[$order]['url'] = category::url($category['catid']);
        }
        return $categories;
    }

    static function getcategoryname($catid){
        $category = new category();
        $where = 'catid=' . $catid;
        $categories = $category->getrows($where, 1,  'catid asc','catname');
        return $categories;
    }

    public static function deletesession(){
        if (session::get("option_category_modules_".lang::getisadmin())){
            session::del("option_category_modules_".lang::getisadmin());
        }
        if (session::get("categoryoption_".lang::getisadmin())){
            session::del("categoryoption_".lang::getisadmin());
        }
        if (session::get("categorydata_".lang::getisadmin())){
            session::del("categorydata_".lang::getisadmin());
        }
        if (session::get("optionshopping_".lang::getisadmin())) {
            session::del("optionshopping_" . lang::getisadmin());
        }
        if (session::get("optionconnent_".lang::getisadmin())) {
            session::del("optionconnent_" . lang::getisadmin());
        }
        if (session::get("catshoppingcategorydata_".lang::getisadmin())) {
            session::del("catshoppingcategorydata_" . lang::getisadmin());
        }
        if (session::get("catconnentcategorydata_".lang::getisadmin())) {
            session::del("catconnentcategorydata_" . lang::getisadmin());
        }
        if (session::get("categorydata_new_".lang::getisadmin())) {
            session::del("categorydata_new_" . lang::getisadmin());
        }
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.