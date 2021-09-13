<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
final class view
{
    public $_var;
    public $lang = array();
    public $lang_admin = array();
    public $lang_custom_admin = array();
    public $lang_custom = array();
    public $databaseName;   //判断表在不在
    /*    public $lang_getisadmin = array();  //后台语言数据
        public $lang_getistemplate = array(); //前台语言数据*/

    function __construct(act $act)
    {
        $this->_var = new stdClass();
        if (isset($act->style))
            $this->_style = $act->style;
        $this->setTemplate();
        $this->sysVar();
        //new template();zy
        templatetag::_getVer();
    }

    function setTemplate()
    {
        if (front::$admin && !front::$html) {
            $this->_style = config::get('template_admin_dir') ? config::get('template_admin_dir') : 'admin';
            $this->_tpl_ext = '.php';
        } else {
            $this->_style = ltrim(THIS_URL, '/');
            if (!$this->_style || front::$html) {
                $this->_style = config::get('template_dir');
            }
            if (front::$ismobile) {
                $this->_style = config::get('template_mobile_dir');
            }

            if (front::$case == 'user' || front::$case == 'manage' || front::$case == 'wxapp'
                || front::$case == 'union' || (front::$case == 'archive' && front::$act == 'orders')
                || (front::$case == 'archive' && front::$act == 'buytemplateorders')
                || (front::$case == 'archive' && front::$act == 'payorders')
                || (front::$case == 'archive' && front::$act == 'paybuytemplateorders')
                || (front::$case == 'archive' && front::$act == 'email')
                || (front::$case == 'archive' && front::$act == 'choosepaytype')
                || (front::$case == 'archive' && front::$act == 'consumption')
                || (front::$case == 'archive' && front::$act == 'payconsumption')
                || front::$case == 'attachment' || front::$case == 'vhost'
                || front::$case == 'form' || front::$case == 'domain'
                || front::$case == 'ballot'
                || front::$case == 'consumption' || front::$case == 'license' || front::$case == 'copyright' || front::$case == 'teaching'
            ) {
                $this->_style = config::get('template_user_dir') ? config::get('template_user_dir') : 'user';
                $this->_style .= '/';
            }

            if (front::$ismobile && (front::$case == 'user' || front::$case == 'manage' || front::$case == 'wxapp'
                    || front::$case == 'union' || (front::$case == 'archive' && front::$act == 'orders')
                    || (front::$case == 'archive' && front::$act == 'payorders')
                    || (front::$case == 'archive' && front::$act == 'email')
                    || front::$case == 'attachment' || (front::$case == 'archive' && front::$act == 'consumption'))
            ) {
                $this->_style = config::get('template_user_dir') ? config::get('template_user_dir') : 'user';
                //$this->_style .= '/wap';
                $this->_style .= '/';
            }
            //var_dump($this->_style);
            $this->_tpl_ext = '.html';
        }
        $this->_tpl = front::$case . '/' . front::$act . $this->_tpl_ext;
    }

    function archive_tpl_list($type = '')
    {
        //load_custom_admin_lang('cn');   //选默认语言包  cn
        $dir = preg_replace('%\/.*%', '', $type);
        $_tpls = front::scan_all(TEMPLATE . '/' . config::get('template_dir') . '/' . $dir, $dir . '/');
        $tpls = array('0' => lang_custom_admin('inherit'));
        foreach ($_tpls as $tpl) {
            if (preg_match('/\.htm(l)?$/', $tpl) && !preg_match('/#/', $tpl)) {
                if ($type)
                    if (!preg_match("%^$type%", $tpl))
                        continue;
                $_tpl = str_replace('.', '_', $tpl);
                $_tpl = help::tpl_name($_tpl);
                if ($_tpl)
                    $_tpl = $_tpl . "($tpl)";
                else
                    $_tpl = $tpl;
                $tpls[$tpl] = $_tpl;
            }
        }

        return $tpls;
    }

    function archive_shoppingtpl_list($type = '')
    {
        //提取商品
        if(!file_exists(ROOT."/lib/table/shopping.php")) {
            return array("");
        }
        //load_custom_admin_lang('cn');   //选默认语言包  cn
        $dir = preg_replace('%\/.*%', '', $type);
        $_tpls = front::scan_all(TEMPLATE . '/' . config::get('template_shopping_dir') . '/' .  $dir, $dir . '/');
        $tpls = array('0' => lang_custom_admin('inherit'));
        foreach ($_tpls as $tpl) {
            if (preg_match('/\.htm(l)?$/', $tpl) && !preg_match('/#/', $tpl)) {
                if ($type)
                    if (!preg_match("%^$type%", $tpl))
                        continue;
                $_tpl = str_replace('.', '_', $tpl);
                $_tpl = help::tpl_name($_tpl);
                if ($_tpl)
                    $_tpl = $_tpl . "($tpl)";
                else
                    $_tpl = $tpl;
                $tpls[$tpl] = $_tpl;
            }
        }

        return $tpls;
    }

    function mobile_tpl_list($type = '')
    {
        $dir = preg_replace('%\/.*%', '', $type);
        $_tpls = front::scan_all(TEMPLATE . '/' . config::get('template_mobile_dir') . '/' . $dir, $dir . '/');
        $tpls = array('0' => '继承');
        foreach ($_tpls as $tpl) {
            if (preg_match('/\.htm(l)?$/', $tpl) && !preg_match('/#/', $tpl)) {
                if ($type)
                    if (!preg_match("%^$type%", $tpl))
                        continue;
                $_tpl = str_replace('.', '_', $tpl);
                $_tpl = help::tpl_name($_tpl);
                if ($_tpl)
                    $_tpl = $_tpl . "($tpl)";
                else
                    $_tpl = $tpl;
                $tpls[$tpl] = $_tpl;
            }
        }
        return $tpls;
    }

    function user_tpl_list($type = '')
    {
        $dir = preg_replace('%\/.*%', '', $type);
        $_tpls = front::scan_all(TEMPLATE . '/' . config::get('template_user_dir') . '/' . $dir, $dir . '/');
        $tpls = array('0' => lang_custom_admin('inherit'));
        foreach ($_tpls as $tpl) {
            if (preg_match('/\.htm(l)?$/', $tpl) && !preg_match('/#/', $tpl)) {
                if ($type)
                    if (!preg_match("%^$type%", $tpl))
                        continue;
                $_tpl = str_replace('.', '_', $tpl);
                $_tpl = help::tpl_name($_tpl);
                if ($_tpl)
                    $_tpl = $_tpl . "($tpl)";
                else
                    $_tpl = $tpl;
                $tpls[$tpl] = $_tpl;
            }
        }
        return $tpls;
    }

    function show($string, $whole = false)
    {
        return $string;
    }

    function default_tpl_list()
    {
        return front::scan(TEMPLATE);
    }

    function user_tpl_select()
    {
        //用户模板下拉
        $template_user_data=array();
        foreach (front::scan(TEMPLATE) as $tpl){
            if (preg_match('/user/',$tpl) && !preg_match('/\./',$tpl)){
                $template_user_data[$tpl]=$tpl;
            }
        }
        return $template_user_data;
    }

    function admin_tpl_list()
    {
        return front::scan(ADMIN_TEMPLATE);
    }

    function special_tpl_list()
    {
        $_tpls = front::scan_all(TEMPLATE . '/' . config::get('template_dir') . '/special', 'special/');
        //var_dump($_tpls);
        $tpls = array();
        foreach ($_tpls as $tpl) {
            if (preg_match('/\.htm(l)?$/', $tpl) && !preg_match('/#/', $tpl)) {
                $_tpl = str_replace('.', '_', $tpl);
                $_tpl = help::tpl_name($_tpl);
                if ($_tpl)
                    $_tpl = $_tpl . "($tpl)";else
                    $_tpl = $tpl;
                $tpls[$tpl] = $_tpl;
            }
        }
        return $tpls;
    }

    function myform_tpl_list()
    {
        $_tpls = front::scan_all(TEMPLATE . '/' . config::get('template_user_dir') . '/myform', 'myform/');
        $tpls = array();
        foreach ($_tpls as $tpl) {
            if (preg_match('/\.htm(l)?$/', $tpl) && !preg_match('/#/', $tpl)) {
                $_tpl = str_replace('.', '_', $tpl);
                $_tpl = help::tpl_name($_tpl);
                if ($_tpl)
                    $_tpl = $_tpl . "($tpl)";
                else
                    $_tpl = $tpl;
                $tpls[$tpl] = $_tpl;
            }
        }
        return $tpls;
    }

    function sysVar()
    {
        //$this->base_url = config::get('base_url');
        $this->base_url = $this->get_base_url(); 
        $this->skin_path = $this->base_url . '/template/' . config::get('template_dir') . '/skin';
        $this->skin_shop_path = $this->base_url . '/template/' . config::get('template_shopping_dir') . '/skin';
        $this->skin_user_path = $this->base_url . '/template/' . config::get('template_user_dir') . '/skin';
        $this->skin_wap_path = $this->base_url . '/template/' . config::get('template_mobile_dir') . '/skin';
        $this->skin_admin_path = $this->base_url . '/template_admin/' . config::get('template_admin_dir') . '/skin';
        $this->site_map = $this->base_url . '/index.php?case=archive&act=sitemap';
        $this->template_path = $this->base_url . '/template/' . config::get('template_dir') . '';
        $this->template_shop_path = $this->base_url . '/template/' . config::get('template_shopping_dir') . '';
        $this->template_wap_path = $this->base_url . '/template/' . config::get('template_mobile_dir') . '';
        $this->template_user_path = $this->base_url . '/template/' . config::get('template_user_dir') . '';
        $this->admin_url = config::get('base_url') . '/index.php?admin_dir=' . config::get('admin_dir');
        $this->roles = session::get('roles');
        $this->site_url = config::get('site_url');
        $this->skin_buymodules =  $this->base_url . '/template/' . config::get('template_dir') . '/visual/buymodules';
        $this->skin_shop_buymodules =  $this->base_url . '/template/' . config::get('template_shopping_dir') . '/visual/buymodules';
        $this->skin_modules =  $this->base_url . '/template/' . config::get('template_dir') . '/visual/modules';
        $this->skin_shop_modules =  $this->base_url . '/template/' . config::get('template_shopping_dir') . '/visual/modules';

    }

    //获取base_url
    static function get_base_url(){
        $base_url=$_SERVER['PHP_SELF'];
        $base_url=substr($base_url,0,strpos($base_url, '/index.php'));
        if ($base_url!="/" && $base_url!=""){
           return  $base_url;
        }
        return "";
    }

    function visualfetch($tpl = null)
    {
        if(!in_array(fileext($tpl),array('html','php'))){
            exit('模版文件错误!');
        }


        $this->_style = config::get('template_dir') ? config::get('template_dir') : 'default';

        //var_dump($this->_style);
        //exit;
        $file = TEMPLATE . '/' . $this->_style . '/' . $tpl;
        //var_dump($this->_style);

        if (!file_exists($file)) {
            echo $file;exit("lang_admin('template_does_not_exist')");
        }
        $tFile = preg_replace('/([\w-]+)\.(\w+)$/', '#$1.$2', preg_replace('/\.html?$/ix', '.php', $tpl));
        $cacheFile = ROOT . '/cache/template/' . $this->_style . '/' . $tFile;
        tool::mkdir(dirname($cacheFile));

        if (!file_exists($cacheFile) || filemtime($cacheFile) < filemtime($file) || front::$admin && !session::get('passinfo')) {
            $source = $this->compile(file_get_contents($file));
            $cacheFile=iconv("utf-8", "gbk",$cacheFile);
            file_put_contents($cacheFile, $source);
        }
        $content = $this->_eval($cacheFile);
        return $this->show($content);
    }
    //权限判断
    function fetch($tpl = null,$static=false,$template_cache=false,$head_foot=false)
    {
        //echo "<script>alert('".$tpl."');</script>";
        //load_custom_admin_lang('cn');   //选默认语言包  cn
        $nopermission = '<div style="min-height:500px;padding:88px 30px 0px 30px; background:#fff;"><div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="glyphicon glyphicon-warning-sign"></span>	<strong>'. lang_admin("tips") . '！</strong>'. lang_admin("no_permission") .';&nbsp;&nbsp;<a class="btn btn-default" href="#" onclick="gotourl(this)"   data-dataurl="index.php?case=table&act=list&table=usergroup&admin_dir='. get('admin_dir',true) .'&site=default">' .lang_admin("go_set_up") . '</a></div></div>';
        if($tpl && !in_array(fileext($tpl),array('html','php'))){
            exit(lang_custom_admin('template_file').lang_custom_admin('error'));
        }
        if (!$tpl && get('spid') && front::$case == 'table' && front::$act == 'list') {
            $_tpl = 'table/special/manage.php';
            $tpl = $_tpl;
        }
        if (!$tpl && get('spid') && front::$case == 'table' && front::$act == 'list') {
            $_tpl = 'table/spider/manage.php';
            $tpl = $_tpl;
        }
        if (front::$case == 'user' && !$tpl) {
            $_tpl = front::$act . '.html';
            $tpl = $_tpl;
        }
        if (front::$case == 'table' && !$tpl && preg_match('/^(htmlrule|htmlruleedit|import|view|result|viewcnzz|send|sendsms|mail|notification|list|add|copy|refund|edit|setting|show|manage)$/', front::$act) && front::get('table') && front::$admin && preg_match('/^my_/',
                front::get('table'))
        )
        {
            $_tpl = 'myform/' . front::$act . '.php';
            $tpl = $_tpl;
        }
        elseif (front::$case == 'table' && !$tpl && preg_match('/^(htmlrule|htmlruleedit|import|view|result|viewcnzz|send|sendsms|mail|notification|list|add|copy|refund|edit|setting|show|manage)$/', front::$act) && front::get('table') && front::$admin)
        {

            if (front::$get['table'] == 'category' && front::$act == 'list') {
                if (!chkpower('category_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'archive' && front::$act == 'list') {
                if (!chkpower('archive_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'type' && front::$act == 'list') {
                if (!chkpower('type_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'special' && front::$act == 'list') {
                if (!chkpower('special_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'user' && front::$act == 'list') {
                if (!chkpower('user_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'usergroup' && front::$act == 'list') {
                if (!chkpower('usergroup_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'orders' && front::$act == 'list') {
                if (!chkpower('order_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'ballot' && front::$act == 'list') {
                if (!chkpower('func_ballot_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'comment' && front::$act == 'list') {
                if (!chkpower('func_comment_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'guestbook' && front::$act == 'list') {
                if (!chkpower('func_book_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'announcement' && front::$act == 'list') {
                if (!chkpower('func_announc_list')) {
                    return $nopermission;
                }
            }
            if ($this->table == 'templatetag' && front::get('tagfrom') == 'define' && front::$act == 'list') {
                if (!chkpower('templatetag_list_define')) {
                    return $nopermission;
                }
            }
            if ($this->table == 'templatetag' && front::get('tagfrom') == 'category' && front::$act == 'list') {
                if (!chkpower('templatetag_list_category')) {
                    return $nopermission;
                }
            }
            if ($this->table == 'templatetag' && front::get('tagfrom') == 'content' && front::$act == 'list') {
                if (!chkpower('templatetag_list_content')) {
                    return $nopermission;
                }
            }
            if ($this->table == 'templatetag' && front::get('tagfrom') == 'system' && front::$act == 'list') {
                if (!chkpower('templatetag_list_system')) {
                    return $nopermission;
                }
            }
            if ($this->table == 'templatetag' && front::get('tagfrom') == 'function' && front::$act == 'list') {
                if (!chkpower('templatetag_list_function')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'linkword' && front::$act == 'list') {
                if (!chkpower('seo_linkword_list')) {
                    return $nopermission;
                }
            }
            if (front::$get['table'] == 'friendlink' && front::$act == 'list') {
                if (!chkpower('seo_friendlink_list')) {
                    return $nopermission;
                }
            }

            $_tpl = 'table/' . front::get('table') . '/' . front::$act . '.php';
            if (file_exists(TEMPLATE_ADMIN . '/' . $this->_style . '/' . $_tpl)) {
                $tpl = $_tpl;
            }
        }
        elseif (front::$case == 'stats' && !$tpl && front::get('table') == 'stats' && front::$act == 'list') {
            if (!chkpower('seo_status_list')) {
                return $nopermission;
            }
        }
        elseif (front::$case == 'field' && !$tpl && front::get('table') == 'archive' && front::$act == 'list') {
            if (!chkpower('defined_field_content')) {
                return $nopermission;
            }
        }
        if (!isset($tpl))
            $tpl = $this->_tpl;
         if (strpos($tpl,'buymodules') !== false && !front::$admin){    //购买的组件加载
            $tpl=str_replace(ROOT.'/template/'.config::get('template_dir'),"",$tpl);
            $file = ROOT.'/data/' . $tpl;
        }
        else {
            if (strpos($tpl,ROOT.'/') !== false){
                $file = $tpl;
            }elseif (front::$admin) {
                $file = TEMPLATE_ADMIN . '/' . $this->_style . '/' . $tpl;
            }else{
                if (strpos($tpl,'shop') !== false && !front::get('pageset')){
                    $file = ROOT . '/template/'. $tpl;
                }
                elseif (front::get('pageset')){
                    if (strpos($tpl,'shop') !== false){
                        $file = ROOT . '/data/template/' . $tpl;
                    }else{
                        $file = ROOT . '/data/template/' . $this->_style . '/' . $tpl;
                    }
                }
                else{
                    $file = TEMPLATE . '/' . $this->_style . '/' . $tpl;
                }
            }
        }

        //缓存方式--2
        $cache_make_open=config::get("cache_make_open");     //php缓存开关
        $template_cache_path=str_replace(ROOT.'/',ROOT.'/'.lang::getistemplate().'/',str_replace('.html','.php',$file));
        if ($template_cache && file_exists($template_cache_path) && $cache_make_open) {
            $content=$this->_eval($template_cache_path,true);
        }
        else{
            $cacheFile=service::get_fetch_cacheFile($tpl,$file,$static,$head_foot,$this->_style);
            $content = $this->_eval($cacheFile,$static);
            //缓存方式--2
            if ($template_cache && $cache_make_open){
                tool::mkdir(dirname($template_cache_path));
                file_put_contents($template_cache_path, $content);  //写入缓存
            }
        }
        if (front::$admin)
            return $this->show($content);
        if($content){
            $rs = config::get('filter_word');
            $rs1 = config::get('filter_x');
            $rs = str_replace('，', ',', $rs);
            $rs1 = str_replace('，', ',', $rs1);
            $rs = explode(',', $rs);
            if (is_array($rs)) {
                foreach ($rs as $k => $v) {
                    if (strtolower($v) == 'cmseasy') {
                        $rs[$k] = 'liuliwei';
                    }
                }
            }
            $rs1 = explode(',', $rs1);
            $content = str_replace($rs, $rs1, $content);
        }

        /*if (is_array($rs))
            foreach ($rs as $rp) {
            if ($rp)
                $content=str_replace(trim($rp),config::get('filter_x'),$content);
        }*/
        return $this->show($content);
    }

    function render($tpl = null)
    {
        echo $this->fetch($tpl);
    }

    function _eval($file = null,$static=false)
    {
        foreach ($this as $var => $value) if (!preg_match('/^_/', $var))
            $$var = $value;
        if (is_object($this->_var))
            foreach ($this->_var as $var => $value) $$var = $value;

        $file=iconv("utf-8", "gbk",$file);
            ob_start();
            if ($file)
                include $file;
         /*   else
                eval('?' . '>' . trim($content));*/
            if ($static){
                $content = ob_get_clean();
            }else{
                ob_flush();
                $content="";
                ob_end_clean();
            }


        $this->_var = new stdClass();
        return $content;
    }

    function compile($source,$head_foot=false)
    {

        $source = service::admin_system($source);

        if ($head_foot || front::get("cache_make")){
            $source = preg_replace("/\{template\s+('header.html')\}/", "{template_php_make \\1}", $source);
            $source = preg_replace("/\{template\s+('footer.html')\}/", "{template_php_make \\1}", $source);
        }
        //公共按钮
        $source = preg_replace('/\{setting_butoon\}/s',$this->setting_butoon("setting_butoon.php") , $source);
        $source = preg_replace('/\{area_city\}/s','{area::mapjs()}', $source);
      /*$source = preg_replace('/\{setting_butoon_layouts\}/s',$this->setting_butoon("setting_butoon_layouts.php") , $source);
	    $source = preg_replace('/\{setting_butoon_delete\}/s',$this->setting_butoon("setting_butoon_delete.php") , $source);
        $source = preg_replace('/\{setting_butoon_grid\}/s',$this->setting_butoon("setting_butoon_grid.php") , $source);
        $source = preg_replace('/\{setting_butoon_category\}/s',$this->setting_butoon("setting_butoon_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_category\}/s',$this->setting_butoon("setting_butoon_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category\}/s',$this->setting_butoon("setting_butoon_shop_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_type\}/s',$this->setting_butoon("setting_butoon_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_type\}/s',$this->setting_butoon("setting_butoon_shop_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_category_info\}/s',$this->setting_butoon("setting_butoon_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category_info\}/s',$this->setting_butoon("setting_butoon_shop_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_commoncss\}/s',$this->setting_butoon("setting_butoon_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_commoncss\}/s',$this->setting_butoon("setting_butoon_shop_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_content\}/s',$this->setting_butoon("setting_butoon_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_content\}/s',$this->setting_butoon("setting_butoon_shop_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_announ\}/s',$this->setting_butoon("setting_butoon_announ.php") , $source);
        $source = preg_replace('/\{setting_butoon_audio\}/s',$this->setting_butoon("setting_butoon_audio.php") , $source);
        $source = preg_replace('/\{setting_butoon_button\}/s',$this->setting_butoon("setting_butoon_button.php") , $source);
        $source = preg_replace('/\{setting_butoon_code\}/s',$this->setting_butoon("setting_butoon_code.php") , $source);
        $source = preg_replace('/\{setting_butoon_contact\}/s',$this->setting_butoon("setting_butoon_contact.php") , $source);
        $source = preg_replace('/\{setting_butoon_editor\}/s',$this->setting_butoon("setting_butoon_editor.php") , $source);
        $source = preg_replace('/\{setting_butoon_field\}/s',$this->setting_butoon("setting_butoon_field.php") , $source);
        $source = preg_replace('/\{setting_butoon_flash\}/s',$this->setting_butoon("setting_butoon_flash.php") , $source);
        $source = preg_replace('/\{setting_butoon_form-link\}/s',$this->setting_butoon("setting_butoon_form-link.php") , $source);
        $source = preg_replace('/\{setting_butoon_href\}/s',$this->setting_butoon("setting_butoon_href.php") , $source);
        $source = preg_replace('/\{setting_butoon_icon\}/s',$this->setting_butoon("setting_butoon_icon.php") , $source);
        $source = preg_replace('/\{setting_butoon_list\}/s',$this->setting_butoon("setting_butoon_list.php") , $source);
        $source = preg_replace('/\{setting_butoon_listspecial\}/s',$this->setting_butoon("setting_butoon_listspecial.php") , $source);
        $source = preg_replace('/\{setting_butoon_listtype\}/s',$this->setting_butoon("setting_butoon_listtype.php") , $source);
        $source = preg_replace('/\{setting_butoon_nav\}/s',$this->setting_butoon("setting_butoon_nav.php") , $source);
        $source = preg_replace('/\{setting_butoon_picture\}/s',$this->setting_butoon("setting_butoon_picture.php") , $source);
        $source = preg_replace('/\{setting_butoon_pictures\}/s',$this->setting_butoon("setting_butoon_pictures.php") , $source);
        $source = preg_replace('/\{setting_butoon_slide\}/s',$this->setting_butoon("setting_butoon_slide.php") , $source);
        $source = preg_replace('/\{setting_butoon_special\}/s',$this->setting_butoon("setting_butoon_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_special\}/s',$this->setting_butoon("setting_butoon_shop_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_video\}/s',$this->setting_butoon("setting_butoon_video.php") , $source);*/
        $source = preg_replace('/\{getread_([^}]+)\}/s', '<span class="removegetread">$1</span>{get(\'$1\')}', $source);
        $source = preg_replace('/\{langtemplate_([^}]+)\}/s', '{lang(\'$1\')}', $source);
        $source = preg_replace('/\{langadmin_([^}]+)\}/s', '{lang_admin(\'$1\')}', $source);
        $source = preg_replace('/\{tag_sections_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',\'\',true)}', $source);
        $source = preg_replace('/\{tag_buymodules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',true)}', $source);
        $source = preg_replace('/\{tag_modules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',false)}', $source);
        $source = preg_replace('/\{tag_buymodules_shop_([^}]+)\}/s', '{shoptemplatetag::tagbuymodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_modules_shop_([^}]+)\}/s', '{shoptemplatetag::tagmodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_buymodules_([^}]+)\}/s', '{templatetag::tagbuymodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_slide_([^}]+)\}/s', '{templatetag::tagslide(\'$1\')}', $source);
        $source = preg_replace('/\{tag_shopslide_([^}]+)\}/s', '{shoptemplatetag::tagslide(\'$1\')}', $source);
        $source = preg_replace('/\{tag_modules_([^}]+)\}/s', '{templatetag::tagmodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_form_([^}]+)\}/s', '{templatetag::tagform(\'$1\')}', $source);
        $source = preg_replace('/\{tag_sections_shop_([^}]+)\}/s', '{templatetag::tagsections(\'$1\',true,1)}', $source);
        $source = preg_replace('/\{tag_sections_([^}]+)\}/s', '{templatetag::tagsections(\'$1\',true)}', $source);
        $source = preg_replace('/\{tag_shop_([^}]+)\}/s', '{shoptemplatetag::tag(\'$1\')}', $source);
        $source = preg_replace('/\{tag_([^}]+)\}/s', '{templatetag::tag(\'$1\')}', $source);
        $source = preg_replace('/\{js_([^}]+)\}/s', '{templatetag::js(\'$1\')}', $source);
        $source = preg_replace('/\{tagwap_([^}]+)\}/s', '{templatetagwap::tag(\'$1\')}', $source);
        $source = preg_replace('/\{jswap_([^}]+)\}/s', '{templatetagwap::js(\'$1\')}', $source);
        $source = preg_replace("/([\n\r]+)\t+/s", "\\1", $source);
        $source = preg_replace("%\/\/\{(.+?)\}%", "", $source);
        $source = preg_replace("/\{autotempdir\s+(.+)\}/", "<?php echo autotempdir(\\1); ?>", $source);
        $source = preg_replace("/\{template_shopping\s+(.+)\}/", "<?php echo template_shopping(\\1); ?>", $source);
        $source = preg_replace("/\{template_user\s+(.+)\}/", "<?php echo template_user(\\1); ?>", $source);
        $source = preg_replace("/\{template_admin\s+(.+)\}/", "<?php echo template_admin(\\1); ?>", $source);
        $source = preg_replace("/\{template_public\s+(.+)\}/", "<?php echo template_public(\\1); ?>", $source);
        $source = preg_replace("/\{template\s+(.+)\}/", "<?php echo template(\\1); ?>", $source);
        $source = preg_replace("/\{=(.+?)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace_callback("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/s", array($this, 'addquote'), $source);
        $source = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1['\\2'];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2]['\\3'];?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', '<?php echo \\3(\\1[\\2]\\4);?>', $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\3(\\1['\\2']\\4);?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\2(\\1\\3);?>", $source);
        $source = preg_replace("/\\$([a-zA-Z0-9_]+)\[([a-zA-Z0-9_]+)\]/s", "\$\\1['\\2']", $source);
        if (!front::get('pageset') && front::$act !='savemoduletag' && front::$act !='savemoduletaglist') {
            $source = preg_replace("/cmseasy-id=\"([a-zA-Z0-9_\x7f-\xff:]+)\"/", "", $source);
            $source = preg_replace("/cmseasy-table=\"([a-zA-Z0-9_\x7f-\xff:]+)\"/", "", $source);
            $source = preg_replace("/cmseasy-field=\"([a-zA-Z0-9_\x7f-\xff:]+)\"/", "", $source);
        }
        $source = "<?php defined('ROOT') or exit('Can\'t Access !'); ?>\r\n" . $source;
        //var_dump($source);
        return $source;
    }

    //解析公用的-动静态结合
    function compile_public($source)
    {
        $source = service::admin_system($source);
        $source = preg_replace("/\{template_php_make\s+(.+)\}/", "<?php echo template_php_make(\\1); ?>", $source);
        return $source;
    }

    //可视化解析
    function viewcompile($source)
    {

        $source = service::admin_system($source);

        //公共按钮
        $source = preg_replace('/\{setting_butoon\}/s',$this->setting_butoon("setting_butoon.php") , $source);
        $source = preg_replace('/\{area_city\}/s','{area::mapjs()}', $source);
        $source = preg_replace('/\{setting_butoon_layouts\}/s',$this->setting_butoon("setting_butoon_layouts.php") , $source);
 	$source = preg_replace('/\{setting_butoon_delete\}/s',$this->setting_butoon("setting_butoon_delete.php") , $source);
        $source = preg_replace('/\{setting_butoon_grid\}/s',$this->setting_butoon("setting_butoon_grid.php") , $source);
        $source = preg_replace('/\{setting_butoon_category\}/s',$this->setting_butoon("setting_butoon_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_type\}/s',$this->setting_butoon("setting_butoon_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_type\}/s',$this->setting_butoon("setting_butoon_shop_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_category_info\}/s',$this->setting_butoon("setting_butoon_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category_info\}/s',$this->setting_butoon("setting_butoon_shop_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category\}/s',$this->setting_butoon("setting_butoon_shop_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_commoncss\}/s',$this->setting_butoon("setting_butoon_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_commoncss\}/s',$this->setting_butoon("setting_butoon_shop_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_content\}/s',$this->setting_butoon("setting_butoon_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_content\}/s',$this->setting_butoon("setting_butoon_shop_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_announ\}/s',$this->setting_butoon("setting_butoon_announ.php") , $source);
        $source = preg_replace('/\{setting_butoon_audio\}/s',$this->setting_butoon("setting_butoon_audio.php") , $source);
        $source = preg_replace('/\{setting_butoon_button\}/s',$this->setting_butoon("setting_butoon_button.php") , $source);
        $source = preg_replace('/\{setting_butoon_code\}/s',$this->setting_butoon("setting_butoon_code.php") , $source);
        $source = preg_replace('/\{setting_butoon_contact\}/s',$this->setting_butoon("setting_butoon_contact.php") , $source);
        $source = preg_replace('/\{setting_butoon_editor\}/s',$this->setting_butoon("setting_butoon_editor.php") , $source);
        $source = preg_replace('/\{setting_butoon_field\}/s',$this->setting_butoon("setting_butoon_field.php") , $source);
        $source = preg_replace('/\{setting_butoon_flash\}/s',$this->setting_butoon("setting_butoon_flash.php") , $source);
        $source = preg_replace('/\{setting_butoon_form-link\}/s',$this->setting_butoon("setting_butoon_form-link.php") , $source);
        $source = preg_replace('/\{setting_butoon_href\}/s',$this->setting_butoon("setting_butoon_href.php") , $source);
        $source = preg_replace('/\{setting_butoon_icon\}/s',$this->setting_butoon("setting_butoon_icon.php") , $source);
        $source = preg_replace('/\{setting_butoon_list\}/s',$this->setting_butoon("setting_butoon_list.php") , $source);
        $source = preg_replace('/\{setting_butoon_listspecial\}/s',$this->setting_butoon("setting_butoon_listspecial.php") , $source);
        $source = preg_replace('/\{setting_butoon_listtype\}/s',$this->setting_butoon("setting_butoon_listtype.php") , $source);
        $source = preg_replace('/\{setting_butoon_nav\}/s',$this->setting_butoon("setting_butoon_nav.php") , $source);
        $source = preg_replace('/\{setting_butoon_picture\}/s',$this->setting_butoon("setting_butoon_picture.php") , $source);
        $source = preg_replace('/\{setting_butoon_pictures\}/s',$this->setting_butoon("setting_butoon_pictures.php") , $source);
        $source = preg_replace('/\{setting_butoon_slide\}/s',$this->setting_butoon("setting_butoon_slide.php") , $source);
        $source = preg_replace('/\{setting_butoon_special\}/s',$this->setting_butoon("setting_butoon_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_special\}/s',$this->setting_butoon("setting_butoon_shop_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_video\}/s',$this->setting_butoon("setting_butoon_video.php") , $source);
        $source = preg_replace('/\{getread_([^}]+)\}/s', '<span class="removegetread">$1</span>{get(\'$1\')}', $source);
        $source = preg_replace('/\{langtemplate_([^}]+)\}/s', '<span class="removelang">$1</span>{lang_admin(\'$1\')}', $source);
        $source = preg_replace('/\{langadmin_([^}]+)\}/s', '<span class="removelangadmin">$1</span>{lang_admin(\'$1\')}', $source);
        $source = preg_replace('/\{tag_sections_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',\'\',true,true)}', $source);
        $source = preg_replace('/\{tag_buymodules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',true,false,true)}', $source);
        $source = preg_replace('/\{tag_modules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',false,false,true)}', $source);
        $source = preg_replace('/\{tag_buymodules_shop_([^}]+)\}/s', '{shoptemplatetag::tagbuymodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_modules_shop_([^}]+)\}/s', '{shoptemplatetag::tagmodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_buymodules_([^}]+)\}/s', '{templatetag::tagbuymodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_slide_([^}]+)\}/s', '{templatetag::tagslide(\'$1\',\'\',\'\',false,true)}', $source);
        $source = preg_replace('/\{tag_shopslide_([^}]+)\}/s', '{shoptemplatetag::tagslide(\'$1\',\'\',\'\',true)}', $source);
        $source = preg_replace('/\{tag_modules_([^}]+)\}/s', '{templatetag::tagmodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_form_([^}]+)\}/s', '{templatetag::tagform(\'$1\',true)}', $source);
        $source = preg_replace('/\{tag_sections_shop_([^}]+)\}/s', '{templatetag::tagsections(\'$1\',true,1,true)}', $source);
        $source = preg_replace('/\{tag_sections_([^}]+)\}/s', '{templatetag::tagsections(\'$1\',0,0,true)}', $source);
        $source = preg_replace('/\{tag_shop_([^}]+)\}/s', '{shoptemplatetag::tag(\'$1\',false)}', $source);
        $source = preg_replace('/\{tag_([^}]+)\}/s', '{templatetag::tag(\'$1\',false)}', $source);
        $source = preg_replace('/\{js_([^}]+)\}/s', '{templatetag::js(\'$1\')}', $source);
        $source = preg_replace('/\{tagwap_([^}]+)\}/s', '{templatetagwap::tag(\'$1\')}', $source);
        $source = preg_replace('/\{jswap_([^}]+)\}/s', '{templatetagwap::js(\'$1\')}', $source);
        $source = preg_replace("/([\n\r]+)\t+/s", "\\1", $source);
        $source = preg_replace("%\/\/\{(.+?)\}%", "", $source);
        $source = preg_replace("/\{autotempdir\s+(.+)\}/", "<?php echo autotempdir(\\1); ?>", $source);
        $source = preg_replace("/\{template_shopping\s+(.+)\}/", "<?php echo template_shopping(\\1); ?>", $source);
        $source = preg_replace("/\{template_user\s+(.+)\}/", "<?php echo template_user(\\1); ?>", $source);
        $source = preg_replace("/\{template_admin\s+(.+)\}/", "<?php echo template_admin(\\1); ?>", $source);
        $source = preg_replace("/\{template_public\s+(.+)\}/", "<?php echo template_public(\\1); ?>", $source);
        $source = preg_replace("/\{template\s+(.+)\}/", "<?php echo template(\\1); ?>", $source);
        $source = preg_replace("/\{=(.+?)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace_callback("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/s", array($this, 'addquote'), $source);
        $source = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1['\\2'];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2]['\\3'];?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', '<?php echo \\3(\\1[\\2]\\4);?>', $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\3(\\1['\\2']\\4);?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\2(\\1\\3);?>", $source);
        $source = preg_replace("/\\$([a-zA-Z0-9_]+)\[([a-zA-Z0-9_]+)\]/s", "\$\\1['\\2']", $source);
        if (!front::get('pageset') && front::$act !='savemoduletag' && front::$act !='savemoduletaglist') {
            $source = preg_replace("/cmseasy-id=\"([a-zA-Z0-9_\x7f-\xff:]+)\"/", "", $source);
            $source = preg_replace("/cmseasy-table=\"([a-zA-Z0-9_\x7f-\xff:]+)\"/", "", $source);
            $source = preg_replace("/cmseasy-field=\"([a-zA-Z0-9_\x7f-\xff:]+)\"/", "", $source);
        }
        $source = preg_replace("/\#\[\#if\s+(.+?)\#\]\#/", "<?php if(\\1) { ?>", $source);
        $source = preg_replace("/\#\[\#else\#\]\#/", "<?php } else { ?>", $source);
        $source = preg_replace("/\#\[\#elseif\s+(.+?)\#\]\#/", "<?php } elseif (\\1) { ?>", $source);
        $source = preg_replace("/\#\[\#\/if\#\]\#/", "<?php } ?>", $source);
        $source = preg_replace("/\#\[\#php\s+(.+)\#\]\#/", "<?php \\1?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\\$\w+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\\$\w+)\s+(\S+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\S+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\S+)\s+(\S+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\#\[\#\/loop\#\]\#/", "<?php } ?>", $source);
        $source = preg_replace("/\#\[\#/", htmlspecialchars_decode("{"), $source);
        $source = preg_replace("/\#\]\#/", htmlspecialchars_decode("}"), $source);
        $source = "<?php defined('ROOT') or exit('Can\'t Access !'); ?>\r\n" . $source;
        //var_dump($source);
        return $source;
    }

    function setting_butoon($name){
        $setting_butoon_path=TEMPLATE_ADMIN . '/' . config::get('template_admin_dir') . '/visual/button';
        if (!file_exists( $setting_butoon_path )) {mkdir ($setting_butoon_path,0777,true );}
        $setting_butoon_path=$setting_butoon_path.'/'.$name;
        if (!file_exists( $setting_butoon_path )) {@fopen($setting_butoon_path, "w");}
        $setting_butoon=file_get_contents($setting_butoon_path);
        return $setting_butoon;
    }

    function addquote($var)
    {

        $str = "<?php echo " . str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var[1])) . ";?>";
        //var_dump($str);
        //exit;
        return $str;
    }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
