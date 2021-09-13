<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta name="Generator" content="CmsEasy 7_7_5_20210905_UTF8" />
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo get('sitename'); ?>	-	<?php if($pass) { ?><?php echo lang_admin('fill_in_database_information');?><?php } else { ?><?php echo lang_admin('detecting_database_links');?><?php } ?></title>
    <link rel="shortcut icon" href="<?php echo $base_url;?>/favicon.ico" type="image/x-icon" />
    <!-- 调用样式表 -->
    <link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url;?>/common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery.min.js"></script>
    <style type="text/css">
        body {
            font-size:14px;
            line-height:180%;
            background:#EEEEEE;
            overflow-x:hidden;
        }
        a:link {
            text-decoration:none;
        }
        a:visited {
            text-decoration:none;
        }
        a:hover {
            text-decoration:none;
        }
        a:active {
            text-decoration:none;
        }
        * {
            outline: none;
        }
        :focus {
            outline:none;
        }
        .modal-backdrop {
            opacity: 0 !important;
            filter: alpha(opacity=0) !important;
        }
        .modal-backdrop {z-index: -1 !important;}
        .modal-content {box-shadow:none !important; border:none !important;}
        .modal-body {padding:0px !important;}
        .modal-dialog {width:100% !important;}
        .modal {position: relative;}
        .btn:focus,
        .btn:active:focus,
        .btn.active:focus,
        .btn.focus,
        .btn:active.focus,
        .btn.active.focus {
            outline: none;
            border-color: transparent;
            box-shadow:none;
        }
        .install {
            position: relative;
            left:0; right:0;
            z-index:999;
            width:588px;
            margin: 15px auto;
            max-width: 100%;
        }
        @media (max-width: 768px) {
            .install {
                width:100%;
            }
        }
        .version {float:right; font-size:8px;color:#888;padding-bottom: 10px;}
        .install-box {
            background-color: white;
            border: 1px solid #e5e5e5;
            border-radius: 2px;
            clear: both;
            background-color: #fff;
            box-shadow: 0 .126rem .26rem rgba(0,0,0,.066)!important;box-sizing: border-box;
            padding: 0px 25px 25px 25px;
        }
        .logo {
            text-align: center;
            margin: 50px 0px 5px 0px;
            padding-bottom:25px;
            border-bottom:1px solid #eee;
        }
        .logo img {width:188px;}
        .form-group label {position: relative;}
        .tips {
            color: #ccc;
            cursor:help
        }
        .tooltip {
            width:188px;
            text-align:left;
        }
        .install-content h3 {margin:15px 0px;padding:15px 0px;border-bottom:1px solid #eee;font-size: 150%;
            line-height: 150%;font-weight:500;}
        .form-control {border-radius: 2px;}
        .blank5, .blank10, .blank20,.blank30 { clear: both; height: 5px; }
        .blank10 { height: 10px; }
        .blank20 { height: 20px; }
        .blank30 { height: 30px; }
        .padding10 { padding: 10px; }
        .readpact {margin:15px;padding:15px 0px;border-top:1px solid #eee;}
        .readpact label a {color: #666; font-weight:normal; font-size:0.8rem;}
        .install-content .btn {background:#fff;border:1px solid #ccc;border-radius: 2px;}
        .install-content .btn-install {color: #fff;
            background-color: #06276a;
            border-color: #06276a;font-size: 1.385rem;
            height: 3.385rem;
            padding: 0 1.538rem;
            border-radius: 2px;
        }
        .install-content .btn-install:hover {opacity: 0.8;}
        .copy {font-size:0.8rem;color:#ccc;padding:10px 0px;text-align: center;}
        .copy a {color:#ccc;}
        .modal-content {border-radius: 2px !important;}
        .tooltip > p {text-align: left;}
        .tooltip-inner {
            text-align:left;
        }
    </style>
</head>
<body>
    <div class="install">
    <small class="version">V.<?php echo _VERCODE;?></small>
    <div class="install-box">
        <div class="logo">
            <a href="https://www.cmseasy.cn/" target="_blank"><img src="./images/logo.png"></a>
        </div>
        <div class="install-content">
            <form name="form1" id="form1" method="post" action="<?php echo uri();?>" >
                <input type="hidden" value="1" id="license_pass" name="license_pass"/>
                <?php
                $pass=true;
                if(PHP_VERSION<5)    $pass=false;
                if(!$mysql_pass)  $pass=false;
                if(!$mysqli)  $pass=false;
                if(isset($adminerror))  $pass=false;
                if($connerror){
                    ?>
                    <div class="blank30"></div>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <?php if(is_array($connerror))
foreach($connerror as $d) { ?>
                        <p><?php echo $d;?></p>
                        <?php } ?>
                    </div>
                <?php }; ?>
                <!-- 在线模板下载 -->
                <div class="modal fade" id="downModal" tabindex="-1" role="dialog" aria-labelledby="downModalLabel" data-backdrop="static" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p><?php echo lang_admin('file_size');?>：<span id="file-size">0</span> Bytes</p>
                                <!-- 进度条 -->
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                        <span id="imported-progress">0</span>%
                                    </div>
                                </div>
                                <p id="statusText"><?php echo lang_admin('download_don_t_refresh');?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="min-height:576px;">
                <!--数据库-->
                <div class="col-md-6 col-xs-12">
                <h3><?php echo lang_admin('mysql_settings');?></h3>
                <div class="form-group">
                    <label><?php echo lang_admin('database_address');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('database_address');?>！"></span></label>
                    <?php echo form::input('hostname',/*get('hostname') ? get('hostname'): */config::getdatabase('database','hostname'),$input_disable);?>
                </div>
                <div class="form-group">
                    <label><?php echo lang_admin('mysql_database_name');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('mysql_database_name');?>！"></span></label>
                    <?php echo form::input('database',/*front::post('database') ?front::post('database') : */config::getdatabase('database','database'),$input_disable);?>
                </div>
                <div class="form-group">
                    <label>MySQL<?php echo lang_admin('username');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="MySQL<?php echo lang_admin('username');?>！"></span></label>
                    <?php echo form::input('user',/*get('user') ?get('user'):*/config::getdatabase('database','user'),$input_disable);?>
                </div>
                <div class="form-group">
                    <label><?php echo lang_admin('mysql_password');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('mysql_password');?>！"></span></label>
                    <?php echo form::input('password',/*get('password') ? get('password') :*/config::getdatabase('database','password'),$input_disable);?>
                </div>
                <div class="form-group">
                    <label><?php echo lang_admin('table_prefix');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('recommended_use');?>&nbsp;&nbsp;cmseasy_"></span></label>
                    <?php echo form::input('prefix',config::getdatabase('database','prefix'),'placeholder="cmseasy_"');?>
                </div>
                <div class="clearfix"></div>
                <input type="submit" name="dosubmit" onclick="this.form.action='<?php echo url('install/index/step/3/test/1');?>';" class="btn" value=" <?php echo lang_admin('test_connection');?> " />
                </div>
                <!--管理员设置-->
                <div class="col-md-6 col-xs-12">
                    <h3><?php echo lang_admin('manage_account_settings');?></h3>
                    <div class="form-group">
                        <label><?php echo lang_admin('administrator');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('administrator');?>！"></span></label>
                        <?php echo form::input('admin_username',get('admin_username') ? get('admin_username'):'');?>
                    </div>
                    <div class="form-group">
                        <label><?php echo lang_admin('administrator_email');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('administrator_email');?>！"></span></label>
                        <input type="email" name="admin_email" class="form-control" id="exampleInputEmail1" value="">
                    </div>
                    <div class="form-group">
                        <label><?php echo lang_admin('administrator_password');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('administrator_password');?>！"></span></label>
                        <?php echo form::password('admin_password',get('admin_password') ?get('admin_password'): '');?>
                    </div>
                    <div class="form-group">
                        <label><?php echo lang_admin('duplicate_password');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('duplicate_password');?>！"></span></label>
                        <?php echo form::password('admin_password2',get('admin_password2') ? get('admin_password2') :'');?>
                    </div>
                    <!--选择模版-->
                    <div class="form-group">

                        <label><?php echo lang_admin('template_selection');?></label>
                        <div style="clear:both;height:5px;"></div>
                        <div class="form-inline" id="template_online_checkbox">
                        <input type="radio" value="1" name="template_thispc"   checked="" onclick="chk(this)">
                        &nbsp;&nbsp;本地模板 <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('系统包自带模板');?>！"></span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="radio" value="0" name="template_thispc" id="template_online" onclick="chk(this)">
                            &nbsp;&nbsp;在线获取 <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('从官网平台下载模板');?>！"></span></label>
                        </div>
<div id="templeat-select-online" style="display:none;">
                        <select name="pc_template_defulr" id="pc_template_defulr" class='form-control'>
                            <?php
                            if (is_array($defaurl_pc_template))
                                foreach ($defaurl_pc_template as $template_default_val){ ?>
                                    <option value="<?php echo $template_default_val['code'];?>"><?php echo $template_default_val['code'];?></option>
                                <?php };?>
                        </select>

                        <div style="clear:both;height:20px;"></div>
      <!--                   <select name="shop_template_defulr" id="shop_template_defulr" class='form-control'>
                                <?php
/*                                if (is_array($defaurl_shop_template))
                                    foreach ($defaurl_shop_template as $template_default_val){ */?>
                                        <option value="<?php echo $template_default_val['code'];?>"><?php echo $template_default_val['code'];?></option>
                                    <?php /*};*/?>
                            </select>-->
</div>
                        <script type="text/javascript">

                            $("#template_online_checkbox input").click(function () {
                                var $cr = $("#template_online");
                                if ($cr.is(":checked")) {
                                    $("#templeat-select-online").css("display", "block");
                                }
                                else {
                                    $("#templeat-select-online").css("display", "none");
                                }
                            });
                        </script>

                    </div>
                </div>
                </div>
                <!--初始数据-->
                <h5>
                    <input type="checkbox" value="1"  name="testdata" <?php if(front::$post['database'] && !front::$post['testdata']) { ?>
                    <?php } else { ?>
                    checked
                    <?php } ?> onclick="chk(this)" />&nbsp;&nbsp;<?php echo lang_admin('install_initial_data');?> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('推荐安装初始数据，方便学习熟悉使用！');?>！"></span></h5>
                <div class="clearfix"></div>
                <div id="initial-data">
                    <div class="row">
                        <div class="checkbox">
                            <label>
                                <?php echo form::checkbox('admin_lang_cn','cn',true);?>中文
                            </label>
                            <label>
                                <?php echo form::checkbox('admin_lang_en','en',true);?>English
                            </label>
                            <label>
                                <?php echo form::checkbox('admin_lang_sk','sk',true);?>한국어
                            </label>
                            <label>
                                <?php echo form::checkbox('admin_lang_jp','jp',true);?>日本語
                            </label>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function chk(obj){
                        if(obj.checked){
                            $("#initial-data").show();
                            $("#admin_lang_cn").attr("checked",true);
                            $("#admin_lang_en").attr("checked",true);
                            $("#admin_lang_sk").attr("checked",true);
                            $("#admin_lang_jp").attr("checked",true);
                        }else{
                            $("#initial-data").hide();
                            $("#admin_lang_cn").attr("checked",false);
                            $("#admin_lang_en").attr("checked",false);
                            $("#admin_lang_sk").attr("checked",false);
                            $("#admin_lang_jp").attr("checked",false);
                        }
                    }
                </script>
                    <div class="clearfix"></div>
                <div class="row">
                    <div class="readpact">
                        <input type="checkbox" value="1" id="readpact" name="license_pass" checked=""><label for="readpact">&nbsp;&nbsp;<a href="https://www.cmseasy.cn/license/" target="_blank" title="<?php echo lang_admin('view_the_license_agreement');?>"><?php echo lang_admin('i_have_read_and_agreed_to_this_agreement');?></a> <span class="tips icon-info" data-toggle="tooltip" data-placement="right" title="<?php echo lang_admin('点击查看使用协议！');?>！"></span></label>
                        <div class="clearfix"></div>
                        <input class="btn btn-install pull-right" type="button"
                               onclick="if(!document.getElementById('readpact').checked) {alert('<?php echo lang_admin('you_must_agree_to_the_software_license_agreement_to_install');?>！'); return false;}else{this.form.action='<?php echo $base_url;?>/index.php?case=install&amp;act=index&amp;step=3&amp;admin_dir=<?php echo get('admin_dir',true);?>&amp;site=default';dowm_pc_template_default();}"
                               value="<?php echo lang_admin('start_installation');?>">
                        <input class="btn btn-install pull-right" style="display: none;" id="install_dosubmit"  name="dosubmit" type="submit"   value="<?php echo lang_admin('start_installation');?>">
                    </div>
                </div>
                    <div class="blank30"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix copy"><?php echo getCopyRight();?></div>


<script language="javascript" type="text/javascript">
    function changebutton(){
        document.getElementById('installbutton').value="<?php echo lang_admin('installation_is_in_progress');?>";
    }
</script>
<script type="text/javascript">
    <!--
    //信息<?php echo lang_admin('tips');?>框
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    //-->
</script>
<script src="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/js/bootstrap.min.js"></script>


<script>
    function checkEmail(e_mail) {
        //对电子邮件的验证
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        return myreg.test(e_mail);
    }

    function dowm_pc_template_default() {

        if($("#admin_username").val().length==0){
            alert("<?php echo lang('please_enter_your_user_name');?>");
            $("#admin_username").focus();
            return false;
        }

        if($("#admin_password").val().length==0){
            alert("<?php echo lang('please_set_a_password');?>");
            $("#admin_password").focus();
            return false;
        }

        if(!checkEmail($("#exampleInputEmail1").val())){
            alert("<?php echo lang('please_enter_the_correct_mailbox');?>");
            $("#exampleInputEmail1").focus();
            return false;
        }

        if( $("#admin_password").val() !=  $("#admin_password2").val() ){
            alert("<?php echo lang('two_password_input_inconsistencies');?>");
            return false;
        }


        var template_pc_name = $("#pc_template_defulr").val();
        var template_thispc = $("[name=template_thispc]:checked").val();
        if (template_pc_name==""){
            alert("请选择pc模板！");
            return false;
        }
       /* var template_shop_name = $("#shop_template_defulr").val();
        if (template_shop_name==""){
            alert("请选择shop模板！");
            return false;
        }*/
        var template_shop_name="";
        //downloadFile(template_shop_name, false,"shop",template_pc_name,template_thispc);
        downloadFile(template_pc_name, false,"pc",template_pc_name,template_thispc);
    }

    function updateState(progress) {
        $('#statusText').html(progress);
        //$('.progress-bar').css('width', progress+'%').attr('aria-valuenow', progress);
    }
    function updateProgress(progress) {
        $('#imported-progress').html(progress);
        $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
    }
    //安装下载模板
    function downloadFile($f,isSql,template_type,template_pc_name,template_thispc) {
        var file_size = 0;
        var progress = 0;
        var filename = $f;
        /*if (template_type=="pc"){
            var isshoptemplate=false;
        }else{
            var isshoptemplate=true;
        }*/
        var isshoptemplate=false;
        console.log("Prepared to download");
        updateState("<?php echo lang_admin('start_downloading_template_files');?>");

        $('#downModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        var def = $.get("<?php echo url('install/down/action/prepare-download',true);?>", {'isshoptemplate':isshoptemplate,'template_thispc':template_thispc,'default_install': true,'f': filename, 'sql': isSql}, null, 'json');
        def.then(function (res) {
            console.log(res);
            file_size = res.file_size;
            $('#file-size').html(file_size);
            console.log("started downloading");
            updateState("<?php echo lang_admin('start_downloading_template_files');?>");


            url = "<?php echo url('install/down/action/start-download',true);?>";
            promise =  $.get(url,{'isshoptemplate':isshoptemplate,'template_thispc':template_thispc,'default_install': true,'f': filename, 'sql': isSql} ,null, 'json');

            var interval_id = window.setInterval(function () {
                $('#imported-progress').html(progress);
                $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
                if (progress >= 100) {
                    clearInterval(interval_id);
                    // 到此远程文件下载完成，继续其他逻辑
                    updateState("<?php echo lang_admin('download_successful_start_to_install_the_template');?>");
                    $.ajax({
                        url : "<?php echo url('install/down/action/exzip',true);?>",
                        data: {'isshoptemplate':isshoptemplate,'template_thispc':template_thispc,'default_install': true,'f': filename, 'sql': isSql},
                        dataType:'json',
                        type : 'GET'
                    }).done(function(res){
                        if(res['code'] === 0){
                            if (template_type=="shop"){
                                updateState("<?php echo lang_admin('installation_is_complete');?>,继续安装商城模板！");
                                downloadFile(template_pc_name, false,"pc",template_thispc);
                            }else{
                                $('#downModal').modal('hide');
                                $("#install_dosubmit").trigger('click');
                            }
                        }else{
                            updateState(res['msg']);
                            return false;
                        }
                    }).fail(showAjaxError);
                } else {
                    $.ajax({
                        url: "<?php echo url('install/down/action/get-file-size',true);?>",
                        data: {'isshoptemplate':isshoptemplate,'template_thispc':template_thispc,'default_install': true,'f': filename, 'sql': isSql},
                        dataType: 'json',
                        type: 'get'
                    }).done(function (json) {
                        //console.log("Progress: "+json);
                        //console.log("Progress: "+json.size);
                        //console.log("Progress: "+file_size);
                        progress = (json.size / file_size * 100).toFixed(2);
                        updateProgress(progress);
                        console.log("Progress: " + progress);
                    }).fail(showAjaxError);
                }
            }, 999);
            return promise;
        }, function (res) {
            updateState("<?php echo lang_admin('error_occurred');?>"+res.responseText);
            console.error(res);
        }).then(function (json) {
            // set progress to 100 when got the response
            progress = 100;
            console.log("<?php echo lang_admin('download_completed');?>");
            console.log(json);
        }, function (res) {
            updateState("<?php echo lang_admin('preparing');?>"+res.responseText);
            console.error(res);
        });
        return false;

        $.ajax({
            url: './download.php?action=prepare-download&f=' + f,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                var mesg="<?php echo lang_admin('preparing');?>";
                var data='<i class="fa fa-spinner fa-spin"></i> '+mesg;
                $('#update-button').html(data).prop('disabled', 'disabled');
            },
        })
            .done(function (json) {
                console.log(json);

                file_size = json.file_size;

                $('#file-size').html(file_size);

                // 显示进度条

                console.log("started downloading");
                $.ajax({
                    url: './download.php?action=start-download&f=' + f,
                    type: 'GET',
                    //timeout : 1000, //超时时间设置，单位毫秒
                    dataType: 'json'
                }).done(function (json) {
                    // set progress to 100 when got the response
                    progress = 100;

                    console.log("Downloading finished");
                    console.log(json);
                }).fail(showAjaxError);

                var interval_id = window.setInterval(function () {

                    $('#imported-progress').html(progress);
                    $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);

                    if (progress >= 100) {
                        clearInterval(interval_id);

                        // 到此远程文件下载完成，继续其他逻辑
                        updateState("<?php echo lang_admin('start_extracting_files');?>");
                        $.ajax({
                            url: 'download.php?action=exzip&f=' + f,
                            dataType: 'json',
                            type: 'GET'
                        }).done(function (json) {
                            if (json.rs == 'ok') {
                                updateState("<?php echo lang_admin('installation_is_complete');?>");
                                $('#downModal').modal('hide');
                            } else {
                                updateState(rs);
                            }
                        }).fail(showAjaxError);
                    } else {
                        $.ajax({
                            url: './download.php?action=get-file-size&f=' + f,
                            dataType: 'json',
                            type: 'GET'
                        })
                            .done(function (json) {
                                //console.log("Progress: "+json);
                                //console.log("Progress: "+json.size);
                                //console.log("Progress: "+file_size);
                                progress = (json.size / file_size * 100).toFixed(2);

                                updateProgress(progress);

                                console.log("Progress: " + progress);
                            })
                            .fail(showAjaxError);
                    }

                }, 999);

            }).fail(showAjaxError);

        return false;
    }
</script>

</body>
</html>
