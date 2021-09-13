<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/category/category-pagination/css/style.css" rel="stylesheet">

        {if isset($pages)}

    <div class="category-pagination category-pagination-$_id">
        {category_pagination($catid)}
    </div>

        {/if}

<style type="text/css">
    .category-pagination-$_id .pagination #getto_page,
    .category-pagination-$_id .pagination .btn-primary,
    .category-pagination-$_id .pagination li a {
        font-size:$_link-font-size !important;
        color:$_link-color !important;
        border-color:$_link-border-color !important;
        border-radius: $_link-border-radius !important;
        background:$_link-background-color !important;
    }
    .category-pagination-$_id .pagination .btn-primary,
    .category-pagination-$_id .pagination li.active a {
        color:$_link-hover-color !important;
        border-color:$_link-border-hover-color !important;
        border-radius: $_link-border-hover-radius !important;
        background:$_link-background-hover-color !important;
    }

</style>
