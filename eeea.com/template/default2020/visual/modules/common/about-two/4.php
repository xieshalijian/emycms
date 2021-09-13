<link href="{$template_path}/visual/modules/common/about-two/css/style-2.css" rel="stylesheet">

{loop plugins::categoryinfo($_catid) $cat}
<div class="about-two-left-img about-two-left-img-$_id">
    <img alt="{$cat['catname']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="image" class="cmseasyeditimg lazy img-auto" src="{$cat['image']}" />
    <div class="clearfix"></div>
</div>
{/loop}
<div class="clearfix"></div>
<style type="text/css">
    .about-two-left-img-$_id {
        height: $_height;
        background:$_background-color;

    }
    .about-two-left-img-$_id:hover {
        background:$_background-hover-color;
    }
</style>

