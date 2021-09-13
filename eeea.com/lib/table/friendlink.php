<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class friendlink extends table
{
    function getcols($act = '')
    {
        switch ($act) {
            case 'manage':
                return 'id,name,logo,adddate,typeid,username,hits,name,listorder' . $this->mycols();
            case 'modify':
                return 'id,name,url,logo,introduce,linktype,listorder,typeid,state,username' . $this->mycols();
            case 'user_modify':
                return 'id,name,typeid' . $this->mycols();
            case 'user_manage':
                return 'id,adddate,typeid,username,name';
        }
    }

    function get_form()
    {
        return array(
            'linktype' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('text_link'), 2 => 'Logo'.lang_admin('link'))),
            ),
            'typeid' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect($this->gettypes()),
            ),
            'state' => array(
                'selecttype' => 'radio',
                'select' => form::arraytoselect(array(1 => lang_admin('to_examine'), 0 => lang_admin('forbidden'))),
            ),
        );
    }

    function gettypes()
    {
        $sets = settings::getInstance()->getrow(array('tag' => 'table-friendlink'));
        if (!is_array($sets))
            return;
        $data = unserialize($sets['value']);
        preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%m', $data['types'], $result, PREG_SET_ORDER);
        $data = array();
        foreach ($result as $res) $data[$res[1]] = $res[2];
        return $data;
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.