<style type="text/css">
    .main-right-box {min-height:auto;}
    #frm1 .main-right-box .form-control {border-radius: 0px;}
    .textarea-wrap {min-height:188px;}
</style>
<script id="autolinenumber" src="{$base_url}/common/plugins/auto-line-number/auto-line-number.js"></script>




<form name="frm1" id="frm1" action="{url('thirdparty/save')}" method="post" onsubmit="return returnform(this);">
    <div class="main-right-box">


        <div class="box" id="box">
            <h5>                   <?php echo lang_admin('third_party_code');?>                           <!--工具栏-->
                <div class="content-eidt-nav pull-right">
                    <!--全屏-->
                    <a id="fullscreen-btn" class="btn btn-default" style="display: none;">
                        <i class="icon-frame"></i>
                        全屏                    </a>
                    <span class="pull-right">
                            <!--保存-->
                                                <input name="submit" value="1" type="hidden">
                                                    <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> 保存                        </button>
                        <!--返回列表-->
                           <a href="#" onclick="gotohome()" data-dataurlname="首页" class="btn btn-default">
                                 <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        <!--关闭工具栏-->
                            <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                                <i class="icon-close"></i>
                            </a>
                        </span>
                </div>
            </h5>

            <ul class="nav nav-tabs" role="tablist">
                <li>
                    <a data-dataurlname="<?php echo lang_admin('essential_information');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/site');?>" name="<?php echo lang_admin('essential_information');?>">
                        <?php echo lang_admin('essential_information');?>
                    </a>
                </li>
                <li>
                    <a data-dataurlname="<?php echo lang_admin('mail_serve');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/mail');?>" name="<?php echo lang_admin('mail_serve');?>">
                        <?php echo lang_admin('mail_serve');?>
                    </a>
                </li>
                <li class="active">
                    <a data-dataurlname="<?php echo lang_admin('third_party_code');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('thirdparty/index');?>" name="<?php echo lang_admin('third_party_code');?>">
                        <?php echo lang_admin('third_party_code');?>
                    </a>
                </li>
                <li>
                    <a data-dataurlname="<?php echo lang_admin('map_settings');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/ditu');?>" name="<?php echo lang_admin('map_settings');?>">
                        <?php echo lang_admin('map_settings');?>
                    </a>
                </li>
            </ul>
            <div class="blank20"></div>
            <h6>{lang_admin('header_code')}</h6>
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-right:29px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-warning-sign"></span>	 {lang_admin('third_party_code_a')}<br>header.html  &lt;body&gt; {lang_admin('front_join')}  &#123;template_public 'common/plugins/public/header-js.html'&#125;；
            </div>
            <div class="form-group">
                <textarea class="form-control" style="min-height: 188px;" id="header" name="header" >{loop $header $head} {$head}{/loop}</textarea>
            </div>

    <div class="blank20"></div>

        <h6>{lang_admin('bottom_code')}</h6>


            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-right:29px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-warning-sign"></span>	 {lang_admin('third_party_code_a')}<br>footer.html &lt;/body&gt;{lang_admin('front_join')} &#123;template_public 'common/plugins/public/foot-js.html'&#125;
            </div>
            <div class="form-group">
                <textarea class="form-control" style="min-height: 188px;" id="foot" name="foot">{loop $foot $fot} {$fot}{/loop}</textarea>
            </div>

            <div class="blank20"></div>
            <div class="line"></div>
            <div class="blank20"></div>

                    <div class="form-group">
                        <input  name="dosubmit" value="1" type="hidden">
                        <input class="btn btn-primary btn-lg" type="submit" value="{lang_admin('preservation')}">

            </div>
        </div>
    </div>

</form>
<script type="text/javascript">
    $("#frm1 .main-right-box .form-control").setTextareaCount({
        width: "30px",
        bgColor: "#eee",
        color: "#333",
        display: "inline-block"
    });
</script>