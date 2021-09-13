

<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/login/css/style.css" rel="stylesheet">

<div class="visual-login visual-login-$_id">
    <div class="codearea">
        #[#if config::getadmin('site_login')=='1'#]#
        #[#login_js()#]#
        {/if#]#
    </div>
    <div class="viewarea">
        <div class="user-panel">
            <a class="top-login"><?php echo lang_admin('login');?></a>
            <a class="top-reg"><?php echo lang_admin('register');?></a>
        </div>
    </div>
</div>



<style type="text/css">
.visual-login-$_id {
    height: $_height;
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual-login-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
.visual-login-$_id a
{
    font-size:$_link-font-size;
    color:$_link-color;
    border-color:$_link-border-color;
    background:$_link-background-color;
}
.visual-login-$_id a:hover {
    color:$_link-hover-color;
    border-color:$_link-border-hover-color;
    background:$_link-background-hover-color;
}
.visual-login-$_id a.top-reg {
    color:$_link-hover-color;
    border-color:$_link-border-hover-color;
    background:$_link-background-hover-color;
    }
.visual-login-$_id a.top-reg:hover {
    font-size:$_link-font-size;
    color:$_link-color;
    border-color:$_link-border-color;
    background:$_link-background-color;
}
.visual-login a.top-login {
    border-radius: $_link-border-radius 0px 0px $_link-border-radius;
}
.visual-login a.top-reg {
    border-radius:  0px $_link-border-radius $_link-border-radius 0px;
}
</style>

