<div class="main-right-box">

<form name="form" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">

    <h5>{lang_admin('import_dede_data')}<!--工具栏-->
        <div class="content-eidt-nav pull-right">

        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('expansion/index');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div></h5>

    <div class="box" id="box">
        <ul class="nav nav-tabs" role="tablist">
            <li>
                <a data-dataurlname="<?php echo lang_admin('batch_import');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('table/import/table/archive');?>" name="<?php echo lang_admin('batch_import');?>">
                    <?php echo lang_admin('batch_import');?>
                </a>
            </li>
            <li>
                <a data-dataurlname="<?php echo lang_admin('import_wordpress_data');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('database/wordpress');?>" name="<?php echo lang_admin('import_wordpress_data');?>">
                    <?php echo lang_admin('import_wordpress_data');?>
                </a>
            </li>
            <li class="active">
                <a data-dataurlname="<?php echo lang_admin('import_dede_data');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('database/inputdede');?>" name="<?php echo lang_admin('import_dede_data');?>">
                    <?php echo lang_admin('import_dede_data');?>
                </a>
            </li>

        </ul>
        <div class="blank30"></div>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
数据库表前缀
</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input('phpweb_prefix')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="PHPWEB表前缀，不需包含下划线 _！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
数据库文件
</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left" >
{form::upload_file('data','data')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="只支持.txt和.sql文件格式！"></span>
</div>
</div>



<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
            </div>
            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left" >
<input  name="submit" value="1" type="hidden">
{form::submit('开始导入')}
            </div>
        </div>
</form>

    </div>
