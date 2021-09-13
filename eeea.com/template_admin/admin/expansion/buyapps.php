
<style type="text/css">
    .quick-navb {margin:0px -10px;}
    .list-group-item { min-height:155px; margin:0px 10px 10px 10px; padding:25px 15px 20px 15px; -moz-box-shadow:0px 8px 15px #eee;-webkit-box-shadow:0px 8px 15px #eee;box-shadow:0px 8px 15px #eee;border:1px solid #ddd;}
    .list-group-item span.app-icon {display:inline-block; width:66px; height:66px; line-height: 66px; margin:0px auto; font-size:26px;color:#424950; background:#eee;border-radius:50%;}
    .list-group-item span.expansion-price { display:inline-block; float:right; margin:5px 0px 0px 10px;background:#28D094; border-radius: 3px; padding:0px 5px;color:#fff;text-align:center;}
    .list-group-item span.free {background:#eee;color:#333;text-align:center;color: rgba(0, 0, 0, 0.45);}
    .list-group-item strong { font-size:16px; line-height:38px; color:#000; font-weight:300;}
    .list-group-item:last-child {border-radius:8px; }
    .list-group-item-b:last-child {border-radius:2px; }
    .list-group-item:hover,.glyphicon-list-alt {background:#424950;color:#fff;box-shadow:0px 8px 15px #aaa;-o-transition: all 0.15s, 0.15s;-moz-transition: all 0.15s, 0.15s;-webkit-transition: all 0.15s, 0.15s;border:1px solid #424950;
    }
    .quick-navb-item {margin-bottom:20px;}
    .quick-navb-item:hover strong {color:#fff;}
    .list-group-item p {margin:0px;line-height:180%;font-size:12px;}

    .apps-config-btn { position:absolute; bottom:0px; left:0px; right:0px; height:38px; line-height:38px; background:#f5f5f5;border-radius: 0px 0px 5px 5px;color:rgba(0, 0, 0, 0.45);}
    .apps-config-btn:before {
        position: absolute;
        left:49%;
        content:"|";
        color:#ccc;
    }
    .apps-config-btn-no:before {display:none;}
    .apps-config-btn a {display:block; text-align:center;text-decoration:none; color:rgba(0, 0, 0, 0.45); cursor:pointer}
    .apps-config-btn .btn,.glyphicon-trash {color:rgba(0, 0, 0, 0.45);}
    .quick-navb-item:hover .apps-config-btn,.quick-navb-item:hover .apps-config-btn a,.quick-navb-item:hover .glyphicon-trash {background:#515962;color:#fff;}
    #myDownloadfileModal .modal-body {
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


    <div class="box" id="box">

        <h5>
            <?php echo lang_admin('apps_extend');?>
            <span class="pull-right">
                <?php if($returndata['static']) { ?>
                    <?php echo $returndata['userdata']['username'];?> | <span style="color:#ff9149">￥<?php echo $returndata['userdata']['menoy'];?></span> |
            <a class="btn btn-success"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('app/close/buyapps/1',true);?>" ><?php echo lang_admin('sign_out');?></a>
                    <a class="btn btn-default"  href="javascript:void(0);" name="buy_usermenoy" ><?php echo lang_admin('recharge');?></a>
                    <a class="btn btn-default" href="https://u.cmseasy.cn/index.php?case=user&act=index" target="_blank">
                <i class="icon-user"></i> <?php echo lang_admin('service_centre');?>
            </a>

                <?php } else { ?>
                    <a class="btn btn-success" data-toggle="modal" data-target="#myDownloadfileModal" href="#" ><?php echo lang_admin('login');?></a>
                    <a class="btn btn-default"  href="https://u.cmseasy.cn/index.php?case=user&act=register" target="_blank"><?php echo lang_admin('register');?></a>
                <?php } ?>
            </span>
        </h5>



        <?php
        $patha =ROOT .'/' . 'apps';
        $is_mkdirs= mkdirs($patha);
        $tips = '<div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;<strong>' . lang_admin("tips") . '</strong>&nbsp;&nbsp;' . $patha . '&nbsp;&nbsp;' . lang_admin("no_write_permission") . '</div>';
        if(!$is_mkdirs){
            echo $tips;
        }else{
            echo '';
        }
        ?>

        <ul class="nav nav-tabs inline-block" role="tablist">
            <li <?php if(front::get('type')=="" &&  front::get('act')=="index" ) { ?>class="active" <?php } ?>><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('expansion/index',true);?>"><?php echo lang_admin('default');?><?php echo lang_admin('extend');?></a></li>
            <li class="active"><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('expansion/buyapps/type/all');?>"><?php echo lang_admin('extend_online');?></a></li>

        </ul>

        <div class="blank20"></div>
        <?php if(session::get('ver') != 'corp'){ ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-warning-sign"></span>	<strong><?php echo lang_admin('tips');?></strong>
                <?php echo lang_admin('expansion_vip_info');?>&nbsp;&nbsp;
                <a class="btn btn-success" href="<?php echo $base_url;?>/index.php?admin_dir=<?php echo config::getadmin('admin_dir',true);?>&site=default&gotoinurl=license_client/buylicense" target="_blank"><?php echo lang_admin('buy');?></a>

            </div>

        <?php } ?>
        <?php
        if(!is_array($appsdate) || !count($appsdate)){
        echo '<div class="alert alert-warning alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="glyphicon glyphicon-warning-sign"></span>	<strong>' . lang_admin("tips") . '</strong> 	' . lang_admin("online_one_info") . '</div>';
        }
        ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(front::get('type')=="free" ) { ?><?php echo lang_admin('free');?><?php echo lang_admin('extend');?><?php } ?>
                <?php if(front::get('type')=="corp" ) { ?><?php echo lang_admin('vip');?><?php echo lang_admin('free');?><?php } ?>
                <?php if(front::get('type')=="all" || front::get('type')=="") { ?><?php echo lang_admin('all');?><?php echo lang_admin('extend');?><?php } ?>
                <?php if(front::get('type')=="likemenoy" ) { ?><?php echo lang_admin('charge');?><?php echo lang_admin('extend');?><?php } ?>
                <?php if(front::get('type')=="mybuyapps" ) { ?><?php echo lang_admin('purchased');?><?php echo lang_admin('extend');?><?php } ?>
                <?php if(front::get('type')=="vip" ) { ?><?php echo lang_admin('is_vip');?><?php } ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="tablist">
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buyapps/type/all'));?>"><?php echo lang_admin('all');?><?php echo lang_admin('extend');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buyapps/type/free'));?>"><?php echo lang_admin('free_extend');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buyapps/type/corp'));?>"><?php echo lang_admin('vip_extend');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buyapps/type/likemenoy'));?>"><?php echo lang_admin('charge_extend');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buyapps/type/mybuyapps'));?>"><?php echo lang_admin('purchased');?><?php echo lang_admin('extend');?></a></li>
                <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo str_replace('&querserver=1','',modify('act/buyapps/type/vip'));?>"><?php echo lang_admin('is_vip');?></a></li>
            </ul>
        </div>
        <?php if($returndata['static']) { ?>
            <a class="btn btn-danger"  href="#"  <?php if($returndata['static']) { ?> onclick="gotourl(this)"   data-dataurl="<?php echo url('expansion/buyapps/type/'.front::get('type').'/querserver/1',true);?>" <?php } else { ?> onclick="alert('<?php echo lang_admin("pleasss_login");?>');" <?php } ?>  ><i class="icon-cloud-download"></i>    <?php echo lang_admin('get_data');?></a>
            <a class="btn btn-gray" href="#" onclick="if(confirm('<?php echo lang_admin('are_you_sure_you_want_to_delete_it');?>')){gotourl(this);}" data-dataurl="<?php echo url('expansion/deleappsall',true);?>" ><i class="icon-trash"></i> <?php echo lang_admin('delete_data');?></a>
        <?php } ?>
        <div class="blank20"></div>


        <div class="quick-navb">
            <?php
            foreach($appsdate as $app){
                if($app['is_vip'] && session::get('ver') != 'corp') {
                    continue;
                }
                $appstatic=false;
                if($returndata["appsdata"]!==""  && count($returndata["appsdata"])>0){
                    foreach ($returndata["appsdata"] as $key=>$val){
                        if(strtolower($val['buyid'])==strtolower($app['id'])  &&  ($_SERVER['SERVER_NAME']==$val['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$val['buyip'])){
                            $appstatic=TRUE;
                        }
                    }
                }
                if($returndata['static']) {
                    $app['price'] = $app['price'] * $returndata['userdata']['discount'] / 10;
                }
                ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item" >
                    <div class="row">
                        <div class="list-group-item">
                            <div class="col-xs-4 col-md-3">
                                <div class="row text-center">
                                    <span class="app-icon">
                                    <img src="<?php echo $app['icon'];?>" class="img-responsive img-circle">
                                        </span>
                                </div>
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <p>
                                    <strong><?php echo $app['name'];?></strong>
                                    <?php if($app['iscorp']) { ?>
                                        <span class="expansion-price">
                                        <?php echo lang_admin('vip_free');?>
                                    </span>
                                    <?php } else if($app['is_vip']) { ?>
                                    <span class="expansion-price">
                                        <?php echo lang_admin('is_vip');?>
                                    </span>
                                    <?php } else { ?>
                                    <?php if($app['price']>0) { ?>
                                        <span class="expansion-price">
                                                ￥<?php echo $app['price'];?>
                                            </span>
                                    <?php } else { ?>
                                        <span class="expansion-price free">
                                            <?php echo lang_admin('free');?>
                                            </span>
                                    <?php } ?>
                                    <?php } ?>
                                </p>
                                <p>V<?php echo $app['version'];?> <?php echo $app['desc'];?></p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="apps-config-btn <?php if($app['installed']) { ?><?php } else { ?>apps-config-btn-no<?php } ?><?php if((($app['iscorp'] && session::get('ver') == 'corp'))) { ?> apps-config-btn-no<?php } ?>">
                                <?php if(($appstatic)) { ?>
                                    <?php if($app['installed']) { ?>
                                        <?php if($app['admin_url']!=""){
                                            $version=floatval(str_replace(".","",$app['version']));
                                            $new_version=floatval(str_replace(".","",$app['new_version']));
                                        ?>
                                            <?php if($new_version>$version) { ?>
                                            <div class="col-xs-6 col-md-6">
                                                <a href="#" name="btn_install"  id="btn_install_<?php echo $app['id'];?>"  data-app_id="<?php echo $app['id'];?>" data-url="<?php echo url('app/uninstall/',true);?>" data-upgrade="1" data-dataurlname="<?php echo lang_admin('upgrade');?> <?php echo $app['name'];?>"><i class="icon-equalizer"></i> <?php echo lang_admin('upgrade');?></a>
                                            </div>
                                            <?php };?>
                                        <div class="col-xs-6 col-md-6">
                                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/<?php echo $app['admin_url'];?>&admin_dir=<?php echo get('admin_dir');?>&site=default"  data-dataurlname="<?php echo lang_admin('administration');?> <?php echo $app['name'];?>"><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                                        </div>
                                        <?php };?>
                                        <div class="col-xs-6 col-md-6">
                                            <a href="#" name="btn_uninstall" data-app_id="<?php echo $app['id'];?>" data-url="<?php echo url('app/uninstall/',true);?>"><i class="icon-action-redo"></i> <?php echo lang_admin('uninstall');?></a>
                                        </div>
                                    <?php } else { ?>
                                        <a name="btn_install"  id="btn_install_<?php echo $app['id'];?>" data-app_id="<?php echo $app['id'];?>" data-url="<?php echo url('app/install/',true);?>" data-toggle="modal"><i class="icon-cloud-download"></i> <?php echo lang_admin('install');?></a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if((($app['iscorp'] && session::get('ver') == 'corp'))) { ?>
                                        <a name="buy_apps"  data-app_id="<?php echo $app['id'];?>" data-app_price="0" data-toggle="modal"><i class="icon-cloud-download"></i>
                                            <?php echo lang_admin('install');?>
                                        </a>
                                    <?php } else { ?>
                                        <a  name="buy_apps"  data-app_id="<?php echo $app['id'];?>" data-app_price="<?php echo $app['price'];?>" ><i class="icon-basket-loaded"></i> <?php echo lang_admin('buy');?></a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <script type="text/javascript">
                var app_name="";
                var upgrade=0;
                var isdownloading = false;  //下载状态  false 是没有下载的  true是在下载中！
                $(function () {
                    //安装
                    $('[name="btn_install"]').click(function(){
                        app_name = $(this).data('app_id');
                        upgrade = $(this).data('upgrade');  //升级
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
                                        var install_message="<?php echo lang_admin('do_you_confirm_the_download_apps');?>";
                                        var upgrade_message="<?php echo lang_admin('do_you_confirm_the_upgrade_apps');?>";
                                        if(upgrade){
                                            install_message=upgrade_message;
                                        }
                                        if (confirm(install_message)) {
                                            $('#btn_install_'+app_name).html('<i class="icon-cloud-download"></i><?php echo lang_admin('installation_is_in_progress');?>');
                                            downloadFile(app_name,upgrade);
                                            app_name="";
                                            upgrade=0;
                                        }
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

                    //卸载方法
                    $('[name="btn_uninstall"]').click(function(){
                        if(confirm("<?php echo lang_admin('extension_confirm_uninstall');?>")) {
                            $(this).addClass('label-default').removeClass('label-warning');
                            var url = $(this).data('url');
                            var _this = this;
                            var i = 0;
                            setInterval(function () {
                                if (i > 3) i = 0;
                                $(_this).html('正在卸载' + '.'.repeat(i));
                                i++;
                            }, 500);
                            $.post(url, {app_id: $(this).data('app_id')}).then(function (res) {
                                console.log(res);
                                gotoinurl("<?php echo uri();?>");
                            }).catch(function (e) {
                                console.error(e);
                            });
                        }
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
                                    gotoinurl("<?php echo url('expansion/buyapps/type/all',true);?>");
                                    //javascript:window.location.href = "index.php?case=expansion&act=buyapps&type=free&admin_dir=<?php echo get('admin_dir');?>";
                                } else {
                                    alert(data.message);
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
                        var  app_buyusername=$("#app_buyusername").val();
                        var  app_buyuserid="<?php if($returndata['userdata']!=""){ echo $returndata['userdata']['userid']; }?>";            //用户id
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
                        app_name = $(this).data('app_id');   //插件商品ID
                        var app_price =$(this).data('app_price');               //插件商品价格
                        $.ajax({
                            type: "get",
                            url: "<?php echo url('app/jklogin',true);?>",
                            dataType: 'json',
                            async: true,
                            success: function (data) {
                                //关闭服务器登录弹出框
                                if (data.static == 1) {
                                    var user_menoy = "<?php if ($returndata['userdata'] != "") {
                                        echo $returndata['userdata']['menoy'];
                                    } else {
                                        echo 0;
                                    }?>";  //用户余额
                                    if (parseFloat(user_menoy) < parseFloat(app_price)) {
                                        alert("<?php echo lang_admin('insufficient_balance_please_recharge_first');?>");
                                        return false;
                                    }
                                    //打开购买弹出框
                                    $('#myBuyappsModal').modal('show');

                                    $("#app_buyusername").val("<?php if ($returndata['userdata'] != "") {
                                        echo $returndata['userdata']['username'];
                                    }?>");
                                    $("#app_buymenoy").val(app_price);
                                    $("#app_buyusername").attr("disabled", "disabled");
                                    $("#app_buymenoy").attr("disabled", "disabled");
                                    if (parseFloat(app_price) <= 0) {
                                        $("#myBuyappsModal_no_free").attr("style", "display: none;");
                                        $("#myBuyappsModal_free").attr("style", "display: block;");
                                        $("#app_clos").attr("style", "display: block;");
                                        $("#app_buy").html("<?php echo lang_admin('install');?>");
                                    }
                                } else {
                                    //打开服务器登录弹出框
                                    $('#myDownloadfileModal').modal('show');
                                }
                            }
                        });
                    });

                    //模态框点击购买
                    $('#app_buy').click(function(){
                        var  app_buyusername=$("#app_buyusername").val();
                        var  app_buyuserid="<?php if($returndata['userdata']!=""){ echo $returndata['userdata']['userid']; }?>";
                        var  app_buytel=$("#app_buytel").val();
                        var  app_buyip=$("#app_buyip").val();
                        if(app_buyip==""){
                            alert("<?php echo lang_admin('ip_nonull');?>");return false;
                        }
                        var  app_buyremarks=$("#app_buyremarks").val();
                        var  app_buymenoy=$("#app_buymenoy").val();
                        var  app_buypayname=$(':radio[name="app_buypayname"]:checked').val();
                        var app_appsname=app_name;
                        $.ajax({
                            type: "get",
                            url: "<?php echo url('app/buyapps',true);?>",
                            data:{'app_buyusername': app_buyusername,"app_buyuserid":app_buyuserid,"app_buytel":app_buytel,"app_buyip":app_buyip,"app_buyremarks":app_buyremarks,"app_buymenoy":app_buymenoy,"app_buypayname":app_buypayname,"app_appsname":app_appsname},
                            dataType: 'json',
                            async: true,
                            success: function (data) {
                                if(data.static){
                                    //关闭购买弹出框
                                    $('#myBuyappsModal').modal('hide');
                                    $(".modal-backdrop.fade").hide();
                                    //购买成功  开始安装
                                    downloadFile(app_name);
                                    app_name="";
                                }else{
                                    alert(data.message);
                                }
                            }
                        });

                    });

                });
                //安装方法
                function downloadFile($f,upgrade) {
                    var appname = $f;
                    //先创建文件夹
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('app/down/action/prepare-download',true);?>",
                        data:{'appname': appname,'upgrade': upgrade},
                        dataType:'json',
                        async: true,
                        success: function (data) {
                            isdownloading=true;
                            //创建文件夹成功
                            if(data.static){
                                //开始下载
                                $.ajax({
                                    type: "get",
                                    url: "<?php echo url('app/down/action/start-download',true);?>",
                                    data: {'appname': appname,'upgrade': upgrade},
                                    dataType: 'json',
                                    async: true,
                                    success: function (startdata) {
                                        //下载成功
                                        if(startdata.static) {
                                            //开始解压
                                            $.ajax({
                                                type: "get",
                                                url: "<?php echo url('app/down/action/exzip',true);?>",
                                                data: {'appname': appname,'upgrade': upgrade},
                                                dataType: 'json',
                                                async: true,
                                                success: function (data) {
                                                    if(data.static) {
                                                        isdownloading=false;
                                                        alert(data.message);
                                                        gotoinurl("<?php echo uri();?>");
                                                    }
                                                }
                                            });
                                        }else{
                                            alert(startdata.message);
                                            $('#btn_install_'+appname).html('<i class="icon-cloud-download"></i><?php echo lang_admin('install');?>');
                                        }
                                    }
                                });
                            }
                            else{
                                alert(data.message);
                                $('#btn_install_'+data.app_name).html('<i class="icon-cloud-download"></i><?php echo lang_admin('install');?>');
                            }
                        }
                    });
                }
            </script>
            <div class="blank30"></div>
        </div>
        <div class="line"></div>
        <div class="page">
            <nav>
                <ul class="pagination">
                    <?php if($page>1) { ?>
                        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/buyapps/page/".($page-1),true);?>"><?php echo lang_admin('prev_page');?></a>
                    <?php } ?>
                    <?php
                    for ($inxex=1;$inxex<=ceil($allsize/$pagesize);$inxex++){
                        ?>
                        <?php if($inxex==$page) { ?>
                            <strong><?php echo $inxex;?></strong>
                        <?php } else { ?>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/buyapps/page/".$inxex,true);?>"><?php echo $inxex;?></a>
                        <?php } ?>

                    <?php    }
                    ?>
                    <?php if($page<ceil($allsize/$pagesize)) { ?>
                        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/buyapps/page/".($page+1),true);?>"><?php echo lang_admin('next_page');?></a>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="blank20"></div>

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
            <div class="modal-body" id="myBuyappsModal_no_free" style="height:auto;display: block;">
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
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="app_buyuserpayname" value="<?php echo $pay['pay_code'];?>" checked>
                                    <?php echo $pay['pay_name'];?>
                                    <!--<small> <?php /*echo lang('rates');*/?>：<?php /*echo $pay['pay_fee'];*/?>%</small>-->
                                    <img src="<?php echo $pay['pay_image'];?>" height="26">
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