<link href="{$template_path}/visual/modules/common/about-one/css/style.css" rel="stylesheet">


    {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
    <div class="about-one-title about-one-title-$_id">
        <div class="row">
            <div class="col-md-12">
                {if $cat['subtitle']}
                <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="htmldir" class="cmseasyedit">
                    {$cat['subtitle']}
                </p>
                {/if}
                <h4>
                    <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                        {$cat['catname']}
                    </a>
                </h4>

            </div>
        </div>
    </div>
    <div class="about-one-right-text about-one-right-text-$_id cmseasyedit content" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="categorycontent">
        <p>
            {$cat['categorycontent']}
        </p>
    </div>
    {/loop}
<div class="clearfix"></div>

<style type="text/css">
    .about-one-$_id {
        background:$_background-color;
    }
    .about-one-$_id:hover {
        background:$_background-hover-color;
    }
    .about-one-title-$_id h4 a {
        font-size:$_title-size;
        color:$_title-color;
    }
    .about-one-title-$_id h4 a:hover {
        color:$_title-hover-color;
    }
    .about-one-title-$_id p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .about-one-title-$_id p:hover {
        color:$_subtitle-hover-color;
    }
    .about-one-right-text-$_id {
        font-size:$_p-size;
        color:$_p-color;
        background:$_background-color;
        border-color:$_background-border-color;
    }

    .about-one-right-text-$_id:hover {
        color:$_p-hover-color;
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
</style>
