<link href="{$template_path}/visual/modules/type/type-title/css/style-2.css" rel="stylesheet">
<ul class="type-title-ul type-title-ul-$_id">
    {loop typies($_typeid) $t}
    {loop $t['children'] $t1}
    <li>
        <a href="{$t1['url']}" title="{$t1['typename']}">
            <span cmseasy-id="{$t1['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit ">
            {$t1['typename']}
                </span>
        </a>
    </li>
    {/loop}
    {/loop}
</ul>

<style type="text/css">
    ul.type-title-ul-$_id li a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    ul.type-title-ul-$_id li a:hover,
    ul.type-title-ul-$_id li a.active{
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }

</style>
