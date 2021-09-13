<link href="{$template_path}/visual/modules/common/about-columns/css/style-1.css" rel="stylesheet">


{loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<div class="about-columns-text about-columns-text-$_id">
            <h4>
                <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                    {$cat['catname']}
                </a>
            </h4>

    {if $cat['subtitle']}
            <div cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit subtitle">
                {$cat['subtitle']}
            </div>
{/if}
            <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="categorycontent" class="cmseasyedit content">
                {$cat['categorycontent']}
            </p>

    <em></em>
</div>
{/loop}



<style type="text/css">
    .shopping-pics-thumbs .shopping-pics-small-item {

    }
    .about-columns-text-$_id h4 a {
        font-size:$_title-size;
        color:$_title-color;
    }
    .about-columns-text-$_id h4 a:hover {
        color:$_title-hover-color;
    }
    .about-columns-text-$_id .subtitle {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .about-columns-text-$_id .subtitle:hover {
        color:$_subtitle-hover-color;
    }
    .about-columns-text-$_id p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .about-columns-text-$_id p:hover {
        color:$_p-hover-color;
    }
    .about-columns .container {
        background:$_background-color;
    }
</style>


