<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/content/content-comment/css/style.css" rel="stylesheet">

<div class="content-comment content-comment-$_id">

    {if (config::get('comment_switch')==2)}
    {lang('no_comment')}
    {elseif (config::get('comment_switch')==0 || (session::get('username')!='' && config::get('comment_switch')==1))}



    <form action="<?php echo url('comment/add');?>" method="POST" name="comment_form" id="comment">
        <div class="comment">
            <div class="blank10"></div>
            <input type="hidden" name="aid" value="{$archive['aid']}"/>

            <div class="form-group">
                <label for="comment" class=" cmseasyedit" cmseasy-id="username" cmseasy-table="lang" cmseasy-field="template">{lang('username')}</label>
                <input type="text" name="username" class="form-control comm_name" value="<?php echo get('username');?>"   />
            </div>

            {if config::get('mobilechk_enable') && config::get('mobilechk_comment')}
            <script src="<?php echo $base_url;?>/js/mobilechk.js"></script>
            <div class="form-group">
                <label for="comment" class=" cmseasyedit" cmseasy-id="tel" cmseasy-table="lang" cmseasy-field="template">{lang('tel')}</label>

                <input type="text" class="comm_name" name="telphone" id="telphone" />
            </div>
            <div class="form-group">
                <label for="comment" class=" cmseasyedit" cmseasy-id="phone_verification_code" cmseasy-table="lang" cmseasy-field="template">{lang('phone_verification_code')}</label>
                <input id="btm_sendMobileCode" onclick="sendMobileCode('{url('tool/smscode')}',$('#telphone'));" type="button" value="{lang('send_cell_phone_verification_code')}" />
                <input type='text' id="mobilenum"  tabindex="4" placeholder="	{lang('please_enter_the_phone_verification_code')}	"  name="mobilenum" />
            </div>
            <div class="blank10"></div>
            {/if}

            <div class="form-group">
                <label for="comment" class=" cmseasyedit" cmseasy-id="comment" cmseasy-table="lang" cmseasy-field="template">{lang('comment')} </label>
                <textarea name="content" id="textarea" class="form-control textarea"></textarea>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="issee" id="issee" value="1" onclick="if(this.checked){this.value=1;}else{this.value=0;};" >
                    <span class="column-title cmseasyedit" cmseasy-id="hostlist" cmseasy-table="lang" cmseasy-field="template">
                    {lang('is_mysee')}
                </span>
                </label>
            </div>


            {if config::get('verifycode')=='1'}
            <div class="balnk10"></div>
            {lang('verifycode')}
            <div class="blank20"></div>
            <input type='text' id="verify"  tabindex="3"  name="verify" />{verify()}
            <div class="balnk10"></div>
            {/if}

            {if config::get('verifycode')=='2'}
            <div class="blank20"></div>
            <div id="verifycode_embed"></div>
            <script src="http://api.geetest.com/get.php"></script>
            <script>
                var loadGeetest = function(config) {
                    window.gt_captcha_obj = new window.Geetest({
                        gt : config.gt,
                        challenge : config.challenge,
                        product : 'float',
                        offline : !config.success
                    });
                    gt_captcha_obj.appendTo("#verifycode_embed");
                };

                $.ajax({
                    url : '{url('tool/geetest',0)}',
                    type : "get",
                    dataType : 'JSON',
                    success : function(result) {
                    //console.log(result);
                    loadGeetest(result)
                }
                });
            </script>
            {/if}

            <div class="blank10"></div>
            <input name="submit" class="comment_btn" value=" {lang('submit_on')} " type="submit" />
            <div class="blank10"></div>

            <div class="comment_info">
                {if $topid==0}{else}<a rel="nofollow" href="<?php echo url('comment/list/aid/'.$archive['aid']);?>">{/if}
                    {lang('have')}<span class="commentnumber">({comment::countcomment($archive['aid'])})</span>{lang('bitofcommenters')}&nbsp;&nbsp;<strong>{lang('clicktoview')}</strong></a>
            </div>

        </div><!-- /comm -->
    </form>

    {elseif (session::get('username')=='' && config::get('comment_switch')==1)}
    <a href="{url('user/login')}">{lang('please_goto_login')}</a>
    {/if}


</div>

<style type="text/css">

    .content-comment-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .content-comment-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .content-comment-$_id .form-group label {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-comment-$_id .form-group label:hover {
        color:$_title-hover-color;
    }
    .content-comment-$_id .checkbox label {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .content-comment-$_id .checkbox label:hover {
        color:$_subtitle-hover-color;
    }
    .content-comment-$_id .comment_info a {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-comment-$_id .comment_info a:hover {
        color:$_p-hover-color;
    }
    .content-comment-$_id .form-control {
        font-size:$_input-size;
        color:$_input-text-color;
        border-color:$_input-border-color !important;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }
    .content-comment-$_id .form-control:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }
    .content-comment-$_id .comment_btn {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-comment-$_id .comment_btn:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>
