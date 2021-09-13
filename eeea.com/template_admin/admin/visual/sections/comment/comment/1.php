
{if (config::get('comment')==1 && (config::get('comment_switch')==0 || (session::get('username')!='' && config::get('comment_switch')==1)))}

<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/comment/comment/css/style.css" rel="stylesheet">

<form action="<?php echo url('comment/add');?>" method="POST" name="comment_form" id="comment">
    <div class="comment comment-$_id">
        <div class="blank10"></div>
        <input type="hidden" name="aid" value="{$archive['aid']}"/>

        <div class="form-group">
            <label for="comment" class=" cmseasyedit" cmseasy-id="username" cmseasy-table="lang" cmseasy-field="template">{lang('username')}</label>
            <input type="text" name="username" class="form-control comment_input comm_name" value="<?php echo get('username');?>"   />
        </div>

        {if config::get('mobilechk_enable') && config::get('mobilechk_comment')}
        <script src="<?php echo $base_url;?>/js/mobilechk.js"></script>
        <div class="form-group">
            <label for="comment" class=" cmseasyedit" cmseasy-id="tel" cmseasy-table="lang" cmseasy-field="template">{lang('tel')}</label>

            <input type="text" class="form-control comment_input  telphone" name="telphone" id="telphone" />
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
            <textarea name="content" id="textarea" class="form-control comment_textarea"></textarea>
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
        <input name="submit" class="btn" value=" {lang('submit_on')} " type="submit" />
        <div class="blank10"></div>

        <div class="comment_info">
            {if $topid==0}
            {else}
            <a rel="nofollow" href="<?php echo url('comment/list/aid/'.$archive['aid']);?>">
                {/if}
                {lang('have')}<span class="commentnumber">({comment::countcomment($archive['aid'])})</span>{lang('bitofcommenters')}&nbsp;&nbsp;<strong>{lang('clicktoview')}</strong></a>
        </div>

    </div><!-- /comm -->
</form>

{elseif (session::get('username')=='' && config::get('comment_switch')==1)}

<div class="balnk10"></div>
<div class="text-center">
    <a href="{url('user/login')}">
        {lang('please_goto_login')}
    </a>
</div>
{/if}


<style type="text/css">
    .comment-$_id .comment_input,
    .comment-$_id .comment_textarea{
        font-size:$_input-size;
        color:$_input-text-color;
        border-color:$_input-border-color;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }
    .comment-$_id .comment_content_item .comment_input:hover,
    .comment-$_id .comment_textarea:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }
    .comment-$_id .checkbox label {
        font-size:$_p-size;
        color:$_p-color;
    }
    .comment-$_id .checkbox label:hover {
        color:$_p-hover-color;
    }
    .comment-$_id .btn {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .comment-$_id .btn:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>




