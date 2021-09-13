<link href="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/search/css/style.css" rel="stylesheet">


<div class="hotkeys hotkeys-$_id">
   <h5 class="cmseasyedit" cmseasy-id="hotkeys" cmseasy-table="lang" cmseasy-field="template">
       {lang('hotkeys')}
   </h5>
    {gethotsearch(10)}
</div>

<style type="text/css">
    .hotkeys-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .hotkeys-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .hotkeys-$_id h5 {
        font-size:$_title-size;
        color:$_title-color;
    }
    .hotkeys-$_id h5:hover,
    .hotkeys-$_id:gver h5
    {
        color:$_title-hover-color;
    }
    .hotkeys-$_id a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
    }
    .hotkeys-$_id a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
    }
</style>



