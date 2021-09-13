<div class="announ-title $_text-align">
    <h1 cmseasy-id="{php echo @$announ['id'];}" cmseasy-table="announ" cmseasy-field="title" class="cmseasyedit announ-title  announ-title-$_id">
        {php echo @$announ['title'];}
    </h1>
</div>

<style type="text/css">

    h1.announ-title-$_id {
        font-size:$_title-size;
        color:$_title-color;
    }
    h1.announ-title-$_id:hover {
        color:$_title-hover-color;
    }

</style>
