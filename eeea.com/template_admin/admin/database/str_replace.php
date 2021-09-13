

<div class="main-right-box">

    <h5>
        {lang_admin('replace_database_characters')}
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">
            <span class="pull-right">
 <!--保存-->

                                              <input type="hidden" name="batch" id="batch" value="" class="form-control">
            <input value="1" name="submit" type="hidden">
                                                    <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> {lang_admin('preservation')}                        </button>
                <!--关闭工具栏-->
                    <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
                </a>
                </span>
        </div>
    </h5>



<div class="box" id="box">

<ul class="nav nav-tabs" role="tablist">
    <li>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('config/system/set/security')}" data-dataurlname="{lang_admin('website_security')}">
            {lang_admin('website_security')}
        </a>
    </li>
    <li>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('adminlogs/manage')}" data-dataurlname="{lang_admin('log_manage')}">
            {lang_admin('log_manage')}
        </a>
    </li>
    <li class="active">
        <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('database/str_replace')}" data-dataurlname="{lang_admin('replace_strings')}">
            {lang_admin('replace_strings')}
        </a>
    </li>
</ul>

<div class="blank30"></div>

<script type="text/javascript">

    $(document).ready(function() {

        $('#stable').change(function() {
            showfield($('#stable').val());
        });

    });


    function showfield(table) {
        $.ajax({
            url: '<?php echo url('database/dbfield_select',true);?>',
            data:'&stable='+table,
            type: 'POST',
            dataType: 'json',
            timeout: 1000,
            error: function(){

            },
            success: function(data){
                $('#'+data.id).html(data.content);
            }
        });
    }
</script>

    <div class="alert alert-warning alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <span class="glyphicon glyphicon-warning-sign"></span>	{lang_admin('replace_database_characters')}，<strong style="color:red;">
            {lang_admin('please_operate_with_caution')}
        </strong>
    </div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('data_sheet')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::select('stable',0,$tables,'style="font-size:12px"')}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('hold')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('replace1','','cols="50" rows="3"')}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('replace_with')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('replace2','','cols="50" rows="3"')}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('condition')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input('where','','size="60"')}
</div>
</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <input type="hidden" name="batch" id="batch" value="" class="form-control">
            <input value="1" name="submit" type="hidden">
            <input type="submit" value="提交" class="btn btn-primary btn-lg">
        </div>
    </div>
</form>

<div class="blank30"></div>
</div>
</div>
