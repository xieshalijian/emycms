<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class template_admin extends admin
{

    function init()
    {
        $this->check_pw();
        $this->_langtemplate=lang::getistemplate();
    }

    function visual_action()
    {

        front::$isvalue=true;
        front::$get['pageset']=1;
        chkpw('template_visual');
        //获取已经购买的插件
        $this->view->returndata=service::getInstance()->getlogin(false);

        if (front::get('isshopping')){
            $this->view->isshopping=1;
            $dir = config::get('template_shopping_dir');
        }else{
            $dir = config::get('template_dir');
            $this->view->isshopping=0;
        }

        $tempname =isset(front::$get['tempname'])? front::$get['tempname']: 'index-index';
        lang::settistemplate(lang::getisadmin());
        if (front::get('tempname') != 'top' && front::get('tempname') != 'bottom'){
            load_lang('system.php','system_custom.php');
            $tempheader= template('header.html');
            $tempfooter= template('footer.html');
            //加载头部
            //$tempheader=$this->view->getvisualhead($dir);
            //加载底部文件
            //$tempfooter=$this->view->getvisualfooter($dir);

        }
        $tempcontent= @file_get_contents(ROOT . '/data/template/'. $dir . '/' . str_replace('-', '/', $tempname) . '.html');

        /*增加解析*/
        $tempcontent=$this->view->viewcompile($tempcontent);

        $pathname= explode('-',$tempname);
        if(front::get('tempname')=="bottom" || front::get('tempname')=="top"){
            $pathname[0]=front::get('tempname');
            $pathname[1]=front::get('tempname');
        }
        $path=ROOT . '/cache/view/template/'.lang::getisadmin().'/'.$dir.'/'.$pathname[0];
        $cacheFile=$path.'/#'.$pathname[1] . '.html';
        if (file_exists($cacheFile)){
            unlink($cacheFile);
        };
        if (!file_exists($cacheFile)){
            if (!file_exists( $path )) {mkdir ($path,0777,true );}
            file_put_contents($cacheFile, $tempcontent);
        }
        try {
            $tempcontent=$this->view->_eval($cacheFile,true);
        } catch(Exception $e) {
            echo " Some error occured: " . $e->getMessage();
            exit;
        }
        if (front::post("refreshrigt")){
            lang::settistemplate($this->_langtemplate);
            echo service::getherf($tempcontent);;exit;
        }

        //最后恢复前台语言包
        lang::settistemplate($this->_langtemplate);

        //链接需要修改  只针对商品内页  批量替换
        $tempcontent=service::getherf($tempcontent);
        $tempheader=service::getherf($tempheader);
        $tempfooter=service::getherf($tempfooter);

        //var_dump($file);
        $this->view->tempname = $tempname;
        $this->view->tempcontent = $tempcontent;
        $this->view->tempheader = $tempheader;
        $this->view->tempfooter = $tempfooter;
        $content = $this->view->adminfetch();
        echo $content;
        exit;
    }

    function getnav_action()
    {
        nav(front::$post['id']);
        exit;
    }

    function getTel_action()
    {
        $code = '<div class="column">' . "\r\n";
        if (front::$post['tel']) {
            $code .= '<p>' . lang('tel') . '：<span class="custtag tel" rel="config::get(\'tel\')">' . config::get('tel') . '</span></p>' . "\r\n";
        }
        if (front::$post['address']) {
            $code .= '<p>' . lang('address') . '：<span class="custtag address" rel="config::get(\'address\')">' . config::get('address') . '</span></p>' . "\r\n";
        }
        if (front::$post['postcode']) {
            $code .= '<p>' . lang('postcode') . '：<span class="custtag postcode" rel="config::get(\'postcode\')">' . config::get('postcode') . '</span></p>' . "\r\n";
        }
        if (front::$post['mobile']) {
            $code .= '<p>' . lang('mobile') . '：<span class="custtag mobile" rel="config::get(\'mobile\')">' . config::get('mobile') . '</span></p>' . "\r\n";
        }
        if (front::$post['fax']) {
            $code .= '<p>' . lang('fax') . '：<span class="custtag fax" rel="config::get(\'fax\')">' . config::get('fax') . '</span></p>' . "\r\n";
        }
        if (front::$post['email']) {
            $code .= '<p>' . lang('email') . '：<span class="custtag email" rel="config::get(\'email\')">' . config::get('email') . '</span></p>' . "\r\n";
        }
        if (front::$post['complaint_email']) {
            $code .= '<p>' . lang('complaint') . '' . lang('email') . '：<span class="custtag complaint_email" rel="config::get(\'complaint_email\')">' . config::get('complaint_email') . '</span></p>' . "\r\n";
        }
        $code .= '<div class="clearfix"></div>' . "\r\n";
        $code .= '</div>' . "\r\n";
        echo $code;
        exit;
    }

    function getlist_action()
    {
        $tpl = 'visual/list/listtag/' . front::$post['listtemplate'];
        echo $this->view->visualfetch($tpl);
        exit;
    }

    function gettypelist_action()
    {
        $tpl = 'visual/list/listtypetag/' . front::$post['listtemplate'];
        echo $this->view->visualfetch($tpl);
        exit;
    }

    function getspeciallist_action()
    {
        $tpl = 'visual/list/listspecialtag/' . front::$post['listtemplate'];
        echo $this->view->visualfetch($tpl);
        exit;
    }

    function getannounlist_action()
    {
        $str = file_get_contents(ROOT . '/template/' . config::get('template_dir') . '/visual/list/listannountag/' . front::$post['annountemplate']);
        $str = preg_replace(
            array(
                '/<var id="num">\d*<\/var>/i',
                '/<var id="title_len">\d*<\/var>/i',
                '/<var id="is_date">\d*<\/var>/i',
            ),
            array(
                '<var id="num">' . front::$post['num'] . '</var>',
                '<var id="title_len">' . front::$post['title_len'] . '</var>',
                '<var id="is_date">' . front::$post['is_date'] . '</var>',
            ),
            $str
        );
        $str = preg_replace('/\{loop announ\((.*?),(.*?),(.*?)\) \$an\}/', '{loop announ(' . front::$post['num'] . ',' . front::$post['title_len'] . ',' . front::$post['is_date'] . ') \$an}', $str);
        //var_dump($str);
        $str = $this->view->compile($str);

        $path=ROOT . '/template/' . config::get('template_dir') . '/visual/list/listannountag';
        $cacheFile=$path.'/#'.front::$post['annountemplate'];
        if (!file_exists($cacheFile)){
            if (!file_exists( $path )) {mkdir ($path,0777,true );}
            file_put_contents($cacheFile, $str);
        }
        $str = $this->view->_eval($cacheFile);
        //var_dump($str);
        echo $str;
        exit;
    }

    //编辑body背景
    function editbody_action()
    {
        front::$post['appendhtml'] = stripslashes(htmlspecialchars_decode(htmlspecialchars_decode(front::$post['appendhtml'], ENT_QUOTES), ENT_QUOTES));
        $appendhtml=front::post('appendhtml');
        if ($appendhtml){
            if (front::get('isshopping')){
                $headerpath= ROOT . '/template/' . config::get('template_shopping_dir') . '/header.html';
            }else{
                $headerpath= ROOT . '/template/' . config::get('template_dir') . '/header.html';
            }
            if (file_exists($headerpath)) {
                $headerhtml=file_get_contents($headerpath);
                if (front::$get['color']){
                    $headerhtml = preg_replace('/<style name="body_background_color">(.+)<\/style>/s', '', $headerhtml);
                }elseif (front::$get['image']){
                    $headerhtml = preg_replace('/<style name="body_background_image">(.+)<\/style>/s', '', $headerhtml);
                }elseif (front::$get['positions']){
                    $headerhtml = preg_replace('/<style name="body_background_positions">(.+)<\/style>/s', '', $headerhtml);
                }elseif (front::$get['size']){
                    $headerhtml = preg_replace('/<style name="body_background_size">(.+)<\/style>/s', '', $headerhtml);
                }elseif (front::$get['attachment']){
                    $headerhtml = preg_replace('/<style name="body_background_attachment">(.+)<\/style>/s', '', $headerhtml);
                }elseif (front::$get['repeat']){
                    $headerhtml = preg_replace('/<style name="body_background_repeat">(.+)<\/style>/s', '', $headerhtml);
                }

                $headerhtml.=$appendhtml;
                file_put_contents($headerpath, $headerhtml);
            }
        }
        exit;
    }
    //清空body背景
    function deletebody_action()
    {
        if (front::get('isshopping')){
            $headerpath= ROOT . '/template/' . config::get('template_shopping_dir') . '/header.html';
        }else{
            $headerpath= ROOT . '/template/' . config::get('template_dir') . '/header.html';
        }
        if (file_exists($headerpath)) {
            $headerhtml=file_get_contents($headerpath);
            if (front::$get['color']){
                $headerhtml = preg_replace('/<style name="body_background_color">(.+)<\/style>/s', '', $headerhtml);
            }elseif (front::$get['image']){
                $headerhtml = preg_replace('/<style name="body_background_image">(.+)<\/style>/s', '', $headerhtml);
            }elseif (front::$get['positions']){
                $headerhtml = preg_replace('/<style name="body_background_positions">(.+)<\/style>/s', '', $headerhtml);
            }elseif (front::$get['size']){
                $headerhtml = preg_replace('/<style name="body_background_size">(.+)<\/style>/s', '', $headerhtml);
            }elseif (front::$get['attachment']){
                $headerhtml = preg_replace('/<style name="body_background_attachment">(.+)<\/style>/s', '', $headerhtml);
            }elseif (front::$get['repeat']){
                $headerhtml = preg_replace('/<style name="body_background_repeat">(.+)<\/style>/s', '', $headerhtml);
            }
            file_put_contents($headerpath, $headerhtml);
        }
        exit;
    }

    function getfieldlist_action()
    {
        if (is_array(front::$post['fields']) && !empty(front::$post['fields'])) {
            $sets = setting::getInstance();
            $str = $str1 = $str2 = '';
            $fields = setting::$var['archive'];
            foreach (front::$post['fields'] as $field) {
                if (isset($fields[$field])) {
                    $str .= '<p><span>' . $fields[$field]['cname'] . " : " . '</span>' . '{$archive[\'' . $fields[$field]['name'] . '\']}</p>' . "\n";
                    $str1 .= '<p><span>' . $fields[$field]['cname'] . " : " . '</span>' . $fields[$field]['cname'] . '</p>';
                    $str2 .= $fields[$field]['name'] . ',';
                }
            }
            $code = "<div class=\"codearea\">\n";
            $code .= "<var class='selected'>" . substr($str2, 0, -1) . "</var>\n" . $str;
            $code .= "</div>\n";
            $code .= "<div class=\"viewarea\">\n" . $str1;
            $code .= "</div>\n";
            echo $code;
        } else {
            echo lang_admin('no_fields_selected');
        }
        //echo $str;
        exit;
    }

    function saveCache($dir, $name, $data)
    {
        $file = ROOT . '/data/template/' . $dir . '/' . str_replace('-', '/', $name) . '.html';
        if (!is_dir(dirname($file))) {
            tool::mkdir(dirname($file));
        }
        return file_put_contents($file, $data);
    }

    function saveTemp($dir, $name, $data, $oldname,$iscopy=false,$isshopping=0)
    {
        $file = TEMPLATE . '/' . $dir . '/' . str_replace('-', '/', $name) . '.html';
        if ($iscopy){
            $copypath=TEMPLATE . '/' . $dir . '/' . str_replace('-', '/', $oldname) . '.html';
            @copy($copypath,$file);
        }
        $arr = array('top', 'bottom');
        if (!in_array($name, $arr)) {
            if ($isshopping){
                $data = '{template_shopping \'header.html\'}' . $data;
                $data = $data . '{template_shopping \'footer.html\'}';
            }else{
                $data = '{template \'header.html\'}' . $data;
                $data = $data . '{template \'footer.html\'}';
            }
        }
        return file_put_contents($file, $data);
    }

    private function saveNote($type, $name, $notename, $note = '')
    {
        $key = str_replace('-', '/', $type) . $name . '_html';
        help::$_var['template_note'][$key . '_name'] = $notename;
        help::$_var['template_note'][$key . '_note'] = $note;
        help::save();
    }

    function newtemplate_action()
    {
        $dir = config::get('template_dir');
        $file = TEMPLATE . '/' . $dir . '/' . str_replace('-', '/', front::$post['type']) . front::$post['name'] . '.html';
        if (file_exists($file)) {
            echo json_encode(array('code' => '1', 'info' => lang_admin('template_file_already_exists')));
            exit;
        } else {
            file_put_contents($file, '');
            $this->saveNote(front::$post['type'], front::$post['name'], front::$post['notename']);
        }
        echo json_encode(array('code' => '0', 'info' => front::$post['type'] . front::$post['name']));
        //echo json_encode(array('code'=>'1','info'=>'模板文件已存在'));
        exit;
    }

    function copytemplate_action()
    {
        $dir = config::get('template_dir');
        $file = TEMPLATE . '/' . $dir . '/' . str_replace('-', '/', front::$post['type']) . front::$post['name'] . '.html';
        if (file_exists($file)) {
            echo json_encode(array('code' => '1', 'info' => lang_admin('template_file_already_exists')));
            exit;
        } else {
            file_put_contents($file, file_get_contents(ROOT . '/template/' . $dir . '/' . str_replace('-', '/', front::$post['oldname']) . '.html'));
            $this->saveNote(front::$post['type'], front::$post['name'], front::$post['notename']);

        }
        $data = file_get_contents(ROOT . '/data/template/'. $dir . '/' . str_replace('-', '/', front::$post['oldname']) . '.html');
        $str = file_put_contents(ROOT . '/data/template/' . $dir . '/' . str_replace('-', '/', front::$post['type']) . front::$post['name'] . '.html', $data);
        echo json_encode(array('code' => '0', 'info' => front::$post['type'] . front::$post['name']));
        exit;
    }

    function savetemp_action()
    {
        front::$post['content'] = stripslashes(htmlspecialchars_decode(htmlspecialchars_decode(front::$post['content'], ENT_QUOTES), ENT_QUOTES));
        front::$post['tempdata'] = stripslashes(htmlspecialchars_decode(htmlspecialchars_decode(front::$post['tempdata'], ENT_QUOTES), ENT_QUOTES));
        //var_dump(front::$post['tempdata']);
        $dir = config::get('template_dir');
        $shopdir = config::get('template_shopping_dir');
        $oldname=front::$post['name'];
        $iscopy=false;
        $return_data=array();
        if (front::get("catid") && front::get("iscreateModal_template")=="new"){
            if (!strpos(front::$post['name'],'_'.front::get("catid"))){
                front::$post['name']=front::$post['name']."_".front::get("catid");
                category::getInstance()->rec_update(array("template"=>front::$post['name'].'.html'),array("catid"=>front::get("catid")));
                $iscopy=true;
            }
        }
        else if (front::get("aid")  && front::get("iscreateModal_template")=="new"){
            if (!strpos(front::$post['name'],'_'.front::get("aid")) &&  front::$post['name']!="comment/list"){
                front::$post['name']=front::$post['name']."_".front::get("aid");
                archive::getInstaznce()->rec_update(array("template"=>front::$post['name'].'.html'),array("aid"=>front::get("aid")));
                $iscopy=true;
            }
        }
        else if (front::get("spid")  && front::get("iscreateModal_template")=="new"){
            if (!strpos(front::$post['name'],'_'.front::get("spid"))){
                front::$post['name']=front::$post['name']."_".front::get("spid");
                special::getInstance()->rec_update(array("template"=>front::$post['name'].'.html'),array("spid"=>front::get("spid")));
                $iscopy=true;
            }
        }
        else if (front::get("typeid")  && front::get("iscreateModal_template")=="new"){
            if (!strpos(front::$post['name'],'_'.front::get("typeid"))){
                front::$post['name']=front::$post['name']."_".front::get("typeid");
                //提取分类
                if(file_exists(ROOT."/lib/table/type.php")) {
                    type::getInstance()->rec_update(array("template" => front::$post['name'] . '.html'), array("typeid" => front::get("typeid")));
                }
                $iscopy=true;
            }
        }
        if (front::get('isshopping')){
            $cache = $this->saveCache($shopdir, front::$post['name'], front::$post['content']);
            $temp = $this->saveTemp($shopdir, front::$post['name'], front::$post['tempdata'],$oldname,$iscopy,1);
        }
        else{
            $cache = $this->saveCache($dir, front::$post['name'], front::$post['content']);
            $temp = $this->saveTemp($dir, front::$post['name'], front::$post['tempdata'],$oldname,$iscopy);
        }

        //保存按钮的时候触发
        if (front::post("newisreload") && config::get("cache_make_open")){
            $return_data['cache_make']=front::$post['name'];
        }

        if (!$cache) {
            $return_data['message']=lang_admin('cache_write').lang_admin('failure');
            echo json_encode($return_data);
            exit;
        }
        if (!$temp) {
            $return_data['message']=lang_admin('template_writing').lang_admin('failure');
            echo json_encode($return_data);
            exit;
        }
        $return_data['message']=lang_admin('preservation').lang_admin('success');
        echo json_encode($return_data);
        exit;
    }

    function gettag_action()
    {
        preg_match('/^{tag_(.*?)}$/', front::$post['tag'], $out);
        if (isset($out[1]) && $out[1]) {
            $this->_table = new templatetag();

            $tagname=$out[1];
            if (!is_numeric($tagname))
                $tagname= "name='".$tagname."'";

            $row = $this->_table->getrowadmin($tagname);
            if (!is_array($row)){
                preg_match('/^(.*?)_(.*?)$/', $out[1], $str);//1 (全局) 2组件名称
                $filepath=TEMPLATE_ADMIN . '/' . config::get('template_admin_dir') . '/visual/sections/' . $str[1] . '/' . $str[2] . '/' . $str[2] . '.config.php';
                if (file_exists($filepath)) {
                    $row = include $filepath;
                }else{
                    $row=array();
                }
            }else
                if($row['setting']['catid']<1 || $row['setting']['catid']==""){
                    $row['setting']['catid']=0;
                }
            echo json_encode($row);
        }
        exit;
    }

    function gettaglist_action()
    {
        preg_match('/^{tag_(.*?)}$/', front::$post['tag'], $out);
        if (isset($out[1]) && $out[1]) {
            $this->_table = new templatetag();

            if (!is_numeric($out[1]))
                $out[1] = "name='".$out[1]."'";

            $row = $this->_table->getrow($out[1]);
            if($row['setting']['catid']<1 || $row['setting']['catid']==""){
                $row['setting']['catid']=0;
            }
            if ($row['setting']['catid']){
                $row['cateorydata']=category::getInstance()->getrow("catid=".$row['setting']['catid']);
            }
            echo json_encode($row);
        }
        exit;
    }

    function getshoptag_action()
    {
        preg_match('/^{tag_(.*?)}$/', front::$post['tag'], $out);
        if (isset($out[1]) && $out[1]) {
            $this->_shoptable = new shoptemplatetag();

            $tagname=$out[1];
            if (!is_numeric($tagname))
                $tagname= "name='".$tagname."'";

            $row = $this->_shoptable->getrowadmin($tagname);
            if (!is_array($row)){
                $filepath=TEMPLATE_ADMIN . '/' . config::get('template_admin_dir') . '/visual/sections/' . $str[1] . '/' . $str[2] . '/' . $str[2] . '.config.php';
                if (file_exists($filepath)) {
                    preg_match('/^(.*?)_(.*?)$/', $out[1], $str);//1 (全局) 2组件名称
                    $row = include $filepath;
                }else{
                    $row=array();
                }
            }else
                if($row['setting']['catid']<1 || $row['setting']['catid']==""){
                    $row['setting']['catid']=0;
                }
            echo json_encode($row);
        }
        exit;
    }

    function getshoptaglist_action()
    {
        preg_match('/^{tag_(.*?)}$/', front::$post['tag'], $out);
        if (isset($out[1]) && $out[1]) {
            $this->_shoptable = new shoptemplatetag();
            if (!is_numeric($out[1]))
                $out[1] = "name='".$out[1]."'";

            $row = $this->_shoptable->getrow($out[1]);
            if($row['setting']['catid']<1 || $row['setting']['catid']==""){
                $row['setting']['catid']=0;
            }
            if ($row['setting']['catid']){
                $row['cateorydata']=category::getInstance()->getrow("catid=".$row['setting']['catid']);
            }
            echo json_encode($row);
        }
        exit;
    }
    //设置幻灯片
    function gettag_slide_action()
    {
        if (!is_numeric(front::$post['tag'])){
            if (strpos(front::$post['tag'], 'tag_slide_') !== false) {
                preg_match('/^{tag_slide_(.*?)}$/', front::$post['tag'], $out);
                if (!is_numeric($out[1]))
                    $out[1]= 0;
            }else{
                //组件弹出框兼容
                $row=slide::getInstance()->getrows(null, 0,'id asc ');
                foreach ($row as $key=>$val){
                    if (front::$post['tag']==$val['name']) $row[$key]['state']=1;else $row[$key]['state']=0;
                }
                $return['id']=0;
                $return['slide']=$row;
                echo json_encode($return);
                exit;
            }
        }else{
            $out[1]= front::$post['tag'];
        }

        $where="id=".$out[1];
        $slideconfig=slideconfig::getInstance()->getrow($where);
        if (!is_array($slideconfig))$slideconfig['setting']="";
        $setting=unserialize($slideconfig['setting']);
        $setting=$setting[lang::getisadmin()];
        $row=slide::getInstance()->getrows(null, 0,'id asc ');
        foreach ($row as $key=>$val){
            if ($setting['slidename']==$val['name']) $row[$key]['state']=1;else $row[$key]['state']=0;
        }
        $return['id']=$out[1];
        $return['slide']=$row;
        echo json_encode($return);

        exit;
    }
    //保存幻灯片
    function save_slide_action()
    {
        if (front::$post['slidename']){
            if (front::$post['modulesname']){
                $this->_table = new templatetag();
                $modulesname=front::$post['modulesname'];
                unset(front::$post['modulesname']);
                preg_match('/^{tag_(.*?)}$/',$modulesname, $out);
                if (isset($out[1]) && $out[1]) {
                    //0 buymodules 1 slide 2 (全局)  3 组件名称 4 配置id
                    //0sections 1slide 2common(全局)  3slide（模块名称） 4 1（配置id）
                    $str = explode("_", $out[1]);
                    if ($str[0]=='sections') {
                        if (intval(front::$post['id']) > 0) {
                            $insert = $this->_table->rec_sectionsupdate(front::$post, front::$post['id'], $str[2], $str[3]);
                        }
                        if ($insert < 1) {
                            echo lang_admin('add_to') . lang_admin('failure');
                        } else {
                            //tag_sections_slide_common_slide_2
                            $modulesname="{tag_sections_".$str[1].'_'.$str[2].'_'.$str[3].'_'. front::$post['id'].'}';
                            preg_match('/^{tag_sections_slide_(.*?)}$/', $modulesname, $slideout);
                            $content = $this->_table->tagslide(front::$post['slidename'], $slideout[1],'',true);
                            echo '<div class="tag"><span class="removeClean tagname">' . $modulesname . '</span>';
                            echo $content;
                            echo '</div>';
                        }
                    }
                    else{
                        if (intval(front::$post['id']) > 0) {
                            $insert = $this->_table->rec_modulesupdate(front::$post, $str[4], $str[2], $str[3], $str[0] == "buymodules" ? true : false);
                        }
                        if ($insert < 1) {
                            echo lang_admin('add_to') . lang_admin('failure');
                        } else {
                            if ($str[0] == "buymodules") {
                                preg_match('/^{tag_buymodules_slide_(.*?)}$/', $modulesname, $slideout);
                                $content = $this->_table->tagslide(front::$post['slidename'], $slideout[1], true);
                            } else {
                                preg_match('/^{tag_modules_slide_(.*?)}$/', $modulesname, $slideout);
                                $content = $this->_table->tagslide(front::$post['slidename'], $slideout[1], false);
                            }

                            echo '<div class="tag"><span class="removeClean tagname">' . $modulesname . '</span>';
                            echo $content;
                            echo '</div>';
                        }
                    }
                }
            }
            else{
                if (front::$post['slide_config_id']==0){
                    $slide_config=array();
                    foreach (lang::getall() as $langval){
                        $slide_config['setting'][$langval['langurlname']]=array("slidename"=>front::$post['slidename']);
                    }
                    $slide_config['setting']=serialize($slide_config['setting']);
                    slideconfig::getInstance()->rec_insert($slide_config);
                    $newslide_config_id=slideconfig::getInstance()->insert_id();
                }else{
                    $slideconfig=slideconfig::getInstance()->getrow("id=".front::$post['slide_config_id']);
                    $slide_config=array();
                    $slide_config['setting']=unserialize($slideconfig['setting']);
                    $slide_config['setting'][lang::getisadmin()]['slidename']=front::$post['slidename'];
                    $slide_config['setting']=serialize($slide_config['setting']);
                    slideconfig::getInstance()->rec_update($slide_config,"id=".front::$post['slide_config_id']);
                    $newslide_config_id=front::$post['slide_config_id'];
                }
                $this->_table = new templatetag();
                $content=$this->_table->tagslide(front::$post['slidename']);

                $slidename="{tag_slide_".$newslide_config_id."}";
                echo '<div class="tag">';
                echo '<span class="removeClean tagname">' . $slidename . '</span>';
                echo $content;
                echo '</div>';
            }
        }
        exit;
    }
    //获取组件配置
    function getmodulestag_action()
    {
        $tagdata=front::$post['tag'];
        $returndata=array();
        if (is_array($tagdata))
            foreach ($tagdata  as $val){
                $returndata[] = $this->getmodulestagconfig($val);
            }
        else  if ($tagdata!="")
            $returndata[] = $this->getmodulestagconfig($tagdata);

        echo json_encode($returndata);
        exit;
    }
    //获取组件栏目配置
    function getmodulestaglist_action()
    {
        $tagdata=front::$post['tag'];
        $returndata=array();
        if ($tagdata!="")
            $returndata = $this->getmodulestagconfig($tagdata);
        if (is_array($returndata) && count($returndata)>0){
            $returndata['cateorydata']=category::getInstance()->getrow("catid=".$returndata['catid']);
        }
        echo json_encode($returndata);
        exit;
    }
    //获取配置
    function getmodulestagconfig($val=null){
        if (strpos($val,'tag_sections') !== false){
            if (strpos($val,'sections_slide_') !== false){
                preg_match('/^{tag_sections_slide_(.*?)}$/', $val, $out);
            }else{
                preg_match('/^{tag_sections_(.*?)}$/', $val, $out);
            }
            if (isset($out[1]) && $out[1]) {
                $str=explode("_",$out[1]);//0 (全局/栏目/内容)  1 组件名称 2 配置id
                //  {tag_sections_category_category-pagination_1}
                $this->_table = new templatetag();
                if ($str[0]=="shop")
                    $row = $this->_table->getsectionsrow($str[3],$str[1],$str[2],true);
                else
                    $row = $this->_table->getsectionsrow($str[2],$str[0],$str[1],true);
                $row['modulesname'] = $val;
                if (strpos($val,'sections_slide_') !== false){
                        $row['newmodulesname'] = "{tag_sections_slide_".$str[0]."_".$str[1]."_".$row['id']."}";
                }else{
                    if ($str[0]=="shop")
                        $row['newmodulesname'] = "{tag_sections_shop_".$str[1]."_".$str[2]."_".$row['id']."}";
                    else
                        $row['newmodulesname'] = "{tag_sections_".$str[0]."_".$str[1]."_".$row['id']."}";
                }
                $row['selecttitle'] = lang_admin('list_style');
                if (array_key_exists('fields',$row)){
                    $row['selecttitle'] = lang_admin('custom_field_properties');
                }
                $lang_sections=ROOT.'/template/'.config::get('template_dir').'/visual/sections/'.$str[0].'/'.$str[1].'/lang/'.lang::getisadmin().'/system_modules.php';
                if ((array_key_exists('listtemplate',$row) && $row['listtemplate']!="") ||
                    (array_key_exists('shoplisttemplate',$row) && $row['shoplisttemplate']!="")){
                    if (get('isshopping')) $name=$row['shoplisttemplate'];else $name=$row['listtemplate'];
                    $sectionsmodulesrow= $this->_table->getsectionsmodulesrow('listtag',$name,get('isshopping'));
                    $row['custom'] = $sectionsmodulesrow['custom'];
                    $lang_sections=TEMPLATE.'/'.config::get('template_dir').'/visual/list/listtag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
                }
                else if ((array_key_exists('annountemplate',$row) && $row['annountemplate']!="")
                    ||  (array_key_exists('shopannountemplate',$row) && $row['shopannountemplate']!="")){
                    if (get('isshopping')) $name=$row['shopannountemplate'];else $name=$row['annountemplate'];
                    $sectionsmodulesrow= $this->_table->getsectionsmodulesrow('listannountag',$name,get('isshopping'));
                    $row['custom'] = $sectionsmodulesrow['custom'];
                    $lang_sections=TEMPLATE.'/'.config::get('template_dir').'/visual/list/listannountag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
                }
                else if ((array_key_exists('commentagtemplate',$row) && $row['commentagtemplate']!="")
                    ||  (array_key_exists('shopcommentagtemplate',$row) && $row['shopcommentagtemplate']!="")){
                    if (get('isshopping')) $name=$row['shopcommentagtemplate'];else $name=$row['commentagtemplate'];
                    $sectionsmodulesrow= $this->_table->getsectionsmodulesrow('listcommenttag',$name,get('isshopping'));
                    $row['custom'] = $sectionsmodulesrow['custom'];
                    $lang_sections=TEMPLATE.'/'.config::get('template_dir').'/visual/list/listcommenttag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
                }
                else if ((array_key_exists('typetemplate',$row) && $row['typetemplate']!="")
                    ||  (array_key_exists('shoptypetemplate',$row) && $row['shoptypetemplate']!="")){
                    if (get('isshopping')) $name=$row['shoptypetemplate'];else $name=$row['typetemplate'];
                    $sectionsmodulesrow= $this->_table->getsectionsmodulesrow('listtypetag',$name,get('isshopping'));
                    $row['custom'] = $sectionsmodulesrow['custom'];
                    $lang_sections=TEMPLATE.'/'.config::get('template_dir').'/visual/list/listtypetag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
                }
                else if ((array_key_exists('specialtemplate',$row) && $row['specialtemplate']!="")
                    ||  (array_key_exists('shopspecialtemplate',$row) && $row['shopspecialtemplate']!="")){
                    if (get('isshopping')) $name=$row['shopspecialtemplate'];else $name=$row['specialtemplate'];
                    $sectionsmodulesrow= $this->_table->getsectionsmodulesrow('listspecialtag',$name,get('isshopping'));
                    $row['custom'] = $sectionsmodulesrow['custom'];
                    $lang_sections=TEMPLATE.'/'.config::get('template_dir').'/visual/list/listspecialtag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
                }
                else if ((array_key_exists('guestbooktemplate',$row) && $row['guestbooktemplate']!="")
                    ||  (array_key_exists('shopguestbooktemplate',$row) && $row['shopguestbooktemplate']!="")){
                    if (get('isshopping')) $name=$row['shopguestbooktemplate'];else $name=$row['guestbooktemplate'];
                    $sectionsmodulesrow= $this->_table->getsectionsmodulesrow('listguestbooktag',$name,get('isshopping'));
                    $row['custom'] = $sectionsmodulesrow['custom'];
                    $lang_sections=TEMPLATE.'/'.config::get('template_dir').'/visual/list/listguestbooktag/'.$name.'/lang/'.lang::getisadmin().'/system_modules.php';
                }
                if (file_exists($lang_sections))
                    $row['lang_sections']=$lang_sections;
                //标题文字转换
                if ($row['lang_sections']) load_sections_lang($row['lang_sections']);
                $row['title']=lang_sections($row['title']);
                return $row;

            }
        }
        else
            if ($val){
                preg_match('/^{tag_(.*?)}$/', $val, $out);
                if (isset($out[1]) && $out[1]) {
                    $this->_table = new templatetag();
                    $this->_shoptable = new shoptemplatetag();
                    $str=explode("_",$out[1]);//0 buymodules 1 shop 2category 3 (全局)  4组件名称 5 配置id
                    if ($str[1]=='shop') {
                        $row = $this->_shoptable->getmodulesrow($str[5],$str[3],$str[4],$str[0]=="buymodules"?true:false,lang::getisadmin());
                        if($row['catid']!="\$catid" && ($row['catid']<1 || $row['catid']=="")){
                            $row['catid']=0;
                        }
                        if (isset(front::$post['inserttag']) && front::$post['inserttag']>1){
                            $row = $this->_shoptable->rec_insertmodules($row,$str[3], $str[4], $str[0] == "buymodules" ? true : false);
                        }else{
                            $row['newmodulesname'] = $val;
                        }
                        $row['modulesname']=$val;
                        $row['lang_sections']=$this->_shoptable->getlangfilename($str[3],$str[4],$str[0]=="buymodules"?true:false,lang::getisadmin());
                    }else
                        if ($str[1]=='category' || $str[1]=='content'|| $str[1]=='slide'|| $str[1]=='type'|| $str[1]=='special' || $str[1]=='commoncss') {
                            $row = $this->_table->getmodulesrow($str[4], $str[2], $str[3], $str[0] == "buymodules" ? true : false,lang::getisadmin());

                            if ( !isset($row['catid']) || ($row['catid']!="\$catid" && ($row['catid'] < 1 || $row['catid'] == "")) ) {
                                $row['catid'] = 0;
                            }
                            if (isset(front::$post['inserttag']) &&  front::$post['inserttag']>1){
                                $row = $this->_table->rec_insertmodules($row,$str[2], $str[3], $str[0] == "buymodules" ? true : false);
                            }else {
                                $row['newmodulesname'] = $val;
                            }
                            $row['modulesname'] = $val;
                            $row['lang_sections']=$this->_table->getlangfilename($str[2],$str[3],$str[0]=="buymodules"?true:false,lang::getisadmin());
                        }
                    //标题文字转换
                    if ($row['lang_sections']) load_sections_lang($row['lang_sections']);
                    $row['title']=lang_sections($row['title']);
                    return $row;
                }
            }
    }
    //保存组件配置
    function savemoduletag_action()
    {
        $this->_table = new templatetag();
        $this->_shoptable = new shoptemplatetag();
        //$this->_table->getFields();
        $modulesname=front::$post['newmodulesname'];
        unset(front::$post['modulesname']);
        unset(front::$post['newmodulesname']);
        if (strpos($modulesname,'tag_sections') !== false){
            preg_match('/^{tag_sections_(.*?)}$/', $modulesname, $out);
            if (isset($out[1]) && $out[1]) {
                $str=explode("_",$out[1]);//0 shop 1 (全局/栏目/内容)  2 组件名称 3配置id
                if (intval(front::$post['id']) > 0) {
                    if ((isset(front::$post['listtemplate']) && front::$post['listtemplate'])
                        || (isset(front::$post['shoplisttemplate']) && front::$post['shoplisttemplate']) ){
                        $custom=front::$post['custom'];
                        unset(front::$post['custom']);
                        if (get('isshopping')){
                            $sectionsmodulesupdate_statc=front::$post['shoplisttemplate']==front::$post['oldshoplisttemplate']?true:false;
                            $name=front::$post['shoplisttemplate'];
                        }
                        else{
                            $sectionsmodulesupdate_statc=front::$post['listtemplate']==front::$post['oldlisttemplate']?true:false;
                            $name=front::$post['listtemplate'];
                        }
                        if ($sectionsmodulesupdate_statc)
                        $this->_table->rec_sectionsmodulesupdate($custom,'listtag',$name, get('isshopping'));
                    }
                    else if ((isset(front::$post['annountemplate']) && front::$post['annountemplate'])
                        || (isset(front::$post['shopannountemplate']) && front::$post['shopannountemplate'])){
                        $custom=front::$post['custom'];
                        unset(front::$post['custom']);
                        if (get('isshopping')){
                            $sectionsmodulesupdate_statc=front::$post['shopannountemplate']==front::$post['oldshopannountemplate']?true:false;
                            $name=front::$post['shopannountemplate'];
                        }else{
                            $sectionsmodulesupdate_statc=front::$post['annountemplate']==front::$post['oldannountemplate']?true:false;
                            $name=front::$post['annountemplate'];
                        }
                        if ($sectionsmodulesupdate_statc)
                        $this->_table->rec_sectionsmodulesupdate($custom,'listannountag',$name, get('isshopping'));
                    }
                    else if ((isset(front::$post['commentagtemplate']) && front::$post['commentagtemplate'])
                        || (isset(front::$post['shopcommentagtemplate']) && front::$post['shopcommentagtemplate'])){
                        $custom=front::$post['custom'];
                        unset(front::$post['custom']);
                        if (get('isshopping')){
                            $sectionsmodulesupdate_statc=front::$post['shopcommentagtemplate']==front::$post['oldshopcommentagtemplate']?true:false;
                            $name=front::$post['shopcommentagtemplate'];
                        }else{
                            $sectionsmodulesupdate_statc=front::$post['commentagtemplate']==front::$post['oldcommentagtemplate']?true:false;
                            $name=front::$post['commentagtemplate'];
                        }
                        if ($sectionsmodulesupdate_statc)
                        $this->_table->rec_sectionsmodulesupdate($custom,'listcommenttag',$name, get('isshopping'));
                    }
                    else if ((isset(front::$post['typetemplate']) && front::$post['typetemplate'])
                        || (isset(front::$post['shoptypetemplate']) && front::$post['shoptypetemplate'])){
                        $custom=front::$post['custom'];
                        unset(front::$post['custom']);
                        if (get('isshopping')){
                            $sectionsmodulesupdate_statc=front::$post['shoptypetemplate']==front::$post['oldshoptypetemplate']?true:false;
                            $name=front::$post['shoptypetemplate'];
                        }else{
                            $sectionsmodulesupdate_statc=front::$post['typetemplate']==front::$post['oldtypetemplate']?true:false;
                            $name=front::$post['typetemplate'];
                        }
                        if ($sectionsmodulesupdate_statc)
                        $this->_table->rec_sectionsmodulesupdate($custom,'listtypetag',$name, get('isshopping'));
                    }
                    else if ((isset(front::$post['specialtemplate']) && front::$post['specialtemplate'])
                        || (isset(front::$post['shopspecialtemplate']) && front::$post['shopspecialtemplate'])){
                        $custom=front::$post['custom'];
                        unset(front::$post['custom']);
                        if (get('isshopping')){
                            $sectionsmodulesupdate_statc=front::$post['shopspecialtemplate']==front::$post['oldshopspecialtemplate']?true:false;
                            $name=front::$post['shopspecialtemplate'];
                        }else{
                            $sectionsmodulesupdate_statc=front::$post['specialtemplate']==front::$post['oldspecialtemplate']?true:false;
                            $name=front::$post['specialtemplate'];
                        }
                        if ($sectionsmodulesupdate_statc)
                        $this->_table->rec_sectionsmodulesupdate($custom,'listspecialtag',$name, get('isshopping'));
                    }
                    else if ((isset(front::$post['guestbooktemplate']) && front::$post['guestbooktemplate'])
                        || (isset(front::$post['shopguestbooktemplate']) && front::$post['shopguestbooktemplate'])){
                        $custom=front::$post['custom'];
                        unset(front::$post['custom']);
                        if (get('isshopping')){
                            $sectionsmodulesupdate_statc=front::$post['shopguestbooktemplate']==front::$post['oldshopguestbooktemplate']?true:false;
                            $name=front::$post['shopguestbooktemplate'];
                        }else{
                            $sectionsmodulesupdate_statc=front::$post['guestbooktemplate']==front::$post['oldguestbooktemplate']?true:false;
                            $name=front::$post['guestbooktemplate'];
                        }
                        if ($sectionsmodulesupdate_statc)
                        $this->_table->rec_sectionsmodulesupdate($custom,'listguestbooktag',$name, get('isshopping'));
                    }

                    if ($str[0]=="shop"){
                        $insert = $this->_table->rec_sectionsupdate(front::$post, $str[3], $str[1], $str[2]);
                    }else
                        $insert = $this->_table->rec_sectionsupdate(front::$post, $str[2], $str[0], $str[1]);

                }
                if ($insert<1) {
                    echo lang_admin('add_to') . lang_admin('failure');
                }
                else {
                    $sectionsname=$out[1];
                    if ($str[0]=="shop" || get('isshopping')){
                        if(!strpos($modulesname,'sections_shop')){
                            $modulesname= str_replace('sections','sections_shop',$modulesname);
                        }
                        $sectionsname= str_replace('shop_','',$sectionsname);
                    }
                    echo '<div class="tag"><span class="removeClean tagname">' . $modulesname . '</span>';
                    if ($str[0]=="shop" || get('isshopping'))
                        echo service::getherf(templatetag::tagsections($sectionsname,0,1,true));
                    else
                        echo service::getherf(templatetag::tagsections($sectionsname,0,0,true));
                    echo '</div>';
                }
            }
        }
        else{
            preg_match('/^{tag_(.*?)}$/', $modulesname, $out);
            if (isset($out[1]) && $out[1]) {
                $str=explode("_",$out[1]);//0 buymodules 1 category 2 (全局)  3 组件名称 4 配置id
                if (intval(front::$post['id']) > 0) {
                    if ($str[1] == 'shop') {
                        $insert = $this->_shoptable->rec_modulesupdate(front::$post, $str[5], $str[3], $str[4], $str[0] == "buymodules" ? true : false);
                    } else {
                        $insert = $this->_table->rec_modulesupdate(front::$post, $str[4], $str[2], $str[3], $str[0] == "buymodules" ? true : false);
                    }
                }else{
                    $insert=0;
                }
                if ($insert<1) {
                    echo lang_admin('add_to') . lang_admin('failure');
                }
                else {
                    lang::settistemplate(lang::getisadmin());
                    //echo "{tag_".front::$post['name']."}";
                    echo '<div class="tag"><span class="removeClean tagname">' . $modulesname . '</span>';
                    if ($str[1] == 'shop' ) {
                        echo service::getherf(shoptemplatetag::tagmodulesadmin($modulesname));
                    } else
                        echo service::getherf(templatetag::tagmodulesadmin($modulesname));
                    echo '</div>';
                    lang::settistemplate($this->_langtemplate);
                }
            }
        }
        exit;

    }


    //保存样式组件配置
    function savelistmoduletag_action()
    {
        $this->_table = new templatetag();
        $this->_shoptable = new shoptemplatetag();
        $modulesname=front::$post['newmodulesname'];
        unset(front::$post['modulesname']);
        unset(front::$post['newmodulesname']);
        if (strpos($modulesname,'tag_sections') !== false){
            preg_match('/^{tag_sections_(.*?)}$/', $modulesname, $out);
            if (isset($out[1]) && $out[1]) {
                $str=explode("_",$out[1]);//0 shop 1 (全局/栏目/内容)  2 组件名称 3配置id
                if (intval(front::$post['id']) > 0) {
                    if ($str[0]=="shop"){
                        $insert = $this->_table->rec_sectionsupdate(front::$post, $str[3], $str[1], $str[2]);
                    }else
                        $insert = $this->_table->rec_sectionsupdate(front::$post, $str[2], $str[0], $str[1]);

                }
                if ($insert<1) {
                    echo lang_admin('add_to') . lang_admin('failure');
                }
                else {
                    $sectionsname=$out[1];
                    if ($str[0]=="shop" || get('isshopping')){
                        if(!strpos($modulesname,'sections_shop')){
                            $modulesname= str_replace('sections','sections_shop',$modulesname);
                        }
                        $sectionsname= str_replace('shop_','',$sectionsname);
                    }
                    echo '<div class="tag"><span class="removeClean tagname">' . $modulesname . '</span>';
                    if ($str[0]=="shop" || get('isshopping'))
                        echo service::getherf(templatetag::tagsections($sectionsname,0,1));
                    else
                        echo service::getherf(templatetag::tagsections($sectionsname,0,0));
                    echo '</div>';
                }
            }
        }
        exit;
    }

    //保存栏目信息组件配置
    function savemoduletaglist_action()
    {
        if (front::$post['catid']){
            if (front::$post['shop']){
                front::$post['categorycontent']=front::$post['shopcategorycontent'];
                front::$post['image']=front::$post['shopimage'];
            }
            $categorydata=array("catname"=>front::$post['catname'],
                "subtitle"=>front::$post['subtitle'],
                "categorycontent"=>htmlspecialchars_decode(str_replace("'", "\'", front::$post['categorycontent'])),
                "image"=>front::$post['image'],
            );
            category::getInstance()->rec_update($categorydata,"catid=".front::$post['catid']);
            category::deletesession();  //清空缓存
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/all');
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/'.front::$post['catid']);
        }
        $modulesname=front::$post['newmodulesname'];
        unset(front::$post['newmodulesname']);
        preg_match('/^{tag_(.*?)}$/', $modulesname, $out);
        if (isset($out[1]) && $out[1]) {
            $str=explode("_",$out[1]);//0 buymodules 1 category 2 (全局)  3 组件名称 4 配置id
            $returndata = $this->getmodulestagconfig($modulesname);
            if (is_array($returndata) && count($returndata)>0) {
                echo '<div class="tag"><span class="removeClean tagname">' . $modulesname . '</span>';
                if ($str[1] == 'shop' ) {
                    echo service::getherf(shoptemplatetag::tagmodulesadmin($modulesname));
                } else
                    echo service::getherf(templatetag::tagmodulesadmin($modulesname));
                echo '</div>';
            }
        }
        exit;
    }

    //删除组件配置
    function deletemoduletag_action()
    {
        $this->_table = new templatetag();
        $this->_shoptable = new shoptemplatetag();

        $modulesname=front::$post['modulesname']; //buymodules_category_common_layouts-14_6
        preg_match('/^{tag_(.*?)}$/',$modulesname, $out);
        //var_dump($out);                       //0sections 1category 2category-pagination 3 1
        if (isset($out[1]) && $out[1]) {        //0 buymodules 1shop 2 category 3 (全局)  4 组件名称 5 配置id
            $str=explode("_",$out[1]);//0 buymodules 1 category 2 (全局)  3 组件名称 4 配置id
            if ($str[0]=="buymodules" || $str[0]=="modules"){
                if ($str[1] == 'shop')
                    $rs = $this->_shoptable->rec_deletemodules($str[5],$str[3],$str[4],$str[0]=="buymodules"?true:false);
                else
                    $rs = $this->_table->rec_deletemodules($str[4], $str[2], $str[3], $str[0] == "buymodules" ? true : false);
            }
            elseif ($str[0]=="sections"){
                if (($str[1] == 'shop' || $str[1] == 'slide') && $str[4]!=1)
                    $rs = $this->_table->rec_deletesections($str[4],$str[2],$str[3]);
                else if($str[3]!=1)
                    $rs = $this->_table->rec_deletesections($str[3], $str[1], $str[2]);
            }


            echo json_encode($rs);
        }
        exit;
    }
    //动态加载栏目弹出框
    function  getcategory_action(){
        $categroyconfig=front::$post['categroyconfig'];
        $showhtml="";
        if (is_array($categroyconfig))
            foreach ($categroyconfig  as $key=>$val){
                $showhtml.=$this->categoryshow($key,$val);
            }
        $showhtml.='<div class="clearfix"></div>';
        echo json_encode($showhtml);
        exit;
    }
    //栏目显示
    function categoryshow($key,$val,$ismixing=false){
        if (isset($val['lang_sections']) && $val['lang_sections']) load_sections_lang($val['lang_sections']);
        $showhtml="";
        if ($key>0)
            $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show" id="tag-show-'.$val['id'].'" >';
        else
            $showhtml.='<div role="tabpanel" class="tab-pane active" name="tab-show"  id="tag-show-'.$val['id'].'" >';
        if($ismixing)
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshopmixing'.$val['id'].'" id="frmshopmixing'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmmixing'.$val['id'].'" id="frmmixing'.$val['id'].'" action="">';
        else
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshopcategory'.$val['id'].'" id="frmshopcategory'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmcategory'.$val['id'].'" id="frmcategory'.$val['id'].'" action="">';
        $showhtml.='<input type="hidden" name="tagfrom" value="'.$val['tagfrom'].'" class="form-control">';

        $showhtml.='<input type="hidden" name="modulesname" value="'.$val['modulesname'].'" class="form-control modulesname">';
        $showhtml.='<input type="hidden" name="newmodulesname" value="'.$val['newmodulesname'].'" class="form-control newmodulesname">';
        $showhtml.='<input type="hidden" name="id" value="'.$val['id'].'" class="form-control id">';
        if ($val['catid']!="\$catid"){
            $showhtml.='<h5 class="title">'.lang_admin('column_settings').'</h5>';
            $showhtml.='<h5 class="subtitle">'.lang_admin('column');
            $showhtml.='</h5>';
            $showhtml.= form::select('catid',$val['catid'], category::option());
            $showhtml.='<div class="clearfix blank20"></div>';
        }else{
            $showhtml.='<input type="hidden" name="catid" value="'.$val['catid'].'">';
        }
        if(isset($val['titlenum']) && $val['titlenum']!=""){
            $showhtml.='<h5 class="subtitle">'.lang_admin('number_of_headings');
            $showhtml.='</h5>';

            $showhtml.='<input placeholder="'.lang_admin('please_enter_the_caption_text_restriction').'" type="text" name="titlenum" value="'.$val['titlenum'].'" class="titlenum form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
            $showhtml.='<div class="clearfix blank20"></div>';

        }
        if(isset($val['textnum']) && $val['textnum']!="") {
            $showhtml .= '<h5 class="subtitle">' . lang_admin('number_of_column_words');
            $showhtml .= '</h5>';

            $showhtml .= '<input placeholder="' . lang_admin('please_enter_text_restrictions_on_cover_content') . '" type="text" name="textnum" value="' . $val['textnum'] . '" class="textnum form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
            $showhtml.='<div class="clearfix blank20"></div>';
        }
        $showhtml.='<div class="clearfix blank20"></div><div class="assembly-color"><h5 class="title">'.lang_admin('custom').'</h5>';
        //自定义配置
        if (isset($val['custom']) && is_array($val['custom']))
            foreach ($val['custom'] as $customkey=>$customval){
                if ($customval['type']=="text"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" value="'.$customval['value'].'" class="'.$customkey.' form-control" >';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else if ($customval['type']=="color"){
                    $showhtml.='<div id="'.$customkey.$val['id'].'" class="colorpicker-element"><div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';
                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" id="'.$customkey.$val['id'].'" value="'.$customval['value'].'" class="form-control" />';
                    $showhtml.='<span class="input-group-addon">';
                    $showhtml.='<i></i>';
                    $showhtml.='</span>';
                    $showhtml.='</div></div><div class="clearfix blank20"></div>';
                    $showhtml.='<script type="text/javascript">$(function () { $("#'.$customkey.$val['id'].'").colorpicker(); }); </script>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                }
                else if ($customval['type']=="select"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<select   name="custom['.$customkey.'][value]" class="form-control select '.$customkey.'">';
                    if ($customval['select']){
                        $select = explode(',',$customval['select']);
                        foreach ($select as $selectval){
                            $showselect = explode('/',$selectval);
                            if($customval['value']==$showselect[0]){
                                $showhtml.='<option value="'.$showselect[0].'" selected>'.$showselect[1].'</option>';
                            }else{
                                $showhtml.='<option value="'.$showselect[0].'" >'.$showselect[1].'</option>';
                            }

                        }
                    }else{
                        $showhtml.='<option value="0" selected="">请选择...</option>';
                    }
                    $showhtml.='</select>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][select]" value="'.$customval['select'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
            }
        $showhtml.='</div></div><div class="clearfix"></div></div></div></form></div>';
        return   $showhtml;
    }
    //动态加载内容弹出框
    function  getcontent_action(){
        $contentconfig=front::$post['contentconfig'];
        $set=settings::getInstance();
        $sets=$set->getrow(array('tag'=>'table-archive'));
        $ds=unserialize($sets['value']);
        preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%s',$ds['attr1'],$result,PREG_SET_ORDER);
        $sdata=array();
        foreach ($result as $res) $sdata[$res[1]]=$res[2];

        if (is_array($contentconfig))
            foreach ($contentconfig  as $key=>$val){
                $showhtml.=$this->contentshow($key,$val,$sdata);
            }
        $showhtml.='<div class="clearfix"></div>';
        echo json_encode($showhtml);
        exit;
    }
    //内容显示
    function contentshow($key,$val,$sdata,$ismixing=false){
        if ($val['lang_sections']) load_sections_lang($val['lang_sections']);
        $showhtml="";
        if ($key>0)
            $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show" id="tag-show-'.$val['id'].'" >';
        else
            $showhtml.='<div role="tabpanel" class="tab-pane active" name="tab-show"  id="tag-show-'.$val['id'].'" >';
        if($ismixing)
            if (front::get('shop'))
                $showhtml.='<form method="post" id="frmshopmixing'.$val['id'].'" name="frmmixing'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" id="frmmixing'.$val['id'].'" name="frmmixing'.$val['id'].'" action="">';
        else
            if (front::get('shop'))
                $showhtml.='<form method="post" id="frmshopcontent'.$val['id'].'" name="frmshopcontent'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" id="frmcontent'.$val['id'].'" name="frmcontent'.$val['id'].'" action="">';
        $showhtml.='<input type="hidden" name="tagfrom" value="'.$val['tagfrom'].'" class="form-control">';
        $showhtml.='<input type="hidden" name="modulesname" value="'.$val['modulesname'].'" class="form-control modulesname">';
        $showhtml.='<input type="hidden" name="newmodulesname" value="'.$val['newmodulesname'].'" class="form-control newmodulesname">';
        $showhtml.='<input type="hidden" name="id" value="'.$val['id'].'" class="form-control id">';
        $showhtml.='<h5 class="title">'.lang_admin('content_settings').'</h5>';
        if ($val['catid']!="\$catid"){
            $showhtml.='<h5 class="subtitle">';
            $showhtml.=lang_admin('column').'</h5>';
            $showhtml.= form::select('catid',$val['catid'], category::option());
        }else{
            $showhtml.='<input type="hidden" name="catid" value="'.$val['catid'].'">';
        }
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<h5 class="subtitle">';
        $showhtml.=lang_admin('subcolumn').'</h5>';
        $showhtml.='<select  name="son" class="form-control select son">';
        $showhtml.='<option value="1" '.($val['son']?'selected':'').'>'.lang_admin('yes').'</option>';
        $showhtml.='<option value="0" '.($val['son']==0?'selected':'').'>'.lang_admin('no').' </option>';
        $showhtml.='</select>';
        $showhtml.='<div class="clearfix blank20"></div>';
        //提取分类
        if(file_exists(ROOT."/lib/table/type.php")) {
            $showhtml.='<h5 class="subtitle">';
            $showhtml.=lang_admin('type').'</h5>';
            $showhtml .= form::select('typeid', $val['typeid'], type::option());
            $showhtml.='<div class="clearfix blank20"></div>';
        }
        //提取
        if(file_exists(ROOT."/lib/table/special.php")) {
            $showhtml .= '<h5 class="subtitle">';
            $showhtml .= lang_admin('special') . ' </h5>';
            $showhtml .= form::select('spid', $val['spid'], special::option());
            $showhtml .= '<div class="clearfix blank20"></div>';
        }
        $showhtml.='<h5 class="subtitle">';
        $showhtml.=lang_admin('number_of_caption_intercepted_words');
        $showhtml.='</h5>';
        $showhtml.='<input type="text" name="length" value="'.$val['length'].'" class="length form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<h5 class="subtitle">';
        $showhtml.=lang_admin('introduction_of_intercepted_words');
        $showhtml.='</h5>';
        $showhtml.='<input type="text" name="introduce_length"  value="'.$val['introduce_length'].'" class="form-control introduce_length" oninput="value=value.replace(/[^\d]/g,\'\')">';
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<h5 class="subtitle">'.lang_admin('sort').'</h5>';
        $showhtml.='<select  name="ordertype" class="form-control ordertype select">';
        $showhtml.='<option value="adddate-desc" '.($val['ordertype']=='adddate-desc'?'selected':'').'>'.lang_admin('contact_informationupdate_in_reverse_chronological_order').' </option>';
        $showhtml.='<option value="aid-desc" '.($val['ordertype']=='aid-desc'?'selected':'').'>'.lang_admin('latest_in_reverse_order_of_aids').'</option>';
        $showhtml.='<option value="aid-asc" '.($val['ordertype']=='aid-asc'?'selected':'').'>'.lang_admin('earliest_in_order_of_aids').'</option>';
        $showhtml.='<option value="view-desc" '.($val['ordertype']=='view-desc'?'selected':'').'>'.lang_admin('hottest_in_reverse_order_of_view').'</option>';
        $showhtml.='<option value="comment_num-desc" '.($val['ordertype']=='comment_num-desc'?'selected':'').'>'.lang_admin('comments_in_reverse_order_of_comment_num').'</option>';
        $showhtml.='<option value="rand()" '.($val['ordertype']=='rand()'?'selected':'').'>'.lang_admin('random').'</option>';
        $showhtml.='</select>';
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<h5 class="subtitle">'.lang_admin('call_top_content').' </h5>';
        $showhtml.='<select  name="istop" class="form-control istop select">';
        $showhtml.='<option value="0" '.($val['istop']=='0'?'selected':'').'>'.lang_admin('no').'</option>';
        $showhtml.='<option value="1" '.($val['istop']?'selected':'').'>'.lang_admin('yes').'</option>';
        $showhtml.='</select>';
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<h5 class="subtitle">'.lang_admin('number_of_call_records').'</h5>';
        $showhtml.='<input type="text" name="limit" value="'.$val['limit'].'" class="limit form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
        $showhtml.='<input type="checkbox" '.($val['thumb']=='on'?'checked':'').' value="'.($val['thumb']=='on'?1:0).'" class="thumb"  id="thumbcheckbox'.$val['id'].'"  >  '.lang_admin('thumbnail');
        $showhtml.='<input type="hidden" name="thumb" id="thumb'.$val['id'].'" value="'.$val['thumb'].'" />';
        $showhtml.='<script>
                            $("#thumbcheckbox'.$val['id'].'").click(function(){
                                            if ($(this).is(":checked")) {
                                                $("#thumb'.$val['id'].'").val("on");
                                            } else {
                                                $("#thumb'.$val['id'].'").val("off");
                                            }
                                        });
                              </script>';
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<h5 class="subtitle">'.lang_admin('recommendation_bit').'</h5>';
        $showhtml.=form::select('attr1', $val['attr1'], $sdata);
        $showhtml.='<div class="assembly-color"><h5 class="title">'.lang_admin('custom').'</h5>';
        //自定义配置
        if (is_array($val['custom']))
            foreach ($val['custom'] as $customkey=>$customval){
                if ($customval['type']=="text"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" value="'.$customval['value'].'" class="'.$customkey.' form-control" >';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else if ($customval['type']=="color"){
                    $showhtml.='<div id="'.$customkey.$val['id'].'" class="colorpicker-element"><div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';
                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" id="'.$customkey.$val['id'].'" value="'.$customval['value'].'" class="form-control" />';
                    $showhtml.='<span class="input-group-addon">';
                    $showhtml.='<i></i>';
                    $showhtml.='</span>';
                    $showhtml.='</div></div><div class="clearfix blank20"></div>';
                    $showhtml.='<script type="text/javascript">$(function () { $("#'.$customkey.$val['id'].'").colorpicker(); }); </script>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                }
                else if ($customval['type']=="select"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<select   name="custom['.$customkey.'][value]" class="form-control select '.$customkey.'">';
                    if ($customval['select']){
                        $select = explode(',',$customval['select']);
                        foreach ($select as $selectval){
                            $showselect = explode('/',$selectval);
                            if($customval['value']==$showselect[0]){
                                $showhtml.='<option value="'.$showselect[0].'" selected>'.$showselect[1].'</option>';
                            }else{
                                $showhtml.='<option value="'.$showselect[0].'" >'.$showselect[1].'</option>';
                            }

                        }
                    }else{
                        $showhtml.='<option value="0" selected="">请选择...</option>';
                    }
                    $showhtml.='</select>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][select]" value="'.$customval['select'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
            }

        $showhtml.='</div></div><div class="clearfix"></div></div></div></form></div>';
        return $showhtml;
    }
    //动态加载分类弹出框
    function  gettype_action(){
        $typeconfig=front::$post['typeconfig'];
        $showhtml="";
        if (is_array($typeconfig))
            foreach ($typeconfig  as $key=>$val){
                $showhtml.=$this->typeshow($key,$val);
            }
        $showhtml.='<div class="clearfix"></div>';
        echo json_encode($showhtml);
        exit;
    }
    //分类显示
    function typeshow($key,$val,$ismixing=false){
        if ($val['lang_sections']) load_sections_lang($val['lang_sections']);
        $showhtml="";
        if ($key>0)
            $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show" id="tag-show-'.$val['id'].'" >';
        else
            $showhtml.='<div role="tabpanel" class="tab-pane active" name="tab-show"  id="tag-show-'.$val['id'].'" >';
        if($ismixing)
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshopmixing'.$val['id'].'" id="frmmixing'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmmixing'.$val['id'].'" id="frmmixing'.$val['id'].'" action="">';
        else
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshoptype'.$val['id'].'" id="frmshoptype'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmtype'.$val['id'].'" id="frmtype'.$val['id'].'" action="">';
        $showhtml.='<input type="hidden" name="tagfrom" value="'.$val['tagfrom'].'" class="form-control">';

        $showhtml.='<input type="hidden" name="modulesname" value="'.$val['modulesname'].'" class="form-control modulesname">';
        $showhtml.='<input type="hidden" name="newmodulesname" value="'.$val['newmodulesname'].'" class="form-control newmodulesname">';
        $showhtml.='<input type="hidden" name="id" value="'.$val['id'].'" class="form-control id">';
        $showhtml.='<h5 class="title">'.lang_admin('type_settings').'</h5>';
        if ($val['typeid']!="\$typeid" && file_exists(ROOT."/lib/table/type.php") ){
            $showhtml.='<h5 class="subtitle">'.lang_admin('type');
            $showhtml.='</h5>';
            $showhtml.= form::select('typeid',$val['typeid'], type::option());
        }else{
            $showhtml.='<input type="hidden" name="typeid" value="'.$val['typeid'].'">';
        }
        $showhtml.='<div class="clearfix blank20"></div>';
        if($val['titlenum']!=""){
            $showhtml.='<h5 class="subtitle">'.lang_admin('number_of_headings');
            $showhtml.='</h5>';
            $showhtml.='<input placeholder="'.lang_admin('please_enter_the_caption_text_restriction').'" type="text" name="titlenum" value="'.$val['titlenum'].'" class="titlenum form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
        }
        $showhtml.='<div class="clearfix blank20"></div>';
        if($val['textnum']!="") {
            $showhtml .= '<h5 class="subtitle">' . lang_admin('number_of_column_words');
            $showhtml .= '</h5>';
            $showhtml .= '<input placeholder="' . lang_admin('please_enter_text_restrictions_on_cover_content') . '" type="text" name="textnum" value="' . $val['textnum'] . '" class="textnum form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
        }
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<div class="assembly-color"><h5 class="title">'.lang_admin('custom').'</h5>';
        //自定义配置
        if (is_array($val['custom']))
            foreach ($val['custom'] as $customkey=>$customval){
                if ($customval['type']=="text"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" value="'.$customval['value'].'" class="'.$customkey.' form-control" >';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else if ($customval['type']=="color"){
                    $showhtml.='<div id="'.$customkey.$val['id'].'" class="colorpicker-element"><div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';
                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" id="'.$customkey.$val['id'].'" value="'.$customval['value'].'" class="form-control" />';
                    $showhtml.='<span class="input-group-addon">';
                    $showhtml.='<i></i>';
                    $showhtml.='</span>';
                    $showhtml.='</div></div><div class="clearfix blank20"></div>';
                    $showhtml.='<script type="text/javascript">$(function () { $("#'.$customkey.$val['id'].'").colorpicker(); }); </script>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                }
                else if ($customval['type']=="select"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<select   name="custom['.$customkey.'][value]" class="form-control select '.$customkey.'">';
                    if ($customval['select']){
                        $select = explode(',',$customval['select']);
                        foreach ($select as $selectval){
                            $showselect = explode('/',$selectval);
                            if($customval['value']==$showselect[0]){
                                $showhtml.='<option value="'.$showselect[0].'" selected>'.$showselect[1].'</option>';
                            }else{
                                $showhtml.='<option value="'.$showselect[0].'" >'.$showselect[1].'</option>';
                            }

                        }
                    }else{
                        $showhtml.='<option value="0" selected="">请选择...</option>';
                    }
                    $showhtml.='</select>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][select]" value="'.$customval['select'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
            }
        $showhtml.='</div></div><div class="clearfix"></div></div></div></form></div>';
        return   $showhtml;
    }
    //动态加载专题弹出框
    function  getspecial_action(){
        $typeconfig=front::$post['specialconfig'];
        $showhtml="";
        if (is_array($typeconfig))
            foreach ($typeconfig  as $key=>$val){
                $showhtml.=$this->specialshow($key,$val);
            }
        $showhtml.='<div class="clearfix"></div>';
        echo json_encode($showhtml);
        exit;
    }
    //专题显示
    function specialshow($key,$val,$ismixing=false){
        if ($val['lang_sections']) load_sections_lang($val['lang_sections']);
        $showhtml="";
        if ($key>0)
            $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show" id="tag-show-'.$val['id'].'" >';
        else
            $showhtml.='<div role="tabpanel" class="tab-pane active" name="tab-show"  id="tag-show-'.$val['id'].'" >';
        if($ismixing)
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshopmixing'.$val['id'].'" id="frmmixing'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmmixing'.$val['id'].'" id="frmmixing'.$val['id'].'" action="">';
        else
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshopspecial'.$val['id'].'" id="frmshopspecial'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmspecial'.$val['id'].'" id="frmspecial'.$val['id'].'" action="">';
        $showhtml.='<input type="hidden" name="tagfrom" value="'.$val['tagfrom'].'" class="form-control">';

        $showhtml.='<input type="hidden" name="modulesname" value="'.$val['modulesname'].'" class="form-control modulesname">';
        $showhtml.='<input type="hidden" name="newmodulesname" value="'.$val['newmodulesname'].'" class="form-control newmodulesname">';
        $showhtml.='<input type="hidden" name="id" value="'.$val['id'].'" class="form-control id">';
        $showhtml.='<h5 class="title">'.lang_admin('special_settings').'</h5>';
        if ($val['spid']!="\$spid"){
            $showhtml.='<h5 class="subtitle">'.lang_admin('special');
            $showhtml.='</h5>';
            $showhtml.= form::select('spid',$val['spid'], special::option());
        }else{
            $showhtml.='<input type="hidden" name="spid" value="'.$val['spid'].'">';
        }
        $showhtml.='<div class="clearfix blank20"></div>';
        if($val['titlenum']!=""){
            $showhtml.='<h5 class="subtitle">'.lang_admin('number_of_headings');
            $showhtml.='</h5>';
            $showhtml.='<input placeholder="'.lang_admin('please_enter_the_caption_text_restriction').'" type="text" name="titlenum" value="'.$val['titlenum'].'" class="titlenum form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
        }
        $showhtml.='<div class="clearfix blank20"></div>';
        if($val['textnum']!="") {
            $showhtml .= '<h5 class="subtitle">' . lang_admin('number_of_column_words');
            $showhtml .= '</h5>';
            $showhtml .= '<input placeholder="' . lang_admin('please_enter_text_restrictions_on_cover_content') . '" type="text" name="textnum" value="' . $val['textnum'] . '" class="textnum form-control" oninput="value=value.replace(/[^\d]/g,\'\')">';
        }
        $showhtml.='<div class="clearfix blank20"></div>';
        $showhtml.='<div class="assembly-color"><h5 class="title">'.lang_admin('custom').'</h5>';
        //自定义配置
        if (is_array($val['custom']))
            foreach ($val['custom'] as $customkey=>$customval){
                if ($customval['type']=="text"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" value="'.$customval['value'].'" class="'.$customkey.' form-control" >';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else if ($customval['type']=="color"){
                    $showhtml.='<div id="'.$customkey.$val['id'].'" class="colorpicker-element"><div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';
                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" id="'.$customkey.$val['id'].'" value="'.$customval['value'].'" class="form-control" />';
                    $showhtml.='<span class="input-group-addon">';
                    $showhtml.='<i></i>';
                    $showhtml.='</span>';
                    $showhtml.='</div></div><div class="clearfix blank20"></div>';
                    $showhtml.='<script type="text/javascript">$(function () { $("#'.$customkey.$val['id'].'").colorpicker(); }); </script>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                }
                else if ($customval['type']=="select"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';

                    $showhtml.='<select   name="custom['.$customkey.'][value]" class="form-control select '.$customkey.'">';
                    if ($customval['select']){
                        $select = explode(',',$customval['select']);
                        foreach ($select as $selectval){
                            $showselect = explode('/',$selectval);
                            if($customval['value']==$showselect[0]){
                                $showhtml.='<option value="'.$showselect[0].'" selected>'.$showselect[1].'</option>';
                            }else{
                                $showhtml.='<option value="'.$showselect[0].'" >'.$showselect[1].'</option>';
                            }

                        }
                    }else{
                        $showhtml.='<option value="0" selected="">请选择...</option>';
                    }
                    $showhtml.='</select>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][select]" value="'.$customval['select'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
            }
        $showhtml.='</div></div><div class="clearfix"></div></div></div></form></div>';
        return   $showhtml;
    }
    //动态加载css弹出框
    function  getcommoncss_action(){
        $commoncssconfig=front::$post['commoncssconfig'];
        $showhtml="";
        if (is_array($commoncssconfig))
            foreach ($commoncssconfig  as $key=>$val){
                $showhtml.=$this->commoncssshow($key,$val);
            }
        $showhtml.='<div class="clearfix"></div>';
        echo json_encode($showhtml);
        exit;
    }
    //css显示
    function commoncssshow($key,$val,$ismixing=false){
        if ($val['lang_sections']) load_sections_lang($val['lang_sections']);
        $showhtml="";
        if ($key>0)
            $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show" id="tag-show-'.$val['id'].'" >';
        else{
            if((!array_key_exists('listtemplate',$val) && !array_key_exists('annountemplate',$val)
                    && !array_key_exists('commentagtemplate',$val) && !array_key_exists('typetemplate',$val)
                    && !array_key_exists('specialtemplate',$val)  && !array_key_exists('guestbooktemplate',$val))
                || front::post("isliststyle"))
            $showhtml.='<div role="tabpanel" class="tab-pane active" name="tab-show"  id="tag-show-'.$val['id'].'" >';
            else
            $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show"  id="tag-show-'.$val['id'].'" >';
        }
        if($ismixing)
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshopmixing'.$val['id'].'" id="frmshopmixing'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmmixing'.$val['id'].'" id="frmmixing'.$val['id'].'" action="">';
        else
            if (front::get('shop'))
                $showhtml.='<form method="post" name="frmshopcommoncss'.$val['id'].'" id="frmshopcommoncss'.$val['id'].'" action="">';
            else
                $showhtml.='<form method="post" name="frmcommoncss'.$val['id'].'" id="frmcommoncss'.$val['id'].'" action="">';
        $showhtml.='<input type="hidden" name="tagfrom" value="'.$val['tagfrom'].'" class="form-control">';
        $showhtml.='<input type="hidden" name="modulesname" value="'.$val['modulesname'].'" class="form-control modulesname">';
        $showhtml.='<input type="hidden" name="newmodulesname" value="'.$val['newmodulesname'].'" class="form-control newmodulesname">';
        $showhtml.='<input type="hidden" name="id" value="'.$val['id'].'" class="form-control id">';
        $showhtml.='<h5 class="title">'.lang_admin('set_up').'</h5>';
        if (isset($val['listtemplate']) &&  $val['listtemplate']!=""){
            if (get('isshopping')) {
                $showhtml .= '<input name="shoplisttemplate" class="tagtemplate"  type="hidden" value="' . $val['shoplisttemplate'] . '">';
                $showhtml .= '<input name="oldshoplisttemplate" class="oldshoplisttemplate"  type="hidden" value="' . $val['shoplisttemplate'] . '">';
            }
            else{
                $showhtml.='<input name="listtemplate" class="tagtemplate"  type="hidden" value="'.$val['listtemplate'].'">';
                $showhtml.='<input name="oldlisttemplate" class="oldlisttemplate"  type="hidden" value="'.$val['listtemplate'].'">';
            }

        }
        else   if (isset($val['annountemplate']) && $val['annountemplate']!=""){
            if (get('isshopping')) {
                $showhtml .= '<input name="shopannountemplate" class="tagtemplate"  type="hidden" value="' . $val['shopannountemplate'] . '">';
                $showhtml .= '<input name="oldshopannountemplate" class="oldshopannountemplate"  type="hidden" value="' . $val['shopannountemplate'] . '">';
            }else {
                $showhtml .= '<input name="annountemplate" class="tagtemplate"  type="hidden" value="' . $val['annountemplate'] . '">';
                $showhtml.='<input name="oldannountemplate" class="oldannountemplate"  type="hidden" value="'.$val['annountemplate'].'">';
            }
        }
        else   if (isset($val['typetemplate']) && $val['typetemplate']!=""){
            if (get('isshopping')){
                $showhtml.='<input name="shoptypetemplate" class="tagtemplate"  type="hidden" value="'.$val['shoptypetemplate'].'">';
                $showhtml .= '<input name="oldshoptypetemplate" class="oldshoptypetemplate"  type="hidden" value="' . $val['shoptypetemplate'] . '">';
            }else{
                $showhtml.='<input name="typetemplate" class="tagtemplate"  type="hidden" value="'.$val['typetemplate'].'">';
                $showhtml .= '<input name="oldtypetemplate" class="oldtypetemplate"  type="hidden" value="' . $val['typetemplate'] . '">';
            }
        }
        else   if (isset($val['specialtemplate']) && $val['specialtemplate']!=""){
            if (get('isshopping')){
                $showhtml.='<input name="shopspecialtemplate" class="tagtemplate"  type="hidden" value="'.$val['shopspecialtemplate'].'">';
                $showhtml .= '<input name="oldshopspecialtemplate" class="oldshopspecialtemplate"  type="hidden" value="' . $val['shopspecialtemplate'] . '">';
           }else{
                $showhtml.='<input name="specialtemplate" class="tagtemplate"  type="hidden" value="'.$val['specialtemplate'].'">';
                $showhtml .= '<input name="oldspecialtemplate" class="oldspecialtemplate"  type="hidden" value="' . $val['specialtemplate'] . '">';
            }
        }
        else   if (isset($val['guestbooktemplate']) && $val['guestbooktemplate']!=""){
            if (get('isshopping')){
                $showhtml.='<input name="shopguestbooktemplate" class="tagtemplate"  type="hidden" value="'.$val['shopguestbooktemplate'].'">';
                $showhtml .= '<input name="oldshopguestbooktemplate" class="oldshopguestbooktemplate"  type="hidden" value="' . $val['shopguestbooktemplate'] . '">';
            } else{
                $showhtml.='<input name="guestbooktemplate" class="tagtemplate"  type="hidden" value="'.$val['guestbooktemplate'].'">';
                $showhtml .= '<input name="oldguestbooktemplate" class="oldguestbooktemplate"  type="hidden" value="' . $val['guestbooktemplate'] . '">';
            }
        }
        else   if (isset($val['commentagtemplate']) && $val['commentagtemplate']!=""){
            if (get('isshopping')) {
                $showhtml .= '<input name="shopcommentagtemplate" class="tagtemplate"  type="hidden" value="' . $val['shopcommentagtemplate'] . '">';
                $showhtml .= '<input name="oldshopcommentagtemplate" class="oldshopcommentagtemplate"  type="hidden" value="' . $val['shopcommentagtemplate'] . '">';
            } else {
                $showhtml .= '<input name="commentagtemplate" class="tagtemplate"  type="hidden" value="' . $val['commentagtemplate'] . '">';
                $showhtml .= '<input name="oldcommentagtemplate" class="oldcommentagtemplate"  type="hidden" value="' . $val['commentagtemplate'] . '">';
            }
        }
        if (array_key_exists('text',$val) && $val['text']){
            foreach (getlang() as $langkey=>$langval){
                $showhtml.='<div class="input-group"><span class="input-group-addon">'.$langval['langurlname'];
                $showhtml.='</span>';
                $showhtml.='<textarea name="text['.$langval['langurlname'].']">';
                $showhtml.=$val['text'][$langval['langurlname']];
                $showhtml.='</textarea>';
                $showhtml.='</div><div class="clearfix blank20"></div>';
            }
        }

        //自定义配置
        if (is_array($val['custom']))
            foreach ($val['custom'] as $customkey=>$customval){
                if ($customval['type']=="text"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'. ($val['lang_sections']?lang_sections($customkey):lang_admin($customkey));
                    $showhtml.='</span>';

                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" value="'.$customval['value'].'" class="'.$customkey.' form-control" >';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else if ($customval['type']=="textarea"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'. ($val['lang_sections']?lang_sections($customkey):lang_admin($customkey));
                    $showhtml.='</span>';

                    $showhtml.='<textarea   name="custom['.$customkey.'][value]" class="'.$customkey.' form-control textarea " >'.$customval['value'].'</textarea>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else if ($customval['type']=="color"){
                    $showhtml.='<div id="'.$customkey.$val['id'].'" class="colorpicker-element"><div class="input-group"><span class="input-group-addon">'.lang_sections($customkey);
                    $showhtml.='</span>';
                    $showhtml.='<input type="text" name="custom['.$customkey.'][value]" id="'.$customkey.$val['id'].'" value="'.$customval['value'].'" class="form-control" />';
                    $showhtml.='<span class="input-group-addon">';
                    $showhtml.='<i></i>';
                    $showhtml.='</span>';
                    $showhtml.='</div></div><div class="clearfix blank20"></div>';
                    $showhtml.='<script type="text/javascript">$(function () { $("#'.$customkey.$val['id'].'").colorpicker(); }); </script>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                }
                else if ($customval['type']=="select"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'.($val['lang_sections']?lang_sections($customkey):lang_admin($customkey));
                    $showhtml.='</span>';

                    $showhtml.='<select   name="custom['.$customkey.'][value]" class="form-control select '.$customkey.'">';
                    if ($customval['select']){
                        $select = explode(',',$customval['select']);
                        foreach ($select as $selectval){
                            $showselect = explode('/',$selectval);
                            if($customval['value']==$showselect[0]){
                                $showhtml.='<option value="'.$showselect[0].'" selected>'.$showselect[1].'</option>';
                            }else{
                                $showhtml.='<option value="'.$showselect[0].'" >'.$showselect[1].'</option>';
                            }

                        }
                    }else{
                        $showhtml.='<option value="0" selected="">请选择...</option>';
                    }
                    $showhtml.='</select>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][select]" value="'.$customval['select'].'">';
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else if ($customval['type']=="image"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'. ($val['lang_sections']?lang_sections($customkey):lang_admin($customkey));
                    $showhtml.='</span>';
                    $img_url = './common/js/ajaxfileupload/pic.png';
                    if ($customval['value']) {
                        $img_url = $customval['value'];
                    }
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.=form::upload_viualimag($customkey,$customval['value']);
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else  if ($customval['type']=="video"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'. ($val['lang_sections']?lang_sections($customkey):lang_admin($customkey));
                    $showhtml.='</span>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.=form::upload_viualvideo($customkey,$customval['value']);
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
                else  if ($customval['type']=="audio"){
                    $showhtml.='<div class="input-group"><span class="input-group-addon">'. ($val['lang_sections']?lang_sections($customkey):lang_admin($customkey));
                    $showhtml.='</span>';
                    $showhtml.='<input type="hidden" name="custom['.$customkey.'][type]" value="'.$customval['type'].'">';
                    $showhtml.=form::upload_viualaudio($customkey,$customval['value']);
                    $showhtml.='</div><div class="clearfix blank20"></div>';
                }
            }
        $showhtml.='</div><div class="clearfix"></div></div></div></form></div>';
        if (get('isshopping'))
            $template_dir=config::getadmin('template_shopping_dir');
        else
            $template_dir=config::getadmin('template_dir');
        if ((array_key_exists('listtemplate',$val) && $val['listtemplate']!="")
            || (array_key_exists('shoplisttemplate',$val) && $val['shoplisttemplate']!="")){
            if (get('isshopping')) $selectname=$val['shoplisttemplate'];else $selectname=$val['listtemplate'];
            $showhtml.='<div role="tabpanel" class="tab-pane '.(front::post("isliststyle")?"":"active").'" name="tab-show" id="tag-show-listtemplate" >';
            $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listtag/list.config.php');
            if (is_array($tplarray)) foreach ($tplarray as $tplarraykey=>$tplarrayval){
                $showhtml.='<div class="tag-preview '.($tplarraykey==$selectname?"active":"").'" name="listtagimgcommoncsss">';
                $showhtml.='<img src="/template/'.$template_dir.'/visual/list/listtag/'.$tplarraykey.'/'.$tplarraykey.'.jpg" alt="'.$tplarrayval.'" data-tagname="'.$tplarraykey.'" name="commoncssstagimg" />';
                $showhtml.='<div class="listtagimgtitle">'.$tplarrayval;
                $showhtml.='</div></div>';
            }
            $showhtml.='</div><div class="clearfix"></div></div></div></form></div>';

        }
        else if ((array_key_exists('annountemplate',$val) &&  $val['annountemplate']!="")
            || (array_key_exists('shopannountemplate',$val) &&  $val['shopannountemplate']!="")){
            if (get('isshopping')) $selectname=$val['shopannountemplate'];else $selectname=$val['annountemplate'];
            $showhtml.='<div role="tabpanel" class="tab-pane '.(front::post("isliststyle")?"":"active").'" name="tab-show" id="tag-show-annountemplate" >';
            $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listannountag/announ.config.php');
            if (is_array($tplarray)) foreach ($tplarray as $tplarraykey=>$tplarrayval){
                $showhtml.='<div class="tag-preview '.($tplarraykey==$selectname?"active":"").'" name="listtagimgcommoncsss">';
                $showhtml.='<img src="/template/'.$template_dir.'/visual/list/listannountag/'.$tplarraykey.'/'.$tplarraykey.'.jpg" alt="'.$tplarrayval.'" data-tagname="'.$tplarraykey.'" name="commoncssstagimg" />';
                $showhtml.='<div class="listtagimgtitle">'.$tplarrayval;
                $showhtml.='</div></div>';
            }
            $showhtml.='</div><div class="clearfix"></div></div></div></form></div>';
        }
        else if ((array_key_exists('commentagtemplate',$val) &&  $val['commentagtemplate']!=""
            || (array_key_exists('shopcommentagtemplate',$val) &&  $val['shopcommentagtemplate']!=""))){
            if (get('isshopping')) $selectname=$val['shopcommentagtemplate'];else $selectname=$val['commentagtemplate'];
            $showhtml.='<div role="tabpanel" class="tab-pane '.(front::post("isliststyle")?"":"active").'" name="tab-show" id="tag-show-commentagtemplate" >';
            $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listcommenttag/list.config.php');
            if (is_array($tplarray)) foreach ($tplarray as $tplarraykey=>$tplarrayval){
                $showhtml.='<div class="tag-preview '.($tplarraykey==$selectname?"active":"").'" name="listtagimgcommoncsss">';
                $showhtml.='<img src="/template/'.$template_dir.'/visual/list/listcommenttag/'.$tplarraykey.'/'.$tplarraykey.'.jpg" alt="'.$tplarrayval.'" data-tagname="'.$tplarraykey.'" name="commoncssstagimg" />';
                $showhtml.='<div class="listtagimgtitle">'.$tplarrayval;
                $showhtml.='</div></div>';
            }
            $showhtml.='</div><div class="clearfix"></div></div></div></form></div>';
        }
        else if ((array_key_exists('typetemplate',$val) &&  $val['typetemplate']!="")
            || (array_key_exists('shoptypetemplate',$val) &&  $val['shoptypetemplate']!="")){
            if (get('isshopping')) $selectname=$val['shoptypetemplate'];else $selectname=$val['typetemplate'];
            $showhtml.='<div role="tabpanel" class="tab-pane '.(front::post("isliststyle")?"":"active").'" name="tab-show" id="tag-show-typetemplate" >';
            $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listtypetag/list.config.php');
            if (is_array($tplarray)) foreach ($tplarray as $tplarraykey=>$tplarrayval){
                $showhtml.='<div class="tag-preview '.($tplarraykey==$selectname?"active":"").'" name="listtagimgcommoncsss">';
                $showhtml.='<img src="/template/'.$template_dir.'/visual/list/listtypetag/'.$tplarraykey.'/'.$tplarraykey.'.jpg" alt="'.$tplarrayval.'" data-tagname="'.$tplarraykey.'" name="commoncssstagimg" />';
                $showhtml.='<div class="listtagimgtitle">'.$tplarrayval;
                $showhtml.='</div></div>';
            }
            $showhtml.='</div><div class="clearfix"></div></div></div></form></div>';
        }
        else if ((array_key_exists('specialtemplate',$val) &&  $val['specialtemplate']!="")
            || (array_key_exists('shopspecialtemplate',$val) &&  $val['shopspecialtemplate']!="")){
            if (get('isshopping')) $selectname=$val['shopspecialtemplate'];else $selectname=$val['specialtemplate'];
            $showhtml.='<div role="tabpanel" class="tab-pane '.(front::post("isliststyle")?"":"active").'" name="tab-show" id="tag-show-specialtemplate" >';
            $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listspecialtag/list.config.php');
            if (is_array($tplarray)) foreach ($tplarray as $tplarraykey=>$tplarrayval){
                $showhtml.='<div class="tag-preview '.($tplarraykey==$selectname?"active":"").'" name="listtagimgcommoncsss">';
                $showhtml.='<img src="/template/'.$template_dir.'/visual/list/listspecialtag/'.$tplarraykey.'/'.$tplarraykey.'.jpg" alt="'.$tplarrayval.'" data-tagname="'.$tplarraykey.'" name="commoncssstagimg" />';
                $showhtml.='<div class="listtagimgtitle">'.$tplarrayval;
                $showhtml.='</div></div>';
            }
            $showhtml.='</div><div class="clearfix"></div></div></div></form></div>';
        }
        else if ((array_key_exists('guestbooktemplate',$val) &&  $val['guestbooktemplate']!="")
            || (array_key_exists('shopguestbooktemplate',$val) &&  $val['shopguestbooktemplate']!="")){
            if (get('isshopping')) $selectname=$val['shopguestbooktemplate'];else $selectname=$val['guestbooktemplate'];
            $showhtml.='<div role="tabpanel" class="tab-pane '.(front::post("isliststyle")?"":"active").'" name="tab-show" id="tag-show-guestbooktemplate" >';
            $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listguestbooktag/list.config.php');
            if (is_array($tplarray)) foreach ($tplarray as $tplarraykey=>$tplarrayval){
                $showhtml.='<div class="tag-preview '.($tplarraykey==$selectname?"active":"").'" name="listtagimgcommoncsss">';
                $showhtml.='<img src="/template/'.$template_dir.'/visual/list/listguestbooktag/'.$tplarraykey.'/'.$tplarraykey.'.jpg" alt="'.$tplarrayval.'" data-tagname="'.$tplarraykey.'" name="commoncssstagimg" />';
                $showhtml.='<div class="listtagimgtitle">'.$tplarrayval;
                $showhtml.='</div></div>';
            }
            $showhtml.='</div><div class="clearfix"></div></div></div></form></div>';
        }

        if (array_key_exists('fields',$val)){
            $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show" id="tag-show-fields" >';
            $showhtml.='<form method="post" name="frmcommoncss_fields_'.$val['id'].'" id="frmcommoncss_fields_'.$val['id'].'" action="">';
            $showhtml.='<select class="fields" style="width: 100%; height: 380px;" name="fields[]" id="fields" multiple="multiple">';
            $showhtml.='<optgroup label="'.lang_admin('selection_by_ctrl_a').'">';
            $showhtml.='</optgroup>';
            $showhtml.='<optgroup label="'.lang_admin('select_by_ctrl_or_shift').'">';
            $sets = setting::getInstance();
            $fields = setting::$var['archive'];
            $newcname='cname_'.lang::getisadmin();
            if(is_array($fields) && !empty($fields)){
                foreach ($fields as $f){
                    if ($f['isshoping'])continue;
                    $showhtml.='<option value="'.$f['name'].'">'.$f[$newcname].'</option>';
                }
            }
            $showhtml.='</optgroup>';
            $showhtml.='</select>';
            $showhtml.='</form></div>';
        }
        return   $showhtml;
    }
    //动态加载混合弹出框
    function  getmixing_action(){
        $mixingconfig=front::$post['mixingconfig'];
        $set=settings::getInstance();
        $sets=$set->getrow(array('tag'=>'table-archive'));
        $sets['value']=isset($sets['value'])?$sets['value']:"";
        $ds=unserialize($sets['value']);
        $ds['attr1']=isset($ds['attr1'])?$ds['attr1']:"";
        preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%s',$ds['attr1'],$result,PREG_SET_ORDER);
        $sdata=array();
        foreach ($result as $res) $sdata[$res[1]]=$res[2];
        $showhtml="";
        if (is_array($mixingconfig))
            foreach ($mixingconfig  as $key=>$val){
                if ($val['tagfrom']=='category' || $val['tagfrom']=='shopcategory'){
                    $showhtml.=$this->categoryshow($key,$val,true);
                }
                else   if ($val['tagfrom']=='content' || $val['tagfrom']=='shopcontent'){
                    $showhtml.=$this->contentshow($key,$val,$sdata,true);
                }
                else   if ($val['tagfrom']=='commoncss' || $val['tagfrom']=='shopcommoncss'){
                    $showhtml.=$this->commoncssshow($key,$val,true);
                }
            }
        $showhtml.='<div class="clearfix"></div>';
        echo json_encode($showhtml);
        exit;
    }
    //保存表单
    function savetagform_action()
    {
        $selectform=front::post("selectform");
        if ($selectform!=""){
            echo '<div class="tag"><span class="removeClean tagname">{tag_form_' . $selectform . '}</span>';
            echo service::getherf(templatetag::tagform($selectform));
            echo '</div>';
        }
        exit;
    }

    //保存图标
    function saveicon_action()
    {
        $this->_table = new templatetag();

        $modulesname=front::$post['newmodulesname'];
        unset(front::$post['newmodulesname']);
        front::$post['icon']=str_replace("\\","",html_entity_decode(front::$post['icon']));

        if (strpos($modulesname,'tag_sections') !== false){
            preg_match('/^{tag_sections_(.*?)}$/', $modulesname, $out);
            if (isset($out[1]) && $out[1]) {
                $str=explode("_",$out[1]);//0  (全局/栏目/内容)  1组件名称 2配置id {tag_sections_common_icon_2}
                if ($str[0]=="shop" || get('isshopping')){
                   $this->_table->rec_iconupdate(front::$post, $str[3], $str[1], $str[2]);
                }else
                   $this->_table->rec_iconupdate(front::$post, $str[2], $str[0], $str[1]);
               /* if ($insert<1) {
                    echo lang_admin('add_to') . lang_admin('failure');
                }
                else {
                    $sectionsname=$out[1];
                    if (get('isshopping')){
                        if(!strpos($modulesname,'sections_shop')){
                            $modulesname= str_replace('sections','sections_shop',$modulesname);
                        }
                        $sectionsname= str_replace('shop_','',$sectionsname);
                    }
                    echo '<div class="tag"><span class="removeClean tagname">' . $modulesname . '</span>';
                    if ($str[0]=="shop" || get('isshopping'))
                        echo service::getherf(templatetag::tagsections($sectionsname,0,1));
                    else
                        echo service::getherf(templatetag::tagsections($sectionsname,0,0));
                    echo '</div>';
                }*/
            }
        }

        exit;
    }

    function deltag_action()
    {
        preg_match('/^{tag_(.*?)}$/', front::$post['tag'], $out);
        if (isset($out[1]) && $out[1]) {
            $this->_table = new templatetag();
            $rs = $this->_table->rec_delete(templatetag::id($out[1]));
            //var_dump($rs);
            echo json_encode($rs);
        }
        exit;
    }

    function savetag_action()
    {
        $this->_table = new templatetag();
        $this->manage = new table_templatetag();
        if (intval(front::$post['id']) > 0) {
            $insert = $this->_table->rec_update(front::$post, intval(front::$post['id']));
        } else {
            $insert = $this->_table->rec_insert(front::$post);
        }
        if ($insert < 1) {
            echo lang_admin('add_to').lang_admin('failure');
        } else {
            echo '<div class="tag"><span class="removeClean tagname">{tag_'. $insert . '}</span>';
            echo service::getherf(templatetag::tagadmin($insert));
            echo '</div>';
        }
        exit;
    }

    function savetaglist_action()
    {
        if (front::$post['catid']){
            $categorydata=array("catname"=>front::$post['catname'],
                "subtitle"=>front::$post['subtitle'],
                "categorycontent"=>htmlspecialchars_decode(str_replace("'", "\'", front::$post['categorycontent'])),
                "image"=>front::$post['image'],
            );
            category::getInstance()->rec_update($categorydata,"catid=".front::$post['catid']);
            category::deletesession();  //清空缓存
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/all');
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/'.front::$post['catid']);

            echo '<div class="tag"><span class="removeClean tagname">{tag_'. front::$post['id'] . '}</span>';
            echo service::getherf(templatetag::tagadmin(front::$post['id']));
            echo '</div>';
        }
        exit;
    }

    function saveshoptag_action()
    {
        $this->_table = new shoptemplatetag();
        $this->manage = new table_shoptemplatetag();
        if (intval(front::$post['id']) > 0) {
            $insert = $this->_table->rec_update(front::$post, intval(front::$post['id']));
        } else {
            $insert = $this->_table->rec_insert(front::$post);
        }

        if ($insert < 1) {
            echo lang_admin('add_to').lang_admin('failure');
        } else {
            //echo "{tag_".front::$post['name']."}";
            echo '<div class="tag"><span class="removeClean tagname">{tag_'. $insert . '}</span>';
            echo service::getherf(shoptemplatetag::tagadmin($insert));
            echo '</div>';
        }
        exit;
    }

    function saveshoptaglist_action()
    {
        if (front::$post['catid']){
            $categorydata=array("catname"=>front::$post['catname'],
                "subtitle"=>front::$post['subtitle'],
                "categorycontent"=>htmlspecialchars_decode(str_replace("'", "\'", front::$post['shopcategorycontent'])),
                "image"=>front::$post['shopimage'],
            );
            category::getInstance()->rec_update($categorydata,"catid=".front::$post['catid']);
            category::deletesession();  //清空缓存
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/all');
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/'.front::$post['catid']);

            echo '<div class="tag"><span class="removeClean tagname">{tag_'. front::$post['id'] . '}</span>';
            echo service::getherf(shoptemplatetag::tagadmin(front::$post['id']));
            echo '</div>';
        }
        exit;

    }

    //可视化直接编辑   公用接口
    function  editcategorytemplate_action(){
        if (front::$post['id']) {
            $value="";
            if (front::$post['type']=="cmseasyeditimg"){
                $value=front::$post['editimage'];
            }
            elseif (front::$post['type']=="content"){
                $value=htmlspecialchars_decode(front::$post['editcategorycontent']);
            }
            elseif (front::$post['type']=="text"){
                $value=front::$post['content'];
            }
            elseif (front::$post['type']=="textarea"){
                $value=front::$post['textareacontent'];
            }
            elseif (front::$post['type']=="time"){
                $value=front::$post['timecontent'];
            }
            elseif (front::$post['type']=="strgrade"){
                $value=front::$post['grade'];
            }

            $row=array(front::$post['field']=>$value);
            $where=array('id'=>front::$post['id']);
            if (front::$post['table']=='category'){   //栏目
                $where=array('catid'=>front::$post['id']);
                //清空数据缓存 {tag_modules_category_common_scroll-columns-list_1}
                $cache_path = ROOT . '/cache/data/admin/' .lang::getisadmin().'/category/'.front::$post['id'];
                front::remove($cache_path);
            }
            else if (front::$post['table']=='archive'){  //内容
                $where=array('aid'=>front::$post['id']);
                //清空数据缓存
                $cache_path = ROOT . '/cache/data/admin/' .lang::getisadmin().'/archive/'.front::$post['id'];
                front::remove($cache_path);
            }
            else if (front::$post['table']=='special'){  //专题
                $where=array('spid'=>front::$post['id']);
                //清空数据缓存
                $cache_path = ROOT . '/cache/data/admin/' .lang::getisadmin().'/special/'.front::$post['id'];
                front::remove($cache_path);
            }
            else if (front::$post['table']=='tag'){  //tag
                $where=array('tagid'=>front::$post['id']);
            }
            else if (front::$post['table']=='type'){  //type
                //清空数据缓存
                $cache_path = ROOT . '/cache/data/admin/' .lang::getisadmin().'/type/'.front::$post['id'];
                front::remove($cache_path);
            }
            //清空缓存
            $cache_modules_path=ROOT . '/'.lang::getisadmin().'/template/'. config::get('template_dir') . '/modules';
            front::remove($cache_modules_path);
            $cache_sections_path=ROOT . '/'.lang::getisadmin().'/template/'. config::get('template_dir') . '/sections';
            front::remove($cache_sections_path);

            if (front::$post['table']!='lang' && front::$post['table']!='config' && front::$post['table']!="") {
                $_table = new front::$post['table'];  templatetag::
                $update = $_table->rec_update($row, $where);
            }
            //语言修改
            if (front::$post['table']=='lang') {
                if (front::$post['field']=='admin') {   //区分前后台语言
                    $langpath=ROOT.'/lang/'.lang::getisadmin().'/system_admin.php';
                }else{
                    $langpath=ROOT.'/lang/'.lang::getistemplate().'/system.php';
                }
                $langcontent=include($langpath);
                foreach ($langcontent as $key=>$val){
                    if ($key==front::$post['id'])$langcontent[$key]=$value;
                }
                $data='<?php return ' . var_export($langcontent, true) . ';';
                $f = fopen($langpath,'w');
                fwrite($f,$data);
                fclose($f);
            }
            else if (front::$post['table']=='config') {
                config::modify(array(front::$post['id']=>$value));
            }

            //删除模板缓存
            if (front::$post['module_name']){
                $isshopping=front::$post['isshopping'];
                $lang=lang::getisadmin();
                $module_name=front::$post['module_name'];
                if (strpos($module_name,'tag_sections') !== false) {
                   /* preg_match('/^{tag_sections_(.*?)}$/', $module_name, $out);
                    if (isset($out[1]) && $out[1]) {
                        if ($isshopping) {
                            $path = ROOT . '/cache/template_admin/'.$lang.'/'. config::get('template_admin_dir') . '/shop/visual/show_sections/';
                        }else{
                            $path = ROOT . '/cache/template_admin/'.$lang.'/' . config::get('template_admin_dir') . '/template/visual/show_sections/';
                        }
                    }*/
                }
                else{
                    preg_match('/^{tag_(.*?)}$/', $module_name, $out);
                    if (isset($out[1]) && $out[1]) {
                        $str = explode("_", $out[1]);//0 buymodules 1 category 2 (全局)  3 组件名称 4 配置id
                        if ($str[1] == 'shop'){
                            $module_type=$str[3];
                            $module_name=$str[4];
                            $module_id=$str[5];
                        }else{
                            $module_type=$str[2];
                            $module_name=$str[3];
                            $module_id=$str[4];
                        }
                        if ($str[0] == "buymodules"){
                            $cacheFile=ROOT . '/cache/template/'.lang::getistemplate().'/buymodules/'.$module_type.'/'.$module_name.'/#'.$module_id.'.php';
                            $cache_path=ROOT . '/'.$lang.'/template/buymodules/'.$module_type.'/'.$module_name.'/#'.$module_id.'.php';
                        }else{
                            $cacheFile=ROOT . '/cache/template/'.$lang.'/' .config::get('template_dir'). '/modules/'.$module_type.'/'.$module_name.'/#'.$module_id.'.php';
                            $cache_path=ROOT . '/'.$lang.'/template/'. config::get('template_dir') . '/modules/' . $module_type . '/' . $module_name.'/#'.$module_id.'.php';
                        }
                        if(file_exists($cacheFile)){
                            unlink($cacheFile);
                        }
                        if(file_exists($cache_path)){
                            unlink($cache_path);
                        }
                    }
                }
            }
            category::deletesession();  //清空缓存
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/all');
            front::remove(ROOT.'/cache/data/'.lang::getistemplate().'/category/'.front::$post['catid']);

            if (front::$post['type']=="strgrade"){
                echo archive::getgrade($value);
            }else   echo $update;
        }
        exit;
    }

    function note_action()
    {

        chkpw('template_note');
        if (front::post('submit')) {
            unset(front::$post['submit']);
            help::$_var['template_note'] = front::$post;
            help::save();
        }
        $dir = ROOT . '/template/' . config::get('template_dir');
        $_dir = dir($dir);
        while ($file = $_dir->read()) {
            if (!preg_match('/^\./', $file) && is_dir($dir . '/' . $file) && !preg_match('/[#@]/', $file) && !preg_match('/^_/', $file)) {
                $this->view->tps[$file] = '<b>' . $file . '</b>';
                $__dir = dir($dir . '/' . $file);
                while ($_file = $__dir->read()) {
                    if (!preg_match('/^\./', $_file) && !preg_match('/[#@]/', $_file)) {
                        if ($file == 'skin' && !preg_match('/\.(css|js)$/', $_file))
                            continue;
                        $_file = str_replace('.', '_', $_file);
                        if (is_dir($dir . '/' . $file . '/' . $_file))
                            $this->view->tps[$file . '/' . $_file] = "&nbsp;&nbsp;└<b>" . $_file . '</b>';
                        else
                            $this->view->tps[$file . '/' . $_file] = "&nbsp;&nbsp;└" . $_file;
                    }
                }
            } elseif (!preg_match('/^\./', $file) && is_file($dir . '/' . $file) && !preg_match('/[#@]/', $file)) {
                $file = str_replace('.', '_', $file);
                $tps[$file] = $file;
            }
        }
        $tps_arr = array_merge($tps, $this->view->tps);
        //分页
        $limit = 20;
        if (!front::get('page'))
            $page = 1;
        else
            $page = front::get('page');
        $total = ceil(count($tps_arr) / $limit);
        if ($page < 1) $page = 1;
        if ($page > $total) $page = $total;
        $start = ($page - 1) * $limit;
        $end = $start + $limit - 1;
        $tmp = range($start, $end);
        $list_tps_arr = array();
        $i = 0;
        foreach ($tps_arr as $k => $v) {
            if (in_array($i++, $tmp))
                $list_tps_arr[$k] = $v;
        }
        $this->view->tps = $list_tps_arr;
        $this->view->link_str = listPage($total, $limit, $page);
    }

    function tag_action()
    {
        if (front::post('submit')) {
            unset(front::$post['submit']);
            help::$var['tag_note2'] = array();
            help::$_var['tag_note2'] = front::post('tag');
            help::save();
        }
        for ($i = 0; $i <= 49; $i++)
            $this->view->tags[$i] = null;
    }

    //获取文件夹下所有目录
    function getdir($dir,$parent=""){
        $_dir = dir($dir);
        $dir_data=array();
        while ($file = $_dir->read()) {
            if ($file == 'skin' || preg_match('/\.(php|css|js|jpg|png|gif)$/', $file))
                continue;
            if ($file == 'visual')
                continue;
            if (!preg_match('/^\./', $file) && is_dir($dir . '/' . $file) && !preg_match('/[#@]/', $file)
                && !preg_match('/^_/', $file)) {
                if ($parent) {
                    $dir_data[$file] = self::getdir($dir . '/' . $file, $parent.'/'.$file);
                }else{
                    $dir_data[$file] = self::getdir($dir . '/' . $file, $file);
                }
            } elseif (!preg_match('/^\./', $file)
                && is_file($dir . '/' . $file)) {
                $file = str_replace('.', '_', $file);
                if ($parent){
                    $dir_data[$parent.'/'.$file]=$file;
                }else{
                    $dir_data[$file]=$file;
                }

            }
        }
        return $dir_data;
    }
    //整理目录数据集
    function  editarray($data,$parentdata="",$parentname="",$index=0){
        if (!is_array($data))return array();
        $tps_arr=array();
        $nbsp="";
        for ($i=1; $i<=$index; $i++)
        {
            $nbsp.="&nbsp;&nbsp;";
        }
        foreach ($data as $key=>$val){
            if (is_array($val) && count($val)>0){
                if ($parentname){
                    $tps_arr[$parentname.'/'.$key]=$nbsp.'└'.$key;
                    $tps_arr=self::editarray($val,$tps_arr,$parentname.'/'.$key,$index+1);
                }
                else{
                    $tps_arr[$key]=$key;
                    $tps_arr=self::editarray($val,$tps_arr,$key,$index+1);
                }

            }else if (!is_array($val)){
                if  ($parentname)
                $tps_arr[$key]=$nbsp.'└'.$val;
                else
                $tps_arr[$key]=$val;
                if (is_array($parentdata)){
                    $tps_arr = array_merge($parentdata,$tps_arr);
                }
            }
        }
        return $tps_arr;
    }

    function edit_action()
    {
        chkpw('template_edit');

        if (front::post('submit')) {
            unset(front::$post['submit']);
            help::$_var[config::get('template_dir') . '_template_note'] = front::$post;
            help::save();
        }
        $dir = ROOT . '/template/' . config::get('template_dir');
        $tps=array();
        $tps=self::getdir($dir);//获取文件夹下所有目录
        $tps_arr=self::editarray($tps);//整理目录数据集
        /*$_dir = dir($dir);
        while ($file = $_dir->read()) {
            if (!preg_match('/^\./', $file) && is_dir($dir . '/' . $file) && !preg_match('/[#@]/', $file)
                && !preg_match('/^_/', $file)) {
                $this->view->tps[$file] = '<b>' . $file . '</b>';
                $__dir = dir($dir . '/' . $file);
                while ($_file = $__dir->read()) {
                    if (!preg_match('/^\./', $_file)) {
                        if ($file == 'skin' && !preg_match('/\.(css|js)$/', $_file))
                            continue;
                        $_file = str_replace('.', '_', $_file);
                        if (is_dir($dir . '/' . $file . '/' . $_file)) {
                            $this->view->tps[$file . '/' . $_file] = "&nbsp;&nbsp;└<b>" . $_file . '</b>';
                        } else {
                            $this->view->tps[$file . '/' . $_file] = "&nbsp;&nbsp;└" . $_file;
                        }
                    }
                }
            } elseif (!preg_match('/^\./', $file)
                && is_file($dir . '/' . $file)) {
                $file = str_replace('.', '_', $file);
                $tps[$file] = $file;
            }
        }
        $tps_arr = array_merge($tps, $this->view->tps);*/

        $this->view->tps = $tps_arr;
    }

    function downlist_action()
    {
        $str = file_get_contents('http://template.cmseasy.cn/template-7/template.html');
        $this->view->tpllist = $str;
    }

    function savecookie_action()
    {
        if(front::post('submit')){
            $cmseasyusers['username']=front::post('username');
            $cmseasyusers['passwrod']=front::post('passwrod');
            $cmseasyusers = serialize($cmseasyusers); //序列化
            $cmseasyusers = xxtea_encrypt($cmseasyusers, config::getadmin('cookie_password'));  //加密
            $cmseasyusers = base64_encode($cmseasyusers);//更改格式
            cookie::set('cmseasyusers_cookie', $cmseasyusers,time()+3600*24*7);//保存cookie
        }
        $this->render(url('template/downlist'));
    }

    function eidttemplatename_action(){
        //修改管控文件
        $creadt_path=TEMPLATE.'/'.front::$get['old_templatename'].'/control.php';  //管控文件地址
        if (file_exists($creadt_path)){
            $template_data = include $creadt_path;
            $template_data=passport_decrypt($template_data,"Cmseasy2099");//解密
            if (is_array($template_data)) {
                $template_data['template_remarks']=front::$get['new_templatename'];

                $template_data=passport_encrypt($template_data,"Cmseasy2099");
                $data='<?php return ' . var_export($template_data, true) . ';';
                $f = fopen($creadt_path,'w');
                fwrite($f,$data);
                fclose($f);
            }
        }

        $old_templatename = ROOT . '/template/' . front::$get['old_templatename'];
        $new_templatename = ROOT . '/template/' . front::$get['new_templatename'];
        if(rename($old_templatename,$new_templatename)){
            $old_data_templatename = ROOT . '/data/template/' . front::$get['old_templatename'];
            $new_data_templatename = ROOT . '/data/template/' . front::$get['new_templatename'];
            if (is_dir($old_data_templatename)){
                rename($old_data_templatename,$new_data_templatename);
            }
            echo json_encode(array("static"=>1,"message"=>lang_admin("edit").lang_admin("success")));
        }else{
            echo json_encode(array("static"=>0,"message"=>lang_admin("edit").lang_admin("failure")));
        }

        if(front::$get['old_templatename'] == config::getadmin('template_dir')){
            config::modify("template_dir",front::$get['new_templatename']);
        }


        exit;

    }

    function copytemplatename_action(){
        if (front::$get['old_templatename']  &&  front::$get['new_templatename']){
            $old_templatename = ROOT . '/template/' . front::$get['old_templatename'];
            $new_templatename = ROOT . '/template/' . front::$get['new_templatename'];
            if(self::xCopy($old_templatename,$new_templatename,1)){
                //复制可视化
                $old_visual_templatename = ROOT . '/data/template/' . front::$get['old_templatename'];
                if (file_exists($old_visual_templatename)) {
                    $new_visual_templatename = ROOT . '/data/template/' . front::$get['new_templatename'];
                    self::xCopy($old_visual_templatename,$new_visual_templatename,1);
                }

                //修改管控文件
                $creadt_path=TEMPLATE.'/'.front::$get['new_templatename'].'/control.php';  //管控文件地址
                service::update_control($creadt_path,front::$get['new_templatename']);
                echo json_encode(array("static"=>1,"message"=>lang_admin("copy").lang_admin("success")));
                exit;
            }
        }
        echo json_encode(array("static"=>0,"message"=>lang_admin("copy").lang_admin("failure")));
        exit;

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

    function json($args)
    {
        echo json_encode($args);
    }

    function json_info($code, $msg)
    {
        echo json_encode(array('code' => $code, 'msg' => $msg));
    }

    function down_action()
    {
        set_time_limit(0);
        session_write_close();
        $action = front::$get['action'];
        $f = (isset(front::$post['f']) && front::$post['f']) ? front::$post['f'] : front::$get['f'];
        $isSql = (isset(front::$post['sql']) && front::$post['sql']) ? front::$post['sql'] : front::$get['sql'];
        $filename = $f . '.zip';
        //校验是否购买
        $applogin=service::getInstance()->get_service_users();
        $data=service::getInstance()->cms_qkdown($applogin["username"],$f,2);
        if(!isset($data["static"]) ||  !$data["static"]){
            $data['message']=isset($data['message'])?$data['message']:"";
            $this->json_info(1, $data['message']);
            exit;
        }

        $remote_url=$data['zipurl'];
        $remote_url= str_replace("https://","http://",$remote_url);
        $file_size = service::get_remote_file_size($remote_url);
        $download_cache = ROOT . '/cache/downloads/';
        $tmp_path = $download_cache . $filename;
        switch ($action) {
            case 'prepare-download':
                // 下载缓存文件夹
                if (!is_dir($download_cache)) {
                    tool::mkdir($download_cache);
                }
                $this->json(compact('file_size'));
                break;
            case 'start-download':
                try {
                    touch($tmp_path);
                    if ($fp = @fopen($remote_url, "rb")) {
                        if (!$download_fp = @fopen($tmp_path, "wb")) {
                            $this->json_info(1, lang_admin('unable_to_open_temporary_file'));
                            exit;
                        }
                        while (!feof($fp)) {
                            if (!file_exists($tmp_path)) {
                                fclose($download_fp);
                                $this->json_info(2, lang_admin('temporary_file_does_not_exist'));
                                exit;
                            }
                            fwrite($download_fp, fread($fp, 1024 * 8), 1024 * 8);
                        }
                        fclose($download_fp);
                        fclose($fp);
                    } else {
                        $this->json_info(3, lang_admin('cannot_open_remote_file'));
                        exit;
                    }
                } catch (Exception $e) {
                    $this->json_info(4, $e->getMessage());
                    exit;
                }
                $this->json_info(0, $tmp_path);
                break;
            case 'get-file-size':
                // 这里检测下 tmp_path 是否存在
                if (file_exists($tmp_path)) {
                    // 返回 JSON 格式的响应
                    $this->json(array('size' => filesize($tmp_path)));
                }
                break;
            case 'exzip':
                $unpath = TEMPLATE;
                $modify_type="pc";
                if ($data['isshoptemplate']){
                    $modify_type="shopping";
                    $unpath = ROOT;
                }
                elseif (false !== stristr($f, 'mobile')) {
                    $modify_type="mobile";
                }else{
                    $unpath = ROOT;
                }
                $archive = new PclZip($tmp_path);
                if (!@$archive->extract(PCLZIP_OPT_PATH, $unpath, PCLZIP_OPT_REPLACE_NEWER)) {
                    //$this->json_info(1, $archive->errorInfo(true));
                    $this->json_info(1, lang_admin("file_error"));
                    exit;
                }
                if($modify_type=="shopping"){
                    config::modify(array(
                        'template_shopping_dir' => $f,
                    ));
                }
                elseif($modify_type=="mobile"){
                    config::modify(array(
                        'template_mobile_dir' => $f,
                    ));
                }
                elseif($modify_type=="pc"){
                    config::modify(array(
                        'template_dir' => $f,
                    ));
                }



                if ($isSql == 'true' && file_exists(ROOT . '/data/template/' . $f . '/install.sql')) {

                    $rs = tdatabase::getInstance()->restoreTables(ROOT . '/data/template/'. $f . '/install.sql');
                    if ($rs) {
                        $this->json_info(5, $rs);
                        exit;
                    }


                    //更新表
                    $nerrCode=service::checktable();
                    if ($nerrCode) {
                        $this->json_info(5, $nerrCode);
                        exit;
                    }


                }


                //全部语言   --增加标签升级
                $langdata=getlang();
                //全部语言 配置
                if($langdata != "") {
                    foreach ($langdata as $lang) {
                        $config_file = TEMPLATE . '/' . $f . '/data/templatetag_'.$lang['langurlname'].'.php';
                        if (file_exists($config_file)) {
                            $setting = include $config_file;
                            if ($setting!="" && is_array($setting) && count($setting)>0){
                                foreach ($setting as $setkey=>$setval){
                                    $setting[$setkey]['setting']['remarksname']=$setval['name'];
                                }
                                file_put_contents(iconv("utf-8", "gbk",$config_file), '<?php return ' . var_export($setting, true) . ';');
                            }
                        }
                    }
                }

                //清空之前的全部php缓存和html缓存
                cache_make::all_make_delete();

                //修改安装状态为已安装
                cutbuytemplate::getInstance()->rec_update("installed=1","static=1 and code='".$f."'");
                $this->json_info(0, lang_admin('template').lang_admin('install').lang_admin('success'));
                break;
            default:
                # code...
                break;
        }
        exit;
    }

    /**
     * 模板升级
     */
    function upgrade_action()
    {
        set_time_limit(0);
        session_write_close();
        $action = front::$get['action'];
        $f = (isset(front::$post['f']) && front::$post['f']) ? front::$post['f'] : front::$get['f'];
        $remark_name =(isset(front::$post['remark_name']) && front::$post['remark_name'])? front::$post['remark_name'] : front::$get['remark_name'];
        $filename = $f . '.zip';
        //校验是否购买
        $applogin=service::getInstance()->get_service_users();
        $data=service::getInstance()->cms_qkdown($applogin["username"],$f,5);
        if(!isset($data["static"]) ||  !$data["static"]){
            $data['message']=isset($data['message'])?$data['message']:"";
            $this->json_info(1, $data['message']);
            exit;
        }

        $remote_url=$data['zipurl'];
        $remote_url= str_replace("https://","http://",$remote_url);
        $file_size = service::get_remote_file_size($remote_url);
        $download_cache = ROOT . '/cache/downloads/';
        $tmp_path = $download_cache . $filename;
        switch ($action) {
            case 'prepare-download':
                // 下载缓存文件夹
                if (!is_dir($download_cache)) {
                    tool::mkdir($download_cache);
                }
                $this->json(compact('file_size'));
                break;
            case 'start-download':
                try {
                    touch($tmp_path);
                    if ($fp = @fopen($remote_url, "rb")) {
                        if (!$download_fp = @fopen($tmp_path, "wb")) {
                            $this->json_info(1, lang_admin('unable_to_open_temporary_file'));
                            exit;
                        }
                        while (!feof($fp)) {
                            if (!file_exists($tmp_path)) {
                                fclose($download_fp);
                                $this->json_info(2, lang_admin('temporary_file_does_not_exist'));
                                exit;
                            }
                            fwrite($download_fp, fread($fp, 1024 * 8), 1024 * 8);
                        }
                        fclose($download_fp);
                        fclose($fp);
                    } else {
                        $this->json_info(3, lang_admin('cannot_open_remote_file'));
                        exit;
                    }
                } catch (Exception $e) {
                    $this->json_info(4, $e->getMessage());
                    exit;
                }
                $this->json_info(0, $tmp_path);
                break;
            case 'get-file-size':
                // 这里检测下 tmp_path 是否存在
                if (file_exists($tmp_path)) {
                    // 返回 JSON 格式的响应
                    $this->json(array('size' => filesize($tmp_path)));
                }
                break;
            case 'exzip':
              /*  $unpath = ROOT.'/cache/template/upgrade/';*/
                $unpath=ROOT;
                // 解压缓存文件夹
                if (!is_dir($unpath)) {
                    tool::mkdir($unpath);
                }
                $archive = new PclZip($tmp_path);
                if (!@$archive->extract(PCLZIP_OPT_PATH, $unpath, PCLZIP_OPT_REPLACE_NEWER)) {
                    //$this->json_info(1, $archive->errorInfo(true));
                    $this->json_info(1, lang_admin("file_error"));
                    exit;
                }
                //清空之前的全部php缓存和html缓存
                cache_make::all_make_delete();

                //解压之后进行文件一一判断
               /*  checkFileAndCopy($unpath.'/template/'.$remark_name, TEMPLATE.'/'.$remark_name);;*/

                $this->json_info(0, lang_admin('template').lang_admin('upgrade').lang_admin('success'));
                break;
            default:
                # code...
                break;
        }
        exit;
    }

    function fckedit_action()
    {
        $id = front::post('id');
        $tpl = str_replace('#', '', $id);
        $tpid = $tpl;
        $tpl = str_replace('_d_', '/', $tpl);
        $tpl = str_replace('_html', '.html', $tpl);
        $res = array();
        $res['content'] = file_get_contents(TEMPLATE . '/' . config::get('template_dir') . '/' . $tpl);
        $res['content'] = "<span id='{$tpid}_fck'></span>" . form::editor($tpid . '_content', $res['content']);
        session::set('fcid', $tpid . '_content');
        session::set('fcid_life', time() + 10);
        echo json::encode($res);
        exit;
    }

    function fetch_action()
    {

        $id = front::post('id');
        $tpl = str_replace('#', '', $id);
        $tpid = $tpl;
        $tpl = str_replace('_d_', '/', $tpl);
        $tpl = str_replace('_html', '.html', $tpl);
        $tpl = str_replace('_css', '.css', $tpl);
        $tpl = str_replace('_js', '.js', $tpl);
        $res = array();
        $res['content'] = file_get_contents(TEMPLATE . '/' . config::get('template_dir') . '/' . $tpl);
        $res['content'] = preg_replace('%</textarea%', '<&#47textarea', $res['content']);
        echo json::encode($res);
        exit;
    }

    function save_action()
    {
        $id = front::post('sid');
        $tpl = str_replace('_d_', '/', $id);
        $tpl = str_replace('#', '', $tpl);
        $tpl = str_replace('_html', '.html', $tpl);
        $tpl = str_replace('_css', '.css', $tpl);
        $tpl = str_replace('_js', '.js', $tpl);
        $res = array();
        $content = htmlspecialchars_decode(front::post('scontent'));
        $content = preg_replace('/\&#039;/s', "'", $content);   //单引号转义
        $content = preg_replace('%<&#47textarea%', '</textarea', $content);
        if ($_GET['site'] != 'default') {
            set_time_limit(0);
            $ftp = new nobftp();
            $ftpconfig = config::get('website');
            $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
            $ftperror = $ftp->returnerror();
            if ($ftperror) {
                exit($ftperror);
            } else {
                $ftp->nobchdir($ftpconfig['ftppath']);
                file_put_contents(ROOT . '/data/tpl.tmp.php', $content);
                $ftp->nobput($ftpconfig['ftppath'] . '/template/' . config::get('template_dir') . '/' . $tpl, ROOT . '/data/tpl.tmp.php');
                $res['message'] = 'ok';
            }
        } else {
            if ($content) {
                $content = stripslashes($content);
                file_put_contents(TEMPLATE . '/' . config::get('template_dir') . '/' . $tpl, $content);
                $res['message'] = 'ok';
            }
        }
        echo $res['message'];
        exit;
    }

    function del_action()
    {
        $dirname = front::get('tplname');
        tool::deleteDir($dirname);
        if (front::get('tagname')){
            front::redirect(url('config/system/set/template/tagname/'.front::get('tagname'), 1));
        }else
            front::redirect(url('config/system/set/template', 1));
    }

    //js加载模块
    function getmodular_action(){
        if (front::get('dirname')){
            if (front::get('page'))$page=front::get('page'); else $page=0;
            autotempdir(front::get('dirname'),$page);
        }
        exit;
    }
    //js加载布局
    function getlayouts_action(){
        if (front::get('dirname')){
            if (front::get('page'))$page=front::get('page'); else $page=0;
            autotempdir(front::get('dirname'),$page);
        }
        exit;
    }
    //js加载模态框
    function getmodals_action(){
        autotempdirmodals('modals');
        exit;
    }
    //js加载组件
    function getmodules_action(){
        if (front::post('dirname')){
            if (front::post('page'))$page=front::post('page'); else $page=0;
            autofronttempdir(front::post('dirname'),front::post("modulesdata"),front::get('isshopping'),$page);
        }
        exit;
    }
    //js加载组件市场
    function getbuymodules_action(){
        if (front::post('dirname')){
            if (front::post('page'))$page=front::post('page'); else $page=0;
            service::getInstance()->autofrontbuytempdir(front::post('dirname'),front::post("modulesdata"),$page);
        }
        exit;
    }

    //获取客服配置
    function getconfig_action(){
        $type=front::post("type");
        if ($type == 'security') {
            if(session::get('ver') != 'corp'){
                front::alert(lang_admin('unauthorized_access'));
            }
        }
        if (!$type)
            $type='[^-]+';

        config::$path=ROOT . '/config/config_'.lang::getisadmin().'.php';
        $source=file_get_contents(config::$path);
        preg_match_all("%//$type-(\S+?)\{(.+?)//\}%s",$source,$result,PREG_PATTERN_ORDER);
        $items=array();
        foreach ($result[2] as $order=>$source2) {
            preg_match_all('%\'(\w+)\'=>\'(.*?)\',\s*//([^=\n\[]+)(\[(.+)\])?((.+))?(=>(.+))?%',$source2,$result2,PREG_SET_ORDER);
            // echo  "<br/><br/><br/><br/><br/><br/>".print_r($result2);
            foreach ($result2 as $key=>$res) {
//不是默认语言包的时候 过滤掉特定字段
                if(lang::getisadmin()!=lang::getisdefault()){
                    //要过滤的特定字段
                    $arr = array('stop_site','isdebug','custom404','nav_top','shield_right_key','nav_blank','template_view','lang_type',
                        'lang_admin_type','safe360_enable','session_ip','ipcheck_enable','admin_nologin','loginfalsetime','cookie_password',
                        'group_on','group_count','isautobak','template_admin_dir','ditu_APK','send_type','header_var',
                        'kill_error','smtp_mail_host','smtp_mail_port','smtp_mail_auth','smtp_user_add','smtp_mail_username','smtp_mail_password',
                        'smtp_host','smtp_port','sms_username','sms_password','sms_on','sms_keyword','sms_maxnum','sms_reg_on','sms_guestbook_on',
                        'sms_order_on','sms_form_on','sms_guestbook_admin_on','sms_form_admin_on','sms_order_admin_on','sms_consult_admin_on',
                        'mobilechk_enable','mobilechk_admin','mobilechk_reg','mobilechk_login','mobilechk_buy','mobilechk_form','mobilechk_comment',
                        'oss_accessKey','oss_secretKey','oss_domain','oss_bucket','oss_setting',                        'install_admin','stop_site','pc_style_color','mobilechk_guestbook','gee_id','gee_key','xiongzhang_appid','xiongzhang_token','isecoding','admin_dir','list_index_php','site_icp','site_beian','site_beian_number','saic_pic','list_cache');
                    if(in_array($res[1], $arr,true)){
                        continue;
                    }
                }
                $item=array();
                $item['name']=$res[1];
                $item['value']=$res[2];
                $item['title']=$res[3];
                if (isset($res[5])){
                    $preg = "/^http(s)?:\\/\\/.+/";
                    if(!preg_match($preg,$_SERVER['SERVER_NAME']))
                    {
                        $serurlname='http://'.$_SERVER['SERVER_NAME'];
                    }else{
                        $serurlname=$_SERVER['SERVER_NAME'];
                    }
                    $res[5]=str_replace("{SERVER_NAME}",$serurlname,$res[5]); ;
                    $item['intro']=$res[5];
                }

                //截取  是否单选
                $setdata=explode("=>",$res[7]);
                if($setdata[0]=="radio"){
                    $item['radio'] = true;
                }
                $res[7]=$setdata[1];

                if (isset($res[7]) &&!strstr($res[7],"image") && !strstr($res[7],"color") ) {
                    if (strstr($res[7],'$mF')){
                        $arr = array_combine(config::getadmin('$mF'),config::getadmin('$mF'));
                        $item['select'] = $arr;
                    }else{
                        $item['select']=url::toarray($res[7]);
                    }
                }elseif (isset($res[7]) && strstr($res[7],"image")) {
                    $item['image']=true;
                }elseif (isset($res[7]) && strstr($res[7],"color")) {
                    $item['color']=true;
                }
                $items[$order][]=$item;
            }
        }
        $showhtml=$this->getconfig_html($result[1],$items,$type) ;
        echo json_encode(array("tabs"=>$result[1],"content"=>$showhtml));
        exit;
    }
    //动态加载config弹出框
    function  getconfig_html($units,$items,$type){
        $showhtml="";
        if(is_array($units)){
            foreach($units as $key => $unit) {
                if ($key>0)
                    $showhtml.='<div role="tabpanel" class="tab-pane" name="tab-show" id="tag-show-config-'.$key.'" >';
                else
                    $showhtml.='<div role="tabpanel" class="tab-pane active" name="tab-show"  id="tag-show-config-'.$key.'" >';
                $showhtml.='<form method="post" name="frmallconfig'.$key.'" id="frmallconfig'.$key.'" action="">';
                $showhtml.='<input type="hidden" name="type" value="'.$type.'" class="form-control">';
                if (is_array($items[$key]))
                    foreach($items[$key] as $keys => $item) {
                        $showhtml.='<div class="input-group">';
                        $showhtml.='<span class="input-group-addon">'.$item['title'].'</span>';
                        if($item['radio']) {
                            foreach ($item['select'] as $key=>$val)
                                $showhtml .= form::radio($item['name'], $key, $key==get($item['name'],true)?true:false) .$val;
                        } elseif (isset($item['select']) && is_array($item['select'])) {
                            $showhtml .=  form::select($item['name'],get($item['name'],true),$item['select'],'class="select"');
                        } elseif (strlen(get($item['name'],true))>50) {
                            $showhtml .=  form::textarea($item['name'],get($item['name'],true),' class="textarea"');
                        } elseif (isset($item['image'])) {
                            $showhtml .=  form::upload_image($item['name'],get($item['name'],true));
                        } elseif ($item['name']=="admin_dir") {
                            $showhtml .=  form::input($item['name'],get($item['name'],true),'onkeyup="value=value.replace(/[^\w\.\/]/ig,\'\')"');
                        } else {
                            $showhtml .=  form::input($item['name'],get($item['name'],true));
                        }
                        $showhtml.='</div>';
                        $showhtml.='<div class="clearfix blank20"></div>';
                    }
                $showhtml.='<div class="clearfix"></div></form></div>';
            }
        }
        return $showhtml;
    }
    //保存配置
    function saveallconfig_action(){

            chkpw('system_'.front::post("type"));
            unset(front::$post["type"]);
            if (is_array(front::$post)){
                foreach (front::$post as $key=>$value) {
                    if(is_array($value)){
                        foreach ($value as $v) {
                            if(false !== strstr($v,'\\')){
                                alerterror(lang_admin('illegal_character'));
                            }
                        }
                    }else if(false !== strstr($value,'\\')){
                        alerterror(lang_admin('illegal_character'));
                    }
                }
                //exit;
            }
            if(preg_match('/(php|asp|aspx|jsp|exe|dll|so|asa)/is',front::$post['upload_filetype'])){
                echo json_encode(array("static"=>0,"message"=>lang_admin("setting_risk_type_file_upload_is_not_allowed")));
                exit;
            }

            if (front::post('admin_dir') &&front::post('admin_dir') != config::getadmin('admin_dir')) {
                $new_dir=ROOT.'/'.front::post('admin_dir');
                if (ADMIN_DIRNAME != $new_dir) {
                    rename(ADMIN_DIRNAME,$new_dir);
                    if (is_dir($new_dir)) {
                        echo json_encode(array("static"=>0,"message"=>lang_admin('lang_background').lang_admin('catalog').lang_admin('lang_change')));
                        exit;
                    }
                    else
                        unset(front::$post['admin_dir']);
                }
            }
            $this->setRewriteFile(front::$post['urlrewrite_on']);
            config::modify(front::$post);
            if(front::post('cnzz_user') && front::post('cnzz_pass')){
                $content = "user:".config::getadmin('cnzz_user')."\tpass:".config::getadmin('cnzz_pass')."\tdate:".date('Y-m-d H:i:s')."\n";
                $file = ROOT.'/data/cnzz.txt';
                $fp = fopen($file,'ab');
                fwrite($fp,$content);
            }
            //首页设置动态 自动删除根目录index.html
            if(front::post('list_index_php')!=1  && array_key_exists('list_index_php',front::$post) ){
                if(file_exists(ROOT.'/index.html')){
                    unlink(ROOT.'/index.html');
                }
                //删除全部语言
                $langdata=getlang();
                if($langdata != "") {
                    foreach ($langdata as $key => $val) {
                        if(file_exists(ROOT.'/index-'. $val['langurlname'].'.html')){
                            unlink(ROOT.'/index-'. $val['langurlname'].'.html');
                        }
                    }
                }
            }
            //修改ueditor_open 配置
            if (array_key_exists('ueditor_open',front::$post)){
                if (front::post('ueditor_open')==0){
                    $ueditor_data = file_get_contents(ROOT . '/ueditor/ueditor.config.js');
                    $ueditor_data = str_replace(",allowDivTransToP:false",",allowDivTransToP:true",$ueditor_data);
                    $ueditor_data = str_replace("//,allowDivTransToP:false ",",allowDivTransToP:true",$ueditor_data);
                    file_put_contents(ROOT . '/ueditor/ueditor.config.js', $ueditor_data);
                }else{
                    $ueditor_data = file_get_contents(ROOT . '/ueditor/ueditor.config.js');
                    $ueditor_data = str_replace(",allowDivTransToP:true",",allowDivTransToP:false",$ueditor_data);
                    $ueditor_data = str_replace("//,allowDivTransToP:true",",allowDivTransToP:false",$ueditor_data);
                    file_put_contents(ROOT . '/ueditor/ueditor.config.js', $ueditor_data);
                }
            }
            event::log(lang_admin('modify').lang_admin('website_configuration'),lang_admin('success'));
            config::modify(front::$post);
            echo json_encode(array("static"=>1,"message"=>lang_admin('set_up').lang_admin('success')));
            exit;

    }

    private function setRewriteFile($urlrewrite_on)
    {
        //$_SERVER['SERVER_SOFTWARE'] = 'IIS6';
        //var_dump($_SERVER['SERVER_SOFTWARE']);
        //exit;
        $base = config::getadmin('base_url');
        if ($urlrewrite_on) {
            if (stristr($_SERVER['SERVER_SOFTWARE'], 'Apache') || stristr($_SERVER['SERVER_SOFTWARE'], 'IIS6')) {
                $htaccess = 'RewriteEngine on' . "\n";
                //$htaccess.= 'RewriteBase '.$base."\n";
                $htaccess .= 'RewriteCond %{REQUEST_FILENAME} !-d' . "\n";
                $htaccess .= 'RewriteCond %{REQUEST_FILENAME} !-f' . "\n";
                $htaccess .= 'RewriteRule !\.(mp3|mp4|wmv|wma|rm|rmvb|js|ico|gif|jpeg|jpg|png|css|swf|php|html|shtml|xml|xsl|wsdl|xslt|eot|svg|ttf|woff|woff2|map|txt)$ ' . $base . '/index.php [NC]' . "\n";
                $httpdurl = '.htaccess';
                $httpd = $htaccess;
            } else if (stristr($_SERVER['SERVER_SOFTWARE'], 'IIS/7') || stristr($_SERVER['SERVER_SOFTWARE'], 'IIS/10')) {
                $web = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
                $web .= '<configuration>' . "\n";
                $web .= '<system.webServer>' . "\n";
                $web .= '<rewrite>' . "\n";
                $web .= '<rules>' . "\n";
                $web .= '<rule name="CmsEasy Url Rewrite">' . "\n";
                $web .= '<match url="\.(mp3|mp4|wmv|wma|rm|rmvb|js|ico|gif|jpeg|jpg|png|css|swf|php|html|shtml|xml|xsl|wsdl|xslt|eot|svg|ttf|woff|woff2|map|txt)$" negate="true" />' . "\n";
                $web .= '<conditions logicalGrouping="MatchAll">' . "\n";
                $web .= '<add input="{REQUEST_FILENAME}" matchType="IsDirectory" ignoreCase="false" negate="true" />' . "\n";
                $web .= '<add input="{REQUEST_FILENAME}" matchType="IsFile" ignoreCase="false" negate="true" />' . "\n";
                $web .= '</conditions>' . "\n";
                $web .= '<action type="Rewrite" url="index.php" />' . "\n";
                $web .= '</rule>' . "\n";
                $web .= '</rules>' . "\n";
                $web.= '</rewrite>'."\n";
                $web.= '<httpErrors errorMode="Custom">'."\n";
                $web.= '<remove statusCode="404" subStatusCode="-1" />'."\n";
                $web.= '<error statusCode="404" prefixLanguageFilePath="" path="/404.php" responseMode="ExecuteURL" />'."\n";
                $web.= '</httpErrors>'."\n";
                $web .= '</system.webServer>' . "\n";
                $web .= '</configuration>' . "\n";
                $httpdurl = 'web.config';
                $httpd = $web;
            } else if (stristr($_SERVER['SERVER_SOFTWARE'], 'nginx')) {
                $htaccess = 'if ($request_filename !~* \.(mp3|mp4|wmv|wma|rm|rmvb|js|ico|gif|jpeg|jpg|png|css|swf|php|html|shtml|xml|xsl|wsdl|xslt|eot|svg|ttf|woff|woff2|map|txt$)) {' . "\n";
                $htaccess .= 'rewrite .* ' . $base . '/index.php last;' . "\n";
                $htaccess .= '}' . "\n";
                $httpdurl = '.htaccess';
                $httpd = $htaccess;
            } else {
                $httpd = '[ISAPI_Rewrite]' . "\n";
                $httpd .= '# 3600 = 1 hour' . "\n";
                $httpd .= 'CacheClockRate 3600' . "\n";
                $httpd .= 'RepeatLimit 32' . "\n";
                $httpd .= 'RewriteRule !\.(mp3|mp4|wmv|wma|rm|rmvb|js|ico|gif|jpeg|jpg|png|css|swf|php|html|shtml|xml|xsl|wsdl|xslt|eot|svg|ttf|woff|woff2|map|txt)$ ' . $base . '/index.php [L]' . "\n";
                $httpdurl = 'httpd.ini';
            }
            if (!file_exists(ROOT . '/' . $httpdurl)){
                $fp = fopen(ROOT . '/' . $httpdurl, 'w');
                fputs($fp, $httpd);
                fclose($fp);
            }
        } else {
            if(config::getadmin('autoDelRewriteFile')){
                @unlink(ROOT . '/httpd.ini');
                @unlink(ROOT . '/.htaccess');
                @unlink(ROOT . '/web.config');
            }
            /*if (file_exists(ROOT . '/httpd.ini')) @unlink(ROOT . '/httpd.ini');
            if (file_exists(ROOT . '/.htaccess')) @unlink(ROOT . '/.htaccess');
            if (file_exists(ROOT . '/web.config')) @unlink(ROOT . '/web.config');*/
        }
        //exit;
    }

    //修复旧模板配置
    function  xiufuoldtemplate_action(){
        //生成全部语言
        $langdata=getlang();
        if($langdata != "") {
            foreach ($langdata as $key => $val) {
                $path=TEMPLATE . '/' . config::get('template_dir') . '/data/templatetag_'.$val['langurlname'].'.php';
                //判断模板标签文件是否存在！不存在则创建
                if (file_exists($path)){
                    $oldtemplate_setting = include $path;
                    if (is_array($oldtemplate_setting)){
                        foreach ($oldtemplate_setting as $temkey=>$temval){
                            $oldtemplate_setting[$temkey]['remarksname']=$temval['name'];
                            unset($oldtemplate_setting[$temkey]['name']);
                        }
                        file_put_contents(iconv("utf-8", "gbk",$path), '<?php return ' . var_export($oldtemplate_setting, true) . ';');
                    }
                }
            }
        }
        exit;
    }

    function end()
    {
        $this->render();
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
