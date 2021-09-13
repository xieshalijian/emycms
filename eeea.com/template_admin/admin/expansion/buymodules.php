
<style type="text/css">
    .glyphicon-retweet {color: rgba(0, 0, 0, 0.45);}
    .checkbox+.checkbox, .radio+.radio {
        margin-top: 10px;
    }
    .iscorp { position: absolute; top:-5px; right:10px; font-size:12px; background:#ff4961; z-index: 2;}
    #downModal .modal-body {
        height:auto;
    }
    .modal-dialog {
        position: absolute !important;
        left:50% !important;
        top:50% !important;
        bottom:auto !important;
        transform: translate(-50%,-50%) !important;
        margin:0px !important;
        height:auto !important;
        box-shadow: 0px 10px 15px 3px #393939;
        border-top:3px solid #222;
    }
    .modal .modal-content {
        margin-top: auto !important;
    }
    .enlargeImg_wrapper img {max-width:60%;}
</style>

<?php if($returndata['static']) { ?>
<?php } else {  ?>
    <style>
        .fade {
            opacity: 1;
        }</style>
    <script>
        $('#myDownloadfileModal').modal('show')
    </script>
<?php } ?>

<div class="main-right-box">
    <h5>
        <?php echo lang_admin('buymodules_online');?>
        <span class="pull-right">

     <?php if($returndata['static']) { ?>
         <?php echo $returndata['userdata']['username'];?> | <span style="color:#ff9149">￥<?php echo $returndata['userdata']['menoy'];?></span> |
            <a class="btn btn-success"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('app/close/buymodules/1',true);?>" ><?php echo lang_admin('sign_out');?></a>
         <a class="btn btn-default"  href="javascript:void(0);" name="buy_usermenoy" ><?php echo lang_admin('recharge');?></a>
         <a class="btn btn-default" href="https://u.cmseasy.cn/index.php?case=user&act=index" target="_blank">
                <i class="icon-user"></i> <?php echo lang_admin('service_centre');?>
            </a>

     <?php } else {   ?>
         <a class="btn btn-success" data-toggle="modal" data-target="#myDownloadfileModal" href="#" ><?php echo lang_admin('login');?></a>
         <a class="btn btn-default"  href="https://u.cmseasy.cn/index.php?case=user&act=register" ><?php echo lang_admin('register');?></a>
     <?php } ?>


            </span>
    </h5>


    <?php
    $patha = ROOT .'/'. 'data/buymodules';
    $pathb = ROOT .'/' . 'data/buymodules/announ';
    $pathc = ROOT .'/' . 'data/buymodules/category';
    $pathd = ROOT .'/' . 'data/buymodules/comment';
    $pathe = ROOT .'/' . 'data/buymodules/common';
    $pathf = ROOT .'/' . 'data/buymodules/content';
    $pathg = ROOT .'/' . 'data/buymodules/guestbook';
    $pathh = ROOT .'/' . 'data/buymodules/special';
    $pathi = ROOT .'/' . 'data/buymodules/type';

    $file = array($patha,$pathb,$pathc,$pathd,$pathe,$pathf,$pathg,$pathh,$pathi);
    foreach($file as $val){
        $tips = '<div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;<strong>' . lang_admin("tips") . '</strong>&nbsp;&nbsp;' . $val . '&nbsp;&nbsp;' . lang_admin("no_write_permission") . '</div>';
        if(!mkdirs($val)){
            echo $tips;
        }else{
            echo '';
        }
    }
    ?>

    <div class="box" id="box">

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="tag_template">
                <a data-dataurlname="<?php echo lang_admin('template_manage');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template');?>"   href="#tag1" name="<?php echo lang_admin('template_manage');?>" role="tab" data-toggle="tab">
                    <?php echo lang_admin('template_manage');?>
                </a>
            </li>


            <li role="presentation" class="tag_template_user ">
                <a data-dataurlname="<?php echo lang_admin('template_other');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template_user');?>"   href="#tag1" name="<?php echo lang_admin('template_other');?>" role="tab" data-toggle="tab">
                    <?php echo lang_admin('template_other');?>
                </a>
            </li>

            <?php if(file_exists(ROOT."/lib/table/shopping.php")){ ?>
                <li role="presentation" class="tag_template_shopping">
                    <a data-dataurlname="<?php echo lang_admin('commodity_template');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template_shop');?>"   href="#tag1" name="<?php echo lang_admin('commodity_template');?>" role="tab" data-toggle="tab">
                        <?php echo lang_admin('commodity_template');?>
                    </a>
                </li>
            <?php };?>

            <?php if(config::getadmin('mobile_open')==1) { ?>
                <li role="presentation" class="tag_template_mobile">
                    <a data-dataurlname="<?php echo lang_admin('template_mobile');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('config/system/set/template_mobile');?>"   href="#tag1" name="<?php echo lang_admin('template_mobile');?>" role="tab" data-toggle="tab">
                        <?php echo lang_admin('template_mobile');?>
                    </a>
                </li>
            <?php };?>
            <?php if(config::getadmin('template_view')==1) { ?>
                <li role="presentation" class="tag_template_online">
                    <a data-dataurlname="<?php echo lang_admin('template_online');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('expansion/buytemplate');?>"   href="#tag1" name="<?php echo lang_admin('template_online');?>" role="tab" data-toggle="tab">
                        <?php echo lang_admin('template_online');?>
                    </a>
                </li>
            <?php };?>
            <?php if(config::getadmin('buymodules_view')==1) { ?>
                <li role="presentation" class="tag_buymodules_online active">
                    <a data-dataurlname="<?php echo lang_admin('buymodules_online');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('expansion/buymodules');?>"   href="#tag1" name="<?php echo lang_admin('buymodules_online');?>" role="tab" data-toggle="tab">
                        <?php echo lang_admin('buymodules_online');?>
                    </a>
                </li>
            <?php };?>
        </ul>
        <div class="blank20"></div>


        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(front::get('type')=="free" ) { ?><?php echo lang_admin('free');?><?php echo lang_admin('assembly');?><?php } ?>
                <?php if(front::get('type')=="corp" ) { ?><?php echo lang_admin('vip');?><?php echo lang_admin('free');?><?php } ?>
                <?php if(front::get('type')=="all" || front::get('type')=="") { ?><?php echo lang_admin('all');?><?php echo lang_admin('assembly');?><?php } ?>
                <?php if(front::get('type')=="likemenoy" ) { ?><?php echo lang_admin('charge');?><?php echo lang_admin('assembly');?><?php } ?>
                <?php if(front::get('type')=="mybuyapps" ) { ?><?php echo lang_admin('purchased');?><?php echo lang_admin('assembly');?><?php } ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="tablist">
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/type/all'));?>"><?php echo lang_admin('all');?><?php echo lang_admin('assembly');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/type/free'));?>"><?php echo lang_admin('free');?><?php echo lang_admin('assembly');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/type/corp'));?>"><?php echo lang_admin('vip');?><?php echo lang_admin('free');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/type/likemenoy'));?>"><?php echo lang_admin('charge');?><?php echo lang_admin('assembly');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/type/mybuyapps'));?>"><?php echo lang_admin('purchased');?><?php echo lang_admin('assembly');?></a></li>
            </ul>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(front::get('modulestype')=="") { ?><?php echo lang_admin('mold');?><?php } ?>
                <?php if(front::get('modulestype')=="common" ) { ?><?php echo lang_admin('global_components');?><?php } ?>
                <?php if(front::get('modulestype')=="category" ) { ?><?php echo lang_admin('column_component');?><?php } ?>
                <?php if(front::get('modulestype')=="all") { ?><?php echo lang_admin('all_mold');?><?php } ?>
                <?php if(front::get('modulestype')=="content" ) { ?><?php echo lang_admin('content_components');?><?php } ?>
                <?php if(front::get('modulestype')=="form" ) { ?><?php echo lang_admin('form_components');?><?php } ?>
                <?php if(front::get('modulestype')=="page" ) { ?><?php echo lang_admin('page_components');?><?php } ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="tablist">

                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/modulestype/all'));?>"><?php echo lang_admin('all_mold');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/modulestype/common'));?>"><?php echo lang_admin('global_components');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/modulestype/category'));?>"><?php echo lang_admin('column_component');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/modulestype/content'));?>"><?php echo lang_admin('content_components');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/modulestype/form'));?>"><?php echo lang_admin('form_components');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/modulestype/page'));?>"><?php echo lang_admin('page_components');?></a></li>
            </ul>
        </div>
        <a class="btn btn-danger"  href="#"  <?php if($returndata['static']) { ?> onclick="gotourl(this)"  data-dataurl="<?php echo url('expansion/buymodules/querserver/1',true);?>"    <?php } else { ?> onclick="alert('<?php echo lang_admin("pleasss_login");?>');" <?php } ?> ><i class="icon-cloud-download"></i>    <?php echo lang_admin('get_data');?></a>
        <a class="btn btn-gray" href="#" onclick="if(confirm('<?php echo lang_admin('are_you_sure_you_want_to_delete_it');?>')){gotourl(this);}" data-dataurl="<?php echo url('expansion/deletemodulesall',true);?>" ><i class="icon-trash"></i>    <?php echo lang_admin('delete_data');?></a>

        <form name="searchform" id="searchform" action="<?php echo url('expansion/buymodules');?>" method="post" class="form-inline pull-right backstage-search" onsubmit="return returnform(this);">
            <input type="text" class="form-control" name="search_coded" id="search_coded" value=""  placeholder="<?php echo lang_admin('please_enter_search_template_number');?>">
            <input  name="submit" value="1" type="hidden">
            <button  type="submit" class="btn btn-default search-btn">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </form>

        <div class="blank20"></div>
        <div class="tempalte-list">
            <div class="row">
                <?php
                if(!is_array($appsdate) || !count($appsdate)){
                    echo '<div style="padding:0px 15px;"><div class="alert alert-warning alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="glyphicon glyphicon-warning-sign"></span>	<strong>' . lang_admin("tips") . '</strong> 	' . lang_admin("online_one_info") . '</div></div>';
                }
                foreach($appsdate as $app){
                    $appstatic=false;
                    if($returndata["modulesdata"]!=""){
                        foreach ($returndata["modulesdata"] as $key=>$val){
                            if(strtolower($val['buyid'])==strtolower($app['code'])  &&  ($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip']
                                    || $_SERVER['SERVER_NAME']=='www.'.$val['buyip'])){
                                $appstatic=TRUE;
                            }
                        }
                    }
                    if($returndata['static']) {
                        $app['price'] = $app['price'] * $returndata['userdata']['discount'] / 10;
                    }
                    ?>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="tempalte-box">
                            <?php if($app['iscorp']) { ?>
                                <span class="template-price iscorp"><?php echo lang_admin('vip');?><?php echo lang_admin('free');?></span>
                            <?php } ?>
                            <div class="tempalte-pic">
                                <a class="tempalte-pic-view enlargeImg" src="<?php echo $app['img'];?>">
                                    <img class="img-responsive enlargeImg" src="<?php echo $app['img'];?>">
                                </a>
                            </div>

                            <div class="tempalte-info">
                                <p>
                                    <strong><?php echo $app['codename'];?></strong>
                                    <?php if($app['price']>0) { ?>
                                        <span class="template-price free">
                                                        ￥<?php echo $app['price'];?>
                                                    </span>
                                    <?php } else { ?>

                                        <span class="template-price free">
                                                    <?php echo lang_admin('free');?>
                                                </span>
                                    <?php } ?>
                                </p>
                                <?php if($app['desc']) { ?>
                                    <p class="tips-p">
                                        <i class="icon-info"></i>    <?php echo $app['desc'];?>
                                    </p>
                                <?php } ?>
                                <?php if(front::get('type')=="mybuyapps" && $appstatic==false && $app['price']>0) { ?>
                                    <p class="text-center">
                                        <span class="btn btn-default" style="background:#f5f5f5;color:#ccc;"><?php echo lang_admin('not_server_oldbuy');?></span>
                                    </p>
                                <?php } ?>

                            </div>

                            <div class="tempalte-btn">
                                <div class="col-xs-6">
                                    <div class="row">
                                        <?php if($appstatic || $returndata["modulesdata"]=="") { ?>
                                            <?php if($app['installed']) { ?>
                                                <a href="#" name="btn_install" data-app_id="<?php echo $app['code'];?>"><i class="glyphicon glyphicon-retweet"></i> <?php echo lang_admin('reapply');?></a>
                                            <?php } else { ?>
                                                <a href="#" name="btn_install" data-app_id="<?php echo $app['code'];?>" class="btn_template"><i class="icon-cloud-download"></i> <?php echo lang_admin('application');?></a>
                                            <?php } ?>

                                        <?php } else {?>

                                            <a href="#" name="buy_apps"  data-app_id="<?php echo $app['code'];?>" data-app_price="<?php echo ($app['iscorp'] && session::get('ver') == 'corp')?0:$app['price'];?>">
                                                <?php if($app['price']>0 && (!$app['iscorp'] || ($app['iscorp'] && session::get('ver') != 'corp'))) { ?><i class="icon-basket-loaded"></i> <?php echo lang_admin('buy');?>
                                                <?php } else { ?>
                                                    <i class="icon-cloud-download"></i> <?php echo lang_admin('download');?>
                                                <?php } ?></a>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="row">
                                        <a href="<?php echo $app['url'];?>" title="<?php echo lang_admin('preview');?>" target="_blank"><i class="icon-screen-desktop"></i> <?php echo lang_admin('preview');?></a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>


        </div>
        <div class="blank20"></div>
        <script type="text/javascript">
            $(function () {
                var template_name="";
                //安装
                $('[name="btn_install"]').click(function(){
                    template_name = $(this).data('app_id');
                    //校验是否登陆
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('app/jklogin',true);?>",
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            //关闭服务器登录弹出框
                            if (data.static == 1) {
                                if (!isdownloading) {
                                    downloadFile(template_name);
                                    template_name="";
                                } else {
                                    alert("<?php echo lang_admin('please_wait_for_the_download_to_complete');?>");
                                }
                            }else{
                                //打开服务器登录弹出框
                                $('#myDownloadfileModal').modal('show');
                            }
                        }
                    });
                });

                //充值弹出框
                $('[name="buy_usermenoy"]').click(function(){
                    //打开充值弹出框
                    $('#myBuyusermenoyModal').modal('show');
                });

                //模态框点击充值
                $('#user_buymenoy').click(function(){
                    var  app_buyuserid="<?php if($returndata['userdata']!=''){ echo $returndata['userdata']['userid']; }?>";            //用户id
                    var  app_buyuserpayname=$(':radio[name="app_buyuserpayname"]:checked').val();   //支付方式
                    var  user_menoy=$('#user_menoy').val();   //充值金额
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('app/buyusermenoy',true);?>",
                        data:{ "app_buyuserid":app_buyuserid,"app_buyuserpayname":app_buyuserpayname,"user_menoy":user_menoy},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            if(data.static){
                                alert(data.message);
                                //关闭购买弹出框
                                $('#myBuyusermenoyModal').modal('hide');
                                $(".modal-backdrop.fade").hide();
                                var tempwindow=window.open('_blank');  //新页面弹出继续充值
                                tempwindow.location=" http://u.cmseasy.cn/index.php?case=archive&act=payappsconsumption&oid="+data.oid;
                            }else{
                                alert(data.message);
                            }
                        }
                    });

                });

                //购买弹出框
                $('[name="buy_apps"]').click(function(){
                    template_name=$(this).data('app_id');   //扩展商品ID
                    var  app_price=$(this).data('app_price');               //扩展商品价格
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('app/jklogin',true);?>",
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            //关闭服务器登录弹出框
                            if (data.static == 1) {
                                var  user_menoy="<?php if($returndata['userdata']!=""){ echo $returndata['userdata']['menoy']; }else{echo 0;}?>"; //用户余额
                                if(parseFloat(user_menoy)<parseFloat(app_price)){
                                    alert("<?php echo lang_admin('insufficient_balance_please_recharge_first');?>");
                                    return false;
                                }
                                //打开购买弹出框
                                $('#myBuyappsModal').modal('show');

                                $("#app_buyusername").val("<?php if($returndata['userdata']!=""){ echo $returndata['userdata']['username']; }?>");
                                $("#app_buymenoy").val(app_price);
                                $("#app_buyusername").attr("disabled","disabled");
                                $("#app_buymenoy").attr("disabled","disabled");
                                if(parseFloat(app_price)<=0){
                                    $("#myBuyappsModal_no_free").attr("style","display: none;");
                                    $("#myBuyappsModal_free").attr("style","display: block;");
                                    $("#app_clos").attr("style","display: block;");
                                    $("#app_buy").html("<?php echo lang_admin('install');?>");
                                }
                            }else {
                                //打开服务器登录弹出框
                                $('#myDownloadfileModal').modal('show');
                            }
                        }
                    });



                });

                //模态框点击购买
                $('#app_buy').click(function(){
                    //关闭购买弹出框
                    $('#myBuyappsModal').modal('hide');
                    $(".modal-backdrop.fade").hide();

                    var  app_buyusername=$("#app_buyusername").val();

                    var  app_buyuserid="<?php if($returndata['userdata']!=''){ echo $returndata['userdata']['userid']; }?>";
                    var  app_buytel=$("#app_buytel").val();
                    var  app_buyip=$("#app_buyip").val();
                    if(app_buyip==""){
                        alert("<?php echo lang_admin('ip_nonull');?>");return false;
                    }
                    var  app_buyremarks=$("#app_buyremarks").val();
                    var  app_buymenoy=$("#app_buymenoy").val();
                    var  app_buypayname=$(':radio[name="app_buypayname"]:checked').val();
                    var app_appsname=template_name;
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('app/buymodules',true);?>",
                        data:{'app_buyusername': app_buyusername,"app_buyuserid":app_buyuserid,"app_buytel":app_buytel,"app_buyip":app_buyip,"app_buyremarks":app_buyremarks,"app_buymenoy":app_buymenoy,"app_buypayname":app_buypayname,"app_appsname":app_appsname},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            if(data.static){
                                //购买成功  开始安装
                                downloadFile(template_name);
                                template_name="";
                            }else{
                                alert(data.message);
                                console.log(data);
                            }
                        }
                    });

                });

                //模态框点击登陆
                $('#app_login').click(function() {
                    var app_username = $("#app_username").val();
                    var app_passwrod = $("#app_passwrod").val();
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('app/login',true);?>",
                        data: {'app_username': app_username, "app_passwrod": app_passwrod},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            if (data.static == 1) {
                                //关闭服务器登录弹出框
                                $('#myDownloadfileModal').modal('hide');
                                $(".modal-backdrop.fade").hide();
                                gotoinurl("/index.php?case=expansion&act=buymodules&admin_dir=<?php echo get('admin_dir');?>");
                            } else {
                                alert(data.message);
                            }
                        }
                    });
                });

            });

            var isdownloading = false;

            function updateProgress(progress) {
                $('#imported-progress').html(progress);
                $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
            }

            function updateState(progress) {
                $('#statusText').html(progress);
                //$('.progress-bar').css('width', progress+'%').attr('aria-valuenow', progress);
            }

            function showAjaxError(XMLHttpRequest, textStatus, errorThrown) {
                console.log('ajax error');
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }

            //安装下载模板
            function downloadFile($f) {
                var file_size = 0;
                var progress = 0;
                var filename = $f;
                console.log("Prepared to download");
                updateState("<?php echo lang_admin('start_downloading_template_files');?>");

                $('#downModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                var def = $.get("<?php echo url('expansion/down/action/prepare-download',true);?>", {'f': filename}, null, 'json');
                def.then(function (res) {
                    console.log(res);
                    file_size = res.file_size;
                    $('#file-size').html(file_size);
                    console.log("started downloading");
                    updateState("<?php echo lang_admin('start_downloading_template_files');?>");
                    //isdownloading = false;
                    //$('#myModal').modal('hide');
                    //$('#info_res').html(res.msg);


                    url = "<?php echo url('expansion/down/action/start-download',true);?>";
                    promise =  $.get(url,{'f': filename} ,null, 'json');

                    var interval_id = window.setInterval(function () {
                        $('#imported-progress').html(progress);
                        $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
                        if (progress >= 100) {
                            clearInterval(interval_id);
                            // 到此远程文件下载完成，继续其他逻辑
                            updateState("<?php echo lang_admin('download_successful_start_to_install_the_template');?>");
                            $.ajax({
                                url : "<?php echo url('expansion/down/action/exzip',true);?>",
                                data: {'f': filename},
                                dataType:'json',
                                type : 'GET'
                            }).done(function(res){
                                if(res['code'] === 0){
                                    updateState("<?php echo lang_admin('installation_completed_2_seconds_later_jump_to_the_background');?>");
                                    $(".modal-backdrop.fade").hide();
                                    setTimeout("gotoinurl('<?php echo url('expansion/buymodules',true);?>');",2000);
                                }else{
                                    updateState(res['msg']);
                                }
                            }).fail(showAjaxError);
                        } else {
                            $.ajax({
                                url: "<?php echo url('expansion/down/action/get-file-size',true);?>",
                                data: {'f': filename},
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
                return;

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
                                        updateState("<?php echo lang_admin('installation_completed_jump_to_the_background');?>");
                                        setTimeout("gotoinurl('<?php echo url('expansion/buymodules',true);?>');", 1000);
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
            }

            $(function () {
                //应用模板
                $('#template-list a.btn_template').click(function (e) {
                    var templatename = $(this).data('app_id');
                    if (!isdownloading) {
                        $('#info_res').html('');
                        if (confirm("<?php echo lang_admin('do_you_confirm_the_download_template');?>")) {
                            downloadFile(templatename);
                        }
                    } else {
                        alert("<?php echo lang_admin('please_wait_for_the_download_to_complete');?>");
                    }
                    return false;
                });
            });

        </script>


        <div class="line"></div>
        <div class="blank5"></div>
        <div class="page">
            <nav>
                <ul class="pagination">
                    <?php if($page>1) { ?>
                        <a href="#" onclick="gotourl(this)"  data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/page/'.($page-1),true));?>"><?php echo lang_admin('prev_page');?></a>
                    <?php } ?>
                    <?php
                    for ($inxex=1;$inxex<=ceil($allsize/$pagesize);$inxex++){
                        ?>
                        <?php if($inxex==$page) { ?>
                            <strong><?php echo $inxex;?></strong>
                        <?php } else { ?>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/page/'.$inxex,true));?>"><?php echo $inxex;?></a>
                        <?php } ?>

                    <?php    }
                    ?>
                    <?php if($page<ceil($allsize/$pagesize)) { ?>
                        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buymodules/page/'.($page+1),true));?>"><?php echo lang_admin('next_page');?></a>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="blank30"></div>
</div>


<!-- 在线模板下载 -->
<div class="modal fade" id="downModal" tabindex="-1" role="dialog" aria-labelledby="downModalLabel" data-backdrop="static" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="downModalLabel"><?php echo lang_admin('download_template');?></h4>
            </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang_admin('close');?></button>
            </div>
        </div>
    </div>
</div>


<!-- 校验服务端登陆Modal -->
<div class="modal fade" id="myDownloadfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('login');?></h4>
            </div>
            <div class="modal-body" >
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-user"></i></span>
                    <input type="text" name="app_username" id="app_username" value="" class="form-control" placeholder="<?php echo lang_admin('account_number');?>">
                </div>
                <div class="blank20"></div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                    <input type="password" name="app_passwrod" id="app_passwrod" value="" class="form-control" placeholder="<?php echo lang_admin('password');?>">
                </div>
            </div>
            <div class="modal-footer">
                <span class="pull-left" style="font-size:12px;color:#ccc;"><?php echo lang_admin('verify_server_login_tips');?></span>
                <button type="button" id="app_login" class="btn btn-success"><?php echo lang_admin('login');?></button>
                <button type="button" class="btn btn-default" onclick="javascrtpt:window.location.href='https://u.cmseasy.cn/index.php?case=user&act=register'" target="_blank"><?php echo lang_admin('register');?></button>
            </div>
        </div>
    </div>
</div>

<!--购买插件Modal -->
<div class="modal fade" id="myBuyappsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('buy');?></h4>
            </div>
            <div class="modal-body" id="myBuyappsModal_no_free" style="display: block;">
                <div class="form-group">
                    <label><?php echo lang_admin("username");?></label>
                    <input type="text" name="app_buyusername" id="app_buyusername"  value="" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo lang_admin("amount_of_money");?></label>
                    <div class="input-group">
                        <div class="input-group-addon">￥</div>
                        <input type="text" class="form-control" name="app_buymenoy" id="app_buymenoy" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo lang_admin("tel");?></label>
                    <input type="text" name="app_buytel" id="app_buytel" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo lang_admin("binding_domain_names");?></label>
                    <input type="text" name="app_buyip" id="app_buyip" value="<?php echo $_SERVER['SERVER_NAME'];?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo lang_admin("remarks");?></label>
                    <textarea type="text" name="app_buyremarks" id="app_buyremarks" value="" class="form-control">
                </textarea>
                </div>
            </div>
            <div class="modal-body" id="myBuyappsModal_free" style="height:88px;display: none;">
                <center><?php echo lang_admin('do_you_confirm_the_download_apps');?></center>
            </div>
            <div class="modal-footer">
                <button type="button" id="app_buy" class="btn btn-success"><?php echo lang_admin('buy');?></button>
                <button type="button" id="closmode" name="app_clos" class="btn btn-danger" data-dismiss="modal"><?php echo lang_admin("close");?></button>
            </div>
        </div>
    </div>
</div>

<!--用户充值Modal -->
<div class="modal fade" id="myBuyusermenoyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('buy');?></h4>
            </div>
            <div class="modal-body" >
                <div class="form-group">
                    <label style="font-size:14px;"><?php echo lang_admin("recharge_amount");?></label>
                    <input type="text" name="user_menoy" id="user_menoy" value="" class="form-control" oninput="value=value.replace(/[^\d]/g,'')">
                </div>
                <?php
                $paylist = apps::getpay();
                if(is_array($paylist)){
                    foreach($paylist as $i => $pay) { ?>
                        <?php if($pay['enabled']==1) { ?>

                            <div class="checkbox col-xs-12 col-md-6">
                                <label class="row">
                                    <input type="radio" name="app_buyuserpayname" value="<?php echo $pay['pay_code'];?>" checked>
                                    <img src="<?php echo $pay['pay_image'];?>" height="26">
                                    <?php echo $pay['pay_name'];?>
                                    <!--<small> <?php /*echo lang('rates');*/?>：<?php /*echo $pay['pay_fee'];*/?>%</small>-->
                                </label>
                            </div>

                        <?php } ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php echo lang('nopayment');?>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="user_buymenoy" class="btn btn-success"><?php echo lang_admin('recharge');?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#app_buyip").bind("input propertychange",function () {//监控输入框1
            var a = $("#app_buyip").val();//获取输入框1的值
            alert(a);
            if(a!=""){            //若输入框1的内容不为空，则输入框2不可用
                $("#app_buy").attr("disabled","disabled");  //设置输入框2不可用
            }else if(a==""){
                $("#app_buy").removeAttr("disabled");    //移除不可用的属性
            }
        });
    })
</script>



<!-- 查看大图 -->
<script type="text/javascript">
    $(function() {
        enlargeImg();
    })
    //查看大图
    function enlargeImg() {
        $(".enlargeImg").click(function() {
            var imgSrc = $(this).attr('src');
            $(this).after("<div onclick='closeImg()' class='enlargeImg_wrapper'><img src='" + imgSrc + "'</div>");
            $('.enlargeImg_wrapper').fadeIn(200);
            $(this).parent().css('z-index', '9');
            $(this).parent().parent().css('z-index', '8');
            $(this).parent().parent().parent().css('z-index', '7');
        })
    }
    //关闭并移除图层
    function closeImg() {
        $('.enlargeImg_wrapper').fadeOut(200).remove();
        $(".enlargeImg").parent().css('z-index', '1');
        $(".enlargeImg").parent().parent().css('z-index', '1');
        $(".enlargeImg").parent().parent().parent().css('z-index', '1');
    }
</script>

