<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class table_slide  extends table_mode {

    function delete_before($id = '')
    {
        if ($id){
            $slidechild = new slidechild();
            $slidechild->rec_delete("slide_sid=".$id);
        }
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.