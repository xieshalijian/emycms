<div class="main-right-box">
    <h5>
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">
            <!--全屏-->
            <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                <i class="icon-frame"></i>
                <?php echo lang_admin('container_fluid');?>
            </a>
            <span class="pull-right">

                        <!--返回列表-->
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('table/list/table/friendlink');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                <!--关闭工具栏-->
                    <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
                </a>
                </span>
        </div>
        {lang_admin('friendship_link_configuration')}
    </h5>

    <div class="box" id="box">


        <form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('type')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <?php $settings['types']=isset($settings['types'])?$settings['types']:""; ?>
                    {form::textarea('types',get('types')?get('types'):$settings['types'],'class="textarea"')}
                </div>
            </div>
            <div class="clearfix blank30"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('for_example')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {lang_admin('type_one')}<br />{lang_admin('type_tow')}
                </div>
            </div>


            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value=" {lang_admin('submitted')} " class="btn btn-primary btn-lg" />
                </div>
            </div>
        </form>
        <div class="blank30"></div>
    </div>
</div>

