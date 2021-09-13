
<style type="text/css">
    @media(max-width:468px) {
        input#title {width:100%;}
        .edit-category .text-left {margin:0px; padding:0px 5px;}
    }
    span.hotspot {float:right; padding-left:10px;}
</style>

<div class="main-right-box">




        <form method="post" name="form1" action="<?php echo uri();?>"  onsubmit="if(checkform()){return returnform(this);}else{return false;}" >
            <input type="hidden" name="onlymodify" value=""/>
            <h5>
                {lang_admin('editorial_language')}
                <!--工具栏-->
                <div class="content-eidt-nav pull-right">
                    <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                        <i class="icon-frame"></i>
                        <?php echo lang_admin('container_fluid');?>
                    </a>
                    <span class="pull-right">

 <input  name="submit" value="1" type="hidden">

                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>


                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=language&act=list&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('language_list');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>

                    <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
                </a>
                </span>
                </div>
            </h5>
            <div class="line"></div>
            <div class="blank20"></div>
            <div class="box edit-category" id="box">
            <script type="text/javascript" src="{$base_url}/common/js/upimg/dialog.js"></script>
            <link href="{$skin_admin_path}/css/dialog.css" rel="stylesheet" type="text/css" />


            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('language_name')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">{form::getform('langname',$form,$field,$data)}<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('if_its_a_first_level_column_you_dont_need_to_choose_it')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><span class="icon-note"></span>{lang_admin('language_file_name')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('langurlname',$form,$field,$data,'class="form-control"')}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('please_fill_in_the_language_file_name')}""></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('language_icons')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::upload_image('langimg',$data['langimg'])}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('language_icon')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            {if !$data['isdefault']}
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('state')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('static',$form,$field,$data,'class="form-control"')}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('language_pack_status')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            {/if}
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('default')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('isdefault',$form,$field,$data,'class="form-control"')}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('language_pack_status')}"></span>
                </div>
            </div>

            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('后台语言')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <select id="adminlangid" name="adminlangid" class="form-control select pull-left" style="display:inline-block;width:auto;margin-right:5px;">
                        <option value="0" {if $data['adminlangid']==0}selected{/if}>{lang_admin('please_select_language')}</option>
                        {loop getlang() $i $d}
                        <option value="{$d['id']}" {if $data['adminlangid']==$d['id']}selected{/if}>{$d['langname']}</a></option>
                        {/loop}
                    </select>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('language_pack_status')}"></span>
                </div>
            </div>


            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('binding_domain_names')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('domain',$form,$field,$data,'class="form-control"')}
                    <script language="JavaScript">
                       <!--
                            $(function(){
                                var inp = $('#domain');
                                inp.focus(function(){
                                    $(this).attr('placeholder','{lang_admin("Input_format")}')
                                })
                            })
//-->
                    </script>

                    <p class="tips-p">{lang_admin('after_binding_domain_name_automatic_identification_switch_to_binding_language')}</p>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('bind_domain_names')}"></span>
                </div>
            </div>
            {if $data['isdefault']}
               <script>
                   $("#domain").val("");
                   $("#domain").attr("disabled","disabled");
                </script>
            {/if}
            <div class="clearfix blank20"></div>
            <div class="line"></div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit" value=" {lang_admin('submitted')} "  class="btn btn-primary btn-lg" />
                </div>
            </div>

            </div>
        </form>
        <div class="blank30"></div>

</div>


<!-- 上传框 -->
<script src="{$base_url}/common/plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script>
<script src="{$base_url}/common/plugins/fileinput/js/locales/zh.js" type="text/javascript"></script>
<link href="{$base_url}/common/plugins/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">
<!--新增tab名称校验-->
<script type="text/javascript">
    function checkform() {
        if ($("#langurlname").val() == "") {
            alert("<?php echo lang_admin('language_file_name') . lang_admin('on_null');?>");
            $("#langurlname").focus();
            return false;
        }
        if ($("#adminlangid").val() == "0") {
            alert("<?php echo lang_admin('background_language_pack') . lang_admin('on_null');?>");
            $("#adminlangid").focus();
            return false;
        }
        return  true;
    }
</script>