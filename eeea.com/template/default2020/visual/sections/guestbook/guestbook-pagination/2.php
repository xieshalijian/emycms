<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/guestbook/guestbook-pagination/css/style.css" rel="stylesheet">

<div class="guestbook-pagination">
        {if isset($record_count)}
        {guestbook_pagination()}
        {/if}
    </div>

<style type="text/css">
    .guestbook-pagination .pagination #getto_page,
    .guestbook-pagination .pagination .btn-primary,
    .guestbook-pagination .pagination li a {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .guestbook-pagination .pagination .btn-primary,
    .guestbook-pagination .pagination li.active a {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }

</style>
