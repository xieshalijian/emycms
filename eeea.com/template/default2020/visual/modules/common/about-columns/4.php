<link href="{$template_path}/visual/modules/common/about-columns/css/style-2.css" rel="stylesheet">


{loop plugins::categoryinfo($_catid) $cat}
<div class="about-columns-img about-columns-img-$_id">
    <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank">
        <img alt="{$cat['catname']}" src="{$cat['image']}" class="cmseasyeditimg" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="image" />
    </a>
</div>
{/loop}



<style type="text/css">
    .about-columns-img-$_id img {
        height: $_height;
    }
    .about-columns-img:before{
        background: $_background-color;
    }

</style>