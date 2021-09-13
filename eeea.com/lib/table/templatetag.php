<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class templatetag
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

    function __construct()
    {
        $setting_file = self::getfilename();

        @mkdir(dirname($setting_file));
        if (!file_exists($setting_file))
            file_put_contents(($setting_file), '<?php return array();');
        else
            self::$setting = include $setting_file;


        $settingadmin_file = self::getadminfilename();
        @mkdir(dirname($settingadmin_file));
        if (!file_exists($settingadmin_file))
            file_put_contents(($settingadmin_file), '<?php return array();');
        else
             self::$adminsetting = include $settingadmin_file;


    }

    public function getfilename()
    {
        $path=TEMPLATE . '/' . config::get('template_dir') . '/data/templatetag_'.lang::getistemplate().'.php';
        //判断模板标签文件是否存在！不存在则创建
        if (!file_exists($path)){
            mkdir ($path,0777,true);
            echo lang_admin('file_created_successfully');
        }
        return $path;

    }

    public function getadminfilename()
    {
        $path=TEMPLATE . '/' . config::get('template_dir') . '/data/templatetag_'.lang::getisadmin().'.php';
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
        file_put_contents(($settingadmin_file), '<?php return ' . var_export(self::$adminsetting, true) . ';');
    }

    static public function xCopy($source, $destination, $child = 1){
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
            $newpath=ROOT.'/template/'.config::get('template_dir').'/visual/buymodules/'.$modulestype.'/'.$modules;
            tool::mkdir(dirname($newpath));
            $path=$newpath.'/'.$modules.'.config.php';

            //加载的时候用原配置
            if(isset(front::$view->nocopytemplate_buymodules) && front::$view->nocopytemplate_buymodules){
                return $oldpath.'/'.$modules.'.config.php';
            }
            //判断文件是否存在！不存在则创建
            if (!file_exists($path)){
                self::xCopy($oldpath,$newpath,1);
            }
            return $path;
        }
        else
            $path=TEMPLATE . '/' . config::get('template_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$modules.'.config.php';
        //判断文件是否存在！不存在则创建
        if (!file_exists($path)){
            if (!file_exists( $path )) {@fopen($path, "w");}
        }
        return $path;

    }
    //获取组件语言包地址
    public static function getlangfilename($modulestype,$modules,$isbuy,$lang="")
    {
        if ($isbuy){
            //加载的时候用原配置
            if(isset(front::$view->nocopytemplate_buymodules) && front::$view->nocopytemplate_buymodules){
                $path=ROOT . '/data/buymodules/'.$modulestype.'/'.$modules.'/lang/'.$lang.'/system_modules.php';
            }else{
                $path=TEMPLATE . '/' . config::get('template_dir') . '/visual/buymodules/'.$modulestype.'/'.$modules.'/lang/'.$lang.'/system_modules.php';
            }
        }
        else
            $path=TEMPLATE . '/' . config::get('template_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/lang/'.$lang.'/system_modules.php';
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
            $path=TEMPLATE . '/' . config::get('template_dir') . '/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';
        }
        else
            $path=TEMPLATE . '/' . config::get('template_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';
        //判断文件是否存在！不存在则创建
        if (!file_exists($path)){
            @mkdir(dirname($path));
            //echo lang_admin('file_created_successfully');
        }
        return $path;

    }
    //获取组件配置
    function getmodulesrow($tagid,$modulestype,$modules,$isbuy,$lang="")
    {
        $modulessetting=array();
        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
        $modulessetting = include $settingTemplate_file;
        foreach ($modulessetting as $key=>$set) {
            if ($lang && isset($set[$lang]) && is_array($set[$lang]))$set=$set[$lang];
            if ($set['id'] == $tagid){
                $set['custom']=$modulessetting[$key]['custom'];
                if (!$lang)
                    return $modulessetting[$key];
                    else
                    return $set;
            }

        }
        return array();
    }
    //获取及时模块地址
    public static function getsectionsfilename($sectionstype,$sections)
    {
        if (get('isshopping')){
            $template_dir=config::get('template_shopping_dir');
        }else{
            $template_dir=config::get('template_dir');
        }
        $old_templatename=ROOT.'/template_admin/'.config::getadmin('template_admin_dir').'/visual/sections/'.$sectionstype.'/'.$sections;
        //判断文件是否存在！不存在则创建
        if (!file_exists($old_templatename.'/'.$sections.'.config.php')){
            @fopen($old_templatename.'/'.$sections.'.config.php', "w");
        }
        $new_templatename=ROOT.'/template/'.$template_dir.'/visual/sections/'.$sectionstype.'/'.$sections;
        tool::mkdir(dirname($new_templatename));
        $path=$new_templatename.'/'.$sections.'.config.php';

        //判断文件是否存在！不存在则创建
        if (!file_exists($path)){
            self::xCopy($old_templatename,$new_templatename,1);
        }
        return $path;

    }
    //获取及时模块loop地址
    public static function getsectionspath($tagid,$sectionstype,$sections,$isshopping=0)
    {
        if ($isshopping){
            $template_dir=config::get('template_shopping_dir');
        }else{
            $template_dir=config::get('template_dir');
        }
        $path=ROOT.'/template/'.$template_dir.'/visual/sections/'.$sectionstype.'/'.$sections.'/'.$tagid.'.php';
        //判断文件是否存在！不存在则创建
        if (!file_exists($path)){
            @mkdir(dirname($path));
            //echo lang_admin('file_created_successfully');
        }
        return $path;

    }
    //获取及时模块配置   如果是1 就自动生成  列表例外
    public static function getsectionsrow($tagid,$sectionstype,$sections,$insert_static=false)
    {
        if (get('isshopping')){
            $template_dir=config::get('template_shopping_dir');
        }else{
            $template_dir=config::get('template_dir');
        }

        $settingTemplate_file = self::getsectionsfilename($sectionstype,$sections);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
        $sectionssetting = include $settingTemplate_file;

        if (front::get('catid')){
            $categorydata= category::getInstance()->getrow('catid='.front::get('catid'));
            $cat_template = @$categorydata['template'];
            if (!$cat_template){
                    $cat_template = category::gettemplate($categorydata['catid'],'listtemplate',true,front::$view->_style);
            }
        }
        elseif (front::get('spid')){
            $specialdata= special::getInstance()->getrow('spid='.front::get('spid'));
            $cat_template = @$specialdata['template'];
        }
        elseif (front::get('typeid')){
            $cat_template= $tempname =type::gettemplate(front::get('typeid'));
        }
        else{
            $cat_template="index-index";
        }

        $row=array();
        $add_static=true;
        foreach ($sectionssetting as $key=>$set) {
            if ($set['id'] == $tagid){
                if (isset($set['listtemplate']) && $set['listtemplate']){
                    $set['listtemplate']=array_key_exists($cat_template,$set['listtemplate'])?$set['listtemplate'][$cat_template]:$set['listtemplate']['default'];
                    $add_static=false;
                }
                 if (isset($set['shoplisttemplate']) && $set['shoplisttemplate']){
                     $set['shoplisttemplate']=array_key_exists($cat_template,$set['shoplisttemplate'])?$set['shoplisttemplate'][$cat_template]:$set['shoplisttemplate']['default'];
                     $add_static=false;
                 }
                if (isset($set['annountemplate']) && $set['annountemplate']){
                    $set['annountemplate']=array_key_exists($cat_template,$set['annountemplate'])?$set['annountemplate'][$cat_template]:$set['annountemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['shopannountemplate']) && $set['shopannountemplate']){
                    $set['shopannountemplate']=array_key_exists($cat_template,$set['shopannountemplate'])?$set['shopannountemplate'][$cat_template]:$set['shopannountemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['commentagtemplate']) && $set['commentagtemplate']){
                    $set['commentagtemplate']=array_key_exists($cat_template,$set['commentagtemplate'])?$set['commentagtemplate'][$cat_template]:$set['commentagtemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['shopcommentagtemplate']) && $set['shopcommentagtemplate']){
                    $set['shopcommentagtemplate']=array_key_exists($cat_template,$set['shopcommentagtemplate'])?$set['shopcommentagtemplate'][$cat_template]:$set['shopcommentagtemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['typetemplate']) && $set['typetemplate']){
                    $set['typetemplate']=array_key_exists($cat_template,$set['typetemplate'])?$set['typetemplate'][$cat_template]:$set['typetemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['shoptypetemplate']) && $set['shoptypetemplate']){
                    $set['shoptypetemplate']=array_key_exists($cat_template,$set['shoptypetemplate'])?$set['shoptypetemplate'][$cat_template]:$set['shoptypetemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['specialtemplate']) && $set['specialtemplate']){
                    $set['specialtemplate']=array_key_exists($cat_template,$set['specialtemplate'])?$set['specialtemplate'][$cat_template]:$set['specialtemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['shopspecialtemplate']) && $set['shopspecialtemplate']){
                    $set['shopspecialtemplate']=array_key_exists($cat_template,$set['shopspecialtemplate'])?$set['shopspecialtemplate'][$cat_template]:$set['shopspecialtemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['guestbooktemplate']) && $set['guestbooktemplate']){
                    $set['guestbooktemplate']=array_key_exists($cat_template,$set['guestbooktemplate'])?$set['guestbooktemplate'][$cat_template]:$set['guestbooktemplate']['default'];
                    $add_static=false;
                }
                if (isset($set['shopguestbooktemplate']) && $set['shopguestbooktemplate']){
                    $set['shopguestbooktemplate']=array_key_exists($cat_template,$set['shopguestbooktemplate'])?$set['shopguestbooktemplate'][$cat_template]:$set['shopguestbooktemplate']['default'];
                    $add_static=false;
                }
                $row=$set;
            }
        }
        // 如果是1 就自动生成  列表例外
        if ($tagid==1 && $add_static && $insert_static && count($sectionssetting)>0){
            $new_id=count($sectionssetting)+1;
            $sectionssetting[$new_id]=$sectionssetting[1];
            $sectionssetting[$new_id]['id']=$new_id;
            $row=$sectionssetting[$new_id];
            self::savemodulessetting($sectionssetting,$settingTemplate_file);
            $copypath=ROOT.'/template/'.$template_dir.'/visual/sections/'.$sectionstype.'/'.$sections.'/1.php';
            $newpath=ROOT.'/template/'.$template_dir.'/visual/sections/'.$sectionstype.'/'.$sections.'/'.$new_id.'.php';
            @copy($copypath,$newpath);
        }
        return $row;
    }
    //修改及时模块配置
    public function rec_sectionsupdate($tag_info, $tagid,$sectionstype,$sections)
    {
        if (!$tagid)
            return false;
        $settingTemplate_file = self::getsectionsfilename($sectionstype,$sections);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
        $sectionssetting = include $settingTemplate_file;
        //$cat_template=category::getInstance()->gettemplate(get('catid'));
        if (front::get('catid')){
            $categorydata= category::getInstance()->getrow('catid='.front::get('catid'));
            $cat_template = @$categorydata['template'];
            if (!$cat_template){
                    $cat_template = category::gettemplate($categorydata['catid'],'listtemplate',true,front::$view->_style);
            }
        }
        elseif (front::get('spid')){
            $specialdata= special::getInstance()->getrow('spid='.front::get('spid'));
            $cat_template = @$specialdata['template'];
        }
        elseif (front::get('typeid')){
            $cat_template= $tempname =type::gettemplate(front::get('typeid'));
        }
        else{
            $cat_template="index-index";
        }

        $setting = array();
        foreach ($sectionssetting as $order => $set) {
            if ($set['id'] == $tagid) {
                foreach ($tag_info as $key => $tag) {
                    if (!in_array($key, explode(',', $this->getcols()))) {
                        unset($tag_info[$key]);
                        $setting[$key] = $tag;
                    }
                }
                if($set['default'])$tag_info['default']=true;else $tag_info['default']=false;
                $setting['tagfrom']=get('tagfrom');
                $setting['title']=isset($set['title'])?$set['title']:"";
                $setting['defaultDemo']=isset($set['defaultDemo'])?$set['defaultDemo']:"";
                if (isset($setting['slidename']) && $setting['slidename'])$sectionssetting[$order]['slidename']=$setting['slidename'];
                if (isset($setting['fields']) && $setting['fields'])$sectionssetting[$order]['fields']=$setting['fields'];
                if (isset($setting['custom']) && $setting['custom'])$sectionssetting[$order]['custom']=$setting['custom'];
                if (isset($setting['codecontent']) && $setting['codecontent'])$sectionssetting[$order]['codecontent']=$setting['codecontent'];
                if (isset($setting['listtemplate']) && $setting['listtemplate'])
                    $sectionssetting[$order]['listtemplate'][$cat_template]=$setting['listtemplate'];
                if (isset($setting['shoplisttemplate']) && $setting['shoplisttemplate'])
                    $sectionssetting[$order]['shoplisttemplate'][$cat_template]=$setting['shoplisttemplate'];
                if (isset($setting['annountemplate']) && $setting['annountemplate'])
                    $sectionssetting[$order]['annountemplate'][$cat_template]=$setting['annountemplate'];
                if (isset($setting['shopannountemplate']) && $setting['shopannountemplate'])
                    $sectionssetting[$order]['shopannountemplate'][$cat_template]=$setting['shopannountemplate'];
                if (isset($setting['commentagtemplate']) && $setting['commentagtemplate'])
                    $sectionssetting[$order]['commentagtemplate'][$cat_template]=$setting['commentagtemplate'];
                if (isset($setting['shopcommentagtemplate']) && $setting['shopcommentagtemplate'])
                    $sectionssetting[$order]['shopcommentagtemplate'][$cat_template]=$setting['shopcommentagtemplate'];
                if (isset($setting['typetemplate']) && $setting['typetemplate'])
                    $sectionssetting[$order]['typetemplate'][$cat_template]=$setting['typetemplate'];
                if (isset($setting['shoptypetemplate']) && $setting['shoptypetemplate'])
                    $sectionssetting[$order]['shoptypetemplate'][$cat_template]=$setting['shoptypetemplate'];
                if (isset($setting['specialtemplate']) && $setting['specialtemplate'])
                    $sectionssetting[$order]['specialtemplate'][$cat_template]=$setting['specialtemplate'];
                if (isset($setting['shopspecialtemplate']) && $setting['shopspecialtemplate'])
                    $sectionssetting[$order]['shopspecialtemplate'][$cat_template]=$setting['shopspecialtemplate'];
                if (isset($setting['guestbooktemplate']) && $setting['guestbooktemplate'])
                    $sectionssetting[$order]['guestbooktemplate'][$cat_template]=$setting['guestbooktemplate'];
                if (isset($setting['shopguestbooktemplate']) && $setting['shopguestbooktemplate'])
                    $sectionssetting[$order]['shopguestbooktemplate'][$cat_template]=$setting['shopguestbooktemplate'];

                //多语言保存
                if (array_key_exists('text',$set) && $set['text'])
                foreach (getlang() as $langkey=>$langval){
                    $sectionssetting[$order]["text"][$langval['langurlname']]=$setting["text"][$langval['langurlname']];
                }
                unset($setting['custom']);
                $this->savemodulessetting($sectionssetting,$settingTemplate_file);
                return true;
            }
        }
        return false;
    }
    //修改图标配置
    public function rec_iconupdate($tag_info, $tagid,$sectionstype,$sections)
    {
        if (!$tagid)
            return false;
        $settingTemplate_file = self::getsectionsfilename($sectionstype,$sections);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
        $sectionssetting = include $settingTemplate_file;

        $setting = array();
        foreach ($sectionssetting as $order => $set) {
            if ($set['id'] == $tagid) {
                foreach ($tag_info as $key => $tag) {
                    if (!in_array($key, explode(',', $this->getcols()))) {
                        unset($tag_info[$key]);
                        $setting[$key] = $tag;
                    }
                }
                if($set['default'])$tag_info['default']=true;else $tag_info['default']=false;
                $setting['tagfrom']="commoncss";
                $setting['title']=$set['title'];
                $setting['defaultDemo']=$set['defaultDemo'];
                $sectionssetting[$order]['icon']=$setting['icon'];  //图标
                unset($setting['custom']);
                $this->savemodulessetting($sectionssetting,$settingTemplate_file);
                return true;
            }
        }
        return false;
    }

    //获取模板样式数据配置
    public static function getsectionsmodulesrow($pathname,$name,$isshopping=0)
    {
        $sectionssetting=array();
        if ($isshopping){
            $template_dir=config::get('template_shopping_dir');
        }else{
            $template_dir=config::get('template_dir');
        }
        $settingTemplate_file = ROOT . '/template/' .$template_dir  . '/visual/list/' .$pathname.'/'.$name.'/'.$name.'.config.php';
        if (!file_exists($settingTemplate_file))
            return array();
            /*file_put_contents(($settingTemplate_file), '<?php return array();');*/
        $sectionssetting = include $settingTemplate_file;

        return $sectionssetting;
    }
    //修改模板样式配置
    public function rec_sectionsmodulesupdate($tag_info, $pathname,$name,$isshopping=0)
    {
        if ($isshopping){
            $template_dir=config::get('template_shopping_dir');
        }else{
            $template_dir=config::get('template_dir');
        }
        $settingTemplate_file = ROOT . '/template/' .$template_dir  . '/visual/list/' .$pathname.'/'.$name.'/'.$name.'.config.php';
        if (!file_exists($settingTemplate_file))
            return false;
        $setting['custom']=$tag_info;
        $data='<?php return ' . var_export($setting, true) . ';';
        $f = fopen($settingTemplate_file,'w');
        fwrite($f,$data);
        fclose($f);
    }

    //修改组件配置
    public function rec_modulesupdate($tag_info, $tagid,$modulestype,$modules,$isbuy)
    {
        if (!$tagid)
            return false;
        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
        $modulessetting = include $settingTemplate_file;
        $setting = array();
        foreach ($modulessetting as $order => $set) {
             if (isset($set[lang::getisadmin()]) && is_array($set[lang::getisadmin()]))$set=$set[lang::getisadmin()];
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
                if ($setting['tagfrom']!="commoncss")
                $modulessetting[$order][lang::getisadmin()] = array_merge(array('id' => $tagid), $tag_info, $setting);


                $this->savemodulessetting($modulessetting,$settingTemplate_file);
                return true;
            }
        }
        return false;
    }
    //保存组件 配置
    static public function savemodulessetting($modulessetting,$settingTemplate_file)
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
        $str=explode("_",$out[1]);//0 buymodules 1 category 2 (全局)  3 组件名称 4 配置id
        $tag = self::getInstance()->getmodulesrow($str[4],$str[2],$str[3],$str[0]=="buymodules"?true:false,lang::getisadmin());
        load_sections_lang(self::getlangfilename($str[2],$str[3],$str[0]=="buymodules"?true:false,lang::getisadmin()));
        //var_dump($tag);
        if (is_array($tag)) {
            if ($tag['tagfrom'] == 'category' || $tag['tagfrom'] == 'content'
                || $tag['tagfrom'] == 'shopcategory' || $tag['tagfrom'] == 'shopcontent'
                || $tag['tagfrom'] == 'type'|| $tag['tagfrom'] == 'shoptype'
                || $tag['tagfrom'] == 'special'|| $tag['tagfrom'] == 'shopspecial'
                || $tag['tagfrom'] == 'shopcontent' || $tag['tagfrom'] == 'shopcategory'
                || $tag['tagfrom'] == 'announcement'|| $tag['tagfrom'] == 'commoncss'
                || $tag['tagfrom'] == 'shopannouncement'|| $tag['tagfrom'] == 'shopcommoncss' ){
                if (isset($tag['catid']) && is_numeric($tag['catid'])){
                    $categorydome=category::getInstance()->getrow("catid=".$tag['catid'].' and langid='.lang::getlangid(lang::getisadmin()));
                }else{
                    $categorydome="";
                }
                if (!is_array($categorydome) && $tag['tagfrom'] != 'commoncss' && is_numeric($tag['catid'])){
                    $content =  file_get_contents(self::getmodulespath($tag['defaultDemo'],$str[2],$str[3],$str[0]=="buymodules"?true:false));
                }else
                    $content = self::getmoduleslisttagcontent($tag,$str[2],$str[3],$str[0]=="buymodules"?true:false);

            }

            $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);

            $content=front::$view->compile($content);
            if ($str[0]=="buymodules"){
                $path=ROOT . '/cache/template/'.lang::getistemplate().'/buymodules/'.$str[2].'/'.$str[3];
            }else{
                $path=ROOT . '/cache/template/'.lang::getistemplate().'/' .config::get('template_dir'). '/modules/'.$str[2].'/'.$str[3];
            }
            $cacheFile=$path.'/#'.$str[4].'.php';
            if (file_exists($cacheFile)){
                unlink($cacheFile);
            };
            if (!file_exists($cacheFile)){
                if (!file_exists( $path )) {mkdir ($path,0777,true );}
                file_put_contents(($cacheFile), $content);
            }
            $content=front::$view->_eval($cacheFile);
            return  $content;
        }
    }
    //加载组件内容
    public static function getmoduleslisttagcontent($tag,$modulestype,$modules,$isbuy)
    {
        $path = self::getmodulespath($tag['id'],$modulestype,$modules,$isbuy);
        //写缓存  判断可视化打开
        if (front::$isvalue){
            $sesssion_name="visual_modules_content_".$modules.'_'.$modulestype.'_'.$tag['id'];
            $session_filetime_name="visual_modules_filetime_".$modules.'_'.$modulestype.'_'.$tag['id'];
        }else{
            $sesssion_name="modules_content_".$modules.'_'.$modulestype.'_'.$tag['id'];
            $session_filetime_name="modules_filetime_".$modules.'_'.$modulestype.'_'.$tag['id'];
        }
        if(file_exists($path)){
            $filemtime_cache=filemtime($path);
        }else{
            $filemtime_cache=0;
        }
        if (session::get($sesssion_name)!="" && session::get($session_filetime_name)!="" && session::get($session_filetime_name)>=$filemtime_cache)
            $tag_tpl_content=session::get($sesssion_name);
        else{
            $tag_tpl_content=front::$view->_eval($path,true);
            session::set($sesssion_name,$tag_tpl_content);
            session::set($session_filetime_name,$filemtime_cache);
        }
        if ($tag['tagfrom'] == 'content') {
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

            if (isset($tag['titlenum']) && $tag['titlenum'] == ''){
                $tag['titlenum']=0;
            }
            if (isset($tag['textnum']) && $tag['textnum'] == ''){
                $tag['textnum']=0;
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
            $patterns[16] = '/\$_id/';
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
            $replacements[10] = isset($tag['wheretype']) ? $tag['wheretype'] : '\'\'';
            $replacements[11] = isset($tag['tpl']) ? $tag['tpl'] : '\'\'';
            $replacements[12] = $tag['introduce_length'];
            $replacements[13] = (int)$tag['istop'];
            $replacements[14] =isset( $tag['textnum'])? $tag['textnum']:"";
            $replacements[15] = isset( $tag['titlenum'])? $tag['textnum']:"";
            $replacements[16] = $tag['id'];
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
            //var_dump($tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'category') {
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
        if (isset($tag['titlenum']) &&$tag['titlenum'] == ''){
            $tag['titlenum']=0;
        }
        if (isset($tag['textnum']) &&$tag['textnum'] == ''){
            $tag['textnum']= 0;
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
        $replacements[5] = isset($tag['son'])?$tag['son']:"";
        $replacements[6] = isset($tag['textnum'])?$tag['textnum']:"''";
        $replacements[7] = isset($tag['titlenum'])?$tag['titlenum']:"''";
        $tag['components-link-color']=isset($tag['components-link-color'])?$tag['components-link-color']:"";
        $tag['components-link-hover-color']=isset($tag['components-link-hover-color'])?$tag['components-link-hover-color']:"";
        $replacements[8] =str_replace('\'','', $tag['components-link-color']);
        $replacements[9] =str_replace('\'','', $tag['components-link-hover-color']);
        $replacements[10] =$tag['id'];
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
        if ($tag['tagfrom'] == 'special') {
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
            $replacements[] = (int)$tag['spname'];
            $replacements[] = (int)$tag['subtitle'];
            $replacements[] = (int)$tag['spcontent'];
            $replacements[] = (int)$tag['len'];
            $replacements[] = (int)$tag['spimage'];
            $replacements[] = str_replace('\'','', $tag['components-link-color']);
            $replacements[] = str_replace('\'','', $tag['components-link-hover-color']);
            $replacements[] = isset($tag['titlenum'])?$tag['titlenum']:"''";
            $replacements[] =  isset($tag['textnum'])?$tag['textnum']:"''";
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
            //var_dump($tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'type') {
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
            //var_dump($tag_config);
            //var_dump($tag_config['tyname']);
            $tag['typeid']=(isset($tag['typeid']) && $tag['typeid'])?$tag['typeid']:0;
            $replacements[] = $tag['typeid'];
            $replacements[] = (int)$tag['tyname'];
            $replacements[] = (int)$tag['subtitle'];
            $replacements[] = (int)$tag['tycontent'];
            $replacements[] = (int)$tag['len'];
            $replacements[] = (int)$tag['tyimage'];
            $replacements[] = str_replace('\'','', $tag['components-link-color']);
            $replacements[] = str_replace('\'','', $tag['components-link-hover-color']);
            $replacements[] = isset($tag['titlenum'])?$tag['titlenum']:"''";
            $replacements[] = isset($tag['textnum'])?$tag['textnum']:"''";
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
            //var_dump($replacements);

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            //var_dump($tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'announcement') {
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
            //var_dump($tag_config);
            //var_dump($tag_config['tyname']);
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
            //var_dump($replacements);

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            //var_dump($tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'commoncss') {
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
    static function tagmodules($modulesname,$lang=true)
    {
            if ($lang)$lang=lang::getistemplate(); else $lang=lang::getisadmin();
            $str=explode("_",$modulesname);//0category 1 (全局)  2 组件名称 3 配置id
            $tag = self::getInstance()->getmodulesrow($str[3],$str[1],$str[2],false,$lang);
            load_sections_lang(self::getlangfilename($str[1],$str[2],false,$lang));
            //var_dump($tag);
            if (is_array($tag)) {
                $path=ROOT . '/cache/template/'.$lang.'/' .config::get('template_dir'). '/modules/'.$str[1].'/'.$str[2];
                $config_path=self::getmodulesfilename($str[1],$str[2],false);
                $cacheFile=$path.'/#'.$str[3].'.php';
                if(file_exists($cacheFile)){
                    $filemtime_cache=filemtime($cacheFile);
                }else{
                    $filemtime_cache=0;
                }
                //php缓存
                $cache_path=ROOT . '/'.$lang.'/template/'. config::get('template_dir') . '/modules/' . $str[1] . '/';
                if (front::get("catid")){
                    $cache_path.="category/".front::get("catid").'/';
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
                        if (isset($tag['catid']) &&  is_numeric($tag['catid'])){
                            $categorydome = category::getInstance()->getrow("catid=" . $tag['catid'] . ' and langid=' . lang::getlangid($lang));
                        }else{
                            $categorydome="";
                        }
                        if ((!isset($categorydome) || !is_array($categorydome)) && $tag['tagfrom'] != 'commoncss' && is_numeric($tag['catid'])) {
                            $content = file_get_contents(self::getmodulespath($tag['defaultDemo'], $str[1], $str[2], false));
                        } else
                            $content = self::getmoduleslisttagcontent($tag, $str[1], $str[2], false);
                    }

                    $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);
                    $content = front::$view->compile($content);
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    file_put_contents(($cacheFile), $content);

                    $content=front::$view->_eval($cacheFile,true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                }
                elseif (file_exists($cache_path)) {
                    $content= front::$view->_eval($cache_path,true);
                }else{
                    $content=front::$view->_eval($cacheFile,true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                }
                return $content;
            }
            return "";
       /* }*/
    }
    //页面加载组件  购买的
    static function tagbuymodules($modulesname,$lang=true)
    {
            $str = explode("_", $modulesname);//0category 1 (全局)  2 组件名称 3 配置id
            if ($lang) $lang = lang::getistemplate(); else $lang = lang::getisadmin();
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
                        if (isset($tag['catid']) && is_numeric($tag['catid'])){
                            $categorydome = category::getInstance()->getrow("catid=" . $tag['catid'] . ' and langid=' . lang::getlangid($lang));
                        }else{
                            $categorydome="";
                        }
                        if (!is_array($categorydome) && $tag['tagfrom'] != 'commoncss' && is_numeric($tag['catid'])) {
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
                    file_put_contents(($cacheFile), $content);
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
       /* }*/
    }
    //新增配置
    public function rec_insertmodules($tag_info,$modulestype,$modules,$isbuy)
    {
        $copyid=$tag_info['id'];
        unset($tag_info['id']);
        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
        $modulessetting = include $settingTemplate_file;
        $max_id=0;
        foreach ($modulessetting as $key=>$set) {
            if ($key > $max_id)
                $max_id = $key;
        }
        $this->insert_id = $max_id + 1;

        $newtag=array();
      /*  $newtag[lang::getisadmin()]=array_merge(array('id' => $this->insert_id), $tag_info);*/

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

        //modulesname 重新生成  cmseasy_buymodules_category_common_layouts
        $newtag[lang::getisadmin()]['custom']=$tag_info['custom'];
        $newtag[lang::getisadmin()]['newmodulesname']="{tag_".($isbuy?"buymodules":"modules")."_".$newtag[lang::getisadmin()]['tagfrom']."_".$modulestype."_".$modules."_".$this->insert_id."}";
        return $newtag[lang::getisadmin()];
    }
    //复制组件loop代码文件
    public function copymodulesloop($copyid,$newid,$modulestype,$modules,$isbuy)
    {
        if ($isbuy){
            $copypath=TEMPLATE .'/'.config::get('template_dir').'/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$copyid.'.php';
            $newpath=TEMPLATE . '/'.config::get('template_dir').'/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$newid.'.php';
        } else{
            $copypath=TEMPLATE . '/' . config::get('template_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$copyid.'.php';
            $newpath=TEMPLATE . '/' . config::get('template_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$newid.'.php';

        }
        @copy($copypath,$newpath);

    }
    //删除组件配置
    public function rec_deletemodules($tagid,$modulestype,$modules,$isbuy)
    {
        if (!$tagid)
            return false;  //6 common layouts-14
        $ids = explode(',', preg_replace('/.*\(|\).*/', '', $tagid));
        $settingTemplate_file = self::getmodulesfilename($modulestype,$modules,$isbuy);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
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
            $path=TEMPLATE.'/'.config::get('template_dir') . '/visual/buymodules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';
        } else{
            $path=TEMPLATE . '/' . config::get('template_dir') . '/visual/modules/'.$modulestype.'/'.$modules.'/'.$tagid.'.php';

        }
        @unlink($path);
        return $path;
    }

    //删除sections配置
    public function rec_deletesections($tagid,$sectionstype,$sections)
    {
        if (!$tagid)
            return false;
        $settingTemplate_file = self::getsectionsfilename($sectionstype,$sections);
        if (!file_exists($settingTemplate_file))
            file_put_contents(($settingTemplate_file), '<?php return array();');
        $sectionssetting = include $settingTemplate_file;

        $count=0;
        foreach ($sectionssetting as $order => $set) {
            if ($set['id']==$tagid) {
                //删除组件loop代码文件
                $path=ROOT.'/template_admin/'.config::getadmin('template_admin_dir').'/visual/sections/'.$sectionstype.'/'.$sections.'/'.$tagid.'.php';
                @unlink($path);
                unset($sectionssetting[$order]);
                $count++;
            }
        }
        if ($count)
            $this->savemodulessetting($sectionssetting,$settingTemplate_file); //保存配置

        return $count;
    }
    //页面加载幻灯片
    static function tagslide($slidename,$out="",$isbuy="",$issections=false)
    {
            $modulespath="";
            if (is_numeric($slidename)){
                $slideconfig=slideconfig::getInstance()->getrow("id=".$slidename);
                if (is_array($slideconfig)){
                    $setting=unserialize($slideconfig['setting']);
                    $slidename=$setting[lang::getisadmin()]['slidename'];
                }
            }
            if ($issections){
                $str=explode("_",$out); //0common(全局)  1slide（模块名称）  2 （配置id） common_slide_2
                $modulespath=ROOT.'/template/'.config::get('template_dir').'/visual/sections/'.$str[0].'/'.$str[1].'/'.$str[2].'.php';

                $row = self::getsectionsrow($str[2],$str[0],$str[1]);
                $slidename=$row['slidename'];
            }
            else if ($out!=""){
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
            $path=ROOT . '/cache/template/'.lang::getistemplate().'/' .config::get('template_dir'). '/system';
            $cacheFile=$path.'/#'.pinyin::get2($slidename).'_'.$slidedata['id'].'.php';

            if (!file_exists( $path )) {mkdir ($path,0777,true );}
            file_put_contents(($cacheFile), $content);
            return front::$view->_eval($cacheFile,true);
       /* }*/
    }
    //加载幻灯片内容
    public static function getslidecontent($tag,$modulespath="")
    {
        if ($modulespath!="")
            $path=$modulespath;
        else
            $path = ROOT . '/template/' .config::get('template_dir'). '/system/slide.html';
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
            $replacements[16] = isset($tag['slide_title_size'])?$tag['slide_title_size']:"";
            $replacements[17] = isset($tag['slide_subtitle_size'])?$tag['slide_subtitle_size']:"";

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            //var_dump($tag_tpl_content);
        return $tag_tpl_content;
    }

    //页面加载表单
    static function tagform($formname)
    {
            $tables = array();
            $forms = tdatabase::getInstance()->getTables();
            foreach ($forms as $form) {
                if (preg_match('/^' . config::getdatabase('database', 'prefix') . '(my_\w+)/xi', $form['name'], $res))
                    $tables[] = $res[1];
            }
            if (in_array($formname, $tables))
                return getform($formname);
            else {
                $content = file_get_contents(ROOT . '/template_admin/' . config::getadmin('template_admin_dir') . '/visual/sections/common/1_form/1_form_dome.php');
                $content = front::$view->compile($content);

                $path = ROOT . '/cache/template_admin/' . lang::getistemplate() . '/' . config::get('template_admin_dir') . '/visual/sections/common/1_form';

                $cacheFile = $path . '/#1_form_dome.php';
                if (file_exists($cacheFile)) {
                    unlink($cacheFile);
                };
                if (!file_exists($cacheFile)) {
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    file_put_contents(($cacheFile), $content);
                }
                $content = front::$view->_eval($cacheFile);
                return $content;
            }
        /*}*/
    }
    //页面加载及时数据
    static function tagsections($sectionsname,$istemplate=0,$isshopping=0,$newadd=false)
    {

        front::$get['isshopping']=$isshopping;
            if ($istemplate)$lang=lang::getistemplate();else $lang=lang::getisadmin();
            $str=explode("_",$sectionsname);//0 (全局/栏目/内容)  1 组件名称 2 配置id
            $tag = self::getInstance()->getsectionsrow($str[2],$str[0],$str[1]);
            if ($isshopping){
                $template_dir=config::get('template_shopping_dir');
            }else{
                $template_dir=config::get('template_dir');
            }

            $lang_sections=ROOT.'/template/'.$template_dir.'/visual/sections/'.$str[0].'/'.$str[1].'/lang/'.lang::getisadmin().'/system_modules.php';
            if ((array_key_exists('listtemplate',$tag) && $tag['listtemplate']!="")
            || (array_key_exists('shoplisttemplate',$tag) && $tag['shoplisttemplate']!="")){
                if ($isshopping)$name=$tag['shoplisttemplate'];else $name=$tag['listtemplate'];
                $sectionsmodulesrow= self::getsectionsmodulesrow('listtag',$name,$isshopping);
                $tag['custom'] = isset($sectionsmodulesrow['custom'])?$sectionsmodulesrow['custom']:"";
                $lang_sections=TEMPLATE.'/'.$template_dir.'/visual/list/listtag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
            }
            else if ((array_key_exists('annountemplate',$tag) && $tag['annountemplate']!="")
            || (array_key_exists('shopannountemplate',$tag) && $tag['shopannountemplate']!="")){
                if ($isshopping)$name=$tag['shopannountemplate'];else $name=$tag['annountemplate'];
                $sectionsmodulesrow= self::getsectionsmodulesrow('listannountag',$name,$isshopping);
               $tag['custom'] = isset($sectionsmodulesrow['custom'])?$sectionsmodulesrow['custom']:"";
                $lang_sections=TEMPLATE.'/'.$template_dir.'/visual/list/listannountag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
            }
            else if ((array_key_exists('commentagtemplate',$tag) && $tag['commentagtemplate']!="")
            || (array_key_exists('shopcommentagtemplate',$tag) && $tag['shopcommentagtemplate']!="")){
                if ($isshopping)$name=$tag['shopcommentagtemplate'];else $name=$tag['commentagtemplate'];
                $sectionsmodulesrow= self::getsectionsmodulesrow('listcommenttag',$name,$isshopping);
               $tag['custom'] = isset($sectionsmodulesrow['custom'])?$sectionsmodulesrow['custom']:"";
                $lang_sections=TEMPLATE.'/'.$template_dir.'/visual/list/listcommenttag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
            }
            else if ((array_key_exists('typetemplate',$tag) && $tag['typetemplate']!="")
            || (array_key_exists('shoptypetemplate',$tag) && $tag['shoptypetemplate']!="")){
                if ($isshopping)$name=$tag['shoptypetemplate'];else $name=$tag['typetemplate'];
                $sectionsmodulesrow= self::getsectionsmodulesrow('listtypetag',$name,$isshopping);
               $tag['custom'] = isset($sectionsmodulesrow['custom'])?$sectionsmodulesrow['custom']:"";
                $lang_sections=TEMPLATE.'/'.$template_dir.'/visual/list/listtypetag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
            }
            else if ((array_key_exists('specialtemplate',$tag) && $tag['specialtemplate']!="")
            || (array_key_exists('shopspecialtemplate',$tag) && $tag['shopspecialtemplate']!="")){
                if ($isshopping)$name=$tag['shopspecialtemplate'];else $name=$tag['specialtemplate'];
                $sectionsmodulesrow= self::getsectionsmodulesrow('listspecialtag',$name,$isshopping);
               $tag['custom'] = isset($sectionsmodulesrow['custom'])?$sectionsmodulesrow['custom']:"";
                $lang_sections=TEMPLATE.'/'.$template_dir.'/visual/list/listspecialtag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
            }
            else if ((array_key_exists('guestbooktemplate',$tag) && $tag['guestbooktemplate']!="")
            || (array_key_exists('shopguestbooktemplate',$tag) && $tag['shopguestbooktemplate']!="")){
                if ($isshopping)$name=$tag['shopguestbooktemplate'];else $name=$tag['guestbooktemplate'];
                $sectionsmodulesrow= self::getsectionsmodulesrow('listguestbooktag',$name,$isshopping);
               $tag['custom'] = isset($sectionsmodulesrow['custom'])?$sectionsmodulesrow['custom']:"";
                $lang_sections=TEMPLATE.'/'.$template_dir.'/visual/list/listguestbooktag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
            }
            if (file_exists($lang_sections))
                $tag['lang_sections']=$lang_sections;

            if (is_array($tag)) {
                if ($isshopping) {
                    $path = ROOT . '/cache/template_admin/'.lang::getistemplate().'/'. config::get('template_admin_dir') . '/shop/visual/show_sections/';
                }else{
                    $path = ROOT . '/cache/template_admin/'.lang::getistemplate().'/' . config::get('template_admin_dir') . '/template/visual/show_sections/';
                }
                //php缓存
                $cache_path=ROOT . '/'.$lang.'/template/'. config::get('template_dir') . '/sections/' . $str[0] . '/';
                if (front::get('catid')){
                    $cache_path.="category/".front::get('catid').'/';
                    $path.="category/".front::get('catid').'/';
                }
                elseif (front::get('spid')){
                    $cache_path.="special/".front::get('spid').'/';
                    $path.="special/".front::get('spid').'/';
                }
                elseif (front::get('typeid')){
                    $cache_path.="type/".front::get('typeid').'/';
                    $path.="type/".front::get('typeid').'/';
                }
                elseif (front::get('aid')){
                    $cache_path.="archive/".get('aid').'/';
                    $path.="archive/".get('aid').'/';
                }
                if (front::get('page')){
                    $cache_path.="page/".front::get('page').'/';
                    $path.="page/".front::get('page').'/';
                }
                $path.= $str[0] . '/' . $str[1];
                $cacheFile=$path.'/#'.$str[2].'.php';
                $config_path = self::getsectionsfilename($str[0],$str[1]);
                if(file_exists($cacheFile)){
                    $filemtime_cache=filemtime($cacheFile);
                }else{
                    $filemtime_cache=0;
                }

                $cache_path.=$str[1].'/#'.$str[2].'.php';

                if(file_exists($cache_path)){
                    $filemtime_cache_2=filemtime($cache_path);
                }else{
                    $filemtime_cache_2=0;
                }

                if (filemtime($config_path) > $filemtime_cache || filemtime($config_path) > $filemtime_cache_2) {
                    if(file_exists($cacheFile)){
                        $filemtime_cache=filemtime($cacheFile);
                    }else{
                        $filemtime_cache=0;
                    }
                    if (filemtime($config_path)>$filemtime_cache){
                        if (isset($tag['lang_sections'])) load_sections_lang($tag['lang_sections']);
                        $content = self::getsectionscontent($tag,$str[0],$str[1],$lang,$isshopping);
                        $content = preg_replace('/\{(tag|js|sys)(_[^}]+)\}/i', '', $content);

                        $content=front::$view->compile($content);
                        if (!file_exists($cacheFile)){
                            if (!file_exists( $path )) {mkdir ($path,0777,true );}
                        }
                        file_put_contents(($cacheFile), $content);
                    }

                    $content=front::$view->_eval($cacheFile,true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                }
                elseif (file_exists($cache_path)) {
                    $content= front::$view->_eval($cache_path,true);
                }else{
                    $content=front::$view->_eval($cacheFile,true);
                    //php缓存
                    tool::mkdir(dirname($cache_path));
                    file_put_contents($cache_path, $content);  //写入缓存
                }

                //新增及时模块的时候 删除缓存  重新加载
                if ($newadd){
                    @unlink($cache_path);
                }
                return $content;

            }
            return "";
        /*}*/
    }
    //加载及时数据内容
    public static function getsectionscontent($tag,$sectionstype,$sections,$lang,$isshopping)
    {
        $patterns=array();
        $replacements=array();
        $patterns[] = '/\$_id/';
        $replacements[] = isset($tag['id'])?$tag['id']:"";
        $admin_lang=lang::getisadmin();
        $template_lang=lang::getistemplate();

        if ($isshopping){
            $template_dir=config::get('template_shopping_dir');
        }else{
            $template_dir=config::get('template_dir');
        }
        if (array_key_exists('listtemplate',$tag) && $tag['listtemplate']!=""){
            if ($isshopping)$htmlname=$tag['shoplisttemplate'];else $htmlname=$tag['listtemplate'];
            $tag_tpl_content = file_get_contents(ROOT . '/template/' . $template_dir . '/visual/list/listtag/'.$htmlname.'/'.$htmlname.'.html');
            $tag_tpl_content= str_replace("#[#","{",$tag_tpl_content);
            $tag_tpl_content= str_replace("#]#","}",$tag_tpl_content); 
        }
        else if (array_key_exists('annountemplate',$tag) && $tag['annountemplate']!=""){
            if ($isshopping)$htmlname=$tag['shopannountemplate'];else $htmlname=$tag['annountemplate'];
            $tag_tpl_content = file_get_contents(ROOT . '/template/' . $template_dir . '/visual/list/listannountag/'.$htmlname.'/'.$htmlname.'.html');
            $tag_tpl_content= str_replace("#[#","{",$tag_tpl_content);
            $tag_tpl_content= str_replace("#]#","}",$tag_tpl_content);
        }
        else if (array_key_exists('commentagtemplate',$tag) && $tag['commentagtemplate']!=""){
            if ($isshopping)$htmlname=$tag['shopcommentagtemplate'];else $htmlname=$tag['commentagtemplate'];
            $tag_tpl_content = file_get_contents(ROOT . '/template/' . $template_dir . '/visual/list/listcommenttag/'.$htmlname.'/'.$htmlname.'.html');
            $tag_tpl_content= str_replace("#[#","{",$tag_tpl_content);
            $tag_tpl_content= str_replace("#]#","}",$tag_tpl_content);
        }
        else if (array_key_exists('typetemplate',$tag) && $tag['typetemplate']!=""){
            if ($isshopping)$htmlname=$tag['shoptypetemplate'];else $htmlname=$tag['typetemplate'];
            $tag_tpl_content = file_get_contents(ROOT . '/template/' . $template_dir . '/visual/list/listtypetag/'.$htmlname.'/'.$htmlname.'.html');
            $tag_tpl_content= str_replace("#[#","{",$tag_tpl_content);
            $tag_tpl_content= str_replace("#]#","}",$tag_tpl_content);
        }
        else if (array_key_exists('specialtemplate',$tag) && $tag['specialtemplate']!=""){
            if ($isshopping)$htmlname=$tag['shopspecialtemplate'];else $htmlname=$tag['specialtemplate'];
            $tag_tpl_content = file_get_contents(ROOT . '/template/' . $template_dir . '/visual/list/listspecialtag/'.$htmlname.'/'.$htmlname.'.html');
            $tag_tpl_content= str_replace("#[#","{",$tag_tpl_content);
            $tag_tpl_content= str_replace("#]#","}",$tag_tpl_content);
        }
        else if (array_key_exists('guestbooktemplate',$tag) && $tag['guestbooktemplate']!=""){
            if ($isshopping)$htmlname=$tag['shopguestbooktemplate'];else $htmlname=$tag['guestbooktemplate'];
            $tag_tpl_content = file_get_contents(ROOT . '/template/' . $template_dir . '/visual/list/listguestbooktag/'.$htmlname.'/'.$htmlname.'.html');
            $tag_tpl_content= str_replace("#[#","{",$tag_tpl_content);
            $tag_tpl_content= str_replace("#]#","}",$tag_tpl_content);
        }
        else{
            $path = self::getsectionspath($tag['id'],$sectionstype,$sections,$isshopping);

            //区分前后台缓存
            if (front::$admin) {
                $session_name="admin_sections_content_".$sectionstype.'_'.$admin_lang.'_'.$sections.'_'.$tag['id'];
                $session_filetime_name="admin_sections_filetime_".$sectionstype.'_'.$admin_lang.'_'.$sections.'_'.$tag['id'];
            }else{
                $session_name="template_sections_content_".$sectionstype.'_'.$template_lang.'_'.$sections.'_'.$tag['id'];
                $session_filetime_name="template_sections_filetime_".$sectionstype.'_'.$template_lang.'_'.$sections.'_'.$tag['id'];
            }
            if(file_exists($path)){
                $filemtime_cache=filemtime($path);
            }else{
                $filemtime_cache=0;
            }
            //写缓存
            if (session::get($session_name)!="" && session::get($session_filetime_name)!="" && session::get($session_filetime_name)>=$filemtime_cache)
                $tag_tpl_content=session::get($session_name);
            else{
                $tag_tpl_content=front::$view->_eval($path,true);
                session::set($session_name,$tag_tpl_content);
                session::set($session_filetime_name,$filemtime_cache);
            }
        }


        $patterns[] = '/\$_id/';
        $replacements[] = $tag['id'];

        //自定义源码
        if (array_key_exists('codecontent',$tag) && $tag['codecontent']){
            $patterns[] = '/\$_codecontent/';
            $replacements[] = htmlspecialchars_decode($tag['codecontent']);
        }


        if (array_key_exists('fields',$tag)){
            $patterns[] = '/\$_fields/';
            $replacements[] = self::getfieldlist($tag['fields']);
        }

        if (array_key_exists('text',$tag) && $tag['text']){
            $patterns[] = '/\$_text/';
            $replacements[] = str_replace("\r\n","<br>",$tag['text'][$lang]);
        }

        if (array_key_exists('icon',$tag) && $tag['icon']){
            $patterns[] = '/\$_icon/';
            $replacements[] = $tag['icon'];
        }

        if (is_array($tag['custom'])){
            foreach ($tag['custom'] as $key=>$val){
                $patterns[] = '/\$_'.$key.'_name/';
                $patterns[] = '/\$_'.$key.'/';
            }
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
        return $content;
    }


    //加载自定义字段
    function getfieldlist($fieldsdata)
    {
        if ($fieldsdata!=""){
            $sets = setting::getInstance();
            $str = $str1 = $str2 = '';
            $fields = setting::$var['archive'];
            foreach ($fieldsdata as $field) {
                if (isset($fields[$field])) {
                    $newcname='cname_'.lang::getistemplate();
                    $str .= '<p><span>' . $fields[$field][$newcname] . " : " . '</span>' . '{$archive[\'' . $fields[$field]['name'] . '\']}</p>' . "\n";
                    $str1 .= '<p><span>' . $fields[$field][$newcname] . " : " . '</span>' . $fields[$field][$newcname] . '</p>';
                    /*$str2 .= $fields[$field]['name'] . ',';*/
                }
            }
            $code = "<var class='selected'>" . substr($str2, 0, -1) . "</var>\n" . $str;
            return $code;
        }
        return '<div class="codearea"> </div> <div class="viewarea"> <span>'.lang_admin('field_name').'：</span>'.lang_admin('content_custom_fields').'</div>';
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

    public static function getInstance($isadmin=false)
    {
        if (!self::$me) {
            $class = new templatetag();
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
                'select' => form::arraytoselect(array('system' => lang_admin('system'), 'function' => lang_admin('function'), 'define' => lang_admin('custom'))),
                'default' => 'define',
            ),
            'template_name' => array(
                'default' => config::get('template_dir'),
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
                file_put_contents(($langpath), '<?php return ' . var_export($setting_lang, true) . ';');
            }
        }
        return  $this->insert_id;
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
        foreach (self::$setting as $set) {
            if ($tag_info['name']!="" && $set['name'] == $tag_info['name'] && $set['name']!="") {
                front::flash(lang_admin('tags')." $tag_info[name]".lang_admin('already_exists'));
                return false;
            }
            if ($set['id'] > $max_id)
                $max_id = $set['id'];
        }
        $this->insert_id = $max_id + 1;
        $tag_info['name']=$max_id + 1;
        $tag_info = array_merge(array('id' => $max_id + 1), $tag_info, array('tagfrom' => get('tagfrom'), 'setting' => $setting));
        self::$setting[] = $tag_info;

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
        /*  $templatetag=new templatetag();
          $settingTemplate_file = self::getTemplatefilename();
          @mkdir(dirname($settingTemplate_file));
          if (!file_exists($settingTemplate_file))
              file_put_contents($settingTemplate_file, '<?php return array();');
          else
              self::$settingTemplate = include $settingTemplate_file;
          $tag = $templatetag->getrowTemplate($tagid);*/
        if ($lang)
            $tag = self::getInstance()->getrow($tagid);
        else
            $tag = self::getInstance()->getrowadmin($tagid);
        //var_dump($tag);
        if (is_array($tag)) {

            $path=ROOT . '/cache/template/'.lang::getistemplate().'/' .config::get('template_dir'). '/oldmodules'.'/'.$tag['tagfrom'];
            $cacheFile_name=pinyin::get2($tag['name']);
            $cacheFile=$path.'/#'.$cacheFile_name.'.php';

            $config_path = ROOT . '/template/' . config::get('template_dir') . '/tpltag/' . $tag['setting']['tagtemplate'];

            if(file_exists($cacheFile)){
                $filemtime_cache=filemtime($cacheFile);
            }else{
                $filemtime_cache=0;
            }
            if (filemtime($config_path)>$filemtime_cache){
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
                if (!file_exists($cacheFile)){
                    if (!file_exists( $path )) {
                        mkdir ($path,0777,true );
                    }
                    file_put_contents(iconv("utf-8", "gbk",$cacheFile), $content);
                }
            }

            return front::$view->_eval($cacheFile);
        }
        return "";
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
            $content = isset($tag['tagcontent'])?$tag['tagcontent']:"";
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
            $path=ROOT . '/cache/template/'.lang::getisadmin().'/'.'admin/oldmodules'.'/'.$tag['tagfrom'];
            $cacheFile=$path.'/#'.$tag['name'].'.php';
            if (file_exists($cacheFile)){
                unlink($cacheFile);
            };
            if (!file_exists($cacheFile)){
                if (!file_exists( $path )) {mkdir ($path,0777,true );}
                file_put_contents(($cacheFile), $content);

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
        $path = ROOT . '/template/' . config::get('template_dir') . '/tpltag/' . $tag_config['tagtemplate'];

        $tag_tpl_content = @file_get_contents($path);
        if ($tag['tagfrom'] == 'content') {
            //$tag_config['area'] = "'" . $tag_config['province_id'] . "," . $tag_config['city_id'] . "," . $tag_config['section_id'] . "'";
            $tag_config['area'] = "'0,0,0'";
            if (isset($tag_config['thumb']) && ($tag_config['thumb']=='1' || $tag_config['thumb']=='on')) {
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

            $tag['typeid']=(isset($tag['typeid']) && $tag['typeid'])?$tag['typeid']:0;
            $replacements[1] = $tag_config['typeid'];

            $tag['spid']=(isset($tag['spid']) && $tag['spid'])?$tag['spid']:0;
            $replacements[2] = $tag_config['spid'];
            $replacements[3] = $tag_config['area'];
            $replacements[4] = $tag_config['length'];
            $replacements[5] = $tag_config['ordertype']?$tag_config['ordertype']:'\'aid\'';
            $replacements[6] = $tag_config['limit'];
            $replacements[7] = $tag_config['thumb'];
            $replacements[8] = $tag_config['attr1']?$tag_config['attr1']:'\'\'';
            $replacements[9] = $tag_config['son'];
            $replacements[10] = isset($tag_config['wheretype']) ? $tag_config['wheretype'] : '\'\'';
            $replacements[11] = isset($tag_config['tpl']) ? $tag_config['tpl'] : '\'\'';
            $replacements[12] = $tag_config['introduce_length'];
            $replacements[13] = (int)$tag_config['istop'];
            $replacements[14] =isset($tag_config['textnum'])?$tag_config['textnum']:"''";
            $replacements[15] = isset($tag_config['titlenum'])?$tag_config['titlenum']:"''";


            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            //var_dump($tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'category') {
            if (isset($tag_config['catname']) && $tag_config['catname'] == 'on') {
                $tag_config['catname'] = '{$cat[catname]}';
            } else {
                $tag_config['catname'] = '';
            }
            if (isset($tag_config['categorycontent']) && $tag_config['categorycontent'] == 'on') {
                $tag_config['categorycontent'] = '{$cat[categorycontent]}';
            } else {
                $tag_config['categorycontent'] = '';
            }
            if (isset($tag_config['catimage']) && $tag_config['catimage'] == 'on') {
                $tag_config['catimage'] = '{$cat[image]}';
            } else {
                $tag_config['catimage'] = '';
            }
            if (isset($tag_config['subcat']) && $tag_config['subcat'] == 'on') {
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
            $replacements[5] = isset($tag_config['son'])?$tag_config['son']:"";
            $replacements[6] = isset($tag_config['textnum'])?$tag_config['textnum']:"''";
            $replacements[7] = isset($tag_config['titlenum'])?$tag_config['titlenum']:"''";
            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);
            $content = $tag_tpl_content;
        }

        if ($tag['tagfrom'] == 'special') {

            $patterns[] = '/\$_spid/';
            $patterns[] = '/\$_spname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_spcontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_spimage/';
            $tag_config['spid']=(isset($tag_config['spid']) && $tag_config['spid'])?$tag_config['spid']:0;
            $replacements[] = $tag_config['spid'];
            $replacements[] = (int)$tag_config['spname'];
            $replacements[] = (int)$tag_config['subtitle'];
            $replacements[] = (int)$tag_config['spcontent'];
            $replacements[] = (int)$tag_config['len'];
            $replacements[] = (int)$tag_config['spimage'];

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'type') {

            $patterns[] = '/\$_typeid/';
            $patterns[] = '/\$_tyname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_tycontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_tyimage/';
            $tag_config['typeid']=(isset($tag_config['typeid']) && $tag_config['typeid'])?$tag_config['typeid']:0;
            $replacements[] = $tag_config['typeid'];
            $replacements[] = (int)$tag_config['tyname'];
            $replacements[] = (int)$tag_config['subtitle'];
            $replacements[] = (int)$tag_config['tycontent'];
            $replacements[] = (int)$tag_config['len'];
            $replacements[] = (int)$tag_config['tyimage'];

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);

            $content = $tag_tpl_content;
        }
        if ($tag['tagfrom'] == 'announcement') {


            $patterns[] = '/\$_typeid/';
            $patterns[] = '/\$_tyname/';
            $patterns[] = '/\$_subtitle/';
            $patterns[] = '/\$_tycontent/';
            $patterns[] = '/\$_len/';
            $patterns[] = '/\$_tyimage/';
            $tag_config['typeid']=(isset($tag_config['typeid']) && $tag_config['typeid'])?$tag_config['typeid']:0;
            $replacements[] = $tag_config['typeid'];
            $replacements[] = (int)$tag_config['tyname'];
            $replacements[] = (int)$tag_config['subtitle'];
            $replacements[] = (int)$tag_config['tycontent'];
            $replacements[] = (int)$tag_config['len'];
            $replacements[] = (int)$tag_config['tyimage'];

            $tag_tpl_content = preg_replace($patterns, $replacements, $tag_tpl_content);

            $content = $tag_tpl_content;
        }

        return $content;
    }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.