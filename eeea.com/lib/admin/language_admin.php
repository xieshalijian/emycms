<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class language_admin extends admin {
    function init() {
        $lang=new lang();
        $this->view->form = $lang->get_form();
        $this->view->primary_key ='id';
        $langid=front::get('id');
        if ($langid != '' ){
            $langdata = $lang->getrows('id='.front::get('id'), 1);
            if (is_array($langdata)){
                $this->view->langdata=$langdata[0];
            }
        }

    }
    function list_action(){
        if (!front::get('page'))
            front::$get['page'] = 1;
        $this->_pagesize = '10';   //默认每页10条
        $limit = ((front::get('page') - 1) * $this->_pagesize) . ',' . $this->_pagesize;
        $lang=new lang();
        $where=null;
        if (!config::get("lang_open")) {
            $where=" langurlname='".lang::getisdefault()."'";
        }
        $langdata = $lang->getrows($where, $limit,'id asc ');
        $this->view->data=$langdata;
    }

    function add_action() {
        $lang_choice='system.php';
        if (isset($_GET['lang_choice'])){
            $lang_choice=$_GET['lang_choice'];
        }
        if (front::post('submit')) {
            $langid=front::get('id');
            $lang=new lang();
            $langdata = $lang->getrows('id='.$langid, 1);
            if (is_array($langdata)){
                $langurlname=$langdata[0]['langurlname'];
            }else{
                front::alert(lang_admin('language_pack').lang_admin('nonentity'));
            }
            $path=ROOT.'/lang/'.$langurlname.'/'.$lang_choice;
            $tipspath=ROOT.'/lang/'.$langurlname.'/'.$lang_choice;
            $content=file_get_contents($path);
            $tipscontent=file_get_contents($tipspath);
            $replace="'".front::$post['key']."'=>'".front::$post['val']."',";
            $tipsreplace="'".front::$post['key']."'=>'".front::$post['cnnote']."',";
            $content=str_replace(');',"\n".$replace.');',$content);
            file_put_contents($path,$content);
            $pos=strpos($tipscontent,$tipsreplace);
            if ($langurlname != 'cn'&&$pos === false) {
                $tipscontent=str_replace(');',"\n".$tipsreplace.');',$tipscontent);
                file_put_contents($tipspath,$tipscontent);
            }
            if ($_GET['site'] != 'default') {
                $ftp=new nobftp();
                $ftpconfig=config::get('website');
                $ftp->connect($ftpconfig['ftpip'],$ftpconfig['ftpuser'],$ftpconfig['ftppwd'],$ftpconfig['ftpport']);
                $ftperror=$ftp->returnerror();
                if ($ftperror) {
                    exit($ftperror);
                }
                else {
                    $ftp->nobchdir($ftpconfig['ftppath']);
                    $ftp->nobput($ftpconfig['ftppath'].'/lang/'.$langurlname.'/'.$lang_choice,$path);
                }
            }
            event::log(lang_admin('add_to').lang_admin('language_pack'),lang_admin('success'));
            //
            $shepi='<script type="text/javascript">alert("'.lang_admin('dosomething').lang_admin('complete').'");gotoinurl("'.url('language/edit/id/'.$langdata[0]['id'],true);
            $shepi=$shepi.'&lang_choice='.$lang_choice;
            $shepi=$shepi.'");</script>';
            echo $shepi;
            //exit;
            //front::refresh(url('language/edit',true));
        }
        $this->view->lang_choice=$lang_choice;
    }

    function langedit_action() {
        $langid=front::get('id');
        $lang=new lang();
        if (front::post('submit')) {
            front::remove(ROOT.'/lang/config');
            $update = $lang->rec_update(front::$post, $langid);
            if ($update < 1) {
                front::flash(lang_admin('language_pack').lang_admin('modify').lang_admin('failure'));
            } else {
                //如果选默认其他的则不能为默认
                if(front::$post['isdefault']){
                    front::$post['domain']="";
                    $lang->rec_update(array('isdefault'=>'0'), 'id <> "'.$langid.'"');
                }

                $_path = iconv('utf-8', 'gb2312', ROOT.'/lang/'.$this->view->langdata['langurlname']);//旧文件名
                $__path = iconv('utf-8', 'gb2312', ROOT.'/lang/'.front::post('langurlname'));//新文件名
                if(is_dir($_path)) {//判断有没有旧的目录
                    if (file_exists($__path) == false) {
                        if (rename($_path, $__path))//修改目录
                        {
                            //修改文件名成功   判断配置文件有没有选择  选的话也要改
                            if(config::get('lang_type')==$this->view->langdata['langurlname']){
                                config::modify(array('lang_type' => front::post('langurlname')));
                             }
                            if(config::get('lang_admin_type')==$this->view->langdata['langurlname']){
                                config::modify(array('lang_admin_type' => front::post('langurlname')));
                            }
                        } else {
                            front::flash(lang_admin('language_pack').lang_admin('file_name').lang_admin('modify').lang_admin('failure'));
                        }
                    }
                }
                event::log(lang_admin('modify').lang_admin('language_pack'),lang_admin('success'));
                $shepi='<script type="text/javascript">gotoinurl("'.url('language/list',true);
                $shepi=$shepi.'");</script>';
                echo $shepi;
            }
        }


        $langdata = $lang->getrows('id='.$langid, 1);
        if (!is_array($langdata)){
            front::alert(lang_admin('language_pack').lang_admin('nonentity'));
        }
        $this->view->data=$langdata[0];
    }

     function langadd_action(){
         if (front::post('submit')) {
             front::remove(ROOT.'/lang/config');
             @set_time_limit(0);
             $lang=new lang();
             $insert = $lang->rec_insert(front::$post);
             $_insertid = $lang->insert_id();   //新增语言包ID
             if ($insert < 1) {
                 front::flash(lang_admin('language_pack').lang_admin('add_to').lang_admin('failure'));
             }else{
                 //如果选默认其他的则不能为默认
                 if(front::$post['isdefault']){
                     front::$post['domain']="";
                     $lang->rec_update(array('isdefault'=>'0'), 'id <> "'.$_insertid.'"');
                 }

                 //先创建文件夹
                 $dst=ROOT.'/lang/'.$lang->getlangurlname($_insertid);
                 if (!file_exists($dst)){
                     mkdir ($dst,0777,true);
                     echo lang_admin('create_folder').'bookcover'.lang_admin('success');
                 }

                 //复制内容和栏目
                 if(front::$post['langcopy']!=0){
                    //复制内容和商品
                    /*$archive=new archive();
                    $archivedata = $archive->getrows('langid="'.front::$post['langcopy'].'"', 0,'aid asc ');
                    if (is_array($archivedata)){
                        //去掉id
                        foreach ($archivedata as $key=>$val){
                            unset($archivedata[$key]['aid']);
                            $archivedata[$key]['langid']=$_insertid;
                            $archive->rec_insert($archivedata[$key]);
                        }
                    }*/
                    //复制栏目
                    $this->copycategory(front::$post['langcopy'],$_insertid);
                    //复制语言包文件夹
                     if($lang->getlangurlname(front::$post['langcopy']) != ''){
                         $src=ROOT.'/lang/'.$lang->getlangurlname(front::$post['langcopy']);
                         $dst=ROOT.'/lang/'.$lang->getlangurlname($_insertid);
                         $this->xCopy($src,$dst,1);
                     }
                 }


                     if (front::$post['langcopy']==0){
                         $newlangurlname=$lang->getdefaultlangurl();
                     }else{
                         $newlangurlname=$lang->getlangurlname(front::$post['langcopy']);
                     }
                     //复制配置文件
                     if ($newlangurlname!=""){
                        /* $configsrc=ROOT.'/config/config_'.$newlangurlname.'.php';
                         $configdst=ROOT.'/config/config_'.$lang->getlangurlname($_insertid).'.php';
                         copy($configsrc,$configdst);*/
                         $lang->query("INSERT INTO `cmseasy_config`(`name`, `key`, `type`, `listorder`,`lang`)
                            SELECT `name`, `key`, `type`, `listorder`,'".$lang->getlangurlname($_insertid)."' AS lang FROM  cmseasy_config WHERE lang='".$newlangurlname."' ");
                     }




             }
             event::log(lang_admin('modify').lang_admin('language_pack'),lang_admin('success'));
             $shepi='<script type="text/javascript">gotoinurl("'.url('language/list',true);
             $shepi=$shepi.'");</script>';
             echo $shepi;

         }
     }


    function setlangopen_action(){
        if (front::get('langopen')!=""){
             config::modify(array("lang_open"=>front::get('langopen')));
            if (!front::get('langopen')){
                $defaultname=lang::getisdefault();
                session::set('lang_getisadmin', $defaultname);
                session::set('lang_getistemplate', $defaultname);
                session::set('nolong_templatelang',$defaultname);
                session::set('nolong_adminlang',$defaultname);

                lang::setisadmin($defaultname);
                lang::settistemplate($defaultname);
                //清空缓存
                front::remove(ROOT.'/cache/data');
                front::remove(ROOT.'/cache/template');
                front::remove(ROOT.'/cache/downloads');
                user::deletesession();
                category::deletesession();
                type::deletesession();
                special::deletesession();
            }
        }
        front::refresh(url('index/index',true));

    }
     //复制语言包
     function xCopy($source, $destination, $child = 1){
        //用法：
        // xCopy("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录
        // xCopy("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录
        //参数说明：
        // $source:源目录名
        // $destination:目的目录名
        // $child:复制时，是不是包含的子目录

        if(!is_dir($source)){
            echo("Error:the $source is not a direction!");
            return 0;
        }

        if(!is_dir($destination)){
            mkdir($destination,0777);
        }

        $handle=dir($source);
        while($entry=$handle->read()) {
            if(($entry!=".")&&($entry!="..")){
                if(is_dir($source."/".$entry)){
                    if($child)
                        xCopy($source."/".$entry,$destination."/".$entry,$child);
                }
                else{
                    copy($source."/".$entry,$destination."/".$entry);
                }
            }
        }
        //return 1;
    }

     //复制顶级栏目
    function copycategory($oldlangid,$newlangid){
        $category=new  category();
        $categorydata=$category->getrows('parentid="0" and langid="'.$oldlangid.'"', 0,'catid asc ');
        if (is_array($categorydata)){
            foreach ($categorydata as $key=>$val){
                $old_categoryinsertid=$val['catid'];
                unset($val['catid']);
                $val['langid']=$newlangid;
                $val['catname']=str_replace("'", "\'", $val['catname']);
                $val['subtitle']=str_replace("'", "\'", $val['subtitle']);
                $val['categorycontent']=str_replace("'", "\'", $val['categorycontent']);
                $val['htmldir'] = $val['htmldir'] . '-' . $this->random_user();
                $category->rec_insert($val);
                $_categoryinsertid = $category->insert_id();   //新增栏目的id
                //复制内容
                $this->copycategoryarchive($_categoryinsertid, $old_categoryinsertid, $newlangid);
                //新增下面的子栏目
                $this->copycategoryson($_categoryinsertid,$old_categoryinsertid,$newlangid);
            }

        }
    }


    //随机生成
    function random_user($len = 6)
    {
        $user = '';
        $lchar = 0;
        $char = 0;
        for($i = 0; $i < $len; $i++)
        {
            while($char == $lchar)
            {
                $char = rand(48, 109);
                if($char > 57) $char += 7;
                if($char > 90) $char += 6;
            }
            $user .= chr($char);
            $lchar = $char;
        }
        return $user;
    }

    //复制栏目下所有商品
    function copycategoryarchive($new_categoryinsertid,$old_categoryinsertid,$newlangid){
        $archivearray=archive::getInstance()->getrows(array("catid"=>$old_categoryinsertid),0);
        if (is_array($archivearray))
            foreach ($archivearray as $archkey=>$archval) {
                unset($archval['aid']);
                //新增
                $archval['langid'] = $newlangid;
                $archval['content']= iconv("GBK","utf-8",str_replace("'", "\'", $archval['content']));
                $archval['introduce']=str_replace("'", "\'", $archval['introduce']);
                $archval['title']=str_replace("'", "\'", $archval['title']);
                $archval['subtitle']=str_replace("'", "\'", $archval['subtitle']);
                $archval['catid'] = $new_categoryinsertid;
                archive::getInstance()->rec_insert($archval);
            }
    }

    //复制子栏目
    function copycategoryson($new_categoryinsertid,$old_categoryinsertid,$newlangid){
        $category=new  category();
        $where='parentid="'.$old_categoryinsertid.'" and langid="'.front::$post['langcopy'].'"';
        $categorydata=$category->getrows($where, 0,'catid asc ');
        if (is_array($categorydata)){
            foreach ($categorydata as $key=>$val){
                $old_son_categoryinsertid=$val['catid'];
                unset($val['catid']);
                $val['langid']=$newlangid;
                $val['parentid']=$new_categoryinsertid;
                $val['catname']=str_replace("'", "\'", $val['catname']);
                $val['subtitle']=str_replace("'", "\'", $val['subtitle']);
                $val['categorycontent']=str_replace("'", "\'", $val['categorycontent']);
                $val['htmldir'] = $val['htmldir'] . '-' . $this->random_user();
                $category->rec_insert($val);
                $new_son_categoryinsertid = $category->insert_id();   //新增栏目的id
                //是否复制内容
                $this->copycategoryarchive($new_son_categoryinsertid, $old_son_categoryinsertid, $newlangid);
                //判断子集栏目还有子集栏目的话 则增加
                if(count($category->getrows('parentid="'.$old_categoryinsertid.'" and langid="'.front::$post['langcopy'].'"', 0,'catid asc '))>0){
                    $this->copycategoryson($new_son_categoryinsertid,$old_son_categoryinsertid,$newlangid);
                }
            }
        }
    }

    function edit_action() {
        $lang_choice='system.php';
        if (isset($_GET['lang_choice'])){
            $lang_choice=$_GET['lang_choice'];
        }
        $langid=front::get('id');
        $lang=new lang();
        $langdata = $lang->getrows('id='.$langid, 1);
        if (is_array($langdata)){
            $langurlname=$langdata[0]['langurlname'];
        }else{
            front::alert(lang_admin('language_pack').lang_admin('nonentity'));
        }
        $path=ROOT.'/lang/'.$langurlname.'/'.$lang_choice;
        $tipspath=ROOT.'/lang/'.$langurlname.'/'.$lang_choice;
        if (front::post('submit')) {
            $content=file_get_contents($path);
            $to_delete_items=front::$post['to_delete_items'];
            unset(front::$post['to_delete_items']);
            foreach (front::$post as $key=>$val) {
                preg_match_all("/'".$key."'=>'(.*?)',/",$content,$out);
                if (is_array($to_delete_items) && in_array($key,$to_delete_items))
                    $content=str_replace($out[0][0],'',$content);
                else
                    $content=str_replace($out[1][0],$val,$content);
            }
            file_put_contents($path,$content);
            if ($_GET['site'] != 'default') {
                $ftp=new nobftp();
                $ftpconfig=config::get('website');
                $ftp->connect($ftpconfig['ftpip'],$ftpconfig['ftpuser'],$ftpconfig['ftppwd'],$ftpconfig['ftpport']);
                $ftperror=$ftp->returnerror();
                if ($ftperror) {
                    exit($ftperror);
                }
                else {
                    $ftp->nobchdir($ftpconfig['ftppath']);
                    $ftp->nobput($ftpconfig['ftppath'].'/lang/'.$langurlname.'/'.$lang_choice,$path);
                }
            }
            unset($content);
            event::log(lang_admin('modify').lang_admin('language_pack'),lang_admin('success'));
            $shepi='<script type="text/javascript">alert("'.lang_admin('dosomething').lang_admin('complete').'");gotoinurl("'.url('language/edit/id/'.$langdata[0]['id'],true);
            $shepi=$shepi.'&lang_choice='.$lang_choice;
            $shepi=$shepi.'");</script>';
            echo $shepi;
        }

        $content=include($path);

        //搜索过滤
        if (front::post('search_submit')) {
            $search_title=front::post('search_title');
            $this->view->search_title=$search_title;
        }
        else{
            $search_title='';
        }
        foreach($content as $k => $v){
                //增加搜索条件
                if ($search_title == '') {
                    $content[$k] = $v;
                }else if (strpos($v,$search_title) === false) {
                   unset($content[$k]);
                }else{
                    $content[$k] = $v;
                }
        }

        $tips=include($tipspath);
        $this->view->tips=$tips;
        //分页
        $limit = 30;
        if(!front::get('page'))
            $page = 1;
        else
            $page = front::get('page');
        $total = ceil(count($content)/$limit);
        if($page < 1) $page = 1;
        if($page > $total) $page = $total;
        $start = ($page-1) * $limit;
        $end = $start+$limit-1;
        $tmp = range($start,$end);
        $i = 0;
        $list_content_arr = array();
        foreach($content as $k => $v){
            if(in_array($i++,$tmp)){
                //增加搜索条件
                $list_content_arr[$k] = $v;
            }
        }

        $this->view->sys_lang=$list_content_arr;
        $this->view->link_str = listPage($total,$limit,$page);
        $this->view->lang_choice=$lang_choice;

    }

    function delete_action() {
        $lang=new lang();
        if ( front::post('select')) {
            foreach (front::post('select') as $id) {
                $langdata = $lang->getrows('id="'.$id.'"', 1);
                if($langdata[0]['isdefault']==0){
                    $langurlname=$langdata[0]['langurlname'];
                    $delete = $lang->rec_delete($id);
                    if ($delete) {
                        //删除文件夹
                        if (isset($langurlname) && front::get("meanwhile")){
                            $dir=ROOT.'/lang/'.$langurlname;
                            front::remove($dir);
                            event::log(lang_admin('delete').lang_admin('language_pack'),lang_admin('success'));
                        }
                        //修改用户语言  改为默认语言
                        $default=lang::getdefaultlangurl();
                        user::getInstance()->rec_update(array("templatelang"=>$default),"templatelang='".$langurlname."'");
                        user::getInstance()->rec_update(array("adminlang"=>$default),"adminlang='".$langurlname."'");

                        //清空缓存
                        session::set('lang_getistemplate','');
                        session::set('lang_getisadmin', '');
                        //删除缓存
                        unlink(ROOT."/lang/config/lang_all.php");
                        unlink(ROOT."/lang/config/lang_admin.php");
                        //删除数据
                        archive::getInstance()->rec_delete('langid="'.$id.'"');
                        category::getInstance()->rec_delete('langid="'.$id.'"');
                        //删除配置文件
                        //unlink(ROOT."/config/config_'.$langurlname.'.php");
                        myconfig::getInstance()->rec_delete("lang='".$langurlname."'");
                    }
                }
            }
        }else{
            $langdata = $lang->getrows('id='.front::get('id'), 1);
            $langurlname=$langdata[0]['langurlname'];
            $delete = $lang->rec_delete(front::get('id'));
            if ($delete) {
                //删除文件夹
                if (isset($langurlname)){
                    $dir=ROOT.'/lang/'.$langurlname;
                    front::remove($dir);
                    event::log(lang_admin('delete').lang_admin('language_pack'),lang_admin('success'));
                    front::refresh(url('language/list',true));
                }
                //删除数据
                archive::getInstance()->rec_delete('langid="'.front::get('id').'"');
                category::getInstance()->rec_delete('langid="'.front::get('id').'"');
                //删除配置文件
                //unlink(ROOT."/config/config_'.$langurlname.'.php");
                myconfig::getInstance()->rec_delete("lang='".$langurlname."'");
            }
        }
        front::redirect(url('language/list',true));

    }

    function setLanguage_action(){
        if (isset($_GET['langValue'])) {
            config::modify(array('lang_choice' =>  $_GET['langValue']));
         }
    }

    function end() {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
