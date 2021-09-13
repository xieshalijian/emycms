<div class="main-right-box">

    <div class="box" id="box">

        <script language="javascript" src="{$base_url}/common/js/common.js"></script>

        <form method="post" name="form1" action="<?php
        if (front::$act == 'edit')
            $id="/id/".$data[$primary_key]."/tagfrom/".$_GET['tagfrom']; else
            $id=''; echo modify("/act/".front::$act."/table/".$table.$id);
        ?>"  onsubmit="return thisreturnform(this);">
            <input type="hidden" name="onlymodify" value=""/>


            <h5>
                {lang_admin('modify_template_tags')}
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


                    {if get('tagfrom')=='category'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=category&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>
        {elseif get('tagfrom')=='shopcategory'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shopcategory&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>
        {elseif get('tagfrom')=='content'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=content&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>
        {elseif get('tagfrom')=='shopcontent'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shopcontent&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>
        {elseif get('tagfrom')=='type'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=type&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>
        {elseif get('tagfrom')=='shoptype'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shoptype&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>
        {elseif get('tagfrom')=='special'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=special&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>
        {elseif get('tagfrom')=='shopspecial'}
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shopspecial&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-default" data-dataurlname="<?php echo lang_admin('template_label_list');?>">
                        <i class="icon-action-redo"></i>
                    </a>

        {/if}
                </span>
                </div>
            </h5>

            <div id="content-eidt-nav"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('remarks')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <?php $data['setting']['remarksname']=isset($data['setting']['remarksname'])?$data['setting']['remarksname']:$data['name'];?>
                    {form::getform('remarksname',$form,$field,$data['setting'])}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('label_names_should_not_begin_with_pure_numbers_or_numbers')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <input type="hidden" name="tagfrom" value="{get('tagfrom')}" class="form-control" />

            {if get('tagfrom')=='category' || get('tagfrom')=='shopcategory'}
            {template_admin 'table/templatetag/listtag_helper_edit_cat.php'}
            {elseif get('tagfrom')=='special' || get('tagfrom')=='shopspecial'}
            {template_admin 'table/templatetag/listtag_helper_edit_special.php'}
            {elseif get('tagfrom')=='type' || get('tagfrom')=='shoptype'}
            {template_admin 'table/templatetag/listtag_helper_edit_type.php'}
            {elseif get('tagfrom')=='announcement'}
            {template_admin 'table/templatetag/listtag_helper_edit_announcement.php'}
            {elseif get('tagfrom')=='content'|| get('tagfrom')=='shopcontent'}
            {template_admin 'table/templatetag/listtag_helper_edit.php'}

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
            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"  value="{lang_admin('submitted')}" class="btn btn-primary btn-lg" />
                </div>
            </div>
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
