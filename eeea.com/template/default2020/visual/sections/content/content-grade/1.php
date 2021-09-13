<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-grade/css/style.css" rel="stylesheet">
<div class="content-rating content-rating-$_id">

                <span class=" cmseasyedit" cmseasy-id="rating" cmseasy-table="lang" cmseasy-field="template">
                    {lang('rating')}
                </span>
    <span>：</span>
        <span class="strgrade cmseasyedit" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="strgrade">
                    {$archive['strgrade']}
                </span>

    </div>

<style type="text/css">

    .content-rating-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-rating-$_id:hover {
        color:$_p-hover-color;
    }
    .content-rating-$_id .strgrade {
        font-size:$_btn-size;
        color:$_btn-text-color;
    }
    .content-rating-$_id .strgrade:hover {
        color:$_btn-text-hover-color;
    }
</style>
