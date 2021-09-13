<link href="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/search/css/style.css" rel="stylesheet">


<div class="visual-search visual-search-$_id">
    <form name="search" action="<?php echo $base_url;?>/index.php?case=archive&act=search" method="post">
        <div class="input-group">
            <input name="keyword" type="text" class="form-control" placeholder="{lang('pleaceinputtext')}">
            <span class="input-group-btn">
                <button class="btn btn-default" name="submit" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>
</div>

<style type="text/css">

    .visual-search-$_id h3 {
        font-size:$_title-size;
        color:$_title-color;
    }

    .visual-search-$_id h3:hover {
        color:$_title-hover-color;
    }

    .visual-search-$_id .input-group .input-group-btn button.btn-default {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .visual-search-$_id .input-group .input-group-btn button.btn-default:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }

    .visual-search-$_id .input-group .form-control {
        font-size:$_input-size;
        color:$_input-text-color;
        border-color:$_input-border-color;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }

    .visual-search-$_id .input-group .form-control:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }
</style>



