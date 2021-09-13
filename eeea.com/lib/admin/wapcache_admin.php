<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

class wapcache_admin extends admin {

    public $archive;
    protected $_langadmin;
    protected $_langtemplate;
    protected   $_make_show_head=true;

    function init() {
        header('Cache-control: private, must-revalidate');
        front::$admin = false;
        front::$html = true;

        //先记录当前语言包
        $this->_langtemplate=lang::getistemplate();
        $this->_langadmin=lang::getisadmin();
    }

    function make_index_action() {
        if (front::get("wap_config_cache")){
            front::$post['submit']=1;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_wap_make_index"))
        {
            echo  lang_admin("beigin_cache_not_refresh").'<br/>';
            echo '<style>*{line-height:180%;color:#fff;}</style>';
            $servip = gethostbyname($_SERVER['SERVER_NAME']);
            if ($servip == front::ip() && front::get('ishtml') == 1) {
            } else {
                chkpw('cache_index');
            }
            $case = 'index';
            $act = 'index';
            $_GET = array('case' => $case, 'act' => $act, 't' => 'wap');
            //$front = new front();
            front::$ismobile = true;
            front::$admin = false;
            front::$html = true;
            $case = $case . '_act';
            $case = new $case();
            $case->init();
            $method = $act . '_action';
            $view = $case->view;
            if (config::getadmin('wap_index_php') != 1) {
                //最后恢复前台语言包
                lang::settistemplate($this->_langtemplate);
                lang::setisadmin($this->_langadmin);
                session::set("cahe_wap_make_index","");   //清空
                echo lang_admin('none_of_the_generated_HTML').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
                exit;
            }

            //生成全部语言
            $langdata=getlang();
            if($langdata != ""){
                foreach ($langdata as $key=>$val){
                    lang::settistemplate($val['langurlname']);
                    lang::setisadmin($val['langurlname']);
                    lang::$langadmindata=null;
                    templatetag::$setting=array();
                    $templatetag=new templatetag();  //重新声明一下  会重新加载标签
                    load_lang('system.php','system_custom.php');  //重新加载语言包
                    echo ROOT . '/wap/index-'.lang::getisadmin().'.html'.'<br/>';
                    file_put_contents(ROOT . '/wap/index-'.lang::getisadmin().'.html', $case->fetch("index/index.html",true));
                }
            }
            //生成默认语言
            $defaultlangdata=getisdefault();
            if($defaultlangdata != ""){
                lang::settistemplate($defaultlangdata);
                lang::setisadmin($defaultlangdata);
                lang::$langadmindata=null;
                templatetag::$setting=array();
                $templatetag=new templatetag();  //重新声明一下  会重新加载标签
                load_lang('system.php','system_custom.php');  //重新加载语言包
                echo ROOT . '/wap/index.html'.'<br/>';
                file_put_contents(ROOT . '/wap/index.html', $case->fetch('index/index.html',true));
            }

            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
            session::set("cahe_wap_make_index","");   //清空
            echo lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
            exit;
        }
        else if ($submit){
            session::set("cahe_wap_make_index",'1');
            front::$get['wap_config_cache']=0;
            front::redirect(modify("act/make_index",true));
        }
    }

    //删除专题生成的静态页面
    static function delete_make_special_action(){
        front::$get['t'] = 'wap';
        front::$admin = false;
        front::$html = true;
        front::$ismobile = true;
        front::$rewrite = false;
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
    function make_special_action() {
    	chkpw('cache_special');
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("wap_config_cache")){
            front::$post['submit']=1;
            front::$post['specialid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_wap_make_special")) {
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  lang_admin("beigin_cache_not_refresh").'<br/>'; //开始生成
            echo '<style>*{line-height:180%;color:#fff;}</style>';
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();

            front::$get['t'] = 'wap';
            front::$admin = false;
            front::$html = true;
            front::$ismobile = true;
            front::$rewrite = false;
            $post = session::get("cahe_wap_make_special");
            $speciaid = intval($post['specialid']);
            $special=new special();
            $where = ' langid = "' . lang::getlangid(lang::getisadmin()) . '"';
            if ($speciaid == '0') {
                $specials = $special->getrows($where,0);
            } else {
                $where .= ' and spid=' . $speciaid;
                $specials = $special->getrows($where,0);
                // echo '<script>alert("' . count($specials) . '");</script>';
            }
            $index = 0;  //生成页数
            if (is_array($specials) && !empty($specials)) {
                foreach ($specials as $v) {
                    if (!$special->getiswaphtml($v['spid'])) {
                        // echo  lang_admin('none_of_the_generated_HTML');
                        continue;
                    }
                    $archive_all = new archive();
                    $archive_num = $archive_all->rec_count('spid=' . $v['spid'] . ' and checked=1 and `state`=1');
                    $pagesize = config::get('list_pagesize');
                    if (!$archive_num) $archive_num = 1;
                    $cpage = ceil($archive_num / $pagesize);
                    $j = 0;

                    for ($i = 1; $i <= $cpage; $i++) {
                        //$path = $html_prefix . 'special/' . $v['spid'] .config::getadmin("staticlang") . lang::getisadmin() . '/list'.config::getadmin("staticlang") . $i . '.html';
                        $path = special::url($v['spid'],$v['ishtml'],$i,$v['htmldir']);
                        if (!preg_match('/\.[a-zA-Z]+$/', $path))
                            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                        $path = rtrim($path, '/');
                        $path = rtrim($path, '\\');
                        $path = str_replace(config::get('site_url'), '', $path);

                        if (config::get('base_url') == '/') {
                            $path = ROOT . substr($path, 1);
                        } else {
                            $path = ROOT . str_replace(config::get('base_url'), '', $path);

                        }
                        $path = str_replace('//', '/', $path);

                        echo  $path."<br/>";
                        tool::mkdir(dirname($path));
                        $data = file_get_contents(config::get('site_url') . 'index.php?case=special&act=show&spid=' . $v['spid'] . '&page=' . $i.'&url='.lang::getisadmin());
                        if (file_put_contents($path, $data)) {
                            $j++;
                        }
                    }
                    if ($j > 0) {
                        $index = $index + $j;//记录页数
                        //  $path = $html_prefix . 'special/' . $v['spid'] .config::getadmin("staticlang"). lang::getisadmin() . '/index.html';
                        $path = dirname($path) . '/index.html';         //目录下index
                      /*  echo  $path."<br/>";*/
                        tool::mkdir(dirname($path));
                        $data = file_get_contents(config::get('site_url') . 'index.php?case=special&act=show&spid=' . $v['spid'] . '&page=1'.'&url='.lang::getisadmin());
                        if (file_put_contents($path, $data)) {
                            //front::flash("成功生成html <b>1</b> 页！");
                        }
                    }
                }
            }
            if ($index > 0) {
                echo lang_admin('generate_html') . " <b>$index</b> " . lang_admin('npage') . "！";
            } else {
                echo  lang_admin('none_of_the_generated_HTML');
            }
            session::set("cahe_wap_make_special", "");   //清空
            echo lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
            exit;
        }
        else if($submit){
            session::set("cahe_wap_make_special",front::$post);
            front::$get['wap_config_cache']=0;
            front::redirect(modify("act/make_special",true));
        }
    }

    //删除Tag生成的静态页面
    static function delete_make_tag_action(){
        front::$get['t'] = 'wap';
        front::$admin = false;
        front::$html = true;
        front::$ismobile = true;
        front::$rewrite = false;
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
    function make_tag_action() {
    	chkpw('cache_tag');
    	header('Cache-control: private, must-revalidate');
    	set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("wap_config_cache")){
            front::$post['submit']=1;
            front::$post['tag']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_wap_make_tag")) {
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  lang_admin("beigin_cache_not_refresh").'<br/>'; //开始生成
            echo '<style>*{line-height:180%;color:#fff;}</style>';
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();

            $post = session::get("cahe_make_tag");
            front::$get['t'] = 'wap';
            front::$admin = false;
            front::$html = true;
            front::$ismobile = true;
            front::$rewrite = false;
                if (!front::$get['tag']) {
                    front::$get['tag'] = $post['tag'];
                }
                if (!front::$get['submit']) {
                    front::$get['submit'] = $post['submit'];
                }
                $otag=new tag();
                $condition = '';
                if (front::$get['tag'] != '') {
                    $condition = 'tagid=' . front::$get['tag'];
                }
                $tags = $otag->getrows($condition, 0);
                //var_dump($tags);
                $tags = $this->view->hottags = array_to_hashmap($tags,'tagid','tagname');


                if (config::getadmin('wap_tag_html')!='1' || !is_array($tags)) {
                    //if (config::getadmin('tag_html')==1) {
                    echo lang_admin('none_of_the_generated_HTML');
                    session::set("cahe_wap_make_tag", "");   //清空
                    exit;
                }
                $j = 0;

                foreach ($tags as $k => $v) {
                    $tagid = $k;
                    $tag = $v;
                    $pinyin = pinyin::get($tag);

                    $arctag = new arctag();
                    $archive_num = $arctag->rec_count('tagid=' . $tagid);

                    front::$record_count = $archive_num;
                    $pagesize = config::get('list_pagesize');
                    front::$pages = $pagesize;
                    $cpage = ceil($archive_num / $pagesize);

                    /* $html_prefix = ROOT . '/';
                     if (config::getadmin('html_prefix')) {
                         $html_prefix = ROOT . '/' . trim(config::getadmin('html_prefix'), '/') . '/';
                     }*/
                    for ($i = 1; $i <= $cpage; $i++) {
                        $path = tag::url($tag,$i);
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

                        /*   $path = $html_prefix . 'tags'.config::getadmin("staticlang").lang::getisadmin().'/' . $pinyin . config::getadmin("staticlang") . $tagid .config::getadmin("staticlang") . $i . '.html';
                     */      tool::mkdir(dirname($path));
                        echo  $path."<br>";
                        $data = file_get_contents(getSiteUrl() . '/index.php?case=tag&act=show&tag=' . urlencode($tag) . '&page=' . $i);
                        if (file_put_contents($path, $data)) {
                            $j++;
                        }
                    }
                }
                /*if (count($tags) > 0) {*/
                if ($j > 0) {
                    echo lang_admin('generate_html') . " <b>" . $j . "</b> " . lang_admin('npage') . "！";
                    //front::redirect(front::$from);
                } else {
                    echo lang_admin('none_of_the_generated_HTML');
                    //front::redirect(front::$from);
                }
                session::set("cahe_wap_make_tag", "");   //清空
                echo lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
                //最后恢复前台语言包
                lang::settistemplate($this->_langtemplate);
                lang::setisadmin($this->_langadmin);
                exit;
               /* $tagid = front::$get['tag'];
                $tag = $tags[$tagid];
                $pinyin = pinyin::get($tag);

                $arctag=new arctag();
                $archive_num=$arctag->rec_count('tagid='.$tagid);

                front::$record_count = $archive_num;
                $pagesize = config::get('list_pagesize');
                front::$pages = $pagesize;
                $cpage = ceil($archive_num/$pagesize);
                $j=0;
                for($i=1;$i<=$cpage;$i++){
                    $path = 'tags-wap/'.$pinyin.'-'.$tagid.'-'.$i.'.html';
                    tool::mkdir(dirname($path));
                    $url = config::get('site_url').'index.php?case=tag&act=show&t=wap&tag='.urlencode($tag).'&page='.$i;
                    //exit($url);
                    $data = file_get_contents($url);
                    if(file_put_contents($path, $data)){
                        $j++;
                    }
                }
                if ($j > 0){
                    front::flash(lang_admin('html_generated')." <b>$j</b> ".lang_admin('page')."！");
                    front::redirect(front::$from);
                }else{
                    front::flash(lang_admin('no_data_html_generated'));
                    front::redirect(front::$from);
                }*/
        }
        else if($submit){
            session::set("cahe_wap_make_tag",front::$post);
            front::$get['wap_config_cache']=0;
            front::redirect(modify("act/make_tag",true));
        }
        $tags = tag::getInstance()->getrows("", 0);
        $this->view->hottags = array_to_hashmap($tags, 'tagid', 'tagname');
    }

    //删除分类生成的静态页面
    static function delete_make_type_action(){
        front::$get['t'] = 'wap';
        front::$admin = false;
        front::$html = true;
        front::$rewrite = false;
        $where = 'langid = "' . lang::getlangid(lang::getisadmin()) . '"';
        $arrtype = type::getInstance()->getrows($where, 0);
        if (is_array($arrtype) && !empty($arrtype)) {
            foreach ($arrtype as $v) {
                $path = type::url($v['typeid'],1, lang::getisadmin());

                if (!preg_match('/\.[a-zA-Z]+$/', $path))
                    $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                $path = rtrim($path, '/');
                $path = rtrim($path, '\\');
                $path = str_replace('//', '/', $path);
                if (config::get('base_url') == '/') {
                    $path = ROOT . substr($path, 1);
                } else {
                    $path = ROOT . str_replace(config::get('base_url'), '', $path);
                }
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
    function make_type_action() {
    	chkpw('cache_type');
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("wap_config_cache")){
            front::$post['submit']=1;
            front::$post['typeid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');
        if(front::get("getshowstatic") && session::get("cahe_wap_make_type")) {
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  lang_admin("beigin_cache_not_refresh").'<br/>'; //开始生成
            echo '<style>*{line-height:180%;color:#fff;}</style>';
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();

            if (config::getadmin('wap_type_php')==2) {
                //最后恢复前台语言包
                lang::settistemplate($this->_langtemplate);
                lang::setisadmin($this->_langadmin);
                session::set("cahe_wap_make_type","");   //清空
                echo lang_admin('none_of_the_generated_HTML').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
                exit;
            }
            $post = session::get("cahe_wap_make_type");
            $case = 'type';
            $act = 'list';
            $_GET = array('case' => $case, 'act' => $act);
            //$front = new front();
            front::$admin = false;
            front::$html = true;
            front::$rewrite = false;
            front::$get['t'] = 'wap';
            $case = $case . '_act';
            $case = new $case();
            $case->init();
            //$method = $act . '_action';
            //$totalpage = 100;
            //$time_start = time::getTime();


            $type = type::getInstance();
            $typeid = $post['typeid'];
            $where = 'langid = "' . lang::getlangid(lang::getisadmin()) . '"';
            /*if ($typeid && !$type->getishtml($typeid)) {
                front::flash("该分类不需要生成html！");
                return;
            }*/
            if ($typeid) {
                $where .= ' and  typeid=' . $typeid;
                $arrtype = $type->getrows($where,0);
            } else {
                $arrtype = $type->getrows($where,0);
            }
            $cpage = 0;
            if (is_array($arrtype) && !empty($arrtype)) {
                foreach ($arrtype as $v) {
                    if (!$type::getwaparcishtml($v))  //如果分类设置不生成则跳过
                        continue;
                    if (!$type->getWapishtml($v['typeid']))
                        continue;
                    $archive_all = new archive();
                    $archive_num = $archive_all->rec_count('typeid=' . $v['typeid'] . ' and checked=1 and `state`=1');
                    for (front::$get['page'] = 1; ; front::$get['page']++) {
                        $view = $case->view;
                        $pagesize = config::get('list_pagesize');
                        $limit = ((front::$get['page'] - 1) * $pagesize) . ',' . $pagesize;
                        $archive = new archive();
                        $case->view->archives = $archive->getrows("typeid=" . $v['typeid'] . " and checked=1 and `state`=1", $limit, '`listorder` desc,aid desc');
                        $case->view->page = front::$get['page'];
                        $case->view->type = $v;
                        $case->view->typeid = $v['typeid'];
                        $case->view->pages = $v['ispages'];

                        foreach ($case->view->archives as $order => $arc) {
                            $articles = $arc;
                            if (!$arc['introduce'])
                                $arc['introduce'] = cut($arc['content'], 200);
                            $articles['url'] = archive::url($arc);
                            $articles['catname'] = category::name($arc['catid']);
                            $articles['caturl'] = category::url($arc['catid']);
                            $articles['sthumb'] = @strstr($arc['thumb'], "http://") ? $arc['thumb'] : config::get('base_url') . '/' . $arc['thumb'];
                            $articles['strgrade'] = archive::getgrade($arc['grade']);
                            $articles['adddate'] = sdate($arc['adddate']);
                            $articles['buyurl'] = url('archive/orders/aid/' . $arc['aid']);
                            $articles['stitle'] = strip_tags($arc['title']);
                            $case->view->archives[$order] = $articles;
                        }
                        if (!isset($page_count)) {
                            front::$record_count = $case->view->record_count = $archive_num;
                            $case->view->page_count = ceil($case->view->record_count / $pagesize);
                            $page_count = $case->view->page_count;
                        }

                        if (front::get('page') > 1 && front::get('page') > $case->view->page_count) {
                            $page_count = null;
                            break;
                        }
                        //$tpl = type::gettemplate($v['typeid']);
                        $tpl = type::gettemplate($v['typeid']);
                        //$tpl = 'wap/type_list.html';
                        $content = $case->fetch($tpl,true);
                        $path = type::url($v['typeid'], front::$get['page']);
                        //var_dump($path);exit;
                        if (!preg_match('/\.[a-zA-Z]+$/', $path))
                            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                        $path = rtrim($path, '/');
                        $path = rtrim($path, '\\');
                        $path = str_replace('//', '/', $path);
                        if (config::get('base_url') == '/') {
                            $path = ROOT . substr($path, 1);
                        } else {
                            $path = ROOT . str_replace(config::get('base_url'), '', $path);
                        }
                        //exit($path);
                        tool::mkdir(dirname($path));
                        //var_dump($path);
                        //var_dump($content);
                        if (!file_put_contents($path, $content)) {
                            echo lang_admin('failed_to_write_to_HTML')."<br/>";
                           /* front::flash(lang_admin('failed_to_write_to_HTML'));*/
                        }
                        $indexpath = dirname($path) . '/index.html';
                        echo  $indexpath."<br/>";
                        if (front::$get['page'] == 1 && $indexpath != ROOT . '/index.html') {
                            file_put_contents($indexpath, $content);
                        }
                        $cpage++;
                        $case->view = $view;
                    }
                }
            }
           /* if ($cpage > 0)
                front::flash(lang_admin('html_generated') . " <b>$cpage</b> " . lang_admin('page') . "！");
            else
                front::flash(lang_admin('no_html_generated'));*/
            if ($cpage > 0)
                echo lang_admin('html_generated') . " <b>$cpage</b> " . lang_admin('page') . "！";
            else
                echo  lang_admin('no_html_generated');
            front::$admin = true;
            session::set("cahe_wap_make_type","");   //清空
            echo lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
            exit;
        }
        else if($submit){
            session::set("cahe_wap_make_type",front::$post);
            front::$get['wap_config_cache']=0;
            front::redirect(modify("act/make_type",true));
        }
    }

    //删除栏目生成的静态页面
    static function delete_make_list_action(){
        front::$get['t'] = 'wap';
        front::$admin = false;
        front::$html = true;
        front::$ismobile = true;
        front::$rewrite = false;
        $category = category::getInstance();
        $category->init();  //重新初始化一下
        $categories = $category->sons(0);
        $categories[] = 0;
        foreach ($categories as $catid) {
            $path = ROOT . category::url($catid, front::$get['page'] > 1 ? front::$get['page'] : null, true);
            if (!preg_match('/\.[a-zA-Z]+$/', $path))
                $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
            $path = rtrim($path, '/');
            $path = rtrim($path, '\\');
            $path = str_replace('//', '/', $path);

            if(file_exists($path)){
                unlink($path);
                // echo  $path."删除成功！<br/>";
            }
            $indexpath = dirname($path) . '/index.html';
            if ($indexpath != ROOT . '/index.html') {
                if(file_exists($indexpath)){
                    unlink($indexpath);
                    // echo  $indexpath."删除成功！<br/>";
                }
            }
        }
    }
    function make_list_action() {
    	$servip = gethostbyname($_SERVER['SERVER_NAME']);
    	if($servip!=front::ip()&&front::get('ishtml')==1){
    		chkpw('cache_category');
    	}
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        //是否修改配置 跳到生成
        if (front::get("wap_config_cache")){
            front::$post['submit']=1;
            front::$post['catid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');

        if(front::get("getshowstatic") && session::get("cahe_wap_make_list")) {
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  lang_admin("beigin_cache_not_refresh").'<br/>'; //开始生成
            echo '<style>*{line-height:180%;color:#fff;}</style>';
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();

            $post = session::get("cahe_wap_make_list");
            $case = 'archive';
            $act = 'list';
            $_GET = array('case' => $case, 'act' => $act);
            //$front = new front();
            front::$admin = false;
            front::$html = true;
            front::$rewrite = false;
            front::$ismobile = true;
            front::$get['t'] = 'wap';
            $case = $case . '_act';
            $case = new $case();
            $case->init();
            $method = $act . '_action';
            $totalpage = 100;
            $time_start = time::getTime();
            $category = category::getInstance();
            $categories = $category->sons($post['catid']);
            $categories[] = $post['catid'];
            $cpage = 0;
            $archive_all = new archive();
            foreach ($categories as $key => $catid) {
                $new_categories = $category->sons($catid);
                $new_categories[] = $catid;
                $archive_num[$catid] = $archive_all->rec_count('catid in(' . implode(',', $new_categories) . ') and checked=1 and `state`=1');
            }
            $i = 0;
            foreach ($categories as $catid) {
                if ($catid == 0)
                    continue;
                if (!category::getiswaphtml($catid))
                    continue;
                front::$get['catid'] = $catid;
                $case->view->categories = category::getpositionlink2($catid);
                $_categories = $category->sons($catid);
                $_categories[] = $catid;
                $case->view->ifson = category::hasson($catid);
                for (front::$get['page'] = 1; ; front::$get['page']++) {
                    $view = $case->view;
                    $_catpage = category::categorypages($catid);
                    if ($_catpage) {
                        $pagesize = $_catpage;
                    } else {
                        $pagesize = config::get('list_pagesize');
                    }
                    $limit = ((front::$get['page'] - 1) * $pagesize) . ',' . $pagesize;
                    $archive = new archive();
                    $tops = array();
                    $tops = $archive->getrows("checked=1 AND (state IS NULL or state<>'-1') AND toppost!=0", 0, 'toppost DESC,listorder=0,listorder ASC,aid DESC');
                    if (@$category->category[$catid]['includecatarchives']) {
                        $case->view->archives = $archive->getrows('catid in(' . implode(',', $_categories) . ') and checked=1 and (state IS NULL or state<>\'-1\')', $limit, 'listorder=0,`listorder` asc,`aid` DESC');
                    } else {
                        $case->view->archives = $archive->getrows("catid=$catid and checked=1 and (state IS NULL or state<>'-1')", $limit, 'listorder=0,`listorder` asc,`aid` DESC');
                    }
                    $case->view->page = front::$get['page'];

                    if (is_array($tops) && !empty($tops)) {
                        foreach ($tops as $order => $arc) {
                            if ($arc['toppost'] == 3) {
                                $tops[$order]['title'] = "[" . lang_admin('set_the_top_of_the_whole_station') . "]" . $arc['title'];
                            }
                            if ($arc['toppost'] == 2) {
                                $subcatids = $category->sons($arc['catid']);
                                if ($arc['catid'] != front::get('catid') && !in_array(front::get('catid'), $subcatids)) {
                                    unset($tops[$order]);
                                } else {
                                    $tops[$order]['title'] = "[" . lang_admin('column_top') . "]" . $arc['title'];
                                }
                            }
                        }
                        $case->view->archives = array_merge($tops, $case->view->archives);
                    }

                    foreach ($case->view->archives as $order => $arc) {
                        $articles = $arc;
                        if (!$arc['introduce'])
                            $arc['introduce'] = cut($arc['content'], 200);
                        $articles['url'] = archive::url($arc);
                        $articles['catname'] = category::name($arc['catid']);
                        $articles['caturl'] = category::url($arc['catid']);
                        $articles['image'] = @strstr($arc['image'], "http://") ? $arc['image'] : config::get('base_url') . '/' . $arc['image'];
                        $articles['strgrade'] = archive::getgrade($arc['grade']);
                        $articles['adddate'] = sdate($arc['adddate']);
                        $articles['buyurl'] = url('archive/orders/aid/' . $arc['aid']);
                        $articles['stitle'] = strip_tags($arc['title']);
                        if (strtolower(substr($arc['thumb'], 0, 7)) == 'http://') {
                            $articles['sthumb'] = $arc['thumb'];
                        } else {
                            $articles['sthumb'] = config::get('base_url') . '/' . $arc['thumb'];
                        }

                        if ($arc['strong']) {
                            $articles['title'] = '<strong>' . $arc['title'] . '</strong>';
                        }
                        if ($arc['color']) {
                            $articles['title'] = '<font style="color:' . $arc['color'] . ';">' . $articles['title'] . '</font>';
                        }

                        $case->view->archives[$order] = $articles;
                    }

                    if (!isset($page_count)) {
                        front::$record_count = $case->view->record_count = $archive_num[$catid];
                        $case->view->page_count = ceil($case->view->record_count / $pagesize);
                        $page_count = $case->view->page_count;
                    }

                    $case->view->catid = $catid;
                    $case->view->topid = category::gettopparent($catid);
                    $case->view->parentid = $category->getparent($catid);
                    $case->view->pages = @$category->category[$catid]['ispages'];
                    $case->view->subids = $category->son($catid);
                    //var_dump($case->view->subids);exit;
                    if (front::get('page') > 1 && front::get('page') > $case->view->page_count) {
                        $page_count = null;
                        break;
                    }
                    if (front::get('page') > 1 && !@$category->category[$catid]['ispages']) {
                        $page_count = null;
                        break;
                    }
                    $template = @$category->category[$catid]['templatewap'];

                    if ($template && ((file_exists(TEMPLATE . '/' . $case->view->_style . '/' . $template))
                            || (file_exists(TEMPLATE . '/' . config::get('template_shopping_dir') . '/' . $template))) ){
                        $tpl = $template;
                    }
                    else
                        $tpl = category::gettemplatewap($case->view->catid);

                    //判断是否是商城栏目
                    if(category::isshopping($case->view->catid)){
                        $tpl = config::get('template_shopping_dir') . '/' . $tpl;
                    }

                    $content = $case->fetch($tpl,true);
                    //重新获取一下栏目
                    $category->init();
                    $path = ROOT . category::url($catid, front::$get['page'] > 1 ? front::$get['page'] : null, true);
                    //echo $path;exit;
                    if (!preg_match('/\.[a-zA-Z]+$/', $path))
                        $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                    $path = rtrim($path, '/');
                    $path = rtrim($path, '\\');
                    $path = str_replace('//', '/', $path);
                    tool::mkdir(dirname($path));
                    file_put_contents($path, $content);
                    $indexpath = dirname($path) . '/index.html';
                    if (front::$get['page'] == 1 && $indexpath != ROOT . '/index.html') {
                        file_put_contents($indexpath, $content);
                        echo  $indexpath."<br/>";
                        $cpage++;
                    }
                    $cpage++;
                    $case->view = $view;
                    $case->view->archives = null;
                }
                $i++;
            }
          /*  if ($cpage > 0)
                front::flash(lang_admin('html_generated') . "<b>$cpage</b> " . lang_admin('page') . "！");
            else
                front::flash(lang_admin('no_html_generated'));*/
            if ($cpage > 0)
                echo lang_admin('html_generated') . " <b>$cpage</b> " . lang_admin('page') . "！";
            else
                echo lang_admin('no_html_generated');
            front::$admin = true;
            front::$isadmin = true;
            session::set("cahe_wap_make_list","");   //清空
            echo lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);
            exit;
        } else if($submit){
            session::set("cahe_wap_make_list",front::$post);
            front::$get['wap_config_cache']=0;
            front::redirect(modify("act/make_list",true));
        }
    }

    function make_sitemap_action() {
        chkpw('cache_google');
    }

    function make_sitemap_baidu_action() {
        chkpw('cache_baidu');
    }
    
    function make_sitemap_google_action() {
    	chkpw('cache_baidu');
    }

    function make_baidu_action() {
        $limit = front::$post['XmlOutNum'];
        $p = front::$post['XmlMaxPerPage'];
        if (!$p)
            $p = 100;
        $frequency = front::$post['frequency'];
        $this->archive = new archive();
        $articles = $this->archive->getrows('', $limit);
        $site_url = config::get('site_url');
        $email = config::get('email');
        $head = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
        $head .= '<urlset>' . "\r\n";
        //$head .= "<webSite>{$site_url}</webSite>\r\n";
        //$head .= "<webMaster>{$email}</webMaster>\r\n";
        //$head .= "<updatePeri>{$frequency}</updatePeri>\r\n";
        $foot = "</urlset>";
        $code = '';
        $i = 1;
        $j = 1;
        if (is_array($articles) && !empty($articles)) {
        	
        	foreach ($articles as $arr) {
        		$url = substr($site_url,0,-1).archive::url($arr);
        		$adddate = date("Y-m-d",strtotime($arr['adddate']));
        		$code .= "<url><loc>{$url}</loc><lastmod>{$adddate}</lastmod></url>\r\n";
        	}
        	file_put_contents("sitemaps_baidu.xml", $head . $code . $foot);
            /*foreach ($articles as $arr) {
            	$url = substr($site_url,0,-1).archive::url($arr);
                $text = mb_substr(strip_tags($arr['content']), 0, 588,'UTF-8');
                $code .= "<item>\r\n<title><![CDATA[{$arr['title']}]]></title>\r\n<link><![CDATA[{$url}]]></link>\r\n<text><![CDATA[{$text}]]></text>\r\n";
                $code .= "<image/>\r\n";
                if ($arr['keyword'] != '') {
                    $code .= "<keywords>{$arr['keyword']}</keywords>\r\n";
                } else {
                    $code .= "<keywords/>\r\n";
                }
                $code .= "<author>{$arr['author']}</author>\r\n";
                $code .= "<source>互联网</source>\r\n";
                $code .= "<pubDate>{$arr['adddate']}</pubDate>\r\n</item>\r\n";
                if ($i % $p == 0) {
                    file_put_contents("baidumap_article_$j.xml", $head . $code . $foot);
                    $j++;
                }
                $i++;
            }
            file_put_contents("baidumap_article_$j.xml", $head . $code . $foot);*/
        }
        echo '<script>alert("'.lang_admin('generate').lang_admin('complete').'");gotoinurl("index.php?case=cache&act=make_sitemap_baidu&admin_dir='.config::get('admin_dir').'");</script>';
        exit;
    }
    
    function make_google_action() {
    	$limit = front::$post['XmlOutNum'];
    	$p = front::$post['XmlMaxPerPage'];
    	if (!$p)
    		$p = 100;
    	$frequency = front::$post['frequency'];
    	$this->archive = new archive();
    	$articles = $this->archive->getrows('', $limit);
    	$site_url = config::get('site_url');
    	$email = config::get('email');
    	$head = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
    	$head .= "<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">\r\n";
    	$foot = "</urlset>";
    	$code = '';
    	$i = 1;
    	$j = 1;
    	if (is_array($articles) && !empty($articles)) {
    		//var_dump($articles);
    		foreach ($articles as $arr) {
    			$url = substr($site_url,0,-1).archive::url($arr);
    			$adddate = date("Y-m-d\TH:i:s+00:00",strtotime($arr['adddate']));
    			$code .= "<url><loc>{$url}</loc><lastmod>{$adddate}</lastmod></url>\r\n";
    			//echo $url;
    			/*$text = mb_substr(strip_tags($arr['content']), 0, 588,'UTF-8');
    			$code .= "<item>\r\n<title><![CDATA[{$arr['title']}]]></title>\r\n<link><![CDATA[{$url}]]></link>\r\n<text><![CDATA[{$text}]]></text>\r\n";
    			$code .= "<image/>\r\n";
    			if ($arr['keyword'] != '') {
    				$code .= "<keywords>{$arr['keyword']}</keywords>\r\n";
    			} else {
    				$code .= "<keywords/>\r\n";
    			}
    			$code .= "<author>{$arr['author']}</author>\r\n";
    			$code .= "<source>互联网</source>\r\n";
    			$code .= "<pubDate>{$arr['adddate']}</pubDate>\r\n</item>\r\n";
    			if ($i % $p == 0) {
    				file_put_contents("baidumap_article_$j.xml", $head . $code . $foot);
    				$j++;
    			}
    			$i++;*/
    		}
    		file_put_contents("sitemaps.xml", $head . $code . $foot);
    	}
    	echo '<script>alert("'.lang_admin('generate').lang_admin('complete').'!");gotoinurl("index.php?case=cache&act=make_sitemap_google&admin_dir='.config::get('admin_dir').'");</script>';
    	exit;
    }

    //删除内容生成的静态页面
    static function delete_make_show_action(){
        front::$get['t'] = 'wap';
        front::$admin = false;
        front::$html = true;
        front::$ismobile = true;
        front::$rewrite = false;
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
    function make_show_action() {
        if($this->_make_show_head) {
            header('Cache-control: private, must-revalidate');
        }
        ignore_user_abort();
        @set_time_limit(0);
        chkpw('cache_content');
        if (front::get("wap_config_cache")){
            front::$post['submit']=1;
            front::$post['catid']=0;
        }
        $submit = front::post('submit') ? front::post('submit') : front::get('submit');

        if(front::get("getshowstatic") && session::get("cahe_wap_make_show"))
        {
            ob_end_clean(); // 清除并关闭缓冲，输出到浏览器之前使用这个函数。
            ob_implicit_flush(1); //控制隐式缓冲泻出，默认off，打开时，对每个 print/echo 或者输出命令的结果都发送到浏览器。
            echo  lang_admin("beigin_cache_not_refresh").'<br/>'; //开始生成
            $post = session::get("cahe_wap_make_show") + front::$get;
            echo '<script type="text/javascript">setInterval(function(){window.scrollTo(0,document.body.scrollHeight);},300);</script>';
            echo '<style>*{line-height:180%;color:#fff;}</style>';
            lang::settistemplate($this->_langadmin); //前台语言改为后台的
            lang::$langadmindata=null;
            templatetag::$setting=array();

            unset($post['submit']);
            $c_url = preg_replace('#&make_page=(\d+)#', '', $_SERVER['QUERY_STRING']);
            $c_url = preg_replace('#&aid_start=(\d+)#', '', $c_url);
            $c_url = preg_replace('#&aid_end=(\d+)#', '', $c_url);
            $c_url = preg_replace('#&catid=(\d+)#', '', $c_url);
            $c_url = preg_replace('#&submit=(\d+)#', '', $c_url);
            $c_url = 'index.php?' . $c_url;
            $c_url.='&submit=1';
            if ($post['aid_start']) {
                $aid_start = $post['aid_start'];
                $aid_end = $post['aid_end'];
                $where = "aid>=$aid_start and aid<=$aid_end AND (ishtml IS NULL OR ishtml!=2)";
                $c_url.='&aid_start=' . $aid_start . '&aid_end=' . $aid_end;
            } elseif (isset($post['catid'])) {
                $catid = $post['catid'];
                $category = category::getInstance();
                $categories = $category->sons($catid);
                $categories[] = $catid;
                $categories = implode(',', $categories);
                $where = "catid in(" . $categories . ') and checked=1 AND (ishtml IS NULL OR ishtml!=2)';
                $c_url.='&catid=' . $catid;
            }else{
                return;
            }
            $case = 'archive';
            $act = 'show';
            $_GET = array('case' => $case, 'act' => $act);
            //$front = new front();
            front::$admin = false;
            front::$html = true;
            front::$ismobile = true;
            front::$rewrite = false;
            front::$get['t'] = 'wap';
            $case = $case . '_act';
            $case = new $case();
            $case->init();
            $method = $act . '_action';
            $category = category::getInstance();
            $time_start = time::getTime();
            $archive = new archive();
            if (config::get('group_on')) {
                $make_page = $post['make_page'] == '' ? 1 : $post['make_page'];
                $archive->getrows($where);
                $archive_num = $archive->record_count;
                $group_count = config::get('group_count');
                $make_page_num = ceil($archive_num / $group_count);
                $totalpage = (($make_page - 1) * $group_count) . ',' . $group_count;
                $c_url.='&make_page=' . ($make_page + 1);
                $post["make_page"]=($make_page + 1);
                session::set("cahe_wap_make_show",$post);   //修改
            } else {
                $totalpage = "";
            }


            $archives = $archive->getrows($where, $totalpage, '1');
            //var_dump($archives);
            $cpage = 0;

            foreach ($archives as $arc) {
                if (!category::getarciswaphtml($arc))
                    continue;
                front::$get['aid'] = $arc['aid'];
                $case->view->archive = $arc;
                $case->view->aid = $arc['aid'];
                $case->view->catid = $arc['catid'];
                $case->view->catid = $case->view->catid;
                $case->view->topid = category::gettopparent($case->view->catid);
                $case->view->parentid = $category->getparent($case->view->catid);
                $template = @$arc['templatewap'];
                //echo $template;exit;
                $content = $arc['content'];
                $case->view->categories = category::getpositionlink2($case->view->catid);
                $linkword = new linkword();
                $linkwords = $linkword->getrows(null, 1000, 'linkorder desc');
                foreach ($linkwords as $linkword) {
                    if (trim($linkword['linkurl']) && !preg_match('%^http://$%', trim($linkword['linkurl']))) {
                        $linkword['linktimes'] = (int) $linkword['linktimes'];
                        $link = "<a href='$linkword[linkurl]' target='_blank'>$linkword[linkword]</a>";
                    } else {
                        $link = "<a href='" . url('archive/search/keyword/' . urlencode($linkword['linkword'])) . "' target='_blank'>$linkword[linkword]</a>";
                    }
                    if (isset($link)) {
                        $content = preg_replace("%(?!\"]*>)$linkword[linkword](?!\s*\")%i", "\\1$link\\2", $content, $linkword['linktimes']);
                        /* $content=preg_replace("%(?!\"]*>alt=\")(<a.*?>)(\"?!\s*\")%i","\\1\\2",$content,$linkword['linktimes']); */
                    }
                    unset($link);
                }

                $case->view->likenews = $case->getLike($case->view->archive['tag'], $case->view->archive['keyword']);

                $contents = preg_split('%<div style="page-break-after(.*?)</div>%si', $content);
                if (!empty($contents)) {
                    $case->view->pages = count($contents);
                    front::$record_count = $case->view->pages * config::get('list_pagesize');
                    $case->view->pages = count($contents);
                } else {
                    $case->view->pages = 1;
                }
                $taghtml = '';
                $tag_table = new tag();
                foreach ($tag_table->urls($case->view->archive['tag']) as $tag => $url) {
                    $taghtml.="<a href='$url' target='_blank'>$tag</a>&nbsp;&nbsp;";
                }
                $case->view->archive['tag'] = $taghtml;
                $case->view->archive['special'] = null;
                if ($case->view->archive['spid']) {
                    $spurl = special::url($case->view->archive['spid'],special::getishtml($case->view->archive['spid']));
                    $sptitle = special::gettitle($case->view->archive['spid']);
                    $case->view->archive['special'] = "<a href='$spurl' target='_blank'>$sptitle</a>&nbsp;&nbsp;";
                }
                $case->view->archive['type'] = null;
                if ($case->view->archive['typeid']) {
                    $typeurl = type::url($case->view->archive['typeid'],1);
                    $typetitle = type::name($case->view->archive['typeid']);
                    $case->view->archive['type'] = "<a href='$typeurl' target='_blank'>$typetitle</a>&nbsp;&nbsp;";
                }
                $arc = $case->view->archive;
                for ($c = 1; $c <= $case->view->pages; $c++) {
                    front::$get['page'] = $c;
                    $case->view->page = $c;
                    if (!empty($contents)) {
                        $content = $contents[$c - 1];
                    }
                    $arc['content'] = $content;
                    $aid = $arc['aid'];
                    $catid = $arc['catid'];
                    $sql1 = "SELECT * FROM `{$archive->name}` WHERE catid = '$catid' AND aid > '$aid' ORDER BY aid ASC LIMIT 0,1";
                    $sql2 = "SELECT * FROM `{$archive->name}` WHERE catid = '$catid' AND aid < '$aid' ORDER BY aid DESC LIMIT 0,1";
                    $n = $archive->rec_query_one($sql1);
                    $p = $archive->rec_query_one($sql2);
                    $arc['p'] = $p;
                    $arc['n'] = $n;
                    $arc['p']['url'] = archive::url($p);
                    $arc['n']['url'] = archive::url($n);
                    $arc['strgrade'] = archive::getgrade($arc['grade']);
                    $arc['pics'] = unserialize($arc['pics']);

                    /*if(is_array($arc['pics']) && !empty($arc['pics'])){
                        foreach ($arc['pics'] as $k => $v){
                            if(strtolower(substr($v,0,7)) == 'http://'){
                                $arc['pics'][$k] = $v;
                            }else{
                                $arc['pics'][$k] = $v;
                            }
                        }
                    }*/
                    //$arc['pics'] = serialize($arc['pics']);
                    $case->view->archive['pics'] = serialize($case->view->archive['pics']);
                    $case->view->archive = $arc;
                    //var_dump($template);
                    if ($template && (file_exists(TEMPLATE . '/' . $case->view->_style . '/' . $template)
                            || file_exists(TEMPLATE . '/' . $template)
                            || file_exists(TEMPLATE . '/' . config::get('template_shopping_dir') . '/' . $template)) )
                        $tpl = $template;
                    else
                        $tpl = category::gettemplatewap($case->view->catid, 'showtemplatewap');

                    //判断是否是商城栏目
                    if(category::isshopping($case->view->catid)){
                        $tpl=config::get('template_shopping_dir').'/'.$tpl;
                    }
                    //var_dump($tpl);exit;
                    $content = $case->fetch($tpl,true);

                    $path = ROOT . archive::url($arc, front::$get['page'] > 1 ? front::$get['page'] : null, true);
                    if (!preg_match('/\.[a-zA-Z]+$/', $path))
                        $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                    $path = rtrim($path, '/');
                    $path = rtrim($path, '\\');
                    $path = str_replace('//', '/', $path);
                    tool::mkdir(dirname($path));
                    file_put_contents($path, $content);
                    echo  $path."<br/>";
                    $cpage++;
                    if ($case->view->pages > 1 && $c == 1) {
                        $path = ROOT . archive::url($arc, 1, true);
                        if (!preg_match('/\.[a-zA-Z]+$/', $path))
                            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                        $path = rtrim($path, '/');
                        $path = rtrim($path, '\\');
                        $path = str_replace('//', '/', $path);
                        tool::mkdir(dirname($path));
                        file_put_contents($path, $content);
                        $cpage++;
                    }
                }
            }
            $totalpage = count($archives);
            if (!isset($archives[0]))
                $totalpage = 0;
            if ($make_page >= $make_page_num) {
                $show_msg = lang_admin('this_group_generates_html')." <b>{$cpage}</b> ".lang_admin('page').
                    "！ ".lang_admin('the_generation_of_html_is_complete_and_this_time_it_is_generated_together')." <b>{$archive_num}</b> ".lang_admin('page').
                    "！".lang_admin('automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page')."！\n";
                $c_url = preg_replace('#&make_page=(\d+)#', '', $_SERVER['QUERY_STRING']);
                $c_url = preg_replace('#&aid_start=(\d+)#', '', $c_url);
                $c_url = preg_replace('#&aid_end=(\d+)#', '', $c_url);
                $c_url = preg_replace('#&catid=(\d+)#', '', $c_url);
                $c_url = preg_replace('#&submit=(\d+)#', '', $c_url);
                $c_url = 'index.php?' . $c_url;
            } else {
                $show_msg = lang_admin('lang_No')."<b>{$make_page}</b> ".lang_admin('lang_group').lang_admin('html_generated').
                    " <b>{$cpage}</b> ".lang_admin('page')."！ ".lang_admin('total_needs_to_be_generated')." <b>{$archive_num}</b> ".lang_admin('page').
                    "！ ".lang_admin('has_been_generated')." <b>" . ($make_page * $group_count) . "</b> ".lang_admin('page')."！ ".lang_admin('automatically_jump_into_the_next_group_generation_after_2_seconds')."！\n";
            }
        /*    $getnexturl = "<script>";
            $getnexturl.="var t=4;\n";
            $getnexturl.="setInterval('testTime()',1000);\n";
            $getnexturl.="function testTime() \n";
            $getnexturl.=" { \n";
            $getnexturl.="if(t == 0) location = '" . $c_url . "'; \n";
            $getnexturl.=" t--;\n";
            $getnexturl.="}\n</script> \n";*/
            if ($cpage > 0) {
                if (!config::get('group_on')) {
                    /*front::flash(lang_admin('html_generated')." <b>{$cpage}</b> ".lang_admin('page')."！ ".lang_admin('automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page')."！\n" . $getnexturl);*/
                    echo  lang_admin('generate_html') . " <b>{$cpage}</b> " . lang_admin('npage') . "！" . lang_admin('when_used') . time::getTime() . "！\n";
                } else {
                   /* front::flash($show_msg . "\n" . $getnexturl);*/
                    echo  $show_msg. "\n";
                    //最后恢复前台语言包
                    lang::settistemplate($this->_langtemplate);
                    lang::setisadmin($this->_langadmin);
                    $this->_make_show_head=false;
                    $this->make_show_action();
                }
            } else {
               /* front::flash(lang_admin('no_need_generate_html_maybe_column_selected_no_content_or_website_not_turn_content_generation'));*/
                echo   lang_admin('no_need_generate_html_maybe_column_selected_no_content_or_website_not_turn_content_generation')."\n";
            }
            front::$admin = true;
            front::$post = $post;
            session::set("cahe_wap_make_show","");   //清空
            unset($archive);
            unset($archives);
            //最后恢复前台语言包
            lang::settistemplate($this->_langtemplate);
            lang::setisadmin($this->_langadmin);

            echo lang_admin('cache_end').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page");
            exit;
        }
        else if($submit){
            session::set("cahe_wap_make_show",front::$post);
            front::$get['wap_config_cache']=0;
            front::redirect(modify("act/make_show",true));
        }


    }

    function end() {
        front::$html = false;
        front::$admin = true;
        $this->render();
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
