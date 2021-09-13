<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

define('PLUGING_DIR_LICENSE',ROOT . '/lib/plugins/license');
class copyright extends table
{

    public $name = 'copyright';
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new copyright();
            self::$me = $class;
        }
        return self::$me;
    }

    function getcols($act)
    {
        switch ($act) {
              default:
                return '*';
        }
    }

    function get_form()
    {
        return array(

        );
    }

    public function chkMoney($aid,$shoptype){
        $new_price = $this->getPrice($aid,$shoptype);
        $balance = getmenoy();
        if($balance - $new_price < 0){
            return false;
        }
        return true;
    }

    public function getPrice($aid,$shoptype){
        $row = archive::getInstance()->getrow($aid);
        $discount=usergroup::getusergrop(user::getuserid()); //获取用户组的折扣
        $isint =usergroup::getisint(user::getuserid());      //获取是否取整

        $attr2=json_decode($row['attr2'], true);
        $row['attr2']=$attr2["attr2_cn"];

        $row['attr2'] = floatval($row['attr2']) * $discount / 10;   //单价打折
        if($isint){                                  //判断取整
            $row['attr2'] = round($row['attr2']);
        }

        $new_price = $old_price = $row['attr2'];
        if(is_array($shoptype)){
            foreach ($shoptype as $r){
                $t = explode(',',$r);
                switch ($t[2]){
                    case 'jia':
                        $new_price += floatval($t[3]);
                        break;
                    case 'jian':
                        $new_price -= floatval($t[3]);
                        break;
                    case 'chen':
                        $new_price *= floatval($t[3]);
                        break;
                    case 'chu':
                        $new_price /= floatval($t[3]);
                        break;
                }
            }
        }
        return $new_price;
    }

    public function chkUser(){
        $_user = front::$user;
        if (!$_user) {
            throw new Exception('请先登录!');
        }
        return $_user;
    }

    public function BuyCopyright($domain,$year,$aid,$shoptype){

        $_user = $this->chkUser();

        $new_price = $this->getPrice($aid,$shoptype);
        $money = user::getmenoy();
        $balance = $money - $new_price;
        user::getInstance()->rec_update(array('menoy'=>$balance),array('userid'=>$_user['userid']));

        if ($aid=="831")$license_type=1;else $license_type=1;
        $rs = copyright::getInstance()->rec_insert([
            'aid' => $aid,
            'uid' => $_user['userid'],
            'addtime' => date('Y-m-d H:i:s'),
            'pay' => $new_price,
            'domain' => $domain,
            'cate' => 'product',
            'timelong' => $year,
            'type'=>$license_type
        ]);
        if(!$rs){
            throw new Exception('授权购买失败!');
        }
        //新增消费记录
        $xfconsumptiondata['adddate'] =  date('Y-m-d h:i:s', time());
        $xfconsumptiondata['mid'] = $_user['userid'];
        $payname ='yuer';
        $xfconsumptiondata['oid'] = date('YmdHis') . '-' . $_user['userid'] . '-' . $payname;
        $xfconsumptiondata['status'] = 1;
        $xfconsumptiondata['menoy'] = $new_price;
        $xfconsumptiondata['xftype'] =15;  //购买版权消费
        $xfconsumptiondata['content'] = ($license_type==1?'cms':"问答").lang_admin("buy").lang_admin("商业版带版权").": ".$domain;
        xfconsumption::getInstance()->rec_insert($xfconsumptiondata);


        return array('code'=>0,'msg'=>'购买商业版带版权成功!','data'=>['id'=>copyright::getInstance()->insert_id()]);
    }

    private function _mkdir($dir, $mode = 0777) {
        if (is_dir($dir) || mkdir($dir, $mode))
            return true;
        if (!$this->_mkdir(dirname($dir), $mode))
            return false;
        return mkdir($dir, $mode);
    }

    public function getCDKey($row){
        return $this->ctCDKey($row);
    }

    private function ctCDKey($row){
        $domain = $row['domain'];
        preg_match_all('/\S+/', $domain, $domains);
        $domains[0] = array_unique($domains[0]);
        sort($domains[0]);
        $dir_name = implode('-', $domains[0]);
        $this->_mkdir(ROOT.'/cdkey/cms/'.$dir_name);
        $dir_name = ROOT.'/cdkey/cms/'.$dir_name;
        $returndata=array("aid"=>$row['aid'],"uid"=>$row['uid'],"domain"=>$row['domain']);
        $returndata=service::passport_encrypt($returndata);
        $source='<?php return ' . var_export($returndata, true) . ';';
        file_put_contents($dir_name.'/copyright.php',$source );
        return $this->ctZip($dir_name,$source);
    }

    private function ctZip($dirname,$str2)
    {
        $zip = new ZipArchive();
        $res = $zip->open($dirname . '/copyright.zip', ZipArchive::CREATE);
        if ($res === TRUE) {
            $zip->addFromString('copyright.php', $str2);
            $zip->addFile(PLUGING_DIR_LICENSE . '/readme.txt', basename(PLUGING_DIR_LICENSE . '/readme.txt'));
            $zip->close();
            return $dirname . '/copyright.zip';
        } else {
            throw new Exception('生成下载文件失败!');
        }

    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.