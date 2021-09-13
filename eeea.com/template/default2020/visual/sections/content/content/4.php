<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content/css/style.css" rel="stylesheet">

<div id="print" class="claerfix content-text content-text-$_id">

<span class="cmseasyedit content" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="content">
                    {$archive['content']}
                </span>
{if $pages>1}
<!-- 内页分页 -->
<div class="content-within-pagination">
    {archive_pagination($archive)}
</div>
{/if}
    </div>


<style type="text/css">

    .content-text-$_id {
        font-size:$_p-size;
        color:$_p-color;
        line-height:1.8;
    }
    .content-text-$_id:hover {
        color:$_p-hover-color;
    }
    .content-text-$_id img {
        max-width:100%;
    }
    .content-text-$_id .content-within-pagination .pagination>li>a,
    .content-text-$_id .content-within-pagination .pagination>li>span {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-text-$_id .content-within-pagination .pagination>.active>a,
    .content-text-$_id .content-within-pagination .pagination>.active>a:focus,
    .content-text-$_id .content-within-pagination .pagination>.active>a:hover,
    .content-text-$_id .content-within-pagination .pagination>.active>span,
    .content-text-$_id .content-within-pagination .pagination>.active>span:focus,
    .content-text-$_id .content-within-pagination .pagination>.active>span:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>
