
<div class="announ-content">

    <span cmseasy-id="{php echo @$announ['id'];}" cmseasy-table="announ" cmseasy-field="content" class="cmseasyedit">
        {php echo @$announ['content'];}
    </span>
    </div>

<style type="text/css">

    .announ-content {
        font-size:$_p-size;
        color:$_p-color;
        line-height:1.8;
    }
    .announ-content:hover {
        color:$_p-hover-color;
    }

</style>
