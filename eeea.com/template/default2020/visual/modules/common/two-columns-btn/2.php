<link href="{$template_path}/visual/modules/common/two-columns-btn/css/style-2.css" rel="stylesheet">

{loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<div class="two-columns-btn-item two-columns-btn-item-r two-columns-btn-item-r-$_id">
    <div class="two-columns-btn-title">
        <div class="two-columns-btn-title2">
            <a class="more pull-left" title="{$cat['catname']}" href="{$cat['url']}"><span class="glyphicon glyphicon-chevron-right"></span></a>
            <h4><a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">{$cat['catname']}</a></h4>
        </div>
    </div>
</div>
{/loop}


    <style type="text/css">
        .two-columns-btn-item-r-$_id {
            background:$_background-color;
        }
        .two-columns-btn-item-r-$_id:hover {
            background:$_background-hover-color;
        }
        .two-columns-btn-item-r-$_id h4 a {
            font-size:$_link-font-size;
            color:$_link-color;
            border-color:$_link-border-color;
            border-radius: $_link-border-radius;
            background:$_link-background-color;
        }
        .two-columns-btn-item-r-$_id:hover h4 a {
            color:$_link-hover-color;
            border-color:$_link-border-hover-color;
            border-radius: $_link-border-hover-radius;
            background:$_link-background-hover-color;
        }
        .two-columns-btn-item-r-$_id .two-columns-btn-title a.more {
            font-size:$_btn-size;
            border-color:$_btn-border-color;
            border-radius: $_btn-border-radius;
            color:$_btn-text-color;
            background:$_btn-background-color;
        }
        .two-columns-btn-item-r-$_id .two-columns-btn-title a.more:hover {
            border-color:$_btn-border-hover-color;
            border-radius: $_btn-border-hover-radius;
            color:$_btn-text-hover-color;
            background:$_btn-background-hover-color;
        }
    </style>
