<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
class attr1
{
    public static $var = array();

    public static function name($id)
    {
        $name = '';
        $attr1 = settings::getInstance()->getrow(array('tag' => 'table-archive'));
        if ($attr1['value'])
            self::$var = @unserialize($attr1['value']);
        else
            self::$var = array();
        preg_match_all('/\(([\d\w]+)\)(\S+)/is', self::$var['attr1'], $result, PREG_SET_ORDER);
        $id_arr = explode(',', $id);
        foreach ($result as $v) {
            foreach ($id_arr as $t_v) {
                if (in_array($t_v, $v))
                    $name .= $v[2] . ' / ';
            }
        }
        return $name;
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.