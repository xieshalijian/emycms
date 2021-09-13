<link href="{$template_path}/visual/modules/common/contact-columns/css/style-1.css" rel="stylesheet">



{loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<div class="contact-columns-left contact-columns-left-$_id">
            <h4>
                <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                    {$cat['catname']}
                </span>
            </h4>
    {if $cat['subtitle']}
            <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit subtitle">
					{$cat['subtitle']}
				</span>
{/if}
            <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="categorycontent" class="cmseasyedit content">
                {$cat['categorycontent']}
            </p>

            <a class="more" title="{$cat['catname']}" href="{$cat['url']}">
                <span class="column-title cmseasyedit" cmseasy-id="more" cmseasy-table="lang" cmseasy-field="template">
                    {langtemplate_more}
                </span>  &gt;
            </a>
</div>
{/loop}



<style type="text/css">

    .contact-columns-left-$_id {
        height: $_height;
        background: $_background-color;
    }
    .contact-columns-left-$_id h4 span {
        font-size:$_title-size;
        color:$_title-color;
    }
    .contact-columns-left-$_id h4 span:hover {
        color:$_title-hover-color;
    }
    .contact-columns-left-$_id span.subtitle {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .contact-columns-left-$_id span.subtitle:hover {
        color:$_subtitle-hover-color;
    }

    .contact-columns-left-$_id p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .contact-columns-left-$_id p:hover {
        color:$_p-hover-color;
    }
    .contact-columns-left-$_id a.more
    {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background-color:$_btn-background-color ;
    }

    .contact-columns-left-$_id a.more:hover,
    .contact-columns-left-$_id:hover a.more {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        background-color:$_btn-background-hover-color;
    }


</style>
