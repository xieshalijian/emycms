<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class plugins
{
    static function categoryinfo($id,$titlenum='',$textnum='')
    {
        $cache_id =lang::getistemplate().'/category/'.$id.'/categoryinfo-'.$id.'-'.($titlenum==''?0:$titlenum).'-'.($textnum==''?0:$textnum);
        if (cache::get($cache_id))
           return cache::get($cache_id);
        else {
            if ($id == 0) {
                $category = category::getInstance();
                $categories = $category->son($id);
                $cats = array();
                foreach ($categories as $catid) {
                    if (!$catid['isnav'])continue;
                    $_category = $category->category[$catid];
                    $_category['url'] = category::url($_category['catid'],null,lang::getistemplate());
                    $_category['num'] = category::num($_category['catid']);
                    $cats[] = $_category;
                }
                cache::set($cache_id, $cats);
                return $cats;
            }
            $category = category::getInstance();
            //$category->init();  //category重新加载全部
            $catinfo[] =$category->getrow("catid=".$id);
            $catinfo[0]['url'] = category::url($id,null,lang::getistemplate());
            $catinfo[0]['num'] = category::num($id);

            $catinfo[0]['categorycontenthtml'] = $catinfo[0]['categorycontent'];
            if($titlenum!=''){
                if($titlenum<0){
                    $titlenum=0;
                }
                $catinfo[0]['catname'] = cut(strip_tags( $catinfo[0]['catname']),$titlenum);
            }
            if($textnum!=''){
                if($textnum<0){
                    $textnum=0;
                }
                $catinfo[0]['categorycontent'] = cut(strip_tags( $catinfo[0]['categorycontent']),$textnum);
            }

            cache::set($cache_id, $catinfo);
            return $catinfo;
        }

    }

    static function servicecategoryinfo($id,$titlenum='',$textnum='')
    {
        $cache_id =lang::getistemplate().'/category/'.$id.'/categoryinfo-'.$id.'-'.($titlenum==''?0:$titlenum).'-'.($textnum==''?0:$textnum);
        if (cache::get($cache_id))
           return cache::get($cache_id);
        else {
            if ($id == 0) {
                $category = servicecategory::getInstance();
                $categories = $category->son($id);
                $cats = array();
                foreach ($categories as $catid) {
                    if (!$catid['isnav'])continue;
                    $_category = $category->category[$catid];
                    $_category['url'] = servicecategory::url($_category['catid'],null,lang::getistemplate());
                    $_category['num'] = servicecategory::num($_category['catid']);
                    $cats[] = $_category;
                }
                cache::set($cache_id, $cats);
                return $cats;
            }
            $category = servicecategory::getInstance();
            //$category->init();  //category重新加载全部
            $catinfo[] =$category->getrow("catid=".$id);
            $catinfo[0]['url'] = servicecategory::url($id,null,lang::getistemplate());
            $catinfo[0]['num'] = servicecategory::num($id);


            if($titlenum!=''){
                if($titlenum<0){
                    $titlenum=0;
                }
                $catinfo[0]['catname'] = cut(strip_tags( $catinfo[0]['catname']),$titlenum);
            }
            if($textnum!=''){
                if($textnum<0){
                    $textnum=0;
                }
                $catinfo[0]['categorycontenthtml'] = $catinfo[0]['categorycontent'];
                $catinfo[0]['categorycontent'] = cut(strip_tags($catinfo[0]['categorycontent']),$textnum);
            }
            cache::set($cache_id, $catinfo);
            return $catinfo;
        }

    }

    public static function specialinfo($id, $_spname = '1', $_subtitle = '1', $_spcontent = '1', $_len = 0, $_spimage = 1,$_image=1)
    {
        if(!file_exists(ROOT."/lib/table/special.php")) {
            return array();
        }
        //var_dump($_len);
        $cache_id =lang::getistemplate().'/special/'.$id.'/specialinfo-'.$id.'-'.$_subtitle.'-'.$_spcontent.'-'.$_len.'-'.$_spimage.'-'.$_image;
        if (cache::get($cache_id))
            return cache::get($cache_id);
        else {
            $special = special::getInstance();
            $fields = 'spid,adddate';
            if ($_spname) {
                $fields .= ",title";
            }
            if ($_subtitle) {
                $fields .= ",subtitle";
            }
            if ($_spcontent && $_len != '0') {
                $fields .= ",specialcontent";
            }
            //var_dump($_spcontent);
            if ($_spimage) {
                $fields .= ",banner";
            }
            if ($_image) {
                $fields .= ",image";
            }
            $where = null;
            if ($id) {
                $where = $id;
            }
            $rows = $special->getrows($where, 0, 'listorder=0,listorder asc,spid desc', $fields);
            //var_dump($rows);
            if (is_array($rows) && !empty($rows)) {
                foreach ($rows as $k => $row) {
                    $row['ishtml']=isset($row['ishtml'])?$row['ishtml']:false;
                    $row['url'] = special::url($row['spid'],$row['ishtml']);
                    //var_dump($row);
                    if ($_spcontent && $_len > 0) {
                        //var_dump($row);
                        $row['specialcontent'] = tool::cn_substr(strip_tags($row['specialcontent']), $_len, 'UTF-8', false);
                        //var_dump($row);
                    }
                    $rows[$k] = $row;
                }
            }
             cache::set($cache_id, $rows);
            //$catinfo[0]['url'] = special::url($id,$special->getishtml($id));
            return $rows;
        }

    }

    public static function typeinfo($id, $_tyname = '1', $_subtitle = '1', $_tycontent = '1', $_len = 0, $_tyimage = 1,$_one=false)
    {
        //提取分类
        if(!file_exists(ROOT."/lib/table/type.php")) {
            return array("");
        }

        $cache_id =lang::getistemplate().'/type/'.$id.'/typeinfo-'.$id.'-'.$_subtitle.'-'.$_tycontent.'-'.$_len.'-'.$_tyimage;
        if (cache::get($cache_id))
            return cache::get($cache_id);
        else {
            //var_dump($_len);
            $type = type::getInstance();
            $fields = 'typeid,banner';
            if ($_tyname) {
                $fields .= ",typename";
            }
            if ($_subtitle) {
                $fields .= ",subtitle";
            }
            if ($_tycontent && $_len != '0') {
                $fields .= ",typecontent";
            }
            //var_dump($_typecontent);
            if ($_tyimage) {
                $fields .= ",image";
            }
            $where = null;
            if ($id) {
                $where = $id;
            }
            if ($_one && !$id){
                $where = " 1<>1";
            }
            $rows = $type->getrows($where, 0, 'listorder=0,listorder asc,typeid desc', $fields);
            //var_dump($rows);
            if (is_array($rows) && !empty($rows)) {
                foreach ($rows as $k => $row) {
                    $row['url'] = type::url($row['typeid'],(isset(front::$get['page']) && front::$get['page'] > 1 )? front::$get['page'] : 1, lang::getistemplate());
                    //var_dump($row);
                    if ($_tycontent && $_len > 0) {
                        //var_dump($row);
                        $row['typecontent'] = tool::cn_substr(strip_tags($row['typecontent']), $_len, 'UTF-8', false);
                        //var_dump($row);
                    }
                    //兼容php8 title调用其实是模板错误 我先后台修复
                    $row['title'] = isset($row['title'])?$row['title']:"";
                    $rows[$k] = $row;
                }
            }
            //$catinfo[0]['url'] = type::url($id,$special->getishtml($id));
            cache::set($cache_id, $rows);
            return $rows;
        }
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.

