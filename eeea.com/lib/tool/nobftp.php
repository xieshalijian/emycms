<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class nobftp {
    private $connid;
    private $errorid;
    public $connmode = FTP_BINARY;
    public $conntime;
    public function connect($host,$user = '',$pwd = '',$port = 21,$pasv = false,$ssl = false,$timeout = 30) {
        $connstarttime = time();
        if($ssl) {
            $connfun = 'ftp_ssl_connect';
        }else {
            $connfun = 'ftp_connect';
        }
        if(!$this->connid = @$connfun($host,$port,$timeout)) {
            $this->errorid = 1;
            return false;
        }
        if(@ftp_login($this->connid,$user,$pwd)) {
            if($pasv) ftp_pasv($this->connid,true);
            $this->conntime = time()-$connstarttime;
        }else {
            $this->errorid = 1;
            return false;
        }
        register_shutdown_function(array(&$this,'close'));
    }
    public function checkconnect() {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
    }
    public function checkdir($dir) {
        $dir = str_replace('\\','/',$dir);
        $dir = explode('/',$dir);
        return $dir;
    }
    public function nobchdir($dir) {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
        if(@ftp_chdir($this->connid,$dir)) {
            return true;
        }else {
            $this->errorid = 6;
            return false;
        }
    }
    public function nobmkdir($dir) {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
        $dir = $this->checkdir($dir);
        $nowdir = '/';
        foreach($dir as $val) {
            if($val &&!$this->nobchdir($nowdir.$val)) {
                if(!$nowdir) $this->nobchdir($nowdirtmp);
                @ftp_mkdir($this->connid,$val);
            }
            if($val) $nowdir .= $val.'/';
        }
        return true;
    }
    public function nobget($local,$remote) {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
        if(@ftp_get($this->connid,$local,$remote,$this->connmode)) {
            return true;
        }else {
            $this->errorid = 8;
            return false;
        }
    }
    public function nobput($remote,$local) {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
        $dir = pathinfo($remote,PATHINFO_DIRNAME);
        if(!$this->nobchdir($dir)) {
            $this->nobmkdir($dir);
        }
        if(@ftp_put($this->connid,$remote,$local,$this->connmode)) {
            return true;
        }else {
            $this->errorid = 7;
            return false;
        }
    }
    public function nobnlist($dir) {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
        if($list = @ftp_nlist($this->connid,$dir)) {
            return $list;
        }else {
            $this->errorid = 5;
            return false;
        }
    }
    public function nobdelete($file) {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
        if(@ftp_delete($this->connid,$file)) {
            return true;
        }else {
            $this->errorid = 4;
            return false;
        }
    }
    public function nobrmdir($dir,$enforce) {
        if(!$this->connid) {
            $this->errorid = 2;
            return false;
        }
        $list = $this->nobnlist($dir);
        if ($list &&$enforce) {
            $this->chdir($dir);
            foreach($list as $v) {
                $this->nobdelete($v);
            }
        }elseif($list &&!$enforce) {
            $this->errorid = 3;
            return false;
        }
        @ftp_rmdir($this->connid,$dir);
        return true;
    }
    public function returnerror() {
        if(!$this->errorid) return false;
        $message = array(
                '1'=>lang('the_FTP_server_cannot_connect'),
                '2'=>lang('no_link_to_service'),
                '3'=>lang('cannot_delete_a_space_folder'),
                '4'=>lang('unable_to_delete_file'),
                '5'=>lang('unable_to_get_file_list'),
                '6'=>lang('cannot_change_the_current_directory_of_the_server'),
                '7'=>lang('unable_to_upload_file'),
                '8'=>lang('unable_to_get_file')
        );
        return $message[$this->errorid];
    }
    public function close() {
        return @ftp_close($this->connid);
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.