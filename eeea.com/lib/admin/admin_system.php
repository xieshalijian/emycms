<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class admin_system
{
    static function _pcompile_($source)
    {
        $tsource = $source;
        $pass = false;
        if(file_exists(ROOT . '/license/reg.lic')){
            $source = file_get_contents(ROOT . '/license/reg.lic');
            if($source){
                $tmp = explode('!@#$%^&*', $source);
                $tmp1 = explode('*&^%$#@!',$tmp[1]);
                $source = authcode($tmp[0],'DECODE', $tmp1[0]);
                $sources = array();
                if (!strpos($source, 's*s'))
                    $sources[] = $source;
                else {
                    $sources = explode('s*s', $source);
                }
                foreach ($sources as $source) {
                    $authkey = run::_getauthkey_($source);
                    $authdate = intval(run::_getauthdate_($source));
                    $authperiod = intval(run::_getauthperiod_($source));
                    if ($authdate + $authperiod < time()) {
                        break;
                    }
                    $name = front::$domain;
                    preg_match('/([\w\-]+(\.(org|net|com|beer|xyz|gov|cn|xin|ren|club|top|red|bid|loan|click|link|help|gift|pics|photo|news|video|win|party|date|trade|science|online|tech|site|website|space|press|rocks|band|engineer|market|pub|social|softwrar|lawyer|wiki|design|live|studio|vip|mom|lol|work|biz|info|name|cc|tv|me|co|so|tel|hk|mobi|in|sh|tw|ltd))(\.(cn|la|tw|hk|au|uk|za|beer))*|\d+\.\d+\.\d+\.\d+)$/i', trim($name), $match);
                    if (isset($match[0])) {
                        $name = $match[0];
                    }
                    $wwwname='www.'.$name;
                    if ($authkey == run::md5tocdkey($source, $name) || $authkey == run::md5tocdkey($source, $wwwname)) {
                        $pass = true;
                        break;
                    }
                }
            }
        }
        $source = $tsource;
        $soft_type = null;
        $phppass = admin_system_::_pcompile__();
        if (!$pass || !$phppass) {
            $passinfo = '免费版 <a href="https://www.cmseasy.cn/service/" target="_blank"><font color="green">('.lang_admin('purchase_authorization').')</font></a>';
            session::set('ver', 'free');
            session::set('passinfo', $passinfo);
            preg_match_all('/<title>(.*) - (.*)<\/title>/', $source, $out);
            $source = preg_replace('/<head>/i', "<head>\r\n<meta name=\"Generator\" content=\"" . SYSTEMNAME . ' ' . _VERSION . "\" />", $source);
        } else {
            $passinfo = '<span id="__edition">'.lang_admin('commercial_version').'</span>';
            session::set('ver', 'corp');
            session::set('passinfo', $passinfo);
        }
        $source = preg_replace("/\{php\s+(.+)\}/", "<?php \\1?>", $source);
        $source = preg_replace("/\{if\s+(.+?)\}/", "<?php if(\\1) { ?>", $source);
        $source = preg_replace("/\{else\}/", "<?php } else { ?>", $source);
        $source = preg_replace("/\{elseif\s+(.+?)\}/", "<?php } elseif (\\1) { ?>", $source);
        $source = preg_replace("/\{\/if\}/", "<?php } ?>", $source);
        $source = preg_replace("/\{loop\s+(\\$\w+)\s+(\S+)\}/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\{loop\s+(\\$\w+)\s+(\S+)\s+(\S+)\}/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\{\/loop\}/", "<?php } ?>", $source);
        return $source;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
