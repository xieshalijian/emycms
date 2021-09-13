<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-form/css/style.css" rel="stylesheet">

        <!-- 自定义表单开始 -->
        {if $archive['showform']}
<div class="content-form content-form-$_id">
            {template_user 'myform/nrform.html'}
        </div>
        {/if}
        <!-- 自定义表单结束 -->

<style type="text/css">

    .content-form-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .content-form-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .content-form-$_id .content-form-title h3 {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-form-$_id .content-form-title:hover h3 {
        color:$_title-hover-color;
    }
    .content-form-$_id .content-form-title p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .content-form-$_id .content-form-title:hover p {
        color:$_subtitle-hover-color;
    }
    .content-form-$_id .table * td {
        border-color:$_background-border-color;
    }
    .content-form-$_id .table * td .form-control {
        font-size:$_input-size;
        color:$_input-text-color;
        border-color:$_input-border-color;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }
    .content-form-$_id .table * td .form-control:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }
    .content-form-$_id .table * td .btn {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-form-$_id .table * td .btn:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>
