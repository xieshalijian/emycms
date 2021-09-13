
<link href="{$template_path}/visual/modules/common/about-two/css/style-1.css" rel="stylesheet">


{loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<div class="about-two-right-text about-two-right-text-$_id">
    {if $cat['subtitle']}
    <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit about-two-subtitle">
        {$cat['subtitle']}
    </p>
    {/if}
    <h4 class="about-two-title">
        <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
            {$cat['catname']}
        </a>
    </h4>

    <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="categorycontent" class="cmseasyedit content">
        {$cat['categorycontent']}
    </p>
    <a title="{$cat['catname']}" href="{$cat['url']}" class="more">
        <span>{langtemplate_more}</span> <span class="glyphicon glyphicon-menu-right"></span>
    </a>
    <div class="blank5"></div>
</div>
{/loop}



<style type="text/css">
    .about-two-right-text-$_id {
        height: $_height;
        background:$_background-color;
    }
    .about-two-right-text-$_id:hover {
        background:$_background-hover-color;
    }
    .about-two-right-text-$_id h4.about-two-title a {
        font-size:$_title-size;
        color:$_title-color;
    }
    .about-two-right-text-$_id h4.about-two-title a:hover {
        color:$_title-hover-color;
    }
    .about-two-right-text-$_id p,
    .list-title-$_id p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .about-two-right-text-$_id p:hover,
    .list-title-$_id p:hover {
        color:$_subtitle-hover-color;
    }

    .about-two-right-text-$_id p.about-two-subtitle {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .about-two-right-text-$_id p.about-two-subtitle:hover {
        color:$_subtitle-hover-color;
    }

    .about-two-right-text-$_id .more {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background-color:$_btn-background-color ;
    }
    .about-two-right-text-$_id .more:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        background-color:$_btn-background-hover-color;
    }
</style>