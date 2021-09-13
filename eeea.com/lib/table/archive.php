<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class archive extends table {
    static $me;

    function getcols($act) {
        switch ($act) {
            case 'list':
                return '*';
            case 'modify':
                return '*'.$this->mycols();
            case 'manage':
                return '*';
            case 'user_modify':
                return '*'.$this->mycols();
            case 'user_manage':
                return '*';
            default: return '1';
        }
    }
    function get_verify() {
        return array(
        );
    }
    function get_form() {
        $form_data=      array(
            'content' => array(
                'type' => 'mediumtext',
            ),
            'langid'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(lang::option()),
                'default'=>lang::getlangid(lang::getisadmin()),
            ),
            'title' => array(
                'placeholder' => lang_admin('fill_in_the_title_of_the_article_here'),
            ),
            'toppost'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(array(0=>lang_admin('not_set_the_top'),2=>lang_admin('column_top'),3=>lang_admin('set_the_top_of_the_whole_station'))),
                'default'=>0,
                'regex'=>'/\d+/',
                'filter'=>'is_numeric',
            ),
            'ishtml'=>array(
                'selecttype'=>'radio',
                'select'=>form::arraytoselect(array(0=>lang_admin('inherit'),1=>lang_admin('generate'),2=>lang_admin('no_generate'))),
            ),
            'isecoding'=>array(
                'selecttype'=>'radio',
                'select'=>form::arraytoselect(array(0=>lang_admin('inherit'),1=>lang_admin('lang_open'),2=>lang_admin('lang_no_open'))),
                'default'=>0,
            ),
            'checked'=>array(
                'selecttype'=>'radio',
                'default' => 1,
                'select'=>form::arraytoselect(form::yesornotoarray(lang_admin('to_examine'))),
            ),
            'image'=>array(
                'filetype'=>'image',
            ),
            'thumb'=>array(
                'filetype'=>'thumb',
            ),
            'displaypos'=>array(
                'selecttype'=>'checkbox',
                //'select'=>form::arraytoselect(array(1=>'首页推荐',2=>'首页焦点',3=>'首页头条',4=>'列表页推荐',5=>'内容页推荐')),
            ),
            'template'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(front::$view->archive_tpl_list('archive/show')),
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'templateshopping'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(front::$view->archive_shoppingtpl_list('archive/show')),
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'templatewap'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(front::$view->mobile_tpl_list('archive/show')),
                //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'showform'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(get_my_tables_list()),
                'default'=>"0",
            ),
            'introduce_len'=>array(
                'default'=>config::getadmin('archive_introducelen')
            ),
            'iscomment'=>array(
                'selecttype'=>'radio',
                'select'=>form::arraytoselect(array('1'=>lang_admin('lang_Allow'),'0'=>lang_admin('lang_no_Allow'))),
            ),
            'attr1'=>array(
                'selecttype'=>'checkbox',
                'select'=>form::arraytoselect($this->getattrs(1)),
            ),
            'grade'=>array(
                'selecttype'=>'radio',
                'select'=>form::arraytoselect(array(0,1,2,3,4,5)),
            ),
            'pics'=>array(
                'filetype'=>'image2',
            ),
            'author'=>array(
                'tips'=>' ',
            ),
            'attr3'=>array(
                'tips'=>' ',
            ),
            'htmlrule'=>array(
                'selecttype'=>'select',
                'select'=>form::arraytoselect(getHtmlRule('archive')),
                'default'=>'',
            ),
            'nofollow' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('enabling'), 0 => lang_admin('forbidden'))),
                'default' => '0',
            ),
            'product_video'=>array(
                'filetype'=>'video',
            ),
            'ecoding'=>array(
                'placeholder' => lang_admin('security_code_tips'),
            ),
        );
        //tag
        if(file_exists(ROOT."/lib/table/tag.php")) {
              $form_data['tag_option']=array(
                  'selecttype'=>'select',
                  'select'=>form::arraytoselect(tag::getadminTags()),
              );
        }
        return  $form_data;

    }
    function get_form_field() {
        $arr=array(0=>'全站使用');
        return array(
                'content' => array(
                'type' => 'mediumtext',
            ),
                'ishtml'=>array(
                        'selecttype'=>'radio',
                        'select'=>form::arraytoselect(array(0=>lang_admin('inherit'),1=>lang_admin('generate'),2=>lang_admin('no_generate'))),
                ),
                'checked'=>array(
                        'selecttype'=>'radio',
                        'default' => 1,
                        'select'=>form::arraytoselect(form::yesornotoarray(lang_admin('to_examine'))),
                ),
                'image'=>array(
                        'filetype'=>'image',
                ),
                'displaypos'=>array(
                        'selecttype'=>'checkbox',
                        'select'=>form::arraytoselect(array(1=>lang_admin('home_page_recommendation'),2=>lang_admin('home_page_focus'),
                                                            3=>lang_admin('home_page_headlines'),4=>lang_admin('list_page_recommendation'),5=>lang_admin('conent_page_recommendation'))),
                ),
                'htmlrule'=>array(
                        //'tips'=>" 默认：{?category::gethtmlrule(get('id'),'showhtmlrule')}",
                ),
                'template'=>array(
                        'selecttype'=>'select',
                        'select'=>form::arraytoselect(front::$view->archive_tpl_list()),
                        //'tips'=>" 默认：{?category::gettemplate(get('id'),'showtemplate')}",
                ),
                'introduce_len'=>array(
                        'default'=>config::getadmin('archive_introducelen'),
                ),
                'attr1'=>array(
                        'selecttype'=>'checkbox',
                        'select'=>form::arraytoselect($this->getattrs(1)),
                ),
                'author'=>array(
                        'tips'=>' ',
                ),
                'attr3'=>array(
                        'tips'=>' ',
                ),
                'video_path'=>array(
                    'filetype'=>'video',
                ),
                 'nofollow' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('enabling'), 0 => lang_admin('forbidden'))),
                'default' => '0',
            ),
        );
    }
    public function get_where($act) {
        switch ($act) {
            case 'list':
                return '';
            case 'manage':
                $where='aid>0';
                if (front::get('needcheck')) $where .=" and checked=0";
                return $where;
            case 'user_manage':
                $where='aid>0';
                if (front::get('needcheck') != ''){
                    $where .=" and checked=".front::get('needcheck');
                }else if(isset(front::$get['needcheck']) && front::get('needcheck') == 0){
                    $where .= " and checked=1";
                }

                return $where;
            default: return '0';
        }
    }
    public static function getInstance() {
        if (!self::$me) {
            $class = new archive();
            self::$me = $class;
        }
        return self::$me;
    }

    //$state为false的时候代表动态下的缓存路径
    static function url($info,$page=null,$lang='',$state=true) {
        //var_dump($info);exit;
        if (isset($info['linkto']) && $info['linkto']) return $info['linkto'];
        if ($lang==""){
            $lang=lang::getisadmin();
        }
        
        if(front::$ismobile == true){
        	if (config::getadmin('wap_html_prefix')){
        		$html_prefix='/'.trim(config::getadmin('wap_html_prefix'),'/');
        	}
        	if(front::$rewrite){
        		if (!$page){
        			return config::getadmin('site_url').'show-wap-'.$info['aid'].'-'.$lang.'.htm';
        		}else{
        			return config::getadmin('site_url').'show-wap-'.$info['aid'].'-'.$page.'-'.$lang.'.htm';
        		}
        	}
        	$type=category::getInstance();
        	if($info['iswaphtml'] == 2){
        		return url::create('archive/show/t/wap/aid/'.$info['aid'],false);
        	}
        	
        	if (!category::getarciswaphtml($info)){
        		if ($page){
        			return url::create('archive/show/t/wap/aid/'.$info['aid'].'/page/'.$page,false);
	        	}else{
	        		return url::create('archive/show/t/wap/aid/'.$info['aid'],false);
	        	}
        	}else {
        		if ($info['htmlrule']){
        			$rule=$info['htmlrule'];
        		}else{
        			$rule=category::gethtmlrule($info['catid'],'showhtmlrule');
        		}
                //自定义url
                if ($info['set_htmlrule']){
                    $rule_list=explode("/",$rule);
                    if (is_array($rule_list) && count($rule_list)>0){
                        $rule="";
                        $rule_list[count($rule_list)-1]=$info['set_htmlrule'];
                        foreach ($rule_list as $val){
                            if ($rule=="")
                                $rule=$val;
                            else
                                $rule.='/'.$val;
                        }

                    }
                }

        		$rule=str_replace('{$caturl}',$type->htmlpath($info['catid']),$rule);
        		$rule=str_replace('{$dir}',$type->category[$info['catid']]['htmldir'],$rule);
        		$rule=str_replace('{$catid}',$info['catid'],$rule);
        		$rule=str_replace('{$aid}',$info['aid'],$rule);
        		$rule=str_replace('{$lang}',$lang,$rule);

        		if ($page){
        			$rule=str_replace('{$page}',$page,$rule);
        		}else{
        			$rule=preg_replace('/\(.*?\)/','',$rule);
        			$rule=str_replace('-{$page}','',$rule);
        		}
        		$rule=preg_replace('/[\(\)]/','',$rule);
        		$rule=preg_replace('%[\\/]index\.htm1%','',$rule);
        		$rule=rtrim($rule,'/');
        		$rule=trim($rule,'\\');

                $base_url=view::get_base_url();
                if ($base_url!=""){
                    $path=$base_url.'/'.$html_prefix .'/'. $rule;
                }else{
                    $path=$html_prefix .'/'. $rule;
                }
        		return $path;
        	}
        }
        
        if (config::getadmin('html_prefix')){
            $html_prefix='/'.trim(config::getadmin('html_prefix'),'/');
        }
        $type = category::getInstance();
        if(isset($info['ishtml']) && $info['ishtml'] == 2 && $state){
        	return url::create('archive/show/aid/'.$info['aid'],false);
        }
        if ($state  && (!category::getarcishtml($info) || front::$isvalue  ||front::$rewrite )){
            if (!isset($info['aid'])) return "";
            if ($page){
                return url::create('archive/show/aid/'.$info['aid'].'/page/'.$page);
            }else{
                return url::create('archive/show/aid/'.$info['aid'],false);
            }
        }
        else {
            //var_dump($rule);
            if ($info['htmlrule']){
                $rule = $info['htmlrule'];
            }else{
                category::getInstance()->init();
                $rule = category::gethtmlrule($info['catid'],'showhtmlrule');
            }
            //自定义url
            if ($info['set_htmlrule']){
                $rule_list=explode("/",$rule);
                if (is_array($rule_list) && count($rule_list)>0){
                    $rule="";
                    $rule_list[count($rule_list)-1]=$info['set_htmlrule'];
                    foreach ($rule_list as $val){
                        if ($rule=="")
                             $rule=$val;
                        else
                            $rule.='/'.$val;
                    }

                }
            }

            $rule=str_replace('{$caturl}',$type->htmlpath($info['catid']),$rule);
            $rule=str_replace('{$dir}',$type->category[$info['catid']]['htmldir'],$rule);
            $rule=str_replace('{$catid}',$info['catid'],$rule);
            $rule=str_replace('{$aid}',$info['aid'],$rule);
            $rule=str_replace('{$lang}',$lang,$rule);
            //var_dump($rule);var_dump($page);exit;
            if ($page){
                $rule=str_replace('{$page}',$page,$rule);
            }else{
                $rule=preg_replace('/\(.*?\)/','',$rule);
                $rule=str_replace('-{$page}','',$rule);
            }
            $rule=preg_replace('/[\(\)]/','',$rule);
            $rule=preg_replace('%[\\/]index\.htm1%','',$rule);
            $rule=rtrim($rule,'/');
            $rule=trim($rule,'\\');


            $rule = str_replace('/1.html', '/', $rule);
            $base_url=view::get_base_url();
            if ($base_url!=""){
                $path=$base_url.$html_prefix .'/'. $rule;
            }else{
                $path=$html_prefix .'/'. $rule;
            }
            return $path;
        }
    }

    //url生成规则
    static  function  url_rule($path){
        $base_url=view::get_base_url();
        if ($base_url== '/') {
            $path = ROOT . substr($path, 1);
        } else {
            $path = ROOT . str_replace($base_url, '', $path);
        }
        if (strpos($path,'.html') == false){
            $path.="1.html";
        }
        if (!preg_match('/\.[a-zA-Z]+$/', $path))
            $path = rtrim(rtrim($path, '/'), '\\') . '/index.html';
        $path = rtrim($path, '/');
        $path = rtrim($path, '\\');
        $path = str_replace('//', '/', $path);
        return $path;
    }

    static function countarchiveformtype($catid) {
        $arc=archive::getInstance();
        return $arc->rec_count('typeid='.$catid);
    }
    static function countarchiveformcategory($catid) {
        $arc=archive::getInstance();
        return $arc->rec_count('catid='.$catid);
    }
    function getattrs($att_order=1) {
        $attr='attr'.$att_order;
        $sets=settings::getInstance()->getrow(array('tag'=>'table-archive'));
        if (!is_array($sets)) return;
        $data=unserialize($sets['value']);
        $newattr='attr1_'.lang::getisadmin();
        $data['attr1']=$data[$newattr];

        preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%m',$data[$attr],$result,PREG_SET_ORDER);
        $data=array();
        foreach ($result as $res)
            $data[$res[1]]=$res[2];
        return $data;
    }

	function getcids($aid){
        //$cat = category::getInstance();
        $cid = $this->getrow(array('aid'=>$aid),'1 desc','catid');
        return $cid['catid'];
    }

    static function getarchivename($aid){
        $archive = new archive();
        $cid = $archive->getrow(array('aid'=>$aid),'1 desc','title');
        return $cid['title'];
    }

    //查询内容
    static function getarchive($aid){
        $archive = new archive();
        $cid = $archive->getrows("aid='".$aid."'", 1);
        return isset($cid[0])?$cid[0]:"";
    }

   /* function getrows($condition = '', $limit = 1, $order = '1 desc', $cols = '*')
    {

        $archive_all_file = ROOT . '/cache/'.lang::getistemplate().'/data/archive_all.php';
        if (file_exists($archive_all_file)){
            $archive_all_data = include $archive_all_file;
        }else{
            $archive_all_data=table::getrows($condition,$limit,$order,$cols);
            $data='<?php return ' . var_export($archive_all_data, true) . ';';
            $f = fopen($archive_all_file,'w');
            fwrite($f,$data);
            fclose($f);
        }
        return $archive_all_data;
    }*/

    //查询内容所在栏目id
    static function getarchivecategory($aid){
        $archive = new archive();
        $aiddata = $archive->getrow("aid='".$aid."'", 1);
        return $aiddata['catid'];
    }

    //查询内容标题
    static function getarchivetitle($aid){
        $archive = new archive();
        $cid = $archive->getrows("aid='".$aid."'", 1);
        if (is_array($cid) && isset($cid[0]['title'])){
            return $cid[0]['title'];
        }else{
            return '';
        }
    }

    static function getgrade($grade) {
        $count=5;
        $path=view::get_base_url().'/';
        $star1="<span class='glyphicon glyphicon-star'></span>";
        $star2="<span class='glyphicon glyphicon-star-empty'></span>";
        $str="";
        for ($i=0;$i <$count;$i++) {
            if ($i <$grade) {
                $str .= $star1;
            }
            else {
                $str .= $star2;
            }
        }
        return $str;
    }

    //点赞增删
    static function setpraise($aid){
        $archive = new archive();
        $archivedata= $archive->getrows("aid='".$aid."'", 1);
        if (isset($archivedata[0]['praise']))
            $archivepraise= $archivedata[0]['praise'];
        $messagelist= array();
        $messagelist[0]='1';
        if($archivepraise !=''){
            $iscz=false;
            $source = explode(",",trim($archivepraise));
            for($index=0;$index<count($source);$index++){
                $praise = explode(':',$source[$index]);
                if($praise[0] == session::get('username')) {
                    $iscz=true;
                }
            }
            if($iscz){
                $source = explode(",",trim($archivepraise));
                $archivepraise='';  //先清空
                for($index=0;$index<count($source);$index++){
                    $praise = explode(':',$source[$index]);
                    if($praise[0] !=session::get('username')) {
                        $archivepraise=$archivepraise.','.$source[$index];
                    }
                }
                if( strpos($archivepraise, ',') !== false){
                    $archivepraise = substr($archivepraise,1,strlen($archivepraise));
                }
                $messagelist[0]='0';
            }else{
                $archivepraise=$archivepraise.','.session::get('username').':'.time();
            }
        }else{
            $archivepraise=session::get('username').':'.time();
        }

        //修改用户的收藏
        if($archivepraise==''){
            $messagelist[1]='0';
        }else{
            if( strpos($archivepraise, ',') !== false){
                $source = explode(",",trim($archivepraise));
                $messagelist[1]=count($source);
            }else{
                $messagelist[1]='1';
            }
        }
        $setarchivedata = array('praise' => $archivepraise);
        $archive->rec_update($setarchivedata, "aid='".$aid."'");

        return $messagelist;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.