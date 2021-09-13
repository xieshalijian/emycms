<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class expansion_admin extends admin
{

    function init(){
        if (!front::get('page'))
            front::$get['page'] = 1;
        $this->_pagesize = config::getadmin('manage_pagesize');
    }



    function index_action()
    {
        $this->view->returndata=service::getInstance()->getlogin(false);

        if(front::get('leftname') != ''){
            $menu = admin_menu::allmenu();
            $this->view->data = $menu[front::get('leftname')];
            $this->view->leftname = front::get('leftname');
        };

        //本地的
        $data=apps::getInstance()->getrows("",0);
        foreach ($data as $key=>$vaule){
                if(!$vaule['isbuy']){
                    unset($data[$key]);
                }
        }
        //$this->view->appsdate=$this->pagedata($data,front::$get['page'],$this->_pagesize);
        $this->view->appsdate=$data;
        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($data);
        //主机状态  是否安装
        $this->view->vhoststatu=file_exists(ROOT."/lib/table/vhost.php");
        //主机状态  是否安装
        $this->view->licensestatu=file_exists(ROOT."/lib/table/license.php");
        //模板管理 插件中心 插件订单 是否安装
        $this->view->appsauthoritystatu=file_exists(ROOT."/lib/table/appsauthority.php");
        //教学管理   是否安装
        $this->view->teachingstatu=file_exists(ROOT."/lib/table/teaching.php");

    }

    function wxxcx_action()
    {
    }

    function buyapps_action()
    {
        $this->view->returndata=service::getInstance()->getlogin();
        //获取服务器的插件列表
        if(front::get('querserver')) {
            @set_time_limit(0);
            $url = "https://u.cmseasy.cn/index.php?case=client&act=cmsgetApps";  //服务器获取列表的地址
            $data = service::cmseayurl($url);   //获取服务器的数据
            $data = json_decode($data, true);
            if (!is_array($data))$data=array();
            foreach ($data as $key => $vaule) {

                $appsdata = apps::getInstance()->getrow(" id='" . $vaule['id'] . "'");
                if (!is_array($appsdata)) {    //不存在的时候插入
                    $vaule['new_version']=$vaule['version'];
                    apps::getInstance()->rec_insert($vaule);
                }
                else {
                    if ($appsdata['installed']) {
                        $data[$key]['installed'] = 1;
                    }
                    /* if(front::$get['type']=="mybuyapps"){
                         if(!$appsdata['isbuy']){   //我已经购买的插件
                             unset($data[$key]);
                         }
                     }*/
                  /*  if ($this->view->returndata['static']) {   //登录之后校验已经购买的购买
                        if ($appsdata['isbuy']) {    //已经购买的不显示
                            unset($data[$key]);
                        }
                    }*/
                    if($appsdata['iscorp'] != $vaule['iscorp']){
                        apps::getInstance()->rec_update(array("iscorp"=>$vaule['iscorp'])," id='".$vaule['id']."'");
                    }
                    if($appsdata['tempate_url'] != $vaule['tempate_url']){
                        apps::getInstance()->rec_update(array("tempate_url"=>$vaule['tempate_url'])," id='".$vaule['id']."'");
                    }
                    if($appsdata['vercode'] != $vaule['vercode']){
                        apps::getInstance()->rec_update(array("vercode"=>$vaule['vercode'])," id='".$vaule['id']."'");
                    }
                    if($appsdata['is_vip'] != $vaule['is_vip']){
                        apps::getInstance()->rec_update(array("is_vip"=>$vaule['is_vip'])," id='".$vaule['id']."'");
                    }
                    if(!$appsdata['new_version'] || $appsdata['new_version'] != $vaule['vercode']){
                        apps::getInstance()->rec_update(array("new_version"=>$vaule['version'])," id='".$vaule['id']."'");
                    }
                }
            }

        }else{
            $data=apps::getInstance()->getrows("static=1",0);
        }

        front::$get['type']=isset(front::$get['type'])?front::$get['type']:"";
        if(front::$get['type']=="free"){    //免费   注意：免费版的过滤掉商业版的插件
            foreach ($data as $key=>$val){
                if($val["price"]>0 || $val['iscorp']){
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="corp"){  //商业版
            foreach ($data as $key=>$val){
                if(!$val["iscorp"]){
                    unset($data[$key]);
                }else{
                    if(session::get('ver') == 'corp'){
                        $data[$key]['price']=0;
                    }
                }
            }
            /*else{
                exit(lang_admin('unauthorized_access'));  //不是商业版 无权访问
            }*/
        }
        else if(front::$get['type']=="likemenoy"){  //收费
            foreach ($data as $key=>$val){
                if($val["price"]<=0 || $val["iscorp"]){
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="mybuyapps"){
            foreach ($data as $key=>$val){
                if(!$val["isbuy"]){
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="vip"){
            foreach ($data as $key=>$val){
                if(!$val["is_vip"]){
                    unset($data[$key]);
                }
            }
        }
        $this->view->appsdate=$this->pagedata($data,front::$get['page'],$this->_pagesize);
        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($data);
    }

    function buytemplate_action(){

        $this->view->returndata=service::getInstance()->getlogin();
        //获取服务器的在线模板列表
        if(front::get('querserver')){
            @set_time_limit(0);
            //判断获取间隔  30秒
            if(session::get("querserver")){
                $thisdata=date('Y-m-d H:i:s', time());
                $oldadddate=date('Y-m-d H:i:s', session::get("querserver"));
                $newdata=floor((strtotime($thisdata)-strtotime($oldadddate))%86400);
                if($newdata<30){
                    echo "<script>alert('".lang_admin('querserver_30_time')."');";//请隔30秒下单
                    echo "gotoinurl('".url("expansion/buytemplate",true)."')</script>";
                    exit;
                }
            }
            $url="https://u.cmseasy.cn/index.php?case=client&act=cmsgetTemplate";  //服务器获取列表的地址
            $data=service::cmseayurl($url);   //获取服务器的数据
            $data=json_decode($data, true);
            session::set("querserver",time());
        }else{
            $data=cutbuytemplate::getInstance()->getrows("static=1",0," serviceid desc ");
        }

        //本地的
        if(is_array($data) && front::get('querserver')){
             $colslist=cutbuytemplate::getInstance()->getcolslist();
             foreach ($data as $key=>$vaule){
                $appsdata=cutbuytemplate::getInstance()->getrow(" code='".$vaule['code']."'");
                if(!is_array($appsdata)){    //不存在的时候插入
                    $vaule['serviceid']=$vaule['id'];
                    unset($vaule['id']);
                    cutbuytemplate::getInstance()->rec_insert($vaule,$colslist);
                }else{
                    //判断是否购买是否相同 不相同修改本地的
                    if($appsdata['isbuy'] != $vaule['isbuy']){
                        cutbuytemplate::getInstance()->rec_update(array("isbuy"=>$vaule['isbuy'])," code='".$vaule['code']."'");
                    }
                    if($appsdata['img'] != $vaule['img']){
                        cutbuytemplate::getInstance()->rec_update(array("img"=>$vaule['img'])," code='".$vaule['code']."'");
                    }
                    if($appsdata['installed']){
                        $data[$key]['installed']=1;
                    }
                    if($appsdata['price'] != $vaule['price']){
                        cutbuytemplate::getInstance()->rec_update(array("price"=>$vaule['price'])," code='".$vaule['code']."'");
                    }
                    if($appsdata['iscorp'] != $vaule['iscorp']){
                        cutbuytemplate::getInstance()->rec_update(array("iscorp"=>$vaule['iscorp'])," code='".$vaule['code']."'");
                    }
                    if(isset($vaule['vercode']) && isset($appsdata['vercode']) && $appsdata['vercode'] != $vaule['vercode']){
                        cutbuytemplate::getInstance()->rec_update(array("vercode"=>$vaule['vercode'])," code='".$vaule['code']."'");
                    }
                }

                //搜索条件
                if(front::post('submit') && front::post('search_coded')){
                    if(strpos($vaule['code'],front::post('search_coded')) === false){
                        unset($data[$key]);
                    }
                }
            }

        }
        else  if(front::post('submit') && front::post('search_coded')){ //搜索条件
            foreach ($data as $key=>$vaule){
                if(strpos($vaule['code'],front::post('search_coded')) === false){
                    unset($data[$key]);
                }
            }
        }
        //当第一次打开的时候   默认收费模板
        if (!isset(front::$get['type']) || front::$get['type']==""){
            front::$get['type']="likemenoy";
        }
        if(front::$get['type']=="free" && !front::post('submit')){    //免费
            foreach ($data as $key=>$val){
                if($val["price"]>0){
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="corp" && !front::post('submit') ){  //商业版

                foreach ($data as $key=>$val){
                    if(!$val["iscorp"]){
                        unset($data[$key]);
                    }else{
                        if(session::get('ver') == 'corp'){
                            $data[$key]['price']=0;
                        }
                    }
                }
           /*else{
                exit(lang_admin('unauthorized_access'));  //不是商业版 无权访问
            }*/
        }
        else if(front::$get['type']=="likemenoy" && !front::post('submit')){  //收费
            foreach ($data as $key=>$val){
                if($val["price"]<=0 ){ //|| ($val["iscorp"] && session::get('ver') == 'corp')
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="mybuyapps"){
            foreach ($data as $key=>$val){
                if(!$val["isbuy"]){
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="visual"){
            foreach ($data as $key=>$val){
                if($val["isview"]!=1){
                    unset($data[$key]);
                }
            }
        }

        $this->view->appsdate=$this->pagedata($data,front::$get['page'],$this->_pagesize);

        //下载图片
        foreach ($this->view->appsdate as $key=>$val){
            $newimg = basename($val['img']);
            if(!file_exists(ROOT.'/images/template/'.$newimg))
                self::getImage($val['img'],ROOT.'/images/template',$newimg);  //下载到本地

            $base_url = $this->base_url;
            //$data[$key]['img']=$base_url.'/images/template/'.$newimg;//str_replace('\\','/',ROOT).
            cutbuytemplate::getInstance()->rec_update(array("img"=>$base_url.'/images/template/'.$newimg),"code='".$val['code']."'");
        }

        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($data);

    }

    function buymodules_action(){
        $this->view->returndata=service::getInstance()->getlogin();
        front::$get['type']=isset(front::$get['type'])?front::$get['type']:"";

        //获取服务器的在线模板列表
        if(front::get('querserver')){
            @set_time_limit(0);
            //判断获取间隔  30秒
            if(session::get("querserver")){
                $thisdata=date('Y-m-d H:i:s', time());
                $oldadddate=date('Y-m-d H:i:s', session::get("querserver"));
                $newdata=floor((strtotime($thisdata)-strtotime($oldadddate))%86400);
                if($newdata<30){
                    echo "<script>alert('".lang_admin('querserver_30_time')."');";//请隔30秒下单
                    echo "gotoinurl('".url("expansion/buymodules",true)."')</script>";
                    exit;
                }
            }
            $url="https://u.cmseasy.cn/index.php?case=client&act=cmsgetModules";  //服务器获取列表的地址
            $data=service::cmseayurl($url);   //获取服务器的数据
            $data=json_decode($data, true);
            //下载图片
           /* foreach ($data as $key=>$val){
                $newimg = basename($val['img']);
                if(!file_exists(ROOT.'/images/template/'.$newimg))
                    $error=self::getImage($val['img'],ROOT.'/images/template',$newimg);  //下载到本地
                $base_url = $this->base_url;
                $data[$key]['img']=$base_url.'/images/template/'.$newimg;//str_replace('\\','/',ROOT).
            }*/
            session::set("querserver",time());
        }else{
            $data=cutbuymodules::getInstance()->getrows("static=1",0," serviceid desc ");
        }

        //本地的
        if(is_array($data) && front::get('querserver')){
            $colslist=cutbuymodules::getInstance()->getcolslist();
            foreach ($data as $key=>$vaule){
                $appsdata=cutbuymodules::getInstance()->getrow(" code='".$vaule['code']."'");
                if(!is_array($appsdata)){    //不存在的时候插入
                    $vaule['serviceid']=$vaule['id'];
                    unset($vaule['id']);
                    cutbuymodules::getInstance()->rec_insert($vaule,$colslist);
                }else{
                    //判断是否购买是否相同 不相同修改本地的
                    if($appsdata['isbuy'] != $vaule['isbuy']){
                        cutbuymodules::getInstance()->rec_update(array("isbuy"=>$vaule['isbuy'])," code='".$vaule['code']."'");
                    }
                    if($appsdata['price'] != $vaule['price']){
                        cutbuymodules::getInstance()->rec_update(array("price"=>$vaule['price'])," code='".$vaule['code']."'");
                    }
                    if($appsdata['img'] != $vaule['img']){
                        cutbuymodules::getInstance()->rec_update(array("img"=>$vaule['img'])," code='".$vaule['code']."'");
                    }
                    if($appsdata['iscorp'] != $vaule['iscorp']){
                        cutbuymodules::getInstance()->rec_update(array("iscorp"=>$vaule['iscorp'])," code='".$vaule['code']."'");
                    }
                    if($appsdata['installed']){
                        $data[$key]['installed']=1;
                    }
                    if(isset( $appsdata['vercode']) && isset($vaule['vercode']) && $appsdata['vercode'] != $vaule['vercode']){
                        cutbuymodules::getInstance()->rec_update(array("vercode"=>$vaule['vercode'])," code='".$vaule['code']."'");
                    }

                }

                //搜索条件
                if(front::post('submit') && front::post('search_coded')){
                    if(strpos($vaule['codename'],front::post('search_coded')) === false){
                        unset($data[$key]);
                    }
                }
            }
        }
        else  if(front::post('submit') && front::post('search_coded')){ //搜索条件
            foreach ($data as $key=>$vaule){
                if(strpos($vaule['codename'],front::post('search_coded')) === false){
                    unset($data[$key]);
                }
            }
        }

        if(front::$get['type']=="free" && !front::post('submit')){    //免费
            foreach ($data as $key=>$val){
                if($val["price"]>0){
                    unset($data[$key]);
                }
            }
        }
        else if(isset(front::$get['type']) && front::$get['type']=="corp" && !front::post('submit') ){  //商业版
            if(session::get('ver') == 'corp'){
                foreach ($data as $key=>$val){
                    if(!$val["iscorp"]){
                        unset($data[$key]);
                    }else{
                        $data[$key]['price']=0;
                    }
                }
            }/*else{
                exit(lang_admin('unauthorized_access'));  //不是商业版 无权访问
            }*/
        }
        else if(front::$get['type']=="likemenoy" && !front::post('submit')){  //收费
            foreach ($data as $key=>$val){
                if($val["price"]<=0 || ($val["iscorp"] && session::get('ver') == 'corp') ){
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="mybuyapps"){
            foreach ($data as $key=>$val){
                if(!$val["isbuy"]){
                    unset($data[$key]);
                }
            }
        }

        //组件分类
        if (isset(front::$get['modulestype']) && front::$get['modulestype']!="" && front::$get['modulestype']!="all"){
            foreach ($data as $key=>$val){
                if($val["type"]!=front::$get['modulestype']){
                    unset($data[$key]);
                }
            }
        }



        $this->view->appsdate=$this->pagedata($data,front::$get['page'],$this->_pagesize);
        //下载图片
         foreach ($this->view->appsdate as $key=>$val){
             $newimg = basename($val['img']);
             if(!file_exists(ROOT.'/images/template/'.$newimg))
                 self::getImage($val['img'],ROOT.'/images/template',$newimg);  //下载到本地
             $base_url = $this->base_url;
             //$data[$key]['img']=$base_url.'/images/template/'.$newimg;//str_replace('\\','/',ROOT).
             cutbuymodules::getInstance()->rec_update(array("img"=>$base_url.'/images/template/'.$newimg),"code='".$val['code']."'");
         }
        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($data);

    }

    //删除缓存在线模板
    function  deletetemplate_action(){
        if (front::get("code")){
            $cutbuytemplate=cutbuytemplate::getInstance()->getrow("code='".front::get("code")."'");
            if ($cutbuytemplate['img'] && file_exists(ROOT.$cutbuytemplate['img']))
                unlink(ROOT.$cutbuytemplate['img']);
            cutbuytemplate::getInstance()->rec_delete("code='".front::get("code")."'");
            unset(front::$get['code']);

            unlink(ROOT.'/data/template_all.php');
        }
        front::redirect(url('expansion/buytemplate', true));
    }
    //删除缓存全部在线模板
    function  deletetemplateall_action(){
        $cutbuytemplate=cutbuytemplate::getInstance()->getrows(null,0);
        if (is_array($cutbuytemplate))
            foreach ($cutbuytemplate as $key=>$val){
                if ($val['img'] && file_exists(ROOT.$val['img']))
                    unlink(ROOT.$val['img']);
                cutbuytemplate::getInstance()->rec_delete("code='".$val['code']."'");
            }
        front::redirect(url('expansion/buytemplate', true));
    }
    //删除缓存全部组件
    function  deletemodulesall_action(){
        $cutbuytemplate=cutbuymodules::getInstance()->getrows(null,0);
        if (is_array($cutbuytemplate))
            foreach ($cutbuytemplate as $key=>$val){
                if ($val['img']  && file_exists(ROOT.$val['img']))
                    unlink(ROOT.$val['img']);
                cutbuymodules::getInstance()->rec_delete("code='".$val['code']."'");
            }
        front::redirect(url('expansion/buymodules', true));
    }
    //删除缓存全部扩展
    function  deleappsall_action(){
        $cutapps=apps::getInstance()->getrows(null,0);
        if (is_array($cutapps))
            foreach ($cutapps as $key=>$val){
                if ($val['installed']) continue;
                apps::getInstance()->rec_delete("id='".$val['id']."'");
            }
        front::redirect(url('expansion/buyapps', true));
    }
    /*
      *功能：php完美实现下载远程图片保存到本地
      *参数：文件url,保存文件目录,保存文件名称，使用的下载方式
      *当保存文件名称为空时则使用远程文件原来的名称
    */
    function getImage($url,$save_dir='',$filename='',$type=1){
        $url = str_replace("https://", "http://", $url);
        if(trim($url)==''){
            return array('file_name'=>'','save_path'=>'','error'=>1);
        }
        if(trim($save_dir)==''){
            $save_dir='./';
        }
        if(trim($filename)==''){//保存文件名
            $ext=strrchr($url,'.');
            if($ext!='.gif'&&$ext!='.jpg'){
                return array('file_name'=>'','save_path'=>'','error'=>3);
            }
            $filename=time().$ext;
        }
        if(0!==strrpos($save_dir,'/')){
            $save_dir.='/';
        }
        //创建保存目录
        if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
            return array('file_name'=>'','save_path'=>'','error'=>5);
        }
        //获取远程文件所采用的方法
        if($type){
            $img=self::http_get_data($url);
        }else{
            ob_start();
            readfile($url);
            $img=ob_get_contents();
            ob_end_clean();
        }
        //$size=strlen($img);
        //文件大小
        $fp2=@fopen($save_dir.$filename,'a');
        fwrite($fp2,$img);
        fclose($fp2);
        unset($img,$url);
        return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
    }
    //curl实现图片下载方式
    function http_get_data($url)
    {
        $url = str_replace("https://", "http://", $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);//设置超时时间
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.119 Safari/537.36');
        $ob_stream = curl_exec($ch);
        /*if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }*/
        curl_close($ch);
        return  $ob_stream;

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

    //刷新插件列表  重新从服务端获取
   function getcmeasyAppps_action(){
           $url="https://u.cmseasy.cn/index.php?case=client&act=cmsgetApps";  //服务器获取列表的地址
           $data=service::cmseayurl($url);   //获取服务器的数据
           $data=json_decode($data, true);
           if(count($data)>0){
               foreach ($data as $key=>$vaule){

                   $appsdata=apps::getInstance()->getrow(" id='".$vaule['id']."'");
                   if(!is_array($appsdata)){    //不存在的时候插入
                       apps::getInstance()->rec_insert($vaule);
                   }
               }
           }
           front::redirect(url::modify('act/index', true));
   }


   //下载
    function down_action()
    {
        set_time_limit(0);
        session_write_close();
        $action = front::$get['action'];
        $f = isset(front::$post['f']) && front::$post['f'] ? front::$post['f'] : front::$get['f'];
        $filename = $f . '.zip';
        //校验是否购买
        $applogin =service::getInstance()->get_service_users();
        $data=service::getInstance()->cms_qkdown($applogin["username"],$f,3);
        if(!$data["static"]){
            $this->json_info(1, $data['message']);
            exit;
        }

        $download_cache = ROOT . '/cache/downloads/';
        $remote_url=$data['zipurl'];
        $remote_url= str_replace("https://","http://",$remote_url);
        $file_size = service::get_remote_file_size($remote_url);
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
                    if ($fp = @fopen($remote_url, "rb")) {
                        if (!$download_fp = @fopen($tmp_path, "wb")) {
                            $this->json_info(0, lang_admin('unable_to_open_temporary_file'));
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
                $unpath = ROOT.'/data/buymodules/'.$data['type'];
                $archive = new PclZip($tmp_path);
                if (!@$archive->extract(PCLZIP_OPT_PATH, $unpath, PCLZIP_OPT_REPLACE_NEWER)) {
                    //$this->json_info(1, $archive->errorInfo(true));
                    $this->json_info(1, lang_admin("file_error"));
                    exit;
                }
                /*if ($isSql == 'true' && file_exists(ROOT . '/data/template/' . $f . '/install.sql')) {
                    $rs = tdatabase::getInstance()->restoreTables(ROOT . '/data/template/' . $f . '/install.sql');
                    if ($rs) {
                        $this->json_info(5, $rs);
                        exit;
                    }
                }*/
                //修改安装状态为已安装
                cutbuymodules::getInstance()->rec_update("installed=1","static=1 and code='".$f."'");
                $this->json_info(0, lang_admin('assembly').lang_admin('install').lang_admin('success'));
                break;
            default:
                # code...
                break;
        }
        exit;
    }
    function json($args)
    {
        echo json_encode($args);
    }
    function json_info($code, $msg)
    {
        echo json_encode(array('code' => $code, 'msg' => $msg));
    }

    function end()
    {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
