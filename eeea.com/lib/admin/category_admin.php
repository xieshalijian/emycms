<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
class category_admin extends admin
{
    function init()
    {
        $this->check_pw();
    }

    function getcategoryoption_action(){
        $data=category::getoption();
        $select="";
        $data[0]=lang_admin('multiple_selection_move_to_column');
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

    function getcategorylist_action(){
        $token=Phpox_token::grante_token('table_del');
        echo category::gethtmlcategorydata_new(category::getcategorydata_new(),false,0,$token);
        exit;
    }

    function end()
    {
        $this->render();
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
