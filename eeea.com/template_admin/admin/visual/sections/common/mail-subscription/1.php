<link href="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/mail-subscription/css/style.css" rel="stylesheet">


<div class="mail-subscription mail-subscription-$_id">
    <form name="listform" id="listform" action="<?php echo $base_url;?>/index.php?case=archive&amp;act=email" method="post">
        <div class="input-group">
            <input type="text"  name="email" id="email" value=""  class="form-control" placeholder="{lang_admin('mailsubscription')}">
            <span class="input-group-btn">
                <button class="btn btn-default cmseasyedit" cmseasy-id="submitted" cmseasy-table="lang" cmseasy-field="template" name="submit" type="submit">
                    {lang_admin('submitted')}
                </button>
            </span>
        </div>
    </form>
</div>

<style type="text/css">

    .mail-subscription-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .mail-subscription-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .mail-subscription-$_id .input-group .input-group-btn button.btn-default {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .mail-subscription-$_id .input-group .input-group-btn button.btn-default:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }

    .mail-subscription-$_id .input-group .form-control {
        font-size:$_input-size;
        color:$_input-text-color;
        border-color:$_input-border-color;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }

    .mail-subscription-$_id .input-group .form-control:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }


</style>



