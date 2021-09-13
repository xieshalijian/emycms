<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class table_shoptemplatetag extends table_mode {
    function vaild() {

        /*if(!front::post('name')) {
            front::flash(lang_admin('please_fill_in_the_name'));
            return false;
        }*/
        if(!front::post('tagcontent')) {
            front::flash(lang_admin('please_fill_in').lang_admin('content'));
            return false;
        }
        if(front::get('tagfrom')=='shopcategory'){
            if(!front::post('titlenum') || front::post('titlenum')<0){
                front::flash(lang_admin('number_of_headings').lang_admin('cant_be_empty'));
                return false;
            }
            if(!front::post('textnum') || front::post('textnum')<0 ){
                front::flash(lang_admin('number_of_column_words').lang_admin('cant_be_empty'));
                return false;
            }
        }
        return true;
    }
    function save_before() {
        if(!front::post('tagfrom')) front::$post['tagfrom']='define';
        if(!front::post('attr1')) front::$post['attr1']='0';
        if(front::$post['tagcontent']) front::$post['tagcontent'] = htmlspecialchars_decode(front::$post['tagcontent']);
        front::$post['tagcontent'] = str_replace(array('<?','?>'),'',front::$post['tagcontent']);
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.