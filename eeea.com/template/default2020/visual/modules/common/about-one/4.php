<link href="{$template_path}/visual/modules/common/about-one/css/style.css" rel="stylesheet">

{loop plugins::categoryinfo($_catid) $cat}
<div class="about-one-right-img about-one-right-img-$_id">
    <a title="{$cat['catname']}" href="{$cat['url']}">
        <img alt="{$cat['catname']}"  cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="image" class="cmseasyeditimg lazy" src="{$cat['image']}" />
    </a>
    <div class="clearfix"></div>
</div>
{/loop}
<div class="clearfix"></div>
<style type="text/css">
    .about-one-right-img-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .about-one-right-img-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
</style>
