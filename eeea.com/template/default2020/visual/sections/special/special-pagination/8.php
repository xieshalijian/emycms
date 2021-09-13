<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/special/special-pagination/css/style.css" rel="stylesheet">

{if isset($pages)}

<div class="special-pagination special-pagination-$_id">
    {special::pagination($special)}
</div>

        {/if}


<style type="text/css">
    .special-pagination-$_id .pagination #getto_page,
    .special-pagination-$_id .pagination .btn-primary,
    .special-pagination-$_id .pagination li a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .special-pagination-$_id .pagination .btn-primary,
    .special-pagination-$_id .pagination li.active a {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }

</style>

