<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

class install_act extends act
{

    function init()
    {
        load_custom_admin_lang('cn'); //安装时候取自定义语言包
        header('Cache-control: private, must-revalidate');
        if (self::installed())
            exit(lang_custom_admin('the_system_is_installed_To_install_again_delete_the_file').' /data/locked ! ');
        //set_time_limit(0);
    }

    function index_action()
    {
        //获取服务端默认模板
       /* if (is_array(session::get("defaurl_template_install"))){
            $data=session::get("defaurl_template_install");
        }else{*/
        if (service:: httpcode("http://down.1826.net/")=="200") {
            $url = "https://u.cmseasy.cn/index.php?case=client&act=cmsgetdefaultTemplate";
            $data = service::cmseayurl($url);   //获取服务器的数据
            $data = json_decode($data, true);

        }
        else{
            $data=array("pctemplatedata"=>array(0=>array("id"=>"789","code"=>"default2020","iscorp"=>"0","isview"=>"1",
                "price"=>"0.00","img"=>"https://view.cmseasy.cn/template/free-template/default2020.jpg","static"=>"1",
                "installed"=>0,"desc"=>"仅适用于7.7.0或更高版本","isbuy"=>0,
                "makeredbili"=>"0.00","makereduser"=>"0","vercode"=>"7726","isdefault"=>"1","isshoptemplate"=>"0")),
                "shoptemplatedata"=>array(0=>array("id"=>"800","code"=>"shop","iscorp"=>"0","isview"=>"1","installed"=>0,
                "price"=>"0.00","img"=>"https://view.cmseasy.cn/template/free-template/shop.jpg","static"=>"1",
                "desc"=>"仅适用于7.7.0或更高版本","isbuy"=>0,"makeredbili"=>"0.00",
                "makereduser"=>"0","vercode"=>"7726","isdefault"=>"1","isshoptemplate"=>"1"))
            );
        }
        /*}*/
        session::set("defaurl_template_pc_install", $data['pctemplatedata']);
        //session::set("defaurl_template_shop_install", $data['shoptemplatedata']);
        $this->view->defaurl_pc_template = $data['pctemplatedata'];
       // $this->view->defaurl_shop_template = $data['shoptemplatedata'];

        $this->view->mysqli = extension_loaded('mysqli');

        $this->view->connerror=array();
         if(!(PHP_VERSION>=5.4)){
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]=lang_admin('php_version').helper::yes(false);
            }else{
                $this->view->connerror[0]=lang_admin('php_version').helper::yes(false);
            }
         }
         if(!(extension_loaded('mysqli'))){
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='php_mysqli:'.lang_admin('not_installed').helper::yes(false);
            }else{
                $this->view->connerror[0]='php_mysqli:'.lang_admin('not_installed').helper::yes(false);
            }
         }
        if (!file_exists(ROOT.'/cache')) {
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='cache'.lang_admin('directory_does_not_exist');
            }else{
                $this->view->connerror[0]='cache'.lang_admin('directory_does_not_exist');
            }
        }
        elseif(!(front::file_mode_info(ROOT.'/cache')>=2)){
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='cache '.lang_admin('directory_not_writable');
            }else{
                $this->view->connerror[0]='cache'.lang_admin('directory_not_writable');
            }
         }
        if (!file_exists(ROOT.'/config')) {
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='config'.lang_admin('directory_does_not_exist');
            }else{
                $this->view->connerror[0]='config'.lang_admin('directory_does_not_exist');
            }
        }
        elseif(!(front::file_mode_info(ROOT.'/config')>=2)){
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='config'.lang_admin('directory_not_writable');
            }else{
                $this->view->connerror[0]='config'.lang_admin('directory_not_writable');
            }
        }
        if (!file_exists(ROOT.'/config/config_database.php')) {
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='config/config_database.php'.lang_admin('directory_does_not_exist');
            }else{
                $this->view->connerror[0]='config/config_database.php'.lang_admin('directory_does_not_exist');
            }
        }
        elseif(!(front::file_mode_info(ROOT.'/config/config_database.php')>=2)){
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='config/config_database.php'.lang_admin('directory_not_writable');
            }else{
                $this->view->connerror[0]='config/config_database.php'.lang_admin('directory_not_writable');
            }
        }
        if (!file_exists(ROOT.'/data')) {
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='data'.lang_admin('directory_does_not_exist');
            }else{
                $this->view->connerror[0]='data'.lang_admin('directory_does_not_exist');
            }
        }
        elseif(!(front::file_mode_info(ROOT.'/data')>=2)){
          if($this->view->connerror){
              $this->view->connerror[count($this->view->connerror)]='data'.lang_admin('directory_not_writable');
          }else{
              $this->view->connerror[0]='data'.lang_admin('directory_not_writable');
          }
      }
         if (!file_exists(ROOT.'/install')) {
             if($this->view->connerror){
                 $this->view->connerror[count($this->view->connerror)]='install'.lang_admin('directory_does_not_exist');
             }else{
                 $this->view->connerror[0]='install'.lang_admin('directory_does_not_exist');
             }
         }
         elseif(!(front::file_mode_info(ROOT.'/install')>=2)){
           if($this->view->connerror){
               $this->view->connerror[count($this->view->connerror)]='install'.lang_admin('directory_not_writable');
           }else{
               $this->view->connerror[0]='install'.lang_admin('directory_not_writable');
           }
        }
        if (!file_exists(ROOT.'/template')) {
            if($this->view->connerror){
                $this->view->connerror[count($this->view->connerror)]='template'.lang_admin('directory_does_not_exist');
            }else{
                $this->view->connerror[0]='template'.lang_admin('directory_does_not_exist');
            }
        }
        elseif(!(front::file_mode_info(ROOT.'/template')>=2)){
           if($this->view->connerror){
               $this->view->connerror[count($this->view->connerror)]='template'.lang_admin('directory_not_writable');
           }else{
               $this->view->connerror[0]='template'.lang_admin('directory_not_writable');
           }
       }
        
          if(!extension_loaded('openssl')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('extend').'opensll    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('extend').'opensll'.helper::yes(false);
               }
           }
          if(!function_exists('gzinflate')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'gzinflate    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'gzinflate'.helper::yes(false);
               }
           }
         /*
          * 微信官方SDK在PHP7中提示：mcrypt_module_open() is deprecated,mcrypt已被OPENSSL

         if(!function_exists('mcrypt_module_open')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'mcrypt_module_open    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'mcrypt_module_open'.helper::yes(false);
               }
           }*/
          if(!function_exists('set_time_limit')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'set_time_limit    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'set_time_limit'.helper::yes(false);
               }
           }
          if(!ini_get('allow_url_fopen')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'allow_url_fopen    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'allow_url_fopen'.helper::yes(false);
               }
           }
          if(!function_exists('pfsockopen')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'pfsockopen    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'pfsockopen  '.helper::yes(false);
               }
           }
          if(!function_exists('fsockopen')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'fsockopen    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'fsockopen  '.helper::yes(false);
               }
           }
            if(!function_exists('stream_socket_client')){
                if($this->view->connerror){
                    $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'stream_socket_client    '.helper::yes(false);
                }else{
                    $this->view->connerror[0]=lang_admin('function_exists').'stream_socket_client  '.helper::yes(false);
                }
            }
          if(!function_exists('socket_set_timeout')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'socket_set_timeout    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'socket_set_timeout  '.helper::yes(false);
               }
           }
          if(!function_exists('scandir')){
               if($this->view->connerror){
                   $this->view->connerror[count($this->view->connerror)]=lang_admin('function_exists').'scandir    '.helper::yes(false);
               }else{
                   $this->view->connerror[0]=lang_admin('function_exists').'scandir  '.helper::yes(false);
               }
           }


        if (front::get('step') == 3 && isset(front::$post['dosubmit'])) {
            $this->view->mysql_pass = false;
            front::$post['prefix'] = strtolower(front::$post['prefix']);
            config::modify(array('type' => 'mysqli'),null,null,true);
            if(!function_exists('mysqli_connect')){
                alerterror(lang_custom_admin('install_and_open_the_PHP_MYSQLI_extension'));
                return;
            }
            if (front::post('hostname')!="" && front::post('user')!=""&& front::post('password')!=""){
                $connect = @mysqli_connect(front::post('hostname'), front::post('user'), front::post('password'));
            }else{
                $connect="";
            }

            //2019 04 23  front::post('createdb') &&   去除安装数据库勾选框   ln
            $databaseName=@mysqli_query($connect,"SHOW DATABASES LIKE '" . front::post('database')."'");
            if (!empty($databaseName) && !@mysqli_select_db($connect, front::post('database'))) {
                @mysqli_query($connect, "CREATE DATABASE " . front::post('database'));
                @mysqli_query($connect, "ALTER DATABASE `$_POST[database]` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
            }
            session::set("langnamewhere","0");
            session::set("admin_lang_cn","0");
            session::set("admin_lang_en","0");
            session::set("admin_lang_sk","0");
            session::set("admin_lang_jp","0");
            if (!mysqli_connect_errno()) {
                if(!front::get('test')){
                    //判断语言包选择   中文不管勾不勾都必选
                    if(front::$post['admin_lang_cn']){
                        session::set('admin_lang_cn',front::$post['admin_lang_cn']);
                    }else{
                        session::set('admin_lang_cn','');
                    }
                    if(front::$post['admin_lang_en']){
                        session::set('admin_lang_en',front::$post['admin_lang_en']);
                    }else{
                        session::set('admin_lang_en','');
                    }
                    if(front::$post['admin_lang_sk']){
                        session::set('admin_lang_sk',front::$post['admin_lang_sk']);
                    }else{
                        session::set('admin_lang_sk','');
                    }
                    if(front::$post['admin_lang_jp']){
                        session::set('admin_lang_jp',front::$post['admin_lang_jp']);
                    }else{
                        session::set('admin_lang_jp','');
                    }
                    if(front::post('default_lang')){
                        session::set('default_lang',front::post('default_lang'));
                    }
                    //如果都不选择的话  就默认中文
                    //if(!(front::$post['admin_lang_cn'] && front::$post['admin_lang_en'] && front::$post['admin_lang_sk']&& front::$post['admin_lang_jp'])){
                        //session::set('admin_lang_cn','cn');
                    //}
                    $db = @mysqli_select_db($connect, front::post('database'));
                    if ($db) {
                        $this->view->mysql_pass = true;
                        session::set('testdata',front::$post['testdata']);
                        $database=array( 'hostname'=>front::post('hostname'),
                            'database'=>front::post('database'),
                            'user'=>front::post('user'),
                            'password'=>front::post('password'),
                            'prefix'=>front::post('prefix'),
                            'encoding'=>'utf8',);
                        config::modify($database,null,null,true);   //true为了修改的是数据库文件config_database.php
                      /*  front::redirect(url('install/index/step/3', true));*/
                        if (front::post('admin_password')=="" || front::post('admin_username')=="" || front::post('admin_password') <> front::post('admin_password2')) {
                            $this->view->adminerror = true;
                        }else {
                            $this->instalsqltype = session::get('testdata');
                            $this->smodarr = front::post('smod');
                            $this->prepare();
                        }
                    }else{
                        $this->view->dberror = true;
                    }
					  
                }
                else{
                    if (front::post('hostname')!="" && front::post('user')!=""&& front::post('password')!="" && front::post('database')!="") {
                        $database = array('hostname' => front::post('hostname'),
                            'database' => front::post('database'),
                            'user' => front::post('user'),
                            'password' => front::post('password'),
                            'prefix' => front::post('prefix'),
                            'encoding' => 'utf8',);
                        config::modify($database, null, null, true);   //true为了修改的是数据库文件config_database.php
                        if ($connect==""){
                            if ($this->view->connerror) {
                                $this->view->connerror[count($this->view->connerror)] = lang_custom_admin('database_connection') . lang_custom_admin('failure');
                            } else {
                                $this->view->connerror[0] = lang_custom_admin('database_connection') . lang_custom_admin('failure');
                            }
                        }else{
                            if ($this->view->connerror) {
                                $this->view->connerror[count($this->view->connerror)] = lang_custom_admin('database_connection') . lang_custom_admin('success');
                            } else {
                                $this->view->connerror[0] = lang_custom_admin('database_connection') . lang_custom_admin('success');
                            }
                        }
                    }else{
                        $this->view->connerror[count($this->view->connerror)] = lang_custom_admin('database_connection') . lang_custom_admin('failure');
                    }
                }
            }
            else{
                if($this->view->connerror){
                    $this->view->connerror[count($this->view->connerror)]=lang_custom_admin('database_connection').lang_custom_admin('failure').mysqli_connect_errno().':'.mysqli_connect_error();
                }else{
                    $this->view->connerror[0]=lang_custom_admin('database_connection').lang_custom_admin('failure').mysqli_connect_errno().':'.mysqli_connect_error();
                }
            }
        }
        $this->render();
    }

    private function prepare()
    {
        set_time_limit(0);
        if ($this->instalsqltype) {
            $sqlquery = file_get_contents(ROOT . '/install/data/install_testdb.sql');
        } else {
            $sqlquery = file_get_contents(ROOT . '/install/data/install.sql');
        }
        if (!$sqlquery) {
            exit(lang_custom_admin('database_file_does_not_exist'));
        }
        $sqlquery = str_replace('cmseasy_', config::getdatabase('database', 'prefix'), $sqlquery);
        $sqlquery = str_replace('\'admin\'', '\'' . front::post('admin_username') . '\'', $sqlquery);
        $sqlquery = str_replace('\'21232f297a57a5a743894a0e4a801fc3\'', '\'' . md5(front::post('admin_password')) . '\'', $sqlquery);
        $sqlquery = str_replace('\'admin@admin.com\'', '\'' .front::post('admin_email') . '\'', $sqlquery);

        file_put_contents(ROOT . '/data/install.data', $sqlquery);
        if(session::get('admin_lang_cn')){
            if(session::get('langnamewhere')){
                session::set("langnamewhere",session::get('langnamewhere').",'".session::get('admin_lang_cn')."'");
            }else{
                session::set("langnamewhere","'".session::get('admin_lang_cn')."'");
            }
            $sqlquerycn = file_get_contents(ROOT . '/install/data/install_lang_'.session::get('admin_lang_cn').'.sql');
            if($sqlquerycn){
                $sqlquerycn = str_replace('cmseasy_', config::getdatabase('database', 'prefix'), $sqlquerycn);
                file_put_contents(ROOT . '/data/install.data', $sqlquerycn,FILE_APPEND);
            }
        }
        if(session::get('admin_lang_en')){
            if(session::get('langnamewhere')){
                session::set("langnamewhere",session::get('langnamewhere').",'".session::get('admin_lang_en')."'");
            }else{
                session::set("langnamewhere","'".session::get('admin_lang_en')."'");
            }
            $sqlqueryen = file_get_contents(ROOT . '/install/data/install_lang_'.session::get('admin_lang_en').'.sql');
            if($sqlqueryen){
                $sqlqueryen = str_replace('cmseasy_', config::getdatabase('database', 'prefix'), $sqlqueryen);
                file_put_contents(ROOT . '/data/install.data', $sqlqueryen,FILE_APPEND);
            }
        }
        if(session::get('admin_lang_sk')){
            if(session::get('langnamewhere')){
                session::set("langnamewhere",session::get('langnamewhere').",'".session::get('admin_lang_sk')."'");
            }else{
                session::set("langnamewhere","'".session::get('admin_lang_sk')."'");
            }
            $sqlquerysk = file_get_contents(ROOT . '/install/data/install_lang_'.session::get('admin_lang_sk').'.sql');
            if($sqlquerysk){
                $sqlquerysk = str_replace('cmseasy_', config::getdatabase('database', 'prefix'), $sqlquerysk);
                file_put_contents(ROOT . '/data/install.data', $sqlquerysk,FILE_APPEND);
            }
        }
        if(session::get('admin_lang_jp')){
            if(session::get('langnamewhere')){
                session::set("langnamewhere",session::get('langnamewhere').",'".session::get('admin_lang_jp')."'");
            }else{
                session::set("langnamewhere","'".session::get('admin_lang_jp')."'");
            }
            $sqlqueryjp = file_get_contents(ROOT . '/install/data/install_lang_'.session::get('admin_lang_jp').'.sql');
            if($sqlqueryjp){
                $sqlqueryjp = str_replace('cmseasy_', config::getdatabase('database', 'prefix'), $sqlqueryjp);
                file_put_contents(ROOT . '/data/install.data', $sqlqueryjp,FILE_APPEND);
            }
        }
        front::redirect(url::create('install/view'));
    }

    function database_action()
    {
       set_time_limit(0);
        $data_file = ROOT . '/data/install.data';
 
        if (file_exists($data_file) == false)
            exit(lang_custom_admin('database_file_does_not_exist'));

        $sqlquery = file_get_contents($data_file);

        $mysql = new user();
        $sqlquery = str_replace("\r", "", $sqlquery);
        $sqls = preg_split("/;(--)*[ \t]{0,}\n/", $sqlquery);
        $nerrCode = "";

        $sqls2 = array();
        foreach ($sqls as $i => $q) {
            $q = trim($q);
            if ($q != '') {
                $sqls2[] = $q;
            }
        }

        echo '<script type="text/javascript">setInterval(function(){window.scrollTo(0,document.body.scrollHeight);},300);</script>';
        echo '<style>*{line-height:180%;font-size:12px;color:#888;}</style>';
        foreach ($sqls2 as $i => $q) {

            echo str_pad(' ', 1024, ' ');

            if (preg_match('/CREATE TABLE (.*?) \(/i', $q, $match) > 0) {

                echo lang_custom_admin('installing_data_sheet').'	' . $match[1] . '...<br>';
            }

            if (!$mysql->query($q)) {
                $nerrCode .= lang_custom_admin('implementation')."： <font color='blue'>$q</font> ".lang_custom_admin('error')."</font><br>";
            }
        }

        @unlink($data_file);

        //修改默认语言包 为CN
        $lang = new lang();
        if(session::get('langnamewhere')){   //语言包安装  设置可用
            $lang->rec_update('static=0,isdefault=0','1=1');
            $lang->rec_update('static=1',' langurlname in ('.session::get('langnamewhere').')');
        }
        //先修改全部 为默认cn
        $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'user SET templatelang="cn",adminlang="cn"  ');
        //然后修改当前数据  然后修改用户取默认设置的语言包
        if(session::get('default_lang')){
            $lang->rec_update('isdefault=1',' langurlname = "'.session::get('default_lang').'"' );
            $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'user SET templatelang="'.session::get(default_lang).'",adminlang="'.session::get(default_lang).'"  ');
        }else{
            $lang->rec_update('isdefault=1',' langurlname = "cn"' );
        }

 $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
				$site_url=$http_type.$_SERVER['HTTP_HOST'].'/';
                $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET `key`="'.$site_url.'" where `name`="site_url"');
                $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET `key`="admin" where `name`="admin_dir"');
                $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET `key`="admin" where `name`="template_admin_dir"');
                $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET `key`="'.sha1(get_hash()).'" where `name`="cookie_password"');
               /* $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET install_admin="'.front::post('admin_username').'" ');*/
                if (session::get("config_template_mobile_dir")){
                    $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET `key`="'.session::get("config_template_mobile_dir").'" where `name`="template_mobile_dir"');
                }
                if (session::get("config_template_dir")){
                    $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET `key`="'.session::get("config_template_dir").'" where `name`="template_dir"');
                }
                if (session::get("config_template_shopping_dir")){
                    $lang->rec_query(' UPDATE '.config::getdatabase('database','prefix').'config SET `key`="'.session::get("config_template_shopping_dir").'" where `name`="template_shopping_dir"');
                }
        echo lang_custom_admin('data_table_installation_complete');
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="' . url::create('install/success') . '";},1000);</script>';
    }

    function view_action()
    {
        $this->render();
    }

    function success_action()
    {
        front::$view->langurlname="";
        file_put_contents(ROOT . '/data/locked', 'install-locked !');
        front::remove(ROOT.'/install');
        @unlink(ROOT . '/install/index.php');
        $this->render();
    }


    function down_action()
    {
        set_time_limit(0);
        session_write_close();
        $action = front::$get['action'];
        $f = front::$post['f'] ? front::$post['f'] : front::$get['f'];
        $isSql = front::$post['sql'] ? front::$post['f'] : front::$get['sql'];
        $filename = $f . '.zip';
        //校验是否购买
        if (front::$get['default_install']){
          /*  if (front::$get['isshoptemplate']=="true"){
                $defaurl_template_install=session::get("defaurl_template_shop_install");
            }else{*/
                $defaurl_template_install=session::get("defaurl_template_pc_install");
           /* }*/

            if (is_array($defaurl_template_install)){
                foreach ($defaurl_template_install as $key=>$val){
                    if ($f==$val['code']){
                        $data=$val;
                    }
                }
            }else{
                $this->json_info(1, lang_admin("模板不存在！"));
                exit;
            }

        }
        else{
            $applogin=service::getInstance()->get_service_users();
            $data=service::cms_qkdown($applogin["username"],$f,2);
            if(!$data["static"]){
                $this->json_info(1, $data['message']);
                exit;
            }
        }


        //判断域名是否可连接  不可连接则使用本地的压缩包下载安装
        if (!front::$get['template_thispc'] && service:: httpcode("http://down.1826.net/")=="200") {
            $remote_url=$data['zipurl'];
            if(!service::is_ssl()) {
                $remote_url = str_replace("https://", "http://", $remote_url);
            }else{
                $remote_url = str_replace("http://", "https://", $remote_url);
            }
            $local_static=false;
        }else{
            //$remote_url="http://".$_SERVER['SERVER_NAME'].'/install/'. $f . '.zip';
            $remote_url=ROOT.'/install/'. $f . '.zip';
            $local_static=true;
        }

        $remote_url= str_replace("https://","http://",$remote_url);

        if ($local_static){
            $file_size = $bytes = filesize($remote_url);;
        }else{
            $file_size = service::get_remote_file_size($remote_url);
        }


        $download_cache = ROOT . '/cache/downloads/';
        $tmp_path = $download_cache . $filename;

        switch ($action) {
            case 'prepare-download':
                // 下载缓存文件夹
                if (!is_dir($download_cache)) {
                    tool::mkdir($download_cache);
                }
                $this->json(compact('file_size'));
                break;
            case 'start-download':
                try {
                    touch($tmp_path);
                    if ($fp = @fopen($remote_url, "rb")) {
                        if (!$download_fp = @fopen($tmp_path, "wb")) {
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
                        }
                        fclose($download_fp);
                        fclose($fp);
                    } else {
                        $this->json_info(3, lang_admin('cannot_open_remote_file'));
                        exit;
                    }
                } catch (Exception $e) {
                    $this->json_info(4, $e->getMessage());
                    exit;
                }
                $this->json_info(0, $tmp_path);
                break;
            case 'get-file-size':
                // 这里检测下 tmp_path 是否存在
                if (file_exists($tmp_path)) {
                    // 返回 JSON 格式的响应
                    $this->json(array('size' => filesize($tmp_path)));
                }
                break;
            case 'exzip':
                $unpath = TEMPLATE;
                if (false !== stristr($f, 'mobile')) {
                    session::set("config_template_mobile_dir",$f);
                    /*config::modify(array(
                        'template_mobile_dir' => $f,
                    ))*/;
                }else{
                    session::set("config_template_dir",$f);
                   /* config::modify(array(
                        'template_dir' => $f,
                    ));*/
                    $unpath = ROOT;
                }
                $archive = new PclZip($tmp_path);
                if (!$archive->extract(PCLZIP_OPT_PATH, $unpath, PCLZIP_OPT_REPLACE_NEWER)) {
                    //$this->json_info(1, $archive->errorInfo(true));
                    $this->json_info(1, lang_admin("file_error"));
                    exit;
                }

                if ($isSql == 'true' && file_exists(ROOT . '/data/template/' . $f . '/install.sql')) {
                    $rs = tdatabase::getInstance()->restoreTables(ROOT . '/data/template/'. $f . '/install.sql');
                    if ($rs) {
                        $this->json_info(5, $rs);
                        exit;
                    }

                    //更新表
                    $nerrCode=service::checktable();
                    if ($nerrCode) {
                        $this->json_info(5, $nerrCode);
                        exit;
                    }

                }

                //config修改
                //修改安装状态为已安装
                if (front::$get['isshoptemplate']=="true"){
                    session::set("config_template_shopping_dir",$f);
                    //config::modify(array("template_shopping_dir"=>$f));
                }else{

                    session::set("config_template_dir",$f);
                    //config::modify(array("template_dir"=>$f));
                }
               /* cutbuytemplate::getInstance()->rec_update("installed=1","static=1 and code='".$f."'");*/
                $this->json_info(0, lang_admin('template').lang_admin('install').lang_admin('success'));
                break;
            default:
                # code...
                break;
        }
        exit;
    }
    function json_info($code, $msg)
    {
        echo json_encode(array('code' => $code, 'msg' => $msg));
    }
    function json($args)
    {
        echo json_encode($args);
    }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
