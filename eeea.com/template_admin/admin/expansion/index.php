
<style type="text/css">
    .quick-navb {margin:0px -10px;}
    .list-group-item { min-height:175px; margin:0px 10px 10px 10px; padding:25px 15px 20px 15px; -moz-box-shadow:0px 8px 15px #eee;-webkit-box-shadow:0px 8px 15px #eee;box-shadow:0px 8px 15px #eee;border:1px solid #ddd; position: relative;}
    .list-group-item span.app-icon {display:inline-block; width:66px; height:66px; line-height: 66px; margin:0px auto; font-size:26px;color:#424950; background:#eee;border-radius:50%;}
    .list-group-item span.expansion-price { display:inline-block; float:right; margin:5px 0px 0px 10px;background:#28D094; border-radius: 3px; padding:0px 5px;color:#fff;text-align:center;}
    .list-group-item span.free {background:#eee;color:#333;text-align:center;color: rgba(0, 0, 0, 0.45);}
    .list-group-item .vip-free {position:absolute; display:inline-block; margin:0px 0px 5px 0px;padding:0px 5px;border-radius: 3px;background:#eee;color:#333;text-align:center;color: rgba(0, 0, 0, 0.45);}
    .list-group-item strong { font-size:18px; line-height:38px; color:#000; font-weight:300;}
    .list-group-item:last-child {border-radius:8px; }
    .list-group-item-b:last-child {border-radius:2px; }
    .list-group-item:hover,.glyphicon-list-alt {background:#424950;color:#fff;box-shadow:0px 8px 15px #aaa;-o-transition: all 0.15s, 0.15s;-moz-transition: all 0.15s, 0.15s;-webkit-transition: all 0.15s, 0.15s;border:1px solid #424950;
    }
    .quick-navb-item {margin-bottom:20px;}
    .quick-navb-item:hover strong {color:#fff;}
    .list-group-item p {clear: both;
        margin: 0px;
        height: 48px;
        overflow: hidden;
        font-size:0.8rem;
        text-overflow: ellipsis;
        line-height:160%;
    }

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
</style>

<div class="main-right-box">

    <div class="box" id="box">
        <h5><?php echo lang_admin('apps');?>
            <span class="pull-right">

     <?php if($returndata['static']) { ?>
         <?php echo $returndata['userdata']['username'];?> | <span style="color:#ff9149">￥<?php echo $returndata['userdata']['menoy'];?></span> |
            <a class="btn btn-primary"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('app/close/index/1',true);?>" ><?php echo lang_admin('sign_out');?></a>
         <a class="btn btn-success"  href="javascript:void(0);" name="buy_usermenoy" ><?php echo lang_admin('recharge');?></a>
         <a class="btn btn-default" href="https://u.cmseasy.cn/index.php?case=user&act=index" target="_blank">
                <i class="icon-user"></i> <?php echo lang_admin('service_centre');?>
            </a>

     <?php } else { ?>
         <a class="btn btn-primary" data-toggle="modal" data-target="#myDownloadfileModal" href="#" ><?php echo lang_admin('login');?></a>
         <a class="btn btn-success"  href="https://u.cmseasy.cn/index.php?case=user&act=register" ><?php echo lang_admin('register');?></a>
     <?php } ?>
        </h5>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('expansion/index',true);?>" data-dataurlname="<?php echo lang_admin('default_extend');?>">
                    <?php echo lang_admin('installeid_extend');?>
                </a>
            </li>
            <?php if(config::getadmin('extend_view')) { ?>
                <li>
                    <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify('act/buyapps/type/all');?>" data-dataurlname="<?php echo lang_admin('all').lang_admin('extend');?>">
                        <?php echo lang_admin('extend_online');?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="blank30"></div>
        <div class="quick-navb">
            <!--公告-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item" href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url ;?>/index.php?case=table&act=list&table=announcement&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('announ');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-speech"></span>
                            </div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('announ');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('publish_website_announcement_information');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>


            <!--评论-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item" href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url ;?>/index.php?case=table&act=list&table=comment&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('comment');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-bubbles"></span>
                            </div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('comment');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('review_and_response_to_content_comments');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>




            <!--自定义字段-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url ;?>/index.php?case=field&act=list&table=archive&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('custom_fields');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-puzzle"></span> 	</div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('custom_fields');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('content_and_user_defined_field_manage');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--图库-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url ;?>/index.php?case=image&act=listdir&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('picture_library');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-picture"></span> 	</div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('picture_library');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('content_and_user_defined_field_manage');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--推荐位-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url ;?>/index.php?case=table&act=setting&table=archive&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('recommendation_bit');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-arrow-up"></span> 	</div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('recommendation_bit');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('featured_first_introduction');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--侧边栏-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('menu/list',true);?>" data-dataurlname="<?php echo lang_admin('sidebar');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-equalizer"></span> 	</div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('sidebar');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('sidebar');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(session::get('ver') == 'corp'){ ?>


                <!--批量导入-->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url ;?>/index.php?case=table&act=import&table=archive&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('batch_import');?>">
                    <div class="row">
                        <div class="list-group-item">
                            <div class="col-xs-4 col-md-3">
                                <div class="row text-center">
                                    <span class="app-icon icon-refresh"></span> 	</div>
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <p>
                                    <strong>
                                        <?php echo lang_admin('batch_import');?>
                                    </strong>
                                </p>
                                <p>
                                    <?php echo lang_admin('batch_import_content_to_database');?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="apps-config-btn  apps-config-btn-no">
                                <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--群发-->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/mail/table/user',true);?>" data-dataurlname="<?php echo lang_admin('group_sending');?>">
                    <div class="row">
                        <div class="list-group-item">
                            <div class="col-xs-4 col-md-3">
                                <div class="row text-center">
                                    <span class="app-icon icon-speech"></span> 	</div>
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <p>
                                    <strong>
                                        <?php echo lang_admin('group_sending');?>
                                    </strong>
                                </p>
                                <p>
                                    <?php echo lang_admin('batch_import_content_to_database');?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="apps-config-btn  apps-config-btn-no">
                                <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } else { ?>

                <!--批量导入-->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item" data-toggle="modal" data-target="#myCorpModal">
                    <div class="row">
                        <div class="list-group-item">
                            <div class="col-xs-4 col-md-3">
                                <div class="row text-center">
                                    <span class="app-icon icon-refresh"></span> 	</div>
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <p>
                                    <strong>
                                        <?php echo lang_admin('batch_import');?>
                                    </strong>
                                </p>
                                <p>
                                    <?php echo lang_admin('batch_import_content_to_database');?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="apps-config-btn  apps-config-btn-no">
                                <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--群发-->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item" data-toggle="modal" data-target="#myCorpModal">
                    <div class="row">
                        <div class="list-group-item">
                            <div class="col-xs-4 col-md-3">
                                <div class="row text-center">
                                    <span class="app-icon icon-speech"></span> 	</div>
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <p>
                                    <strong>
                                        <?php echo lang_admin('group_sending');?>
                                    </strong>
                                </p>
                                <p>
                                    <?php echo lang_admin('batch_import_content_to_database');?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="apps-config-btn  apps-config-btn-no">
                                <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <!--微信公众号-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixin/list',true);?>" data-dataurlname="<?php echo lang_admin('wechat_public_number');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-bubbles"></span> 	</div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('wechat_public_number');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('public_number_manage');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>


            <!--熊掌号-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item"  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('xiongzhang/index',true);?>" data-dataurlname="<?php echo lang_admin('author_baidu');?>">
                <div class="row">
                    <div class="list-group-item">
                        <div class="col-xs-4 col-md-3">
                            <div class="row text-center">
                                <span class="app-icon icon-bubble"></span> 	</div>
                        </div>
                        <div class="col-xs-8 col-md-9">
                            <p>
                                <strong>
                                    <?php echo lang_admin('author_baidu');?>
                                </strong>
                            </p>
                            <p>
                                <?php echo lang_admin('batch_import_content_to_database');?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="apps-config-btn  apps-config-btn-no">
                            <a><i class="icon-equalizer"></i> <?php echo lang_admin('administration');?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>


            <!--安装扩展-->
            <?php
            $user_buy_apps=$returndata['appsdata'];
            if (is_array($user_buy_apps))
                foreach($appsdate as $app){
                    $static=false;
                    foreach ($user_buy_apps as $appskey=>$appsval){
                        if(strtolower($appsval['buyid'])==strtolower($app['id']) && ($_SERVER['SERVER_NAME']==$appsval['buyip'] || 'www.'.$_SERVER['SERVER_NAME']==$appsval['buyip']
                                || $_SERVER['SERVER_NAME']=='www.'.$appsval['buyip'])) $static=true;
                    }
                    if(($app['iscorp']==0 || ($app['iscorp'] && session::get('ver') == 'corp')) && $static){
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
                                            <?php if($app['price']>0){ ?><span class="expansion-price">￥<?php echo $app['price'];?></span>
                                            <?php } elseif ($app['iscorp']) { ?>
                                                <span class="expansion-price vip-free">
                                            <?php echo lang_admin('vip_free');?>
                                        </span>
                                            <?php }else{ ?>
                                                <span class="expansion-price free">
                                        <?php echo lang_admin('free');?>
                                    </span>


                                            <?php } ?>

                                        </p>

                                        <p>V<?php echo $app['version'];?> <?php echo $app['desc'];?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="apps-config-btn <?php if($app['installed']) { ?><?php }else{ ?>apps-config-btn-no<?php } ?>">
                                        <?php if($app['installed']){ ?>
                                           <?php if($app['admin_url']!=""){ ?>
                                            <div class="col-xs-6 col-md-6">
                                                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url ;?>/<?php echo $app['admin_url'];?>&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('administration');?>   <?php echo $app['name'];?>">
                                                    <i class="icon-equalizer"></i>
                                                    <?php echo lang_admin('administration');?>
                                                </a>
                                            </div>
                                            <?php }?>
                                            <div class="col-xs-6 col-md-6">
                                                <a href="#" name="btn_uninstall" data-app_id="<?php echo $app['id'];?>" data-url="<?php echo url('app/uninstall/',true);?>"  data-dataurlname="<?php echo lang_admin('uninstall');?>">
                                                    <i class="icon-action-redo"></i>
                                                    <?php echo lang_admin('uninstall');?>
                                                </a>
                                            </div>
                                        <?php }else{ ?>
                                            <a name="btn_install"  data-app_id="<?php echo $app['id'];?>" data-url="<?php echo url('app/install/',true);?>" data-toggle="modal">
                                                <i class="icon-cloud-download"></i>
                                                <?php echo lang_admin('install');?>
                                            </a>
                                        <?php } ?>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
            <script type="text/javascript">
                var app_name="";
                var isdownloading = false;  //下载状态  false 是没有下载的  true是在下载中！
                $(function () {
                    //安装
                    $('[name="btn_install"]').click(function(){
                        app_name = $(this).data('app_id');
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
                                        if (confirm("<?php echo lang_admin('do_you_confirm_the_download_apps');?>")) {
                                            $('#btn_install_'+app_name).html('<i class="icon-cloud-download"></i><?php echo lang_admin('installation_is_in_progress');?>');
                                            downloadFile(app_name);
                                            app_name="";
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
                        if(confirm('<?php echo lang_admin("extension_confirm_uninstall");?>')) {
                            $(this).addClass('label-default').removeClass('label-warning');
                            var url = $(this).data('url');
                            var _this = this;
                            var i = 0;
                            setInterval(function () {
                                if (i > 3) i = 0;
                                $(_this).html('<?php echo lang_admin("unloadings");?>' + '.'.repeat(i));
                                i++;
                            }, 500);
                            $.post(url, {app_id: $(this).data('app_id')}).then(function (res) {
                                console.log(res);
                                gotoinurl("<?php echo url('expansion/index',true);?>");
                                // window.location.reload();
                            }).catch(function (e) {
                                console.error(e);
                            });
                        }
                    });
                    //模态框点击登陆
                    $('#app_login').click(function () {
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
                                    gotoinurl("<?php echo url('expansion/buyapps',true);?>");
                                    /* javascript:window.location.href = "index.php?case=expansion&act=buyapps&type=free&admin_dir={get('admin_dir');?>";*/
                                } else {
                                    alert(data.message);
                                }
                            }
                        });
                    });

                });
                //安装方法
                function downloadFile($f) {
                    var appname = $f;
                    //先创建文件夹
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('app/down/action/prepare-download',true);?>",
                        data:{'appname': appname},
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
                                    data: {'appname': appname},
                                    dataType: 'json',
                                    async: true,
                                    success: function (startdata) {
                                        //下载成功
                                        if(startdata.static) {
                                            //开始解压
                                            $.ajax({
                                                type: "get",
                                                url: "<?php echo url('app/down/action/exzip',true);?>",
                                                data: {'appname': appname},
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

        </div>
        <div class="clearfix"></div>
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
                <button type="button" id="app_login" class="btn btn-primary"><?php echo lang_admin('login');?></button>
                <button type="button" class="btn btn-success" onclick="javascrtpt:window.location.href='https://u.cmseasy.cn/index.php?case=user&act=register'" target="_blank"><?php echo lang_admin('register');?></button>
            </div>
        </div>
    </div>
</div>

<!--商业版扩展提醒-->
<div class="modal fade" id="myCorpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('tips');?></h4>
            </div>
            <div class="modal-body" >
                此功能需开通商业版
            </div>
            <div class="modal-footer">
                <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url;?>/index.php?case=license_client&act=buylicense&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('commercial_authorization');?>" class="btn btn-success" data-dismiss="modal">
                    <?php echo lang_admin('buy');?>
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang_admin('close');?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
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
                        gotoinurl("/index.php?case=expansion&act=index&admin_dir=<?php echo get('admin_dir');?>");
                    } else {
                        alert(data.message);
                    }
                }
            });
        });
    });
</script>


