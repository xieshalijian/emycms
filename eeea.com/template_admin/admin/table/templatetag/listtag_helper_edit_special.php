<?php

$data['tagfrom']=isset($data['tagfrom'])?$data['tagfrom']:"";
if($data['tagfrom']=='shopspecial' || get('tagfrom')=='shopspecial') {
    $tplarray=include(ROOT.'/template/'.config::getadmin('template_shopping_dir').'/tpltag/tag.config.php');
    $tplarray=$tplarray['shopspecial'];
}else{
    $tplarray=include(ROOT.'/template/'.config::getadmin('template_dir').'/tpltag/tag.config.php');
    $tplarray=$tplarray['special'];
}


$tag_config=isset($data['setting'])?$data['setting']:array();
$spname_checked = $subtitle_checked = $spimage_checked = $spcontent_checked = '';
if(isset($tag_config['spname']) && $tag_config['spname']) $spname_checked = 'checked';
if(isset($tag_config['subtitle']) && $tag_config['subtitle']) $subtitle_checked = 'checked';
if(isset($tag_config['spimage']) && $tag_config['spimage']) $spimage_checked = 'checked';
if(isset($tag_config['spcontent']) && $tag_config['spcontent']) $spcontent_checked = 'checked';

$tag_config['spid']=isset($tag_config['spid'])?$tag_config['spid']:"";
$tag_config['len']=isset($tag_config['len'])?$tag_config['len']:"";
$tag_config['tagtemplate']=isset($tag_config['tagtemplate'])?$tag_config['tagtemplate']:"";
?>


<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
        {lang_admin('special')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <?php echo form::select('spid', $tag_config['spid'],special::option(lang_admin('all_special')));?>
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('default')}{lang_admin('all_special')}!"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
       {lang_admin('name')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <input type="checkbox" value="1" name="spname" class="radio" id="spname" <?php echo $spname_checked;?> />
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_to_call_the_topic_name_silently')}"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
        {lang_admin('special_subtitle')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <input type="checkbox" value="1" name="subtitle" class="radio" id="subtitle" <?php echo $subtitle_checked;?> />
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_to_call_the_subtitle_silently')}!"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
        {lang_admin('special_pictures')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <input type="checkbox" value="1" class="radio" name="spimage" id="spimage" <?php echo $spimage_checked;?> />
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_to_call_special_pictures')}!"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
        {lang_admin('content')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <input type="checkbox" value="1" class="radio" name="spcontent" id="spcontent" <?php echo $spcontent_checked;?> />
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_to_call_the_topic_text_content')}!"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
       {lang_admin('number_of_intercepted_words_in_content')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <?php echo form::input('len', $tag_config['len'], 'class="input_c" oninput="value=value.replace(/[^\d]/g,\'\')"');?>
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('1_no_limit_0_no_call')}"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
        {lang_admin('label_template')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <?php if(is_array($tplarray)){
            echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        }else{
            echo form::select('tagtemplate', $tag_config['tagtemplate'], array('0'=> lang_admin('template_label_not_found')));
        }; ?>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('label_template_files_are_stored_in_the_tpltag_folder_of_the_current_template_directory')}"></span>
        <div style="display:none">
            <?php echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');?>
        </div>
    </div>
</div>
