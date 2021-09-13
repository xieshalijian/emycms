<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class manage_act extends act
{
    protected $_table;

    function init()
    {
        $user = array();
        $guest = front::get('guest');
        $guestuser = array();
        $this->_user = new user;
        if ($guest == '1' && config::get('opguestadd')) {
            $guestuser = $user = array(
                'userid' => 0,
                'username' => 'Guest',
                'nickname' => lang('tourist'),
                'groupid' => 0,
                'checked' => 1,
                'intro' => 'Guest',
                'point' => '',
                'introducer' => '',
            );
        } else {
            $username = cookie::get('login_username');
            $password = cookie::get('login_password');
            if ($username != '' && $password != '') {
                $guestuser = $user = $this->_user->getrow(array('username' => $username));
                if (front::cookie_encode($user['password']) != $password) {
                    $guestuser = $user = array();
                }
            }
        }
        $this->view->guestuser = $guestuser;
        if (!$user && front::$act != 'login' && front::$act != 'register') front::redirect(url::create('user/login'));
        $this->view->user = $user;
        $this->table = front::get('manage');
        if ($this->table <> 'archive'
            && $this->table <> 'orders'
            && $this->table <> 'comment'
            && $this->table <> 'invite'
            && $this->table <> 'zanlog'
            && $this->table <> 'guestbook'
            && $this->table <> 'coupon'
            && $this->table <> 'user'
            && $this->table <> 'consumption'
            && $this->table <> 'xfconsumption'
            && $this->table <> 'notification'
            && $this->table <> 'user'
            && $this->table <> 'vhost'
            && $this->table <> 'invoice'
	        && $this->table <> 'appsauthority'
	        && $this->table <> 'applicationcase'
	        && $this->table <> 'usergroup'
        ) {
            throw new HttpErrorException(404,lang('page_does_not_exist'),404);
        }
        $this->_table = new $this->table;
        $this->_table->getFields();
        $this->view->form = $this->_table->get_form();
        $this->_pagesize = config::get('list_pagesize');
        $this->view->manage = $this->table;
        $this->view->primary_key = $this->_table->primary_key;
        if (!front::get('page')) front::$get['page'] = 1;
        $manage = 'table_' . $this->table;
        $this->manage = new $manage;
    }

    public function guestbooklist_action(){
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "username='" . front::$user['username'] . "'";
        $this->_view_table = $this->_table->getrows($where, $limit, '1 desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }


    function commentlist_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "username='" . front::$user['username'] . "'";
        $this->_view_table = $this->_table->getrows($where, $limit, 'adddate desc', $this->_table->getcols('manage'));
        $i = 0;
        $archive = archive::getInstance();
        if (is_array($this->_view_table) && !empty($this->_view_table)) {
            foreach ($this->_view_table as $arr) {
                $news = $archive->getrow($arr['aid']);
                $aurl = $archive->url($news);
                $this->_view_table[$i]['title'] = $news['title'];
                $this->_view_table[$i]['aurl'] = $aurl;
                unset($news);
                $i++;
            }
        }
        //var_dump($this->_view_table);
        $this->view->record_count = $this->_table->record_count;
    }

    function zanlist_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "uid='" . front::$user['userid'] . "'";
        $this->_view_table = $this->_table->getrows($where, $limit, 'addtime desc', $this->_table->getcols('manage'));
        $i = 0;
        $archive = archive::getInstance();
        if (is_array($this->_view_table) && !empty($this->_view_table)) {
            foreach ($this->_view_table as $arr) {
                $news = $archive->getrow($arr['aid']);
                $aurl = $archive->url($news);
                $this->_view_table[$i]['title'] = $news['title'];
                $this->_view_table[$i]['aurl'] = $aurl;
                unset($news);
                $i++;
            }
        }

        //var_dump($this->_view_table);
        $this->view->record_count = $this->_table->record_count;
    }

    //点赞列表
    function zanarchivelist_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = " praise LIKE '%" .session::get('username') . "%'";
        $this->_view_table = $this->_table->getrows($where, $limit, 'adddate desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }

    //已购买的内容
    function buyarchive_action()
    {
        $userdata=$this->_table->getrow("username='".session::get('username')."'");
        $array = explode(",",$userdata['buyarchive']);
        $data=array();  //已经购买的内容
        if(is_array($array)){
            foreach ($array as $val){
                $data[count($data)]=archive::getInstance()->getrow("aid='".$val."'");
            }
        }
        $this->_view_table = $this->pagedata($data,front::get('page'),config::get('manage_pagesize'));
        $this->view->record_count = count($array);
    }
    //分页
    function pagedata($data,$page,$size){
        $index=1;
        $returndata=array();
        if($page==1){
            foreach ($data as $key=>$val){
                if($index<=$size){
                    $returndata[$key]=$val;
                }
                $index++;
            }
        }else{
            foreach ($data as $key=>$val){
                if($index>($page-1)*$size && $index<=$page*$size){
                    $returndata[$key]=$val;
                }
                $index++;
            }
        }
        return $returndata;
    }
    //通知列表
    function notificationlist_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = " FIND_IN_SET('".user::getusersid()."',userid) ";
        $notificationdata=$this->_table->getrows($where, $limit, 'adddatatime desc', $this->_table->getcols('manage'));
        $notifiid=user::getnotifiid();
        if (is_array($notificationdata)){
            foreach ($notificationdata as $key=>$val){
               if ($notifiid != ''){
                   $source = explode(",",trim($notifiid));
                   for($index=0;$index<count($source);$index++){
                       if($source[$index]==$notificationdata[$key]['id']){
                           $notificationdata[$key]['isread']='1';
                       }
                   }
                   if (!$notificationdata[$key]['isread']){
                       $notificationdata[$key]['isread']='0';
                   }
               }else{
                   $notificationdata[$key]['isread']='0';
               }
            }
        }
        $this->_view_table = $notificationdata;
        $this->view->record_count = $this->_table->record_count;
   
    }

    //通知列表查看
    function notificationitem_action()
    {
        if (front::get('id')){
            $where="username='".session::get('username')."' and  (FIND_IN_SET('".front::get('id')."',notifiid)=false  OR notifiid IS NULL )";
            $userdata=user::getInstance()->getrow($where);
            //如果未读  改为已读
            if ($userdata){
                if($userdata['notifiid'] != ''){
                    $userdata['notifiid'].=','.front::get('id');
                }else{
                    $userdata['notifiid']=front::get('id');
                }
                user::getInstance()->rec_update(array('notifiid'=>$userdata['notifiid']), $userdata['userid']);
            }
            $where = " id=".front::get('id')." and FIND_IN_SET('".user::getusersid()."',userid) ";
            $notificationdata=$this->_table->getrows($where, 0, 'adddatatime desc', $this->_table->getcols('manage'));
            if (is_array($notificationdata)){
                $this->_view_table = $notificationdata;
            }
        }

    }
    //删除通知
    function notificationdelete_action()
    {
        $where = " FIND_IN_SET('".user::getusersid()."',userid)  and id=".front::get('id');
        $notificationdata=$this->_table->getrows($where, 1, 'adddatatime desc', $this->_table->getcols('manage'));
        if (is_array($notificationdata)){
            $newuserid='';
            $source = explode(",",trim($notificationdata[0]['userid']));
            for($index=0;$index<count($source);$index++){
                if($source[$index]==user::getusersid()){
                    continue;
                }
                if($index==0){
                    $newuserid=$source[$index];
                }else{
                    $newuserid.=','.$source[$index];
                }
            }
            if($newuserid==''){
                $delete = $this->_table->rec_delete(front::get('id'));
                if ($delete) {
                    front::flash("{$this->tname}".lang('delete').lang('success')."！");
                    event::log(lang('delete')."{$this->tname},ID=" . front::get('id'), lang('success'));
                }
            }else{
                $delete = $this->_table->rec_update(array('userid'=>$newuserid), front::get('id'));
                if ($delete) {
                    front::flash("{$this->tname}".lang('edit').lang('success')."！");
                    event::log(lang('edit')."{$this->tname},ID=" . front::get('id'), lang('success'));
                }
            }
        }

        front::redirect(url('manage/notificationlist/manage/notification'));

    }


    //模板管理 在线模板下载的商业模板，和  buy曾经购买的模板  免费模板不需要列出来了
    function templatelist_action(){
        $limit = ((front::get('page') - 1) * 10) . ',10';
        $where = " username='{$this->view->user['username']}' and buytype=1";
        $this->view->manage =front::get('manage');
        $appsdate= $this->_table->getrows($where, $limit, 'id desc', $this->_table->getcols('manage'));
        $appsdatetemplate=array();
        if(is_array($appsdate)){
            foreach ($appsdate as $value){
                $buytemplatedata=buytemplate::getInstance()->getrow("code='".$value['buyid']."'");
                if(is_array($buytemplatedata)){
                    //只显示商业版和付费的 模板
                    if($buytemplatedata['iscorp']  || $buytemplatedata['price']>0){
                        $buytemplatedata['buyip']=$value['buyip'];
                        $appsdatetemplate[count($appsdatetemplate)]=$buytemplatedata;
                    }
                }

            }
        }
        $this->_view_table =$appsdatetemplate;
        $this->view->record_count = count($appsdatetemplate);
    }

    function invitelist_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "ctname='" . front::$user['username'] . "'";
        $this->_view_table = $this->_table->getrows($where, $limit, '1 desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }

    function list_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "userid={$this->view->user['userid']}";
        $where .= ' and ' . $this->_table->get_where('user_manage');
        if(front::get('needcheck')!=''){
            $this->view->needcheck=front::get('needcheck');
        }
        if($this->table=='archive'){
            $where .=" and langid=".lang::getlangid(lang::getistemplate());
        }
        //var_dump($where);
        $this->_view_table = $this->_table->getrows($where, $limit, '1 desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }
    function guestlist_action()
    {
        echo '<script type="text/javascript">
		alert("' . lang('submit_complete_wait_for_audit') . '");
		window.location.href="' . url::create('/manage/guestadd/manage/archive/guest/1') . '";
		</script>';
    }

    function orderslist_action()
    {
        include_once ROOT . '/lib/plugins/pay/wxscanpay.php';
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "mid={$this->view->user['userid']}";
        if(front::get('type') == 'buy'){
            $where=$where.' and status=0 ';
        }
        else if(front::get('type') == 'shou') {
            $where=$where.' and status=1 ';
        }
        else if(front::get('type') == 'refund') {
            $where=$where.' and (status=6 || status=7 || status=8) ';
        }
        $this->view->type=front::get('type');
        $this->_view_table = $this->_table->getrows($where, $limit, 'adddate desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }

    function vhostlist_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "uid={$this->cur_user['userid']}";
        $this->view->type=front::get('type');
        if($this->view->type == 'trial'){
            $where .= " AND status='trial'";
        }
        if($this->view->type == 'buy'){
            $where .= " AND status='normal'";
        }
        $this->_view_table = $this->_table->getrows($where, $limit, 'addtime desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }

    //查询优惠劵
    function couponlist_action()
    {
        if (!config::get('coupon_show')){
            front::alert(lang('preferential_offer').lang('function').lang('no_oprn'));
        }
        if(session::get('ver') != 'corp'){
            front::alert(lang('unauthorized_access'));
        }
        $langid=lang::getlangid(lang::getistemplate());  //获取当前前台语言ID
        //all查询兑换优惠劵   usable查询可用优惠劵 used已用优惠券  old过期优惠券
        if (front::get('statu')=='all') {
            $limit = ((front::get('page') - 1) * 20) . ',20';
            $where = "isexchange =1 and statu=1 and overduedate >= NOW() and langid='".$langid."'";
            $this->_view_table = $this->_table->getrows($where, $limit, 'adddatatime desc', $this->_table->getcols('manage'));
            $this->view->usable ='all' ;
        }
        else if (front::get('statu')=='usable') {
            $user = new user();
            $couponidnum=$user->getcouponidnum();
            $usercoupondataarry=array();
            if($couponidnum != ''){
                $source = explode(",",trim($couponidnum));
                for($index=0;$index<count($source);$index++){
                    $sourcearry=explode(":",trim($source[$index]));
                    $where = " couponid=".$sourcearry[0]." and langid='".lang::getlangid(lang::getistemplate())."'";
                    $cols = '*,'.$sourcearry[1].' as usableusernum';
                    $usercoupondata = $this->_table->getrows($where, 1, 'adddatatime desc',$cols);
                    if($usercoupondata[0]['statu']=='1'
                        && strtotime($usercoupondata[0]['overduedate']) >= strtotime(date("y-m-d"))
                        &&  $usercoupondata[0]['usableusernum'] > 0) {
                        $usercoupondataarry[count($usercoupondataarry)] = $usercoupondata[0];
                    }
                }
            }
            $this->_view_table =$usercoupondataarry ;
            $this->view->usable ='usableusernum' ;
        }
        else if (front::get('statu')=='used') {
                $user = new user();
                $couponidnum=$user->getcouponidnum();
                $usercoupondataarry=array();
                if($couponidnum != ''){
                    $source = explode(",",trim($couponidnum));
                    for($index=0;$index<count($source);$index++){
                        $sourcearry=explode(":",trim($source[$index]));
                        if( $sourcearry[2] > 0){
                            $where = "statu=1 and couponid=".$sourcearry[0] ." and langid='".$langid."'";
                            $cols = '*,'.$sourcearry[2].' as usedusernum';
                            $usercoupondata = $this->_table->getrows($where, 1, 'adddatatime desc',$cols);
                            if(is_array($usercoupondata) && count($usercoupondata)>0)
                            $usercoupondataarry[count($usercoupondataarry)]=$usercoupondata[0];
                        }
                    }
                }
                $this->_view_table =$usercoupondataarry ;
                 $this->view->usable ='usedusernum' ;
         }
        else if (front::get('statu')=='old') {
            $user = new user();
            $couponidnum=$user->getcouponidnum();
            $usercoupondataarry=array();
            if($couponidnum != ''){
                $source = explode(",",trim($couponidnum));
                for($index=0;$index<count($source);$index++){
                    $sourcearry=explode(":",trim($source[$index]));
                    $where = " couponid=".$sourcearry[0] ." and langid='".$langid."'";;
                    $cols = '*,'.$sourcearry[1].' as oldusernum';
                    $usercoupondata = $this->_table->getrows($where, 1, 'adddatatime desc',$cols);
                   if(is_array($usercoupondata) && count($usercoupondata)>0)
                    if($usercoupondata[0]['statu']=='0'
                        || strtotime($usercoupondata[0]['overduedate'])<strtotime(date("y-m-d"))){
                      $usercoupondataarry[count($usercoupondataarry)]=$usercoupondata[0];
                    }
                }
            }
            $this->_view_table =$usercoupondataarry ;
            $this->view->usable ='oldusernum' ;
        }
        $this->view->record_count = $this->_table->record_count;
    }

    //用户组积分查询
    function usergrouplist_action()
    {
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "isadministrator='0' ";
        $usergroupdata=$this->_table->getrows($where, $limit, '', $this->_table->getcols('manage'));
        $this->_view_table = $usergroupdata;
        $this->view->record_count = $this->_table->record_count;
    }
    //我的收藏
    function collectlist_action()
    {
        if(session::get('ver') != 'corp'){
            front::alert(lang('unauthorized_access'));
        }
        $limit = ((front::get('page') - 1) * 20) . ',20';
        $where = "username='".session::get('username')."'";
        $collectaarry=array();
        $archive=new archive();
        $collectdata=$this->_table->getrows($where, $limit, '', $this->_table->getcols('manage'));
        if($collectdata[0]['collect'] !=''){
            if( strpos($collectdata[0]['collect'], ',') !== false){
                $source = explode(",",trim($collectdata[0]['collect']));
                for($index=0;$index<count($source);$index++){
                    $collect_array = explode(':',$source[$index]);
                    $where='aid='.$collect_array[0];
                    $where.=' and  checked=1';
                    $archivearray=$archive->getrows($where, 1, '', '*');
                    if(count($archivearray)>0){
                        $collectaarry[count($collectaarry)]=$archivearray[0];
                    }
                }
            }else{
                $collect_array = explode(':',$collectdata[0]['collect']);
                $where='aid='.$collect_array[0];
                $where.=' and  checked=1';
                $archivearray=$archive->getrows($where, 1, '', '*');
                if(count($archivearray)>0){
                    $collectaarry[count($collectaarry)]=$archivearray[0];
                }

            }
        }
        $this->_view_table = $collectaarry;
        $this->view->record_count = $this->_table->record_count;
    }

    //兑换用优惠劵
    function editcoupon_action(){
        if(front::get('couponid')){
            //查询优惠卷
            $where = "isexchange =1 and statu=1 and couponid=".front::get('couponid');
            $coupondata= $this->_table->getrows($where, 1, 'adddatatime desc', $this->_table->getcols('manage'));
            //查询用户
            $user = new user();
            //剩余积分
            if( (int)($coupondata[0]['exchangepoints'])!=0 && (((int)($coupondata[0]['exchangepoints']) > (int)($user->getintegration())) || ($user->getintegration()==0))){
                exit(lang('insufficient_points_exchange_failure'));
            }else if($coupondata[0]['quantity']==0){
                exit(lang('not_enough_discount_tickets_wait_for_the_next_activity'));
            }else{
                //减少积分
                $user->editintegration($coupondata[0]['exchangepoints']);
                //修改用户的优惠劵
                $user->setcouponidnum($coupondata[0]['couponid']);
                //修改优惠卷剩余数量
                $coupondata[0]['quantity']=(int)($coupondata[0]['quantity'])-1;
                $coupondata[0]['usedquantity']=(int)($coupondata[0]['usedquantity'])+1;
                $this->_table->rec_update($coupondata[0], $where);
                echo lang('exchange_success');
            }
        }else{
            echo '';
        }
        exit;
    }

    //充值 消费记录  主机续费记录
    function consumptionlist_action()
    {
        $limit = ((front::get('page') - 1) * 10) . ',10';
        $where = "mid={$this->view->user['userid']}";
        if (front::get('xftype')){
            $where.= " and xftype=".front::get('xftype');
        }
        $this->view->manage =front::get('manage');
        $this->_view_table = $this->_table->getrows($where, $limit, 'adddate desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;


    }
    //主机续费记录
    function vhostconsumptionlist_action()
    {
        $limit = ((front::get('page') - 1) * 10) . ',10';
        $where = "mid={$this->view->user['userid']}";
        if (front::get('xftype')){
            $where.= " and xftype=".front::get('xftype');
        }
        $this->view->manage =front::get('manage');
        $this->_view_table = $this->_table->getrows($where, $limit, 'adddate desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }

    function add_action()
    {
        if (front::post('submit') && $this->manage->vaild()) {

            $this->manage->filter();
            $this->manage->save_before();
            front::$post['checked'] = 0;
            front::$post['userid'] = $this->view->user['userid'];
            front::$post['username'] = $this->view->user['username'];
            front::$post['author'] = $this->view->user['username'];
            front::$post['adddate'] = date('Y-m-d H:i:s',time());
            front::$post['ip'] = front::ip();
            //增加语言标签
            if($this->table=='archive' && front::$post['langid']==''){
                front::$post['langid']=lang::getlangid(lang::getistemplate());
            }
            $data = array();
            $fieldlimit = $this->_table->getcols(front::$act == 'list' ? 'user_manage' : 'user_modify');
            $fieldlimits = explode(',', $fieldlimit);
            foreach (front::$post as $key => $value) {
                if (preg_match('/(select|union|and|load_file)/i', $value)) {
                    //echo $value;
                    exit(lang('illegal_parameter'));
                }
                if (in_array($key, $fieldlimits))
                    $data[$key] = $value;

            }


            $data = array_merge($data, front::$post);
            unset($data['template']);
            $insert = $this->_table->rec_insert($data);
            if ($insert < 1) {
                front::flash(lang('record_add_failed'));
            } else {
                front::flash(lang('record_add_success'));
                if ($this->table == 'archive')
                    front::redirect(url::create('/manage/list/manage/archive/needcheck/1'));
            }
        }
        chkpwf('add_archive', $this->view->user['groupid']);
        //echo 11;
        $this->_view_table = $this->_table->getrow(null, '1 desc',  $this->_table->getcols('user_modify'));
        $this->_view_table['data'] = array();
    }

    function guestadd_action()
    {
        //var_dump($this->view->guestuser);
        if ($this->view->guestuser['userid']) {
            echo '<script type="text/javascript">
		alert("' . lang('jump_to_member_release_page') . '");
		window.location.href="' . url::create('/manage/add/manage/archive') . '";
		</script>';
        }
        if (front::post('submit') && $this->manage->vaild()) {
            $this->manage->filter();
            $this->manage->save_before();
            //front::$post['title']=addslashes(front::$post['title']);
            front::$post['checked'] = 0;
            front::$post['userid'] = '-999';
            front::$post['username'] = 'guest';
            front::$post['author'] = 'guest';
            front::$post['adddate'] = date('Y-m-d H:i:s');
            front::$post['ip'] = front::ip();
            $data = array();
            $fieldlimit = $this->_table->getcols(front::$act == 'list' ? 'user_manage' : 'user_modify');
            $fieldlimits = explode(',', $fieldlimit);
            foreach (front::$post as $key => $value) {
                if (in_array($key, $fieldlimits))
                    $data[$key] = $value;
            }
            $data = array_merge($data, front::$post);
            $insert = $this->_table->rec_insert($data);
            if ($insert < 1) {
                front::flash(lang('record_add_failed'));
            } else {
                front::flash(lang('record_add_success'));
                if ($this->table == 'archive')
                    front::redirect(url::create('/manage/guestlist/manage/archive/needcheck/1/guest/1'));
            }
        }
        //$this->_view_table = $this->_table->getrow(null);
        $this->_view_table['data'] = array();
    }

    function edit_action()
    {
        $from = front::$from;
        front::check_type(front::get('id'));
        $this->manage->filter();
        $info = $this->_table->getrow(front::get('id'));
        if ($info['userid'] != $this->view->user['userid']) {
            front::flash(lang('record_change_failed_reason_unauthorized'));
            front::refUrl($from);
            //header("Location: " . $from, TRUE, 302);
            exit;
        }
        if ($info['checked']) {
            front::flash(lang('record_change_failed_reason_it_has_passed_the_audit'));
            front::refUrl($from);
            exit;
        }

        if (front::post('submit') && $this->manage->vaild()) {
            $this->manage->save_before();
            $data = array();
            $fieldlimit = $this->_table->getcols(front::$act == 'list' ? 'user_manage' : 'user_modify');
            //var_dump($fieldlimit);
            $fieldlimits = explode(',', $fieldlimit);
            foreach (front::$post as $key => $value) {
                if (preg_match('/(select|union|and|\'|"|\))/i', $value)) {
                    exit(lang('illegal_parameter'));
                }
                if (in_array($key, $fieldlimits))
                    $data[$key] = $value;
            }
            //var_dump($data);exit;
            $update = $this->_table->rec_update($data, front::get('id'));
            if ($update < 1) {
                front::flash(lang('record_add_failed'));
            } else {
                front::flash(lang('record_add_success'));
                $from = session::get('from');
                session::del('from');
                header("Location: " . $from, TRUE, 302);
                exit;
            }
        }
        if (!session::get('from')) session::set('from', front::$from);
        $this->_view_table = $this->_table->getrow(front::get('id'), '1', $this->_table->getcols('modify'));
    }

    function delete_action()
    {
        front::check_type(front::get('id'));
        $row = $this->_table->getrow(array('id' => front::get('id')));
        if ($row['mid'] != $this->view->user['userid']) {
            exit('no_permission');
        }
        $delete = $this->_table->rec_delete(front::get('id'));
        if ($delete) front::flash(lang('delete') . lang('success'));
        front::redirect(url::modify('act/list/manage/' . $this->table));
    }

    function view($table)
    {
        $this->view->data = $table['data'];
        $this->view->field = $table['field'];
    }

    //插件
    function buyapps_action()
    {
        $userdata=user::getInstance()->getrow(array("username"=>session::get("username")));
        $this->view->userdata=$userdata;
        $discount =usergroup::getusergrop(user::getuserid());
        $this->view->discount=$discount;

        $appsdate= apps::getInstance()->getrows("static=1", 0);
        if(front::post('submit') && front::post('search_coded')){ //搜索条件
            foreach ($appsdate as $key=>$vaule){
                if(strpos($vaule['id'],front::post('search_coded')) === false){
                    unset($appsdate[$key]);
                }
            }
        }
        if(front::$get['type']=="free"){    //���
            foreach ($appsdate as $key=>$val){
                if($val["price"]>0){
                    unset($appsdate[$key]);
                }
            }
        }
        else if(front::$get['type']=="corp"){  //��ҵ��
            foreach ($appsdate as $key=>$val){
                if(!$val["iscorp"]){
                    unset($appsdate[$key]);
                }
            }
        }
        else if(front::$get['type']=="likemenoy"){  //�շ�
            foreach ($appsdate as $key=>$val){
                if($val["price"]<=0){
                    unset($appsdate[$key]);
                }
            }
        }
        else if(front::$get['type']=="mybuyapps"){   //�Ƿ���
            foreach ($appsdate as $key=>$val){
                $appsauthoritybuy=appsauthority::getInstance()->getrow(array("username"=>$userdata["username"],"buyid"=>$val['id']));
                if(!is_array($appsauthoritybuy)){
                    unset($appsdate[$key]);
                }
            }
        }
        else{
            foreach ($appsdate as $key=>$val){
                if($val["isbuy"]){   //�Ѿ�����Ĳ���ʾ
                    unset($appsdate[$key]);
                }
            }
        }
        $this->view->appsdate=$this->pagedatas($appsdate,front::$get['page'],$this->_pagesize);
        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($appsdate);

        //��ȡ�Ѿ�����Ĳ��
        $returndata=array();
        if (!is_array($userdata)) {
            $returndata['static']=0;
            $returndata["message"]=lang('login_failure');  //��½ʧ��
            $returndata["modeldata"]="";
            $returndata["appsdata"]="";
        }
        else{
            $appsauthoritydata=appsauthority::getInstance()->getrows(array("username"=>session::get("username")),0);
            $modeldata=array();  //����ģ��
            $appsdata=array();  //���
            if(is_array($appsauthoritydata)){
                foreach ($appsauthoritydata as $key=>$val){
                        $appsdata[$key]=$val;
                }
            }
            $returndata['static']=1;
            $returndata["message"]="";  //��½�ɹ�
            $returndata["message"]="";  //��½�ɹ�
            $returndata["modeldata"]=$modeldata;
            $returndata["appsdata"]=$appsdata;
            $returndata["userdata"]=$userdata;
        }
        $this->view->returndata=$this->_view_table=$returndata;
    }

    //在线模板
    function buytemplate_action(){
        $userdata=user::getInstance()->getrow(array("username"=>session::get("username")));
        $this->view->userdata=$userdata;
        $discount =usergroup::getusergrop(user::getuserid());
        $this->view->discount=$discount;

        //��ȡ������������ģ���б�
        $data=buytemplate::getInstance()->getrows("static=1",0);
        if(front::$get['type']=="free"){    //���
            foreach ($data as $key=>$val){
                if($val["price"]>0){
                    unset($data[$key]);
                }
            }
        }else if(front::$get['type']=="corp"){  //��ҵ��
            foreach ($data as $key=>$val){
                if(!$val["iscorp"]){
                    unset($data[$key]);
                }
            }
        }else if(front::$get['type']=="likemenoy"){  //�շ�
            foreach ($data as $key=>$val){
                if($val["price"]<=0){
                    unset($data[$key]);
                }
            }
        }
        if(front::$get['type']=="mybuyapps"){   //�Ƿ���
            foreach ($data as $key=>$val){
                $appsauthoritybuy=appsauthority::getInstance()->getrow(array("username"=>session::get("username"),"buyid"=>$val['code']));
                if(!$appsauthoritybuy){
                    unset($data[$key]);
                }
            }
        }else{
            foreach ($data as $key=>$val){
                if($val["isbuy"]){   //�Ѿ�����Ĳ���ʾ
                    unset($data[$key]);
                }
            }
        }

        if(front::post('submit') && front::post('search_coded')){ //搜索条件
            foreach ($data as $key=>$vaule){
                if(strpos($vaule['code'],front::post('search_coded')) === false){
                    unset($data[$key]);
                }
            }
        }
        $this->view->appsdate=$this->pagedatas($data,front::$get['page'],$this->_pagesize);
        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($data);


        //��ȡ�Ѿ�����Ĳ��
        $returndata=array();
        if (!is_array($userdata)) {
            $returndata['static']=0;
            $returndata["message"]=lang('login_failure');  //��½ʧ��
            $returndata["modeldata"]="";
            $returndata["appsdata"]="";
        }else{
            $appsauthoritydata=appsauthority::getInstance()->getrows(array("username"=>session::get("username")),0);
            $modeldata=array();  //����ģ��
            $appsdata=array();  //���
            if(is_array($appsauthoritydata)){
                foreach ($appsauthoritydata as $key=>$val){
                    if($val['buytype']==1){
                        $modeldata[$key]=$val;
                    }elseif($val['buytype']==2){
                        $appsdata[$key]=$val;
                    }
                }
            }
            $returndata['static']=1;
            $returndata["message"]="";  //��½�ɹ�
            $returndata["message"]="";  //��½�ɹ�
            $returndata["modeldata"]=$modeldata;
            $returndata["appsdata"]=$appsdata;
            $returndata["userdata"]=$userdata;
        }
        $this->view->returndata=$this->_view_table=$returndata;


        //加载购物车的
        $oreders_c = cookie::get('ce_buytemplateorders_cookie');
        $oreders_c = base64_decode($oreders_c);
        $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
        $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
        $orderid =unserialize($oreders_c);
        $buytemplateorder=array();
        if(is_array($orderid)){
            foreach ($orderid as $key=>$val){
                $buytemplateorder[]=$val['aid'];
            }
        }
        $this->view->buytemplateorder=$buytemplateorder;
    }

    //组件市场
    function usermodules_action(){
        $userdata=user::getInstance()->getrow(array("username"=>session::get("username")));
        $this->view->userdata=$userdata;
        $discount =usergroup::getusergrop(user::getuserid());
        $this->view->discount=$discount;

        $data=buymodules::getInstance()->getrows("static=1",0);
        if(front::$get['type']=="free"){
            foreach ($data as $key=>$val){
                if($val["price"]>0){
                    unset($data[$key]);
                }
            }
        }else if(front::$get['type']=="corp"){
            foreach ($data as $key=>$val){
                if(!$val["iscorp"]){
                    unset($data[$key]);
                }
            }
        }else if(front::$get['type']=="likemenoy"){
            foreach ($data as $key=>$val){
                if($val["price"]<=0){
                    unset($data[$key]);
                }
            }
        }
        else if(front::$get['type']=="mybuyapps"){
            foreach ($data as $key=>$val){
                $appsauthoritybuy=appsauthority::getInstance()->getrow(array("username"=>session::get("username"),"buyid"=>$val['code']));
                if(!$appsauthoritybuy){
                    unset($data[$key]);
                }
            }
        }
        //组件分类
        if (front::$get['modulestype']!="" && front::$get['modulestype']!="all"){
            foreach ($data as $key=>$val){
                if($val["type"]!=front::$get['modulestype']){
                    unset($data[$key]);
                }
            }
        }

        if(front::post('submit') && front::post('search_coded')){ //搜索条件
            foreach ($data as $key=>$vaule){
                if(strpos($vaule['code'],front::post('search_coded')) === false){
                    unset($data[$key]);
                }
            }
        }
        $this->view->appsdate=$this->pagedatas($data,front::$get['page'],$this->_pagesize);
        $this->view->pagesize=$this->_pagesize;
        $this->view->page=front::$get['page'];
        $this->view->allsize=count($data);

        //��ȡ�Ѿ�����Ĳ��
        $returndata=array();
        if (!is_array($userdata)) {
            $returndata['static']=0;
            $returndata["message"]=lang('login_failure');  //��½ʧ��
            $returndata["modeldata"]="";
            $returndata["appsdata"]="";
            $returndata["modulesdata"]="";
        }else{
            $appsauthoritydata=appsauthority::getInstance()->getrows(array("username"=>session::get("username")),0);
            $modeldata=array();
            $appsdata=array();
            $modulesdata=array();
            if(is_array($appsauthoritydata)){
                foreach ($appsauthoritydata as $key=>$val){
                    if($val['buytype']==1){     //buytype 1模板 2插件  3组件
                        $modeldata[$key]=$val;
                    }elseif($val['buytype']==2){
                        $appsdata[$key]=$val;
                    }elseif($val['buytype']==3){
                        $modulesdata[$key]=$val;
                    }
                }
            }
            $returndata['static']=1;
            $returndata["message"]="";
            $returndata["modeldata"]=$modeldata;
            $returndata["appsdata"]=$appsdata;
            $returndata["userdata"]=$userdata;
            $returndata["modulesdata"]=$modulesdata;
        }
        $this->view->returndata=$this->_view_table=$returndata;

        //加载购物车的
        $oreders_c = cookie::get('ce_buymodulesorders_cookie');
        $oreders_c = base64_decode($oreders_c);
        $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
        $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
        $orderid =unserialize($oreders_c);
        $buymodulesorder=array();
        if(is_array($orderid)){
            foreach ($orderid as $key=>$val){
                $buymodulesorder[]=$val['aid'];
            }
        }
        $this->view->buymodulesorder=$buymodulesorder;
    }

    function pagedatas($data,$page,$size){
        $index=1;
        $returndata=array();
        if($page==1){
            foreach ($data as $key=>$val){
                if($index<=$size){
                    $returndata[$key]=$val;
                }
                $index++;
            }
        }else{
            foreach ($data as $key=>$val){
                if($index>($page-1)*$size && $index<=$page*$size){
                    $returndata[$key]=$val;
                }
                $index++;
            }
        }
        return $returndata;
    }

    //申请案例
    function applicationcase_action(){
        if(front::post('submit')){
            //案例时间间隔
            $datadata=$this->_table->getrow("mid='".user::getusersid()."'","id desc");
            if (is_array($datadata)){
                $thisdata=date('Y-m-d h:i:s', time());
                $oldadddate=date('Y-m-d h:i:s', $datadata['adddate']);
                $newdata=floor((strtotime($thisdata)-strtotime($oldadddate))%86400);
                if($newdata<5*60){
                    echo '<script type="text/javascript">
                alert("' .lang('applicationcase_5_time') . '");
                window.location.href="' . url('user/index') . '";
                </script>';
                    exit;
                }
            }

            //案例申请时间
            front::$post['adddate'] = time();
            front::$post['mid'] = user::getusersid();
            $insert = $this->_table->rec_insert(front::$post);
            if ($insert < 1) {
                front::flash(lang('invoice_failure'));
            }
            else {
                front::flash(lang('invoice_success'));
                front::redirect(url('user/index'));
            }
        }
        $this->_view_table = array();
    }


    //内容列表
    function archivelist_action()
    {
        $limit = ((front::get('page') - 1) * $this->_pagesize) . ','.$this->_pagesize;
        $archive_where="1=1 ";
        if (front::post("archivelist_title") || front::post("archivelist_code") || front::get("archivewhere")){
            if (front::post("archivelist_title")){
                session::set("archivelist_title",front::post("archivelist_title"));
            }
            if (front::post("archivelist_code")){
                session::set("archivelist_code",front::post("archivelist_code"));
            }
            $typeid=0;
            if (session::get("archivelist_title") && file_exists(ROOT."/lib/table/type.php")){
                $type_where="typename like '%".session::get("archivelist_title")."%'";
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


            if ($typeid){
                $archive_where.="and typeid in (".$typeid.")";
            }
            if (session::get("archivelist_code"))$archive_where.=" and  title like '%".session::get("archivelist_code")."%'";

        }else{
            session::del("archivelist_title");
            session::del("archivelist_code");
        }
        $categories = array();
        $categories = category::getInstance()->sons(3);
        $categories[] = 3;
        $archive_where.=' and catid in (' . implode(',', $categories) . ') and checked=1';
        $arc_data=$this->_table->getrows($archive_where, $limit, 'aid desc');


        $this->_view_table = $arc_data;
        $this->view->record_count = $this->_table->record_count;

    }


    function end()
    {
        if (!isset($this->_view_table)) return;
        if (!isset($this->_view_table['data']))
            $this->_view_table['data'] = $this->_view_table;
        $this->_view_table['field'] = $this->_table->getFields();
        $this->view->fieldlimit = $this->_table->getcols(front::$act == 'list' ? 'user_manage' : 'user_modify');
        $this->view($this->_view_table);
        manage_form::manage($this);
        if (front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
