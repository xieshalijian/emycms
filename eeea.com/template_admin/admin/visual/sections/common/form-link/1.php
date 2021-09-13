<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/form-link/css/style.css" rel="stylesheet">

<a href="$_link-href" class="visual-form-link visual-form-link-$_id"{if $_isblank==1} target="_blank"{/if}>
{if $_link-name == ''}
<?php echo lang_admin('myform_name');?>
{else}
$_link-name
{/if}
</a>


<style type="text/css">
    .visual-form-link-$_id {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
        padding-top:$_padding_top;
        padding-right:$_padding_right;
        padding-bottom:$_padding_bottom;
        padding-left:$_padding_left;
    }
    .visual-form-link-$_id:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>