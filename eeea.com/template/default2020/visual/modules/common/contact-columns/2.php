<link href="{$template_path}/visual/modules/common/contact-columns/css/style-2.css" rel="stylesheet">


<div class="contact-columns-right contact-columns-right-$_id">
    <div class="contact-columns-right-bg-txt">
        {loop plugins::categoryinfo($_catid) $cat}
        <h4>
            <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">{$cat['catname']}</span>
        </h4>
        <p>
            <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="subtitle" class="cmseasyedit">{$cat['subtitle']}</span>
        </p>

        <h5>
            <i class="icon-call-end"></i>：<span class="column-title cmseasyedit" cmseasy-id="tel" cmseasy-table="lang" cmseasy-field="template">{get('tel')}</span>
        </h5>
        <h5>
            <i class="icon-drop"></i>：<span class="column-title cmseasyedit" cmseasy-id="address" cmseasy-table="lang" cmseasy-field="template">{get('address')}</span>
        </h5>
        <a class="more" title="{$cat['catname']}" href="{$cat['url']}">
            <em></em>
            <span class="column-title cmseasyedit" cmseasy-id="more" cmseasy-table="lang" cmseasy-field="template">
                {lang('more')}
            </span> &gt;
        </a>
        {/loop}
    </div>
    <div class="contact-columns-right-bg"></div>
</div>


<style type="text/css">

    .contact-columns-right-$_id {
        height:$_height;
        background:$_background-color;
        background-image:url("{$template_path}/visual/modules/common/contact-columns/images/contact-columns-right.png");
        background-size:cover;
    }
    .contact-columns-right a.more em{
        background-image:url("{$template_path}/visual/modules/common/contact-columns/images/contact-columns-right-ico.png");
    }

    .contact-columns-right-$_id h4 span {
        font-size:$_title-size;
        color:$_title-color;
    }

    .contact-columns-right-$_id h4:span,.contact-columns-right-$_id h4 span:hover {
        color:$_title-hover-color;
    }

    .contact-columns-right-$_id p span {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .contact-columns-right-$_id p span:hover,.contact-columns-right-$_id p:hover span {
        color:$_subtitle-hover-color;
    }

    .contact-columns-right-$_id p:after {
        background-color:$_subtitle-color;
    }


    .contact-columns-right-$_id h5 span,.contact-columns-right-$_id h5 i {
        font-size:$_p-size;
        color:$_p-color;
    }

    .contact-columns-right-$_id h5:hover span,
    .contact-columns-right-$_id h4 span:hover,
    .contact-columns-right-$_id h5:hover i,
    .contact-columns-right-$_id h4 i:hover{
        color:$_p-hover-color;
    }

    .contact-columns-right-$_id a.more {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .contact-columns-right-$_id a.more:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>
