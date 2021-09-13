
<div class="main-right-box">
    <h5>{lang_admin('short_message')}<!--工具栏-->
        <div class="content-eidt-nav pull-right">

        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('expansion/index');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div></h5>
    <div class="blank20"></div>
    <div class="box" id="box">


        <ul class="nav nav-tabs" role="tablist">
            <li>
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/mail/table/user',true);?>" data-dataurlname="<?php echo lang_admin('group_sending');?>">
                    <?php echo lang_admin('group_sending');?>
                </a>
            </li>

            <li>
                <a href="#" onclick="gotourl(this)"   data-dataurl="./index.php?case=table&act=send&table=user&type=subscription&admin_dir={get('admin_dir')}&site=default
" data-dataurlname="<?php echo lang_admin('subscribe_to_group_distribution');?>">
                    <?php echo lang_admin('subscribe_to_group_distribution');?>
                </a>
            </li>
            <li class="active">
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/sendsms/table/user',true);?>" data-dataurlname="<?php echo lang_admin('short_message');?>">
                    <?php echo lang_admin('short_message');?>
                </a>
            </li>
            <li >
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/notification/table/user',true);?>" data-dataurlname="<?php echo lang_admin('short_message');?>">
                    <?php echo lang_admin('notice');?>
                </a>
            </li>
        </ul>
        <div class="clearfix blank30"></div>
        <form method="post" name="mail_form1" action=""  onsubmit="return returnform(this);">
            <input type="hidden" name="onlymodify" value=""/>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('phone_number')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <textarea name="mail_address" id="mail_address" class="form-control textarea"><?php if(isset(front::$get['st']) && front::$get['st']) {?>{table_user::sms_before()}<?php }?></textarea>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('examples_of_sending_formats')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('content')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <textarea name="content" id="sendmail" class="form-control textarea"></textarea>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title=""></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>


            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                </div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <input  name="submit" value="1" type="hidden">
            <input type="submit"  value="{lang_admin('send_out')}" class="btn btn-primary btn-lg" />
                </div>
            </div>
        </form>
        <div class="blank30"></div>
    </div>
</div>
