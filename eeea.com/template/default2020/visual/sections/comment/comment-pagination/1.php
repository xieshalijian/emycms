<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/comment/comment-pagination/css/style.css" rel="stylesheet">

<div class="comment-pagination">
        {if isset($record_count)}
        {comment_pagination($aid)}
        {/if}
    </div>

<style type="text/css">
    .comment-pagination .pagination #getto_page,
    .comment-pagination .pagination .btn-primary,
    .comment-pagination .pagination li a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .comment-pagination .pagination .btn-primary,
    .comment-pagination .pagination li.active a {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }

</style>
