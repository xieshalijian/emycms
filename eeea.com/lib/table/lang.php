<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class lang extends table
{
    public $name = 'lang';
    static $me;
    static $categorydata;
    public static $langtemplatedata=null;
    public static $langadmindata=null;

    public static function getInstance() {
        if (!self::$me) {
            $class=new lang();
            self::$me=$class;
        }

        if (!self::$categorydata) {
            self::$categorydata=new category();
            self::$categorydata->init();
        }
        return self::$me;
    }

    function getcols($act)
    {
        return '*';
    }

    function get_form()
    {
        return array(
            'static' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('forbidden'), 1 => lang_admin('enabling'))),
                'default' => 1,
            ),
            'langcopy'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(lang::optionall('tolast')),
                'default'=>intval($this->getdefaultlang()),
            ),
            'isdefault'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(array(0=>lang_admin('no'),1=>lang_admin('yes'))),
                'default' => 0,
            ),
        );
    }

    //获取默认的语言包ID
    function  getdefaultlang(){
        $lang = self::getall();
        if (is_array($lang))
            foreach ((array)$lang as $key=>$val){
                if($val['isdefault']){
                    return $val['id'];
                }
            }
        return 1;
    }
    //获取默认的语言包url
    static function  getdefaultlangurl(){
        $lang = self::getall();
        if (is_array($lang))
        foreach ((array)$lang as $key=>$val){
            if($val['isdefault']){
                return $val['langurlname'];
            }
        }
        return "cn";
    }

    //获取可用语言包
    public static function  getlang(){
    /*    $lang = self::getInstance();
        $where=" static=1 ";
        if (!config::getadmin('lang_open')) {
                if(!file_exists(ROOT."/data/locked"))
                {
                    $where.=" and  langurlname='cn' ";
                }
            $where.=" and  langurlname='".lang::getisdefault()."' ";
        }
        $_lang = $lang->getrows($where, 0, 'id asc');
        if (is_array($_lang)){
            //获取当前域名
            //$http_host = (self::isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']; //获取域名
            foreach ($_lang as $key=>$val){
                $domain=explode(",",$val['domain']);
                if(!in_array($_SERVER['HTTP_HOST'],$domain) && $val['domain']!=""){
                    unset($_lang[$key]);
                }
            }
            return $_lang;
        }*/

        $lang = self::getall();
        $langdefault=lang::getisdefault();
        if (is_array($lang))
            foreach ((array)$lang as $key=>$val){
                if (!config::getadmin('lang_open') && $val['langurlname']!=$langdefault) {
                    unset($lang[$key]);
                }else
                if(!$val['static']){
                   unset($lang[$key]);
                }
            }
        return $lang;
    }

    //通过文件夹名称  获取语言包id
    public static function  getlangid($langurlname){
        $lang = self::getall();
        if (is_array($lang))
            foreach ((array)$lang as $key=>$val){
                if ($val['langurlname']==$langurlname && $val['static'] ) {
                    return $val['id'];
                }
            }
        return 0;
    }

    //通过文件夹名称  获取语言包的后台语言设置
    public static function  getlangadminlang($langurlname){
        if(file_exists(ROOT."/data/locked")) {
            $langdata=self::getall();
            foreach ((array)$langdata as $key=>$val){
                if ($val['static'] && $val['langurlname']==$langurlname){
                    return $val['adminlangid'];
                }
            }
        }
        return 0;
    }

    //通过语言包id   获取文件夹名称
    public static function  getlangurlname($langid){
        $lang =self::getall();
        if (is_array($lang))
            foreach ((array)$lang as $key=>$val){
                if ($val['static'] && $val['id']==$langid) {
                    return $val['langurlname'];
                }
            }
        return 'cn';
    }


    static function optionall()
    {
        $lang = self::getall();
        $langoptionall = array();
        foreach ((array)$lang as $one) {
            $langoptionall[$one['id']] = $one['langname'];
        }
        return $langoptionall;


    }

    static function option()
    {
        $lang = self::getall();
        $langoption = array();
        foreach ($lang as $one) {
            if($one['static']){
                $langoption[$one['id']] = $one['langname'];
            }
        }
        return $langoption;


    }

    //获取前台语言包的路径
   /* static function getistemplate()
    {
        if(file_exists(ROOT."/data/locked")) {
            if (session::get('lang_getistemplate')){
                $_lang=session::get('lang_getistemplate');
            }else{
                $_lang=array("templatelang"=>"","templatelangdomain"=>"");
            }
            if ($_lang['templatelang']!="" && session::get('username') && $_lang['templatelangdomain']==$_SERVER['HTTP_HOST']) {   //前提条件是登陆了
                return $_lang['templatelang'];
            }else
            if (session::get('nolong_templatelang') && !session::get('username') && session::get('nolong_templatelang_domain')==$_SERVER['HTTP_HOST']){    //判断游客的缓存
                return session::get('nolong_templatelang');
            }
            //下面的 进一次就行了  进多了 影响速度
            $configdatabase = config::getdatabase('database');
            $pddatabase=dbmysqli::getInstance($configdatabase['hostname'],$configdatabase['user'], $configdatabase['password'],$configdatabase['database']);
            if (!mysqli_connect_errno($pddatabase))
            {
                $table = $configdatabase['prefix'] . "lang";
                if (mysqli_num_rows($pddatabase->query( "SHOW TABLES LIKE '" . $table . "'")) == 1) {
                    $user = new user();
                    if (session::get('username')) {   //登陆的时候 取用户的语言
                        $_lang = $user->getrow("username='" . session::get('username') . "'", 1);
                        if (is_array($_lang)) {
                            if ($_lang['templatelangdomain']!=$_SERVER['HTTP_HOST']){
                                $_lang['templatelang']=self::getdomainlang(); //获取语言 优先获取域名的 然后是默认的
                                $_lang['templatelangdomain']=$_SERVER['HTTP_HOST'];
                            }
                            session::set('lang_getistemplate', $_lang);
                            return $_lang['adminlang'];
                        }

                    }else if (session::get('nolong_templatelang') && session::get('nolong_templatelang_domain')==$_SERVER['HTTP_HOST']) {   //没登陆的时候  看看session有没有前台语言
                        return session::get('nolong_templatelang');
                    } else {
                        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4); //只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。
                        if (preg_match("/zh-c/i", $lang))
                            $langname=self::islang('cn');
                        else if (preg_match("/zh/i", $lang))
                            $langname=self::islang('cn');
                        else if (preg_match("/en/i", $lang))
                            $langname=self::islang('en');
                        else if (preg_match("/fr/i", $lang))
                            $langname=self::islang('fr');
                        else if (preg_match("/de/i", $lang))
                            $langname=self::islang('de');
                        else if (preg_match("/jp/i", $lang))
                            $langname=self::islang('jp');
                        else if (preg_match("/ko/i", $lang))
                            $langname=self::islang('ko');
                        else if (preg_match("/es/i", $lang))
                            $langname=self::islang('es');
                        else if (preg_match("/sv/i", $lang))
                            $langname=self::islang('sv');
                        $langname=($langname==""?self::getdomainlang():$langname);
                        session::set('nolong_templatelang',$langname);
                        session::set('nolong_templatelang_domain',$_SERVER['HTTP_HOST']);
                        return $langname;
                    }
                }
            }
        }
        return 'cn';
    }*/
    static function getistemplate($lang_getistemplate=array("templatelang"=>"","templatelangdomain"=>""))
    {
        $langurl=isset($_GET["url"])?$_GET["url"]:"";
        $returnlangurl="";
        if(file_exists(ROOT."/data/locked")) {
            //前台打开商品的时候
            if (isset($_GET["aid"]) && $_GET["aid"] != '' && $_GET["case"] == 'archive' && $_GET["act"] == 'show'){
                $template_aid=session::get("lang_getistemplate_".$_GET["aid"]);
                if (!$template_aid)
                    $archive=archive::getInstance()->getrow("aid=".$_GET["aid"]);
                else
                    return $template_aid['templatelang'];
                $langurl=lang::getlangurlname($archive['langid']);
                session::set("lang_getistemplate_".$_GET["aid"],array("templatelang"=>$langurl,"templatelangdomain"=>$_SERVER['HTTP_HOST']));
                return $langurl;
            }
            //前台打开栏目的时候
            if (isset($_GET["catid"]) && $_GET["catid"] != ''){
                if (!self::$categorydata){
                    self::getInstance();
                }
                $template_catid=session::get("lang_getistemplate_".$_GET["catid"]);
                if (!$template_catid)
                     $langurl=lang::getlangurlname(self::$categorydata->category[$_GET["catid"]]['langid']);
                else
                    return $template_catid['templatelang'];
                session::set("lang_getistemplate_".$_GET["catid"],array("templatelang"=>$langurl,"templatelangdomain"=>$_SERVER['HTTP_HOST']));
                return $langurl;
            }
            if (session::get('lang_getistemplate')){
                $lang_getistemplate=session::get('lang_getistemplate');
            }
            if ( $lang_getistemplate['templatelang']!="" && $langurl=="" && $lang_getistemplate['templatelangdomain']==$_SERVER['HTTP_HOST']) {
                $langurl=$lang_getistemplate['templatelang'];
                return $langurl;
            }

            $langdata=self::getall();
            foreach ((array)$langdata as $key=>$val){
                $domain=explode(",",$val['domain']);
               if($val['static'] && $val['langurlname']==$langurl && ($val['domain']=="" || (!in_array($_SERVER['HTTP_HOST'],$domain) && $val['domain']!="")) ){
                       $returnlangurl= $val['langurlname'];
               }
            }

            if ($langurl!=$returnlangurl || $langurl==""){
                $langurl=self::getdefaultlangurl();
            }
            session::set("lang_getistemplate",array("templatelang"=>$langurl,"templatelangdomain"=>$_SERVER['HTTP_HOST']));
            return $langurl;
        }
        return 'cn';
    }

    //修改前台语言包
    static function settistemplate($langurl)
    {
        session::set("lang_getistemplate",array("templatelang"=>$langurl,"templatelangdomain"=>$_SERVER['HTTP_HOST']));
       /* if(session::get('username')){
            $user = new user();
            //然后修改当前数据
            $user-> rec_update(array('templatelang' => $langurl,'templatelangdomain'=>$_SERVER['HTTP_HOST']), "username='".session::get('username')."'");
            //清空
            session::set('lang_getistemplate','');
        }else{
            session::set('nolong_templatelang',$langurl);
            session::set('nolong_templatelang_domain',$_SERVER['HTTP_HOST']);
        }*/
    }

    //获取后台语言包的路径
  /*  static function getisadmin( )
    {
        if(file_exists(ROOT."/data/locked"))
        {
            if (session::get('lang_getisadmin')){
                $_lang=session::get('lang_getisadmin');
            }else{
                $_lang=array("adminlang"=>"","adminlangdomain"=>"");
            }
            if ($_lang['adminlang']!="" && session::get('username') && $_lang['adminlangdomain']==$_SERVER['HTTP_HOST']) {   //前提条件是登陆了
                return $_lang['adminlang'];
            }else
            if (session::get('nolong_adminlang') && !session::get('username') && session::get('nolong_adminlang_domain')==$_SERVER['HTTP_HOST'] ){      //判断游客的缓存
                 return session::get('nolong_adminlang');
            }
            $configdatabase = config::getdatabase('database');
            $pddatabase=dbmysqli::getInstance($configdatabase['hostname'],$configdatabase['user'], $configdatabase['password'],$configdatabase['database']);
            if (!mysqli_connect_errno($pddatabase))
            {
                $table =$configdatabase['prefix'] . "lang";
                if (mysqli_num_rows($pddatabase->query( "SHOW TABLES LIKE '" . $table . "'")) == 1) {
                    $user = new user();
                    if (session::get('username')){
                        $_lang = $user->getrow("username='".session::get('username')."'", 1);
                        if (is_array($_lang)) {
                            if ($_lang['adminlangdomain']!=$_SERVER['HTTP_HOST']){
                                $_lang['adminlang']=self::getdomainlang(); //获取语言 优先获取域名的 然后是默认的
                                $_lang['adminlangdomain']=$_SERVER['HTTP_HOST'];
                            }
                            session::set('lang_getisadmin', $_lang);
                            return $_lang['adminlang'];
                        }
                    }else if(session::get('nolong_adminlang') && session::get('nolong_adminlang_domain')==$_SERVER['HTTP_HOST']){   //没登陆的时候  看看session有没有前台语言
                        return session::get('nolong_adminlang');
                    }else{
                        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4); //只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。

                        if (preg_match("/zh-c/i", $lang))
                            $langname=self::islang('cn');
                        else if (preg_match("/zh/i", $lang))
                            $langname=self::islang('cn');
                        else if (preg_match("/en/i", $lang))
                            $langname=self::islang('en');
                        else if (preg_match("/fr/i", $lang))
                            $langname=self::islang('fr');
                        else if (preg_match("/de/i", $lang))
                            $langname=self::islang('de');
                        else if (preg_match("/jp/i", $lang))
                            $langname=self::islang('jp');
                        else if (preg_match("/ko/i", $lang))
                            $langname=self::islang('ko');
                        else if (preg_match("/es/i", $lang))
                            $langname=self::islang('es');
                        else if (preg_match("/sv/i", $lang))
                            $langname=self::islang('sv');
                        $langname=($langname==""?self::getdomainlang():$langname);
                        session::set('nolong_adminlang',$langname);
                        session::set('nolong_adminlang_domain',$_SERVER['HTTP_HOST']);
                        return $langname;
                    }
                }
            }
        }
        return 'cn';
    }*/
    static function getisadmin()
    {
        $langurl=isset($_GET["url"])?$_GET["url"]:"";
        $returnlangurl="";
        $username=cookie::get("login_username");
        if(file_exists(ROOT."/data/locked")) {
            //获取管理员配置
            $langadmindata=self::getadmin();

            if(isset($langadmindata[$username]) && is_array($langadmindata[$username])
            && isset($langadmindata[$username]['adminlang']) && $langadmindata[$username]['adminlang'] != ""
                && isset($langadmindata[$username]['adminlangdomain']) &&  $langadmindata[$username]['adminlangdomain'] == $_SERVER['HTTP_HOST']
                && $langurl==""){
                $langurl=$langadmindata[$username]['adminlang'];
                return $langurl;
            }
            $langdata=self::getall();
            foreach ((array)$langdata as $key=>$val){
                $domain=explode(",",$val['domain']);
                if($val['static'] && $val['langurlname']==$langurl && ($val['domain']=="" || (!in_array($_SERVER['HTTP_HOST'],$domain) && $val['domain']!="")) ){
                    $returnlangurl= $val['langurlname'];
                }
            }
            if ($langurl!=$returnlangurl || $langurl==""){
                $langurl=self::getdefaultlangurl();
            }
            return $langurl;
        }
        return 'cn';
    }


    //判断语言是否存在
    static function islang($langname=""){
        $lang = self::getall();
        if (is_array($lang))
            foreach ((array)$lang as $key=>$val){
                if ($val['static'] && $val['langurlname']=$langname) {
                    return $val['langurlname'];
                }
            }
        return '';
    }

    //获取语言 优先获取域名的 然后是默认的
   static  function getdomainlang(){
       $langname=self::getdefaultlangurl();
       $lang = self::getall();
       if (is_array($lang))
           foreach ((array)$lang as $key=>$val){
               $domain=explode(",",$val['domain']);
               if ($val['domain']<>"" && in_array($_SERVER['HTTP_HOST'],$domain) ) {
                   $langname=$val['langurlname'];
               }
           }
       return $langname;

      /* $lang = self::getInstance();
       $_lang = $lang->getrows(" domain <> '' ", 0, 'id asc');

       if (is_array($_lang)){
           foreach ($_lang as $key=>$val){
               $domain=explode(",",$val['domain']);
               if(in_array($_SERVER['HTTP_HOST'],$domain)){
                   $langname=$val['langurlname'];
               }
           }
       }
       if ($langname==""){
           $langname=self::getdefaultlangurl();
       }
       return $langname;*/
    }

    //获取默认语言包
    static function getisdefault( )
    {
        if (!config::getadmin('lang_open')){
            if(!file_exists(ROOT."/data/locked"))
            {
                return "cn";
            }
        }
        $lang = self::getall();
        if (is_array($lang))
            foreach ((array)$lang as $key=>$val){
                if ($val['isdefault']) {
                    return $val['langurlname'];
                }
            }
        return 'cn';
    }

    //修改后台语言包
    static function setisadmin($langurl)
    {
        $username=cookie::get("login_username");
        $langadmindata=self::getInstance()->getadmin();
        $langadmindata[$username]=array("adminlang"=>$langurl,"adminlangdomain"=> $_SERVER['HTTP_HOST']);
        self::setadmin($langadmindata);
        load_admin_lang('system_admin.php','system_admin_custom.php');
       /* if(session::get('username')) {
            $user = new user();
            //然后修改当前数据
            $user->rec_update(array('adminlang' => $langurl,'adminlangdomain'=>$_SERVER['HTTP_HOST']), "username='" . session::get('username') . "'");
            //清空
            session::set('lang_getisadmin', '');
        }else{
            session::set('nolong_adminlang',$langurl);
            session::set('nolong_adminlang_domain',$_SERVER['HTTP_HOST']);
        }*/
    }

    //获取所有可用语言包的路径名称
    static function getlangurl()
    {
        if (!config::getadmin('lang_open')) {
            if(!file_exists(ROOT."/data/locked"))
            {
               return 'cn';
            }
            return lang::getisdefault();
        }
        $lang = self::getall();
        if (is_array($lang)) {
            foreach ((array)$lang as $key => $val) {
                $domain = explode(",", $val['domain']);
                if (!$val['static'] && (!in_array($_SERVER['HTTP_HOST'], $domain) && $val['domain'] != "")) {
                    unset($lang[$key]);
                }
            }
            return $lang;
        }
        return '';
/*
        $lang = self::getInstance();
        $where=" static=1 ";
        if (!config::getadmin('lang_open')) {
                if(!file_exists(ROOT."/data/locked"))
                {
                    $where.=" and  langurlname='cn' ";
                }
                $where.=" and  langurlname='".lang::getisdefault()."' ";
        }
        $_lang = $lang->getrows($where, 0, 'id asc');
        if (is_array($_lang)){
            //获取当前域名
            //$http_host = (self::isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']; //获取域名
            foreach ($_lang as $key=>$val){
                $domain=explode(",",$val['domain']);
                if(!in_array($_SERVER['HTTP_HOST'],$domain) && $val['domain']!=""){
                    unset($_lang[$key]);
                }
            }
            return $_lang;
        }else{
            return '';
        }*/

    }


    static function isHTTPS()
    {
        if (defined('HTTPS') && HTTPS) return true;
        if (!isset($_SERVER)) return FALSE;
        if (!isset($_SERVER['HTTPS'])) return FALSE;
        if ($_SERVER['HTTPS'] === 1) {  //Apache
            return TRUE;
        } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
            return TRUE;
        } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
            return TRUE;
        }
        return FALSE;
    }

    //获取所有可用语言包的路径名称
    static function getconfiglangurl()
    {
        $lang = self::getall();
        if (is_array($lang)) {
            foreach ((array)$lang as $key => $val) {
                if (!$val['static']) {
                    unset($lang[$key]);
                }
            }
            return $lang;
        }
        return '';

        /*$lang = self::getInstance();
        $where=" static=1 ";
        $_lang = $lang->getrows($where, 0, 'id asc');
        if (is_array($_lang)){
            return $_lang;
        }else{
            return '';
        }*/

    }

    //生成php语言缓存文件
    public static function setall($data="")
    {
        $path = ROOT . '/lang/config/lang_all.php';
        if ($data=="") $data=self::getInstance()->getrows("",0);
        if (is_array($data)) {
            $string = var_export($data, true);
        } else {
            $data = str_replace("'", "\'", $data);
            $string = "'$data'";
        }
        $string = "<?php  return " . $string . ';';
        tool::mkdir(dirname($path));
        file_put_contents($path, $string);
    }
    //读取php语言缓存文件
    public static function getall()
    {
        if (!file_exists(ROOT."/lang/config/lang_all.php")){
            self::setall();
        }
        if (!self::$langtemplatedata){
            $path = ROOT . '/lang/config/lang_all.php';
            if (file_exists($path)) {
                self::$langtemplatedata = include $path;
            }
        }

        return self::$langtemplatedata;
    }

    //生成php语言缓存文件  后台语言
    public static function setadmin($data="")
    {
        $path = ROOT . '/lang/config/lang_admin.php';
        if (file_exists($path))
        {
            unlink($path);
        }
        $username=cookie::get("login_username");
        if ($data=="")$data=array($username=>array());
        if (is_array($data)) {
            $string = var_export($data, true);
        } else {
            $data = str_replace("'", "\'", $data);
            $string = "'$data'";
        }

        $string = "<?php  return " . $string . ';';
        tool::mkdir(dirname($path));
        if(!is_dir(ROOT. '/lang/config')){
            mkdir(ROOT. '/lang/config',0777,true);
        }
        if(!is_dir(dirname($path))){
            mkdir(dirname($path), 0777);
            chmod(dirname($path), 0777);
        }
        file_put_contents($path, $string);
        self::$langadmindata=$data;

    }
    //读取php语言缓存文件   后台语言
    public static function getadmin()
    {
        if (!file_exists(ROOT."/lang/config/lang_admin.php")){
            self::setadmin();
        }
        if (!self::$langadmindata) {
            $path = ROOT . '/lang/config/lang_admin.php';
            if (file_exists($path)) {
                self::$langadmindata = include $path;
            }
        }
        return self::$langadmindata;
    }


    //读取多语言的html_prefix  图库
    public static function getlang_html_prefix()
    {
        $lang_data=self::getlang();
        $html_prefix=array();
        if (is_array($lang_data)){
            foreach ($lang_data as $lang){
                if (config::get("html_prefix",$lang['langurlname'])){
                    $html_prefix[]=str_replace("/","",config::get("html_prefix",$lang['langurlname']));
                }
            }
        }

        return $html_prefix;
    }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.