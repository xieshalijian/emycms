<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

function _decrypt($str, $key)
{
    $decode = authcode($str, 'DECODE', $key);
    return $decode;
}

class run extends table
{
    static function _start()
    {
        if (!file_exists(ROOT . '/lib/tool/getinf.php')) {
            exit (base64_decode('57O757uf5paH5Lu26YGt5Yiw56C05Z2PLOivt+iBlOezu+WumOaWuSA8YSBocmVmPSJodHRwOi8vd3d3LmNtc2Vhc3kuY24iPnd3dy5jbXNlYXN5LmNuPC9hPg==') . ' ' . base64_decode('PGEgaHJlZj0iaHR0cDovL3d3dy5jbXNlYXN5LmNuIiB0aXRsZT0iUG93ZXJlZCBieSBDbXNFYXN5LmNuIiB0YXJnZXQ9Il9ibGFuayI+UG93ZXJlZCBieSBDbXNFYXN5PC9hPg'));
        }
    }

    static function check($source)
    {
        $tsource = $source;
        $source = @file_get_contents(ROOT . '/license/reg.lic');
        $tmp = explode(strrev('!@#$%&'), $source);
        $key = _decrypt(xxtea_decrypt($tmp[1], str_repeat('xx', 64)), strtoupper(bin2hex($tmp[2])));
        $source = xxtea_decrypt($tmp[0], $key);
        $start = 0;
        $sources = array();
        if (!strpos($source, 's*s'))
            $sources[] = $source;
        else {
            $sources = explode('s*s', $source);
        }
        $pass = false;
        foreach ($sources as $source) {
            $authkey = service::_getauthkey_($source);
            $authdate = intval(service::_getauthdate_($source));
            $authperiod = intval(service::_getauthperiod_($source));
            if ($authdate + $authperiod < time()) {
                break;
            }
            $name = front::$domain;
            preg_match('/([\w\-]+(\.(org|net|com|beer|xyz|gov|cn|xin|ren|club|top|red|bid|loan|click|link|help|gift|pics|photo|news|video|win|party|date|trade|science|online|tech|site|website|space|press|rocks|band|engineer|market|pub|social|softwrar|lawyer|wiki|design|live|studio|vip|mom|lol|work|biz|info|name|cc|tv|me|co|so|tel|hk|mobi|in|sh|tw|ltd))(\.(cn|la|tw|hk|au|uk|za|beer))*|\d+\.\d+\.\d+\.\d+)$/i', trim($name), $match);
            if (isset($match[0])) {
                $name = $match[0];
            }
            $wwwname='www.'.$name;
            if ($authkey == service::md5tocdkey($source, $name) || $authkey == service::md5tocdkey($source, $wwwname)) {
                $pass = true;
                break;
            }
        }
        $source = $tsource;
        $soft_type = null;
        $phppass = admin_system_::_pcompile__();
        if (!$pass || !$phppass) {
            $passinfo = lang_admin('free_version').' <a href="https://www.cmseasy.cn/service/" target="_blank"><font color="green">('.lang_admin('purchase_authorization').')</font></a>';
            session::set('ver', 'free');
            session::set('passinfo', $passinfo);
            preg_match_all('/<title>(.*) - (.*)<\/title>/', $source, $out);
            $source = preg_replace('/<head>/i', "<head>\r\n<meta name=\"Generator\" content=\"" . SYSTEMNAME . ' ' . _VERSION . "\" />", $source);
            $pos = strpos($source, '</body>');
            if ($pos === false) {
                $source = str_replace('</html>', '</body></html>', $source);
            } else {
                $pos = strpos($source, 'Powered by <a href="https://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>');
                if ($pos === false) {
                    $int = 0;
                    $source = preg_replace('/<body(.*?)>/is', '<body>Powered by <a href="https://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>', $source, -1, $int);
                    if (!$int) {
                        $source = 'Powered by <a href="https://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a>' . $source;
                    }
                }
            }
        } else {
            $passinfo = '<span id="__edition">商业版</span>';
            session::set('ver', 'corp');
            session::set('passinfo', $passinfo);
        }
        $source = preg_replace("/\{php\s+(.+)\}/", "<?php \\1?>", $source);
        $source = preg_replace("/\{if\s+(.+?)\}/", "<?php if(\\1) { ?>", $source);
        $source = preg_replace("/\{else\}/", "<?php } else { ?>", $source);
        $source = preg_replace("/\{elseif\s+(.+?)\}/", "<?php } elseif (\\1) { ?>", $source);
        $source = preg_replace("/\{\/if\}/", "<?php } ?>", $source);
        $source = preg_replace("/\{loop\s+(\\$\w+)\s+(\S+)\}/", "<?php if(is_array(\\1) && !empty(\\1))\r\n\tforeach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\{loop\s+(\\$\w+)\s+(\S+)\s+(\S+)\}/", "<?php foreach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/", "<?php foreach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/", "<?php foreach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\{\/loop\}/", "<?php } ?>", $source);
        return $source;
    }



}


# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.