<script type="text/javascript">
    $(function(){
        $(".usergroup-table input[type='checkbox']").on('click',function (e) {
            var exp = $(this).attr('id');
            var status = $(this).prop('checked');
            if (typeof(exp) !== "undefined"){
                $("."+exp).prop('checked',status).prop('disabled',!status);
            }
            if(exp == 'allcheckbox'){
                $(".usergroup-table input[type='checkbox']").prop('checked',status);
                $("dd input[type='checkbox']").prop('checked',status).prop('disabled',!status);
            }
        });
    });
</script>
<style type="text/css">
    .main-right-box { min-height:auto; }
    .user-rights-list .text-right {line-height: 34px;}
    .user-rights-list dt {clear:both;font-weight:normal; margin-bottom:10px;background: #f5f5f5;
        border-radius: 3px;height: 34px;padding-left:10px;
        line-height: 34px;}
    .user-rights-list dd {margin-bottom:10px;padding:0px 10px;}
</style>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
      onsubmit="return returnform(this);"     >
    <div class="main-right-box">
        <h5>
            {lang_admin('editing_user_groups')}
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



                   <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('table/list/table/usergroup');?>" data-dataurlname="<?php echo lang_admin('user_group');?>" class="btn btn-default">
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

        <div class="box" id="box">

            <div id="content-eidt-nav"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('user_group')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('groupid',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('mold')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('isadministrator',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('integral_requirements')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('integrationclaim',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('name')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('name',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('commodity_discounts')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('discount',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('is_it_an_integer')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('isint',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('is_merchant')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('ismerchant',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('dividends_rate')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('rate',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('front_office_authority')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-rigt">
                    <input type="checkbox" {getfchk($data['fpwlist'],'add_archive')} name="fpwlist[]" value="add_archive" />	{lang_admin('adding_articles')}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                    {lang_admin('lang_background_jurisdiction')}
                </div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-rigt usergroup-table">
                    <input name="all" type="checkbox" id="allcheckbox" value="1" /> {lang_admin('all_election')}
                </div>
            </div>
        </div>
        <div class="clearfix blank20"></div>
    </div>
    <div class="clearfix blank20"></div>
    <!--权限列表-->
    <div class="user-rights-list">
        <!--设置-->
        <div class="main-right-box usergroup-table">
            <h5> <input name="powerlist[config]" type="checkbox" id="config"  value="1" {getchecked($data['powerlist'],'config')} />
                <strong>{lang_admin('set_up')}</strong></h5>
            <div class="box" id="box">
                <dl>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_site]"  {getchecked($data['powerlist'],'system_site')} value="1" />
                        {lang_admin('website')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_extend]"  {getchecked($data['powerlist'],'system_extend')} value="1" />
                        {lang_admin('extend')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" data-animated="false" data-size="mini" type="checkbox" name="powerlist[system_image]"  {getchecked($data['powerlist'],'system_image')} value="1" />{lang_admin('watermarking_settings')}
                    </dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" data-animated="false" data-size="mini" type="checkbox" name="powerlist[system_filechecksite]"  {getchecked($data['powerlist'],'system_filechecksite')} value="1" />{lang_admin('safety_protection_setting')}
                    </dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_upload]"  {getchecked($data['powerlist'],'system_upload')} value="1" />
                        {lang_admin('system_upload')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_security]"  {getchecked($data['powerlist'],'system_security')} value="1" />
                        {lang_admin('character_filtering')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_mail]"  {getchecked($data['powerlist'],'system_mail')} value="1" />
                        {lang_admin('mail_sending')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_vote]"  {getchecked($data['powerlist'],'system_vote')} value="1" />
                        {lang_admin('vote')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_website" type="checkbox" name="powerlist[language]"  {getchecked($data['powerlist'],'language')} value="1" />
                        {lang_admin('language_editor')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_website" type="checkbox" name="powerlist[system_sms]"  {getchecked($data['powerlist'],'system_sms')} value="1" />
                        {lang_admin('short_message')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_website" type="checkbox" name="powerlist[system_ditu]"  {getchecked($data['powerlist'],'system_ditu')} value="1" />
                        {lang_admin('map')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[website]"  {getchecked($data['powerlist'],'website')} value="1" />
                        {lang_admin('site_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_information]"  {getchecked($data['powerlist'],'system_information')} value="1" />
                        {lang_admin('contact_information')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_websitesite]"  {getchecked($data['powerlist'],'system_websitesite')} value="1" />
                        {lang_admin('custom')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_dynamic]"  {getchecked($data['powerlist'],'system_dynamic')} value="1" />
                        {lang_admin('dynamic_and_static')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_customer]"  {getchecked($data['powerlist'],'system_customer')} value="1" />
                        {lang_admin('customer_service_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_verification]"  {getchecked($data['powerlist'],'system_verification')} value="1" />
                        {lang_admin('verification_code')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_sitesetup]"  {getchecked($data['powerlist'],'system_sitesetup')} value="1" />
                        {lang_admin('site')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_membersite]"  {getchecked($data['powerlist'],'system_membersite')} value="1" />
                        {lang_admin('membership_manage')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_discuss]"  {getchecked($data['powerlist'],'system_discuss')} value="1" />
                        {lang_admin('comment_manage')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_formsite]"  {getchecked($data['powerlist'],'system_formsite')} value="1" />
                        {lang_admin('form_manage')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_backupsite]"  {getchecked($data['powerlist'],'system_backupsite')} value="1" />
                        {lang_admin('backup_manage')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_spidersite]"  {getchecked($data['powerlist'],'system_spidersite')} value="1" />
                        {lang_admin('spider_statistics')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_langsite]"  {getchecked($data['powerlist'],'system_langsite')} value="1" />
                        {lang_admin('language_manage')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[security]"  {getchecked($data['powerlist'],'security')} value="1" />
                        {lang_admin('security')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_phonesite]"  {getchecked($data['powerlist'],'system_phonesite')} value="1" />
                        {lang_admin('mobile_version')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[system_guestbook]"  {getchecked($data['powerlist'],'system_guestbook')} value="1" />
                        {lang_admin('message_manage')}
                    </dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[add]"  {getchecked($data['powerlist'],'add')} value="1" />
                        {lang_admin('add')}
                    </dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[manage]"  {getchecked($data['powerlist'],'manage')} value="1" />
                        {lang_admin('manage')}
                    </dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" type="checkbox" name="powerlist[interactive]"  {getchecked($data['powerlist'],'interactive')} value="1" />
                        {lang_admin('interactive')}
                    </dd>
                    <!--<dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_data" type="checkbox" name="powerlist[func_data_phpweb]" {getchecked($data['powerlist'],'func_data_phpweb')} value="1" />
                        {lang_admin('func_data_phpweb')}
                        </dd>-->
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--内容-->
        <div class="main-right-box usergroup-table">
            <h5><input name="powerlist[content]" type="checkbox" id="content"  value="1" {getchecked($data['powerlist'],'content')} />
                <strong>{lang_admin('content')}</strong></h5>
            <div class="box" id="box">
                <dl>
                    <!--栏目管理-->
                    <dt><input class="content" type="checkbox" name="powerlist[category]" {getchecked($data['powerlist'],'category')} value="1" id="content_category">
                        {lang_admin('column_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_category" type="checkbox" name="powerlist[category_list]" {getchecked($data['powerlist'],'category_list')} value="1" />
                        {lang_admin('column_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_category" type="checkbox" name="powerlist[category_add]" {getchecked($data['powerlist'],'category_add')} value="1" />
                        {lang_admin('add_columns')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_category" type="checkbox" name="powerlist[category_edit]" {getchecked($data['powerlist'],'category_edit')} value="1" />
                        {lang_admin('modify_the_column')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_category" type="checkbox" name="powerlist[category_del]" {getchecked($data['powerlist'],'category_del')} value="1" />
                        {lang_admin('delete_columns')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_category" type="checkbox" name="powerlist[category_htmlrule]" {getchecked($data['powerlist'],'category_htmlrule')} value="1" />
                        {lang_admin('column_url_rules')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_category" type="checkbox" name="powerlist[archive_import]" {getchecked($data['powerlist'],'archive_import')} value="1" />
                        {lang_admin('batch_import')}</dd>
                    <?php if(is_array(category::option())){

                        foreach(category::option() as $key=>$val) {
                            if($key==0){
                                continue;
                            }
                            $val= str_ireplace('&nbsp;','',str_ireplace('└','',$val));
                            ?>
                            <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_category" type="checkbox" name="powerlist[{$key}]" {getchecked($data['powerlist'],$key)} value="1" />
                                {$val}</dd>
                            <?php
                        }
                    };?>


                    <!--内容管理-->
                    <dt><input class="content" type="checkbox" name="powerlist[archive]" {getchecked($data['powerlist'],'archive')} value="1" id="content_archive">
                        {lang_admin('content_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_list]" {getchecked($data['powerlist'],'archive_list')} value="1" />
                        {lang_admin('content_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_add]" {getchecked($data['powerlist'],'archive_add')} value="1" />
                        {lang_admin('adding_content')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_content" type="checkbox" name="powerlist[defined_field_category_add]" {getchecked($data['powerlist'],'defined_field_category_add')} value="1" />
                        {lang_admin('adding_category_fields')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_edit]" {getchecked($data['powerlist'],'archive_edit')} value="1" />
                        {lang_admin('modify_content')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_del]" {getchecked($data['powerlist'],'archive_del')} value="1" />
                        {lang_admin('delete_content')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_check]" {getchecked($data['powerlist'],'archive_check')} value="1" />
                        {lang_admin('contents_to_be_audited')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_setting]" {getchecked($data['powerlist'],'archive_setting')} value="1" />
                        {lang_admin('recommendation_bit_settings')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_hotsearch]" {getchecked($data['powerlist'],'archive_hotsearch')} value="1" />
                        {lang_admin('hot_keyword_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_image]" {getchecked($data['powerlist'],'archive_image')} value="1" />
                        {lang_admin('picture_gallery')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_archive" type="checkbox" name="powerlist[archive_tag]" {getchecked($data['powerlist'],'archive_tag')} value="1" />
                        {lang_admin('custom_label_manage')}</dd>
                    <!--分类管理-->
                    <dt><input class="content" type="checkbox" name="powerlist[mtype]" {getchecked($data['powerlist'],'mtype')} value="1" id="content_mtype">
                        {lang_admin('type_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_mtype" type="checkbox" name="powerlist[type_list]" {getchecked($data['powerlist'],'type_list')} value="1" />
                        {lang_admin('type_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_mtype" type="checkbox" name="powerlist[type_add]" {getchecked($data['powerlist'],'type_add')} value="1" />
                        {lang_admin('adding_type')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_mtype" type="checkbox" name="powerlist[type_edit]" {getchecked($data['powerlist'],'type_edit')} value="1" />
                        {lang_admin('modification_of_type')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_mtype" type="checkbox" name="powerlist[type_del]" {getchecked($data['powerlist'],'type_del')} value="1" />
                        {lang_admin('delete_type')}</dd>
                    <!--专题管理-->
                    <dt><input class="content" type="checkbox" name="powerlist[special]" {getchecked($data['powerlist'],'special')} value="1" id="content_special">
                        {lang_admin('special_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_special" type="checkbox" name="powerlist[special_list]" {getchecked($data['powerlist'],'special_list')} value="1" />
                        {lang_admin('special_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_special" type="checkbox" name="powerlist[special_add]" {getchecked($data['powerlist'],'special_add')} value="1" />
                        {lang_admin('adding_special')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_special" type="checkbox" name="powerlist[special_edit]" {getchecked($data['powerlist'],'special_edit')} value="1" />
                        {lang_admin('revision_of_special')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="content content_special" type="checkbox" name="powerlist[special_del]" {getchecked($data['powerlist'],'special_del')} value="1" />
                        {lang_admin('delete_special')}</dd>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--用户-->
        <div class="main-right-box usergroup-table">
            <h5>
                <input name="powerlist[user]" type="checkbox" id="user"  value="1" {getchecked($data['powerlist'],'user')}>
                <strong>{lang_admin('user_manage')}</strong></h5>
            <div class="box" id="box">
                <dl>
                    <!--用户管理-->
                    <dt><input class="user" type="checkbox" name="powerlist[user_manage]" {getchecked($data['powerlist'],'user_manage')} value="1" id="user_manage">
                        {lang_admin('user_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_manage" type="checkbox" name="powerlist[user_list]" {getchecked($data['powerlist'],'user_list')} value="1" />
                        {lang_admin('registered_user_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_manage" type="checkbox" name="powerlist[user_add]" {getchecked($data['powerlist'],'user_add')} value="1" />
                        {lang_admin('add_user_fields')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_manage" type="checkbox" name="powerlist[user_edit]" {getchecked($data['powerlist'],'user_edit')} value="1" />
                        {lang_admin('modify_users')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_manage" type="checkbox" name="powerlist[user_del]" {getchecked($data['powerlist'],'user_del')} value="1" />
                        {lang_admin('delete_user')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_manage" type="checkbox" name="powerlist[user_ologin]" {getchecked($data['powerlist'],'user_ologin')} value="1" />
                        {lang_admin('login_configuration')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_manage" type="checkbox" name="powerlist[user_invite]" {getchecked($data['powerlist'],'user_invite')} value="1" />
                        {lang_admin('invitation_code')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_integration" type="checkbox" name="powerlist[user_integration]" {getchecked($data['powerlist'],'user_integration')} value="1" />
                        {lang_admin('modified_integral')}</dd>
                    <!--用户组管理-->
                    <dt><input class="user" type="checkbox" name="powerlist[user_group]" {getchecked($data['powerlist'],'user_group')} value="1" id="user_group">
                        {lang_admin('user_group_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_group" type="checkbox" name="powerlist[usergroup_list]" {getchecked($data['powerlist'],'usergroup_list')} value="1" />
                        {lang_admin('user_group_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_group" type="checkbox" name="powerlist[usergroup_add]" {getchecked($data['powerlist'],'usergroup_add')} value="1" />
                        {lang_admin('adding_user_groups')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_group" type="checkbox" name="powerlist[usergroup_edit]" {getchecked($data['powerlist'],'usergroup_edit')} value="1" />
                        {lang_admin('modify_user_groups')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_group" type="checkbox" name="powerlist[usergroup_del]" {getchecked($data['powerlist'],'usergroup_del')} value="1" />
                        {lang_admin('delete_user_groups')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_group" type="checkbox" name="powerlist[seo_consumption]" {getchecked($data['powerlist'],'seo_consumption')} value="1" />
                        {lang_admin('recharge_record_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="user user_group" type="checkbox" name="powerlist[seo_express]" {getchecked($data['powerlist'],'seo_express')} value="1" />
                        {lang_admin('logistics_list')}</dd>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--订单-->
        <div class="main-right-box usergroup-table">
            <h5>
                <input name="powerlist[order]" type="checkbox" id="order"  value="1" {getchecked($data['powerlist'],'order')} />
                <strong>{lang_admin('order')}</strong></h5>
            <div class="box" id="box">
                <dl>
                    <!--订单-->
                    <dt><input class="order" type="checkbox" name="powerlist[order_manage]" {getchecked($data['powerlist'],'order_manage')} value="1" id="order_manage">
                        {lang_admin('order_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_sitesystem" data-animated="false" data-size="mini" type="checkbox" name="powerlist[system_orders]"  {getchecked($data['powerlist'],'system_orders')} value="1" />{lang_admin('order_manage_settings')}
                    </dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="order order_manage" type="checkbox" name="powerlist[order_list]" {getchecked($data['powerlist'],'order_list')} value="1" />
                        {lang_admin('order_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="order order_manage" type="checkbox" name="powerlist[refund_list]" {getchecked($data['powerlist'],'refund_list')} value="1" />
                        {lang_admin('refund_order')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="order order_manage" type="checkbox" name="powerlist[order_del]" {getchecked($data['powerlist'],'order_del')} value="1" />
                        {lang_admin('delete_orders')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="order order_manage" type="checkbox" name="powerlist[order_edit]" {getchecked($data['powerlist'],'order_edit')} value="1" />
                        {lang_admin('handling_orders')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="order order_manage" type="checkbox" name="powerlist[order_pay]" {getchecked($data['powerlist'],'order_pay')} value="1" />
                        {lang_admin('payment_configuration')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="order order_manage" type="checkbox" name="powerlist[order_logistics]" {getchecked($data['powerlist'],'order_logistics')} value="1" />
                        {lang_admin('distribution_allocation')}</dd>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--扩展-->
        <div class="main-right-box usergroup-table">
            <h5>
                <input name="powerlist[func]" type="checkbox" id="func"  value="1" {getchecked($data['powerlist'],'func')} />
                <strong>{lang_admin('extend')}</strong>
            </h5>
            <div class="box" id="box">
                <dl>
                    <!--公告-->
                    <dt><input class="func" type="checkbox" name="powerlist[func_announc]" {getchecked($data['powerlist'],'func_announc')} value="1" id="func_announc">
                        {lang_admin('announcement_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_list]" {getchecked($data['powerlist'],'func_announc_list')} value="1" />
                        {lang_admin('bulletin_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_add]" {getchecked($data['powerlist'],'func_announc_add')} value="1" />
                        {lang_admin('adding_announcements')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_edit]" {getchecked($data['powerlist'],'func_announc_edit')} value="1" />
                        {lang_admin('amendment_notice')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_announc" type="checkbox" name="powerlist[func_announc_del]" {getchecked($data['powerlist'],'func_announc_del')} value="1" />
                        {lang_admin('delete_bulletins')}</dd>
                    <!--留言-->
                    <dt><input class="func" type="checkbox" name="powerlist[func_book]" {getchecked($data['powerlist'],'func_book')} value="1" id="func_book">
                        {lang_admin('guestbook_manage_settings')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_book" type="checkbox" name="powerlist[func_book_list]" {getchecked($data['powerlist'],'func_book_list')} value="1" />
                        {lang_admin('message_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_book" type="checkbox" name="powerlist[func_book_reply]" {getchecked($data['powerlist'],'func_book_reply')} value="1" />
                        {lang_admin('visitor_messages_and_administrator_response_messages')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_book" type="checkbox" name="powerlist[func_book_del]" {getchecked($data['powerlist'],'func_book_del')} value="1" />
                        {lang_admin('delete_messages')}</dd>
                    <!--评论-->
                    <dt><input class="func" type="checkbox" name="powerlist[func_comment]" {getchecked($data['powerlist'],'func_comment')} value="1" id="func_comment">
                        {lang_admin('comment_manage_settings')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_comment" type="checkbox" name="powerlist[func_comment_list]" {getchecked($data['powerlist'],'func_comment_list')} value="1" />
                        {lang_admin('comment_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_comment" type="checkbox" name="powerlist[func_comment_edit]" {getchecked($data['powerlist'],'func_comment_edit')} value="1" />
                        {lang_admin('revision_of_comments')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_comment" type="checkbox" name="powerlist[func_comment_del]" {getchecked($data['powerlist'],'func_comment_del')} value="1" />
                        {lang_admin('delete_comments')}</dd>
                    <!--投票-->
                    <dt><input class="func" type="checkbox" name="powerlist[func_ballot]" {getchecked($data['powerlist'],'func_ballot')} value="1" id="func_ballot">
                        {lang_admin('voting_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_list]" {getchecked($data['powerlist'],'func_ballot_list')} value="1" />
                        {lang_admin('voting_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_add]" {getchecked($data['powerlist'],'func_ballot_add')} value="1" />
                        {lang_admin('adding_votes')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_edit]" {getchecked($data['powerlist'],'func_ballot_edit')} value="1" />
                        {lang_admin('amendment_of_voting')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_ballot" type="checkbox" name="powerlist[func_ballot_del]" {getchecked($data['powerlist'],'func_ballot_del')} value="1" />
                        {lang_admin('delete_the_vote')}</dd>
                    <!--数据管理-->
                    <dt><input class="func" type="checkbox" name="powerlist[func_data]" {getchecked($data['powerlist'],'func_data')} value="1" id="func_data">
                        {lang_admin('manage_data')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_data" type="checkbox" name="powerlist[func_data_baker]" {getchecked($data['powerlist'],'func_data_baker')} value="1" />
                        {lang_admin('backup_database')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_data" type="checkbox" name="powerlist[func_data_restore]" {getchecked($data['powerlist'],'func_data_restore')} value="1" />
                        {lang_admin('restore_database')}</dd>
                    <!-- <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_data" type="checkbox" name="powerlist[func_data_phpweb]" {getchecked($data['powerlist'],'func_data_phpweb')} value="1" />
                        导入PHPweb数据</dd>-->
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_data" type="checkbox" name="powerlist[func_data_replace]" {getchecked($data['powerlist'],'func_data_replace')} value="1" />
                        {lang_admin('replace_strings')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_data" type="checkbox" name="powerlist[func_data_adminlogs]" {getchecked($data['powerlist'],'func_data_adminlogs')} value="1" />
                        {lang_admin('log_manage')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_data" type="checkbox" name="powerlist[func_data_safe]" {getchecked($data['powerlist'],'func_data_safe')} value="1" />
                        {lang_admin('security')}</dd>
                    <!--扩展-->
                    <dt><input class="func" type="checkbox" name="powerlist[system_extend]" {getchecked($data['powerlist'],'system_extend')} value="1" id="func_data">
                        {lang_admin('extend')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_security" type="checkbox" name="powerlist[func_filecheck]" {getchecked($data['powerlist'],'func_filecheck')} value="1" />
                        {lang_admin('document_proofreading')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_security" type="checkbox" name="powerlist[func_scan]" {getchecked($data['powerlist'],'func_scan')} value="1" />
                        {lang_admin('trojan_horse_killing')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="config config_website" type="checkbox" name="powerlist[seo_tag]"  {getchecked($data['powerlist'],'seo_tag')} value="1" />
                        {lang_admin('tag')}</dd>
                    </dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func" type="checkbox" name="powerlist[func_update]" {getchecked($data['powerlist'],'func_update')} value="1" id="func_update"> {lang_admin('detection_update')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="func func_security" type="checkbox" name="powerlist[system_wxxcx]" {getchecked($data['powerlist'],'system_wxxcx')} value="1" />
                        {lang_admin('wxxcx')}</dd>
                    </dd>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--模板-->
        <div class="main-right-box usergroup-table">
            <h5>
                <input name="powerlist[template]" type="checkbox" id="templates"  value="1" {getchecked($data['powerlist'],'template')}>
                <strong>{lang_admin('template_manage')}</strong></h5>
            <div class="box" id="box">
                <dl>
                    <!--模板管理-->
                    <dt><input class="templates" type="checkbox" name="powerlist[template_manage]" {getchecked($data['powerlist'],'template_manage')} value="1" id="template_manage">
                        {lang_admin('template_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates template_manage" type="checkbox" name="powerlist[system_template]" {getchecked($data['powerlist'],'system_template')} value="1" />
                        {lang_admin('template_selection')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates template_manage" type="checkbox" name="powerlist[template_visual]" {getchecked($data['powerlist'],'template_visual')} value="1" />
                        {lang_admin('visual_editing')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates template_manage" type="checkbox" name="powerlist[template_edit]" {getchecked($data['powerlist'],'template_edit')} value="1" />
                        {lang_admin('template_source_code')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates template_manage" type="checkbox" name="powerlist[template_downlist]" {getchecked($data['powerlist'],'template_downlist')} value="1" />
                        {lang_admin('template_online')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates template_manage" type="checkbox" name="powerlist[system_slide]" {getchecked($data['powerlist'],'system_slide')} value="1" />
                        {lang_admin('slide_projector')}</dd>
                    <!--添加标签-->
                    <dt><input class="templates" type="checkbox" name="powerlist[templatetag_add]" {getchecked($data['powerlist'],'templatetag_add')} value="1" id="templatetag_add">
                        {lang_admin('add_labels')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_add" type="checkbox" name="powerlist[templatetag_add_content]" {getchecked($data['powerlist'],'templatetag_add_content')} value="1" />
                        {lang_admin('content_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_add" type="checkbox" name="powerlist[templatetag_add_category]" {getchecked($data['powerlist'],'templatetag_add_category')} value="1" />
                        {lang_admin('column_lable')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_add" type="checkbox" name="powerlist[templatetag_add_special]" {getchecked($data['powerlist'],'templatetag_add_special')} value="1" />
                        {lang_admin('special_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_add" type="checkbox" name="powerlist[templatetag_add_define]" {getchecked($data['powerlist'],'templatetag_add_define')} value="1" />
                        {lang_admin('mobile_custom_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_add" type="checkbox" name="powerlist[templatetag_wap_add_define]" {getchecked($data['powerlist'],'templatetag_wap_add_define')} value="1" />
                        {lang_admin('mobile_content_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_add" type="checkbox" name="powerlist[templatetag_wap_add_define]" {getchecked($data['powerlist'],'templatetag_wap_add_define')} value="1" />
                        {lang_admin('target_target_of_mobile_column')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_add" type="checkbox" name="powerlist[templatetag_wap_add_define]" {getchecked($data['powerlist'],'templatetag_wap_add_define')} value="1" />
                        {lang_admin('mobile_custom_label')}</dd>
                    <!--标签列表-->
                    <dt><input class="templates" type="checkbox" name="powerlist[templatetag_list]" {getchecked($data['powerlist'],'templatetag_list')} value="1" id="templatetag_list">
                        {lang_admin('tag_list')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_list_function]" {getchecked($data['powerlist'],'templatetag_list_function')} value="1" />
                        {lang_admin('function_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_list_system]" {getchecked($data['powerlist'],'templatetag_list_system')} value="1" />
                        {lang_admin('system_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_list_content]" {getchecked($data['powerlist'],'templatetag_list_content')} value="1" />
                        {lang_admin('content_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_list_category]" {getchecked($data['powerlist'],'templatetag_list_category')} value="1" />
                        {lang_admin('column_lable')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_list_special]" {getchecked($data['powerlist'],'templatetag_list_special')} value="1" />
                        {lang_admin('special_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_list_define]" {getchecked($data['powerlist'],'templatetag_list_define')} value="1" />
                        {lang_admin('custom_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_wap_list_content]" {getchecked($data['powerlist'],'templatetag_wap_list_content')} value="1" />
                        {lang_admin('mobile_content_label')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_wap_list_category]" {getchecked($data['powerlist'],'templatetag_wap_list_category')} value="1" />
                        {lang_admin('target_target_of_mobile_column')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="templates templatetag_list" type="checkbox" name="powerlist[templatetag_wap_list_define]" {getchecked($data['powerlist'],'templatetag_wap_list_define')} value="1" />
                        {lang_admin('mobile_custom_label')}</dd>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--营销-->
        <div class="main-right-box usergroup-table">
            <h5>
                <input name="powerlist[seo]" type="checkbox" id="seo"  value="1" {getchecked($data['powerlist'],'seo')}>
                <strong>{lang_admin('marketing')}</strong>
            </h5>
            <div class="box" id="box">
                <dl>
                    <!--公众号-->
                    <dt><input class="seo" type="checkbox" name="powerlist[seo_weixin]" {getchecked($data['powerlist'],'seo_weixin')} value="1" id="seo_weixin">
                        {lang_admin('public_number_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_weixin" type="checkbox" name="powerlist[seo_weixin_list]" {getchecked($data['powerlist'],'seo_weixin_list')} value="1" />
                        {lang_admin('public_number_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_weixin" type="checkbox" name="powerlist[seo_weixin_add]" {getchecked($data['powerlist'],'seo_weixin_add')} value="1" />
                        {lang_admin('add_public_number')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_weixin" type="checkbox" name="powerlist[seo_weixin_edit]" {getchecked($data['powerlist'],'seo_weixin_edit')} value="1" />
                        {lang_admin('revision_of_public_number')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_weixin" type="checkbox" name="powerlist[seo_weixin_del]" {getchecked($data['powerlist'],'seo_weixin_del')} value="1" />
                        {lang_admin('delete_the_public_number')}</dd>
                    <!--蜘蛛列表-->
                    <dt><input class="seo" type="checkbox" name="powerlist[seo_status]" {getchecked($data['powerlist'],'seo_status')} value="1" id="seo_status">
                        {lang_admin('spider_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_status" type="checkbox" name="powerlist[seo_status_list]" {getchecked($data['powerlist'],'seo_status_list')} value="1" />
                        {lang_admin('spider_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_status" type="checkbox" name="powerlist[seo_status_del]" {getchecked($data['powerlist'],'seo_status_del')} value="1" />
                        {lang_admin('delete')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_status" type="checkbox" name="powerlist[seo_status_clear]" {getchecked($data['powerlist'],'seo_status_clear')} value="1" />
                        {lang_admin('empty')}</dd>
                    <!--内容链接-->
                    <dt><input class="seo" type="checkbox" name="powerlist[seo_linkword]" {getchecked($data['powerlist'],'seo_linkword')} value="1" id="seo_linkword">
                        {lang_admin('content_link_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_list]" {getchecked($data['powerlist'],'seo_linkword_list')} value="1" />
                        {lang_admin('link_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_add]" {getchecked($data['powerlist'],'seo_linkword_add')} value="1" />
                        {lang_admin('add_links')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_edit]" {getchecked($data['powerlist'],'seo_linkword_edit')} value="1" />
                        {lang_admin('modify_links')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_linkword" type="checkbox" name="powerlist[seo_linkword_del]" {getchecked($data['powerlist'],'seo_linkword_del')} value="1" />
                        {lang_admin('delete_links')}</dd>
                    <!--友情链接-->
                    <dt><input class="seo" type="checkbox" name="powerlist[seo_friendlink]" {getchecked($data['powerlist'],'seo_friendlink')} value="1" id="seo_friendlink">
                        {lang_admin('friendship_link_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_list]" {getchecked($data['powerlist'],'seo_friendlink_list')} value="1" />
                        {lang_admin('link_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_add]" {getchecked($data['powerlist'],'seo_friendlink_add')} value="1" />
                        {lang_admin('add_links')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_edit]" {getchecked($data['powerlist'],'seo_friendlink_edit')} value="1" />
                        {lang_admin('modify_links')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_del]" {getchecked($data['powerlist'],'seo_friendlink_del')} value="1" />
                        {lang_admin('delete_links')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_friendlink" type="checkbox" name="powerlist[seo_friendlink_setting]" {getchecked($data['powerlist'],'seo_friendlink_setting')} value="1" />
                        {lang_admin('friendship_link_configuration')}</dd>
                    <!--推广模块-->
                    <dt><input class="seo" type="checkbox" name="powerlist[user_union]" {getchecked($data['powerlist'],'user_union')} value="1" id="user_union">
                        {lang_admin('promotion_alliance')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo user_union" type="checkbox" name="powerlist[union_user]" {getchecked($data['powerlist'],'union_user')} value="1" />
                        {lang_admin('alliance_users')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo user_union" type="checkbox" name="powerlist[union_pay]" {getchecked($data['powerlist'],'union_pay')} value="1" />
                        {lang_admin('settlement_records')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo user_union" type="checkbox" name="powerlist[union_visit]" {getchecked($data['powerlist'],'union_visit')} value="1" />
                        {lang_admin('visit_statistics')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo user_union" type="checkbox" name="powerlist[union_reguser]" {getchecked($data['powerlist'],'union_reguser')} value="1" />
                        {lang_admin('registration_statistics')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo user_union" type="checkbox" name="powerlist[union_config]" {getchecked($data['powerlist'],'union_config')} value="1" />
                        {lang_admin('configuration_of_alliances')}</dd>
                    <!--邮件管理-->
                    <dt><input class="seo" type="checkbox" name="powerlist[seo_mail]" {getchecked($data['powerlist'],'seo_mail')} value="1" id="seo_mail">
                        {lang_admin('mail_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_mail" type="checkbox" name="powerlist[seo_mail_send]" {getchecked($data['powerlist'],'seo_mail_send')} value="1" />
                        {lang_admin('send_mail')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_mail" type="checkbox" name="powerlist[seo_mail_usersend]" {getchecked($data['powerlist'],'seo_mail_usersend')} value="1" />
                        {lang_admin('membership_mail_mass_distribution')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo seo_mail" type="checkbox" name="powerlist[seo_mail_subscription]" {getchecked($data['powerlist'],'seo_mail_subscription')} value="1" />
                        {lang_admin('subscription_mail_mass_distribution')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo" type="checkbox" name="powerlist[seo_coupon]" {getchecked($data['powerlist'],'seo_coupon')} value="1">
                        {lang_admin('coupon')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo" type="checkbox" name="powerlist[seo_thirdparty]" {getchecked($data['powerlist'],'seo_thirdparty')} value="1">
                        {lang_admin('third_party_code')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="seo" type="checkbox" name="powerlist[seo_xiongzhang]" {getchecked($data['powerlist'],'seo_xiongzhang')} value="1" id="seo_xiongzhang"> {lang_admin('xiongzhang_push')}</dd>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--自定义-->
        <div class="main-right-box usergroup-table">
            <h5>
                <input name="powerlist[defined]" type="checkbox" id="defined"  value="1" {getchecked($data['powerlist'],'defined')} />
                <strong>{lang_admin('custom')}</strong></h5>
            <div class="box" id="box">
                <dl>
                    <!--内容字段-->
                    <dt><input class="defined" type="checkbox" name="powerlist[defined_field_content]" {getchecked($data['powerlist'],'defined_field_content')} value="1" id="defined_field_content">
                        {lang_admin('content_field')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_content" type="checkbox" name="powerlist[defined_field_content_list]" {getchecked($data['powerlist'],'defined_field_content_list')} value="1" />
                        {lang_admin('content_field_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_content" type="checkbox" name="powerlist[defined_field_content_add]" {getchecked($data['powerlist'],'defined_field_content_add')} value="1" />
                        {lang_admin('adding_content_fields')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_content" type="checkbox" name="powerlist[defined_field_content_edit]" {getchecked($data['powerlist'],'defined_field_content_edit')} value="1" />
                        {lang_admin('modify_content_fields')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_content" type="checkbox" name="powerlist[defined_field_content_del]" {getchecked($data['powerlist'],'defined_field_content_del')} value="1" />
                        {lang_admin('delete_content_fields')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_content" type="checkbox" name="powerlist[defined_field_user]" {getchecked($data['powerlist'],'defined_field_user')} value="1" />
                        {lang_admin('user_field')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_user" type="checkbox" name="powerlist[defined_field_user_list]" {getchecked($data['powerlist'],'defined_field_user_list')} value="1" />
                        {lang_admin('user_field_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_user" type="checkbox" name="powerlist[defined_field_user_add]" {getchecked($data['powerlist'],'defined_field_user_add')} value="1" />
                        {lang_admin('add_user_fields')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_user" type="checkbox" name="powerlist[defined_field_user_edit]" {getchecked($data['powerlist'],'defined_field_user_edit')} value="1" />
                        {lang_admin('modify_user_fields')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_field_user" type="checkbox" name="powerlist[defined_field_user_del]" {getchecked($data['powerlist'],'defined_field_user_del')} value="1" />
                        {lang_admin('delete_user_fields')}</dd>
                    <!--管理表单-->
                    <dt><input class="defined" type="checkbox" name="powerlist[defined_form]" {getchecked($data['powerlist'],'defined_form')} value="1" id="defined_form">
                        {lang_admin('manage_forms')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_list]" {getchecked($data['powerlist'],'defined_form_list')} value="1" />
                        {lang_admin('form_list')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_add]" {getchecked($data['powerlist'],'defined_form_add')} value="1" />
                        {lang_admin('add_forms')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_edit]" {getchecked($data['powerlist'],'defined_form_edit')} value="1" />
                        {lang_admin('modify_the_form')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="defined defined_form" type="checkbox" name="powerlist[defined_form_del]" {getchecked($data['powerlist'],'defined_form_del')} value="1" />
                        {lang_admin('delete_form')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="question question-reply" type="checkbox" name="powerlist[cash]" {getchecked($data['powerlist'],'cash')} value="1" />
                        {lang_admin('cash')}</dd>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>
        <div class="clearfix blank20"></div>
        <!--静态-->
        <div class="main-right-box usergroup-table">
            <h5>
                <input name="powerlist[cache]" type="checkbox" id="cache"  value="1" {getchecked($data['powerlist'],'cache')} />
                <strong>{lang_admin('generating_static_state')}</strong>
            </h5>
            <div class="box" id="box">
                <dl>
                    <!--电脑静态-->
                    <dt><input class="cache" type="checkbox" name="powerlist[cache_manage]" {getchecked($data['powerlist'],'cache_manage')} value="1" id="cache_manage">
                        {lang_admin('computer_generation_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_content]" {getchecked($data['powerlist'],'cache_content')} value="1" />
                        {lang_admin('content_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_category]" {getchecked($data['powerlist'],'cache_category')} value="1" />
                        {lang_admin('column_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_index]" {getchecked($data['powerlist'],'cache_index')} value="1" />
                        {lang_admin('home_page_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_type]" {getchecked($data['powerlist'],'cache_type')} value="1" />
                        {lang_admin('type_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_special]" {getchecked($data['powerlist'],'cache_special')} value="1" />
                        {lang_admin('special_generation')}</dd>
                    <!-- <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_area]" {getchecked($data['powerlist'],'cache_area')} value="1" />
                      地区生成</dd> -->
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_tag]" {getchecked($data['powerlist'],'cache_tag')} value="1" />
                        {lang_admin('label_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_baidu]" {getchecked($data['powerlist'],'cache_baidu')} value="1" />
                        {lang_admin('baidu_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_google]" {getchecked($data['powerlist'],'cache_google')} value="1" />
                        {lang_admin('google_generation')}</dd>
                    <!--手机静态-->
                    <dt><input class="cache" type="checkbox" name="powerlist[cache_wap_manage]" {getchecked($data['powerlist'],'cache_wap_manage')} value="1" id="cache_wap_manage">
                        {lang_admin('mobile_generation_manage')}</dt>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_wap_manage" type="checkbox" name="powerlist[cache_manage_wap_content]" {getchecked($data['powerlist'],'cache_manage_wap_content')} value="1" />
                        {lang_admin('mobile_content_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_wap_manage" type="checkbox" name="powerlist[cache_manage_wap_category]" {getchecked($data['powerlist'],'cache_manage_wap_category')} value="1" />
                        {lang_admin('mobile_column_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_wap_manage" type="checkbox" name="powerlist[cache_manage_wap_index]" {getchecked($data['powerlist'],'cache_manage_wap_index')} value="1" />
                        {lang_admin('mobile_home_page_generation')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_wap_manage" type="checkbox" name="powerlist[cache_manage_wap_type]" {getchecked($data['powerlist'],'cache_manage_wap_type')} value="1" />
                        {lang_admin('type_generation_of_mobile_phones')}</dd>
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_wap_manage" type="checkbox" name="powerlist[cache_manage_wap_special]" {getchecked($data['powerlist'],'cache_manage_wap_special')} value="1" />
                        {lang_admin('mobile_theme_generation')}</dd>
                    <!-- <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_manage" type="checkbox" name="powerlist[cache_area]" {getchecked($data['powerlist'],'cache_area')} value="1" />
                      地区生成</dd> -->
                    <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><input class="cache cache_wap_manage" type="checkbox" name="powerlist[cache_manage_wap_tag]" {getchecked($data['powerlist'],'cache_manage_wap_tag')} value="1" />
                        {lang_admin('mobile_label_generation')}</dd>
                    <!--缓存-->
                    <dt><input class="cache" type="checkbox" name="powerlist[cache_update]" {getchecked($data['powerlist'],'cache_update')} value="1" id="cache_update">
                        {lang_admin('update_cache')}</dt>
                </dl>
            </div>
            <div class="clearfix blank5"></div>
        </div>

    </div>
    <div class="blank30"></div>
    <div class="blank30"></div>
    <div class="blank30"></div>
</form>
