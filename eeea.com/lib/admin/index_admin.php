<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class index_admin extends admin {
    function init() {
    }
    function index_action() {
        $this->check_pw();
        session::del('mod');
        $tbpre = config::getdatabase('database','prefix');
        $user = new user();
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}archive` where ((attr2 = '') or (attr2 is NULL)) and langid=".lang::getlangid(lang::getisadmin());
        $row = $user->rec_query_one($sql);
        $this->view->archivenum = $row['rec_sum'];
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}archive` where attr2 <> '' and langid=".lang::getlangid(lang::getisadmin());
        $row = $user->rec_query_one($sql);
        $this->view->shoppingnum = $row['rec_sum'];
        $sql = "SELECT value FROM `{$tbpre}settings` WHERE tag='table-hottag'";
        $row = $user->rec_query_one($sql);
        $tmp =isset($row['value'])?unserialize($row['value']):'';
        $tmp = isset($tmp['hottag'])?explode("\n", $tmp['hottag']):array("");
        $this->view->tagnum = count($tmp);
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}a_comment`";
        $row = $user->rec_query_one($sql);
        $this->view->commentnum = $row['rec_sum'];
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}archive` WHERE checked = 0";
        $row = $user->rec_query_one($sql);
        $this->view->unchecknum = $row['rec_sum'];


        //提取留言
        if(file_exists(ROOT."/lib/table/guestbook.php")) {
            $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}guestbook`";
            $row = $user->rec_query_one($sql);
            $this->view->guestbooknum = $row['rec_sum'];
        }
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}b_category` where isshopping=0";
        $row = $user->rec_query_one($sql);
        $this->view->categorynum = $row['rec_sum'];
        $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}announcement`";
        $row = $user->rec_query_one($sql);
        $this->view->announcementnum = $row['rec_sum'];
        //提取商品
        if(file_exists(ROOT."/lib/table/shopping.php")) {
            $sql = "SELECT count(1) as rec_sum FROM `{$tbpre}p_orders`";
            $row = $user->rec_query_one($sql);
            $this->view->ordernum = $row['rec_sum'];
            $this->view->dbversion = $user->verison();
            //销售量  本日和前六天的销售订单数量
            $sql = "SELECT COUNT(*) as rec_sum FROM `{$tbpre}p_orders`  WHERE DATE_SUB(CURDATE(), INTERVAL 0 DAY) <=  FROM_UNIXTIME(ADDDATE) AND STATUS<>'0' ";
            $row = $user->rec_query_one($sql);
            $thisdaynum= $row['rec_sum'];
            for ($index=1;$index<7;$index++){
                $sql = "SELECT COUNT(*) as rec_sum FROM `{$tbpre}p_orders`  WHERE DATE_SUB(CURDATE(), INTERVAL ".$index." DAY) <=  FROM_UNIXTIME(ADDDATE) AND FROM_UNIXTIME(ADDDATE)<DATE_SUB(CURDATE(), INTERVAL ".($index-1)." DAY) AND STATUS<>'0'";
                $row = $user->rec_query_one($sql);
                $thisdaynum= $row['rec_sum'].','.$thisdaynum;
            }
            $this->view->thisdaynum=$thisdaynum;
            $ordersdata = orders::getInstance()->getrows('status=1', 10, 'adddate desc ');
            $this->view->ordersdata = $ordersdata;

            //订单统计  完成和未完成 代付款  和已发货
            $sql = "SELECT COUNT(*) as rec_sum FROM `{$tbpre}p_orders` WHERE STATUS = '3'  ";
            $row = $user->rec_query_one($sql);
            $overnum = $row['rec_sum'];
            $sql = "SELECT COUNT(*)  as rec_sum FROM `{$tbpre}p_orders` WHERE STATUS = '0' ";
            $row = $user->rec_query_one($sql);
            $noovernum = $row['rec_sum'];
            $sql = "SELECT COUNT(*)  as rec_sum FROM `{$tbpre}p_orders` WHERE STATUS = '2' ";
            $row = $user->rec_query_one($sql);
            $fahuonum = $row['rec_sum'];
            $sql = "SELECT COUNT(*)  as rec_sum FROM `{$tbpre}p_orders` WHERE STATUS = '1' ";
            $row = $user->rec_query_one($sql);
            $chulinum = $row['rec_sum'];
            if (front::get('gotoinurl')) {
                $this->view->gotoinurl = url(front::get('gotoinurl'), true);
            }
            //总数
            $toolnum = $overnum + $noovernum + $fahuonum + $chulinum;
            $this->view->overnum = ($overnum > 0 && $toolnum > 0) > 0 ? round($overnum / $toolnum, 2) * 100 : 0;
            $this->view->noovernum = ($noovernum > 0 && $toolnum > 0) ? round($noovernum / $toolnum, 2) * 100 : 0;
            $this->view->fahuonum = ($fahuonum > 0 && $toolnum > 0) > 0 ? round($fahuonum / $toolnum, 2) * 100 : 0;
            $this->view->chulinum = ($chulinum > 0 && $toolnum > 0) > 0 ? round($chulinum / $toolnum, 2) * 100 : 0;

        }

        //是否存在可视化目录
        $this->view->isvisual=file_exists(ROOT."/data/template/".myconfig::get('template_dir')."/index/index.html");
    }
    function hotsearch_action() {
        chkpw('archive_hotsearch');
        $path=ROOT.'/data/hotsearch_'.lang::getisadmin();
        if (is_dir($path) == false) {
            mkdir($path, 0777);
        }
    }
    function thank_action() {
    }
    function sidebar_action() {
    }
    function hotdel_action(){
        $key = front::get('key');
        $file = ROOT.'/data/hotsearch/'.urlencode($key).'.txt';
        $isexists = file_exists($file);
        if($isexists){
            @unlink($file);
        }
        front::redirect(url('index/hotsearch'));
    }
    function logout_action() {
        // 清空浏览器记录 全改为  未选择状态
        history::getInstance()->rec_update("static=0","userid=".user::getusersid());
        cookie::del('login_username');
        cookie::del('login_password');
        session::del('username');
        session::del('roles');
        session::set("logintime",0);
        front::redirect(url::create('index'));
    }
    function profile_action(){
        $user = new user();
        if (front::post('submit')) {
            $table_user = new table_user();
            $table_user->filter(false);
            $table_user->edit_before();
            $table_user->save_before();
            if (!Phpox_token::is_token('user_add', front::$post['token'])) {
                exit(lang_admin('token_error'));
            }
            unset(front::$post['groupid']);
            $user->rec_update(front::$post, $this->cur_user['userid']);
            alertinfo(lang_admin('modify_data_successfully'),url('index/profile'));
        }
        $this->view->field = $user->getFields();
        $this->view->form = $user->get_form();
        $this->view->data = $user->getrow(array('userid'=>$this->cur_user['userid']));
        $this->view->token = Phpox_token::grante_token('user_add');
    }
    function end() {

        if (front::get("act")=="index" || front::get("act")==""){
            $this->render('index.php');
            exit;
        }
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
