<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class table_archive extends table_mode
{
    function view_before(&$data = null)
    {
        //自定义字段 内页多图
        if (is_array($data) && !empty($data)) {
            foreach ($data as $k => $v) {
                if (preg_match('/^my_/is', $k) && isset(setting::$var['archive'][$k]['filetype']) && setting::$var['archive'][$k]['filetype']=="pic") {
                    $data[$k] = unserialize($data[$k]);
                }
            }
        }

        $data['pics'] = unserialize($data['pics']);
        //var_dump($data['pics']);
        /*if(is_array($pics) &&!empty($pics)) {
            foreach ($pics as $k => $v) {
                $data['pics' . $k] = $v;
            }
        }*/
        //$archive['pics'] = $v;
        //unset($data['pics']);
        $rank = new rank();
        $rank = $rank->getrow('aid=' . intval(front::get('id')));
        if (is_array($rank))
            $data['_ranks'] = unserialize($rank['ranks']);
        else $data['_ranks'] = array();
        unset($data['ranks']);
        if ($data['isecoding'] == '2' || ($data['isecoding'] == '0' && config::get('isecoding') == '0')) {
            $data['ecoding'] = '';
        }

        if(file_exists(ROOT."/lib/table/linkword.php")) {
            $linkword = new linkword();
            $linkwords = $linkword->getrows(null, 1000, 'linkorder desc');
            foreach ($linkwords as $linkword) {
                $linkword['linktimes'] = (int)$linkword['linktimes'];
                if (trim($linkword['linkurl']) && !preg_match('%^http://$%', trim($linkword['linkurl']))) {
                    $link = "<a href='$linkword[linkurl]' target='_blank'>$linkword[linkword]</a>";
                } else {
                    $link = "<a href='" . url('archive/search/keyword/' . urlencode($linkword['linkword'])) . "' target='_blank'>$linkword[linkword]</a>";
                }
                $data['content'] = _keylinks($data['content'], $linkword['linkword'], $link, $linkword['linktimes']);
            }
        }


    }

    function vaild()
    {
        if (!front::post('title')) {
            front::flash(lang_admin('please_fill_in_the_title'));
            return false;
        }
      /*  if (!front::post('catid')) {
            front::flash('请选择栏目！');
            return false;
        }*/
        if (!front::post('langid')) {
            front::flash(lang_admin('please_choose').lang_admin('language_pack'));
            return false;
        }
        return true;
    }

    function add_before(act $act = null)
    {
        front::$post['userid'] = $act->view->user['userid'];
        front::$post['username'] = $act->view->user['username'];
        if (empty(front::$post['author'])) {
            front::$post['author'] = $act->view->user['username'];
        }
        front::$post['checked'] = intval(front::$post['checked']);
        if (empty(front::$post['adddate'])) {
            front::$post['adddate'] = date('Y-m-d H:i:s');
        }
    }

    function save_before()
    {
        //自定义字段 内页多图
        if (is_array(front::$post) && !empty(front::$post)) {
            foreach (front::$post as $k => $v) {
                if (preg_match('/^my_/is', $k) && isset(setting::$var['archive'][$k]) && setting::$var['archive'][$k]['filetype']=="pic") {
                    front::$post[$k] = serialize(front::$post[$k]);
                }
            }
        }

        parent::save_before();

        //自定义字段允许HTML
        if (is_array(front::$post) && !empty(front::$post)) {
            foreach (front::$post as $k => $v) {
                if (preg_match('/^my_/is', $k)) {
                    front::$post[$k] = htmlspecialchars_decode(front::$post[$k]);
                }
            }
        }
        //var_dump(front::$post['content']);
        front::$post['content']=isset(front::$post['content'])?front::$post['content']:"";
        front::$post['content'] = stripslashes(front::$post['content']);
        //var_dump(front::$post['content']);
        front::$post['content'] = htmlspecialchars_decode(front::$post['content']);
        //var_dump(front::$post['content']);
        //exit;
        //var_dump(front::$post['content']);
        //exit;
        if (isset(front::$post['htmlrule1']) &&  front::$post['htmlrule1'] != '') {
            front::$post['htmlrule'] = front::$post['htmlrule1'];
        }

        front::$post['strong'] = isset(front::$post['strong'])?intval(front::$post['strong']):0;
        //var_dump(front::$post['pics']);exit;
        /*$pics = array();
        foreach(front::$post as $k =>$v) {
            if(preg_match('/pics(\d+)/i',$k,$out)) {
                if($v != ''){
                    $pics[$out[1]] = $v;
                }
                unset(front::$post[$k]);
            }
        }
        */

        front::$post['pics'] =isset(front::$post['pics'])?serialize(front::$post['pics']):"";
        if (!front::post('attr1')) {
            front::$post['attr1'] = '';
        }
        front::$post['introduce_len'] = isset(front::$post['introduce_len'])?intval(front::$post['introduce_len']):0;
        if(!isset(front::$post['type'])){
            front::$post['type'] = '';
        }
        if (!front::$post['introduce']) {
            front::$post['introduce'] = cut(strip_tags(front::$post['content']), front::$post['introduce_len'] * 2);
        }

        if (isset(front::$post['savehttppic']) && front::$post['savehttppic']) {
            //front::$post['content'] = stripslashes(front::$post['content']);
			front::$post['content'] = stripcslashes(htmlspecialchars_decode(front::$post['content']));
            front::$post['content'] = preg_replace_callback('%(<img\s[^>|/>]*?src\s*=\s*["|\']?)([^"|\'|\s>]*)%is', 'savepic', front::$post['content']);
            //front::$post['content'] = addslashes(front::$post['content']);
			front::$post['content'] = stripcslashes(htmlspecialchars_decode(front::$post['content']));
        }


        //处理防伪码 只在新加时生成
        if (front::$get['act'] == 'add') {
            if (front::$post['isecoding'] == '1') {
                front::$post['ecoding'] = config::get('ecoding') . randomkeys(18);
            } else if (front::$post['isecoding'] == '0' && config::get('isecoding')) {
                front::$post['ecoding'] = config::get('ecoding') . randomkeys(18);
            }
        }

        //var_dump(front::$post);exit;

        //var_dump(front::$post['content']);exit;

        if (isset(front::$post['autothumb']) && front::$post['autothumb']) {
            //front::$post['content'] = stripslashes(front::$post['content']);
			front::$post['content'] = stripcslashes(htmlspecialchars_decode(front::$post['content']));
            preg_match('%(<img\s[^>|/>]*?src\s*=\s*["|\']?)([^"|\'|\s>]*)%is', front::$post['content'], $out);
            $out[1] = '';
            //$out[2] = savepic1($out);
            if (!$out[2]) return;
            //front::$post['thumb'] = str_ireplace(config::get('site_url'),'',$out[2]);
            $len = 1;
            if (config::get('base_url') != '/') {
                $len = strlen(config::get('base_url')) + 1;
            }
            if (substr($out[2], 0, 4) == 'http') {
                front::$post['thumb'] = str_ireplace(config::get('site_url'), '', $out[2]);
            } else {
                front::$post['thumb'] = substr($out[2], $len);
            }
            $catid = front::get('catid');
            $thumb = new thumb();
            $thumb->set(front::$post['thumb'], 'file');
            front::$post['thumb'] = str_ireplace('.jpg', '_s.jpg', front::$post['thumb']);
            if ($catid)
                $thumb->create(front::$post['thumb'], category::getwidthofthumb($catid), category::getheightofthumb($catid));
            else
                $thumb->create(front::$post['thumb'], config::get('thumb_width'), config::get('thumb_height'));
            $sp = $len > 1 ? '/' : '';
            front::$post['thumb'] = config::get('base_url') . $sp . front::$post['thumb'];
            if (substr(front::$post['thumb'], 0, 1) != '/') {
                front::$post['thumb'] = '/' . front::$post['thumb'];
            }
            //front::$post['content'] = addslashes(front::$post['content']);
			front::$post['content'] = stripcslashes(htmlspecialchars_decode(front::$post['content']));
        }

        if(!isset(front::$post['state']) || !front::$post['state']) front::$post['state']= 1;

        front::$post['listorder'] = intval(front::$post['listorder']);



    }

    function save_after($aid = '')
    {
        //$tag=preg_replace('/\s+/',' ',trim(front::$post['tag']));
        if(file_exists(ROOT."/lib/table/tag.php")) {
            front::$post['tag'] = isset(front::$post['tag']) ? front::$post['tag'] : "";
            $tags = explode(',', trim(front::$post['tag']));
            //var_dump($tags);
            $tag_table = new tag();
            $arctag_table = new arctag();
            //var_dump($tags);
            foreach ($tags as $tag) {
                /*  去掉新增tag
                if ($tag && !$tag_table->getrow('tagname="' . $tag . '" and langid='.lang::getlangid(lang::getisadmin()))) {
                       $tag_table->rec_insert(array('tagname' => $tag,'langid'=>lang::getlangid(lang::getisadmin())));
                   }*/
                $tag = $tag_table->getrow('tagname="' . $tag . '" and langid= ' . lang::getlangid(lang::getisadmin()));
                $arctag_table->rec_replace(array('aid' => $aid, 'tagid' => $tag['tagid']));
            }
        }
        //exit;
        $doit = false;
        if (session::get('attachment_id') || front::post('attachment_id')) {
            //var_dump($_SESSION);
            //var_dump($_POST);
            //var_dump($aid);
            //exit;
            $attachment_id = session::get('attachment_id') ? session::get('attachment_id') : front::post('attachment_id');
            $attachment = new attachment();
            $attachment->rec_update(array('aid' => $aid,'path' => front::post('attachment_path'), 'intro' => front::post('title')), array('id'=>$attachment_id));
            $doit = true;
            if (session::get('attachment_id')) session::del('attachment_id');
        }
        if (front::post('attachment_path') != '' && !$doit) {
            $attachment = new attachment();
            $attachment->rec_insert(array('aid' => $aid, 'path' => front::post('attachment_path'), 'intro' => front::post('title'), 'adddate' => date('Y-m-d H:i:s')));
        }
        //exit;
        if (front::post('_ranks')) {
            $_ranks = serialize(front::post('_ranks'));
            $rank = new rank();
            if (is_array($rank->getrow(array('aid' => $aid))))
                $rank->rec_update(array('ranks' => $_ranks), 'aid=' . $aid);
            else
                $rank->rec_insert(array('aid' => $aid, 'ranks' => $_ranks));
        } else {
            $rank = new rank();
            $rank->rec_delete('aid=' . $aid);
        }
        if (front::post('vote')) {
            $votes = front::$post['vote'];
            $images = front::$post['vote_image'];
            $vote = new vote();
            $_vote = $vote->getrow('aid=' . $aid);
            if (!$_vote) $_vote = array('aid' => $aid);
            $_vote['titles'] = serialize($votes);
            $_vote['images'] = serialize($images);
            $vote->rec_replace($_vote, $aid);
            //var_dump($_vote);exit;
        }

        //产品码表
        if(file_exists(ROOT."/lib/table/productcode.php")) {
            //产品码
            if (front::$post['product_num']){
                $product_num=front::$post['product_num'];
                unset(front::$post['product_num']);
                for ($i=1;$i<=$product_num;$i++){
                    $product_code=front::$post['product_code_'.$i];
                    $product_outtime=front::$post['product_outtime_'.$i];
                    $product_addtime=front::$post['product_addtime_'.$i];
                    unset(front::$post['product_code_'.$i]);
                    unset(front::$post['product_outtime_'.$i]);
                    unset(front::$post['product_addtime_'.$i]);
                    if ($product_code && $product_outtime){
                        $productcode_data=productcode::getInstance()->getrow(array("product"=>$product_code));
                        if (!is_array($productcode_data)){
                            productcode::getInstance()->rec_insert(array("product"=>$product_code,
                                "outtime"=>$product_outtime,
                                "addtime"=>$product_addtime,
                                "shopid"=>$aid,"status"=>1));
                        }
                    }
                }
            }
        }

        //过滤中间表增加
        if(file_exists(ROOT."/lib/table/filter.php")) {
            archivefilter::getIns()->rec_delete(array("aid" => $aid));
            if (is_array(front::post('filter_type'))) {
                $filter_where="";
                foreach (front::post('filter_type') as $val){
                    $filter_where.=($filter_where==""?$val:",".$val);
                }
                $archivefilter_data['aid'] = $aid;
                $archivefilter_data['filter_where'] = $filter_where;
                $archivefilter_data['addtime'] = date('Y-m-d H:i:s');
                archivefilter::getIns()->rec_insert($archivefilter_data);
            }

        }

        //保存之后 自动生成
        cache_make::get_make_show($aid);
        //删除首页缓存
        $fileurl_path=ROOT . '/'.lang::getistemplate().'/index-' . lang::getistemplate() . '.php';
        if (file_exists($fileurl_path))
            unlink($fileurl_path);

        //xml自动生成
        if (config::getadmin("met_sitemap_auto"))make_xml();


    }

    function delete_before($id = '')
    {
        $arc = new archive();
        $info = $arc->getrow($id);
        $attachment = new attachment();
        $res = $attachment->getrows(array("aid" => $id));
        if (is_array($res) && !empty($res)) {
            foreach ($res as $v) {
                @unlink($v['path']);
            }
        }

        if (category::getarcishtml($info)) {
            $path = ROOT . preg_replace("%" . THIS_URL . "[\\/]%", '', archive::url($info));
            if (file_exists($path)) unlink($path);
        }

        if (config::get("cache_make_open")) {
            $cache_path = archive::url($info, front::$get['page'] > 1 ? front::$get['page'] : null, lang::getisadmin(), false);
            $cache_path = archive::url_rule($cache_path);
            $cache_path = str_replace('.html', '.php', $cache_path);
            if (file_exists($cache_path))
                unlink($cache_path);
        }

    }

    function edit_before(){
        //修改模板触发清空可视化缓存
        if (front::post('template') && front::get('id')) {
            $archive = new archive();
            $archive_data = $archive->getrow(array("aid"=>front::get('id')));
            if($archive_data['template']!=front::post('template')){
                front::remove(ROOT.'/cache/template_admin');
            }
        }


        //产品码表
        if(file_exists(ROOT."/lib/table/productcode.php")) {
            //产品码
            if (front::$post['product_num']) {
                $product_num = front::$post['product_num'];
                unset(front::$post['product_num']);
                for ($i = 1; $i <= $product_num; $i++) {
                    $product_code = front::$post['product_code_' . $i];
                    $product_outtime = front::$post['product_outtime_' . $i];
                    $product_addtime = front::$post['product_addtime_' . $i];
                    $product_change = front::$post['product_change_' . $i];
                    $product_old = front::$post['product_old_' . $i];
                    unset(front::$post['product_code_' . $i]);
                    unset(front::$post['product_outtime_' . $i]);
                    unset(front::$post['product_addtime_' . $i]);
                    unset(front::$post['product_change_' . $i]);
                    unset(front::$post['product_old_' . $i]);
                    if ($product_code && $product_outtime) {
                        if ($product_change) {
                            productcode::getInstance()->rec_update(array("product" => $product_code), array('id' => $product_old));
                        } else {
                            $productcode_data = productcode::getInstance()->getrow(array("product" => $product_code));
                            if (!is_array($productcode_data)) {
                                productcode::getInstance()->rec_insert(array("product" => $product_code,
                                    "outtime" => $product_outtime,
                                    "addtime" => $product_addtime,
                                    "shopid" => front::get('id'), "status" => 1));
                            }
                        }
                        //统一修改时间
                        productcode::getInstance()->rec_update(array("outtime" => $product_outtime), array('product' => $product_code));
                    }
                }
            }
        }
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.