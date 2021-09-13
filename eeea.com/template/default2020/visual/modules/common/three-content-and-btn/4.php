

<link href="{$template_path}/visual/modules/common/three-content-and-btn/css/style-4.css" rel="stylesheet">

    {loop plugins::categoryinfo($_catid) $cat}
    <div class="three-content-and-btn-more three-content-and-btn-more-$_id">
        <a title="{$cat['catname']}" href="{$cat['url']}">
            <span class="cmseasyedit" cmseasy-id="more" cmseasy-table="lang" cmseasy-field="template">
            {langtemplate_more}
            </span>
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>
    </div>
    {/loop}
    <style>
        .three-content-and-btn-more-$_id a {
            border-radius:$_btn-border-radius;
            color:$_btn-text-color;
            font-size:$_btn-size;
            background:$_btn-background-color;
            border-color:$_btn-border-color;
        }
        .three-content-and-btn-more-$_id a:hover {
            color:$_btn-text-hover-color;
            background:$_btn-background-hover-color;
            border-color:$_btn-border-hover-color;
        }
    </style>
