<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class thirdparty_admin extends admin
{


    function end()
    {
        $this->render();
    }

    function index_action()
    {
        $fileuel=ROOT. '/common/plugins/public/header-js.html';
        if(!file_exists($fileuel))
        {
            exit($fileuel.lang_admin('the_current_directory_file_does_not_exist'));
        }
        $header = array();
        $header['content'] = file_get_contents($fileuel);
        $header['content'] = preg_replace('%</textarea%','<&#47textarea',$header['content']);
        $this->view->header = $header;
        $foot = array();
        $fileuel=ROOT. '/common/plugins/public/foot-js.html';
        if(!file_exists($fileuel))
        {
            exit($fileuel.lang_admin('the_current_directory_file_does_not_exist'));
        }
        $foot['content'] = file_get_contents($fileuel);
        $foot['content'] = preg_replace('%</textarea%','<&#47textarea',$foot['content']);
        $this->view->foot = $foot;

    }

    function save_action()
    {
        front::$post['header'] = stripslashes(htmlspecialchars_decode(htmlspecialchars_decode(front::$post['header'],ENT_QUOTES ),ENT_QUOTES ));
        $headerfile = ROOT. '/common/plugins/public/header-js.html';
        if(!is_dir(dirname($headerfile))){
            tool::mkdir(dirname($headerfile));
        }
        if(!file_put_contents($headerfile,front::$post['header']) && trim(front::$post['header']) !=''){
            echo '<script type="text/javascript">alert("'.lang_admin('failed_to_write_header_code').'!");gotoinurl("'.url('thirdparty/index').'");</script>';
            exit;
        };

        front::$post['foot'] = stripslashes(htmlspecialchars_decode(htmlspecialchars_decode(front::$post['foot'],ENT_QUOTES ),ENT_QUOTES ));
        $footfile = ROOT. '/common/plugins/public/foot-js.html';
        if(!is_dir(dirname($footfile))){
            tool::mkdir(dirname($footfile));
        }
        if(!file_put_contents($footfile,front::$post['foot']) && trim(front::$post['foot']) !=''){
            echo '<script type="text/javascript">alert("'.lang_admin('bottom_code_write_failed').'!");gotoinurl("'.url('thirdparty/index').'");</script>';
            exit;
        };
        echo '<script type="text/javascript">alert("'.lang_admin('preservation').lang_admin('success').'!");gotoinurl("'.url('thirdparty/index').'");</script>';
        exit;
    }



}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
