<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.

header("Pragma:no-cache\r\n");
header("Cache-Control:no-cache\r\n");
header("Expires:0\r\n");
header("Content-Type: text/html; charset=utf-8");
header('Cache-control: private, must-revalidate');
date_default_timezone_set('Etc/GMT-8');
$_GET['site']='default';
error_reporting(0);
//error_reporting(E_ALL & ~(E_NOTICE | E_STRICT | E_DEPRECATED));
if(version_compare(PHP_VERSION,'5.4.0','<'))  die('<div style="width:300px;margin:0px auto;margin-top:50px;padding:20px;border:5px solid #ccc;border-radius: 5px 5px 5px 5px;text-align:left;"><p>This system requires PHP version at least <strong style="color:blue"> 5.4.0</strong> or higher</p><p>The current PHP version is:   <strong style="color:red;">' .PHP_VERSION . ' !</strong></p><p style="color:green">Please go to the virtual host control panel to switch the PHP version, or contact the space provider to help switch.</p><p><center><a href="https://www.cmseasy.cn/chm/faq/show-551.html" target="_blank">Click to view the installation tutorial!</a></center></p></div>');


class time {

    static $start;
    static function start() {
        self::$start=self::getMicrotime();
    }

    static function getMicrotime() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    static function getTime($length=6) {
        return round(self::getMicrotime()-self::$start, $length);
    }
}
function is_mobile() {
    if(!config::get('mobile_open')){
        return false;
    }elseif(config::get('mobile_open') == 2){
        return true;
    }else {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_agents = Array("240x320", "acer", "acoon", "acs-", "abacho", "ahong", "airness", "alcatel", "amoi", "android", "anywhereyougo.com", "applewebkit/525", "applewebkit/532", "asus", "audio", "au-mic", "avantogo", "becker", "benq", "bilbo", "bird", "blackberry", "blazer", "bleu", "cdm-", "compal", "coolpad", "danger", "dbtel", "dopod", "elaine", "eric", "etouch", "fly ", "fly_", "fly-", "go.web", "goodaccess", "gradiente", "grundig", "haier", "hedy", "hitachi", "htc", "huawei", "hutchison", "inno", "ipad", "ipaq", "ipod", "jbrowser", "kddi", "kgt", "kwc", "lenovo", "lg ", "lg2", "lg3", "lg4", "lg5", "lg7", "lg8", "lg9", "lg-", "lge-", "lge9", "longcos", "maemo", "mercator", "meridian", "micromax", "midp", "mini", "mitsu", "mmm", "mmp", "mobi", "mot-", "moto", "nec-", "netfront", "newgen", "nexian", "nf-browser", "nintendo", "nitro", "nokia", "nook", "novarra", "obigo", "palm", "panasonic", "pantech", "philips", "phone", "pg-", "playstation", "pocket", "pt-", "qc-", "qtek", "rover", "sagem", "sama", "samu", "sanyo", "samsung", "sch-", "scooter", "sec-", "sendo", "sgh-", "sharp", "siemens", "sie-", "softbank", "sony", "spice", "sprint", "spv", "symbian", "talkabout", "tcl-", "teleca", "telit", "tianyu", "tim-", "toshiba", "tsm", "up.browser", "utec", "utstar", "verykool", "virgin", "vk-", "voda", "voxtel", "vx", "wap", "wellco", "wig browser", "wii", "windows ce", "wireless", "xda", "xde", "zte");
        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $_GET['t'] == 'wap' ? true :$is_mobile;
    }
}
time::start();
define('ROOT',dirname(__FILE__));

define('TEMPLATE',dirname(__FILE__).'/template');
define('TEMPLATE_ADMIN',dirname(__FILE__).'/template_admin');

if(!defined('THIS_URL')) define('THIS_URL','');

set_include_path(ROOT.'/lib/default'.PATH_SEPARATOR.ROOT.'/lib/plugins'.PATH_SEPARATOR.ROOT.'/lib/tool'.PATH_SEPARATOR.ROOT.'/lib/table'.PATH_SEPARATOR.ROOT.'/lib/inc');
function _autoload($class) {
    if(in_array($class,array('Throwable','TypeError'))){
        return;
    }
    if(preg_match('/^PHPExcel_/i', $class)){
        include str_replace('_','/',$class).'.php';
        //include ROOT."/lib/plugins/".str_replace('_','/',$class).'.php';
    }else{
        if($class == 'admin_system'){
            include_once ROOT.'/lib/admin/admin_system.php';
            include_once ROOT.'/lib/admin/admin_system_.php';
        }else{
            if ((strlen($class) > 7) && (strtolower(substr($class, 0, 7)) === "hprose\\")) {
                $file = ROOT.'/lib/plugins'.DIRECTORY_SEPARATOR.'hprose'.DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
                //var_dump($file);exit;
                if (is_file($file)) {
                    include $file;
                    return true;
                }
            }
            include $class.'.php';
        }
    }



    if(!class_exists($class,false) && !interface_exists($class,false)){
        if(preg_match('/_act$/',$class)){
            throw new HttpErrorException(404, 'lang("page_does_not_exist")', 404);
            //404页面不存在
        }
        exit('lang("system_failed_to_load_class")，lang("class")'.$class.'lang("nonentity")！');
        //加载类失败
    }
}
spl_autoload_register('_autoload');
require_once(ROOT . '/lib/tool/functions.php');
require_once(ROOT . '/lib/tool/front_class.php');
require_once(ROOT . '/lib/plugins/userfunction.php');

if(config::get('safe360_enable')){

    include_once(ROOT . '/lib/tool/waf.php');

    if(is_file(dirname(__FILE__).'/webscan360/360safe/360webscan.php')){
        require_once(dirname(__FILE__).'/webscan360/360safe/360webscan.php');
    }
}
$debug=config::get('isdebug');//1提示错误，0禁止
if ($debug){
    @ini_set("display_errors","On");
    error_reporting(E_ALL & (~(E_NOTICE | E_STRICT | E_DEPRECATED)));
}else{
    error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
}

if(preg_match("/[\'~`!$^)({}]|\]|\[|\"/i",$_SERVER['REQUEST_URI'])){
    header('location: /404.php');exit;
}



try{
    $front = new front();
    $front->dispatch();
}catch(HttpErrorException $e){
    if(config::get('custom404') && $e->statusCode == 404){
        header('location: /404.php');
    }else{
        exit($e->statusCode.':'.$e->getMessage());
    }
}

if(file_exists(ROOT."/lib/table/stats.php")) {
    stats::getbot();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.