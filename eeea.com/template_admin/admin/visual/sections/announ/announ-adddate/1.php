<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/announ/announ-adddate/css/style.css" rel="stylesheet">
<div class="announ-adddate">
    <span cmseasy-id="{$announ['id']}" cmseasy-table="announ" cmseasy-field="adddate" class="cmseasyedit time">
    {$announ['adddate']}
    </span>
    </div>

<style type="text/css">

    .announ-adddate {
        font-size:$_p-size;
        color:$_p-color;
    }
    .announ-adddate:hover {
        color:$_p-hover-color;
    }

</style>
