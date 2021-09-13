

<link href="{$template_path}/visual/modules/common/left-pic-and-right-content/css/style-2.css" rel="stylesheet">
<div class="left-pic-and-right-content-title">
<div class="left-pic-and-right-content-title-ul left-pic-and-right-content-title-ul-$_id">
<ul>
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
</div>
	<style>
        .left-pic-and-right-content-title-ul-$_id ul li a {
            color:$_link-color;
            border-color:$_link-border-color;
            background-color:$_link-background-color;
            font-size:$_link-font-size;
            border-radius:$_link-border-radius;
        }
        .left-pic-and-right-content-title-ul-$_id ul li a:hover,
        .left-pic-and-right-content-title-ul-$_id ul li a.active {
            color:$_link-hover-color;
            border-color:$_link-border-hover-color;
            background-color:$_link-background-hover-color;
        }

        .left-pic-and-right-content-title-ul-$_id ul li a:before
        {
            background-color:$_link-hover-color;
        }
        .left-pic-and-right-content-title-ul-$_id ul li a:after {
            border-left-color:$_link-hover-color;
        }
    </style>

