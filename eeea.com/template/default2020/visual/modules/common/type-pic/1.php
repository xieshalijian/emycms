<link href="{$template_path}/visual/modules/common/type-pic/css/style.css" rel="stylesheet">

<div class="type-pic type-pic-$_id">
    <div class="column ui-sortable">

{loop plugins::typeinfo($_typeid) $type}

<a href="{$type['url']}" title="{$type['title']}" class="d-block">
    <div class="type-pic-text">
    <h2 cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="typename" class="cmseasyedit ">
            {$type['typename']}
    </h2>
        <p cmseasy-id="{$type['typeid']}" cmseasy-table="type" cmseasy-field="subtitle" class="cmseasyedit ">
            {$type['subtitle']}
        </p>


        </div>
        <img src="{$type['image']}" alt="{$type['typename']}" cmseasy-id="$_typeid" cmseasy-table="type" cmseasy-field="image" class="img-responsive cmseasyeditimg" />
</a>

{/loop}

</div>
</div>
<style type="text/css">

    .type-pic-$_id .type-pic-text h2 {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }

    .type-pic-$_id .type-pic-text h2:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }

    .type-pic-$_id .type-pic-text p {
        font-size:$_p-size;
        color:$_p-color;
    }
    .type-pic-$_id  .type-pic-text p:hover {
        color:$_p-hover-color;
    }

    .type-pic-$_id {
        background:$_background-color;
    }

    .type-pic-$_id:hover {
        background:$_background-hover-color;
    }

</style>
