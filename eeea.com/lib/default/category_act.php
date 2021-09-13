<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class category_act extends act
{
    function getcategoryoption_action(){
        $data=category::getoption();
        unset($data[0]);
        $select="";
        $is_select=true;
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";

            if (front::get("catid") && $k == front::get("catid")) {
                $select .= ' selected ';
                $is_select=false;
            }
            if (isset($_GET['id']) && ($_GET['table'] == 'category' || $_GET['table'] == 'type')) {
                if ($_GET['id'] == $k) {
                    $select .= ' disabled ';
                }
            }
            $select .= ">$d</option>";
        }
        $title=front::get("title")?front::get("title"):lang_admin('multiple_selection_move_to_column');
        $select="<option value=\"0\" ".($is_select?"selected":"").">".$title."...</option>".$select;

        echo $select;
        exit;
    }

    function getcategorylist_action(){
        $token=Phpox_token::grante_token('table_del');
        echo category::gethtmlcategorydata_new(category::getcategorydata_new(),false,0,$token);
        exit;
    }

    function out($tpl)
    {
        if (front::$debug) return;
        $this->render($tpl);
        $this->out = true;
        exit;
    }

    function end()
    {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
