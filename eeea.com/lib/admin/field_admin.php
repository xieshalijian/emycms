<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');
class field_admin extends admin {
    function init() {
        $this->table=front::get('table');
        if(preg_match('/^my_/',$this->table)) {
            //form_admin::init();
            $this->_table=new defind($this->table);
        }
        else $this->_table=new $this->table;
        $this->view->form = $this->_table->get_form_field();
        $_fields=array();
        $fields=$this->_table->getFields();
        foreach($fields as $_field) {
            if(preg_match('/^my_/',$_field['name']))
                $_fields[$_field['name']]=$_field;
        }
        $this->_fields=$_fields;
        $this->view->table=$this->table;
        $this->view->primary_key=$this->_table->primary_key;

        //多语言栏目
        $langdata=lang::getlang();
        $catidarray=array();
        if(is_array($langdata)) {
            foreach ($langdata as $key => $value) {
                $catidarray["catid_".$value['langurlname']]=array(
                    'selecttype'=>'select',
                    'select'=>form::arraytoselect(category::getfieldoption(0,'tolast',$arr,$level,$value['langurlname'])),
                    'default'=>intval(get('catid')),
                    'regex'=>'/\d+/',
                    'filter'=>'is_numeric',
                );
            }
        }
        $this->view->catidform = $catidarray;
    }
    function list_action() {
        if($this->table == 'user'){
            chkpw('defined_field_user');
        }
        $fields=$this->_fields;
        //获取到序号  排序
        foreach ($fields as $key => $value){
            //判断语言包
         /*   if( (!setting::$var[$this->table][$key]['langname']) ||
                (setting::$var[$this->table][$key]['langname'] != '' && setting::$var[$this->table][$key]['langname']==lang::getisadmin())){*/
                $fields[$key]['listorder']=isset(setting::$var[$this->table][$key]['listorder'])?setting::$var[$this->table][$key]['listorder']:0;
          /*  }else{
                unset($fields[$key]);
            }*/
        }
        array_multisort($fields,SORT_ASC,$fields);
        $this->view->fields=$fields;
    }
    function add_action() {
        if($this->table == 'user'){
            chkpw('defined_field_user_add');
        }
        if($this->table == 'archive'){
            chkpw('defined_field_content_add');
        }
        if($this->table == 'category'){
            chkpw('defined_field_category_add');
        }
        //新增标签
        if(isset(front::$post['batchmediumtext']) &&  front::$post['batchmediumtext']=='addmediumtext') {
            front::$post['type']='mediumtext';
            front::$post['name']=front::$post['addmediumtextname'];
            $langdata=lang::getlang();
            foreach ($langdata as $key=>$value){
                //绑定栏目为0
                front::$post['catid_'.$value['langurlname']]=0;

                $newaddmediumtextshow='addmediumtextshow_'.$value['langurlname'];
                $newcname='cname_'.$value['langurlname'];
                front::$post[$newcname]=front::$post[$newaddmediumtextshow];
            }
            front::$post['filetype'] =null;
            front::$post['type'] = 'mediumtext';
            front::$post['len']=500;
            front::$post['selecttype']=null;
            front::$post['catid']=0;
            front::$post['istage']=1;

            front::$post['len'] = front::$post['type'] == 'varchar'?min(front::$post['len'],255) : (front::$post['type'] == 'int'?min(front::$post['len'],11) : 0);
            if(front::$post['type'] == 'text'||front::$post['type'] == 'mediumtext'||front::$post['type'] == 'datetime'||front::$post['type'] == 'text')
                front::$post['len']=0;
            $option=front::post('type').(front::post('len')>0?'('.front::post('len').')':'');
            $option .= front::post('isnotnull')?' not null':' null';
            front::$post['isshoping']=front::post('isshoping')=='1'?'1':'0';
            front::$post['listorder']='0';  //排序默认0

            $add=$this->_table->query("ALTER TABLE `{$this->_table->name}` ADD COLUMN `".front::post('name')."` $option");
            if(!$add) {
                front::flash(lang_admin('field_add_failed'));
            }else {
                foreach(front::$post as $k=>$n) if(!preg_match('/submit/',$k)) {
                    setting::$_var[$this->table][front::post('name')][$k]=$n;
                }
                setting::save();

                front::flash(lang_admin('field_add_success'));
                if(front::get('id') && front::get('copy') ){
                    front::redirect(url('table/copy/table/archive/id/'.front::get('id'),true));
                }elseif(front::get('id') && (!front::get('copy'))){
                    front::redirect(url('table/edit/table/archive/id/'.front::get('id'),true));
                }
                else{
                    front::redirect(url('table/add/table/archive/shopping/'.front::get('shopping'),true));
                }
            }
        }
        else if(front::post('submit') && $this->check_myfield()) {
            if(strpos(front::$post['name'],'.') !== FALSE){
                front::flash(lang_admin('field_name_cannot_contain'));
                return;
                //var_dump(front::$post);exit;
            }
            if(front::$post['type']=='_image') {
                front::$post['filetype'] = 'image';
                front::$post['type'] = 'varchar';
                front::$post['len']=100;
                front::$post['selecttype']=null;
            }
            elseif(front::$post['type']=='_file') {
                front::$post['filetype'] = 'file';
                front::$post['type'] = 'varchar';
                front::$post['len']=100;
                front::$post['selecttype']=null;
            }
            elseif(front::$post['type']=='_pic') {
                front::$post['filetype'] = 'pic';
                front::$post['type'] = 'text';
                front::$post['len']=0;
                front::$post['selecttype']=null;
            }
            elseif(front::$post['type']=='mediumtext' && front::$post['batch']=='addmediumtext') {
                front::$post['name']=front::$post['addmediumtextname'];
                front::$post['cname']=front::$post['addmediumtextshow'];
                if(strpos(front::$post['name'],'.') !== FALSE){
                    front::flash(lang_admin('field_name_cannot_contain'));
                    return;
                }
                front::$post['filetype'] =null;
                front::$post['type'] = 'mediumtext';
                front::$post['len']=500;
                front::$post['selecttype']=null;
            }
            else {
                if(front::$post['selecttype']) {
                    front::$post['type'] = 'varchar';
                    if(front::$post['selecttype']=='checkbox') front::$post['len']=100;
                    else front::$post['len']=10;
                }
                front::$post['filetype']=null;
            }
            //绑定语言
            //front::$post['langname']=lang::getisadmin();

            front::$post['len'] = front::$post['type'] == 'varchar'?min(front::$post['len'],255) : (front::$post['type'] == 'int'?min(front::$post['len'],11) : 0);
            if(front::$post['type'] == 'text'||front::$post['type'] == 'mediumtext'||front::$post['type'] == 'datetime'||front::$post['type'] == 'text')
                front::$post['len']=0;
            $option=front::post('type').(front::post('len')>0?'('.front::post('len').')':'');
            $option .= front::post('isnotnull')?' not null':' null';
            front::$post['isshoping']=front::post('isshoping')=='1'?'1':'0';
            front::$post['istage']=front::post('istage')=='1'?'1':'0';
            front::$post['listorder']='0';  //排序默认0

            $add=$this->_table->query("ALTER TABLE `{$this->_table->name}` ADD COLUMN `".front::post('name')."` $option");
            if(!$add) {
                front::flash(lang_admin('field_add_failed'));
            }else {
               /* foreach(front::$post as $k=>$n) if(!preg_match('/submit/',$k)) {
                    setting::$_var[$this->table][front::post('name')][$k]=$n;
                }
                setting::save(front::$post);*/
                //保存自定义字段
                field::save(front::$post,"table-fieldset",$this->table);

                front::flash(lang_admin('field_add_success'));
                front::redirect(url::modify('act/list',true));
            }
        }

    }


    function edit_action() {
        if($this->table == 'user'){
            chkpw('defined_field_user_edit');
        }
        if($this->table == 'archive'){
            chkpw('defined_field_content_edit');
        }

        if(front::post('submit')  &&$this->check_myfield()) {
            if(front::$post['type']=='_image') {
                front::$post['filetype'] = 'image';
                front::$post['type'] = 'varchar';
                front::$post['len']=100;
                front::$post['selecttype']=null;
            }
            elseif(front::$post['type']=='_pic') {
                front::$post['filetype'] = 'pic';
                front::$post['type'] = 'text';
                front::$post['len']=0;
                front::$post['selecttype']=null;
            }
            elseif(front::$post['type']=='_file') {
                front::$post['filetype'] = 'file';
                front::$post['type'] = 'varchar';
                front::$post['len']=100;
                front::$post['selecttype']=null;
            }
            else {
                if(front::$post['selecttype']) {
                    front::$post['type'] = 'varchar';
                    if(front::$post['selecttype']=='checkbox') front::$post['len']=100;
                    else front::$post['len']=10;
                }
                front::$post['filetype']=null;
            }
            //绑定语言
            //front::$post['langname']=lang::getisadmin();

            if(front::$post['type'] == 'text'||front::$post['type'] == 'mediumtext'||front::$post['type'] == 'datetime'||front::$post['type'] == 'text')
                front::$post['len']=0;
            $option=front::post('type').(front::post('len')>0?'('.front::post('len').')':'');
            $option .= front::post('isnotnull')?' not null':' null';
            front::$post['isshoping']=front::post('isshoping')=='1'?'1':'0';
            $edit=$this->_table->query("ALTER TABLE `{$this->_table->name}` CHANGE `".front::post('name')."` `".front::post('name')."` $option");

            if(!$edit) {
                front::flash(lang_admin('field_edit_failed')."ALTER TABLE `{$this->_table->name}` CHANGE `".front::post('name')."` `".front::post('name')."` $option");
            }else {
                if(!front::$post['issearch']) {
                    front::$post['issearch'] = 0;
                }
                if(!front::$post['isnotnull'])
                    front::$post['isnotnull'] = 0;
                if($this->table=='user') {
                    if(!front::$post['showinreg'])
                        front::$post['showinreg'] = 0;
                }
                //保存自定义字段
                field::save(front::$post,"table-fieldset",$this->table);

                front::flash(lang_admin('field_edit_success'));
                front::redirect(url::modify('act/list',true));
            }
        }
        $this->view->data=setting::$var[$this->table][front::get('name')];
        $this->view->field=$this->_fields[front::get('name')];
    }
    function delete_action() {
        if($this->table == 'user'){
            chkpw('defined_field_user_del');
        }
        if($this->table == 'archive'){
            chkpw('defined_field_content_del');
        }
        if(!preg_match('/^my_.+/',front::get('name'))) {
            front::flash(lang_admin('field_name').lang_admin('incorrectness'));
        }
        $delete=$this->_table->query("ALTER TABLE `{$this->_table->name}` DROP `".front::get('name')."`");
        if(!$delete) {
            front::flash(lang_admin('field').lang_admin('delete').lang_admin('failure'));
        }else {
            $id=setting::$var[$this->table][front::get('name')]['id'];
            if ($id){
                unset(setting::$var[$this->table][front::get('name')]);
                field::getInstance()->rec_delete(array('id'=>$id));
            }

            front::flash(lang_admin('field').lang_admin('delete').lang_admin('success'));
            front::redirect(url::modify('act/list',true));
        }
    }

    function batch_action(){
        if (front::post('batch') == 'listorder') {
            $fields = front::post('listorder');
            if (is_array($fields))
                foreach ($fields as $id => $field) {
                    $id=setting::$var[$this->table][$id]['id'];
                    if ($id){
                        unset(setting::$var[$this->table][$id]);
                        field::getInstance()->rec_update(array("listorder"=>intval($field)),array('id'=>$id));
                    }
                }
            front::flash(lang_admin('sort').lang_admin('success'));
        }else
            if (front::post('batch') == 'delete') {
            if(is_array(front::$post['select']) && !empty(front::$post['select'])){
                foreach(front::$post['select'] as $v){
                    if(!preg_match('/^my_.+/',$v)) {
                        front::flash(lang_admin('field_name').lang_admin('incorrectness'));
                    }
                    $delete=$this->_table->query("ALTER TABLE `{$this->_table->name}` DROP `".$v."`");
                    if(!$delete) {
                        front::flash(lang_admin('field').lang_admin('delete').lang_admin('failure'));
                    }else {
                        $id=setting::$var[$this->table][$v]['id'];
                        if ($id){
                            unset(setting::$var[$this->table][$v]);
                            field::getInstance()->rec_delete(array('id'=>$id));
                        }
                    }
                }
                front::flash(lang_admin('field').lang_admin('delete').lang_admin('success'));
            }
        }
        front::redirect(url::modify('act/list',true));
    }

    private function check_myfield() {
        if(!preg_match('/^my_.+/',front::post('name'))) {
            front::flash(lang_admin('field_name_format_must_be').'my_abc！');
            return false;
        }
        return true;
    }

    //自定义字段栏目下拉框
    function getfieldcatid_action()
    {
        $selectarray = array();
        $langdata = lang::getlang();
        if (is_array($langdata)) {
            foreach ($langdata as $key => $value) {
                $option= array(0 => '请选择...');
                if ($_GET['isshopcatid']) {
                    $catdata = category::optionshopping('0', 'all', $option, $level, $value['langurlname']);
                } else {
                    $catdata = category::optionall(0, 'all', $option, $level, $value['langurlname']);
                }
                $select = "";
                foreach ($catdata as $k => $d) {
                    $select .= "<option value=\"$k\" >$d</option>";
                }
                $selectarray[$value['langurlname']]=$select;
            }
        }
        echo json_encode($selectarray);
        exit;

    }

    function end() {
        $this->render();
    }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.
