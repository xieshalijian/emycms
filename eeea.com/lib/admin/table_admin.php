<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

class   table_admin extends admin
{
    protected $_table;

    function init()
    {
        //strpos(front::get('tagfrom'),'shop') !== false
        if (front::get('tagfrom')=='shopcontent' || front::post('tagfrom')=='shopcontent'
         || front::get('tagfrom')=='shopcategory'|| front::post('tagfrom')=='shopcategory'
         || front::get('tagfrom')=='shopspecial'|| front::post('tagfrom')=='shopspecial'
         || front::get('tagfrom')=='shoptype'|| front::post('tagfrom')=='shoptype'){
            $this->table ='shoptemplatetag';
        }else{
            $this->table = front::get('table');
        }
        if (preg_match('/^my_/', $this->table)) {
            //form_admin::init();
            $this->_table = new defind($this->table);
        } else
            $this->_table = new $this->table;
        $this->_table->getFields();

        if (front::get('act')== 'delete' || front::get('act')== 'batch'|| front::get('act')== 'newadd' || front::get('act')== 'edit' || front::get('act')== 'add')
        $this->view->form="";
        $this->view->form = $this->_table->get_form();
        $this->tname = lang_admin($this->table);

        if ($this->table == 'orders')
            $this->tname = lang_admin('order');
        if ($this->table == 'coupon')
            $this->tname = lang_admin('discount_coupon');
        if ($this->table == 'archive') {
            $this->tname = lang_admin('content');
            session::set('modname', lang_admin('content_management'));
        }
        if ($this->table == 'user')
            $this->tname = lang_admin('user');
        if ($this->table == 'usergroup')
            $this->tname = lang_admin('user_group');
        if ($this->table == 'announcement')
            $this->tname = lang_admin('announcement');
        if ($this->table == 'guestbook')
            $this->tname = lang_admin('leaving_a_message');
        if ($this->table == 'ballot')
            $this->tname = lang_admin('vote');
        if ($this->table == 'option')
            $this->tname = lang_admin('voting_options');
        if ($this->table == 'linkword')
            $this->tname = lang_admin('internal_link');
        if ($this->table == 'category')
            $this->tname = lang_admin('column');
	    if ($this->table == 'buytemplate')
            $this->tname = lang_admin('online_template');
        $this->_pagesize = config::getadmin('manage_pagesize');
        if (front::get('tagfrom')=='shopcontent' || front::post('tagfrom')=='shopcontent'
            || front::get('tagfrom')=='shopcategory'|| front::post('tagfrom')=='shopcategory'
            || front::get('tagfrom')=='shopspecial'|| front::post('tagfrom')=='shopspecial'
            || front::get('tagfrom')=='shoptype'|| front::post('tagfrom')=='shoptype'){
            $this->view->table ='templatetag';
        }else{
            $this->view->table = $this->table;
        }
        $this->view->primary_key = $this->_table->primary_key;
        if (!front::get('page'))
            front::$get['page'] = 1;
        $this->Exc = $this->table == 'templatetag'
            || $this->table == 'templatetagwap'
            || $this->table == 'shoptemplatetag'
			|| $this->table == 'archive'
			|| $this->table == 'announcement'
			|| $this->table == 'category'
			|| $this->table == 'type'
			|| $this->table == 'special' ? true : false;
        $manage = 'table_' . $this->table;
        if (preg_match('/^my_/', $this->table))
            $manage = 'table_form';
        $this->manage = new $manage;

        //清空缓存---内容商品的
        if(($this->table == 'category' || $this->table == 'usergroup'  || $this->table == 'type' || $this->table == 'archive' || $this->table == 'user'|| $this->table == 'special')
            && ((front::get('act')== 'newadd' || front::get('act')== 'delete' || front::get('act')== 'batch') ||
            ((front::get('act')== 'edit'  || front::get('act')== 'add') && front::post('submit')))  ){
            user::deletesession();
            category::deletesession();
            //分类扩展 安装的情况
            if(file_exists(ROOT."/lib/table/type.php")) {
                type::deletesession();
            }
            //专题扩展 安装的情况
            if(file_exists(ROOT."/lib/table/special.php")) {
                special::deletesession();
            }
            //前台缓存删除
            if(front::get('act')== 'batch' && front::post('select')){
                front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/'.$this->table);
            }else if(front::post('submit') && front::get('id')!=""){
                front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/'.$this->table.'/all');
                front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/'.$this->table.'/'.front::get('id'));
            }
        }

    }

    function list_action()
    {
        if ($this->table == 'coupon') {
            if(session::get('ver') != 'corp'){
                front::alert(lang_admin('unauthorized_access'));
            }
        }
        $set1 = settings::getInstance();
        $sets1 = $set1->getrow(array('tag' => 'table-' . $this->table));
        $setsdata1 = isset($sets1['value'])?unserialize($sets1['value']):'';
        $this->view->settings = $setsdata1;

        $where = null;
        $ordre = '`id` DESC';
        if (preg_match('/^special$/', $this->table)) {
            $ordre = "listorder='0',`listorder` asc,`adddate` DESC";
        }
        if (preg_match('/^coupon$/', $this->table)) {
            $ordre = " couponid DESC";
        }
        if (preg_match('/^archive$/', $this->table)) {
            if(isset($_GET['sorting'])){
               if($_GET['sorting'] == '0'){
                   $ordre = "updatedate ASC";
               }else if($_GET['sorting'] == '1'){
                   $ordre = "updatedate DESC";
               }else if($_GET['sorting'] == '2'){
                   $ordre = "adddate ASC";
               }else if($_GET['sorting'] == '3'){
                   $ordre = "adddate DESC";
               }else if($_GET['sorting'] == '4'){
                   $ordre = "view ASC";
               }else if($_GET['sorting'] == '5'){
                   $ordre = "view DESC";
               }else if($_GET['sorting'] == '6'){
                   $ordre = "listorder ASC";
               }else if($_GET['sorting'] == '7'){
                   $ordre = "listorder DESC";
               }else if($_GET['sorting'] == '8'){
                   $ordre = "aid ASC";
               }
               else if($_GET['sorting'] == '9'){
                   $ordre = "aid DESC";
               }  else if($_GET['sorting'] == '10'){
                   $ordre = "salesnum ASC";
               }else if($_GET['sorting'] == '11'){
                   $ordre = "salesnum DESC";
               }
                $this->view->sorting = $_GET['sorting'];
            }ELSE{
                $ordre = "updatedate DESC";
                $this->view->sorting = '1';
            }
            $ordre=$ordre;
            /*$ordre="listorder desc,".$ordre;*/
            //$ordre = "toppost DESC,listorder=0,listorder ASC,adddate DESC";
            //$ordre = "adddate DESC";
        }
        if (preg_match('/^type|tag|category$/', $this->table)) {
            $ordre = "listorder=0,listorder asc";
        }
        if (preg_match('/^user$/', $this->table)) {
            $ordre = '`userid` DESC';
        }
        if (preg_match('/^usergroup$/', $this->table)) {
            $ordre = '`groupid` DESC';
        }
        if (preg_match('/^my_/', $this->table)) {
            $ordre = '`fid` DESC';
        }

        if ($this->table == 'consumption') {
            $ordre = '`adddate` DESC';
           /* if ((!front::post('search_userid') && front::get('type') != 'search') || (front::post('search_userid')=='0' && front::get('type') == 'search'))
                session::del('search_userid'); */
            if ((!front::post('search_username') && front::get('type') != 'search') || front::post('search_username')=="")
                session::del('search_username');
            if (get('search_username') ) {
                $sectionid = get('search_username');
                session::set('search_username', $sectionid);
                if(user::getusernameTouserid($sectionid) !=""){
                  $where .= 'mid in (' .user::getusernameTouserid($sectionid) .')';
                }else{
                    $where.=' 1 <> 1';
                }
            }
            if ((!front::post('search_deletType') && front::get('type') != 'search') || (front::post('search_deletType')=='0' && front::get('type') == 'search'))
                session::del('search_deletType');
           /* if (get('search_userid')) {
                $sectionid = get('search_userid');
                session::set('search_userid', $sectionid);
                $where .= 'mid=' . $sectionid;
            }*/
            if (get('search_deletType')) {
                $sectionid = get('search_deletType');
                session::set('search_deletType', $sectionid);
                $this->view->search_deletType = $sectionid;
                if($sectionid=='1'){
                    $filetime=date('Y-m-d', time());
                    $where .= " DATE_FORMAT(ADDDATE,'%Y-%m-%d')='" . $filetime."'";
                }
                elseif($sectionid=='2'){
                    $time =  time();
                    //组合数据
                    for ($i=1; $i<=7; $i++){
                        $filetime = date('Y-m-d' ,strtotime( '+' . $i-7 .' days', $time));
                        if($where==null){
                            $where .= "  DATE_FORMAT(adddate,'%Y-%m-%d') ='" . $filetime."'";
                        }else{
                            $where .= " or DATE_FORMAT(adddate,'%Y-%m-%d') ='" . $filetime."'";
                        }
                    }
                }
                elseif($sectionid=='3'){
                    $filetime=date('Y-m', time());
                    $where .= "DATE_FORMAT(adddate,'%Y-%m') ='" . $filetime."'";
                }
            }else{
                $this->view->search_deletType = '0';
            }
        }

        if ($this->table == 'orders') {
            $where=" status !=6  and status !=7 and status !=8";
            if (!front::post('search_number') && front::get('type') != 'search')
                session::del('search_number');
            if (get('search_number')) {
                $oid = get('search_number');
                session::set('search_number', $oid);
                $where .= " and oid like '%$oid%' ";
            }
        }

        if ($this->table == 'appsorders') {
            if (!front::post('search_number_apps') && front::get('type') != 'search')
                session::del('search_number_apps');
            if (get('search_number_apps')) {
                $oid = get('search_number_apps');
                session::set('search_number_apps', $oid);
                $where .= "  oid like '%$oid%' ";
            }
        }

        if ($this->table == 'xfconsumption'){
            $where = "mid=".front::get('userid');
        }

        if ($this->table == 'archive') {
            session::set('actname', '内容列表');
            $where = $this->_table->get_where('manage');
            $wherestatic=false;
            if (!front::post('search_catid') && front::get('type') != 'search')
                session::del('search_catid');
            if (get('search_catid')) {
                $catid = get('search_catid');
                session::set('search_catid', $catid);
                $this->category = category::getInstance();
                $categories = $this->category->sons($catid);
                $categories[] = $catid;
                $where .= ' and catid in(' . trim(implode(',', $categories), ',') . ')';
            }
            if (get('catid')) {
                $catid = get('catid');
                $cateidson=category::getInstance()->sons($catid);
                if(count($cateidson)>0){
                    $where.=  ' and (catid=' . $catid.' or catid in( '. trim(implode(',', $cateidson), ',') . '))';
                }else{
                    $where .= ' and catid=' . $catid;
                }
                $wherestatic=true;
            }
            if (!front::post('search_typeid') && front::get('type') != 'search')
                session::del('search_typeid');
            if (get('search_typeid') && file_exists(ROOT."/lib/table/type.php")) {
                $typeid = get('search_typeid');
                session::set('search_typeid', $typeid);
                $this->type = type::getInstance();
                $types = $this->type->sons($typeid);
                $types[] = $typeid;
                $where .= ' and typeid in(' . trim(implode(',', $types), ',') . ') or typeid='.$typeid;
            }
            if (get('typeid')) {
                $typeid = get('typeid');
                $where .= ' and typeid=' . $typeid;
            }
            if (!front::post('search_title') && front::get('type') != 'search')
                session::del('search_title');
            if (get('search_title')) {
                $title = get('search_title');
                session::set('search_title', $title);
                $where .= " and title like '%$title%' ";
            }
            if (!front::post('search_province_id') && front::get('type') != 'search')
                session::del('search_province_id');
            if (get('search_province_id')) {
                $proid = get('search_province_id');
                session::set('search_province_id', $proid);
                $where .= ' and province_id=' . $proid;
            }
            if (!front::post('search_city_id') && front::get('type') != 'search')
                session::del('search_city_id');
            if (get('search_city_id')) {
                $cityid = get('search_city_id');
                session::set('search_city_id', $cityid);
                $where .= ' and city_id=' . $cityid;
            }
            if (!front::post('search_section_id') && front::get('type') != 'search')
                session::del('search_section_id');
            if (get('search_section_id')) {
                $sectionid = get('search_section_id');
                session::set('search_section_id', $sectionid);
                $where .= ' and section_id=' . $sectionid;
            }
            if (!front::post('search_spid') && front::get('type') != 'search')
                session::del('search_spid');
            if (get('search_spid')) {
                $sectionid = get('search_spid');
                session::set('search_spid', $sectionid);
                $where .= ' and spid=' . $sectionid;
            }
            if (get('manage_spid')) {
                $spidid = get('manage_spid');
                $where .= ' and spid=' . $spidid;
            }
            if (!front::post('search_userid') && front::get('type') != 'search')
                session::del('search_userid');
            if (get('search_userid')) {
                $sectionid = get('search_userid');
                session::set('search_userid', $sectionid);
                $where .= ' and userid=' . $sectionid;
            }
            if (get('ecoding_title')) {   //防伪码搜索
                $ecoding = get('ecoding_title');
                $where .= ' and ecoding="' . $ecoding.'"';
            }

            if (get('deletestate')) {
                $where .= ' and state=-1 ';
                $wherestatic=true;
            }else{
                $where .= ' and state>0 ';
            }
            if (get('needcheck')) {
                $where .= ' and checked=0 ';
                $wherestatic = true;
            }
            if (front::get('shopping')) {
                if (session::get('ver') != 'corp'){
                    front::alert(lang_admin('no_permission'));
                }
                $this->view->shopping='1';
            }else{
                $this->view->shopping='0';
            }


            //判断是否有条件 没有的话  不查询
            if(!$wherestatic && !front::post('search_static') && !get('search_typeid')
                &&  !get('search_spid') &&  !get('search_code') && !get('manage_spid') && !get('typeid')){
                $where="1<>1";
            }

        }
        if ($this->table =="buytemplate"){
            if (!front::post('search_code') && front::get('type') != 'search')
                session::del('search_code');
            if (get('search_code')) {
                $sectionid = get('search_code');
                session::set('search_code', $sectionid);
                if ($where){
                    $where .= ' and code="' . $sectionid.'" ';
                }else{
                    $where .= ' code="' . $sectionid.'" ';
                }

            }
        }
        if ($this->table == 'templatetag' || $this->table == 'shoptemplatetag') {
            if (front::get('tagfrom')) {
                $where = "tagfrom='" . front::get('tagfrom') . "'";
            } else
                $where = "tagfrom='define'";
            $where .= " and (`tagvar` IS NULL OR `tagvar` = '') ";
        }
        if ($this->table == 'templatetagwap' ) {
            if (front::get('tagfrom')) {
                $where = "tagfrom='" . front::get('tagfrom') . "'";
            } else
                $where = "tagfrom='define'";
            $where .= " and (`tagvar` IS NULL OR `tagvar` = '') ";
        }
        if ($this->table == 'option') {
            $ballot = new ballot();
            $where = array('bid' => front::$get['bid']);
            session::set('bid', front::$get['bid']);
            $row = $ballot->getrow(array('id' => front::$get['bid']));
            $this->view->ballot = $row;
        }
        if (get('spid')) {
            $sp = new special();
            $sp = $sp->getrow('spid=' . get('spid'));
            $this->view->special = $sp;
        }
        $limit = ((front::get('page') - 1) * $this->_pagesize) . ',' . $this->_pagesize;
        if ($this->table == 'category' || $this->table == 'type') {
            $where .= " `parentid`='0' ";
        }

        //语言包过滤
        if ($this->table == 'category' || $this->table == 'archive' || $this->table == 'coupon' || $this->table == 'special' || $this->table == 'type'
           || $this->table == 'announcement' || $this->table == 'tag' ){
            //增加语言包过滤
            if($where !=''){
                $where .= ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            }else{
                $where= ' langid = "'.lang::getlangid(lang::getisadmin()).'"';
            }
        }
        //提取商品
        //提取商品
        if ($this->table == 'category' && (!file_exists(ROOT."/lib/table/shopping.php") || (session::get('ver') != 'corp' && file_exists(ROOT."/lib/table/shopping.php"))) ){
            $where.=$where!=''?' and isshopping=0':" isshopping=0";
        }

        if ($this->table == 'user') {
            if (!front::post('search_name_email_tel') && front::get('type') != 'search')
                session::del('search_name_email_tel');
            if (get('search_name_email_tel')) {
                $search_name_email_tel = get('search_name_email_tel');
                session::set('search_name_email_tel', $search_name_email_tel);
                if($where !=""){
                    $where .= " and ( username like '%$search_name_email_tel%' or e_mail like '%$search_name_email_tel%' or tel like '%$search_name_email_tel%') ";
                }else{
                    $where .= " ( username like '%$search_name_email_tel%' or e_mail like '%$search_name_email_tel%' or tel like '%$search_name_email_tel%') ";
                }

            }
      /*      if (!front::post('search_email') && front::get('type') != 'search')
                session::del('search_email');
            if (get('search_email')) {
                $search_email = get('search_email');
                session::set('search_email', $search_email);
                if($where !=""){
                $where .= " and e_mail like '%$search_email%' ";
                }else{
                    $where .= "  e_mail like '%$search_email%' ";
                }
            }
            if (!front::post('search_tel') && front::get('type') != 'search')
                session::del('search_tel');
            if (get('search_tel')) {
                $search_tel = get('search_tel');
                session::set('search_tel', $search_tel);
                if($where !=""){
                $where .= " and tel like '%$search_tel%' ";
                }else{
                    $where .= "  tel like '%$search_email%' ";
                }
            }*/
            if ($this->view->userid!=1){
                if ($where=="") $where .= " userid !=1 ";else $where .= " and userid !=1 ";
            }
            if ($this->cur_user['groupid'] == '2' && config::getadmin('install_admin') == $this->cur_user['username']) {
                if($where ==""){
                    $where .= "groupid >= " . front::$user['groupid'];
                }else{
                    $where .= " and groupid >= " . front::$user['groupid'];
                }
            } else {
                if($where ==""){
                    $where  = "   groupid > " . front::$user['groupid'];
                }else{
                    $where.= " and  groupid > " . front::$user['groupid'];
                }
            }

            if (isset(front::$get['type']) && front::$get['type'] == 'search' && front::$post['search_title']) {
                $where .= front::$post['field'] . '="' . front::$post['search_title'] . '"';
            }
        }
        if ($this->table == 'comment') {
            if (front::get('uid'))
                $where = "userid='" . front::get('uid') . "'";
        }

        if ($this->table == 'zanlog') {
            if (front::get('uid'))
                $where = "uid='" . front::get('uid') . "'";
            $ordre = 'zlid DESC';
        }
        if ($this->table == 'guestbook') {
                $guestbookfielddata=guestbookfield::getInstance()->getrows(' isshow=1 ',0);
                if(is_array($guestbookfielddata)){
                    foreach ($guestbookfielddata as $key=>$val){
                        $guestbookfielddata[$key]['showname'] = unserialize($guestbookfielddata[$key]['showname']);
                        $guestbookfielddata[$key]['message'] = unserialize($guestbookfielddata[$key]['message']);
                        $guestbookfielddata[$key]['fieldvalue'] = unserialize($guestbookfielddata[$key]['fieldvalue']);
                    }
                }
                $this->view->guestbookfielddata=$guestbookfielddata;
        }

        $this->_view_table = $this->_table->getrows($where, $limit, $ordre, $this->_table->getcols('manage'));
        if ($this->table == 'guestbookfield') {
            foreach ($this->_view_table as $key=>$val){
                    $this->_view_table[$key]['showname'] = unserialize( $this->_view_table[$key]['showname']);
                    $this->_view_table[$key]['message'] = unserialize($this->_view_table[$key]['message']);
                    $this->_view_table[$key]['fieldvalue'] = unserialize($this->_view_table[$key]['fieldvalue']);
            }
        }
        if ($this->table == 'archive' && !get('manage_spid') && !get('typeid') ){
            //区分商品和文章
            foreach ($this->_view_table as $key=>$val){
                if (front::get('shopping')) {
                    $categorydata=category::getInstance()->getrow(" isshopping=1 and catid=".$val['catid']);
                    if (!is_array($categorydata)) unset($this->_view_table[$key]);
                }else{
                    $categorydata=category::getInstance()->getrow(" isshopping=0 and catid=".$val['catid']);
                    if (!is_array($categorydata)) unset($this->_view_table[$key]);
                }
            }
        }
            /*  if ($this->table == 'tag'){
                //判断范围
                foreach ($this->_view_table as $keys=>$value){
                    if($this->_view_table[$keys]['ranges']!=""){
                        $categorydata=category::getInstance()->getrows("catid in (".$this->_view_table[$keys]['ranges'].")",0);
                        foreach ($categorydata as $key=>$val){
                            if ($this->_view_table[$keys]['rangesname']!=""){
                                $this->_view_table[$keys]['rangesname'].=','.$val['catname'];
                            }else{
                                $this->_view_table[$keys]['rangesname']=$val['catname'];
                            }
                        }
                    }
                }

            }*/
        //echo $this->_table->sql;
        //print_r($this->_view_table);exit();
        $this->view->search_title = isset(front::$post['search_title'])?front::$post['search_title']:"";
        $this->view->record_count = ($this->table=="templatetag" || $this->table=="shoptemplatetag"|| $this->table=="templatetagwap")?0:$this->_table->record_count;
        $this->view->token = Phpox_token::grante_token('table_del');
    }

    function copy_action(){
        if ($this->table == 'category') {
            chkpw('category_add');
        }
        if ($this->table == 'archive') {
            chkpw('archive_add');
        }

        //判断是不是商品栏目复制
        if (isset(front::$get['shopping']) && front::$get['shopping'] ) {
            if (session::get('ver') != 'corp'){
                front::alert(lang_admin('no_permission'));
            }
            $this->view->shopping='1';
        }else{
            $this->view->shopping='0';
        }

        if(isset($_GET['id'])){
            $testdata = $this->_table->getrow(front::get('id'), '1 desc', $this->_table->getcols('modify'));
            if ($this->table == 'archive'){
                //区分商品和文章
                $categorydata=category::getInstance()->getrow(" isshopping=1 and catid=".$testdata['catid']);
                if (is_array($categorydata)){
                    $this->view->shopping=1;
                }else{
                    $this->view->shopping=0;
                }

            }

                //删除ID
                foreach ($testdata as $key => $value){
                    if ($value == front::get('id')){
                        unset($testdata[$key]);
                    }
                }

            //用户异步提取图库图片
            if (isset(front::$get['ajax']) && front::$get['ajax']) {
                front::$get['dir'] = front::$get['ajax'];
                $img_arr = image_admin::listimg_action();
                foreach ($img_arr as $v) {
                    echo '<img src="upload/images/' . front::$get['dir'] . '/' . $v . '" id="img' . str_replace('.', '', $v) . '" onClick="select_img(\'img' . str_replace('.', '', $v) . '\');" />';
                }
                exit();
            }

            /*//插入开始复制
            $insert = $this->_table->rec_insert($testdata[0]);
            if ($insert < 1) {
                front::flash("{$this->tname}复制失败！");
            } else {
                $_insertid = $this->_table->insert_id();
                event::log("复制" . $this->tname . ",ID=" . $_insertid, '成功');
                $this->manage->save_after($_insertid);
            }*/

            $this->_view_table =$testdata;
            $this->manage->view_before($this->_view_table);
            /*$this->_view_table['data'] = $testdata;*/
            $this->view->image_dir = image_admin::listdir();
            $this->view->token = Phpox_token::grante_token('user_add');
            $this->view->form = $this->_table->get_form();

        }
        //front::redirect(url::modify('act/list/table/' . $this->table));

    }

    function addballot_action()
    {
        $this->render('dialog/addballot.php');
    }

    function import_action()
    {
        if ($this->table == 'archive') {
            if (session::get('ver') != 'corp') {
                front::alert(lang_admin('unauthorized_access'));
            }
        }

        if (front::post('submit')) {
            if (front::$post['attachment_path']) {
                $name = front::$post['attachment_path'];

                if (!$name || !preg_match('/\.xls$/i', $name)) {
                    alerterror(lang_admin('please_select_Excel2003_file'));
                }
                $reader = PHPExcel_IOFactory::createReader('Excel5');
                $PHPExcel = $reader->load($name);
                $sheet = $PHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumm = $sheet->getHighestColumn();
                $i = 0;
                for ($row = 2; $row <= $highestRow; $row++) {
                    if ($sheet->getCell('A' . $row)->getValue()) {
                        $data['catid'] = $sheet->getCell('A' . $row)->getValue();
                        $data['typeid'] = intval($sheet->getCell('B' . $row)->getValue());
                        $data['spid'] = intval($sheet->getCell('C' . $row)->getValue());
                        $data['title'] = $sheet->getCell('D' . $row)->getValue();
                        $data['content'] = $sheet->getCell('E' . $row)->getValue();
                        $data['introduce'] = $sheet->getCell('F' . $row)->getValue();
                        $data['tag'] = $sheet->getCell('G' . $row)->getValue();
                        $data['adddate'] = $sheet->getCell('H' . $row)->getValue();
                        if ($data['adddate'] == '') {
                            $data['adddate'] = date('Y-m-d H:i:s');
                        }
                        $data['author'] = $sheet->getCell('I' . $row)->getValue();
                        $data['attr3'] = $sheet->getCell('J' . $row)->getValue();
                        $data['checked'] = intval($sheet->getCell('K' . $row)->getValue());
                        $data['attr2'] = $sheet->getCell('L' . $row)->getValue();
                        $data['thumb'] = $sheet->getCell('M' . $row)->getValue();
                        $data['langid'] = $sheet->getCell('O' . $row)->getValue();
                        $a = explode('|', $sheet->getCell('N' . $row)->getValue());
                        if (is_array($a) && !empty($a)) {
                            $c = array();
                            $i = 0;
                            foreach ($a as $b) {
                                $c[$i]['url'] = $b;
                                $i++;
                            }
                            $data['pics'] = serialize($c);
                        } else {
                            $data['pics'] = '';
                        }
                        //加载自定义字段  对应  表格序号
                        foreach (front::$post as $key=>$val){
                            if (!preg_match('/^my_/', $key) || preg_match('/^my_field/', $key)) {
                                continue;
                            }
                            if ($val!="")
                            $data[$key] = $sheet->getCell($val . $row)->getValue();
                        }


                        $data['userid'] = $this->view->user['userid'];
                        $this->_table->rec_insert($data);
                        $i++;
                    }
                }
                front::flash("{$this->tname}".lang_admin('import_data_successfully')."！");
            } else {
                alerterror(lang_admin('please_select_Excel2003_file_file_to_import'));
            }
        }
        $this->_view_table = array();
        $this->_view_table['data'] = array();
    }

    function add_action()
    {
        if ($this->table == 'category') {
            chkpw('category_add');
        }
        if ($this->table == 'archive') {
            chkpw('archive_add');
            session::set('actname', '添加内容');
        }
        if ($this->table == 'type') {
            chkpw('type_add');
            front::$post['typecontent'] = isset(front::$post['typecontent'])?htmlspecialchars_decode(front::$post['typecontent']):"";
        }
        if ($this->table == 'special') {
            chkpw('special_add');
            front::$post['description'] =isset(front::$post['description'])?htmlspecialchars_decode(front::$post['description']):"";
        }
        if ($this->table == 'user') {
            chkpw('user_add');
        }
        if ($this->table == 'usergroup') {
            chkpw('usergroup_add');
        }
        if ($this->table == 'ballot') {
            chkpw('func_ballot_add');
        }
        if ($this->table == 'announcement') {
            chkpw('func_announc_add');
            front::$post['content'] = htmlspecialchars_decode(front::$post['content']);
        }
        if ($this->table == 'templatetag' && front::get('tagfrom') == 'define') {
            chkpw('templatetag_add_define');
        }
        if ($this->table == 'templatetag' && front::get('tagfrom') == 'category') {
            chkpw('templatetag_add_category');
        }
        if ($this->table == 'templatetag' && front::get('tagfrom') == 'content') {
            chkpw('templatetag_add_content');
        }
        if ($this->table == 'linkword') {
            chkpw('seo_linkword_add');
        }
        if ($this->table == 'friendlink') {
            chkpw('seo_friendlink_add');
        }
        //判断是不是商品增加
        if (isset(front::$get['shopping']) && front::$get['shopping'] ) {
            if (session::get('ver') != 'corp'){
                front::alert(lang_admin('no_permission'));
            }
            $this->view->shopping='1';
        }else{
            $this->view->shopping='0';
        }
        //用户异步提取图库图片
        if (isset(front::$get['ajax']) && front::$get['ajax']) {
            front::$get['dir'] = front::$get['ajax'];
            $img_arr = image_admin::listimg_action();
            foreach ($img_arr as $v) {
                echo '<img src="upload/images/' . front::$get['dir'] . '/' . $v . '" id="img' . str_replace('.', '', $v) . '" onClick="select_img(\'img' . str_replace('.', '', $v) . '\');" />';
            }
            exit();
        }

        //手动添加订单  商品自定义字段获取
        if (front::$get['table']=="orders"){
            $fieldname="";
            $archivefield = archive::getInstance()->getFields();
             foreach ($archivefield as $key => $val){
                 $name=$val['name'];
                 if (!preg_match('/^my_/', $name)) {
                     unset($archivefield[$key]);
                     continue;
                 }
                  if((setting::$var['archive'][$name]['isshoping'] == '1') && (setting::$var['archive'][$name]['langname'] == lang::getisadmin()) ){
                       $fieldname=$fieldname==""?$name:$fieldname.','.$name;
                  }
             }
            $this->view->fieldname = $fieldname;
        }
        if (front::post('submit') && $this->manage->vaild()) {
            //新增时候绑定语言包
            if($this->table == 'announcement' || $this->table == 'tag'){
                front::$post['langid']=lang::getlangid(lang::getisadmin());
            }
            $this->manage->filter($this->Exc);
            $this->manage->add_before($this);
            $this->manage->save_before();
            front::$post['catname'] = isset(front::$post['catname'])?str_replace(' ', '&nbsp;', front::$post['catname']):"";
            front::$post['htmldir'] = str_replace(' ', '_', front::$post['htmldir']);

            if (!isset(front::$post['introduce']) || front::$post['introduce'] == '') {
                front::$post['content']=isset(front::$post['content'])?front::$post['content']:"";
                front::$post['introduce'] = tool::cn_substr(preg_replace('/&(.*?);/is', '', strip_tags(front::$post['content'])), 200);
            }
            if ($this->table == 'user') {
                front::$post['adddatetime']=date('Y-m-d h:i:s', time());
                if (!Phpox_token::is_token('user_add', front::$post['token'])) {
                    exit(lang_admin('token_error'));
                }
            }
            if ($this->table == 'templatetag' || $this->table == 'shoptemplatetag') {
                if (front::$post['tagfrom'] != 'define' && !preg_match('/^tag_(.*?)+\.html$/is', front::$post['tagtemplate'])) {
                    exit(lang_admin('illegal_parameter'));
                }
            }
            if ($this->table == 'templatetagwap') {
                if (front::$post['tagfrom'] != 'define' && !preg_match('/^tag_(.*?)+\.html$/is', front::$post['tagtemplate'])) {
                    exit(lang_admin('illegal_parameter'));
                }
            }
            if ($this->table == 'coupon') {
                $couponyard =$this->generateCode(1,'',16,'');
                front::$post['couponyard'] =$couponyard[0];
            }

            //自定义留言字段新增
            if ($this->table == 'guestbookfield'){
                $langdata=lang::getlang();
                $newshownamedata=array();
                $newmessagedata=array();
                $newfieldvaluedata=array();
                if(is_array($langdata)){
                    foreach ($langdata as $key=>$value) {
                        $newshowname = 'showname_' . $value['langurlname'];
                        $newmessage = 'message_' . $value['langurlname'];
                        $newfieldvalue = 'fieldvalue_' . $value['langurlname'];
                        $newshownamedata[$newshowname]=front::$post[$newshowname];
                        $newmessagedata[$newmessage]=front::$post[$newmessage];
                        $newfieldvaluedata[$newfieldvalue]=front::$post[$newfieldvalue];
                    }
                }
                front::$post['showname']=serialize($newshownamedata);
                front::$post['message']=serialize($newmessagedata);
                front::$post['fieldvalue']=serialize($newfieldvaluedata);


                if (front::$post['selecttype'] != '0') {
                    front::$post['type']=front::$post['selecttype'];
                }
                if(front::$post['type'] == 'varchar'){
                    $fieldtype = 'varchar';
                }else
                if(front::$post['type'] == 'text'){
                    $fieldtype = 'text';
                }else
                if(front::$post['type'] == 'mediumtext'){
                    $fieldtype = 'text';
                }else
                if(front::$post['type'] == 'int'){
                    $fieldtype = 'int';
                }else
                if(front::$post['type'] == 'datetime'){
                    $fieldtype = 'datetime';
                }else
                if(front::$post['type'] == 'radio'){
                    $fieldtype = 'text';
                }else
                if(front::$post['type'] == 'checkbox'){
                    $fieldtype = 'text';
                }else
                if(front::$post['type'] == 'select'){
                    $fieldtype = 'text';
                }else
                if(front::$post['type'] == 'image'){
                    $fieldtype = 'varchar';
                }else
                if(front::$post['type'] == 'file'){
                    $fieldtype = 'varchar';
                }
                if($fieldtype != 'datetime'){
                    $fieldtype= $fieldtype."(".front::post('leng').") ";
                }
                $isnull=" ";
                if(front::$post['isnull']){
                    $isnull=" not null ";
                }
                $sql=" ALTER TABLE `cmseasy_guestbook` ADD ".front::post('name')." ".$fieldtype.$isnull;
                $this->_table->query($sql);
            }

            //手动添加订单
            if (front::$get['table']=="orders"){
                front::$post['payname']=front::$post['payname']?front::$post['payname']:"none";
                front::$post['mid'] = front::$post['mid'] ? front::$post['mid'] : 0;
                front::$post['ip'] = front::ip();
                front::$post['oid'] = date('YmdHis') . '-0-' . front::$post['mid'] . '-'.front::$post['payname'];
                front::$post['courier_number'] = '';
                front::$post['s_status'] = 0;
                front::$post['trade_no'] = '';
                front::$post['adddate'] = time();
            }

            //商品模板
            if ($this->table == 'archive'){
                //兼容单引号
                front::$post['content']=str_replace("'", "\'", front::$post['content']);
                front::$post['introduce']=str_replace("'", "\'", front::$post['introduce']);
                front::$post['title']=str_replace("'", "\'", front::$post['title']);
                front::$post['subtitle']=str_replace("'", "\'", front::$post['subtitle']);

                if(front::$post['isshopping']){
                    front::$post['template']=front::$post['templateshopping'];
                    $langdata=lang::getlang();
                    if(is_array($langdata)){
                        foreach ($langdata as $key=>$value){
                            $newcname='attr2_'.$value['langurlname'];
                            $newatt2[$newcname]=front::$post[$newcname];
                        }
                    }
                    front::$post['attr2']=json_encode($newatt2);
                }else{
                    if(front::$post['readmenoy']==0 && front::$post['domwmenoy']==0){
                        $newreadmenoy=$this->catidparentreadmenoy(front::$post['catid']);
                        front::$post['readmenoy']=$newreadmenoy['readmenoy'];
                        front::$post['domwmenoy']=$newreadmenoy['domwmenoy'];
                    }
                }
                //简介截取
                if(front::$post['introduce'] !=''){
                    front::$post['introduce']=mb_substr(front::$post['introduce'],0,config::getadmin('archive_introducelen'));

                }
                if(front::$post['buyurl'] !=''){
                    front::$post['buyurl']=htmlspecialchars_decode(front::$post['buyurl']);
                }
            }

            //专题
            if ($this->table == 'special'){
                if (front::$post['htmldir']=="") {
                    front::$post['htmldir'] = pinyin::get2(front::$post['title']);
                }
                $data=$this->_table->getrow("htmldir='".front::$post['htmldir']."' or title='".front::$post['title']."'");
                if(is_array($data)){
                    front::flash(lang_admin("topic_name").lang_admin("catalog_name").lang_admin("repetition"));
                    front::redirect(url::modify('act/list/table/' . $this->table, true));
                }
            }
            //tag
            if ($this->table == 'tag'){
                if (front::$post['htmldir']=="") {
                    front::$post['htmldir'] = pinyin::get2(front::$post['tagname']);
                }
                $data=$this->_table->getrow("htmldir='".front::$post['htmldir']."' or tagname='".front::$post['tagname']."'");
                if(is_array($data)){
                    front::flash(lang_admin("topic_name").lang_admin("catalog_name").lang_admin("repetition"));
                    front::redirect(url::modify('act/list/table/' . $this->table, true));
                }
            }

            if ($this->table == 'category') {
                //兼容单引号
                front::$post['catname']=str_replace("'", "\'", front::$post['catname']);
                front::$post['subtitle']=str_replace("'", "\'", front::$post['subtitle']);
                front::$post['categorycontent']=str_replace("'", "\'", front::$post['categorycontent']);
                //商品栏目
                if(front::$post['isshopping']){
                    front::$post['template']=front::$post['templateshopping'];
                    front::$post['showtemplate'] = front::$post['showshoppingtemplate'];
                    front::$post['listtemplate'] = front::$post['listshoppingtemplate'];
                    front::$post['parentid']=front::$post['catidshopping'];
                }
                //是否设置前台首页
                if(front::$post['isindex']){
                   $this->_table->rec_update("isindex=0",'1=1');
                }

                if (front::$post['addtype'] == 'single') {
                    if (!front::$post['htmldir']) {
                       front::$post['htmldir'] = pinyin::get2(front::$post['catname']);
                    }

                    $data=$this->_table->getrows("catname='".front::$post['catname']."'", 0);
                    if(is_array($data) && count($data)>0){
                      /*  front::flash(front::$post['htmldir'].lang_admin("category_name").lang_admin("catalog_name").lang_admin("repetition"));
                        front::redirect(url::modify('act/add/isshopping/'.front::$post['isshopping'].'/table/' . $this->table, true));*/
                        front::$post['htmldir']= front::$post['htmldir'].'-'.count($data);
                    }
                    $insert = $this->_table->rec_insert(front::$post);
                    if ($insert < 1) {
                        front::flash("{$this->tname}".lang_admin('add_to').lang_admin('failure')."！");
                    }
                    else {
                        $_insertid = $this->_table->insert_id();
                        event::log(lang_admin('add_to') . $this->tname . ",ID=" . $_insertid, lang_admin('success'));
                        $this->manage->save_after($_insertid);
                    }

                }
                else {
                    $catearr = explode("\n", front::$post['batch_add']);
                    foreach ($catearr as $cates) {
                        $catetmp = explode("|", $cates);
                        if ($catetmp[0] != '') {
                            front::$post['catname'] = $catetmp[0];
                            front::$post['htmldir'] = $catetmp[1];

                            if ($catetmp[1] == '') {
                                front::$post['htmldir'] = pinyin::get2($catetmp[0]);
                            }
                            $insert = $this->_table->rec_insert(front::$post);
                            if ($insert < 1) {
                                front::flash("{$this->tname}".lang_admin('add_to').lang_admin('failure')."！");
                            } else {
                                $_insertid = $this->_table->insert_id();
                                event::log(lang_admin('add_to') . $this->tname . ",ID=" . $_insertid, lang_admin('success'));
                                $this->manage->save_after($_insertid);
                            }
                        }
                    }
                }

                 //front::redirect(url::modify('act/list/table/' . $this->table, true));
                 front::redirect(url('table/list/table/' . $this->table, true));
            }
            else if ($this->table == 'type') {
                if (front::$post['addtype'] == 'single') {
                    if (!front::$post['htmldir']) {
                        front::$post['htmldir'] = pinyin::get2(front::$post['typename']);
                    }
                    $sp =  $this->_table->getrowlike( "htmldir like '".front::post('htmldir')."%'");
                    if (is_array($sp) && count($sp)>0 ){
                        $htmldirindex=0;
                       foreach ($sp as $val){
                           $source = explode("-",trim($val['htmldir']));
                           if(!isset($source[1]) || $source[1]==''){
                               $htmldirindex=0;
                           }else if(((int)$source[1])>$htmldirindex){
                               $htmldirindex=$source[1];
                           }
                       }
                        $htmldirindex=$htmldirindex+1;
                        front::$post['htmldir']=front::$post['htmldir'].'-'.$htmldirindex;
                    }
                    //判断是否重复
                    $data=$this->_table->getrow("htmldir='".front::$post['htmldir']."'");
                    if(is_array($data)){
                        front::flash(lang_admin("type_name").lang_admin("catalog_name").lang_admin("repetition"));
                        front::redirect(url::modify('act/list/table/' . $this->table, true));
                    }
                    $insert = $this->_table->rec_insert(front::$post);
                    if ($insert < 1) {
                        front::flash("{$this->tname}".lang_admin('add_to').lang_admin('failure')."！");
                    } else {
                        $_insertid = $this->_table->insert_id();
                        event::log(lang_admin('add_to') . $this->tname . ",ID=" . $_insertid, lang_admin('success'));
                        $this->manage->save_after($_insertid);
                    }
                } else {
                    $catearr = explode("\n", front::$post['batch_add']);
                    foreach ($catearr as $cates) {
                        $catetmp = explode("|", $cates);
                        if ($catetmp[0] != '') {
                            front::$post['typename'] = $catetmp[0];
                            front::$post['htmldir'] = $catetmp[1];
                            if ($catetmp[1] == '') {
                                front::$post['htmldir'] = pinyin::get2($catetmp[0]);
                            }
                            //判断是否重复
                            $data=$this->_table->getrow("htmldir='".front::$post['htmldir']."'");
                            if(is_array($data)){
                                front::flash(lang_admin("type_name").lang_admin("catalog_name").lang_admin("repetition"));
                                front::redirect(url::modify('act/list/table/' . $this->table, true));
                            }
                            $insert = $this->_table->rec_insert(front::$post);
                            if ($insert < 1) {
                                front::flash("{$this->tname}".lang_admin('add_to').lang_admin('failure')."！");
                            } else {
                                $_insertid = $this->_table->insert_id();
                                event::log(lang_admin('add_to') . $this->tname . ",ID=" . $_insertid, lang_admin('success'));
                                $this->manage->save_after($_insertid);
                            }
                        }
                    }
                }
                 front::redirect(url::modify('act/list', true));
            }
            else{
                if ($this->table == 'user' && ($this->_table->getrow("username='" .front::post('username')."' or tel='".front::post('tel')."' or e_mail='".front::post('e_mail')."'")) ){
                    front::flash(lang('user_name_already_registered'));
                }
                else{
                    $insert = $this->_table->rec_insert(front::$post);
                    $_insertid = $this->_table->insert_id();
                    $this->manage->save_after($_insertid);
                    if ($insert < 1) {
                        front::flash("{$this->tname}".lang_admin('add_to').lang_admin('failure')."！");
                    }
                    else {
                        event::log(lang_admin('add_to') . $this->tname . ",ID=" . $_insertid, lang_admin('success'));
                        $info = '';
                        if ($this->table == 'archive') {
                            $url = url('archive/show/aid/' . $_insertid, false);
                            if (front::get('site') == 'default' || front::get('site') == '') {
                                $info = '<a href="' . $url . '" target="_blank">'.lang_admin('see').'</a>';
                            }
                        }
                        front::flash("{$this->tname}".lang_admin('add_to').lang_admin('success')."！$info");
                        if (front::get('type') == 'dialog') {
                            if ($this->table == 'option') {
                                front::flash();
                                exit(lang_admin('add_to').lang_admin('success'));
                            }
                        }
                        if ($this->table == 'templatetag' || $this->table == 'shoptemplatetag') {
                             front::redirect(url::modify('act/list/table/templatetag/tagfrom/'.front::post('tagfrom'), true));
                        } else if ($this->table == 'archive') {
                            front::redirect(url::modify('act/list/table/' . $this->table.'/catid/'.front::post('catid'),true));
                        }
                        else if ($this->table == 'ballot') {
                            //fasong duanxin
                            $user = user::getInstance();
                            $rows = $user->getrows('', 0);
                            foreach ($rows as $r) {
                                sendMsg($r['tel'], config::getadmin('sitename') . lang_admin('release') . front::$post['title'] . '，'.lang_admin('welcome_to_join_us'));
                            }
                             front::redirect(url::modify('act/list/table/' . $this->table, true));
                        } else {
                             front::redirect(url::modify('act/list/table/' . $this->table, true));
                        }
                    }
                }
            }

        }
        //$tag_option_info = settings::getInstance()->getrow(array('tag'=>'table-hottag'));
        //$tag_option_arr = unserialize($tag_option_info['value']);
        $this->_view_table = array();

        $this->_view_table['data'] = array();
        $this->view->image_dir = image_admin::listdir();
        $this->view->token = Phpox_token::grante_token('user_add');
        //var_dump($this->view->token);
        //$this->view->tag_opton = explode("\n",$tag_option_arr['hottag']);
    }

    //快速新增方法
    function newadd_action(){
        if ($this->table == 'category') {
            chkpw('category_add');
        }
        if ($this->table == 'type') {
            chkpw('type_add');
            front::$post['typecontent'] =isset(front::$post['typecontent'])?htmlspecialchars_decode(front::$post['typecontent']):"";
        }
        if ($this->table == 'special') {
            chkpw('special_add');
            front::$post['description'] = htmlspecialchars_decode(front::$post['description']);
        }
        if (front::post('batch')=="newadd" && front::post('inedx')) {
            $index = front::post('inedx'); //总数
            //获取新增修改的序号  不是不操作
            $cahngenumdata = explode(',',front::post('cahngenum'));

            //栏目
            if ($this->table == 'category'){
                for ($index; $index > 0; $index--) {
                    //判断是否是新增修改的序号  不是不操作
                    if(!in_array($index,$cahngenumdata) || front::post('cahngenum')==""){
                        continue;
                    }
                    //判断修改还是新增加
                    if(front::post('catid'.$index)!=''){

                        //修改内容
                        $updatearray=array("listorder"=>front::post('listorder'.$index),
                                           "catname"=>trim(str_replace("  └ ","",front::post('catname'.$index))),
                                           "isnav"=>front::post('isnav'.$index),
                        );
                        $updatearray['catname']=trim(html_entity_decode($updatearray['catname']),chr(0xc2).chr(0xa0));

                        //修改
                        $this->_table->rec_update($updatearray, 'catid="'.front::post('catid'.$index).'"');
                    }else{
                        //新增 --名称不能为空  文件夹名自动通过名称生成
                        if(front::post('catname'.$index)!=""){
                            //新增内容
                            $inarray=array("listorder"=>front::post('listorder'.$index),
                                "catname"=>trim(str_replace("  └ ","",front::post('catname'.$index))),
                                "isnav"=>front::post('isnav'.$index),
                                "isshopping"=>front::post('isshopping'.$index),
                                "parentid"=>0,
                                "ispages"=>1,
                                "langid"=>lang::getlangid(lang::getisadmin()),
                            );
                            $inarray['catname ']=trim(html_entity_decode($inarray['catname']),chr(0xc2).chr(0xa0));

                            if(front::post('htmldir'.$index)!=""){
                                $inarray['htmldir']=front::post('htmldir'.$index);
                            }else{
                                $inarray['htmldir']=pinyin::get2(front::post('catname'.$index));
                            }
                            //判断是否重复
                            $data=$this->_table->getrow("htmldir='".$inarray['htmldir']."' or catname='".$inarray['catname']."'");
                            if(is_array($data)){
                                front::flash(lang_admin("category_name").lang_admin("catalog_name").lang_admin("repetition"));
                                front::redirect(url::modify('act/list/table/' . $this->table, true));
                            }
                            //新增
                            $this->_table->rec_insert($inarray);

                            $this->manage=new table_category();
                            $_insertid = $this->_table->insert_id();
                            $this->manage->save_after($_insertid);
                        }
                    }
                }
             }
            //分类
            if ($this->table == 'type'){
                for ($index; $index > 0; $index--) {
                    //判断是否是新增修改的序号  不是不操作
                    if(!in_array($index,$cahngenumdata) || front::post('cahngenum')==""){
                        continue;
                    }
                    //判断修改还是新增加
                    if(front::post('typeid'.$index)!=''){
                        //修改内容
                        $updatearray=array("listorder"=>front::post('listorder'.$index),
                            "typename"=>trim(str_replace("  └ ","",front::post('typename'.$index))),
                        );
                        $updatearray['typename']=trim(html_entity_decode($updatearray['typename']),chr(0xc2).chr(0xa0));
                        //修改
                        $this->_table->rec_update($updatearray, 'typeid="'.front::post('typeid'.$index).'"');
                    }else{
                        //新增 --名称不能为空  文件夹名自动通过名称生成
                        if(front::post('typename'.$index)!=""){
                            //新增内容
                            $inarray=array("listorder"=>front::post('listorder'.$index),
                                "typename"=>trim(str_replace("  └ ","",front::post('typename'.$index))),
                                "parentid"=>0,
                                "ispages"=>1,
                                "langid"=>lang::getlangid(lang::getisadmin()),
                            );
                            $inarray['typename']=trim(html_entity_decode($inarray['typename']),chr(0xc2).chr(0xa0));

                            if(front::post('htmldir'.$index)!=""){
                                $inarray['htmldir']=front::post('htmldir'.$index);
                            }else{
                                $inarray['htmldir']= pinyin::get2(front::post('typename'.$index));
                            }
                            //判断是否重复
                            $data=$this->_table->getrow("htmldir='".$inarray['htmldir']."' or typename='".$inarray['typename']."'");
                            if(is_array($data)){
                                front::flash(lang_admin("type_name").lang_admin("catalog_name").lang_admin("repetition"));
                                front::redirect(url::modify('act/list/table/' . $this->table, true));
                            }
                            //新增
                            $this->_table->rec_insert($inarray);
                        }
                    }
                }
            }
            //专题
            if ($this->table == 'special'){
                for ($index; $index > 0; $index--) {
                    //判断是否是新增修改的序号  不是不操作
                    if(!in_array($index,$cahngenumdata) || front::post('cahngenum')==""){
                        continue;
                    }
                    //判断修改还是新增加
                    if(front::post('spid'.$index)!=''){
                        //修改内容
                        $updatearray=array("listorder"=>front::post('listorder'.$index),
                            "title"=>front::post('title'.$index),
                        );
                        //修改
                        $this->_table->rec_update($updatearray, 'spid="'.front::post('spid'.$index).'"');
                    }else{
                        //新增
                            //新增内容
                            $inarray=array("listorder"=>front::post('listorder'.$index),
                                "title"=> front::post('title'.$index),
                                "langid"=>lang::getlangid(lang::getisadmin()),
                            );
                            $inarray['title']=trim(html_entity_decode($inarray['title']),chr(0xc2).chr(0xa0));
                            if(front::post('htmldir'.$index)!=""){
                                $inarray['htmldir']=front::post('htmldir'.$index);
                            }else{
                                $inarray['htmldir']=pinyin::get2(front::post('title'.$index));
                            }
                            //判断是否重复
                            $data=$this->_table->getrow("htmldir='".$inarray['htmldir']."' or title='".$inarray['title']."'");
                            if(is_array($data)){
                                front::flash(lang_admin("topic_name").lang_admin("catalog_name").lang_admin("repetition"));
                                front::redirect(url::modify('act/list/table/' . $this->table, true));
                            }
                            //新增
                            $this->_table->rec_insert($inarray);
                    }
                }
            }
        }
        front::flash("{$this->tname}".lang_admin('preservation').lang_admin('success')."！");
        front::redirect(url::modify('act/list/table/' . $this->table, true));

    }

    //获取栏目的设置收费
    function catidparentreadmenoy($catid){
        if ($catid==0){
            return array('readmenoy'=>0,'domwmenoy'=>0);
        }
        $category=category::getInstance();
        $categorydata=$category->getrow('catid='.$catid);
        if ($categorydata['readmenoy']>0 || $categorydata['domwmenoy']>0){
            return array('readmenoy'=>$categorydata['readmenoy'],'domwmenoy'=>$categorydata['domwmenoy']);
        }else{
            return $this->catidparentreadmenoy($categorydata['parentid']);
        }
    }

    /**
     * 生成vip激活码
     * @param int $nums             生成多少个优惠码
     * @param array $exist_array     排除指定数组中的优惠码
     * @param int $code_length         生成优惠码的长度
     * @param int $prefix              生成指定前缀
     * @return array                 返回优惠码数组
     */
    public function generateCode( $nums,$exist_array='',$code_length = 6,$prefix = '' ) {

        $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz";
        $promotion_codes = array();//这个数组用来接收生成的优惠码

        for($j = 0 ; $j < $nums; $j++) {

            $code = '';

            for ($i = 0; $i < $code_length; $i++) {

                $code .= $characters[mt_rand(0, strlen($characters)-1)];

            }

            //如果生成的4位随机数不再我们定义的$promotion_codes数组里面
            if( !in_array($code,$promotion_codes) ) {

                if( is_array($exist_array) ) {

                    if( !in_array($code,$exist_array) ) {//排除已经使用的优惠码

                        $promotion_codes[$j] = $prefix.$code; //将生成的新优惠码赋值给promotion_codes数组

                    } else {

                        $j--;

                    }

                } else {

                    $promotion_codes[$j] = $prefix.$code;//将优惠码赋值给数组

                }

            } else {
                $j--;
            }
        }

        return $promotion_codes;
    }

    function getfield_action()
    {
        if (get('aid')) {
            $data = $this->_table->getrow(get('aid'), '1 desc', $this->_table->getcols('modify'));
        }
        if (get('thiscatid')) {
            $data = $this->_table->getrow(get('thiscatid'), '1 desc', $this->_table->getcols('modify'));
        }
        $form=array();
        $base_url=front::$view->base_url;
        $field = $this->_table->getFields();
        $set_field = category::getpositionlink(get('catid'));
        //var_dump($set_field);
        $set_fields = array("0");
        if (is_array($set_field)) {
            foreach ($set_field as $key => $value) {
                $set_fields[] = $value['id'];
            }
        }
        $set_fields[] = get('catid');   //加上本身
        //var_dump($set_fields);

        $codedata=array();
        $shoppingcode=$code = '<div id="table_field">';
        $newcname='cname_'.lang::getisadmin();
        $newselect='select_'.lang::getisadmin();
        $newcatid='catid_'.lang::getisadmin();
        foreach ($field as $f) {
            $name = $f['name'];
            setting::$var[$this->table][$name][$newcatid]=isset(setting::$var[$this->table][$name][$newcatid])?setting::$var[$this->table][$name][$newcatid]:"";
            if (setting::$var[$this->table][$name][$newcatid] && !@in_array(setting::$var[$this->table][$name][$newcatid], $set_fields)) {
                unset($field[$name]);
                continue;
            }
            if (!preg_match('/^my_/', $name) || preg_match('/^my_field/', $name)) {
                unset($field[$name]);
                continue;
            }
            if (!isset($data[$name]))
                $data[$name] = '';
            //var_dump($data);
            if( ((setting::$var[$this->table][$name]['isshoping'] == '0') || (setting::$var[$this->table][$name]['isshoping'] == ''))
                && setting::$var[$this->table][$name]['istage'] !='1' ){
                if(setting::$var[$this->table][$name]['filetype']=="pic"){
                    $form[$name]['select']=setting::$var[$this->table][$name][$newselect];
                    $code .= '<div class="row">';
                    $code .='<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">'.setting::$var[$this->table][$name][$newcname].' </div>';
                    $code .='<div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">';
                    $code .='<div id="uploadarea">';
                    $code .='<div id="pv'.$name.'">';
                    $ic=0;
                    $data[$name]= unserialize($data[$name]);
                    if(is_array($data[$name])){
                            foreach($data[$name] as $k => $v){
                                $ic++;
                                if(!isset($v['url'])) continue;
                                //兼容老版本  老版本结构是{url:{url,alt},alt}  新版本是{url,alt}
                                if (isset($v['url']['url'])){
                                    $v['url']=$v['url']['url'];
                                    $v['alt']=isset($v['url']['alt'])?$v['url']['alt']:"";
                                }
                                $code .='<div id="'.$name.$ic.'_up" style="clear:both;">';
                                $code .='<span id="<?php echo $name.$ic;?>_preview" class="pull-left">';
                                $code .='<img style="width:90px;margin-right:10px;" src="'.$v['url'].'" border="0" />';
                                $code .='</span>';
                                $code .='<div class="blank10"></div>';
                                $code .='<input id="'.$name.$ic.'" value="'.$v['url'].'" class="form-control" name="'.$name.'['.$ic.'][url]" />';
                                $code .='<div class="blank10"></div>';
                                $code .='<input id="'.$name.$ic.'_del" onclick="pics_delete(\''.$ic.'\',\''.$name.'\');" value="'.lang_admin('delete').'" type="button" name="delbutton" class="btn btn-default" />';
                                $code .='<div class="blank10"></div>';
                                $code .='<input id="'.$name.$ic.'alt" value="'.$v['alt'].'" class="form-control" placeholder="'.lang_admin('text_description').'" name="'.$name.'['.$ic.'][alt]" />';
                                $code .='</div>';
                                $code .='<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="'.lang_admin('inside_the_page_there_are_many_pictures_pictures_and_text_instructions').'"></span>';
                                $code .='<div class="blank20"></div>';

                                }
                    }
                    $code .='</div>';
                    $code .='<input type="hidden" name="'.$name.'ic" id="'.$name.'ic" value="'.$ic.'" />';
                    $code .='<div class="blank10"></div>';
                    $code .='<div style="border: 1px dashed #ccc;border-radius:3px;">';
                    $code .='<a title="'.lang_admin('select_files').'" onclick="javascript:windowsdig(\''.lang_admin('select_files').'\',\'iframe:index.php?case=file&act=updialog&fileinputid='.$name.'&filed_name='.$name.'&getbyid=pv'.$name.'&max=99&checkfrom=piclistshow&admin_dir='.config::getadmin('admin_dir').'\',\'900px\',\'480px\',\'iframe\')" href="#body"><img src="'.$base_url.'/common/js/ajaxfileupload//pic.png" style="width:90px;max-width:90px;" /></a>';
                    $code .='</div>';
                    $code .='<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="'.lang_admin('inner_page_multi_graph_info').'"></span>';
                    $code .='</div>';
                    $code .='</div>';
                    $code .='</div>';
                    $code .= '<div class="clearfix blank20"></div>';
                }else{
                    $code .= '<div class="row">';
                    $code .= '<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">' . setting::$var[$this->table][$name][$newcname] . '</div>';
                    $code .= '<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left" id="con_one_6">';
                    $code .= form::getform($name, $form, $field, $data);
                    $code .= '</div>';
                    $code .= '</div>';
                    $code .= '<div class="clearfix blank20"></div>';
                }
            }else{
                //切换栏目的时候商品字段切换
              /*  $shoppingcode .= '<div class="row">';
                $shoppingcode .= '<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">' . setting::$var[$this->table][$name]['cname'] . '</div>';
                $shoppingcode .= '<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left" id="con_one_6">';
                $shoppingcode .= form::getform($name, $form, $field, $data);
                $shoppingcode .= '</div>';
                $shoppingcode .= '</div>';
                $shoppingcode .= '<div class="clearfix blank20"></div>';*/

            }
        }
        $code .= '</div>';
        $shoppingcode.= '</div>';
        $codedata[0]=$code;
        $codedata[1]=$shoppingcode;
        echo json_encode($codedata);
    }

    //复制框  栏目加载
    function getcopylangcatory_action(){
        $select = "";
          if (front::get('langurlname')) {
              if (front::get('shopping')) {
                  $catdata = category::optionshopping('0', 'all', $option, $level, front::get('langurlname'));
              }else{
                  $catdata = category::optionall(0, 'all', $option, $level, front::get('langurlname'));
              }
              foreach ($catdata as $k => $d) {
                  $select .= "<option value=\"$k\" >$d</option>";
              }
              $select="<option value=\"0\" selected>".lang_admin('请选择')."...</option>".$select;
          }
        echo json_encode($select);
        exit;
    }

    function block_action()
    {
        $id = intval(front::$get['id']);
        $data = $this->_table->getrow($id);
        if ($data['isblock']) {
            $data = array('isblock' => 0);
            $msg = lang_admin('thaw');
        } else {
            $data = array('isblock' => 1);
            $msg =lang_admin('frozen');
        }
        $this->_table->rec_update($data, $id);
        alertinfo($msg .lang_admin('success'), $_SERVER['HTTP_REFERER']);
    }

    function clean_action()
    {
        $id = intval(front::$get['id']);
        $data = $this->_table->getrow($id);
        if ($data['isdelete']) {
            $data = array('isdelete' => 0);
            $msg =lang_admin('pull_back');
        } else {
            $data = array('isdelete' => 1);
            $msg =lang_admin('retreat');
        }
        $this->_table->rec_update($data, $id);
        alertinfo($msg . lang_admin('success'), $_SERVER['HTTP_REFERER']);
    }

    function edit_action()
    {
        if ($this->table == 'category') {
            chkpw('category_edit');
        }
        if ($this->table == 'archive') {
            chkpw('archive_edit');
        }
        if ($this->table == 'type') {
            chkpw('type_edit');
            front::$post['typecontent'] = isset(front::$post['typecontent'])?htmlspecialchars_decode(front::$post['typecontent']):"";
        }
        if ($this->table == 'special') {
            chkpw('special_edit');
            front::$post['description'] =isset(front::$post['description'])?htmlspecialchars_decode(front::$post['description']):"";
        }
        if ($this->table == 'user') {
            chkpw('user_edit');
        }
        if ($this->table == 'usergroup') {
            chkpw('usergroup_edit');
        }
        if ($this->table == 'orders') {
            chkpw('order_edit');
        }
        if ($this->table == 'comment') {
            chkpw('func_comment_edit');
        }
        if ($this->table == 'guestbook') {
            chkpw('func_book_reply');
        }
        if ($this->table == 'announcement') {
            chkpw('func_announc_edit');
            front::$post['content'] = isset(front::$post['content'])?htmlspecialchars_decode(front::$post['content']):"";
        }
        if ($this->table == 'linkword') {
            chkpw('seo_linkword_edit');
        }
        if ($this->table == 'friendlink') {
            chkpw('seo_friendlink_edit');
        }

        //判断是不是商品栏目编辑
        if (isset(front::$get['shopping']) && front::$get['shopping'] ) {
            if (session::get('ver') != 'corp'){
                front::alert(lang_admin('no_permission'));
            }
            $this->view->shopping='1';
        }else{
            $this->view->shopping='0';
        }

        //用户异步提取图库图片
        if (isset(front::$get['ajax']) && front::$get['ajax']) {
            front::$get['dir'] = front::$get['ajax'];
            $img_arr = image_admin::listimg_action();
            foreach ($img_arr as $v) {
                echo '<img src="upload/images/' . front::$get['dir'] . '/' . $v . '" id="img' . str_replace('.', '', $v) . '" onClick="select_img(\'img' . str_replace('.', '', $v) . '\');" />';
            }
            exit();
        }
        //插件或者在线模板
        if ($this->table == 'apps' ||$this->table == 'buytemplate'||$this->table == 'buymodules'
            ||$this->table == 'wxapptemplate'){
            front::$get['id']="id='".front::get('id')."'";
        }
        //tag
        if ($this->table == 'tag' ){
            front::$get['id']="tagname='".front::get('id')."'";
        }
        if (front::post('submit') && $this->manage->vaild()) {
            $this->manage->filter($this->Exc);
            $this->manage->edit_before();
            $this->manage->save_before();
            if ($this->table == 'user') {
                //var_dump($_SESSION);
                if (!Phpox_token::is_token('user_add', front::$post['token'])) {
                    exit(lang_admin('token_error'));
                }
            }

            if ($this->table == 'orders') {
                if(front::$post['courier_number']!=''){
                    front::$post['status']='2';
                }
                front::$post['menoy'] = front::$post['menoy']- front::$post['admindiscounts'];
                front::$post['menoy']=front::$post['menoy']>0?front::$post['menoy']:0;
            }

            if ($this->table == 'category') {
                //商品栏目
                if (front::$post['isshopping']) {
                    front::$post['template'] = front::$post['templateshopping'];
                    front::$post['showtemplate'] = front::$post['showshoppingtemplate'];
                    front::$post['listtemplate'] = front::$post['listshoppingtemplate'];
                    front::$post['parentid'] = front::$post['catidshopping'];
                }

                //是否设置前台首页
                if(front::$post['isindex']){
                    $this->_table->rec_update("isindex=0",'1=1');
                }

                //兼容单引号
                front::$post['catname']=str_replace("'", "\'", front::$post['catname']);
                front::$post['subtitle']=str_replace("'", "\'", front::$post['subtitle']);
                front::$post['categorycontent']=str_replace("'", "\'", front::$post['categorycontent']);
            }

            //商品模板
            if ($this->table == 'archive'){
                //兼容单引号
                front::$post['content']=str_replace("'", "\'", front::$post['content']);
                front::$post['introduce']=str_replace("'", "\'", front::$post['introduce']);
                front::$post['title']=str_replace("'", "\'", front::$post['title']);
                front::$post['subtitle']=str_replace("'", "\'", front::$post['subtitle']);

                if(isset(front::$post['isshopping']) && front::$post['isshopping']){
                    front::$post['template']=front::$post['templateshopping'];
                    $langdata=lang::getlang();
                    if(is_array($langdata)){
                        foreach ($langdata as $key=>$value){
                            $newcname='attr2_'.$value['langurlname'];
                            $newatt2[$newcname]=front::$post[$newcname];
                        }
                    }
                    front::$post['attr2']=json_encode($newatt2);
                }

                if(isset(front::$post['buyurl']) && front::$post['buyurl'] !=''){
                    front::$post['buyurl']=htmlspecialchars_decode(front::$post['buyurl']);
                }
                //简介截取
                if(front::$post['introduce'] !=''){
                    front::$post['introduce']=mb_substr(front::$post['introduce'],0,config::getadmin('archive_introducelen'));

                }

            }

            if ($this->table == 'guestbookfield') {
                $langdata = lang::getlang();
                $newshownamedata = array();
                $newmessagedata = array();
                $newfieldvaluedata = array();
                if (is_array($langdata)) {
                    foreach ($langdata as $key => $value) {
                        $newshowname = 'showname_' . $value['langurlname'];
                        $newmessage = 'message_' . $value['langurlname'];
                        $newfieldvalue = 'fieldvalue_' . $value['langurlname'];
                        $newshownamedata[$newshowname] = front::$post[$newshowname];
                        $newmessagedata[$newmessage] = front::$post[$newmessage];
                        $newfieldvaluedata[$newfieldvalue] = front::$post[$newfieldvalue];
                    }
                }
                front::$post['showname'] = serialize($newshownamedata);
                front::$post['message'] = serialize($newmessagedata);
                front::$post['fieldvalue'] = serialize($newfieldvaluedata);
            }


            $update = $this->_table->rec_update(front::$post, front::get('id'));
            if ($this->table == 'category' && front::post('image') != '' && front::post('image_del')) {
                @unlink(front::post('image'));
                $update = $this->_table->rec_update(array('image' => ''), front::get('id'));
            }
            if ($this->table == 'templatetag' || $this->table == 'shoptemplatetag') {
                unset(front::$post['submit']);
                if (front::$post['tagfrom'] != 'define' && !preg_match('/^tag_(.*?)+\.html$/is', front::$post['tagtemplate'])) {
                    exit(lang_admin('illegal_parameter'));
                }
                front::$post['tagcontent'] = stripslashes(stripslashes(front::$post['tagcontent']));
                if (front::$post['tagfrom'] == 'content') {
                    $path = ROOT . '/config/tag/content_' . intval(front::get('id')) . '.php';
                } else {
                    $path = ROOT . '/config/tag/category_' . intval(front::get('id')) . '.php';
                }
                $tag_config = serialize(front::$post);
                file_put_contents($path, $tag_config);
                front::redirect(url::modify('act/list/table/templatetag/tagfrom/'.front::post('tagfrom'), true));
            }

            if ($update < 1) {
                front::flash("{$this->tname}".lang_admin('modify').lang_admin('failure')."！");
            } else {
                event::log(lang_admin('modify'). $this->tname . "ID=" . front::get('id'), lang_admin('success'));
                $this->manage->save_after(front::get('id'));
                $info = '';
                if ($this->table == 'archive') {
                    $url = url('archive/show/aid/' . front::get('id'), false);
                    if (front::get('site') == 'default' || front::get('site') == '') {
                        $info = '<a href="' . $url . '" target="_blank">'.lang_admin('see').'</a>';
                    }
                }
                if ($this->table == 'archive') {   //跳回当前商品的列表页面
                    front::redirect(url::modify('act/list/table/' . $this->table.'/catid/'.front::post('catid'),true));
                }
                front::flash("{$this->tname}".lang_admin('modify').lang_admin('success')."！$info");
                $from = session::get('from');
                session::del('from');
                if (!front::post('onlymodify'))
                    front::redirect(url::modify('act/list/table/' . $this->table, true));
            }
        }
        $tag_option_info = settings::getInstance()->getrow(array('tag' => 'table-hottag'));
        $tag_option_arr =isset($tag_option_info['value'])?unserialize($tag_option_info['value']):"";
        $this->view->tag_opton = isset($tag_option_arr['hottag'])?explode("\n", $tag_option_arr['hottag']):"";
        $this->view->image_dir = image_admin::listdir();
        $this->view->token = Phpox_token::grante_token('user_add');
        //var_dump($this->view->token);
        if (!session::get('from'))
            session::set('from', front::$from);
        if (!front::get('id'))
            exit("PAGE_NOT FOUND!");
        $this->_view_table = $this->_table->getrow(front::get('id'), '1 desc', $this->_table->getcols('modify'));

        if ($this->table == 'archive'){
            //区分商品和文章
            $categorydata=category::getInstance()->getrow(" isshopping=1 and catid=".$this->_view_table['catid']);
            if (is_array($categorydata)){
                $this->view->shopping=1;
            }else{
                $this->view->shopping=0;
            }
        }
       /* if ($this->table == 'tag'){
            //判断范围
                if($this->_view_table['ranges']!=""){
                    $categorydata=category::getInstance()->getrows("catid in (".$this->_view_table['ranges'].")",0);
                    foreach ($categorydata as $key=>$val){
                        if ($this->_view_table['rangesname']!=""){
                            $this->_view_table['rangesname'].=','.$val['catname'];
                        }else{
                            $this->_view_table['rangesname']=$val['catname'];
                        }
                    }
                }

        }*/
        if (is_array($this->_view_table)) {
                if ($this->table == 'guestbookfield') {
                    $this->_view_table['showname'] = unserialize($this->_view_table['showname']);
                    $this->_view_table['message'] = unserialize($this->_view_table['message']);
                    $this->_view_table['fieldvalue'] = unserialize($this->_view_table['fieldvalue']);
                }
        }

        //插件订单
        if ($this->table == 'appsorders'){
            switch ($this->_view_table['static']) {
                case 1:
                    $this->_view_table['statics'] = lang_admin('complete');       //完成
                    break;
                default:
                    $this->_view_table['statics'] = lang_admin('no_buyapps'); //未支付
                    break;
            }
            preg_match_all("/-(.*)-(.*)/isu",$this->_view_table['oid'], $oidout);
            //手续费
            $this->view->freetotal = 0;
            //获取产品
            $orderssomedata = array();
            $ordersAid = explode(",", trim($this->_view_table['appsid']));
            $discount = usergroup::getusergrop(user::getuserid($oidout[1][0])); //获取用户组的折扣
            $isint = usergroup::getisint(user::getuserid($oidout[1][0]));      //获取是否取整
            if(apps::getappsname($this->_view_table['appsid'])){   //判断是在线模板的订单还是插件的订单  查询插件名称是否存在
                $buytemplatedata = apps::getInstance()->getrow("id='" . $this->_view_table['appsid']."'");//查询插件
                $buytemplatedata['price'] = (floatval($buytemplatedata['price']) * $discount / 10);   //单价打折
                $buytemplatedata['img'] = $buytemplatedata['icon'];
                $buytemplatedata['code'] = $buytemplatedata['name'];
                if ($isint) {                                  //判断取整
                    $buytemplatedata['price'] = round($buytemplatedata['price']);
                }
                $orderssomedata[count($orderssomedata)] = $buytemplatedata;
            }else{
                for ($index = 0; $index < count($ordersAid); $index++) {
                    $buytemplatedata = buytemplate::getInstance()->getrow("code='" . $ordersAid[$index] . "'");//查询在线模板
                    $buytemplatedata['price'] = (floatval($buytemplatedata['price']) * $discount / 10);   //单价打折
                    if ($isint) {                                  //判断取整
                        $buytemplatedata['price'] = round($buytemplatedata['price']);
                    }
                    $orderssomedata[count($orderssomedata)] = $buytemplatedata;
                }
            }
            $this->view->archivearr1 = $this->view->_archivearr = $orderssomedata;

            foreach ($this->view->archivearr1 as $key => $val) {
                $where = array();
                $payfilename = $where['pay_code'] = $this->view->paytype;
                $where['langid'] = lang::getlangid(lang::getistemplate());
                $this->view->pay = pay::getInstance()->getrows($where);
                $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
                //重算总价  手续费+单价
                $this->view->archivearr1[$key]['total'] = $val['price'] + ($val['price'] * $this->view->pay[0]['pay_fee']);
                // 总价 总和
                $this->view->total += $val['price'] + ($val['price'] * $this->view->pay[0]['pay_fee']);

                //计算手续费
                $this->view->freetotal += $val['price'] * $this->view->pay[0]['pay_fee'];
            }
            $this->view->total = $this->view->total > 0 ? $this->view->total : 0;

            //优惠劵使用
            $couponmenoy = array();
            $this->view->fktotal = $this->view->total;
            if (isset($this->_view_table['somecoupon']) && $this->_view_table['somecoupon'] != '') {
                if (strpos(trim($this->_view_table['somecoupon']), ',') !== false) {
                    $source = explode(",", trim($this->_view_table['somecoupon']));
                    for ($index = 0; $index < count($source); $index++) {
                        $coupondata = coupon::getcouponid($source[$index]);; //优惠劵信息获取
                        $this->view->fktotal = (float)($this->view->total) - (float)($coupondata['moeny']);
                        $couponmenoy[count($couponmenoy)] = array((int)$coupondata['moeny'], $coupondata['coupontitle']); //保存优惠金额
                    }
                } else {
                    $coupondata = coupon::getcouponid($this->view->orders['somecoupon']);; //优惠劵信息获取
                    $this->view->fktotal = (float)($this->view->total) - (float)($coupondata['moeny']);
                    $couponmenoy[count($couponmenoy)] = array((int)$coupondata['moeny'], $coupondata['coupontitle']);  //保存优惠金额
                }
            }
            $this->view->archivearr1['couponmenoy'] = $couponmenoy;

        }
        //var_dump($this->_view_table);exit;
        if (!is_array($this->_view_table))
            exit("PAGE_NOT FOUND!");
        $this->manage->view_before($this->_view_table);
    }

    //导航是否显示修改
    function editisnav_action(){
        $update = $this->_table->rec_update(array('isnav' => front::get('isnav')), front::get('id'));
        if ($update < 1) {
            front::flash("{$this->tname}".lang_admin('modify').lang_admin('failure')."！");
        } else {
            event::log(lang_admin('modify') . $this->tname . "ID=" . front::get('id'), lang_admin('success'));
        }
        front::redirect(url::modify('act/list', true));
    }

    //留言审核
    function editstate_action(){

            $update = $this->_table->rec_update(array('checked' => '1'), front::get('id'));
            if ($update < 1) {
                front::flash("{$this->tname}".lang_admin('modify').lang_admin('failure')."！");
            } else {
                event::log(lang_admin('modify') . $this->tname . "ID=" . front::get('id'), lang_admin('success'));
            }
            front::flash("{$this->tname}".lang_admin('to_examine').lang_admin('complete')."！");
        front::redirect(url::modify('act/list', true));

        $this->_view_table = $this->_table->getrow(front::get('id'), '1 desc', $this->_table->getcols('modify'));
        if (!is_array($this->_view_table))
            exit("PAGE_NOT FOUND!");
        $this->manage->view_before($this->_view_table);
    }

    function htmlrule_action()
    {
        chkpw('category_htmlrule');
        $filename = ROOT . '/data/htmlrule.php';
        $arr = include($filename);
        if (!is_array($arr)) $arr = array();
        if (front::post('submit')) {
            if (front::post('htmlrule')) {
                //file_put_contents($filename, file_get_contents($filename).front::post('htmlrule')."\r\n");
                $tmp['hrname'] = front::post('hrname');
                $tmp['htmlrule'] = front::post('htmlrule');
                $tmp['cate'] = front::post('cate');
                $arr[count($arr)]=$tmp;
                file_put_contents($filename, '<?php return ' . var_export($arr, true) . ';');
                front::flash(lang_admin('added_successfully'));
                front::redirect(url::modify('act/htmlrule/table/category/cate/'.front::post('cate'), true));
            }
        }
        if (front::get('o') == 'del' && front::get('id')) {
            $id = front::get('id') - 1;
            $oldcate=$arr[$id]['cate'];
            unset($arr[$id]);
            file_put_contents($filename, '<?php return ' . var_export($arr, true) . ';');
            front::flash("HTMLrule".lang_admin('delete').lang_admin('success'));
            front::redirect(url('table/htmlrule/table/category/cate/'.$oldcate, true));
        }

        foreach ($arr as $key=>$val){
            if(front::get("cate")!=$val['cate']){
                unset($arr[$key]);
            }
        }

        $this->_view_table = $arr;
        $this->view->cate = front::get("cate");
    }

    function htmlruleedit_action()
    {
        chkpw('category_htmlrule');
        $filename = ROOT . '/data/htmlrule.php';
        $arr = include($filename);
        if (!is_array($arr)) $arr = array();
        if (front::post('submit')) {
            if (front::post('htmlrule')) {
                $tmp['hrname'] = front::post('hrname');
                $tmp['htmlrule'] = front::post('htmlrule');
                $tmp['cate'] = front::post('cate');
                $arr[front::get('id')]=$tmp;
                file_put_contents($filename, '<?php return ' . var_export($arr, true) . ';');
                front::flash(lang_admin('edit').lang_admin('success'));
                front::redirect(url::modify('act/htmlrule/table/category/cate/'.front::post('cate'), true));
            }
        }
        $this->_view_table = $arr[front::get('id')];
    }

    function mail_action()
    {
        chkpw('seo_mail_usersend');
        $where = null;
        $ordre = '1 desc';
        if ($this->table == 'archive') {
            $ordre = "`order`,1 DESC";
            $where = $this->_table->get_where('manage');
            if (!front::post('_typeid'))
                session::del('_typeid');
            if (get('_typeid') && file_exists(ROOT."/lib/table/type.php")) {
                $typeid = get('_typeid');
                session::set('_typeid', $typeid);
                $this->type = type::getInstance();
                $types = $this->type->sons($typeid);
                $types[] = $typeid;
                $where .= ' and typeid in(' . trim(implode(',', $types), ',') . ')';
            }
            if (get('typeid')) {
                $typeid = get('typeid');
                $where .= ' and typeid=' . $typeid;
            }
            if (!front::post('_title'))
                session::del('_title');
            if (get('_title')) {
                $title = get('_title');
                session::set('_title', $title);
                $where .= " and title like '%$title%' ";
            }
        }
        if ($this->table == 'templatetag') {
            if (front::get('tagfrom')) {
                $where = "tagfrom='" . front::get('tagfrom') . "'";
            } else
                $where = "tagfrom='define'";
            $where .= " and (`tagvar` IS NULL OR `tagvar` = '') ";
        }
        if ($this->table == 'option') {
            $ballot = new ballot();
            $where = array('bid' => front::$get['bid']);
            session::set('bid', front::$get['bid']);
            $row = $ballot->getrow(array('id' => front::$get['bid']));
            $this->view->ballot = $row;
        }
        $limit = ((front::get('page') - 1) * $this->_pagesize) . ',' . $this->_pagesize;
        $this->_view_table = $this->_table->getrows($where, $limit, $ordre, $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }

    //群发通知
    function notification_action()
    {
        chkpw('seo_mail_usersend');
        if(front::post('batch') == 'allnext'){
            front::post('userwhere') ? $where = "groupid in (" . front::post('userwhere') . ")" : $where = '';
            $ordre = '1 desc';
            $userdata=$this->_table->getrows($where, 0, $ordre);
            $userid='';
            $usertel='';
            $useremail='';
            $username='';
            if($userdata){
                foreach ($userdata as $val){
                    if ($userid==""){
                        $userid=$val['userid'];
                    }else{
                        $userid.=','.$val['userid'];
                    }

                    if ($usertel==""){
                        $usertel=$val['tel'];
                    }else{
                        $usertel.=','.$val['tel'];
                    }

                    if ($useremail==""){
                        $useremail=$val['e_mail'];
                    }else{
                        $useremail.=','.$val['e_mail'];
                    }

                    if ($username==""){
                        $username=$val['username'];
                    }else{
                        $username.=','.$val['username'];
                    }
                }
            }
            $this->view->userid =$userid;
            $this->view->usertel =$usertel;
            $this->view->useremail =$useremail;
            $this->view->username =$username;
            $this->view->next=true;
            echo '11111121111';
        }else
        if(front::post('batch') == 'next'){
                front::get('id') ? $where = "userid in (" . front::get('id') . ")" : $where = '';
                $ordre = '1 desc';
                $userdata=$this->_table->getrows($where, 0, $ordre);
                $userid='';
                $usertel='';
                $useremail='';
                $username='';
                if($userdata){
                    foreach ($userdata as $val){
                            if ($userid==""){
                                $userid=$val['userid'];
                            }else{
                                $userid.=','.$val['userid'];
                            }

                            if ($usertel==""){
                                $usertel=$val['tel'];
                            }else{
                                $usertel.=','.$val['tel'];
                            }

                            if ($useremail==""){
                                $useremail=$val['e_mail'];
                            }else{
                                $useremail.=','.$val['e_mail'];
                            }

                            if ($username==""){
                                $username=$val['username'];
                            }else{
                                $username.=','.$val['username'];
                            }
                    }
                }
            $this->view->userid =$userid;
            $this->view->usertel =$usertel;
            $this->view->useremail =$useremail;
            $this->view->username =$username;
            $this->view->next=true;
        }else
        if(front::post('submit')){
            front::$post['static']=1;
            front::$post['adddatatime']=date('Y-m-d h:i:s', time());
            $insert=notification::getInstance()->rec_insert(front::$post);
            if($insert>0){
                front::flash("{$this->tname}".lang_admin('send_out').lang_admin('notice').lang_admin('success'));
                //发送短信
                if(front::$post['usertel']!='' && front::$post['istel']){
                    $source = explode(",",trim(front::$post['usertel']));
                    for($index=0;$index<count($source);$index++){
                        sendMsg($source[$index], front::$post['note']);
                    }
                }
                //发送邮箱
                if(front::$post['useremail']!='' && front::$post['isemail']){
                    $source = explode(",",trim(front::$post['useremail']));
                    for($index=0;$index<count($source);$index++){
                        $source[$index] = strtr($source[$index], '[', '<');
                        $source[$index] = strtr($source[$index], ']', '>');
                        include_once(ROOT . '/lib/plugins/smtp.php');
                        $mailtype = "HTML";
                        $smtp = new include_smtp(config::getadmin('smtp_mail_host'), config::getadmin('smtp_mail_port'), config::getadmin('smtp_mail_auth'), config::getadmin('smtp_mail_username'), config::getadmin('smtp_mail_password'));
                        $smtp->debug = false;
                        $smtp->sendmail($source[$index], config::getadmin('smtp_user_add'),front::$post['title'], front::$post['note'], $mailtype);
                    }
                }
            }
             front::redirect(url::modify('act/notification/table/user', true));
        }
            $where = null;
            $usergropdata=usergroup::getInstance()->getrows("isadministrator='0'",0);
            if (is_array($usergropdata)){
                foreach ($usergropdata as $val){
                    if ($where==null){
                        $where=$val['groupid'];
                    }else{
                        $where=$where.','.$val['groupid'];
                    }
                }
            }
            //全员用户条件
            $this->view->userwhere=$where;
            if ($where!=null){
                $where=' groupid in ('.$where.') ' ;
                $ordre = '1 desc';
                $limit = ((front::get('page') - 1) * $this->_pagesize) . ',' . $this->_pagesize;
                $this->_view_table = $this->_table->getrows($where, $limit, $ordre, $this->_table->getcols('manage'));
            }
            $this->view->record_count = $this->_table->record_count;

    }

    function send_action()
    {
        if (front::get('type') == 'subscription') {
            chkpw('seo_mail_subscription');
        }
        if (front::get('table') == 'user') {
            chkpw('seo_mail_send');
            if(session::get('ver') != 'corp'){
                front::alert(lang_admin('unauthorized_access'));
            }
        }
        if (front::post('submit') && $this->manage->vaild()) {
            $_POST['mail_address'] = strtr($_POST['mail_address'], '[', '<');
            $_POST['mail_address'] = strtr($_POST['mail_address'], ']', '>');
            include_once(ROOT . '/lib/plugins/smtp.php');
            $mailsubject = mb_convert_encoding($title, 'GB2312', 'UTF-8');
            $mailtype = "HTML";
            $smtp = new include_smtp(config::getadmin('smtp_mail_host'), config::getadmin('smtp_mail_port'), config::getadmin('smtp_mail_auth'), config::getadmin('smtp_mail_username'), config::getadmin('smtp_mail_password'));
            $smtp->debug = false;
            $smtp->sendmail($_POST['mail_address'], config::getadmin('smtp_user_add'), $_POST['title'], $_POST['content'], $mailtype);
            front::flash('<font color=red>'.lang_admin('send_mail').lang_admin('success').'</font>');
        }
        if (!session::get('from'))
            session::set('from', front::$from);
        front::get('id') ? $where = "userid in (" . front::get('id') . ")" : $where = '';
        //var_dump($where);
        $this->_view_table = $this->_table->getrow($where, '1', $this->_table->getcols('modify'));
        $this->manage->view_before($this->_view_table);
    }

    function sendsms_action()
    {
        if (front::post('submit') && $this->manage->vaild()) {
            //var_dump(front::$post);
            sendMsg(front::$post['mail_address'], front::$post['content']);
            front::flash('<font color=red>'.lang_admin('send_out').lang_admin('short_message').lang_admin('success').'!</font>');
        }
        front::get('id') ? $where = "userid in (" . front::get('id') . ")" : $where = '';
        //var_dump($where);
        $this->_view_table = $this->_table->getrow($where, '1', $this->_table->getcols('modify'));
        $this->manage->view_before($this->_view_table);
    }

    function show_action()
    {
        front::check_type(front::$get['id']);
        $this->_view_table = $this->_table->getrow(front::$get['id'], '1 desc', $this->_table->getcols('modify'));
    }

	function result_action()
    {
        //var_dump($_GET);
        $bid = intval(front::$get['bid']);
        $votelogs = votelogs::getInstance();
        $rows = $votelogs->getrows(array('bid' => $bid));
        $voteduser = array_to_hashmap($rows, 'uid', 'username');
        //var_dump($voteduser);
        $user = user::getInstance();
        $rows = $user->getrows('', 0);
        $alluser = array_to_hashmap($rows, 'userid', 'username');
        //var_dump($alluser);
        $unvoteuser = array_diff_assoc($alluser, $voteduser);
        $this->_view_table['data']['voteduser'] = $voteduser;
        $this->_view_table['data']['unvoteuser'] = $unvoteuser;
        //$this->render();
        //var_dump($arr);
        //var_dump($rows);
        //var_dump($bid);
    }

    function batch_action()
    {
        if (front::post('batch') && front::post('select')) {

            $str_select = implode(',', front::post('select'));
            //$select = implode(',', front::post('select'));
     //插件删除
            if ($this->table == 'apps' || $this->table == 'buytemplate' || $this->table == 'wxapptemplate' || $this->table == 'buymodules'){
                $this->_table->primary_key="id";
                $str_select="";
                foreach ( front::post('select') as $value){
                    if($str_select==""){
                        $str_select="'".$value."'";
                    } else{
                        $str_select.=",'".$value."'";
                    }
                }
            }
             $select = $this->_table->primary_key . ' in (' . $str_select . ')';
            if (front::post('batch') == 'check') {
                if ($this->table == 'archive') {
                    chkpw('archive_check');
                }
                $check = $this->_table->rec_update(array('checked' => 1), $select);
                if ($check > 0) {
                    front::flash("{$this->tname}".lang_admin('to_examine').lang_admin('complete')."！");
                    event::log(lang_admin('to_examine').lang_admin('through') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('to_examine').lang_admin('failure')."！");

                }
            }
            elseif (front::post('batch') == 'nocheck'){
                if ($this->table == 'archive') {
                    chkpw('archive_check');
                }
                $check = $this->_table->rec_update(array('checked' => 0), $select);
                if ($check > 0) {
                    front::flash("{$this->tname}".lang_admin('cancellation_of_audit').lang_admin('complete')."！");
                    event::log(lang_admin('cancellation_of_audit').lang_admin('through') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
            } else {
                    front::flash("{$this->tname}".lang_admin('cancellation_of_audit').lang_admin('failure')."！");
                }
            }
            elseif (front::post('batch') == 'cancelcheck') {
                $check = $this->_table->rec_update(array('checked' => 0), $select);
                if ($check > 0) {
                    front::flash("{$this->tname}".lang_admin('complete').lang_admin('cancellation_of_audit')."！");
                    event::log(lang_admin('cancellation_of_audit'). $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('without').lang_admin('cancellation_of_audit')."！");
                }
            }
            elseif (front::post('batch') == 'move' && front::post('typeid')) {
                if (in_array(front::post('typeid'), front::post('select')))
                    front::flash(lang_admin('cannot_be_moved_to_this_category'));
                else {
                    $check = $this->_table->rec_update(array('parentid' => front::post('typeid')), $select);
                    if ($check > 0) {
                        front::flash(lang_admin('classification_move_successfully'));
                        event::log(lang_admin('classification_move'). $this->tname . ",ID=" . $str_select, lang_admin('success'));
                    } else {
                        front::flash(lang_admin('no_classification_was_moved'));
                    }
                }
            }
            elseif (front::post('batch') == 'move' && front::post('catid')) {
                if (in_array(front::post('catid'), front::post('select')))
                    front::flash(lang_admin('can_not_move_to_this_column'));
                else {
                    $check = $this->_table->rec_update(array('parentid' => front::post('catid')), $select);
                    if ($check > 0) {
                        front::flash(lang_admin('column_moved_successfully'));
                        event::log(lang_admin('column_moved') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
                    } else {
                        front::flash(lang_admin('no_columns_have_been_moved'));
                    }
                }
            }
            elseif (front::post('batch') == 'movelist' && front::post('catid')) {
                $check = $this->_table->rec_update(array('catid' => front::post('catid')), $select);
                if ($check > 0) {
                    front::flash(lang_admin('move_successfully'));
                    event::log(lang_admin('content_moved') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash(lang_admin('no_content_has_been_moved'));
                }
            }
            elseif (front::post('batch') == 'recommend' && isset(front::$post['attr1'])) {
                $check = $this->_table->rec_update(array('attr1' => front::post('attr1')), $select);
                if ($check > 0) {
                    front::flash(lang_admin('setup_recommendation_successful'));
                    event::log(lang_admin('setup_recommendation') . $this->tname . ",ID=" . $str_select,  lang_admin('success'));
                } else {
                    front::flash(lang_admin('no_content_is_set'));
                }
            }
            elseif (front::post('batch') == 'deletestate') {
                if ($this->table == 'archive') {
                    chkpw('archive_del');
                }
                $deletestate = $this->_table->rec_update(array('state' => -1), $select);
                if ($deletestate > 0) {
                    front::flash("{$this->tname}".lang_admin('has_been_moved_to_the_Recycle_Bin')."！");
                    event::log(lang_admin('moved_to_the_Recycle_Bin') . $this->tname . ",ID=" . $str_select,  lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('not_moved_to_the_Recycle_Bin')."！");
                }
            }
            elseif (front::post('batch') == 'restore') {
                $deletestate = $this->_table->rec_update(array('state' => 1), $select);
                if ($deletestate > 0) {
                    front::flash("{$this->tname}".lang_admin('has_been_restored')."！");
                    event::log(lang_admin('reduction') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('not_restored')."！");
                }
            }
            elseif (front::post('batch') == 'docheck') {
                $deletestate = $this->_table->rec_update(array('checked' => 1), $select);
                $deletestate = $this->_table->rec_update(array('state' => 1), $select);
                if ($deletestate > 0) {
                    front::flash("{$this->tname}".lang_admin('to_examine').lang_admin('complete')."！");
                    event::log(lang_admin('to_examine').lang_admin('through') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('to_examine').lang_admin('failure')."！");
                }
            }
            elseif (front::post('batch') == 'douncheck') {
                $deletestate = $this->_table->rec_update(array('checked' => 0), $select);
                $deletestate = $this->_table->rec_update(array('state' => 0), $select);
                if ($deletestate > 0) {
                    front::flash("{$this->tname}".lang_admin('cancellation_of_audit')."！");
                    event::log(lang_admin('cancellation_of_audit') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('without').lang_admin('cancellation_of_audit')."！");
                }
            }
            elseif (front::post('batch') == 'top') {
                $deletestate = $this->_table->rec_update(array('toppost' => 3), $select);
                if ($deletestate > 0) {
                    front::flash("{$this->tname}".lang_admin('topping')."！");
                    event::log(lang_admin('topping') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('without').lang_admin('topping')."！");
                }
            }
            elseif (front::post('batch') == 'delete') {
                if ($this->table == 'archive') {
                    chkpw('archive_del');
                }
                if ($this->table == 'coupon'){
                    $select ='couponid' . ' in (' . $str_select . ')';
                }

                foreach (front::post('select') as $id) {
                    //还原库存
                    if ($this->table == 'orders') {
                        $orders = new orders();
                        //获取到购买的商品  进行计算销售量
                        $tabledata = $orders->getrows("id='".$id."'", 1); //查询订单表
                        if(is_array($tabledata)){
                            //获取到购买的商品  进行计算库存
                            $ordersAid = explode("-",trim($tabledata[0]['aid']));
                            //循环多个商品
                            for($index=0;$index<count($ordersAid);$index++){
                                $source = explode("#",trim($ordersAid[$index]));
                                $_aidArrys = explode(",", trim($source[0]));
                                $datavuel = archive::getInstance()->getrows('aid = '.$_aidArrys[0],1);
                                //库存还原
                                $inventorynum=$datavuel[0]['inventory']+(int)($_aidArrys[1]);
                                //修改库存
                                archive::getInstance()->rec_update(array('inventory'=>$inventorynum), $_aidArrys[0]);
                            }
                        }
                    }
                    //自定义留言字段删除
                    if ($this->table == 'guestbookfield'){
                        $this->deleteguestbookfield($id);
                    }
                    $this->manage->delete_before($id);
                }

                //栏目删除  同时删除子栏目
                if ($this->table == 'category'){
                    $select="";
                    foreach (front::post('select') as $id) {
                        $newselect= explode(',', $select);

                        if($select!=$id && !in_array($id,$newselect)){
                            if ($select!=""){
                                $select.=','.$id;
                            }else{
                                $select.=$id;
                            }
                        }
                        //子栏目
                        $newsonall = explode(',', category::sonall($id));
                        if(category::sonall($id)){
                            foreach ($newsonall as $id) {
                                $newselect= explode(',', $select);
                                if($select!=$id && !in_array($id,$newselect)){
                                    if ($select!=""){
                                        $select.=','.$id;
                                    }else{
                                        $select.=$id;
                                    }
                                }
                            }
                        }

                    }
                    $select="catid in (".$select.")";
                }
                //分类删除  同时删除子分类
                if ($this->table == 'type' && file_exists(ROOT."/lib/table/type.php")){
                    $select="";
                    foreach (front::post('select') as $id) {
                        $newselect= explode(',', $select);
                        if($select!=$id && !in_array($id,$newselect)){
                            if ($select!=""){
                                $select.=','.$id;
                            }else{
                                $select.=$id;
                            }
                        }
                        //子分类
                        $newsonall=explode(',',type::sonall($id,true));
                        foreach ($newsonall as $id) {
                            $newselect= explode(',', $select);
                            if($select!=$id && !in_array($id,$newselect)){
                                if ($select!=""){
                                    $select.=','.$id;
                                }else{
                                    $select.=$id;
                                }
                            }
                        }
                    }
                    $select="typeid in (".$select.")";
                }

                $delete = $this->_table->rec_delete($select);
                if ($delete > 0) {
                    front::flash("成功删除{$this->tname}！");
                    event::log("删除" . $this->tname . "ID=" . $str_select, '成功');
                } else
                    front::flash("没有{$this->tname}被删除！");
            }
            elseif (front::post('batch') == 'addtospecial') {
                $add = $this->_table->rec_update(array('spid' => front::post('spid')), $select);
                event::log("发布到专题" . $this->tname . "ID=" . $str_select, '成功');
            }
            elseif (front::post('batch') == 'removefromspecial') {
                $add = $this->_table->rec_update(array('spid' => null), $select);
                event::log("从专题移除" . $this->tname . "ID=" . $str_select, '成功');
            }
            elseif (front::post('batch') == 'copytolang') {
                if($this->table == 'category'){
                    foreach (front::post('select') as $id) {
                        $newlangid=lang::getlangid(front::post('langurlname'));
                        $langtoarraydata = $this->_table->getrows("catid in (" . $id . ")",0,'catid asc');
                        foreach ($langtoarraydata as $key=>$langtodata){
                            $oldid=$langtodata['catid'];
                            unset($langtodata['catid']);
                            $langtodata['htmldir'] = $langtodata['htmldir'] . '-' . $this->random_user();
                            $langtodata['langid'] =$newlangid ;
                            $langtodata['catname']=str_replace("'", "\'", $langtodata['catname']);
                            $langtodata['subtitle']=str_replace("'", "\'", $langtodata['subtitle']);
                            $langtodata['categorycontent']=str_replace("'", "\'", $langtodata['categorycontent']);
                            //判断是否重复
                            $data = $this->_table->getrow("htmldir='" . $langtodata['htmldir'] . "'");
                            if (is_array($data)) {
                                $langtodata['htmldir'] = $langtodata['htmldir'] . '-' . $this->random_user();
                            }
                            //新增
                            $this->_table->rec_insert($langtodata);
                            $newcatid = $this->_table->insert_id();
                            //是否复制子栏目
                            if (front::post('iscopysubcolumn')) {
                                $this->copycategoryson($newcatid, $oldid, $newlangid,front::post('iscopycontent'));
                            }
                            //判断是否复制栏目下内容
                            if (front::post('iscopycontent')){
                                $this->copycategoryarchive($newcatid, $oldid, $newlangid);
                            }

                        }
                        front::flash("{$this->tname}" . lang_admin('copy') . lang_admin('success') . "！");
                    }
                }else
                if( $this->table == 'type'){
                    foreach (front::post('select') as $id) {
                        $langtodata = $this->_table->getrow("typeid='" . $id . "'");
                        unset($langtodata['typeid']);
                        $langtodata['htmldir'] = $langtodata['htmldir'] . '-' . front::post('langurlname');
                        $langtodata['langid'] = lang::getlangid(front::post('langurlname'));
                        //判断是否重复
                        $data = $this->_table->getrow("htmldir='" . $langtodata['htmldir'] . "'");
                        if (!is_array($data)) {
                            //新增
                            $this->_table->rec_insert($langtodata);
                            front::flash("{$this->tname}" . lang_admin('copy') . lang_admin('success') . "！");
                        }
                    }
                }else
                if($this->table == 'special'){
                    foreach (front::post('select') as $id) {
                        if ($this->table == 'special') {
                            $langtodata = $this->_table->getrow("spid='" . $id . "'");
                            unset($langtodata['spid']);
                        }
                        //新增
                        $this->_table->rec_insert($langtodata);
                        front::flash("{$this->tname}" . lang_admin('copy') . lang_admin('success') . "！");
                    }
                }
                else
                    if($this->table == 'archive'){
                    foreach (front::post('select') as $id) {
                        if ($this->table == 'archive') {
                            $langtodata = $this->_table->getrow("aid='" . $id . "'");
                            unset($langtodata['aid']);
                            //新增
                            $langtodata['langid'] = lang::getlangid(front::post('langurlname'));
                            $langtodata['catid'] = front::post('copylangcatid');
                            $langtodata['content']=str_replace("'", "\'", $langtodata['content']);
                            $langtodata['introduce']=str_replace("'", "\'", $langtodata['introduce']);
                            $langtodata['title']=str_replace("'", "\'", $langtodata['title']);
                            $langtodata['subtitle']=str_replace("'", "\'", $langtodata['subtitle']);
                            $this->_table->rec_insert($langtodata);
                        }
                    }
                    front::flash("{$this->tname}" . lang_admin('copy') . lang_admin('success') . "！");
                }
            }
            elseif (front::post('batch') == 'yesstatic'){
                $check = $this->_table->rec_update(array('static' => 1), $select);
                if ($check > 0) {
                    front::flash("{$this->tname}".lang_admin('release').lang_admin('success')."！");
                    event::log(lang_admin('release'). $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('release').lang_admin('failure')."！");
                }
            }
            elseif (front::post('batch') == 'nostatic'){
                $check = $this->_table->rec_update(array('static' => 0), $select);
                if ($check > 0) {
                    front::flash("{$this->tname}".lang_admin('cancel').lang_admin('release').lang_admin('success')."！");
                    event::log(lang_admin('cancel').lang_admin('release'). $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('cancel').lang_admin('release').lang_admin('failure')."！");
                }
            }
            elseif (front::post('batch') == 'yes_recommend'){
                $check = $this->_table->rec_update(array('recommend' => 1), $select);
                if ($check > 0) {
                    front::flash("{$this->tname}".lang_admin('setup_recommendation').lang_admin('success')."！");
                    event::log(lang_admin('setup_recommendation').$this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('setup_recommendation').lang_admin('failure')."！");
                }
            }
            elseif (front::post('batch') == 'no_recommend'){
                $check = $this->_table->rec_update(array('recommend' => 0), $select);
                if ($check > 0) {
                    front::flash("{$this->tname}".lang_admin('cancel').lang_admin('setup_recommendation').lang_admin('success')."！");
                    event::log(lang_admin('cancel').lang_admin('setup_recommendation'). $this->tname . ",ID=" . $str_select, lang_admin('success'));
                } else {
                    front::flash("{$this->tname}".lang_admin('cancel').lang_admin('setup_recommendation').lang_admin('failure')."！");
                }
            }
        }
        //var_dump($_POST);
        if (front::post('batch') == 'listorder') {
            $orders = front::post('listorder');
            //var_dump($orders);
            if (is_array($orders))
                foreach ($orders as $id => $order) {
                    $this->_table->rec_update(array('listorder' => intval($order)), $id);
                }
        }
        //批量导出
        if (front::post('batch') == 'export') {

            //var_dump(setting::$var[$this->table]);exit;
            $fields = $this->_table->getFields();
            //var_dump($fields);
            //var_dump($this->_table);exit;
            $rows = $this->_table->rec_select($select, 0, '*', '1 asc');
            push($fields, $rows, setting::$var[$this->table]);
            exit;
        }
        //front::redirect(url::modify('act/list/table/' . $this->table));
        if ($this->table == 'archive') {
            front::redirect(url::modify('act/list/table/' . $this->table.'/catid/'.front::get('catid'),true));
        }
        if ($this->table == 'shoptemplatetag') {
            front::redirect(url::modify('act/list/table/templatetag', true));
        }
        if ($this->table == 'category') {
            front::redirect(url('table/list/table/' . $this->table, true));
        }
         front::redirect(url::modify('act/list/table/' . $this->table, true));
    }

    //复制栏目下所有商品
    function copycategoryarchive($new_categoryinsertid,$old_categoryinsertid,$newlangid){
        $archivearray=archive::getInstance()->getrows(array("catid"=>$old_categoryinsertid),0);
        if (is_array($archivearray))
            foreach ($archivearray as $archkey=>$archval) {
                unset($archval['aid']);
                //新增
                $archval['langid'] = $newlangid;
                $archval['content']=str_replace("'", "\'", $archval['content']);
                $archval['introduce']=str_replace("'", "\'", $archval['introduce']);
                $archval['title']=str_replace("'", "\'", $archval['title']);
                $archval['subtitle']=str_replace("'", "\'", $archval['subtitle']);
                $archval['catid'] = $new_categoryinsertid;
                archive::getInstance()->rec_insert($archval);
            }
    }

    //随机生成
    function random_user($len = 6)
    {
        $user = '';
        $lchar = 0;
        $char = 0;
        for($i = 0; $i < $len; $i++)
        {
            while($char == $lchar)
            {
                $char = rand(48, 109);
                if($char > 57) $char += 7;
                if($char > 90) $char += 6;
            }
            $user .= chr($char);
            $lchar = $char;
        }
        return $user;
    }

    //复制子栏目
    function copycategoryson($new_categoryinsertid,$old_categoryinsertid,$newlangid,$iscopyconnent){
        $category=new  category();
        $where='parentid='.$old_categoryinsertid;
        $categorydata=$category->getrows($where, 0,'catid asc ');
        if (is_array($categorydata)){
            foreach ($categorydata as $key=>$val){
                $old_son_categoryinsertid=$val['catid'];
                unset($val['catid']);
                $val['langid']=$newlangid;
                $val['catname']=str_replace("'", "\'", $val['catname']);
                $val['subtitle']=str_replace("'", "\'", $val['subtitle']);
                $val['categorycontent']=str_replace("'", "\'", $val['categorycontent']);
                $val['parentid']=$new_categoryinsertid;
                $val['htmldir'] = $val['htmldir'] . '-' . $this->random_user();
                $category->rec_insert($val);
                $new_son_categoryinsertid = $category->insert_id();   //新增栏目的id
                //是否复制内容
                if ($iscopyconnent){
                    $this->copycategoryarchive($new_son_categoryinsertid, $old_son_categoryinsertid, $newlangid);
                }
                //判断子集栏目还有子集栏目的话 则增加
                if(count($category->getrows('parentid='.$old_categoryinsertid, 0,'catid asc '))>0){
                    $this->copycategoryson($new_son_categoryinsertid,$old_son_categoryinsertid,$newlangid,$iscopyconnent);
                }
            }
        }
    }

    //移动到专题
    function setspecial_action(){
        if (front::post('batch') && front::post('select')) {
            $str_select = implode(',', front::post('select'));
            //$select = implode(',', front::post('select'));
            $select = $this->_table->primary_key . ' in (' . $str_select . ')';
            $check = $this->_table->rec_update(array('spid' => front::post('specialid')), $select);
            if ($check > 0) {
                front::flash("{$this->tname}".lang_admin('set_up').lang_admin('success')."！");
                event::log(lang_admin('set_up').lang_admin('success').$this->tname . ",ID=" . $str_select, lang_admin('success'));
            } else {
                front::flash("{$this->tname}".lang_admin('set_up').ang_admin('failure')."！");
            }
        }
        front::redirect(url::modify('act/list/table/' . $this->table));
    }

    //移动到分类
    function settype_action(){
        if (front::post('batch') && front::post('select')) {
            $str_select = implode(',', front::post('select'));
            //$select = implode(',', front::post('select'));
            $select = $this->_table->primary_key . ' in (' . $str_select . ')';
            $check = $this->_table->rec_update(array('typeid' => front::post('typeid')), $select);
            if ($check > 0) {
                front::flash("{$this->tname}".lang_admin('set_up').lang_admin('success')."！");
                event::log(lang_admin('set_up').lang_admin('success') . $this->tname . ",ID=" . $str_select, lang_admin('success'));
            } else {
                front::flash("{$this->tname}".lang_admin('set_up').ang_admin('failure')."！");
            }
        }
        front::redirect(url::modify('act/list/table/' . $this->table));
    }

    //批量修改单价
    function updateprice_action(){
        if (front::post('select')) {
            $str_select = implode(',', front::post('select'));
            $select = $this->_table->primary_key . ' in (' . $str_select . ')';
            $check = $this->_table->rec_update(array('attr2' => front::post('batch')), $select);
            if ($check > 0) {
                front::flash("{$this->tname}".lang_admin('modify').lang_admin('unit_price').lang_admin('success')."！");
                event::log(lang_admin('unit_price').lang_admin('modify').lang_admin('success'). $this->tname . ",ID=" . $str_select, lang_admin('success'));
            } else {
                front::flash("{$this->tname}".lang_admin('unit_price').lang_admin('modify').lang_admin('failure')."！");
            }
        }
        front::redirect(url::modify('act/list/table/' . $this->table.'/shopping/'.front::get('shopping').'/catid/'.front::get('catid').'/page/'.front::get('page')));
    }

    function clearall_action(){
        if (!Phpox_token::is_token('table_del', front::$get['token'])) {
            exit(lang_admin('token_error'));
        }
        $delete = $this->_table->query("truncate table ".$this->_table->name);
        if ($delete) {
            front::flash("{$this->tname}".lang_admin('empty').lang_admin('success')."！");
            event::log(lang_admin('empty')."{$this->tname}", lang_admin('success'));
        }
        front::redirect(url::modify('act/list/table/' . $this->table));
    }

    function delete_action()
    {
        if ($this->table == 'category') {
            chkpw('category_del');
        }
        if ($this->table == 'type') {
            chkpw('type_del');
        }
        if ($this->table == 'special') {
            chkpw('special_del');
        }
        if ($this->table == 'user') {
            chkpw('user_del');
        }
        if ($this->table == 'usergroup') {
            chkpw('usergroup_del');
        }
        if ($this->table == 'orders') {
            chkpw('order_del');
        }
        if ($this->table == 'comment') {
            chkpw('func_comment_del');
        }
        if ($this->table == 'guestbook') {
            chkpw('func_book_del');
        }
        if ($this->table == 'announcement') {
            chkpw('func_announc_del');
        }
        if ($this->table == 'linkword') {
            chkpw('seo_linkword_del');
        }
        if ($this->table == 'friendlink') {
            chkpw('seo_friendlink_del');
        }
        if (!Phpox_token::is_token('table_del', front::$get['token'])) {
            exit(lang_admin('token_error'));
        }

        //还原库存
        if ($this->table == 'orders') {
            $orders = new orders();
            //获取到购买的商品  进行计算销售量
            $tabledata = $orders->getrows("id='".front::get('id')."'", 1); //查询订单表
            if(is_array($tabledata)){
                //获取到购买的商品  进行计算库存
                $ordersAid = explode("-",trim($tabledata[0]['aid']));
                //循环多个商品
                for($index=0;$index<count($ordersAid);$index++){
                    $source = explode("#",trim($ordersAid[$index]));
                    $_aidArrys = explode(",", trim($source[0]));
                    $datavuel = archive::getInstance()->getrows('aid = '.$_aidArrys[0],1);
                    //库存还原
                    $inventorynum=$datavuel[0]['inventory']+(int)($_aidArrys[1]);
                    //修改库存
                    archive::getInstance()->rec_update(array('inventory'=>$inventorynum), $_aidArrys[0]);
                }
            }
        }

        //自定义留言字段删除
        if ($this->table == 'guestbookfield'){
          $this->deleteguestbookfield(front::get('id'));
        }

        //插件或者在线模板
        if ($this->table == 'apps' ||$this->table == 'buytemplate'){
            front::$get['id']="id='".front::get('id')."'";
        }

        //栏目删除  同时删除子栏目
        if ($this->table == 'category'){
            if(category::sonall(front::get('id'))){
                front::$get['id']=" catid in (".front::get('id').",".category::sonall(front::get('id')).")";
            }
        }
        //栏目删除  同时分类栏目
        if ($this->table == 'type' && file_exists(ROOT."/lib/table/type.php")){
            if(type::sonall(front::get('id'))) {
                front::$get['id'] = " typeid in (" . front::get('id') . "," . type::sonall(front::get('id')) . ")";
            }
        }
        //var_dump($this->_table);
        $this->manage->delete_before(front::get('id'));
        //var_dump($this->_table);
        $delete = $this->_table->rec_delete(front::get('id'));
        if ($delete) {
            front::flash("{$this->tname}".lang_admin('delete').lang_admin('success')."！");
            event::log(lang_admin('delete')."{$this->tname},ID=" . front::get('id'), lang_admin('success'));
        }
        if ($this->table == 'archive') {
            front::redirect(url::modify('act/list/table/' . $this->table.'/catid/'.front::get('catid'),true));
        }
        if ($this->table == 'templatetag') {
            front::redirect(url::modify('act/list/table/' . $this->table.'/tagfrom/'.front::get('tagfrom'),true));
        }


        //front::redirect(url::modify('act/list/table/' . $this->table));
        front::redirect(url::modify('act/list/table/' . $this->table));

    }

    //加入回收站
    function deletestate_action()
    {

        if (!Phpox_token::is_token('table_del', front::$get['token'])) {
            exit(lang_admin('token_error'));
        }
        $this->manage->delete_before(front::get('id'));
        $deletestate = $this->_table->rec_update(array('state' => -1), front::get('id'));
        if ($deletestate > 0) {
            front::flash("{$this->tname}".lang_admin('has_been_moved_to_the_Recycle_Bin')."！");
            event::log(lang_admin('moved_to_the_Recycle_Bin') . $this->tname . ",ID=" . front::get('id'),  lang_admin('success'));
        } else {
            front::flash("{$this->tname}".lang_admin('not_moved_to_the_Recycle_Bin')."！");
        }

        if ($this->table == 'archive') {
            front::redirect(url::modify('act/list/table/' . $this->table.'/catid/'.front::get('catid'),true));
        }

        //front::redirect(url::modify('act/list/table/' . $this->table));
        front::redirect(url::modify('act/list/table/' . $this->table));

    }

    function setting_action()
    {
        if ($this->table == 'archive') {
            chkpw('archive_setting');
        }
        if ($this->table == 'friendlink') {
            chkpw('seo_friendlink_setting');
        }
        $this->_view_table = false;
        $set = settings::getInstance();
        $sets = $set->getrow(array('tag' => 'table-' . $this->table));
        $data = isset($sets['value'])?unserialize($sets['value']):array();
        $newattr='attr1_'.lang::getisadmin();
        $data['attr1']=isset($data[$newattr])?$data[$newattr]:"";
        if (front::post('submit')) {
            $langdata=lang::getlang();
            foreach ($langdata as $key=>$value){
                $newattr='attr1_'.$value['langurlname'];
                if($value['langurlname']!=lang::getisadmin()){
                    front::$post[$newattr] =$data[$newattr];
                }else{
                    front::$post[$newattr]=front::$post['attr1'];
                }
            }
            $var = front::$post;
            unset($var['submit']);
            $set->rec_replace(array('value' => addslashes(serialize($var)), 'tag' => 'table-' . $this->table, 'array' => addslashes(var_export($var, true))));
            event::log(lang_admin('modify')."{$this->tname}".lang_admin('to_configure'), lang_admin('success'));
            front::flash(lang_admin('to_configure').lang_admin('success'));
        }
        $this->view->settings = $data;
    }

    //删除留言表字段
    function deleteguestbookfield($id){
        if($id){
            $guestbookfieldate=guestbookfield::getInstance()->getrow($id);
            if (is_array($guestbookfieldate)){
                $sql=" alter table cmseasy_guestbook drop column ".$guestbookfieldate['name'];
                $this->_table->query($sql);
            }

        }
    }

    //打印
    function view_action(){
        if(front::post('select')){
            $str_select = implode(',', front::post('select'));
            $where = $this->_table->primary_key . ' in (' . $str_select . ')';
        }else{
            $where=front::get('id');
        }
        $this->_view_table = $this->_table->getrows($where,0,' id ASC ', $this->_table->getcols('modify'));
        //var_dump($this->_view_table);exit;
        if (!is_array($this->_view_table))
            exit("PAGE_NOT FOUND!");
       // $this->manage->view_before($this->_view_table);
        $this->view->viewdata=$this->_view_table;
        $this->render('table/orders/view.php');
        exit;

    }
    //商品下拉框
    function gettolast_action(){
        if(isset($_GET['tolastid'])){
            $class = new archive();
            $cateidson=category::getInstance()->sons($_GET['tolastid']);
            if(is_array($cateidson) && count($cateidson)>0){
                $where = ' catid in( '.$_GET['tolastid'].','. trim(implode(',', $cateidson), ',') . ')';
            }else{
                $where = ' catid ='.$_GET['tolastid'];
            }
            $cid = $class->getrows1($where,99,'1 desc','aid,title');
            echo json_encode($cid);
        }else{
           echo "";
        }
        exit;
    }

    //商品下拉框
    function getshoppingtypecatid_action(){
        $returndata=array();
        if(file_exists(ROOT."/lib/table/shopping.php")) {
            $data=category::optionshopping('0','all');
            if (is_array($data)){
                foreach ($data as $key => $val){
                    $returndata[count($returndata)]=array("aid"=>$key,"title"=>$val);
                }
            }
        }
        echo json_encode($returndata);
        exit;
    }

    //订单申请退款列表
    function refund_action(){
        $ordre = '`id` DESC';
        $limit = ((front::get('page') - 1) * $this->_pagesize) . ',' . $this->_pagesize;
        $where=" status=6 or status=7 or status=8 ";
        if (!front::post('search_username') && front::get('type') != 'search')
            session::del('search_username');
        if (get('search_username')) {
            $username = get('search_username');
            session::set('search_username', $username);
            $user = new user();
            $userdata = $user->getrows("username like '%".$username."%'", 0);
            $userid="";
            if(count($userdata)>0){
                foreach ($userdata as $key=>$val){
                    if($userid !=""){
                        $userid.=",".$val['userid'];
                    }else{
                        $userid=$val['userid'];
                    }
                }
            }
            if($userid !=""){
                $where .= " and mid in ($userid) ";
            }else{
                $where = "  1<>1 ";
            }
        }
        $this->_view_table = $this->_table->getrows($where, $limit, $ordre, $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
        $this->view->token = Phpox_token::grante_token('table_del');
    }

    function view($table)
    {
        $this->view->data = $table['data'];
        $this->view->field = $table['field'];
    }

    function end()
    {
        if (!isset($this->_view_table))
            return;
        if (!isset($this->_view_table['data']))
            $this->_view_table['data'] = $this->_view_table;
        $this->_view_table['field'] = $this->_table->getFields();
        $this->view->fieldlimit = $this->_table->getcols(front::$act == 'list' ? 'manage' : 'modify');
        $this->view($this->_view_table);
        if (!preg_match('/^my_/', $this->table)) {
            manage_form::table($this);
        }

        $this->render();
        /*  if (front::post('onlymodify')) {
              $this->render();
          } else {
             if (front::get('main')) {
                  $this->render();
              } else {
                  $this->render('index.php');
              }
        }*/
    }

    //判断名称重复
    function  checkctname_action(){
        if (front::post('catname')){
            echo  category::getInstance()->rec_count(array("catname"=>front::post('catname')));
            exit;
        }
        echo 0;
        exit;
    }
    //分类查询
    function loadowntype_action(){
        //提取分类
        if(!file_exists(ROOT."/lib/table/type.php")) {
            echo json_encode(array(""));exit;
        }
        if(front::get('typeid')){
            $where='parentid=' . front::get('typeid');
            $where.= ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            $typedata= type::getInstance()->getrows($where,0,'listorder desc,typeid asc','*');
            if (is_array($typedata))
                //有子栏目的区分出来
                foreach ($typedata as $key=>$val){
                    $where='parentid=' . $val['typeid'];
                    $where.= ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $typedatason= type::getInstance()->getrows($where,0,'typeid asc','typeid');
                    if (count($typedatason)>0)$typedata[$key]['son']=count($typedatason);
                };
            echo  json_encode($typedata);
        }
        exit;
    }

    //栏目查询
    function loadowncategory_action(){
        if(front::get('catid')){
            $where='parentid=' . front::get('catid');
            $where.= ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            //提取商品
            if (!file_exists(ROOT."/lib/table/shopping.php")){
                $where.=$where!=''?' and isshopping=0':" isshopping=0";
            }
            $categorydata= category::getInstance()->getrows($where,0,'listorder desc,catid asc','*');
            if (is_array($categorydata))
                //有子栏目的区分出来
                foreach ($categorydata as $key=>$val){
                    $where='parentid=' . $val['catid'];
                    $where.= ' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
                    $categorydatason= category::getInstance()->getrows($where,0,'catid asc','catid');
                    if (count($categorydatason)>0)$categorydata[$key]['son']=count($categorydatason);
                };
            echo  json_encode($categorydata);
        }
        exit;
    }

    //获取当前栏目下的所有栏目id 包括自己
    function getcatidson_action(){
        if(front::get('catid')){
            $categorydata= category::sonall(front::get('catid'),true);
            echo  json_encode($categorydata);
        }
        exit;
    }

    //获取当前栏目下的所有tag  (栏目校验去掉了  无用了)
    /*function gettaglist_action(){
        if(front::get('catid')){
            $categorydata= tag::getadminTagslist(front::get('catid'));
            echo  json_encode($categorydata);
        }
        exit;
    }*/

    //判断tag是否存在  不存在则新增
    function getistag_action(){
        if(front::get('tagname')){
            $tagdata= tag::getistag(front::get('tagname'));
            //不存在则新增
            if(!$tagdata['state']){
                $newtagdata=array();
                $newtagdata['tagname']=front::get('tagname');
                $newtagdata['langid']=lang::getlangid(lang::getisadmin());
                $newtagdata['htmldir']= pinyin::get2(front::get('tagname'));
                $newtagdata['txtsize']=10;
                $newtagdata['txtcolor']="#000000";
                $newtagdata['listorder']=0;
                $newtagdata['htmlrule']="\{\$dir\}/\{\$page\}.html";
                tag::getInstance()->rec_insert($newtagdata);
            }
            echo  json_encode($tagdata);
        }
        exit;
    }

    //js删除产品码
    function deleteproduct_action()
    {

        $this->manage->delete_before(front::get('id'));
        $delete = $this->_table->rec_delete(front::get('id'));
        if ($delete) {
             echo  json_encode(array("status"=>1,"message"=> lang_admin('delete').lang_admin('success')));
        }else{
            echo  json_encode(array("status"=>1,"message"=> lang_admin('delete').lang_admin('failure')));
        }
        exit;
    }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
