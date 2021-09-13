<?php defined('ROOT') or exit('Can\'t Access !'); ?>

<?php echo  getuserhistory('index');?>
<style type="text/css">
    .main .main-right-box {min-height:10px;}
    .main-right-box ul {padding:0px 10px;}
    .main-right-box ul li {
        line-height:38px;
    }
    .quick-nav {padding:0px 5px 16px 5px;}
    .quick-nav div,.quick-navb div  {box-sizing:border-box; padding:0px;}
    .quick-navb {padding:0px 5px;margin-bottom:15px;}

    .list-group-item { margin:0px 10px 10px 10px; padding:25px 30px 20px 30px; -moz-box-shadow:0px 8px 15px #eee; height:150px; overflow:hidden;
        -webkit-box-shadow:0px 8px 15px #eee;
        box-shadow:0px 8px 15px #eee;border:none;color:#fff;text-align:right; font-size:14px;}
    a.list-group-item-b {background:#eee; padding:15px 30px; border:1px solid #ccc; text-align:center;}

    .main-right-box {margin:0px;border-radius: 8px;}
    .list-group-item span {display:block; width:50px; height:50px; font-size:26px;float:left;color:#424950; background:#eee;padding:12px;border-radius:50%;}
    .list-group-item strong {display:block; font-size:28px; line-height:38px; }
    .list-group-item:last-child {border-radius:8px; }
    .list-group-item-b:last-child {border-radius:2px; }
    a.list-group-item:hover,.glyphicon-list-alt {background:#424950;color:#fff;-moz-box-shadow:0px 8px 15px #aaa;
        -webkit-box-shadow:0px 8px 15px #aaa;
        box-shadow:0px 8px 15px #aaa;-o-transition: all 0.15s, 0.15s;
        -moz-transition: all 0.15s, 0.15s;
        -webkit-transition: all 0.15s, 0.15s;}

    .i_table_a,.i_table_b,.i_table_c {font-size:14px;}
    @media(max-width:468px) {
        a.list-group-item-success,a.list-group-item-danger {
            margin-top:10px;
        }
        .system-info,.i_table_b,.information {display:none;}
    }
    .main-right-box h5 {margin: 0px 0px 30px -2px;}
    #information {min-height:336px;}
    .table {margin:0px;}
    .website-a {font-weight:bold;padding:0px 10px 0px 0px;}
    .i_links_bg {line-height:200%; height:225px;padding:15px 20px;}
    .i_table_b ul {min-height:293px ;padding:8px 20px;}
    .i_table_b ul li {clear:both; margin:0px 0px 15px 0px;background:#f5f5f5;}
    .i_table_b strong {width:100px;  display:block;float:left; padding:0px 10px; background: #eee;color: #424950;  text-align:center;}
    input.btn-primary, a.btn-primary {padding:5px 25px; }
    .blank25 {clear:both; height:25px;}

    #information p {background:#f5f5f5;padding:0px 15px;}

    @media(max-width:1748px) {
        .quick-nav .col-lg-3 {padding:0px;}
    }

    @media(max-width:1580px) {
        .quick-nav .col-lg-3 {padding:0px;}
    }

    @media(max-width:1420px) {
        .quick-nav .col-lg-3 {padding:0px;}
    }

    @media(max-width:1340px) {
        .quick-nav .col-lg-3 {padding:0px;}
        .list-group-item {text-align:center;}
        .i_table_b .main-right-box {min-height:450px;}
    }

    @media(max-width:1260px) {
        .quick-nav .col-lg-3 {margin-bottom:20px;}
    }

    @media(min-width:1200px) {
        .i_table_a,.i_table_d {padding-right:25px;}
        .i_table_b,.i_table_c {padding-left:25px;}
        .i_table_c, .i_table_a {margin:20px 0px;}
    }
    @media(max-width:1200px) {
        .i_table_a {margin:20px 0px;}
        .i_table_a,.i_table_c {width:100%;}
    }

    @media(max-width:992px) {
        .i_table_c {margin:0px;}
    }

    @media(max-width:768px) {
        .i_table_d {margin-bottom:0px;}
    }

    .i_table_a .alert {box-shadow:none; background:#f5f5f5;  border-radius: 0px; border:none; color:#333;}
    .i_table_a .alert a {color:#333;}
    .index-box .main-right-box {min-height:auto;}



    .index-steps > .steps {
        position: relative;
        display: block;
        width: 100%; }
    .index-steps > .steps .current-info {
        position: absolute;
        left: -99999px; }
    .index-steps > .steps > ul {
        display: table;
        width: 100%;
        table-layout: fixed;
        margin: 0;
        padding: 0;
        list-style: none; }
    .index-steps > .steps > ul > li {
        display: table-cell;
        width: auto;
        vertical-align: top;
        text-align: center;
        position: relative;
        cursor:pointer
    }
    .index-steps > .steps > ul > li a {
        position: relative;
        padding-top: 92px;
        margin-top: 20px;
        margin-bottom: 20px;
        display: block; cursor:pointer }
    .index-steps > .steps > ul > li:before {
        content: '';
        display: block;
        position: absolute;
        z-index: 2;
        left: 0; }
    .index-steps > .steps > ul > li:after {
        content: '';
        display: block;
        position: absolute;
        z-index: 2;
        right: 0; }
    .index-steps > .steps > ul > li:first-child:before {
        content: none; }
    .index-steps > .steps > ul > li:last-child:after {
        content: none; }
    .index-steps > .steps > ul > li.current > a {
        color: #999;
        cursor: pointer; }
    .index-steps > .steps > ul > li.current > a:hover {color: #00B5B8;}
    .index-steps > .steps > ul > li.current .step {
        border-color: #00B5B8;
        background-color: #fff;
        color: #00B5B8; }
    .index-steps > .steps > ul > li.disabled a {
        color: #999999;
    }
    .index-steps > .steps > ul > li.disabled a:hover {
        color: #00B5B8;
        cursor: pointer; }
    .index-steps > .steps > ul > li.disabled a:focus {
        color: #999999;
        cursor: pointer; }
    .index-steps > .steps > ul > li.done a {
        color: #999999; }
    .index-steps > .steps > ul > li.done a:hover {
        color: #999999; }
    .index-steps > .steps > ul > li.done a:focus {
        color: #999999; }
    .index-steps > .steps > ul > li.done .step {
        background-color: #00B5B8;
        border-color: #00B5B8;
        color: #fff; }
    .index-steps > .steps > ul > li.error .step {
        border-color: #FF7588;
        color: #FF7588; }
    .index-steps > .steps .step {
        background-color: #fff;
        display: inline-block;
        position: absolute;
        top: 0;
        left: 0px;
        right:0px;
        z-index: 3;
        text-align: center; }
    @media (min-width:768px) and (max-width:1002px) {
        .index-steps > .steps .step {left: 26%; }
    }
    .index-steps > .content {
        position: relative;
        width: auto;
        padding: 0;
        margin: 0; }
    .index-steps > .content > .title {
        position: absolute;
        left: -99999px; }
    .index-steps > .content > .body {
        padding: 0 20px; }
    .index-steps > .content > iframe {
        border: 0 none;
        width: 100%;
        height: 100%; }
    .index-steps > .actions {
        position: relative;
        display: block;
        text-align: right;
        padding: 20px;
        padding-top: 0; }
    .index-steps > .actions > ul {
        float: right;
        list-style: none;
        padding: 0;
        margin: 0; }
    .index-steps > .actions > ul:after {
        content: '';
        display: table;
        clear: both; }
    .index-steps > .actions > ul > li {
        float: left; }
    .index-steps > .actions > ul > li + li {
        margin-left: 10px; }
    .index-steps > .actions > ul > li > a {
        background: #00B5B8;
        color: #fff;
        display: block;
        padding: 7px 12px;
        border-radius: 2px;
        border: 1px solid transparent; }
    .index-steps > .actions > ul > li > a:hover {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.05) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.05) inset; }
    .index-steps > .actions > ul > li > a:focus {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.05) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.05) inset; }
    .index-steps > .actions > ul > li > a:active {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.1) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.1) inset; }
    .index-steps > .actions > ul > li > a[href="#previous"] {
        background-color: #FF8D60;
        color: #FFF;
    }
    .index-steps > .actions > ul > li > a[href="#previous"]:hover {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.02) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.02) inset; }
    .index-steps > .actions > ul > li > a[href="#previous"]:focus {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.02) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.02) inset; }
    .index-steps > .actions > ul > li > a[href="#previous"]:active {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.04) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, 0.04) inset; }
    .index-steps > .actions > ul > li.disabled > a {
        color: #FFF; }
    .index-steps > .actions > ul > li.disabled > a:hover {
        color: #FFF; }
    .index-steps > .actions > ul > li.disabled > a:focus {
        color: #FFF; }
    .index-steps > .actions > ul > li.disabled > a[href="#previous"] {
        -webkit-box-shadow: none;
        box-shadow: none; }
    .index-steps > .actions > ul > li.disabled > a[href="#previous"]:hover {
        -webkit-box-shadow: none;
        box-shadow: none; }
    .index-steps > .actions > ul > li.disabled > a[href="#previous"]:focus {
        -webkit-box-shadow: none;
        box-shadow: none; }
    .index-steps.index-steps-circle > .steps > ul > li:before,  .index-steps.index-steps-circle > .steps > ul > li:after {
        top: 63px;
        width: 50%;
        height: 5px;
        background-color: #00B5B8; }
    .index-steps.index-steps-circle > .steps > ul > li.current:after {
        background-color: #F5F7FA; }
    .index-steps.index-steps-circle > .steps > ul > li.current ~ li:before {
        background-color: #F5F7FA; }
    .index-steps.index-steps-circle > .steps > ul > li.current ~ li:after {
        background-color: #F5F7FA; }
    .index-steps.index-steps-circle > .steps .step {
        width: 88px;
        height: 88px;
        line-height: 88px;
        margin:0px auto;
        border: 5px solid #F5F7FA;
        font-size: 2.8rem;
        border-radius: 50%;
    }

    .index-steps.index-steps-circle > .steps .step i {display:inline-block; margin-top:18px;}
    .index-steps.index-steps-circle > .steps .step:hover { background:#00B5B8;
        box-shadow: 0 6px 0 0 rgba(0, 0, 0, 0.05), 0 15px 32px 0 rgba(0, 0, 0, 0.09);
        border: 5px solid #F5F7FA;
    }
    .index-steps.index-steps-circle > .steps .step:hover i {color:#fff;}

    .index-steps.index-steps-notification > .steps > ul > li:before,  .index-steps.index-steps-notification > .steps > ul > li:after {
        top: 39px;
        width: 50%;
        height: 2px;
        background-color: #00B5B8; }
    .index-steps.index-steps-notification > .steps > ul > li.current .step {
        border: 2px solid #00B5B8;
        color: #00B5B8;
        line-height: 36px; }
    .index-steps.index-steps-notification > .steps > ul > li.current .step:after {
        border-top-color: #00B5B8; }
    .index-steps.index-steps-notification > .steps > ul > li.current:after {
        background-color: #F5F7FA; }
    .index-steps.index-steps-notification > .steps > ul > li.current ~ li:before {
        background-color: #F5F7FA; }
    .index-steps.index-steps-notification > .steps > ul > li.current ~ li:after {
        background-color: #F5F7FA; }
    .index-steps.index-steps-notification > .steps > ul > li.done .step {
        color: #FFF; }
    .index-steps.index-steps-notification > .steps > ul > li.done .step:after {
        border-top-color: #00B5B8; }
    .index-steps.index-steps-notification > .steps .step {
        width: 40px;
        height: 40px;
        line-height: 40px;
        font-size: 1.3rem;
        border-radius: 15%;
        background-color: #F5F7FA; }
    .index-steps.index-steps-notification > .steps .step:after {
        content: "";
        width: 0;
        height: 0;
        position: absolute;
        bottom: 0;
        left: 50%;
        margin-left: -8px;
        margin-bottom: -8px;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 8px solid #F5F7FA; }
    .index-steps.vertical > .steps {
        display: inline;
        float: left;
        width: 10%; }
    .index-steps.vertical > .steps > ul > li {
        display: block;
        width: 100%; }
    .index-steps.vertical > .steps > ul > li:before,  .index-steps.vertical > .steps > ul > li:after {
        background-color: transparent; }
    .index-steps.vertical > .steps > ul > li.current:before,  .index-steps.vertical > .steps > ul > li.current:after {
        background-color: transparent; }
    .index-steps.vertical > .steps > ul > li.current ~ li:before {
        background-color: transparent; }
    .index-steps.vertical > .steps > ul > li.current ~ li:after {
        background-color: transparent; }

    @media (max-width: 768px) {
        .index-steps > .steps > ul {
            margin-bottom: 20px; }
        .index-steps > .steps > ul > li {
            display: block;
            float: left;
            width: 50%; }
        .index-steps > .steps > ul > li > a {
            margin-bottom: 0; }
        .index-steps > .steps > ul > li:first-child:before {
            content: ''; }
        .index-steps > .steps > ul > li:last-child:after {
            content: '';
            background-color: #00B5B8; }
        .index-steps.vertical > .steps {
            width: 15%; } }

    @media (max-width: 480px) {
        .index-steps > .steps > ul > li {
            width: 100%; }
        .index-steps > .steps > ul > li.current:after {
            background-color: #00B5B8; }
        .index-steps.vertical > .steps {
            width: 20%; } }
    #myModal-license .modal-dialog {height:100vh;}
    #myModal-license .modal-content {
        width:888px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        margin-top:0px;
    }

</style>
<!--流程指引-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 steps index-box" style="padding:0px;">
    <div class="main-right-box" style="border-radius: 8px 0px 8px 8px;">
        <h5><?php echo lang_admin('process_guidance');?></h5>
        <div class="box" id="box">
            <div class="index-steps">
                <div class="icons-tab-steps index-steps-circle index-steps clearfix" id="steps-uid-0">
                    <div class="steps clearfix">
                        <ul role="tablist">
                            <li role="tab" class="first current" aria-disabled="false" aria-selected="true">
                                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=config&act=system&set=site&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="step1"  data-dataurlname="<?php echo lang_admin('essential_information');?>">
                                    <span class="step">
                                        <i class="icon-settings"></i>
                                    </span>
                                    <?php echo lang_admin('essential_information');?>
                                </a>
                            </li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=category&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('configuration_column');?>"><span class="step"><i class="icon-equalizer"></i></span> <?php echo lang_admin('configuration_column');?></a></li>
                            <li role="tab" class="disabled" aria-disabled="true"><a  href="#" onclick="gotourl(this)" data-dataurl="<?php echo url::create('table/add/table/archive');?>" data-dataurlname="<?php echo lang_admin('adding_content');?>"><span class="step"><i class="icon-note"></i></span> <?php echo lang_admin('adding_content');?></a></li>
                            <?php if ($isvisual){ ?>
                                <li role="tab" class="disabled last" aria-disabled="true"><a  href="<?php echo $base_url;?>/index.php?case=template&act=visual&admin_dir=<?php echo get('admin_dir',true);?>&site=default"  target="_blank"><span class="step"><i class="icon-screen-desktop"></i></span> <?php echo lang_admin('debugging_template');?></a></li>
                            <?php }else{ ?>
                                <li role="tab" class="disabled last" aria-disabled="true"><a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=templatetag&tagfrom=content&admin_dir=<?php echo get('admin_dir',true);?>&site=default"  ><span class="step"><i class="icon-screen-desktop"></i></span> <?php echo lang_admin('debugging_template');?></a></li>
                            <?php }; ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="blank20"></div>

<!--数量同级-->
<div class="index-2">
    <div class="row">

        <div class="quick-navb">

            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <a title="<?php echo lang_admin('column_manage');?>" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=category&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="list-group-item" data-dataurlname="<?php echo lang_admin('column_manage');?>">
                    <span class="icon-list"></span>
                    <p>
                        <strong>
                            <?php echo $categorynum;?>
                        </strong>
                        <?php echo lang_admin('column');?>
                    </p>
                </a>
            </div>

            <?php   if(file_exists(ROOT."/lib/table/shopping.php") && session::get('ver') == 'corp') {?>


                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                    <a title="<?php echo lang_admin('see');?>" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=archive&shopping=1&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="list-group-item" data-dataurlname="<?php echo lang_admin('shopping_manage');?>">
                        <span class="icon-basket-loaded"></span>
                        <p>
                            <strong>
                                <?php echo $shoppingnum;?>
                            </strong>
                            <?php echo lang_admin('shopping');?>
                        </p>
                    </a>
                </div>
            <?php } else { ?>
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                    <a title="<?php echo lang_admin('see');?>" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url::create('table/list/table/announcement');?>" class="list-group-item" data-dataurlname="<?php echo lang_admin('announcement');?>">
                        <span class="icon-basket-loaded"></span>
                        <p>
                            <strong>
                                <?php echo $announcementnum;?>
                            </strong>
                            <?php echo lang_admin('announcement');?>
                        </p>
                    </a>
                </div>

            <?php } ?>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <a title="<?php echo lang_admin('see');?>" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=archive&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="list-group-item" data-dataurlname="<?php echo lang_admin('content_manage');?>">
                    <span class="icon-doc"></span>
                    <p>
                        <strong>
                            <?php echo $archivenum;?>
                        </strong>
                        <?php echo lang_admin('content');?>
                    </p>
                </a>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <a title="<?php echo lang_admin('see');?>" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=list&table=comment&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="list-group-item" data-dataurlname="<?php echo $commentnum;?>">
                    <span class="icon-bubble"></span>
                    <p>
                        <strong>
                            <?php echo $commentnum;?>
                        </strong>
                        <?php echo lang_admin('comment');?>
                    </p>
                </a>
            </div>

        </div>
    </div>
</div>



<?php if(session::get('ver') != 'corp'){ ?>
    <div class="clearfix"></div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 index-box i_table_a">
        <div class="row">
            <div class="main-right-box">
                <h5><?php echo lang_admin('tips');?></h5>
                <div class="box" id="box">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                        </button>
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        <strong>
                            <?php echo lang_admin('welcome_to_cmseasy');?>
                        </strong>
                        <?php echo lang_admin('easy_to_pass_the_enterprise_website_system_through_the_background_system_you_can_easily_manage_the_website_content');?>
                        <div class="blank5"></div>
                        <?php echo lang_admin('while_thanking_you_for_your_use_we_have_prepared_more_than_100_sets_of_free_website_templates_for_users_to_choose_to_use_click_on_the_template_in_the_left_navigation');?>	&rarr;	[	<a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=template&act=downlist&admin_dir=<?php echo get('admin_dir',true);?>&site=default"><?php echo lang_admin('more_templates');?></a>	]	<?php echo lang_admin('choose');?>
                    </div>
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                        </button>
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        <?php echo lang_admin('tips');?>
                        <strong>CmsEasy</strong>
                        <?php echo lang_admin('using_baidu_free_cloud_to_speed_up_cdn_not_only_improves_access_speed_but_also_avoids_some_common_attacks_register_address');?><a href="#" onclick="gotourl(this)"   data-dataurl="https://su.baidu.com/" target="_blank">https://su.baidu.com/</a>
                    </div>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                        </button>
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        <strong><?php echo lang_admin('welcome_to_cmseasy');?></strong>
                        <?php echo lang_admin('learning_address_with_operational_quick_start_manual');?><a href="#" onclick="gotourl(this)"   data-dataurl="https://www.cmseasy.cn/chm/quick/" target="_blank">https://www.cmseasy.cn/chm/quick/</a>
                    </div>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                        <span class="glyphicon glyphicon-warning-sign"></span>	 <?php echo lang_admin('tips');?>	<strong><?php echo lang_admin('software_company');?></strong> <?php echo lang_admin('recommended_operations_course_for_web_site_security_settings');?><a href="#" onclick="gotourl(this)"   data-dataurl="https://www.cmseasy.cn/chm/quick/web-security.html" target="_blank">https://www.cmseasy.cn/chm/quick/web-security.html</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 index-box i_table_c">
        <div class="row">
            <div class="main-right-box">
                <h5><?php echo lang_admin('official_announcement');?></h5>
                <div class="box" id="box">
                    <ul id="information">
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $.get('./lib/tool/getinf.php?type=officialinf', function (data) {
                $("#information").append(data);
            });
        });

        $(function(){
            var heightLeft= $(".i_table_a .main-right-box").height();
            var heightRight= $(".i_table_c .main-right-box").height();
            if (heightLeft > heightRight)
            {
                $(".i_table_c .main-right-box").height(heightLeft);
            }
            else
            {
                $(".i_table_a .main-right-box").height(heightRight);
            }
        })
    </script>

    <div class="clearfix"></div>
<?php } else { ?>
<?php   if(file_exists(ROOT."/lib/table/shopping.php")  && session::get('ver') == 'corp') {?>
        <div class="blank20"></div>
    <!--图标订单-->
    <div class="index-2">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 index-box i_table_d">
            <div class="row">
                <div class="main-right-box">
                    <h5><?php echo lang_admin('weekly_sales_statistics');?></h5>
                    <div class="box" id="box">
                        <div id="line" style="width:100%;height:370px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blank20 visible-md-block"></div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6  index-box i_table_b">
            <div class="row">
                <div class="main-right-box" style="margin:0px;">
                    <h5><?php echo lang_admin('new_orders');?></h5>
                    <div class="box" id="box">
                        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="catname"><!--oid--><?php echo lang_admin('order_number');?></th>
                                        <th class="catname"><!--pname--><?php echo lang_admin('account_name');?></th>
                                        <th class="catname"><!--pname--><?php echo lang_admin('tel');?></th>
                                        <th class="catname"><!--pname--><?php echo lang_admin('order_time');?></th>
                                        <th class="manage"><?php echo lang_admin('dosomething');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($ordersdata))
                                        foreach($ordersdata as $d) { ?>
                                            <tr>
                                                <td class="catname"><?php echo $d['oid'];?></td>
                                                <td class="catname" align="left"><?php if($d['mid']==0){echo lang_admin('tourist');}else{ ?><?php echo getusername($d['mid']);?><?php } ?></td>
                                                <td class="catname" align="left"><?php echo $d['telphone'];?></td>
                                                <td class="htmldir"><?php echo date('Y-m-d H:i:s',$d['adddate']);?></td>
                                                <td>
                                                    <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url("table/edit/table/orders/id/".$d['id']);?>" title="<?php echo lang_admin('handle');?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blank20"></div>
    <script type="text/javascript" src="<?php echo $base_url;?>/common/plugins/echarts/echarts.min.js"></script>
    <script type="text/javascript">
        <!--
        // JavaScript Document
        // echarts
        // create for AgnesXu at 20161115

        //折线图
        var line = echarts.init(document.getElementById('line'));
        line.setOption({
            color:["#32d2c9"],
            title: {
                x: 'left',
                textStyle: {
                    fontSize: '18',
                    color: '#4c4c4c',
                    fontWeight: 'bolder'
                }
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                show: true,
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    dataView: {readOnly: false},
                    magicType: {type: ['line', 'bar']}
                }
            },
            xAxis:  {
                type: 'category',
                boundaryGap: false,
                data: getweekeddata(),
                axisLabel: {
                    interval:0
                }
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:"<?php echo lang_admin('sales_volume');?>",
                    type:'line',
                    data:[<?php echo $thisdaynum;?>],
                    markLine: {data: [{type: 'average', name: "<?php echo lang_admin('average_value');?>"}]}
                }
            ]
        }) ;

        //获取本周日期
        function getweekeddata(){
            var data=[];
            data.push(getBeforeDate(-6));
            data.push(getBeforeDate(-5));
            data.push(getBeforeDate(-4));
            data.push(getBeforeDate(-3));
            data.push(getBeforeDate(-2));
            data.push(getBeforeDate(-1));
            data.push(getBeforeDate(0));
            return data;
        }
        //获取日期
        function getBeforeDate(n){//n为你要传入的参数，当前为0，前一天为-1，后一天为1
            var date = new Date() ;
            var year,month,day ;
            date.setDate(date.getDate()+n);
            year = date.getFullYear();
            month = date.getMonth()+1;
            day = date.getDate() ;
            s = year + '-' + ( month < 10 ? ( '0' + month ) : month ) + '-' + ( day < 10 ? ( '0' + day ) : day) ;
            return s ;
        }
        //-->
    </script>
<?php } ?>
<?php } ?>
<?php if (!myconfig::getadmin("agreement")){?>

    <!--使用协议-->
    <div class="modal fade bs-example-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myModal-license" id="myModal-license" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"><?php echo lang_admin('view_the_license_agreement');?></h4>
                </div>
                <div class="modal-body" style="max-height: 300px;">
                    <?php echo template_admin('index/license.php'); ?>
                </div>
                <div class="modal-footer">
                    <input type="checkbox"  name="license_pass" checked=""><label for="readpact"></label>&nbsp;
                    <button type="button" class="btn btn-default" id="config_agreement"><?php echo lang_admin('i_have_read_and_agreed_to_this_agreement');?></button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang_admin('disagree');?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script type="text/javascript">
        $(function(){
            $('#myModal-license').modal('show');
            $('#config_agreement').click(function(){
                if(!$('[name=license_pass]').is(':checked')) {
                    alert("<?php echo lang_admin("agreement_ty");?>");
                    return;
                }
                //加载栏目下拉
                var setagreement_url='<?php echo url("config/setagreement");?>';
                $.ajax({
                    type: "get",
                    url: setagreement_url,
                    async: true,
                    success: function (data) {
                        $('#myModal-license').modal('hide');
                    }
                });
            });
        });
    </script>
<?php }?>



