<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-pagination/css/style.css" rel="stylesheet">
<div class="content-pagination content-pagination-$_id">

    {if $archive['p']['aid']}
    <span class="content-archivep">
                    <a href="{$archive['p']['url']}">
                        <strong class=" cmseasyedit" cmseasy-id="archivep" cmseasy-table="lang" cmseasy-field="template">
                            {lang('archivep')}
                        </strong>
                        {$archive['p']['title']}
                    </a>
                </span>
    {else}
    <span class="content-archivep">
                    <a>
                        <strong class=" cmseasyedit" cmseasy-id="archivep" cmseasy-table="lang" cmseasy-field="template">
                            {lang('archivep')}
                        </strong>
                        {lang('nopage')}
                    </a>
                </span>
    {/if}
    {if $archive['n']['aid']}
    <span class="content-archiven">
                    <a href="{$archive['n']['url']}">
                        <strong class=" cmseasyedit" cmseasy-id="archiven" cmseasy-table="lang" cmseasy-field="template">
                            {lang('archiven')}
                        </strong>
                        {$archive['n']['title']}
                    </a>
                </span>
    {else}
    <span class="content-archiven">
                    <a>
                        <strong class=" cmseasyedit" cmseasy-id="archiven" cmseasy-table="lang" cmseasy-field="template">
                            {lang('archiven')}
                        </strong>
                        {lang('nopage')}
                    </a>
                </span>
    {/if}
    <div class="clearfix"></div>
</div>

<style type="text/css">
    .content-pagination-$_id span {
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .content-pagination-$_id span:hover {
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
    .content-pagination-$_id a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .content-pagination-$_id a:hover {
        color:$_link-hover-color;
    }

</style>
