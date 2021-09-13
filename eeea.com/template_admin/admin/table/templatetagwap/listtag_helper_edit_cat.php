<?php
$data['tagfrom']=isset($data['tagfrom'])?$data['tagfrom']:"";
    $tplarray=include(ROOT.'/template/'.config::getadmin('template_mobile_dir').'/tpltag/tag.config.php');
    $tplarray=$tplarray['category'];

$tag_config=isset($data['setting'])?$data['setting']:array();
$tag_config['catid']=isset($tag_config['catid'])?$tag_config['catid']:"";
$tag_config['tagtemplate']=isset($tag_config['tagtemplate'])?$tag_config['tagtemplate']:"";
$tag_config['titlenum']=isset($tag_config['titlenum'])?$tag_config['titlenum']:"";
$tag_config['textnum']=isset($tag_config['textnum'])?$tag_config['textnum']:"";
?>


        <?php
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        if($data['tagfrom']=='shopcategory' || get('tagfrom')=='shopcategory'){
            echo lang_admin('commodity').lang_admin('column').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('catid', $tag_config['catid'], category::optionshopping());
        }else{
            echo lang_admin('column').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('catid', $tag_config['catid'], category::optionconnent());
        }
		echo '<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="'.lang_admin('default').lang_admin('all_columns').'!"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';

        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo lang_admin('number_of_headings').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo '<input type="text" name="titlenum" id="titlenum" value="'.$tag_config['titlenum'].'" class="form-control" oninput="value=value.replace(/[^\d]/g,\'\')"><span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="" title="'.lang_admin('cover_title_text_restriction_can_only_be_numeric').'"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';
		 echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo lang_admin('number_of_column_words').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo '<input type="text" name="textnum" id="textnum" value="'.$tag_config['textnum'].'" class="form-control" oninput="value=value.replace(/[^\d]/g,\'\')"><span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="" title="'.lang_admin('cover_content_text_restriction_can_only_be_digital').'"></span>';
		 echo '</div></div><div class="clearfix blank20"></div>';

		echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo lang_admin('label_template').'</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="'.lang_admin('label_template_files_are_stored_in_the_tpltag_folder_of_the_current_template_directory').'"></span><div style="display:none">';
        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
        echo '</div></div></div>';
        echo '';
        ?>
