<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-statistics-title/css/style.css" rel="stylesheet">

<div class="content-statistics content-statistics-$_id">
                <span class="content-statistics-title cmseasyedit" cmseasy-id="view" cmseasy-table="lang" cmseasy-field="template">
                    {lang('view')}
                </span>
    <span class="content-statistics-title">
        ：</span>
        {view_js($archive['aid'])}

</div>

<style type="text/css">

    .content-statistics-$_id .content-statistics-title {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-statistics-$_id .content-statistics-title:hover {
        color:$_title-hover-color;
    }
    .content-statistics-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-statistics-$_id:hover {
        color:$_p-hover-color;
    }
</style>
