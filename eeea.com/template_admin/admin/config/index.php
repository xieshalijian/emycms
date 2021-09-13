<style type="text/css">
    .quick-navb {}
    .list-group-item { min-height:144px; margin:0px 10px 10px 10px; padding:25px 30px 20px 30px; -moz-box-shadow:0px 8px 15px #eee;
        -webkit-box-shadow:0px 8px 15px #eee;
        box-shadow:0px 8px 15px #eee;border:none;color:#fff;text-align:right; font-size:12px;}
        a.list-group-item-b {background:#eee; padding:15px 30px; border:1px solid #ccc; text-align:center;}

        .list-group-item span {display:block; width:50px; height:50px; font-size:26px;float:left;color:#424950; background:#eee;padding:12px;border-radius:50%;}
        .list-group-item strong {display:block; font-size:18px; line-height:38px; color:#000; font-weight:300;}
        .list-group-item:last-child {border-radius:8px; }
        .list-group-item-b:last-child {border-radius:2px; }
        a.list-group-item:hover,.glyphicon-list-alt {background:#424950;color:#fff;-moz-box-shadow:0px 8px 15px #aaa;
            -webkit-box-shadow:0px 8px 15px #aaa;
            box-shadow:0px 8px 15px #aaa;-o-transition: all 0.15s, 0.15s;
            -moz-transition: all 0.15s, 0.15s;
            -webkit-transition: all 0.15s, 0.15s;}
            .quick-navb-item {margin-bottom:20px; height:150px; overflow:hidden; }
            .quick-navb-item:hover strong {color:#fff;}
        </style>

        <script type="text/javascript">
            jQuery(function($){
               $("#demo_btn").click(function(){
                  $("#demo_div").attr("src",
                     "demo.php?pattern="+$("#ifocus_pattern").val()+"&width="+$("#ifocus_width").val()+"&height="+$("#ifocus_height").val()+
                     "&number="+$("#ifocus_number").val()+"&time="+$("#ifocus_time").val());
              });
               $('#sms_manage').load('<?php echo url('sms/manage');?>');
           });
            var base_url = '{config::getadmin('site_url')}';


        </script>

        <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload/ajaxfileupload.js"></script>
        <script type="text/javascript" src="{$base_url}/common/js/jquery/plugins/jquery-imgareaselect/jquery.imgareaselect.min.js"></script>
        <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload/ThumbAjaxFileUpload.js"></script>
        <script type="text/javascript" src="{$base_url}/common/js/upimg/dialog.js"></script>
        <link href="{$skin_admin_path}/css/dialog.css" rel="stylesheet" type="text/css" />

        <div class="blank30"></div>

        <form method="post" action="<?php echo uri();?>" name="config_form" id="config_form">

            <div class="quick-navb">

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=site&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('global_settings')}"><span class="icon-settings"></span> 	<p><strong>{lang_admin('global_settings')}</strong>{lang_admin('web_site_global_configuration')}</p></a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=websitesite&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('custom')}"><span class="icon-equalizer"></span> 	<p><strong>{lang_admin('custom')}</strong>{lang_admin('custom_site_configuration_settings')}</p></a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=information&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('contact_information')}"><span class="icon-speech"></span> 	<p><strong>{lang_admin('contact_information')}</strong></p>{lang_admin('setting_up_contact_information_display_content_of_website')}</a>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=phonesite&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('mobile_version')}"><span class="icon-call-end"></span> 	<p><strong>{lang_admin('mobile_version')}</strong>{lang_admin('setting_up_independent_mobile_content')}</p></a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=slide&act=list&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('slide')}"><span class="icon-film"></span> 	<p><strong>{lang_admin('slide')}</strong></p>{lang_admin('slide_expansion_info')}</a></a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=customer&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('customer_service_list')}"><span class="icon-earphones-alt"></span> 	<p><strong>{lang_admin('customer_service_list')}</strong></p>{lang_admin('site_customer_service_information_settings')}</a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=verification&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('verification_code')}"><span class="icon-shield"></span> 	<p><strong>{lang_admin('verification_code')}</strong>{lang_admin('verification_code_and_mobile_short_message_verification_code_settings')}</p></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=upload&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('attachment')}"><span class="icon-folder-alt"></span> 	<p><strong>{lang_admin('attachment')}</strong>{lang_admin('set_the_suffix_name_and_size_of_the_upload_attachment')}</p></a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=mail&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('mail_serve')}"><span class="icon-envelope"></span> 	<p><strong>{lang_admin('mail_serve')}</strong>{lang_admin('set_up_mail_notification_service_set_trigger_mail_notification')}</p></a>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=ditu&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('map_settings')}"><span class="icon-pointer"></span> 	<p><strong>{lang_admin('map_settings')}</strong></p>{lang_admin('setting_up_the_location_of_display_company_in_baidu_map')}</a>
                    </div>
                </div>





                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=language&act=list&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('language')}"><span class="icon-globe"></span> 	<p><strong>{lang_admin('language')}</strong>{lang_admin('other_languages_can_be_added_such_as_english_german_japanese_etc')}</p></a>
                    </div>
                </div>




                <?php if(session::get('ver') == 'corp'){ ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                        <div class="row">
                            <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=atlas&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('multipoint_map_settings')}"><span class="icon-pointer"></span> 	<p><strong>{lang_admin('multipoint_map_settings')}</strong></p>{lang_admin('setting_up_the_location_of_display_company_in_baidu_map')}</a>
                        </div>
                    </div>
                <?php } ?>


                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a title="" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=website&act=listwebsite&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('multi_sign_on')}"><span class="icon-list"></span> 	<p><strong>{lang_admin('multi_sign_on')}</strong></p>{lang_admin('group_sub-station_information_settings_do_not_need_to_log_in_to_switch directly_to_sub-station')}</a>
                    </div>
                </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                        <div class="row">
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=dynamic&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('dynamic')}"><span class="
                                icon-rocket"></span> 	<p><strong>{lang_admin('dynamic')}</strong></p>{lang_admin('when_html_is_generated_by_separate_settings_columns_in_dynamic_and_static_settings_must_be_selected_as_specified_and_columns_in_dynamic_and_static_generation_need_to_generate_html')}</a></a>
                            </div>
                        </div>

                <?php if(user::getuserid()==2){?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                        <div class="row">
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=menu&act=list&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('侧边栏')}"><span class="
                                icon-rocket"></span> 	<p><strong>{lang_admin('sidebar')}</strong></p>{lang_admin('sidebar')}</a></a>
                        </div>
                    </div>
                <?php }?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
                    <div class="row">
                        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=config&act=system&set=xml&admin_dir={get('admin_dir',true)}&site=default" class="list-group-item" data-dataurlname="{lang_admin('xml设置')}"><span class="
                                icon-rocket"></span> 	<p><strong>{lang_admin('xml设置')}</strong></p>{lang_admin('xml设置')}</a></a>
                    </div>
                </div>


            </div>

                </form>
                <div class="blank30"></div>

            </div>