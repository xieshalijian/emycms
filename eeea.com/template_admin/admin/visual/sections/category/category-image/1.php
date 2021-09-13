<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/category/category-image/css/style.css" rel="stylesheet">

<div class="category-image category-image-$_id">
<img src="{$category[$catid]['image']}"  cmseasy-id="{front::get('catid')}" cmseasy-table="category" cmseasy-field="image" class="cmseasyeditimg img-responsive">
</div>

<style type="text/css">

</style>
