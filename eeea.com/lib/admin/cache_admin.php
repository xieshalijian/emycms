<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

class cache_admin extends admin
{

    public $archive;
    protected $_langadmin;
    protected $_langtemplate;
    protected   $_make_show_head=true;

    function init()
    {
        header('Cache-control: private, must-revalidate');
        front::$admin = false;
        front::$isadmin = false;
        front::$html = true;
        //先记录当前语言包
        $this->_langtemplate=lang::getistemplate();
        $this->_langadmin=lang::getisadmin();
    }

    //首页生成
    function make_index_action()
    {
        if (front::get("config_cache")){
            front::$post['submit']=1;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_make_index"))
        {
            echo  str_pad(lang_admin("beigin_cache_not_refresh").'<br/>',1024*128);
            echo str_pad('<style>*{line-height:180%;color:#fff;}</style>',1024*128);
            $servip = gethostbyname($_SERVER['SERVER_NAME']);
            if ($servip == front::ip() && front::get('ishtml') == 1) {

            } else {
                chkpw('cache_index');
            }

            cache_make::get_make_index($this->_langtemplate,$this->_langadmin,true);

            session::set("cahe_make_index","");   //清空
            echo str_pad(lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
            exit;
        }
        else if ($submit){
            session::set("cahe_make_index",'1');
            front::$get['config_cache']=0;
            front::redirect(modify("act/make_index",true));
        }
    }

    //删除专题生成的静态页面
    static function delete_make_special_action(){
        $where = ' langid = "' . lang::getlangid(lang::getisadmin()) . '"';
        $specials = special::getInstance()->getrows($where);
        if (is_array($specials) && !empty($specials)) {
            foreach ($specials as $v) {
                $j = 0;
                $archive_num = archive::getInstance()->rec_count('spid=' . $v['spid'] . ' and checked=1 and `state`=1');
                $pagesize = config::get('list_pagesize');
                if (!$archive_num) $archive_num = 1;
                $cpage = ceil($archive_num / $pagesize);

                for ($i = 1; $i <= $cpage; $i++) {
                        $path = special::url($v['spid'],$v['ishtml'],$i,$v['htmldir']);
                    if (!preg_match('/\.[a-zA-Z]+$/', $path))
                        $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                    $path = rtrim($path, '/');
                    $path = rtrim($path, '\\');

                    if (config::get('base_url') == '/') {
                        $path = ROOT . substr($path, 1);
                    } else {
                        $path = ROOT . str_replace(config::get('base_url'), '', $path);
                    }
                    $path = str_replace('//', '/', $path);
                    if(file_exists($path)){
                        unlink($path);
                        //echo  $path."删除成功！<br/>";
                    }
                     $j++;
                }
                if ($j > 0) {
                    $path = dirname($path) . '/index.html';         //目录下index
                    if(file_exists($path)){
                        unlink($path);
                       // echo  $path."删除成功！<br/>";
                    }
                }
            }
        }
       // exit;
    }

    //专题生成
    function make_special_action()
    {
        chkpw('cache_special');
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("config_cache")){
            front::$post['submit']=1;
            front::$post['specialid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_make_special")) {
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  str_pad(lang_admin("beigin_cache_not_refresh").'<br/>',1024*128); //开始生成
            echo  str_pad('<style>*{line-height:180%;color:#fff;}</style>',1024*128);
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();
            templatetag::$adminsetting=array();

            /*if (config::getadmin('list_special_php')==2) {

            }*/
            $post = session::get("cahe_make_special");
            $speciaid = intval($post['specialid']);

            cache_make::get_make_special($speciaid,true);

            session::set("cahe_make_special", "");   //清空
            echo  str_pad(lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
           exit;
        }
        else if($submit){
            front::$get['config_cache']=0;
            session::set("cahe_make_special",front::$post);
            front::redirect(modify("act/make_special",true));
        }
    }

    //地区生成
    function make_area_action()
    {
        chkpw('cache_area');
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);

        if (!front::post('submit'))
            return;
        if (!config::get('area_html')) {
            front::flash(lang_admin('none_of_the_generated_HTML'));
            return;
        }
        $archive_all = new archive();

        if (front::post('province_id')) {
            $where = 'checked=1 and `state`=1';
            $where .= ' and province_id=' . front::post('province_id');
            $archive_num = $archive_all->rec_count($where);
            $pagesize = config::get('list_pagesize');
            $cpage = ceil($archive_num / $pagesize);
            $j = 0;
            for ($i = 1; $i <= $cpage; $i++) {
                $path = 'area/province/' . intval(front::post('province_id')) . '-list-' . $i . '.html';
                tool::mkdir(dirname($path));
                $data = file_get_contents(config::get('site_url') . 'index.php?case=area&act=list&province_id=' . intval(front::post('province_id')) . '&city_id=' . intval(front::post('city_id')) . '&section_id=' . intval(front::post('section_id')) . '&page=' . $i);
                if (file_put_contents($path, $data)) {
                    $j++;
                }
            }
            if ($j > 0) {
                front::flash(lang_admin('generate_html') . " <b>$j</b> " . lang_admin('npage') . "！");
            } else {
                front::flash(lang_admin('none_of_the_generated_HTML'));
            }
        }
        if (front::post('city_id')) {
            $where = 'checked=1 and `state`=1';
            $where .= ' and city_id=' . front::post('city_id');
            $archive_num = $archive_all->rec_count($where);
            $pagesize = config::get('list_pagesize');
            $cpage = ceil($archive_num / $pagesize);
            $j = 0;
            for ($i = 1; $i <= $cpage; $i++) {
                $path = 'area/city/' . intval(front::post('city_id')) . '-list-' . $i . '.html';
                tool::mkdir(dirname($path));
                $data = file_get_contents(config::get('site_url') . 'index.php?case=area&act=list&province_id=' . intval(front::post('province_id')) . '&city_id=' . intval(front::post('city_id')) . '&section_id=' . intval(front::post('section_id')) . '&page=' . $i);
                if (file_put_contents($path, $data)) {
                    $j++;
                }
            }
            if ($j > 0) {
                front::flash(lang_admin('generate_html') . " <b>$j</b> " . lang_admin('npage') . "！");
            } else {
                front::flash(lang_admin('none_of_the_generated_HTML'));
            }
        }
        if (front::post('section_id')) {
            $where = 'checked=1 and `state`=1';
            $where .= ' and section_id=' . front::post('section_id');
            $archive_num = $archive_all->rec_count($where);
            $pagesize = config::get('list_pagesize');
            $cpage = ceil($archive_num / $pagesize);
            $j = 0;
            for ($i = 1; $i <= $cpage; $i++) {
                $path = 'area/section/' . intval(front::post('section_id')) . '-list-' . $i . '.html';
                tool::mkdir(dirname($path));
                $data = file_get_contents(config::get('site_url') . 'index.php?case=area&act=list&province_id=' . intval(front::post('province_id')) . '&city_id=' . intval(front::post('city_id')) . '&section_id=' . intval(front::post('section_id')) . '&page=' . $i);
                if (file_put_contents($path, $data)) {
                    $j++;
                }
            }
            if ($j > 0) {
                front::flash(lang_admin('generate_html') . " <b>$j</b> " . lang_admin('npage') . "！");
            } else {
                front::flash(lang_admin('none_of_the_generated_HTML'));
            }
        }
    }

    //删除Tag生成的静态页面
    static function delete_make_tag_action(){
        $tags = tag::getInstance()->getrows("", 0);
        $tags = array_to_hashmap($tags, 'tagid', 'tagname');
        foreach ($tags as $k => $v) {
            $tagid = $k;
            $arctag = new arctag();
            $archive_num = $arctag->rec_count('tagid=' . $tagid);
            $pagesize = config::get('list_pagesize');
            $cpage = ceil($archive_num / $pagesize);
            for ($i = 1; $i <= $cpage; $i++) {
                $path = tag::url($v, $i);
                if (!preg_match('/\.[a-zA-Z]+$/', $path))
                    $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                $path = rtrim($path, '/');
                $path = rtrim($path, '\\');
                if (config::get('base_url') == '/') {
                    $path = ROOT .'/'. substr($path, 1);
                } else {
                    $path = ROOT.'/' . str_replace(config::get('base_url'), '', $path);
                }
                $path = str_replace('//', '/', $path);
                if(file_exists($path)){
                    unlink($path);
                    //echo  $path."删除成功！<br/>";
                }
            }
        }
        //exit;
    }

    //Tag生成
    function make_tag_action()
    {
        chkpw('cache_tag');
        header('Cache-control: private, must-revalidate');
        set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("config_cache")){
            front::$post['submit']=1;
            front::$post['tag']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_make_tag")) {
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  str_pad(lang_admin("beigin_cache_not_refresh"),1024*128).'<br/>'; //开始生成
            echo  str_pad('<style>*{line-height:180%;color:#fff;}</style>',1024*128);
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();
            templatetag::$adminsetting=array();

            $post = session::get("cahe_make_tag");
            if (!front::$get['tag']) {
                front::$get['tag'] = $post['tag'];
            }
            if (!front::$get['submit']) {
                front::$get['submit'] = $post['submit'];
            }

            cache_make::get_make_tag(front::$get['tag'],true);

            session::set("cahe_make_tag", "");   //清空
             echo str_pad(lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
            exit;
        }
        else if($submit){
            front::$get['config_cache']=0;
            session::set("cahe_make_tag",front::$post);
            front::redirect(modify("act/make_tag",true));
        }
        $tags = tag::getInstance()->getrows("", 0);
        $this->view->hottags = array_to_hashmap($tags, 'tagid', 'tagname');

    }

    //删除分类生成的静态页面
    static function delete_make_type_action(){
        $where = 'langid = "' . lang::getlangid(lang::getisadmin()) . '"';
        $arrtype = type::getInstance()->getrows($where, 0);
        if (is_array($arrtype) && !empty($arrtype)) {
            foreach ($arrtype as $v) {
                $path = type::url($v['typeid'], (isset(front::$get['page']) && front::$get['page']) > 1 ? front::$get['page'] : 1, lang::getisadmin(), false);
                $path = type::url_rule($path);
                if(file_exists($path)){
                    unlink($path);
                     //echo  $path."删除成功！<br/>";
                }
                $indexpath = dirname($path) . '/index.html';
                if ($indexpath != ROOT . '/index.html') {
                    if(file_exists($indexpath)){
                        unlink($indexpath);
                       //  echo  $indexpath."删除成功！<br/>";
                    }
                };
            }
        }
    }

    //分类生成
    function make_type_action()
    {
        chkpw('cache_type');
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("config_cache")){
            front::$post['submit']=1;
            front::$post['typeid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_make_type")) {
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  str_pad(lang_admin("beigin_cache_not_refresh").'<br/>',1024*128); //开始生成
            echo  str_pad('<style>*{line-height:180%;color:#fff;}</style>',1024*128);
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();
            templatetag::$adminsetting=array();

            if (config::getadmin('list_type_php')==2) {
                //最后恢复前台语言包
                lang::settistemplate($this->_langtemplate);
                lang::setisadmin($this->_langadmin);
                session::set("cahe_make_type","");   //清空
                echo  str_pad(lang_admin('none_of_the_generated_HTML').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
                exit;
            }
            $post = session::get("cahe_make_type");

            cache_make::get_make_type($post['typeid'],true);

            session::set("cahe_make_type","");   //清空
             echo  str_pad(lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
            exit;
        }
        else if($submit){
            front::$get['config_cache']=0;
            session::set("cahe_make_type",front::$post);
            front::redirect(modify("act/make_type",true));
        }
    }

    //删除栏目生成的静态页面
    static function delete_make_list_action(){
        $category = category::getInstance();
        $category->init();  //重新初始化一下
        $categories = $category->langsons(0);
        $categories[] = 0;
        foreach ($categories as $catid) {
            $path = category::url($catid, (isset(front::$get['page']) && front::$get['page'] > 1) ? front::$get['page'] : 1,
                lang::getisadmin(),false);
            $path = category::url_rule($path);

            if(file_exists($path)){
                unlink($path);
               // echo  $path."删除成功！<br/>";
            }
            $indexpath = dirname($path) . '/index.html';
            if ($indexpath != ROOT . '/index.html') {
                if(file_exists($indexpath)){
                    unlink($indexpath);
                }
            }
        }
    }

    //栏目列表生成
    function make_list_action()
    {
        $servip = gethostbyname($_SERVER['SERVER_NAME']);
        if ($servip != front::ip() && front::get('ishtml') == 1) {
            chkpw('cache_category');
        }
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("config_cache")){
            front::$post['submit']=1;
            front::$post['catid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');

        if(front::get("getshowstatic") && session::get("cahe_make_list")) {
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo   str_pad(lang_admin("beigin_cache_not_refresh").'<br/>',1024*128); //开始生成
            echo   str_pad('<style>*{line-height:180%;color:#fff;}</style>',1024*128);
            $post = session::get("cahe_make_list");

            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();
            templatetag::$adminsetting=array();

            //修复一下生成bug
            //config::set('lang_type', lang::getisadmin());
            /* config::modify(array('lang_admin_type' =>'cn'));*/
            //echo '<script>alert("'.lang::getisadmin().'");</script>';
            //循环生成  多个语言包版本的前台
            /* $langdata=getlang_admin();
             $oldadminlang=lang::getisadmin();
             if (count($langdata)>0){
              foreach ($langdata as $langkey=>$langval){
                 config::modify(array('lang_admin_type' => $langval['langurlname']));*/
            //生成栏目页面
            cache_make::get_make_list($post['catid'],true);

            session::set("cahe_make_list","");   //清空
             echo str_pad(lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
            exit;
        }
        else if($submit){
            front::$get['config_cache']=0;
            session::set("cahe_make_list",front::$post);
            front::redirect(modify("act/make_list",true));
        }

    }

    function make_sitemap_action()
    {
        chkpw('cache_google');
    }

    function make_sitemap_baidu_action()
    {
        chkpw('cache_baidu');
    }

    function make_sitemap_google_action()
    {
        chkpw('cache_google');
    }

    function make_sitemap_map_action()
    {
        chkpw('cache_sitemap_map');
    }

    //删除内容生成的静态页面
    static function delete_make_show_action(){
        $catid=0;
        $category = category::getInstance(); //实例化栏目类
        $categories = $category->sons($catid);
        $categories[] = $catid;
        $categories = implode(',', $categories);
        $where = "catid in(" . $categories . ') and checked=1 AND (ishtml IS NULL OR ishtml!=2)'. ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
        $archives = archive::getInstance()->getrows($where, 0, 'aid asc '); //取到要生成的所有文章
        foreach ($archives as $arc) {
            if ($arc['linkto']) { //如果有跳转连接则跳过生成
                continue;
            }

            $contents = preg_split('%<hr/>%', $arc['content']);
            if (!empty($contents)) {
                $pages = count($contents);
                front::$record_count = $pages * config::get('list_pagesize');
                $pages = count($contents);
            }
            else {
                $pages = 1;
            }
            for ($c = 1; $c <= $pages; $c++) {
                front::$get['page'] = $c;
                $path = ROOT . archive::url($arc, front::$get['page'] > 1 ? front::$get['page'] : null, true, lang::getisadmin());
                if (!preg_match('/\.[a-zA-Z]+$/', $path))
                    $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                $path = rtrim($path, '/');
                $path = rtrim($path, '\\');
                $path = str_replace('//', '/', $path);
                //echo  $path.'删除成功！<br/>';
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
       // exit;
        //返回到首页
       /* front::redirect(url('index/index'));*/
    }
    //内容页生成
    function make_show_action()
    {
        if($this->_make_show_head){
            header('Cache-control: private, must-revalidate');
        }

        chkpw('cache_content');
        if (front::get("config_cache")){
            front::$post['submit']=1;
            front::$post['catid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
         if(front::get("getshowstatic") && session::get("cahe_make_show"))
        {
            ignore_user_abort();
            @set_time_limit(0);
            //php 设置memory_limit
            ini_set("memory_limit","256M");
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo str_pad( lang_admin("beigin_cache_not_refresh").'<br/>',1024*128);


            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();
            templatetag::$adminsetting=array();

           //time::start();
            $post = session::get("cahe_make_show") + front::$get;
            echo  str_pad('<script type="text/javascript">setInterval(function(){window.scrollTo(0,document.body.scrollHeight);},300);</script>',1024*128);;
            echo  str_pad('<style>*{line-height:180%;color:#fff;}</style>',1024*128);;
            unset($post['submit']);
           /* $c_url = preg_replace('#&make_page=(\d+)#', '', $_SERVER['QUERY_STRING']);
            $c_url = preg_replace('#&aid_start=(\d+)#', '', $c_url);
            $c_url = preg_replace('#&aid_end=(\d+)#', '', $c_url);
            $c_url = preg_replace('#&catid=(\d+)#', '', $c_url);
            $c_url = preg_replace('#&submit=(\d+)#', '', $c_url);
            $c_url = 'index.php?' . $c_url;
            $c_url .= '&submit=1';*/

            $category = category::getInstance(); //实例化栏目类

            if ($post['aid_start']) {
                $aid_start = $post['aid_start'];
                $aid_end = $post['aid_end'];
                $where = "aid>=$aid_start and aid<=$aid_end AND checked=1 AND (ishtml IS NULL OR ishtml!=2) ". ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
                //$c_url .= '&aid_start=' . $aid_start . '&aid_end=' . $aid_end;
            }
            elseif (isset($post['catid'])) {
                $catid = $post['catid'];
                $categories = $category->sons($catid);
                $categories[] = $catid;
                $categories = implode(',', $categories);
                $where = "catid in(" . $categories . ') and checked=1 AND (ishtml IS NULL OR ishtml!=2)'. ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
                //$c_url .= '&catid=' . $catid;
            } else
                return;
            $case = 'archive';
            $act = 'show';
            $_GET = array('case' => $case, 'act' => $act);
            //$front = new front();
            front::$admin = false;
            front::$isadmin = false;
            front::$html = true;
            front::$rewrite = false;
            $case = $case . '_act';
            $case = new $case();
            $case->init();
            $method = $act . '_action';
            //$time_start = time::getTime();

            $archive = new archive(); //实例化文章类

             //启用分组生成
            $make_page = $post['make_page'] == '' ? 1 : $post['make_page'];
            $archive->getrows($where);
            $archive_num = $archive->record_count;
            $group_count = 50;
            $make_page_num = ceil($archive_num / $group_count);
            $totalpage = (($make_page - 1) * $group_count) . ',' . $group_count;
            //$c_url .= '&make_page=' . ($make_page + 1);
            $post["make_page"]=($make_page + 1);
            session::set("cahe_make_show",$post);   //修改

            //取到要生成的所有文章
            $archives = $archive->getrows($where, $totalpage, '1');
            $cpage = 0;
            //关键字连接
            $linkword = new linkword();
            $linkwords = $linkword->getrows(null, 1000, 'linkorder desc');
            //循环所有文章
            foreach ($archives as $arc) {
                if (!category::getarcishtml($arc))  //如果文章设置不生成则跳过
                    continue;
                if ($arc['linkto']) { //如果有跳转连接则跳过生成
                    continue;
                }


                $case->view->archive = $arc;
                front::$get['aid'] = $case->view->aid = $case->view->archive['aid'];
                $case->view->catid = $case->view->archive['catid'];

                $case->view->topid = category::gettopparent($case->view->catid);
                $case->view->parentid = $category->getparent($case->view->catid);


                $template = $case->view->archive['template'];

                $content = $case->view->archive['content'];

                $case->view->categories = category::getpositionlink2($case->view->catid);

                //关键字连接
                foreach ($linkwords as $linkword) {
                    if (trim($linkword['linkurl']) && !preg_match('%^http://$%', trim($linkword['linkurl']))) {
                        $linkword['linktimes'] = (int)$linkword['linktimes'];
                        $link = "<a href='$linkword[linkurl]' target='_blank'>$linkword[linkword]</a>";
                    } else {
                        $link = "<a href='" . url('archive/search/keyword/' . urlencode($linkword['linkword'])) . "' target='_blank'>$linkword[linkword]</a>";
                    }
                    if (isset($link)) {
                        $content = preg_replace("%(?!\"]*>)$linkword[linkword](?!\s*\")%i", "\\1$link\\2", $content, $linkword['linktimes']);
                    }
                    unset($link);
                }

                //相关文章
                $case->view->likenews = $case->getLike($case->view->archive['tag'], $case->view->archive['keyword']);

                //内容分页
                //$contents = preg_split('%<div style="page-break-after(.*?)</div>%si', $content);
                $contents = preg_split('%<hr/>%', $content);
                if (!empty($contents)) {
                    $case->view->pages = count($contents);
                    front::$record_count = $case->view->pages * config::get('list_pagesize');
                    $case->view->pages = count($contents);
                }
                else {
                    $case->view->pages = 1;
                }

                //标签连接
                $taghtml = '';
                $tag_table = new tag();
                foreach ($tag_table->urls($case->view->archive['tag']) as $tag => $url) {
                    $taghtml .= "<a href='$url' target='_blank'>$tag</a>&nbsp;&nbsp;";
                }
                $case->view->archive['tag'] = $taghtml;

                //专题连接
                $case->view->archive['special'] = null;
                if ($case->view->archive['spid']) {
                    $spurl = special::url($case->view->archive['spid'], special::getishtml($case->view->archive['spid']));
                    $sptitle = special::gettitle($case->view->archive['spid']);
                    $case->view->archive['special'] = "<a href='$spurl' target='_blank'>$sptitle</a>&nbsp;&nbsp;";
                }

                //分类连接
                $case->view->archive['type'] = null;
                if ($case->view->archive['typeid']) {
                    $typeurl = type::url($case->view->archive['typeid'], 1);
                    $typetitle = type::name($case->view->archive['typeid']);
                    $case->view->archive['type'] = "<a href='$typeurl' target='_blank'>$typetitle</a>&nbsp;&nbsp;";
                }

                //地区连接
                //$case->view->archive['area'] = null;
                //$case->view->archive['area'] = area::getpositonhtml($case->view->archive['province_id'], $case->view->archive['city_id'], $case->view->archive['section_id']);

                //$arc = $case->view->archive;
                for ($c = 1; $c <= $case->view->pages; $c++) {
                    front::$get['page'] = $c;
                    $case->view->page = $c;
                    //静态生成  判断动态的php缓存是否存在  存在的话  直接使用动态的php文件
                    $cache_path =archive::url($case->view->archive, front::$get['page'] > 1 ? front::$get['page'] : null, lang::getisadmin(), false);
                    $cache_path = archive::url_rule($cache_path);
                    $cache_path=str_replace('.html','.php',$cache_path);
                    if (file_exists($cache_path)) {
                        $content=$case->view->_eval($cache_path,true);
                        $path = archive::url($case->view->archive, front::$get['page'] > 1 ? front::$get['page'] : null, lang::getisadmin(), true);
                        $path = archive::url_rule($path);
                        file_put_contents($path, $content);
                        echo  str_pad(str_ireplace(ROOT.'/','',$path)."<br/>",1024*128);
                    }
                    else {
                        if (!empty($contents)) {
                            $content = $contents[$c - 1];
                        }
                        $case->view->archive['content'] = $content;

                        $catid = $case->view->catid;
                        if (!$case->view->archive['showform']) {
                            $this->getshowform($catid);
                        } else if ($case->view->archive['showform'] && $case->view->archive['showform'] == '1') {
                            $this->showform = 1;
                        } else {
                            $this->showform = $case->view->archive['showform'];
                        }
                        if (preg_match('/^my_/is', $this->showform)) {
                            $case->view->archive['showform'] = $this->showform;
                            $o_table = new defind($this->showform);
                            front::$get['form'] = $this->showform;
                            $this->view->primary_key = $o_table->primary_key;
                            $field = $o_table->getFields();
                            $fieldlimit = $o_table->getcols('user_modify');
                            helper::filterField($field, $fieldlimit);
                            $case->view->field = $field;
                        } else {
                            $case->view->archive['showform'] = '';
                        }

                        //自定义字段
                        cb_data($case->view->archive);
                        $str = "";
                        $adminlang=lang::getisadmin();
                        foreach ($case->view->archive as $key => $value) {
                            if (!preg_match('/^my/', $key) || !$value)
                                continue;
                            setting::$var['archive'][$key]['catid_'.$adminlang]=setting::$var['archive'][$key]['catid_'.$adminlang]==""?0:setting::$var['archive'][$key]['catid_'.$adminlang];
                            $sonids = $category->sons(setting::$var['archive'][$key]['catid_'.$adminlang]);
                            $sonids[] = setting::$var['archive'][$key]['catid_'.$adminlang];
                            if (!in_array($case->view->archive['catid'], $sonids) && intval(setting::$var['archive'][$key]['catid_'.$adminlang])) {
                                //unset($case->view->field[$key]);
                                continue;
                            }
                            $str .= '<p> ' . setting::$var['archive'][$key]['cname'] . ':' . $value . '</p>';
                        }
                        $arc['my_fields'] = $str;

                        //上一篇,下一篇
                        $aid = $case->view->archive['aid'];
                        $catid = $case->view->archive['catid'];
                        $sql1 = "SELECT * FROM `{$archive->name}` WHERE catid = '$catid' AND aid > '$aid' and state=1 ORDER BY aid ASC LIMIT 0,1";
                        $sql2 = "SELECT * FROM `{$archive->name}` WHERE catid = '$catid' AND aid < '$aid' and state=1 ORDER BY aid DESC LIMIT 0,1";
                        $n = $archive->rec_query_one($sql1);
                        $p = $archive->rec_query_one($sql2);
                        $case->view->archive['p'] = $p;
                        $case->view->archive['n'] = $n;
                        $case->view->archive['p']['url'] = archive::url($p);
                        $case->view->archive['n']['url'] = archive::url($n);

                        //评级
                        $case->view->archive['strgrade'] = archive::getgrade($arc['grade']);

                        $newcname='attr2_'.lang::getistemplate();
                        $attr2=json_decode($case->view->archive['attr2'],true);
                        $case->view->archive['attr2']=is_array($attr2)?$attr2[$newcname]:$case->view->archive['attr2'];

                        $prices = getPrices($case->view->archive['attr2']);
                        $case->view->archive['attr2'] = $prices['price'];
                        $case->view->archive['oldprice'] = $prices['oldprice'];
                        $case->view->groupname = $prices['groupname'];

                        //图片
                        $case->view->archive['pics'] = unserialize($case->view->archive['pics']);


                        if ($template && (file_exists(TEMPLATE . '/' . $case->view->_style . '/' . $template)
                                || file_exists(TEMPLATE . '/' . $template)
                                || file_exists(TEMPLATE . '/' . config::get('template_shopping_dir') . '/' . $template)) )
                                $tpl = $template;
                        else{
                                $tpl = category::gettemplate($case->view->catid, 'showtemplate',true,null,true);
                        }
                        //判断是否是商城栏目
                        if(category::isshopping($case->view->catid)){
                            $tpl=config::get('template_shopping_dir').'/'.$tpl;
                        }

                        $content = $case->fetch($tpl,true);

                        $path =archive::url($case->view->archive, front::$get['page'] > 1 ? front::$get['page'] : null, lang::getisadmin(),true);
                        if (config::get('base_url') == '/') {
                            $path = ROOT . substr($path, 1);
                        } else {
                            $path = ROOT . str_replace(config::get('base_url'), '', $path);
                        }
                        if (strpos($path,'.html') == false){
                            $path.="1.html";
                        }
                        if (!preg_match('/\.[a-zA-Z]+$/', $path))
                            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                        $path = rtrim($path, '/');
                        $path = rtrim($path, '\\');
                        $path = str_replace('//', '/', $path);
                        tool::mkdir(dirname($path));
                        file_put_contents($path, $content);
                        echo  str_pad(str_ireplace(ROOT.'/','',$path)."<br/>",1024*128);
                    }
                    $cpage++;
                    if ($case->view->pages > 1 && $c == 1) {
                        $path = ROOT . archive::url($case->view->archive, 1, lang::getisadmin());
                        if (!preg_match('/\.[a-zA-Z]+$/', $path))
                            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                        $path = rtrim($path, '/');
                        $path = rtrim($path, '\\');
                        $path = str_replace('//', '/', $path);
                        tool::mkdir(dirname($path));
                        //file_put_contents('logs.txt', file_get_contents('logs.txt')."\r\n".$path);
                        $f = fopen($path, 'w');
                        fwrite($f, $content);
                        fclose($f);
                        $cpage++;
                    }
                }
            }
            $totalpage = count($archives);
            if (!isset($archives[0]))
                $totalpage = 0;
            if ($make_page >= $make_page_num) {
                $show_msg =  lang_admin('this_group_generates_html') . " <b>{$cpage}</b> " . lang_admin('npage') . "！  " . lang_admin('generate_html') . lang_admin('this_co_generation') . " <b>{$archive_num}</b> " . lang_admin('npage') . "！ " ;
            } else {
                $show_msg =   lang_admin('how_many') . " <b>{$make_page}</b> " . lang_admin('group_html') . " <b>{$cpage}</b> " . lang_admin('npage') . "！ " . lang_admin('the_total_required') . " <b>{$archive_num}</b> " . lang_admin('npage') . "！ " . lang_admin('has_been_generated') . " <b>" . ($make_page * $group_count) . "</b> " . lang_admin('npage') . "！ " ;
            }

            if ($cpage > 0) {
                if (!config::get('group_on')) {
                    echo  str_pad(lang_admin('generate_html') . " <b>{$cpage}</b> " . lang_admin('npage') . "！" . lang_admin('when_used') . time::getTime() . "！\n",1024*128);
                } else {
                    echo  str_pad($show_msg. "\n",1024*128) ;
                    //最后恢复前台语言包
                    lang::settistemplate($this->_langtemplate);
                    lang::setisadmin($this->_langadmin);
                    $this->_make_show_head=false;
                    $this->make_show_action();
                }
            } else {
               echo   str_pad(lang_admin('none_of_the_generated_HTML')."\n",1024*128);
            }
            front::$admin = true;
            front::$isadmin = true;
            front::$post = $post;
            session::set("cahe_make_show","");   //清空
            unset($archive);
            unset($archives);
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);

            echo str_pad(lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
            exit;
        }
        else if($submit){
            session::set("cahe_make_show",front::$post);
            front::$get['config_cache']=0;
            front::redirect(modify("act/make_show",true));
        }
    }
    function getshowform($cid)
    {
        $category = category::getInstance();
        $row = $category->getrow(array('catid' => $cid), '1 desc', 'catid,showform,parentid');
        if ($row['showform'] && $row['showform'] != 1) {
            $this->showform = $row['showform'];
        } else if ($row['showform'] && $row['showform'] == 1) {
            $this->showform = 1;
        } else if (!$row['showform']) {
            if ($row['parentid'] != 0) {
                $this->getshowform($row['parentid']);
            } else {
                $this->showform = '1';
            }
        }
    }

    //出发生成缓存
    function cache_make_all_action(){
        //动静态切换
        if (session::get("cache_make_php_array")!=""){
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  str_pad(lang_admin("beigin_cache_not_refresh"),1024*128).'<br/>'; //开始生成
            echo  str_pad('<style>*{line-height:180%;color:#fff;}</style>',1024*128);

            $cache_make_array= session::get("cache_make_php_array");
            foreach ($cache_make_array as $cache){
                if ($cache=="index"){
                    //生成全部首页的缓存
                    cache_make::all_make_index(true);
                }
                elseif($cache=="list"){
                    //生成全部栏目的缓存
                    cache_make::all_make_list(true);
                }
                elseif($cache=="show"){
                    //生成全部内容的缓存
                    front::$ismobile = false;
                    cache_make::all_make_show(true);
                }
                elseif($cache=="type"){
                    //生成全部分类的缓存
                    cache_make::all_make_type(true);
                }
                elseif($cache=="special"){
                    //生成全部专题的缓存
                    cache_make::all_make_special(true);
                }
                elseif($cache=="tag"){
                    //生成全部tag的缓存
                    cache_make::all_make_tag(true);
                }
            }
            front::$admin=true;
            session::set("cache_make_php_array","");
            echo str_pad(lang_admin('cache_end').lang_admin("automatically_return_to_the_php_after_2_seconds_to_generate_the_first_page"),1024*128);
        }

        //可视化
        if (front::post("cache_make")){
            if(front::post("cache_make")=="top" || front::post("cache_make")=="bottom"  ){
                //生成全部首页的缓存
                cache_make::all_make_index();
                //生成全部栏目的缓存
                cache_make::all_make_list();
                //生成全部内容的缓存
                front::$ismobile = false;
                cache_make::all_make_show();
                //生成全部分类的缓存
                cache_make::all_make_type();
                //生成全部专题的缓存
                cache_make::all_make_special();
                //生成全部tag的缓存
                cache_make::all_make_tag();
            }
            elseif(front::post("cache_make")=="index-index"){
                //生成全部首页的缓存
                cache_make::all_make_index();
            }
            else{
                $where=array();
                $where['langid']=lang::getlangid(lang::getisadmin());
                $where['template']=front::post("cache_make").".html";
                $archive=archive::getInstance()->getrows($where,0,'aid asc','aid');
                $special=special::getInstance()->getrows($where,0,'spid asc','spid');
                $type=type::getInstance()->getrows($where,0,'typeid asc','typeid');
                $category=category::getInstance()->getrows($where,0,'catid asc','catid');

               if(is_array($archive) && count($archive)>0){
                    foreach ($archive as $a){
                        cache_make::get_make_show($a['aid']);
                    }
                }
                elseif(is_array($category) && count($category)>0){
                        foreach ($category as $c){
                            cache_make::get_make_list($c['catid'],false);
                        }
                }
                elseif(is_array($special) && count($special)>0){
                        foreach ($special as $p){
                            cache_make::get_make_special($p['spid'],false);
                        }
                }
                elseif(is_array($type) && count($type)>0){
                        foreach ($type as $y){
                            cache_make::get_make_type($y['typeid'],false);
                        }
                }
            }

        }

        exit;
    }

    function make_php_all_action(){
        if (session::get("cache_make_php_array")==""){
            //返回动静态切换
            front::redirect("/index.php?case=config&act=system&set=dynamic&admin_dir=".get('admin_dir',true)."&site=default");
        }
    }


  //---------------------------------------新版生成-------------------------------------------------------------
    //获取生成需要的信息
    function  get_manke_data_action(){
        if (front::get("manke_data_type")){
            //生成全部首页静态
            if (front::get("manke_data_type")=="manke_all_index"){
                $manke_all_data=self::manke_all_data();
                $index_data=$manke_all_data['manke_index'];
                $baidu_data=$manke_all_data['manke_baidu'];
                $google_data=$manke_all_data['make_google'];
                $map_data=$manke_all_data['ctsitemap'];
                $data=array_merge($index_data,$baidu_data,$google_data,$map_data);
                $return_data=array("msg"=>"","status"=>1,"data"=>$data);
                echo json_encode($return_data);
            }//生成全部栏目静态
            elseif (front::get("manke_data_type")=="manke_all_list"){
                $manke_all_data=self::manke_all_data();
                if (session::get("manke_list_data")){
                    $category_data=session::get("manke_list_data");
                }else{
                    $category = category::getInstance();
                    $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $category_data=$category->getrows($where,0,'listorder=0,listorder desc');
                }
                $data=array();
                if (is_array($category_data))
                    foreach ($category_data as $key=>$val){
                        if (isset($manke_all_data["manke_column_".$val['catid']]) &&  is_array($manke_all_data["manke_column_".$val['catid']]))
                        $data=array_merge($data,$manke_all_data["manke_column_".$val['catid']]);
                    }
                $return_data=array("msg"=>"","status"=>1,"data"=>$data);
                echo json_encode($return_data);
            }//生成全部栏目静态
            elseif (front::get("manke_data_type")=="manke_all_show"){
            $manke_all_data=self::manke_all_data();
                if (session::get("manke_list_data")){
                    $category_data=session::get("manke_list_data");
                }else{
                    $category = category::getInstance();
                    $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $category_data=$category->getrows($where,0,'listorder=0,listorder desc');
                }
                $data=array();
                if (is_array($category_data))
                    foreach ($category_data as $key=>$val){
                     if (isset($manke_all_data["manke_show_".$val['catid']]) && is_array($manke_all_data["manke_show_".$val['catid']]))
                        $data=array_merge($data,$manke_all_data["manke_show_".$val['catid']]);
                    }
                $return_data=array("msg"=>"","status"=>1,"data"=>$data);
                echo json_encode($return_data);
            }//生成全部内容静态
            elseif (front::get("manke_data_type")=="manke_all_type"){
                $manke_all_data=self::manke_all_data();
                if (session::get("manke_type_data")){
                    $type_data=session::get("manke_type_data");
                }else{
                    $type = type::getInstance();
                    $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $type_data=$type->getrows($where,0,'listorder=0,listorder desc');
                }
                $data=array();
                if (is_array($type_data))
                    foreach ($type_data as $key=>$val){
                     if (isset($manke_all_data["manke_type_".$val['typeid']]) && is_array($manke_all_data["manke_type_".$val['typeid']]))
                        $data=array_merge($data,$manke_all_data["manke_type_".$val['typeid']]);
                    }
                $return_data=array("msg"=>"","status"=>1,"data"=>$data);
                echo json_encode($return_data);
            }//生成全部分类静态
            elseif (front::get("manke_data_type")=="manke_all_special"){
                $manke_all_data=self::manke_all_data();
                $special = special::getInstance();
                if (session::get("manke_special_data")){
                    $special_data=session::get("manke_special_data");
                }else{
                    $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $special_data=$special->getrows($where,0,'listorder=0,listorder desc');
                }
                $data=array();
                if (is_array($special_data))
                    foreach ($special_data as $key=>$val){
                     if (isset($manke_all_data["manke_special_".$val['spid']]) && is_array($manke_all_data["manke_special_".$val['spid']]))
                        $data=array_merge($data,$manke_all_data["manke_special_".$val['spid']]);
                    }
                $return_data=array("msg"=>"","status"=>1,"data"=>$data);
                echo json_encode($return_data);
            }//生成全部专题静态
            elseif (front::get("manke_data_type")=="manke_all_tag"){
                $manke_all_data=self::manke_all_data();
                $tag = tag::getInstance();
                if (session::get("manke_tag_data")){
                    $tag_data=session::get("manke_tag_data");
                }else{
                    $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $tag_data=$tag->getrows($where,0);
                }
                $data=array();
                if (is_array($tag_data))
                    foreach ($tag_data as $key=>$val){
                     if (isset($manke_all_data["manke_tag_".$val['tagid']]) && is_array($manke_all_data["manke_tag_".$val['tagid']]))
                        $data=array_merge($data,$manke_all_data["manke_tag_".$val['tagid']]);
                    }
                $return_data=array("msg"=>"","status"=>1,"data"=>$data);
                echo json_encode($return_data);
            }//生成全部tag静态
            else{
                $manke_all_data=self::manke_all_data();
                $data=isset($manke_all_data[front::get("manke_data_type")])?$manke_all_data[front::get("manke_data_type")]:"";
                $return_data=array("msg"=>"","fail"=>lang_admin('no_data_html_generated'),"status"=>1,"data"=>$data);
                echo json_encode($return_data);
            } ////单个生成
        }
        exit;
    }
    function  manke_all_data(){
        $manke_all_data=array();
        front::$get['page']=1;
        $lang_id=lang::getlangid(lang::getisadmin());
        $pagesize = config::get('list_pagesize');
        //首页生成获取
        if ( config::get('list_index_php') == 1) {
            $data = array();
            //默认前台选中语言
            $index_data = array("fail" => '<a target="_blank" href="' . getSiteUrl() . '/index.html" style="color:red">index.html' . lang_admin('generate') . lang_admin('failure') . '</a>',
                "filename" => 'index.html',
                "suc" => '<a" target="_blank" href="' . getSiteUrl() . '/index.html">index.html' .  '<span class="pull-right" style="color: #28D094;">' . lang_admin('successful_generation') . '</span></a>',
                "url" => getSiteUrl() . "/index.php?case=cache&act=manke_index&isdefault_index=1&lang=" . lang::getistemplate() . "&admin_dir=" . get('admin_dir', true) . "&site=default"
            );
            $data[] = $index_data;
            //生成全部语言
            $langdata = getlang();
            if ($langdata != "") {
                foreach ($langdata as $key => $val) {
                    $index_data = array("fail" => '<a target="_blank" href="' . getSiteUrl() . '/index-' . $val['langurlname'] . '.html" style="color:red">index-' . $val['langurlname'] . '.html' . lang_admin('generate') . lang_admin('failure') . '</a>',
                        "filename" => 'index-' . $val['langurlname'] . '.html',
                        "suc" => '<a" target="_blank" href="' . getSiteUrl() . '/index-' . $val['langurlname'] . '.html">index-' . $val['langurlname'] . '.html' .  '<span class="pull-right" style="color: #28D094;">' . lang_admin('successful_generation') . '</span></a>',
                        "url" => getSiteUrl() . "/index.php?case=cache&act=manke_index&isdefault_index=0&lang=" . $val['langurlname'] . "&admin_dir=" . get('admin_dir', true) . "&site=default"
                    );
                    $data[] = $index_data;
                }
            }
            $manke_all_data["manke_index"] = $data;


            //百度地图
            $data=array();
            $data[] = array("fail" => '<a target="_blank" href="#" style="color:red">'.lang_admin("generating_baidu_map_xml").lang_admin('generate').lang_admin('failure').'</a>',
                "filename" => lang_admin("generating_baidu_map_xml"),
                "suc" => '<a" target="_blank" href="#">'.lang_admin("generating_baidu_map_xml").lang_admin('generate').lang_admin('success').'</a>',
                "url" => getSiteUrl() . "/index.php?case=cache&act=make_baidu&admin_dir=" . get('admin_dir', true) . "&site=default"
            );
            $manke_all_data["manke_baidu"]=$data;

            //谷歌地图
            $data=array();
            $data[] = array("fail" => '<a target="_blank" href="#" style="color:red">'.lang_admin("google").lang_admin('generate').lang_admin('failure').'</a>',
                "filename" => lang_admin("google"),
                "suc" => '<a" target="_blank" href="#">'.lang_admin("google").lang_admin('generate').lang_admin('success').'</a>',
                "url" => getSiteUrl() . "/index.php?case=cache&act=make_google&admin_dir=" . get('admin_dir', true) . "&site=default"
            );
            $manke_all_data["make_google"]=$data;

            //网站地图
            $data=array();
            $data[] = array("fail" => '<a target="_blank" href="#" style="color:red">'.lang_admin("site_map").lang_admin('generate').lang_admin('failure').'</a>',
                "filename" => lang_admin("site_map"),
                "suc" => '<a" target="_blank" href="#">'.lang_admin("site_map").lang_admin('generate').lang_admin('success').'</a>',
                "url" => getSiteUrl() . "/index.php?case=cache&act=ctsitemap"
            );
            $manke_all_data["ctsitemap"]=$data;
        }

        //栏目列表生成获取
        if ( config::get('list_page_php') == 1) {
            if (session::get("manke_list_data")){
                $category_data=session::get("manke_list_data");
            }else{
                $category = category::getInstance();
                $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                $category_data=$category->getrows($where,0,'listorder=0,listorder desc');
            }
            if (is_array($category_data))
                foreach ($category_data as $key=>$val){
                    //分页
                    $_catpage = category::categorypages($val['catid']);
                    if ($_catpage) {
                        $pagesize = $_catpage;
                    } else {
                        $pagesize = config::get('list_pagesize');
                    }
                    $categories = array();
                    if (@$val['ispages'])
                        $categories =category::getInstance()->sons($val['catid']);
                    $categories[] = $val['catid'];
                    if (@$val['includecatarchives']) {
                        $articlesWhere ='catid in (' . implode(',', $categories) . ') and checked=1';
                    } else {
                        $articlesWhere='catid=' . front::get('catid') . ' and checked=1';
                    }
                    //增加语言包过滤
                    $articlesWhere=$articlesWhere. ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $art_count = archive::getInstance()->rec_count($articlesWhere);
                    if ($art_count==0  )$art_count=$pagesize;
                    for($page=1;$page<=ceil($art_count/$pagesize);$page++){
                        $path = category::url($val['catid'], $page,
                            lang::getisadmin(),false);
                        $path = category::url_rule($path);
                        $path=str_ireplace(ROOT . '/', '', $path);
                        //栏目页
                        $data = array("fail" => '<a target="_blank" href="' . getSiteUrl() . '/'.$path.'" style="color:red">'.$path . lang_admin('generate') . lang_admin('failure') . '</a>',
                            "filename" => $path,
                            "suc" => '<a" target="_blank" href="' . getSiteUrl() . '/'.$path.'">'.$path .  '<span class="pull-right" style="color: #28D094;">' . lang_admin('successful_generation') . '</span></a>',
                            "url" => getSiteUrl() . "/index.php?case=archive&act=list&catid=".$val['catid'].'&page='.$page.'&cache=1'
                        );
                        $manke_all_data["manke_column_".$val['catid']][]=$data;
                    }
                }
        }
        //内容生成获取
        if ( config::get('show_page_php') == 1) {
            if (session::get("manke_list_data")){
                $category_data=session::get("manke_list_data");
            }else{
                $category = category::getInstance();
                $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                $category_data=$category->getrows($where,0,'listorder=0,listorder desc');
            }
            if (is_array($category_data))
                foreach ($category_data as $key=>$val){
                    $where = "catid=".$val['catid'].' and checked=1 AND (ishtml IS NULL OR ishtml!=2)'. ' and langid = "'.$lang_id.'"';
                    //取到要生成的所有文章
                    $archives =archive::getInstance()->getrows($where, 0);
                    if (is_array($archives))
                        foreach ($archives as $arc) {
                            if (!category::getarcishtml($arc))  //如果文章设置不生成则跳过
                                continue;
                            //内容分页
                            $contents = preg_split('%<hr/>%', $arc['content']);
                            if (!empty($contents)) {
                                $_page = count($contents);
                            }
                            else {
                                $_page = 1;
                            }
                            for ($page = 1; $page <= $_page; $page++) {
                                $path = archive::url($arc, $page > 1 ? $page : null, lang::getisadmin(), false);
                                $path = archive::url_rule($path);
                                $path = str_ireplace(ROOT . '/', '', $path);
                                //内容页
                                $data = array("fail" => '<a target="_blank" href="' . getSiteUrl() . '/' . $path . '" style="color:red">' . $path . lang_admin('generate') . lang_admin('failure') . '</a>',
                                    "filename" => $path,
                                    "suc" => '<a" target="_blank" href="' . getSiteUrl() . '/' . $path . '">' . $path .  '<span class="pull-right" style="color: #28D094;">' . lang_admin('successful_generation') . '</span></a>',
                                    "url" => getSiteUrl() . "/index.php?case=archive&act=show&aid=" . $arc['aid'] . '&cache=1&page='.$page
                                );
                                $manke_all_data["manke_show_" . $val['catid']][] = $data;
                            }
                        }
                }
        }
        //分类生成获取
        if ( config::get('list_type_php') == 1) {
            $type = type::getInstance();
            if (session::get("manke_type_data")){
                $type_data=session::get("manke_type_data");
            }else{
                $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                $type_data=$type->getrows($where,0,'listorder=0,listorder desc');
            }
            if (is_array($type_data))
                foreach ($type_data as $key=>$val){
                        if (!$type::getarcishtml($val))  //如果分类设置不生成则跳过
                            continue;
                        if (!$type->getishtml($val['typeid']))
                             continue;
                        $path = type::url($val['typeid'], front::$get['page'] > 1 ? front::$get['page'] : 1, lang::getisadmin(), false);
                        $path = type::url_rule($path);
                        $path = str_ireplace(ROOT . '/', '', $path);
                        //分类页
                        $data = array("fail" => '<a target="_blank" href="' . getSiteUrl() . '/' . $path . '" style="color:red">' . $path . lang_admin('generate') . lang_admin('failure') . '</a>',
                            "filename" => $path,
                            "suc" => '<a" target="_blank" href="' . getSiteUrl() . '/' . $path . '">' . $path .  '<span class="pull-right" style="color: #28D094;">' . lang_admin('successful_generation') . '</span></a>',
                            "url" => getSiteUrl() . "/index.php?case=type&act=list&typeid=" . $val['typeid'] . '&cache=1&page=' . front::$get['page']
                        );
                        $manke_all_data["manke_type_" . $val['typeid']][] = $data;
                }
        }
        //专题生成获取
        if ( config::get('list_special_php') == 1) {
            $special = special::getInstance();
            if (session::get("manke_special_data")){
                $special_data=session::get("manke_special_data");
            }else{
                $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                $special_data=$special->getrows($where,0,'listorder=0,listorder desc');
            }
            if (is_array($special_data))
                foreach ($special_data as $key=>$val){
                    if (!$special->getishtml($val['spid'])) {
                        continue;
                    }
                    $archive_all = new archive();
                    $archive_num = $archive_all->rec_count('spid=' . $val['spid'] . ' and checked=1 and `state`=1 and langid = "'.lang::getlangid(lang::getisadmin()).'"');
                    if (!$archive_num) $archive_num = 1;
                    $cpage = ceil($archive_num / $pagesize);
                    for ($i = 1; $i <= $cpage; $i++) {
                        $path =special::url($val['spid'],$val['ishtml'],$i,$val['htmldir'],lang::getisadmin(),false);
                        $path = special::url_rule($path);
                        $path = str_ireplace(ROOT . '/', '', $path);
                        //分类页
                        $data = array("fail" => '<a target="_blank" href="' . getSiteUrl() . '/' . $path . '" style="color:red">' . $path . lang_admin('generate') . lang_admin('failure') . '</a>',
                            "filename" => $path,
                            "suc" => '<a" target="_blank" href="' . getSiteUrl() . '/' . $path . '">' . $path .  '<span class="pull-right" style="color: #28D094;">' . lang_admin('successful_generation') . '</span></a>',
                            "url" => getSiteUrl() . "/index.php?case=special&act=show&spid=" . $val['spid'] . '&cache=1&page=' . $i
                        );
                        $manke_all_data["manke_special_" . $val['spid']][] = $data;
                    }
                }
        }
        //tag生成获取
        if (config::get('tag_html') == 1) {
            $tag = tag::getInstance();
            if (session::get("manke_tag_data")){
                $tag_data=session::get("manke_tag_data");
            }else{
                $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
                $tag_data=$tag->getrows($where,0);
            }
            if (is_array($tag_data))
                foreach ($tag_data as $key=>$val){
                    $arctag = new arctag();
                    $archive_num = $arctag->rec_count('tagid=' . $val['tagid']);
                    if (!$archive_num) $archive_num = 1;
                    $cpage = ceil($archive_num / $pagesize);
                    for ($i = 1; $i <= $cpage; $i++) {
                        $path =tag::url($val['tagname'],$i,lang::getisadmin(),false);
                        $path = tag::url_rule($path);
                        $path = str_ireplace(ROOT . '/', '', $path);
                        //分类页
                        $data = array("fail" => '<a target="_blank" href="' . getSiteUrl() . '/' . $path . '" style="color:red">' . $path . lang_admin('generate') . lang_admin('failure') . '</a>',
                            "filename" => $path,
                            "suc" => '<a" target="_blank" href="' . getSiteUrl() . '/' . $path . '">' . $path .  '<span class="pull-right" style="color: #28D094;">' . lang_admin('successful_generation') . '</span></a>',
                            "url" => getSiteUrl() . "/index.php?case=tag&act=show&tagid=" . $val['tagid'] . '&cache=1&page=' . $i
                        );
                        $manke_all_data["manke_tag_" . $val['tagid']][] = $data;
                    }
                }
        }

        return $manke_all_data;
    }


    //获取首页生成项目
    function doGetHtml_index_action(){
        $data=array();
        $all_data=array("name"=>lang_admin("all_html"),"content"=>array("name"=>lang_admin("generate").lang_admin("all_html"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_all_index&admin_dir=".get('admin_dir',true)."&site=default"),
        );
        if (front::get('is_static')){
            $all_data['is_static']="all_button";
        }
        $data[]=$all_data;
        $index_data=array("name"=>lang_admin("home"),"content"=>array("name"=>lang_admin("generate").lang_admin("home"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_index&admin_dir=".get('admin_dir',true)."&site=default"));
        $data[]=$index_data;
        $baidu_data=array("name"=>lang_admin("baidu_maps"),"content"=>array("name"=>lang_admin("generating_baidu_map_xml"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_baidu&admin_dir=".get('admin_dir',true)."&site=default"));
        $data[]=$baidu_data;
        $google_data=array("name"=>lang_admin("google"),"content"=>array("name"=>lang_admin("generating_google_map_xml"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=make_google&admin_dir=".get('admin_dir',true)."&site=default"));
        $data[]=$google_data;
        $map_data=array("name"=>lang_admin("site_map"),"content"=>array("name"=>lang_admin("generate_site_map"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=ctsitemap&admin_dir=".get('admin_dir',true)."&site=default"));
        $data[]=$map_data;
        $return_data=array("msg"=>"","status"=>1,"data"=>$data);
        echo json_encode($return_data);
        exit;
    }
    //首页生成
    function manke_index_action(){
        if (front::get("lang") && config::get('list_index_php') == 1){
            $admin_lang=front::get("admin_lang");
            $template_lang=front::get("template_lang");

            $lang=front::get("lang");

            $case = 'index';
            $act = 'index';
            $_GET = array('case' => $case, 'act' => $act);
            front::$admin = false;
            front::$isadmin = false;
            front::$html = true;
            $case = $case . '_act';
            $case = new $case();
            $case->init();
            lang::settistemplate($lang);
            lang::setisadmin($lang);
            //重新加载语言包
            load_lang('system.php','system_custom.php');
            load_admin_lang('system_admin.php','system_admin_custom.php');

            $categorydata_lang=category::getInstance()->getrow("isindex=1 and langid=".lang::getlangid($lang)); //如果首页是栏目
            if (is_array($categorydata_lang) && $categorydata_lang['langid']==lang::getlangid($lang)){
                $return_data=array("suc"=>0);
                echo json_encode($return_data);
            }
            else {
                $data=$case->fetch('index/index.html',true);
                if (front::get("isdefault_index")) {
                    file_put_contents(ROOT . '/index.html', $data);
                }else{
                    file_put_contents(ROOT . '/index-' . lang::getistemplate() . '.html', $data);
                }
                $return_data=array("suc"=>1);
                echo json_encode($return_data);
            }

            front::$admin = true;
            front::$isadmin = true;
            //最后恢复前台语言包
            lang::settistemplate($admin_lang);
            lang::setisadmin($template_lang);
            exit;
        }
        exit;
    }
    //百度地图-生成
    function make_baidu_action()
    {
        $limit = front::$post['XmlOutNum'];
        $p = front::$post['XmlMaxPerPage'];
        if (!$p)
            $p = 100;
        $frequency = front::$post['frequency'];
        $this->archive =archive::getInstance();
        $articles = $this->archive->getrows('state=1', $limit);
        $site_url = config::get('site_url');
        $email = config::get('email');
        $code = '';
        $i = 1;
        $j = 1;
        if (is_array($articles) && !empty($articles)) {
            foreach ($articles as $arr) {
                $_url = archive::url($arr);
                if(preg_match('/^http/i',$_url)){
                    $url = archive::url($arr);;
                }else{
                    $url = substr($site_url, 0, -1) . $_url;
                }
                $adddate = date("Y-m-d", strtotime($arr['adddate']));
                $code .= "{$url}\r\n";
            }
            file_put_contents("sitemap.txt",  $code);
        }
        //exit;
      /*  echo '<script>alert("' . lang_admin('generate_html') . '");gotoinurl("index.php?case=index&act=index&admin_dir=' . config::getadmin('admin_dir') . '");</script>';
        exit;*/
        $return_data=array("suc"=>1);
        echo json_encode($return_data);
        exit;
    }
    //谷歌地图
    function make_google_action()
    {
        $limit = isset(front::$post['XmlOutNum'])?front::$post['XmlOutNum']:"";
        $p = isset(front::$post['XmlMaxPerPage'])?front::$post['XmlMaxPerPage']:"";
        if (!$p)
            $p = 100;
        $frequency = isset(front::$post['frequency'])?front::$post['frequency']:"";
        make_xml();
       /* echo '<script>alert("' . lang_admin('generate_html') . '");gotoinurl("index.php?case=index&act=index&admin_dir=' . config::get('admin_dir') . '");</script>';
        exit;*/
        $return_data=array("suc"=>1);
        echo json_encode($return_data);
        exit;
    }
    //xml生成
    function make_xml_action()
    {
        $limit = isset(front::$post['XmlOutNum'])?front::$post['XmlOutNum']:"";
        $p = isset(front::$post['XmlMaxPerPage'])?front::$post['XmlMaxPerPage']:"";
        if (!$p)
            $p = 100;
        $frequency = isset(front::$post['frequency'])?front::$post['frequency']:"";
        make_xml();
        /* echo '<script>alert("' . lang_admin('generate_html') . '");gotoinurl("index.php?case=index&act=index&admin_dir=' . config::get('admin_dir') . '");</script>';
         exit;*/
        front::flash("xml生成成功！");
        front::$admin=true;
        front::redirect(url::create('config/system/set/xml', true));
    }


    //获取栏目列表
    function doGetHtml_list_action(){
        $data=array();
        $all_data=array("name"=>lang_admin("all_html"),"content"=>array("name"=>lang_admin("generate").lang_admin("all_html"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_all_list&admin_dir=".get('admin_dir',true)."&site=default"));
        if (front::get('is_static')){
            $all_data['is_static']="all_button";
        }

        $data[]=$all_data;


        $category = category::getInstance();
        $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
        $category_data=$category->getrows($where,0,'listorder=0,listorder desc');

        $category_clead = array();
        foreach ($category_data as $one) {
            $category_clead[$one['catid']] = $one;
        }

        session::set("manke_list_data",$category_data);
        if (is_array($category_data))
            foreach ($category_data as $key=>$val) {
                if ($val['parentid']!=0 && !array_key_exists($val['parentid'], $category_clead))continue;
                $all_data = array("name" => $val['catname'],
                    "content" => array("name" => lang_admin("generate") . lang_admin("list") . lang_admin("npage"),
                        "url" => getSiteUrl() . "/index.php?case=cache&act=get_manke_data&manke_data_type=manke_column_" . $val['catid'] . "&admin_dir=" . get('admin_dir', true) . "&site=default"),
                );
                $data[] = $all_data;
            }

        $return_data=array("msg"=>"","status"=>1,"data"=>$data);
        echo json_encode($return_data);
        exit;
    }
    //获取内容列表
    function doGetHtml_show_action(){
        $data=array();
        $all_data=array("name"=>lang_admin("all_html"),"content"=>array("name"=>lang_admin("generate").lang_admin("all_html"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_all_show&admin_dir=".get('admin_dir',true)."&site=default"));
        if (front::get('is_static')){
            $all_data['is_static']="all_button";
        }
        $data[]=$all_data;

        $category = category::getInstance();
        $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
        $category_data=$category->getrows($where,0,'listorder=0,listorder desc');
        if (is_array($category_data))
            foreach ($category_data as $key=>$val) {
                $all_data = array("name" => $val['catname'],
                    "content" => array("name" => lang_admin("generate") . lang_admin("content") . lang_admin("npage"),
                        "url" => getSiteUrl() . "/index.php?case=cache&act=get_manke_data&manke_data_type=manke_show_" . $val['catid'] . "&admin_dir=" . get('admin_dir', true) . "&site=default"),
                );
                $data[] = $all_data;
            }

        $return_data=array("msg"=>"","status"=>1,"data"=>$data);
        echo json_encode($return_data);
        exit;
    }
    //获取分类列表
    function doGetHtml_type_action(){
        $data=array();
        $all_data=array("name"=>lang_admin("all_html"),"content"=>array("name"=>lang_admin("generate").lang_admin("all_html"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_all_type&admin_dir=".get('admin_dir',true)."&site=default"));
        if (front::get('is_static')){
            $all_data['is_static']="all_button";
        }
        $data[]=$all_data;

        $type = type::getInstance();
        $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
        $type_data=$type->getrows($where,0,'listorder=0,listorder desc');

        $type_clead = array();
        foreach ($type_data as $one) {
            $type_clead[$one['typeid']] = $one;
        }

        session::set("manke_type_data",$type_data);
        if (is_array($type_data))
            foreach ($type_data as $key=>$val) {
                if ($val['parentid']!=0 && !array_key_exists($val['parentid'], $type_clead))continue;
                $all_data = array("name" => $val['typename'],
                    "content" => array("name" => lang_admin("generate") . lang_admin("type") . lang_admin("npage"),
                        "url" => getSiteUrl() . "/index.php?case=cache&act=get_manke_data&manke_data_type=manke_type_" . $val['typeid'] . "&admin_dir=" . get('admin_dir', true) . "&site=default"),
                );
                $data[] = $all_data;
            }

        $return_data=array("msg"=>"","status"=>1,"data"=>$data);
        echo json_encode($return_data);
        exit;
    }
    //获取专题列表
    function doGetHtml_special_action(){
        $data=array();
        $all_data=array("name"=>lang_admin("all_html"),"content"=>array("name"=>lang_admin("generate").lang_admin("all_html"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_all_special&admin_dir=".get('admin_dir',true)."&site=default"));
        if (front::get('is_static')){
            $all_data['is_static']="all_button";
        }
        $data[]=$all_data;

        $special = special::getInstance();
        $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
        $special_data=$special->getrows($where,0,'listorder=0,listorder desc');
        session::set("manke_special_data",$special_data);
        if (is_array($special_data))
            foreach ($special_data as $key=>$val) {
                $all_data = array("name" => $val['title'],
                    "content" => array("name" => lang_admin("generate") . lang_admin("special") . lang_admin("npage"),
                        "url" => getSiteUrl() . "/index.php?case=cache&act=get_manke_data&manke_data_type=manke_special_" . $val['spid'] . "&admin_dir=" . get('admin_dir', true) . "&site=default"),
                );
                $data[] = $all_data;
            }

        $return_data=array("msg"=>"","status"=>1,"data"=>$data);
        echo json_encode($return_data);
        exit;
    }
    //获取tag列表
    function doGetHtml_tag_action(){
        $data=array();
        $all_data=array("name"=>lang_admin("all_html"),"content"=>array("name"=>lang_admin("generate").lang_admin("all_html"),
            "url"=>getSiteUrl()."/index.php?case=cache&act=get_manke_data&manke_data_type=manke_all_tag&admin_dir=".get('admin_dir',true)."&site=default"));
        if (front::get('is_static')){
            $all_data['is_static']="all_button";
        }
        $data[]=$all_data;

        $tag = tag::getInstance();
        $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
        $tag_data=$tag->getrows($where,0,'listorder=0,listorder desc');
        session::set("manke_tag_data",$tag_data);
        if (is_array($tag_data))
            foreach ($tag_data as $key=>$val) {
                $all_data = array("name" => $val['tagname'],
                    "content" => array("name" => lang_admin("generate") . lang_admin("tag") . lang_admin("npage"),
                        "url" => getSiteUrl() . "/index.php?case=cache&act=get_manke_data&manke_data_type=manke_tag_" . $val['tagid'] . "&admin_dir=" . get('admin_dir', true) . "&site=default"),
                );
                $data[] = $all_data;
            }

        $return_data=array("msg"=>"","status"=>1,"data"=>$data);
        echo json_encode($return_data);
        exit;
    }

    function end()
    {
        front::$html = false;
        front::$admin = true;
        front::$isadmin = true;
        //最后恢复前台语言包
        lang::settistemplate($this->_langtemplate);
        lang::setisadmin($this->_langadmin);
        $this->render();
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
