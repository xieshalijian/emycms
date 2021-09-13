<link href="{$template_path}/visual/modules/common/search/css/style.css" rel="stylesheet">

<div class="col-md-12">
<div class="search-container search-container-$_id column $_text-align">
    <h3 class="cmseasyedit" cmseasy-id="pleaceinputtext" cmseasy-table="lang" cmseasy-field="template">
        {lang('pleaceinputtext')}
    </h3>
    <form name="search" action="{$base_url}/index.php?case=archive&act=search" method="post">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-default" name="submit" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            <input name="keyword" type="text" class="form-control" placeholder="{lang('pleaceinputtext')}">
        </div>
    </form>
    <p>
    <h5 class="cmseasyedit" cmseasy-id="hotkeys" cmseasy-table="lang" cmseasy-field="template">
        {lang('hotkeys')}
    </h5>
    {gethotsearch(10)}
    </p>
</div>
</div>

<style type="text/css">

    @media (min-width: 486px) {
        .search-container {
            width: 60%;
            margin: 0px auto;
        }
    }

    .search-box {
        background:$_background-color;
        border-color:$_background-border-color;

    }

    .search-box:hover
    {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .search-container-$_id h3 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .search-container-$_id h3:hover {
        color:$_title-hover-color;
    }

    .search-container-$_id .input-group .input-group-btn button.btn-default {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .search-container-$_id .input-group .input-group-btn button.btn-default:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }

    .search-container-$_id .input-group .form-control {
        font-size:$_input-size;
        color:$_input-text-color;
        border-color:$_input-border-color;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }

    .search-container-$_id .input-group .form-control:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }

    .search-container-$_id p a {
        font-size:$_link-font-size;
        color:$_link-color;
        border-color:$_link-border-color;
        border-radius: $_link-border-radius;
        background:$_link-background-color;
    }
    .search-container-$_id p a:hover {
        color:$_link-hover-color;
        border-color:$_link-border-hover-color;
        border-radius: $_link-border-hover-radius;
        background:$_link-background-hover-color;
    }
</style>



