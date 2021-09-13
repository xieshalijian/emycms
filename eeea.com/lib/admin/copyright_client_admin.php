<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

/**
 * Class license_admin
 * @property license $db_license
 */
class copyright_client_admin extends admin{

    public $db_license = null;
    public $_pagesize = 20;

    function init(){
        $this->_pagesize = config::get('manage_pagesize');
        if (!front::get('page')) front::$get['page']=1;
    }

    function buycopyright_action(){
        //获取已经购买的插件 
        $this->view->returndata=service::getInstance()->getlogin();
        if (session::get("user_buy_copyright")=="") {
            $url = "https://u.cmseasy.cn/index.php?case=client&act=getcopyright";  //服务器获取授权数据
            $data = service::cmseayurl($url);   //获取服务器的数据
            $data = json_decode($data, true);
            session::set("user_buy_copyright",$data);
        }else{
            $data=session::get("user_buy_copyright");
        }
        $this->view->data =$data;
    }

    function copyrightlist_action(){
        $this->_pagesize = config::getadmin('manage_pagesize');
        //获取已经购买的插件
        $returndata=service::getInstance()->getlogin();
        if (is_array($returndata["copyrightdata"])){
            //搜索条件
            if(front::post('submit') && front::post('search_domain')){
                foreach ($returndata["copyrightdata"] as $key=>$val){
                    if(strpos($val['domain'],front::post('search_domain')) === false){
                        unset($returndata["copyrightdata"][$key]);
                    }
                }
            }
        }
        $this->view->returndata=$returndata;
        $this->view->data=$this->pagedata($returndata["copyrightdata"],front::$get['page'],$this->_pagesize);
        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($returndata["copyrightdata"]?$returndata["copyrightdata"]:array());
    }


    //分页
    function pagedata($data,$page,$size){
        $index=1;
        $returndata=array();
        if($page==1){
            if(is_array($data)) {
                foreach ($data as $key => $val) {
                    if ($index <= $size) {
                        $returndata[$key] = $val;
                    }
                    $index++;
                }
            }
        }else{
            if(is_array($data)) {
                foreach ($data as $key => $val) {
                    if ($index > ($page - 1) * $size && $index <= $page * $size) {
                        $returndata[$key] = $val;
                    }
                    $index++;
                }
            }
        }
        return $returndata;
    }

    function json_info($code, $msg)
    {
          echo json_encode(array('code' => $code, 'msg' => $msg));
    }

    function get_remote_file_size($url)
    {
        $headers = array();
        $validhost = filter_var(gethostbyname(parse_url($url,PHP_URL_HOST)), FILTER_VALIDATE_IP);
        if($validhost){
            $headers = get_headers($url, 1);
        }

        return $headers['Content-Length'] ? $headers['Content-Length'] : 0;
    }

    function json($args)
    {
        echo json_encode($args);
    }

    function down_action()
    {
        set_time_limit(0);
        session_write_close();
        $action = front::$get['action'];
        $f = front::$post['f'] ? front::$post['f'] : front::$get['f'];
        $filename = 'copyright.zip';

        $applogin=service::getInstance()->get_service_users(); //反序列化

        $data=service::getmycrdowme($f,$applogin["username"]);
        if(!$data["static"]){
            $this->json_info(1, lang_admin('未购买，无法下载！'));
            exit;
        }
        $download_cache = ROOT . '/cache/downloads/';
        $remote_url=$data['zipurl'];
       if (service::is_ssl()){
           $remote_url= str_replace("http://","https://",$remote_url);
       }else{
           $remote_url= str_replace("https://","http://",$remote_url);
       }

        $file_size = $this->get_remote_file_size($remote_url);
        $tmp_path = $download_cache . $filename;

        switch ($action) {
            case 'prepare-download':
                // 下载缓存文件夹
                if (!is_dir($download_cache)) {
                    tool::mkdir($download_cache);
                }
                $this->json(compact(/*'remote_url', 'tmp_path',*/ 'file_size'));
                break;
            case 'start-download':
                try {
                    touch($tmp_path);
                    if ($fp = fopen($remote_url, "rb")) {
                        if (!$download_fp = fopen($tmp_path, "wb")) {
                            $this->json_info(1, lang_admin('unable_to_open_temporary_file'));
                            exit;
                        }
                        while (!feof($fp)) {
                            if (!file_exists($tmp_path)) {
                                fclose($download_fp);
                                $this->json_info(2, lang_admin('temporary_file_does_not_exist'));
                                exit;
                            }
                            fwrite($download_fp, fread($fp, 1024 * 8), 1024 * 8);
                            //$_SESSION['tmp_size'] = 1024 * 8 + $_SESSION['tmp_size'];
                        }
                        fclose($download_fp);
                        fclose($fp);
                    } else {
                        $this->json_info(3, lang_admin('cannot_open_remote_file'));
                        exit;
                    }
                } catch (Exception $e) {
                    //@unlink($tmp_path);
                    //exit('发生错误：'.$e->getMessage());
                    $this->json_info(4, $e->getMessage());
                    exit;
                }
                $this->json_info(0, $tmp_path);
                break;
            case 'get-file-size':
                // 这里检测下 tmp_path 是否存在
                //var_dump($tmp_path);
                if (file_exists($tmp_path)) {
                    // 返回 JSON 格式的响应
                    $this->json(array('size' => filesize($tmp_path)));
                }
                //return json(array('size'=>$_SESSION['tmp_size']));
                break;
            case 'exzip':
                $unpath = ROOT.'/license/';
                $archive = new PclZip($tmp_path);
                if (!$archive->extract(PCLZIP_OPT_PATH, $unpath, PCLZIP_OPT_REPLACE_NEWER)) {
                    $this->json_info(1, $archive->errorInfo(true));
                }
                //修改安装状态为已安装
                $this->json_info(0, lang_admin('commercial_authorization').lang_admin('success'));
                break;
            default:
                # code...
                break;
        }
        exit;
    }


    function end() {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
