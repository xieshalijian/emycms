<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
final class visualview
{
    public $_var;
    public $lang = array();
    public $lang_admin = array();

    function __construct(act $act)
    {
        $this->_var = new stdClass();
        if (isset($act->style))
            $this->_style = $act->style;
        //$this->setTemplate();
        $this->sysVar();
        //new template();
        templatetag::_getVer();
    }

    function show($string, $whole = false)
    {
        return $string;
    }

    function sysVar()
    {
        $this->base_url = config::get('base_url');
        $this->skin_path = $this->base_url . '/template/' . config::get('template_dir') . '/skin';
        $this->skin_shop_path = $this->base_url . '/template/' . config::get('template_shopping_dir') . '/skin';
        $this->skin_user_path = $this->base_url . '/template/' . config::get('template_user_dir') . '/skin';
        $this->skin_wap_path = $this->base_url . '/template/' . config::get('template_mobile_dir') . '/skin';
        $this->skin_admin_path = $this->base_url . '/template_admin/' . config::get('template_admin_dir') . '/skin';
        $this->site_map = $this->base_url . '/index.php?case=archive&act=sitemap';
        $this->template_path = $this->base_url . '/template/' . config::get('template_dir') . '';
        $this->template_shop_path = $this->base_url . '/template/' . config::get('template_shopping_dir') . '';
        $this->template_wap_path = $this->base_url . '/template/' . config::get('template_mobile_dir') . '';
        $this->template_user_path = $this->base_url . '/template/' . config::get('template_user_dir') . '';
        $this->admin_url = config::get('base_url') . '/index.php?admin_dir=' . config::get('admin_dir');
        $this->roles = session::get('roles');
        $this->site_url = config::get('site_url');
        $this->skin_buymodules =  $this->base_url . '/template/' . config::get('template_dir') . '/visual/buymodules';
        $this->skin_shop_buymodules =  $this->base_url . '/template/' . config::get('template_shopping_dir') . '/visual/buymodules';
        $this->skin_modules =  $this->base_url . '/template/' . config::get('template_dir') . '/visual/modules';
        $this->skin_shop_modules =  $this->base_url . '/template/' . config::get('template_shopping_dir') . '/visual/modules';
    }

    function adminfetch($tpl = null)
    {
        //load_custom_admin_lang('cn');   //选默认语言包  cn
        if(!$tpl){
            $tpl = 'template/visual.php';
        }else if(!in_array(fileext($tpl),array('html','php'))){
            exit(lang_custom_admin('template_file').lang_custom_admin('error'));
        }


        $this->_style = config::get('template_admin_dir') ? config::get('template_admin_dir') : 'admin';

        //var_dump($this->_style);
        //exit;
        if (strpos($tpl,ROOT.'/') !== false){
            $file = $tpl;
        }else{
            $file = TEMPLATE_ADMIN . '/' . $this->_style . '/' . $tpl;
        }

        if (strpos($tpl,ROOT.'/') !== false){
            $tpl=str_replace(ROOT.'/',"",$tpl);
        }
        if (strpos($tpl,'template/'.config::get('template_dir')) !== false){
            $tpl=str_replace('template/'.config::get('template_dir'),"",$tpl);
        }

        if (!file_exists($file)) {
            echo $file;exit(lang_custom_admin('template_file').lang_custom_admin('nonentity'));
        }
        $tFile = preg_replace('/([\w-]+)\.(\w+)$/', '#$1.$2', preg_replace('/\.html?$/ix', '.php', $tpl));
        $cacheFile = ROOT . '/cache/template/' . $this->_style . '/' . $tFile;
        tool::mkdir(dirname($cacheFile));

        if (!file_exists($cacheFile) || filemtime($cacheFile) < filemtime($file) || front::$admin && !session::get('passinfo')) {
            $source = $this->compile(file_get_contents($file));
            $cacheFile=iconv("utf-8", "gbk",$cacheFile);
            file_put_contents($cacheFile, $source);
        }
        $content = $this->_eval($cacheFile);
        return $this->show($content);
    }

    function fetch($tpl = null)
    {
        //load_custom_admin_lang('cn');   //选默认语言包  cn
        if(!$tpl){
            $tpl = $this->_tpl;
        }else if(!in_array(fileext($tpl),array('html','php'))){
            exit(lang_custom_admin('template_file').lang_custom_admin('error'));
        }

        $this->_style = config::get('template_dir');

        //var_dump($this->_style);
        if (strpos($tpl,ROOT.'/') !== false){
            $file = $tpl;
        }
        elseif (strpos($tpl,'buymodules') !== false){    //购买的组件加载
            $tpl=str_replace(ROOT.'/template/'.config::get('template_dir'),"",$tpl);
            $file = ROOT.'/data/' . $tpl;
        }
        elseif (strpos($tpl,'shop') !== false){
            $file = ROOT . '/template/'. $tpl;
        }
        else {
            $file = TEMPLATE . '/' . $this->_style . '/' . $tpl;
        }

        if (strpos($tpl,ROOT.'/') !== false){
            $tpl=str_replace(ROOT.'/',"",$tpl);
        }
        if (strpos($tpl,'template/'.config::get('template_dir')) !== false){
            $tpl=str_replace('template/'.config::get('template_dir'),"",$tpl);
        }

        if (!file_exists($file)) {
            echo $file;exit(lang_custom_admin('template_file').lang_custom_admin('nonentity'));
        }
        $tFile = preg_replace('/([\w-]+)\.(\w+)$/', '#$1.$2', preg_replace('/\.html?$/ix', '.php', $tpl));
        $cacheFile = ROOT . '/cache/template/' . $this->_style . '/' . $tFile;

        tool::mkdir(dirname($cacheFile));
        if (!file_exists($cacheFile) || filemtime($cacheFile) < filemtime($file) || front::$admin && !session::get('passinfo')) {
            $source = $this->compile(file_get_contents($file));
            $cacheFile=iconv("utf-8", "gbk",$cacheFile);
            file_put_contents($cacheFile, $source);
        }
        $content = $this->_eval($cacheFile);

        $rs = config::get('filter_word');
        $rs1 = config::get('filter_x');
        $rs = str_replace('，', ',', $rs);
        $rs1 = str_replace('，', ',', $rs1);
        $rs = explode(',', $rs);
        if (is_array($rs)) {
            foreach ($rs as $k => $v) {
                if (strtolower($v) == 'cmseasy') {
                    $rs[$k] = 'liuliwei';
                }
            }
        }
        $rs1 = explode(',', $rs1);
        $content = str_replace($rs, $rs1, $content);
        /*if (is_array($rs))
            foreach ($rs as $rp) {
            if ($rp)
                $content=str_replace(trim($rp),config::get('filter_x'),$content);
        }*/
        return $this->show($content);
    }

    function archive_tpl_list($type = '')
    {
        $dir = preg_replace('%\/.*%', '', $type);
        $_tpls = front::scan_all(TEMPLATE . '/' . config::get('template_dir') . '/' . $dir, $dir . '/');
        $tpls = array();
        foreach ($_tpls as $tpl) {
            if (preg_match('/\.htm(l)?$/', $tpl) && !preg_match('/#/', $tpl)) {
                if ($type && !preg_match("%^$type%", $tpl)) 
                    continue;
                $_tpl = str_replace('.', '_', $tpl);
                $_tpl = help::tpl_name($_tpl);
                $k_tpl = str_replace(array('/','.html'),array('-',''),$tpl);
                if ($_tpl)
                    //$_tpl = $_tpl . "(".substr($tpl,strrpos($tpl,'/')+1).")";
                    $_tpl = substr($tpl,strrpos($tpl,'/')+1).' - （'.$_tpl.')';
                else
                    $_tpl = $tpl;

                $tpls[$k_tpl] = $_tpl;
            }
        }
        //var_dump($tpls);
        return $tpls;
    }

    function render($tpl = null)
    {
        echo $this->fetch($tpl);
    }

    function _eval($file = null)
    {
        foreach ($this as $var => $value) if (!preg_match('/^_/', $var))
            $$var = $value;
        if (is_object($this->_var))
            foreach ($this->_var as $var => $value) $$var = $value;

        $file=iconv("utf-8", "gbk",$file);
        ob_start();
        if ($file)
            include $file;
        $content = ob_get_contents();
        ob_end_clean();
        $this->_var = new stdClass();
        return $content;
    }

    function compile($source)
    {
        $source = service::admin_system($source);
        //公共按钮
        $source = preg_replace('/\{setting_butoon\}/s',$this->setting_butoon("setting_butoon.php") , $source);
	$source = preg_replace('/\{setting_butoon_layouts\}/s',$this->setting_butoon("setting_butoon_layouts.php") , $source);
        $source = preg_replace('/\{setting_butoon_delete\}/s',$this->setting_butoon("setting_butoon_delete.php") , $source);
        $source = preg_replace('/\{setting_butoon_grid\}/s',$this->setting_butoon("setting_butoon_grid.php") , $source);    
        $source = preg_replace('/\{setting_butoon_type\}/s',$this->setting_butoon("setting_butoon_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_type\}/s',$this->setting_butoon("setting_butoon_shop_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_category\}/s',$this->setting_butoon("setting_butoon_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category\}/s',$this->setting_butoon("setting_butoon_shop_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_category_info\}/s',$this->setting_butoon("setting_butoon_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category_info\}/s',$this->setting_butoon("setting_butoon_shop_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_commoncss\}/s',$this->setting_butoon("setting_butoon_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_commoncss\}/s',$this->setting_butoon("setting_butoon_shop_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_content\}/s',$this->setting_butoon("setting_butoon_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_content\}/s',$this->setting_butoon("setting_butoon_shop_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_announ\}/s',$this->setting_butoon("setting_butoon_announ.php") , $source);
        $source = preg_replace('/\{setting_butoon_audio\}/s',$this->setting_butoon("setting_butoon_audio.php") , $source);
        $source = preg_replace('/\{setting_butoon_button\}/s',$this->setting_butoon("setting_butoon_button.php") , $source);
        $source = preg_replace('/\{setting_butoon_code\}/s',$this->setting_butoon("setting_butoon_code.php") , $source);
        $source = preg_replace('/\{setting_butoon_contact\}/s',$this->setting_butoon("setting_butoon_contact.php") , $source);
        $source = preg_replace('/\{setting_butoon_editor\}/s',$this->setting_butoon("setting_butoon_editor.php") , $source);
        $source = preg_replace('/\{setting_butoon_field\}/s',$this->setting_butoon("setting_butoon_field.php") , $source);
        $source = preg_replace('/\{setting_butoon_flash\}/s',$this->setting_butoon("setting_butoon_flash.php") , $source);
        $source = preg_replace('/\{setting_butoon_form-link\}/s',$this->setting_butoon("setting_butoon_form-link.php") , $source);
        $source = preg_replace('/\{setting_butoon_href\}/s',$this->setting_butoon("setting_butoon_href.php") , $source);
        $source = preg_replace('/\{setting_butoon_icon\}/s',$this->setting_butoon("setting_butoon_icon.php") , $source);
        $source = preg_replace('/\{setting_butoon_list\}/s',$this->setting_butoon("setting_butoon_list.php") , $source);
        $source = preg_replace('/\{setting_butoon_listspecial\}/s',$this->setting_butoon("setting_butoon_listspecial.php") , $source);
        $source = preg_replace('/\{setting_butoon_listtype\}/s',$this->setting_butoon("setting_butoon_listtype.php") , $source);
        $source = preg_replace('/\{setting_butoon_nav\}/s',$this->setting_butoon("setting_butoon_nav.php") , $source);
        $source = preg_replace('/\{setting_butoon_picture\}/s',$this->setting_butoon("setting_butoon_picture.php") , $source);
        $source = preg_replace('/\{setting_butoon_pictures\}/s',$this->setting_butoon("setting_butoon_pictures.php") , $source);
        $source = preg_replace('/\{setting_butoon_slide\}/s',$this->setting_butoon("setting_butoon_slide.php") , $source);
        $source = preg_replace('/\{setting_butoon_special\}/s',$this->setting_butoon("setting_butoon_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_special\}/s',$this->setting_butoon("setting_butoon_shop_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_video\}/s',$this->setting_butoon("setting_butoon_video.php") , $source);

        $source = preg_replace('/\{getread_([^}]+)\}/s', '<span class="removegetread">$1</span>{get(\'$1\')}', $source);
        $source = preg_replace('/\{langtemplate_([^}]+)\}/s', '<span class="removelang">$1</span>{lang(\'$1\')}', $source);
        $source = preg_replace('/\{langadmin_([^}]+)\}/s', '<span class="removelangadmin">$1</span>{lang_admin(\'$1\')}', $source);

        $source = preg_replace('/\{tag_sections_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',\'\',true)}', $source);
        $source = preg_replace('/\{tag_buymodules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',true)}', $source);
        $source = preg_replace('/\{tag_modules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',false)}', $source);
        $source = preg_replace('/\{tag_buymodules_shop_([^}]+)\}/s', '{shoptemplatetag::tagbuymodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_modules_shop_([^}]+)\}/s', '{shoptemplatetag::tagmodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_buymodules_([^}]+)\}/s', '{templatetag::tagbuymodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_slide_([^}]+)\}/s', '{templatetag::tagslide(\'$1\')}', $source);
        $source = preg_replace('/\{tag_shopslide_([^}]+)\}/s', '{shoptemplatetag::tagslide(\'$1\')}', $source);
        $source = preg_replace('/\{tag_modules_([^}]+)\}/s', '{templatetag::tagmodules(\'$1\')}', $source);
        $source = preg_replace('/\{tag_form_([^}]+)\}/s', '{templatetag::tagform(\'$1\')}', $source);
        $source = preg_replace('/\{tag_sections_shop_([^}]+)\}/s', '{templatetag::tagsections(\'$1\',true,1)}', $source);
        $source = preg_replace('/\{tag_sections_([^}]+)\}/s', '{templatetag::tagsections(\'$1\')}', $source);
        $source = preg_replace('/\{tag_([^}]+)\}/s', '{templatetag::tag(\'$1\')}', $source);
        $source = preg_replace('/\{tag_shop_([^}]+)\}/s', '{shoptemplatetag::tag(\'$1\')}', $source);
       /* $source = preg_replace('/#\[#cmseasy_([^}]+)#\]#/s', '{templatetag::tag(\'$1\')}', $source);*/
        $source = preg_replace('/\{js_([^}]+)\}/s', '{templatetag::js(\'$1\')}', $source);
        $source = preg_replace('/\{tagwap_([^}]+)\}/s', '{templatetagwap::tag(\'$1\')}', $source);
        $source = preg_replace('/\{jswap_([^}]+)\}/s', '{templatetagwap::js(\'$1\')}', $source);
        $source = preg_replace("/([\n\r]+)\t+/s", "\\1", $source);
        $source = preg_replace("%\/\/\{(.+?)\}%", "", $source);
        $source = preg_replace("/\{template\s+(.+)\}/", "<?php echo template(\\1); ?>", $source);
        $source = preg_replace("/\{template_shopping\s+(.+)\}/", "<?php echo template_shopping(\\1); ?>", $source);
        $source = preg_replace("/\{template_user\s+(.+)\}/", "<?php echo template_user(\\1); ?>", $source);
        $source = preg_replace("/\{template_public\s+(.+)\}/", "<?php echo template_public(\\1); ?>", $source);
        $source = preg_replace("/\{template_admin\s+(.+)\}/", "<?php echo template_admin(\\1); ?>", $source);
        $source = preg_replace("/\{autotempdir\s+(.+)\}/", "<?php echo autotempdir(\\1); ?>", $source);
        $source = preg_replace("/\{=(.+?)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace_callback("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/s", array($this, 'addquote'), $source);
        $source = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1['\\2'];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2]['\\3'];?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', '<?php echo \\3(\\1[\\2]\\4);?>', $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\3(\\1['\\2']\\4);?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\2(\\1\\3);?>", $source);
        $source = preg_replace("/\\$([a-zA-Z0-9_]+)\[([a-zA-Z0-9_]+)\]/s", "\$\\1['\\2']", $source);
        $source = "<?php defined('ROOT') or exit('Can\'t Access !'); ?>\r\n" . $source;
        //var_dump($source);
        return $source;
    }

    //可视化解析
    function viewcompile($source)
    {
        $source = service::admin_system($source);
        //公共按钮
        $source = preg_replace('/\{setting_butoon\}/s',$this->setting_butoon("setting_butoon.php") , $source);
        $source = preg_replace('/\{setting_butoon_delete\}/s',$this->setting_butoon("setting_butoon_delete.php") , $source);
        $source = preg_replace('/\{setting_butoon_layouts\}/s',$this->setting_butoon("setting_butoon_layouts.php") , $source);
        $source = preg_replace('/\{setting_butoon_grid\}/s',$this->setting_butoon("setting_butoon_grid.php") , $source);
        $source = preg_replace('/\{setting_butoon_type\}/s',$this->setting_butoon("setting_butoon_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_type\}/s',$this->setting_butoon("setting_butoon_shop_type.php") , $source);
        $source = preg_replace('/\{setting_butoon_category\}/s',$this->setting_butoon("setting_butoon_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category\}/s',$this->setting_butoon("setting_butoon_shop_category.php") , $source);
        $source = preg_replace('/\{setting_butoon_category_info\}/s',$this->setting_butoon("setting_butoon_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_category_info\}/s',$this->setting_butoon("setting_butoon_shop_category_info.php") , $source);
        $source = preg_replace('/\{setting_butoon_commoncss\}/s',$this->setting_butoon("setting_butoon_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_commoncss\}/s',$this->setting_butoon("setting_butoon_shop_commoncss.php") , $source);
        $source = preg_replace('/\{setting_butoon_content\}/s',$this->setting_butoon("setting_butoon_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_content\}/s',$this->setting_butoon("setting_butoon_shop_content.php") , $source);
        $source = preg_replace('/\{setting_butoon_announ\}/s',$this->setting_butoon("setting_butoon_announ.php") , $source);
        $source = preg_replace('/\{setting_butoon_audio\}/s',$this->setting_butoon("setting_butoon_audio.php") , $source);
        $source = preg_replace('/\{setting_butoon_button\}/s',$this->setting_butoon("setting_butoon_button.php") , $source);
        $source = preg_replace('/\{setting_butoon_code\}/s',$this->setting_butoon("setting_butoon_code.php") , $source);
        $source = preg_replace('/\{setting_butoon_contact\}/s',$this->setting_butoon("setting_butoon_contact.php") , $source);
        $source = preg_replace('/\{setting_butoon_editor\}/s',$this->setting_butoon("setting_butoon_editor.php") , $source);
        $source = preg_replace('/\{setting_butoon_field\}/s',$this->setting_butoon("setting_butoon_field.php") , $source);
        $source = preg_replace('/\{setting_butoon_flash\}/s',$this->setting_butoon("setting_butoon_flash.php") , $source);
        $source = preg_replace('/\{setting_butoon_form-link\}/s',$this->setting_butoon("setting_butoon_form-link.php") , $source);
        $source = preg_replace('/\{setting_butoon_href\}/s',$this->setting_butoon("setting_butoon_href.php") , $source);
        $source = preg_replace('/\{setting_butoon_icon\}/s',$this->setting_butoon("setting_butoon_icon.php") , $source);
        $source = preg_replace('/\{setting_butoon_list\}/s',$this->setting_butoon("setting_butoon_list.php") , $source);
        $source = preg_replace('/\{setting_butoon_listspecial\}/s',$this->setting_butoon("setting_butoon_listspecial.php") , $source);
        $source = preg_replace('/\{setting_butoon_listtype\}/s',$this->setting_butoon("setting_butoon_listtype.php") , $source);
        $source = preg_replace('/\{setting_butoon_nav\}/s',$this->setting_butoon("setting_butoon_nav.php") , $source);
        $source = preg_replace('/\{setting_butoon_picture\}/s',$this->setting_butoon("setting_butoon_picture.php") , $source);
        $source = preg_replace('/\{setting_butoon_pictures\}/s',$this->setting_butoon("setting_butoon_pictures.php") , $source);
        $source = preg_replace('/\{setting_butoon_slide\}/s',$this->setting_butoon("setting_butoon_slide.php") , $source);
        $source = preg_replace('/\{setting_butoon_special\}/s',$this->setting_butoon("setting_butoon_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_shop_special\}/s',$this->setting_butoon("setting_butoon_shop_special.php") , $source);
        $source = preg_replace('/\{setting_butoon_video\}/s',$this->setting_butoon("setting_butoon_video.php") , $source);
        $source = preg_replace('/\{getread_([^}]+)\}/s', '<span class="removegetread">$1</span>{get(\'$1\')}', $source);
        $source = preg_replace('/\{langtemplate_([^}]+)\}/s', '<span class="removelang">$1</span>{lang_admin(\'$1\')}', $source);
        $source = preg_replace('/\{langadmin_([^}]+)\}/s', '<span class="removelangadmin">$1</span>{lang_admin(\'$1\')}', $source);
        $source = preg_replace('/\{tag_sections_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',\'\',true,true)}', $source);
        $source = preg_replace('/\{tag_buymodules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',true,false,true)}', $source);
        $source = preg_replace('/\{tag_modules_slide_([^}]+)\}/s', '{templatetag::tagslide(\'\',\'$1\',false,false,true)}', $source);
        $source = preg_replace('/\{tag_buymodules_shop_([^}]+)\}/s', '{shoptemplatetag::tagbuymodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_modules_shop_([^}]+)\}/s', '{shoptemplatetag::tagmodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_buymodules_([^}]+)\}/s', '{templatetag::tagbuymodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_slide_([^}]+)\}/s', '{templatetag::tagslide(\'$1\',\'\',\'\',false,true)}', $source);
        $source = preg_replace('/\{tag_shopslide_([^}]+)\}/s', '{shoptemplatetag::tagslide(\'$1\',\'\',\'\',true)}', $source);
        $source = preg_replace('/\{tag_modules_([^}]+)\}/s', '{templatetag::tagmodules(\'$1\',false,true)}', $source);
        $source = preg_replace('/\{tag_form_([^}]+)\}/s', '{templatetag::tagform(\'$1\',true)}', $source);
        $source = preg_replace('/\{tag_sections_shop_([^}]+)\}/s', '{templatetag::tagsections(\'$1\',true,1,true)}', $source);
        $source = preg_replace('/\{tag_sections_([^}]+)\}/s', '{templatetag::tagsections(\'$1\',0,0,true)}', $source);
        $source = preg_replace('/\{tag_([^}]+)\}/s', '{templatetag::tag(\'$1\',false)}', $source);
        $source = preg_replace('/\{tag_shop_([^}]+)\}/s', '{shoptemplatetag::tag(\'$1\',false)}', $source);
        /* $source = preg_replace('/#\[#cmseasy_([^}]+)#\]#/s', '{templatetag::tag(\'$1\')}', $source);*/
        $source = preg_replace('/\{js_([^}]+)\}/s', '{templatetag::js(\'$1\')}', $source);
        $source = preg_replace('/\{tagwap_([^}]+)\}/s', '{templatetagwap::tag(\'$1\')}', $source);
        $source = preg_replace('/\{jswap_([^}]+)\}/s', '{templatetagwap::js(\'$1\')}', $source);
        $source = preg_replace("/([\n\r]+)\t+/s", "\\1", $source);
        $source = preg_replace("%\/\/\{(.+?)\}%", "", $source);
        $source = preg_replace("/\{template\s+(.+)\}/", "<?php echo template(\\1); ?>", $source);
        $source = preg_replace("/\{template_shopping\s+(.+)\}/", "<?php echo template_shopping(\\1); ?>", $source);
        $source = preg_replace("/\{template_user\s+(.+)\}/", "<?php echo template_user(\\1); ?>", $source);
        $source = preg_replace("/\{template_public\s+(.+)\}/", "<?php echo template_public(\\1); ?>", $source);
        $source = preg_replace("/\{template_admin\s+(.+)\}/", "<?php echo template_admin(\\1); ?>", $source);
        $source = preg_replace("/\{autotempdir\s+(.+)\}/", "<?php echo autotempdir(\\1); ?>", $source);
        $source = preg_replace("/\{=(.+?)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/", "<?php echo \\1;?>", $source);
        $source = preg_replace_callback("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/s", array($this, 'addquote'), $source);
        $source = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1['\\2'];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2];?>", $source);
        $source = preg_replace("/\{\\$([a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\}/s", "<?php echo \$\\1[\\2]['\\3'];?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', '<?php echo \\3(\\1[\\2]\\4);?>', $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\.([a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\3(\\1['\\2']\\4);?>", $source);
        $source = preg_replace('/\{(\\$[a-zA-Z_]+)\|([^,}]+)(.*?)\}/i', "<?php echo \\2(\\1\\3);?>", $source);
        $source = preg_replace("/\\$([a-zA-Z0-9_]+)\[([a-zA-Z0-9_]+)\]/s", "\$\\1['\\2']", $source);
        $source = preg_replace("/\#\[\#if\s+(.+?)\#\]\#/", "<?php if(\\1) { ?>", $source);
        $source = preg_replace("/\#\[\#else\#\]\#/", "<?php } else { ?>", $source);
        $source = preg_replace("/\#\[\#elseif\s+(.+?)\#\]\#/", "<?php } elseif (\\1) { ?>", $source);
        $source = preg_replace("/\#\[\#\/if\#\]\#/", "<?php } ?>", $source);
        $source = preg_replace("/\#\[\#php\s+(.+)\#\]\#/", "<?php \\1?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\\$\w+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\\$\w+)\s+(\S+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\S+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2) { ?>", $source);
        $source = preg_replace("/\#\[\#loop\s+(\S+)\s+(\S+)\s+(\S+)\#\]\#/", "<?php if(is_array(\\1))\r\n\tforeach(\\1 as \\2 => \\3) { ?>", $source);
        $source = preg_replace("/\#\[\#\/loop\#\]\#/", "<?php } ?>", $source);
        $source = preg_replace("/\#\[\#/", htmlspecialchars_decode("{"), $source);
        $source = preg_replace("/\#\]\#/", htmlspecialchars_decode("}"), $source);
        $source = "<?php defined('ROOT') or exit('Can\'t Access !'); ?>\r\n" . $source;
        //var_dump($source);
        return $source;
    }


    function setting_butoon($name){
        $setting_butoon_path=TEMPLATE_ADMIN . '/' . config::get('template_admin_dir') . '/visual/button';
        if (!file_exists( $setting_butoon_path )) {mkdir ($setting_butoon_path,0777,true );}
        $setting_butoon_path=$setting_butoon_path.'/'.$name;
        if (!file_exists( $setting_butoon_path )) {@fopen($setting_butoon_path, "w");}
        $setting_butoon=file_get_contents($setting_butoon_path);
        return $setting_butoon;
    }

    function addquote($var)
    {

        $str = "<?php echo " . str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var[1])) . ";?>";
        //var_dump($str);
        //exit;
        return $str;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
