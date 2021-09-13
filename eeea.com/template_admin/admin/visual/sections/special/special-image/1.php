

<div class="special-image special-image-$_id">
    <div class="special-image-img">
        <img src="{$special['image']}"  cmseasy-id="{$special['spid']}" cmseasy-table="special" cmseasy-field="image" class="cmseasyeditimg img-responsive">
    </div>
</div>


<style type="text/css">

    .special-image-$_id {
        height: $_height;
        background:$_background-color;
    }

    .special-image-$_id .special-image-title  h1 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .special-image-$_id .special-image-title h1:hover {
        color:$_title-hover-color;
    }

    ..special-image-$_id .special-image-title p  {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }

    .special-image-$_id .special-image-title p:hover {
        color:$_subtitle-hover-color;
    }

    .special-image-$_id .special-image-title h1:after {
        background:$_title-color;
    }
    .special-image-$_id .special-image-title h1:hover:after {
        background:$_title-hover-color;
    }
</style>