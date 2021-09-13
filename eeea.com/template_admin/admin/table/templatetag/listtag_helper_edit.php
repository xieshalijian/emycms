<?php
/*
  $id = get('id');
  $path=ROOT.'/config/tag/content_'.$id.'.php';
  $tag_config = array();
  $tag_config_content = @file_get_contents($path);
  if($tag_config_content){
  $tag_config = unserialize($tag_config_content);
  if(isset($tag_config['thumb'])){
  $checked = 'checked';
  }else{
  $checked = '';
  }
  }else{
  $tag_config['length'] = 20;
  $tag_config['limit'] = 10;
  $tag_config['thumb'] = 0;
  }
 */
$data['tagfrom']=isset($data['tagfrom'])?$data['tagfrom']:"";
if( $data['tagfrom']=='shopcontent' || get('tagfrom')=='shopcontent') {
    $tplarray = include(ROOT . '/template/' . config::getadmin('template_shopping_dir') . '/tpltag/tag.config.php');
    $tplarray=$tplarray['shopcontent'];
}else{
    $tplarray = include(ROOT . '/template/' . config::getadmin('template_dir') . '/tpltag/tag.config.php');
    $tplarray=$tplarray['content'];
}

$tag_config=isset($data['setting'])?$data['setting']:array();
?>
        <?php
        $tag_config['catid']=isset($tag_config['catid'])?$tag_config['catid']:"";
        $tag_config['son']=isset($tag_config['son'])?$tag_config['son']:"";
        $tag_config['typeid']=isset($tag_config['typeid'])?$tag_config['typeid']:"";
        $tag_config['spid']=isset($tag_config['spid'])?$tag_config['spid']:"";
        $tag_config['length']=isset($tag_config['length'])?$tag_config['length']:"";
        $tag_config['introduce_length']=isset($tag_config['introduce_length'])?$tag_config['introduce_length']:"";
        $tag_config['istop']=isset($tag_config['istop'])?$tag_config['istop']:"";
        $tag_config['limit']=isset($tag_config['limit'])?$tag_config['limit']:"";
        $tag_config['thumb']=isset($tag_config['thumb'])?$tag_config['thumb']:"";
        $tag_config['attr1']=isset($tag_config['attr1'])?$tag_config['attr1']:"";
        $tag_config['tagtemplate']=isset($tag_config['tagtemplate'])?$tag_config['tagtemplate']:"";
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        if($data['tagfrom']=='shopcontent' || get('tagfrom')=='shopcontent'){
            echo lang_admin('commodity').lang_admin('column').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('catid', $tag_config['catid'], category::optionshopping());
        }else{
            echo lang_admin('column').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('catid', $tag_config['catid'], category::optionconnent());
        }

        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('subcolumn').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('son', $tag_config['son'], array(lang_admin('no'),lang_admin('yes')));
		echo '</div></div><div class="clearfix blank20"></div>';
        //提取分类
        if(file_exists(ROOT."/lib/table/type.php")) {
            echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
            echo lang_admin('type') . '</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">' . form::select('typeid', $tag_config['typeid'], type::option());
            echo '</div></div><div class="clearfix blank20"></div>';
        }
        //专题扩展 安装的情况
        if(file_exists(ROOT."/lib/table/special.php")) {
            echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
            echo lang_admin('special') . '</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">' . form::select('spid', $tag_config['spid'], special::option());
            echo '</div></div><div class="clearfix blank20"></div>';
        }
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('number_of_caption_intercepted_words').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::input('length', $tag_config['length'], 'class="input_c" oninput="value=value.replace(/[^\d]/g,\'\')"');
		echo '</div></div><div class="clearfix blank20"></div>';
		echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('introduction_of_intercepted_words').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::input('introduce_length', $tag_config['introduce_length'], 'class="input_c" oninput="value=value.replace(/[^\d]/g,\'\')"').'<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="'.lang_admin('1_no_limit_0_no_call').'"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('sort').lang_admin('mode').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
		if(!isset($tag_config['ordertype']) || $tag_config['ordertype']==''){$tag_config['ordertype']='adddate-desc';};
        echo form::select('ordertype', $tag_config['ordertype'],
                array(
			'updatedate-asc'=>lang_admin('modification_time_positive_order'),
            'updatedate-desc'=>lang_admin('modification_time_reverse_order'),
            'adddate-asc'=>lang_admin('add_time_positive_order'),
            'adddate-desc'=>lang_admin('add_time_reverse_order_'),
            'view-asc'=>lang_admin('browsing_volume_positive_order'),
	        'view-desc'=>lang_admin('browse_volume_reverse_order'),
            'aid-asc'=>lang_admin('by_serial_number_positive_order'),
            'aid-desc'=>lang_admin('number_in_reverse_order'),
            'id-asc'=>lang_admin('by_id_positive_order'),
            'id-desc'=>lang_admin('by_id_in_reverse_order'),
            'rand()'=>lang_admin('random'),
        ));
       echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('call_top_content').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::select('istop', $tag_config['istop'],
                array(
			'1'=>lang_admin('yes'),
            '0'=>lang_admin('no'),
        ));
       echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('number_of_call_records').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::input('limit', $tag_config['limit'], 'class="input_c" oninput="value=value.replace(/[^\d]/g,\'\')"');
       echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('thumbnail').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        $checked="";
		if($tag_config['thumb'] == 'on'){$checked = 'checked';$thumbval="on";}else{$thumbval="off";};
        echo '<input type="checkbox"  id="thumbcheckbox"  '.$checked.'/>';
        echo '<input type="hidden" name="thumb" id="thumb"  value="'.$thumbval.'" />';
        echo '<script>
                $("#thumbcheckbox").click(function(){
                if ($(this).is(":checked")) {
                    $("[name=thumb]").val("on");
                } else {
                   $("[name=thumb]").val("off");
                }
                });
        </script>';
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('recommendation_bit').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
		$set=settings::getInstance();
        $sets=$set->getrow(array('tag'=>'table-archive'));
        $ds=isset($sets['value'])?unserialize($sets['value']):array("attr1"=>"");
		preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%s',$ds['attr1'],$result,PREG_SET_ORDER);
        $sdata=array();
        foreach ($result as $res) $sdata[$res[1]]=$res[2];
        echo form::select('attr1', $tag_config['attr1'], $sdata);
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo lang_admin('label_template').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="'.lang_admin('label_template_files_are_stored_in_the_tpltag_folder_of_the_current_template_directory').'"></span><div style="display:none">';

        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
		echo '</div></div></div>';
        
        ?>
