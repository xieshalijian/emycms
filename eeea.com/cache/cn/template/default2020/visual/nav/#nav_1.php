<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<div id="navbar" class="nav navbar-nav navbar-collapse collapse">
    <ul class="nav navbar-nav">
        <li class="oen<?php if($topid==0) { ?> active<?php } ?>">
            <a href="<?php echo $base_url;?>/">
                <span class=" cmseasyedit"   >
                <?php echo lang('homepage');?>
                    </span>
            </a>
        </li>
        <?php if(is_array(categories_new_nav()))
foreach(categories_new_nav() as $t) { ?>
        <li class="oen<?php if(isset($topid) && $topid==$t['catid']) { ?> active<?php } ?><?php if(count((array)$t['children'])) { ?> dropdown<?php } ?>">
            <a href="<?php echo $t['url'];?>"<?php if(config::get('nav_blank')==1) { ?> target=" _blank"<?php } ?><?php if(count((array)$t['children'])) { ?> class="toogle"<?php } ?>>
            <span cmseasy-id="<?php echo $t['catid'];?>"   class="cmseasyedit">
                <?php echo $t['catname'];?>
            </span>
            <?php if(count((array)$t['children'])) { ?><span class="caret"></span><?php } ?></a>

            <?php if(count((array)$t['children'])) { ?>
                <ul class="two dropdown-menu">
                    <?php if(is_array($t['children']))
foreach($t['children'] as $t1) { ?>
                    <li<?php if(count((array)$t1['children'])) { ?> class="dropdown-submenu"<?php } ?>>
                    <a title="<?php echo $t1['catname'];?>" href="<?php echo $t1['url'];?>" cmseasy-id="<?php echo $t1['catid'];?>"   class="cmseasyedit<?php if(count((array)$t1['children'])) { ?> toogle<?php } ?>"><?php echo $t1['catname'];?></a>
                    <?php if(count((array)$t1['children'])) { ?>
                    <ul class="three dropdown-menu">
                        <?php if(is_array($t1['children']))
foreach($t1['children'] as $t2) { ?>
                        <li<?php if(count((array)$t2['children'])) { ?> class="dropdown-submenu"<?php } ?>>
                        <a title="<?php echo $t2['catname'];?>" href="<?php echo $t2['url'];?>" cmseasy-id="<?php echo $t2['catid'];?>"   class="cmseasyedit<?php if(count((array)$t2['children'])) { ?> toogle<?php } ?>"><?php echo $t2['catname'];?></a>
                        <?php if(count((array)$t2['children'])) { ?>
                        <ul class="four dropdown-menu">
                            <?php if(is_array($t2['children']))
foreach($t2['children'] as $t3) { ?>
                            <li<?php if(count((array)$t3['children'])) { ?> class="dropdown-submenu"<?php } ?>>
                            <a title="<?php echo $t3['catname'];?>" href="<?php echo $t3['url'];?>" cmseasy-id="<?php echo $t3['catid'];?>"   class="cmseasyedit<?php if(count((array)$t3['children'])) { ?> toogle<?php } ?>"><?php echo $t3['catname'];?></a>
                            <?php if(count((array)$t3['children'])) { ?>
                            <ul class="five dropdown-menu">
                                <?php if(is_array($t3['children']))
foreach($t3['children'] as $t4) { ?>
                                <li>
                                    <a title="<?php echo $t4['catname'];?>" href="<?php echo $t4['url'];?>" cmseasy-id="<?php echo $t4['catid'];?>"   class="cmseasyedit"><?php echo $t4['catname'];?></a>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                        </li>

                        <?php } ?>
                    </ul>
                    <?php } ?>
                    </li>

                    <?php } ?>
                </ul>
            <?php } ?>

        </li>
        <?php } ?>
        <?php if(config::get('lang_open')=='1') { ?>

        <li id="fat-menu" class="one dropdown">
            <a data-toggle="modal" data-target="#myModalLang"><img src="<?php echo getlangimg(lang::getistemplate());?>" width="20"> <?php echo getlangurlname(lang::getistemplate());?>
                <span class="caret"></span>
            </a>
        </li>
        <?php } ?>
        <?php if(config::get('site_login')=='1') { ?>
        <li id="login" class="one head-loginoen dropdown"></li>
        <?php } ?>
       
    </ul>
</div>