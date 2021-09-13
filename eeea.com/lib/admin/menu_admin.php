<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT'))
    exit('Can\'t Access !');
set_time_limit(0);
class menu_admin extends admin
{

    function init()
    {
         if (!front::get('page'))
             front::$get['page'] = 1;
        $this->database_menu = menu::getmenu();
    }


    function list_action(){
        $menu = admin_menu::allmenu();
        $this->view->data=array();
        self::getmenu($menu);
    }

    function add_action(){
        if (front::post('submit')) {
            $fromdata=front::$post['fromdata'];
            if (is_array($fromdata)){
                $i=0;
                foreach ($fromdata as $key=>$val){
                    if (array_key_exists($key, $this->database_menu)){
                        if ($val['status']!=$this->database_menu[$key]['status'] || $this->database_menu[$key]['listorder']!=$i){
                            menu::getInstance()->rec_update(array("status"=>$val['status'],"listorder"=>$i),array("listkey"=>$key));
                        }
                    }else{
                        $insert_data=array("listkey"=>$key,"status"=>$val['status'],"listorder"=>$i);
                        menu::getInstance()->rec_insert($insert_data);
                    }
                    $i++;
                }
            }
        }
        front::flash(lang_admin("save_successfully"));
        front::redirect(url::modify('act/list', true));
    }

    function  getmenu($menu,$son=0,$prante=""){
        foreach ($menu as $key=>$val){
                if ($prante==""){
                    $son=0;
                }
             /*$son_fu="";
             if ($son){
               for ($i=1;$i<$son;$i++){
                    $son_fu.="&nbsp;&nbsp;";
               }
               $son_fu.="└";
             }*/
              $data=array("name"=>$key,"key"=>$val[0],"status"=>1,"prante"=>$prante);

              if (array_key_exists($val['0'], $this->database_menu) && !$this->database_menu[$val['0']]['status']){
                $data['status']=0;
              }
              if ($son>0){
                  $this->view->data[count($this->view->data)-1]['son'][]=$data;
              }else{
                  $this->view->data[]=$data;
              }

              if (is_array($val[1])){
                    $son=$son+1;
                    self::getmenu($val[1],$son,$val[0]);
              }
        }
    }


    function end()
    {
        $this->render();

    }



}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
