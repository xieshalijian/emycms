<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class attachment_act extends act
{
    function init()
    {
        $this->view->usergroupid = 1000;
        front::check_type(cookie::get('login_username'), 'safe');
        front::check_type(cookie::get('login_password'), 'safe');
        if (cookie::get('login_username') && cookie::get('login_password')) {
            $user = new user();
            $user = $user->getrow(array('username' => cookie::get('login_username')));
            if (is_array($user) && cookie::get('login_password') == front::cookie_encode($user['password'])) {
                $this->view->user = $user;
                $this->view->usergroupid = $user['groupid'];
            }
        }
    }

    function getBrowser()
    {
        $sys = $_SERVER['HTTP_USER_AGENT'];
        if (stripos($sys, "NetCaptor") > 0) {
            $exp = "NetCaptor";
        } elseif (stripos($sys, "Firefox/") > 0) {
            preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
            $exp = "Mozilla Firefox " . $b[1];
        } elseif (stripos($sys, "MAXTHON") > 0) {
            preg_match("/MAXTHON\s+([^;)]+)+/i", $sys, $b);
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            $exp = $b[0] . " (IE" . $ie[1] . ")";
        } elseif (stripos($sys, "MSIE") > 0) {
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            $exp = "Internet Explorer " . $ie[1];
        } elseif (stripos($sys, "Netscape") > 0) {
            $exp = "Netscape";
        } elseif (stripos($sys, "Opera") > 0) {
            $exp = "Opera";
        } else {
            $exp = lang('unknown_browser');
        }
        return $exp;
    }

    function attachment_js_action()
    {
        //front::check_type(front::get('aid'));
        $aid = intval(front::get('aid'));
        $filename = front::get('filename');
        $archive = archive::getInstance();
        $user = user::getInstance();
        $catid = $archive->getcids($aid);
        $name = archive_attachment($aid, 'intro');
        $path = archive_attachment($aid, 'path');
        $base_url = config::get('base_url');
        if (!$name) $name = preg_replace('%(.*)[\\\\\/](.*)_\d+(\.[a-z]+)$%i', '$2', $path);
        $catpv = rank::catget($catid, $this->view->usergroupid, 'down');
        $arcpv = rank::arcget($aid, $this->view->usergroupid, 'down');
        //var_dump($arcpv);
        if (!$arcpv || !$catpv) {
            $link = "<a id='att' title='$name' name='attmenoy'  href='javascript:alert(\"" . lang('without_authorization_can_ not_download') . "\");' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a>";
            echo tool::text_javascript($link);
            exit;
        } else {
            if (config::get('verifycode')) {
                if ($filename)
                    $link = "<a target='_blank' title='$name' id='att' name='attmenoy' href='" . url::create('attachment/downfile/aid/' . $aid.'/v/ce/filename/'.$filename) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a>";
                else
                    $link = "<a target='_blank' title='$name' id='att' name='attmenoy'  href='" . url::create('attachment/downfile/aid/' . $aid . '/v/ce') . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a>";
                echo tool::text_javascript($link);
                exit;
            } else {
                $archivedata=$archive->getrow('aid='.$aid);
                $archivedata['readmenoy']=$archivedata['readmenoy']?$archivedata['readmenoy']:getcategory_menoy("readmenoy",$archivedata['catid']);
                $archivedata['domwmenoy']=$archivedata['domwmenoy']?$archivedata['domwmenoy']:getcategory_menoy("domwmenoy",$archivedata['catid']);
                if($archivedata['readmenoy']>0 || $archivedata['domwmenoy']>0){
                    //提取商品
                    if(file_exists(ROOT."/lib/table/shopping.php")) {
                        $userdata=$user->getrow("username='".session::get('username')."'");
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
                            if ($filename)
                                $link = "<a target='_blank' title='$name' id='att' name='attmenoy' href='" . url::create('attachment/down/aid/' . $aid.'/filename/'.$filename) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a>";
                            else
                                $link = "<a target='_blank' title='$name' id='att' name='attmenoy' href='" . url::create('attachment/down/aid/' . $aid) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a>";
                        }else{
                            $url="'".url('archive/buyarchive/aid/'.$aid)."'";
                            $link = "<a target='_blank' id='att' name='attmenoy' onclick=\"shoppingarchive(".$url.",'".lang('doyou_buy')."')\" class='btn btn-default visual-content-down-link-btn'>" . lang('buy') . "</a>";
                        }
                    }else{
                        $link = "";
                    }

                }else{
                    if ($filename)
                        $link = "<a target='_blank' title='$name' id='att' name='attmenoy' href='" . url::create('attachment/down/aid/' . $aid.'/filename/'.$filename) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a>";
                    else
                        $link = "<a target='_blank' title='$name' id='att' name='attmenoy' href='" . url::create('attachment/down/aid/' . $aid) . "' class='btn btn-default visual-content-down-link-btn'>" . lang('nowdownload') . "</a>";
                }
                echo tool::text_javascript($link);
                exit;
            }
        }
    }

    function downfile_action()
    {
        //$base_url = config::get('base_url');
        if (front::post('submit')) {
            if (config::get('verifycode') == 1) {
                if (!session::get('verify') || front::post('verify') <> session::get('verify')) {
                    alerterror(lang('verification_code'));
                    exit;
                }
            } else if (config::get('verifycode') == 2) {
                if (!verify::checkGee()) {
                    alerterror(lang('verification_code'));
                    exit;
                }
            }


            front::check_type(front::get('aid'));
            $aid = front::get('aid');
            $name = archive_attachment($aid, 'intro');
            $path = archive_attachment($aid, 'path');
            if (!$name) $name = preg_replace('%(.*)[\\\\\/](.*)_\d+(\.[a-z]+)$%i', '$2', $path);
            @cookie::set('allowdown', md5(url::create('attachment/downfile/aid/' . $aid . '/v/ce')));
            if (!rank::arcget($aid, $this->view->usergroupid, 'down'))
                $link = "<br /><br /><br /><br /><br /><p align='center'><a id='att' href='javascript:alert(\"" . lang('without_authorization_can_ not_download') . "\");' class='btn btn-default visual-content-down-link-btn'><br /><br />" . lang('click_download') . "</a></p>";
            else $link = "<br /><br /><br /><br /><br /><br /><p align='center'><a id='att' href='" . url::create('attachment/down/aid/' . $aid) . "' class='btn btn-default visual-content-down-link-btn' style='display:block;width:128px;height:168px; padding:148px 0px 0px 0px;background: url(/images/download.jpg) center top no-repeat;'>" . lang('click_download') . "</a></p>";
            echo $link;
            exit;

        }
    }

    function down_action()
    {
        if (config::get('verifycode')) {
            if (cookie::get('allowdown') != md5(url::create('attachment/downfile/aid/' . front::get('aid') . '/v/ce'))) {
                header("Location: index.php?case=attachment&act=downfile&aid=" . front::get('aid') . "&v=ce");
            }
        }
        //δ֧����������
        $archivedata=archive::getInstance()->getrow('aid='.front::get('aid'));
        $archivedata['readmenoy']=$archivedata['readmenoy']?$archivedata['readmenoy']:getcategory_menoy("readmenoy",$archivedata['catid']);
        $archivedata['domwmenoy']=$archivedata['domwmenoy']?$archivedata['domwmenoy']:getcategory_menoy("domwmenoy",$archivedata['catid']);
        if ($archivedata['readmenoy']>0 || $archivedata['domwmenoy']>0) {
            $userdata=user::getInstance()->getrow("username='".session::get('username')."'"); //�û��Ƿ����
            $array = explode(",",$userdata['buyarchive']);
            //设置时间限制的时候
            if (config::get("attachment_time")){
                $attachment_time=intval(config::get("attachment_time"));
                $xfconsumption = xfconsumption::getInstance()->getrow("xftype=4 and aid=".front::get('aid')." and mid=".user::getusersid()," adddate desc");
                $old_time=date("Y-m-d", strtotime("+".$attachment_time." day", strtotime( $xfconsumption['adddate'])));
                $this_data=date("Y-m-d");
                 if(strtotime($old_time)<strtotime($this_data)){
                     $link = "<script>alert(\"" . lang('no_buy_no_down') . "\");</script>";
                     exit($link);
                 }
            }
            if(!in_array(front::get('aid'),$array)) {
                $link = "<script>alert(\"" . lang('no_buy_no_down') . "\");</script>";
                exit($link);
            }
            //设置ip限制的时候
            if (config::get("attachment_ip")){
                $ips = explode(",", config::get("attachment_ip"));
                if (!in_array(front::ip(),$ips)){
                    $link = "<script>alert(\"" . lang('no_buy_no_down') . "\");</script>";
                    exit($link);
                }
            }
        }

        if (!rank::arcget(front::get('aid'), $this->view->usergroupid, 'down')) {
            $link = "<script>alert(\"" . lang('without_authorization_can_ not_download') . "\");</script>";
            exit($link);
        }
        front::check_type(front::get('aid'));
        if (!rank::arcget(front::get('aid'), $this->view->usergroupid, 'down')) {
            $link = "<script>alert(\"" . lang('without_authorization_can_ not_download') . "\");</script>";
            exit($link);
        }
        if (strtolower(substr(archive_attachment(front::get('aid'), 'path'), 0, 4)) == 'http') {
            echo "<script>window.location.href='" . archive_attachment(front::get('aid'), 'path') . "';</script>";
            exit;
        }


        $filename = front::get('filename'); //如果是自定义字段
        if ($filename && $archivedata[$filename]){
            $path = ROOT . '/' . $archivedata[$filename];
        }else{
            $path = ROOT . '/' . archive_attachment(front::get('aid'), 'path');
        }
        $path = iconv('utf-8', 'gbk//ignore', $path);
        if (!is_readable($path)) {
            header("HTTP/1.1 404 Not Found");
            exit;
        }
        $size = filesize($path);
        $content = file_get_contents($path);
        //$size=strlen($content);
        if (!config::get('is_attachment_intro')  && !$filename){
            $name= $rname = basename($path);
        }else{
            $name = preg_replace('%(.*)[\\\\\/](.*)_\d+(\.[a-z]+)$%i', '$2$3', $path);
            $name = substr($name, -7, 7);
            $name = 'CmsEasy_file_' . $name;
        }
        header('Content-Type: application/octet-stream');
        header("Content-Length: $size");
        header("Content-Disposition: attachment; filename=\"$name\"");
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        echo $content;
        exit;
    }

    function end()
    {
        if (front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
