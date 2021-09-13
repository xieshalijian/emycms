<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
set_time_limit(0);
class app_admin extends admin
{

    public $domain="https://u.cmseasy.cn";
    
    function init()
    {
        if (front::get('act')== 'buyapps' || front::get('act')== 'buytemplates'
            || front::get('act')== 'buymodules'|| front::get('act')== 'buyusermenoy'
            || front::get('act')== 'buylicense' || front::get('act')== 'wxapptemplates'){
            session::set('user_buy_all', "");
            //清空服务端登陆缓存
        }
        //加载插件
        front::loadApps();
    }

    function execSql($sqlquery){
        if (!$sqlquery)
            return '';
        $database = config::getdatabase('database');
        $sqlquery = str_replace("\r", "", $sqlquery);
        $sqlquery = str_replace("cmseasy_", $database['prefix'], $sqlquery);
        $sqls = preg_split("/;(--)*[ \t]{0,}\n/", $sqlquery);

        $nerrCode = "";
        $i = 0;
        foreach ($sqls as $q) {
            $q = trim($q);
            if ($q == "") {
                continue;
            }

            if (tdatabase::getInstance()->query($q))
                $i++;
            else
                $nerrCode .= "执行： $q 出错!\n";

        }
        return $nerrCode;
    }

    function insSql($app_dir,$upgrade)
    {
        if(!$upgrade && file_exists($app_dir.'install.sql')){
            $sqlquery = file_get_contents($app_dir.'install.sql');
            $return_data=$this->execSql($sqlquery);
            if(file_exists($app_dir.'upgrade.sql')){
                $sqlquery = file_get_contents($app_dir.'upgrade.sql');
                $return_data=$this->execSql($sqlquery);
            }
            return $return_data;
        }
        if(file_exists($app_dir.'upgrade.sql')){
            $sqlquery = file_get_contents($app_dir.'upgrade.sql');
            $return_data=$this->execSql($sqlquery);
            return $return_data;
        }
        return true;
    }

    function unsSql($app_dir)
    {
        if(file_exists($app_dir.'uninstall.sql')){
            $sqlquery = file_get_contents($app_dir.'uninstall.sql');
            return $this->execSql($sqlquery);
        }
        return true;
    }

    function alertJson($code=0,$msg=''){
        echo json_encode(['code'=>$code,'msg'=>$msg]);
        exit;
    }

    function insFiles($app_id,$app_dir){
        $src_list = front::$apps[$app_id]['filelist'];
        $dec_list = front::$apps[$app_id]['filelist'];
        array_walk($src_list,function(&$item,$key){
            $item = str_replace([
                '%root%',
                '%template%',
                '%template_admin%',
                '%template_shopping_dir%',
                '%template_user_dir%',
                '%template_admin_dir%',
            ],[
                '',
                'template',
                'template_admin',
                'shop',
                'user',
                'admin',
            ],$item);
        });
        array_walk($dec_list,function(&$item,$key){
            $item = str_replace([
                '%root%',
                '%template%',
                '%template_admin%',
                '%template_shopping_dir%',
                '%template_user_dir%',
                '%template_admin_dir%',
            ],[
                ROOT.'/',
                TEMPLATE,
                TEMPLATE_ADMIN,
                config::get('template_shopping_dir'),
                config::get('template_user_dir'),
                config::get('template_admin_dir'),
            ],$item);
        });
        foreach ($src_list as $k => $v){
            $dirPath = dirname($dec_list[$k]);
            //获取文件目录  目的地目录
            if(!is_dir($dirPath))
            {
                mkdir($dirPath, 0777, true );
                //不存在则创建文件夹
            }

            //判断如果是.php或者是.html后缀的 复制单个文件  反之则复制的是 整个文件夹
            if (strpos($v,'.php') !== false || strpos($v,'.html') !== false || strpos($v,'.log') !== false
                || strpos($v,'.json') !== false || strpos($v,'.js') !== false){
                copy($app_dir.'files/'.$v,$dec_list[$k]);
            }else{
                self::xCopy($app_dir.'files/'.$v,$dec_list[$k],1);
            }

        }
        return;
    }

    //拷贝文件夹方法
    public function xCopy($source, $destination, $child = 1){
        //用法：
        // xCopy("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录
        // xCopy("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录
        //参数说明：
        // $source:源目录名
        // $destination:目的目录名
        // $child:复制时，是不是包含的子目录
        if(!file_exists($source)){
            echo json_encode(array("static"=>0,"message"=>"Error:the ".$source." is not a direction!"));
            return 0;
        }

        if (is_file($source)){
            $source=dirname($source);
            $destination=dirname($destination);
            $handle=dir($source);
        }else{
            $handle=dir($source);
        }
        if(!file_exists($destination) && !is_file($destination)){
            mkdir($destination,0777);
        }

        while($entry=$handle->read()) {
            if(($entry!=".")&&($entry!="..")){
                if(file_exists($source."/".$entry) && !is_file($source."/".$entry)){
                    if($child)
                        xCopy($source."/".$entry,$destination."/".$entry,$child);
                }
                else{ 
                    copy($source."/".$entry,$destination."/".$entry);
                }
            }
        }
        return 1;
    }

    function unsFiles($app_id,$app_dir){
        $dec_list = front::$apps[$app_id]['filelist'];
        array_walk($dec_list,function(&$item,$key){
            $item = str_replace([
                '%root%',
                '%template%',
                '%template_admin%',
                '%template_shopping_dir%',
                '%template_user_dir%',
                '%template_admin_dir%',
            ],[
                ROOT.'/',
                TEMPLATE,
                TEMPLATE_ADMIN,
                config::get('template_shopping_dir'),
                config::get('template_user_dir'),
                config::get('template_admin_dir'),
            ],$item);
        });
        foreach ($dec_list as $k => $v){
            //判断如果是.php或者是.html后缀的 复制单个文件  反之则复制的是 整个文件夹
            if (strpos($v,'.php') !== false || strpos($v,'.html') !== false || strpos($v,'.log') !== false
                || strpos($v,'.json') !== false){
                unlink($v);
            }else{
                self::deldir($v.'/');
                //目录清空后删除空文件夹
                @rmdir($v);
            }
        }
        front::remove($app_dir);
        return;
    }
    //清空文件夹函数和清空文件夹后删除空文件夹函数的处理
    function deldir($path){
        //如果是目录则继续
        if(is_dir($path)){
            //扫描一个文件夹内的所有文件夹和文件并返回数组
            $p = scandir($path);
            foreach($p as $val){
                //排除目录中的.和..
                if($val !="." && $val !=".."){
                    //如果是目录则递归子目录，继续操作
                    if(is_dir($path.$val)){
                        //子目录中操作删除文件夹和文件
                        self::deldir($path.$val.'/');
                        //目录清空后删除空文件夹
                        @rmdir($path.$val.'/');
                    }else{
                        //如果是文件直接删除
                        unlink($path.$val);
                    }
                }
            }
        }
    }

    //安装插件
    function install($app_id,$upgrade=0)
    {

        //加载插件
        front::loadApps();

        $app_dir = ROOT . '/apps/' . $app_id . '/';

        $app = front::$apps[$app_id];
        $app['installed'] = true;
        if(!$upgrade && file_exists($app_dir.'install.sql')) {
            if ($res = $this->insSql($app_dir,$upgrade)) {
                $this->alertJson(-1, $res);
            }
        }
        if(file_exists($app_dir.'upgrade.sql')) {
            if ($res = $this->insSql($app_dir,$upgrade)) {
                $this->alertJson(-1, $res);
            }
        }
        //解压文件
        $this->insFiles($app_id,$app_dir);
        //压缩包自定义php代码
        if(!$upgrade && file_exists($app_dir.'command.php')){
            include $app_dir . 'command.php';
        }
        if ($upgrade){
            apps::getInstance()->rec_update("version='".$app['new_version']."'","static=1 and id='".$app_id."'");
        }
        apps::getInstance()->rec_update("installed=1","static=1 and id='".$app_id."'");

    }

    function uninstall_action()
    {
        $app_id = front::$post['app_id'];
        $app_dir = ROOT . '/apps/' . $app_id . '/';
        $app = front::$apps[$app_id];
        $app['installed'] = false;
        //压缩包自定义php代码
        if(file_exists($app_dir.'un_command.php')){
            include $app_dir . 'un_command.php';
        }
       /* $res = $this->unsSql($app_dir);
        if(!$res){
            $this->alertJson(-1,$res);
        }*/
        $this->unsSql($app_dir);

        $this->unsFiles($app_id,$app_dir);
       /* $str = json_encode($app,JSON_UNESCAPED_UNICODE);
        $rs = file_put_contents($app_dir.'config.json', $str);*/

        $rs=apps::getInstance()->rec_update("installed=0","static=1 and id='".$app_id."'");
        echo $rs;
    }

    function get_remote_file_url($filename)
    {
        $domain = $this->domain;
        $path = '/apps/apps-7/';
        $url = $domain . $path . $filename;
        return $url;
    }


    //远程下载插件
    function down_action()
    {
        set_time_limit(0);
        session_write_close();
        $action = front::$get['action'];
        $f = isset(front::$post['appname']) && front::$post['appname'] ? front::$post['appname'] : (isset(front::$get['appname'])?front::$get['appname']:"");
        $upgrade =  isset(front::$post['upgrade']) && front::$post['upgrade'] ? front::$post['upgrade'] : (isset(front::$get['upgrade'])?front::$get['upgrade']:"");  //是否升级
        $isSql =  isset(front::$post['sql']) && front::$post['sql'] ? front::$post['appname'] : (isset(front::$get['sql'])?front::$get['sql']:"");
        $filename = $f . '.zip';

        //校验是否购买
        if ($action=="start-download"){
            $applogin =service::getInstance()->get_service_users();
            $data=service::getInstance()->cms_qkdown($applogin["username"],$f,4);
            if(!$data["static"]){
                echo json_encode(array("static"=>0,"message"=>$data['message'],"app_name"=>$f));
                exit;
            }
        }

        $download_cache = ROOT . '/apps/';

        $remote_url = $this->get_remote_file_url($filename);
        $remote_url= str_replace("https://","http://",$remote_url);
        $file_size = service::get_remote_file_size($remote_url);
        $tmp_path = $download_cache . $filename;

        switch ($action) {
            case 'prepare-download':
                // 下载缓存文件夹
                if (!is_dir($download_cache.$f)) {
                    tool::mkdir($download_cache.$f);
                }
                echo json_encode(array("static"=>1,"message"=>"文件创建成功！"));
                break;
            case 'start-download':
                try {
                    touch($tmp_path);
                    if ($fp = @fopen($remote_url, "rb")) {
                        if (!$download_fp = @fopen($tmp_path, "wb")) {
                            echo json_encode(array("static"=>0,"message"=>lang_admin("unable_to_open_temporary_file！")));
                            exit;
                        }
                        while (!feof($fp)) {
                            if (!file_exists($tmp_path)) {
                                fclose($download_fp);
                                echo json_encode(array("static"=>0,"message"=>lang_admin("temporary_file_does_not_exist！")));
                                exit;
                            }
                            fwrite($download_fp, fread($fp, 1024 * 8), 1024 * 8);
                        }
                        fclose($download_fp);
                        fclose($fp);
                    } else {
                        echo json_encode(array("static"=>0,"message"=>lang_admin("cannot_open_remote_file！").$remote_url));
                        exit;
                    }
                } catch (Exception $e) {
                    $messagedata=$e->getMessage();
                    echo json_encode(array("static"=>0,"message"=>$messagedata));
                    exit;
                }
                echo json_encode(array("static"=>1,"message"=>"下载成功，路径：".$tmp_path));
                break;
            case 'get-file-size':
                // 这里检测下 tmp_path 是否存在

                break;
            case 'exzip':
                $unpath = ROOT . '/apps/'.$f;
                //解压路径
                $archive = new PclZip($tmp_path);
                if (!@$archive->extract(PCLZIP_OPT_PATH, $unpath, PCLZIP_OPT_REPLACE_NEWER)) {

                    $this->json_info(1, lang_admin("file_error"));
                    exit;
                }
                //解压完成删除压缩包
                if(file_exists($tmp_path)){
                    unlink($tmp_path);
                }
                $this->install($f,$upgrade);
                echo json_encode(array("static"=>1,"message"=>"安装成功！"));
                break;
            default:
                break;
        }
        exit;
    }

    //服务端登陆
    function  login_action(){
        $app_username=front::$get['app_username'];
        $app_passwrod=front::$get['app_passwrod'];
        $data=service::login_cms($app_username,$app_passwrod);
        echo json_encode($data);
        exit;
    }

    //校验服务端登陆
    function jklogin_action(){
         $returndata=service::getInstance()->getlogin();
         echo json_encode($returndata);
        exit;
    }

    //退出登陆
    function  close_action(){
        //清空服务端账号密码
        $app_login=array("username"=>'',"passwrod"=>'');
        service::getInstance()->save_service_users($app_login);
        session::set('user_buy_all', "");
        if(front::get("buytemplate")){
            front::redirect(url("expansion/buytemplate", true));
        }
        else if(front::get("buymodules")){
            front::redirect(url("expansion/buymodules", true));
        }
        else if(front::get("buywxappmodules")){
            front::redirect(url("wxxcx/template", true));
        }
        else if(front::get("buyapps")){
            front::redirect(url("expansion/buyapps", true));
        }
        else if(front::get("license")){
            front::redirect(url("license_client/buylicense", true));
        }
        else if(front::get("copyright")){
            front::redirect(url("copyright_client/buycopyright", true));
        }
        else if(front::get("visual")){
            front::redirect(url("template/visual", true));
        }
        else if(front::get("index")){
            front::redirect(url("expansion/index", true));
        }
        else if(front::get("proxy")){
            front::redirect(url("proxy/list/table/servicearchive/shopping/1", true));
        }
        front::redirect(url("expansion/index", true));
    }

    //购买插件商品
    function  buyapps_action(){
        session::set('user_buy_all', "");
        //每次购买清空缓存
       //购买插件
        $app_buyusername=front::$get['app_buyusername'];
        $app_buyuserid=front::$get['app_buyuserid'];
        $app_buytel=front::$get['app_buytel'];
        $app_buyip=front::$get['app_buyip'];
        $app_buyremarks=front::$get['app_buyremarks'];
        $app_buymenoy=front::$get['app_buymenoy'];
        $app_buypayname=isset(front::$get['app_buypayname'])?front::$get['app_buypayname']:"";
        $app_buytype=2;
        $app_appsname=front::$get['app_appsname'];
        $data=service::getInstance()->buyapps_templates($app_buyusername,$app_buyuserid,$app_buytel,$app_buyip,$app_buyremarks,$app_buymenoy,$app_buypayname,$app_buytype,$app_appsname);
        //购买插件
        if($data['static']){
            apps::getInstance()->rec_update("isbuy=1","id='".front::$get['app_appsname']."'");
        }
        echo json_encode($data);
        exit;
    }
    //购买在线模板商品
    function  buytemplates_action(){
        session::set('user_buy_all', "");
        //每次购买清空缓存
        $app_buyusername=front::$get['app_buyusername'];
        $app_buyuserid=front::$get['app_buyuserid'];
        $app_buytel=front::$get['app_buytel'];
        $app_buyip=front::$get['app_buyip'];
        $app_buyremarks=front::$get['app_buyremarks'];
        $app_buymenoy=front::$get['app_buymenoy'];
        $app_buypayname=isset(front::$get['app_buypayname'])?front::$get['app_buypayname']:"";
        $app_buytype=1;
        $app_appsname=front::$get['app_appsname'];
        $data=service::getInstance()->buyapps_templates($app_buyusername,$app_buyuserid,$app_buytel,$app_buyip,$app_buyremarks,$app_buymenoy,$app_buypayname,$app_buytype,$app_appsname);
        echo json_encode($data);
        exit;
    }
    //购买组件
    function  buymodules_action(){
        session::set('user_buy_all', "");
        //每次购买清空缓存
        $app_buyusername=front::$get['app_buyusername'];
        $app_buyuserid=front::$get['app_buyuserid'];
        $app_buytel=front::$get['app_buytel'];
        $app_buyip=front::$get['app_buyip'];
        $app_buyremarks=front::$get['app_buyremarks'];
        $app_buymenoy=front::$get['app_buymenoy'];
        $app_buypayname=isset(front::$get['app_buypayname'])?front::$get['app_buypayname']:"yuer";
        $app_buytype=3;
        $app_appsname=front::$get['app_appsname'];
        $data=service::getInstance()->buyapps_templates($app_buyusername,$app_buyuserid,$app_buytel,$app_buyip,$app_buyremarks,$app_buymenoy,$app_buypayname,$app_buytype,$app_appsname);
        echo json_encode($data);
        exit;
    }
    //购买小程序模板  年费
    function  wxapptemplates_action(){
        session::set('user_buy_all', "");
        //每次购买清空缓存
        $app_buyusername=front::$get['app_buyusername'];
        $app_buyuserid=front::$get['app_buyuserid'];
        $app_buyip=front::$get['app_buyip'];
        $data=service::getInstance()->buywxapp($app_buyusername,$app_buyuserid,$app_buyip);
        echo json_encode($data);
        exit;
    }

    //用户充值
    function buyusermenoy_action(){
       //购买插件
        $app_buyuserid=front::$get['app_buyuserid'];
        $app_buyuserpayname=front::$get['app_buyuserpayname'];
        $user_menoy=front::$get['user_menoy'];
        $data=service::getInstance()->buyusermenoy($app_buyuserid,$app_buyuserpayname,$user_menoy);
        echo json_encode($data);
        exit;
    }

    //购买授权
    function buylicense_action(){
        //购买插件
        $app_buyusername=front::$get['app_buyusername'];
        $app_buyuserid=front::$get['app_buyuserid'];
        $buy_domain=front::$get['buy_domain'];
       $data=service::getInstance()->buylicense($app_buyusername,$app_buyuserid,$buy_domain);
        echo json_encode($data);
        exit;
    }

    //购买授权
    function buycopyright_action(){
        //购买插件
        $app_buyusername=front::$get['app_buyusername'];
        $app_buyuserid=front::$get['app_buyuserid'];
        $buy_domain=front::$get['buy_domain'];
        $data=service::getInstance()->buycopyright($app_buyusername,$app_buyuserid,$buy_domain);
        echo json_encode($data);
        exit;
    }


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
