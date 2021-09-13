
<div class="content-thumb content-thumb-$_id">
        <img src="{$archive['thumb']}"cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="thumb" class="cmseasyeditimg img-responsive" alt="{$archive['stitle']}" />
    </div>

<style>
    .content-thumb-$_id {
        height: $_height;
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .content-thumb-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
</style>
