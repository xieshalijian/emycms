<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class teaching_act extends act
{

    function init()
    {
        $this->table = 'teaching';
        $this->_table = new $this->table;
        $this->_table->getFields();
        $this->view->form = $this->_table->get_form();
        $this->_pagesize = config::get('manage_pagesize');
        $this->view->manage = $this->table;
        $this->view->primary_key = $this->_table->primary_key;
        if (!front::get('page')) front::$get['page'] = 1;
        $manage = 'table_' . $this->table;
        $this->manage = new $manage;
    }

    //购买教学
    function buyteaching_action(){
        if (!front::$post['domain']){
            echo json_encode(array("static"=>0,"message"=>lang_admin("ip_nonull")));
            exit;
        }
        if (is_array(teaching::getInstance()->getrow(array("uid"=>front::$post['uid'],"domain"=>front::$post['domain'])))){
            echo json_encode(array("static"=>0,"message"=>lang_admin("当前教学已购买！")));
            exit;
        }
        $appsorders=array();
        $payname = 'yuer';
        $appsorders['oid'] = date('YmdHis') . '-0-' . front::$post['uid'] . '-' . $payname;
        $userdata = user::getInstance()->getrow("userid=".front::$post['uid']);
        $appsorders['username']=$userdata['username'];
        $discount=usergroup::getusergrop($userdata['groupid']); //获取用户组的折扣
        $buylicensedata=archive::getInstance()->getrow('aid=730');
        $attr2=json_decode($buylicensedata['attr2'], true);
        $appsorders['menoy']=floatval($attr2['attr2_cn'])*($discount>0?$discount:10)/10;
        $appsorders['domain']=front::$post['domain'];
        $appsorders['mid']=front::$post['uid'];
        $appsorders['ip'] = front::ip();
        $appsorders['status'] = 0;
        $appsorders['pname'] =$userdata['username'];
        $appsorders['telphone'] =$userdata['tel'];
        $appsorders['address'] =$userdata['address'];
        $appsorders['status'] = 0;
        $appsorders['courier_number'] = '';
        $appsorders['s_status'] = 0;
        $appsorders['trade_no'] = '';
        $appsorders['adddate'] = time();
        $appsorders['content'] =lang_admin("buy")."教学: ".$appsorders['domain'] ;

        //校验余额
        if (($userdata['menoy']<$appsorders['menoy'])){
            echo json_encode(array("static"=>0,"message"=>  lang_admin('insufficient_balance_please_recharge_first')));//余额不足
            exit;
        }
        $oldorders=orders::getInstance()->getrow("mid='".front::$post['uid']."' and aid='730' ","id desc");
        if (is_array($oldorders)){
            $thisdata=date('Y-m-d H:i:s', time());
            $oldadddate=date('Y-m-d H:i:s', $oldorders['adddate']);
            $newdata=floor((strtotime($thisdata)-strtotime($oldadddate))%86400);
            if($newdata<30){
                echo json_encode(array("static"=>0,"message"=>lang_admin('buytemplate_down_time'),'thisdata'=>$thisdata,'oldadddate'=>$oldadddate));//请隔30秒下单
                exit;
            }
        }

        $insert=orders::getInstance()->rec_insert($appsorders);
        if ($insert < 1) {
            echo json_encode(array("static"=>0,"message"=>lang_admin('apps_orders_failed')));//订单生成失败
            exit;
        }
        else {
            //修改剩余金额
            $userdata['menoy']=$userdata['menoy']-$appsorders['menoy'];
            $update=user::getInstance()->rec_update(array("menoy"=>$userdata['menoy']),"username='".$appsorders['username']."'");
            if($update>0){
                //消费订单也增加数据
                $xfconsumptiondata['adddate'] =  date('Y-m-d h:i:s', time());
                $xfconsumptiondata['mid'] = front::$post['uid'];
                $payname ='yuer';
                $xfconsumptiondata['oid'] = date('YmdHis') . '-' . front::$post['uid'] . '-' . $payname;
                $xfconsumptiondata['status'] = 1;
                $xfconsumptiondata['menoy'] = $appsorders['menoy'];
                $xfconsumptiondata['xftype'] =10;  //购买教学
                $xfconsumptiondata['content'] =lang_admin("buy")."教学: ".front::$get['domain'];
                xfconsumption::getInstance()->rec_insert($xfconsumptiondata);

                //修改订单状态
                $update=appsorders::getInstance()->rec_update(array("static"=>1),"oid='".$appsorders['oid']."'");
                user::setintegration($appsorders['menoy'], $appsorders['username']);   //积分增加

                if($update>0){
                    //购买成功！  授权表表增加数据
                    $teaching=array();
                    $teaching['oid']=$appsorders['oid'];
                    $teaching['uid']=front::$post['uid'];
                    $teaching['domain']=$appsorders['domain'];
                    $teaching['adddate']=date('Y-m-d H:i:s', time());
                    $teaching['expiredate']=date("Y-m-d H:i:s",strtotime("+1 year"));
                    $teaching['state']=1;
                    teaching::getInstance()->rec_insert($teaching);
                    echo json_encode(array("static"=>1,"message"=>lang_admin('buy_success'),"oid"=>$appsorders['oid']));
                    exit;
                }
            }
        }


    }

    //教学列表
    function teachinglist_action()
    {
        $limit = ((front::get('page') - 1) * config::get('list_pagesize')) . ','.config::get('list_pagesize');
        $where = "uid=".user::getusersid();
        $this->view->type=front::get('type');
        if (front::post('submit')){
            $where .= " AND domain like '%".front::post('search_domain')."%'";
        }
        $this->view->data = $this->_table->getrows($where, $limit, 'adddate desc', $this->_table->getcols('manage'));
        $this->view->record_count = $this->_table->record_count;
    }

    function vip_action()
    {
        if (front::post('submit')){
            $search_ip="search_ip".front::post('search_ip');
            if(session::get($search_ip)){
                $thisdata=date('Y-m-d H:i:s', time());
                $newdata=floor((strtotime($thisdata)-strtotime(session::get($search_ip)))%86400);
                if($newdata>60){
                    session::set($search_ip,date('Y-m-d H:i:s', time()));
                }else{
                    exit("<div class='tip_box' style='width:300px;margin:0px auto;margin-top:50px;padding:20px;border:5px solid #ccc;border-radius: 5px 5px 5px 5px;text-align:center;'>请等待60秒后查询</div>");
                }
            }else{
                session::set($search_ip,date('Y-m-d h:i:s', time()));
            }

            $where = "  domain='".front::post('search_domain')."'";
            $this->view->data = $this->_table->getrow($where);
            $this->view->record_count = $this->_table->record_count;
        }else{
            $this->_view_table ="";
        }
    }


    function end()
    {
        if (isset($this->end) && !$this->end) return;
        if (front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
