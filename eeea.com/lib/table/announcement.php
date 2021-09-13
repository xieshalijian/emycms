<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class announcement extends table
{
    function getcols($act = '')
    {
        switch ($act) {
            case 'list':
                return 'id,title,adddate,content,recommend' . $this->mycols();
            case 'modify':
                return 'id,title,content,recommend' . $this->mycols();
            case 'manage':
                return 'id,title,adddate,content,recommend';
            default:
                return '1';
        }
    }

    function get_form() {
        return array(
            'content'=>array(
                'type'=>'mediumtext',
            ),
            'recommend'=>array(
                'selecttype'=>'radio',
                'select'=>form::arraytoselect(array(0=>lang_admin('no'),1=>lang_admin('yes'))),
                'default'=>0,
            ),
        );
    }

    static function url($id)
    {
        if(config::get('urlrewrite_on')){
            return rtrim(config::get('base_url'),'/').'/announ-show-'.$id.'.htm';
        }
        return url::create('announ/show/id/' . $id);
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.