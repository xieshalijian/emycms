<?php
# CmsEasy Enterprise Content Management System
# Copyright (C) CmsEasy Co.,Ltd (https://www.CmsEasy.cn). All rights reserved.
if (!defined('ROOT')) exit('Can\'t Access !');

class myconfig extends table
{

    public $name = 'config';
    public static $me;

    public static function getInstance()
    {
        if (!self::$me) {
            $class = new myconfig();
            $class->init();
            self::$me = $class;
        }
        return self::$me;
    }
    function init()
    {
        $_config = $this->getrows(null, 1000, 'id desc');
        $myconfigconfig = array();
        foreach ($_config as $one) {
            $myconfigconfig[$one['lang']][$one['name']] = $one;
        }
        $this->myconfig = $myconfigconfig;
    }

    function getcols($act)
    {
        switch ($act) {
            case 'manage':
                return '*';
            default:
                return '*';
        }
    }

    function get_form()
    {
        $myconfig_data=array(
            "site"=>array(
                'stop_site' => array(
                    'selecttype' => 'radio',
                    'select' => array(1 => lang_admin('open'), 2=> lang_admin('shut'),3=> lang_admin('suspend')),
                    'remarks' => lang_admin('site'),
                    'message' => lang_admin('please_select_the_status'),
                ),
                'user_outtime' => array(
                    'selecttype' => 'radio',
                    'select' => array(30=> lang_admin('half_an_hour'),60 => lang_admin('one_hour'),0 => lang_admin('never_timeout')),
                    'remarks' => lang_admin('set_account_timeout'),
                    'message' => lang_admin('set_account_timeout'),
                ),
                'site_url' => array(
                    'remarks' => lang_admin('website_address'),
                    'message' => lang_admin('please_fill_in_the_complete_url_of_the_site'),
                ),
                'site_mobile' => array(
                    'remarks' => lang_admin('administrator_mobile_phone'),
                    'message' => lang_admin('administrator_mobile_phone'),
                ),

                'sitename' => array(
                    'remarks' => lang_admin('sitename'),
                    'message' => lang_admin('sitename'),
                ),
                'fullname' => array(
                    'remarks' => lang_admin('page_title'),
                    'message' => lang_admin('it_can_fill_in_keywords_different_from_content_names_which_is_beneficial_to_search_optimization'),
                ),
                'site_keyword' => array(
                    'remarks' => lang_admin('website_keyword'),
                    'message' => lang_admin('the_keywords_information_in_meta_information_can_be_filled_in_the_keywords_related_to_the_content_separated_by_commas_in_english_which_is_conducive_to_search_optimization'),
                ),
                'site_description' => array(
                    'remarks' => lang_admin('website_description'),
                    'message' => lang_admin('description_information_in_meta_information_can_fill_in_content_related_profiles_which_is_conducive_to_search_optimization'),
                ),
                'site_logo' => array(
                    'selecttype' => 'image',
                    'remarks' => lang_admin('Logo'),
                    'message' => lang_admin('site_logo'),
                ),

                'site_ico' => array(
                    'selecttype' => 'image',
                    'remarks' => lang_admin('address_bar_icon'),
                    'message' => lang_admin('address_bar_icon'),
                ),
                'site_right' => array(
                    'remarks' => lang_admin('copyright_information'),
                    'message' => lang_admin('copyright_information'),
                ),
                'site_icp' => array(
                    'remarks' => lang_admin('ICP_filing_number'),
                    'message' => lang_admin('ICP_filing_number'),
                ),
                'icp_url' => array(
                    'remarks' => lang_admin('ICP_address'),
                    'message' => lang_admin('ICP_address'),
                ),
                'site_beian_number' => array(
                    'remarks' => lang_admin('public_network_security_number'),
                    'message' => lang_admin('public_network_security_number'),
                ),
                'saic_pic' => array(
                    'remarks' => lang_admin('industrial_and_commercial_lighting_ID'),
                    'message' => lang_admin('industrial_and_commercial_lighting_ID'),
                ),
                'address' => array(
                    'remarks' => lang_admin('address'),
                    'message' => lang_admin('address'),
                ),
                'tel' => array(
                    'remarks' => lang_admin('ordertel'),
                    'message' => lang_admin('site'),
                ),
                'mobile' => array(
                    'remarks' => lang_admin('mobile'),
                    'message' => lang_admin('mobile'),
                ),
                'fax' => array(
                    'remarks' => lang_admin('fax'),
                    'message' => lang_admin('fax'),
                ),
                'email' => array(
                    'remarks' => lang_admin('email'),
                    'message' => lang_admin('email'),
                ),
                'complaint_email' => array(
                    'remarks' => lang_admin('complaint_email'),
                    'message' => lang_admin('complaint_email'),
                ),
                'postcode' => array(
                    'remarks' => lang_admin('postal_code'),
                    'message' => lang_admin('postal_code'),
                ),


            ),
            "websitesite"=>array(


                'history_num' => array(
                    'remarks' => lang_admin('access_record'),
                    'message' => lang_admin('access_record'),
                ),





                'video_url' => array(
                    'selecttype' => 'textarea',
                    'remarks' => lang_admin('video_address'),
                    'message' => lang_admin('video_address'),
                ),

            ),
            "information"=>array(

            ),
            "langsite"=>array(
                'lang_switch' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('multilingual'),
                    'message' => lang_admin('multilingual'),
                ),
                'lang_type' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('complex_and_simple_switching'),
                    'message' => lang_admin('complex_and_simple_switching'),
                ),
            ),
            "filechecksite"=>array(
                'safe360_enable' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('360安全开关'),
                    'message' => lang_admin('360安全开关'),
                ),

            ),
            "phonesite"=>array(
                'mobile_open' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('is_it_enabled'),
                    'message' => lang_admin('setting_up_independent_mobile_content'),
                ),
                'wap_logo' => array(
                    'selecttype' => 'image',
                    'remarks' => lang_admin('Logo'),
                    'message' => lang_admin('Logo'),
                ),

                'wap_style_color' => array(
                    'selecttype' => 'select',
                    'select' => array(0=> lang_admin('nothing'),1 => lang_admin('red'),2 => lang_admin('orange'),3 => lang_admin('yellow'),4 => lang_admin('green'),5 => lang_admin('young'),6 => lang_admin('blue'), 7 => lang_admin('purple'),8 => lang_admin('black'),9 => lang_admin('white')),
                    'remarks' => lang_admin('overall_color'),
                    'message' => lang_admin('overall_color'),
                ),
                'wap_foot_nav' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'),1 => lang_admin('pop_up'),2 => lang_admin('circular'),3 => lang_admin('background_repeat')),
                    'remarks' => lang_admin('menu_style'),
                    'message' => lang_admin('wap_bottom_menu_style'),
                ),
                'wap_foot_nav_position' => array(
                    'selecttype' => 'select',
                    'select' => array("left"=> lang_admin('left'),"right"=> lang('right')),
                    'remarks' => lang_admin('menu_position'),
                    'message' => lang_admin('menu_position'),
                ),
                'qrcodes' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('wap_qr_code'),
                    'message' => lang_admin('wap_qr_code'),
                ),
            ),
            "dynamic"=>array(
                'list_cache' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('list_cache'),
                    'message' => lang_admin('list_cache'),
                ),
                'list_cache_time' => array(
                    'remarks' => lang_admin('cache_time'),
                    'message' => lang_admin('cache_time'),
                ),
                'group_on' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('generate_group'),
                    'message' => lang_admin('generate_group'),
                ),
                'group_count' => array(
                    'remarks' => lang_admin('number_of_generators_per_group'),
                    'message' => lang_admin('number_of_generators_per_group'),
                ),
                'pc_html_info' => array(
                    'remarks' => lang_admin('pc_html'),
                    'message' => lang_admin('pc_html'),
                ),

                'html_prefix' => array(
                    'remarks' => lang_admin('storage_directory'),
                    'message' => lang_admin('column_file_storage_directory_directory_must_be_in_english_or_pinyin_no_space_in_the_middle'),
                ),
                'list_index_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('home_page'),
                    'message' => lang_admin('is_static_html'),
                ),
                'list_page_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('column'),
                    'message' => lang_admin('is_static_html'),
                ),
                'show_page_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('content'),
                    'message' => lang_admin('is_static_html'),
                ),
                'list_type_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('type'),
                    'message' => lang_admin('is_static_html'),
                ),
                'list_special_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('special'),
                    'message' => lang_admin('is_static_html'),
                ),
                'tag_html' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('TAG'),
                    'message' => lang_admin('is_static_html'),
                ),
                'wap_html_info' => array(
                    'remarks' => lang_admin('wap_html'),
                    'message' => lang_admin('is_static_htmlis_static_html'),
                ),
                'wap_html_prefix' => array(
                    'remarks' => lang_admin('storage_directory'),
                    'message' => lang_admin('column_file_storage_directory_directory_must_be_in_english_or_pinyin_no_space_in_the_middle'),
                ),
                'wap_index_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('home_page'),
                    'message' => lang_admin('is_static_htmlis_static_html'),
                ),
                'wap_list_page_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('column'),
                    'message' => lang_admin('is_static_htmlis_static_html'),
                ),
                'wap_show_page_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('content'),
                    'message' => lang_admin('is_static_htmlis_static_html'),
                ),
                'wap_type_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('type'),
                    'message' => lang_admin('is_static_htmlis_static_html'),
                ),
                'wap_special_php' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('special'),
                    'message' => lang_admin('is_static_htmlis_static_html'),
                ),
                'wap_tag_html' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('as_specified'),1 => lang_admin('static_state'),2 => lang_admin('dynamic')),
                    'remarks' => lang_admin('TAG'),
                    'message' => lang_admin('is_static_htmlis_static_html'),
                ),
                'urlrewrite_info' => array(
                    'remarks' => lang_admin('please_note_that'),
                ),

                'share' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('share'),
                    'message' => lang_admin('share'),
                ),
                'cache_make_open' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('PHP_cache_switch'),
                    'message' => lang_admin('PHP_cache_switch'),
                ),
                'show_top_text' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('top_text_display'),
                    'message' => lang_admin('site'),
                ),
                'nav_top' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('navigation_top'),
                    'message' => lang_admin('site'),
                ),
                'shield_right_key' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('shield_right_button'),
                    'message' => lang_admin('site'),
                ),
                'nav_blank' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('column_opening_method'),
                    'message' => lang_admin('site'),
                ),
                'onerror_pic' => array(
                    'selecttype' => 'image',
                    'remarks' => lang_admin('list_default_picture'),
                    'message' => lang_admin('site'),
                ),
                'thumb_width' => array(
                    'remarks' => lang_admin('picture_width'),
                    'message' => lang_admin('site'),
                ),
                'thumb_height' => array(
                    'remarks' => lang_admin('picture_height'),
                    'message' => lang_admin('site'),
                ),
                'manage_pagesize' => array(
                    'remarks' => lang_admin('number_of_background_pages'),
                    'message' => lang_admin('site'),
                ),
                'list_pagesize' => array(
                    'remarks' => lang_admin('number_of_foreground_pages'),
                    'message' => lang_admin('site'),
                ),
                'like_news' => array(
                    'remarks' => lang_admin('number_of_related_articles'),
                    'message' => lang_admin('site'),
                ),

                'archive_introducelen' => array(
                    'remarks' => lang_admin('content_profile_interception_length'),
                    'message' => lang_admin('site'),
                ),

            ),
            "spidersite"=>array(
                'stats_enable' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('spider_statistics'),
                    'message' => lang_admin('site'),
                ),
                'iscleanstats' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'),1 => lang_admin('daily'),2 => lang_admin('weekly')),
                    'remarks' => lang_admin('auto_clear'),
                    'message' => lang_admin('site'),
                ),
                'site_push' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('baidu_push'),
                    'message' => lang_admin('site'),
                ),
            ),
            "backupsite"=>array(
                'isautobak' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'),1 => lang_admin('daily'),2 => lang_admin('weekly'),3 => lang_admin('monthly')),
                    'remarks' => lang_admin('automatic_database_backup'),
                    'message' => lang_admin('site'),
                ),
            ),
            "customer"=>array(
                'ifonserver' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('is_it_enabled'),
                    'message' => lang_admin('site'),
                ),
                'server_template' => array(
                    'selecttype' => 'select',
                    'select' => array(1=> lang_admin('flat_color'),2 => lang_admin('flat_gray'),3 => lang_admin('flat_blue'),4 => lang_admin('classic'),5 => lang_admin('old_time')),
                    'remarks' => lang_admin('customer_service_style'),
                    'message' => lang_admin('site'),
                ),
                'boxopen' => array(
                    'selecttype' => 'radio',
                    'select' => array("close"=> lang_admin('shut'),"open" => lang_admin('open')),
                    'remarks' => lang_admin('default_deployment'),
                    'message' => lang_admin('site'),
                ),
                'serverlistp' => array(
                    'selecttype' => 'radio',
                    'select' => array("left"=> lang_admin('left'),"right" => lang_admin('right')),
                    'remarks' => lang_admin('menu_position'),
                    'message' => lang_admin('site'),
                ),
                'worktime' => array(
                    'remarks' => lang_admin('working_hours'),
                    'message' => lang_admin('site'),
                ),
                'qq1name' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'qq1' => array(
                    'remarks' => lang_admin('qq_number'),
                    'message' => lang_admin('site'),
                ),
                'qq2name' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'qq2' => array(
                    'remarks' => lang_admin('QQ'),
                    'message' => lang_admin('site'),
                ),
                'qq3name' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'qq3' => array(
                    'remarks' => lang_admin('QQ'),
                    'message' => lang_admin('site'),
                ),
                'qq4name' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'qq4' => array(
                    'remarks' => lang_admin('QQ'),
                    'message' => lang_admin('site'),
                ),
                'qq5name' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'qq5' => array(
                    'remarks' => lang_admin('QQ'),
                    'message' => lang_admin('site'),
                ),
                'wangwangname' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'wangwang' => array(
                    'remarks' => lang_admin('taobao_wangwang'),
                    'message' => lang_admin('site'),
                ),
                'aliname' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'ali' => array(
                    'remarks' => lang_admin('ali_wangwang'),
                    'message' => lang_admin('site'),
                ),
                'skypename' => array(
                    'remarks' => lang_admin('customer_service_position'),
                    'message' => lang_admin('site'),
                ),
                'skype' => array(
                    'remarks' => lang_admin('Skype'),
                    'message' => lang_admin('site'),
                ),
                'weixin_pic' => array(
                    'selecttype' => 'image',
                    'remarks' => lang_admin('wechat_QR_code'),
                    'message' => lang_admin('site'),
                ),
            ),
            "security"=>array(
                'filter_word' => array(
                    'selecttype' => 'textarea',
                    'remarks' => lang_admin('filter_character'),
                    'message' => lang_admin('site'),
                ),
                'filter_x' => array(
                    'selecttype' => 'textarea',
                    'remarks' => lang_admin('substitute_character'),
                    'message' => lang_admin('site'),
                ),
                'admin_dir' => array(
                    'remarks' => lang_admin('background_address'),
                    'message' => lang_admin('site'),
                ),
                'upload_filetype' => array(
                    'selecttype' => 'textarea',
                    'remarks' => lang_admin('attachment_type'),
                    'message' => lang_admin('site'),
                ),
                'upload_max_filesize' => array(
                    'remarks' => lang_admin('attachment_size'),
                    'message' => lang_admin('site'),
                ),
                'verifycode' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'),1 => lang_admin('character'),2 => lang_admin('puzzle')),
                    'remarks' => lang_admin('verification_code'),
                    'message' => lang_admin('site'),
                ),
                'pic_enable_info' => array(
                    'remarks' => lang_admin('please_note_that'),
                    'message' => lang_admin('site'),
                ),
                'gee_id' => array(
                    'remarks' => lang_admin('ID'),
                    'message' => lang_admin('site'),
                ),
                'gee_key' => array(
                    'remarks' => lang_admin('KEY'),
                    'message' => lang_admin('site'),
                ),

                'isdebug' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('debugging'),
                    'message' => lang_admin('site'),
                ),
                'ueditor_open' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('editor_supports_div'),
                    'message' => lang_admin('site'),
                ),
                'hotsearch' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('search_keyword'),
                    'message' => lang_admin('site'),
                ),
                'search_time' => array(
                    'remarks' => lang_admin('time_limit'),
                    'message' => lang_admin('site'),
                ),
                'maxhotkeywordnum' => array(
                    'remarks' => lang_admin('search_cardinality'),
                    'message' => lang_admin('site'),
                ),

                'template_view' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('template_online'),
                    'message' => lang_admin('site'),
                ),
                'buymodules_view' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('buymodules_online'),
                    'message' => lang_admin('site'),
                ),
                'extend_view' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('extend_online'),
                    'message' => lang_admin('site'),
                ),
                'opguestadd' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('submitted_by_tourists'),
                    'message' => lang_admin('site'),
                ),
                'html_wow' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('Web_animation'),
                    'message' => lang_admin('site'),
                ),

                'session_ip' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('session_validation'),
                    'message' => lang_admin('site'),
                ),
                'ipcheck_enable' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('background_login_IP_authentication_switch'),
                    'message' => lang_admin('site'),
                ),
                'template_nologin' => array(
                    'remarks' => lang_admin('limit_of_number_of_foreground_login_errors'),
                    'message' => lang_admin('site'),
                ),
                'admin_nologin' => array(
                    'remarks' => lang_admin('limit_of_number_of_background_login_errors'),
                    'message' => lang_admin('site'),
                ),
                'loginfalsetime' => array(
                    'selecttype' => 'select',
                    'select' => array(3600=> lang_admin('1_hour'),18000 => lang_admin('5_hours'),86400 => lang_admin('24_hours')),
                    'remarks' => lang_admin('login_failure_time'),
                    'message' => lang_admin('site'),
                ),
                'cookie_password' => array(
                    'remarks' => lang_admin('cookie_security_code'),
                    'message' => lang_admin('site'),
                ),
                'attachment_time' => array(
                    'remarks' => lang_admin('下载时间限制'),
                    'message' => lang_admin('0为不限制'),
                ),
                'attachment_ip' => array(
                    'selecttype' => 'textarea',
                    'remarks' => lang_admin('下载IP白名单'),
                    'message' => lang_admin('对上传的文件进行ip限制，空为不限制,多个逗号分隔'),
                ),
                'is_attachment_intro' => array(
                    'selecttype' => 'radio',
                    'select' => array(1 => lang_admin('yes'), 0=> lang_admin('no')),
                    'remarks' => lang_admin('is_attachment_intro'),
                    'message' => lang_admin('site'),
                )
            ),
            "user"=>array(
                'reg_on' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('registered_user'),
                    'message' => lang_admin('site'),
                ),
                'site_login' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('display_registration'),
                    'message' => lang_admin('site'),
                ),
                'invitation_registration' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('invite_registration'),
                    'message' => lang_admin('site'),
                ),
            ),
            "comment"=>array(
                'comment' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('is_it_enabled'),
                    'message' => lang_admin('site'),
                ),
                'comment_list' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('comment_list'),
                    'message' => lang_admin('site'),
                ),
                'comment_num' => array(
                    'remarks' => lang_admin('comment_number'),
                    'message' => lang_admin('site'),
                ),
                'comment_user' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('tourist_view'),
                    'message' => lang_admin('site'),
                ),

                'comment_time' => array(
                    'selecttype' => 'select',
                    'select' => array(10=> lang_admin('10seconds'),30 => lang_admin('30seconds'),60 => lang_admin('60seconds')),
                    'remarks' => lang_admin('time_limit'),
                    'message' => lang_admin('site'),
                ),
                'comment_switch' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('tourist'),1 => lang_admin('member'),2 => lang_admin('prohibit')),
                    'remarks' => lang_admin('comment_condition'),
                    'message' => lang_admin('site'),
                ),
                'comment_title' => array(
                    'remarks' => lang_admin('comment_page_title'),
                    'message' => lang_admin('site'),
                ),
                'reply_comment' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('multiple_reply'),
                    'message' => lang_admin('site'),
                ),
            ),
            "formsite"=>array(
                'guestformsubmit' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('visitor_submission'),
                    'message' => lang_admin('site'),
                ),
            ),
            "orders"=>array(

                'order_time' => array(
                    'selecttype' => 'select',
                    'select' => array(10=> lang_admin('10seconds'),30 => lang_admin('30seconds'),60 => lang('60seconds')),
                    'remarks' => lang_admin('time_limit'),
                    'message' => lang_admin('site'),
                ),
            ),
            "guestbook"=>array(
                'guestbook_enable' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('is_it_enabled'),
                    'message' => lang_admin('site'),
                ),
                'guestbook_list' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('show_guestbook_list'),
                    'message' => lang_admin('site'),
                ),
                'guestbook_time' => array(
                    'selecttype' => 'select',
                    'select' => array(10=> lang_admin('10seconds'),30 => lang_admin('30seconds'),60 => lang('60seconds')),
                    'remarks' => lang_admin('time_limit'),
                    'message' => lang_admin('site'),
                ),
                'guestbook_user' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('tourist_view'),
                    'message' => lang_admin('site'),
                ),
                'guestbook_switch' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('tourist'),1 => lang_admin('member'),2 => lang_admin('prohibit')),
                    'remarks' => lang_admin('guestbook_conditions'),
                    'message' => lang_admin('site'),
                ),
                'guestbook_title' => array(
                    'remarks' => lang_admin('guestbook_title'),
                    'message' => lang_admin('site'),
                ),
            ),
            "sitesetup"=>array(
                'website_list' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('site_list'),
                    'message' => lang_admin('site'),
                ),
            ),
            "upload"=>array(

            ),
            "ballot"=>array(
                'checkip' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('verify_IP'),
                    'message' => lang_admin('site'),
                ),
                'timer' => array(
                    'remarks' => lang_admin('time_limit'),
                    'message' => lang_admin('site'),
                ),
            ),
            "ditu"=>array(
                'ditu_APK' => array(
                    'remarks' => lang_admin('map_APK'),
                    'message' => lang_admin('site'),
                ),
                'ditu_width' => array(
                    'remarks' => lang_admin('map_width'),
                    'message' => lang_admin('site'),
                ),
                'ditu_height' => array(
                    'remarks' => lang_admin('map_height'),
                    'message' => lang_admin('site'),
                ),
                'ditu_center_left' => array(
                    'remarks' => lang_admin('longitude'),
                    'message' => lang_admin('site'),
                ),
                'ditu_center_right' => array(
                    'remarks' => lang_admin('latitude'),
                    'message' => lang_admin('site'),
                ),
                'ditu_level' => array(
                    'remarks' => lang_admin('rank'),
                    'message' => lang_admin('site'),
                ),
                'ditu_title' => array(
                    'remarks' => lang_admin('information_window_title'),
                    'message' => lang_admin('site'),
                ),
                'ditu_content' => array(
                    'selecttype' => 'textarea',
                    'remarks' => lang_admin('information_window_content'),
                    'message' => lang_admin('site'),
                ),
                'ditu_maker_left' => array(
                    'remarks' => lang_admin('mark_point_longitude'),
                    'message' => lang_admin('site'),
                ),
                'ditu_maker_right' => array(
                    'remarks' => lang_admin('mark_point_latitude'),
                    'message' => lang_admin('site'),
                ),
                'ditu_explain' => array(
                    'remarks' => lang_admin('instructions_for_use'),
                    'message' => lang_admin('site'),
                ),
            ),
            "mail"=>array(
                'send_type' => array(
                    'selecttype' => 'select',
                    'select' => array(0=> lang_admin('please_choose'),1 => 'Sendmail',2 => 'SOCKET',3 => 'PHP函数'),
                    'remarks' => lang_admin('mail_sending_method'),
                    'message' => lang_admin('site'),
                ),
                'header_var' => array(
                    'selecttype' => 'select',
                    'select' => array(99=> lang_admin('please_choose'),1 => 'CRLF分隔符(Windows)',0 => 'LF分隔符(Unix|Linux)',2 => 'CR分隔符(Mac)'),
                    'remarks' => lang_admin('separator_of_message_header'),
                    'message' => lang_admin('site'),
                ),
                'kill_error' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('screen_error_prompt'),
                    'message' => lang_admin('site'),
                ),
                'smtp_mail_host' => array(
                    'remarks' => lang_admin('SMTP_server'),
                    'message' => lang_admin('site'),

                ),
                'smtp_mail_port' => array(
                    'remarks' => lang_admin('SMTP_port'),
                    'message' => lang_admin('site'),
                ),
                'smtp_mail_auth' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('authentication_required'),
                    'message' => lang_admin('site'),
                ),
                'smtp_user_add' => array(
                    'remarks' => lang_admin('sender_address'),
                    'message' => lang_admin('site'),
                ),
                'smtp_mail_username' => array(
                    'remarks' => lang_admin('emial'),
                    'message' => lang_admin('site'),
                ),
                'smtp_mail_password' => array(
                    'remarks' => lang_admin('password'),
                    'message' => lang_admin('site'),
                ),
            ),
            "mail_php"=>array(
                'smtp_host' => array(
                    'remarks' => lang_admin('SMTP_server'),
                    'message' => lang_admin('site'),
                ),
                'smtp_port' => array(
                    'remarks' => lang_admin('SMTP_port'),
                    'message' => lang_admin('site'),
                ),
            ),
            "mail_open"=>array(
                'email_gust_send_cust' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('send_message_to_customer_email'),
                    'message' => lang_admin('site'),
                ),
                'email_guest_send_admin' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('send_message_to_administrator_mailbox'),
                    'message' => lang_admin('site'),
                ),
                'email_order_send_cust' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('send_order_to_customer_email'),
                    'message' => lang_admin('site'),
                ),
                'email_order_send_admin' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('order_sending_administrator_mailbox'),
                    'message' => lang_admin('site'),
                ),
                'email_form_on' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('custom_form_sending_mail'),
                    'message' => lang_admin('site'),
                ),
                'email_form_send_admin' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('custom_form_sending_administrator_mailbox'),
                    'message' => lang_admin('site'),
                ),
                'email_reg_on' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('no'),1 => lang_admin('yes')),
                    'remarks' => lang_admin('registered_user_sends_mail'),
                    'message' => lang_admin('site'),
                ),
            ),
            "vote"=>array(
                'vote_onlyone' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('voting_can_only_be_done_once'),
                    'message' => lang_admin('site'),
                ),
                'vote_auto_sms' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'), 1=> lang_admin('open')),
                    'remarks' => lang_admin('publish_voting_and_send_SMS_automatically'),
                    'message' => lang_admin('site'),
                ),
            ),
            "verification"=>array(

            ),

            "template_user"=>array(
                'template_user_dir' => array(
                    'selecttype' => 'select',
                    'select' => front::$view->user_tpl_select(),
                    'remarks' => lang_admin('template_user_dir'),
                    'message' => lang_admin('site'),
                ),
                'template_admin_dir' => array(
                    'remarks' => lang_admin('template_admin_dir'),
                    'message' => lang_admin('site'),
                ),
            ),
            "template"=>array(
                'template_dir' => array(
                    'remarks' => lang_admin('template_dir'),
                    'message' => lang_admin('site'),
                ),
            ),
            "template_shop"=>array(
                'template_shopping_dir' => array(
                    'remarks' => lang_admin('template_shopping_dir'),
                    'message' => lang_admin('site'),
                ),
            ),
            "template_mobile"=>array(
                'template_mobile_dir' => array(
                    'remarks' => lang_admin('template_mobile_dir'),
                    'message' => lang_admin('site'),
                ),
            ),
            "xml"=>array(
                'xml_sitemap_auto' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('shut'),1 => lang_admin('open')),
                    'remarks' => lang_admin('automatic_generation'),
                    'message' => lang_admin('site'),
                ),
                'xml_sitemap_not1' => array(
                    'selecttype' => 'radio',
                    'select' => array(1 => ''),
                    'remarks' => lang_admin('filtering_is_not_displayed_in_the_first_level_column_of_navigation'),
                    'message' => lang_admin('site'),
                ),
                'xml_sitemap_not2' => array(
                    'selecttype' => 'radio',
                    'select' => array(1 => ''),
                    'remarks' => lang_admin('filter_external_modules'),
                    'message' => lang_admin('site'),
                ),
                'xml_sitemap_lang' => array(
                    'selecttype' => 'radio',
                    'select' => array(0=> lang_admin('current_language'),1 => lang_admin('all_languages')),
                    'remarks' => lang_admin('website_language_range'),
                    'message' => lang_admin('site'),
                ),
            ),
        );

        //提取安装扩展的config_form
        $apps_data=apps::getInstance()->getrows("installed=1",0);
        if (is_array($apps_data))
            foreach ($apps_data as $val){
                $myconfig_path=ROOT.'/apps/'.$val['id'].'/config/config_form.php';
                if(file_exists($myconfig_path)){
                    $myconfig_data=include  $myconfig_path;
                }
            }

        return $myconfig_data;
    }

    function gettitle_form()
    {
        $myconfig_gettitle_data=array(
            'site' => lang_admin("网站信息"),
            'websitesite' => lang_admin("网站自定义"),
            'information' => lang_admin("联系信息"),
            'langsite' => lang_admin("语言管理设置"),
            'filechecksite' => lang_admin("安全设置"),
            'phonesite' => lang_admin("手机版"),
            'dynamic' => lang_admin("动静态设置"),
            'spidersite' => lang_admin("蜘蛛统计设置"),
            'backupsite' => lang_admin("备份管理设置"),
            'customer' => lang_admin("客服列表"),
            'security' => lang_admin("字符过滤"),
            'user' => lang_admin("会员管理设置"),
            'comment' => lang_admin("评论管理设置"),
            'formsite' => lang_admin("表单管理设置"),
            'orders' => lang_admin("订单管理设置"),
            'guestbook' => lang_admin("留言设置"),
            'sitesetup' => lang_admin("站点设置"),
            'upload' => lang_admin("附件设置"),
            'ballot' => lang_admin("投票设置"),
            'ditu' => lang_admin("地图设置"),
            'vote' => lang_admin("投票设置"),
            'verification' => lang_admin("验证码"),
            'shopping' => lang_admin("商品设置"),
            'xml' => lang_admin("xml设置"),
        );
        $template_mode_data=array(
            'template' => lang_admin("template_manage"),
        );
        $template_mode_data['template_mobile']=lang_admin("手机模板");
        $template_mode_data['template_user']=lang_admin("其他模板");
        $template_mode_data['template_online']=lang_admin("在线模板");
        $template_mode_data['buymodules_online']=lang_admin("组件市场");
        $myconfig_gettitle_data[]=$template_mode_data;

        $myconfig_gettitle_data[]=array(
            'mail' => lang_admin("邮件设置"),
            'mail_socket' => lang_admin("SOCKET"),
            'mail_php' => lang_admin("PHP函数"),
            'mail_open' => lang_admin("开关设置"),
        );
        //提取安装扩展的config_title
        $apps_data=apps::getInstance()->getrows("installed=1",0);
        if (is_array($apps_data))
            foreach ($apps_data as $val){
                $myconfig_path=ROOT.'/apps/'.$val['id'].'/config/config_title.php';
                if(file_exists($myconfig_path)){
                    $myconfig_gettitle_data=include  $myconfig_path;
                }
            }

        return $myconfig_gettitle_data;
    }

    public static function set($name,$key)
    {
        //$where="name='".$name."' and (lang='all' or lang='".lang::getistemplate()."')";
        $where=array("name"=>$name,"lang"=>lang::getistemplate());
        myconfig::getInstance()->rec_update(array("key"=>$key),$where);
        $myconfig = self::getInstance();
        $myconfig->myconfig[lang::getistemplate()][$name]['key']=$key;
    }
    public static function setadmin($name,$key)
    {
        //$where="name='".$name."' and (lang='all' or lang='".lang::getisadmin()."')";
        $where=array("name"=>$name,"lang"=>lang::getisadmin());
        myconfig::getInstance()->rec_update(array("key"=>$key),$where);
        $myconfig = self::getInstance();
        $myconfig->myconfig[lang::getisadmin()][$name]['key']=$key;

    }
    public static function setall($name,$key)
    {
        myconfig::getInstance()->rec_update(array("key"=>$key),array("name"=>$name));
        $myconfig = self::getInstance();
        $myconfig->myconfig['all'][$name]['key']=$key;
    }

    public static function  getadmin($name){
        /* $myconfig_data=myconfig::getInstance()->getrow("name='".$name."' and lang='".lang::getisadmin()."'",'id desc','`name`,`key`');
         if (!is_array($myconfig_data)) {
             $myconfig_all_data = myconfig::getInstance()->getrow("name='" . $name . "' and lang='all'", 'id desc', '`name`,`key`');
             if (is_array($myconfig_all_data)) $myconfig_data = $myconfig_all_data;
         }*/
        $myconfig = self::getInstance();
        $myconfig_data=isset($myconfig->myconfig[lang::getisadmin()][$name])?$myconfig->myconfig[lang::getisadmin()][$name]:"";
        if (!is_array($myconfig_data)) {
            $myconfig_data=isset($myconfig->myconfig['all'][$name])?$myconfig->myconfig['all'][$name]:"";
        }
        if (is_array($myconfig_data)){
            if ("site_url"==$name){
                $domain=str_replace("https://","",$_SERVER['HTTP_HOST']);
                $domain=str_replace("http://","",$domain);
                if (substr($domain,-1)!="/"){
                    $domain=$domain.'/';
                }
                if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
                    $domain="https://".$domain;
                } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
                    $domain="https://".$domain;
                }else{
                    $domain="http://".$domain;
                }
                if(strpos($myconfig_data["key"],$domain) == false){
                    return $domain;
                }
            }
            elseif ("ditu_content"==$name){
                $myconfig_data['key']=str_replace(array("\r\n", "\r", "\n"), " ", $myconfig_data['key']);
            }
            return $myconfig_data['key'];
        }
        else
            return "";
    }
    public static function  get($name,$lang=null){
        if (!$lang){
            $lang=lang::getistemplate();
        }
        //内页幻灯片  --固定
        $arr = array(
            'cslide_width','cslide_height','cslide_number','cslide_time','cslide_style_position','cslide_text_color','cslide_input_bg',
            'cslide_input_color','cslide_btn_hover_color','cslide_btn_color','cslide_btn_width','cslide_btn_height','cslide_btn_shape',
            'cslide_button_size','cslide_button_color',
            'cslide_pic1','cslide_pic1_title','cslide_pic1_info','cslide_pic1_title_url','cslide_pic1_url',
            'cslide_pic2','cslide_pic2_title','cslide_pic2_info','cslide_pic2_title_url','cslide_pic2_url',
            'cslide_pic3','cslide_pic3_title','cslide_pic3_info','cslide_pic3_title_url','cslide_pic3_url',
            'cslide_pic4','cslide_pic4_title','cslide_pic4_info','cslide_pic4_title_url','cslide_pic4_url',
            'cslide_pic5','cslide_pic5_title','cslide_pic5_info','cslide_pic5_title_url','cslide_pic5_url',

        );
        //判断是否为特定字段  --图片字段
        if(in_array($name,$arr)){
            if ($name=="cslide_time"){
                $name="slide_time";
            }
            if ($name=="cslide_width"){
                $name="slide_width";
            }
            if ($name=="cslide_height"){
                $name="slide_height";
            }
            if ($name=="cslide_style_position"){
                $name="slide_style_position";
            }
            if ($name=="cslide_text_color"){
                $name="slide_text_color";
            }
            if ($name=="cslide_input_bg"){
                $name="slide_input_bg";
            }
            if ($name=="cslide_input_color"){
                $name="slide_input_color";
            }
            if ($name=="cslide_btn_hover_color"){
                $name="slide_btn_hover_color";
            }
            if ($name=="cslide_btn_color"){
                $name="slide_btn_color";
            }
            if ($name=="cslide_btn_width"){
                $name="slide_btn_width";
            }
            if ($name=="cslide_btn_height"){
                $name="slide_btn_height";
            }
            if ($name=="cslide_btn_shape"){
                $name="slide_btn_shape";
            }
            if ($name=="cslide_button_size"){
                $name="slide_button_size";
            }
            if ($name=="cslide_button_color"){
                $name="slide_button_color";
            }
            return self::getslide($name);
        }else{
            //判断是否为特定字段
            /* $myconfig_data=myconfig::getInstance()->getrow("name='".$name."' and lang='".lang::getistemplate()."'",'id desc','`name`,`key`');
             if (!is_array($myconfig_data)) {
                 $myconfig_all_data = myconfig::getInstance()->getrow("name='" . $name . "' and lang='all'", 'id desc', '`name`,`key`');
                 if (is_array($myconfig_all_data)) $myconfig_data = $myconfig_all_data;
             }*/
            $myconfig = self::getInstance();
            $myconfig_data=isset($myconfig->myconfig[$lang][$name])?$myconfig->myconfig[$lang][$name]:"";
            if (!is_array($myconfig_data)) {
                $myconfig_data=isset($myconfig->myconfig['all'][$name])?$myconfig->myconfig['all'][$name]:"";
            }
            if (is_array($myconfig_data)){
                if ("site_url"==$name){
                    $domain=str_replace("https://","",$_SERVER['HTTP_HOST']);
                    $domain=str_replace("http://","",$domain);
                    if (substr($domain,-1)!="/"){
                        $domain=$domain.'/';
                    }
                    if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
                        $domain="https://".$domain;
                    } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
                        $domain="https://".$domain;
                    }else{
                        $domain="http://".$domain;
                    }
                    if(strpos($myconfig_data["key"],$domain) == false){
                        return $domain;
                    }
                }
                elseif ("ditu_content"==$name){
                    $myconfig_data['key']=str_replace(array("\r\n", "\r", "\n"), " ", $myconfig_data['key']);
                }
                return $myconfig_data['key'];
            }
        }
        return false;
    }
    public static function  getslide($name){
        $slide=slide::getInstance()->getrow(array("name"=>"内页切换图片","isdefault"=>1));
        if (is_array($slide)){
            if (array_key_exists($name, $slide)){
                return $slide[$name];
            }else{
                $slidechild=slidechild::getInstance()->getrows('slide_sid='.$slide['id'],5,'id asc');
                if ($name=="cslide_number"){
                    return count($slidechild);
                }
                $pic1 = array('cslide_pic1','cslide_pic1_title','cslide_pic1_info','cslide_pic1_title_url','cslide_pic1_url');
                $pic2 = array('cslide_pic2','cslide_pic2_title','cslide_pic2_info','cslide_pic2_title_url','cslide_pic2_url');
                $pic3 = array('cslide_pic3','cslide_pic3_title','cslide_pic3_info','cslide_pic3_title_url','cslide_pic3_url');
                $pic4 = array('cslide_pic4','cslide_pic4_title','cslide_pic4_info','cslide_pic4_title_url','cslide_pic4_url');
                $pic5 = array('cslide_pic5','cslide_pic5_title','cslide_pic5_info','cslide_pic5_title_url','cslide_pic5_url');
                if(in_array($name,$pic1)){
                    return self::getslidechild($name,$slidechild[0]);
                }
                elseif(in_array($name,$pic2)){
                    return self::getslidechild($name,$slidechild[1]);
                }
                elseif(in_array($name,$pic3)){
                    return self::getslidechild($name,$slidechild[2]);
                }
                elseif(in_array($name,$pic4)){
                    return self::getslidechild($name,$slidechild[3]);
                }
                elseif(in_array($name,$pic5)){
                    return self::getslidechild($name,$slidechild[4]);
                }
                elseif($slidechild[$name]){
                    return $slidechild[$name];
                }else
                    return "";
            }

        }
    }
    public static function  getslidechild($name,$slidechild){
        $langurl=lang::getistemplate();
        $slide_title=unserialize($slidechild['slide_title']);
        $new_slide_key=is_array($slide_title)?$slide_title[$langurl]:$slidechild['slide_title'];

        $slide_subtitle=unserialize($slidechild['slide_subtitle']);
        $new_slide_subtitle=is_array($slide_subtitle)?$slide_subtitle[$langurl]:$slidechild['slide_subtitle'];

        $slide_butname=unserialize($slidechild['slide_butname']);
        $new_slide_butname=is_array($slide_butname)?$slide_butname[$langurl]:$slidechild['slide_butname'];

        $slide_url=unserialize($slidechild['slide_url']);
        $new_slide_url=is_array($slide_url)?$slide_url[$langurl]:$slidechild['slide_url'];
        if($name=="cslide_pic1_title" || $name=="cslide_pic2_title" || $name=="cslide_pic3_title"
            || $name=="cslide_pic4_title" || $name=="cslide_pic5_title"){
            return $new_slide_key;
        }
        elseif($name=="cslide_pic1_info" || $name=="cslide_pic2_info" || $name=="cslide_pic3_info"
            || $name=="cslide_pic4_info" || $name=="cslide_pic5_info"){
            return $new_slide_subtitle;
        }
        elseif($name=="cslide_pic1_title_url" || $name=="cslide_pic2_title_url" || $name=="cslide_pic3_title_url"
            || $name=="cslide_pic4_title_url" || $name=="cslide_pic5_title_url"){
            return $new_slide_butname;
        }
        elseif($name=="cslide_pic1_url" || $name=="cslide_pic2_url" || $name=="cslide_pic3_url"
            || $name=="cslide_pic4_url" || $name=="cslide_pic5_url"){
            return $new_slide_url;
        } elseif($name=="cslide_pic1" || $name=="cslide_pic2" || $name=="cslide_pic3"
            || $name=="cslide_pic4" || $name=="cslide_pic5"){
            return $slidechild['slide_path'];
        }else
            return "";

    }



    public static function  getdefault($name){
        /* $myconfig_data=myconfig::getInstance()->getrow("name='".$name."' and lang='".lang::getisdefault()."'",'id desc','`name`,`key`');
          if (!is_array($myconfig_data)){
              $myconfig_all_data=myconfig::getInstance()->getrow("name='".$name."' and lang='all'",'id desc','`name`,`key`');
              if (is_array($myconfig_all_data))$myconfig_data=$myconfig_all_data;
          }*/
        $myconfig = self::getInstance();
        $myconfig_data=isset($myconfig->myconfig[lang::getisdefault()][$name])?$myconfig->myconfig[lang::getisdefault()][$name]:"";
        if (!is_array($myconfig_data)) {
            $myconfig_data=$myconfig->myconfig['all'][$name];
        }
        if (is_array($myconfig_data)){
            if ("site_url"==$name){
                $domain=str_replace("https://","",$_SERVER['HTTP_HOST']);
                $domain=str_replace("http://","",$domain);
                if (substr($domain,-1)!="/"){
                    $domain=$domain.'/';
                }
                if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
                    $domain="https://".$domain;
                } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
                    $domain="https://".$domain;
                }else{
                    $domain="http://".$domain;
                }
                if(strpos($myconfig_data["key"],$domain) == false){
                    return $domain;
                }
            }
            return $myconfig_data['key'];
        }
        else
            return false;
    }

    static function modify_admin($var, $key = null, $value = null,$database=false)
    {
        //对数据库配置修改保存  修改数据库的配置文件
        if($database){
            config::modify($var,$key,$value,$database);
        }else{
            //配置文件中要统一的特定字段
            $arr = myconfig::getall();
            if (is_array($var)){
                foreach ($var as $key => $value) {
                    //判断是否为特定字段  是的话 修改全部语言的配置
                    if(in_array($key,$arr)){
                        myconfig::setall($key,$value);
                    }else{
                        myconfig::setadmin($key,$value);
                    }
                }
            }else {
                if (!$key || !$value)
                    return;
                //判断是否为特定字段  是的话 修改全部语言的配置
                if(in_array($key,$arr)){
                    myconfig::setall($key,$value);
                }else{
                    myconfig::setadmin($key,$value);
                }
            }
        }
    }
    static function modify($var, $key = null, $value = null,$database=false)
    {
        //对数据库配置修改保存  修改数据库的配置文件
        if($database){
            config::modify($var,$key,$value,$database);
        }
        else{
            //配置文件中要统一的特定字段
            $arr = myconfig::getall();
            if (is_array($var))
                foreach ($var as $key => $value) {
                    //判断是否为特定字段  是的话 修改全部语言的配置
                    if (in_array($key, $arr)) {
                        myconfig::setall($key,$value);
                    } else {
                        myconfig::set($key,$value);
                    }

                }
            else {
                if (!$key || !$value)
                    return;
                //判断是否为特定字段  是的话 修改全部语言的配置
                if (in_array($key, $arr)) {
                    myconfig::setall($key,$value);
                } else {
                    myconfig::set($key,$value);
                }
            }
        }

    }

    //发挥特定字段
    public static function  getall(){
        $all_data=array();
        $myconfig_data=myconfig::getInstance()->getrows(array("lang"=>"all"),0);
        if (is_array($myconfig_data)){
            foreach ($myconfig_data as $val){
                $all_data[]=$val['name'];
            }
        }
        return $all_data;
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) CmsEasy Co., Ltd. (https://www.CmsEasy.cn). All rights reserved.