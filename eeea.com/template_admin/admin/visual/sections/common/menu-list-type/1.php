<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/menu-list-type/css/style.css" rel="stylesheet">

<div class="menu-list-type menu-list-type-$_id">
    <ul class="nav panel-group sidebar-menu" id="nav_parent-$_id">
        {loop typies() $t}
        <li class="panel">
            <a title="{$t['typename']}" class="panel-heading collapsed{if isset($topid) && $topid==$t[typeid]} active{/if}" data-parent="#nav_parent-$_id"{if count((array)$t['children'])} data-toggle="collapse" href="#collapse{$t['typeid']}"{else} href="{$t['url']}"{/if}>
            <span cmseasy-id="{$t['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit">
                {$t['typename']}
            </span>
            {if count((array)$t['children'])}<span class="caret"></span>{/if}
            </a>
            {if count((array)$t['children'])}
            <ul class="nav submenu collapse" id="collapse{$t['typeid']}">
                {loop $t['children'] $t1}
                <li>
                    <a title="{$t1['typename']}" class="panel-heading collapsed"{if count((array)$t1['children'])} data-toggle="collapse" href="#collapse{$t1['typeid']}"{else} href="{$t1['url']}"{/if}>
                    &nbsp;&nbsp;
                    <span cmseasy-id="{$t1['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit">
                            {$t1['typename']}
                        </span>
                    {if count((array)$t1['children'])}<span class="caret"></span>{/if}
                    </a>
                    {if count((array)$t1['children'])}
                    <ul class="nav submenu collapse" id="collapse{$t1['typeid']}">
                        {loop $t1['children'] $t2}
                        <li>
                            <a title="{$t2['typename']}" class="panel-heading collapsed"{if count((array)$t2['children'])} data-toggle="collapse" href="#collapse{$t2['typeid']}"{else}  href="{$t2['url']}"{/if}>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <span cmseasy-id="{$t2['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit">
                                    {$t2['typename']}
                                </span>
                            {if count((array)$t2['children'])}<span class="caret"></span>{/if}
                            </a>
                            {if count((array)$t2['children'])}
                            <ul class="nav submenu collapse" id="collapse{$t2['typeid']}">
                                {loop $t2['children'] $t3}
                                <li>
                                    <a title="{$t3['typename']}" class="panel-heading collapsed"{if count((array)$t3['children'])} data-toggle="collapse" href="#collapse{$t3['typeid']}"{else}  href="{$t3['url']}"{/if}>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span cmseasy-id="{$t3['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit">
                                    {$t3['typename']}
                                </span>
                                    {if count((array)$t3['children'])}<span class="caret"></span>{/if}
                                    </a>
                                    {if count((array)$t3['children'])}
                                    <ul class="nav submenu collapse" id="collapse{$t3['typeid']}">
                                        {loop $t3['children'] $t4}
                                        <li>
                                            <a title="{$t4['typename']}" class="panel-heading collapsed" data-toggle="collapse" href="{$t4['url']}">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span cmseasy-id="{$t4['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit">
                                    {$t4['typename']}
                                </span>
                                            </a>
                                        </li>
                                        {/loop}
                                    </ul>
                                    {/if}
                                </li>
                                {/loop}
                            </ul>
                            {/if}
                        </li>
                        {/loop}
                    </ul>
                    {/if}
                </li>
                {/loop}
            </ul>
            {/if}
        </li>
        {/loop}
    </ul>
</div>


<script src="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/menu-list-type/js/menu-list-type.js"></script>

<style type="text/css">

    .menu-list-type-$_id .sidebar-menu>li>a {
        font-size:$_link-font-size;
        color:$_link-color;
        background:$_link-background-color;
    }
    .menu-list-type-$_id .sidebar-menu>li>a:hover {
        color:$_link-hover-color;
        background:$_link-background-hover-color;
    }

    .menu-list-type-$_id .submenu li a {
        font-size:$_link-sub-font-size;
        color:$_link-sub-color;
        background:$_link-sub-background-color;
    }
    .menu-list-type-$_id .submenu li a:hover {
        color:$_link-sub-hover-color;
        background:$_link-sub-background-hover-color;
    }
 	.menu-list-type-$_id .sidebar-menu a.active:before {
        background:$_link-border-color;
    }

</style>
