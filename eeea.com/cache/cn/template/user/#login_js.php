<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<?php if(isset($user) && is_array($user)) { ?>

<a class="user-head-dropdown aa toogle" data-toggle="dropdown" >
<img src="<?php echo $user['headimage'];?>" class="img-responsive img-circle headimage pull-left" width="30"><span class="login-txt"><?php echo lang('membercenter');?></span>
<span class="caret"></span>
</a>
<ul class="dropdown-menu dropdown-menu-user">
<?php if(count(pay::getInstance()->getrows())>1 ||
(count(pay::getInstance()->getrows())==1 && count(pay::getInstance()->getrows('pay_code="nopay"'))==0) ){ ?>
<li>
<a rel="external nofollow" href="<?php echo url('manage/orderslist/manage/orders');?>" target="_blank" class="top-reg">
<i class="icon-list"></i> <?php echo lang('order');?>
</a>
</li>
<li>
<a rel="external nofollow" href="<?php echo url('manage/consumptionlist/manage/consumption');?>" target="_blank" class="top-reg">
<i class="icon-wallet"></i> <?php echo lang('finance');?>
</a>
<a href="<?php echo url('archive/consumption');?>" class="paycheck">
<?php echo lang('recharge');?>
</a>

</li>
<li>
<a href="<?php echo url('archive/orders');?>">
<i class="icon-basket"></i> <?php echo lang('shoppingcart');?>
</a>
</li>
<?php } ?>
<li>
<a rel="external nofollow" href="<?php echo url('manage/collectlist/manage/user');?>" target="_blank" class="top-reg">
<i class="icon-heart"></i> <?php echo lang('collection');?>
</a>
</li>
<li>
<a href="<?php echo url('user/index');?>">
<i class="icon-user"></i> <?php echo lang('membercenter');?>
</a>
</li>
<?php if($user['groupid']=='2') { ?><li>
<a rel="external nofollow" href="<?php echo $admin_url;?>" target="_blank" class="top-login">
<i class="icon-grid"></i> <?php echo lang('admin_login');?>
</a>
</li><?php } ?>
<li class="line"></li>
<li>
<a href="<?php echo url('user/edit/table/user');?>">
<i class="icon-note"></i> <?php echo lang('edituserinfo');?>
</a>
</li>
<li>
<a href="<?php echo url('user/logout');?>">
<i class="icon-logout"></i> <?php echo lang('logout');?>
</a>
</li>
</ul>


<?php }else{ ?>
<div class="user-panel">
<a rel="external nofollow" title="<?php echo lang('login');?>" href="<?php echo url('user/login/loginurl/1');?>" class="top-login"><?php echo lang('login');?></a>
<?php if(config::get('reg_on')=='1') { ?>
<a class="top-reg" rel="external nofollow" title="<?php echo lang('register');?>" href="<?php echo url('user/register');?>"><?php echo lang('register');?></a>
<?php } ?>
</div>
<?php } ?>