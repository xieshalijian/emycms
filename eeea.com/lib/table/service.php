<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class service
{


    public static $domain="https://u.cmseasy.cn";
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new service();
            self::$me = $class;
        }
        return self::$me;
    }

    //代理服务器访问
    public static function cmseayurl($url,$message=true){
        $url= str_replace("https://","http://",$url);
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
        curl_setopt($ch, CURLOPT_PROXY, "61.160.247.49"); //代理服务器地址
        curl_setopt($ch, CURLOPT_PROXYPORT, 80); //代理服务器端口
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    //远程下载压缩包
    function curl_download($url, $dir) {
        $ch = curl_init($url);
        $fp = fopen($dir, "wb");
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $res=curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        return $res;
    }

    //服务器访问
    function curl_get($url){

        $header = array(
            'Accept: application/json',
        );
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 超时设置,以秒为单位
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);

        // 超时设置，以毫秒为单位
        // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

        // 设置请求头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //执行命令
        $data = curl_exec($curl);

        // 显示错误信息
        if (curl_error($curl)) {
            return "";
        } else {
            curl_close($curl);
            return $data;

        }
    }

    //获取文件字节
    public static function get_remote_file_size($url){
        $url= str_replace("https://","http://",$url);
        ob_start();
        $ch = curl_init($url); // make sure we get the header
        curl_setopt($ch, CURLOPT_HEADER, 1); // make it a http HEAD request
        curl_setopt($ch, CURLOPT_NOBODY, 1); // if auth is needed, do it here
        $okay = curl_exec($ch);
        curl_close($ch); // get the output buffer
        $head = ob_get_contents(); // clean the output buffer and return to previous // buffer settings
        ob_end_clean();  // gets you the numeric value from the Content-Length // field in the http header
        $regex = '/Content-Length:\s([0-9].+?)\s/';
        $count = preg_match($regex, $head, $matches);  // if there was a Content-Length field, its value // will now be in $matches[1]
        if (isset($matches[1]))
        {
            $size = $matches[1];
        }
        else
        {
            $size = 0;
        }
        return $size;
    }

    //检测服务器是否能访问  返回200是可以访问
    public static function httpcode($url){

        $ch = curl_init();

        $timeout = 3;

        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,0);

        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch, CURLOPT_HEADER, 1);

        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        curl_setopt($ch,CURLOPT_URL,$url);

        curl_exec($ch);

        $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $httpcode;

    }

    /***
     * 判断网络是否连接
     * */
    public static function varify_url($url){
        if(!self::is_ssl()){
            $url= str_replace("https://","http://",$url);
        }
        $check = @fopen($url,"r");
         if($check){
            $status = true;
        }else{
            $status = false;
        }
        return $status;
    }

    //校验路径接口
    public static function dkUrl($url){
        if (service::is_ssl()){
            if(stristr($url,'http://')){
                $url= str_replace("http://","https://",$url);
            }
            if(!stristr($url,'https://')){
                $url= "https://".$url;
            }
        }else{
            if(stristr($url,'https://')){
                $url= str_replace("https://","http://",$url);
            }
            if(!stristr($url,'http://')){
                $url= "http://".$url;
            }
        }

        return $url;
    }

    /***
    * 判断是否SSL协议
    * @return boolean
    */
    public static function is_ssl()
    {
        if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
            return true;
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            return true;
        }
        return false;
    }

    /***
     * 登陆服务端用户
     * @return boolean  $message是否提示错误
     */
    function getlogin($message=true){
        $returndata=array();
        if (session::get("user_buy_all")==""){
            $app_login =$this->get_service_users();
            if(!empty($app_login) && is_array($app_login)){
                $url=self::$domain."/index.php?case=client&act=cmseaylogin&username=".$app_login["username"]."&passwrod=".$app_login['passwrod']."&vercode="._NEWVERCODE."&ip=".$_SERVER['SERVER_NAME'];  //服务器获取列表的地址
                $url.="&licenstype=1";  //cms的授权
                if ( session::get('ver') == 'corp'){
                    $url.="&app_ver=1";
                }else{
                    $url.="&app_ver=0";
                }
                $data=service::cmseayurl($url,$message);   //获取服务器的数据
                $data=json_decode($data, true);
                if(isset($data["static"]) && $data["static"]) {
                    //写到缓存
                    $returndata['static'] = 1;
                    $returndata["message"] = $data['message'];  //登陆成功
                    $returndata["userdata"] = $data['userdata'];
                    $returndata["appsdata"] = $data['appsdata'];
                    $returndata["modulesdata"] = $data['modulesdata'];
                    $returndata["modeldata"] = $data['modeldata'];
                    $returndata["wxappyear"] = $data['wxappyear'];  //开通年费
                    $returndata["licensedata"]=$data['licensedata'];
                    $returndata["copyrightdata"]=$data['copyrightdata'];
                    session::set("user_buy_all", $returndata);

                    //修改本地缓存购买状态
                    foreach($data['appsdata'] as $key=>$val){
                        if($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                            || $_SERVER['SERVER_NAME']=='www.'.$val['buyip']){   //已经购买的 并且域名一直  更新本地缓存
                            apps::getInstance()->rec_update("isbuy=1"," id='".$val['buyid']."'");
                        }
                    }
                    //修改本地缓存购买状态
                    foreach($data['modeldata'] as $key=>$val){
                        if($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                            || $_SERVER['SERVER_NAME']=='www.'.$val['buyip']) {   //已经购买的 并且域名一直  更新本地缓存
                            cutbuytemplate::getInstance()->rec_update("isbuy=1", " code='" . $val['buyid'] . "'");
                        }
                    }
                    //修改本地缓存购买状态
                    foreach($data['modulesdata'] as $key=>$val){
                        if($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                            || $_SERVER['SERVER_NAME']=='www.'.$val['buyip']) {   //已经购买的 并且域名一直  更新本地缓存
                            cutbuymodules::getInstance()->rec_update("isbuy=1", " code='" . $val['buyid'] . "'");
                        }
                    }
                }
            }
            if(!isset($returndata['static']) || $returndata['static']!=1 || $returndata==""){
                $returndata['static']=0;
                $returndata["message"]=lang('login_failure');  //登陆失败
                $returndata["modeldata"]="";
                $returndata["userdata"]="";
                $returndata["appsdata"]=array();
                $returndata["modulesdata"]=array();
                $returndata["modeldata"]=array();
                $returndata["wxappyear"]=array();
                $returndata["licensedata"]=array();
                $returndata["copyrightdata"]=array();
            }
            session::set("user_buy_all", $returndata);
        }else{
            $returndata=session::get("user_buy_all");
        }
        return $returndata;

    }

    //保存组件 服务端账号密码
    public function save_service_users($app_login)
    {
        if (empty($app_login))
            return;
        $data='<?php return ' . var_export($app_login, true) . ';';
        $service_users_path=ROOT."/config/service_users.php";
        //判断文件是否存在！不存在则创建
        if (!file_exists( $service_users_path )) {@fopen($service_users_path, "w");}

        $f = fopen($service_users_path,'w');
        fwrite($f,$data);
        fclose($f);
    }
    //保存组件 服务端账号密码
    public function get_service_users()
    {
        $service_users_path=ROOT."/config/service_users.php";
        //判断文件是否存在！不存在则创建
        if (!file_exists( $service_users_path )) {@fopen($service_users_path, "w");}
        $service_users = include $service_users_path;
        return $service_users;
    }

    //获取页面所有链接
    public static  function  getherf($html){
        if ($html=="")return $html;
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $hrefs = $xpath->evaluate('/html/body//a');
        $urldata=array();
        for ($i = 0; $i < $hrefs->length; $i++) {
            $href = $hrefs->item($i);
            $url = $href->getAttribute('href');

            // 保留以http开头的链接
            if(stristr($url,'/index.php?case=archive&act=show') || stristr($url,'/index.php?case=archive&act=list')
                || stristr($url,'/index.php?case=special&act=show') || stristr($url,'/index.php?case=type&act=list')
                || stristr($url,'/index.php?case=guestbook&act=index')|| stristr($url,'/index.php?case=comment&act=list')
                || stristr($url,'/index.php?case=archive&act=sitemap') || stristr($url,'/index.php?case=announ&act=show') )
                $urldata[]= $url;
        }
        $urldata=array_unique($urldata); //去掉重复数据
        //开始批量替换
        foreach ($urldata as $val){
            if(stristr($val,config::get('site_url'))) continue;
            $newval=config::get('site_url').substr($val,1);
            $newurl=$newval.'&admin_dir='.config::getadmin('admin_dir',true).'&site=default';
            $html=str_replace('"'.$val.'"','"'.$newurl.'"',$html);
        }
        //解析首页
        $html=str_replace('"/"','"'.url('template/visual',true).'"',$html);
        return $html;
    }

    function json_info($code, $msg)
    {
        echo json_encode(array('code' => $code, 'msg' => $msg));
    }

    //更新最新表
    static  public   function checktable(){
        //远程下载 newtable.php
        $remote_url="https://down.cmseasy.cn/upgradetable/"._NEWVERCODE."/newtable.zip";
        if(!service::is_ssl()) {
            $remote_url = str_replace("https://", "http://", $remote_url);
        }
        else{
            $remote_url = str_replace("http://", "https://", $remote_url);
        }
        $path=ROOT."/data/newtable.zip";
        $newtablepath=ROOT."/data/newtable.php";

        touch($path);
        if ($fp = @fopen($remote_url, "rb")) {
            if (!$download_fp = fopen($path, "wb")) {
                service::getInstance()->json_info(1, lang_admin('unable_to_open_temporary_file'));
                exit;
            }
            while (!feof($fp)) {
                if (!file_exists($path)) {
                    fclose($download_fp);
                    service::getInstance()->json_info(2, lang_admin('temporary_file_does_not_exist'));
                    exit;
                }
                fwrite($download_fp, fread($fp, 1024 * 8), 1024 * 8);
            }
            fclose($download_fp);
            fclose($fp);
        }
        $archive = new PclZip($path);
        if (!@$archive->extract(PCLZIP_OPT_PATH, ROOT."/data", PCLZIP_OPT_REPLACE_NEWER)) {
            service::getInstance()->json_info(1, $archive->errorInfo(true));
        }
        $nerrCode="";
        $i=0;
        if (file_exists($newtablepath)){
            $newtabledata = include $newtablepath;
            if (is_array($newtabledata))
            foreach ($newtabledata as $key=>$val){
                if(!file_exists(ROOT."/lib/table/".$key.".php")) continue;
                $table=new  $key;
                $oldtabledata=$table->getFields();
                $oldtable=array();
                if (is_array($oldtabledata))
                    foreach ($oldtabledata as $oldkey=>$oldval){
                        $oldtable[]=$oldkey;
                    }
                if (is_array($val)){
                    //不存在的话 则增加字段
                    foreach ($val as $newkey=>$newval){
                        if (!in_array($newkey,$oldtable)){
                            $database=config::getdatabase('database');
                            set_time_limit(0);
                            $newval = str_replace("cmseasy_", $database['prefix'] , $newval);
                            if ($table->query($newval)){
                                $i++;
                            }
                            else
                                $nerrCode .= "执行： <font color='blue'>$newval</font> 出错!</font><br>";
                        }
                    }
                }
            }
        }

        @unlink(ROOT.'/data/newtable.zip');
        @unlink(ROOT.'/data/newtable.php');
        return $nerrCode;
    }

    //模板安全检验使用---获取官网模板+模板id  判断 $template_cod是否商业版 免费版 还是收费版
    public function get_template_check($template_code,$key_t="Cmseasy2099"){
        if (_NEWVERCODE<7700){  //老版本不检验
            return array("statue"=>1);
        }
        //模板的管控文件
        $template_path=TEMPLATE.'/'.$template_code.'/control.php';  //管控文件地址
        if (!file_exists( $template_path )) {
            $return_data=array("statue"=>0,"message"=>"缺少control.php管控文件！");
            return $return_data;
        }
        $template_data = include $template_path;
        if (session::get($template_path)){
            $template_data=session::get($template_path); //解密
        }else{
            $template_data=self::passport_decrypt($template_data,$key_t);//解密
            session::set($template_path,$template_data);
        }


        $template_all_path=TEMPLATE."/".$template_code."/template_all.php";
        //判断文件是否存在！不存在则创建
        if (!file_exists( $template_all_path )) {
            $url=self::$domain."/index.php?case=client&act=cmsgetTemplate&template_code=".$template_data['template_name']; //服务器获取列表的地址
            //$url.="&vercode="._NEWVERCODE."&ip=".$_SERVER['SERVER_NAME'];
            $template_service_array=service::cmseayurl($url,true);   //获取服务器的数据
            $template_service_array=json_decode($template_service_array, true);
            $template_service_array=self::passport_encrypt($template_service_array,$key_t);//加密
            $data='<?php return ' . var_export($template_service_array, true) . ';';
            $f = fopen($template_all_path,'w');
            fwrite($f,$data);
            fclose($f);
        }
        $template_all_data = include $template_all_path;
        if (session::get("data-template_all-".$template_code)){
            $template_all_data=session::get("data-template_all-".$template_code); //解密
        }else{
            $template_all_data=self::passport_decrypt($template_all_data,$key_t); //解密
            session::set("data-template_all-".$template_code,$template_all_data);
        }


        //重新生成最新格式
        if (is_array($template_all_data) && $template_all_data['code']=="") {
                foreach ($template_all_data as $template_val){
                    if ($template_val['code'] == $template_data['template_name']) {
                        session::set("data-template_all-".$template_code,$template_val);
                        $template_new_data=self::passport_encrypt($template_val,$key_t);//加密
                        $data='<?php return ' . var_export($template_new_data, true) . ';';
                        $file = fopen($template_all_path,'w');
                        fwrite($file,$data);
                        fclose($file);
                    }
                }
        }
        $return_data=array();
        if ($template_data['template_name']!=$template_code && $template_data['template_remarks']!=$template_code){
            $return_data=array("statue"=>0,"message"=> "请勿随意修改管控文件，会导致网站崩溃！");
        }
        if (is_array($template_all_data)) {
                if ($template_all_data['code'] == $template_data['template_name']) {  //判断模板是否存在
                    $template_vercode = $template_all_data['vercode'] ? $template_all_data['vercode'] : 0;
                    if ($template_vercode < 7700) {  //旧版本模板无需检验
                        return array("statue"=>1);
                    }
                    else if ($template_all_data['isdefault']) {  //默认模板直接跳过
                        return array("statue"=>1);
                    }
                    else{
                        if ($template_all_data['price'] == 0) {  //免费版直接过
                            return array("statue"=>1);
                        }
                        elseif ($template_all_data['iscorp'] && session::get('ver') == 'corp') {  //判断当前客户端是否授权 授权的版本直接过
                            return array("statue"=>1);
                        }elseif ($template_all_data['price'] > 0) { //检验域名-u用户id-密钥
                            $returndata = service::getInstance()->getlogin();
                            $user_id=((int)($template_data['Unique_code'])/2)-$template_all_data['id']-$returndata['userdata']['key_t'];
                            foreach ($returndata["modeldata"] as $val) {
                                if (strtolower($val['buyid']) == strtolower($template_data['code'])
                                    && ($template_data['domain'] == $val['buyip'] || 'www.' . $template_data['domain'] == $val['buyip']
                                        || $template_data['domain'] == 'www.' . $val['buyip']) && $user_id==$returndata['userdata']['userid']) {
                                    return array("statue"=>1);
                                }
                            }
                        }
                    }
                    $return_data=array("statue"=>0,"message"=> $template_data['template_remarks']."模板未购买请购买后使用！");
                }
                else{
                    $return_data=array("statue"=>0,"message"=> $template_data['template_remarks']."模板在官网列表不存在，请勿非法操作！");
                }
        }else{
            $return_data=array("statue"=>0,"message"=> $template_data['template_remarks']."获取官网模板列表失败,请联系管理员！");
        }
        return $return_data;
    }

    //组件绑定检验
    public function get_modules_check($template_code,$template_name,$key_t="Cmseasy2099"){
        if (_NEWVERCODE<7700){  //老版本不检验
            return true;
        }
        //模板的管控文件
        $template_path=TEMPLATE.'/'.$template_name.'/control.php';  //管控文件地址
        if (!file_exists( $template_path )) {
            //$return_data=array("statue"=>0,"message"=>"缺少control.php管控文件！");
            return false;
        }
        if (session::get($template_path)){
            $template_data=session::get($template_path); //解密
        }else{
            $template_data = include $template_path;
            $template_data=self::passport_decrypt($template_data,$key_t);//解密
            session::set($template_path,$template_data);
        }

        if ($template_data['template_name']!=$template_name && $template_data['template_remarks']!=$template_name){
            //$return_data=array("statue"=>0,"message"=> "请勿随意修改管控文件，会导致网站崩溃！");
            return false;
        }
        if ($template_data['template_name']!=$template_code && $template_data['template_remarks']!=$template_code){
            //$return_data=array("statue"=>0,"message"=> "当前组件不能在当前模板内使用！");
            return false;
        }
        return true;
    }

    //生成管控文件  $f模板名称
    function creadt_control($f,$key,$userid,$template_id,$key_t="Cmseasy2099"){
        $path=TEMPLATE.'/'.$f.'/control.php';  //管控文件地址
        //判断文件是否存在！不存在则创建
        if (!file_exists($path)){
            if (!file_exists( $path )) {@fopen($path, "w");}
        }
        $control_array=array();//配置  关键
        $control_array["template_name"]=$f;   //唯一模板名
        $control_array["template_remarks"]=$f; //备注模板名 可改名
        $Unique_code=$userid+$template_id+$key;//唯一码（用户id+模板id+密钥数字*2）
        $control_array["Unique_code"]=(int)($Unique_code)*2;
        $domain=$_SERVER['SERVER_NAME'];
        $domain=str_replace("https://","",$domain);
        $domain=str_replace("http://","",$domain);
        $control_array["domain"]=$domain;

        $control_array=self::passport_encrypt($control_array,$key_t);

        $data='<?php return ' . var_export($control_array, true) . ';';
        $file = fopen($path,'w');
        fwrite($file,$data);
        fclose($file);

        $template_all_path=TEMPLATE.'/'.$f.'/template_all.php';  //管控文件地址
        $url=self::$domain."/index.php?case=client&act=cmsgetTemplate&template_code=".$f; //服务器获取列表的地址
        //$url.="&vercode="._NEWVERCODE."&ip=".$_SERVER['SERVER_NAME'];
        $template_service_array=service::cmseayurl($url,true);   //获取服务器的数据
        $template_service_array=json_decode($template_service_array, true);
        $template_service_array=self::passport_encrypt($template_service_array,$key_t);//加密
        $data='<?php return ' . var_export($template_service_array, true) . ';';
        $file = fopen($template_all_path,'w');
        fwrite($file,$data);
        fclose($file);

    }

    //修改管控文件  $new_templatename模板名称
    function update_control($creadt_path,$new_templatename){
        if (file_exists($creadt_path)){
            $template_data = include $creadt_path;
            $template_data=service::passport_decrypt($template_data);//解密
            if (is_array($template_data)) {
                $template_data['template_remarks']=$new_templatename;

                $template_data=service::passport_encrypt($template_data);
                $data='<?php return ' . var_export($template_data, true) . ';';
                $f = fopen($creadt_path,'w');
                fwrite($f,$data);
                fclose($f);
            }
        }
    }


    /***
    *功能：对数组进行加密处理
    *参数一：需要加密的内容
    *参数二：密钥
    */
    function passport_encrypt($cookie_array,$key_t="Cmseasy2099"){
        $txt = serialize($cookie_array);
        srand();//生成随机数
        $encrypt_key = md5(rand(0,10000));//从0到10000取一个随机数
        $ctr = 0;
        $tmp = '';
        for($i = 0;$i < strlen($txt);$i++){
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr]);
            $ctr++;
        }
        return base64_encode(self::passport_key($tmp,$key_t));
    }

    /***
    *功能：对数组进行解密处理
    *参数一：需要解密的密文
    *参数二：密钥
    */
    static function passport_decrypt($txt,$key_t="Cmseasy2099"){
        $txt = self::passport_key(base64_decode($txt), $key_t);
        $tmp = '';
        for($i = 0;$i < strlen($txt); $i++) {
            $md5 = $txt[$i];
            $tmp .= $txt[++$i] ^ $md5;
        }
        $tmp_t = unserialize($tmp);
        return $tmp_t;
    }

    static function passport_key($txt,$encrypt_key){
        $encrypt_key = md5($encrypt_key);
        $ctr = 0;
        $tmp = '';
        for($i = 0; $i < strlen($txt); $i++) {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $txt[$i] ^ $encrypt_key[$ctr];
            $ctr++;
        }
        return $tmp;
    }

    //加载购买组件
    function autofrontbuytempdir($dirname,$returndata=array(),$page=0)
    {
        $page_size=1;   //每页数量
        $fileurl=ROOT.'/data/'.$dirname;
        if(is_dir($fileurl)){
            $list = front::buyscan($fileurl);
            if ($page==0){
                echo count($list);
                exit;
            }
            else{
                $list=array_slice($list, $page-1, $page_size);
            }
            sort($list);
            if (is_array($list) && !empty($list)) {
                foreach ($list as $t) {
                    if(strpos($t,'.') !== false ){
                        /*  echo template($dirname . '/' . $t);*/
                        $path=ROOT . '/cache/'.lang::getisadmin().'/template/'.$dirname;
                        $cacheFile=$path.'/#'.$t;
                        $fileurl_path=$fileurl.'/'.$t;
                        if(file_exists($cacheFile)){
                            $filemtime_cache=filemtime($cacheFile);
                        }else{
                            $filemtime_cache=0;
                        }
                        if (filemtime($fileurl_path)>$filemtime_cache){
                            $content=file_get_contents($fileurl_path);
                            $content=front::$view->compile($content);
                            if (!file_exists( $path )) {mkdir ($path,0777,true );}
                            file_put_contents($cacheFile, $content);
                        }
                        echo  front::$view->_eval($cacheFile);
                    }
                    else{
                        if (!service::get_buymodules_check($dirname,$t,$returndata)){
                            continue;
                        }
                        load_sections_lang($fileurl.'/'.$t.'/lang/'.lang::getisadmin().'/system_modules.php');
                        /*$content=file_get_contents($fileurl.'/'.$t.'/'.$t.'.php');*/
                        $path=ROOT . '/cache/'.lang::getisadmin().'/template/'.$dirname.'/'.$t;
                        $cacheFile=$path.'/#'.$t.'.php';
                        $fileurl_path=$fileurl.'/'.$t.'/'.$t.'.php';
                        if(file_exists($cacheFile)){
                            $filemtime_cache=filemtime($cacheFile);
                        }else{
                            $filemtime_cache=0;
                        }
                        if (filemtime($fileurl_path)>$filemtime_cache){
                            //不复制
                            front::$view->nocopytemplate_buymodules=true;
                            front::$view->skin_buymodules = front::$view->base_url.'/data/buymodules/';

                            $content=front::$view->_eval($fileurl_path,true);
                            $content=front::$view->compile($content);
                            if (!file_exists( $path )) {mkdir ($path,0777,true );}
                            file_put_contents($cacheFile, $content);
                            $content=front::$view->_eval($cacheFile);
                            file_put_contents($cacheFile, $content);
                        }
                        //还原
                        front::$view->skin_buymodules =  front::$view->base_url . '/template/' . config::get('template_dir') . '/visual/buymodules';
                        front::$view->nocopytemplate_buymodules=false;
                        $content=file_get_contents($cacheFile);
                        echo  $content;
                        /*echo  front::$view->_eval($cacheFile); */
                    }
                }
            }
        }
    }

    //组件绑定检验
    function  get_buymodules_check($dirname,$t,$returndata){
        //显示组件名
        if (!file_exists (ROOT.'/data/'.$dirname . '/' . $t.'/default.config.php')){
            return false;
        }
        $defaultconfig = include ROOT.'/data/'.$dirname . '/' . $t.'/default.config.php';
        if ($defaultconfig['modulesname']!=$t){
            return false; //名称和配置不相同  不加载
        }

        //购买组件的话  就需要远程校验  调用
        if ($defaultconfig['isbuy']){
            $appstatic=false;
            foreach ($returndata as $key=>$val){
                if($val['buyid']==$defaultconfig['modulesname']
                    &&  ($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                        || $_SERVER['SERVER_NAME']=='www.'.$val['buyip'])){
                    $appstatic=true;
                }
            }
            if (!$appstatic){
                return false;
            }
        }
        return true;
    }

    //组件绑定检验
    public  static function  get_fetch_cacheFile($tpl,$file,$static,$head_foot,$style){
        $cacheFile="";
        //检验模板文件
     /*   if (!front::$admin){
            //检验PC模板
            if ((strpos($file,'/'.config::get("template_dir").'/') !== false
                    || $style==config::get("template_dir")
                    || $style==config::get("template_dir").'/')
                && !(front::get("case")=="archive"  && front::get("act")=="consumption")
                && !(front::get("case")=="archive"  && front::get("act")=="payconsumption")
                && !(front::get("case")=="archive"  && front::get("act")=="payappsconsumption")
            ){
                $template_check=service::get_template_check(config::get("template_dir"));
                if (!$template_check['statue']){
                    if ($static){
                        return $template_check['message'];  //生成直接返回错误信息
                    }else{
                        echo $template_check['message'];exit;
                    }
                }
            }//检验shop模板
            else if (strpos($file,config::get("template_shopping_dir")) !== false){

                $template_check=service::get_template_check(config::get("template_shopping_dir"));
                if (!$template_check['statue']){
                    if ($static){
                        return $template_check['message'];  //生成直接返回错误信息
                    }else{
                        echo $template_check['message'];exit;
                    }
                }
            }
        }*/
        if (strpos($tpl,ROOT.'/') !== false){
            $tpl=str_replace(ROOT.'/',"",$tpl);
        }
        if (strpos($tpl,'template/'.config::get('template_dir')) !== false){
            $tpl=str_replace('template/'.config::get('template_dir'),"",$tpl);
        }
        //var_dump($style);
        if (!file_exists($file)) {
            echo $file;exit(lang_custom_admin('template').lang_custom_admin('nonentity'));
        }

        $tFile = preg_replace('/([\w-]+)\.(\w+)$/', '#$1.$2', preg_replace('/\.html?$/ix', '.php', $tpl));
        //缓存文件判断 是否静态不修改头部
        if($head_foot && !front::get("cache_make")){
            $header_footer_tFile="no_header_footer/".$tFile;
        }else{
            $header_footer_tFile=$tFile;
        }
        if (front::get('pageset')){
            $cacheFile = ROOT . '/cache/'.lang::getisadmin().'/data/template/' . $style . '/' . $header_footer_tFile;
        }else{
            if (front::$admin){
                $cacheFile = ROOT . '/cache/'.lang::getisadmin().'/template/' . $style . '/' . $header_footer_tFile;
            }else{
                $cacheFile = ROOT . '/cache/'.lang::getistemplate().'/template/' . $style . '/' . $header_footer_tFile;
            }
        }
        tool::mkdir(dirname($cacheFile));
        $tmp = explode('.', $file);
        $ext = end($tmp);
        if($ext != 'php' && $ext != 'html'){
            exit(lang_custom_admin('template_file').lang_custom_admin('mold').lang_custom_admin('error'));
        }

        if (!file_exists($cacheFile) || filemtime($cacheFile) < filemtime($file) || front::$admin && !session::get('passinfo')) {
            $source = front::$view->compile(file_get_contents($file),$head_foot);
            $cacheFile=iconv("utf-8", "gbk",$cacheFile);
            file_put_contents($cacheFile, $source);
        }

        return $cacheFile;
    }


    //login  cms官网登录
   static function  login_cms($app_username,$app_passwrod){
        //服务器登陆校验的地址
        $url=service::$domain."/index.php?case=client&act=cmseaylogin&username=".
            $app_username."&passwrod=".md5($app_passwrod)."&vercode="._NEWVERCODE."&ip=".$_SERVER['SERVER_NAME'];
        $url.="&licenstype=1";  //cms的授权and版权
        $data=service::cmseayurl($url);   //获取服务器的数据
        $data=json_decode($data, true);
        if(isset($data["static"]) && $data["static"]){
            //登陆成功保存到vookie
            $app_login=array("username"=>$app_username,"passwrod"=>md5($app_passwrod));
            service::getInstance()->save_service_users($app_login);
            //写到缓存
            $returndata['static']=1;
            $returndata["message"]=$data['message'];  //登陆成功
            $returndata["userdata"]=$data['userdata'];
            $returndata["appsdata"]=$data['appsdata'];
            $returndata["modulesdata"]=$data['modulesdata'];
            $returndata["wxappyear"]=$data['wxappyear'];
            $returndata["modeldata"]=$data['modeldata'];
            $returndata["licensedata"]=$data['licensedata'];
            $returndata["copyrightdata"]=$data['copyrightdata'];
            session::set("user_buy_all",$returndata);

            //修改本地缓存购买状态
            foreach($data['appsdata'] as $key=>$val){
                if($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                    || $_SERVER['SERVER_NAME']=='www.'.$val['buyip']){   //已经购买的 并且域名一直  更新本地缓存
                    apps::getInstance()->rec_update("isbuy=1"," id='".$val['buyid']."'");
                }
            }
            //修改本地缓存购买状态
            foreach($data['modeldata'] as $key=>$val){
                if($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                    || $_SERVER['SERVER_NAME']=='www.'.$val['buyip']) {   //已经购买的 并且域名一直  更新本地缓存
                    cutbuytemplate::getInstance()->rec_update("isbuy=1", " code='" . $val['buyid'] . "'");
                }
            }
            //修改本地缓存购买状态
            foreach($data['modulesdata'] as $key=>$val){
                if($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                    || $_SERVER['SERVER_NAME']=='www.'.$val['buyip']) {   //已经购买的 并且域名一直  更新本地缓存
                    cutbuymodules::getInstance()->rec_update("isbuy=1", " code='" . $val['buyid'] . "'");
                }
            }
        }
        return $data;
    }

    //检验购买
    function  cms_qkdown($username,$buyname,$buytype){
        $url=service::$domain."/index.php?case=client&act=qkdown&username=".$username.
            "&ip=".$_SERVER['SERVER_NAME']."&buyname=".$buyname.'&buytype='.$buytype;
        $url.="&vercode="._NEWVERCODE;
        if (session::get('ver') == 'corp'){
            $url.="&app_ver=1";
        }else{
            $url.="&app_ver=0";
        }
        $data=service::cmseayurl($url);   //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }

    //购买插件
    function  buyapps_templates($app_buyusername,$app_buyuserid,$app_buytel,$app_buyip,$app_buyremarks,$app_buymenoy,$app_buypayname,$app_buytype,$app_appsname){
        //购买插件
        $curl = new curl();
        $curl->set('host', service::$domain);
        $curl->set('file', 'index.php?case=client&act=buyapps');
        $post=array("app_buyusername"=>$app_buyusername,"app_buyuserid"=>$app_buyuserid,"app_buytel"=>$app_buytel,
            "app_buyip"=>$app_buyip,"app_buyremarks"=>$app_buyremarks,"app_buymenoy"=>$app_buymenoy,"app_buypayname"=>$app_buypayname,
            "app_buytype"=>$app_buytype,"app_appsname"=>$app_appsname,"vercode"=>_NEWVERCODE
            );
        if ( session::get('ver') == 'corp'){
            $post['app_ver']=1;
        }else{
            $post['app_ver']=0;
        }
        $data = $curl->curl_post($post, 30);  //获取服务器的数据
        $data=json_decode($data, true);
       return $data;
    }

    //购买小程序模板  年费
    function  buywxapp($app_buyusername,$app_buyuserid,$app_buyip){
        $curl = new curl();
        $curl->set('host', service::$domain);
        $curl->set('file', 'index.php?case=client&act=buywxapp');
        $post=array("app_buyusername"=>$app_buyusername,"app_buyuserid"=>$app_buyuserid,
            "app_buyip"=>$app_buyip,"vercode"=>_NEWVERCODE
        );
        if ( session::get('ver') == 'corp'){
            $post['app_ver']=1;
        }else{
            $post['app_ver']=0;
        }
        $data = $curl->curl_post($post, 30);  //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }

    //购买授权
    function  buylicense($app_buyusername,$app_buyuserid,$buy_domain){
        $curl = new curl();
        $curl->set('host', service::$domain);
        $curl->set('file', 'index.php?case=client&act=buylicense');
        $post=array("app_buyusername"=>$app_buyusername,"app_buyuserid"=>$app_buyuserid,
            "buy_domain"=>$buy_domain,"vercode"=>_NEWVERCODE,"license_type"=>1
        );
        if ( session::get('ver') == 'corp'){
            $post['app_ver']=1;
        }else{
            $post['app_ver']=0;
        }
        $data = $curl->curl_post($post, 30);  //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }
    //购买版权
    function  buycopyright($app_buyusername,$app_buyuserid,$buy_domain){
        $curl = new curl();
        $curl->set('host', service::$domain);
        $curl->set('file', 'index.php?case=client&act=buycopyright');
        $post=array("app_buyusername"=>$app_buyusername,"app_buyuserid"=>$app_buyuserid,
            "buy_domain"=>$buy_domain,"vercode"=>_NEWVERCODE,"copyright_type"=>1
        );
        if ( session::get('ver') == 'corp'){
            $post['app_ver']=1;
        }else{
            $post['app_ver']=0;
        }
        $data = $curl->curl_post($post, 30);  //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }

    //用户充值
    function buyusermenoy($app_buyuserid,$app_buyuserpayname,$user_menoy){
        $curl = new curl();
        $curl->set('host', service::$domain);
        $curl->set('file', 'index.php?case=client&act=buyusermenoy');
        $post=array("app_buyuserid"=>$app_buyuserid,"app_buyuserpayname"=>$app_buyuserpayname,
            "user_menoy"=>$user_menoy,"vercode"=>_NEWVERCODE
        );
        if ( session::get('ver') == 'corp'){
            $post['app_ver']=1;
        }else{
            $post['app_ver']=0;
        }
        $data = $curl->curl_post($post, 30);  //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }

    //下载授权检验
    function getmycddowme($f,$username){
        $url=service::$domain."/index.php?case=license&act=getmycddowme&id=".$f."&username=".$username;
        $data=service::cmseayurl($url);   //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }

    //代理商品做对接
    function proxyarchive($order){
        $user_data=service::getInstance()->getlogin();
        $data=array("static"=>0,"message"=>lang_admin('buy').lang_admin('failure'));//默认失败
        if (isset($user_data) && is_array($user_data) && $user_data['static']){
            $curl = new curl();
            $curl->set('host', service::$domain);
            $curl->set('file', 'index.php?case=client&act=buyproxyarchive');
            $post=array("order_oid"=>$order['oid'],"oid_details"=>$order['service_aid'],
                "userid"=>$user_data['userdata']['userid'],"vercode"=>_NEWVERCODE,"username"=>$user_data['userdata']['username'],
                "oid_address"=>$order['address']
            );
            if ( session::get('ver') == 'corp'){
                $post['app_ver']=1;
            }else{
                $post['app_ver']=0;
            }
            $data = $curl->curl_post($post, 30);  //获取服务器的数据
            $data=json_decode($data, true);
            if ($data['static']){

            }
        }
        return $data;
    }

    //下载版权检验
    function getmycrdowme($f,$username){
        $url=service::$domain."/index.php?case=copyright&act=getmycrdowme&id=".$f."&username=".$username;
        $data=service::cmseayurl($url);   //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }


    static function _getauthkey_($source)
    {
        if (strlen($source) < 0)
            return '';
        preg_match_all('/#!=(.*)=!#/', $source, $out);
        preg_match_all('/#\$=(.*)=\$#/', $source, $out1);
        preg_match_all('/#\^=(.*)=\^#/', $source, $out2);
        preg_match_all('/#%=(.*)=%#/', $source, $out3);
        preg_match_all('/#\*=(.*)=\*#/', $source, $out4);
        preg_match_all('/#\(=(.*)=\)#/', $source, $out5);
        preg_match_all('/#\-=(.*)=\-#/', $source, $out6);
        preg_match_all('/#\?=(.*)=\?#/', $source, $out7);
        preg_match_all('/#`=(.*)`##/', $source, $out8);
        return $out[1][0] . '-' . $out1[1][0] . '-' . $out2[1][0] . '-' . $out3[1][0] . '-' . $out4[1][0] . '-' . $out5[1][0] . '-' . $out6[1][0] . '-' . $out7[1][0] . '-' . $out8[1][0];
    }
    static function _getauthdate_($source)
    {
        if (strlen($source) < 0)
            return '0';
        preg_match_all('/\\:(.*):\//', $source, $outd0);
        preg_match_all('/\':(.*);\'/', $source, $outd1);
        preg_match_all('/;:(.*):\'/', $source, $outd2);
        return $outd0[1][0] . $outd1[1][0] . $outd2[1][0];
    }
    static function _getauthperiod_($source)
    {
        if (strlen($source) < 0)
            return '0';
        preg_match_all('/.];(.*);]./', $source, $outp0);
        preg_match_all('/\)\)(.*)\(\(/', $source, $outp1);
        return $outp0[1][0] . $outp1[1][0];
    }
    static function md5tocdkey($source, $name)
    {
        $md5str = md5('shenmewanyiluanqibazaodea' . $name);
        if (strlen($source) < 0)
            return 'nocdkeymd5str';
        $str = 'a`b`c`d`e`f`0`1`2`3`4`5`6`7`8`9';
        preg_match_all('/\[\[=(.*)\*%/', $source, $outa);
        preg_match_all('/%%=(.*)\/=/', $source, $outa1);
        preg_match_all('/\/\/(.*)\*\*=/', $source, $outa2);
        preg_match_all('/\*\*=(.*)=\*/', $source, $outa3);
        preg_match_all('/\$%(.*)%\$/', $source, $outa4);
        preg_match_all('/\-=\-(.*)\(\)/', $source, $outa5);
        preg_match_all('/#\/(.*)\/#/', $source, $outa6);
        preg_match_all('/!%(.*)=\]\]/', $source, $outa7);
        $cdkeystr = $outa[1][0] . $outa1[1][0] . $outa2[1][0] . $outa3[1][0] . $outa4[1][0] . $outa5[1][0] . $outa6[1][0] . $outa7[1][0];
        $srtarr = explode('`', $str);
        $cdkeyarr = explode('`', $cdkeystr);
        $cdkey = '';
        for ($i = 0; $i < 32; $i++) {
            $md5word = substr($md5str, $i, 1);
            foreach ($srtarr as $key => $val) {
                if ($md5word == $val) {
                    foreach ($cdkeyarr as $key1 => $val1) {
                        if ($key == $key1) {
                            if ($i % 4 == 0) {
                                $cdkey .= $val1 . '-';
                            } else {
                                $cdkey .= $val1;
                            }
                        }
                    }
                }
            }
        }
        return $cdkey;
    }
    /*static function admin_system_()
    {
        $domains = '127.0.0.2';
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
    }*/
    /***
     * 版权检验
     */
    public static function admin_system($source){
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
            }
        }
        $source = $tsource;
        $soft_type = null;
        //版权验证
        $copyright_static = false;
        //商业版
        if (!$pass) {
            if(file_exists(ROOT . '/license/copyright.php')){
                $copyright_data = include ROOT . '/license/copyright.php';
                $copyright_data=service::passport_decrypt($copyright_data);//解密
                if (is_array($copyright_data)){
                    if($_SERVER['SERVER_NAME']==$copyright_data['domain'] || 'www.'.$_SERVER['SERVER_NAME']==$copyright_data['domain']
                        || $_SERVER['SERVER_NAME']=='www.'.$copyright_data['domain']){
                        session::set('ver', 'corp');
                        session::set('crg', 'free');
                    }
                }
            }else{
                session::set('ver', 'free');
                session::set('crg', 'free');
            }
        } else {
            session::set('crg', 'corp');
            session::set('ver', 'corp');
        }

        if (session::get('crg')=="free") {
            $passinfo = '免费版 <a href="https://www.cmseasy.cn/service/" target="_blank"><font color="green">('.lang_admin('purchase_authorization').')</font></a>';
            session::set('passinfo', $passinfo);
            preg_match_all('/<title>(.*) - (.*)<\/title>/', $source, $out);
            $source = preg_replace('/<head>/i', "<head>\r\n<meta name=\"Generator\" content=\"" . SYSTEMNAME . ' ' . _VERSION . "\" />", $source);
        } else {
            $passinfo = '<span id="__edition">'.lang_admin('commercial_version').'</span>';
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



    /**对字符串进行加密。  crossall_act文件使用
     * @param $txt
     * @param string $key
     * @return string
     */
    public static function lockString($txt,$key='xxx')
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
        $nh = rand(0,64);
        $ch = $chars[$nh];
        $mdKey = md5($key.$ch);
        $mdKey = substr($mdKey,$nh%8, $nh%8+7);
        $txt = base64_encode($txt);
        $tmp = '';
        $i=0;$j=0;$k = 0;
        for ($i=0; $i<strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
            $tmp .= $chars[$j];
        }
        return urlencode($ch.$tmp);
    }

    /**对字符串进行解密。 crossall_act文件使用
     * @param $txt
     * @param string $key
     * @return bool|string
     */
    public static function unlockString($txt,$key='xxx')
    {
        $txt = urldecode($txt);
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
        $ch = $txt[0];
        $nh = strpos($chars,$ch);
        $mdKey = md5($key.$ch);
        $mdKey = substr($mdKey,$nh%8, $nh%8+7);
        $txt = substr($txt,1);
        $tmp = '';
        $i=0;$j=0; $k = 0;
        for ($i=0; $i<strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
            while ($j<0) $j+=64;
            $tmp .= $chars[$j];
        }
        return base64_decode($tmp);
    }


    /** 获取模板列表。
     */
    public static function getservicetemplate()
    {
        $path=ROOT."/cache/template";
        if (!file_exists( $path )) {
            mkdir ($path,0777,true);
        }
        $path.="/template_service.php";
        if (!file_exists($path)){
            @set_time_limit(0);
            //判断获取间隔  30秒
            $url="https://u.cmseasy.cn/index.php?case=client&act=cmsgetTemplate";  //服务器获取列表的地址
            $data=service::cmseayurl($url);   //获取服务器的数据
            $data=json_decode($data, true);
            $template_service=array();
            if(is_array($data)){
                foreach ($data as $val){
                    $sava_val=array();
                    $sava_val['code']=$val['code'];
                    $sava_val['isview']=$val['isview'];
                    $sava_val['iscorp']=$val['iscorp'];
                    $sava_val['version']=$val['version'];
                    $template_service[$val['code']]=$sava_val;
                }
            }
            file_put_contents($path, '<?php return ' . var_export($template_service, true) . ';');
        }
        $template_service = include $path;
        if (!is_array($template_service))
            $template_service=array();
        return $template_service;
    }


    //拆分升级到扩展  扩展数据绑定
    static function  updateapps_cms($app_buyusername,$app_buyip,$app_appsname){
        //购买插件
        $curl = new curl();
        $curl->set('host', service::$domain);
        $curl->set('file', 'index.php?case=client&act=updateapps');
        $post=array("app_buyusername"=>$app_buyusername,"app_buyip"=>$app_buyip,"app_appsname"=>$app_appsname);
        if ( session::get('ver') == 'corp'){
            $post['app_ver']=1;
        }else{
            $post['app_ver']=0;
        }
        $data = $curl->curl_post($post, 30);  //获取服务器的数据
        $data=json_decode($data, true);
        return $data;
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.