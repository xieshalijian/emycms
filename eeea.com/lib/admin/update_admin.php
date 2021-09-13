<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class update_admin extends admin
{
    function init()
    {
    }

    function index_action()
    {
        $curl = new curl();
        //$curl->set('file', 'upserv/frontend/web/index.php?r=version/check&code=' . _VERCODE . '&ver=' . session::get('ver'));
        $curl->set('file', 'upserv/frontend/web/index.php?r=version/check&code=' . _VERCODE . '&ver=' . session::get('ver'));
        $str = $curl->curl_post(null, 10);
        //var_dump($str);
        $arr = json_decode($str, 1);
        if ($arr['err'] == 0) {
            $this->view->isnew = 1;
            if (isset($arr['data']['code'])){
                $url="http://service.cmseasy.cn/upserv/frontend/web/versions/".$arr['data']['code'].'/update.json';
                $res = $this->get_file($url, 'cache',true);
                if ($res) {
                    $json_path=ROOT."/cache/update.json";
                    if(file_exists($json_path)){
                        $json_string=file_get_contents($json_path);
                        $json = json_decode($json_string,true);
                        if (is_array($json)){
                            $file_erro=array(); //错误目录或者文件权限问题
                            foreach ($json as $file) {
                                $fileName = $this->switch_admin($file);
                                if(!file_exists(ROOT.'/'.$fileName)){
                                    $file_erro[]=array("path"=>ROOT.'/'.$fileName,"erro_type"=>1);//没有目录
                                }
                                elseif(!is_writable(ROOT.'/'.$fileName)){
                                    $file_erro[]=array("path"=>ROOT.'/'.$fileName,"erro_type"=>2);//没有写入权限
                                }
                            }
                        }
                        if (count($file_erro)>0){
                            $this->view->file_erro =$file_erro;
                        }
                    }
                }
            }
        }
        //var_dump($arr);exit;
        $this->view->row = $arr;
        $user = new user();
        $this->view->dbversion = $user->verison();
    }


    /**
     * @param $file
     * @return mixed
     */
    public function switch_admin($file)
    {
        $info = explode('/', $file);
        $full_file = ROOT.$file;
        if($info[0] == 'lib' && $info[1] == 'admin'){
            $fileName = str_replace('lib/admin', 'lib/'.config::getadmin('admin_dir',true), $full_file);
            $fileName = str_replace(ROOT, '', $fileName);
        }
        elseif($info[0] == 'template_admin' && $info[1] == 'admin'){
            $fileName = str_replace('template_admin/admin', 'template_admin/'.config::getadmin('template_admin_dir',true), $full_file);
            $fileName = str_replace(ROOT, '', $fileName);
        }
        else{
            $fileName = $file;
        }

        return $fileName;
    }

    function getfile_action()
    {
        $curl = new curl();
        $curl->set('file', 'upserv/frontend/web/index.php?r=version/getfile&code=' . front::get('code') . '&domain=' . front::$domain . '&oldver=' . _VERCODE . '&newver=' . front::get('code') . '&cmsver=' . session::get('ver'));
        $str = $curl->curl_post(null, 10);
        //session::set('downurl', $str);
        //var_dump('upserv/frontend/web/index.php?r=version/getfile&code=' . front::get('code').'&domain='.front::$domain.'&oldver='._VERCODE.'&newver='.front::get('code').'&cmsver='.session::get('ver'));exit;
        echo $str;
        exit;
    }

    function get_file($url, $folder = "./", $isjson = false)
    {
        set_time_limit(24 * 60 * 60); // 设置超时时间
        $destination_folder = $folder . '/'; // 文件下载保存目录，默认为当前文件目录
        if (!is_dir($destination_folder)) { // 判断目录是否存在
            $this->mkdirs($destination_folder); // 如果没有就建立目录
        }
        if ($isjson)
            $newfname = $destination_folder . 'update.json'; // 取得文件的名称
        else
            $newfname = $destination_folder . 'patch.zip'; // 取得文件的名称
        //var_dump($url);exit;
        $file = fopen($url, "rb"); // 远程下载文件，二进制模式
        if ($file) { // 如果下载成功
            $newf = fopen($newfname, "wb"); // 远在文件文件
            if ($newf) // 如果文件保存成功
                while (!feof($file)) { // 判断附件写入是否完整
                    fwrite($newf, fread($file, 1024), 1024); // 没有写完就继续
                    //usleep(2000);
                    //clearstatcache();
                }
        } else {
            return false;
        }
        if ($file) {
            fclose($file); // 关闭远程文件
        } else {
            return false;
        }
        if ($newf) {
            fclose($newf); // 关闭本地文件
        } else {
            return false;
        }
        return true;
    }

    function mkdirs($path, $mode = "0777")
    {
        if (!is_dir($path)) { // 判断目录是否存在
            $this->mkdirs(dirname($path), $mode); // 循环建立目录
            mkdir($path, $mode); // 建立目录
        }
        return true;

    }


    function downfile_action()
    {
        $url = front::get('url');

        $res = $this->get_file($url, 'cache');
        if (!$res) {
            $res = array(
                'err' => 1,
                'data' => lang_admin('update_package_download_failed'),
            );
        } else {
            @unlink('upgrade/config_cn.php');
            @unlink('upgrade/config_cn.tmp.php');
            @unlink('upgrade/upgrade.sql');
            @unlink('upgrade/command.php');
            front::remove(ROOT.'/cache/data');
            front::remove(ROOT.'/cache/template');//清空全部语言
            $langdata=getlang();
            if($langdata != ""){
                foreach ($langdata as $key=>$val){
                    front::remove(ROOT.'/cache/'.$val['langurlname']);
                    front::remove(ROOT.'/'.$val['langurlname'].'/template');
                }
            }
            //先清空缓存
            user::deletesession();
            category::deletesession();
            //提取分类
            if(file_exists(ROOT."/lib/table/type.php")) {
                type::deletesession();
            }
            //提取专题
            if(file_exists(ROOT."/lib/table/special.php")) {
                special::deletesession();
            }
            $archive = new PclZip('cache/patch.zip');
            $archive->extract(PCLZIP_OPT_PATH, ROOT, PCLZIP_OPT_REPLACE_NEWER);

            if(file_exists('upgrade/upgrade.sql')) {
                $sqlquery = file_get_contents('upgrade/upgrade.sql');
                $sqlquery = str_replace('`cmseasy_', '`' . config::getdatabase('database', 'prefix'), $sqlquery);

                $sqlquery = str_replace("\r", "", $sqlquery);
                $sqls = preg_split("/;(--)*[ \t]{0,}\n/", $sqlquery);
                $this->exec_cms_sql($sqls);
            }

            if(file_exists('upgrade/command.php')){
                include ROOT . '/upgrade/command.php';
            }
            $res = array(
                'err' => 0,
                'message' => $this->message,
                'data' => lang_admin('upgrade_successful'),
            );
        }

        echo json_encode($res);
        exit;
    }

    //手动升级
    function manualdownfile_action()
    {
        $this->message=array();
        $url = front::post('zipurl');

        @unlink('upgrade/config_cn.php');
        @unlink('upgrade/config_cn.tmp.php');
        @unlink('upgrade/upgrade.sql');
        $archive = new PclZip($url);
        if (!$archive->extract(PCLZIP_OPT_PATH, ROOT, PCLZIP_OPT_REPLACE_NEWER)) {
            $res=array("err"=>1,"data"=>$archive->errorInfo(true));
            echo json_encode($res);
            exit;
        }

        if(file_exists('upgrade/upgrade.sql')) {
            $sqlquery = file_get_contents('upgrade/upgrade.sql');
            $sqlquery = str_replace('`cmseasy_', '`' . config::getdatabase('database', 'prefix'), $sqlquery);


            $sqlquery = str_replace("\r", "", $sqlquery);
            $sqls = preg_split("/;(--)*[ \t]{0,}\n/", $sqlquery);

            $this->exec_cms_sql($sqls);
        }
        if(file_exists('upgrade/command.php')){
            include ROOT . '/upgrade/command.php';
        }
        $res = array(
            'err' => 0,
            'message' => $this->message,
            'data' => lang_admin('upgrade_successful'),
        );

        echo json_encode($res);
        exit;
    }
        function  exec_cms_sql($sqls){
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysql = new user();
            $sql_static=true;
            foreach ($sqls as $key=>$q) {
                $q = trim($q);
                if ($q != "") {
                    unset($sqls[$key]);
                    try{
                        $mysql->query($q);
                    } catch (Exception $e) {
                        $this->message[]=$q;
                        $sql_static=false;
                    }

                }
            }
            if (!$sql_static)
                    $this->exec_cms_sql($sqls);
        }

    function getsize_action()
    {
        echo filesize('cache/patch.zip');
        exit;
    }

    function end()
    {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
