<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
//error_reporting(0);
class safe_act extends act {

    function getval_action() {
    	$ptime = front::$post['ptime'];
    	$webscan_model = new webscan();
    	$res = $webscan_model->getrow(array('var'=>'key'));
    	if(!empty($res) && !empty($res['value'])){
    		echo md5("webscan360:".$res['value'].":".$ptime);
    	}
    	
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
