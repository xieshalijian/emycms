<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class cache_make
{

    public static $me;
    public static $showform;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new cache_make();
            self::$me = $class;
        }
        return self::$me;
    }

    function json_info($code, $msg)
    {
        echo json_encode(array('code' => $code, 'msg' => $msg));
    }

    //栏目页面生成  $_catid栏目id   $state是否静态
    public static function get_make_list($_catid,$state=true,$is_message=false){
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        if (!$state && !$cache_make_open){
            return "";
        }
        $case = 'archive';
        $act = 'list';
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
        $totalpage = 100;
        $time_start = time::getTime();
        $category = category::getInstance();
        $category->init();  //重新初始化一下
        $categories = $category->langsons($_catid);
        if ($_catid!=0)
        $categories[] = $_catid;
        $cpage = 0;
        $archive_all = new archive();
        foreach ($categories as $key => $catid) {
            $new_categories = $category->langsons($catid);
            $new_categories[] = $catid;
            $archive_num[$catid] = $archive_all->rec_count('catid in(' . implode(',', $new_categories) . ') and checked=1 and `state`=1' . ' and langid = "' . lang::getlangid(lang::getisadmin()) . '"');
        }
        $i = 0;
        foreach ($categories as $catid) {
            if ($catid == 0)
                continue;
            if (!category::getishtml($catid) && $state) {
                continue;
            }
            /*   $ishtmldata=$category->getrow('catid='.$catid);
               if ($ishtmldata['ishtml']!=1) {
                   continue;
               }*/
            if ($category->category[$catid]['linkto']) {
                continue;
            }
            front::$get['catid'] = $catid;
            $case->view->categories = category::getpositionlink2($catid);
            $_categories = $category->langsons($catid);
            $_categories[] = $catid;
            $case->view->ifson = category::hasson($catid);
            for (front::$get['page'] = 1; ; front::$get['page']++) {

                $view = $case->view;

                //静态生成  判断动态的php缓存是否存在  存在的话  直接使用动态的php文件
                $cache_path = category::url($catid, front::$get['page'] > 1 ? front::$get['page'] : null,
                    lang::getisadmin(),false);
                $cache_path = category::url_rule($cache_path);
                $cache_path=str_replace('.html','.php',$cache_path);
                if (file_exists($cache_path) && $state) {
                    //头部尾部重新解析
                    $content=$case->view->compile_public(file_get_contents($cache_path),true);
                    file_put_contents($cache_path, $content);

                    $content=$case->view->_eval($cache_path,true);
                    $path = category::url($catid, front::$get['page'] > 1 ? front::$get['page'] : null,
                        lang::getisadmin(),$state);
                    $path = category::url_rule($path);
                    file_put_contents($path, $content);
                    echo str_pad(str_ireplace(ROOT . '/', '', $path) . "<br/>", 1024 * 128);
                    $indexpath = dirname($path) . '/index.html';
                    if (!$state){
                        $indexpath=str_replace('.html','.php',$indexpath);
                    }
                    if (front::$get['page'] == 1 && $indexpath != ROOT . '/index.html') {
                        echo str_pad(str_ireplace(ROOT . '/', '', $indexpath) . "<br/>", 1024 * 128);
                        file_put_contents($indexpath, $content);
                        $cpage++;
                    }
                 }
                 else{
                    $_catpage = category::categorypages($catid);
                    if ($_catpage) {
                        $pagesize = $_catpage;
                    } else {
                        $pagesize = config::get('list_pagesize');
                    }
                    $limit = ((front::$get['page'] - 1) * $pagesize) . ',' . $pagesize;

                    $archive = new archive();
                    $tops = array();
                    $categorysdata = category::getInstance()->getrows($catid, 1);
                    if ($categorysdata[0]['contentrank'] != '') {
                        $order = $categorysdata[0]['contentrank'];
                    } else {
                        $order = "listorder=0,`listorder` asc,`adddate` DESC";
                    }
                    $tops = $archive->getrows("checked=1 AND (state IS NULL or state<>'-1') AND toppost!=0" . ' and langid = "' . lang::getlangid(lang::getisadmin()) . '"', 0, $order);

                    if (@$category->category[$catid]['includecatarchives']) {
                        $case->view->archives = $archive->getrows('catid in(' . implode(',', $_categories) . ') and checked=1 and (state IS NULL or state<>\'-1\')' . ' and langid = "' . lang::getlangid(lang::getisadmin()) . '"', $limit, $order);
                    } else {
                        $case->view->archives = $archive->getrows("catid=$catid and checked=1 and (state IS NULL or state<>'-1')" . ' and langid = "' . lang::getlangid(lang::getisadmin()) . '"', $limit, $order);
                    }
                    $case->view->page = front::$get['page'];

                    if (is_array($tops) && !empty($tops)) {
                        foreach ($tops as $order => $arc) {
                            if ($arc['toppost'] == 3) {
                                $tops[$order]['title'] = "[" . lang_admin('the_total_top') . "]" . $arc['title'];
                            }
                            if ($arc['toppost'] == 2) {
                                $subcatids = $category->langsons($arc['catid']);
                                if ($arc['catid'] != front::get('catid') && !in_array(front::get('catid'), $subcatids)) {
                                    unset($tops[$order]);
                                } else {
                                    $tops[$order]['title'] = "[" . lang_admin('the_column_top') . "]" . $arc['title'];
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

                        $pics = unserialize($arc['pics']);
                        if (is_array($pics) && !empty($pics)) {
                            $articles['pics'] = $pics;
                        }

                        $newcname='attr2_'.lang::getistemplate();
                        $attr2=json_decode($arc['attr2'],true);
                        $arc['attr2']=is_array($attr2)?$attr2[$newcname]:$arc['attr2'];

                        $prices = getPrices($arc['attr2']);
                        $articles['attr2'] = $prices['price'];
                        $articles['oldprice'] = $prices['oldprice'];

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
                    if (front::get('page') > 1 && front::get('page') > $case->view->page_count) {
                        $page_count = null;
                        break;
                    }
                    if (front::get('page') > 1 && !@$category->category[$catid]['ispages']) {
                        $page_count = null;
                        break;
                    }

                    $template = $categorysdata[0]['template'];

                    if ($template && ((file_exists(TEMPLATE . '/' . $case->view->_style . '/' . $template))
                            || (file_exists(TEMPLATE . '/' . config::get('template_shopping_dir') . '/' . $template))) ){
                        $tpl = $template;
                    } else{
                        $tpl = category::gettemplate($case->view->catid,"listtemplate",true,$case->view->_style);
                    }
                    //判断是否是商城栏目
                    if(category::isshopping($case->view->catid)){
                        $tpl = config::get('template_shopping_dir') . '/' . $tpl;
                    }
                    if (!rank::catget($case->view->catid,user::getuserid()))
                        $tpl='message/error.html';

                     if ($state){
                         $content=$case->fetch($tpl,true);
                     }else{
                         $content=$case->fetch($tpl,true,false,true);
                     }
                    //重新获取一下栏目
                    $category->init();
                    $path = category::url($catid, front::$get['page'] > 1 ? front::$get['page'] : null,
                        lang::getisadmin(),$state);

                    $path = category::url_rule($path);
                    if (!$state){
                        $path=str_replace('.html','.php',$path);
                    }
                    tool::mkdir(dirname($path));

                    if ($state || $is_message) {
                        echo str_pad(str_ireplace(ROOT . '/', '', $path) . "<br/>", 1024 * 128);
                    }
                    file_put_contents($path, $content);
                    if ($state){
                        $indexpath = dirname($path) . '/index.html';
                        if (!$state){
                            $indexpath=str_replace('.html','.php',$indexpath);
                        }
                        if (front::$get['page'] == 1 && $indexpath != ROOT . '/index.html') {
                            if ($state  || $is_message) {
                                echo str_pad(str_ireplace(ROOT . '/', '', $indexpath) . "<br/>", 1024 * 128);
                            }
                            file_put_contents($indexpath, $content);
                            $cpage++;
                        }
                    }
                }
                $cpage++;
                $case->view = $view;
                $case->view->archives = null;
            }
            $i++;
        }
        /* }

        }
        config::modify(array('lang_admin_type' => $oldadminlang));*/
        if ($state || $is_message){
            if ($cpage > 0)
                echo str_pad(lang_admin('generate_html') . " <b>$cpage</b> " . lang_admin('npage') . "！",1024*128);
            else
                echo str_pad(lang_admin('none_of_the_generated_HTML'),1024*128);
        }
        front::$admin = true;
        front::$isadmin = true;

        //更新栏目同时更新导航
        if (!$state){
            cache_make::get_make_top($_catid);
        }
    }

    //内容页面生成  $_catid栏目id   $state是否静态  和 静态生成区分开来的方法  所以默认缓存  ,$is_message  php缓存生成的提示
    public static function get_make_show($_aid=0,$make_page="",$state=false,$is_message=false){
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        if (!$state && !$cache_make_open){
         return "";
        }
            $category = category::getInstance(); //实例化栏目类

            if ($_aid) {
                $where = "aid=$_aid AND checked=1 AND (ishtml IS NULL OR ishtml!=2) ". ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            }
            else
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
            $make_page = $make_page == '' ? 1 : $make_page;
            $archive->getrows($where);
            $archive_num = $archive->record_count;
            $group_count = 50;
            $make_page_num = ceil($archive_num / $group_count);
            $totalpage = (($make_page - 1) * $group_count) . ',' . $group_count;

            //取到要生成的所有文章
            $archives = $archive->getrows($where, $totalpage, '1');
            $cpage = 0;
            //关键字连接
            $linkword = new linkword();
            $linkwords = $linkword->getrows(null, 1000, 'linkorder desc');
            //循环所有文章
            foreach ($archives as $arc) {
                if (!category::getarcishtml($arc) && $state)  //如果文章设置不生成则跳过
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
                    if (!empty($contents)) {
                        $content = $contents[$c - 1];
                    }
                    $case->view->archive['content'] = $content;

                    $catid = $case->view->catid;
                    if (!$case->view->archive['showform']) {
                        self::getshowform($catid);
                    } else if ($case->view->archive['showform'] && $case->view->archive['showform'] == '1') {
                        self::$showform = 1;
                    } else {
                        self::$showform = $case->view->archive['showform'];
                    }
                    if (preg_match('/^my_/is', self::$showform)) {
                        $case->view->archive['showform'] = self::$showform;
                        $o_table = new defind(self::$showform);
                        front::$get['form'] = self::$showform;
                        $case->view->primary_key = $o_table->primary_key;
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
                    $adminlang = lang::getisadmin();
                    foreach ($case->view->archive as $key => $value) {
                        if (!preg_match('/^my/', $key) || !$value)
                            continue;
                        setting::$var['archive'][$key]['catid_' . $adminlang] = setting::$var['archive'][$key]['catid_' . $adminlang] == "" ? 0 : setting::$var['archive'][$key]['catid_' . $adminlang];
                        $sonids = $category->sons(setting::$var['archive'][$key]['catid_' . $adminlang]);
                        $sonids[] = setting::$var['archive'][$key]['catid_' . $adminlang];
                        if (!in_array($case->view->archive['catid'], $sonids) && intval(setting::$var['archive'][$key]['catid_' . $adminlang])) {
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

                    $newcname = 'attr2_' . lang::getistemplate();
                    $attr2 = json_decode($case->view->archive['attr2'], true);
                    $case->view->archive['attr2'] = is_array($attr2) ? $attr2[$newcname] : $case->view->archive['attr2'];

                    $prices = getPrices($case->view->archive['attr2']);
                    $case->view->archive['attr2'] = $prices['price'];
                    $case->view->archive['oldprice'] = $prices['oldprice'];
                    $case->view->groupname = $prices['groupname'];

                    //图片
                    $case->view->archive['pics'] = unserialize($case->view->archive['pics']);

                    if ($template && (file_exists(TEMPLATE . '/' . $case->view->_style . '/' . $template)
                            || file_exists(TEMPLATE . '/' . $template)
                            || file_exists(TEMPLATE . '/' . config::get('template_shopping_dir') . '/' . $template)))
                        $tpl = $template;
                    else {
                        $tpl = category::gettemplate($case->view->catid, 'showtemplate', true, null, true);
                    }
                    //判断是否是商城栏目
                    if (category::isshopping($case->view->catid)) {
                        $tpl = config::get('template_shopping_dir') . '/' . $tpl;
                    }

                    if ($state){
                        $content=$case->fetch($tpl,true);
                    }else{
                        $content=$case->fetch($tpl,true,false,true);
                    }
                    $path = archive::url($case->view->archive, front::$get['page'] > 1 ? front::$get['page'] : null, lang::getisadmin(), $state);
                    $path = archive::url_rule($path);
                    $path = str_replace('.html', '.php', $path);

                    tool::mkdir(dirname($path));
                    file_put_contents($path, $content);
                    if ($is_message){
                        echo  str_pad(str_ireplace(ROOT.'/','',$path)."<br/>",1024*128);
                    }

                    $cpage++;
                    if ($case->view->pages > 1 && $c == 1 && $state) {
                        $path = ROOT . archive::url($case->view->archive, 1, lang::getisadmin(),$state);
                        if (!preg_match('/\.[a-zA-Z]+$/', $path))
                            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                        $path = rtrim($path, '/');
                        $path = rtrim($path, '\\');
                        $path = str_replace('//', '/', $path);
                        $path = str_replace('.html','.php',$path);
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
                $show_msg =  lang_admin('this_group_generates_html') . " <b>{$cpage}</b> " . lang_admin('npage')
                    . "！  " . lang_admin('generate_html') . lang_admin('this_co_generation') . " <b>{$archive_num}</b> " . lang_admin('npage') . "！ "."<br/>" ;
            } else {
                $show_msg =   lang_admin('how_many') . " <b>{$make_page}</b> " . lang_admin('group_html') . " <b>{$cpage}</b> "
                    . lang_admin('npage') . "！ " . lang_admin('the_total_required') . " <b>{$archive_num}</b> " . lang_admin('npage') . "！ "
                    . lang_admin('has_been_generated') . " <b>" . ($make_page * $group_count) . "</b> " . lang_admin('npage') . "！ " ."<br/>";
            }
            if ($cpage > 0) {
                if (!config::get('group_on') && $is_message) {
                    echo  str_pad(lang_admin('generate_html') . " <b>{$cpage}</b> " . lang_admin('npage') . "！" . lang_admin('when_used') . time::getTime() . "！\n",1024*128);
                } else {
                    if ($is_message){
                        echo  str_pad($show_msg. "\n",1024*128) ;
                    }
                    self::get_make_show($_aid,$make_page + 1,$state);
                }
            } else {
                if ($is_message){
                    echo   str_pad(lang_admin('none_of_the_generated_HTML')."\n",1024*128);
                }
            }
            front::$admin = true;
            front::$isadmin = true;
    }

    function getshowform($cid)
    {
        $category = category::getInstance();
        $row = $category->getrow(array('catid' => $cid), '1 desc', 'catid,showform,parentid');
        if ($row['showform'] && $row['showform'] != 1) {
            self::$showform = $row['showform'];
        } else if ($row['showform'] && $row['showform'] == 1) {
            self::$showform = 1;
        } else if (!$row['showform']) {
            if ($row['parentid'] != 0) {
               self::getshowform($row['parentid']);
            } else {
                self::$showform = '1';
            }
        }
    }

    //分类页面生成  $_typeid分类id   $state是否静态
    public static function get_make_type($_typeid,$state=true,$is_message=false){
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        if (!$state && !$cache_make_open){
            return "";
        }
        $case = 'type';
        $act = 'list';
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
        $totalpage = 100;
        $time_start = time::getTime();

        $type = type::getInstance();
        $typeid = $_typeid;

        if ($typeid && !$type->getishtml($typeid) && $state) {
            front::flash(lang_admin('none_of_the_generated_HTML'));
            return;
        }

        $where = 'langid = "' . lang::getlangid(lang::getisadmin()) . '"';
        if ($typeid) {
            $where .= ' and  typeid=' . $typeid;
            $arrtype = $type->getrows($where);
        } else {
            $arrtype = $type->getrows($where, 0);
        }
        $cpage = 0;
        if (is_array($arrtype) && !empty($arrtype)) {
            foreach ($arrtype as $v) {
                if (!$type::getarcishtml($v)  && $state)  //如果分类设置不生成则跳过
                    continue;
                if (!$type->getishtml($v['typeid']) && $state) {
                    continue;
                }
                $types = array();
                $types = $type->sons($v['typeid']);
                $types[] = $v['typeid'];
                $where = 'typeid in (' . implode(',', $types) . ') AND checked=1 AND state=1 and langid = "' . lang::getlangid(lang::getisadmin()) . '"';
                $where .= ' and langid = "' . lang::getlangid(lang::getisadmin()) . '"';
                $archive_all = new archive();
                $archive_num = $archive_all->rec_count($where);
                for (front::$get['page'] = 1; ; front::$get['page']++) {
                    //静态生成  判断动态的php缓存是否存在  存在的话  直接使用动态的php文件
                    $cache_path = type::url($v['typeid'], front::$get['page'], lang::getisadmin(),false);
                    $cache_path = type::url_rule($cache_path);
                    $cache_path=str_replace('.html','.php',$cache_path);
                    if (file_exists($cache_path) && $state) {
                        //头部尾部重新解析
                        $content=$case->view->compile_public(file_get_contents($cache_path),true);
                        file_put_contents($cache_path, $content);

                        $content=$case->view->_eval($cache_path,true);
                        $path = type::url($v['typeid'], front::$get['page'], lang::getisadmin(),$state);
                        $path = category::url_rule($path);
                        file_put_contents($path, $content);
                        echo str_pad(str_ireplace(ROOT . '/', '', $path) . "<br/>", 1024 * 128);
                        $indexpath = dirname($path) . '/index.html';
                        if (!$state){
                            $indexpath=str_replace('.html','.php',$indexpath);
                        }
                        if (front::$get['page'] == 1 && $indexpath != ROOT . '/index.html') {
                            echo str_pad(str_ireplace(ROOT . '/', '', $indexpath) . "<br/>", 1024 * 128);
                            file_put_contents($indexpath, $content);
                            $cpage++;
                        }
                    }
                    else{
                        $view = $case->view;
                        $pagesize = config::get('list_pagesize');
                        $limit = ((front::$get['page'] - 1) * $pagesize) . ',' . $pagesize;
                        $archive = new archive();
                        $case->view->archives = $archive->getrows($where, $limit, '`listorder` desc,adddate desc');
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

                            $newcname='attr2_'.lang::getistemplate();
                            $attr2=json_decode($arc['attr2'],true);
                            $arc['attr2']=is_array($attr2)?$attr2[$newcname]:$arc['attr2'];

                            $prices = getPrices($arc['attr2']);
                            $articles['attr2'] = $prices['price'];
                            $articles['oldprice'] = $prices['oldprice'];
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


                        $tpl = type::gettemplate($v['typeid']);
                        if ($state){
                            $content=$case->fetch($tpl,true);
                        }else{
                            $content=$case->fetch($tpl,true,false,true);
                        }
                        $path = type::url($v['typeid'], front::$get['page'], lang::getisadmin(),$state);
                        $path = type::url_rule($path);

                        if (!$state){
                            $path=str_replace('.html','.php',$path);
                        }
                        tool::mkdir(dirname($path));
                        if ($state){
                            echo  str_pad(str_ireplace(ROOT.'/','',$path)."<br/>",1024*128);
                        }
                        if (!file_put_contents($path, $content)  && ($state || $is_message) ) {
                            echo str_pad(lang_admin('write_html_failed')."<br/>",1024*128);
                        }

                        if ($state){
                            $indexpath = dirname($path) . '/index.html';
                            if (!$state){
                                $indexpath=str_replace('.html','.php',$indexpath);
                            }
                            if ($state || $is_message){
                                echo  str_pad(str_ireplace(ROOT.'/','',$indexpath)."<br/>",1024*128);
                            }

                            if (front::$get['page'] == 1 && $indexpath != ROOT . '/index.html') {
                                file_put_contents($indexpath, $content);
                                $cpage++;
                            }
                        }
                    }
                    $cpage++;
                    $case->view = $view;
                }
            }
        }
        if ($state || $is_message){
            if ($cpage > 0)
                echo  str_pad(lang_admin('generate_html') . " <b>$cpage</b> " . lang_admin('npage') . "！",1024*128)."<br/>";
            else
                echo  str_pad(lang_admin('none_of_the_generated_HTML'),1024*128)."<br/>";
        }

        front::$admin = true;
        front::$isadmin = true;

    }

    //专题生成 $speciaid专题id  $state是否静态
    public static  function get_make_special($speciaid,$state=true,$is_message=false){
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        if (!$state && !$cache_make_open){
            return "";
        }
        $special = new special();
        $where = ' langid = "' . lang::getlangid(lang::getisadmin()) . '"';
        if ($speciaid == '0') {
            $specials = $special->getrows($where,0);
        } else {
            $where .= ' and spid=' . $speciaid;
            $specials = $special->getrows($where,0);
        }
        $index = 0;  //生成页数
        if (is_array($specials) && !empty($specials)) {
            foreach ($specials as $v) {
                if (!$special->getishtml($v['spid']) && $state) {
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
                    //静态生成  判断动态的php缓存是否存在  存在的话  直接使用动态的php文件
                    $cache_path =special::url($v['spid'],$v['ishtml'],$i,$v['htmldir'],lang::getisadmin(),false);
                    $cache_path = special::url_rule($cache_path);
                    $cache_path=str_replace('.html','.php',$cache_path);
                    if (file_exists($cache_path) && $state) {
                        $case ='archive_act';
                        $case = new $case();
                        $case->init();

                        //头部尾部重新解析
                        $content=$case->view->compile_public(file_get_contents($cache_path),true);
                        file_put_contents($cache_path, $content);

                        $data=$case->view->_eval($cache_path,true);
                        $path = special::url($v['spid'],$v['ishtml'],$i,$v['htmldir'],lang::getisadmin(), $state);
                        $path = special::url_rule($path);
                        if (file_put_contents($path, $data)) {
                            echo  str_pad( str_ireplace(ROOT.'/','',$path)."<br/>",1024*128);
                            $j++;
                        }
                    }
                    else {
                        $path = special::url($v['spid'],$v['ishtml'],$i,$v['htmldir'],lang::getisadmin(),$state);
                        $path = special::url_rule($path);
                        if (!$state){
                            $path=str_replace('.html','.php',$path);
                        }

                        tool::mkdir(dirname($path));
                        $data = file_get_contents(config::get('site_url') . 'index.php?case=special&cache_make=1&act=show&spid=' . $v['spid'] . '&page=' . $i.'&url='.lang::getisadmin());
                        if (file_put_contents($path, $data)) {
                            if ($state || $is_message){
                                echo  str_pad( str_ireplace(ROOT.'/','',$path)."<br/>",1024*128);
                            }
                            $j++;
                        }

                    }
                    if ($state) {
                        $indexpath = dirname($path) . '/index.html';
                        if (!$state) {
                            $indexpath = str_replace('.html', '.php', $indexpath);
                        }
                        if ($i == 1 && $indexpath != ROOT . '/index.html') {
                            if ($state || $is_message) {
                                echo str_pad(str_ireplace(ROOT . '/', '', $indexpath) . "<br/>", 1024 * 128);
                            }
                            file_put_contents($indexpath, $data);
                        }
                    }
                }

            }
        }
        if ($state || $is_message) {
            if ($state || $is_message) {
                if ($j > 0) {
                    echo str_pad(lang_admin('generate_html') . " <b>" . $j . "</b> " . lang_admin('npage') . "！", 1024 * 128). "<br/>";
                } else {
                    echo str_pad(lang_admin('none_of_the_generated_HTML'), 1024 * 128). "<br/>";
                }
            }
        }
    }

    //tag生成 $_tagid TAGid  $state是否静态
    public static  function get_make_tag($_tagid,$state=true,$is_message=false){
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        if (!$state && !$cache_make_open){
            return "";
        }

        $otag = new tag();
        $condition = '';
        if ($_tagid != '') {
            $condition = 'tagid=' . $_tagid;
        }
        $tags = $otag->getrows($condition, 0);
        //var_dump($tags);
        $tags = array_to_hashmap($tags, 'tagid', 'tagname');


        if ($state && (config::getadmin('tag_html')!='1' || !is_array($tags)) ) {
            echo  str_pad(lang_admin('none_of_the_generated_HTML'),1024*128);
            session::set("cahe_make_tag", "");   //清空
            exit;
        }

        $j = 0;
        foreach ($tags as $k => $v) {
            $tagid = $k;
            $tag = $v;
            $pinyin = pinyin::get($tag);

            $arctag = new arctag();
            $archive_num = $arctag->rec_count('tagid=' . $tagid);
            if (!$state) {
                $archive_num = $archive_num ? $archive_num : 1;
            }

            front::$record_count = $archive_num;
            $pagesize = config::get('list_pagesize');
            front::$pages = $pagesize;
            $cpage = ceil($archive_num / $pagesize);
            /* $html_prefix = ROOT . '/';
             if (config::getadmin('html_prefix')) {
                 $html_prefix = ROOT . '/' . trim(config::getadmin('html_prefix'), '/') . '/';
             }*/

            for ($i = 1; $i <= $cpage; $i++) {
                //静态生成  判断动态的php缓存是否存在  存在的话  直接使用动态的php文件
                $cache_path =tag::url($tag,$i,lang::getisadmin(),false);
                $cache_path = tag::url_rule($cache_path);
                $cache_path=str_replace('.html','.php',$cache_path);
                if (file_exists($cache_path) && $state) {
                    $case ='archive_act';
                    $case = new $case();
                    $case->init();

                    //头部尾部重新解析
                    $content=$case->view->compile_public(file_get_contents($cache_path),true);
                    file_put_contents($cache_path, $content);

                    $data=$case->view->_eval($cache_path,true);
                    $path = tag::url($tag,$i,lang::getisadmin(),$state);
                    $path = tag::url_rule($path);
                    echo str_pad(str_ireplace(ROOT . '/', '', $path), 1024 * 128) . "<br>";
                    if (file_put_contents($path, $data)) {
                        $j++;
                    }
                }
                else {
                    $path = tag::url($tag,$i,lang::getisadmin(),$state);
                    $path = tag::url_rule($path);
                    if (!$state){
                        $path=str_replace('.html','.php',$path);
                    }

                    tool::mkdir(dirname($path));
                    if ($state || $is_message) {
                        echo str_pad(str_ireplace(ROOT . '/', '', $path), 1024 * 128) . "<br>";
                    }
                    $data = file_get_contents(getSiteUrl() . '/index.php?case=tag&cache_make=1&act=show&tag=' . urlencode($tag) . '&page=' . $i);
                    if (file_put_contents($path, $data)) {
                        $j++;
                    }
                }
                if ($state) {
                    $indexpath = dirname($path) . '/index.html';
                    if (!$state) {
                        $indexpath = str_replace('.html', '.php', $indexpath);
                    }
                    if ($i == 1 && $indexpath != ROOT . '/index.html') {
                        if ($state || $is_message) {
                            echo str_pad(str_ireplace(ROOT . '/', '', $indexpath) . "<br/>", 1024 * 128);
                        }
                        file_put_contents($indexpath, $data);
                    }
                }

            }
        }
        /*if (count($tags) > 0) {*/

        if ($state || $is_message) {
            if ($j > 0) {
                echo str_pad(lang_admin('generate_html') . " <b>" . $j . "</b> " . lang_admin('npage') . "！", 1024 * 128). "<br/>";
            } else {
                echo str_pad(lang_admin('none_of_the_generated_HTML'), 1024 * 128). "<br/>";
            }
        }

    }

    //首页生成 $_langtemplate 恢复的前台语言 $_langadmin恢复的后台语言  $state是否静态
    public static  function get_make_index($_langtemplate,$_langadmin,$state=true,$is_message=false){
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        if (!$state && !$cache_make_open){
            return "";
        }
        $case = 'index';
        $act = 'index';
        $_GET = array('case' => $case, 'act' => $act);
        $front = new front();
        front::$admin = false;
        front::$isadmin = false;
        front::$html = true;
        $case = $case . '_act';
        $case = new $case();
        $case->init();
        $method = $act . '_action';
        $view = $case->view;
        if (config::getadmin('list_index_php') != 1 && $state) {
            //最后恢复前台语言包
            lang::settistemplate($_langtemplate);
            lang::setisadmin($_langadmin);
            session::set("cahe_make_index","");   //清空
            echo str_pad(lang_admin('none_of_the_generated_HTML').lang_admin("automatically_return_to_the_content_after_2_seconds_to_generate_the_first_page"),1024*128);
            exit;
        }
        //生成全部语言
        $langdata=getlang();
        $categorydata=category::getInstance()->getrow("isindex=1 and langid=".lang::getlangid($_langadmin)); //如果首页是栏目
        if($langdata != ""){
            foreach ($langdata as $key=>$val){
                lang::settistemplate($val['langurlname']);
                lang::setisadmin($val['langurlname']);
                if (config::get('list_index_php') == 1 || !$state) {
                    lang::$langadmindata=null;
                    templatetag::$setting=array();
                    session::set('modify_state_'.$val['langurlname'],1);
                    $templatetag = new templatetag();  //重新声明一下  会重新加载标签
                    //重新加载语言包
                    load_lang('system.php','system_custom.php');
                    load_admin_lang('system_admin.php','system_admin_custom.php');
                    $categorydata_lang=category::getInstance()->getrow("isindex=1 and langid=".lang::getlangid($val['langurlname'])); //如果首页是栏目
                    if (is_array($categorydata_lang) && $categorydata_lang['langid']==lang::getlangid($val['langurlname'])){
                        continue;
                    }
                    else {
                        if ($state){
                            echo str_pad( 'index-' . lang::getistemplate() . '.html'. '<br/>',1024*128);
                        }
                        if ($is_message){
                            echo str_pad( lang::getistemplate().'/index-' . lang::getistemplate() . '.php'. '<br/>',1024*128);
                        }
                        if ($state){
                            $data=$case->fetch('index/index.html',true);
                        }else{
                            $data=$case->fetch('index/index.html',true,false,true);
                        }
                        if ($state){
                            file_put_contents(ROOT . '/index-' . lang::getistemplate() . '.html', $data);
                        }else{
                            tool::mkdir(ROOT . '/'.$val['langurlname']);
                            file_put_contents(ROOT . '/'.lang::getistemplate().'/index-' . lang::getistemplate() . '.php', $data);
                        }
                    }
                }
            }
        }

        //生成默认语言
        $defaultlangdata=getisdefault();
        if($defaultlangdata != "" && config::get('list_index_php') == 1 && $state){
            lang::settistemplate($defaultlangdata);
            lang::setisadmin($defaultlangdata);
            lang::$langadmindata=null;
            templatetag::$setting=array();

            $templatetag=new templatetag();  //重新声明一下  会重新加载标签
            load_lang('system.php','system_custom.php');  //重新加载语言包
            if (is_array($categorydata) && $categorydata['langid']==lang::getlangid($defaultlangdata) ){
                /*  $data="";
                 front::$get['catid']=$categorydata['catid'];
                 $archive_act=new archive_act();
                 $archive_act->init();
                 $data=$archive_act->list_action(true);
                 if ($data=="")
                 $data=$archive_act->end(true);*/
                /* $data = file_get_contents(config::get('site_url')."index.php?case=archive&act=list&catid=".$categorydata['catid']);*/
                /*file_put_contents(ROOT . '/index.html', $data);*/
            }else
                file_put_contents(ROOT . '/index.html', $case->fetch(null,true));

        }

        front::$admin = true;
        front::$isadmin = true;
        //最后恢复前台语言包
        lang::settistemplate($_langtemplate);
        lang::setisadmin($_langadmin);
    }


    //footer尾部生成
    public static  function get_make_footer($_langtemplate,$_langadmin){
        $case = 'index';
        $act = 'index';
        $_GET = array('case' => $case, 'act' => $act);
        front::$admin = false;
        front::$isadmin = false;
        front::$html = true;
        $case = $case . '_act';
        $case = new $case();

        $cache_path=ROOT . '/'.lang::getistemplate().'/template/'.front::$view->_style.'/footer.php';

        if(file_exists(TEMPLATE.'/'.front::$view->_style.'/footer.html')){
            file_put_contents($cache_path, $case->fetch("footer.html",true));
        }else{
            $content = "";
        }

        front::$admin = true;
        front::$isadmin = true;
        //最后恢复前台语言包
        lang::settistemplate($_langtemplate);
        lang::setisadmin($_langadmin);
    }

    //更新导航的top
    public static  function get_make_top($_catid=0){
        $case = 'index';
        $case = $case . '_act';
        $case = new $case();
        front::$admin = false;
        front::$isadmin = false;
        front::$html = true;
        front::$rewrite = false;

        $cache_path=ROOT . '/'.lang::getistemplate().'/template/'.front::$view->_style;
        //删除列表
        front::remove($cache_path.'/visual/nav');
        //删除缓存数据
        front::remove(ROOT.'/cache/data/template/'.lang::getistemplate().'/category/0');
        if ($_catid){
            //删除缓存数据
            front::remove(ROOT.'/cache/data/template/'.lang::getistemplate().'/category/'.$_catid);
        }
        //重新生成
        $cache_path=$cache_path.'/top.php';
        if(file_exists($cache_path)){
            unlink($cache_path);
        }
        if(file_exists(TEMPLATE.'/'.front::$view->_style.'/top.html')){
            $content = $case->fetch("top.html",true,true);
        }else{
            $content = "";
        }

        file_put_contents($cache_path, $content);

        front::$admin = true;
        front::$isadmin = true;

    }

    //公用全部首页生成
    public static function all_make_index($is_message=false){
           self::get_make_index(lang::getistemplate(),lang::getisadmin(),false,$is_message);
    }

    //公用全部栏目生成
    public static function all_make_list($is_message=false){
        $category=category::getInstance()->getrows("parentid=0 and langid=".lang::getlangid(lang::getisadmin()),0,'catid asc','catid');
        if (is_array($category)){
            foreach ($category as $c){
                self::get_make_list($c['catid'],false,$is_message);
            }
        }
    }

    //公用全部内容生成
    public static function all_make_show($is_message=false){
        $archive=archive::getInstance()->getrows("langid=".lang::getlangid(lang::getisadmin()),0,'aid asc','aid');
        if (is_array($archive)){
            foreach ($archive as $a){
                self::get_make_show($a['aid'],"",false,$is_message);
            }
        }
    }

    //公用全部分类生成
    public static function all_make_type($is_message=false){
        $type=type::getInstance()->getrows("langid=".lang::getlangid(lang::getisadmin()),0,'typeid asc','typeid');
        if (is_array($type)){
            foreach ($type as $y){
                self::get_make_type($y['typeid'],false,$is_message);
            }
        }
    }

    //公用全部专题生成
    public static function all_make_special($is_message=false){
        $special=special::getInstance()->getrows("langid=".lang::getlangid(lang::getisadmin()),0,'spid asc','spid');
        if (is_array($special)){
            foreach ($special as $p){
                self::get_make_special($p['spid'],false,$is_message);
            }
        }
    }

    //公用全部标签生成
    public static function all_make_tag($is_message=false){
        $tag=tag::getInstance()->getrows("langid=".lang::getlangid(lang::getisadmin()),0,'tagid asc','tagid');
        if (is_array($tag)){
            foreach ($tag as $t){
                self::get_make_tag($t['tagid'],false,$is_message);
            }
        }
    }

    //删除全部php缓存文件和html文件
    public static function all_make_delete(){
        //清空全部语言
        $langdata=getlang();
        if($langdata != ""){
            foreach ($langdata as $key=>$val) {
                $fileurl = ROOT . '/' . $val['langurlname'];
                if (is_dir($fileurl)) {
                    $list = front::buyscan($fileurl);
                    if (is_array($list) && !empty($list)) {
                        foreach ($list as $t) {
                            $fileurl_path = $fileurl . '/' . $t;
                            if ($t!="upload"){
                                if (strpos($t, '.') !== false) {
                                    unlink($fileurl_path);
                                }else{
                                    front::remove($fileurl_path);
                                }
                            }
                        }
                    }
                }
            }
        }

    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.