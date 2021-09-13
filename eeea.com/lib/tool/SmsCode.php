<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class SmsCode {
    public $code;

    public function getCode(){
        $this->code = mt_rand(123456,987654);
        $_SESSION['smscode'] = $this->code;
    }

    public function getTemplate($func,$argv=null){
        $str = '';
        switch($func){
            case 'chkcode':
                $str = lang('your_verification_code_for_this_operation_is').':'.$_SESSION['smscode'].'。';
                break;
            case 'reg':
                $str = lang('hello_welcome_you_to_register').config::get('sitename').lang('web_site_account_number_generated').'，'.lang('username').'：'.$argv[0].'，'.lang('password').'：'.$argv[1].'，'.lang('log_on_to_the_member_center_to_improve_your_information').'。';
                break;
            case 'guestbook':
                $str = lang('thank_you_for_being_here').config::get('sitename').lang('leave_message_we_have_received_it_Thank_you_for_your_support_and_participation');
                break;
            case 'order':
                $str = '（'.$argv[0].'）'.lang('your_order_has_been_submitted_for_completion_order_number_is').$argv[1].'。'.config::get('sitename').lang('site').'，'.lang('guesttel').'：'.config::get('site_mobile').'。';
                break;
            case 'form':
                $str = lang('hello').'！（'.$argv[0].'）'.lang('content_has_been_submitted_Thank_you_for_your_participation_and_support');
            default :
                break;
        }
        return $str;
    }

    public function chkcode($code){
        if(!$_SESSION['smscode'] || !$code){
            return false;
        }
        return $code == $_SESSION['smscode'];
    }

    public function clear(){
        $_SESSION['smscode'] = null;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.