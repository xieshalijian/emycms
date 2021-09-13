<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

class admin_system_
{
    public static function _pcompile__()
    {
        $domains = 'cmseasy.cn';
        $domain_arr = explode('|', $domains);
        $pass = false;
        foreach ($domain_arr as $domain) {
            preg_match('/([\w\-]+(\.(org|net|com|xyz|gov|cn|xin|ren|club|top|red|bid|loan|click|link|help|gift|pics|photo|news|video|win|party|date|trade|science|online|tech|site|website|space|press|rocks|band|engineer|market|pub|social|softwrar|lawyer|wiki|design|live|studio|vip|mom|lol|work|biz|info|name|cc|tv|me|co|so|tel|hk|mobi|in|sh))(\.(cn|la|tw|hk|au|uk|za))*|\d+\.\d+\.\d+\.\d+)$/i', trim(front::$domain), $match);
            preg_match('/([\w\-]+(\.(org|net|com|xyz|gov|cn|xin|ren|club|top|red|bid|loan|click|link|help|gift|pics|photo|news|video|win|party|date|trade|science|online|tech|site|website|space|press|rocks|band|engineer|market|pub|social|softwrar|lawyer|wiki|design|live|studio|vip|mom|lol|work|biz|info|name|cc|tv|me|co|so|tel|hk|mobi|in|sh))(\.(cn|la|tw|hk|au|uk|za))*|\d+\.\d+\.\d+\.\d+)$/i', trim($domain), $match1);
            if (isset($match[0])) {
                $name = $match[0];
            } else {
                $name = front::$domain;
            }
            if (isset($match1[0])) {
                $domain = $match[0];
            }
            if ($domain == $name) {
                $pass = true;
                break;
            }
        }
        return $pass;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
