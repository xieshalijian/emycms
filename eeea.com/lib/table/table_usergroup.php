<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class table_usergroup extends table_mode {
	
	function save_before() {
		parent::save_before();

		if (front::$post['groupid']){
            $groupdata=usergroup::getInstance()->getrow(array("groupid"=>front::$post['groupid']));
            $powerlist=unserialize($groupdata['powerlist']);
            foreach ($powerlist as $key=>$val){
                if (!array_key_exists($key,front::$post['powerlist']) && front::$post['powerlist'][$key]) front::$post['powerlist'][$key]=$val;
            }
        }
		front::$post['powerlist'] = serialize(front::$post['powerlist']);
		if(front::$post['powerlist'] == 'N;') front::$post['powerlist'] = '';
		if(front::$post['fpwlist']){
			front::$post['fpwlist'] = implode(',',front::$post['fpwlist']);
		}else{
			front::$post['fpwlist'] = '';
		}

	}
	
	function view_before(&$data=NULL) {
		if($data['powerlist'] != 'all' && $data['powerlist'] != ''){
			$data['powerlist'] = unserialize($data['powerlist']);
		}
		if($data['fpwlist']) $data['fpwlist'] = explode(',',$data['fpwlist']);
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.