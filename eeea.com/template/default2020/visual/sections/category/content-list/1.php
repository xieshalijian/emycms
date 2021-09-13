<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/category/content-list/css/style.css" rel="stylesheet">
<div class="content-list content-list-$_id">

    <div class="content-list-title">
        <a herf="$_title-href" title="{lang_sections('hot-list')}" target="$_isblank" class="cmseasyedit" cmseasy-id="hostlist" cmseasy-table="lang" cmseasy-field="template">
            {langtemplate_hostlist}
        </a>
    </div>

    <ul>
        {loop archive($catid,'0','0','0,0,0','$_title-number','$_list-sort','$_list-number',false,'0',true,'0','0','$_intro-number','0') $i $archive}

        {if $_align-number == 6}
        {if $i%2==0 && $i>0}
        <div class="clearfix"></div>
        {/if}
        {elseif $_align-number == 4}
        {if $i%3==0 && $i>0}
        <div class="clearfix"></div>
        {/if}
        {elseif $_align-number == 3}
        {if $i%4==0 && $i>0}
        <div class="clearfix"></div>
        {/if}
        {elseif $_align-number == 2}
        {if $i%6==0 && $i>0}
        <div class="clearfix"></div>
        {/if}
        {else}
        <div class="clearfix"></div>
        {/if}

        <li class="col-sm-$_align-number">
            {if $_isshowtime == 1}
				<span cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="adddate" class="cmseasyedit time $_align-float">
				{$archive['adddate']}
				</span>
            {/if}
            <a title="{$archive['stitle']}" href="{$archive['url']}" cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit " target="$_isblank">
                {$archive['title']}
            </a>
            <p>
            {$archive['intro']}
            </p>
        </li>
        {/loop}
    </ul>
</div>

<style>
    .content-list-$_id .content-list-title {
        font-size: $_title-size;
        color: $_title-color;
        border-left-color: $_title-color;
    }
    .content-list-$_id .content-list-title {
        color:$_title-hover-color;
        border-left-color$_title-hover-color;
    }
    .content-list-$_id ul li {
        background:$_background-color;
        border-bottom-style:$_link-border-style;
        border-bottom-color:$_background-border-color;
    }
    .content-list-$_id ul li:hover {
        background:$_background-hover-color;
        border-bottom-style:$_link-border-hover-style;
        border-bottom-color:$_background-border-hover-color;
    }
    .content-list-$_id ul li a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .content-list-$_id ul li:hover a,
    .content-list-$_id ul li a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
    .content-list-$_id ul li p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-list-$_id ul li:hover p,
    .content-list-$_id ul li p:hover {
        color:$_p-hover-color;
    }
    .content-list-$_id ul li span {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-list-$_id ul li span:hover,
    .content-list-$_id ul li:hover span {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>