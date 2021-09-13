
<div id="print" class="claerfix claerfix category-content category-content-$_id">

                <span  cmseasy-id="{front::get('catid')']}" cmseasy-table="category" cmseasy-field="categorycontent" class="cmseasyedit content">
                {$category[$catid]['categorycontent']}
                </span>
    </div>

<style type="text/css">

    .category-content-$_id {
        line-height:1.8;
        font-size:$_p-size;
        color:$_p-color;
    }
    .category-content-$_id:hover {
        color:$_p-hover-color;
    }

</style>
