<style type="text/css">
.main .main-right-box {
position: absolute;
top:130px;
right:30px;
left:30px;
bottom:30px;
}
</style>

<div class="main-right-box">
<h5>{lang_admin('importing_php_web_data')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

    <ul class="nav nav-tabs" role="tablist">
        <li><a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=database&act=baker&admin_dir={get('admin_dir',true)}&site=default">{lang_admin('manage_data')}</a></li>
        <li><a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=adminlogs&act=manage&admin_dir={get('admin_dir',true)}&site=default">{lang_admin('log_manage')}</a></li>
        <li class="active"><a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=database&act=str_replace&admin_dir={get('admin_dir',true)}&site=default">{lang_admin('replace_strings')}</a></li>
        <!-- <li><a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=database&act=phpwebinsert&admin_dir={get('admin_dir',true)}&site=default">导入PHPweb数据</a></li> -->
        <li><a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=database&act=wordpress&admin_dir={get('admin_dir')}&site=default">{lang_admin('import_wordpress_data')}</a></li>
        <li><a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=database&act=inputdede&admin_dir={get('admin_dir')}&site=default">{lang_admin('import_dede_data')}</a></li>
    </ul>
<div class="blank30"></div>
<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload/ThumbAjaxFileUpload.js"></script>



<form name="form" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
{lang_admin('database_table_prefix')}
</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input('phpweb_prefix')}
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('phpweb_table_prefix_without_underlining')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
{lang_admin('database_files')}
</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::upload_file('data','data')}
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('support_only_txt_and_sql_file_formats')}"></span>
</div>
</div>



<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input  name="submit" value="1" type="hidden">
{form::submit(lang_admin('start_importing'))}

</form>
<div class="blank30"></div>
</div>
</div>
