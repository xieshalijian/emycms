<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');

class archive_act extends act
{

    public $auto_end = true;
    public $showform = '1';
    public $manage = null;
    function init()
    {
        $this->archive = new archive();
        $this->category = category::getInstance();
        //提取分类
        if(file_exists(ROOT."/lib/table/type.php")) {
            $this->type = type::getInstance();
            $this->view->type = $this->type->type;
        }
        $this->view->category = $this->category->category;
        if (front::get('page'))
            $page = front::get('page');
        else
            $page = 1;
        $this->view->page = $page;
        front::check_type($page);
        $_catpage = category::categorypages(front::get('catid'));
        if ($_catpage) {
            $this->pagesize = $_catpage;
        } else {
            $this->pagesize = config::get('list_pagesize');
        }

        front::check_type($this->pagesize);

        $announcement = new announcement();
        $this->view->announcements = $announcement->getrows(null, 10);

    }

    //前端切换语言包
    function setlang_action(){
        if(front::get('langurl') != '' ){
            // config::modify(array('lang_type' => front::get('langurl')));
            //获取域名
            $langdomain=lang::getInstance()->getrow("langurlname='".front::get('langurl')."'",'1 desc','domain');
            //是当前域名才修改配置
            //if($langdomain['domain'] =="") {
            //修改当前语言包
            lang::settistemplate(front::get('langurl'));
            // }
            //删除缓存
            front::remove(ROOT.'/cache/template');
            //清空购物车
            cookie::set('ce_orders_cookie', '');
        }
        if (front::get('static')){
            echo json_encode(array("state"=>1,"message"=>lang("success")));
            exit;
        }
        if(front::get('user')){
            if($langdomain['domain'] !=""){
                echo '<script>window.location.href="'.$langdomain['domain'].'/index.php?case=user&act=index";</script>';
            }else {
                echo '<script>window.location.href="' . url('user/index') . '";</script>';
            }
        }else{
            if($langdomain['domain'] !=""){
                $url=service::dkUrl($langdomain['domain']);
                echo '<script>window.location.href="'.$url.'";</script>';
            }else{
                $url=service::dkUrl(config::getadmin('site_url'));
                echo '<script> window.location.href="'.$url.'";</script>';
            }
        }
        exit;
    }

    function getScreening_action(){
        /*$category = new category();
        $isparentid=true;
        //获取父类的id
        while ($isparentid) {
            $where = 'catid=' . $_GET['catid'];
            $categories = $category->getrows($where, 1,  'catid asc','parentid');
            if($categories[0]['parentid']=='0'){
                $isparentid=false;
            }else{
                $_GET['catid']=$categories[0]['parentid'];
            }
        }

        $sql=" select catid as id,catname as name from  cmseasy_b_category  ";
        if(isset($_GET['catid'])&&$_GET['catid']!=""){
            $sql=" select catid as id,catname as name from  cmseasy_b_category WHERE parentid=".$_GET['catid']." OR catid=".$_GET['catid'];
        }*/
        if(front::get('langurl')){
            $lang=front::get('langurl');
        }else{
            $lang=lang::getistemplate();
        }
        $sql=" select catid as id,catname as name from  cmseasy_b_category where isscreening=1 ";
        $sql.=' and langid = "'.lang::getlangid($lang).'"';
        $cateGoryData = $this->category->rec_query($sql);
        //提取分类
        if(file_exists(ROOT."/lib/table/type.php")) {
            $sql = " select typeid as id,typename as name from  cmseasy_type  where isscreening=1 ";
            $sql .= ' and langid = "' . lang::getlangid($lang) . '"';
            $typeData = $this->category->rec_query($sql);
        }else{
            $typeData=array();
        }
        //专题扩展 安装的情况
        if(file_exists(ROOT."/lib/table/special.php")) {
            $sql = " select spid as id,title as name from  cmseasy_b_special  where isscreening=1  ";
            $sql .= ' and langid = "' . lang::getlangid($lang) . '"';
            $specialData = $this->category->rec_query($sql);
        }else{
            $specialData=array();
        }
        $data = array(
            "cateGoryData" => $cateGoryData,
            "typeData" => $typeData,
            "specialData" => $specialData,
        );

        echo json_encode($data);
        exit;
    }

    //获取多点地图
    function getAtlas_action(){
        if(!file_exists(ROOT."/lib/table/atlasmap.php")){
            echo "";exit;
        }
        $atlasmap=new atlasmap();
        $atlasmaplist = $atlasmap->getrows('', 0,'id desc ');
        echo json_encode($atlasmaplist);
        exit;
    }

    function set_verify()
    {
        return array(
            'is_int' => 'id,aid',
            'is_word' => '',
            'is_email' => '',
            'is_text' => ''
        );
    }

    function index_action()
    {

    }

    function pages_action()
    {
        $p = front::get('p');
        if ($p != 'share' && $p != 'map') {
            die();
        }
        if (front::get('t') == 'wap') {
            $this->out("wap/$p.html");
            return;
        };
    }

    function rss_action()
    {
        $sitename = config::getadmin('sitename');
        $site_url = config::getadmin('site_url');
        $catid = intval(front::get('catid'));
        if (!$catid) {
            $title = $sitename;
            $url = $site_url;
            $articles = $this->archive->getrows('', 30);
        } else {
            $type = $this->category->category[$catid];
            $cids = $this->category->sons($catid);
            $where = "catid='$catid'";
            if ($cids) {
                $cids[] = $catid;
                $where = "catid in(" . implode(',', $cids) . ")";
            }
            $title = $type['catname'] . '-' . $sitename;
            //$url = $site_url . url('archive/list/catid/' . $catid);
            $url = 'http://' . $_SERVER['HTTP_HOST'] . category::url($catid);
            $articles = $this->archive->getrows($where, 30);
        }
        $code = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
        $code .= "<rss version=\"2.0\">\r\n";
        $code .= "<channel>\r\n";
        $code .= "<title>{$title}</title>\r\n";
        $code .= "<link><![CDATA[{$url}]]></link>\r\n";
        $code .= "<description>11{$title}</description>\r\n";
        $i = 1;
        if (is_array($articles) && !empty($articles)) {
            foreach ($articles as $arr) {
                $aurl = 'http://' . $_SERVER['HTTP_HOST'] . archive::url($arr);
                $text = strip_tags(cut($arr['content'], 588));
                $code .= "<item id=\"{$i}\">\r\n";
                $code .= "<title><![CDATA[{$arr['title']}]]></title>\r\n";
                $code .= "<link><![CDATA[" . $aurl . "]]></link>\r\n";
                $code .= "<description><![CDATA[{$text}]]></description>\r\n";
                $code .= "<pubDate>{$arr['adddate']}</pubDate>\r\n";
                $code .= "</item>\r\n";
                $i++;
            }
        }
        $code .= "</channel>\r\n";
        $code .= "</rss>";
        header('Content-type: application/xml');
        echo $code;
        exit;
    }

    //栏目列表
    function list_action()
    {
        if (front::get("cache")==1 &&  config::get('list_page_php') == 1)
            $cache=true;
        else
            $cache=false;
        //判断是否静态生成
        $path_cache="";
        if ($cache){
            $path_cache = category::url(front::get('catid'), $this->view->page > 1 ? $this->view->page : 1,
                lang::getisadmin(),false);
            $path_cache = category::url_rule($path_cache);
            tool::mkdir(dirname($path_cache));
        }
        front::check_type(front::get('catid'));
       // $this->view->category[front::get('catid')]['categorycontenthtml']=strip_tags($this->view->category[front::get('catid')]['categorycontent']);
        $this->view->category[front::get('catid')]['categorycontenthtml']=front::get('catid')?$this->view->category[front::get('catid')]['categorycontent']:"";
        $this->view->category[front::get('catid')]['categorycontent']=front::get('catid')?$this->view->category[front::get('catid')]['categorycontent']:"";
        $this->view->categorys = category::getpositionlink2(front::get('catid'));
        $topid = category::gettopparent(front::get('catid'));
        if ((!isset($this->category->category[front::get('catid')]) ||
            !isset($this->category->category[$topid]) ) && !isset(front::$get['typeid']) && !isset(front::$get['spid'])
        ) {
            throw new HttpErrorException(404, lang('page_does_not_exist'), 404);
        }
        //兼容php8
        $this->view->category[$topid]['banner']=isset($this->category->category[$topid]['banner'])?$this->category->category[$topid]['banner']:"";
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $categories = array();
        if (@$this->category->category[front::get('catid')]['ispages'])
            $categories = $this->category->sons(front::get('catid'));
        $categories[] = front::get('catid');

        $this->view->pages = @$this->category->category[front::get('catid')]['ispages'];
        if (!rank::catget(front::get('catid'), $this->view->usergroupid))
            if ($cache)return $this->out('message/error.html',$cache,$path_cache);else $this->out('message/error.html',$cache,$path_cache);
        $categoryslist=category::getInstance();
        $categorysdata= $categoryslist->getrows(front::get('catid'), 1);
        if(count($categorysdata)>0 &&  $categorysdata[0]['contentrank']!=''&&  $categorysdata[0]['contentrank']){
            $order =$categorysdata[0]['contentrank'];
            if ($order==""){
                $order=" listorder desc ";
            }
        }else{
            $order = "listorder=0,`listorder` desc,`aid` DESC";
        }

        $tops = $this->archive->getrows("checked=1 AND state=1 AND toppost!=0 ".' and langid = "'.lang::getlangid(lang::getistemplate()).'"', 0, $order);
        if (@$this->category->category[front::get('catid')]['includecatarchives']) {
            $articlesWhere ='catid in (' . implode(',', $categories) . ') and checked=1';
        } else {
            $articlesWhere='catid=' . front::get('catid') . ' and checked=1';
        }
        //增加语言包过滤
        $articlesWhere=$articlesWhere. ' and langid = "'.lang::getlangid(lang::getistemplate()).'"';
        /*  if(isset($_GET['cateGory'])&&$_GET['cateGory']!=""){
              $articlesWhere=$articlesWhere.' and catid='.$_GET['cateGory'];
              $this->view->cateGorycolor = $_GET['cateGory'];
          }else{
              $this->view->cateGorycolor = '0';
          }
          if(isset($_GET['type'])&&$_GET['type']!=""){
              $articlesWhere=$articlesWhere.' and typeid='.$_GET['type'];
              $this->view->typecolor = $_GET['type'];
          }else{
              $this->view->typecolor = '0';
          }
          if(isset($_GET['special'])&&$_GET['special']!=""){
              $articlesWhere=$articlesWhere.' and spid='.$_GET['special'];
              $this->view->specialcolor = $_GET['special'];
          }else{
              $this->view->specialcolor = '0';
          }*/
        $articles = $this->archive->getrows($articlesWhere, $limit, $order);

        if (!is_array($articles)) {
            if ($cache)return $this->out('message/error.html',$cache,$path_cache);else $this->out('message/error.html',$cache,$path_cache);
        }
        $isint =usergroup::getisint(user::getuserid());      //获取是否取整
        if (is_array($tops) && !empty($tops)) {
            foreach ($tops as $order => $arc) {
                if ($arc['toppost'] == 3 ) {
                    $tops[$order]['title'] =(config::get("show_top_text")?( "[" . lang('the_total_top') . "]"):"") . $arc['title'];
                }
                if ($arc['toppost'] == 2 ) {
                    $subcatids = $this->category->sons(front::get('catid'));
                    $subcatids[count($subcatids)]=front::get('catid');
                    if ( !in_array($arc['catid'], $subcatids) ||  $arc['langid']!= lang::getlangid(lang::getistemplate())) {
                        unset($tops[$order]);
                    } else {
                        $tops[$order]['title'] = (config::get("show_top_text")?("[" . lang('the_column_top'). "]"):"") . $arc['title'];
                    }
                }
            }
            $articles = array_merge($tops, $articles);
        }

        foreach ($articles as $order => $arc) {
            $articles[$order]['url'] = archive::url($arc);
            $articles[$order]['catname'] = category::name($arc['catid']);
            $articles[$order]['caturl'] = category::url($arc['catid']);
            $articles[$order]['adddate'] = sdate($arc['adddate']);
            $articles[$order]['title'] = $arc['title'];
            $articles[$order]['stitle'] = strip_tags($arc['title']);
            $articles[$order]['strgrade'] = archive::getgrade($arc['grade']);
            $articles[$order]['buyurl'] = url('archive/orders/aid/' . $arc['aid']);
            if (strtolower(substr($arc['thumb'], 0, 7)) == 'http://') {
                $articles[$order]['sthumb'] = $arc['thumb'];
            } else {
                $articles[$order]['sthumb'] = config::getadmin('base_url') . '/' . $arc['thumb'];
            }
            $pics = unserialize($arc['pics']);
            if(is_array($pics) && !empty($pics)){
                $articles[$order]['pics'] = $pics;
            }

            $articles[$order]['attr2']=$articles[$order]['attr2']==""?0:$articles[$order]['attr2'];
            $newcname='attr2_'.lang::getistemplate();
            $attr2=json_decode($articles[$order]['attr2'],true);
            $articles[$order]['attr2']=is_array($attr2)?$attr2[$newcname]:$articles[$order]['attr2'];
            if($isint){                                                   //取整
                $articles[$order]['attr2']=isset($articles[$order]['attr2'])?round($articles[$order]['attr2']):0;
            }

            $prices = getPrices($articles[$order]['attr2']);
            $articles[$order]['attr2'] = $prices['price'];
            $articles[$order]['oldprice'] = $prices['oldprice'];
            if ($arc['strong']) {
                $articles[$order]['title'] = '<strong>' . $arc['title'] . '</strong>';
            }
            if ($arc['color'] && (!isset($arc['isvisual']) || !$arc['isvisual'])) {
                $articles[$order]['title'] = '<font style="color:' . $arc['color'] . ';">' . $articles[$order]['title'] . '</font>';
            }

            $taghtml = '';
            if(file_exists(ROOT."/lib/table/tag.php")) {
                $tag_table = tag::getInstance();
                foreach ($tag_table->urls($arc['tag']) as $tag => $url) {
                    $taghtml .= "<a href='$url' target='_blank' class='archive-tag'>$tag</a>";
                }
                $articles[$order]['tag'] = $taghtml;
            }

        }

        cb_datas($articles);
        $this->view->archives = $articles;

        if (@$this->category->category[front::get('catid')]['includecatarchives'])
            $this->view->record_count = $this->archive->rec_count('catid in(' . implode(',', $categories) . ') AND state=1 AND checked=1');
        else
            $this->view->record_count = $this->archive->rec_count('catid=' . front::get('catid') . ' AND state=1 AND checked=1');
        front::$record_count = $this->view->record_count;
        $this->view->catid = front::get('catid');
        $this->view->typeid = isset(front::$get['typeid'])?front::$get['typeid']:0;
        $this->view->spid = isset(front::$get['spid'])?front::$get['spid']:0;
        $this->view->typeid_parentid = isset(front::$get['typeid'])?type::getparentsid(front::$get['typeid']):array(0);
        $this->view->ifson = isset($articles[0])?category::hasson($articles[0]['catid'] ? $articles[0]['catid'] : $this->view->catid):"";
        $this->view->topid = $topid;
        //筛选
        if(file_exists(ROOT."/lib/table/filter.php")) {
            $this->view->filter_one_id = isset(front::$get['filter_one_id']) ? front::$get['filter_one_id'] : 0;
            $this->view->filter_two_id = isset(front::$get['filter_two_id']) ? front::$get['filter_two_id'] : 0;
            $this->view->filter_trhee_id = isset(front::$get['filter_trhee_id']) ? front::$get['filter_trhee_id'] : 0;
        }

        $this->view->parentid = @$this->category->getparent($this->view->catid);
        if (front::$ismobile) {
            $cateobj = category::getInstance();
            $this->view->subids = $cateobj->son($this->view->catid);
            $template = $this->category->category[front::get('catid')]['templatewap'];
            if ($template && file_exists(TEMPLATE . '/' . $this->view->_style . '/' . $template)) {
                if ($cache)return $this->out($template,$cache); else $this->out($template,$cache);
            } else {
                $tpl = category::gettemplatewap($this->view->catid);
                if ($cache)return $this->out($tpl,$cache);else $this->out($tpl,$cache);
            }
            return;
        }
        $template = @$this->category->category[front::get('catid')]['template'];
        //动静态结合判断  商品
        if(count($categorysdata)>0 && $categorysdata[0]['isshopping']){
            $template=config::getadmin('template_shopping_dir').'/'.$template;
            $this->view->_style="";
        }

        //判断专题模板
        if ($this->view->spid && $this->view->typeid==0){
            $spid = $this->view->spid;
            $where= 'spid='.$spid.' and langid = "'.lang::getlangid(lang::getisadmin()).'"';
            $this->view->special = special::getInstance()->getrow($where);
            $template=$this->view->special['template'];
            $this->out($template,$cache,$path_cache);
        }

        //判断内容模板
        if ($this->view->typeid){
            $template = type::gettemplate($this->view->typeid);
            $this->out($template,$cache,$path_cache);
        }

        if ($template && ( file_exists(TEMPLATE . '/' . $this->view->_style . '/' . $template)
                || (file_exists(TEMPLATE . '/'.$template) )))
        {  $this->out($template,$cache,$path_cache);
        }
        else {
            $tpl = category::gettemplate($this->view->catid,'listtemplate',true,$this->view->_style);
            if (category::getishtml($this->view->catid)) {
                $path = ROOT . category::url($this->view->catid, @front::$get['page'] > 1 ? front::$get['page'] : 1);
                if (!preg_match('/\.[a-zA-Z]+$/', $path))
                    $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                $this->cache_path = $path;
            }
            if($categorysdata[0]['isshopping']){
                $tpl=config::getadmin('template_shopping_dir').'/'.$tpl;
            }
            $this->out($tpl,$cache,$path_cache);
        }


    }

    //筛选结果
    function listscreening_action(){
        if(front::get('langurl')){
            $lang=front::get('langurl');
        }else{
            $lang=lang::getistemplate();
        }
        if(front::get('cateGory')!="" && front::get('cateGory')){
            $this->view->cateGorycolor = $_GET['cateGory'];
            $this->view->catid = $_GET['cateGory'];
        }else{
            $this->view->cateGorycolor = '0';
        }
        if($_GET['type']!=""  && front::get('type')  && file_exists(ROOT."/lib/table/type.php")){
            $this->view->typecolor = $_GET['type'];
        }else{
            $this->view->typecolor = '0';
        }
        if($_GET['special']!=""  && front::get('special') && file_exists(ROOT."/lib/table/special.php")){
            $this->view->specialcolor = $_GET['special'];
        }else{
            $this->view->specialcolor = '0';
        }
        if($_GET['minprice']!=""  && front::get('minprice')){
            $this->view->minprice = $_GET['minprice'];
        }else{
            $this->view->minprice = '';
        }
        if(isset($_GET['maxprice'])&&$_GET['maxprice']!=""){
            $this->view->maxprice = $_GET['maxprice'];
        }else{
            $this->view->maxprice = '';
        }

        $articlesWhere=' checked=1  and attr2<>"" ';
        if(front::get('cateGory') != '' && front::get('cateGory')){
            if(substr($_GET['cateGory'],strlen($_GET['cateGory'])-1,strlen($_GET['cateGory']))==','){
                $_GET['cateGory'] = substr($_GET['cateGory'],0,strlen($_GET['cateGory'])-1);
            }
            $articlesWhere=$articlesWhere.' and catid in ('.$_GET['cateGory'].')';
        }
        if(front::get('type') != ''  && front::get('type') && file_exists(ROOT."/lib/table/type.php")){
            if(substr($_GET['type'],strlen($_GET['type'])-1,strlen($_GET['type']))==','){
                $_GET['type'] = substr($_GET['type'],0,strlen($_GET['type'])-1);
            }
            $articlesWhere=$articlesWhere.' and typeid in ('.$_GET['type'].')';
        }
        if(front::get('special') != '' && front::get('special') && file_exists(ROOT."/lib/table/special.php")){
            if(substr($_GET['special'],strlen($_GET['special'])-1,strlen($_GET['special']))==','){
                $_GET['special'] = substr($_GET['special'],0,strlen($_GET['special'])-1);
            }
            $articlesWhere=$articlesWhere.' and spid in ('.$_GET['special'].')';
        }
        //筛选结果加上语言包判断
        $articlesWhere.=" and langid='".lang::getlangid($lang)."'";

        //排序
        $order = "listorder=0,`listorder` asc,`adddate` DESC";
        //分页
        //echo '<script>alert("'.$articlesWhere.'");</script>';
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $articles = $this->archive->getrows($articlesWhere, $limit, $order);
        if (is_array($articles)){
            foreach ($articles as $key=>$val){
                $newcname='attr2_'.$lang;
                $attr2=json_decode($val['attr2'],true);
                $articles[$key]['attr2']=is_array($attr2)?$attr2[$newcname]:$val['attr2'];
                //金额校验
                if(front::get('minprice') != '' && $articles[$key]['attr2']< front::get('minprice') ){
                   unset($articles[$key]);
                }
                //最大金额
                if(front::get('maxprice') != '' && $articles[$key]['attr2'] >  front::get('maxprice') ){
                    unset($articles[$key]);
                }
            }
        }

        $this->view->record_count =$this->archive->rec_count($articlesWhere);
        if (!is_array($articles)) {
            $this->out('message/error.html');
        }else{
            $discount =usergroup::getusergrop(user::getuserid());
            //折扣
            $this->view->discount =$discount ;
            $isint =usergroup::getisint(user::getuserid());
            //取整
            $this->view->isint =$isint ;
            $this->view->archives = $articles;
            $this->view->articlesWhere = "cateGory=".$_GET['cateGory']."&type=".$_GET['type']."&minprice=".$_GET['minprice']."&maxprice=".$_GET['maxprice'];
            if (file_exists(ROOT."/lib/table/special.php")){
                $this->view->articlesWhere.="&special=".$_GET['special'];
            }
        }
        $this->out(config::get('template_shopping_dir').'/screening/list_screening.html');
    }

    function getlist_action(){
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $order = "listorder=0,`listorder` asc,`adddate` DESC";
        $categories = array();
        if (@$this->category->category[front::get('catid')]['ispages'])
            $categories = $this->category->sons(front::get('catid'));
        $categories[] = front::get('catid');
        if (@$this->category->category[front::get('catid')]['includecatarchives']) {
            $articlesWhere ='catid in (' . implode(',', $categories) . ') and checked=1';
        } else {
            $articlesWhere='catid=' . front::get('catid') . ' and checked=1';
        }
        if(isset($_GET['cateGory'])&&$_GET['cateGory']!=""){
            $articlesWhere='catid='.$_GET['cateGory']. ' and checked=1';;
            $this->view->cateGorycolor = $_GET['cateGory'];
        }else{
            $this->view->cateGorycolor = '0';
        }
        if(isset($_GET['type'])&&$_GET['type']!="" && file_exists(ROOT."/lib/table/type.php")){
            $articlesWhere=$articlesWhere.' and typeid='.$_GET['type'];
            $this->view->typecolor = $_GET['type'];
        }else{
            $this->view->typecolor = '0';
        }
        if(isset($_GET['special'])&&$_GET['special']!="" && file_exists(ROOT."/lib/table/special.php")){
            $articlesWhere=$articlesWhere.' and spid='.$_GET['special'];
            $this->view->specialcolor = $_GET['special'];
        }else{
            $this->view->specialcolor = '0';
        }
        $articles = $this->archive->getrows($articlesWhere, $limit, $order);
        foreach ($articles as $k=>$v){
            $articles[$k]['url'] = archive::url($v);
        }
        $newarticles = $this->archive->rec_count($articlesWhere);
        $articles[0]['pageindex']=ceil((int)$newarticles/(int)($this->pagesize));
        $articles[0]['pagesize']=count($articles);
        $articles[0]['page']=$this->view->page;
        echo json_encode($articles);
        exit;
    }

    //防伪码搜索
    function ecodingsearch_action()
    {//print_r($_SESSION);exit();
        if (front::get('keyword') && !front::post('keyword'))
            front::$post['keyword'] = front::get('keyword');
        front::check_type(front::post('keyword'), 'safe');
        if (front::post('keyword')) {
            $this->view->keyword = trim(front::post('keyword'));
            if (preg_match('/union/i', $this->view->keyword) || preg_match('/"/i', $this->view->keyword) || preg_match('/\'/i', $this->view->keyword)) {
                exit(lang('illegal_parameter'));
            }
        } else {
            alerterror(lang('key_words_can_not_be_empty'));
        }

        if (preg_match('/union/i', $this->view->keyword) || preg_match('/"/i', $this->view->keyword) || preg_match('/\'/i', $this->view->keyword)) {
            exit(lang('illegal_parameter'));

        }
        $condition = "ecoding = '" . $this->view->keyword . "'";
        if (config::getadmin('isecoding')) {
            $condition .= " AND (isecoding=0 OR isecoding=1)";
        } else {
            $condition .= " AND (isecoding=1)";
        }
        $order = "`listorder`,aid DESC";
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $articles = $this->archive->getrows($condition, $limit, $order);
        foreach ($articles as $order => $arc) {
            $articles[$order]['url'] = archive::url($arc);
            $articles[$order]['catname'] = category::name($arc['catid']);
            $articles[$order]['caturl'] = category::url($arc['catid']);
            $articles[$order]['adddate'] = sdate($arc['adddate']);
            $articles[$order]['stitle'] = strip_tags($arc['title']);
        }
        $this->view->articles = $articles;
        $this->view->archives = $articles;
        $this->view->record_count = $this->archive->record_count;

        if (front::get('t') == 'wap') {
            $this->out('wap/archive_search.html');
            return;
        }
    }

    function search_action()
    {//print_r($_SESSION);exit();

        if (front::get('ule')) {
            front::$get['keyword'] = str_replace('-', '%', front::$get['keyword']);
            front::$get['keyword'] = urldecode(front::$get['keyword']);
        }
        if (front::get('keyword') && !front::post('keyword'))
            front::$post['keyword'] = front::get('keyword');

        if (front::post('keyword') ==""){
            alertinfo(lang('search').lang('on_null'),url("index/index"));
        }
        $arr=array("!","@","#","$","%","^","&","*","(",")","[","]","|",",",".","<",">","{","}","+","；","\"","www.","http:://","https:://");
        $a=0;
        foreach($arr as $key=>$value){
            if(strpos(front::post('keyword'),$value)){
                $a=1;
            }
        }
        if($a==1){
            echo "<script>alert(\"不能包含特殊字符！\"); history.back(-1);</script>";
            exit;
        }
        //过滤特殊字符
        $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\\+|\/|\;|\'|\`|\-|\=|\\\|\|/";
        front::$post['keyword']=preg_replace($regex,"",front::$post['keyword']);

        front::check_type(front::post('keyword'), 'safe');
        if (front::post('keyword')) {
            $this->view->keyword = trim(front::post('keyword'));
            if (preg_match('/union/i', $this->view->keyword) || preg_match('/"/i', $this->view->keyword) || preg_match('/\'/i', $this->view->keyword)) {
                exit(lang('illegal_parameter'));
            }
            session::set('keyword', trim(front::post('keyword')));
            /* if(isset(front::$get['keyword']))
              front::redirect(preg_replace('/keyword=[^&]+/','keyword='.urlencode($this->view->keyword),front::$uri));
              else  front::redirect(front::$uri.'&keyword='.urlencode($this->view->keyword)); */
        } else {
            $this->view->keyword = session::get('keyword');
            if (preg_match('/union/i', $this->view->keyword) || preg_match('/"/i', $this->view->keyword) || preg_match('/\'/i', $this->view->keyword)) {
                exit(lang('illegal_parameter'));
            }
        }

        if(front::post('search_catid')){
            session::set('searchcatid', trim(front::post('search_catid')));
            $this->view->catid = trim(front::post('search_catid'));
        }else{
            $this->view->catid =session::get('searchcatid');
        }

        if (preg_match('/union/i', $this->view->keyword) || preg_match('/"/i', $this->view->keyword) || preg_match('/\'/i', $this->view->keyword)) {
            exit(lang('illegal_parameter'));
        }

        $path = ROOT . '/data/hotsearch/' . urlencode($this->view->keyword) . '.txt';
        $mtime = @filemtime($path);
        $time = intval(config::getadmin('search_time')) ? intval(config::getadmin('search_time')) : 30;
        if (time() - $mtime < $time && !front::get('page')) {
            alertinfo($time . lang('within_seconds_can_not_repeat_search'), 'index.php?t=' . front::get('t'));
        }
        $keywordcount = @file_get_contents($path);
        $keywordcount = $keywordcount + 1;
        file_put_contents($path, $keywordcount);
        $type = $this->view->category;
        $condition = "";
        if ($this->view->catid) {
            $cateobj = category::getInstance();
            $ciddata = explode(',',$this->view->catid);
            for($index=0;$index<count($ciddata);$index++){
                $cid=$ciddata[$index];
                $sons = $cateobj->sons($cid);
                if (is_array($sons) && !empty($sons)) {
                    $cids = $cid. ',' . implode(',', $sons);
                } else {
                    $cids = $cid;
                }
                $condition .= $condition==""?"( catid in (" . $cids . ") ":" or catid in (" . $cids . ") ";
            }
            $condition .=") and ";
            //var_dump($condition);exit;
        }
        $condition .= "(title like '%" . $this->view->keyword . "%'";
        $sets = settings::getInstance()->getrow(array('tag' => 'table-fieldset'));
        $arr = unserialize($sets['value']);
        if (is_array($arr['archive']) && !empty($arr['archive'])) {
            foreach ($arr['archive'] as $v) {
                if ($v['issearch'] == '1') {
                    $condition .= " OR {$v['name']} like '%{$this->view->keyword}%'";
                }
            }
        }
        $condition=$condition==""?' langid="'.lang::getlangid(lang::getistemplate()).'"':$condition.' and langid="'.lang::getlangid(lang::getistemplate()).'"';
        $condition.= ")";
        if(front::get('searchtype')){
            if( front::$get['searchtype']=="1"){
                $condition.=" and  DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(ADDDATE) ";
            }else if( front::$get['searchtype']=="2"){
                $condition.=" and  DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(ADDDATE) ";
            }else if( front::$get['searchtype']=="3"){
                $condition.=" and  YEAR(ADDDATE)=YEAR(NOW())  ";
            }
            $this->view->searchtype = front::$get['searchtype'];
        }

        $order = "`listorder`,1 DESC";
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $articles = $this->archive->getrows($condition, $limit, $order);
        foreach ($articles as $order => $arc) {
            $articles[$order]['url'] = archive::url($arc);
            $articles[$order]['catname'] = category::name($arc['catid']);
            $articles[$order]['caturl'] = category::url($arc['catid']);
            $articles[$order]['adddate'] = sdate($arc['adddate']);
            $articles[$order]['stitle'] = strip_tags($arc['title']);
        }
        $this->view->articles = $articles;


        $this->view->record_count =front::$record_count= $this->archive->rec_count($condition);
    }

    function banxingsearch_action()
    {
        if (front::get('keyword') && !front::post('keyword'))
            front::$post['keyword'] = front::get('keyword');

        if (front::post('keyword') ==""){
            alertinfo(lang('search').lang('on_null'),url("index/index"));
        }
        $arr=array("!","@","#","$","%","^","&","*","(",")","[","]","|",",",".","<",">","{","}","+","；","\"","www.","http:://","https:://");
        $a=0;
        foreach($arr as $key=>$value){
            if(strpos(front::post('keyword'),$value)){
                $a=1;
            }
        }
        if($a==1){
            echo "<script>alert(\"不能包含特殊字符！\"); history.back(-1);</script>";
            exit;
        }
        //过滤特殊字符
        $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\\+|\/|\;|\'|\`|\-|\=|\\\|\|/";
        front::$post['keyword']=preg_replace($regex,"",front::$post['keyword']);


        $this->view->keyword = trim(front::post('keyword'));
        if (preg_match('/union/i', $this->view->keyword) || preg_match('/"/i', $this->view->keyword) || preg_match('/\'/i', $this->view->keyword)) {
            exit(lang('illegal_parameter'));
        }

        $path = ROOT . '/data/hotsearch/' . urlencode($this->view->keyword) . '.txt';
        $mtime = @filemtime($path);
        $time = intval(config::getadmin('search_time')) ? intval(config::getadmin('search_time')) : 30;
        if (time() - $mtime < $time && !front::get('page')) {
            alertinfo($time . lang('within_seconds_can_not_repeat_search'), 'index.php?t=' . front::get('t'));
        }
        $keywordcount = @file_get_contents($path);
        $keywordcount = $keywordcount + 1;
        file_put_contents($path, $keywordcount);

        //查询类型  1/车型  2/款式编号
        //提取分类
        if(file_exists(ROOT."/lib/table/type.php")) {
            $type_data = type::getInstance()->getrows("typename like '%" . $this->view->keyword . "%'", 0);
        }else{
            $type_data="";
        }
        $condition="(";
        if (is_array($type_data) && count($type_data)>0) {
            foreach ($type_data as $type) {
                $typeid=isset($typeid)?($typeid.','.$type['typeid']):$type['typeid'];
            }
            $condition.=" typeid in (".$typeid.")";
            $condition.="  or title='".$this->view->keyword."' ";
        }else{
            $condition.=" title='".$this->view->keyword."' ";
        }
        $condition.=")";
        $condition.=' and langid="'.lang::getlangid(lang::getistemplate()).'"';

        $order = "`listorder`,1 DESC";
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $articles = $this->archive->getrows($condition, $limit, $order);
        foreach ($articles as $order => $arc) {
            $articles[$order]['url'] = archive::url($arc);
            $articles[$order]['catname'] = category::name($arc['catid']);
            $articles[$order]['caturl'] = category::url($arc['catid']);
            $articles[$order]['adddate'] = sdate($arc['adddate']);
            $articles[$order]['stitle'] = strip_tags($arc['title']);
        }
        $this->view->articles = $articles;
        $this->view->typeid_parentid = (isset(front::$get['typeid']) && file_exists(ROOT."/lib/table/type.php"))?type::getparentsid(front::$get['typeid']):array(0);

        $this->view->record_count =front::$record_count= $this->archive->rec_count($condition);
    }

    //自定义字段搜索
    function esearch_action()
    {
        front::check_type(front::get('keyword'), 'safe');
        $this->view->keyword = trim(front::get('keyword'));



        if ($this->view->keyword) {
            $path = ROOT . '/data/hotsearch/' . urlencode($this->view->keyword) . '.txt';
            $mtime = @filemtime($path);
            $time = intval(config::getadmin('search_time')) ? intval(config::getadmin('search_time')) : 30;
            if (time() - $mtime < $time && !front::get('page')) {
                alertinfo($time . lang('within_seconds_can_not_repeat_search'), 'index.php?t=' . front::get('t'));
            }
            $keywordcount = @file_get_contents($path);
            $keywordcount = $keywordcount + 1;
            file_put_contents($path, $keywordcount);
            $type = $this->view->category;
            $condition = "";
            if (front::get('catid')) {
                $condition .= "catid = '" . front::get('catid') . "' AND ";
            }
            $condition .= "(title like '%" . $this->view->keyword . "%'";
            $sets = settings::getInstance()->getrow(array('tag' => 'table-fieldset'));
            $arr = unserialize($sets['value']);
            if (is_array($arr['archive']) && !empty($arr['archive'])) {
                foreach ($arr['archive'] as $v) {
                    if ($v['issearch'] == '1' && front::get($v['name'])) {
                        if ($v['selecttype']) {
                            $condition .= " AND {$v['name']} = '" . front::get($v['name']) . "'";
                        } else {
                            $condition .= " AND {$v['name']} like '%" . front::get($v['name']) . "%'";
                        }
                    }
                }
            }
            $condition .= ")";
            $order = "`listorder`,1 DESC";
            $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
            $articles = $this->archive->getrows($condition, $limit, $order);
            foreach ($articles as $order => $arc) {
                $articles[$order]['url'] = archive::url($arc);
                $articles[$order]['catname'] = category::name($arc['catid']);
                $articles[$order]['caturl'] = category::url($arc['catid']);
                $articles[$order]['adddate'] = sdate($arc['adddate']);
                $articles[$order]['stitle'] = strip_tags($arc['title']);
            }
            $this->view->articles = $articles;
            $this->view->archives = $articles;
            $this->view->record_count = $this->archive->record_count;
        }
        $this->view->field = $this->archive->getFields();
        if (isset($_GET['catid'])){
            $data=front::$get;
            $where='1=1 ';
            foreach ($data as $key=>$value){
                if($key != 'case' && $key!='act' && $key!='site' && $key!='page'
                    && $key !='dfile'&& ($key !='catid' && $value!='0')){
                    $value=$value==""?0:$value;
                    $where=$where." and IFNULL(".$key.",0)='".$value."'";
                }
            }
            $sql1=" select * from  cmseasy_archive where ".$where;
            $count=$this->archive->rec_query($sql1);
            $limit=' limit 0,5';
            if(isset($_GET['page'])){
                $page=$page*5;
                $limit=' limit '.$page.',5';
            }
            $sql2=" select * from  cmseasy_archive where ".$where.$limit;

            $articlesTites=$this->archive->rec_query($sql2);
            $this->view->articlesTites =$articlesTites;
            $this->view->count =count($count);
        }

    }

    function asearch_action()
    {
        if (front::get('keyword') && !front::post('keyword'))
            front::$post['keyword'] = front::get('keyword');
        front::check_type(front::post('keyword'), 'safe');
        if (front::post('keyword')) {
            $this->view->keyword = trim(front::post('keyword'));
            session::set('keyword', $this->view->keyword);
        } elseif (session::get('keyword')) {
            $this->view->keyword = trim(session::get('keyword'));
            session::set('keyword', $this->view->keyword);
        } else {
            session::set('keyword', null);
            $this->view->keyword = session::get('keyword');
        }
        $limit = (($this->view->page - 1) * $this->pagesize) . ',' . $this->pagesize;
        $articles = $this->archive->getrows("title like '%" . $this->view->keyword . "%'", $limit);
        foreach ($articles as $order => $arc) {
            $articles[$order]['url'] = archive::url($arc);
            $articles[$order]['catname'] = category::name($arc['catid']);
            $articles[$order]['caturl'] = category::url($arc['catid']);
            $articles[$order]['adddate'] = sdate($arc['adddate']);
            $articles[$order]['stitle'] = strip_tags($arc['title']);
        }
        $this->view->articles = $articles;
        $this->view->archives = $articles;
        $this->view->record_count = $this->archive->record_count;
    }

    //内容打开--阅读付费
    function show_action()
    {
        if (front::get("cache")==1 &&  config::get('show_page_php') == 1)
            $cache=true;
        else
            $cache=false;


        $aid = intval(front::get('aid'));
        if (!$aid) {
            $aid = intval(front::get('id'));
        }
        //判断内容是否可查看  是否设置付费查看   商品除外
        $archivedata=$this->archive->getrow('aid='.$aid.' and (attr2 is null or attr2="") ');

        //判断是否静态生成
        $path_cache="";
        if ($cache){
            $path_cache = archive::url($archivedata, $this->view->page > 1 ? $this->view->page : null, lang::getisadmin(), false);
            $path_cache = archive::url_rule($path_cache);
            tool::mkdir(dirname($path_cache));
        }

        $this->view->aid = $aid;    //用于提示的时候购买
        if(isset($archivedata['readmenoy']) && $archivedata['readmenoy']>0){
            if (session::get('username')!=''){
                $userdata=user::getInstance()->getrow("username='".session::get('username')."'");
                $array = explode(",",$userdata['buyarchive']);
                if(!((in_array($aid,$array) || $userdata['buyarchive']==$aid))){
                    $tpl = ROOT.'/template/'.config::get('template_user_dir').'/message/buyerror.html';
                    $this->out($tpl,$cache, $path_cache);
                }
            }else{
                $tpl = ROOT.'/template/'.config::get('template_user_dir').'/message/buyerror.html';
                $this->out($tpl,$cache,$path_cache);
            }
        }
        front::check_type($aid);
        ///已浏览扩展
        if(file_exists(ROOT."/lib/table/browse.php") && !$cache) {
            $user=front::$user;
            if (is_array($user)){
                $browse=browse::getInstance()->getrow(array("aid"=>$aid,"uid"=>$user['userid']));
                if (!is_array($browse))
                browse::getInstance()->rec_insert(array("aid"=>$aid,"uid"=>$user['userid'],"langid"=>lang::getlangid(lang::getistemplate()),"addtime"=>date('Y-m-d h:i:s', time())));
            }
        }
        //获取自定义字段
        $this->view->field = $this->archive->getFields();
        $this->view->showarchive = archive::getInstance()->getrow($aid,'');
        //var_dump($this->view->showarchive);
        $this->manage = new table_archive();
        $this->manage->view_before($this->view->showarchive);
        $addcontentuser = new user();
        $addcontentuser = $addcontentuser->getrow(array('userid' => $this->view->showarchive['userid']));
        if (is_array($addcontentuser)) {
            $this->view->adduser = $addcontentuser;
        }

        if(session::get('ver') != 'corp' && !front::get('pageset')){
            $this->view->showarchive['my_field']='';
        }

        //兼容老版本  老版本结构是{url:{url,alt},alt}  新版本是{url,alt}
        if(is_array($this->view->showarchive['pics']))
            foreach($this->view->showarchive['pics'] as $k => $v){
                if (isset($v['url']['url'])){
                    $this->view->showarchive['pics'][$k]['url']=$v['url']['url'];
                    $this->view->showarchive['pics'][$k]['alt']=isset($v['url']['alt'])?$v['url']['alt']:"";
                }
            }
        $this->view->archive = $this->view->showarchive;

        $this->view->categorys = category::getpositionlink2($this->view->archive['catid']);
        if (!is_array($this->view->archive)){
            $this->out('message/error.html',$cache,$path_cache);
        }
        if ($this->view->archive['checked'] < 1 && !usergroup::getusergropadmin(user::getuserid()) )
            exit("<div class='tip_box' style='width:300px;margin:0px auto;margin-top:50px;padding:20px;border:5px solid #ccc;border-radius: 5px 5px 5px 5px;text-align:center;'>" . lang('error_url') . "<a href='javascript:history.back(-1);'>" . lang('go_back') . "</a></div>");
        if (!rank::arcget(front::get('aid'), $this->view->usergroupid)) {
            $this->out('message/error.html',$cache,$path_cache);
        }
        $this->view->catid = $this->view->archive['catid'];
        $this->view->typeid = $this->view->archive['typeid'];
        $this->view->topid = category::gettopparent($this->view->catid);
        $this->view->parentid = $this->category->getparent($this->view->catid);
        if (!rank::catget($this->view->catid, $this->view->usergroupid)){
                $this->out('message/error.html',$cache,$path_cache);
        }

        if (!isset($this->category->category[$this->view->catid]) ||
            !isset($this->category->category[$this->view->topid])
        ) {

        }
        $template = @$this->view->archive['template'];

        $content = $this->view->archive['content'];
        $content=str_replace("_ueditor_page_break_tag_","<hr/>",$content);

        //$contents = preg_split('%<div style="page-break-after(.*?)</div>%si', $content);
        $contents = preg_split('%<hr/>%', $content);
        if ($contents) {
            $this->view->pages = count($contents);
            front::$record_count = $this->view->pages * config::getadmin('list_pagesize');
            $content = $contents[$this->view->page - 1];
        }

        $this->view->likenews = $this->getLike($this->view->archive['tag'], $this->view->archive['keyword']);

        $taghtml = '';
        if(file_exists(ROOT."/lib/table/tag.php")) {
            $tag_table = new tag();
            foreach ($tag_table->urls($this->view->archive['tag']) as $tag => $url) {
                $taghtml .= "<a href='$url' target='_blank'>$tag</a>&nbsp;&nbsp;";
            }
            $this->view->archive['tag'] = $taghtml;
        }

        $this->view->archive['special'] = null;
        if ($this->view->archive['spid'] && file_exists(ROOT."/lib/table/special.php")) {
            $spurl = special::url($this->view->archive['spid'], special::getishtml($this->view->archive['spid']));
            $sptitle = special::gettitle($this->view->archive['spid']);
            $this->view->archive['special'] = "<a href='$spurl' target='_blank'>$sptitle</a>&nbsp;&nbsp;";
        }
        $this->view->archive['type'] = null;
        if ($this->view->archive['typeid'] && file_exists(ROOT."/lib/table/type.php")) {
            $typeurl = type::url($this->view->archive['typeid'], 1);
            $typetitle = type::name($this->view->archive['typeid']);
            $this->view->archive['type'] = "<a href='$typeurl' target='_blank'>$typetitle</a>&nbsp;&nbsp;";
        }
        //$this->view->archive['area'] = null;
        //$this->view->archive['area'] = area::getpositonhtml($this->view->archive['province_id'], $this->view->archive['city_id'], $this->view->archive['section_id']);

        //$content=str_replace('&nbsp;', ' ', $content);
        //$this->view->archive['content'] = htmlspecialchars_decode($content);  //htmlspecialchars_decode解析html代码
        $this->view->archive['content'] = $content;
        $aid = intval(front::$get['aid']);
        $catid = $this->view->catid;
        if (!$this->view->archive['showform']) {
            $this->getshowform($catid);
        } else if ($this->view->archive['showform'] && $this->view->archive['showform'] == '1') {
            $this->showform = 1;
        } else {
            $this->showform = $this->view->archive['showform'];
        }
        if (preg_match('/^my_/is', $this->showform)) {
            $this->view->archive['showform'] = $this->showform;
            $o_table = new defind($this->showform);
            front::$get['form'] = $this->showform;
            $this->view->primary_key = $o_table->primary_key;
            $field = $o_table->getFields();
            $fieldlimit = $o_table->getcols('user_modify');
            helper::filterField($field, $fieldlimit);
            $this->view->field = $field;
        } else {
            $this->view->archive['showform'] = '';
        }

        $str = "";

        cb_data($this->view->archive);
        $newcname='cname_'.lang::getistemplate();
        $adminlang=lang::getistemplate();
        $filedname=array();//自定义字段名称
        foreach ($this->view->archive as $key => $value) {
            if (!preg_match('/^my/', $key) )
                continue;

            $category = category::getInstance();
            setting::$var['archive'][$key]['catid_'.$adminlang]=isset(setting::$var['archive'][$key]['catid_'.$adminlang])?setting::$var['archive'][$key]['catid_'.$adminlang]:"";
            setting::$var['archive'][$key]['catid_'.$adminlang]=setting::$var['archive'][$key]['catid_'.$adminlang]==""?0:setting::$var['archive'][$key]['catid_'.$adminlang];
            $sonids = $category->sons(setting::$var['archive'][$key]['catid_'.$adminlang]);

            if (setting::$var['archive'][$key]['catid_'.$adminlang] != $this->view->archive['catid']
                && !in_array($this->view->archive['catid'], $sonids) ) {//&& (setting::$var['archive'][$key]['catid'])
                unset($this->view->field[$key]);
                continue;
            }
            setting::$var['archive'][$key][$newcname]=isset(setting::$var['archive'][$key][$newcname])?setting::$var['archive'][$key][$newcname]:"";
          if (!is_array($value))
             $str .= '<p> ' .setting::$var['archive'][$key][$newcname]. ':' . $value . '</p>';

            $filedname[$key]=setting::$var['archive'][$key][$newcname];
            //判断下载附件的自定义字段
            if (isset(setting::$var['archive'][$key]['filetype']) && setting::$var['archive'][$key]['filetype'] && setting::$var['archive'][$key]['filetype']!="pic"){
                if ($value){
                    $this->view->archive[$key]=attachment_js($this->view->archive['aid'],$key);
                }
            }
        }
        $this->view->archive['my_fields'] = $str;
        $this->view->archive['filedname'] = $filedname;
        $sql1 = "SELECT aid,title,catid,thumb FROM `{$this->archive->name}` WHERE catid = '$catid' AND aid > '$aid' and state=1 and checked=1 ORDER BY aid ASC LIMIT 0,1";
        $sql2 = "SELECT aid,title,catid,thumb FROM `{$this->archive->name}` WHERE catid = '$catid' AND aid < '$aid' and state=1 and checked=1 ORDER BY aid DESC LIMIT 0,1";
        $n = $this->archive->rec_query_one($sql1);
        $p = $this->archive->rec_query_one($sql2);
        $this->view->archive['p'] = $p;
        $this->view->archive['n'] = $n;
        $this->view->archive['p']['url'] = archive::url($p);
        $this->view->archive['n']['url'] = archive::url($n);

        $this->view->archive['strgrade'] = archive::getgrade($this->view->archive['grade']);

        $newcname='attr2_'.lang::getistemplate();
        $attr2=json_decode($this->view->archive['attr2'],true);
        $this->view->archive['attr2']=is_array($attr2)?$attr2[$newcname]:$this->view->archive['attr2'];

        $prices = getPrices($this->view->archive['attr2']);
        $this->view->archive['attr2'] = $prices['price'];
        $this->view->archive['url'] = archive::url($this->view->archive);
        $this->view->archive['oldprice'] = $prices['oldprice'];
        $this->view->groupname = $prices['groupname'];


        //获取评论列表
        $this->view->comments = comment::getIns()->getrows('state=1 and aid=' . $aid);

        //自定义字段区分语言包
        $datanamefield=explode(",",trim($this->view->archive['my_field']));
        $fieldName='';
        for($index=0;$index<count($datanamefield);$index++){
            $category = category::getInstance();
            setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang]=isset(setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang])?setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang]:"";
            setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang]=setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang]==""?0:setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang];
            $sonids = $category->sons(setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang]);
            $sonids[count($sonids)]=setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang];
            if (setting::$var['archive'][$datanamefield[$index]]['catid_'.$adminlang] == $this->view->archive['catid']
                || in_array($this->view->archive['catid'], $sonids) ) { //&& (setting::$var['archive'][$datanamefield[$index]]['catid'])
                if($fieldName==''){
                    $fieldName=$datanamefield[$index];
                }else{
                    $fieldName=$fieldName.','.$datanamefield[$index];
                }
            }
        }

        $this->view->archive['my_field'] =$fieldName;


        if (front::$ismobile) {
            $templatewap = @$this->view->archive['templatewap'];
            if ($templatewap && file_exists(TEMPLATE . '/' . $this->view->_style . '/' . $templatewap)) {
                $this->out($templatewap);
            } else {
                $tpl = category::gettemplate($this->view->catid, 'showtemplatewap',true,$this->view->_style);
                if (!$tpl) $tpl = 'archive/show.html';
                $this->out($tpl);
                return;
            }
        }


        //动态下  区分商品和内容
        $cateshopping=category::getInstance()->getrow("catid='".$this->view->archive['catid']."'");

        if( $cateshopping['isshopping']){
            $template=config::getadmin('template_shopping_dir').'/'.$template;
        }
        if ($template && (file_exists(TEMPLATE . '/' . $this->view->_style . '/' . $template)
                || file_exists(TEMPLATE . '/' . $template) )){
            $this->out($template,$cache,$path_cache);
        }else {
            $tpl = category::gettemplate($this->view->catid, 'showtemplate',true,$this->view->_style);
            if (category::getarcishtml($this->view->archive)) {
                $path = ROOT . archive::url($this->view->archive);
                if (!preg_match('/\.[a-zA-Z]+$/', $path))
                    $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
                $this->cache_path = $path;
            }
            if($cateshopping['isshopping']){
                $tpl=config::getadmin('template_shopping_dir').'/'.$tpl;
            }
            $this->out($tpl,$cache,$path_cache);
        }
    }

    //获取标题和按钮
    function gettitle_action(){
        $aid = intval(front::get('aid'));
        $returndata='';
        $archive=archive::getInstance();
        $user = user::getInstance();
        $archivedata=$archive->getrow('aid='.$aid);
        if (is_array($archivedata)){
            //$name = archive_attachment($aid, 'intro');   //名称
            $userdata=$user->getrow("username='".session::get('username')."'"); //用户是否购买过
            $array = explode(",",$userdata['buyarchive']);
            $url="'".url('archive/buyarchive/aid/'.$aid)."'";   //购买链接
            $archivedata['readmenoy']=$archivedata['readmenoy']?$archivedata['readmenoy']:getcategory_menoy("readmenoy",$archivedata['catid']);
            $archivedata['domwmenoy']=$archivedata['domwmenoy']?$archivedata['domwmenoy']:getcategory_menoy("domwmenoy",$archivedata['catid']);
            if($archivedata['attachment_path']){
                if($archivedata['readmenoy']>0){
                    if(in_array($aid,$array)){
                        $returndata.='<a title="'.strip_tags($archivedata['title']).'" href="'.archive::url($archivedata).'" target="_blank">'.$archivedata['title'].'</a>';
                        $returndata.="<span><a target='_blank' title='".strip_tags($archivedata['title'])."' id='att' name='attmenoy' href='" . url::create('attachment/down/aid/' . $aid) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a></span>";
                    }else{
                        $returndata.='<a title="'.strip_tags($archivedata['title']).'">'.$archivedata['title'].'</a>';
                        $returndata.= "<span><a target='_blank' id='att' name='attmenoy' onclick=\"shoppingarchive(".$url.",'".lang('doyou_buy')."')\" class='btn btn-default visual-content-down-link-btn'>" . lang('buy') . "</a></span>";
                    }
                }else if ($archivedata['domwmenoy']>0){
                    $returndata.='<a title="'.strip_tags($archivedata['title']).'" href="'.archive::url($archivedata).'" target="_blank">'.$archivedata['title'].'</a>';
                    if(in_array($aid,$array)){
                        $returndata.="<span><a target='_blank' title='".strip_tags($archivedata['title'])."' id='att' name='attmenoy' href='" . url::create('attachment/down/aid/' . $aid) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a></span>";
                    }else{
                        $returndata.= "<span><a target='_blank' id='att' name='attmenoy' onclick=\"shoppingarchive(".$url.",'".lang('doyou_buy')."')\" class='btn btn-default visual-content-down-link-btn'>" . lang('buy') . "</a></span>";
                    }
                }else{
                    //$returndata .= '<a title="' . strip_tags($archivedata['title']) . '">' . $archivedata['title'] . '</a>';
                    $returndata.='<a title="'.strip_tags($archivedata['title']).'" href="'.archive::url($archivedata).'" target="_blank">'.$archivedata['title'].'</a>';
                    $returndata.= "<span><a target='_blank' title='".strip_tags($archivedata['title'])."' id='att' name='attmenoy' href='" . url::create('attachment/down/aid/' . $aid) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a></span>";
                }
            }else{
                if($archivedata['readmenoy']>0  && in_array($aid,$array)) {
                    $returndata .= '<a title="' . strip_tags($archivedata['title']) . '">' . $archivedata['title'] . '</a>';
                    $returndata.= "<span><a target='_blank' id='att' name='attmenoy' onclick=\"shoppingarchive(".$url.",'".lang('doyou_buy')."')\" class='btn btn-default visual-content-down-link-btn'>" . lang('buy') . "</a></span>";
                }else{
                    $returndata.='<a title="'.strip_tags($archivedata['title']).'" href="'.archive::url($archivedata).'" target="_blank">'.$archivedata['title'].'</a>';
                    $returndata.='<span><a class="visual-content-down-link-btn">'.lang('nodownload').'</a></span>';
                }

            }
        }
        echo json_encode($returndata);
        exit;
    }

    //购买阅读内容
    function buyarchive_action(){
        if(session::get('username')==''){
            $returndata=array('static'=>0,'message'=>lang('buy_old_login'),'gotourl'=>url('user/login'));
        }else
            {
            $aid = intval(front::get('aid'));
            $archive = archive::getInstance();
            $archivedata=$archive->getrow('aid='.$aid);
            if (is_array($archivedata)){
                $archivedata['readmenoy']=$archivedata['readmenoy']?$archivedata['readmenoy']:getcategory_menoy("readmenoy",$archivedata['catid']);
                $archivedata['domwmenoy']=$archivedata['domwmenoy']?$archivedata['domwmenoy']:getcategory_menoy("domwmenoy",$archivedata['catid']);

                //购买的价格
                $archivemenoy=0;
 		$discount =usergroup::getusergrop(user::getuserid());
                if($archivedata['readmenoy']>0){
                    $archivemenoy=$archivedata['readmenoy'];
                }else  if ($archivedata['domwmenoy']>0){
                    $archivemenoy=$archivedata['domwmenoy'];
                }
		$archivemenoy=floatval($archivemenoy) * $discount/10;
                $user=user::getInstance();
                $userdata=$user->getrow("username='".session::get('username')."'");
                if($userdata['menoy']>$archivemenoy){
                    //减少用户余额
                    $userdata['menoy']=round($userdata['menoy']-$archivemenoy,2);
                    if( $userdata['buyarchive']==''){
                        $userdata['buyarchive']=$aid;
                    }else{
                        $userdata['buyarchive'].=','.$aid;
                    }
                    $user->rec_update(array('menoy'=>$userdata['menoy'],'buyarchive'=>$userdata['buyarchive']),$userdata['userid']);
                    //生成订单
                    if(file_exists(ROOT."/lib/table/xfconsumption.php")) {
                        $xfconsumption = new xfconsumption();
                        $xfconsumptiondata['adddate'] = date('Y-m-d h:i:s', time());
                        $xfconsumptiondata['mid'] = $userdata['userid'];
                        $payname = 'yuer';
                        $xfconsumptiondata['oid'] = date('YmdHis') . '-' . $xfconsumptiondata['mid'] . '-' . $payname;
                        $xfconsumptiondata['status'] = 1;
                        $xfconsumptiondata['aid'] = $aid;
                        $xfconsumptiondata['xftype'] = 4;//消费类型(1/商品消费 2/充值记录 3/插件模板消费 4/阅读下载购买)
                        $xfconsumptiondata['menoy'] = $archivemenoy;
                        $xfconsumptiondata['content'] = lang('pay_reading_download_No') . $aid;
                        $xfconsumption->rec_insert($xfconsumptiondata);
                    }
                    //添加到记录表
                    if(file_exists(ROOT."/lib/table/downlogin.php")) {
                        if ($userdata['userid']) {
                            $menoy=floatval($archivedata['domwmenoy']) * $discount/10;
                            $downlogin = array("aid" => front::get('aid'), "uid" => $userdata['userid'], "menoy" => $menoy, "adddate" => date('Y-m-d H:i:s'));
                            downlogin::getInstance()->rec_insert($downlogin);
                        }
                    }

                    $returndata=array('static'=>1,'message'=>lang('buy_success'),"url"=>url('attachment/down/aid/'.$aid));
                }else{
                    $returndata=array('static'=>0,'message'=>lang('insufficient_balance_please_recharge_first'),'gotourl'=>url('archive/consumption'));
                }
            }else{
                $returndata=array('static'=>0,'message'=>lang('no_archive'),'gotourl'=>"#");
            }
        }
        echo json_encode($returndata);
        exit;
    }
    //获取价格
    function getarchiveprice_action(){
        $aid = intval(front::get('aid'));
        if (front::get('aid')!=''){
            //先获取折扣
            $usergroupid=user::getuserid();
            $discount =usergroup::getusergrop($usergroupid);
            //获取商品单价
            $archive=new archive();
            //保存商品价格
            $price = array();
            $articles = $archive->getrows($aid, 1);
            //取整
            if(is_array($articles)){
                $isint =usergroup::getisint($usergroupid);

                $newcname='attr2_'.lang::getistemplate();
                $attr2=json_decode($articles[0]['attr2'],true);
                $articles[0]['attr2']=is_array($attr2)?$attr2[$newcname]:$articles[0]['attr2'];

                if($isint){
                    $price['oldprice']=round($articles[0]['attr2']);
                    $price['newprice']=round($articles[0]['attr2']*$discount/10);
                }else{
                    $price['oldprice']=round($articles[0]['attr2'],2);
                    $price['newprice']=round($articles[0]['attr2']*$discount/10,2);
                }
                if(cookie::get('login_username')!=''){
                    $price['oldpricestatic']='1';
                }else{
                    $price['oldpricestatic']='0';
                }
                $articles['shoppingprice'] =$price;

                //产品码的数量单独计算
                if(file_exists(ROOT."/lib/table/productcode.php")) {
                    $productcode = productcode::getInstance()->getrows("status=1", 0, "id desc", 'shopid');
                    if (is_array($productcode)) {
                        $productcode_data = array();
                        foreach ($productcode as $key => $val) {
                            $productcode_data[] = $val['shopid'];
                        }
                        if (in_array(front::get('aid'), $productcode_data)) {
                            $count_data = productcode::getInstance()->getrows("status=1 and shopid=" . front::get('aid'), 0, "id desc", 'shopid');
                            $articles[0]['inventory'] = is_array($count_data) ? count($count_data) : 0;
                            $archive->rec_update("inventory=" . $articles[0]['inventory'], "aid=" . front::get('aid'));
                        }
                    }
                }

                echo json_encode($articles);
                exit;
            }
        }
        echo '-1';
        exit;
    }
    //商品类型名称
    function getfieldName_action(){
        $field=front::get('field');

        $dataname= array();
        $datanamefield=explode(",",trim($field));
        $fieldName='';
        $newcname='cname_'.lang::getistemplate();
        for($index=0;$index<count($datanamefield);$index++){
            if($fieldName==''){
                $fieldName=setting::$var['archive'][$datanamefield[$index]][$newcname];
            }else{
                $fieldName=$fieldName.','.setting::$var['archive'][$datanamefield[$index]][$newcname];
            }
        }
            echo json_encode($fieldName);
        exit;
    }
    //组合商品类型
    function getcombinedarchiveType_action(){
        $combined=front::get('combined');
        $combined=self::unescape($combined);
        $combineddata=explode("-",$combined);
        $return=array();
        for($index=0;$index<count($combineddata);$index++) {
            $newcombineddata = explode("#",$combineddata[$index]);   //获取出下标0 aid，数量和 下标1  类型
            $array_combineddata = explode(",",$newcombineddata[0]);  //数组下标0是 aid   1是数量

            $aid = intval($array_combineddata[0]);
            if (!$aid) {
                $aid = intval(front::get('id'));
            }
            front::check_type($aid);
            $archivedata = archive::getInstance()->getrow($aid, '');
            if (is_array($archivedata)) {
                $newcname = 'attr2_' . lang::getistemplate();
                $attr2 = json_decode($archivedata['attr2'], true);
                $archivedata['attr2'] = is_array($attr2) ? $attr2[$newcname] : $archivedata['attr2'];

                $prices = getPrices($archivedata['attr2']);
                $archivedata['attr2'] = $prices['price'];
                $archivedata['oldprice'] = $prices['oldprice'];

            }

            $showtype = "";//显示的类型
            $showprice = "";//显示的价格
            $buytype = "";//购买的类型
            if ($newcombineddata[1] != "") {
                $newcombineddata =explode(";",$newcombineddata[1]);  //区分多个类型
                for ($i = 0;$i < count($newcombineddata);$i++) {
                    $newcombineddatatype =explode(":",$newcombineddata[$i]); //my_shop_model,3:定位,jia,2
                    $oldfielddata = explode(",",$newcombineddatatype[0]);    //my_shop_model,3:
                    if ($archivedata[$oldfielddata[0]] != '') {
                       $newfielddata = explode("\n",$archivedata[$oldfielddata[0]]);
                        for ($j = 0; $j <count($newfielddata);$j++) {
                            $newnewfielddata = explode(":",$newfielddata[$j]); //1:定位,+,2,
                            if ($newnewfielddata[0] == $oldfielddata[1]) {
                                $buytype = $buytype == '' ? $oldfielddata[0].",".$newnewfielddata[0].":" : $buytype.';'.$oldfielddata[0].",".$newnewfielddata[0].":";
                                $newnewfielddata =explode(",",$newnewfielddata[1]);
                                $showtype = $showtype == '' ? $newnewfielddata[0] : $showtype.'-'.$newnewfielddata[0];
                                if ($newnewfielddata[1] == '+') {
                                    $archivedata['attr2'] = $archivedata['attr2']+$newnewfielddata[2];
                                } else if ($newnewfielddata[1] == '-') {
                                    $archivedata['attr2'] = $archivedata['attr2']- $newnewfielddata[2];
                                } else if ($newnewfielddata[1] == '*') {
                                    $archivedata['attr2'] = $archivedata['attr2']*$newnewfielddata[2];
                                } else if ($newnewfielddata[1] == '/') {
                                    $archivedata['attr2'] = $archivedata['attr2']/$newnewfielddata[2];
                                }
                                if ($newnewfielddata[1] == '+') {
                                    $newnewfielddata[1] = 'jia';
                                } else if ($newnewfielddata[1] == '-') {
                                    $newnewfielddata[1] = 'jian';
                                } else if ($newnewfielddata[1] == '*') {
                                    $newnewfielddata[1] = 'chen';
                                } else if ($newnewfielddata[1] == '/') {
                                    $newnewfielddata[1] = 'chu';
                                } else {
                                    $newnewfielddata[1] = $newnewfielddata[1];
                                }
                                $buytype = $buytype.$newnewfielddata[0].",".$newnewfielddata[1].",".$newnewfielddata[2];
                            }
                        }
                    }
                }
            }
            $showprice = $archivedata['attr2'];
            $htmldata = "<div class=\"col-lg-2 col-md-2 col-xs-4\"><div class=\"row\"><div class=\"combination-shopping-list-swiper\">";
            $htmldata.= "<img src='".$archivedata['thumb']."' class=\"img-responsive\">";
            $htmldata.= "<p>".$archivedata['title']."</p>";
            $htmldata.= "<p>".$showtype."</p>";
            $htmldata.= "<p>";
            $htmldata.= "<label class=\"checkbox-inline\">";
            $onclickdata = "clickcombinedshopping(".$archivedata['aid'].",'".$buytype."',".$showprice.",this)";
            $htmldata.= "<input type=\"checkbox\" onclick=\"".$onclickdata."\" value=\"option1\"> ";
            if (config::get('show_pice')==1)$htmldata.=lang('unit')." ".$showprice;
            $htmldata.= "</label>";
            $htmldata.= "</p>";
            $htmldata.= "</div></div></div>";
            $return[]=$htmldata;
           /* $("#getcombineddata").append($htmldata);*/
        }

        echo json_encode($return);
        exit;
    }
    //给前台的escape的中文字符转码
    function unescape($str){
        $ret = '';
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++){
            if ($str[$i] == '%' && $str[$i+1] == 'u'){
                $val = hexdec(substr($str, $i+2, 4));
                if ($val < 0x7f) $ret .= chr($val);
                else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
                else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));
                $i += 5;
            }
            else if ($str[$i] == '%'){
                $ret .= urldecode(substr($str, $i, 3));
                $i += 2;
            }
            else $ret .= $str[$i];
        }
        return $ret;
    }
    //商品类型
    function getarchiveType_action(){
        $aid = intval(front::get('aid'));
        if (!$aid) {
            $aid = intval(front::get('id'));
        }
        front::check_type($aid);
        $archivedata=archive::getInstance()->getrow($aid,'');
        if(is_array($archivedata)){
            $newcname='attr2_'.lang::getistemplate();
            $attr2=json_decode($archivedata['attr2'],true);
            $archivedata['attr2']=is_array($attr2)?$attr2[$newcname]:$archivedata['attr2'];

            $prices = getPrices($archivedata['attr2']);
            $archivedata['attr2'] = $prices['price'];
            $archivedata['oldprice'] = $prices['oldprice'];
        }


        $field=front::get('field');
        $datanamefield = explode(',',$field);
        $return=array();
        for($index=0;$index<count($datanamefield);$index++){
            $return[$index]['name']=$datanamefield[$index];
            if ($archivedata[$datanamefield[$index]] == 'num' || $archivedata[$datanamefield[$index]]==''){
                $return[$index]['display']=false;
            }else{
                $return[$index]['display']=true;
               /* if (strpos($archivedata[$datanamefield[$index]],'\r\n') !== false){
                   $dataarray=explode('\r\n',$archivedata[$datanamefield[$index]]);
                } else  if (strpos($archivedata[$datanamefield[$index]],'/[\n]/') !== false){
                    $dataarray=explode('\n',$archivedata[$datanamefield[$index]]);
                }*/
                $dataarray=explode("\n",$archivedata[$datanamefield[$index]]);
                for($i=0;$i<count($dataarray);$i++){
                    $newdataarray=explode(',',$dataarray[$i]);
                    $fieldtype=explode(':',$newdataarray[0]);
                    $onclickprice="onclickprice(this,'".$newdataarray[1]."','".$newdataarray[2]."','".$datanamefield[$index]."','".$fieldtype[1]."','".$fieldtype[0]."','".(strlen($newdataarray[3])>1?$newdataarray[3]:'')."')";

                    $htmldata='<button name="'.$datanamefield[$index].'" id="img'.$datanamefield[$index].$fieldtype[0].'" onclick="'.$onclickprice.'" type="button" data-switch-toggle="animate" class="btn">'.$fieldtype[1].'</button>';
                    $return[$index]['append'][$i]['appendhtml']=$htmldata;
                    $butteid=$datanamefield[$index].$fieldtype[0];
                    if($newdataarray[3]!=""){
                        $return[$index]['append'][$i]['Existstype']=true;
                        $return[$index]['append'][$i]['Exists1']=$newdataarray[3];
                        $return[$index]['append'][$i]['Exists2']=$butteid;
                        $return[$index]['append'][$i]['Exists3']=$fieldtype[1];
					}else{
                        $return[$index]['append'][$i]['Existstype']=false;
                    }
                }
			}
        }
        echo json_encode($return);
        exit;
    }

    //商品类型
    function getarchiveTypeadmin_action(){
        $aid = intval(front::get('aid'));
        if (!$aid) {
            $aid = intval(front::get('id'));
        }
        front::check_type($aid);
        $archivedata=archive::getInstance()->getrow($aid,'');
        if(is_array($archivedata)){
            $newcname='attr2_'.lang::getistemplate();
            $attr2=json_decode($archivedata['attr2'],true);
            $archivedata['attr2']=is_array($attr2)?$attr2[$newcname]:$archivedata['attr2'];

            $prices = getPrices($archivedata['attr2']);
            $archivedata['attr2'] = $prices['price'];
            $archivedata['oldprice'] = $prices['oldprice'];
        }

        echo json_encode($archivedata);
        exit;
    }

    //顶部导航搜索
    function searAdminTitle_action(){
        $sear_name = front::get('sear_name');
        $path=ROOT.'/lang/'.lang::getisadmin().'/system_search.php';
        $content=include($path);
        $newcontent=array();
        foreach ($content as $key=>$value){
            if( $sear_name=="" || (strpos($key,$sear_name) !== false)  ){
                $newstatic=true;
                foreach ($newcontent as $newkey=>$newval){
                    if($newval['titleURL']==$value){
                        $newstatic=false;
                    }
                }
                if($newstatic){
                    array_push($newcontent,array("title"=>$key,"titleURL"=>$value));
                }
            }
        }
        echo json_encode($newcontent);
        exit;

    }

    function getLike($tag, $keyword)
    {
        $str = '';
        if ($tag && file_exists(ROOT."/lib/table/tag.php")) {
            $tags = explode(',', $tag);
            foreach ($tags as $v) {
                if ($v)
                    $str .= " OR tag LIKE '%$v%'";
            }
        }
        if ($keyword) {
            $keywords = explode(",", $keyword);
            foreach ($keywords as $v) {
                if ($v)
                    $str .= " OR keyword LIKE '%$v%'";
            }
        }
        $str = substr($str, 3);
        if (!$str) {
            return null;
        }
        $prefix = config::getdatabase('database', 'prefix');
        $limit = intval(config::getadmin('like_news')) ? intval(config::getadmin('like_news')) : 5;
        $sql = "SELECT aid,catid,typeid,title,adddate,linkto,iswaphtml,htmlrule,ishtml,introduce,thumb FROM `{$prefix}archive` where checked=1 AND ($str) ORDER BY aid DESC LIMIT 0,$limit";
        //echo $sql;
        $row = $this->archive->rec_query($sql);
        return $row;
    }

    function getshowform($cid)
    {
        $category = category::getInstance();
        $row = $category->getrow(array('catid' => $cid), '1 desc', 'catid,showform,parentid');
        if ($row['showform'] && $row['showform'] != 1) {
            $this->showform = $row['showform'];
        } else if ($row['showform'] && $row['showform'] == 1) {
            $this->showform = 1;
        } else if (!$row['showform']) {
            if ($row['parentid'] != 0) {
                $this->getshowform($row['parentid']);
            } else {
                $this->showform = '1';
            }
        }
    }

    function view_js_action()
    {
        front::check_type(front::get('aid'));
        $aid = intval(front::get('aid'));
        $this->archive->rec_update('view=view+1', $aid);

        $archive = $this->archive->getrow($aid);
        if ($archive['view']<=1 && array_key_exists('my_viewtime', $archive)){
            $this->archive->rec_update(array('my_viewtime'=>date('Y-m-d H:i:s', time())), $aid);
        }
        echo tool::text_javascript($archive['view']);
        exit;
    }

    function jsPrice_action()
    {
        front::check_type(front::get('aid'));
        $aid = intval(front::get('aid'));
        $archive = $this->archive->getrow($aid);
        $price = getPrices($archive['attr2']);
        echo tool::text_javascript($price['price']);
        exit;
    }

    function email_action()
    {
        if (front::post('submit')) {
            $path = ROOT . '/data/subscriptionmail.txt';
            $maillist = file_get_contents($path);
            $content = $maillist . ',guest' . time() . ' [' . front::$post['email'] . ']';
            file_put_contents($path, $content);
            echo '<script type="text/javascript">alert("' . lang('operation_complete') . '")</script>';
            front::refresh(url('archive/email', true));
        }
        $this->render('email/email.html');
        exit;
    }

    function respond_action()
    {
        $out_trade_no = $_GET['subject'] ? $_GET['subject'] : $_POST['subject'];
        if(!$out_trade_no){
            $out_trade_no = $_GET['out_trade_no'] ? $_GET['out_trade_no'] : $_POST['out_trade_no'];
        }
        if(front::$get['code'] == 'wxscanpay') {
            $out_trade_no=front::$get['oid'];
        }
        if(front::$get['code'] == 'unionpay') {
            $out_trade_no=front::$get['orderId'];
        }
        $code = explode('-', $out_trade_no);
        if(front::$get['tablename'] == 'consumption' || front::$get['tablename'] == 'buytemplateorders'|| front::$get['tablename'] == 'buymodulesorders'){
            $payclassname = $code[2];
        }else{
            $payclassname = $code[3];
        }


        $flist = array('alipay', 'nopay', 'paypal', 'paypal_ec', 'tenpay', 'malipay','wxpay','wxscanpay','unionpay');
        if (!in_array($payclassname, $flist)) {
            exit(lang('illegal_parameter'));
        }

        include_once ROOT . '/lib/plugins/pay/' . $payclassname . '.php';
        if(front::$get['code'] == 'unionpay' || front::$get['code'] == 'scanunionpay'
            || front::$get['code'] == 'appunionpay') {
            $payobj = new $payclassname();
            $status_data = $payobj->backUrl();
            if ($status_data['static']) {
                $status=true;
            } else {
                exit($status_data['message']);
            }
        }
        elseif(front::$get['code'] != 'wxscanpay') {
            $payobj = new $payclassname();
            $status = $payobj->respond(front::$get['tablename']);

            //var_dump($status);
            if ($_POST['out_trade_no']) {
                if ($status) {
                    exit('success');
                } else {
                    exit('fail');
                }
            }
        }else{
            $status=true;
        }
        $url='archive/'.front::$get['tablename'].'/oid/';
        $xfconsumptiondata=xfconsumption::getInstance()->getrows('oid="'.$out_trade_no.'"');//查询是否存在消费订单
        if(front::$get['tablename'] == 'consumption'){
            $consumption=consumption::getInstance()->getrow('oid="'.$out_trade_no.'"');//查询是否存在充值订单
            if (count($consumption)>0 && $consumption['status']==1){
                $status=false;
            }
        }
        if ($status && count($xfconsumptiondata)<1) {

            //支付了分发产品码
            if(file_exists(ROOT."/lib/table/productcode.php")) {
                productcode::product($out_trade_no);
            }
            if(front::$get['tablename']=="buytemplateorders" || front::$get['tablename']=="buymodulesorders"){
                $tablename="appsorders";   //在线模板订单表
            }else{
                $tablename=front::$get['tablename'];
            }
            $table = new $tablename();
            $tabledata = $table->getrows("oid='".$out_trade_no."'", 1); //查询订单表
            if ($this->view->user['userid']){  //增加判断 userid存在的时候增加  不然匿名导致出问题
                user::setintegration($tabledata[0]['menoy']);   //积分增加
            }
            //新增消费记录
            $xfconsumption = new xfconsumption();
            $xfconsumptiondata = array();
            $xfconsumptiondata['status'] = '1';
            $xfconsumptiondata['adddate'] = date('Y-m-d h:i:s', time());
            $xfconsumptiondata['mid'] = $this->view->user['userid'] ? $this->view->user['userid'] : 0;
            $xfconsumptiondata['trade_no'] = '';

            if(front::$get['tablename'] == 'consumption'){
                $user=new user();
                $userdata = $user->getrows("userid='".$code[1]."'", 1);
                $moeny=$userdata[0]['menoy'];
                $moeny=(float)($moeny)+(float)($tabledata[0]['menoy']);
                $moenyarray = array('menoy' => $moeny);
                $user->rec_update($moenyarray, "userid='".$code[1]."'");
                //增加通知到问答  充值的通知
                if(file_exists(ROOT."/lib/table/answermessage.php")){
                    answermessage::message_add($code[1],0,1,$tabledata[0]['menoy']);
                }
                $xfconsumptiondata['oid'] = $out_trade_no;
                $xfconsumptiondata['menoy'] =$tabledata[0]['menoy'];
                $xfconsumptiondata['xftype'] =2;  //充值记录
                $xfconsumptiondata['content'] = lang('lang_user').lang('recharge').'！';

                //为推荐人增加金额  判断是否安装扩展
                if(file_exists(ROOT."/lib/table/union.php")){
                    if (union::getconfig('enabled') && $userdata['introducer'] ) {
                        //充值返利到推荐人
                        $this->userrebate($userdata['introducer'],$tabledata[0]['menoy']);
                    }
                }
            }
            elseif(front::$get['tablename'] == 'buytemplateorders'){
                $xfconsumptiondata['oid'] = $out_trade_no;
                $xfconsumptiondata['menoy'] = $tabledata[0]['menoy'];
                $xfconsumptiondata['xftype'] =3;  //插件模板消费
                $xfconsumptiondata['content'] = lang("buy_template")."：".$tabledata[0]['appsid'];

                //已购买表增加
                $appsauthoritydata = explode("#",trim($tabledata[0]['ip']));
                foreach ($appsauthoritydata as $val){
                    $addappsauthoritydata=array();
                    $source = explode(",",trim($val));
                    $addappsauthoritydata['buyid']=$source[0];
                    $addappsauthoritydata['buyip']=$source[1];
                    $addappsauthoritydata['username']=$tabledata[0]['username'];
                    $addappsauthoritydata['buytype']=1;
                    $addappsauthoritydata['adddate']=date('Y-m-d h:i:s', time());
                    appsauthority::getInstance()->rec_insert($addappsauthoritydata);

                    //判断分红 开始
                    $buytemplate = buytemplate::getInstance()->getrow(" code='".$source[0]."'");
                    if ($buytemplate['makereduser']!="" && $buytemplate['makeredbili']>0){
                        $makereduser=user::getInstance()->getrow("userid='".$buytemplate['makereduser']."'", 1);
                        if (is_array($makereduser)){
                            $discount=usergroup::getusergrop($code[1]); //获取用户组的折扣
                            $oldprice=(float)(floatval($buytemplate['price'])*$discount/10);  //分红前销售额
                            $makeredbili=(float)($oldprice)*(float)($buytemplate['makeredbili']);//分红
                            $newmenoy=(float)($makereduser['menoy'])+(float)($makeredbili);
                            user::getInstance()->rec_update(array("menoy"=>$newmenoy),"userid='".$buytemplate['makereduser']."'");//修改用户余额
                            $salesdividend=array();
                            $salesdividend['code']=$buytemplate['code'];
                            $salesdividend['userid']=$code[1];
                            $salesdividend['buydata']=front::$post['adddate'];
                            $salesdividend['menoy']=$oldprice;
                            $salesdividend['makerprice']=$makeredbili;
                            salesdividend::getInstance()->rec_insert($salesdividend);  //插入到分红销售记录表
                        }
                    }
                    //判断分红 结束

                }
            }
            elseif(front::$get['tablename'] == 'buymodulesorders'){
                $xfconsumptiondata['oid'] = $out_trade_no;
                $xfconsumptiondata['menoy'] = $tabledata[0]['menoy'];
                $xfconsumptiondata['xftype'] =4;  //组件消费
                $xfconsumptiondata['content'] = lang('buy_modules').'：'.$tabledata[0]['appsid'];

                //已购买表增加
                $appsauthoritydata = explode("#",trim($tabledata[0]['ip']));
                foreach ($appsauthoritydata as $val){
                    $addappsauthoritydata=array();
                    $source = explode(",",trim($val));
                    $addappsauthoritydata['buyid']=$source[0];
                    $addappsauthoritydata['buyip']=$source[1];
                    $addappsauthoritydata['username']=$tabledata[0]['username'];
                    $addappsauthoritydata['buytype']=3;
                    $addappsauthoritydata['adddate']=date('Y-m-d h:i:s', time());
                    appsauthority::getInstance()->rec_insert($addappsauthoritydata);

                    //判断分红 开始
                    $buytemplate = buymodules::getInstance()->getrow(" code='".$source[0]."'");
                    if ($buytemplate['makereduser']!="" && $buytemplate['makeredbili']>0){
                        $makereduser=user::getInstance()->getrow("userid='".$buytemplate['makereduser']."'", 1);
                        if (is_array($makereduser)){
                            $discount=usergroup::getusergrop($code[1]); //获取用户组的折扣
                            $oldprice=(float)(floatval($buytemplate['price'])*$discount/10);  //分红前销售额
                            $makeredbili=(float)($oldprice)*(float)($buytemplate['makeredbili']);//分红
                            $newmenoy=(float)($makereduser['menoy'])+(float)($makeredbili);
                            user::getInstance()->rec_update(array("menoy"=>$newmenoy),"userid='".$buytemplate['makereduser']."'");//修改用户余额
                            $salesdividend=array();
                            $salesdividend['code']=$buytemplate['code'];
                            $salesdividend['userid']=$code[1];
                            $salesdividend['buydata']=front::$post['adddate'];
                            $salesdividend['menoy']=$oldprice;
                            $salesdividend['makerprice']=$makeredbili;
                            salesdividend::getInstance()->rec_insert($salesdividend);  //插入到分红销售记录表
                        }
                    }
                    //判断分红 结束

                }
            }
            else{
                //代理商品做对接
                if ($tabledata[0]['type']==2){
                    $proxy['oid']=$out_trade_no;
                    $proxy['service_aid']=str_replace("#",",,,",$tabledata[0]['service_aid']);;
                    $proxy['address']=$tabledata[0]['address'];
                    service::getInstance()->proxyarchive($proxy);
                }
                //商品购买的订单
                $xfconsumptiondata['oid'] = $out_trade_no;
                $xfconsumptiondata['menoy'] = $tabledata[0]['menoy'];
                $xfconsumptiondata['xftype'] =1;  //商品消费
                $xfconsumptiondata['content'] = lang('purchase_and_consumption_of_goods');
                //获取到购买的商品  进行计算销售量
                $ordersAid = explode("-",trim($tabledata[0]['aid']));

                for($index=0;$index<count($ordersAid);$index++){
                    $source = explode("#",trim($ordersAid[$index]));
                    $_aidArrys = explode(",", trim($source[0]));
                    $datavuel = archive::getInstance()->getrows('aid = '.$_aidArrys[0],1);
                    $newsalesnum=$datavuel[0]['salesnum']+1;   //销售加1
                    //修改销售量
                    archive::getInstance()->rec_update(array('salesnum'=>$newsalesnum), $_aidArrys[0]);

                }

            }

            //充值不增加消费订单
            if(front::$get['tablename'] != 'consumption') {
                //新增消费订单
                $xfconsumption->rec_insert($xfconsumptiondata);
            }

            //修改订单状态
          /*  if(front::$get['tablename'] == 'buytemplateorders'){
                $table->rec_update(array('static' => '1'), 'oid=\''.$out_trade_no.'\'');
            }else{*/
            $table->rec_update(array('status' => '1'), 'oid=\''.$out_trade_no.'\'');
           /* }*/
        }

        if (front::$get['code'] == 'scanunionpay'){  //银联返回success
            exit('success');
        }

        if (front::get('aid')){
            echo '<script type="text/javascript">alert("' . lang('调回购买页面！') . '")</script>';
            front::refresh(url('archive/show/aid/' . front::get('aid'), false));
        }else{
            echo '<script type="text/javascript">alert("' . lang('go_order') . '")</script>';
            front::refresh(url($url . $out_trade_no, true));
        }

        exit;
    }

    //充值返利到推荐人
    function  userrebate($uid=0,$menoy=0){
        if ($uid && $menoy){
            $user=new user();
            $userdata = $user->getrows("userid='".$uid."'", 1);
            $moeny=$userdata[0]['menoy'];
            //获取返利比
            $rebate=union::getconfig('rebate');
            $moeny=(float)($moeny)+(float)((round($menoy/100,2))*$rebate);
            $moenyarray = array('menoy' => $moeny);
            $user->rec_update($moenyarray, "userid='".$uid."'");
        }
    }

    function chkorders_action()
    {
        $oid = front::get('oid');
        $row = orders::getInstance()->getrow(array('oid'=>$oid));
        echo $row['status'];
        exit;
    }


    //计算价格
    static function  getattr2($customize_attr2){
        $customize_attr2=$customize_attr2==""?0:$customize_attr2;
        $newcname='attr2_'.lang::getistemplate();
        $attr2=json_decode($customize_attr2,true);
        $attr2=is_array($attr2)?$attr2:array();
        //取出中文价格
        $attr2_cn_price=(is_array($attr2) && isset($attr2['attr2_cn']))?$attr2['attr2_cn']:0;
        //当前价格不存在则使用中文价格
        $attr2[$newcname]=(is_array($attr2) && isset($attr2[$newcname]))?$attr2[$newcname]:$attr2_cn_price;
        //若是没有设置多语言 默认使用原来价格  否则使用多语言价格
        $customize_attr2=is_numeric($customize_attr2)?$customize_attr2:$attr2[$newcname];

        return $customize_attr2;
    }

    function payorders_action()
    {
        //var_dump($_SERVER['QUERY_STRING']);
        if (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[3][0];
            if($this->view->paytype=='none'){
                echo '<script type="text/javascript">alert("'.lang('no_payment_contact_administrator').'");window.opener=null;window.close();</script>';
                exit;
            }
            $this->view->user_id = $oidout[2][0];
            $where = array();
            $where['oid'] = front::get('oid');
            //手续费为0
            $this->view->freetotal=0;
            $this->view->orders = orders::getInstance()->getrow($where);
            if ($this->view->orders['type']==2){
                $this->_archive_tale=servicearchive::getInstance();
                $this->_cecategory_tale=servicecategory::getInstance();
            }else{
                $this->_archive_tale=archive::getInstance();
                $this->_cecategory_tale=category::getInstance();
            }
            //获取AID   后面永远都带逗号    所以 $pos !== false永远不会进入else
            $newaid=$this->view->orders['aid'];
            $source = explode("-",trim( $this->view->orders['aid']));
            $this->view->orders['aid']='';
            for($index=0;$index<count($source);$index++){
                $sourceindex = explode("#",trim($source[$index]));
                $_aidArrys = explode(",", trim($sourceindex[0]));
                $this->view->orders['aid']=$this->view->orders['aid'].$_aidArrys[0].',';
            }

            $string = $this->view->orders['aid'];
            $find = ',';
            $pos = strpos($string, $find);
            $this->view->statusnum = $data['status'] = $this->view->orders['status'];
            switch ($data['status']) {
                case 1:
                    $this->view->orders['status'] = lang('complete');
                    break;
                case 2:
                    $this->view->orders['status'] = lang('processing');
                    break;
                case 3:
                    $this->view->orders['status'] = lang('shipped');
                    break;
                case 4:
                    $this->view->orders['status'] = lang('pending_audit_payment');
                    break;
                case 5:
                    $this->view->orders['status'] = lang('check_payment');
                    break;
                default:
                    $this->view->orders['status'] = lang('ordersnotalreadydo');
                    break;
            }
            //var_dump($this->view);
            if (!$this->view->user['userid'] && !config::get("memberbuy")) {
                echo '<script type="text/javascript">alert("' . lang('not_logged_save_the_order_number') .front::get('oid'). '")</script>';
            }
            $logisticsid = $oidout[1][0];
            if ($pos !== false) {
                $_aid = $string;
                $_aid = substr($_aid, 0, -1);
                //获取产品
                $orderssomedata=array();
                $ordersAid = explode("-",trim($newaid));
                $discount=usergroup::getusergrop(user::getuserid($oidout[2][0])); //获取用户组的折扣
                $isint =usergroup::getisint(user::getuserid($oidout[2][0]));      //获取是否取整
                for($index=0;$index<count($ordersAid);$index++){

                    $source = explode("#",trim($ordersAid[$index]));
                    $_aidArrys = explode(",", trim($source[0]));
                    $datavuel = $this->_archive_tale->getrows('aid in ('.$_aidArrys[0].')',100);

                    if ($this->view->orders['type']==2) {
                        $datavuel[0]['attr2'] =self::getattr2($datavuel[0]['customize_attr2']);
                    }else{
                        $newcname = 'attr2_' . lang::getistemplate();
                        $attr2 = json_decode($datavuel[0]['attr2'], true);
                        $datavuel[0]['attr2'] = is_array($attr2) ? $attr2[$newcname] : $datavuel[0]['attr2'];
                    }

                    $datavuel[0]['attr2']=(floatval($datavuel[0]['attr2'])*$discount/10);   //单价打折
                    if($isint){                                  //判断取整
                        $datavuel[0]['attr2']=round($datavuel[0]['attr2']);
                    }
                    if(count($source)>0){
                        $datavuel[0]['leixing']=$source[1];
                    }else{
                        $datavuel[0]['leixing']='';
                    }
                    $datavuel[0]['num']=$_aidArrys[1];
                    $orderssomedata[count($orderssomedata)]=$datavuel[0];
                }
                $this->view->archivearr1 = $this->view->_archivearr = $this->view->orderssomedata =$orderssomedata;

                $order_title="";
                $this->view->total=0;
                //重算单价和数量
                foreach ($this->view->archivearr1 as $key => $val) {
                    if($val['leixing']!=''){
                        //重算单价
                        $newsource = explode(";",trim($val['leixing']));
                        for($index=0;$index<count($newsource);$index++){
                            $sourceArry = explode(":",trim($newsource[$index]));
                            $sourceArry = explode(",",trim($sourceArry[1]));
                            if($sourceArry[1]=="jia"){
                                $val['attr2']=floatval($val['attr2'])+floatval($sourceArry[2]);
                            }else if($sourceArry[1]=="jian"){
                                $val['attr2']=floatval($val['attr2'])-floatval($sourceArry[2]);
                            }else if($sourceArry[1]=="chen"){
                                $val['attr2']=floatval($val['attr2'])*floatval($sourceArry[2]);
                            }else if($sourceArry[1]=="chu"){
                                $val['attr2']=floatval($val['attr2'])/floatval($sourceArry[2]);
                            }
                        }
                    }
                    $pnums=$val['num'];

                    $this->view->archivearr1[$key]['attr2'] = $val['attr2'];
                    $this->view->orders[$key]['pnums'] = $pnums;
                    $order_title.= $val['title'];
                    $where = array();
                    $payfilename = $where['pay_code'] = $this->view->paytype;
                    $where['langid']=lang::getlangid(lang::getistemplate());
                    $this->view->pay = pay::getInstance()->getrows($where);
                    $where = array();
                    $where['id'] = $logisticsid;
                    $this->view->logistics = logistics::getInstance()->getrows($where);
                    if (isset($this->view->logistics[0]['cashondelivery']) && $this->view->logistics[0]['cashondelivery']) {
                        $this->view->logistics[0]['price'] = 0.00;
                    } else {
                        if (isset($this->view->logistics[0]['insure']) && $this->view->logistics[0]['insure']) {
                            $this->view->logistics[0]['price'] = $this->view->logistics[0]['price'] + ($val['attr2'] * $this->view->orders[$key]['pnums']) * ($this->view->logistics[0]['insureproportion'] / 100);
                        }
                    }
                    if (!isset($this->view->logistics[0]['price']))
                        $this->view->logistics[0]['price'] = 0;
                    $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
                    //重算总价
                    $this->view->archivearr1[$key]['total'] = $val['attr2'] * $pnums  + ($val['attr2'] * $pnums * $this->view->pay[0]['pay_fee']);
                    $this->view->total += $val['attr2'] * $pnums  + ($val['attr2'] * $pnums * $this->view->pay[0]['pay_fee']);

                    //计算手续费
                    $this->view->freetotal+=$val['attr2'] * $pnums * $this->view->pay[0]['pay_fee'];

                    if ($this->view->orders['type']==2) {
                        $this->view->archivearr1[$key]['url'] = servicearchive::url($val);
                    }else{
                        $this->view->archivearr1[$key]['url'] = archive::url($val);
                    }
                }
                $this->view->total += $this->view->logistics[0]['price']-$this->view->orders['admindiscounts'];
                $this->view->total= $this->view->total>0?$this->view->total:0;

                //优惠劵使用
                $couponmenoy=array();
                $this->view->fktotal=$this->view->total;
                if(isset($this->view->orders['somecoupon']) && $this->view->orders['somecoupon'] != '' ){
                    if(strpos(trim($this->view->orders['somecoupon']),',') !== false) {
                        $source = explode(",", trim($this->view->orders['somecoupon']));
                        for ($index = 0; $index < count($source); $index++) {
                            $coupondata=coupon::getcouponid( $source[$index]);; //优惠劵信息获取
                            $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                            $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']); //保存优惠金额
                        }
                    }
                    else{
                        $coupondata=coupon::getcouponid(  $this->view->orders['somecoupon']);; //优惠劵信息获取
                        $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                        $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']);  //保存优惠金额
                    }
                }
                $this->view->archivearr1['couponmenoy']=$couponmenoy;

                $order['ordersn'] = front::get('oid');
                $order['title'] =$order_title;
                $order['id'] = $this->view->orders['id'];
                $order['orderamount'] = $this->view->fktotal;
                $order['talename'] ='orders';
                $this->view->tablename=$order['talename'];
                include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
                $payclassname = $payfilename;
                $payobj = new $payclassname();
                $this->view->pay[0]['pay_config'];
                $this->view->gotopaygateway = $payobj->get_code($order, unserialize_config($this->view->pay[0]['pay_config']));
                if ($this->view->orders['type']==2){
                    //判断是否商户账号 并且管理员后台账号是否存在  and 价格是否可以支付
                    $this->view->returndata=service::getInstance()->getlogin();
                    if (isset($this->view->returndata) && is_array($this->view->returndata)
                        && $this->view->returndata['userdata']['ismerchant'] && $this->view->total>$this->view->returndata['userdata']['menoy']){
                        $this->view->gotopaygateway="购买的商品库存不足，请联系管理员及时补货！";
                    }
                }
                //var_dump($this->view->gotopaygateway);exit;
            }
            else {
                /*  $this->view->archive = archive::getInstance()->getrow($this->view->orders['aid']);
                  $prices = getPrices($this->view->archive['attr2']);
                  $this->view->archive['attr2'] = $prices['price'];
                  $where = array();
                  $payfilename = $where['pay_code'] = $this->view->paytype;
                  $this->view->pay = pay::getInstance()->getrows($where);
                  $where = array();
                  $where['id'] = $logisticsid;
                  $this->view->logistics = logistics::getInstance()->getrows($where);
                  if ($this->view->logistics[0]['cashondelivery']) {
                      $this->view->logistics[0]['price'] = 0.00;
                  } else {
                      if ($this->view->logistics[0]['insure']) {
                          $this->view->logistics[0]['price'] = $this->view->logistics[0]['price'] + ($this->view->archive['attr2'] * $this->view->orders['pnums']) * ($this->view->logistics[0]['insureproportion'] / 100);
                      }
                  }
                  if (!isset($this->view->logistics[0]['price']))
                      $this->view->logistics[0]['price'] = 0;
                  $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
                  $this->view->total = $this->view->archive['attr2'] * $this->view->orders['pnums'] + $this->view->logistics[0]['price'] + ($this->view->archive['attr2'] * $this->view->orders['pnums'] * $this->view->pay[0]['pay_fee']);
                  $order['ordersn'] = front::get('oid');
                  $order['title'] =$order_title;
                  $order['id'] = $this->view->orders['id'];
                  $order['orderamount'] = $this->view->total;
                  $order['talename'] ='orders';
                  include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
                  $payclassname = $payfilename;
                  $payobj = new $payclassname();

                  $this->view->gotopaygateway = $payobj->get_code($order, unserialize_config($this->view->pay[0]['pay_config']));*/
            }
        }
        $this->render('pay/payorders.html');
        exit;
    }

    function confirmationorders_action(){
        $oid = front::get('oid');
        $update = orders::getInstance()->rec_update(array('status'=>'3'),array('oid'=>$oid));
        if ($update > 0) {
            front::flash(lang('order').$oid.lang('confirmation_of_receipt').lang('success'));
        }
        front::redirect(url('manage/orderslist/manage/orders/type/all'));
    }

    function doorders_action()
    {
        $aid = intval(front::get('aid'));
        if (archive::getInstance()->getrow($aid)) {
            $oreders_c = cookie::get('ce_orders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));

            //var_dump($orders_c);
            if (empty($oreders_c)) {
                $c_aid = '0' . front::get('aid');
                $orders_c = array($c_aid => array('aid' => $aid, 'amount' => (int)($_GET['thisnum']),'datatype' => $_GET['datatype']));
                $orders_c = serialize($orders_c);
                //var_dump($orders_c);
            } else {
                $orderid =unserialize($oreders_c);
                if (count($orderid) >= 12) {
                    echo 'limit';
                    exit;
                }
                $newc_aid="";
                $newctype=false;

                for($i=0;$i<count($orderid);$i++){
                    if($i == 0){
                        $c_aid= '0' . front::get('aid');
                    }else{
                        $c_aid=(string)($i).front::get('aid');
                    }
                    if (is_array($orderid) && array_key_exists($c_aid, $orderid) && trim($orderid[$c_aid]['datatype'])==trim($_GET['datatype'])) {
                        $newctype=true;
                        $newc_aid=$c_aid;
                    }

                }

                if ($newctype) {
                    $amount = $orderid[$newc_aid]['amount'] + (int)($_GET['thisnum']);
                    unset($orderid[$newc_aid]);
                    $orderid[$newc_aid] = array('aid' => $aid, 'amount' => (int)($amount),'datatype' => $_GET['datatype']);
                    $orders_c = serialize($orderid);

                } else{
                    $newc_aid=count($orderid).front::get('aid');
                    $orderid[$newc_aid]=array('aid' => $aid, 'amount' => (int)($_GET['thisnum']),'datatype' =>$_GET['datatype']);
                    $orders_c = serialize($orderid);
                }
            }
            //echo '<script type="text/javascript">alert('.$orders_c.');</script>>';
            //echo $orders_c."<br/>";
            $orders_c = xxtea_encrypt($orders_c, config::getadmin('cookie_password'));
            //var_dump(config::getadmin('cookie_password'));
            $orders_c = base64_encode($orders_c);
            //var_dump($orders_c);
            cookie::set('ce_orders_cookie', $orders_c);
            if(isset($_GET['buy'])){
                if($_GET['buy']){
                    echo '<script type="text/javascript">';
                    echo 'window.location.href="' . url('archive/orders',true) . '";';
                    echo '</script>';
                    exit;
                }
            }
            echo  lang('add_to_cart');
            exit;
            //echo '<script type="text/javascript">alert("' . lang('完成操作，你可以继续购物，或者在购物车中结算！') . '");window.location.href="'.url('archive/show/aid/' . front::get('aid'), true).'";</script>';
        }
    }

    //退款申请
    function refund_action(){
        if(front::$post['refund_oid']!=""){
            $orders=orders::getInstance();
            $orders->rec_update(array("refund_user"=>front::$post['refund_user'],"status"=>"6","refund_type"=>front::$post['refund_type'],"refund_connent"=>front::$post['refund_connent']),array("oid"=>front::$post['refund_oid']));
            echo json_encode(array("static"=>1,"retdata"=>lang('successful_application')));
            exit;
        }
        echo  json_encode(array("static"=>0,"retdata"=>lang('application_failure')));
        exit;


    }

    //清空购物车
    function emptyorders_action(){
        if (front::get('delete')){
            $oreders_c = cookie::get('ce_orders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
            $aid = !empty($oreders_c) ? unserialize($oreders_c) : 0;
            if ($aid) {
                if($aid[front::get('key')]['aid']==front::get('aid')){

                    unset($aid[front::get('key')]);
                }
                $orders_c = serialize($aid);
                $orders_c = xxtea_encrypt($orders_c, config::getadmin('cookie_password'));
                $orders_c = base64_encode($orders_c);
                cookie::set('ce_orders_cookie', $orders_c);
                exit;
            }
        }else{
            cookie::set('ce_orders_cookie', '');
            echo "<script>history.go(-1);</script>";
        }
        exit;
    }

    function orders_action()
    {
        $this->view->aid = intval(trim(front::get('aid')));
        $this->view->isproxy = front::get('isproxy');

        if (config::getadmin('memberbuy') && !front::$user['userid']) {
            alertinfo(lang('not_logged'), url('user/login'));
            return;
        }

        //var_dump($this->view->user);
        if (front::post('submit')) {

            //var_dump($this->view->user);exit;
            $this->orders = new orders();
            $row = $this->orders->getrow("oid='%-".$this->view->user['userid']."-%'", "adddate DESC");
            //var_dump(time());
            //下单间隔
            if (isset($row['adddate']) && time() - $row['adddate'] <= intval(config::getadmin('order_time'))) {
                alerterror(lang('frequent_operation_please_wait'));
                return;
            }
            //联系电话必填
            if (front::$post['telphone'] == '') {
                alerterror(lang('telephone_is_required'));
                return;
            }
            //手机验证码
            if (config::getadmin('mobilechk_enable') && config::getadmin('mobilechk_buy')) {
                $mobilenum = front::$post['mobilenum'];
                $smsCode = new SmsCode();
                if (!$smsCode->chkcode($mobilenum)) {
                    alerterror(lang('cell_phone_parity_error'));
                    return false;
                }
            }

            front::$post['mid'] = $this->view->user['userid'] ? $this->view->user['userid'] : 0;

            front::$post['adddate'] = time();
            front::$post['ip'] = front::ip();

            if (front::$post['isproxy']){
                front::$post['type'] = 2;
                $this->_archive_tale=servicearchive::getInstance();
                $this->_cecategory_tale=servicecategory::getInstance();
            }else{
                front::$post['type'] = 1;
                $this->_archive_tale=archive::getInstance();
                $this->_cecategory_tale=category::getInstance();
            }

            $moeny=0;   //支付总金额
            $discount=usergroup::getusergrop(user::getuserid()); //获取用户组的折扣
            $isint =usergroup::getisint(user::getuserid());      //获取是否取整
            $finalkey='';  //伟哥需要
            if (isset(front::$post['aid']) && front::$post['aid']!='') {
                $aidarr = front::$post['aid'];
                unset(front::$post['aid']);
                foreach ($aidarr as $val) {
                    $aid=substr($val,1,strlen($val));
                    //重新编辑aid  取出key
                    $source = explode("#",trim($aid));
                    $aid=$source[0].'#';
                    $source = explode(";",trim($source[1]));
                    $newaid='';
                    for($index=0;$index<count($source);$index++){
                        //获取到key
                        $sourcedata = explode(":",trim($source[$index]));
                        $sourcekeyval = explode(",",trim($sourcedata[0]));
                        $sourcename = isset($sourcekeyval[0])?$sourcekeyval[0]:"";  //字段名称
                        $sourcekey  = isset($sourcekeyval[1])?$sourcekeyval[1]:"";  //字段key
                        if($sourcename != ''){
                            if(strpos($finalkey,$sourcename . ':' . $sourcekey) === false) {
                                if ($finalkey == '') {
                                    $finalkey = $sourcename . ':' . $sourcekey;   //伟哥需要
                                } else {
                                    $finalkey = $finalkey . ',' . $sourcename . ':' . $sourcekey;   //伟哥需要
                                }
                            }

                            //恢复aid
                            if($index==0){
                                $newaid.=$sourcename.':'.$sourcedata[1];
                            }else{
                                $newaid.=';'.$sourcename.':'.$sourcedata[1];
                            }
                        }
                    }
                    $aid.=$newaid;
                    front::$post['aid']=isset(front::$post['aid'])?front::$post['aid']:"";
                    if(front::$post['aid']==""){
                        front::$post['aid'].=$aid;
                    }else{
                        front::$post['aid'] .= '-'.$aid;
                    }
                    $source = explode("#",trim($aid));
                    $_aidArrys = explode(",", trim($source[0]));
                    $datavuel = $this->_archive_tale->getrows('aid in ('.$_aidArrys[0].')',100);

                    if($datavuel[0]['inventory'] >0){              //库存减1
                        $inventorynum=$datavuel[0]['inventory']-(int)($_aidArrys[1]);
                    }else{
                        $inventorynum=0;
                    }

                    //修改库存
                    $this->_archive_tale->rec_update(array('inventory'=>$inventorynum), $_aidArrys[0]);

                    //代理商品价格 单独算法
                    if (front::$post['isproxy']) {
                        $datavuel[0]['customize_attr2']=$datavuel[0]['customize_attr2']==""?0:$datavuel[0]['customize_attr2'];
                        $newcname='attr2_'.lang::getistemplate();
                        $attr2=json_decode($datavuel[0]['customize_attr2'],true);
                        $attr2=is_array($attr2)?$attr2:array();
                        //取出中文价格
                        $attr2_cn_price=(is_array($attr2) && isset($attr2['attr2_cn']))?$attr2['attr2_cn']:0;
                        //当前价格不存在则使用中文价格
                        $attr2[$newcname]=(is_array($attr2) && isset($attr2[$newcname]))?$attr2[$newcname]:$attr2_cn_price;
                        //若是没有设置多语言 默认使用原来价格  否则使用多语言价格
                        $datavuel[0]['customize_attr2']=is_numeric($datavuel[0]['customize_attr2'])?$datavuel[0]['customize_attr2']:$attr2[$newcname];
                        $datavuel[0]['attr2'] =$datavuel[0]['customize_attr2'];

                    }else{
                        $newcname = 'attr2_' . lang::getistemplate();
                        $attr2 = json_decode($datavuel[0]['attr2'], true);
                        $datavuel[0]['attr2'] = is_array($attr2) ? $attr2[$newcname] : $datavuel[0]['attr2'];
                    }

                    $datavuel[0]['attr2']=(floatval($datavuel[0]['attr2'])*$discount/10);   //单价打折
                    if($isint){                                  //判断取整
                        $datavuel[0]['attr2']=round($datavuel[0]['attr2']);
                    }
                    $source = explode(";",trim($source[1]));
                    for($index=0;$index<count($source);$index++){
                        $sourceArry = explode(":",trim($source[$index]));
                        $sourceArry[1]=isset($sourceArry[1])?$sourceArry[1]:"";
                        $sourceArry = explode(",",trim($sourceArry[1]));
                        $sourceArry[1]=isset($sourceArry[1])?$sourceArry[1]:"";
                        if($sourceArry[1]=="jia"){
                            $datavuel[0]['attr2']=floatval($datavuel[0]['attr2'])+floatval($sourceArry[2]);
                        }else if($sourceArry[1]=="jian"){
                            $datavuel[0]['attr2']=floatval($datavuel[0]['attr2'])-floatval($sourceArry[2]);
                        }else if($sourceArry[1]=="chen"){
                            $datavuel[0]['attr2']=floatval($datavuel[0]['attr2'])*floatval($sourceArry[2]);
                        }else if($sourceArry[1]=="chu"){
                            $datavuel[0]['attr2']=floatval($datavuel[0]['attr2'])/floatval($sourceArry[2]);
                        }
                    }
                    $moeny=$moeny+(floatval($datavuel[0]['attr2'])*floatval($_aidArrys[1]));
                    front::$post['thisnum'][$val]=isset(front::$post['thisnum'][$val])?front::$post['thisnum'][$val]:"";
                    front::$post['pnums']=isset(front::$post['pnums'])?front::$post['pnums']:"";
                    front::$post['pnums'] .= abs(intval(front::$post['thisnum'][$val])) . ',';
                }

                //重算代理商品
                if (front::$post['isproxy']){
                    $service_aidarr = front::$post['service_aid'];
                    unset(front::$post['service_aid']);
                    foreach ($service_aidarr as $val) {
                        $aid=$val;
                        //重新编辑aid  取出key
                        $source = explode("#",trim($aid));
                        $aid=$source[0].'#';
                        $source = explode(";",trim($source[1]));
                        $newaid='';
                        for($index=0;$index<count($source);$index++){
                            //获取到key
                            $sourcedata = explode(":",trim($source[$index]));
                            $sourcekeyval = explode(",",trim($sourcedata[0]));
                            $sourcename = isset($sourcekeyval[0])?$sourcekeyval[0]:"";  //字段名称
                            $sourcekey  = isset($sourcekeyval[1])?$sourcekeyval[1]:"";  //字段key
                            if($sourcename != ''){
                                if(strpos($finalkey,$sourcename . ':' . $sourcekey) === false) {
                                    if ($finalkey == '') {
                                        $finalkey = $sourcename . ':' . $sourcekey;   //伟哥需要
                                    } else {
                                        $finalkey = $finalkey . ',' . $sourcename . ':' . $sourcekey;   //伟哥需要
                                    }
                                }
                                //恢复aid
                                if($index==0){
                                    $newaid.=$sourcename.':'.$sourcedata[1];
                                }else{
                                    $newaid.=';'.$sourcename.':'.$sourcedata[1];
                                }
                            }
                        }
                        $aid.=$newaid;
                        front::$post['service_aid']=isset(front::$post['service_aid'])?front::$post['service_aid']:"";
                        if(front::$post['service_aid']==""){
                            front::$post['service_aid'].=$aid;
                        }else{
                            front::$post['service_aid'] .= '-'.$aid;
                        }

                    }
                }
            } else {
                front::$post['aid'] = $this->view->aid;
            }
            if (!isset(front::$post['logisticsid']))
                front::$post['logisticsid'] = 0;
            $payname = front::$post['payname'] ? front::$post['payname'] : 'none';
            front::$post['oid'] = date('YmdHis') . '-' . front::$post['logisticsid'] . '-' . front::$post['mid'] . '-' . $payname;
            unset(front::$post['status']);
            front::$post['status'] = 0;
            front::$post['courier_number'] = '';
            front::$post['s_status'] = 0;
            front::$post['trade_no'] = '';
            //获取运费
            $where = array();
            $where['id'] = front::$post['logisticsid'];
            $this->view->logistics = logistics::getInstance()->getrows($where);
            $this->view->logistics[0]['price']=isset($this->view->logistics[0]['price'])?$this->view->logistics[0]['price']:0;
            front::$post['menoy'] = $moeny+$this->view->logistics[0]['price'];
            front::$post['finalkey']=$finalkey;
            $insert = $this->orders->rec_insert(front::$post);
            if ($insert < 1) {
                front::flash($this->tname . lang('add_failure'));
            }
            else {
                if (front::$post['isproxy']) {
                    cookie::set('ce_service_orders_cookie', '');
                }else{
                    cookie::set('ce_orders_cookie', '');
                }
                //优惠劵使用
                if(isset(front::$post['somecoupon']) && front::$post['somecoupon'] != '' ){
                    if(strpos(trim(front::$post['somecoupon']),',') !== false) {
                        $source = explode(",", trim(front::$post['somecoupon']));
                        for ($index = 0; $index < count($source); $index++) {
                            user::setcouponidnum($source[$index], 1, '-');   //优惠劵变更
                            $coupondata=coupon::getcouponid( $source[$index]);; //优惠劵信息获取
                            $moeny=(float)($moeny)-(float)($coupondata['moeny']);
                        }
                    }
                    else{
                        user::setcouponidnum(front::$post['somecoupon'], 1, '-');   //优惠劵变更
                        $coupondata=coupon::getcouponid(front::$post['somecoupon']);; //优惠劵信息获取
                        $moeny=(float)($moeny)-(float)($coupondata['moeny']);
                    }
                }

                if (config::getadmin('sms_on') && config::getadmin('sms_order_on')) {
                    $smsCode = new SmsCode();
                    $content = $smsCode->getTemplate('order', array($this->view->user['usernam'], front::$post['oid']));
                    sendMsg(front::$post['telphone'], $content);
                }
                if (config::getadmin('sms_on') && config::getadmin('sms_order_admin_on') && $mobile = config::getadmin('site_mobile')) {
                    sendMsg($mobile, lang('web_ site') . date('Y-m-d H:i:s') . lang('ordersnotalreadydo'));
                    //echo 11;
                }

                //$user = $this->view->user;
                if (config::getadmin('email_order_send_cust') && front::$post['postcode']) {
                    $title = lang('you_in') . config::getadmin('sitename') . lang('the_order') . front::get('oid') . lang('has_been_submitted');
                    $this->sendmail(front::$post['postcode'], $title, $title);
                }
                if (config::getadmin('email_order_send_admin') && config::getadmin('email')) {
                    $title = lang('web_ site') . date('Y-m-d H:i:s') . lang('ordersnotalreadydo');
                    $this->sendmail(config::getadmin('email'), $title, $title);
                }

                //使用余额支付的时候 直接付款  状态改已支付
                if($payname=="yuer") {
                    //代理商品做对接
                    if (front::$post['isproxy']){
                        front::$post['service_aid']=str_replace("#",",,,",front::$post['service_aid']);
                        service::getInstance()->proxyarchive(front::$post);
                    }
                    //支付了分发产品码
                    if (file_exists(ROOT . "/lib/table/productcode.php")){
                        productcode::product(front::$post['oid']);
                    }
                    user::setintegration($moeny);   //积分增加
                    $sheyumenoy=user::getmenoy()-$moeny;  //剩余余额
                    user::getInstance()->rec_update(array('menoy' => $sheyumenoy), "username='".session::get('username')."'");
                    //修改订单状态
                    $this->orders->rec_update(array('status' => '1'), "oid='".front::$post['oid']."'");
                    //新增消费记录
                    $xfconsumption = new xfconsumption();
                    $xfconsumptiondata = array();
                    $xfconsumptiondata['status'] = '1';
                    $xfconsumptiondata['oid'] = front::$post['oid'];
                    $xfconsumptiondata['menoy'] = $moeny;
                    $xfconsumptiondata['content'] = lang('purchase_and_consumption_of_goods');
                    $xfconsumptiondata['adddate'] = date('Y-m-d h:i:s', time());
                    $xfconsumptiondata['xftype'] =1;  //商品消费
                    $xfconsumptiondata['mid'] = $this->view->user['userid'] ? $this->view->user['userid'] : 0;
                    $xfconsumptiondata['trade_no'] = '';
                    $xfconsumption->rec_insert($xfconsumptiondata);
                    //获取到购买的商品  进行计算销售量
                    $ordersAid = explode("-",trim(front::$post['aid']));
                    for($index=0;$index<count($ordersAid);$index++){
                        $source = explode("#",trim($ordersAid[$index]));
                        $_aidArrys = explode(",", trim($source[0]));
                        $datavuel = $this->_archive_tale->getrows(
                            'aid = '.$_aidArrys[0],1);
                        $newsalesnum=$datavuel[0]['salesnum']+1;   //销售加1
                        //修改销售量
                        $this->_archive_tale->rec_update(array('salesnum'=>$newsalesnum), $_aidArrys[0]);

                    }

                    echo '<script type="text/javascript">alert("' . lang('pay_success') . '");window.location.href="' . url('archive/orders/oid/' . front::$post['oid']) . '";</script>';
                    exit;
                }
                if (front::$post['payname'] && front::$post['payname'] != 'nopay') {

                    echo '<script type="text/javascript">alert("' . lang('orderssuccess') . ' ' . lang('now_turn_to_pay_page') . '");window.location.href="' . url('archive/payorders/oid/' . front::$post['oid'], true) . '";</script>';
                    exit;
                }
                echo '<script type="text/javascript">alert("' . lang('orderssuccess') . '");window.location.href="' . url('archive/orders/oid/' . front::$post['oid'], true) . '";</script>';
                exit;
            }
        }
        elseif
        (front::get('oid')) {

            if(strlen(front::get('oid'))==14){
                $orders_oid=orders::getInstance()->getrow("oid like '%".front::get('oid')."%' ");
                front::$get['oid']=$orders_oid['oid'];
            }
            preg_match_all("/-(.*)-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[3][0];
            //非会员不可查看   排除匿名
            if ($oidout[2][0] != $this->view->user['userid'] && config::getadmin('memberbuy')) {
                alertinfo(lang('view_order_failure'), url::create('index/index'));
            }

            $where = array();
            $where['oid'] = front::get('oid');
            //手续费为0
            $this->view->freetotal=0;
            $this->view->orders = orders::getInstance()->getrow($where);
            $this->view->orders['status2'] = $this->view->orders['status'];
            $this->view->statusnum = $data['status'] = $this->view->orders['status'];
            $unpay = false;
            switch ($data['status']) {
                case 1:
                    $data['status'] = lang('complete');
                    break;
                case 2:
                    $data['status'] = lang('processing');
                    break;
                case 3:
                    $data['status'] = lang('shipped');
                    break;
                case 4:
                    $data['status'] = lang('pending_audit_payment');
                    break;
                case 5:
                    $data['status'] = lang('check_payment');
                    break;
                default:
                    $data['status'] = lang('ordersnotalreadydo');
                    $unpay = true;
                    break;
            }
            $this->view->orders['status'] = $data['status'];
            /*if ($this->view->paytype) {
                $this->view->gotopaygateway = '<a href="' . url('archive/payorders/oid/' . front::get('oid'), true) . '">进入支付页面</a>';
            }*/

            //获取支付链接
            if ($unpay && $this->view->paytype && $this->view->paytype != 'nopay' && $this->view->paytype != 'none' && $this->view->paytype != 'yuer') {

                if ($this->view->orders['type'] == 2) {
                    $this->_archive_tale = servicearchive::getInstance();
                    $this->_cecategory_tale = servicecategory::getInstance();
                } else {
                    $this->_archive_tale = archive::getInstance();
                    $this->_cecategory_tale = category::getInstance();
                }

                //获取AID   后面永远都带逗号    所以 $pos !== false永远不会进入else
                $newaid=$this->view->orders['aid'];

                $logisticsid = $oidout[1][0];
                    //获取产品
                    $orderssomedata=array();
                    $ordersAid = explode("-",trim($newaid));
                    $discount=usergroup::getusergrop(user::getuserid($oidout[2][0])); //获取用户组的折扣
                    $isint =usergroup::getisint(user::getuserid($oidout[2][0]));      //获取是否取整
                    for($index=0;$index<count($ordersAid);$index++){
                        $source = explode("#",trim($ordersAid[$index]));
                        $_aidArrys = explode(",", trim($source[0]));
                        $datavuel = $this->_archive_tale->getrows('aid in ('.$_aidArrys[0].')',100);

                        if ($this->view->orders['type']==2) {
                            $datavuel[0]['attr2'] =self::getattr2($datavuel[0]['customize_attr2']);
                        }else{
                            $newcname = 'attr2_' . lang::getistemplate();
                            $attr2 = json_decode($datavuel[0]['attr2'], true);
                            $datavuel[0]['attr2'] = is_array($attr2) ? $attr2[$newcname] : $datavuel[0]['attr2'];
                        }

                        $datavuel[0]['attr2']=(floatval($datavuel[0]['attr2'])*$discount/10);   //单价打折
                        if($isint){                                  //判断取整
                            $datavuel[0]['attr2']=round($datavuel[0]['attr2']);
                        }
                        if(count($source)>0){
                            $datavuel[0]['leixing']=$source[1];
                        }else{
                            $datavuel[0]['leixing']='';
                        }
                        $datavuel[0]['num']=$_aidArrys[1];
                        $orderssomedata[count($orderssomedata)]=$datavuel[0];
                    }
                    $this->view->archivearr1 = $this->view->_archivearr = $this->view->orderssomedata =$orderssomedata;

                    $order_title="";
                    $this->view->total=0;
                    //重算单价和数量
                    foreach ($this->view->archivearr1 as $key => $val) {

                        if($val['leixing']!=''){
                            //重算单价
                            $newsource = explode(";",trim($val['leixing']));
                            for($index=0;$index<count($newsource);$index++){
                                $sourceArry = explode(":",trim($newsource[$index]));
                                $sourceArry = explode(",",trim($sourceArry[1]));
                                if($sourceArry[1]=="jia"){
                                    $val['attr2']=floatval($val['attr2'])+floatval($sourceArry[2]);
                                }else if($sourceArry[1]=="jian"){
                                    $val['attr2']=floatval($val['attr2'])-floatval($sourceArry[2]);
                                }else if($sourceArry[1]=="chen"){
                                    $val['attr2']=floatval($val['attr2'])*floatval($sourceArry[2]);
                                }else if($sourceArry[1]=="chu"){
                                    $val['attr2']=floatval($val['attr2'])/floatval($sourceArry[2]);
                                }
                            }
                        }
                        $pnums=$val['num'];

                        $this->view->archivearr1[$key]['attr2'] = $val['attr2'];
                        $this->view->orders[$key]['pnums'] = $pnums;
                        $order_title.= $val['title'];
                        $where = array();
                        $payfilename = $where['pay_code'] = $this->view->paytype;
                        $where['langid']=lang::getlangid(lang::getistemplate());
                        $this->view->pay = pay::getInstance()->getrows($where);
                        $where = array();
                        $where['id'] = $logisticsid;
                        $this->view->logistics = logistics::getInstance()->getrows($where);
                        if (isset($this->view->logistics[0]['cashondelivery']) && $this->view->logistics[0]['cashondelivery']) {
                            $this->view->logistics[0]['price'] = 0.00;
                        } else {
                            if (isset($this->view->logistics[0]['insure']) && $this->view->logistics[0]['insure']) {
                                $this->view->logistics[0]['price'] = $this->view->logistics[0]['price'] + ($val['attr2'] * $this->view->orders[$key]['pnums']) * ($this->view->logistics[0]['insureproportion'] / 100);
                            }
                        }
                        if (!isset($this->view->logistics[0]['price']))
                            $this->view->logistics[0]['price'] = 0;
                        $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
                        //重算总价
                        $this->view->archivearr1[$key]['total'] = $val['attr2'] * $pnums  + ($val['attr2'] * $pnums * $this->view->pay[0]['pay_fee']);
                        $this->view->total += $val['attr2'] * $pnums  + ($val['attr2'] * $pnums * $this->view->pay[0]['pay_fee']);

                        //计算手续费
                        $this->view->freetotal+=$val['attr2'] * $pnums * $this->view->pay[0]['pay_fee'];

                        if ($this->view->orders['type']==2) {
                            $this->view->archivearr1[$key]['url'] = servicearchive::url($val);
                        }else{
                            $this->view->archivearr1[$key]['url'] = archive::url($val);
                        }
                    }
                    $this->view->total += $this->view->logistics[0]['price']-$this->view->orders['admindiscounts'];
                    $this->view->total= $this->view->total>0?$this->view->total:0;

                    //优惠劵使用
                    $couponmenoy=array();
                    $this->view->fktotal=$this->view->total;
                    if(isset($this->view->orders['somecoupon']) && $this->view->orders['somecoupon'] != '' ){
                        if(strpos(trim($this->view->orders['somecoupon']),',') !== false) {
                            $source = explode(",", trim($this->view->orders['somecoupon']));
                            for ($index = 0; $index < count($source); $index++) {
                                $coupondata=coupon::getcouponid( $source[$index]);; //优惠劵信息获取
                                $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                                $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']); //保存优惠金额
                            }
                        }
                        else{
                            $coupondata=coupon::getcouponid(  $this->view->orders['somecoupon']);; //优惠劵信息获取
                            $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                            $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']);  //保存优惠金额
                        }
                    }
                    $this->view->archivearr1['couponmenoy']=$couponmenoy;

                    $order['ordersn'] = front::get('oid');
                    $order['title'] =$order_title;
                    $order['id'] = $this->view->orders['id'];
                    $order['orderamount'] = $this->view->fktotal;
                    $order['talename'] ='orders';
                    $this->view->tablename=$order['talename'];
                    include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
                    $payclassname = $payfilename;
                    $payobj = new $payclassname();
                    $this->view->gotopaygateway = $payobj->get_code($order, unserialize_config($this->view->pay[0]['pay_config']));
                    if ($this->view->orders['type']==2){
                        //判断是否商户账号 并且管理员后台账号是否存在  and 价格是否可以支付
                        $this->view->returndata=service::getInstance()->getlogin();
                        if (isset($this->view->returndata) && is_array($this->view->returndata)
                            && $this->view->returndata['userdata']['ismerchant'] && $this->view->total>$this->view->returndata['userdata']['menoy']){
                            $this->view->gotopaygateway="购买的商品库存不足，请联系管理员及时补货！";
                        }
                    }

            }else{
                $this->view->gotopaygateway = "";
            }

            //var_dump($this->view->user);var_dump($_SESSION);exit();

            $this->out('message/orderssuccess.html');
        }
        elseif
        (intval(front::get('aid'))) {
            front::check_type(front::get('aid'));
            $aid = intval(front::get('aid'));
            $this->view->archive = archive::getInstance()->getrow($aid);
            $this->view->categorys = category::getpositionlink2($this->view->archive['catid']);
            $this->view->paylist = pay::getInstance()->getrows('langid='.lang::getlangid(lang::getistemplate()), 50);
            $this->view->logisticslist = logistics::getInstance()->getrows('', 50);

            $newcname='attr2_'.lang::getistemplate();
            $attr2=json_decode($this->view->archive['attr2'],true);
            $this->view->archive['attr2']=is_array($attr2)?$attr2[$newcname]:$this->view->archive['attr2'];

            $prices = getPrices($this->view->archive['attr2']);
            $this->view->archive['attr2'] = $prices['price'];
            if (!is_array($this->view->archive))
                $this->out('message/error.html');
            if ($this->view->archive['checked'] < 1)
                exit(lang('unaudited'));
            if (!rank::arcget($aid, $this->view->usergroupid)) {
                $this->out('message/error.html');
            }
        }
        elseif
        ($this->view->isproxy){
            $oreders_c = cookie::get('ce_service_orders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            //var_dump($oreders_c);
            if (preg_match('/(union|select|update|delete)/i', $oreders_c)) {
                alerterror(lang('illegal_character'));
            }
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
            $aid = !empty($oreders_c) ? unserialize($oreders_c) : 0;
            /* echo print_r($aid);*/
            if ($aid) {
                foreach ($aid as $key => $val) {
                    $archive = servicearchive::getInstance()->getrow(intval($val['aid']));
                    $val['title'] = $archive['title'];

                    $archive['customize_attr2']=$archive['customize_attr2']==""?0:$archive['customize_attr2'];
                    $newcname='attr2_'.lang::getistemplate();
                    $attr2=json_decode($archive['customize_attr2'],true);
                    $attr2=is_array($attr2)?$attr2:array();
                    //取出中文价格
                    $attr2_cn_price=(is_array($attr2) && isset($attr2['attr2_cn']))?$attr2['attr2_cn']:0;
                    //当前价格不存在则使用中文价格
                    $attr2[$newcname]=(is_array($attr2) && isset($attr2[$newcname]))?$attr2[$newcname]:$attr2_cn_price;
                    //若是没有设置多语言 默认使用原来价格  否则使用多语言价格
                    $archive['customize_attr2']=is_numeric($archive['customize_attr2'])?$archive['customize_attr2']:$attr2[$newcname];

                    $prices = getPrices($archive['customize_attr2']);
                    $val['customize_attr2'] = $prices['price'];
                    $val['thumb'] = $archive['thumb'];
                    $val['url'] = isset($archive['url'])?$archive['url']:"";
                    $val['inventory'] = $archive['inventory'];
                    $val['name'] = $key;
                    $val['catid'] = $archive['catid'];
                    $val['service_aid'] = $archive['service_aid'];
                    $aid[$key] = $val;
                }
                $this->view->orderaidlist = $aid;
                $this->view->paylist = pay::getInstance()->getrows(' langid='.lang::getlangid(lang::getistemplate()), 50);
                $this->view->logisticslist = logistics::getInstance()->getrows('', 50);
            }
            else {
                if (isset(front::$get['oid'])) {
                    if ($_SERVER['HTTP_REFERER']) {
                        front::refresh($_SERVER['HTTP_REFERER']);
                    } else {
                        front::refresh(url('index'));
                    }
                    exit;
                }
                $this->view->orderaidlist ="";
            }
        }
        else
        {
            //直接跳到结算
            if(front::get('settlement')){
                $this->view->settlement =front::get('settlement');
            }
            $oreders_c = cookie::get('ce_orders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            //var_dump($oreders_c);
            if (preg_match('/(union|select|update|delete)/i', $oreders_c)) {
                alerterror(lang('illegal_character'));
            }
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
            $aid = !empty($oreders_c) ? unserialize($oreders_c) : 0;
            /* echo print_r($aid);*/
            if ($aid) {
                foreach ($aid as $key => $val) {
                    $archive = archive::getInstance()->getrow(intval($val['aid']));
                    $val['title'] = $archive['title'];

                    $newcname='attr2_'.lang::getistemplate();
                    $attr2=json_decode($archive['attr2'],true);
                    $archive['attr2']=is_array($attr2)?$attr2[$newcname]:$archive['attr2'];

                    $prices = getPrices($archive['attr2']);
                    $val['attr2'] = $prices['price'];
                    $val['thumb'] = $archive['thumb'];
                    $val['url'] = $archive['url'];
                    $val['inventory'] = $archive['inventory'];
                    $val['name'] = $key;
                    $val['catid'] = $archive['catid'];
                    $aid[$key] = $val;
                }
                $this->view->orderaidlist = $aid;
                $this->view->paylist = pay::getInstance()->getrows(' langid='.lang::getlangid(lang::getistemplate()), 50);
                $this->view->logisticslist = logistics::getInstance()->getrows('', 50);
            } else {
                if (isset(front::$get['oid'])) {
                    if ($_SERVER['HTTP_REFERER']) {
                        front::refresh($_SERVER['HTTP_REFERER']);
                    } else {
                        front::refresh(url('index'));
                    }
                    exit;
                }
                $this->view->orderaidlist ="";
                /* echo '<script type="text/javascript">alert("' . lang('the commodity shopping cart') . '");';
                 if ($_SERVER['HTTP_REFERER']) {
                     echo 'window.location.href="' . $_SERVER['HTTP_REFERER'] . '";';
                 } else {
                     echo 'window.location.href="' . url('index') . '";';
                 }
                 echo '</script>';*/
            }
        }
        $this->render('pay/orders.html');
        exit;
    }

    //在线模板购物车
    function buytemplateorders_action()
    {
        if (front::post('submit')) {
            // front::$post Array ( [aid] => Array ( [0] => f162,127.0.0.8 [1] => f164,127.0.0.9 ) [apps_ip] => 127.0.0.9 [somecoupon] => [telphone] => 15111505506 [remarks] => [payname] => yuer [submit] => 购买 )
            $this->appsorders = new appsorders();
            $row = $this->appsorders->getrow("oid='%-".$this->view->user['userid']."-%'", "adddate DESC");
            //var_dump(time());
            //下单间隔
            if ($row['adddate'] && time() - $row['adddate'] <= intval(config::getadmin('order_time'))) {
                alerterror(lang('frequent_operation_please_wait'));
                return;
            }
            //联系电话必填
            if (front::$post['telphone'] == '') {
                alerterror(lang('telephone_is_required'));
                return;
            }
            //手机验证码
            if (config::getadmin('mobilechk_enable') && config::getadmin('mobilechk_buy')) {
                $mobilenum = front::$post['mobilenum'];
                $smsCode = new SmsCode();
                if (!$smsCode->chkcode($mobilenum)) {
                    alerterror(lang('cell_phone_parity_error'));
                    return false;
                }
            }
            front::$post['mid'] = $this->view->user['userid'];
            front::$post['adddate'] = time();
            front::$post['tel'] = front::$post['telphone'];
            front::$post['username'] = user::getusername($this->view->user['userid']);
            $moeny=0;   //支付总金额
            $discount=usergroup::getusergrop(user::getuserid()); //获取用户组的折扣
            $isint =usergroup::getisint(user::getuserid());      //获取是否取整
            $finalkey='';  //伟哥需要                                                   -------------------------------------end ---------------------------------------------------------------
            $appsid="";  //订单表的域名
            if (count(front::$post['aid'])>0 && front::$post['aid']!='') {
                foreach (front::$post['aid'] as $val) {
                    $source = explode(",",trim($val));
                    $buytemplatedata = buytemplate::getInstance()->getrow(" code='".$source[0]."'");
                    $buytemplatedata['price']=(floatval($buytemplatedata['price'])*$discount/10);   //单价打折
                    if($isint){                                  //判断取整
                        $buytemplatedata['price']=round($buytemplatedata['price']);
                    }
                    $moeny=$moeny+(floatval($buytemplatedata['price'])*1);
                    if ($finalkey == '') {
                        $finalkey =$source[0];   //伟哥需要
                    } else {
                        $finalkey = $finalkey . ',' .$source[0];   //伟哥需要
                    }
                    if ($appsid == '') {
                        $appsid =$val;  //订单表的域名
                    } else {
                        $appsid = $appsid . '#' .$val;   //订单表的域名
                    }
                }
            } else {
                front::$post['aid'] = $this->view->aid;
            }
            $payname = front::$post['payname'] ? front::$post['payname'] : 'none';
            front::$post['oid'] = date('YmdHis') . '-' . front::$post['mid'] . '-' . $payname;
            unset(front::$post['status']);
            front::$post['status'] = 0;
            front::$post['menoy'] = $moeny;         //总价
            front::$post['finalkey']=$finalkey;
            front::$post['appsid']=$finalkey;  //appsid的格式也用 id,域名#id2,域名2#id3,域名3......
            front::$post['ip']=$appsid;  //ip的格式也用 id,域名#id2,域名2#id3,域名3......
            $insert = $this->appsorders->rec_insert(front::$post);
            if ($insert < 1) {
                front::flash($this->tname . lang('add_failure'));
            }
            else {
                cookie::set('ce_buytemplateorders_cookie', '');
                //优惠劵使用
                if(isset(front::$post['somecoupon']) && front::$post['somecoupon'] != '' ){
                    if(strpos(trim(front::$post['somecoupon']),',') !== false) {
                        $source = explode(",", trim(front::$post['somecoupon']));
                        for ($index = 0; $index < count($source); $index++) {
                            user::setcouponidnum($source[$index], 1, '-');   //优惠劵变更
                            $coupondata=coupon::getcouponid( $source[$index]);; //优惠劵信息获取
                            $moeny=(float)($moeny)-(float)($coupondata['moeny']);
                        }
                    }
                    else{
                        user::setcouponidnum(front::$post['somecoupon'], 1, '-');   //优惠劵变更
                        $coupondata=coupon::getcouponid(front::$post['somecoupon']);; //优惠劵信息获取
                        $moeny=(float)($moeny)-(float)($coupondata['moeny']);
                    }
                }
                //短信通知订单
                if (config::getadmin('sms_on') && config::getadmin('sms_order_on')) {
                    $smsCode = new SmsCode();
                    $content = $smsCode->getTemplate('order', array($this->view->user['usernam'], front::$post['oid']));
                    sendMsg(front::$post['telphone'], $content);
                }
                //短信通知管理员
                if (config::getadmin('sms_on') && config::getadmin('sms_order_admin_on') && $mobile = config::getadmin('site_mobile')) {
                    sendMsg($mobile, lang('web_ site') . date('Y-m-d H:i:s') . lang('ordersnotalreadydo'));
                    //echo 11;
                }
                //发送客户邮箱
                if(front::$post['postcode']==""){
                    front::$post['postcode']=user::getuseremail($this->view->user['userid']);
                }
                if (config::getadmin('email_order_send_cust') && front::$post['postcode']) {
                    $title = lang('you_in') . config::getadmin('sitename') . lang('the_order') . front::get('oid') . lang('has_been_submitted');
                    $this->sendmail(front::$post['postcode'], $title, $title);
                }
                //发送管理员邮箱
                if (config::getadmin('email_order_send_admin') && config::getadmin('email')) {
                    $title = lang('web_ site') . date('Y-m-d H:i:s') . lang('ordersnotalreadydo');
                    $this->sendmail(config::getadmin('email'), $title, $title);
                }
                //使用余额支付的时候 直接付款  状态改已支付
                if($payname=="yuer"){
                    $this->appsorders->rec_update(array('static' => '1'), "oid='".front::$post['oid']."'");
                    user::setintegration($moeny);   //积分增加
                    $sheyumenoy=user::getmenoy()-$moeny;  //剩余余额
                    user::getInstance()->rec_update(array('menoy' => $sheyumenoy), "username='".session::get('username')."'");
                    //新增消费记录
                    $xfconsumption = new xfconsumption();
                    $xfconsumptiondata = array();
                    $xfconsumptiondata['status'] = '1';
                    $xfconsumptiondata['oid'] = front::$post['oid'];
                    $xfconsumptiondata['menoy'] = $moeny;
                    $xfconsumptiondata['content'] = lang("buy_template")."：".$finalkey;
                    $xfconsumptiondata['adddate'] = date('Y-m-d h:i:s', time());
                    $xfconsumptiondata['xftype'] =3;  //插件模板消费
                    $xfconsumptiondata['mid'] = $this->view->user['userid'] ? $this->view->user['userid'] : 0;
                    $xfconsumptiondata['trade_no'] = '';
                    $xfconsumption->rec_insert($xfconsumptiondata);
                    //已购买表增加
                    $appsauthoritydata = explode("#",trim( front::$post['ip']));
                    foreach ($appsauthoritydata as $val){
                        $addappsauthoritydata=array();
                        $source = explode(",",trim($val));
                        $addappsauthoritydata['buyid']=$source[0];
                        $addappsauthoritydata['buyip']=$source[1];
                        $addappsauthoritydata['username']=front::$post['username'];
                        $addappsauthoritydata['buytype']=1;
                        $addappsauthoritydata['adddate']=date('Y-m-d h:i:s', time());
                        appsauthority::getInstance()->rec_insert($addappsauthoritydata);
                        //判断分红 开始
                        $buytemplate = buytemplate::getInstance()->getrow(" code='".$source[0]."'");
                        if ($buytemplate['makereduser']!="" && $buytemplate['makeredbili']>0){
                            $makereduser=user::getInstance()->getrow("userid='".$buytemplate['makereduser']."'", 1);
                            if (is_array($makereduser)){
                                $oldprice=(float)(floatval($buytemplate['price'])*$discount/10);  //分红前销售额
                                $makeredbili=(float)($oldprice)*(float)($buytemplate['makeredbili']);//分红
                                $newmenoy=(float)($makereduser['menoy'])+(float)($makeredbili);
                                user::getInstance()->rec_update(array("menoy"=>$newmenoy),"userid='".$buytemplate['makereduser']."'");//修改用户余额
                                $salesdividend=array();
                                $salesdividend['code']=$buytemplate['code'];
                                $salesdividend['userid']=$buytemplate['makereduser'];
                                $salesdividend['buydata']=front::$post['adddate'];
                                $salesdividend['menoy']=$oldprice;
                                $salesdividend['makerprice']=$makeredbili;
                                salesdividend::getInstance()->rec_insert($salesdividend);  //插入到分红销售记录表

                            }
                        }
                        //判断分红 结束

                    }
                    echo '<script type="text/javascript">alert("' . lang('pay_success') . '");window.location.href="' . url('archive/buytemplateorders/oid/' . front::$post['oid']) . '";</script>';
                    exit;
                }
                if (front::$post['payname'] && front::$post['payname'] != 'nopay') {
                    echo '<script type="text/javascript">alert("' . lang('orderssuccess') . ' ' . lang('now_turn_to_pay_page') . '");window.location.href="' . url('archive/paybuytemplateorders/oid/' . front::$post['oid'], true) . '";</script>';
                    exit;
                }
                echo '<script type="text/javascript">alert("' . lang('orderssuccess') . '");window.location.href="' . url('archive/buytemplateorders/oid/' . front::$post['oid'], true) . '";</script>';
                exit;
            }
        }
        elseif
        (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[2][0];
            //非会员不可查看
            if ($oidout[1][0] != $this->view->user['userid']) {
                alertinfo(lang('view_order_failure'), url::create('index/index'));
            }
            $where = array();
            $where['oid'] = front::get('oid');
            $this->view->appsorders = appsorders::getInstance()->getrow($where);
            $this->view->statusnum = $data['static'] = $this->view->appsorders['static'];
            switch ($data['static']) {
                case 1:
                    $this->view->appsorders['static'] = lang('complete');       //完成
                    break;
                default:
                    $this->view->appsorders['static'] = lang('non-payment'); //未支付
                    break;
            }

            //手续费
            $this->view->freetotal = 0;
            //获取产品
            $orderssomedata = array();
            $ordersAid = explode(",", trim($this->view->appsorders['appsid']));
            $discount = usergroup::getusergrop(user::getuserid($oidout[1][0])); //获取用户组的折扣
            $isint = usergroup::getisint(user::getuserid($oidout[1][0]));      //获取是否取整
            for ($index = 0; $index < count($ordersAid); $index++) {
                $buytemplatedata = buytemplate::getInstance()->getrow("code='" . $ordersAid[$index] . "'");//查询在线模板
                $buytemplatedata['price'] = (floatval($buytemplatedata['price']) * $discount / 10);   //单价打折
                if ($isint) {                                  //判断取整
                    $buytemplatedata['price'] = round($buytemplatedata['price']);
                }
                $orderssomedata[count($orderssomedata)] = $buytemplatedata;
            }

            $this->view->archivearr1 = $this->view->_archivearr = $orderssomedata;

            foreach ($this->view->archivearr1 as $key => $val) {
                $this->view->archive['title'] .= $val['code'];
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
            if (isset($this->view->appsorders['somecoupon']) && $this->view->appsorders['somecoupon'] != '') {
                if (strpos(trim($this->view->appsorders['somecoupon']), ',') !== false) {
                    $source = explode(",", trim($this->view->appsorders['somecoupon']));
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
            //未支付的订单
            if (!$this->view->orders['static'] && $payfilename!="none"  && $payfilename!="yuer" ) {
                $order['ordersn'] = front::get('oid');
                $order['title'] = $this->view->archive['title'];
                $order['id'] = $this->view->appsorders['id'];
                $order['orderamount'] = $this->view->fktotal;
                $order['talename'] = 'buytemplateorders';
                $this->view->tablename=$order['talename'];
                include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
                $payclassname = $payfilename;
                $payobj = new $payclassname();
                $this->view->pay[0]['pay_config'];
                $this->view->gotopaygateway = $payobj->get_code($order, unserialize_config($this->view->pay[0]['pay_config']));
            }
            $this->out('../'.config::get('template_user_dir').'/'.'message/buytemplatesuccess.html');
            exit;
        }
        else{
            //直接跳到结算
            if(front::get('settlement')){
                $this->view->settlement =front::get('settlement');
            }
            $oreders_c = cookie::get('ce_buytemplateorders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            //var_dump($oreders_c);
            if (preg_match('/(union|select|update|delete)/i', $oreders_c)) {
                alerterror(lang('illegal_character'));
            }
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
            $aid = !empty($oreders_c) ? unserialize($oreders_c) : 0;
            /* echo print_r($aid);*/
            if ($aid) {
                foreach ($aid as $key => $val) {
                    $buytemplatedata = buytemplate::getInstance()->getrow(" code='".$val['aid']."'");
                    $val['title'] = $buytemplatedata['code'];
                    $prices = getPrices($buytemplatedata['price']);
                    $val['price'] = $prices['price'];
                    $val['name'] = $key;
                    $val['thumb'] = $buytemplatedata['img'];
                    $val['isscorp'] = $buytemplatedata['isscorp'];
                    $aid[$key] = $val;
                }
                $this->view->orderaidlist = $aid;
                $this->view->paylist = pay::getInstance()->getrows(' langid='.lang::getlangid(lang::getistemplate()), 50);
                $this->view->logisticslist = logistics::getInstance()->getrows('', 50);
            }
        }
        $this->render( '../'.config::get('template_user_dir').'/'.'pay/buytemplateorders.html');
        exit;
    }
    //加入/删除 在线模板 购物车
    function dobuytemplateorders_action()
    {

        $aid = front::get('aid');
        $buytemplate=buytemplate::getInstance()->getrow(" code='".$aid."'");
        if (is_array($buytemplate)) {
            $oreders_c = cookie::get('ce_buytemplateorders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));

            //var_dump($orders_c);
            if (empty($oreders_c)) {
                $c_aid = '0' . $aid;
                $orders_c = array($c_aid => array('aid' => $aid, 'amount' => 1));
                $orders_c = serialize($orders_c);
                //var_dump($orders_c);
            } else {
                $orderid =unserialize($oreders_c);
                if (count($orderid) >= 12) {
                    echo 'limit';
                    exit;
                }
                $newctype=true;
                foreach ($orderid as $key=>$val){
                    if($val['aid']==$aid){
                        unset($orderid[$key]);
                        $newctype=false;
                    }
                }
                if ($newctype) {
                    $newc_aid=count($orderid).$aid;
                    $orderid[$newc_aid]=array('aid' => $aid, 'amount' => 1);
                    $orders_c = serialize($orderid);
                }else{
                    $orders_c = serialize($orderid);
                }
            }
            $orders_c = xxtea_encrypt($orders_c, config::getadmin('cookie_password'));
            $orders_c = base64_encode($orders_c);
            cookie::set('ce_buytemplateorders_cookie', $orders_c);
            echo  lang('add_to_cart');
            exit;
        }
        echo  lang('no_add_to_cart');
        exit;
    }
    //清空在线模板购物车
    function emptybuytemplateorders_action()
    {
        cookie::set('ce_buytemplateorders_cookie', '');
        echo "<script>history.go(-1);</script>";
        exit;
    }
    //在线模板订单继续支付页面
    function paybuytemplateorders_action()
    {
        if (front::get('oid')) {
            //Array ( [0] => Array ( [0] => -2638-alipay ) [1] => Array ( [0] => 2638 ) [2] => Array ( [0] => alipay ) ) 1
            preg_match_all("/-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[2][0];
            if($this->view->paytype=='none'){
                echo '<script type="text/javascript">alert("'.lang('no_payment_contact_administrator').'");window.opener=null;window.close();</script>';
                exit;
            }
            $this->view->user_id = $oidout[1][0];
            $where = array();
            $where['oid'] = front::get('oid');
            $this->view->appsorders = appsorders::getInstance()->getrow($where);

            $this->view->statusnum = $data['static'] = $this->view->appsorders['static'];
            switch ($data['static']) {
                case 1:
                    $this->view->appsorders['static'] = lang('complete');       //完成
                    break;
                default:
                    $this->view->appsorders['static'] = lang('non-payment'); //未支付
                    break;
            }
            if (!$this->view->user['userid']) {
                echo '<script type="text/javascript">alert("' . lang('not_logged_save_the_order_number') .$oidout[1][0].'-'.$oidout[2][0]. '")</script>';
            }
            //手续费
            $this->view->freetotal=0;
            //获取产品
            $orderssomedata=array();
            $ordersAid = explode(",",trim( $this->view->appsorders['appsid']));
            $discount=usergroup::getusergrop(user::getuserid($oidout[1][0])); //获取用户组的折扣
            $isint =usergroup::getisint(user::getuserid($oidout[1][0]));      //获取是否取整
            for($index=0;$index<count($ordersAid);$index++){
                $buytemplatedata=buytemplate::getInstance()->getrow("code='".$ordersAid[$index]."'");//查询在线模板
                $buytemplatedata['price']=(floatval($buytemplatedata['price'])*$discount/10);   //单价打折
                if($isint){                                  //判断取整
                    $buytemplatedata['price']=round($buytemplatedata['price']);
                }
                $orderssomedata[count($orderssomedata)]=$buytemplatedata;
            }

            $this->view->archivearr1 = $this->view->_archivearr =$orderssomedata;

            foreach ($this->view->archivearr1 as $key => $val) {
                $this->view->archive['title'] .= $val['code'];
                $where = array();
                $payfilename = $where['pay_code'] = $this->view->paytype;
                $where['langid']=lang::getlangid(lang::getistemplate());
                $this->view->pay = pay::getInstance()->getrows($where);
                $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
                //重算总价  手续费+单价
                $this->view->archivearr1[$key]['total'] = $val['price'] + ($val['price'] * $this->view->pay[0]['pay_fee']);
                // 总价 总和
                $this->view->total += $val['price']  + ($val['price']   * $this->view->pay[0]['pay_fee']);

                //计算手续费
                $this->view->freetotal+=$val['price'] * $this->view->pay[0]['pay_fee'];
            }
            $this->view->total= $this->view->total>0?$this->view->total:0;

            //优惠劵使用
            $couponmenoy=array();
            $this->view->fktotal=$this->view->total;
            if(isset($this->view->appsorders['somecoupon']) && $this->view->appsorders['somecoupon'] != '' ){
                if(strpos(trim($this->view->appsorders['somecoupon']),',') !== false) {
                    $source = explode(",", trim($this->view->appsorders['somecoupon']));
                    for ($index = 0; $index < count($source); $index++) {
                        $coupondata=coupon::getcouponid( $source[$index]);; //优惠劵信息获取
                        $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                        $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']); //保存优惠金额
                    }
                }
                else{
                    $coupondata=coupon::getcouponid(  $this->view->orders['somecoupon']);; //优惠劵信息获取
                    $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                    $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']);  //保存优惠金额
                }
            }
            $this->view->archivearr1['couponmenoy']=$couponmenoy;

            $order['ordersn'] = front::get('oid');
            $order['title'] = $this->view->archive['title'];
            $order['id'] = $this->view->appsorders['id'];
            $order['orderamount'] = $this->view->fktotal;
            $order['talename'] ='buytemplateorders';
            $this->view->tablename=$order['talename'];
            include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
            $payclassname = $payfilename;
            $payobj = new $payclassname();
            $this->view->pay[0]['pay_config'];
            $this->view->gotopaygateway = $payobj->get_code($order, unserialize_config($this->view->pay[0]['pay_config']));
        }
        $this->render('pay/paybuytemplateorders.html');
        exit;
    }

    //组件市场购物车
    function buymodulesorders_action()
    {
        if (front::post('submit')) {
            // front::$post Array ( [aid] => Array ( [0] => f162,127.0.0.8 [1] => f164,127.0.0.9 ) [apps_ip] => 127.0.0.9 [somecoupon] => [telphone] => 15111505506 [remarks] => [payname] => yuer [submit] => 购买 )
            $this->appsorders = new appsorders();
            $row = $this->appsorders->getrow("oid='%-".$this->view->user['userid']."-%'", "adddate DESC");
            //var_dump(time());
            //下单间隔
            if ($row['adddate'] && time() - $row['adddate'] <= intval(config::getadmin('order_time'))) {
                alerterror(lang('frequent_operation_please_wait'));
                return;
            }
            //联系电话必填
            if (front::$post['telphone'] == '') {
                alerterror(lang('telephone_is_required'));
                return;
            }
            //手机验证码
            if (config::getadmin('mobilechk_enable') && config::getadmin('mobilechk_buy')) {
                $mobilenum = front::$post['mobilenum'];
                $smsCode = new SmsCode();
                if (!$smsCode->chkcode($mobilenum)) {
                    alerterror(lang('cell_phone_parity_error'));
                    return false;
                }
            }
            front::$post['mid'] = $this->view->user['userid'];
            front::$post['adddate'] = time();
            front::$post['tel'] = front::$post['telphone'];
            front::$post['username'] = user::getusername($this->view->user['userid']);
            $moeny=0;   //支付总金额
            $discount=usergroup::getusergrop(user::getuserid()); //获取用户组的折扣
            $isint =usergroup::getisint(user::getuserid());      //获取是否取整
            $finalkey='';  //伟哥需要                                                   -------------------------------------end ---------------------------------------------------------------
            $appsid="";  //订单表的域名
            if (count(front::$post['aid'])>0 && front::$post['aid']!='') {
                foreach (front::$post['aid'] as $val) {
                    $source = explode(",",trim($val));
                    $buytemplatedata = buymodules::getInstance()->getrow(" code='".$source[0]."'");
                    $buytemplatedata['price']=(floatval($buytemplatedata['price'])*$discount/10);   //单价打折
                    if($isint){                                  //判断取整
                        $buytemplatedata['price']=round($buytemplatedata['price']);
                    }
                    $moeny=$moeny+(floatval($buytemplatedata['price'])*1);
                    if ($finalkey == '') {
                        $finalkey =$source[0];   //伟哥需要
                    } else {
                        $finalkey = $finalkey . ',' .$source[0];   //伟哥需要
                    }
                    if ($appsid == '') {
                        $appsid =$val;  //订单表的域名
                    } else {
                        $appsid = $appsid . '#' .$val;   //订单表的域名
                    }
                }
            } else {
                front::$post['aid'] = $this->view->aid;
            }
            $payname = front::$post['payname'] ? front::$post['payname'] : 'none';
            front::$post['oid'] = date('YmdHis') . '-' . front::$post['mid'] . '-' . $payname;
            unset(front::$post['status']);
            front::$post['status'] = 0;
            front::$post['menoy'] = $moeny;         //总价
            front::$post['finalkey']=$finalkey;
            front::$post['appsid']=$finalkey;  //appsid的格式也用 id,域名#id2,域名2#id3,域名3......
            front::$post['ip']=$appsid;  //ip的格式也用 id,域名#id2,域名2#id3,域名3......
            $insert = $this->appsorders->rec_insert(front::$post);
            if ($insert < 1) {
                front::flash($this->tname . lang('add_failure'));
            }
            else {
                cookie::set('ce_buymodulesorders_cookie', '');
                //优惠劵使用
                if(isset(front::$post['somecoupon']) && front::$post['somecoupon'] != '' ){
                    if(strpos(trim(front::$post['somecoupon']),',') !== false) {
                        $source = explode(",", trim(front::$post['somecoupon']));
                        for ($index = 0; $index < count($source); $index++) {
                            user::setcouponidnum($source[$index], 1, '-');   //优惠劵变更
                            $coupondata=coupon::getcouponid( $source[$index]);; //优惠劵信息获取
                            $moeny=(float)($moeny)-(float)($coupondata['moeny']);
                        }
                    }
                    else{
                        user::setcouponidnum(front::$post['somecoupon'], 1, '-');   //优惠劵变更
                        $coupondata=coupon::getcouponid(front::$post['somecoupon']);; //优惠劵信息获取
                        $moeny=(float)($moeny)-(float)($coupondata['moeny']);
                    }
                }
                //短信通知订单
                if (config::getadmin('sms_on') && config::getadmin('sms_order_on')) {
                    $smsCode = new SmsCode();
                    $content = $smsCode->getTemplate('order', array($this->view->user['usernam'], front::$post['oid']));
                    sendMsg(front::$post['telphone'], $content);
                }
                //短信通知管理员
                if (config::getadmin('sms_on') && config::getadmin('sms_order_admin_on') && $mobile = config::getadmin('site_mobile')) {
                    sendMsg($mobile, lang('web_ site') . date('Y-m-d H:i:s') . lang('ordersnotalreadydo'));
                    //echo 11;
                }
                //发送客户邮箱
                if(front::$post['postcode']==""){
                    front::$post['postcode']=user::getuseremail($this->view->user['userid']);
                }
                if (config::getadmin('email_order_send_cust') && front::$post['postcode']) {
                    $title = lang('you_in') . config::getadmin('sitename') . lang('the_order') . front::get('oid') . lang('has_been_submitted');
                    $this->sendmail(front::$post['postcode'], $title, $title);
                }
                //发送管理员邮箱
                if (config::getadmin('email_order_send_admin') && config::getadmin('email')) {
                    $title = lang('web_ site') . date('Y-m-d H:i:s') . lang('ordersnotalreadydo');
                    $this->sendmail(config::getadmin('email'), $title, $title);
                }
                //使用余额支付的时候 直接付款  状态改已支付
                if($payname=="yuer"){
                    $this->appsorders->rec_update(array('static' => '1'), "oid='".front::$post['oid']."'");
                    user::setintegration($moeny);   //积分增加
                    $sheyumenoy=user::getmenoy()-$moeny;  //剩余余额
                    user::getInstance()->rec_update(array('menoy' => $sheyumenoy), "username='".session::get('username')."'");
                    //新增消费记录
                    $xfconsumption = new xfconsumption();
                    $xfconsumptiondata = array();
                    $xfconsumptiondata['status'] = '1';
                    $xfconsumptiondata['oid'] = front::$post['oid'];
                    $xfconsumptiondata['menoy'] = $moeny;
                    $xfconsumptiondata['content'] = lang("buy_modules")."：".$finalkey;
                    $xfconsumptiondata['adddate'] = date('Y-m-d h:i:s', time());
                    $xfconsumptiondata['xftype'] =9;  //插件模板消费
                    $xfconsumptiondata['mid'] = $this->view->user['userid'] ? $this->view->user['userid'] : 0;
                    $xfconsumptiondata['trade_no'] = '';
                    $xfconsumption->rec_insert($xfconsumptiondata);
                    //已购买表增加
                    $appsauthoritydata = explode("#",trim( front::$post['ip']));
                    foreach ($appsauthoritydata as $val){
                        $addappsauthoritydata=array();
                        $source = explode(",",trim($val));
                        $addappsauthoritydata['buyid']=$source[0];
                        $addappsauthoritydata['buyip']=$source[1];
                        $addappsauthoritydata['username']=front::$post['username'];
                        $addappsauthoritydata['buytype']=3;   //组件购买
                        $addappsauthoritydata['adddate']=date('Y-m-d h:i:s', time());
                        appsauthority::getInstance()->rec_insert($addappsauthoritydata);
                        //判断分红 开始
                        $buytemplate = buymodules::getInstance()->getrow(" code='".$source[0]."'");
                        if ($buytemplate['makereduser']!="" && $buytemplate['makeredbili']>0){
                            $makereduser=user::getInstance()->getrow("userid='".$buytemplate['makereduser']."'", 1);
                            if (is_array($makereduser)){
                                $oldprice=(float)(floatval($buytemplate['price'])*$discount/10);  //分红前销售额
                                $makeredbili=(float)($oldprice)*(float)($buytemplate['makeredbili']);//分红
                                $newmenoy=(float)($makereduser['menoy'])+(float)($makeredbili);
                                user::getInstance()->rec_update(array("menoy"=>$newmenoy),"userid='".$buytemplate['makereduser']."'");//修改用户余额
                                $salesdividend=array();
                                $salesdividend['code']=$buytemplate['code'];
                                $salesdividend['userid']=$buytemplate['makereduser'];
                                $salesdividend['buydata']=front::$post['adddate'];
                                $salesdividend['menoy']=$oldprice;
                                $salesdividend['makerprice']=$makeredbili;
                                salesdividend::getInstance()->rec_insert($salesdividend);  //插入到分红销售记录表
                            }
                        }
                        //判断分红 结束

                    }
                    echo '<script type="text/javascript">alert("' . lang('pay_success') . '");window.location.href="' . url('archive/buymodulesorders/oid/' . front::$post['oid']) . '";</script>';
                    exit;
                }
                if (front::$post['payname'] && front::$post['payname'] != 'nopay') {
                    echo '<script type="text/javascript">alert("' . lang('orderssuccess') . ' ' . lang('now_turn_to_pay_page') . '");window.location.href="' . url('archive/paybuymodulesorders/oid/' . front::$post['oid'], true) . '";</script>';
                    exit;
                }
                echo '<script type="text/javascript">alert("' . lang('orderssuccess') . '");window.location.href="' . url('archive/buymodulesorders/oid/' . front::$post['oid']) . '";</script>';
                exit;
            }
        }
        elseif
        (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[2][0];
            //非会员不可查看
            if ($oidout[1][0] != $this->view->user['userid']) {
                alertinfo(lang('view_order_failure'), url::create('index/index'));
            }
            $where = array();
            $where['oid'] = front::get('oid');
            $this->view->appsorders = appsorders::getInstance()->getrow($where);
            $this->view->statusnum = $data['static'] = $this->view->appsorders['static'];
            switch ($data['static']) {
                case 1:
                    $this->view->appsorders['static'] = lang('complete');       //完成
                    break;
                default:
                    $this->view->appsorders['static'] = lang('non-payment'); //未支付
                    break;
            }

            //手续费
            $this->view->freetotal = 0;
            //获取产品
            $orderssomedata = array();
            $ordersAid = explode(",", trim($this->view->appsorders['appsid']));
            $discount = usergroup::getusergrop(user::getuserid($oidout[1][0])); //获取用户组的折扣
            $isint = usergroup::getisint(user::getuserid($oidout[1][0]));      //获取是否取整
            for ($index = 0; $index < count($ordersAid); $index++) {
                $buytemplatedata = buymodules::getInstance()->getrow("code='" . $ordersAid[$index] . "'");//查询在线模板
                $buytemplatedata['price'] = (floatval($buytemplatedata['price']) * $discount / 10);   //单价打折
                if ($isint) {                                  //判断取整
                    $buytemplatedata['price'] = round($buytemplatedata['price']);
                }
                $orderssomedata[count($orderssomedata)] = $buytemplatedata;
            }

            $this->view->archivearr1 = $this->view->_archivearr = $orderssomedata;

            foreach ($this->view->archivearr1 as $key => $val) {
                $this->view->archive['title'] .= $val['code'];
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
            if (isset($this->view->appsorders['somecoupon']) && $this->view->appsorders['somecoupon'] != '') {
                if (strpos(trim($this->view->appsorders['somecoupon']), ',') !== false) {
                    $source = explode(",", trim($this->view->appsorders['somecoupon']));
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
            //未支付的订单
            if (!$this->view->orders['static'] && $payfilename!="none" && $payfilename!="nopay"  && $payfilename!="yuer" ) {
                $order['ordersn'] = front::get('oid');
                $order['title'] = $this->view->archive['title'];
                $order['id'] = $this->view->appsorders['id'];
                $order['orderamount'] = $this->view->fktotal;
                $order['talename'] = 'buymodulesorders';
                $this->view->tablename=$order['talename'];
                include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
                $payclassname = $payfilename;
                $payobj = new $payclassname();
                $this->view->pay[0]['pay_config'];
                $this->view->gotopaygateway = $payobj->get_code($order, unserialize_config($this->view->pay[0]['pay_config']));
            }
            $this->out('../'.config::get('template_user_dir').'/'.'message/usermodulessuccess.html');
            exit;
        }
        else{
            //直接跳到结算
            if(front::get('settlement')){
                $this->view->settlement =front::get('settlement');
            }
            $oreders_c = cookie::get('ce_buymodulesorders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            //var_dump($oreders_c);
            if (preg_match('/(union|select|update|delete)/i', $oreders_c)) {
                alerterror(lang('illegal_character'));
            }
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
            $aid = !empty($oreders_c) ? unserialize($oreders_c) : 0;
            /* echo print_r($aid);*/
            if ($aid) {
                foreach ($aid as $key => $val) {
                    $buytemplatedata = buymodules::getInstance()->getrow(" code='".$val['aid']."'");
                    $val['title'] = $buytemplatedata['code'];
                    $prices = getPrices($buytemplatedata['price']);
                    $val['price'] = $prices['price'];
                    $val['name'] = $key;
                    $val['thumb'] = $buytemplatedata['img'];
                    $val['isscorp'] = $buytemplatedata['isscorp'];
                    $aid[$key] = $val;
                }
                $this->view->orderaidlist = $aid;
                $this->view->paylist = pay::getInstance()->getrows(' langid='.lang::getlangid(lang::getistemplate()), 50);
                $this->view->logisticslist = logistics::getInstance()->getrows('', 50);
            }
        }
        $this->render( '../'.config::get('template_user_dir').'/'.'pay/usermodulesorders.html');
        exit;
    }
    //加入/删除 组件市场 购物车
    function dobuymodulesorders_action()
    {

        $aid = front::get('aid');
        $buytemplate=buymodules::getInstance()->getrow(" code='".$aid."'");
        if (is_array($buytemplate)) {
            $oreders_c = cookie::get('ce_buymodulesorders_cookie');
            $oreders_c = base64_decode($oreders_c);
            $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
            $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));

            //var_dump($orders_c);
            if (empty($oreders_c)) {
                $c_aid = '0' . $aid;
                $orders_c = array($c_aid => array('aid' => $aid, 'amount' => 1));
                $orders_c = serialize($orders_c);
                //var_dump($orders_c);
            } else {
                $orderid =unserialize($oreders_c);
                if (count($orderid) >= 12) {
                    echo 'limit';
                    exit;
                }
                $newctype=true;
                foreach ($orderid as $key=>$val){
                    if($val['aid']==$aid){
                        unset($orderid[$key]);
                        $newctype=false;
                    }
                }
                if ($newctype) {
                    $newc_aid=count($orderid).$aid;
                    $orderid[$newc_aid]=array('aid' => $aid, 'amount' => 1);
                    $orders_c = serialize($orderid);
                }else{
                    $orders_c = serialize($orderid);
                }
            }
            $orders_c = xxtea_encrypt($orders_c, config::getadmin('cookie_password'));
            $orders_c = base64_encode($orders_c);
            cookie::set('ce_buymodulesorders_cookie', $orders_c);
            echo  lang('add_to_cart');
            exit;
        }
        echo  lang('no_add_to_cart');
        exit;
    }
    //清空组件市场购物车
    function emptybuymodulesorders_action()
    {
        cookie::set('ce_buymodulesorders_cookie', '');
        echo "<script>history.go(-1);</script>";
        exit;
    }
    //组件市场订单继续支付页面
    function paybuymodulesorders_action()
    {
        if (front::get('oid')) {
            //Array ( [0] => Array ( [0] => -2638-alipay ) [1] => Array ( [0] => 2638 ) [2] => Array ( [0] => alipay ) ) 1
            preg_match_all("/-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[2][0];
            if($this->view->paytype=='none'){
                echo '<script type="text/javascript">alert("'.lang('no_payment_contact_administrator').'");window.opener=null;window.close();</script>';
                exit;
            }
            $this->view->user_id = $oidout[1][0];
            $where = array();
            $where['oid'] = front::get('oid');
            $this->view->appsorders = appsorders::getInstance()->getrow($where);

            $this->view->statusnum = $data['static'] = $this->view->appsorders['static'];
            switch ($data['static']) {
                case 1:
                    $this->view->appsorders['static'] = lang('complete');       //完成
                    break;
                default:
                    $this->view->appsorders['static'] = lang('non-payment'); //未支付
                    break;
            }
            if (!$this->view->user['userid']) {
                echo '<script type="text/javascript">alert("' . lang('not_logged_save_the_order_number') .$oidout[1][0].'-'.$oidout[2][0]. '")</script>';
            }
            //手续费
            $this->view->freetotal=0;
            //获取产品
            $orderssomedata=array();
            $ordersAid = explode(",",trim( $this->view->appsorders['appsid']));
            $discount=usergroup::getusergrop(user::getuserid($oidout[1][0])); //获取用户组的折扣
            $isint =usergroup::getisint(user::getuserid($oidout[1][0]));      //获取是否取整
            for($index=0;$index<count($ordersAid);$index++){
                $buytemplatedata=buymodules::getInstance()->getrow("code='".$ordersAid[$index]."'");//查询在线模板
                $buytemplatedata['price']=(floatval($buytemplatedata['price'])*$discount/10);   //单价打折
                if($isint){                                  //判断取整
                    $buytemplatedata['price']=round($buytemplatedata['price']);
                }
                $orderssomedata[count($orderssomedata)]=$buytemplatedata;
            }

            $this->view->archivearr1 = $this->view->_archivearr =$orderssomedata;

            foreach ($this->view->archivearr1 as $key => $val) {
                $this->view->archive['title'] .= $val['code'];
                $where = array();
                $payfilename = $where['pay_code'] = $this->view->paytype;
                $where['langid']=lang::getlangid(lang::getistemplate());
                $this->view->pay = pay::getInstance()->getrows($where);
                $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
                //重算总价  手续费+单价
                $this->view->archivearr1[$key]['total'] = $val['price'] + ($val['price'] * $this->view->pay[0]['pay_fee']);
                // 总价 总和
                $this->view->total += $val['price']  + ($val['price']   * $this->view->pay[0]['pay_fee']);

                //计算手续费
                $this->view->freetotal+=$val['price'] * $this->view->pay[0]['pay_fee'];
            }
            $this->view->total= $this->view->total>0?$this->view->total:0;

            //优惠劵使用
            $couponmenoy=array();
            $this->view->fktotal=$this->view->total;
            if(isset($this->view->appsorders['somecoupon']) && $this->view->appsorders['somecoupon'] != '' ){
                if(strpos(trim($this->view->appsorders['somecoupon']),',') !== false) {
                    $source = explode(",", trim($this->view->appsorders['somecoupon']));
                    for ($index = 0; $index < count($source); $index++) {
                        $coupondata=coupon::getcouponid( $source[$index]);; //优惠劵信息获取
                        $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                        $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']); //保存优惠金额
                    }
                }
                else{
                    $coupondata=coupon::getcouponid(  $this->view->orders['somecoupon']);; //优惠劵信息获取
                    $this->view->fktotal=(float)($this->view->total)-(float)($coupondata['moeny']);
                    $couponmenoy[count($couponmenoy)]=array((int)$coupondata['moeny'],$coupondata['coupontitle']);  //保存优惠金额
                }
            }
            $this->view->archivearr1['couponmenoy']=$couponmenoy;

            $order['ordersn'] = front::get('oid');
            $order['title'] = $this->view->archive['title'];
            $order['id'] = $this->view->appsorders['id'];
            $order['orderamount'] = $this->view->fktotal;
            $order['talename'] ='buymodulesorders';
            $this->view->tablename=$order['talename'];
            include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
            $payclassname = $payfilename;
            $payobj = new $payclassname();
            $this->view->pay[0]['pay_config'];
            $this->view->gotopaygateway = $payobj->get_code($order, unserialize_config($this->view->pay[0]['pay_config']));
        }
        $this->render('../'.config::get('template_user_dir').'/'.'pay/payusermodulesorders.html');
        exit;
    }

    //购物车输入域名在线模板校验是否已经购买
    function getbuyappstemplate_action(){
        $appsauthoritydata=appsauthority::getInstance()->getrow(array("buyid"=>front::get('buyid'),"buyip"=>front::get('buyip'),"username"=>user::getusername($this->view->user['userid'])));
        if (is_array($appsauthoritydata)){
            echo  json_encode(array("static"=>0,"message"=>lang("当前域名的模板已经购买，请勿重复购买！")));
        }else{
            echo  json_encode(array("static"=>1,"message"=>""));
        }
        exit;
    }
    //获取购物车
    function getorders_action(){
        $oreders_c = cookie::get('ce_orders_cookie');
        $oreders_c = base64_decode($oreders_c);
        $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
        //var_dump($oreders_c);
        if (preg_match('/(union|select|update|delete)/i', $oreders_c)) {
            alerterror(lang('illegal_character'));
        }
        $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
        $aid = !empty($oreders_c) ? unserialize($oreders_c) : array();
        $archivedata=array();
        foreach ($aid as $key => $val) {
            $archive = archive::getInstance()->getrow(intval($val['aid']));
            $val['title'] = $archive['title'];
            $newcname='attr2_'.lang::getistemplate();
            $attr2=json_decode($archive['attr2'],true);
            $archive['attr2']=is_array($attr2)?$attr2[$newcname]:$archive['attr2'];

            $prices = getPrices($archive['attr2']);
            $val['attr2'] = $prices['price'];
            $val['thumb'] = $archive['thumb'];
            $val['url'] = $archive['url'];
            $val['inventory'] = $archive['inventory'];
            $val['name'] = $key;
            $val['catid'] = $archive['catid'];
            $aid[$key] = $val;
        }
        echo json_encode($aid);
        exit;
    }

    //取消订单
    function droporders_action(){
        $xfconsumption = new orders();
        //获取到购买的商品  进行计算销售量
        $tabledata = $xfconsumption->getrows("oid='".front::get('oid')."'", 1); //查询订单表
        if(is_array($tabledata)){
            //获取到购买的商品  进行计算库存
            $ordersAid = explode("-",trim($tabledata[0]['aid']));
            //循环多个商品
            for($index=0;$index<count($ordersAid);$index++){
                $source = explode("#",trim($ordersAid[$index]));
                $_aidArrys = explode(",", trim($source[0]));
                if ($tabledata['type']==2){
                    $datavuel = servicearchive::getInstance()->getrows('aid = '.$_aidArrys[0],1);
                }else{
                    $datavuel = archive::getInstance()->getrows('aid = '.$_aidArrys[0],1);
                }
                //库存还原
                $inventorynum=$datavuel[0]['inventory']+(int)($_aidArrys[1]);
                //修改库存
                archive::getInstance()->rec_update(array('inventory'=>$inventorynum), $_aidArrys[0]);
            }
        }
        $delete = $xfconsumption->rec_delete("oid='".front::get('oid')."'");
        if($delete>0){
            echo '<script type="text/javascript">alert("'.lang('cancellation_of_order').lang('success').'！");window.location.href="' . url('manage/orderslist/manage/orders', true) . '";</script>';
        }else{
            echo '<script type="text/javascript">alert("'.lang('cancellation_of_order').lang('failure').'！");window.location.href="' . url('manage/orderslist/manage/orders', true) . '";</script>';
        }
        exit;
    }

    //获取cookie里面的购买数量
    function getshoppinginventory_action(){
        $oreders_c = cookie::get('ce_orders_cookie');
        $oreders_c = base64_decode($oreders_c);
        $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
        //var_dump($oreders_c);
        if (preg_match('/(union|select|update|delete)/i', $oreders_c)) {
            alerterror(lang('illegal_character'));
        }
        $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
        $aid = !empty($oreders_c) ? unserialize($oreders_c) : 0;
        if($aid){
            $shoppinginventory=0;
            foreach ($aid as $key => $val) {
                if($val['aid']==front::get('aid')){
                    $shoppinginventory=$shoppinginventory+(int)($val['amount']);
                }
            }
            echo $shoppinginventory;
        }else{
            echo 0;
        }
        exit;
    }

    function consumption_action()
    {
        //校验是否登陆
        if ( !front::$user['userid']) {
            alertinfo(lang('not_logged'), url('user/login'));
            return;
        }

        if (front::post('submit')) {
            $this->consumption = new consumption();
            front::$post['adddate'] =  date('Y-m-d h:i:s', time());
            front::$post['mid'] = $this->view->user['userid'] ? $this->view->user['userid'] : 0;
            $payname = front::$post['payname'] ? front::$post['payname'] : 'none';
            front::$post['oid'] = date('YmdHis') . '-' . front::$post['mid'] . '-' . $payname;
            unset(front::$post['status']);
            front::$post['status'] = 0;
            front::$post['s_status'] = 0;
            $insert = $this->consumption->rec_insert(front::$post);
            if($insert>0){
                $url=url('archive/payconsumption/oid/' . front::$post['oid'], true);
                if (front::get("aid"))
                    $url=$url.'&aid='.front::get("aid");
                echo '<script type="text/javascript">alert("' . lang('orderssuccess') . ' ' . lang('now_turn_to_pay_page') . '");window.location.href="' .$url . '";</script>';
                exit;
            }
        }
        elseif  (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[2][0];
            //非会员不可查看
            if ($oidout[1][0] != $this->view->user['userid']) {
                alertinfo(lang('view_order_failure'), url::create('index/index'));
            }
            $where = array();
            $where['oid'] = front::get('oid');
            $this->view->consumption = consumption::getInstance()->getrow($where);
            $this->view->statusnum = $data['status'] = $this->view->consumption['status'];
            $unpay = false;
            switch ($data['status']) {
                case 1:
                    $data['status'] = lang('complete');
                    break;
                case 2:
                    $data['status'] = lang('processing');
                    break;
                case 3:
                    $data['status'] = lang('shipped');
                    break;
                case 4:
                    $data['status'] = lang('pending_audit_payment');
                    break;
                case 5:
                    $data['status'] = lang('check_payment');
                    break;
                default:
                    $data['status'] = lang('ordersnotalreadydo');
                    $unpay = true;
                    break;
            }
            $this->view->consumption['status'] = $data['status'];

            //获取支付链接
            if ($unpay && $this->view->paytype && $this->view->paytype != 'nopay' && $this->view->paytype != 'none') {

                $where = array();
                $where['oid'] = front::get('oid');
                $this->view->consumption = consumption::getInstance()->getrow($where);

                $where = array();
                $payfilename = $where['pay_code'] = $this->view->paytype;
                $where['langid']=lang::getlangid(lang::getistemplate());
                $this->view->pay = pay::getInstance()->getrows($where);
                $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
                $this->view->total = $this->view->consumption['menoy']  + ($this->view->archive['menoy']  * $this->view->pay[0]['pay_fee']);
                $consumption['ordersn'] = front::get('oid');
                $consumption['title'] = lang('recharge_amount');
                $consumption['id'] = $this->view->consumption['id'];
                $consumption['orderamount'] = $this->view->total;
                $consumption['talename'] ='consumption';
                $this->view->tablename=$consumption['talename'];
                include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
                $payclassname = $payfilename;
                $payobj = new $payclassname();
                $this->view->gotopaygateway = $payobj->get_code($consumption, unserialize_config($this->view->pay[0]['pay_config']));
            }

            //var_dump($this->view->user);var_dump($_SESSION);exit();
            $this->out('message/consumptionsuccess.html');
        }
        else{
            $this->view->paylist = pay::getInstance()->getrows(' langid='.lang::getlangid(lang::getistemplate()), 50);
        }

        if (front::get("aid"))
         $this->view->aid=front::get("aid");

        $this->render('consumption/consumption.html');
        exit;
    }

    function expresslist_action()
    {
        //校验是否登陆
        if ( !front::$user['userid']) {
            alertinfo(lang('not_logged'), url('user/login'));
            return;
        }
        if(front::get('expressid') !='' && front::get('expresstype')!='') {
            $this->_table  =new orders();
            $this->_table->querexpress(front::get('expressid'),front::get('expresstype'),$this->view);
        }
        $this->render('express/expresslist.html');
        exit;
    }

    function payconsumption_action()
    {
        if (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[2][0];
         /*   if($this->view->paytype=='none'){
                echo '<script type="text/javascript">alert("'.lang('no_payment_contact_administrator').'");window.opener=null;window.close();</script>';
                exit;
            }*//*   if($this->view->paytype=='none'){
                echo '<script type="text/javascript">alert("'.lang('no_payment_contact_administrator').'");window.opener=null;window.close();</script>';
                exit;
            }*/
            $this->view->user_id = $oidout[1][0];
            $where = array();
            $where['oid'] = front::get('oid');
            $this->view->consumption = consumption::getInstance()->getrow($where);
            $this->view->statusnum = $data['status'] = $this->view->consumption['status'];
            switch ($data['status']) {
                case 1:
                    $this->view->orders['status'] = lang('complete');
                    break;
                case 2:
                    $this->view->orders['status'] = lang('processing');
                    break;
                case 3:
                    $this->view->orders['status'] = lang('shipped');
                    break;
                case 4:
                    $this->view->orders['status'] = lang('pending_audit_payment');
                    break;
                case 5:
                    $this->view->orders['status'] = lang('check_payment');
                    break;
                default:
                    $this->view->orders['status'] = lang('ordersnotalreadydo');
                    break;
            }

            if (!$this->view->user['userid']) {
                echo '<script type="text/javascript">alert("' . lang('not_logged_save_the_order_number') .$oidout[1][0].'-'.$oidout[2][0]. '")</script>';
            }

            $where = array();
            $payfilename = $where['pay_code'] = $this->view->paytype;
            $where['langid']=lang::getlangid(lang::getistemplate());
            $this->view->pay = pay::getInstance()->getrows($where);
            $this->view->consumption['title']= lang('recharge_amount');
            $this->view->consumption['total']= $this->view->consumption['menoy']+( $this->view->consumption['menoy']* $this->view->pay[0]['pay_fee']);

            $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
            $this->view->total = $this->view->consumption['menoy'] + ($this->view->consumption['menoy']  * $this->view->pay[0]['pay_fee']);
            $consumption['ordersn'] = front::get('oid');
            $consumption['title'] = lang('recharge_amount');
            $consumption['id'] = $this->view->consumption['id'];
            $consumption['orderamount'] = $this->view->total;
            $consumption['talename'] ='consumption';
            $this->view->tablename=$consumption['talename'];
            include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
            $payclassname = $payfilename;
            $payobj = new $payclassname();
            $this->view->gotopaygateway = $payobj->get_code($consumption, unserialize_config($this->view->pay[0]['pay_config']));
        }
        $this->render('consumption/payconsumption.html');
        exit;
    }

    function payappsconsumption_action()
    {
        if (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)/isu", front::get('oid'), $oidout);
            $this->view->paytype = $oidout[2][0];
            if($this->view->paytype=='none'){
                echo '<script type="text/javascript">alert("'.lang('no_payment_contact_administrator').'");window.opener=null;window.close();</script>';
                exit;
            }
            $this->view->user_id = $oidout[1][0];
            $where = array();
            $where['oid'] = front::get('oid');
            $this->view->consumption = consumption::getInstance()->getrow($where);
            $this->view->statusnum = $data['status'] = $this->view->consumption['status'];
            switch ($data['status']) {
                case 1:
                    $this->view->orders['status'] = lang('complete');
                    break;
                case 2:
                    $this->view->orders['status'] = lang('processing');
                    break;
                case 3:
                    $this->view->orders['status'] = lang('shipped');
                    break;
                case 4:
                    $this->view->orders['status'] = lang('pending_audit_payment');
                    break;
                case 5:
                    $this->view->orders['status'] = lang('check_payment');
                    break;
                default:
                    $this->view->orders['status'] = lang('ordersnotalreadydo');
                    break;
            }

            $where = array();
            $payfilename = $where['pay_code'] = $this->view->paytype;
            $where['langid']=lang::getlangid(lang::getistemplate());
            $this->view->pay = pay::getInstance()->getrows($where);
            $this->view->consumption['title']= lang('recharge_amount');
            $this->view->consumption['total']= $this->view->consumption['menoy']+( $this->view->consumption['menoy']* $this->view->pay[0]['pay_fee']);

            $this->view->pay[0]['pay_fee'] = $this->view->pay[0]['pay_fee'] / 100;
            $this->view->total = $this->view->consumption['menoy'] + ($this->view->consumption['menoy']  * $this->view->pay[0]['pay_fee']);
            $consumption['ordersn'] = front::get('oid');
            $consumption['title'] = lang('recharge_amount');
            $consumption['id'] = $this->view->consumption['id'];
            $consumption['orderamount'] = $this->view->total;
            $consumption['talename'] ='consumption';
            $this->view->tablename=$consumption['talename'];
            include_once ROOT . '/lib/plugins/pay/' . $payfilename . '.php';
            $payclassname = $payfilename;
            $payobj = new $payclassname();

            $this->view->gotopaygateway = $payobj->get_code($consumption, unserialize_config($this->view->pay[0]['pay_config']));
        }
        $this->render('consumption/payconsumption.html');
        exit;
    }

    function chkconsumption_action()
    {
        $oid = front::get('oid');
        include_once ROOT . '/lib/plugins/pay/wxscanpay.php';
        $payobj = new wxscanpay();
        $result=$payobj->Queryorder($oid);
        if ($result=="SUCCESS"){
            $out_trade_no=$result['out_trade_no'];
            $row = array();
            $row['status'] = 1;
            $row['s_status'] = 1;
            $row['trade_no'] = $result['transaction_id'];
            orders::getInstance()->rec_update($row, array("oid"=>$out_trade_no));

            //支付了分发产品码
            if (file_exists(ROOT . "/lib/table/productcode.php"))
            productcode::product($out_trade_no);

            //查询订单表
            $tabledata = orders::getInstance()->getrow("oid='".$out_trade_no."'");

            user::setintegration($tabledata['menoy']);   //积分增加

            //新增消费记录
            $xfconsumption = new xfconsumption();
            $xfconsumptiondata = array();
            $xfconsumptiondata['status'] = '1';
            $xfconsumptiondata['adddate'] = date('Y-m-d h:i:s', time());
            $xfconsumptiondata['mid'] = $this->view->user['userid'] ? $this->view->user['userid'] : 0;
            $xfconsumptiondata['oid'] = $out_trade_no;
            $xfconsumptiondata['menoy'] = $tabledata['menoy'];
            $xfconsumptiondata['xftype'] =1;  //商品消费
            $xfconsumptiondata['content'] = lang('purchase_and_consumption_of_goods');
            //新增消费订单
            $xfconsumption->rec_insert($xfconsumptiondata);

            echo 1;
        }else{
            echo 0;
        }
        exit;
    }

    //id查询商品
    function getcouponid_action(){
        if(front::get('couponid') && front::get('couponid')!=''){
            $coupon=coupon::getcouponid(front::get('couponid'));
            echo  json_encode($coupon);
        }
        exit;

    }

    //增删收藏
    function setcollect_action(){
        if(front::get('couponid') && front::get('couponid')!=''){
            $messagelist=user::setcollect(front::get('couponid'));
            echo  json_encode($messagelist);
        }
        exit;

    }
    //增删收藏在线模板
    function setcollectbuytemplate_action(){
        if(front::get('couponid') && front::get('couponid')!=''){
            $messagelist=user::setcollectbuytemplate(front::get('couponid'));
            echo  json_encode($messagelist);
        }
        exit;

    }

    //增删点赞
    function setpraise_action(){
        if(front::get('aid') && front::get('aid')!=''){
            $aid = intval(front::get('aid'));
            $messagelist=archive::setpraise($aid);
            echo  json_encode($messagelist);
        }
        exit;

    }

    //查询点赞
    function getraise_action(){
        if(session::get('ver') != 'corp'){
            echo '';
            exit;
        }
        if (session::get('username') ==""){
            echo '<div class="visual-inline-block content-fabulous"><i class="icon-like fabulous-btn" type="button" onclick="alert(\''.lang('please_log_in_first').'!\')" value="'.lang('point-like').'"></i></div>';
            exit;
        }
        if(front::get("aid")){
             $archive=archive::getInstance()->getrow("aid=".front::get("aid"));
             $data=getraise_data($archive['praise'],$archive['aid']);
             echo $data;
        }
        exit;
    }

    //查询收藏
    function getcollect_action(){
        if(session::get('ver') != 'corp'){
            echo '';
            exit;
        }
        if (session::get('username') ==""){
            echo '<div class="visual-inline-block content-fabulous"><i class="icon-like fabulous-btn" type="button" onclick="alert(\''.lang('please_log_in_first').'!\')" value="'.lang('point-like').'"></i></div>';
            exit;
        }
        if(front::get("aid")){
            $data=getcollect_data(front::get("aid"));
            echo $data;
        }
        exit;
    }

    public function delbuycar_action()
    {
        $id = intval($_POST['aid']);
        $oreders_c = cookie::get('ce_orders_cookie');
        $oreders_c = base64_decode($oreders_c);
        $oreders_c = xxtea_decrypt($oreders_c, config::getadmin('cookie_password'));
        if (preg_match('/(union|select|update|delete)/i', $oreders_c)) {
            alerterror(lang('illegal_character'));
        }
        $oreders_c = stripslashes(htmlspecialchars_decode($oreders_c));
        $aid = !empty($oreders_c) ? unserialize($oreders_c) : 0;
        if ($aid) {
            foreach ($aid as $key => $val) {
                if ($val['aid'] == $id) {
                    unset($aid[$key]);
                }
            }
            cookie::set('ce_orders_cookie', xxtea_encrypt(serialize($aid), config::getadmin('cookie_password')));
        }
        echo 'ok';
        exit;

    }

    private function sendmail($smtpemailto, $title, $mailbody)
    {
        include_once(ROOT . '/lib/plugins/smtp.php');
        $mailsubject = mb_convert_encoding($title, 'GB2312', 'UTF-8');
        $mailtype = "HTML";
        $smtp = new include_smtp(config::getadmin('smtp_mail_host'), config::getadmin('smtp_mail_port'), config::getadmin('smtp_mail_auth'), config::getadmin('smtp_mail_username'), config::getadmin('smtp_mail_password'));
        $smtp->debug = false;
        $smtp->sendmail($smtpemailto, config::getadmin('smtp_user_add'), $mailsubject, $mailbody, $mailtype);
    }

    //地图
    function sitemap_action(){

        $tpl=ROOT.'/sitemap/index.php';
        $tpltemplate='sitemap/index-'.lang::getistemplate().'.html';
        //优先访问静态
        if(file_exists(ROOT.'/'.$tpltemplate))
        {
            echo '<script>window.location.href ="/'.$tpltemplate.'";</script>';
            exit;
        }
        $this->render($tpl);
        exit;
    }

    function out($tpl,$cache=false,$path_cache="")
    {

        if (front::$debug)
            return;
        if ($cache){
            $content= $this->render($tpl,$cache);
            file_put_contents($path_cache, $content);
            $path_cache = dirname($path_cache) . '/index.html';
            if ($this->view->page==1 && $path_cache != ROOT . '/index.html') {
                file_put_contents($path_cache, $content);
            }
            $return_data=array("suc"=>1);
            echo json_encode($return_data);
            exit;
        }
        $this->render($tpl,$cache);
        $this->out = true;
        exit;
    }

    function test_action(){
        return $this->render('index/index.html',true);
        exit;
    }

    //检验用户
    function checkuser_action(){
        $retuen_data=array("static"=>1);
        $this->_user=new user();
        if (front::post("username")){
            $username=front::post("username");
            //用户名存在
            if ($this->_user->getrow(array('username' => $username))) {
                $retuen_data=array("static"=>0,"message"=>lang("user_name_already_registered"));
                echo  json_encode($retuen_data);
                exit;
            }
        }
        if (front::post("email")) {
            $email=front::post("email");
            //邮箱存在
            if ($this->_user->getrow(array('e_mail' => $email))) {
                $retuen_data = array("static" => 0, "message" => lang("user_mail_already_registered"));
                echo json_encode($retuen_data);
                exit;
            }
        }
        if (front::post("tel")) {
            $tel=front::post("tel");
            //手机号存在
            if ($this->_user->getrow(array('tel' => $tel))) {
                $retuen_data = array("static" => 0, "message" => lang("user_tel_already_registered"));
                echo json_encode($retuen_data);
                exit;
            }
        }
        echo  json_encode($retuen_data);
        exit;
    }

    //查询下拉框
    function getsearch_catid_action(){
        if (front::get("shopping")) {
            $data=category::getoptionshopping();
        }else{
            $data=category::getoptionconnent();
        }
        $select="";
        unset($data[0]);
        $is_select=true;
        foreach ($data as $k => $d) {
          /*  if (){
                $select .="<optgroup label='".$d."' style='font-family：'>";
                $select .=" </optgroup>";
            }else{*/
            $select .= "<option value=\"$k\"";
            if (front::get("catid") && $k == front::get("catid")) {
                $select .= ' selected ';
                $is_select=false;
            }
            elseif (front::get('this_catid')>0 && front::get('this_catid')==$k) {
                    $select .= ' disabled ';
            }
            elseif (isset($_GET['id']) && ($_GET['table'] == 'category' || $_GET['table'] == 'type')) {
                if ($_GET['id'] == $k) {
                    $select .= ' disabled ';
                }
            }
            $select .= ">$d</option>";


        }
        $select="<option value=\"0\" ".($is_select?"selected":"").">".lang_admin('please_choose')."...</option>".$select;
        echo $select;
        exit;
    }
    function getsearch_typeid_action(){
        //提取分类
        if(!file_exists(ROOT."/lib/table/type.php")) {
            return "";exit;
        }
        $data=type::getoption();
        unset($data[0]);
        $select="";
        $is_select=true;
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";
            if (front::get("typeid") && $k == front::get("typeid")) {
                $select .= ' selected ';
                $is_select=false;
            }
            elseif (isset($_GET['id']) && ($_GET['table'] == 'category' || $_GET['table'] == 'type')) {
                if ($_GET['id'] == $k) {
                    $select .= ' disabled ';
                }
            }
            $select .= ">$d</option>";
        }
        $select="<option value=\"0\" ".($is_select?"selected":"").">".lang_admin('please_choose')."...</option>".$select;

        echo $select;
        exit;
    }
    function getsearch_spid_action(){
        if (!file_exists(ROOT."/lib/table/special.php")){
            return "";
        }
        $data=special::getoption();
        $select="";
        $data[0]=lang_admin('please_choose')."...";
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";
            if (front::get("spid") && $k == front::get("spid")) {
                $select .= ' selected ';
            }
            elseif (isset($_GET['id']) && ($_GET['table'] == 'category' || $_GET['table'] == 'type')) {
                if ($_GET['id'] == $k) {
                    $select .= ' disabled ';
                }
            }
            $select .= ">$d</option>";
        }
        echo $select;
        exit;
    }
    function getsearch_userid_action(){
        $data=user::option();
        $select="";
        $data[0]=lang_admin('please_choose')."...";
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";
            if (isset($_GET['id']) && ($_GET['table'] == 'category' || $_GET['table'] == 'type')) {
                if ($_GET['id'] == $k) {
                    $select .= ' disabled ';
                }
            }
            $select .= ">$d</option>";
        }
        echo $select;
        exit;
    }
    function getleftlistform_action(){
        if (front::get("shopping")) {
            $data = category::catshoppingcategorydata();
        }else{
            $data =  category::catconnentcategorydata();
        }
        echo '<div class="table-responsive">';
        echo '<table class="table table-hover">';
        echo '<tbody id="listtable">';
        if(is_array($data))
            foreach($data as $d=>$dval) {
                if(get('manage_spid')){$lang=0;}else{$lang=$dval['level'];}
                echo '<tr onmouseover="m_over(this)" onmouseout="m_out(this)" lang="'.$lang.'" ';
                if(!get('manage_spid')){
                    if($dval['level']>0) {
                        echo'style="display:none" ';
                    }
                }
                echo '>';
                echo '<td class="catname">';
                if(get('manage_spid')){
                    echo '<a href="#"  onclick="gotourl(this)"  data-dataurl="'.url("table/list/table/archive/manage_spid/".$d,true).'" title="'.lang_admin('administration').'">';
                }else if(get('typeid')){
                    echo '<a href="#"  onclick="gotourl(this)"  data-dataurl="/index.php?case=table&act=list&table=archive&typeid='.$dval['typeid'].'&admin_dir='.get('admin_dir',true).'&site=default" title="'.lang_admin('administration').'">';
                }
                else if($dval['isshopping']){
                    echo '<a href="#"  onclick="gotourl(this)"  data-dataurl="/index.php?case=table&act=list&table=archive&shopping=1&catid='.$dval['catid'].'&admin_dir='.get('admin_dir',true).'&site=default" title="'.lang_admin('administration').'">';
                }else{
                    echo '<a href="#"  onclick="gotourl(this)"  data-dataurl="/index.php?case=table&act=list&table=archive&catid='.$dval['catid'].'&admin_dir='.get('admin_dir',true).'&site=default" title="'.lang_admin('administration').'">';
                }
                if(get('manage_spid')){
                    echo $dval;
                }elseif (get('typeid')){
                    echo $dval['typename'];
                }else{
                    echo $dval['catname'];
                }
                echo '</a>';
                if(!get('manage_spid') && ((get('typeid') && type::hasson($dval['typeid'])) || (!get('typeid') &&category::hasson($dval['catid'])) )) {
                    echo '<a onclick="child(this)" title="'.lang_admin('click_to_expand_and_close').'" class="child"></a>';
                }
                echo '<br>';
                echo '</td>';
                echo '</tr>';
            }
        echo '</tbody>';
        echo ' </table>';
        echo ' </div>';
        exit;
    }

    //查询内容 通过aid
    function getarcgivedata_action(){
        $retuen_data=array();
        if (!$this->view->user['userid']) {
            echo  json_encode(array("static"=>-1));
            exit;
        }
        if (front::get("aid")){
            $retuen_data=archive::getInstance()->getrow(array("aid"=>front::get("aid")));
            if (is_array($retuen_data)){
                //提取分类
                if(file_exists(ROOT."/lib/table/type.php")) {
                    $retuen_data['mode_typename'] = type::name($retuen_data['typeid']);
                }else{
                    $retuen_data['mode_typename'] = "";
                }
                $retuen_data['mode_catname']=category::name($retuen_data['catid']);
                //自定义字段 内页多图
                if (is_array($retuen_data) && !empty($retuen_data)) {
                    foreach ($retuen_data as $k => $v) {
                        if (preg_match('/^my_/is', $k) && setting::$var['archive'][$k]['filetype']=="pic") {
                            $retuen_data[$k] = unserialize($retuen_data[$k]);
                            $retuen_data[$k]=json_encode($retuen_data[$k]);
                        }
                    }
                }
                $retuen_data['pics'] = unserialize($retuen_data['pics']);
                $retuen_data['pics'] = json_encode( $retuen_data['pics']);
                cb_data($retuen_data);
                $retuen_data['static']=1;
            }
        }
        echo  json_encode($retuen_data);
        exit;
    }


    //判断登录 下载收费 返回下载
    function qkdomwnarchive_action(){
        $retuen_data=array("");
        if (!$this->view->user['userid']) {
            echo  json_encode(array("static"=>-1));
            exit;
        }
        if (front::get("aid")){
            $aid=front::get("aid");
            $archivedata=archive::getInstance()->getrow('aid='.$aid);
            if($archivedata['domwmenoy']>0){
                $userdata=user::getInstance()->getrow("username='".session::get('username')."'");
                $array = explode(",",$userdata['buyarchive']);
                //设置时间限制的时候
                $is_attachment_time=true;
                if (config::get("attachment_time")){
                    $attachment_time=intval(config::get("attachment_time"));
                    $xfconsumption = xfconsumption::getInstance()->getrow("xftype=4 and aid=".front::get('aid')." and mid=".user::getusersid()," adddate desc");
                    $old_time=date("Y-m-d", strtotime("+".$attachment_time." day", strtotime( $xfconsumption['adddate'])));
                    $this_data=date("Y-m-d");
                    if(strtotime($old_time)<strtotime($this_data)){
                        $is_attachment_time=false;
                    }
                }
                if(in_array($aid,$array) && $is_attachment_time){
                    //添加到记录表
                    if(file_exists(ROOT."/lib/table/downlogin.php")) {
                        if (isset($this->view->user['userid']) && $this->view->user['userid'] && front::get('aid')) {
                            $menoy=0;
                            $downlogin = array("aid" => front::get('aid'), "uid" => $this->view->user['userid'], "menoy" => $menoy, "adddate" => date('Y-m-d H:i:s'));
                            downlogin::getInstance()->rec_insert($downlogin);
                        }
                    }
                    $retuen_data['static']=1;
                    $retuen_data['url']=url('attachment/down/aid/'.front::get("aid"));
                }else{
                    $retuen_data['static']=0;
                    //折扣
                    $discount =usergroup::getusergrop(user::getuserid());
                    $retuen_data['domwmenoy']=(floatval($archivedata['domwmenoy']) * $discount/10);
                    $retuen_data['usermenoy']=floatval($userdata['menoy']);
                    $retuen_data['aid']=$aid;
                    $retuen_data['message']="";
                    $retuen_data['message_static']="1";
                    if ($retuen_data['usermenoy']<$retuen_data['domwmenoy']){
                        $retuen_data['message_static']="0";
                        $retuen_data['message']="积分不足,无法下载，请前往<a href=\"/index.php?case=archive&act=consumption\" target=\"_blank\">充值</a>！";
                    }
                }
            }else{
                //添加到记录表
                if(file_exists(ROOT."/lib/table/downlogin.php")) {
                    if (isset($this->view->user['userid']) && $this->view->user['userid'] && front::get('aid')) {
                        $menoy=0;
                        $downlogin = array("aid" => front::get('aid'), "uid" => $this->view->user['userid'], "menoy" => $menoy, "adddate" => date('Y-m-d H:i:s'));
                        downlogin::getInstance()->rec_insert($downlogin);
                    }
                }
                $retuen_data['static']=1;
                $retuen_data['url']=url('attachment/down/aid/'.front::get("aid"));
            }
        }
        echo  json_encode($retuen_data);
        exit;
    }



    function end($cache=false)
    {
        if (isset($this->out))
            return;
        if ($this->auto_end) {
            if (front::$debug)
                if ($cache)return $this->render('style/index.html',$cache); else $this->render('style/index.html',$cache);
            else
                if ($cache)return $this->render(null,$cache); else $this->render(null,$cache);

        }
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
