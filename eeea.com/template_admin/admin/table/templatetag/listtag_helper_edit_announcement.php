<?php

$tplarray = include(ROOT . '/template/' . config::get('template_dir') . '/tpltag/tag.config.php');
$tplarray = $tplarray['announcement'];

$tag_config=isset($data['setting'])?$data['setting']:array();
$tyname_checked = $subtitle_checked = $tyimage_checked = $tycontent_checked = '';
if(isset($tag_config['tyname']) && $tag_config['tyname']) $tyname_checked = 'checked';
if(isset($tag_config['subtitle']) && $tag_config['subtitle']) $subtitle_checked = 'checked';
if(isset($tag_config['tyimage']) && $tag_config['tyimage']) $tyimage_checked = 'checked';
if(isset($tag_config['tycontent']) && $tag_config['tycontent']) $tycontent_checked = 'checked';


$tag_config['typeid']=isset($tag_config['typeid'])?$tag_config['typeid']:"";
$tag_config['len']=isset($tag_config['len'])?$tag_config['len']:"";
$tag_config['tagtemplate']=isset($tag_config['tagtemplate'])?$tag_config['tagtemplate']:"";
?>

<?php
//提取分类
if(file_exists(ROOT."/lib/table/type.php")) {
?>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
		{lang_admin('type')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <?php echo form::select('typeid', $tag_config['typeid'],type::option(0,lang_admin('all_type')));?>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('default_all_type')}"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<?php };?>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
       {lang_admin('name')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <input type="checkbox" value="1" name="tyname" class="radio" id="tyname" <?php echo $tyname_checked;?> style="vertical-align: middle;" />
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_to_call_the_classification_name_silently')}"></span>
    </div>
</div>

<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
		{lang_admin('type_picture')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <input type="checkbox" value="1" class="radio" name="tyimage" id="tyimage" <?php echo $tyimage_checked;?> />
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_to_call_the_type_picture')}"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
		{lang_admin('content')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <label class="checkbox-inline">
        <input type="checkbox" value="1" class="radio" name="tycontent" id="tycontent" <?php echo $tycontent_checked;?> />
        </label>
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_to_call_the_categorized_text_content')}"></span>
    </div>
</div>
<div class="clearfix blank20"></div>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
		{lang_admin('number_of_intercepted_words_in_content')}
    </div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        <?php echo form::input('len', $tag_config['len'], 'class="input_c" oninput="value=value.replace(/[^\d]/g,\'\')"');?>
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
