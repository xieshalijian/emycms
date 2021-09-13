<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class attachment extends table
{
    public $name = 'a_attachment';

    function del($id)
    {
        $attach = $this->getrow($id);
        if (is_array($attach) && $attach['path'])
            @unlink(ROOT . '/' . $attach['path']);
        $this->rec_delete($id);
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.