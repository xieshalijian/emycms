<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class defind extends table
{
    function __construct($name)
    {
        $this->name = $name;
        parent::__construct();
    }

    function getcols($act = '')
    {
        switch ($act) {
            case 'manage':
                return '*';  //fid,adddate,username,ip,archiveid
            case 'modify':
                return 'fid' . $this->mycols();
            case 'user_modify':
                return $this->mycols();
            case 'user_manage':
                return 'fid,adddate' . $this->mycols();
        }
    }

    function get_form_field()
    {
        $arr = array(0 => lang_admin('full_station_use'));
        return array(
            'catid' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(category::option(0, 'tolast', $arr)),
                'default' => get('catid'),
                'regex' => '/\d+/',
                'filter' => 'is_numeric',
            ),
            'ishtml' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(0 => lang_admin('inherit'), 1 => lang_admin('generate'), 2 => lang_admin('no_generate'))),
            ),
            'checked' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(form::yesornotoarray(lang_admin('to_examine'))),
            ),
            'image' => array(
                'filetype' => 'image',
            ),
            'displaypos' => array(
                'selecttype' => 'checkbox',
                'select' => form::arraytoselect(array(1 => lang_admin('home_page_recommendation'), 2 => lang_admin('home_page_focus'),
                    3 => lang_admin('home_page_headlines'), 4 => lang_admin('list_page_recommendation'), 5 => lang_admin('conent_page_recommendation'))),
            ),
            'htmlrule' => array(
                'tips' => lang_admin('default')." ：{?category::gethtmlrule(get('id'),'showhtmlrule')}",
            ),
            'template' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(front::$view->archive_tpl_list()),
                'tips' => lang_admin('default')."：{?category::gettemplate(get('id'),'showtemplate')}",
            ),
            'introduce_len' => array(
                'default' => config::get('archive_introducelen'),
            ),
            'attr1' => array(
                'selecttype' => 'checkbox',
            ),
        );
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.