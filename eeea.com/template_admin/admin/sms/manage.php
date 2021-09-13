<style type="text/css">
    #sms_manage .record-tab {display:none;}
</style>




<!-- 基本信息 -->

<div style="padding:0px 20px;">
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <span class="glyphicon glyphicon-warning-sign"></span>	{lang_admin('tips')}</span>
        {lang_admin('prior_to_recharging')}&nbsp;&nbsp;<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn btn-success">{lang_admin('registered_user')}</a>&nbsp;&nbsp;{lang_admin('change_the_account_and_password_in_the_sms_settings_to_the_registered_user_and_password')}{lang_admin('at')}&nbsp;&nbsp;<a href="#tag2" class="btn btn-view">{lang_admin('short_message_manage')}</a>&nbsp;&nbsp;{lang_admin('after_recharging_sms_it_can_be_used_properly')}
    </div>

    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <span class="glyphicon glyphicon-warning-sign"></span>	{lang_admin('tips')}</span>
        {lang_admin('has_been_sent')}&nbsp;<font color="#009900"><strong>{$info[1]}</strong></font>&nbsp;,{lang_admin('surplus')}&nbsp;<font color="#CC0000"><strong>{$info[0]}</strong></font>
        <?php  if(!$status){echo '<span style="color: #ff0000; font-weight: bolder;">' . lang_admin('check_the_interface_settings_such_as_username_password_and_whether_the_server_can_access_pay_cmseasy_cn') . '</span>';};?>
    </div>


    <span style="float:right">
<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn btn-success">{lang_admin('register')}</a>
<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-primary">{lang_admin('set_up')}</a>
<a target="_blank" href="http://pay.cmseasy.cn/list.php?username=<?php echo config::getadmin('sms_username');?>&password=<?php echo md5(config::getadmin('sms_password'));?>" class="btn btn-info">{lang_admin('detailed')}</a>
<a target="_blank" href="http://pay.cmseasy.cn/plist.php?username=<?php echo config::getadmin('sms_username');?>&password=<?php echo md5(config::getadmin('sms_password'));?>" class="btn btn-danger">{lang_admin('recharge_record')}</a>
<a href="http://pay.cmseasy.cn/rule.php" target="_blank" class="btn btn-secondary">{lang_admin('view_the_license_agreement')}</a>
</span>
</div>



<form id="frmPay" name="frmPay" method="post" action="http://pay.cmseasy.cn/pay.php" target="_blank">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('recharge')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <div class="row">
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <select name="num" id="num" class="form-control select">
                        <option value="10">{lang_admin('number_of_short_messages_10')}</option>
                        <option value="100" selected>{lang_admin('number_of_short_messages_100')}</option>
                        <option value="200">{lang_admin('number_of_short_messages_200')}</option>
                        <option value="300">{lang_admin('number_of_short_messages_300')}</option>
                        <option value="500">{lang_admin('number_of_short_messages_500')}</option>
                        <option value="1000">{lang_admin('number_of_short_messages_1000')}</option>
                        <option value="5000">{lang_admin('number_of_short_messages_5000')}</option>
                    </select>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left">
                    <input type="submit" value="{lang_admin('recharge')}" class="btn btn-danger" />
                    <input name="sms_username" type="hidden" value="<?php echo config::getadmin('sms_username');?>">
                </div>

            </div>
        </div>
    </div>
    <div class="clearfix blank20"></div>
</form>


<form method="post" action="{url('sms/manage')}">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('test')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <div class="row">
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input type="text" placeholder="{lang_admin('please_fill_in_your_cell_phone_number')}" name="mobile" id="mobile" class="form-control" />
                </div>
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left">
                    <input type="submit" name="submit" id="submit" value="{lang_admin('send_out')}" class="btn btn-view" />
                    <input name="act" type="hidden" value="test">
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix blank20"></div>

</form>

<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('tips')}</div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        {lang_admin('sms_tips_a')}<br />
        {lang_admin('sms_tips_b')}<br />
        {lang_admin('sms_tips_c')}<br />
    </div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('tips')}</div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        {lang_admin('sms_explain_a')}</br>
        {lang_admin('sms_explain_b')}</br>
        {lang_admin('sms_explain_c')}</br>
        {lang_admin('sms_explain_d')}</br>
        {lang_admin('sms_explain_e')}
    </div>
</div>
<div class="clearfix blank20"></div>



<div style="display:none;">
    {getCopyRight()}
</div>