<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class field extends table {

    public $name = 'field';
    static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new field();
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

    function get_form() {
        return array(

        );
    }


    static  function  save($post,$field_belonging,$field_type){
        $langdata=lang::getlang();
        $post['cname']=array();
        $post['tips']=array();
        $post['catid']=array();
        $post['select']=array();
        if(is_array($langdata)) {
            foreach ($langdata as $key => $value) {
                $newcname = 'cname_' . $value['langurlname'];
                $newtips = 'tips_' . $value['langurlname'];
                $newcatid = 'catid_' . $value['langurlname'];
                $newselect = 'select_' . $value['langurlname'];
                $post['cname'][$newcname]=isset($post[$newcname])?$post[$newcname]:"";
                $post['tips'][$newtips]=isset($post[$newtips])?$post[$newtips]:"";
                $post['catid'][$newcatid]=isset($post[$newcatid])?$post[$newcatid]:"";
                $post['select'][$newselect]=isset($post[$newselect])?$post[$newselect]:"";
            }
        }
        $post['cname']=serialize($post['cname']);
        $post['tips']=serialize($post['tips']);
        $post['catid']=serialize($post['catid']);
        $post['select']=serialize($post['select']);

        $post['field_belonging']=$field_belonging;
        $post['field_type']=$field_type;
        if (isset($post['id']) && $post['id']){
            $id=$post['id'];
            unset($post['id']);
            field::getInstance()->rec_update($post,array("id"=>$id));
        }else{
            field::getInstance()->rec_insert($post);
        }

    }

    static  function  setfield($field_data){
        $langdata=lang::getlang();
        if (is_array($field_data)){
            foreach ($field_data as $field_data_key=>$field_data_val){
                foreach ($field_data_val as $field_key=>$field_val){
                        $post=array();
                        $post['name']=isset($field_val['name'])?$field_val['name']:"";
                        $post['field_belonging']="table-fieldset";
                        $post['field_type']=$field_data_key;
                        $field = field::getInstance()->getrow($post);
                        if (is_array($field))continue;  //存在则不需要继续插入
                        $post['cname']=array();
                        $post['tips']=array();
                        $post['catid']=array();
                        $post['select']=array();
                        if(is_array($langdata)) {
                            foreach ($langdata as $key => $value) {
                                $newcname = 'cname_' . $value['langurlname'];
                                $newtips = 'tips_' . $value['langurlname'];
                                $newcatid = 'catid_' . $value['langurlname'];
                                $newselect = 'select_' . $value['langurlname'];
                                $post['cname'][$newcname]=isset($field_val[$newcname])?$field_val[$newcname]:"";
                                $post['tips'][$newtips]=isset($field_val[$newtips])?$field_val[$newtips]:"";
                                $post['catid'][$newcatid]=isset($field_val[$newcatid])?$field_val[$newcatid]:"";
                                $post['select'][$newselect]=isset($field_val[$newselect])?$field_val[$newselect]:"";
                            }
                        }
                        $post['cname']=serialize($post['cname']);
                        $post['tips']=serialize($post['tips']);
                        $post['catid']=serialize($post['catid']);
                        $post['select']=serialize($post['select']);
                        $post['isshoping']=isset($field_val['isshoping'])?$field_val['isshoping']:0;
                        $post['type']=isset($field_val['type'])?$field_val['type']:"text";
                        $post['len']=isset($field_val['len'])?$field_val['len']:0;
                        $post['selecttype']=isset($field_val['selecttype'])?$field_val['selecttype']:0;
                        $post['filetype']=isset($field_val['filetype'])?$field_val['filetype']:"";
                        $post['issearch']=isset($field_val['issearch'])?$field_val['issearch']:0;
                        $post['isnotnull']=isset($field_val['isnotnull'])?$field_val['isnotnull']:0;
                        $post['listorder']=isset($field_val['listorder'])?$field_val['listorder']:0;

                        field::getInstance()->rec_insert($post);
                }
            }
        }
    }

    static  function  getfield($field_belonging){
        $field = field::getInstance()->getrows(array('field_belonging' => $field_belonging),0);
        $setting=array();
        $langdata=lang::getlang();
        if (is_array($field))
          foreach ($field as $val){
                if (isset($val['field_type']) && $val['field_type']!=""){
                    $field_son_data=array();
                    $field_son_data['name']=isset($val['name'])?$val['name']:"";

                    $val['cname'] = (isset($val['cname']) && $val['cname']!= "")?unserialize($val['cname']):"";
                    $val['tips'] = (isset($val['tips']) && $val['tips']!= "")?unserialize($val['tips']):"";
                    $val['catid'] = (isset($val['catid']) && $val['catid']!= "")?unserialize($val['catid']):"";
                    $val['select'] = (isset($val['select']) && $val['select']!= "")?unserialize($val['select']):"";
                    if(is_array($langdata)) {
                        foreach ($langdata as $key => $value) {
                            $newcname = 'cname_' . $value['langurlname'];
                            $newtips = 'tips_' . $value['langurlname'];
                            $newcatid = 'catid_' . $value['langurlname'];
                            $newselect = 'select_' . $value['langurlname'];
                            $field_son_data[$newcname]=isset($val['cname'][$newcname])?$val['cname'][$newcname]:"";
                            $field_son_data[$newtips]=isset($val['tips'][$newtips])?$val['tips'][$newtips]:"";
                            $field_son_data[$newcatid]=isset($val['catid'][$newcatid])?$val['catid'][$newcatid]:"";
                            $field_son_data[$newselect]=isset($val['select'][$newselect])?$val['select'][$newselect]:"";
                        }
                    }
                    $field_son_data['isshoping']=isset($val['isshoping'])?$val['isshoping']:0;
                    $field_son_data['type']=isset($val['type'])?$val['type']:"text";
                    $field_son_data['len']=isset($val['len'])?$val['len']:0;
                    $field_son_data['selecttype']=isset($val['selecttype'])?$val['selecttype']:0;
                    $field_son_data['filetype']=isset($val['filetype'])?$val['filetype']:"";
                    $field_son_data['issearch']=isset($val['issearch'])?$val['issearch']:0;
                    $field_son_data['isnotnull']=isset($val['isnotnull'])?$val['isnotnull']:0;
                    $field_son_data['id']=isset($val['id'])?$val['id']:0;
                    $field_son_data['listorder']=isset($val['listorder'])?$val['listorder']:0;

                    $field_data[$val['name']]=$field_son_data;
                    $setting[$val['field_type']]=$field_data;
                }
          }

        //q迁移一次后清空
        settings::getInstance()->rec_update(array("value"=>""),array('tag' => 'table-fieldset'));
        return $setting;

    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.