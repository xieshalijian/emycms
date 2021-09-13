<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class announ_act extends act
{
    function init()
    {
    }

    function show_action()
    {
        front::check_type(front::get('id'));
        $announcement = new announcement();
        $this->view->announ = $announcement->getrow(front::get('id'));
    }

    function end()
    {
        if (front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
