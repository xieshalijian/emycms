
<div class="main-right-box">
<h5>{lang_admin('group_sending')}<!--工具栏-->
    <div class="content-eidt-nav pull-right">

        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('expansion/index');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
    </div></h5>
<div class="blank20"></div>
<div class="box" id="box">
<script type="text/javascript">
    function checkform(obj){

        if($("#title").val()=="") {
            alert("{lang_admin('please_fill_in_the_title_of_the_notice')}");
            $("#title").focus();
            return false;
        }
        if($("#note").val()=="") {
            alert("{lang_admin('please_fill_in_the_notice')}");
            $("#note").focus();
            return false;
        }
       returnform(obj);
        return false;
    }
</script>

<ul class="nav nav-tabs" role="tablist">
    <li>
        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/mail/table/user',true);?>" data-dataurlname="<?php echo lang_admin('group_sending');?>">
            <?php echo lang_admin('group_sending');?>
        </a>
    </li>

    {if file_exists(ROOT."/lib/admin/sms_admin.php")}
    <li>
        <a href="#" onclick="gotourl(this)"   data-dataurl="./index.php?case=table&act=send&table=user&type=subscription&admin_dir={get('admin_dir')}&site=default
" data-dataurlname="<?php echo lang_admin('subscribe_to_group_distribution');?>">
            <?php echo lang_admin('subscribe_to_group_distribution');?>
        </a>
    </li>
    <li>
        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/sendsms/table/user',true);?>" data-dataurlname="<?php echo lang_admin('short_message');?>">
            <?php echo lang_admin('short_message');?>
        </a>
    </li>
    {/if}
    <li class="active">
        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/notification/table/user',true);?>" data-dataurlname="<?php echo lang_admin('notice');?>">

            <?php echo lang_admin('notice');?>
        </a>
    </li>
</ul>
<div class="clearfix blank30"></div>
<form name="listform" id="listform"  action="index.php?case=table&act=notification&table=user&admin_dir={get('admin_dir')}&site=default" method="post" onsubmit="return checkform(this);">
<?php $next=isset($next)?$next:"";?>
{if !$next}
<div role="tabpanel" class="tab-pane" id="old">
    <div class="table-responsive">
        <table class="table table-hover">
        <thead>
        <tr class="th" style="text-align: center;">
        <th class="s_out" style="text-align: center;"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
        <th class="catid" style="text-align: center;"><!--userid-->{lang_admin('id')}</th>
        <th class="catname" style="text-align: center;"><!--username-->{lang_admin('username')}</th>
        <th class="catname" style="text-align: center;"><!--nickname-->{lang_admin('nickname')}</th>
        <th class="catname" style="text-align: center;"><!--groupid-->{lang_admin('user_group')}</th>
        </tr>
        </thead>
        <tbody>

        {loop $data $d}
        <tr>

        <td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

        <td align="center" class="catid">{cut($d['userid'])}</td>
        <td align="center" class="catname">{cut($d['username'])}</td>
        <td align="center">{cut($d['nickname'])}</td>
        <td align="center">{usergroupname($d['groupid'])}</td>

        </tr>
        {/loop}

        </tbody>
        </table>
    </div>
    <div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); ?></div>
    <div class="blank30"></div>
    <div class="line"></div>
    <div class="blank30"></div>

    <input type="hidden" name="batch" value="" />
    <input type="hidden" name="userwhere" value="" />
            <input  class="btn btn-primary" type="button" value=" {lang_admin('group_notification_next_step')} " name="notification"
                    onclick="if(getSelect(this.form) && confirm('{lang_admin('do_give_id_as')}('+getSelect(this.form)+'){lang_admin('does_the_record_send_a_notification')}')){
                        this.form.batch.value='next';
                        this.form.action='?case=table&act=notification&table=user&admin_dir={get('admin_dir',true)}&id='+getSelect(this.form);
                        returnform(this.form);
                    }"/>
    <input  class="btn btn-danger" type="button" value=" {lang_admin('full_notice_next_step')} " name="notification"
                    onclick="
                        this.form.batch.value='allnext';
                        this.form.userwhere.value='{$userwhere}';
                        this.form.action='?case=table&act=notification&table=user&admin_dir={get('admin_dir',true)}';
                        returnform(this.form);
                    "/>
</div>
<!-- 下一步 -->
{else}
<div role="tabpanel" class="tab-pane" id="next" >
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('username')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <input type="hidden" name="userid" id="userid" value="{$userid}" />
            <input type="hidden" name="usertel" id="usertel" value="{$usertel}" />
            <input type="hidden" name="useremail" id="useremail" value="{$useremail}" />
            <textarea name="username" id="username" class="form-control textarea">{$username}</textarea>
            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('group_notification_object')}"></span>
        </div>
    </div>
    <div class="clearfix blank20"></div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('please_fill_in_the_title_of_the_notice')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <input name="title" id="title" type="text" value="" class="form-control" />
        </div>
    </div>
    <div class="clearfix blank20"></div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('please_fill_in_the_notice')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <textarea name="note" id="note" class="form-control textarea"></textarea>
            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('you_can_enter_legitimate_html_code')}"></span>
        </div>
    </div>
    <div class="clearfix blank20"></div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('notification_link')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <input name="titleurl"  id="titleurl" type="text" value="" class="form-control" />
        </div>
    </div>
    <div class="clearfix blank20"></div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('send_short_messages')}</div>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-8 text-left">
            <label class="checkbox-inline"><input name="istel" type="radio" id="istel" value="0" class="radio" checked="checked"></label>{lang_admin('no')}
            <label class="checkbox-inline"><input name="istel" type="radio" id="istel" value="1" class="radio">	</label>{lang_admin('yes')}
            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="" title="{lang_admin('choose_whether_to_send_sms_or_not')}"></span>
        </div>
    </div>
    <div class="clearfix blank20"></div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('send_mailbox')}</div>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-8 text-left">
            <label class="checkbox-inline"><input name="isemail" type="radio" id="isemail" value="0" class="radio" checked="checked"></label>{lang_admin('no')}
            <label class="checkbox-inline"><input name="isemail" type="radio" id="isemail" value="1" class="radio">	</label>{lang_admin('yes')}
            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="" title="{lang_admin('choose_whether_to_send_sms_or_not')}"></span>
        </div>
    </div>
    <div class="clearfix blank20"></div>

    <div class="blank30"></div>
    <div class="line"></div>
    <div class="blank30"></div>
    <input  name="submit" value="1" type="hidden">
    <input type="submit"   value="{lang_admin('send_out')}" class="btn btn-primary" />
</div>
{/if}

</form>
<div class="blank30"></div>
</div>
</div>
