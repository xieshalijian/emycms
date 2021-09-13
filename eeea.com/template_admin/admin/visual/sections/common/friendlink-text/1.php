<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/friendlink-text/css/style.css" rel="stylesheet">


<div class="friendlink-text friendlink-text-$_id">
    {loop friendlink('text',0,24) $flink}
    <a href="{$flink['url']}" target="_blank" title="{$flink['name']}">
        {$flink['name']}
    </a>
    {/loop}
</div>

<style type="text/css">
.friendlink-text-$_id {
    height: $_height;
    background:$_background-color;
    border-color:$_background-border-color;
}
.friendlink-text-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
    .friendlink-text-$_id a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
.friendlink-text-$_id a:hover {
    color:$_link-hover-color;
    border-color:$_link-border-hover-color;
    border-radius: $_link-border-hover-radius;
    background:$_link-background-hover-color;
}
</style>