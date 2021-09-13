<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-author/css/style.css" rel="stylesheet">
<div class="content-author content-author-$_id">

                <span class="content-author-title cmseasyedit" cmseasy-id="author" cmseasy-table="lang" cmseasy-field="template">
                    {lang('author')}
                </span>
    <span class="content-author-title">
    ：
        </span>
        <span class="cmseasyedit" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="author">
                    {$archive['author']}
                </span>
    </div>

<style type="text/css">

    .content-author-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-author-$_id:hover {
        color:$_p-hover-color;
    }
    .content-author-$_id .content-author-title {

    }

</style>
