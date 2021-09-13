<?php defined('ROOT') or exit('Can\'t Access !'); ?>



<?php echo template('bottom.html'); ?>



<div class="footer">
    <div class="container">
            <div class="copyright">
                <p>
                    <span class="cmseasyedit"  >
                        <?php echo get('site_right');?>
                    </span>
                    <a title="<?php echo get('sitename');?>" href="<?php echo get('site_url');?>" class="cmseasyedit"  >
                        <?php echo get('sitename');?>
                    </a>.
                </p>
                <p>
                    <?php if(config::get('site_icp')) { ?>
                    <a rel="nofollow" href="<?php echo get('icp_url');?>" class="cmseasyedit"  >
                        <?php echo get('site_icp');?>
                    </a>
                    <?php } ?>
                    <?php if(config::get('site_beian_number')) { ?>&nbsp;&nbsp;<a rel="nofollow" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo get('site_beian_number');?>" rel="nofollow">
                    <img src="<?php echo $base_url;?>/images/g.png" width="20">
                    <span class=" cmseasyedit"   >
  <?php echo lang('gong_wang_an_bei');?>
  </span>
                    <span class=" cmseasyedit"  >
                    <?php echo get('site_beian_number');?>
                    </span>
                </a>
                    <?php } ?>&nbsp;&nbsp;<?php echo getCopyRight();?>
                    <?php if(get('guestbook_enable')) { ?>&nbsp;&nbsp;<a rel="nofollow" title="<?php echo lang('feedback');?>" href="<?php echo url('guestbook');?>" class="cmseasyedit"   ><?php echo lang('feedback');?></a><?php } ?><?php if(config::get('opguestadd')=='1') { ?>&nbsp;&nbsp;<a rel="nofollow" href="<?php echo $base_url;?>/?g=1"><?php echo lang('opguestadd');?></a><?php } ?>&nbsp;&nbsp;<a href="<?php echo $site_map;?>" title="<?php echo lang('sitemap');?>" class="cmseasyedit"   ><?php echo lang('sitemap');?></a><?php if(get('saic_pic')) { ?> <a href='http://www.sgs.gov.cn/lz/licenselink.do>?nethod=licenceView&entyID=<?php echo get('saic_pic');?>'><img src='<?php echo $base_url;?>/images/gongshang.png' width='20'></a><?php } ?>

                </p>
            </div>
    </div>
</div>


<div class="servers">
    <!--[if (gte IE 7)|!(IE)]><!-->
    <!-- 在线客服 -->
    <?php echo template('system/servers.html'); ?>
    <![endif]-->
    <!-- 短信 -->
    <?php echo template('system/sms.html'); ?>
</div>

<div class="servers-wap">
    <?php if(get('wap_style_color')=='1') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap1.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='2') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap2.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='3') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap3.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='4') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap4.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='5') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap5.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='6') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap6.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='7') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap7.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='8') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap8.css" rel="stylesheet" />
    <?php } elseif (config::get('wap_style_color')=='9') { ?>
    <link href="<?php echo $skin_path;?>/css/wap/wap9.css" rel="stylesheet" />
    <?php } else { ?>
    <?php } ?>
    <?php if(config::get('wap_foot_nav')=='1') { ?>
    <?php echo template('system/foot_nav_a.html'); ?>
    <?php } elseif (config::get('wap_foot_nav')=='2') { ?>
    <?php echo template('system/foot_nav_b.html'); ?>
    <?php } elseif (config::get('wap_foot_nav')=='3') { ?>
    <?php echo template('system/foot_nav_c.html'); ?>
    <?php } else { ?>
    <?php } ?>
</div>







<?php echo template_public('common/plugins/public/foot-js.html'); ?>
<?php echo template('foot_js.html'); ?>



</body>
</html>