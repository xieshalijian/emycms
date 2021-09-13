<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class event extends table
{
    static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new event();
            self::$me = $class;
        }
        return self::$me;
    }

    function getcols($act = '')
    {
        return '*';
    }

    static function loginfalsemaxtimes()
    {
        $ip = front::ip();
        $ftime = time() - 3600;
        $event = new event;
        return $event->rec_count("event='loginfalse' and ip='$ip' and addtime>$ftime ") > config::get('template_nologin');
    }

    static function log($action, $remark)
    {
        $user = new user();
        $username = cookie::get('login_username');
        $row = $user->getrow(array('username' => $username));
        $uid = $row['userid'];
        $action = lang($action);
        $remark = addslashes(lang($remark));
        $ip = front::ip();
        $time=date('Y-m-d H:i:s', time());
        $addtime =$time;;
        $data = array(
            'username' => '<td align="center">'.$username.'</td>',
            'addtime' => '<td align="center">'.$addtime.'</td>',
            'ip' => '<td align="center">'.$ip.'</td>',
            'event' => '<td align="center">'.$action.'</td>',
            'note' => '<td align="center">'.$remark.'</td>'."\n",
        );

        //日志写入txt文件
        $filetime=date('Ymd', time());
        $fileName='log'.$filetime.'.txt';
        $file  = 'data/event/'.$fileName;//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
        if (!file_exists( 'data/event/' )) {mkdir ('data/event/',0777,true );}
        $content = $data;
        file_put_contents($file, $content,FILE_APPEND);// 这个函数支持版本(PHP 5)

    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.