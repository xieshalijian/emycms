<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class apps extends table
{

    public $name = 'apps';
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new apps();
            self::$me = $class;
        }
        return self::$me;
    }

    function getcols($act)
    {
        switch ($act) {
            case 'manage':
                return '*';
            default:
                return '*';
        }
    }

    function get_form()
    {
        return array(
            'installed' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(0 => '未安装', 1 => '已安装')),
                'default' => 0,
            ),
            'iscorp' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => '是', 0 => '否')),
                'default' => '0',
            ),
            'is_vip' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => '是', 0 => '否')),
                'default' => '0',
            ),
            'static' => array(
                'selecttype' => 'select',
                'select' => form::arraytoselect(array(1 => lang_admin('release'), 0 =>lang_admin('no_release'))),
                'default' => '0',
            ),
        );
    }


    //插件上传图片   str 图片上传路径  $path本地图片路径
    public static function updateimg($str=null,$path=null)
    {
        //$str  图片路径
        //当安装阿里云插件的时候
        $aliyunossdata=apps::getInstance()->getrow("id='aliyunoss'  and installed=1  ");
        if(is_array($aliyunossdata)){
            if($aliyunossdata['static'] && $aliyunossdata['installed']){
                //是否上传到OSS
                $aliyunosssetting=aliyunosssetting::getInstance()->getrow("");
                if($aliyunosssetting["oss_setting"]=='1' || $aliyunosssetting["oss_setting"]=='2'){
                    $info = pathinfo($str);
                    $file_name =  basename($str,'.'.$info['extension']);   //获取图片名称
                    $file_hou_name = array_pop(explode('.', $str)); //获取图片后缀

                    $aliyunoss=new aliyunoss();
                    $updateimgname="images/".date("Ymd")."/".$file_name.'.'.$file_hou_name;
                    $aliyunoss->ossUpload($path,$updateimgname );
                    return $aliyunosssetting['oss_domain'].'/'.$updateimgname;
                }
            }
        }

        //$str  图片路径
        //当安装阿里云插件的时候
        $qiniuyunossdata=apps::getInstance()->getrow("id='qiniuyunoss'  and installed=1  ");
        if(is_array($qiniuyunossdata)){
            if($qiniuyunossdata['static'] && $qiniuyunossdata['installed']){
                //是否上传到OSS
                $qiniuyunossconfig=qiniuyunossconfig::getInstance()->getrow("");
                if($qiniuyunossconfig["oss_setting"]=='1' || $qiniuyunossconfig["oss_setting"]=='2'){
                    $info = pathinfo($str);
                    $file_name =  basename($str,'.'.$info['extension']);   //获取图片名称
                    $file_hou_name = array_pop(explode('.', $str)); //获取图片后缀

                    $qiniuyunoss=new qiniuyunoss();
                    $updateimgname="images/".date("Ymd")."/".$file_name.'.'.$file_hou_name;
                    $qiniuyunoss->ossUpload($path,$updateimgname );
                    return $qiniuyunossconfig['oss_domain'].'/'.$updateimgname;
                }
            }
        }

        return "";
    }

    //获取服务端的支付方式
    public static function getpay()
    {
        $data=array();
        if (session::get("user_buy_pay")=="") {
            //获取服务器的插件列表
            $url = "https://u.cmseasy.cn/index.php?case=client&act=getpay";  //服务器获取支付方式列表的地址
            $data = service::cmseayurl($url);   //获取服务器的数据
            $data = json_decode($data, true);
            session::set("user_buy_pay",$data);  //写到php服务器缓存
        }else{
            $data=session::get("user_buy_pay");
        }
        return $data;
    }



    //插件删除图片
    public static function  deleteossimg($str=null){
        //当安装阿里云插件的时候
        $aliyunossdata=apps::getInstance()->getrow("id='aliyunoss'  and installed=1  ");
        if(is_array($aliyunossdata)){
            $aliyunoss=new aliyunoss();  //声明OSS
            $aliyunoss->ossdelete($str);//删除oss文件
        }

    }


    //查询当前用户优惠劵
    public static function getappsname($appsid=null) {
        $appsdata = apps::getInstance()->getrow("id='".$appsid."'", 1);
        if (isset($appsdata['name']))
            return $appsdata['name'];
        else
            return '';
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.