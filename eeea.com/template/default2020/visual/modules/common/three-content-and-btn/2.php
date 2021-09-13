

<link href="{$template_path}/visual/modules/common/three-content-and-btn/css/style-2.css" rel="stylesheet">
<div class="three-content-and-btn-title">
    <ul class="index-title-ul index-title-ul-$_id">
        {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
        {loop categories($cat['catid']) $cat}
        <li>
            <a title="{$cat['catname']}" href="{$cat['url']}" target="_blank" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
                {$cat['catname']}
            </a>
        </li>
        {/loop}
        {/loop}
    </ul>
</div>
<style>
    ul.index-title-ul-$_id li a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    ul.index-title-ul-$_id li.index-title-ul-$_id a:hover,
    ul.index-title-ul-$_id li.index-title-ul-$_id a.active {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }

    ul.index-title-ul-$_id li.index-title-ul-$_id a:before
    {
        background-color:$_link-hover-color;
    }
    ul.index-title-ul-$_id li.index-title-ul-$_id a:after {
        border-left-color:$_link-hover-color;
    }
</style>

