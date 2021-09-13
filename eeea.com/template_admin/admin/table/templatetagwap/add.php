<div class="main-right-box">

<div class="box" id="box">


<form method="post" name="form1" action="<?php if (front::$act == 'edit')
    $id="/id/".$data[$primary_key]; else
    $id='';
echo modify("/act/".front::$act."/table/".$table.$id); ?>"  onsubmit="return thisreturnform(this);">
<input type="hidden" name="onlymodify" value=""/>


    <h5>
        {lang_admin('adding_mobile_phone_template_label')}
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">
            <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                <i class="icon-frame"></i>
                {lang_admin('container_fluid')}
            </a>
            <span class="pull-right">


                    <input  name="submit" value="1" type="hidden">

                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>



                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=templatetagwap&tagfrom=content&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div>

    </h5>



    <div id="content-eidt-nav"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('name')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('name',$form,$field,$data)}
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('label_names_should_not_begin_with_pure_numbers_or_numbers')}"></span>
</div>
</div>
    <div class="clearfix blank20"></div>
<!--template 'table/templatetag/listtag_helper.php-->

<input type="hidden" name="tagfrom" value="{get('tagfrom')}" class="form-control" />

{if get('tagfrom')=='category'}

{template_admin 'table/templatetagwap/listtag_helper_edit_cat.php'}


{elseif get('tagfrom')=='content'}

{template_admin 'table/templatetagwap/listtag_helper_edit.php'}

{else}

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('content')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('tagcontent',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank20"></div>
{/if}


<div class="blank30"></div>

</form>
<div class="blank30"></div>
</div>
</div>

<script>
    function thisreturnform(obj) {
        if ($("#tagtemplate").val()==""){
            alert("{lang_admin('please_choose')}{lang_admin('template_tags')}");
            return false;
        }
        returnform(obj);
        return false;
    }
</script>