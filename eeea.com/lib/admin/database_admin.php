<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');
class database_admin extends admin {
    function init() {
        $dir=ROOT.'/data/backup-data/';
        if (!file_exists( $dir )) {mkdir ($dir,0777,true );}
        $dir=ROOT.'/data/backup-website/';
        if (!file_exists( $dir )) {mkdir ($dir,0777,true );}
        $dir=ROOT.'/data//backup-upload/';
        if (!file_exists( $dir )) {mkdir ($dir,0777,true );}
        $dir=ROOT.'/data//backup-template/';
        if (!file_exists( $dir )) {mkdir ($dir,0777,true );}
    }
    function index_action() {

    }
    function baker_action() {
        chkpw('func_data_baker');
        if(front::post('submit2')) {
            if(!is_array(front::post('select'))) return;
            tdatabase::getInstance()->bakTablesBags();
            front::flash(lang_admin('success').lang_admin('backups').count(front::post('select')).lang_admin('individual').lang_admin('lang_table').'！');
        };
        //备份
        $newdataback=array();
        $newbackup=array();
        $newupload=array();
        $newtemplate=array();
        //获取数据库的备份
        chkpw('func_data_restore');
        $dir=ROOT.'/data/backup-data/';
        $databack=front::scan($dir);
        foreach($databack as $dir) {
            if(!preg_match('/\./',$dir) &&!preg_match('/hotsearch/',$dir)) $newdataback[count($newdataback)]=$dir;
        }
        //获取整站的备份
        $dir=ROOT.'/data/backup-website';
        $backup=front::scan($dir);
        foreach($backup as $dir) {
            if(!preg_match('/\.\./',$dir)) $newbackup[count($newbackup)]=$dir;
        }
        //获取附件的备份
        $dir=ROOT.'/data/backup-upload';
        $upload=front::scan($dir);
        foreach($upload as $dir) {
            if(!preg_match('/\.\./',$dir)) $newupload[count($newupload)]=$dir;
        }
        //获取模板的备份
        $dir=ROOT.'/data/backup-template';
        $template=front::scan($dir);
        foreach($template as $dir) {
            if(!preg_match('/\.\./',$dir)) $newtemplate[count($newtemplate)]=$dir;
        }

        $this->view->newdataback=$newdataback;
        $this->view->newbackup=$newbackup;
        $this->view->newupload=$newupload;
        $this->view->newtemplate=$newtemplate;
        //结合所有备份
        /*$db_dirs=array_merge($newdataback,$newbackup,$newupload,$newtemplate);
        sort($db_dirs);
        $this->view->db_dirs=$db_dirs;*/
    }
    function backAll_action(){
        $dir=ROOT.'/data/backup-website';
        if(front::post('submit') &&is_array(front::post('select'))) {
            foreach(front::post('select') as $d) {
                @unlink($dir.'/'.$d);
            }
            front::flash(lang_admin('success').lang_admin('delete').count(front::post('select')).lang_admin('individual').lang_admin('archives').'！');
        }
        $dirs=front::scan($dir);
        $db_dirs=array();
        foreach($dirs as $dir) {
            if(!preg_match('/\.\./',$dir)) $db_dirs[]=$dir;
        }
        //var_dump($db_dirs);
        $this->view->db_dirs=$db_dirs;
    }
    function dobackAll_action(){
        $random = randomkeys(8);
        $database = new tdatabase();
        $database->autoBakTablesBags();
        if(!file_exists(ROOT.'/data/backup-website/'))@mkdir (ROOT.'/data/backup-website/', 0777,true);
        $this->deldir(ROOT.'/data/backup-website/');  //删除目录下文件
        $zipname='backup_'.date('YmdHis').$random.'.zip';
        $pclzip = new PclZip(ROOT.'/data/backup-website/'.$zipname);
        $pclzip->create(ROOT,PCLZIP_OPT_REMOVE_PATH,ROOT);
        if($pclzip == 0){
            die("Error : ".$pclzip->errorInfo(true));
        }else{
            //上传插件
            apps::updateimg("backup-website/".$zipname,ROOT.'/data/backup-website/'.$zipname);
            die('ok');
        }
    }

    //清理无栏目的内容
    function deletenocatgoty_action(){
        $archivedata=archive::getInstance()->getrows(null,0);
        $category=category::getInstance();
        foreach ($archivedata as $key=>$val){
            if (!is_array($category->category[$val['catid']])){
                archive::getInstance()->rec_delete("aid=".$val['aid']);
            }
        }

        front::redirect(url('database/baker',true));
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
                        deldir($path.$val.'/');
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

    function restore_action() {
        chkpw('func_data_restore');
        $dir=ROOT.'/data/backup-data/';
        if(front::post('submit') &&is_array(front::post('select'))) {
            foreach(front::post('select') as $d) {
                front::remove($dir.'/'.$d);
            }
            front::flash(lang_admin('success').lang_admin('delete').count(front::post('select')).lang_admin('individual').lang_admin('archives').'！');
        }
        $dirs=front::scan($dir);
        $db_dirs=array();
        foreach($dirs as $dir) {
            if(!preg_match('/\./',$dir) &&!preg_match('/hotsearch/',$dir)) $db_dirs[]=$dir;
        }
        $this->view->db_dirs=$db_dirs;
    }
    function deletedir_action() {
        if(strpos(front::get('db_dir'),'backup_') !== false){
            $dir=ROOT.'/data/backup-website/'.front::get('db_dir');
            @unlink($dir);
            apps::deleteossimg('backup-website/'.front::get('db_dir'));//插件删除

        }else  if(strpos(front::get('db_dir'),'databack_') !== false){
            $dir=ROOT.'/data/backup-data/'.front::get('db_dir');
            front::remove($dir);
            apps::deleteossimg('backup-data/'.front::get('db_dir'));//插件删除
        }else  if(strpos(front::get('db_dir'),'upload_') !== false){
            $dir=ROOT.'/data/backup-upload/'.front::get('db_dir');
            @unlink($dir);
            apps::deleteossimg('backup-upload/'.front::get('db_dir'));//插件删除
        }else  if(strpos(front::get('db_dir'),'template_') !== false){
            $dir=ROOT.'/data/backup-template/'.front::get('db_dir');
            @unlink($dir);
            apps::deleteossimg('backup-template/'.front::get('db_dir'));//插件删除
        }
        $count_num=isset(front::$post['select'])?count(front::post('select')):0;
        front::flash(lang_admin('success').lang_admin('delete').$count_num.$dir.lang_admin('individual').lang_admin('archives').'！');
        front::redirect(url::create('database/baker'));
    }
    //备份附件
    function  dobackupload_action(){
        $basePath=ROOT.'/html/upload';
        $random = randomkeys(8);
        if(!file_exists(ROOT.'/data/backup-upload/'))@mkdir (ROOT.'/data/backup-upload/', 0777,true);
        $zipname='upload_'.date('YmdHis').$random.'.zip';
        $pclzip = new PclZip(ROOT.'/data/backup-upload/'.$zipname);
        @$pclzip->create($basePath,PCLZIP_OPT_REMOVE_PATH,$basePath);
        if($pclzip == 0){
            die("Error : ".$pclzip->errorInfo(true));
        }else{
            //上传插件
            apps::updateimg("backup-upload/".$zipname,ROOT.'/data/backup-upload/'.$zipname);

            die('ok');
        }
    }
    //恢复附件
    function doupload_action(){
        $basePath=ROOT.'/html/upload';
        $pclzip = new PclZip(ROOT.'/data/backup-upload/'.front::get('db_dir'));
        $pclzip->extract(PCLZIP_OPT_PATH,$basePath);
        if($pclzip == 0){
            front::flash(lang_admin('attachment_recovery').lang_admin('failure').'！');
        }else{
            front::flash(lang_admin('attachment_recovery').lang_admin('success').'！');
        }
        front::redirect(url::create('database/baker'));
    }
    //备份模板
    function  dobacktemplate_action(){
        $basePath=ROOT.'/template';
        $random = randomkeys(8);
        if(!file_exists(ROOT.'/data/backup-template/'))@mkdir (ROOT.'/data/backup-template/', 0777,true);
        $zipname='template_'.date('YmdHis').$random.'.zip';
        $pclzip = new PclZip(ROOT.'/data/backup-template/'.$zipname);
        @$pclzip->create($basePath,PCLZIP_OPT_REMOVE_PATH,$basePath);
        if($pclzip == 0){
            die("Error : ".$pclzip->errorInfo(true));
        }else{
            //上传插件
            apps::updateimg("backup-template/".$zipname,ROOT.'/data/backup-template/'.$zipname);
            die('ok');
        }
    }
    //恢复m模板
    function dotemplate_action(){
        $basePath=ROOT.'/template';
        $pclzip = new PclZip(ROOT.'/data/backup-template/'.front::get('db_dir'));
        $pclzip->extract(PCLZIP_OPT_PATH,$basePath);
        if($pclzip == 0){
            front::flash(lang_admin('template_recovery').lang_admin('failure').'！');
        }else{
            front::flash(lang_admin('template_recovery').lang_admin('success').'！');
        }
        front::redirect(url::create('database/baker'));
    }

    //还原数据
    function dorestore_action() {
       /* $db_dir = explode('_',front::get('db_dir'));
        if($db_dir[2]!=_VERCODE){
            front::flash(lang_admin('database_recovery_failed').'！');
            front::redirect(url::create('database/baker'));
        }*/
        $dir=ROOT.'/data/backup-data/'.front::get('db_dir');
        if(is_dir($dir)) {
            $db_files=front::scan($dir);
            foreach($db_files as $db_file) {
                if(!preg_match('/^\./',$db_file)) tdatabase::getInstance()->restoreTables($dir.'/'.$db_file);
            }
            //更新表
            $nerrCode=service::checktable();
            if ($nerrCode) {
                $this->json_info(5, $nerrCode);
                exit;
            }
            user::deletesession();
            category::deletesession();
            type::deletesession();
            special::deletesession();
            front::flash(lang_admin('database_recovery').lang_admin('success').'！');
        }
        front::redirect(url::create('database/baker'));
    }

    function str_replace_action() {
        chkpw('func_data_replace');
        if(front::post('submit') &&front::post('sfield') &&front::post('replace1')) {
            $field=front::post('sfield');
            $table=front::post('stable');
            $table=new $table();
            $replace1=front::post('replace1');
            $replace2=front::post('replace2');
            $where=front::post('where');
            if(!$where) {
                $table->getFields();
                $where=$table->primary_key.'>0';
            }
            $table->rec_update( " `$field` = REPLACE($field,'$replace1','$replace2')",$where);
            front::flash(lang_admin('success').lang_admin('substitute')."！");
        }
        $_tables=tdatabase::getInstance()->getTables();
        $this->view->tables=array(0=>lang_admin('select_an_item').'...');
        if(config::get('test_data')) $prefix='test_';
        else $prefix=config::getdatabase('database','prefix');

        foreach($_tables as $table) {
            if(!preg_match("/$prefix/is",$table['name'])) continue;
            $name=str_replace($prefix,'',$table['name']);
            $name=str_replace('a_','',$name);
            $_name=lang($name);
            if($_name<>$name)
                $this->view->tables[$name]=$_name;
        }
    }
    function dbfield_select_action() {
        $res=array();
        $res['content']='&nbsp;&nbsp;'.lang_admin('no_field_can_be_replaced').'。';
        $table=front::post('stable');
        if(@class_exists($table)) {
            $table=new $table;
            $_fields=array();
            foreach($table->getFields() as $field) {
                if(preg_match('/text|var/',$field['type']) &&!preg_match('/^[a-zA-Z_]+$/',lang($field['name'])))
                    $_fields[]=$field['name'];
            }
            $fields=array(0=>null);
            foreach($_fields as $field) $fields[$field]=lang($field);
            if(count($_fields)>0)
                $res['content']='&nbsp;&nbsp;'.lang_admin('field').'=>'.form::select('sfield',0,$fields,'style="font-size:16px"');
        }
        $res['id']='fieldlist';
        echo json::encode($res);
        exit;
    }

    //导wordpress的数据到cmseasy中
    function wordpress_action(){
/* chkpw('func_data_phpweb');*/
        //插入数据库的总条目数
        $total_num = 0;
        $set=settings::getInstance();
        $set->name = $set->prefix.'user';
        //目标表前缀
        $d_prefix = $set->prefix;
        $user_info = $set->rec_select_one("`username`='{$_COOKIE['login_username']}'","*","`userid`");

        if(!empty(front::$post['submit'])){
            //判断是否填写原表前缀
            if(!empty(front::$post['phpweb_prefix'])){
                $s_prefix = front::$post['phpweb_prefix'].'_';
            }else{
                front::flash(lang_admin('please_fill_in_the_original_form'));
                return ;
            }
            //判断上传的数据库文件是否存在
            $filename = ROOT.'/'.front::$post['data'];
            if(!file_exists(ROOT.'/'.front::$post['data'])){
                front::flash(lang_admin('please_check_if_you_can_upload_the_database_files_correctly'));
                return ;
            }
            //记录前面插入的category的id
            $cat_id = array();
            $sql_file = fopen($filename,'r');
            while ($row = fgets($sql_file)){
                //如果这一行不是INSERT语句就略过
                if(!strstr($row,'insert')) continue;

                $tmp = strstr($row,'(');
                $tmp = trim($tmp,"\n\t\r\0\x0B(); ");
                $tmp_arr = explode('),(',$tmp);

                //如果是wp_users表,则选择对应数据插入user中
                if(strstr($row,$s_prefix.'users')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        if(!is_array(user::getInstance()->getrow("username='".$arr[10]."'"))){   //判断用户名是否重复  重复的不插入
                            $arr_data = array(
                                'username'   =>$arr[10],
                                'PASSWORD'     =>$arr[11],
                                'nickname'  =>$arr[12],
                                'e_mail'  =>$arr[13],
                                'adddatetime'  =>$arr[15],
                                'groupid'=>'101',   //默认一般会员
                            );
                            $id = put_into_db($d_prefix.'user',$arr_data);
                            if(!$id) $total_num++;
                        }
                    }
                    continue;
                }
                //  html/upload/attachment/201909/1567732503.txt

                //如果是wp_comments表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'comments')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        echo print_r($arr);
                        $arr_data = array(
                            'username'   =>$arr[11],
                            'PASSWORD'     =>$arr[7],
                            'nickname'  =>$arr[8],
                            'groupid'=>$arr[9],
                            'checked'   =>$arr[10],
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if(!$id) $total_num++;

                    }
                    continue;
                }



                //如果是product_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'product_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>3,
                            'catname'           =>$arr[2],
                            'listorder'         => $arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'showtemplate'      =>0,
                            'template'          =>'archive/list_pic.html',
                            'listtemplate'      =>'archive/list_pic.html',
                            'showtemplate'      =>'archive/show_products.html',
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['product_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是product_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'product_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['product_cat'][$arr[1]]) ? $cat_id['product_cat'][$arr[1]] : -1,
                            'title'        =>$arr[5],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>7,//确认首页是以图片的版面来显示
                            'spid'         =>0,
                            'tag'          =>$arr[43],
                            'keyword'      =>$arr[43],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'thumb'        =>$arr[15],//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>'archive/show_products.html',
                            'ishtml'       =>0,
                            'attr2'        =>9,//产品金额
                            'pics'         =>'a:1:{i:0;s:0:"";}',//内容多图
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是news_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'news_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>2,
                            'catname'           =>$arr[2],
                            'listorder'         =>$arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'template'          =>'archive/list_text.html',
                            'listtemplate'      =>'archive/list_text.html',
                            'showtemplate'      =>0,
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['news_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是news_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'news_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['news_cat'][$arr[1]]) ? $cat_id['news_cat'][$arr[1]] : -1 ,
                            'title'        =>$arr[5],
                            'tag'          =>$arr[46],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>0,//确认首页是以文本版面显示
                            'spid'         =>0,
                            'keyword'      =>$arr[46],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'thumb'        =>'',//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>0,
                            'ishtml'       =>0,
                            'attr2'        =>'',//产品金额
                            'pics'         =>'a:0:{}',
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是down_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'down_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>6,
                            'catname'           =>$arr[2],
                            'listorder'         =>$arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'template'          =>'archive/list_down.html',
                            'listtemplate'      =>'archive/list_down.html',
                            'showtemplate'      =>0,
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['down_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是down_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'down_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['down_cat'][$arr[1]]) ? $cat_id['down_cat'][$arr[1]] : -1 ,
                            'title'        =>$arr[5],
                            'tag'          =>$arr[45],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>0,//确认首页是以文本版面显示
                            'spid'         =>0,
                            'keyword'      =>$arr[45],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'thumb'        =>'',//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>0,
                            'ishtml'       =>0,
                            'linkto'       =>$arr[43],
                            'attr1'        =>$arr[44],//存放文件被下载的次数
                            'pics'         =>'a:1:{i:0;s:0:"";}',
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是photo_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'photo_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>2,
                            'catname'           =>$arr[2],
                            'listorder'         => $arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'template'          =>'archive/list_text.html',
                            'listtemplate'      =>'archive/list_text.html',
                            'showtemplate'      =>0,
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['photo_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是photo_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'photo_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['photo_cat'][$arr[1]]) ? $cat_id['photo_cat'][$arr[1]] : -1 ,
                            'title'        =>$arr[5],
                            'tag'          =>$arr[22],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>0,//确认首页是以文本版面显示
                            'spid'         =>0,
                            'keyword'      =>$arr[22],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'image'        =>$arr[15],//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>0,
                            'ishtml'       =>0,
                            'attr2'        =>'',//产品金额
                            'pics'         =>'a:0:{}',
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }
            }
            front::flash(lang_admin('common_insertion').$total_num.lang_admin('bar_data'));
        }
    }
    //导inputdede的数据到cmseasy中
    function inputdede_action(){
        chkpw('func_data_phpweb');
        //插入数据库的总条目数
        $total_num = 0;
        $set=settings::getInstance();
        $set->name = $set->prefix.'user';
        //目标表前缀
        $d_prefix = $set->prefix;
        $user_info = $set->rec_select_one("`username`='{$_COOKIE['login_username']}'","*","`userid`");

        if(!empty(front::$post['submit'])){
            //判断是否填写原表前缀
            if(!empty(front::$post['phpweb_prefix'])){
                $s_prefix = front::$post['phpweb_prefix'].'_';
            }else{
                front::flash(lang_admin('please_fill_in_the_original_form'));
                return ;
            }
            //判断上传的数据库文件是否存在
            $filename = ROOT.'/'.front::$post['data'];
            if(!file_exists(ROOT.'/'.front::$post['data'])){
                front::flash(lang_admin('please_check_if_you_can_upload_the_database_files_correctly'));
                return ;
            }
            //记录前面插入的category的id
            $cat_id = array();
            $sql_file = fopen($filename,'r');
            while ($row = fgets($sql_file)){
                //如果这一行不是INSERT语句就略过
                if(!strstr($row,'INSERT')) continue;

                $tmp = strstr($row,'(');
                $tmp = trim($tmp,"\n\t\r\0\x0B(); ");
                $tmp_arr = explode('),(',$tmp);

                //如果是cmseasy_user表,则选择对应数据插入user中
                if(strstr($row,$s_prefix.'user')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'username'   =>$arr[6],
                            'PASSWORD'     =>$arr[7],
                            'nickname'  =>$arr[8],
                            'groupid'=>$arr[9],
                            'checked'   =>$arr[10],
                        );
                        $id = put_into_db($d_prefix.'user',$arr_data);
                        if(!$id) $total_num++;

                    }
                    continue;
                }

                //如果是feedback_info表,则选择对应数据插入guestbook中
                if(strstr($row,$s_prefix.'feedback_info')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'username'  =>$arr[4],
                            'adddate'   =>date('Y-m-d H:i:s',$arr[26]),
                            'state'     =>$arr[29],
                            'guesttel'  =>$arr[6],
                            'guestemail'=>$arr[8],
                            'guestqq'   =>$arr[10],
                            'title'     =>$arr[2],
                            'content'   =>$arr[3],
                        );
                        $id = put_into_db($d_prefix.'guestbook',$arr_data);
                        if($id) $total_num++;

                    }
                    continue;
                }

                //如果是advs_link表,则选择对应数据插入linkword中
                if(strstr($row,$s_prefix.'advs_link')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'linkword'  =>$arr[2],
                            'linkurl'   =>$arr[3],
                            'linktimes' =>mktime(),
                        );
                        $id = put_into_db($d_prefix.'linkword',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是pollindex表,则选择对应数据插入ballot中
                if(strstr($row,$s_prefix.'tools_pollindex')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'id'    =>$arr[0],
                            'title' =>$arr[1],
                            'type'  =>'radio',
                        );
                        $id = put_into_db($d_prefix.'ballot',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是tools_polldata表,则选择对应数据插入option中
                if(strstr($row,$s_prefix.'tools_polldata')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'bid'  =>$arr[1],
                            'name' =>$arr[3],
                            'num'  =>$arr[5],
                            'order'=>$arr[2],
                        );
                        $id = put_into_db($d_prefix.'option',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是product_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'product_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>3,
                            'catname'           =>$arr[2],
                            'listorder'         => $arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'showtemplate'      =>0,
                            'template'          =>'archive/list_pic.html',
                            'listtemplate'      =>'archive/list_pic.html',
                            'showtemplate'      =>'archive/show_products.html',
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['product_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是product_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'product_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['product_cat'][$arr[1]]) ? $cat_id['product_cat'][$arr[1]] : -1,
                            'title'        =>$arr[5],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>7,//确认首页是以图片的版面来显示
                            'spid'         =>0,
                            'tag'          =>$arr[43],
                            'keyword'      =>$arr[43],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'thumb'        =>$arr[15],//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>'archive/show_products.html',
                            'ishtml'       =>0,
                            'attr2'        =>9,//产品金额
                            'pics'         =>'a:1:{i:0;s:0:"";}',//内容多图
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是news_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'news_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>2,
                            'catname'           =>$arr[2],
                            'listorder'         =>$arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'template'          =>'archive/list_text.html',
                            'listtemplate'      =>'archive/list_text.html',
                            'showtemplate'      =>0,
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['news_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是news_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'news_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['news_cat'][$arr[1]]) ? $cat_id['news_cat'][$arr[1]] : -1 ,
                            'title'        =>$arr[5],
                            'tag'          =>$arr[46],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>0,//确认首页是以文本版面显示
                            'spid'         =>0,
                            'keyword'      =>$arr[46],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'thumb'        =>'',//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>0,
                            'ishtml'       =>0,
                            'attr2'        =>'',//产品金额
                            'pics'         =>'a:0:{}',
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是down_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'down_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>6,
                            'catname'           =>$arr[2],
                            'listorder'         =>$arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'template'          =>'archive/list_down.html',
                            'listtemplate'      =>'archive/list_down.html',
                            'showtemplate'      =>0,
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['down_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是down_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'down_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['down_cat'][$arr[1]]) ? $cat_id['down_cat'][$arr[1]] : -1 ,
                            'title'        =>$arr[5],
                            'tag'          =>$arr[45],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>0,//确认首页是以文本版面显示
                            'spid'         =>0,
                            'keyword'      =>$arr[45],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'thumb'        =>'',//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>0,
                            'ishtml'       =>0,
                            'linkto'       =>$arr[43],
                            'attr1'        =>$arr[44],//存放文件被下载的次数
                            'pics'         =>'a:1:{i:0;s:0:"";}',
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是photo_cat表,则选择对应数据插入b_category中
                if(strstr($row,$s_prefix.'photo_cat')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'parentid'          =>2,
                            'catname'           =>$arr[2],
                            'listorder'         => $arr[3],
                            'htmldir'           =>pinyin::get($arr[2]),
                            'template'          =>'archive/list_text.html',
                            'listtemplate'      =>'archive/list_text.html',
                            'showtemplate'      =>0,
                            'includecatarchives'=>1,
                            'ispages'           =>1,
                            'ishtml'            =>0,
                            'includecatarchives'=>1,
                            'thumb_width'       =>0,
                            'thumb_height'      =>0,
                            'isnav'             =>0, //是否在导航栏显示字段
                        );
                        $id = put_into_db($d_prefix.'b_category',$arr_data);
                        $cat_id['photo_cat'][$arr[0]] = $id;
                        if($id) $total_num++;
                    }
                    continue;
                }

                //如果是photo_con表,则选择对应数据插入archive中
                if(strstr($row,$s_prefix.'photo_con')){
                    foreach($tmp_arr as $v){
                        $arr = super_explode($v);
                        $arr_data = array(
                            'catid'        =>isset($cat_id['photo_cat'][$arr[1]]) ? $cat_id['photo_cat'][$arr[1]] : -1 ,
                            'title'        =>$arr[5],
                            'tag'          =>$arr[22],
                            'username'     =>$user_info['username'],
                            'userid'       =>$user_info['userid'],
                            'view'         =>0,//确认首页是以文本版面显示
                            'spid'         =>0,
                            'keyword'      =>$arr[22],
                            'listorder'    =>0,
                            'adddate'      =>date('Y-m-d H:i:s',$arr[16]),
                            'author'       =>$arr[17],
                            'image'        =>$arr[15],//列表显示的图片
                            'state'        =>1,
                            'checked'      =>1,
                            'introduce'    =>$arr[22],
                            'introduce_len'=>200,
                            'content'      =>$arr[6],
                            'template'     =>0,
                            'ishtml'       =>0,
                            'attr2'        =>'',//产品金额
                            'pics'         =>'a:0:{}',
                            'city_id'      =>0,
                            'section_id'   =>0,
                        );
                        $id = put_into_db($d_prefix.'archive',$arr_data);
                        if($id) $total_num++;
                    }
                    continue;
                }
            }
            front::flash(lang_admin('common_insertion').$total_num.lang_admin('bar_data'));
        }
    }

    function dir_path($path) {
        $path = str_replace('\\','/',$path);
        if(substr($path,-1) != '/') $path = $path.'/';
        return $path;
    }

    public function converpics_action(){
        set_time_limit(0);
        $archive = archive::getInstance();
        $rows = $archive->getrows(null,0,'aid asc','aid,pics');
        if(is_array($rows) && !empty($rows)){
            foreach ($rows as $arr){
                //var_dump($arr);
                $tmp = array();
                $row = unserialize($arr['pics']);
                if(is_array($row)){
                    $i = 0;
                    foreach ($row as $pic){
                        $tmp[$i]['url'] = $pic;
                        $tmp[$i]['alt'] = $pic;
                        $i++;
                    }
                }
                //var_dump($tmp);
                $str = serialize($tmp);
                $archive->rec_update(array('pics'=>$str),array('aid'=>$arr['aid']));
            }
        }
        echo lang_admin('conversion_complete');
        exit;
    }

    function end() {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
