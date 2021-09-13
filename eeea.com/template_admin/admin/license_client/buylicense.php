

<style type="text/css">
    .main-right-box h1 { margin-bottom:30px; padding-bottom:15px; font-size:20px;  color:#000; border-bottom:1px solid #eee;}
    .btn-license {border:none;padding: 14px 60px;background: #06276a;color: white;border-radius: 2px;}
    .btn-license:hover {background:#337ab7;color:#fff;box-shadow: 0 6px 0 0 rgba(0, 0, 0, 0.01), 0 15px 32px 0 rgba(0, 0, 0, 0.06);}
    .modal-body {padding:0px 30px 0px 50px;}
    .system_down h4.desc {font-weigth:normal;font-size:18px;}
</style>



<!-- 购买弹出框 -->
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" data-backdrop="static" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="domain"><?php echo lang_admin('enter_authorized_domain_name') ;?>：cmseasy.cn</label>
                    <div class="input-group">
                        <div class="input-group-addon">http://www.</div>
                        <input type="text" class="form-control" name="buy_license_domain"
                               id="buy_license_domain" placeholder="***" onkeyup="value=value.replace(/[^\w\.\/.*+%!-]/ig,'')" value="">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <span class="pull-left" style="font-size:12px;color:#ccc;"><?php echo lang_admin('verify_server_login_tips');?></span>
                <button type="button" id="btn_buy" class="btn btn-success"><?php echo lang_admin('buy');?></button>
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
                <button type="button" id="user_buymenoy" class="btn btn-success"><?php echo lang_admin('the_next_step');?></button>
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
                <a class="btn btn-primary"  href="https://u.cmseasy.cn/index.php?case=user&act=register" target="_blank"><?php echo lang_admin('register');?></a>
            </div>
        </div>
    </div>
</div>


<div class="main-right-box">
    <div class="blank20"></div>
    <div class="box" id="box">

        <h5>
            <?php echo lang_admin('buy_license');?>
            <span class="pull-right">
            <?php if($returndata['static']) { ?>
                <?php echo $returndata['userdata']['username'];?> | <span style="color:#ff9149">￥<?php echo $returndata['userdata']['menoy'];?></span> |
            <a class="btn btn-primary"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('app/close/license/1',true);?>" ><?php echo lang_admin('sign_out');?></a>
                <a class="btn btn-success"  href="javascript:void(0);" name="buy_usermenoy" ><?php echo lang_admin('recharge');?></a>
                <a class="btn btn-default" href="https://u.cmseasy.cn/index.php?case=user&act=index" target="_blank">
                <i class="icon-user"></i> <?php echo lang_admin('service_centre');?>
            </a>
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=license_client&act=licenselist&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('buy_license');?>" class="btn btn-default"><?php echo lang_admin('yes_buy');?></a>
            <?php } else { ?>
                <a class="btn btn-primary" data-toggle="modal" data-target="#myDownloadfileModal" href="#" ><?php echo lang_admin('login');?></a>
                <a class="btn btn-success"  href="https://u.cmseasy.cn/index.php?case=user&act=register" target="_blank"><?php echo lang_admin('register');?></a>
            <?php } ?>

        </span>
        </h5>
        <div class="line"></div>
        <div class="blank30"></div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="system_down text-center">
                <center><img src="https://www.cmseasy.cn/images/license/cmseasype.png" class="img-responsive"></center>
                <h2><?php echo $data['title'];?></h2>
                <div class="blank10"></div>
                <h4 class="desc"><?php echo lang_admin('remove_all_official_information_in_front_and_back_office') ;?></h4>

                <h4 class="desc"><?php echo lang_admin('all_business_functions_available') ;?></h4>
                <div class="blank30"></div>
                <div class="shop-price">
                    <a  title="<?php echo lang_admin('purchase_authorization') ;?>" class="btn btn-license" data-toggle="modal"
                        <?php if($returndata['static']) { ?> data-target="#buyModal"<?php } else { ?> data-target="#myDownloadfileModal" <?php } ?> href="#">
                        <?php echo lang_admin('purchase_authorization') ;?> ￥<span id="shop-price">
                                <?php   echo floatval($data['attr2'])*(($returndata['static'] && $returndata['userdata']['discount'])>0?$returndata['userdata']['discount']:10)/10; ?></span></a>
                    <div class="blank30"></div>

                    <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=copyright_client&act=buycopyright&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('commercial_authorization');?>" class="btn btn-default">
                        如果您仅想拥有商业版功能 <i class="glyphicon glyphicon-arrow-right"></i>
                    </a>
                    <div class="blank30"></div>
                </div>
                <div class="blank30"></div>
                <div class="clearfix"></div>

            </div>



            <div class="blank30"></div>

        </div>


        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div style="padding-left:60px;text-align:left;">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                    <?php echo lang_admin('buy_license_one') ;?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" style="">
                            <div class="panel-body">
                                <p>
                                    <?php echo lang_admin('buy_license_one_info') ;?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <?php echo lang_admin('buy_license_one') ;?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                            <div class="panel-body">
                                <p>
                                    <?php echo lang_admin('buy_license_one_info') ;?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <?php echo lang_admin('buy_license_three') ;?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                            <div class="panel-body">
                                <p>
                                    <?php echo lang_admin('buy_license_three_info') ;?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <?php echo lang_admin('buy_license_four') ;?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                            <div class="panel-body">
                                <p>
                                    <?php echo lang_admin('buy_license_four_info') ;?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <?php echo lang_admin('buy_license_five') ;?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                            <div class="panel-body">
                                <p>
                                    <?php echo lang_admin('buy_license_five_info') ;?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingSix">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <?php echo lang_admin('buy_license_six') ;?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" aria-expanded="false">
                            <div class="panel-body">
                                <p>
                                    <?php echo lang_admin('buy_license_six_info') ;?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="blank30"></div>
    </div>
</div>




<script>
    $(function () {
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

        //模态框点击登陆
        $('#app_login').click(function () {
            var app_username = $("#app_username").val();
            var app_passwrod = $("#app_passwrod").val();
            $.ajax({
                type: "get",
                url: "<?php echo url('app/login', true);?>",
                data: {'app_username': app_username, "app_passwrod": app_passwrod},
                dataType: 'json',
                async: true,
                success: function (data) {
                    if (data.static == 1) {
                        //关闭服务器登录弹出框
                        $('#myDownloadfileModal').modal('hide');
                        $(".modal-backdrop.fade").hide();
                        gotoinurl("/index.php?case=license_client&act=buylicense&admin_dir=<?php echo get('admin_dir');?>");
                    } else {
                        alert(data.message);
                    }
                }
            });
        });

        //模态框点击购买
        $('#btn_buy').click(function(){
            var  buy_domain=$("#buy_license_domain").val();     //域名
            //关闭购买弹出框
            $('#buyModal').modal('hide');
            $(".modal-backdrop.fade").hide();
            var  app_buyuserid="<?php if($returndata['userdata']!=''){ echo $returndata['userdata']['userid']; }?>";
            var  app_buyusername="<?php if($returndata['userdata']!=''){ echo $returndata['userdata']['username']; }?>";
            $.ajax({
                type: "get",
                url: "<?php echo url('app/buylicense',true);?>",
                data:{'app_buyuserid': app_buyuserid,"buy_domain":buy_domain,"app_buyusername":app_buyusername},
                dataType: 'json',
                async: true,
                success: function (data) {
                    console.log(data);
                    if(data.static){
                        alert(data.message);
                        //购买成功  开始安装  是否使用模板内置数据
                        gotoinurl("/index.php?case=license_client&act=licenselist&admin_dir=<?php echo get('admin_dir');?>");
                    }else{
                        alert(data.message);
                        console.log(data);
                    }
                }
            });

        });

    });
</script>

<script flashpath="<?php echo $base_url;?>/common/js/hprose/" src="<?php echo $base_url;?>/common/js/hprose/hprose.js"></script>

<script src="<?php echo $base_url;?>/common/plugins/license/js/license.js"></script>
<script src="<?php echo $base_url;?>/common/plugins/shop/js/shopping.js"></script>



