
<div class="type-topid-image type-topid-image-$_id">
    <img src="{$type['image']}"  cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="image" class="cmseasyeditimg img-responsive">

</div>

<div class="type-topid-image type-topid-image-$_id">

    <div class="type-topid-image-img">
        <img src="{$type[$topid]['image']}"  cmseasy-id="{$type[$topid]['typeid']}" cmseasy-table="type" cmseasy-field="image" class="cmseasyeditimg img-responsive">
    </div>

        <div class="type-topid-image-title type-topid-image-title-$_id">
            <div class="container $_text-align">
            <h1 cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="title" class="clearfix cmseasyedit position-move">
                {$type['catname']}
            </h1>
            <div class="clearfix"></div>
            <p cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="subtitle" class="clearfix cmseasyedit position-move">
                {$type['subtitle']}
            </p>
        </div>
    </div>

</div>


<style type="text/css">

    .type-topid-image-$_id {
        height: $_height;
        background:$_background-color;
    }

    .type-topid-image-$_id .type-topid-image-title  h1 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .type-topid-image-$_id .type-topid-image-title h1:hover {
        color:$_title-hover-color;
    }

    ..type-topid-image-$_id .type-topid-image-title p  {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }

    .type-topid-image-$_id .type-topid-image-title p:hover {
        color:$_subtitle-hover-color;
    }

</style>