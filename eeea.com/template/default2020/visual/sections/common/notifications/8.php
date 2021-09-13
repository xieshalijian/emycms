<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/notifications/css/style.css" rel="stylesheet">



<ul class="breadcrumb breadcrumb-$_id">
        <span class="glyphicon glyphicon-list"></span>
        <li><a href="<?php echo $base_url;?>/">{lang('homepage')}</a></li>

        <?php
        if(front::get('case') == 'announ'){
            ?>
            <li><a title="{lang('siteannoun')}" href="#">{lang('siteannoun')}</a></li>
            <?php
        }elseif(front::get('case') == 'guestbook'){
            ?>
            <li><a title="{lang('guestbook')}" href="#">{lang('guestbook')}</a></li>
            <?php
        }elseif(front::get('case') == 'comment'){
            ?>
            <li><a title="{$t['name']}" href="{$t.url}">{lang('commentlist')}</a></li>
            <?php
        }elseif(front::get('case') == 'type'){
            ?>
            <li>{type::getpositionhtml($type['typeid'])}</li>
            <?php
        }elseif(front::get('case') == 'special'){
            ?>
            <li><a title="{$special['title']}" href="#">{$special['title']}</a></li>
            <?php
        }elseif(front::get('case') == 'tag'){
            ?>
            <li><a title="{$tag}" href="#">{$tag}</a></li>
            <?php
        }elseif(front::get('case') == 'mailsubscription'){
            ?>
            <li><a href="#" title="{lang('mailsubscription')}">{lang('mailsubscription')}</a></li>
            <?php
        }else{
            ?>

            {loop position($catid) $t}
            <li><a title="{$t['name']}" href="{$t.url}">{$t['name']}</a></li>
            {/loop}

            <?php
        }
        ?>
    </ul>



<style type="text/css">
    .breadcrumb-$_id {
        background:$_background-color;
        font-size:$_p-size;
        color:$_p-color;
    }
    .breadcrumb-$_id li a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .breadcrumb-$_id li a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
    .breadcrumb-$_id .glyphicon {
        font-size:$_link-font-size;
        color:$_link-color;
    }
</style>
