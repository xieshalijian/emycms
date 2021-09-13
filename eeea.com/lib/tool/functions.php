<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
define('_NEWVERCODE','7751');

function getCommentPages($aid){
    $aid = intval($aid);
    $where = "state=1 and aid='$aid'";
    $comment = comment::getIns();
    $pagesize = config::get('list_pagesize');
    $count = $comment->rec_count($where);
    $pages = ceil($count / $pagesize);
    return $pages;
}

function getCates($catid, $arr,$parents)
{
    $str = '';
    static $i = 2;
    foreach ($arr as $r) {
        $class = $r['catid'] == $catid ? ' class="on"' : '';
        $str .= '<a title="' . $r['catname'] . '" href="' . $r['url'] . '"' . $class . '>' . str_repeat('&nbsp;', $i) . '└' . $r['catname'] . '</a>';
        $tmp = categories($r['catid']);
        if(in_array($r['catid'],$parents) && is_array($tmp) && !empty($tmp)) {
            $i++;
            $str .= getCates($catid, $tmp, $parents);
        }
    }
    return $str;
}

function slideCateMenu($catid, $topid, $categories)
{
    $__pid = getcategoryparentsid($catid);
    $parents = category::getparentsid($catid);
    $str = '';
    foreach ($categories as $t) {
        if ($t['catid'] == $__pid) {
            $id = isset($topid) && $topid == $t['catid'] ? ' id="p1"' : '';
            $str .= '<dt class="parent"' . $id . '><a>' . $t['catname'] . '</a></dt>';
            $str .= '<dd class="child">';
            $str .= getCates($catid, categories($t['catid']),$parents);
        }
    }
    return $str;
}

function nav($id)
{
    echo template('visual/nav/nav_' . $id . '.html',false);
}

function shopping_nav($id)
{
    echo template_shopping('visual/nav/nav_' . $id . '.html',false);
}


function ctimg($url, $width = false, $height = false, $border = false, $opt = null)
{
    $str = '<img src="' . $url . '"';
    if ($width) {
        $str .= ' width="' . $width . '"';
    }
    if ($height) {
        $str .= ' height="' . $height . '"';
    }
    if ($border) {
        $str .= ' border="' . $border . '"';
    }

    if (is_array($opt)) {
        foreach ($opt as $k => $v) {
            $str .= ' ' . $k . '="' . $v . '"';
        }
    }
    $str .= " />";
    return $str;
}

function getSiteUrl()
{
    $http = $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $url = $http . $_SERVER['HTTP_HOST'];
    return $url . front::$view->base_url;
}

function sqliteEscape($keyWord)
{
    $keyWord = str_replace("/", "//", $keyWord);
    $keyWord = str_replace("'", "''", $keyWord);
    $keyWord = str_replace("[", "/[", $keyWord);
    $keyWord = str_replace("]", "/]", $keyWord);
    $keyWord = str_replace("%", "/%", $keyWord);
    $keyWord = str_replace("&", "/&", $keyWord);
    $keyWord = str_replace("_", "/_", $keyWord);
    $keyWord = str_replace("(", "/(", $keyWord);
    $keyWord = str_replace(")", "/)", $keyWord);
    return $keyWord;
}

// 远程请求（不获取内容）
function _sock($url)
{
    //var_dump($url);
    // exit;
    $host = parse_url($url, PHP_URL_HOST);
    $port = parse_url($url, PHP_URL_PORT);
    //var_dump($port);
    $port = $port ? $port : 80;
    $scheme = parse_url($url, PHP_URL_SCHEME);
    $path = parse_url($url, PHP_URL_PATH);
    $query = parse_url($url, PHP_URL_QUERY);
    if ($query) $path .= '?' . $query;
    if ($scheme == 'https') {
        $host = 'ssl://' . $host;
        $port = '443';
    }
    //var_dump($host);
    //var_dump($port);
    //exit;

    $fp = @stream_socket_client($host.':'.$port, $error_code, $error_msg, 1);
    if (!$fp) {
        return array('error_code' => $error_code, 'error_msg' => $error_msg);
    } else {
        stream_set_blocking($fp, 1);
        stream_set_timeout($fp, 1);
        $header = "GET $path HTTP/1.1\r\n";
        $header .= "Host: $host\r\n";
        $header .= "Connection: close\r\n\r\n";
        fwrite($fp, $header);
        usleep(1000);
        fclose($fp);
        return array('error_code' => 0);
    }
}

function getCopyRight()
{
    if (session::get('ver') != 'corp') {
        echo "Powered by <a href=\"https://www.cmseasy.cn\" title=\"CmsEasy企业网站系统\" target=\"_blank\">CmsEasy</a>";
    }

}

function alerterror($info, $back = true)
{
    echo "<script type='text/javascript'>alert('$info');";
    if (true === $back) {
        echo "history.go(-1);";
    }
    echo "</script>";
    exit();
}

function alertexit($info)
{
    echo "<script type='text/javascript'>alert('$info');window.close();";
    echo "</script>";
    exit();
}

function alertinfo($info, $url, $window = '')
{
    echo "<script type='text/javascript'>alert('$info');window{$window}.location.href='$url';</script>";
    exit();
}

function phpox_replace($str)
{
    return str_replace("'", "''", $str);
}

if (!function_exists('utf8_unicode')) {
    function utf8_unicode($name)
    {
        $name = iconv('UTF-8', 'UCS-2', $name);
        $len = strlen($name);
        $str = '';
        for ($i = 0; $i < $len - 1; $i = $i + 2) {
            $c = $name[$i];
            $c2 = $name[$i + 1];
            if (ord($c) > 0) {//两个字节的文字
                $str .= '\u' . base_convert(ord($c), 10, 16) . str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
                //$str .= base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
            } else {
                $str .= '\u' . str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
                //$str .= str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
            }
        }
        $str = strtoupper($str);
        //转换为大写
        return $str;
    }
}

/**
 * unicode 转 utf-8
 *
 * @param string $name
 * @return string
 */
if (!function_exists('unicode_decode')) {
    function unicode_decode($name)
    {
        $name = strtolower($name);
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
        preg_match_all($pattern, $name, $matches);
        if (!empty($matches)) {
            $name = '';
            for ($j = 0; $j < count($matches[0]); $j++) {
                $str = $matches[0][$j];
                if (strpos($str, '\\u') === 0) {
                    $code = base_convert(substr($str, 2, 2), 16, 10);
                    $code2 = base_convert(substr($str, 4), 16, 10);
                    $c = chr($code) . chr($code2);
                    $c = iconv('UCS-2', 'UTF-8', $c);
                    $name .= $c;
                } else {
                    $name .= $str;
                }
            }
        }
        return $name;
    }
}

if (!function_exists('daddslashes')) {
    function daddslashes($string, $force = 1)
    {
        if (is_array($string)) {
            $keys = array_keys($string);
            foreach ($keys as $key) {
                $val = $string[$key];
                unset($string[$key]);
                $string[addslashes($key)] = daddslashes($val, $force);
            }
        }
        else {
            $string = htmlspecialchars(addslashes(trim($string)), ENT_QUOTES);
            if (!front::$isadmin || (front::$case == 'admin' && front::$act == 'login')) {
                front::check_type($string, 'safe');
                if (inject_check($string)) {
                    //var_dump($string);
                    event::log('inject', $string);
                    echo $string;exit;

                }

            }
            if (preg_match('/^data:(.*?)/is', $string)) {
                exit('data:');
            }
        }
        return $string;
    }

}

/* 导出excel函数*/
function push($titles, $data, $settings, $name = 'Excel')
{
    /*  error_reporting(0);
      require_once(ROOT.'/lib/plugins/PHPExcel.php');*/
    ob_end_clean();//清空浏览器缓存
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("CmsEasy")
        ->setLastModifiedBy("CmsEasy")
        ->setTitle("数据EXCEL导出")
        ->setSubject("数据EXCEL导出")
        ->setDescription("备份数据")
        ->setKeywords("excel")
        ->setCategory("result file");
    $i = 'A';
    foreach ($titles as $title) {
        $newcname='cname_'.lang::getisadmin();
        if (preg_match('/^my_/is', $title['name'])) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i . '1', $settings[$title['name']][$newcname]);
        } else {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i . '1', $title[$newcname] ? $title[$newcname] : $title['name']);
        }
        if (is_array($data))
            foreach ($data as $k => $v) {
                $num = $k + 2;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($i . $num, $v[$title['name']]);
            }
        $i++;
    }
    /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
    /*foreach ($data as $k => $v) {
        $num = $k + 2;
        $objPHPExcel->setActiveSheetIndex(0)
            //Excel的第A列，uid是你查出数组的键值，下面以此类推
            ->setCellValue('A' . $num, $v['fid'])
            ->setCellValue('B' . $num, $v['fid'])
            ->setCellValue('C' . $num, $v['fid']);
    }*/
    $objPHPExcel->getActiveSheet()->setTitle('User');
    $objPHPExcel->setActiveSheetIndex(0);
    //header('Content-Type: application/vnd.ms-excel');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $name . '.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

function eaddslashes($string, $force = 1)
{
    if (is_array($string)) {
        $keys = array_keys($string);
        foreach ($keys as $key) {
            $val = $string[$key];
            unset($string[$key]);
            $string[$key] = eaddslashes($val, $force);
        }
    } else {
        $string = htmlspecialchars(trim($string), ENT_QUOTES);
        if (!front::$isadmin) {
            front::check_type($string, 'safe');
        }
    }
    return $string;
}

function inject_check($sql_str)
{                                                                                                                                /*去掉into校验 |\binto\b */
    return preg_match('@\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bSLEEP\b|\bwhen\b|\bCHAR|\bTHEN\b|\bCONCAT\b|\/\*|\*|\.\.\/|\.\/|\[bunion]\b|\bload_file\b|\boutfile\b@is', $sql_str);
}

function inject_check_cookie($sql_str)
{                                         /*去掉into校验 |\binto\b  |\*| */
    return preg_match('@\bselect\b|\binsert\b|\/\*|\.\.\/|\.\/|\bupdate\b|\bdelete\b|\bSLEEP\b|\bwhen\b|\bCHAR|\bTHEN\b|\bCONCAT\b|\[bunion]\b|\bload_file\b|\boutfile\b@is', $sql_str);
}

function post_check_2($post)
{
    $post = str_replace("_", "\_", $post);
    $post = str_replace("%", "\%", $post);
    $post = nl2br($post);
    $post = htmlspecialchars($post);
    return $post;
}

function is_safe($string)
{
    if (!$string)
        return true;
    if (false !== stripos($string, '<script')) {
        return false;
    }
    if (false !== stripos($string, 'vbscript:')) {
        return false;
    }
    if (false !== stripos($string, 'javascript:')) {
        return false;
    }
    /*if ($string <>addslashes($string))
     return false;
     else*/
    return true;
}

function is_number($number)
{
    if (!is_numeric($number))
        return false;
    else
        return true;
}

function is_word($word)
{
    if (!preg_match("%^[a-zA-Z][a-zA-Z0-9_-]*$%"))
        return false;
    else
        return true;
}

function is_email($email)
{
    if (!preg_match("%^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$%", $email))
        return false;
    else
        return true;
}

function is_url($url)
{
    if (!preg_match("%^http://[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$%", $url))
        return false;
    else
        return true;
}

function getcnzzcount()
{
    $user = config::get('cnzz_user');
    if (strlen($user) > 0) {
        $cnzz = new cnzz();
        return $cnzz->getcount($user);
    }
    return '';
}

function type($id = 0, $stype = null,$myrthis=true)
{
    //提取分类
    if(!file_exists(ROOT."/lib/table/type.php")) {
        return array("");
    }
    $type = type::getInstance();
    if (is_array($id))
        $id = $id['typeid'];
    $types = $type->son($id);
    if ($id && $myrthis) {
        array_unshift($types, $id);
    }
    $ts = array();
    foreach ($types as $t) {
        $_ts = $type->type[$t];
        if ($stype && !preg_match('/-/', $stype) && $_ts['stype'] <> $stype)
            continue;
        if ($stype && preg_match('/-/', $stype) && '-' . $_ts['stype'] == $stype)
            continue;
        $_ts['url'] = type::url($_ts['typeid'], $_ts['ispages']);
        $ts[] = $_ts;
    }
    return $ts;
}

function showtype($id)
{
    //提取分类
    if(!file_exists(ROOT."/lib/table/type.php")) {
        return array("");
    }
    $type = type::getInstance();
    return $type->type[$id];
}

function showcategory($id)
{
    $category = category::getInstance();
    return $category->category[$id];
}

function categories_new_nav($id = 0,$conent="all",$mystatu = false)
{
    return category::categories_new_nav($id,$conent,$mystatu);
}

function servicecategories_new_nav($id = 0,$conent="all",$mystatu = false)
{
    return servicecategory::categories_new_nav($id,$conent,$mystatu);
}


function categories_nav($id = 0, $stype = null)
{
    //echo '<script>alert("'.$id.'");</script>';
    $category = category::getInstance();
    if (is_array($id))
        $id = $id['catid'];

    $categoryids = $category->templateson($id);
    $cats = array();
    foreach ($categoryids as $catid) {
        $cat = $category->category[$catid];
        if (!$cat['isnav'])
            continue;
        if (front::get('t') == 'wap' && !$cat['ismobilenav']) {
            continue;
        }
        if ($stype && !preg_match('/-/', $stype) && $cat['stype'] <> $stype)
            continue;
        if ($stype && preg_match('/-/', $stype) && '-' . $cat['stype'] == $stype)
            continue;
        $cat['url'] = category::url($cat['catid'],null,false,lang::getistemplate());
        //echo '<script>alert("'.$cat['url'].'");</script>';
        if ($cat['nofollow']){
            $cat['nofollow'] = '" rel="nofollow';
        }else{
            $cat['nofollow'] = '';
        }
        if ($cat['isblank']){
            $cat['isblank'] = '" target="_blank';
        }else{
            $cat['isblank'] = '';
        }

        $cat['url']=$cat['url'].$cat['nofollow'].$cat['isblank'];

        $cat['num'] = category::num($cat['catid']);
        $cats[] = $cat;
    }

    return $cats;
}

function categories($id = 0, $stype = null,$titlenum='',$textnum='')
{
    $cache_id =lang::getistemplate().'/category/'.$id.'/categories-'.$id.'-'.($titlenum==''?0:$titlenum).'-'.($textnum==''?0:$textnum);
    if (cache::get($cache_id))
        return cache::get($cache_id);
    else {
        $category = category::getInstance();
        if (is_array($id))
            $id = $id['catid'];
        $categories = $category->templateson($id);
        $cats = array();

        foreach ($categories as $catid) {
            $_category = $category->category[$catid];
            if (!$_category['isnav'])
                continue;
            if ($stype && !preg_match('/-/', $stype) && $_category['stype'] <> $stype)
                continue;
            if ($stype && preg_match('/-/', $stype) && '-' . $_category['stype'] == $stype)
                continue;
            if (front::get('t') == 'wap' && !$_category['ismobilenav']) {
                continue;
            }

            if ($titlenum != '') {
                $_category['catname'] = cut(strip_tags($_category['catname']), $titlenum);
            }
            $_category['categorycontenthtml']=$_category['categorycontent'];
            if ($titlenum != '') {
                $_category['categorycontent'] = cut(strip_tags($_category['categorycontent']), $textnum);
            }else{
                $_category['categorycontent']=strip_tags( $_category['categorycontent']);
            }
            $_category['url'] = category::url($_category['catid']);
            $_category['num'] = category::num($_category['catid']);
            $cats[] = $_category;
        }
        cache::set($cache_id, $cats);
        return $cats;
    }
}

function servicecategories($id = 0, $stype = null,$titlenum='',$textnum='')
{
    $cache_id =lang::getistemplate().'/servicecategory/'.$id.'/categories-'.$id.'-'.($titlenum==''?0:$titlenum).'-'.($textnum==''?0:$textnum);
    if (cache::get($cache_id))
        return cache::get($cache_id);
    else {
        $category = servicecategory::getInstance();
        if (is_array($id))
            $id = $id['catid'];
        $categories = $category->templateson($id);
        $categories[]=$id; //加入本身栏目id
        $cats = array();

        foreach ($categories as $catid) {
            $_category = $category->category[$catid];
            if (!$_category['isnav'])
                continue;
            if ($stype && !preg_match('/-/', $stype) && $_category['stype'] <> $stype)
                continue;
            if ($stype && preg_match('/-/', $stype) && '-' . $_category['stype'] == $stype)
                continue;
            if (front::get('t') == 'wap' && !$_category['ismobilenav']) {
                continue;
            }

            if ($titlenum != '') {
                $_category['catname'] = cut(strip_tags($_category['catname']), $titlenum);
            }
            if ($titlenum != '') {
                $_category['categorycontent'] = cut(strip_tags($_category['categorycontent']), $textnum);
            }else{
                $_category['categorycontent']=strip_tags( $_category['categorycontent']);
            }
            $_category['url'] = servicecategory::url($_category['catid']);
            $_category['num'] = servicecategory::num($_category['catid']);
            $cats[] = $_category;
        }
        cache::set($cache_id, $cats);
        return $cats;
    }
}

function typies()
{
    //提取分类
    if(!file_exists(ROOT."/lib/table/type.php")) {
        return "";
    }

    return type::typies();
}

function tags($catid='0',$aid='0',$num=0)
{
    if(file_exists(ROOT."/lib/table/tag.php")) {
        return array();
    }
    $tags = tag::getTags($catid,$aid,$num);
    unset($tags[0]);
    $obj = tag::getInstance();
    $arr = array();
    if (is_array($tags) && !empty($tags)) {
        foreach ($tags as $tag) {
            $arr[] = array('url' => $obj->url($tag), 'tag' => $tag);
        }
    }
    return $arr;
}
function archive($catid = '0', $typeid = '0', $spid = 0, $area = '0,0,0', $length = 20, $ordertype = 'aid', $limit = 10, $image = false, $attr1 = null,
                 $son = true, $wheretype = '', $tpl = null, $intro_len = '0', $istop = 0,$isvisual=false)
{
    //$args = func_get_args();
    //var_dump($args);
    //专题扩展未安装的情况
    if(!file_exists(ROOT."/lib/table/special.php")) {
        $spid=0;
    }
    $_ordertype = $ordertype;
    if (front::$isvalue || front::$isadmin || front::get('pageset'))  //区分前后台缓存 可视化不加载颜色
        $cache_id =lang::getistemplate()."/archive/all/archive-".$catid.'-'.$typeid.'-'.$spid.'-'.$length.'-'.$ordertype.'-'.$limit.'_admin';
    else
        $cache_id =lang::getistemplate()."/archive/all/archive-".$catid.'-'.$typeid.'-'.$spid.'-'.$length.'-'.$ordertype.'-'.$limit;
    if ($ordertype == 'rand()')
        $cache_id = $cache_id . time();
    if (cache::get($cache_id)){
        $archives = cache::get($cache_id);
    }
    else {
        $ordertype = str_replace('-', ' ', $ordertype);
        $wheretype = str_replace('-', ' ', $wheretype);
        $order = 'listorder=0,listorder DESC ';
        if (preg_match('/^\w+$/', $ordertype))
            $order .= ',' . $ordertype . ' desc';
        elseif ($ordertype)
            $order .= ',' . $ordertype;
        $where = array();
        if ($wheretype)
            foreach (explode(',', $wheretype) as $_wheretype)
                switch ($_wheretype) {
                    case 'day' :
                        $where[] = 'adddate>' . date('Y-m-d H:i:s', time() - 3600 * 24);
                        break;
                    case 'week' :
                        $where[] = 'adddate>' . date('Y-m-d H:i:s', time() - 3600 * 24 * 7);
                        break;
                    case 'month' :
                        $where[] = 'adddate>' . date('Y-m-d H:i:s', time() - 3600 * 24 * 30);
                        break;
                    default :
                        if (preg_match('/commend=(\d+)/i', $_wheretype, $match))
                            $where[] = " attr1 REGEXP  '(^|,)$match[1](,|$)'  ";
                        else if (preg_match('/^\w+$/', $_wheretype))
                            $where[] = $_wheretype . "<>''";
                        else
                            $where[] = $_wheretype;
                        break;
                }
        if (!empty($where))
            $where = ' and ' . implode(' and ', $where);
        else
            $where = '';
        $archive = archive::getInstance();
        $category = category::getInstance();
        $categories = array();
        if (isset($catid) && $catid != '0') {
            $catid = explode('-', $catid);
            //var_dump($catid);
            $categories = $catid;
            $_categories1 = array();
            if ($son && !empty($categories)) {

                foreach ($categories as $key => $val) {
                    $_categories[$key] = $category->sons($val);
                    $_categories1 = @array_merge($_categories[$key], $_categories1);
                }
                //var_dump($_categories);
            }
            //var_dump($categories);
            $categories = @array_merge($categories, $_categories1);
            //var_dump($categories);
        }
        //var_dump($categories);
        //提取分类
        if(file_exists(ROOT."/lib/table/type.php")) {
            $type = type::getInstance();
            $types = array();
            if (isset($typeid) && $typeid != '0') {
                $types[] = $typeid;
                if ($son) {
                    $_types = $type->sons($typeid);
                }
                $types = @array_merge($types, $_types);
            }
        }
        $where = '1';
        //var_dump($attr1);
        if (!empty($types))
            $where .= ' and typeid in (' . implode(',', $types) . ')';
        if (!empty($categories))
            $where .= ' and catid in (' . implode(',', $categories) . ')';
        if ($spid)
            $where .= ' and spid=' . $spid;
        list($province_id, $city_id, $section_id) = explode(',', $area);
        if ($province_id)
            $where .= ' and province_id=' . $province_id;
        if ($city_id)
            $where .= ' and city_id=' . $city_id;
        if ($section_id)
            $where .= ' and section_id=' . $section_id;
        if ($image)
            $where .= ' and thumb <> "" ';
        /*if ($attr1)
            $where .= " and FIND_IN_SET('$attr1',attr1) ";*/
        if ($attr1) {
            $where .= " and (attr1='{$attr1}' OR attr1 LIKE '{$attr1},%' or attr1 LIKE '%,{$attr1},%' or attr1 LIKE '%,{$attr1}')";
        }
        if ($_ordertype == 'aid-asc') {
            $order .= ',aid asc';
        }
        if ($_ordertype == 'new') {
            $order .= ',adddate desc';
        }

        $where.=" and langid=".lang::getlangid(lang::getistemplate());
        //var_dump($where);
        $tops = array();
        if ($istop) {
            $tops = $archive->getrows($where . " AND checked=1 AND toppost!=0", $limit, 'toppost DESC,listorder=0,listorder ASC,aid DESC');
        }
        $archives = $archive->getrows($where . ' AND checked=1 and toppost=0', $limit, $order, $archive->getcols('list'));
        //var_dump($archives);
        if (is_array($tops) && !empty($tops)) {
            foreach ($tops as $order => $arc) {
                if ($arc['toppost'] == 3) {
                    $tops[$order]['title'] = "[".lang('the_total_top')."]" . $arc['title'];
                }
                if ($arc['toppost'] == 2) {
                    $subcatids = $category->son($catid[0]);
                    if ($arc['catid'] != $catid[0] && !in_array($arc['catid'], $subcatids)) {
                        unset($tops[$order]);
                    } else {
                        $tops[$order]['title'] = "[".lang('the_column_top')."]" . $arc['title'];
                    }
                }
            }

            $newlimit=$limit - count($tops);
            if($newlimit>0){
                $archives = $archive->getrows($where . ' AND checked=1 AND toppost=0', $newlimit, $order, $archive->getcols('list'));
            }else{
                $archives=array();
            }
            $archives = array_merge($tops, $archives);
        }
        //var_dump($archives);

        $isint =usergroup::getisint(user::getuserid());      //获取是否取整
        $templatelang =lang::getistemplate();
        foreach ($archives as $order => $arc) {
            if (!$arc['introduce'])
                $arc['introduce'] = cut($arc['content'], $arc['introduce_len'] ? $arc['introduce_len'] : 200);
            if ($arc['nofollow']){
                $nofollow = '" rel="nofollow';
            }else{
                $nofollow = '';
            }
            $archives[$order]['url'] = $arc['linkto'] ? $arc['linkto'] : archive::url($arc).$nofollow;
            $archives[$order]['catname'] = category::name($arc['catid']);
            $archives[$order]['caturl'] = category::url($arc['catid']);
            $archives[$order]['image'] = @strstr($arc['image'], "http://") ? $arc['image'] : config::get('base_url') . '/' . $arc['image'];
            $archives[$order]['adddate'] = sdate($arc['adddate']);
            $archives[$order]['stitle'] = strip_tags($arc['title']);
            $archives[$order]['title'] = tool::cn_substr($arc['title'], $length);
            $archives[$order]['strgrade'] = archive::getgrade($arc['grade']);
            $archives[$order]['buyurl'] = url('archive/orders/aid/' . $arc['aid']);
            $newcname='attr2_'.$templatelang;
            $attr2=json_decode($arc['attr2'],true);
            $arc['attr2']=$archives[$order]['attr2']=is_array($attr2)?$attr2[$newcname]:$arc['attr2'];

            $prices = getPrices($arc['attr2']);
            $prices['price']=isset($prices['price']) && $prices['price']!=""?$prices['price']:0;
            $archives[$order]['oldprice'] = $prices['oldprice'];
            if($isint){                                                   //取整
                $prices['price']=round($prices['price']);
            }
            $archives[$order]['attr2'] = $prices['price'];
            if (!$intro_len) {
                $archives[$order]['intro'] = '';
            } else if ($intro_len == '-1') {
                $archives[$order]['intro'] = $arc['introduce'];
            } else {
                $archives[$order]['intro'] = cut($arc['introduce'], $intro_len);
            }
            if (strtolower(substr($arc['thumb'], 0, 7)) == 'http://') {
                $archives[$order]['sthumb'] = $arc['thumb'];
            } else {
                $archives[$order]['sthumb'] = config::get('base_url') . '/' . $arc['thumb'];
            }
            $pics = unserialize($arc['pics']);
            if (is_array($pics) && !empty($pics)) {
                $archives[$order]['pics'] = $pics;
            }
            if ($arc['strong'] && !front::$isadmin && !front::get('pageset')) {
                $archives[$order]['title'] = '<strong>' . $archives[$order]['title'] . '</strong>';
            }
            if ($arc['color'] != "#000000" && !front::$isadmin && !front::get('pageset')) {
                $archives[$order]['title'] = '<font style="color:' . $arc['color'] . ';">' . $archives[$order]['title']. '</font>';
            }
            $taghtml = '';
            if(file_exists(ROOT."/lib/table/tag.php")) {
                $tag_table = tag::getInstance();
                foreach ($tag_table->urls($arc['tag']) as $tag => $url) {
                    $taghtml .= "<a href='$url' target='_blank' class='archive-tag'>$tag</a>";
                }
            }

            $archives[$order]['tag'] = $taghtml;

            cb_data($archives[$order]);

        }
        if ($ordertype != 'rand()')
            cache::set($cache_id, $archives);
    }

    if ($tpl) {
        front::$view->_var->articles = $archives;
        return template($tpl);
    } else
        return $archives;
}

function servicearchive($catid = '0', $area = '0,0,0', $length = 20, $ordertype = 'aid', $limit = 10, $image = false, $attr1 = null,
                 $son = true, $wheretype = '', $tpl = null, $intro_len = '0', $istop = 0,$isvisual=false)
{
    //$args = func_get_args();
    //var_dump($args);
    $_ordertype = $ordertype;
    if (front::$isvalue || front::$isadmin || front::get('pageset'))  //区分前后台缓存 可视化不加载颜色
        $cache_id =lang::getistemplate()."/servicearchive/all/archive-".$catid.'-'.$length.'-'.$ordertype.'-'.$limit.'_admin';
    else
        $cache_id =lang::getistemplate()."/servicearchive/all/archive-".$catid.'-'.$length.'-'.$ordertype.'-'.$limit;
    if ($ordertype == 'rand()')
        $cache_id = $cache_id . time();
    if (cache::get($cache_id)){
        $archives = cache::get($cache_id);
    }
    else {
        $ordertype = str_replace('-', ' ', $ordertype);
        $wheretype = str_replace('-', ' ', $wheretype);
        $order = 'listorder=0,listorder DESC ';
        if (preg_match('/^\w+$/', $ordertype))
            $order .= ',' . $ordertype . ' desc';
        elseif ($ordertype)
            $order .= ',' . $ordertype;
        $where = array();
        if ($wheretype)
            foreach (explode(',', $wheretype) as $_wheretype)
                switch ($_wheretype) {
                    case 'day' :
                        $where[] = 'adddate>' . date('Y-m-d H:i:s', time() - 3600 * 24);
                        break;
                    case 'week' :
                        $where[] = 'adddate>' . date('Y-m-d H:i:s', time() - 3600 * 24 * 7);
                        break;
                    case 'month' :
                        $where[] = 'adddate>' . date('Y-m-d H:i:s', time() - 3600 * 24 * 30);
                        break;
                    default :
                        if (preg_match('/commend=(\d+)/i', $_wheretype, $match))
                            $where[] = " attr1 REGEXP  '(^|,)$match[1](,|$)'  ";
                        else if (preg_match('/^\w+$/', $_wheretype))
                            $where[] = $_wheretype . "<>''";
                        else
                            $where[] = $_wheretype;
                        break;
                }
        if (!empty($where))
            $where = ' and ' . implode(' and ', $where);
        else
            $where = '';
        $archive = servicearchive::getInstance();
        $category = servicecategory::getInstance();
        $categories = array();
        if (isset($catid) && $catid != '0') {
            $catid = explode('-', $catid);
            //var_dump($catid);
            $categories = $catid;
            $_categories1 = array();
            if ($son && !empty($categories)) {

                foreach ($categories as $key => $val) {
                    $_categories[$key] = $category->sons($val);
                    $_categories1 = @array_merge($_categories[$key], $_categories1);
                }
                //var_dump($_categories);
            }
            //var_dump($categories);
            $categories = @array_merge($categories, $_categories1);
            //var_dump($categories);
        }
        $where = '1';
        if (!empty($categories))
            $where .= ' and catid in (' . implode(',', $categories) . ')';
        list($province_id, $city_id, $section_id) = explode(',', $area);
        if ($province_id)
            $where .= ' and province_id=' . $province_id;
        if ($city_id)
            $where .= ' and city_id=' . $city_id;
        if ($section_id)
            $where .= ' and section_id=' . $section_id;
        if ($image)
            $where .= ' and thumb <> "" ';
        /*if ($attr1)
            $where .= " and FIND_IN_SET('$attr1',attr1) ";*/
        if ($attr1) {
            $where .= " and (attr1='{$attr1}' OR attr1 LIKE '{$attr1},%' or attr1 LIKE '%,{$attr1},%' or attr1 LIKE '%,{$attr1}')";
        }
        if ($_ordertype == 'aid-asc') {
            $order .= ',aid asc';
        }
        if ($_ordertype == 'new') {
            $order .= ',adddate desc';
        }

        $where.=" and langid=".lang::getlangid(lang::getistemplate());
        //var_dump($where);
        $tops = array();
        if ($istop) {
            $tops = $archive->getrows($where . " AND isput=1 AND toppost!=0", $limit, 'toppost DESC,listorder=0,listorder ASC,aid DESC');
        }
        $archives = $archive->getrows($where . ' AND isput=1 and toppost=0', $limit, $order, $archive->getcols('list'));
        //var_dump($archives);
        if (is_array($tops) && !empty($tops)) {
            foreach ($tops as $order => $arc) {
                if ($arc['toppost'] == 3) {
                    $tops[$order]['title'] = "[".lang('the_total_top')."]" . $arc['title'];
                }
                if ($arc['toppost'] == 2) {
                    $subcatids = $category->son($catid[0]);
                    if ($arc['catid'] != $catid[0] && !in_array($arc['catid'], $subcatids)) {
                        unset($tops[$order]);
                    } else {
                        $tops[$order]['title'] = "[".lang('the_column_top')."]" . $arc['title'];
                    }
                }
            }

            $newlimit=$limit - count($tops);
            if($newlimit>0){
                $archives = $archive->getrows($where . ' AND checked=1 AND toppost=0', $newlimit, $order, $archive->getcols('list'));
            }else{
                $archives=array();
            }
            $archives = array_merge($tops, $archives);
        }
        //var_dump($archives);

        $isint =usergroup::getisint(user::getuserid());      //获取是否取整
        $templatelang =lang::getistemplate();
        foreach ($archives as $order => $arc) {
            if (!$arc['introduce'])
                $arc['introduce'] = cut($arc['content'], $arc['introduce_len'] ? $arc['introduce_len'] : 200);
            if ($arc['nofollow']){
                $nofollow = '" rel="nofollow';
            }else{
                $nofollow = '';
            }
            $archives[$order]['url'] = $arc['linkto'] ? $arc['linkto'] : servicearchive::url($arc).$nofollow;
            $archives[$order]['catname'] = servicecategory::name($arc['catid']);
            $archives[$order]['caturl'] = servicecategory::url($arc['catid']);
            $archives[$order]['image'] = @strstr($arc['image'], "http://") ? $arc['image'] : config::get('base_url') . '/' . $arc['image'];
            $archives[$order]['adddate'] = sdate($arc['adddate']);
            $archives[$order]['stitle'] = strip_tags($arc['title']);
            $archives[$order]['title'] = tool::cn_substr($arc['title'], $length);
            $archives[$order]['strgrade'] = servicearchive::getgrade($arc['grade']);
            $archives[$order]['buyurl'] = url('proxy/orders/aid/' . $arc['aid']);

            $newcname='attr2_'.$templatelang;
            $attr2=json_decode($arc['customize_attr2'],true);
            $attr2=is_array($attr2)?$attr2:array();
            //取出中文价格
            $attr2_cn_price=(is_array($attr2) && isset($attr2['attr2_cn']))?$attr2['attr2_cn']:0;
            //当前价格不存在则使用中文价格
            $attr2[$newcname]=(is_array($attr2) && isset($attr2[$newcname]))?$attr2[$newcname]:$attr2_cn_price;
            //若是没有设置多语言 默认使用原来价格  否则使用多语言价格
            $arc['customize_attr2']=is_numeric($arc['customize_attr2'])?$arc['customize_attr2']:$attr2[$newcname];

            $prices = getPrices($arc['customize_attr2']);
            $prices['price']=isset($prices['price']) && $prices['price']!=""?$prices['price']:0;
            $archives[$order]['oldprice'] = $prices['oldprice'];
            if($isint){                                                   //取整
                $prices['price']=round($prices['price']);
            }
            $archives[$order]['attr2'] = $prices['price'];
            if (!$intro_len) {
                $archives[$order]['intro'] = '';
            } else if ($intro_len == '-1') {
                $archives[$order]['intro'] = $arc['introduce'];
            } else {
                $archives[$order]['intro'] = cut($arc['introduce'], $intro_len);
            }
            if (strtolower(substr($arc['thumb'], 0, 7)) == 'http://') {
                $archives[$order]['sthumb'] = $arc['thumb'];
            } else {
                $archives[$order]['sthumb'] = config::get('base_url') . '/' . $arc['thumb'];
            }
            $pics = unserialize($arc['pics']);
            if (is_array($pics) && !empty($pics)) {
                $archives[$order]['pics'] = $pics;
            }
            if ($arc['strong'] && !front::$isadmin && !front::get('pageset')) {
                $archives[$order]['title'] = '<strong>' . $archives[$order]['title'] . '</strong>';
            }
            if ($arc['color'] != "#000000" && !front::$isadmin && !front::get('pageset')) {
                $archives[$order]['title'] = '<font style="color:' . $arc['color'] . ';">' . $archives[$order]['title']. '</font>';
            }
            cb_data($archives[$order]);

        }
        if ($ordertype != 'rand()')
            cache::set($cache_id, $archives);
    }

    if ($tpl) {
        front::$view->_var->articles = $archives;
        return template($tpl);
    } else
        return $archives;
}

function create_guid($namespace = '')
{
    static $guid = '';
    $uid = uniqid("", true);
    $data = $namespace;
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['LOCAL_ADDR'];
    $data .= $_SERVER['HTTP_COOKIE'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = '{' .
        substr($hash, 0, 8) .
        '-' .
        substr($hash, 8, 4) .
        '-' .
        substr($hash, 12, 4) .
        '-' .
        substr($hash, 16, 4) .
        '-' .
        substr($hash, 20, 12) .
        '}';
    return $guid;
}

function get_hash()
{
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()+-';
    $random = '';
    for ($i = 0; $i < 128; $i++) {
        $random .= $chars[mt_rand(0, 73)];
    }

    //$random = $chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)];//Random 5 times
    $content = create_guid($_SERVER['HTTP_ACCEPT']) . uniqid() . $random;  // 类似 5443e09c27bf4aB4uT
    return sha1($content);
}


function special($spid = 0, $tpl = null)
{
    if(!file_exists(ROOT."/lib/table/special.php")) {
        return array();
    }
    $special = special::getInstance();
    $where = '';
    if ($spid) {
        $where = "spid in($spid)";
    }
    $specials = $special->getrows($where);
    $i = 0;
    foreach ($specials as $v) {
        $url = $special->url($v['spid'], $v['ishtml']);
        $specials[$i]['url'] = $url;
        $i++;
    }
    if ($tpl) {
        front::$view->_var->specials = $specials;
        return template($tpl);
    } else
        return $specials;
}


function phpox_decode($str = '')
{
    return $str . xxtea_decrypt(base64_decode('c66r8Pq3NOuNBimVgkPpL+ljBwABX5N4WIfY2djYQ1X3ZpTRW84XtoD3bVLXEJ/BA+7c//ppNaEcma0ddAB4SM8etTWqCuVYaDd4/MbkFUil8vfZQADCm1DNFRO/JME4wwYwo5bj48J0z3Gw5MeXpg=='), 'nibushiren');
}

function announ($num = 10, $title_len = 0, $is_date = true)
{
    $announcement = new announcement();
    $announcs = $announcement->getrows('langid='.lang::getlangid(lang::getistemplate()), $num,' recommend desc');

    foreach ($announcs as $order => $annc) {
        if ($title_len > 0) {
            $announcs[$order]['title'] = cut($annc['title'], $title_len);
        }
        if ($is_date) {
            $announcs[$order]['adddate'] = sdate($annc['adddate']);
        } else {
            unset($announcs[$order]['adddate']);
        }
        $announcs[$order]['is_date'] = $is_date;
        $announcs[$order]['url'] = announcement::url($annc['id']);
    }
    return $announcs;
}

function comment($aid)
{
    $comment = new comment();
    return $comment->getrows('aid=' . front::get('aid'), 10);
}

function userGroupList()
{
    $usergroup = usergroup::getInstance();
    $rows = $usergroup->getrows(null, 0, 'groupid asc', 'groupid,name,discount');
    return $rows;

}



/**
 * @param int $groupid
 * @param int $isblock 是否调用冻结会员
 * @param int $isdelete 是否调用删除会员
 * @return array
 *
 */
function userList($groupid = 0, $isblock = 1, $isdelete = 1)
{
    $user = user::getInstance();
    $where = null;
    if ($groupid) {
        $where = array('groupid' => $groupid);
    }
    if (!$isblock) {
        $where['isblock'] = 0;
    }
    if (!$isdelete) {
        $where['isdelete'] = 0;
    }

    $rows = $user->getrows($where, 0, 'groupid,nickname asc');
    $arrs = array();
    $i = 0;
    if (is_array($rows) && !empty($rows)) {
        foreach ($rows as $row) {
            unset($row['password']);
            $arrs[] = $row;
            $i++;
        }
    }
    return $arrs;
}

function archive_attachment($aid, $key)
{
    if (!$aid)
        return;
    $oattachment = new attachment();
    $attachment = $oattachment->getrow('aid=' . $aid);
    if (is_array($attachment) && isset($attachment[$key]))
        return $attachment[$key];
    else
        return;
}

function sdate($date, $format = 'Y-m-d')
{
    return tool::date_format($date, $format);
}

function autotempdir($dirname,$page=0)
{
    //var_dump($dirname);
    $page_size=1;   //每页数量
    $dirname = 'visual/' . $dirname;
    $fileurl=TEMPLATE_ADMIN . '/' . config::get('template_admin_dir') . '/' .$dirname;
    if(is_dir($fileurl)){
        $list = front::buyscan($fileurl);
        if ($page==0){
            echo count($list);
            exit;
        }
        else{
            $list=array_slice($list, $page-1, $page_size);
        }
        sort($list);
        //随机数
        $patterns[] = '/\$_divnum/';
        $replacements[] = randomkeys(6);
        if (is_array($list) && !empty($list)) {
            foreach ($list as $t) {
                if(!file_exists(ROOT."/lib/table/type.php") && ($t=="menu-list-type" || $t==="tag_type"))  continue;
                if(!file_exists(ROOT."/lib/table/tag.php") && $t=="tag-list")  continue;
                if(strpos($t,'.') !== false ){
                    $path=ROOT . '/cache/'.lang::getisadmin().'/template_admin/'.config::getadmin('template_admin_dir').'/'.$dirname;
                    $cacheFile=$path.'/#'.$t;
                    $fileurl_path=$fileurl.'/'.$t;
                    if(file_exists($cacheFile)){
                        $filemtime_cache=filemtime($cacheFile);
                    }else{
                        $filemtime_cache=0;
                    }
                    if (filemtime($fileurl_path)>$filemtime_cache){
                        $content=file_get_contents($fileurl_path);
                        $content=front::$view->compile($content);
                        if (!file_exists( $path )) {mkdir ($path,0777,true );}
                        file_put_contents($cacheFile, $content);

                        $content=front::$view->_eval($cacheFile);
                        $content = preg_replace($patterns, $replacements, $content);
                        file_put_contents($cacheFile, $content);
                    }
                    $content=file_get_contents($cacheFile);
                    echo  $content;
                }
                else{
                    if (file_exists($fileurl.'/'.$t.'/lang/'.lang::getisadmin().'/system_modules.php'))
                        load_sections_lang($fileurl.'/'.$t.'/lang/'.lang::getisadmin().'/system_modules.php');
                    $default_path=$fileurl.'/'.$t.'/default.config.php';
                    if(file_exists($default_path)){
                        $default_data=include $default_path;
                        if (is_array($default_data) && isset($default_data['type'])){
                            if ($default_data['type']=="tag" && !file_exists(ROOT."/lib/table/tag.php")){
                                continue;
                            }
                            if ($default_data['type']=="special" && !file_exists(ROOT."/lib/table/special.php")){
                                continue;
                            }
                            if ($default_data['type']=="guestbook" && !file_exists(ROOT."/lib/table/guestbook.php")){
                                continue;
                            }
                            if ($default_data['type']=="type" && !file_exists(ROOT."/lib/table/type.php")){
                                continue;
                            }
                        }
                    }

                    $path=ROOT . '/cache/'.lang::getisadmin().'/template_admin/'.config::getadmin('template_admin_dir').'/'.$dirname.'/'.$t;
                    $cacheFile=$path.'/#'.$t.'.php';
                    $fileurl_path=$fileurl.'/'.$t.'/'.$t.'.php';
                    if(file_exists($cacheFile)){
                        $filemtime_cache=filemtime($cacheFile);
                    }else{
                        $filemtime_cache=0;
                    }
                    if (filemtime($fileurl_path)>$filemtime_cache){  
                        $content=front::$view->_eval($fileurl_path,true);
                        $content=front::$view->compile($content);
                        if (!file_exists( $path )) {mkdir ($path,0777,true );}
                        file_put_contents($cacheFile, $content);
                        $content=front::$view->_eval($cacheFile);
                        $content = preg_replace($patterns, $replacements, $content);
                        file_put_contents($cacheFile, $content);

                    }
                    $content=file_get_contents($cacheFile);
                    echo  $content;

                }
            }
        }
    }
}

function autotempdirmodals($dirname)
{
    //var_dump($dirname);
    $dirname = 'visual/' . $dirname;
    $fileurl=TEMPLATE_ADMIN . '/' . config::get('template_admin_dir') . '/' .$dirname;
    if(is_dir($fileurl)){
        $list = front::buyscan($fileurl);
        sort($list);
        if (is_array($list) && !empty($list)) {
            foreach ($list as $t) {
                //公用文件区分类别
                if ($t=="list"){
                    if (front::get("type")=="special"){
                        $file_type="special";
                    }else
                        if (front::get("type")=="type"){
                            $file_type="type";
                        }else{
                            $file_type="list";
                        }
                    $newt=$file_type.'_'.$t;
                }else{
                    $newt=$t;
                }
                if(strpos($t,'.') !== false ){
                    $path=ROOT . '/cache/'.lang::getisadmin().'/template_admin/'.config::getadmin('template_admin_dir').'/'.$dirname;
                    $cacheFile=$path.'/#'.$newt;
                    $fileurl_path=$fileurl.'/'.$t;
                    if(file_exists($cacheFile)){
                        $filemtime_cache=filemtime($cacheFile);
                    }else{
                        $filemtime_cache=0;
                    }
                    if (filemtime($fileurl_path)>$filemtime_cache){
                        $content=file_get_contents($fileurl_path);
                        $content=front::$view->compile($content);
                        if (!file_exists( $path )) {mkdir ($path,0777,true );}
                        file_put_contents($cacheFile, $content);
                    }
                    $content=front::$view->_eval($cacheFile);
                    echo  $content;
                }else{
                    $path=ROOT . '/cache/'.lang::getisadmin().'/template_admin/'.config::getadmin('template_admin_dir').'/'.$dirname.'/'.$t;
                    $cacheFile=$path.'/#'.$newt.'.php';
                    $fileurl_path=$fileurl.'/'.$t.'/'.$t.'.php';
                    if(file_exists($cacheFile)){
                        $filemtime_cache=filemtime($cacheFile);
                    }else{
                        $filemtime_cache=0;
                    }
                    if (filemtime($fileurl_path)>$filemtime_cache){
                        $content=front::$view->_eval($fileurl_path,true);
                        $content=front::$view->compile($content);
                        if (!file_exists( $path )) {mkdir ($path,0777,true );}
                        file_put_contents($cacheFile, $content);
                        $content=front::$view->_eval($cacheFile);
                        file_put_contents($cacheFile, $content);
                    }
                    $content=file_get_contents($cacheFile);
                    echo  $content;
                }
            }
        }
    }
}

function autofronttempdir($dirname,$returndata=array(),$isshopping=0,$page=0)
{
    //var_dump($dirname);
    $page_size=1;   //每页数量
    if($isshopping)
        $fileurl= TEMPLATE.'/'.config::getdefault('template_shopping_dir').'/visual/' . $dirname;
    else
        $fileurl= TEMPLATE.'/'.config::getdefault('template_dir').'/visual/' . $dirname;
    if(is_dir($fileurl)){
        $list = front::buyscan($fileurl);

        if ($page==0){
            echo count($list);
            exit;
        }
        else{
            $list=array_slice($list, $page-1, $page_size);
        }
        sort($list);
        if (is_array($list) && !empty($list)) {
            foreach ($list as $t) {
                if(strpos($t,'.') !== false ){
                    $path=ROOT . '/cache/'.lang::getisadmin().'/template/'.config::get('template_dir').'/'.$dirname;
                    $cacheFile=$path.'/#'.$t;
                    $fileurl_path=$fileurl.'/'.$t;
                    if(file_exists($cacheFile)){
                        $filemtime_cache=filemtime($cacheFile);
                    }else{
                        $filemtime_cache=0;
                    }
                    if (filemtime($fileurl_path)>$filemtime_cache){
                        $content=file_get_contents($fileurl_path);
                        $content=front::$view->compile($content);
                        if (!file_exists( $path )) {mkdir ($path,0777,true );}
                        file_put_contents($cacheFile, $content);
                    }
                    echo  front::$view->_eval($cacheFile);
                }
                else{
                    load_sections_lang($fileurl.'/'.$t.'/lang/'.lang::getisadmin().'/system_modules.php');
                    $path=ROOT . '/cache/'.lang::getisadmin().'/template/'.config::get('template_dir').'/'.$dirname.'/'.$t;
                    //或者组件配置
                    $default_path=$fileurl.'/'.$t.'/default.config.php';
                    $default_data=include $default_path;
                    if (is_array($default_data) && isset($default_data['type'])){
                        if ($default_data['type']=="tag" && !file_exists(ROOT."/lib/table/tag.php")){
                            continue;
                        }
                        if ($default_data['type']=="special" && !file_exists(ROOT."/lib/table/special.php")){
                            continue;
                        }
                        if ($default_data['type']=="guestbook" && !file_exists(ROOT."/lib/table/guestbook.php")){
                            continue;
                        }
                        if ($default_data['type']=="type" && !file_exists(ROOT."/lib/table/type.php")){
                            continue;
                        }
                    }

                    $cacheFile=$path.'/#'.$t.'.php';
                    $fileurl_path=$fileurl.'/'.$t.'/'.$t.'.php';
                    if(file_exists($cacheFile)){
                        $filemtime_cache=filemtime($cacheFile);
                    }else{
                        $filemtime_cache=0;
                    }
                    if (filemtime($fileurl_path)>$filemtime_cache){
                        $content=front::$view->_eval($fileurl_path,true);
                        $content=front::$view->compile($content);
                        if (!file_exists( $path )) {mkdir ($path,0777,true );}
                        file_put_contents($cacheFile, $content);
                        $content=front::$view->_eval($cacheFile);
                        file_put_contents($cacheFile, $content);
                    }

                    $content=file_get_contents($cacheFile);
                    echo  $content;
                }
            }
        }
    }
}

function make_xml(){
    $category =category::getInstance();
    $archive =archive::getInstance();
    $where="1=1 ";
    $where.= ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
    if (config::getadmin("met_sitemap_not1")){
        $where=" isnav=1";
    }
    $category_data= $category->getrows($where, 0);


    $site_url = config::get('site_url');
    $head = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
    $head .= "<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">\r\n";
    $foot = "</urlset>";
    $code = '';
    if (is_array($category_data) && !empty($category_data)) {
        //var_dump($articles);
        foreach ($category_data as $cat) {
            //$url = substr($site_url, 0, -1) . archive::url($arr);
            $_url = category::url($cat['catid']);
            if(preg_match('/^http/i',$_url)){
                $url = category::url($cat['catid']);
            }else{
                $url = substr($site_url, 0, -1) .  category::url($cat['catid']);
            }
            $adddate = date("Y-m-d\TH:i:s+00:00", strtotime(date('Y-m-d h:i:s', time()))); //$cat['adddate']
            $code .= xml_gs($url,$adddate);
            $arrwhere="catid=".$cat['catid'];
            $arrwhere.= ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            $articles = $archive->getrows($arrwhere, 0);
            if (is_array($articles) && !empty($articles)) {
                foreach ($articles as $arr) {
                    $_url = archive::url($arr);
                    if(preg_match('/^http/i',$_url)){
                        $url = archive::url($arr);
                    }else{
                        $url = substr($site_url, 0, -1) .  archive::url($arr);
                    }
                    $adddate = date("Y-m-d\TH:i:s+00:00", strtotime($arr['adddate'])); //
                    $code .= xml_gs($url,$adddate);
                }
            }
        }
        file_put_contents("sitemap.xml", $head . $code . $foot);
    }
}
function xml_gs($url,$adddate){
    $code="";
    $code .="<url>" . "\r\n";
    $code .="<loc>{$url}</loc>" . "\r\n";
    $code .="<lastmod>{$adddate}</lastmod>" . "\r\n";
    $code .="<changefreq>monthly</changefreq>" . "\r\n";
    $code .="<priority>0.5</priority>" . "\r\n";
    $code .="</url>" . "\r\n";
    return $code;
}

function template($tpl,$no_cache=true)
{

    if(!front::$ismobile){
        $tpl = ROOT.'/template/'.config::get('template_dir').'/'.$tpl;
        if(!file_exists($tpl))
        {
            return "";
        }
    }


   if (strpos($tpl,"header.html") !== false || strpos($tpl,"footer.html") !== false
       || !$no_cache  || strpos($tpl,"position.html") !== false || strpos($tpl,"top.html") !== false
       || strpos($tpl,"bottom.html") !== false || strpos($tpl,"system/servers.html") !== false
       || strpos($tpl,"system/sms.html") !== false || strpos($tpl,"system/foot_nav_a.html") !== false
       || strpos($tpl,"system/foot_nav_c.html") !== false || strpos($tpl,"foot_js.html") !== false
   ){
       return front::$view->fetch($tpl,false,false);
   }else{
       return front::$view->fetch($tpl,true,$no_cache);
   }

}

function template_php_make($tpl)
{
    if ($tpl=="header.html"){
        front::$admin = false;
        front::$isadmin = false;
        return front::$view->fetch($tpl,false,false);
    }
    if ($tpl=="footer.html"){
      /*  $cache_path=ROOT . '/'.lang::getistemplate().'/template/'.front::$view->_style.'/' . $tpl;
        $cache_path=str_replace('.html','.php',$cache_path);
        //不存在的情况则生成
        if (!file_exists($cache_path)) {
            cache_make::get_make_footer(lang::getistemplate(),lang::getisadmin());
        }
        $content=front::$view->_eval($cache_path,true);
        return  $content;*/
        front::$admin = false;
        front::$isadmin = false;
        return front::$view->fetch($tpl,false,false);
    }
}

function template_public($tpl,$no_cache=true)
{
    $tpl =ROOT.'/'.$tpl;
    if(!file_exists($tpl))
    {
        return "";
    }
    if (strpos($tpl,"common/plugins/public/header-js.html") !== false
        || strpos($tpl,"common/plugins/public/foot-js.html") !== false
    ){
        return front::$view->fetch($tpl,false,false);
    }else{
        return front::$view->fetch($tpl,true,$no_cache);
    }
}

function template_shopping($tpl,$no_cache=true)
{

    $tpl = ROOT.'/template/'.config::get('template_shopping_dir').'/'.$tpl;
    if (strpos($tpl,"header.html") !== false  || strpos($tpl,"footer.html") !== false
        || !$no_cache  || strpos($tpl,"position.html") !== false){
        return front::$view->fetch($tpl,false,false);
    }else{
        return front::$view->fetch($tpl,true,$no_cache);
    }
}


function admintemplate($tpl)
{
    return front::$view->adminfetch($tpl);
}

function template_user($tpl)
{
    $tpl = ROOT.'/template/'.config::get('template_user_dir').'/'.$tpl;
    return front::$view->fetch($tpl);
}

function template_admin($tpl)
{
    return front::$view->fetch($tpl);
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key != '' ? $key : 'phpox');
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }

}

function pages($name = null)
{
    $pages = pagination::pages(front::$record_count);
    if (!$name)
        return $pages['pages'];
    if (isset($pages[$name]))
        return $pages[$name];
}

function pages1($name = null)
{
    $pages = pagination::pages1(front::$record_count);
    if (!$name)
        return $pages['pages'];
    if (isset($pages[$name]))
        return $pages[$name];
}

function pagination($catid, $tpl = 'system/pagination')
{
    front::$view->_var->catid = $catid;
    return template($tpl,false);
}

function type_pagination($typeid, $tpl = 'system/type_pagination.html')
{
    front::$view->_var->typeid = $typeid;
    return template($tpl,false);
}

function comment_pagination($aid, $tpl = 'system/comment_pagination.html')
{
    front::$view->_var->aid = $aid;
    return template($tpl,false);
}

function category_pagination($catid,$tpl = 'system/category_pagination.html')
{

    front::$view->_var->catid = $catid;
    return template($tpl,false);
}

function tags_pagination($tag, $tpl = 'system/tag_pagination.html')
{
    front::$view->_var->tag = $tag;
    return template($tpl,false);
}

function screening_pagination($page,$record_count, $tpl = 'system/screening_pagination.html')
{
    front::$view->_var->page = $page;
    front::$view->_var->record_count = ($record_count/config::getadmin('list_pagesize'))<0?1:(int)($record_count/config::getadmin('list_pagesize'));
    return template_shopping($tpl,false);
}


function search_pagination($page,$record_count, $tpl = 'system/search_pagination.html')
{
    front::$view->_var->page = $page;
    front::$view->_var->record_count = ($record_count/config::getadmin('list_pagesize'))<0?1:(int)($record_count/config::getadmin('list_pagesize'));
    return template($tpl,false);
}

function guestbook_pagination($tpl = 'system/guestbook_pagination.html')
{
    return template($tpl,false);
}

function archive_pagination($archive, $tpl = 'system/archive_pagination.html')
{
    front::$view->_var->archive = $archive;
    return template($tpl,false);
}

function position($catid)
{
    return category::getpositionlink($catid);
}

function type_position($typeid)
{

    //提取分类
    if(!file_exists(ROOT."/lib/table/type.php")) {
        return array("");
    }
    return type::getpositionlink($typeid);
}

function position_p($catid)
{
    $row = category::getpositionlink($catid);
    $arr = array();
    if (is_array($row) && !empty($row)) {
        foreach ($row as $ar) {
            if ($ar['id'] == $catid) {
                $arr['name'] = $ar['name'];
                $arr['url'] = $ar['url'];
                return $arr;
            }
        }
    }
}

function position1($catid)
{
    return category::getpositionlink1($catid);
}

function url($_url, $pre = true)
{
    return url::create($_url, $pre);
}

function modify($_url, $true = true)
{
    return url::modify($_url, $true);
}

function defined_cname($key)
{
    if (preg_match('/^my_/', $key)) {
        $cname = @setting::$var[$key]['cname'];
        if ($cname)
            return $cname;
        $cname = @setting::$var[get('table')][$key]['cname'];
        if ($cname)
            return $cname;
        $cname = @setting::$var[get('form')][$key]['cname'];
        if ($cname)
            return $cname;
        $cname = @setting::$var[get('form')][$key]['myform']['cname'];
        if ($cname)
            return $cname;
    }
    return $cname;
}

function gethottags($num = 10)
{
    $set = settings::getInstance();
    $sets = $set->getrow(array('tag' => 'table-hottag'));
    if (!empty($sets)) {
        if (!empty($sets['value'])) {
            $hottags = unserialize($sets['value']);
        }
        if ($hottags['hottag']) {
            $hottags['hottag'] = str_replace("\r", "", $hottags['hottag']);
            $hottags = explode("\n", $hottags['hottag']);
            foreach ($hottags as $v) {
                echo '<a href="' . url('tag/show/tag/' . urlencode($v)) . '">' . $v . '</a> ';
            }
        }
    }
}

function gethotsearch($num)
{
    $path = ROOT . '/data/hotsearch_'.lang::getistemplate();
    if (!file_exists($path)) return "";
    $dir = opendir($path);
    $i = 0;
    $hotarr = array();
    while ($file = readdir($dir)) {
        if (!($file == '..')) {
            if (!($file == '.')) {
                if (!is_dir($path . '/' . $file)) {
                    $keyword = urldecode(substr($file, 0, -4));
                    $keywordcount = @file_get_contents($path . '/' . $file);
                    if ($keywordcount >= config::get('maxhotkeywordnum')) {
                        //echo '<a href="'.url('archive/search/keyword/'.str_replace('%','-',urlencode($keyword)).'/ule/1').'">'.$keyword.'</a> ';
                        $hotarr[$keyword] = $keywordcount;
                        $i++;
                    }
                    if ($i == $num)
                        break;
                }
            }
        }
    }
    arsort($hotarr);
    //var_dump($hotarr);
    $httmldata="";
    foreach ($hotarr as $keyword => $v) {
        $httmldata.='<a href="' . url('archive/search/keyword/' . str_replace('%', '-', urlencode($keyword)) . '/ule/1') . '">' . $keyword . '</a> ';
    }
    if($httmldata){
        echo  "<strong>".lang('hotkeys')."：</strong>".$httmldata;
    }
}

function view_js($aid)
{
    return '<script src="' . url('archive/view_js/aid/' . $aid, false) . '"></script>';
}

function jsPrice($aid)
{
    return '<script src="' . url('archive/jsPrice/aid/' . $aid, false) . '"></script>';
}

function login_js()
{
    return  '<script src="' . url('user/login_js', false) . '"></script>';
}

function comment_js($aid)
{
    if(config::get('comment_switch')==2){
        return lang('no_see_comment');
    }else if(config::get('comment_list')==1 && (config::get('comment_switch')==0 || (session::get('username')!='' && config::get('comment_switch')==1))) {
        return '<script src="' . url('comment/comment_js/aid/' . $aid, false) . '"></script>';
    }else{
        return "";
    }
}

function attachment_js($aid,$filename="")
{
    return '<script src="' . url('attachment/attachment_js/aid/' . $aid.'/filename/'.$filename, false) . '"></script>';
}

function verify()
{
    return helper::verify();
}

function ding()
{
    return helper::ding();
}

function hasflash()
{
    return front::hasflash();
}

function flash()
{
    return front::flash();
}

function showflash()
{
    return front::showflash();
}

function catname($catid,$proxy=false)
{
    if ($proxy){
        return servicecategory::name($catid);
    }else{
        return category::name($catid);
    }

}

function attr1($catid)
{
    return attr1::name($catid);
}

function typename($catid)
{
    //提取分类
    if(!file_exists(ROOT."/lib/table/type.php")) {
        return "";
    }
    return type::name($catid);
}

function typeimage($catid)
{
    return category::image($catid);
}

//获取当前用户未读通知数量
function getnotread(){
    $limit = (((front::get('page')?front::get('page'):1) - 1) * 20) . ',20';
    $where = " FIND_IN_SET('".user::getusersid()."',userid) ";
    $notificationdata=notification::getInstance()->getrows($where, $limit, 'adddatatime desc');
    $notifiid=user::getnotifiid();
    $num=0;
    if ($notifiid==''){
        if (is_array($notificationdata)){
            $num=count($notificationdata);
        }
    }else{
        if (is_array($notificationdata)){
            foreach ($notificationdata as $key=>$val){
                $source = explode(",",trim($notifiid));
                for($index=0;$index<count($source);$index++){
                    if($source[$index]==$notificationdata[$key]['id']){
                        $notificationdata[$key]['isread']='1';
                    }
                }
                if (!$notificationdata[$key]['isread']){
                    $num=$num+1;
                }
            }
        }
    }
    return $num;
}


//获取当前 通知列表数据
function getreadlist(){
    $limit = (((front::get('page')?front::get('page'):1) - 1) * 20) . ',20';
    $where = " FIND_IN_SET('".user::getusersid()."',userid) ";
    $notificationdata=notification::getInstance()->getrows($where, $limit, 'adddatatime desc');
    $notifiid=user::getnotifiid();
    $num=0;
    if (is_array($notificationdata)){
        foreach ($notificationdata as $key=>$val){
            if ($notifiid != ''){
                $source = explode(",",trim($notifiid));
                for($index=0;$index<count($source);$index++){
                    if($source[$index]==$notificationdata[$key]['id']){
                        $notificationdata[$key]['isread']='1';
                    }
                }
                if (!$notificationdata[$key]['isread']){
                    $notificationdata[$key]['isread']='0';
                }
            }else{
                $notificationdata[$key]['isread']='0';
            }
        }
    }

    return $notificationdata;
}


//获取语言包
function getlang(){
    $langdata=lang::getlang();
    //去掉过滤域名
    /* foreach ($langdata as $key=>$d){
         if( (strpos($d['domain'],$_SERVER['SERVER_NAME']) === false) && $d['domain'] !=''){
             unset($langdata[$key]);
         }
     }*/
    return $langdata;
}

//获取默认语言包
function getisdefault(){
    $langdata=lang::getisdefault();
    return $langdata;
}

//通过语言包文件夹名称   获取语言包名称
function getlangurlname($id){
    /* echo '<script>alert("'.$id.'");</script>';*/
    $langdata=lang::getInstance()->getrows('static=1 and langurlname="'.$id.'"', 1, 'id asc');
    if(count($langdata)>0){
        return $langdata[0]['langname'];
    }
    return '';
}

//通过语言包文件夹名称   获取语言包图片
function getlangimg($langurlname){
    /* echo '<script>alert("'.$id.'");</script>';*/
    $langdata=lang::getInstance()->getrows('static=1 and langurlname="'.$langurlname.'"', 1, 'id asc');
    if(count($langdata)>0){
        return $langdata[0]['langimg'];
    }
    return '';
}

//获取自定义字段的下拉框
function getfilename($nmae="archive",$filename=null,$key=0){
    if($filename){
        $value=setting::$var[$nmae][$filename]['select_'.lang::getisadmin()];
        preg_match_all('%\((.*?)\)(\S+)%s', $value, $result, PREG_SET_ORDER);
        foreach ($result as $res) if($res[1]==$key) return $res[2];
    }
    return "";
}

//获取当前用户的用户组折扣
function getdiscount(){
    return usergroup::getusergrop(user::getuserid());
}

//获取用户组名称
function usergroupname($gid)
{
    return usergroup::name($gid);
}

//查询用户积分
function getintegration()
{
    return user::getintegration();
}

//查询用户余额
function getmenoy()
{
    return user::getmenoy();
}

//查询用户优惠劵
function getcouponidnum()
{
    return user::getcouponidnum();
}

//查询用户名称
function getusername($userid)
{
    return user::getusername($userid);
}

//查询指定用户信息
function getuserheadimg($user。id)
{
    return user::getuserheadimg($userid);
}

//查询用户收藏
function getcollect($aid)
{
    if(session::get('ver') != 'corp' || !file_exists(ROOT."/template_admin/".config::get("template_admin_dir")."/usermanage/collectlist.php")){
        return "";
    }
    $data="<div name='getcollect_".$aid."'>";
    $data.='</div>';
    $data.='<script>$(function() {
         $.ajax({
                    type: "get",
                    url: "'.url('archive/getcollect',false).'&aid='.$aid.'",
                    async: false,
                    success: function (data) {
                        $("[name=getcollect_'.$aid.']").html(data);
                    }
           });
    });</script>';
    return $data;
}

//查询用户收藏
function getcollect_data($aid)
{
    if(session::get('ver') != 'corp' || !file_exists(ROOT."/template_admin/".config::get("template_admin_dir")."/usermanage/collectlist.php")){
        return '';
    }
    $loginurlname=url("user/login");
    if (session::get('username') ==""){
        return '<div class="visual-inline-block content-collection"><i class="icon-heart collection-btn" type="button" onclick="alert(\''.lang('please_log_in_first').'!\')" value="'.lang('collection').'"></i></div>';
    }
    $getcollect=user::getcollect();
    $urlname=url("archive/setcollect");
    if($getcollect==$aid ||  strpos($getcollect, ",".$aid) !== false
        ||  strpos($getcollect, $aid.",") !== false){
        return '<div class="visual-inline-block content-collection"><i class="glyphicon glyphicon-heart collection-btn" type="button" onclick="setcollect('.$aid.',\''.$urlname.'\',this)" value="'.lang('giveup').lang('collection').'"></i></div>';
    }else{
        return '<div class="visual-inline-block content-collection"><i class="icon-heart collection-btn" type="button" onclick="setcollect('.$aid.',\''.$urlname.'\',this)" value="'.lang('collection').'"></i></div>';
    }
}

//查询用户赞
function getraise($praise,$aid){
    if(session::get('ver') != 'corp' || !file_exists(ROOT."/template_admin/".config::get("template_admin_dir")."/usermanage/zanarchivelist.php")){
        return '';
    }
    $data="<div name='getraise_".$aid."'>";
    $data.='</div>';
    $data.='<script>$(function() {
         $.ajax({
                    type: "get",
                    url: "'.url('archive/getraise',false).'&aid='.$aid.'",
                    async: false,
                    success: function (data) {
                        $("[name=getraise_'.$aid.']").html(data);
                    }
           });
    });</script>';
    return $data;

}

//查询用户赞
function getraise_data($praise,$aid){
    if(session::get('ver') != 'corp' || !file_exists(ROOT."/template_admin/".config::get("template_admin_dir")."/usermanage/zanarchivelist.php")){
        return '';
    }

    if (session::get('username') ==""){
        return '<div class="visual-inline-block content-fabulous"><i class="icon-like fabulous-btn" type="button" onclick="alert(\''.lang('please_log_in_first').'!\')" value="'.lang('point-like').'"></i></div>';
    }
    $urlname=url("archive/setpraise");
    $data="";
    $iscz=false;
    $source = explode(",",trim($praise));
    for($index=0;$index<count($source);$index++){
        if(session::get('username') == $source[$index]){
            $iscz=true;
        }
    }
    if( $iscz){
        $data= '<div class="visual-inline-block content-fabulous"><i class="icon-like fabulous-btn" type="button" onclick="setpraise('.$aid.',\''.$urlname.'\',this)" value="'.lang('cancel_praise').'"></i>';
    }else{
        $data=  '<div class="visual-inline-block content-fabulous"><i class="icon-like fabulous-btn" type="button" onclick="setpraise('.$aid.',\''.$urlname.'\',this)" value="'.lang('point-like').'"></i>';
    }
    $data=$data.'<span>';
    if($praise != ''){
        if( strpos($praise, ',') !== false){
            $source = explode(",",trim($praise));
            $data=$data.count($source);
        }else{
            $data=$data. '1';
        }
    }else{
        $data=$data.'0';
    }
    $data=$data.'</span></div>';
    return $data;

}

//查询用户收藏模板
function getcollectbuytemplate($aid)
{
    if(session::get('ver') != 'corp' || !file_exists(ROOT."/template_admin/".config::get("template_admin_dir")."/usermanage/collectlist.php")){
        return '';
    }
    $loginurlname=url("user/login");
    if (session::get('username') ==""){
        return '<div class="content-collection"><i class="icon-heart collection-btn" type="button" onclick="alert(\''.lang('please_log_in_first').'!\')" value="'.lang('collection').'"></i></div>';
    }
    $getcollect=user::getcollectbuytemplate();
    $urlname=url("archive/setcollectbuytemplate");
    if( strpos($getcollect, $aid) !== false){
        return '<div class="content-collection"><i class="glyphicon glyphicon-heart collection-btn" type="button" onclick="setcollect(\''.$aid.'\',\''.$urlname.'\',this)" value="'.lang('giveup').lang('collection').'"></i></div>';
    }else{
        return '<div class="content-collection"><i class="icon-heart collection-btn" type="button" onclick="setcollect(\''.$aid.'\',\''.$urlname.'\',this)" value="'.lang('collection').'"></i></div>';
    }
}

//查询上级栏目的名称
function getcateorygetparent($catid=0,$fiel="")
{
    if ($catid && $fiel){
        $_category=category::getInstance();
        $_category->init();
        $parentid=$_category->getparent($catid);
        if ($fiel=="url"){
            return $_category->url($catid);
        }else if($fiel=="parenturl"){
            return $_category->url($parentid);
        }else
            return $_category->category[$parentid][$fiel];
    }
    return "";
}

//查询内容的所属栏目的
function getarchivecateoryget($aid,$fiel="")
{
    if ( $aid && $fiel){
        $archive=archive::getInstance()->getarchive($aid);
        $_category=category::getInstance();
        $_category->init();
        if ($fiel=="url"){
            return archive::url($archive);
        } else if ($fiel=="caturl"){
            return $_category->url($archive['catid']);
        }else
            return $_category->category[$archive['catid']][$fiel];
    }
    return "";
}

//查询栏目数据
function getcategorydata($catid)
{
    if ($catid){
        $_category=category::getInstance();
        $_category->init();
        return $_category->category[$catid];
    }
    return "";
}


function usergroupisadministrator($gid)
{
    return usergroup::isadministrator($gid);
}

function cut($string, $length = 20)
{
    return tool::cn_substr(strip_tags($string), $length, config::getdatabase('database', 'encoding'));
}

function caturl($catid, $page = null)
{
    return category::url($catid, $page);
}

function archiveurl($catid, $page = null)
{
    return archive::url($catid, $page);
}

function uri()
{
    return front::$uri;
}

function message()
{
    if (front::hasflash())
        return front::showflash();
}

function get($var,$admin=false)
{
    if (front::get($var))
        return front::get($var);
    else if (front::post($var))
        return front::post($var);
    else if ((config::getadmin($var)!="") || (config::get($var)!="")){
        if ($admin){
            return config::getadmin($var);
        }else{
            return config::get($var);
        }
    }
    else if (session::get($var))
        return session::get($var);
}

function tag()
{
}

function myfield($table, $field, $type, $value = '', $state = 'show')
{
}

function field($table, $field, $type, $value)
{
}

function countarchiveformtype($catid)
{
    $cache_id =lang::getistemplate()."/archive/all/countarchiveformtype-".$catid;
    $cache = cache::get($cache_id);
    if (isset($cache))
        $count = $cache;
    else
        $count = archive::countarchiveformtype($catid);
    if (cache::set($cache_id, $count, 60))
        ;
    return $count;
}

function countarchiveformcategory($catid)
{
    $cache_id =lang::getistemplate()."/archive/all/countarchiveformcategory-".$catid;
    $cache = cache::get($cache_id);
    if (isset($cache))
        $count = $cache;
    else
        $count = archive::countarchiveformcategory($catid);
    if (cache::set($cache_id, $count, 60))
        ;
    return $count;
}

function friendlink($type, $catid = 0, $limit = 100, $width = 100)
{
    $friendlink = new friendlink();
    switch ($type) {
        case 'image' :
            $linktype = 2;
            break;
        case 'text' :
            $linktype = 1;
            break;
        default :
            $linktype = '';
            break;
    }
    $where = " state>0 ";
    if ($catid)
        $where .= "and typeid=$catid ";
    if ($linktype)
        $where .= "and linktype=$linktype ";
    $friendlinks = $friendlink->getrows($where, $limit, 'listorder asc,id asc');
    foreach ($friendlinks as $order => $friendlink) {
        if ($friendlink['logo'] && $catid = 2)
            $link_str = helper::img($friendlink['logo'], $width);
        else
            $link_str = $friendlink['name'];
        $friendlinks[$order]['link'] = "<a href='$friendlink[url]' onmousedown='this.href=\"" . url("friendlink/click/id/$friendlink[id]/r/") . "\"+Math.random()*5;' target='_blank'>$link_str</a>";
    }
    return $friendlinks;
}

function ballot($id)
{
    $blot = new ballot();
    $row = $blot->getrow($id);
    if ($row) {
        $html = '<script type="text/javascript" src="' . url('ballot/getjs/id/' . $id) . '"></script>';
        return $html;
    }
}

function vote($id)
{
    return ballot($id);
}

function myform($table, $title = null)
{
    if (!$title)
        $title = @setting::$var[$table]['myform']['cname_'.lang::getistemplate()];
    $url = url('form/add/form/' . $table);
    return "<a href='$url'>$title</a>";
}

function vote_js($aid)
{
    return '<script src="' . url('vote/view/aid/' . $aid, false) . '"></script>';
}

function cb_item($table, $field, $value)
{
    return form::select_option($field, setting::$var[$table][$field], $value);
}

function cb_data(&$data, $table = 'archive')
{
    if (is_array($data) && !empty($data)) {
        foreach ($data as $key => $value) {
            if (preg_match('/^my_/', $key) && isset(setting::$var[$table][$key]) && @setting::$var[$table][$key]['selecttype']) {
                $data[$key] = cb_item($table, $key, $value);
            }
        }
    }
}

function cb_datas(&$datas, $table = 'archive')
{
    foreach ($datas as $order => $data)
        foreach ($data as $key => $value) {
            if (preg_match('/^my_/', $key) && isset(setting::$var[$table][$key]) && @setting::$var[$table][$key]['selecttype']) {
                $datas[$order][$key] = cb_item($table, $key, $value);
            }
        }
}

function load_lang($path,$custompath)
{
    if(front::get('case')=='install'){
        session::set('lang_getistemplate','');
        session::set('lang_getisadmin','');
        session::set('username','');
    }
    $lang = include ROOT . '/lang/' . lang::getistemplate() . '/' . $path;   //系统自带

    $customlang = include ROOT . '/lang/' . lang::getistemplate() . '/' . $custompath; //自定义

    front::$view->lang = array_merge(front::$view->lang, $lang,$customlang);
}

function lang($string)
{
    if (preg_match('/^my_/', $string))
        return defined_cname($string);
    else if (isset(front::$view->lang[$string])){
        return front::$view->lang[$string];
    }
    else
        return $string;
}


function load_admin_lang($path,$custompath)
{
    $adminlang=lang::getlangadminlang(lang::getisadmin());
    if($adminlang){
        $langurl=lang::getlangurlname($adminlang);
    }else{
        $langurl=lang::getisadmin();
    }

    $lang = include ROOT . '/lang/' . $langurl . '/' . $path;  //系统自带
    $customlang = include ROOT . '/lang/' . $langurl . '/' . $custompath; //自定义
    front::$view->lang_admin = array_merge(front::$view->lang_admin, (array)$lang,(array)$customlang);
}
function lang_admin($string)
{
    if(front::get('case')=='install'){
        session::set('lang_getistemplate','');
        session::set('lang_getisadmin','');
        session::set('username','');
    }
    if (preg_match('/^my_/', $string))
        return defined_cname($string);
    else if (isset(front::$view->lang_admin[$string]))
        return front::$view->lang_admin[$string];
    else
        return $string;

}
function load_expansion_lang($path,$expansionname)
{
    $adminlang=lang::getlangadminlang(lang::getisadmin());
    if($adminlang){
        $langurl=lang::getlangurlname($adminlang);
    }else{
        $langurl=lang::getisadmin();
    }
    $fliepath=ROOT . '/apps/'.$expansionname.'/lang/' . $langurl;
    $path=$fliepath . '/' . $path;
    if (!file_exists( $fliepath )) {mkdir ($fliepath,0777,true );}
    if (!file_exists( $path )) {
        @fopen($path, "w");
        file_put_contents($path, "<?php return  array(  'ces'=>'测试',); ?>");
    }

    $lang = include $path;
    front::$view->lang_expansion = $lang;
}
function lang_expansion($string)
{
    if (preg_match('/^my_/', $string))
        return defined_cname($string);
    else if (isset(front::$view->lang_expansion[$string])){
        return front::$view->lang_expansion[$string];
    }
    else
        return $string;
}

//加载组件的 语言包  写入缓存
function load_modules_lang($modulesname)
{
    if (session::get('buymodules_lang')==""){
        $adminlang=lang::getlangadminlang(lang::getisadmin());
        if($adminlang){
            $langurl=lang::getlangurlname($adminlang);
        }else{
            $langurl=lang::getisadmin();
        }
        $lang=array();
        $modulesarray=array("category","content","type","special","guestbook","comment","announ","common");
        foreach ($modulesarray as $val){
            $lang[$val]=array();  //初始化 防止不存在
            $filepath=ROOT . '/data/buymodules/'.$val;
            if(is_dir($filepath)){
                $list = front::buyscan($filepath);
                sort($list);
                if (is_array($list) && !empty($list)) {
                    foreach ($list as $t) {
                        if(strpos($t,'.') !== false ){
                        }else{
                            $moduleslangpath =ROOT.'/data/buymodules/'.$val.'/' . $t.'/lang/'.$langurl;
                            $langpath=$moduleslangpath . '/' . $modulesname;
                            if (!file_exists( $moduleslangpath )) {mkdir ($moduleslangpath,0777,true );}
                            if (!file_exists( $langpath )) {
                                @fopen($langpath, "w");
                                file_put_contents($langpath, "<?php return  array(  'ces'=>'测试',); ?>");
                            }
                            $thislang=include $langpath;
                            $lang[$val] =array_merge((array)$lang[$val],(array)$thislang);
                        }
                    }
                }
            }
        }
        $moduleslang=array_merge((array)$lang['category'],(array)$lang['content'],(array)$lang['type'],(array)$lang['special'],(array)$lang['guestbook'],(array)$lang['comment'],(array)$lang['announ'],(array)$lang['common']);
        session::set('buymodules_lang',$moduleslang);
    }
    front::$view->lang_modules_admin =session::get('buymodules_lang');

}
function lang_modules($string)
{
    if (preg_match('/^my_/', $string))
        return defined_cname($string);
    else if (isset(front::$view->lang_modules_admin[$string])){
        return front::$view->lang_modules_admin[$string];
    }
    else
        return $string;
}

//加载组件文件的 语言包  写入缓存
function load_sections_lang($path)
{
    if (!file_exists( $path )) {
        @fopen($path, "w");
        file_put_contents($path, "<?php return  array(  'ces'=>'测试',); ?>");
    }
    $lang = include $path;
    front::$view->lang_sections =$lang;

}
function lang_sections($string)
{
    if (preg_match('/^my_/', $string))
        return defined_cname($string);
    else if (isset(front::$view->lang_sections[$string])){
        return front::$view->lang_sections[$string];
    }
    else
        return $string;
}

//后台自定义语言包
function load_custom_admin_lang($path)
{
    $lang = include ROOT . '/lang/' . $path. '/system_admin.php';
    $customlang = include ROOT . '/lang/' . $path . '/system_admin_custom.php';
    front::$view->lang_custom_admin = array_merge((array)$lang,(array)$customlang);
}
function lang_custom_admin($string)
{
    if (preg_match('/^my_/', $string))
        return defined_cname($string);
    else if (isset(front::$view->lang_custom_admin[$string]))
        return front::$view->lang_custom_admin[$string];
    else
        return $string;
}

//前台自定义语言包
function load_custom_lang($path)
{
    $lang = include ROOT . '/lang/' . $path . '/system.php';
    $customlang = include ROOT . '/lang/' . $path . '/system_custom.php';
    front::$view->lang_custom = array_merge(front::$view->lang_custom, $lang,$customlang);
}
function lang_custom($string)
{
    if (preg_match('/^my_/', $string))
        return defined_cname($string);
    else if (isset(front::$view->lang_custom[$string]))
        return front::$view->lang_custom[$string];
    else
        return $string;
}

//用户的浏览记录
function getuserhistory($static){
    $historydata=history::getInstance()->getrows(" userid='".user::getusersid()."' and langid=".lang::getlangid(lang::getisadmin()),0);
    $history="";
    if (count($historydata)>0){
        $history='<div class="record-tab"><div class="swiper-container swiper-container-record-tab"><ul class="nav nav-tabs swiper-wrapper" id="record-tab" role="tablist">';
        $indexid="";
        if($static=="index"){  //如果是首页增加
            $indexid=0;
            $history.='<li class="active swiper-slide">';
            $history.='<a href="#" >';
            $history.=lang_admin('home').'</i>';
            $history.='</a> </li>';
        }
        $index=0;
        foreach ($historydata as $key=>$val){
            if($val['url']==uri()){
                $indexid=$val['id'];
                $history.='<li class="active swiper-slide">';
            }else{
                $index++;
                $history.='<li class="swiper-slide">';
            }
            $history.='<a href="#" onclick="gotourl(this)"  data-dataurlid="'.$val['id'].'" data-dataurlname="'.$val['urlname'].'"  data-dataurl="'.$val['url'].'">';
            $history.=$val['urlname'];
            $history.='</a> <i class="glyphicon glyphicon-remove record-tab-remove"></i></li>';
        }
        $history.='</ul></div><div class="swiper-button-next swiper-button-next-record-tab"></div><div class="swiper-button-prev swiper-button-prev-record-tab"></div>';

        if($index>0){
            $history.='';
            $history.='<a class="record-tab-clear" onclick="deletehistorydata(this);" >';
            $history.=lang_admin('empty').'</i>';
            $history.='</a></div>';
        }

        //关闭jq
        $history.='<script>    $(document).ready(function(){
            $(".record-tab-remove").click(function(){
                if($(this).parent().hasClass("active")){
                  alert("当前打开的不可关闭");
                }else{
                  $(this).parent().remove();
                  var dataurlid=$(this).prev().data("dataurlid");
                  //删除记录方法
                    $.ajax({
                    type: "get",
                    url: "'.url('history/historyrome',true).'&dataurlid="+dataurlid,
                    async: false,
                    success: function (data) {
                    }
                   });
                }
           });
           var swiper = new Swiper(".swiper-container-record-tab", {
                            slidesPerView: "auto",
                            //loop: true,
                            spaceBetween: 0,
                            navigation: {
                                nextEl: ".swiper-button-next-record-tab",
                                prevEl: ".swiper-button-prev-record-tab",
                            },
                        });
        });
        function  deletehistorydata(obj){
                  $("#index_lading").attr("style","display: block;");
                    //清空记录方法
                    $(obj).parent().find("li").each(function() {
                         if(!$(this).hasClass("active")){
                           $(this).remove();
                         };
                    });
                    $.ajax({
                    type: "get",
                    url: "'.url('history/historyromeall',true).'&id='.$indexid.'",
                    async: true,
                    success: function (data) {
                         $("#index_lading").attr("style","display: none;");
                    }
                   });
        }
        
        </script>';

    }else{
        if($static=="index"){  //如果是首页增加
            $history='<div class="record-tab"><div class="swiper-container swiper-container-record-tab"><ul class="nav nav-tabs swiper-wrapper" id="record-tab" role="tablist">';
            $history.='<li class="active swiper-slide">';
            $history.='<a href="#"  >';
            $history.=lang_admin('home').'</i>';
            $history.='</a> </li>';
            $history.='</ul></div><div class="swiper-button-next swiper-button-next-record-tab"></div><div class="swiper-button-prev swiper-button-prev-record-tab"></div></div>';
        }
    }
    return $history;
}

//前台获取插件列表
function getappdata()
{
    $user_buy_apps=service::getInstance()->getlogin();
    $user_buy_apps=$user_buy_apps['appsdata'];
    if (count($user_buy_apps)>1){
        $appdata=apps::getInstance()->getrows('installed=1', 0);
        $data=array();
        foreach($appdata as $app){
            $static=false;
            foreach ($user_buy_apps as $appskey=>$appsval){
                if($appsval['buyid']==$app['id'] && ($_SERVER['SERVER_NAME']==$appsval['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$appsval['buyip']
                        || $_SERVER['SERVER_NAME']=='www.'.$appsval['buyip'])) $static=true;
            }
            if(($app['iscorp']==0 || ($app['iscorp'] && session::get('ver') == 'corp')) && $static) {
                $data[count($data)]=$app;
            }
        }
        return $data;
    }else{
        return "";
    }

}

//会员中心 获取 过期主机
function getoldvhost()
{
    $userid=user::getuserid();
    $vhostdata=array();
    if ($userid){
        $vhost=new vhost();
        $vhostdata=$vhost->getrows('FROM_UNIXTIME(expires) <  NOW()  and uid='.$userid,0);
    }
    return $vhostdata;

}

//判断是否前台显示
function getisshoew($id){
    $appconfig = new appconfig();
    $appconfigdata=$appconfig->getrow(array("appname"=>$id,'name'=>'istemshow'));
    $appdata=apps::getInstance()->getrow(array('id'=>$id));
    if (is_array($appdata))
        if($appdata['tempate_url']){
            if (is_array($appconfigdata))
                if($appconfigdata['value']){
                    return true;
                }else{
                    return false;
                }
            return true;
        }
    return false;
}

//获取字表幻灯片
function getslide_child($id){
    if ($id!=""){
        $data=slidechild::getInstance()->getrows('slide_sid='.$id,0,'id asc');
        if (is_array($data))
            foreach ($data as $key=>$val){
                $slide_title=unserialize($val['slide_title']);
                $data[$key]['slide_title']=is_array($slide_title)?$slide_title[lang::getistemplate()]:$val['slide_title'];
                $slide_subtitle=unserialize($val['slide_subtitle']);
                $data[$key]['slide_subtitle']=is_array($slide_subtitle)?$slide_subtitle[lang::getistemplate()]:$val['slide_subtitle'];
                $slide_butname=unserialize($val['slide_butname']);
                $data[$key]['slide_butname']=is_array($slide_butname)?$slide_butname[lang::getistemplate()]:$val['slide_butname'];
                $slide_url=unserialize($val['slide_url']);
                $data[$key]['slide_url']=is_array($slide_url)?$slide_url[lang::getistemplate()]:$val['slide_url'];
            }
        return $data;
    }
    return array();
}
//获取字表幻灯片  -- 主表
function getslide($id){
    $slide_data=slide::getInstance()->getrow('id='.$id);
    return $slide_data;
}

//获取字表幻灯片  --通过栏目和分类
function getslide_banner($catid=0,$typeid=0){
    $where="1=1";
    if ($catid){
        $where.=" and FIND_IN_SET('".$catid."', banner_catid)";
    }
    if ($typeid){
        $where.=" and FIND_IN_SET('".$catid."', banner_typeid)";
    }
    if (!$typeid && !$catid){
      return array("");
    }
    $slide_data=slide::getInstance()->getrow($where);
    return $slide_data;
}


//判断文件夹权限是不是007
function mkdirs($dir, $mode = 0777){
    if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
    if (!mkdirs(dirname($dir), $mode)) return FALSE;
    return @mkdir($dir, $mode);
}



/**
3  * used：新模板和default模板比较，如果新模板没有的文件自动从default模板复制过去
4  * @param type $defaultPath 默认模板路径
5  * @param type $templetPath 当前模板路径
6  * @return boolean
7  */
function checkFileAndCopy($defaultPath, $templetPath) {
         if (!is_dir($defaultPath)) {
                 echo '默认模板路径没有存在！！！';
         return false;
     }
     $defaultPath = rtrim(str_replace('\\', '/', $defaultPath), '/');
     $templetPath = rtrim(str_replace('\\', '/', $templetPath), '/');
     $files = scandir($defaultPath);
     foreach ($files as $file) {
                 if (in_array($file, array('.', '..'))) {
                         continue;
         }
        $fileFrom = $defaultPath . '/' . $file;
         $fileTo = $templetPath . '/' . $file;
         if (is_dir($fileFrom)) {
                         @mkdir($fileTo);
             checkFileAndCopy($fileFrom, $fileTo);
         } else {
                         if (file_exists($fileTo)) {
                                 continue;
             } else {
                 copy($fileFrom, $fileTo);
                 //echo $templetPath . '/新增文件:' . $file . "<br />";
             }
         }
     }
     return true;
 }



//获取通知列表
function getnotificationlist(){
    $where = " FIND_IN_SET('".user::getusersid()."',userid) ";
    $notificationdata=notification::getInstance()->getrows($where, 0, 'adddatatime desc', "*");
    $notifiid=user::getnotifiid();
    if (is_array($notificationdata)){
        foreach ($notificationdata as $key=>$val){
            if ($notifiid != ''){
                $source = explode(",",trim($notifiid));
                for($index=0;$index<count($source);$index++){
                    if($source[$index]==$notificationdata[$key]['id']){
                        $notificationdata[$key]['isread']='1';
                    }
                }
                if (!$notificationdata[$key]['isread']){
                    $notificationdata[$key]['isread']='0';
                }
            }else{
                $notificationdata[$key]['isread']='0';
            }
        }
    }
    return $notificationdata;
}



//获取我的评论列表
function getcommentlist(){
    $where = array("userid"=>user::getusersid());
    $comment_data = comment::getIns()->getrows($where, 0);
    return $comment_data;
}


//获取栏目的列表下载收费 阅读收费
function getcategory_menoy($name="domwmenoy",$catid=0){
     if ($catid){
         $category_data = category::getInstance()->getrow("catid=".$catid, 0);
         if (is_array($category_data)){
             if (isset($category_data[$name]) && $category_data[$name]!="" && $category_data[$name]>0) return $category_data[$name];
             else  return getcategory_menoy($name,$category_data['parentid']);
         }
     }
    return 0;
}



# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.