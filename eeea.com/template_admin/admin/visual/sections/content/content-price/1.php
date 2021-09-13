<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-price/css/style.css" rel="stylesheet">




        {if $archive['attr2']}
<div class="content-price content-price-$_id">

        <span class=" cmseasyedit" cmseasy-id="price" cmseasy-table="lang" cmseasy-field="template">
                    {lang('price')}
                </span>
        ：
        <span class="cmseasyedit" cmseasy-id="unit" cmseasy-table="lang" cmseasy-field="template">
                    {lang('unit')}
                </span>
        <strong>
                    <span class="price cmseasyedit" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="attr2">
                        {$archive['attr2']}
                    </span>
        </strong>
        {else}
        <span class="cmseasyedit" cmseasy-id="not" cmseasy-table="lang" cmseasy-field="template">
                    {lang('not')}
                </span>

</div>
        {/if}

    

<style type="text/css">

    .content-price-$_id {
        font-size:$_p-size;
        color:$_p-color;
    }

    .content-price-$_id:hover {
        color:$_p-hover-color;
    }
    .content-price-$_id .price {
        font-size:$_price-size;
        color:$_price-color;
    }
    .content-price-$_id .price:hover {
        color:$_price-hover-color;
    }
</style>
