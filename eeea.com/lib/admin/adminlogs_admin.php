<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');
class adminlogs_admin extends admin {
    function init() {
    }
    function batch_action(){
        //txt清空
        if(isset($_GET['logTime'])){
            $logTime=$_GET['logTime'];
        }else{
            $filetime=date('Ymd', time());
            $logTime=$filetime;
        }
        $fileToName='log'.$logTime.'.txt';
        $filename  = 'data/event/'.$fileToName;
        //定义操作文件
        file_put_contents($filename,"");
        event::log(lang_admin('journal').lang_admin('eliminate'),lang_admin('success'));
    }
    function deleteLogTxt_action(){
        if(isset($_GET['deletType'])){
            $path = ROOT."/data/event/";
            //设置需要删除的文件夹
            $p = scandir($path);
            if($_GET['deletType']=='0'){
                //删除本日
                foreach($p as $val){
                    //排除目录中的.和..
                    $filetime=date('Ymd', time());
                    if($val !="." && $val !=".." && strpos($val, $filetime) == FALSE)
                    {
                        unlink($path.$val);
                        //删除文件
                    }
                }
            }else if($_GET['deletType']=='1'){
                //删除本周
                foreach($p as $val){
                    //排除目录中的.和..
                    $filetime=$this->getWeek();
                    $russ=true;
                    for ($i=1;$i<=7;$i++){
                        if($val !="." && $val !=".." && strpos($val, $filetime[$i]) != FALSE)
                        {
                            $russ=false;
                        }
                    }
                    if ($russ){
                        unlink($path.$val);
                        //删除文件
                    }
                }
            }else if($_GET['deletType']=='2'){
                //删除本月
                foreach($p as $val){
                    //排除目录中的.和..
                    $filetime=date('Ym', time());
                    if($val !="." && $val !=".." && strpos($val, $filetime) == FALSE)
                    {
                        unlink($path.$val);
                        //删除文件
                    }
                }
            }
        }
    }
    //获取本周
    function getWeek(){
        $time =  time();
        //组合数据
        $date= (array) null;
        for ($i=1; $i<=7; $i++){
            $date[$i] = date('Ymd' ,strtotime( '+' . $i-7 .' days', $time));
        }
        return $date;
    }
    function delete_action(){
        //txt的删除
        if(isset($_GET['id'])){
            if(isset($_GET['logTime'])){
                $logTime=$_GET['logTime'];
            }else{
                $filetime=date('Ymd', time());
                $logTime=$filetime;
            }
            $fileToName='log'.$logTime.'.txt';
            $filename  = 'data/event/'.$fileToName;
            //定义操作文件
            $delline=$_GET['id'];
            //要删除的行数
            $farray=file($filename);
            //读取文件数据到数组中
            $newfp='';
            //新数据
            for($i=0;$i<count($farray);$i++)
            {
                //判断删除的行,strcmp是比较两个数大小的函数
                if(strcmp($i+1,$delline)==0)
                {
                    continue;
                }
                if(trim($farray[$i])<>"")
                {
                    $newfp.=$farray[$i];
                    //重新整理后的数据
                }
            }
            $fp=@fopen($filename,"w");
            //以写的方式打开文件
            @fputs($fp,$newfp);
            @fclose($fp);
            event::log(lang_admin('delete').lang_admin('journal').','.lang_admin('line_number').'='.$_GET['id'],lang_admin('success'));
        }
    }
    function manage_action() {
        if(isset($_GET['logTime'])){
            $logTime=$_GET['logTime'];
        }else{
            $filetime=date('Ymd', time());
            $logTime=$filetime;
        }
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }else{
            $page=1;
        }
        $this->view->logPage= $page;
        $this->view->logTime= $logTime;
    }
    function end() {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
