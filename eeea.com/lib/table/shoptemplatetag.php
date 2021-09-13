<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class shoptemplatetag
{
    static $me;
    static $setting = array();
    static $adminsetting = array();
    static $fields =
        array(
            0 =>
                array(
                    'Field' => 'id',
                    'Type' => 'int(11)',
                    'Null' => 'NO',
                    'Key' => 'PRI',
                    'Default' => NULL,
                    'Extra' => 'auto_increment',
                ),
            1 =>
                array(
                    'Field' => 'name',
                    'Type' => 'varchar(100)',
                    'Null' => 'NO',
                    'Key' => 'UNI',
                    'Default' => NULL,
                    'Extra' => '',
                ),
            2 =>
                array(
                    'Field' => 'tagmodule',
                    'Type' => 'varchar(32)',
                    'Null' => 'YES',
                    'Key' => '',
                    'Default' => NULL,
                    'Extra' => '',
                ),
            4 =>
                array(
                    'Field' => 'tagcontent',
                    'Type' => 'text',
                    'Null' => 'NO',
                    'Key' => '',
                    'Default' => NULL,
                    'Extra' => '',
                ),
            6 =>
                array(
                    'Field' => 'note',
                    'Type' => 'text',
                    'Null' => 'YES',
                    'Key' => '',
                    'Default' => NULL,
                    'Extra' => '',
                ),
            7 =>
                array(
                    'Field' => 'tagfrom',
                    'Type' => 'varchar(16)',
                    'Null' => 'YES',
                    'Key' => '',
                    'Default' => 'define',
                    'Extra' => '',
                ),
            8 =>
                array(
                    'Field' => 'tagtype',
                    'Type' => 'varchar(20)',
                    'Null' => 'YES',
                    'Key' => '',
                    'Default' => '',
                    'Extra' => '',
                ),
        );

    public function __construct()
    {
        //提取分类
        if(file_exists(ROOT."/lib/table/shopping.php")) {
            $setting_file = self::getfilename();
            @mkdir(dirname($setting_file));
            if (!file_exists($setting_file))
                file_put_contents(iconv("utf-8", "gbk",$setting_file), '<?php return array();');
            else
                self::$setting = include $setting_file;


            $settingadmin_file = self::getadminfilename();
            @mkdir(dirname($settingadmin_file));
            if (!file_exists($settingadmin_file))
                file_put_contents(iconv("utf-8", "gbk",$settingadmin_file), '<?php return array();');
            else
                self::$adminsetting = include $settingadmin_file;
        }else{
            self::$setting = array();
            self::$adminsetting = array();
        }


    }

    public function getfilename()
    {
        $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/data/templatetag_'.lang::getistemplate().'.php';
        //判断模板标签文件是否存在！不存在则创建
        if (!file_exists($path)){
            mkdir ($path,0777,true);
            echo lang_admin('file_created_successfully');
        }
        return $path;
    }

    public function getadminfilename()
    {
        $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/data/templatetag_'.lang::getisadmin().'.php';
        //判断模板标签文件是否存在！不存在则创建
        if (!file_exists($path)){
            mkdir ($path,0777,true);
            echo lang_admin('file_created_successfully');
        }
        return $path;

    }

    public function savesetting()
    {
        if (empty(self::$adminsetting))
            return;
        $settingadmin_file = self::getadminfilename();
        file_put_contents(iconv("utf-8", "gbk",$settingadmin_file), '<?php return ' . var_export(self::$adminsetting, true) . ';');
    }

    public function xCopy($source, $destination, $child = 1){
        //用法：
        // xCopy("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录
        // xCopy("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录
        //参数说明：
        // $source:源目录名
        // $destination:目的目录名
        // $child:复制时，是不是包含的子目录
        if(!is_dir($source)){
            echo("Error:the $source is not a direction!");
            return 0;
        }

        if(!is_dir($destination)){
            mkdir($destination,0777);
        }

        $handle=dir($source);
        while($entry=$handle->read()) {
            if(($entry!=".")&&($entry!="..")){
                if(is_dir($source."/".$entry)){
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
    //获取组件地址
    public static function getmodulesfilename($modulestype,$modules,$isbuy)
    {
        if ($isbuy){
            $oldpath=ROOT . '/data/buymodules/'.$modulestype.'/'.$modules;
            //判断文件是否存在！不存在则创建
            if (!file_exists($oldpath.'/'.$modules.'.config.php')){
                @fopen($oldpath.'/'.$modules.'.config.php', "w");
            }
            $newpath=ROOT.'/template/'.config::get('template_shopping_dir').'/visual/buymodules/'.$modulestype.'/'.$modules;
            tool::mkdir(dirname($newpath));
            $path=$newpath.'/'.$modules.'.config.php';

            //判断文件是否存在！不存在则创建
            if (!file_exists($path)){
                self::xCopy($oldpath,$newpath,1);
            }
            return $path;
        }
        else
            $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$modules.'.config.php';
        //判断文件是否存在！不存在则创建
        if (!file_exists($path)){
            if (!file_exists( $path )) {@fopen($path, "w");}
            echo lang_admin('file_created_successfully');
        }
        return $path;

    }
    //获取组件语言包地址
    public static function getlangfilename($modulestype,$modules,$isbuy,$lang="")
    {
        if ($isbuy){
            //$path=ROOT . '/data/buymodules/'.$modulestype.'/'.$modules.'/lang/'.$lang.'/system_modules.php';
            $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/buymodules/'.$modulestype.'/'.$modules.'/lang/'.$lang.'/system_modules.php';
        }
        else
            $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/lang/'.$lang.'/system_modules.php';
        //判断文件是否存在！不存在则创建
        if (!file_exists( $path )) {
            @fopen($path, "w");
            file_put_contents($path, "<?php return  array(  'ces'=>'测试',); ?>");
        }
        return $path;

    }
    //获取组件loop地址
    public static function getmodulespath($tagid,$modulestype,$modules,$isbuy)
    {
        if ($isbuy){
            //$path=ROOT . '/data/buymodules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';
            $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';
        }
        else
            $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';
        //判断文件是否存在！不存在则创建
        if (!file_exists($path)){
            @mkdir(dirname($path));
           // echo lang_admin('file_created_successfully');
        }
        return $path;

    }
    //获取组件配置
    static function getmodulesrow($tagid,$modulestype,$modules,$isbuy,$lang="")
    {
        $modulessetting=array();
        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(iconv("utf-8", "gbk",$settingTemplate_file), '<?php return array();');
        $modulessetting = include $settingTemplate_file;

        foreach ($modulessetting as $key=>$set) {
            if ($lang && isset($set[$lang]) && is_array($set[$lang]))$set=$set[$lang];
            if ($set['id'] == $tagid) {
                $set['custom']=$modulessetting[$key]['custom'];
                if (!$lang)
                    return $modulessetting[$key];
                else
                    return $set;
            }
        }
        return array();
    }
    //修改组件配置
    public function rec_modulesupdate($tag_info, $tagid,$modulestype,$modules,$isbuy)
    {
        if (!$tagid)
            return false;

        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(iconv("utf-8", "gbk",$settingTemplate_file), '<?php return array();');
        $modulessetting = include $settingTemplate_file;
        $setting = array();
        foreach ($modulessetting as $order => $set) {
            if (is_array($set[lang::getisadmin()]))$set=$set[lang::getisadmin()];
            if ($set['id'] == $tagid) {
                foreach ($tag_info as $key => $tag) {
                    if (!in_array($key, explode(',', $this->getcols()))) {
                        unset($tag_info[$key]);
                        $setting[$key] = $tag;
                    }
                }
                if($set['default'])$tag_info['default']=true;else $tag_info['default']=false;
                $setting['tagfrom']=get('tagfrom');
                $setting['title']=$set['title'];
                $setting['defaultDemo']=isset($set['defaultDemo'])?$set['defaultDemo']:"";
                $modulessetting[$order]['custom']=$setting['custom'];
                unset($setting['custom']);
                if ($setting['tagfrom']!="shopcommoncss")
                $modulessetting[$order][lang::getisadmin()] = array_merge(array('id' => $tagid), $tag_info, $setting);
                $this->savemodulessetting($modulessetting,$settingTemplate_file);
                return true;
            }
        }
        return false;
    }
    //保存组件 配置
    public function savemodulessetting($modulessetting,$settingTemplate_file)
    {
        if (empty($modulessetting))
            return;
        $data='<?php return ' . var_export($modulessetting, true) . ';';
        $f = fopen($settingTemplate_file,'w');
        fwrite($f,$data);
        fclose($f);
        ini_set('opcache.revalidate_freq',0);  //清空缓存时间  阿里云缓存无法修改  只能手动修改

    }
    //显示组件
    static function tagmodulesadmin($modulesname)
    {

        preg_match('/^{tag_(.*?)}$/', $modulesname, $out);
        $str=explode("_",$out[1]);//0 buymodules 1shop 2 category 3 (全局)  4组件名称 5 配置id
        $tag = self::getInstance()->getmodulesrow($str[5],$str[3],$str[4],$str[0]=="buymodules"?true:false,lang::getisadmin());

        load_sections_lang(self::getlangfilename($str[3],$str[4],$str[0]=="buymodules"?true:false,lang::getisadmin()));
        //var_dump($tag);
        if (is_array($tag)) {
            $content = isset($tag['tagcontent'])?$tag['tagcontent']:"";
            if ($tag['tagfrom'] == 'category' || $tag['tagfrom'] == 'content'
                || $tag['tagfrom'] == 'shopcategory' || $tag['tagfrom'] == 'shopcontent'
                || $tag['tagfrom'] == 'type'|| $tag['tagfrom'] == 'shoptype'
                || $tag['tagfrom'] == 'special'|| $tag['tagfrom'] == 'shopspecial'
                || $tag['tagfrom'] == 'shopcontent' || $tag['tagfrom'] == 'shopcategory'
                || $tag['tagfrom'] == 'announcement'|| $tag['tagfrom'] == 'commoncss'
                || $tag['tagfrom'] == 'shopannouncement'|| $tag['tagfrom'] == 'shopcommoncss' ){
               if(isset($tag['catid']) && is_numeric($tag['catid'])){
                  $categorydome=category::getInstance()->getrow("catid=".$tag['catid'].' and langid='.lang::getlangid(lang::getisadmin()));
               }else{
                   $categorydome="";
               }
                if (!is_array($categorydome) && $tag['tagfrom'] != 'shopcommoncss' && is_numeric($tag['catid'])){
                    $content = file_get_contents(self::getmodulespath($tag['defaultDemo'],$str[2],$str[3],$str[0]=="buymodules"?true:false));
                }else
                $content = self::getmoduleslisttagcontent($tag,$str[3],$str[4],$str[0]=="buymodules"?true:false);

            }

            $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);

            $content=front::$view->compile($content);
            if ($str[0]=="buymodules"){
                $path=ROOT . '/cache/template/buymodules/'.$str[3].'/'.$str[4];
            }else{
                $path=ROOT . '/cache/template/' .config::get('template_dir'). '/modules/'.$str[3].'/'.$str[4];
            }
            $cacheFile=$path.'/#'.$str[5].'.php';
            if (file_exists($cacheFile)){
                unlink($cacheFile);
            };
            if (!file_exists($cacheFile)){
                if (!file_exists( $path )) {mkdir ($path,0777,true );}
                file_put_contents(iconv("utf-8", "gbk",$cacheFile), $content);
            }
            $content=front::$view->_eval($cacheFile);
            unlink($cacheFile);
            return  $content;
        }
    }
    //加载组件内容
    public static function getmoduleslisttagcontent($tag,$modulestype,$modules,$isbuy)
    {
        $path = self::getmodulespath($tag['id'],$modulestype,$modules,$isbuy);
        //写缓存
        if (front::$isvalue){
            $sesssion_name="visual_modules_shop_content_".$modules.'_'.$modulestype.'_'.$tag['id'];
        }else{
            $sesssion_name="modules_shop_content_".$modules.'_'.$modulestype.'_'.$tag['id'];
        }

        if (session::get($sesssion_name)!=""){
            $tag_tpl_content=session::get($sesssion_name);
        }else{
            $tag_tpl_content=front::$view->_eval($path,true);
            session::set($sesssion_name,$tag_tpl_content);
        }
        $tag_tpl_content=front::$view->_eval($path,true);
        if ($tag['tagfrom'] == 'shopcontent') {
            $tag['area'] = "'0,0,0'";
            if ($tag['thumb']=='1' || $tag['thumb']=='on') {
                $tag['thumb'] = 'true';
            } else {
                $tag['thumb'] = 'false';
            }

            foreach ($tag as $key => $value) {
                if (empty($value))
                    $tag[$key] = '0';
                else if (is_array($value))
                    $tag[$key] =  $value;
                else if ($key <> 'area' && $value != 'false' && $value != 'true' && !is_numeric($value))
                    $tag[$key] = "'$value'";
            }
            if (!isset($tag['titlenum']) || $tag['titlenum'] == ''){
                $tag['titlenum']=0;
            }
            if (!isset($tag['textnum']) || $tag['textnum'] == ''){
                $tag['textnum']= 0;
            }
            if (strstr($tag['catid'],'$catid')){
                if (front::get('catid')){
                    $tag['catid']=front::get('catid');
                }
                else  if (front::get('aid')){
                    if (front::get('case')=="proxy")
                        $tag['catid']=servicearchive::getarchivecategory(front::get('aid'));
                    else
                        $tag['catid']=archive::getarchivecategory(front::get('aid'));
                }

            }
            $patterns[0] = '/\$_catid/';
            $patterns[1] = '/\$_typeid/';
            $patterns[2] = '/\$_spid/';
            $patterns[3] = '/\$_area/';
            $patterns[4] = '/\$_length/';
            $patterns[5] = '/\$_ordertype/';
            $patterns[6] = '/\$_limit/';
            $patterns[7] = '/\$_image/';
            $patterns[8] = '/\$_attr1/';
            $patterns[9] = '/\$_son/';
            $patterns[10] = '/\$_wheretype/';
            $patterns[11] = '/\$_tpl/';
            $patterns[12] = '/\$_intro_len/';
            $patterns[13] = '/\$_istop/';
            $patterns[14] = '/\$_textnum/';
            $patterns[15] = '/\$_titlenum/';
            $patterns[16] = '/\$_components-link-color/';
            $patterns[17] = '/\$_components-link-hover-color/';
            $patterns[18] = '/\$_id/';
            if($tag['catid']){
                $patterns[] = '/\$_topid/';
            }
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $patterns[] = '/\$_'.$key.'_name/';
                    $patterns[] = '/\$_'.$key.'/';
                }
            }
            $replacements[0] = $tag['catid'];
            $tag['typeid']=(isset($tag['typeid']) && $tag['typeid'])?$tag['typeid']:0;
            $replacements[1] = $tag['typeid'];
            $tag['spid']=(isset($tag['spid']) && $tag['spid'])?$tag['spid']:0;
            $replacements[2] = $tag['spid'];
            $replacements[3] = $tag['area'];
            $replacements[4] = $tag['length'];
            $replacements[5] = $tag['ordertype']?$tag['ordertype']:'\'aid\'';
            $replacements[6] = $tag['limit'];
            $replacements[7] = $tag['thumb'];
            $replacements[8] = $tag['attr1']?$tag['attr1']:'\'\'';
            $replacements[9] = $tag['son'];
            $replacements[10] = (isset($tag['wheretype']) && $tag['wheretype']) ? $tag['wheretype'] : '\'\'';
            $replacements[11] = (isset($tag['tpl']) && $tag['tpl'])? $tag['tpl'] : '\'\'';
            $replacements[12] = $tag['introduce_length'];
            $replacements[13] = (int)$tag['istop'];
            $replacements[14] =isset( $tag['textnum'])? $tag['textnum']:"''";
            $replacements[15] = isset( $tag['titlenum'])? $tag['titlenum']:"''";
            $tag['components-link-color']=isset($tag['components-link-color'])?$tag['components-link-color']:"";
            $replacements[16] = str_replace('\'','', $tag['components-link-color']);
            $tag['components-link-hover-color']=isset($tag['components-link-hover-color'])?$tag['components-link-hover-color']:"";
            $replacements[17] = str_replace('\'','', $tag['components-link-hover-color']);
            $replacements[18] = $tag['id'];
            if($tag['catid']){
                $replacements[] =category::getInstance()->getparent($tag['catid']);
            }
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $replacements[] = $key;
                    $replacements[] = $val['value'];
                }
            }

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shopcategory') {
            if (isset($tag['catname']) && $tag['catname'] == 'on') {
                $tag['catname'] = '{$cat[catname]}';
            } else {
                $tag['catname'] = '';
            }
            if (isset($tag['categorycontent']) && $tag['categorycontent'] == 'on') {
                $tag['categorycontent'] = '{$cat[categorycontent]}';
            } else {
                $tag['categorycontent'] = '';
            }
            if (isset($tag['catimage']) && $tag['catimage'] == 'on') {
                $tag['catimage'] = '{$cat[image]}';
            } else {
                $tag['catimage'] = '';
            }
            if (isset($tag['subcat']) && $tag['subcat'] == 'on') {
                $tag['subcat'] = '<!--子栏目开始-->
  {loop categories($cat[catid]) $cat}
    {lang_admin("column")}{lang_admin("name")}：{$cat[catname]}
    {lang_admin("news_coverage")}：{$cat[categorycontent]}
    {lang_admin("column_pictures")}：{$cat[image]}
    <a href="{$cat[url]}">{$cat[catname]}</a>
  {/loop}
  <!--子栏目结束-->';
            } else {
                $tag['subcat'] = '';
            }
            if (strstr($tag['catid'],'$catid')){
                if (front::get('catid')){
                    $tag['catid']=front::get('catid');
                }
                else  if (front::get('aid')){
                    if (front::get('case')=="proxy")
                        $tag['catid']=servicearchive::getarchivecategory(front::get('aid'));
                    else
                        $tag['catid']=archive::getarchivecategory(front::get('aid'));
                }

            }
            if (isset($tag['titlenum']) && $tag['titlenum'] == ''){
                $tag['titlenum']=0;
            }
            if (isset($tag['textnum']) && $tag['textnum'] == ''){
                $tag['textnum']=0;
            }

            $patterns[0] = '/\$_catid/';
            $patterns[1] = '/\$_subcat/';
            $patterns[2] = '/\$_catname/';
            $patterns[3] = '/\$_categorycontent/';
            $patterns[4] = '/\$_image/';
            $patterns[5] = '/\$_son/';
            $patterns[6] = '/\$_textnum/';
            $patterns[7] = '/\$_titlenum/';
            $patterns[8] = '/\$_components-link-color/';
            $patterns[9] = '/\$_components-link-hover-color/';
            $patterns[10] = '/\$_id/';
            if($tag['catid']){
                $patterns[] = '/\$_topid/';
            }
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $patterns[] = '/\$_'.$key.'_name/';
                    $patterns[] = '/\$_'.$key.'/';
                }
            }
            $replacements[0] = $tag['catid'];
            $replacements[1] = $tag['subcat'];
            $replacements[2] = $tag['catname'];
            $replacements[3] = $tag['categorycontent'];
            $replacements[4] = $tag['catimage'];
            $replacements[5] =isset($tag['son'])?$tag['son']:"";
            $replacements[6] = isset($tag['textnum'])?$tag['textnum']:"''";
            $replacements[7] = isset($tag['titlenum'])?$tag['titlenum']:"''";
            $tag['components-link-color']=isset($tag['components-link-color'])?$tag['components-link-color']:"";
            $tag['components-link-hover-color']=isset($tag['components-link-hover-color'])?$tag['components-link-hover-color']:"";
            $replacements[8] = str_replace('\'','', $tag['components-link-color']);
            $replacements[9] = str_replace('\'','', $tag['components-link-hover-color']);
            $replacements[10] = $tag['id'];
            if($tag['catid']){
                $replacements[] =category::getInstance()->getparent($tag['catid']);
            }
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $replacements[] = $key;
                    $replacements[] = $val['value'];
                }
            }
            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shopspecial') {
            if (strstr($tag['spid'],'$spid')){
                if (front::get('spid')){
                    $tag['spid']=front::get('spid');
                }
            }
            $patterns[] = '/\$_spid/';
            $patterns[] = '/\$_spname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_spcontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_spimage/';
            $patterns[] = '/\$_components-link-color/';
            $patterns[] = '/\$_components-link-hover-color/';
            $patterns[] = '/\$_titlenum/';
            $patterns[] = '/\$_textnum/';
            $patterns[] = '/\$_id/';
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $patterns[] = '/\$_'.$key.'_name/';
                    $patterns[] = '/\$_'.$key.'/';
                }
            }
            $tag['spid']=(isset($tag['spid']) && $tag['spid'])?$tag['spid']:0;
            $replacements[] = $tag['spid'];
            $tag['spname']=isset($tag['spname'])?$tag['spname']:"";
            $replacements[] = (int)$tag['spname'];
            $tag['subtitle']=isset($tag['subtitle'])?$tag['subtitle']:"";
            $replacements[] = (int)$tag['subtitle'];
            $tag['spcontent']=isset($tag['spcontent'])?$tag['spcontent']:"";
            $replacements[] = (int)$tag['spcontent'];
            $tag['len']=isset($tag['len'])?$tag['len']:"";
            $replacements[] = (int)$tag['len'];
            $tag['spimage']=isset($tag['spimage'])?$tag['spimage']:"";
            $replacements[] = (int)$tag['spimage'];
            $tag['components-link-color']=isset($tag['components-link-color'])?$tag['components-link-color']:"";
            $replacements[] = str_replace('\'','', $tag['components-link-color']);
            $tag['components-link-hover-color']=isset($tag['components-link-hover-color'])?$tag['components-link-hover-color']:"";
            $replacements[] = str_replace('\'','', $tag['components-link-hover-color']);
            $tag['titlenum']=isset($tag['titlenum'])?$tag['titlenum']:"''";
            $replacements[] = (int)$tag['titlenum'];
            $tag['textnum']=isset($tag['textnum'])?$tag['textnum']:"''";
            $replacements[] = (int)$tag['textnum'];
            $replacements[] = $tag['id'];
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $replacements[] = $key;
                    $replacements[] = $val['value'];
                }
            }
            //var_dump($replacements);

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shoptype') {
            if (strstr($tag['typeid'],'$typeid')){
                if (front::get('typeid')){
                    $tag['typeid']=front::get('typeid');
                }
            }
            $patterns[] = '/\$_typeid/';
            $patterns[] = '/\$_tyname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_tycontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_tyimage/';
            $patterns[] = '/\$_components-link-color/';
            $patterns[] = '/\$_components-link-hover-color/';
            $patterns[] = '/\$_titlenum/';
            $patterns[] = '/\$_textnum/';
            $patterns[] = '/\$_id/';
            if($tag['typeid']){
                $patterns[] = '/\$_toptypeid/';
            }
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $patterns[] = '/\$_'.$key.'_name/';
                    $patterns[] = '/\$_'.$key.'/';
                }
            }
            $tag['typeid']=(isset($tag['typeid']) && $tag['typeid'])?$tag['typeid']:0;
            $replacements[] = $tag['typeid'];
            $tag['tyname']=isset($tag['tyname'])?$tag['tyname']:"";
            $replacements[] = (int)$tag['tyname'];
            $tag['subtitle']=isset($tag['subtitle'])?$tag['subtitle']:"";
            $replacements[] = (int)$tag['subtitle'];
            $tag['tycontent']=isset($tag['tycontent'])?$tag['tycontent']:"";
            $replacements[] = (int)$tag['tycontent'];
            $tag['len']=isset($tag['len'])?$tag['len']:"";
            $replacements[] = (int)$tag['len'];
            $tag['tyimage']=isset($tag['tyimage'])?$tag['tyimage']:"";
            $replacements[] = (int)$tag['tyimage'];
            $tag['components-link-color']=isset($tag['components-link-color'])?$tag['components-link-color']:"";
            $replacements[] = str_replace('\'','', $tag['components-link-color']);
            $tag['components-link-hover-color']=isset($tag['components-link-hover-color'])?$tag['components-link-hover-color']:"";
            $replacements[] = str_replace('\'','', $tag['components-link-hover-color']);
            $tag['titlenum']=isset($tag['titlenum'])?$tag['titlenum']:"''";
            $replacements[] = (int)$tag['titlenum'];
            $tag['textnum']=isset($tag['textnum'])?$tag['textnum']:"''";
            $replacements[] = (int)$tag['textnum'];
            $replacements[] = $tag['id'];
            if($tag['typeid']){
                $replacements[] =type::getInstance()->getparent($tag['typeid']);
            }
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $replacements[] = $key;
                    $replacements[] = $val['value'];
                }
            }

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shopannouncement') {


            $patterns[] = '/\$_typeid/';
            $patterns[] = '/\$_tyname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_tycontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_tyimage/';
            $patterns[] = '/\$_components-link-color/';
            $patterns[] = '/\$_components-link-hover-color/';
            $patterns[] = '/\$_id/';
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $patterns[] = '/\$_'.$key.'_name/';
                    $patterns[] = '/\$_'.$key.'/';
                }
            }
            $tag['typeid']=(isset($tag['typeid']) && $tag['typeid'])?$tag['typeid']:0;
            $replacements[] = $tag['typeid'];
            $replacements[] = (int)$tag['tyname'];
            $replacements[] = (int)$tag['subtitle'];
            $replacements[] = (int)$tag['tycontent'];
            $replacements[] = (int)$tag['len'];
            $replacements[] = (int)$tag['tyimage'];
            $replacements[] = str_replace('\'','', $tag['components-link-color']);
            $replacements[] = str_replace('\'','', $tag['components-link-hover-color']);
            $replacements[] = $tag['id'];
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $replacements[] = $key;
                    $replacements[] = $val['value'];
                }
            }

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shopcommoncss') {
            $patterns=array();
            $replacements=array();
            $patterns[] = '/\$_id/';
            $replacements[] = $tag['id'];
            //加载自定义配置
            if (is_array($tag['custom'])){
                foreach ($tag['custom'] as $key=>$val){
                    $patterns[] = '/\$_'.$key.'_name/';
                    $patterns[] = '/\$_'.$key.'/';
                    $replacements[] = $key;
                    $replacements[] = $val['value'];
                }
                $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            }
            $content = $tag_tpl_content;
        }
        return $content;
    }
    //页面加载组件   未购买
    static function tagmodules($modulesname,$lang=true,$html_js=false)
    {
       /* if (!$html_js){
            $content="<div name='cmseasy_shop_".$modulesname."'>";
            $url=url('templatetag/shop_tagmodules',false);
            if (get('catid')){
                $url.="&catid=".get('catid');
            }
            elseif (get('spid')){
                $url.="&spid=".get('spid');
            }
            elseif (get('typeid')){
                $url.="&typeid=".get('typeid');
            }
            elseif (get('aid')){
                $url.="&aid=".get('aid');
            }
            if (get('page')){
                $url.="&page=".get('page');
            }
            $content.='<script>
                       $(function () {
                          $.ajax({
                                type: "post",
                                url: "'.$url.'",
                                data: {"modulesname":"'.$modulesname.'","lang":'.$lang.'},
                                async: true,
                                success: function (data) {
                                    $("[name=cmseasy_shop_'.$modulesname.']").after(data); 
                                    $("[name=cmseasy_shop_'.$modulesname.']").remove();
                                }
                           });
                        });
                        </script>';
            $content.="</div>";
            //涉及到及时模块 所以先生成一波了
            shoptemplatetag::tagmodules($modulesname,$lang,true);
            return $content;
        }
        else{*/
            if ($lang)$lang=lang::getistemplate(); else $lang=lang::getisadmin();
            $str=explode("_",$modulesname);//0category 1 (全局)  2 组件名称 3 配置id
            $tag = self::getInstance()->getmodulesrow($str[3],$str[1],$str[2],false,$lang);
            load_sections_lang(self::getlangfilename($str[1],$str[2],false,$lang));
            //var_dump($tag);
            if (is_array($tag)) {
                $path = ROOT . '/cache/template/' . config::get('template_shopping_dir') . '/modules/' . $str[1] . '/' . $str[2];
                $config_path=self::getmodulesfilename($str[1],$str[2],false);
                $cacheFile=$path.'/#'.$str[3].'.php';
                if(file_exists($cacheFile)){
                    $filemtime_cache=filemtime($cacheFile);
                }else{
                    $filemtime_cache=0;
                }
                //php缓存
                $cache_path=ROOT . '/'.$lang.'/template/'. config::get('template_shopping_dir') . '/modules/' . $str[1] . '/';
                if (front::get('catid')){
                    $cache_path.="category/".front::get('catid').'/';
                }
                elseif (front::get('spid')){
                    $cache_path.="special/".front::get('spid').'/';
                }
                elseif (front::get('typeid')){
                    $cache_path.="type/".front::get('typeid').'/';
                }
                elseif (front::get('aid')){
                    $cache_path.="archive/".front::get('aid').'/';
                }
                if (front::get('page')){
                    $cache_path.="page/".front::get('page').'/';
                }
                $cache_path.=$str[2].'/#'.$str[3].'.php';
                if(file_exists($cache_path)){
                    $filemtime_cache_2=filemtime($cache_path);
                }else{
                    $filemtime_cache_2=0;
                }

                if (filemtime($config_path) > $filemtime_cache || filemtime($config_path) > $filemtime_cache_2) {
                    $content = isset($tag['tagcontent'])?$tag['tagcontent']:"";
                    if ($tag['tagfrom'] == 'category' || $tag['tagfrom'] == 'content'
                        || $tag['tagfrom'] == 'shopcategory' || $tag['tagfrom'] == 'shopcontent'
                        || $tag['tagfrom'] == 'type' || $tag['tagfrom'] == 'shoptype'
                        || $tag['tagfrom'] == 'special' || $tag['tagfrom'] == 'shopspecial'
                        || $tag['tagfrom'] == 'shopcontent' || $tag['tagfrom'] == 'shopcategory'
                        || $tag['tagfrom'] == 'announcement' || $tag['tagfrom'] == 'commoncss'
                        || $tag['tagfrom'] == 'shopannouncement' || $tag['tagfrom'] == 'shopcommoncss') {
                        $tag['catid']=isset($tag['catid'])?$tag['catid']:"";
                        if (isset($tag['catid']) &&  is_numeric($tag['catid'])){
                            $categorydome = category::getInstance()->getrow("catid=" . $tag['catid'] . ' and langid=' . lang::getlangid($lang));
                        }else{
                            $categorydome="";
                        }
                        if ((!isset($categorydome) || !is_array($categorydome)) && $tag['tagfrom'] != 'shopcommoncss' && is_numeric($tag['catid'])) {
                            $content = file_get_contents(self::getmodulespath($tag['defaultDemo'], $str[1], $str[2], false));
                        } else
                            $content = self::getmoduleslisttagcontent($tag, $str[1], $str[2], false);
                    }
                    $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);
                    //var_dump($content);//exit;

                    $content = front::$view->compile($content);
                    if (!file_exists($path)) {  mkdir($path, 0777, true); }
                    file_put_contents(iconv("utf-8", "gbk", $cacheFile), $content);
                    $content=front::$view->_eval($cacheFile,true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                }
                if (file_exists($cache_path)) {
                    $content= front::$view->_eval($cache_path,true);
                }
                else{
                    $content=front::$view->_eval($cacheFile,true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                }

                return $content;
            }
            return "";
        /*}*/
    }
    //页面加载组件  购买的
    static function tagbuymodules($modulesname,$lang=true,$html_js=false)
    {
        /*if (!$html_js){
            $content="<div name='cmseasy_shop_buy_".$modulesname."'>";
            $url=url('templatetag/shoo_tagbuymodules',false);
            if (get('catid')){
                $url.="&catid=".get('catid');
            }
            elseif (get('spid')){
                $url.="&spid=".get('spid');
            }
            elseif (get('typeid')){
                $url.="&typeid=".get('typeid');
            }
            elseif (get('aid')){
                $url.="&aid=".get('aid');
            }
            if (get('page')){
                $url.="&page=".get('page');
            }
            $content.='<script>
                       $(function () {
                          $.ajax({
                                type: "post",
                                url: "'.$url.'",
                                data: {"modulesname":"'.$modulesname.'","lang":'.$lang.'},
                                async: true,
                                success: function (data) {
                                    $("[name=cmseasy_shop_buy_'.$modulesname.']").after(data); 
                                    $("[name=cmseasy_shop_buy_'.$modulesname.']").remove();
                                }
                           });
                        });
                        </script>';
            $content.="</div>";
            //涉及到及时模块 所以先生成一波了
            shoptemplatetag::tagmodules($modulesname,$lang,true);
            return $content;
        }
        else {*/
            if ($lang) $lang = lang::getistemplate(); else $lang = lang::getisadmin();
            $str = explode("_", $modulesname);//0category 1 (全局)  2 组件名称 3 配置id
            $tag = self::getInstance()->getmodulesrow($str[3], $str[1], $str[2], true, $lang);
            load_sections_lang(self::getlangfilename($str[1], $str[2], true, $lang));
            //var_dump($tag);
            if (is_array($tag)) {
                $path = ROOT . '/cache/template/' . lang::getistemplate() . '/buymodules/' . $str[1] . '/' . $str[2];
                $config_path = self::getmodulesfilename($str[1], $str[2], true);
                $cacheFile = $path . '/#' . $str[3] . '.php';
                if (file_exists($cacheFile)) {
                    $filemtime_cache = filemtime($cacheFile);
                } else {
                    $filemtime_cache = 0;
                }

                //php缓存
                $cache_path = ROOT . '/' . $lang . '/template/buymodules/' . $str[1] . '/';
                if (front::get('catid')){
                    $cache_path.="category/".front::get('catid').'/';
                }
                elseif (front::get('spid')){
                    $cache_path.="special/".front::get('spid').'/';
                }
                elseif (front::get('typeid')){
                    $cache_path.="type/".front::get('typeid').'/';
                }
                elseif (front::get('aid')){
                    $cache_path.="archive/".front::get('aid').'/';
                }
                if (front::get('page')){
                    $cache_path.="page/".front::get('page').'/';
                }
                $cache_path.=$str[2].'/#'.$str[3].'.php';
                if (file_exists($cache_path)) {
                    $filemtime_cache_2 = filemtime($cache_path);
                } else {
                    $filemtime_cache_2 = 0;
                }

                if (filemtime($config_path) > $filemtime_cache || filemtime($config_path) > $filemtime_cache_2) {
                    $content = isset($tag['tagcontent'])?$tag['tagcontent']:"";
                    if ($tag['tagfrom'] == 'category' || $tag['tagfrom'] == 'content'
                        || $tag['tagfrom'] == 'shopcategory' || $tag['tagfrom'] == 'shopcontent'
                        || $tag['tagfrom'] == 'type' || $tag['tagfrom'] == 'shoptype'
                        || $tag['tagfrom'] == 'special' || $tag['tagfrom'] == 'shopspecial'
                        || $tag['tagfrom'] == 'shopcontent' || $tag['tagfrom'] == 'shopcategory'
                        || $tag['tagfrom'] == 'announcement' || $tag['tagfrom'] == 'commoncss'
                        || $tag['tagfrom'] == 'shopannouncement' || $tag['tagfrom'] == 'shopcommoncss') {
                        if (is_numeric($tag['catid'])){
                            $categorydome = category::getInstance()->getrow("catid=" . $tag['catid'] . ' and langid=' . lang::getlangid($lang));
                        }else{
                            $categorydome="";
                        }
                        if (!is_array($categorydome) && $tag['tagfrom'] != 'shopcommoncss' && is_numeric($tag['catid'])) {
                            $content = file_get_contents(self::getmodulespath($tag['defaultDemo'], $str[1], $str[2], true));
                        } else
                            $content = self::getmoduleslisttagcontent($tag, $str[1], $str[2], true);
                    }

                    $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);
                    //var_dump($content);//exit;
                    $content = front::$view->compile($content);

                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    file_put_contents(iconv("utf-8", "gbk", $cacheFile), $content);

                    $content = front::$view->_eval($cacheFile, true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                } elseif (file_exists($cache_path)) {
                    $content = front::$view->_eval($cache_path, true);
                } else {
                    $content = front::$view->_eval($cacheFile, true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                }
                return $content;

            }
            return "";
        /*}*/
    }
    //新增配置
    public function rec_insertmodules($tag_info,$modulestype,$modules,$isbuy)
    {
        $copyid=$tag_info['id'];
        unset($tag_info['id']);
        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(iconv("utf-8", "gbk",$settingTemplate_file), '<?php return array();');
        $modulessetting = include $settingTemplate_file;

        $max_id=0;
        foreach ($modulessetting as $key=>$set) {
            if ($key > $max_id)
                $max_id = $key;
        }
        $this->insert_id = $max_id + 1;

        $newtag=array();
        foreach (lang::getall() as $langval){
            $capy_tag_info =self::getmodulesrow($copyid, $modulestype, $modules, $isbuy,$langval['langurlname']);
            unset($capy_tag_info['custom']);
            unset($capy_tag_info['id']);
            $capy_tag_info['default']=false; //新增的不能是默认配置
            $newtag[$langval['langurlname']]=array_merge(array('id' => $this->insert_id), $capy_tag_info);
        }
        $newtag['custom']=$tag_info['custom'];

        $modulessetting[] = $newtag;

        //保存配置
        $this->savemodulessetting($modulessetting,$settingTemplate_file);
        //复制loop代码文件
        $this->copymodulesloop($copyid,$this->insert_id,$modulestype,$modules,$isbuy);

        $newtag[lang::getisadmin()]['custom']=$tag_info['custom'];
        $newtag[lang::getisadmin()]['newmodulesname']="{tag_".($isbuy?"buymodules":"modules")."_shop_".$newtag[lang::getisadmin()]['tagfrom']."_".$modulestype."_".$modules."_".$this->insert_id."}";
        return $newtag[lang::getisadmin()];
    }
    //复制组件loop代码文件
    public function copymodulesloop($copyid,$newid,$modulestype,$modules,$isbuy)
    {
        if ($isbuy){
            $copypath=TEMPLATE . '/'.config::get('template_shopping_dir').'/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$copyid.'.php';
            $newpath=TEMPLATE . '/'.config::get('template_shopping_dir').'/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$newid.'.php';
        } else{
            $copypath=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$copyid.'.php';
            $newpath=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$newid.'.php';

        }
        @copy($copypath,$newpath);

    }
    //删除配置
    public function rec_deletemodules($tagid,$modulestype,$modules,$isbuy)
    {
        if (!$tagid)
            return false;
        $ids = explode(',', preg_replace('/.*\(|\).*/', '', $tagid));
        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(iconv("utf-8", "gbk",$settingTemplate_file), '<?php return array();');
        $modulessetting = include $settingTemplate_file;

        $count=0;
        foreach ($modulessetting as $order => $set) {
            if (in_array($set[lang::getisadmin()]['id'],$ids) && !$set[lang::getisadmin()]['default']) {
                //删除组件loop代码文件
                $this->delmodulesloop($set[lang::getisadmin()]['id'],$modulestype,$modules,$isbuy);
                unset($modulessetting[$order]);
                $count++;
            }
        }
        if ($count)
            $this->savemodulessetting($modulessetting,$settingTemplate_file); //保存配置

        return $count;
    }
    //删除组件loop代码文件
    public function delmodulesloop($tagid,$modulestype,$modules,$isbuy)
    {
        if ($isbuy){
            $path=TEMPLATE . '/' . config::get('template_shopping_dir'). '/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';
        } else{
            $path=TEMPLATE . '/' . config::get('template_shopping_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';

        }
        @unlink($path);
    }

    //页面加载幻灯片
    static function tagslide($slidename,$out="",$isbuy="",$html_js=false)
    {
       /* if (!$html_js){
            if ($slidename){
                $show_name=$slidename;
            }else{
                $show_name=$out;
            }
            $content="<div name='cmseasy_shop_".$show_name."'>";
            $url=url('templatetag/shop_tagslide',false);
            $content.='<script>
                       $(function () {
                          $.ajax({
                                type: "post",
                                url: "'.$url.'",
                                data: {"slidename":"'.$slidename.'","out":"'.$out.'","isbuy":"'.$isbuy.'"},
                                async: true,
                                success: function (data) {
                                    $("[name=cmseasy_shop_'.$show_name.']").after(data); 
                                    $("[name=cmseasy_shop_'.$show_name.']").remove();
                                }
                           });
                        });
                        </script>';
            $content.="</div>";
            return $content;
        }
        else{*/
            if (is_numeric($slidename)){
                $slideconfig=slideconfig::getInstance()->getrow("id=".$slidename);
                if (is_array($slideconfig)){
                    $setting=unserialize($slideconfig['setting']);
                    $slidename=$setting[lang::getisadmin()]['slidename'];
                }
            }
            if ($out!=""){

                $str=explode("_",$out);// 0 (全局) 1 组件名称2 配置id
                if ($isbuy)
                    $modulespath=ROOT . '/data/buymodules/'.$str[0].'/'.$str[1].'/'.$str[2].'.php';
                else
                    $modulespath=TEMPLATE . '/' . config::get('template_dir') . '/visual/modules/'.$str[0].'/'.$str[1].'/'.$str[2].'.php';

                $row = self::getmodulesrow($str[2], $str[0], $str[1], $isbuy,lang::getisadmin());
                $slidename=$row['slidename'];
            }
            $slidedata=slide::getInstance()->getrow('name="'.$slidename.'"');
            if (!is_array($slidedata))return "";

            $content = self::getslidecontent($slidedata,$modulespath);

            $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);
            //var_dump($content);//exit;
            $content=front::$view->compile($content);
            $path=ROOT . '/cache/template/' .config::get('template_dir'). '/system';
            $cacheFile=$path.'/#'.$slidename.'.php';
            if (file_exists($cacheFile)){
                unlink($cacheFile);
            };
            if (!file_exists($cacheFile)){
                if (!file_exists( $path )) {mkdir ($path,0777,true );}
                file_put_contents(iconv("utf-8", "gbk",$cacheFile), $content);
            }
            return front::$view->_eval($cacheFile,true);
        /*}*/
    }
    //加载幻灯片内容
    public static function getslidecontent($tag)
    {
        $path = ROOT . '/template/' .config::get('template_shopping_dir'). '/system/slide.html';
        $tag_tpl_content = @file_get_contents($path);

        if($tag['slide_style_position']=='1'){
            $tag['slide_style_position']='text-center';
        }elseif($tag['slide_style_position']=='2'){
            $tag['slide_style_position']='text-right';
        }else{
            $tag['slide_style_position']='text-left';
        }

        if($tag['slide_btn_shape']=='2'){
            $tag['slide_btn_shape'] = 'border-radius: 0;';
        }else{
            $tag['slide_btn_height'] = $tag['slide_btn_width'];
        }
        $patterns[0] = '/\$_id/';
        $patterns[1] = '/\$_slide_time/';
        $patterns[2] = '/\$_slide_text_color/';
        $patterns[3] = '/\$_slide_input_bg/';
        $patterns[4] = '/\$_slide_input_color/';
        $patterns[5] = '/\$_slide_btn_width/';
        $patterns[6] = '/\$_slide_btn_height/';
        $patterns[7] = '/\$_slide_btn_color/';
        $patterns[8] = '/\$_slide_btn_shape/';
        $patterns[9] = '/\$_slide_btn_hover_color/';
        $patterns[10] ='/\$_slide_button_color/';
        $patterns[11] ='/\$_slide_button_size/';
        $patterns[12] ='/\$_slide_style_position/';
        $patterns[13] ='/\$_slide_width/';
        $patterns[14] ='/\$_slide_height/';
        $patterns[15] ='/\$_name/';
        $patterns[16] = '/\$_slide_title_size/';
        $patterns[17] = '/\$_slide_subtitle_size/';

        $replacements[0] = $tag['id'];
        $replacements[1] = $tag['slide_time'];
        $replacements[2] = $tag['slide_text_color'];
        $replacements[3] = $tag['slide_input_bg'];
        $replacements[4] = $tag['slide_input_color'];
        $replacements[5] = $tag['slide_btn_width'];
        $replacements[6] = $tag['slide_btn_height'];
        $replacements[7] = $tag['slide_btn_color'];
        $replacements[8] = $tag['slide_btn_shape'];
        $replacements[9] = $tag['slide_btn_hover_color'];
        $replacements[10] = $tag['slide_button_color'];
        $replacements[11] = $tag['slide_button_size'];
        $replacements[12] = $tag['slide_style_position'];
        $replacements[13] = $tag['slide_width'];
        $replacements[14] = $tag['slide_height'];
        $replacements[15] = $tag['name'];
        $replacements[16] = $tag['slide_title_size'];
        $replacements[17] = $tag['slide_subtitle_size'];

        $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
        return $tag_tpl_content;
    }

    function getrow($tagid)
    {
        if (is_numeric($tagid)) {
            foreach (self::$setting as $set) {
                if ($set['id'] == $tagid)
                    return $set;
            }
        } elseif (preg_match("/name='([^']+)'/", $tagid, $match)) {
            foreach (self::$setting as $set) {
                if ($set['name'] == $match[1])
                    return $set;
            }
        }
        return false;
    }

    function getrowadmin($tagid)
    {
        if (is_numeric($tagid)) {
            foreach (self::$adminsetting  as $set) {
                if ($set['id'] == $tagid)
                    return $set;
            }
        } elseif (preg_match("/name='([^']+)'/", $tagid, $match)) {
            foreach (self::$adminsetting  as $set) {
                if ($set['name'] == $match[1])
                    return $set;
            }
        }
        return false;
    }

    function getrows($condition)
    {
        preg_match("/tagfrom='(\w+)'/", $condition, $match);
        $rows = array();
        foreach (self::$setting as $set) {
            if ($set['tagfrom'] == $match[1])
                $rows[] = $set;
        }

        return $rows;
    }

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new shoptemplatetag();
            self::$me = $class;
        }
        return self::$me;
    }

    static function _getVer()
    {
        define('SYSTEMNAME', 'C' . 'm' . 's' . 'E' . 'a' . 's' . 'y');
        include_once 'version.php';
    }

    function getcols($act = null)
    {
        return 'id,name,tagmodule,tagcontent,note,tagfrom,tagtype';
    }

    function get_form()
    {
        return array(
            'tagmodule' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array('all' => lang_admin('all'), 'archive' => lang_admin('article'),
                    'user' => lang_admin('member'), 'other' => lang_admin('other'))),
            ),
            'tagfrom' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array('system' => lang_admin('system'), 'function' => lang_admin('function'), 'define' =>lang_admin('custom'))),
                'default' => 'define',
            ),
            'template_name' => array(
                'default' => config::get('template_shopping_dir'),
            ),
            'tagtype' => array(
                'tips' => "&nbsp;".lang_admin('can_customize_category_name_to_make_easy_find'),
            ),
        );
    }

    function getFields()
    {
        static $fields;
        static $primary_key;
        if (!isset($fields)) {
            $fields = array();
            $_field = array();
            foreach (self::$fields as $field) {
                $_type = preg_match('/(\w+)(\((\w+)\))?/i', $field['Type'], $result);
                $_field['name'] = $field['Field'];
                $_field['type'] = $result[1];
                $_field['len'] = isset($result[3]) ? $result[3] : 0;
                $_field['primary_key'] = $field['Key'] == 'PRI';
                $_field['notnull'] = $field['Null'] == 'NO';
                $_field['selecttype'] = isset($this->_form[$_field['name']]['selecttype']) ? $this->_form[$_field['name']]['selecttype'] : '';
                $_field['select'] = isset($this->_form[$_field['name']]['select']) ? $this->_form[$_field['name']]['select'] : '';
                $_field['tips'] = isset($this->_form[$_field['name']]['tips']) ? $this->_form[$_field['name']]['tips'] : '';
                $fields[$field['Field']] = $_field;
                if ($field['Key'] == 'PRI') {
                    $this->primary_key = $field['Field'];
                    $primary_key = $this->primary_key;
                }
            }
        }
        $this->primary_key = $primary_key;
        return $fields;
    }

    public function rec_insert($tag_info)
    {
        unset($tag_info['id']);
        $setting = array();
        foreach ($tag_info as $key => $tag) {
            if (!in_array($key, explode(',', $this->getcols()))) {
                unset($tag_info[$key]);
                $setting[$key] = $tag;
            }
        }
        $max_id = 0;
        foreach (self::$setting as $set) {
            if ($set['name'] == $tag_info['name']) {
                front::flash(lang_admin('tags')." $tag_info[name]".lang_admin('already_exists'));
                return false;
            }
            if ($set['id'] > $max_id)
                $max_id = $set['id'];
        }
        $this->insert_id = $max_id + 1;
        $tag_info['name']=$max_id + 1;
        $tag_info = array_merge(array('id' => $max_id + 1), $tag_info, array('tagfrom' => get('tagfrom'), 'setting' => $setting));
        //保持其他语言配置一致
        foreach (lang::getall() as $langval){
            $langpath=TEMPLATE . '/' . config::get('template_dir') . '/data/templatetag_'.$langval['langurlname'].'.php';
            if (file_exists($langpath)){
                $setting_lang= include $langpath;
                $setting_lang[] = $tag_info;
                file_put_contents(iconv("utf-8", "gbk",$langpath), '<?php return ' . var_export($setting_lang, true) . ';');
            }
        }
        return$this->insert_id;
    }

    public function rec_insertview($tag_info)
    {
        unset($tag_info['id']);
        $setting = array();
        foreach ($tag_info as $key => $tag) {
            if (!in_array($key, explode(',', $this->getcols()))) {
                unset($tag_info[$key]);
                $setting[$key] = $tag;
            }
        }
        $max_id = 0;
        foreach (self::$adminsetting as $set) {
            if ( $tag_info['name']!="" && $set['name'] == $tag_info['name'] && $set['name']!="") {
                front::flash(lang_admin('tags')." $tag_info[name]".lang_admin('already_exists'));
                return false;
            }
            if ($set['id'] > $max_id)
                $max_id = $set['id'];
        }
        $this->insert_id = $max_id + 1;
        $tag_info['name']=$max_id + 1;
        $tag_info = array_merge(array('id' => $max_id + 1), $tag_info, array('tagfrom' => get('tagfrom'), 'setting' => $setting));
        self::$adminsetting[] = $tag_info;

        $this->savesetting();
        return $this->insert_id;
    }

    public function rec_update($tag_info, $id)
    {
        if (!$id)
            return false;
        $setting = array();
        foreach (self::$adminsetting as $order => $set) {
            if ($set['id'] == $id) {
                foreach ($tag_info as $key => $tag) {
                    if (!in_array($key, explode(',', $this->getcols()))) {
                        unset($tag_info[$key]);
                        $setting[$key] = $tag;
                    }
                }
                self::$adminsetting[$order] = array_merge(array('id' => $id,'name' => $set['name']), $tag_info, array('tagfrom' => get('tagfrom'), 'setting' => $setting));
                $this->savesetting();
                return $id;
            }
        }
        return false;
    }

    public function rec_delete($id)
    {
        if (!$id)
            return false;
        $ids = explode(',', preg_replace('/.*\(|\).*/', '', $id));
        $count = 0;
        foreach (self::$adminsetting as $order => $set) {
            if (in_array($set['id'], $ids)) {
                unset(self::$adminsetting[$order]);
                $count++;
            }
        }
        if ($count)
            $this->savesetting();
        return $count;
    }

    public function insert_id()
    {
        return $this->insert_id;
    }

    static function tag($tagid,$lang=true)
    {
        if (!is_numeric($tagid))
            $tagid = "name='$tagid'";
        if ($lang)
            $tag = self::getInstance()->getrow($tagid);
        else
            $tag = self::getInstance()->getrowadmin($tagid);
        //var_dump($tag);
        if (is_array($tag)) {
            if (front::$case == 'tag') {
                $get = array_slice(front::$get, 2);
                if (is_array($get))
                    foreach ($get as $key => $value) front::$view->_var->$key = $value;
            }
            $content =isset($tag['tagcontent'])?$tag['tagcontent']:"";
            if ($tag['tagfrom'] == 'shopcategory' || $tag['tagfrom'] == 'shopcontent' || $tag['tagfrom'] == 'shoptype'
                || $tag['tagfrom'] == 'shopspecial') {
                $content = self::getlisttagcontent($tag, $tag['setting']);
            }
            $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);

            //var_dump($content);//exit;
            $content=front::$view->compile($content);
            $path=ROOT . '/cache/template/' .config::get('template_shopping_dir'). '/oldmodules'.'/'.$tag['tagfrom'];
            $cacheFile=$path.'/#'.$tag['name'].'.php';
            if (file_exists($cacheFile)){
                unlink($cacheFile);
            };
            if (!file_exists($cacheFile)){
                if (!file_exists( $path )) {mkdir ($path,0777,true );}
                file_put_contents(iconv("utf-8", "gbk",$cacheFile), $content);
            }

            return front::$view->_eval($cacheFile);
        }
    }

    static function tagadmin($tagid)
    {
        if (!is_numeric($tagid))
            $tagid = "name='$tagid'";

        $tag = self::getInstance()->getrowadmin($tagid);
        //var_dump($tag);
        if (is_array($tag)) {
            if (front::$case == 'tag') {
                $get = array_slice(front::$get, 2);
                if (is_array($get))
                    foreach ($get as $key => $value) front::$view->_var->$key = $value;
            }
            $content =isset($tag['tagcontent'])?$tag['tagcontent']:"";
            if ($tag['tagfrom'] == 'category' || $tag['tagfrom'] == 'content'
                || $tag['tagfrom'] == 'shopcategory' || $tag['tagfrom'] == 'shopcontent'
                || $tag['tagfrom'] == 'type'|| $tag['tagfrom'] == 'shoptype'
                || $tag['tagfrom'] == 'special'|| $tag['tagfrom'] == 'shopspecial'
                || $tag['tagfrom'] == 'shopcontent' || $tag['tagfrom'] == 'shopcategory'
                || $tag['tagfrom'] == 'announcement'|| $tag['tagfrom'] == 'commoncss'
                || $tag['tagfrom'] == 'shopannouncement'|| $tag['tagfrom'] == 'shopcommoncss' ){
                $content = self::getlisttagcontent($tag, $tag['setting']);
            }

            $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);
            //var_dump($content);//exit;
            $content=front::$view->compile($content);
            $path=ROOT . '/cache/template/admin/oldmodules'.'/'.$tag['tagfrom'];
            $cacheFile=$path.'/#'.$tag['name'].'.php';
            if (file_exists($cacheFile)){
                unlink($cacheFile);
            };
            if (!file_exists($cacheFile)){
                if (!file_exists( $path )) {mkdir ($path,0777,true );}
                file_put_contents(iconv("utf-8", "gbk",$cacheFile), $content);

            }

            return front::$view->_eval($cacheFile);
        }
    }


    static function js($tagid)
    {
        if (!is_numeric($tagid)) {
            $tagid = "name='$tagid'";
            $tag = self::getInstance()->getrow($tagid);
            $tagid = $tag['id'];
        }
        $url = url::create("templatetag/get/id/$tagid/" . url::arrayto(array_slice(front::$get, 2)));
        return "<script src=\"$url\"></script>";
    }

    static function typeoption(){
        return array(
            'archive-list_' => lang_admin('column_list'),
            'archive-show_' => lang_admin('article').lang_admin('content'),
        );
    }

    static function id($tagid)
    {
        if (!is_numeric($tagid)) {
            $tagid = "name='$tagid'";
            $tag = self::getInstance()->getrow($tagid);
            $tagid = $tag['id'];
        }
        return $tagid;
    }

    public static function getlisttagcontent($tag, $tag_config)
    {
        $path = ROOT . '/template/' . config::get('template_shopping_dir') . '/tpltag/' . $tag_config['tagtemplate'];
        $tag_tpl_content = @file_get_contents($path);
        if ($tag['tagfrom'] == 'shopcontent') {
            //$tag_config['area'] = "'" . $tag_config['province_id'] . "," . $tag_config['city_id'] . "," . $tag_config['section_id'] . "'";
            $tag_config['area'] = "'0,0,0'";
            if ($tag_config['thumb']=='1' || $tag_config['thumb']=='on') {
                $tag_config['thumb'] = 'true';
            } else {
                $tag_config['thumb'] = 'false';
            }

            foreach ($tag_config as $key => $value) {
                if (empty($value))
                    $tag_config[$key] = '0';
                else if ($key <> 'area' && $value != 'false' && $value != 'true' && !is_numeric($value))
                    $tag_config[$key] = "'$value'";
            } 
            $patterns[0] = '/\$_catid/';
            $patterns[1] = '/\$_typeid/';
            $patterns[2] = '/\$_spid/';
            $patterns[3] = '/\$_area/';
            $patterns[4] = '/\$_length/';
            $patterns[5] = '/\$_ordertype/';
            $patterns[6] = '/\$_limit/';
            $patterns[7] = '/\$_image/';
            $patterns[8] = '/\$_attr1/';
            $patterns[9] = '/\$_son/';
            $patterns[10] = '/\$_wheretype/';
            $patterns[11] = '/\$_tpl/';
            $patterns[12] = '/\$_intro_len/';
            $patterns[13] = '/\$_istop/';
            $patterns[14] = '/\$_textnum/';
            $patterns[15] = '/\$_titlenum/';
            $replacements[0] = $tag_config['catid'];
            $tag_config['typeid']=(isset($tag_config['typeid']) && $tag_config['typeid'])?$tag_config['typeid']:0;
            $replacements[1] = $tag_config['typeid'];
            $tag_config['spid']=(isset($tag_config['spid']) && $tag_config['spid'])?$tag_config['spid']:0;
            $replacements[2] = $tag_config['spid'];
            $replacements[3] = $tag_config['area'];
            $replacements[4] = $tag_config['length'];
            $replacements[5] = $tag_config['ordertype'];
            $replacements[6] = $tag_config['limit'];
            $replacements[7] = $tag_config['thumb'];
            $replacements[8] = $tag_config['attr1'];
            $replacements[9] = $tag_config['son'];
            $replacements[10] = isset($tag_config['wheretype']) ? $tag_config['wheretype'] : '\'\'';
            $replacements[11] = isset($tag_config['tpl'])? $tag_config['tpl'] : '\'\'';
            $replacements[12] = $tag_config['introduce_length'];
            $replacements[13] = (int)$tag_config['istop'];
            $replacements[14] = isset( $tag_config['textnum'])? $tag_config['textnum']:"''";
            $replacements[15] = isset( $tag_config['titlenum'])? $tag_config['titlenum']:"''";

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            //var_dump($tag_tpl_content);
            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shopcategory') {
            if ($tag_config['catname'] == 'on') {
                $tag_config['catname'] = '{$cat[catname]}';
            } else {
                $tag_config['catname'] = '';
            }
            if ($tag_config['categorycontent'] == 'on') {
                $tag_config['categorycontent'] = '{$cat[categorycontent]}';
            } else {
                $tag_config['categorycontent'] = '';
            }
            if ($tag_config['catimage'] == 'on') {
                $tag_config['catimage'] = '{$cat[image]}';
            } else {
                $tag_config['catimage'] = '';
            }
            if ($tag_config['subcat'] == 'on') {
                $tag_config['subcat'] = '<!--子栏目开始-->
  {loop categories($cat[catid]) $cat}
    {lang_admin("column")}{lang_admin("name")}：{$cat[catname]}
    {lang_admin("news_coverage")}：{$cat[categorycontent]}
    {lang_admin("column_pictures")}：{$cat[image]}
    <a href="{$cat[url]}">{$cat[catname]}</a>
  {/loop}
  <!--子栏目结束-->';
            } else {
                $tag_config['subcat'] = '';
            }
            $patterns[0] = '/\$_catid/';
            $patterns[1] = '/\$_subcat/';
            $patterns[2] = '/\$_catname/';
            $patterns[3] = '/\$_categorycontent/';
            $patterns[4] = '/\$_image/';
            $patterns[5] = '/\$_son/';
            $patterns[6] = '/\$_textnum/';
            $patterns[7] = '/\$_titlenum/';
            $replacements[0] = $tag_config['catid'];
            $replacements[1] = $tag_config['subcat'];
            $replacements[2] = $tag_config['catname'];
            $replacements[3] = $tag_config['categorycontent'];
            $replacements[4] = $tag_config['catimage'];
            $replacements[5] = $tag_config['son'];
            $replacements[6] = isset( $tag_config['textnum'])? $tag_config['textnum']:"''";
            $replacements[7] =  isset( $tag_config['titlenum'])? $tag_config['titlenum']:"''";
            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shopspecial') {

            $patterns[] = '/\$_spid/';
            $patterns[] = '/\$_spname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_spcontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_spimage/';
            //var_dump($tag_config);
            //var_dump($tag_config['spname']);
            $tag_config['spid']=(isset($tag_config['spid']) && $tag_config['spid'])?$tag_config['spid']:0;
            $replacements[] = $tag_config['spid'];
            $replacements[] = (int)$tag_config['spname'];
            $replacements[] = (int)$tag_config['subtitle'];
            $replacements[] = (int)$tag_config['spcontent'];
            $replacements[] = (int)$tag_config['len'];
            $replacements[] = (int)$tag_config['spimage'];
            //var_dump($replacements);

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            //var_dump($tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'shoptype') {

            $patterns[] = '/\$_typeid/';
            $patterns[] = '/\$_tyname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_tycontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_tyimage/';
            //var_dump($tag_config);
            //var_dump($tag_config['tyname']);
            $tag_config['typeid']=(isset($tag_config['typeid']) && $tag_config['typeid'])?$tag_config['typeid']:0;
            $replacements[] = $tag_config['typeid'];
            $replacements[] = (int)$tag_config['tyname'];
            $replacements[] = (int)$tag_config['subtitle'];
            $replacements[] = (int)$tag_config['tycontent'];
            $replacements[] = (int)$tag_config['len'];
            $replacements[] = (int)$tag_config['tyimage'];
            //var_dump($replacements);

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            //var_dump($tag_tpl_content);

            $content = $tag_tpl_content;
        }


        return $content;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.