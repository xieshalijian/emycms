<link href="{$template_path}/visual/modules/category/category-title/css/style-2.css" rel="stylesheet">
<div class="col-md-12">
    <ul class="category-title-ul category-title-ul-$_id">
    {loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
    {loop categories_new_nav($cat['catid'],$_titlenum,$_textnum) $cat}
    <li>
        <a href="{$cat['url']}" title="{$cat['catname']}">
            <span cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit ">
            {$cat['catname']}
                </span>
        </a>
    </li>
    {/loop}
    {/loop}
</ul>
</div>

<style type="text/css">
    .category-title ul.category-title-ul-$_id li a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .category-title ul.category-title-ul-$_id li a:hover,
    .category-title ul.category-title-ul-$_id li a.active{
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }

</style>
