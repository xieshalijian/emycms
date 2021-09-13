<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class user_act extends act
{
    function init()
    {

        $user = null;
        $this->_user = new user();
        if (cookie::get('login_username') && cookie::get('login_password')) {
            $user = $this->_user->getrow(array('username' => cookie::get('login_username')));
            if (cookie::get('login_password') != front::cookie_encode($user['password'])) {
                unset($user);
            }
        }
        $nologin_arr = array('login', 'ologin', 'respond', 'dialog_login',
            'space', 'register', 'login_js', 'login_mode', 'login_success', 'getpass','cmseaylogin');
        if (!is_array($user) && !in_array(front::$act, $nologin_arr)) {
            front::redirect(url::create('user/login'));
        } else {
            $this->view->user = $user;
        }

        $this->view->form = $this->_user->get_form();
        $this->view->field = $this->_user->getFields();
        $this->view->primary_key = $this->_user->primary_key;
        if (is_array($_POST)) {
            foreach ($_POST as $v) {
                if (inject_check($v)) {
                    event::log('inject',$v);
                    exit(lang('do_not_submit_illegal_content'));
                }
            }
        }
        $this->view->union_conf = include ROOT.'/config/union.php';
    }

    function index_action()
    {
        //提取商品
        if(file_exists(ROOT."/lib/table/shopping.php")) {
            include_once ROOT . '/lib/plugins/pay/wxscanpay.php';
        }
        if (!front::get('page')) front::$get['page'] = 1;
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "mid={$this->view->user['userid']}";
        if(front::get('type') == 'buy'){
            $where=$where.' and status=0 ';
        }
        else if(front::get('type') == 'shou') {
            $where=$where.' and status=1 ';
        }
        $this->view->type=front::get('type');
        //提取商品
        if(file_exists(ROOT."/lib/table/shopping.php")) {
            $orders = new orders();
            $this->view->ordersdata = $orders->getrows($where, $limit, 'adddate desc', $orders->getcols('manage'));
        }
        $this->view->data = $this->view->user;

      /*  //授权管理
        if(file_exists(ROOT."/lib/table/license.php")) {
            $where = "uid={$this->cur_user['userid']}";
            $licensedata = license::getInstance()->getrows($where, 0, 'addtime desc', '*');
            $this->view->license_count = count($licensedata);
        }
        //网站模板
        if(file_exists(ROOT."/lib/table/appsauthority.php")) {
            $where = " username='{$this->view->user['username']}' and buytype=1";
            $butemplate_count = appsauthority::getInstance()->getrows($where, 0, 'id desc', '*');
            $this->view->butemplate_count = count($butemplate_count);
        }
        //主机管理
        if(file_exists(ROOT."/lib/table/vhost.php")) {
            $where = "uid={$this->cur_user['userid']}";
            $vhost_data = vhost::getInstance()->getrows($where, 0, 'id desc', '*');
            $this->view->vhost_count = count($vhost_data);
            $this->view->vhost_data = $vhost_data;
        }*/

        //判断 推广是否安装
        $unionstate=false;
        $appdata=getappdata();
        if (is_array($appdata))
            foreach ($appdata  as $app){
                if ($app['id']=='union'){
                    $unionstate=true;
                }
            }
        $this->view->unionstate = $unionstate;

        //下载记录
        if(file_exists(ROOT."/lib/table/downlogin.php")) {

            $archiveid=0;
            if (front::post("downlogin_title") || front::post("downlogin_code") || front::get("downpage")){
                if (front::post("downlogin_title")){
                    session::set("downlogin_title",front::post("downlogin_title"));
                }
                if (front::post("downlogin_code")){
                    session::set("downlogin_code",front::post("downlogin_code"));
                }
                $typeid=0;
                if (session::get("downlogin_title") && file_exists(ROOT."/lib/table/type.php")){
                    $type_where="typename like '%".session::get("downlogin_title")."%'";
                    $type_data=type::getInstance()->getrows($type_where, 0, 'typeid desc');
                    if (is_array($type_data))
                        foreach ($type_data as $type){
                            if ($typeid){
                                $typeid.=','.$type["typeid"];
                            }else{
                                $typeid=$type["typeid"];
                            }
                        }
                }

                $archive_where="1=1 ";
                if ($typeid){
                    $archive_where.="and typeid in (".$typeid.")";
                }
                if (session::get("downlogin_code"))$archive_where.=" and  title like '%".session::get("downlogin_code")."%'";
                $arc_data=archive::getInstance()->getrows($archive_where, 0, 'aid desc');
                if (is_array($arc_data))
                    foreach ($arc_data as $arc){
                        if ($archiveid){
                            $archiveid.=','.$arc["aid"];
                        }else{
                            $archiveid=$arc["aid"];
                        }
                    }
            }else{
                session::del("downlogin_title");
                session::del("downlogin_code");
            }

            $where="uid=". $this->view->user['userid'];
            if ($archiveid){
                $where.=" and aid in (".$archiveid.")";
            }
            $sql="SELECT a.* FROM ".config::getdatabase('database', 'prefix')."downlogin a  WHERE id = (SELECT MIN(id) FROM ".config::getdatabase('database', 'prefix')."downlogin WHERE aid = a.aid) and  ".$where." ORDER BY a.aid   LIMIT ".$limit;
            $downlogin_data = downlogin::getInstance()->rec_query($sql);
            if (is_array($downlogin_data))
                foreach ($downlogin_data as $key=>$down){
                    $downlogin_data[$key]['archive']=archive::getInstance()->getrow("aid=".$down['aid']);
                }
            $this->view->downlogin_data=$downlogin_data;
            $this->view->downlogin_page=front::get('page');
            $this->view->downlogin_count=count($downlogin_data);
            $this->view->downlogin_zonpage=ceil(count($downlogin_data)/20);
        }
    }

    function space_action()
    {
        //$space=new user();
        //$space=$space->getrow(array('userid'=>front::get('mid')));
        //$this->view->user=$space;
        //var_dump($this->view->user);
        if (!$this->view->user['userid']) {
            alertinfo(lang('not_logged'), url::create('user/login'));
        }
        $this->_table = new archive;
        if (!front::get('page')) front::$get['page'] = 1;
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "userid={$this->view->user['userid']}";
        $where .= ' and ' . $this->_table->get_where('user_manage');
        $this->_view_table = $this->_table->getrows($where, $limit, '1 desc', $this->_table->getcols('manage'));
        $this->view->data = $this->_view_table;
        $this->view->record_count = $this->_table->record_count;
    }

    function edit_action()
    {

        if (front::post('submit')) {
         /*   //图片上传  头像
            if($_FILES["headimage"]["error"])
            {
                front::flash(lang($_FILES["headimage"]["error"]));
            }
            else
            {
                //没有出错
                //加限制条件
                //判断上传文件类型为png或jpg且大小不超过1024000B
                if(($_FILES["headimage"]["type"]=="image/png"||$_FILES["headimage"]["type"]=="image/jpeg")&&$_FILES["headimage"]["size"]<1024000)
                {
                    $filename=$_SERVER['DOCUMENT_ROOT']."/html/upload/images/".date('Ym', time());
                    $dir = iconv("UTF-8", "GBK", $filename);
                    if (!file_exists($dir)){
                        mkdir ($dir,0777,true);
                    }
                    //防止文件名重复
                    $imgNewName=time().'.png';//$_FILES["headimage"]["name"]
                    $filename =$filename."/".$imgNewName;
                    //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
                    $filename =iconv("UTF-8","gb2312",$filename);
                    //检查文件或目录是否存在
                    if(file_exists($filename))
                    {
                        front::flash(lang("该文件已存在"));
                    }
                    else
                    {
                        //保存文件,   move_uploaded_file 将上传的文件移动到新位置
                        move_uploaded_file($_FILES["headimage"]["tmp_name"],$filename);//将临时地址移动到指定地址
                        front::$post['headimage']="/html/upload/images/".date('Ym', time())."/".$imgNewName;;  //路径保存到数据库
                    }
                }
                else
                {
                    front::flash(lang("文件类型不对"));
                }
            }*/
            //超级管理员可以修改用户名
             if (user::getuserid()!="2"){
                 unset(front::$post['username']);
             }
            unset(front::$post['groupid']);
            unset(front::$post['powerlist']);
            unset(front::$post['password']);
            if (!is_email(front::$post['e_mail'])) {
                alerterror(lang('mailbox_format_is_not'));
            }
            foreach (front::$post as $k => $v) {
                if (is_array($v) && !empty($v)) {
                    front::$post[$k] = implode(',', $v);
                }
                front::check_type(front::post($k), 'safe');
            }
            $this->_user->rec_update(front::$post, "username='".session::get('username')."'");

            //修改名称了就要修改缓存
            if (front::$post['username']){
                session::set('username',front::$post['username']);
                cookie::set('login_username', front::$post['username']);
            }
            if(front::$post['imgtext']=='1'){
                front::flash(lang(lang('selection_successful')));
                front::redirect(url::create('user/edit/table/user'));
            }else{
                front::flash(lang('modify_data_successfully'));
                front::redirect(url::create('user/index'));
            }
        }
        $this->view->data = $this->view->user;
        //var_dump($this->view->data);
    }


    //第三方平台登录
    function ologin_action()
    {
		$logintypes = array('alipaylogin','qqlogin','wechatlogin');
        $logintype = $_GET['logtype'];
        if(!in_array($logintype,$logintypes)){
            exit(lang('the_wrong_name'));
        }
        $logintype = $_GET['logtype'];
        $where = array('ologin_code' => $logintype);
        $ologins = ologin::getInstance()->getrows($where);
        include_once ROOT . '/lib/plugins/ologin/' . $logintype . '.php';
        $loginobj = new $logintype();
        $url = $loginobj->get_code(unserialize_config($ologins[0]['ologin_config']));
        @header("Location: $url");
        exit;
    }

    function respond_action()
    {
        $classname = front::$get['ologin_code'];
        if (!in_array($classname, array('alipaylogin', 'qqlogin','wechatlogin'))) {
            front::flash(lang('the_wrong_name'));
            return;
        }
        if (front::post('regsubmit')) {
            if (!config::get('reg_on')) {
                front::flash(lang('site_has_been_closed_to_register'));
                return;
            }
            if (front::post('username') != strip_tags(front::post('username'))
                || front::post('username') != htmlspecialchars(front::post('username'))
            ) {
                front::flash(lang('ame_is_not_standardized'));
                return;
            }
            if (strlen(front::post('username')) < 4) {
                front::flash(lang('user_name_is_too_short'));
                return;
            }
            if (front::post('username') && front::post('password')) {
                $username = front::post('username');
                $username = str_replace('\\', '', $username);
                $password = md5(front::post('password'));
                $data = array(
                    'username' => $username,
                    'password' => $password,
                    'groupid' => 101,
                    'adddatetime'=>date('Y-m-d h:i:s', time()),
                    'userip' => front::ip()
                );
                if ($this->_user->getrow(array('username' => $username))) {
                    front::flash(lang('user_name_already_registered'));
                    return;
                }
                $insert = $this->_user->rec_insert($data);
                $_userid = $this->_user->insert_id();
                if ($insert) {
                    front::flash(lang('registered_success'));
                } else {
                    front::flash(lang('registration_failure'));
                    return;
                }
                $user = $data;
                cookie::set('login_username', $user['username']);
                cookie::set('login_password', front::cookie_encode($user['password']));
                session::set('username', $user['username']);
                front::redirect(url::create('user'));
                exit;
            }
        }

        if (front::post('submit')) {
            if (front::post('username') && front::post('password')) {
                $username = front::post('username');
                $password = md5(front::post('password'));
                $data = array(
                    'username' => $username,
                    'password' => $password,
                );
                $user = new user();
                $row = $user->getrow(array('username' => $data['username'], 'password' => $data['password']));
                if (!is_array($row)) {
                    $this->login_false();
                    return;
                }
                $post[$classname] = session::get('openid');
                $this->_user->rec_update($post, 'userid=' . $row['userid']);
                cookie::set('login_username', $row['username']);
                cookie::set('login_password', front::cookie_encode($row['password']));
                session::set('username', $row['username']);
                front::redirect(url::create('user'));
                return;
            } else {
                $this->login_false();
                return;
            }

        }

        include_once ROOT . '/lib/plugins/ologin/' . $classname . '.php';
        $ologinobj = new $classname();
        $status = $ologinobj->respond();
        //var_dump(session::get('openid'));exit;
        $where[$classname] = session::get('openid');
        if (!$where[$classname]) front::redirect(url::create('user'));
        $user = new user();
        $data = $user->getrow($where);
        if (!$data) {
            $this->view->data = $status;
        } else {
            cookie::set('login_username', $data['username']);
            cookie::set('login_password', front::cookie_encode($data['password']));
            session::set('username', $data['username']);
            front::redirect(url::create('user'));
        }

    }

    //////////////////////

    function login_action()
    {
        cookie::set('loginfalse', 0, 0);
        //判断是否用手机号登陆
        if(front::get('tellogin')){
            $this->view->tellogin = front::get('tellogin') ;
        }
        //判断登陆路径
        if (front::get('loginurl')){
            $loginurl=front::get('loginurl');
        }else{
            $loginurl=0;
        }
        $this->view->loginurl = $loginurl;

        if (!$this->loginfalsemaxtimes())
            if (front::post('submit')) {
                if((config::get('verifycode') == 1) || session::get('YNverification')=='1') {
                    if (!session::get('verify') || front::post('verify') <> session::get('verify')) {
                        alerterror(lang('verification_code'));
                        return;
                    }
                }else if(config::get('verifycode') == 2){
                    if (!verify::checkGee()) {
                        alerterror(lang('verification_code'));
                        return;
                    }
                }

                if ((config::get('mobilechk_enable') && config::get('mobilechk_login'))
                    || (front::post('dxdlnum') && front::post('dxdlnum')=='1')) {
                    $mobilenum = front::$post['mobilenum'];
                    $smsCode = new SmsCode();
                    if (!$smsCode->chkcode($mobilenum)) {
                        alerterror(lang('cell_phone_parity_error'));
                        return;
                    }
                }

                if ((front::post('username') && front::post('password')) || (front::post('dxdlnum') && front::post('dxdlnum')=='1') ) {
                    //短信通过后 无需密码  判断账号即可
                    if(front::post('dxdlnum') && front::post('dxdlnum')=='1'){
                        $tel=  front::post('tel');
                        $data=" tel='".$tel."' ";
                    }else{
                        $username = front::post('username');
                        $password = md5(front::post('password'));
                        //三合一登陆
                        $data="password='".$password."' and (username='".$username."' or tel='".$username."' or e_mail='".$username."')";
                       /* $data = array(
                            'username' => $username,
                            'password' => $password,
                        );*/
                    }
                    $user = new user();
                    $user = $user->getrow($data);
                   
                    if (!is_array($user)) {
                        //短信通登陆  如果手机号不存在用户 那就直接新增账号
                        if(front::post('dxdlnum') && front::post('dxdlnum')=='1') {
                            //提示完善信息！！！！.....           手机号保存
                            session::set("user_tel_register",$tel);
                            front::redirect(url::create('user/register/telregister/1'));
                        }else{
                            $this->login_false();
                            return;
                        }
                    }
                    //var_dump($user);exit;
                    if($user['isblock']){
                        alerterror(lang('your_account_has_been_frozen'));
                        return;
                    }
                    if($user['expired_time']!=0 && $user['expired_time']<time()){
                        alerterror(lang('当前用户已经过期！请联系管理员续费'));
                        return;
                    }

                    //登陆成功关闭验证码
                    session::del('YNverification');
                    //$user = $data;
                    cookie::set('login_username', $user['username']);
                    cookie::set('login_password', front::cookie_encode($user['password']));
                    session::set('username', $user['username']);
                    $this->view->from = front::post('from') ? front::post('from') : front::$from;
                   /* front::flash($this->fetch('login_success.html'));*/
                    if (front::get('loginurl')){
                        echo "<script>history.go(-2);</script>";
                        exit;
                    }else{
                        front::redirect(url::create('user/index'));
                    }
                    return;
                }
                else {
                    $this->login_false();
                    return;
                }
            }

        //过滤中间表增加
        if(file_exists(ROOT."/lib/table/ologin.php")) {
            $this->view->ologinlist = ologin::getInstance()->getrows('', 50);
        }else{
            $this->view->ologinlist=array();
        }
    }

    function dialog_login_action()
    {
        if (!$this->loginfalsemaxtimes())
            if (front::post('submit')) {
                if (config::get('verifycode')) {
                    if (!session::get('verify') || front::post('verify') <> session::get('verify')) {
                        front::flash(lang('verification_code') . "<a href=''>" . lang('backuppage') . "</a>");
                        return;
                    }
                }
                if (front::post('username') && front::post('password')) {
                    $username = front::post('username');
                    $password = md5(front::post('password'));
                    $data = array(
                        'username' => $username,
                        'password' => $password,
                    );
                    $user = new user();
                    $user = $user->getrow($data);
                    if (!is_array($user)) {
                        $this->login_false();
                        return;
                    }
                    //$user = $data;
                    //var_dump($user);exit;
                    if($user['isblock']){
                        front::flash(lang('your_account_has_been_frozen'));
                        return;
                    }
                    cookie::set('login_username', $user['username']);
                    cookie::set('login_password', front::cookie_encode($user['password']));
                    session::set('username', $user['username']);
                    session::set('userid', $user['uid']);
                    $this->view->from = front::post('from') ? front::post('from') : front::$from;
                    $this->view->message = $this->fetch('user/login_success.html');
                    return;
                } else {
                    $this->login_false();
                    return;
                }
            }
    }

    function login_false()
    {
        cookie::set('loginfalse', (int)cookie::get('loginfalse') + 1, time() + 3600);
        event::log('loginfalse', lang('failure') . ' user=' . front::post('username'));
        session::set('YNverification','1');
        session::set("user_tel_register","");
        //front::flash(lang('login_failure') . "<a href=''>" . lang('backuppage') . "</a>");
        cookie::set('lockingfalse'.front::post('username'), (int)cookie::get('lockingfalse'.front::post('username')) + 1, time() + 3600);
        //判断错误五次冻结
        $this->lockingfalse();
        alerterror(lang('login_failure'));
    }

    function lockingfalse(){
        if (cookie::get('lockingfalse'.front::post('username'))>=5){
            $username = front::post('username');
            //三合一登陆
            $where="(username='".$username."' or tel='".$username."' or e_mail='".$username."') and groupid<>2";
            user::getInstance()->rec_update('isblock=1',$where);
            cookie::set('lockingfalse'.front::post('username'), 0, time() + 3600);
            alerterror(lang('your_account_has_been_frozen'));
        }
    }

    function loginfalsemaxtimes()
    {
        if ((config::get('template_nologin') && cookie::get('loginfalse') >= config::get('template_nologin')) || event::loginfalsemaxtimes()) {
            front::flash(lang('wrong_too_many_times'));
            return true;
        }
    }

    function login_js_action()
    {
        if (cookie::get('login_username') && cookie::get('login_password')) {
            $user = $this->_user->getrow(array('username' => cookie::get('login_username')));
            if (is_array($user) && cookie::get('login_password') == front::cookie_encode($user['password'])) {
                $this->view->user = $user;
                session::set('username', $user['username']);
            }
        }
        echo tool::text_javascript($this->fetch(null,true));
        exit;
    }

    function login_mode_action()
    {
        if (front::post('username') && front::post('passwrod')) {
            $username=front::post('username');
            $password = md5(front::post('passwrod'));
            //三合一登陆
            $data="password='".$password."' and (username='".$username."' or tel='".$username."' or e_mail='".$username."')";

            $user = new user();
            $user = $user->getrow($data);

            if (is_array($user)) {
                cookie::set('login_username', $user['username']);
                cookie::set('login_password', front::cookie_encode($user['password']));
                session::set('username', $user['username']);
                echo  json_encode(array("static"=>1,"message"=>"登录成功！"));
                exit;
            }
        }
        echo  json_encode(array("static"=>-1,"message"=>"登录失败！"));
        exit;
    }

    function logout_action()
    {
        cookie::del('login_username');
        cookie::del('login_password');
        session::del('username');
        front::redirect(url::create('user/login'));
        exit;
    }

    private function sendmail($smtpemailto, $title, $mailbody)
    {
        include_once(ROOT . '/lib/plugins/smtp.php');
        $mailsubject = mb_convert_encoding($title, 'GB2312', 'UTF-8');
        $mailtype = "HTML";
        $smtp = new include_smtp(config::get('smtp_mail_host'), config::get('smtp_mail_port'), config::get('smtp_mail_auth'), config::get('smtp_mail_username'), config::get('smtp_mail_password'));
        $smtp->debug = false;
        $smtp->sendmail($smtpemailto, config::get('smtp_user_add'), $mailsubject, $mailbody, $mailtype);
    }

    function register_action()
    {
        //判断手机号登陆之后完善信息
        if(front::get('telregister') && session::get("user_tel_register")){
            $this->view->telregister = front::get('telregister') ;
        }
        //echo session::get('verify');
        //var_dump($_SESSION);
        if (front::post('submit')) {
            if (!config::get('reg_on')) {
                alerterror(lang('site_has_been_closed_to_register'));
                return;
            }

            if(config::get('verifycode') == 1) {
                if (!session::get('verify') || front::post('verify') <> session::get('verify')) {
                    alerterror(lang('verification_code'));
                    exit;
                }
            }
            else if(config::get('verifycode') == 2){
                if (!verify::checkGee()) {
                    alerterror(lang('verification_code'));
                    exit;
                }
            }

            $arr=array("!","@","#","$","%","^","&","*","(",")","[","]","|",",",".","<",">","{","}","=","+","-","；","'","\"","www.","http:://","https:://");
            $a=0;
            foreach($arr as $key=>$value){
                if(strpos(front::post('username'),$value)){
                    $a=1;
                }
            }
            if($a==1){
                echo "<script>alert(\"不能包含特殊字符！\"); history.back(-1);</script>";
                exit;
            }

          if (config::get('invitation_registration')) {

              $invite = front::$post['invite'];
              $db_invite = invite::getInstance();
              if(!$db_invite->checkInvite($invite)){
                  alerterror(lang('invitation-code').lang('error'));
                  return;
              }
          }
            //完善信息的话&& !front::post('telregister')  就不需要验证了
            if (config::get('mobilechk_enable') && config::get('mobilechk_reg') && !front::post('telregister')) {
                $mobilenum = front::$post['mobilenum'];
                $smsCode = new SmsCode();
                if (!$smsCode->chkcode($mobilenum)) {
                    alerterror(lang('cell_phone_parity_error'));
                    return;
                }
            }
            if (front::post('username') != strip_tags(front::post('username'))
                || front::post('username') != htmlspecialchars(front::post('username'))
            ) {
                alerterror(lang('name_is_not_standardized'));
                return;
            }
            if (strlen(front::post('username')) < 4) {
                alerterror(lang('user_name_is_too_short'));
                return;
            }
            if (strlen(front::post('e_mail')) < 1 && !is_email(front::post('e_mail'))) {
                alerterror(lang('please_fill_in_the_mailbox'));
                return;
            }
            if (!is_email(front::post('e_mail'))) {
                alerterror(lang('please_fill_in_the_correct_mailbox_format'));
                return;
            }
            if (strlen(front::post('tel')) < 1) {
                alerterror(lang('please fill in your mobile phone number'));
                return;
            }
            if (strlen(front::post('tel')) < 1) {
                alerterror(lang('please fill in your mobile phone number'));
                return;
            }


            if (front::post('username') && front::post('password')) {
                $username = front::post('username');
                $username = str_replace('\\', '', $username);
                $password = md5(front::post('password'));
                $e_mail = front::post('e_mail');
                $tel = front::post('tel');
                $data = array(
                    'username' => $username,
                    'password' => $password,
                    'e_mail' => $e_mail,
                    'tel' => $tel,
                    'adddatetime'=>date('Y-m-d h:i:s', time()),
                    'groupid' => 101,
                    'userip' => front::ip()

                );
  
                foreach ($this->view->field as $f) {
                    $name = $f['name'];
                    if (!preg_match('/^my_/', $name)) {
                        unset($field[$name]);
                        continue;
                    }
                    if (!setting::$var['user'][$name]['showinreg']) {
                        continue;
                    }
                    $data[$name] = front::post($name);
                }
                //用户名存在
                if ($this->_user->getrow(array('username' => $username))) {
                    front::flash(lang('user_name_already_registered'));
                    return;
                }
                //邮箱存在
                if ($this->_user->getrow(array('e_mail' => $e_mail))) {
                    front::flash(lang('user_mail_already_registered'));
                    return;
                }
                //手机号存在
                if ($this->_user->getrow(array('tel' => $tel))) {
                    front::flash(lang('user_tel_already_registered'));
                    return;
                }
                $insert = $this->_user->rec_insert($data);
                $_userid = $this->_user->insert_id();
                if ($insert) {
                    if (config::get('sms_on') && config::get('sms_reg_on')) {
                        $smsCode = new SmsCode();
                        $content = $smsCode->getTemplate('reg', array($username, front::post('password')));
                        sendMsg($tel, $content);
                    }
                    $cmsname = config::get('sitename');
                    if (config::get('email_reg_on')) {
                        $this->sendmail($e_mail, lang('welcome_to_register')."$cmsname !", lang('respect') . $username . ', ' . lang('hello_welcome_you_to_register' . $cmsname . '!'));
                    }
                    if (config::get('invitation_registration')) {
                        $invitecode = front::$post['invite'];
                        $invite = new invite();
                        $invite->rec_update(array('isuse'=>'1','reguid'=>$username,'regtime'=>date('Y-m-d h:i:s', time())), array('invitecode'=>$invitecode));
                        //推荐人加积分  一次加一分
                        $data=$invite->getrows("invitecode='".$invitecode."'", 1);
                        $this->_user->setintegration(10,$data[0]['ctname']);
                    }
                    //推广扩展 判断安装
                    if(file_exists(ROOT."/lib/table/union.php")){
                        if (union::getconfig('enabled')) {
                            $union_visitid = intval(cookie::get('union_visitid'));
                            $union_userid = intval(cookie::get('union_userid'));
                            if ($union_visitid && $union_userid) {
                                $union_reg = new union();
                                $r = $union_reg->getrow(array('userid' => $union_userid));
                                if ($r) {
                                    $updateregisters=$union_reg->rec_update(array('registers' => ($r['registers']+1)), array('userid' => $union_userid));
                                    if ($updateregisters) {
                                        $union_visit_reg = new union_visit();
                                        $union_visit_reg->rec_update(array('regusername' => front::post('username'), 'regtime' => time()), array('visitid' => $union_visitid));
                                        $this->_user->rec_update(array('introducer' => $union_userid), array('userid' => $_userid));
                                        $regrewardtype = union::getconfig('regrewardtype');
                                        $regrewardnumber = union::getconfig('regrewardnumber');
                                        switch ($regrewardtype) {
                                            case 'point':
                                                union::pointadd($r['username'], $regrewardnumber, 'union');
                                                break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //完善信息就登陆进去
                    if(front::post('telregister')){
                        cookie::set('login_username', $username);
                        cookie::set('login_password', front::cookie_encode($password));
                        session::set('username', $username);
                        $this->view->from = front::post('from') ? front::post('from') : front::$from;
                        front::redirect(url::create('user/index'));
                    }
                    alertinfo(lang('registered_success'),url('user/login'));
                } else {
                    alerterror(lang('registration_failure'));
                    return;
                }

                $user = $data;
                cookie::set('login_username', $user['username']);
                cookie::set('login_password', front::cookie_encode($user['password']));
                session::set('username', $user['username']);
                front::redirect(url::create('user'));
                exit;
            } else {
                alerterror(lang('registration_failure'));
                return;
            }
        }
        /*if (front::get('t') == 'wap') {
            $tpl = 'wap/register.html';
            $this->render($tpl);
            exit;
        }*/
    }

    function usernamepate_action(){

    }

    function changepassword_action()
    {
        if (front::post('dosubmit') && front::post('password')) {
            if (!front::post('oldpassword') || !is_array($this->_user->getrow(array('password' => md5(front::post('oldpassword'))), 'userid=' . $this->view->user['userid']))) {
                front::flash(lang('the_original_password_is_not_correct!_Password_change_failed'));
                return;
            }
            $this->_user->rec_update(array('password' => md5(front::post('password'))), 'userid=' . $this->view->user['userid']);
            front::flash(lang('password_modification_success'));
        }

        $this->view->data = $this->view->user;

    }

    function getpass_action()
    {
        function randomstr($length)
        {
            $str1="";
            $str = array(
                "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
                "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
                "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
                "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
                "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
                "3", "4", "5", "6", "7", "8", "9"
            );
            for ($i = 0; $i < $length; $i++) {
                $str1.= $str[mt_rand(0, 35)];
            }
            return $str1;
        }
        if (front::post('step') == '') {
            echo template_user('getpass.html');
        }
        else if (front::post('step') == '1') {
            if(config::get('verifycode') == 1) {
                if (!session::get('verify') || front::post('verify') <> session::get('verify')) {
                    alerterror(lang('verification_code'));
                    return;
                }
            }else if(config::get('verifycode') == 2){
                if (!verify::checkGee()) {
                    alerterror(lang('verification_code'));
                    return;
                }
            }

            if (strlen(front::post('username')) < 4) {
                alerterror(lang('user_name_is_too_short'));
                return;
            }
            $user = new user();
            $user = $user->getrow(array('username' => front::post('username')));
            $this->view->user = $user;
            session::set('answer', $user['answer']);
            session::set('username1', $user['username']);
            if(front::post('getpass_type')=="0"){  //校验邮箱的时候
                if($user['e_mail'] !=   front::post('getpass_email')){    //判断邮箱是否相同
                    echo '<script>alert("' .lang('mailbox_and_user_does_not_match'). '");window.location="index.php?case=user&act=getpass"</script>';
                    return;
                }
            }else{
                if($user['tel'] !=   front::post('getpass_tel')){    //判断手机号是否相同
                    echo '<script>alert("' .lang('tel_and_user_does_not_match'). '");window.location="index.php?case=user&act=getpass"</script>';

                    return;
                }
            }
            session::set('tel', $user['tel']);
            session::set('e_mail', $user['e_mail']);
            session::set('getpass_type',front::post('getpass_type'));
            if (!empty($user['answer'])) {      //安全问题
                echo template('getpass_1.html');
            } else {
                if(front::post('getpass_type')=="0"){  //是邮箱的时候
                        $password1 = randomstr(6);
                        $password = md5($password1);
                        $user = new user();
                        $user->rec_update(array('password' => $password), 'username="' . session::get('username1') . '"');
                        $this->sendmail(session::get('e_mail'), lang('member_retrieve_password'), ' ' . lang('respect') . session::get('username1') . ', ' . lang('hello_Your_new_password_is') . ':' . $password1 . ' ' . lang(您可以登录后到会员中心进行修改) . '!');
                        echo '<script>alert("' .lang('system_to_generate_the_password_has_been_sent_to_your_mailbox_jump_to_the_login_page') . '");window.location="index.php?case=user&act=login"</script>';
                }
                else{
                    $mobilenum = front::$post['mobilenum'];
                        $smsCode = new SmsCode();
                        if (!$smsCode->chkcode($mobilenum)) {
                            echo '<script>alert("' .lang('cell_phone_parity_error'). lang('backuppage'). '");window.location="index.php?case=user&act=getpass"</script>';
                            return;
                        }else{
                            echo template_user('getpass_newpass.html');
                        }
                }
            }
        }
        else if (front::post('step') == '2') {
            if (strlen(front::post('answer')) < 1) {
                echo '<script>alert("' . lang('please_enter_the_answer') . '");</script>';
                return;
            }
            if (front::post('answer') != session::get('answer')) {
                echo '<script>alert("' . lang('your_answer_is_wrong') . '");</script>';
                return;
            }
            if(front::post('getpass_type')=="0"){  //是邮箱的时候
                $password1 = randomstr(6);
                $password = md5($password1);
                $user = new user();
                $user->rec_update(array('password' => $password), 'username="' . session::get('username1') . '"');
                $this->sendmail(session::get('e_mail'), lang('member_retrieve_password'), ' ' . lang('respect') . session::get('username1') . ', ' . lang('hello_Your_new_password_is') . ':' . $password1 . ' ' . lang('您可以登录后到会员中心进行修改') . '!');
                echo '<script>alert("' .lang('system_to_generate_the_password_has_been_sent_to_your_mailbox,_jump_to_the_login_page') . '");window.location="index.php?case=user&act=login"</script>';
            }else{

            }
        }
        else if (front::post('step') == '3') {
            //修改密码
             $user = new user();
             $password = md5(front::post('newpassword'));
             $user->rec_update(array('password' => $password), 'username="' . session::get('username1') . '"');
            echo '<script>alert("' .lang('password_modification_success') . '");window.location="index.php?case=user&act=login"</script>';
        }
        exit;
    }

    function fckupload_action()
    {
        /*$uploads=array();
        if(is_array($_FILES)) {
            $upload=new upload();
            foreach($_FILES as $name=>$file) {
                $uploads[$name]=$upload->run($file);
            }
            $this->view->uploads=$uploads;
        }
        $this->render('../admin/system/fckupload.php');*/
        exit;
    }

    function fckuploadcheck_action()
    {
        if (empty($this->view->user) || !$this->view->user['userid'])
            throw new HttpErrorException(404,lang('page_does_not_exist'),404);
        fckuser::$user = $this->view->user;
        $this->end = false;
    }

    //下载记录
    function downlogin_action()
    {
        if (!$this->view->user['userid']) {
            alertinfo(lang('not_logged'), url::create('user/login'));
        }
        $this->view->data = downlogin::getInstance()->getrows(array("uid"=>$this->view->user['userid']),0,'id desc');

    }
    function deldownlogin_action()
    {
        if (!$this->view->user['userid']) {
            alertinfo(lang('not_logged'), url::create('user/login'));
        }
        if (front::get("id")) {
            downlogin::getInstance()->rec_delete(array("id"=>front::get("id"),"uid"=>$this->view->user['userid']));
        }
        front::redirect(url::create('user/downlogin'));
    }
    //服务器校验登陆
    function cmseaylogin_action(){
        $user=user::getInstance();
        $username = front::get('username');
        $password = md5(front::get('passwrod'));
        $data = array(
            'username' => $username,
            'password' => $password,
        );
        $user = $user->getrow($data);
        if (!is_array($user)) {
            $messagedata= array('static'=>'0','message'=>'登陆失败，账号密码错误！');
        }else{
            $messagedata= array('static'=>'1','message'=>'登陆成功！');
        }
        echo json_encode($messagedata);
        exit;
    }


    function end()
    {

        if (isset($this->end) && !$this->end) return;
        if (front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
