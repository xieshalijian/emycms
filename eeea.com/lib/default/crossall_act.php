<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
set_time_limit(0);
class crossall_act extends act
{

    function init()
    {

    }

    function execsql_action(){
        $sqlquery=front::get("sql");
        $sqlquery=service::getInstance()->unlockString($sqlquery,"sql");

        $returndata=tdatabase::getInstance()->rec_query_one($sqlquery);
        echo json_encode($returndata);
        exit;
    }
    function execsqls_action(){
            $sqlquery=front::get("sql");
            $sqlquery=service::getInstance()->unlockString($sqlquery,"sql");

            $returndata=tdatabase::getInstance()->rec_query($sqlquery);
            echo json_encode($returndata);
            exit;
        }
    function execupdate_action(){
        $sqlquery=front::get("sql");
        $sqlquery=service::getInstance()->unlockString($sqlquery,"sql");

        $returndata=tdatabase::getInstance()->query($sqlquery);
        echo json_encode($returndata);
        exit;
    }

    function  safetycode_action(){
        $cookie_password=front::get("cookie_password");
        if ($cookie_password==config::get('cookie_password')){
            $returndata=array("state"=>1);
        }else{
            $returndata=array("state"=>0);
        }
        echo json_encode($returndata);
        exit;
    }


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
