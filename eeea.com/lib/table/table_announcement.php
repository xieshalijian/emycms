<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class table_announcement extends table_mode {
    function add_before(act $act=null) {
        front::$post['adddate'] = date('Y-m-d H:i:s');
    }
  
    function save_before() {
		front::$post['content'] = stripcslashes(htmlspecialchars_decode(front::$post['content']));
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.