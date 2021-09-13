<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/menu-list-categroy/css/style.css" rel="stylesheet">

<div class="menu-list-categroy menu-list-categroy-$_id">
    <ul class="nav panel-group sidebar-menu" id="nav-parent-$_id">
        {loop categories_new_nav() $t}
        <li class="panel">
            <a title="{$t['catname']}" class="panel-heading collapsed{if isset($topid) && $topid==$t['catid']} active{/if}" data-parent="nav-parent-$_id"{if count((array)$t['children'])} data-toggle="collapse" href="#collapse{$t['catid']}"{else} href="{$t['url']}"{/if}>
            <span cmseasy-id="{$t['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                {$t['catname']}
            </span>
            {if count((array)$t['children'])}<span class="caret"></span>{/if}
            </a>
            {if count((array)$t['children'])}
            <ul class="nav submenu collapse" id="collapse{$t['catid']}">
                {loop $t['children'] $t1}
                <li>
                    <a title="{$t1['catname']}" class="panel-heading collapsed"{if count((array)$t1['children'])} data-toggle="collapse" href="#collapse{$t1['catid']}"{else} href="{$t1['url']}"{/if}>
                    &nbsp;&nbsp;
                    <span cmseasy-id="{$t1['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                            {$t1['catname']}
                        </span>
                    {if  count((array)$t1['children'])}<span class="caret"></span>{/if}
                    </a>
                    {if count((array)$t1['children'])}
                    <ul class="nav submenu collapse" id="collapse{$t1['catid']}">
                        {loop $t1['children'] $t2}
                        <li>
                            <a title="{$t2['catname']}" class="panel-heading collapsed"{if count((array)$t2['children'])} data-toggle="collapse" href="#collapse{$t2['catid']}"{else}  href="{$t2['url']}"{/if}>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <span cmseasy-id="{$t2['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                                    {$t2['catname']}
                                </span>
                            {if count((array)$t2['children'])}<span class="caret"></span>{/if}
                            </a>
                            {if count((array)$t2['children'])}
                            <ul class="nav submenu collapse" id="collapse{$t2['catid']}">
                                {loop $t2['children'] $t3}
                                <li>
                                    <a title="{$t3['catname']}" class="panel-heading collapsed"{if count((array)$t3['children'])} data-toggle="collapse" href="#collapse{$t3['catid']}"{else}  href="{$t3['url']}"{/if}>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span cmseasy-id="{$t3['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                                    {$t3['catname']}
                                </span>
                                    {if count((array)$t3['children'])}<span class="caret"></span>{/if}
                                    </a>
                                    {if count((array)$t3['children'])}
                                    <ul class="nav submenu collapse" id="collapse{$t3['catid']}">
                                        {loop $t3['children'] $t4}
                                        <li>
                                            <a title="{$t4['catname']}" class="panel-heading collapsed"{if count((array)$t4['children'])} data-toggle="collapse" href="#collapse{=$i+1}"{else}  href="{$t4['url']}"{/if}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span cmseasy-id="{$t4['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                                    {$t4['catname']}
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


<script src="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/menu-list-categroy/js/menu-list-categroy.js"></script>

<style type="text/css">

    .menu-list-categroy-$_id .sidebar-menu>li>a {
        font-size:$_link-font-size;
        color:$_link-color;
        background:$_link-background-color;
    }
    .menu-list-categroy-$_id .sidebar-menu>li>a:hover {
        color:$_link-hover-color;
        background:$_link-background-hover-color;
    }

    .menu-list-categroy-$_id .submenu li a {
        font-size:$_link-sub-font-size;
        color:$_link-sub-color;
        background:$_link-sub-background-color;
    }
    .menu-list-categroy-$_id .submenu li a:hover {
        color:$_link-sub-hover-color;
        background:$_link-sub-background-hover-color;
    }
    .menu-list-categroy-$_id .sidebar-menu a.active:before {
        background:$_link-border-color;
    }
</style>
