<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-ecoding/css/style.css" rel="stylesheet">


        {if $archive['ecoding']}
<div class="content-ecoding content-ecoding-$_id">
        <span>{lang('ecoding')}</span>
    ：
    <span class="cmseasyedit" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="ecoding">
        {$archive['ecoding']}
    </span>
</div>
        {/if}


<style type="text/css">
    .content-ecoding-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-ecoding-$_id:hover {
        color:$_p-hover-color;
    }
</style>
