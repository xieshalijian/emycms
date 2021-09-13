<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<div class="clearfix view-html">
<nav class="navbar navbar-default">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
 <span class="sr-only">
 <?php echo get('sitename');?>
 </span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<div class="navbar-brand text-center">
 <a href="<?php echo $base_url;?>/" title="<?php echo get('sitename');?>"><img src="<?php echo get('site_logo');?>" class="img-responsive cmseasyeditimg" alt="<?php echo get('sitename');?>" /></a>
</div>
</div> <?php echo nav(1);?>
</div>
</nav>
</div>