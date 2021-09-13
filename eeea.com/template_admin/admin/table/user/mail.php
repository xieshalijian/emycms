
<div class="main-right-box">
    <h5><?php echo lang_admin('group_sending');?><!--工具栏-->
        <div class="content-eidt-nav pull-right">

        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('expansion/index');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div></h5>
    <div class="blank20"></div>
    <div class="box" id="box">


        <ul class="nav nav-tabs" role="tablist">

            <li class="active">
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/mail/table/user',true);?>" data-dataurlname="<?php echo lang_admin('group_sending');?>">
                    <?php echo lang_admin('group_sending');?>
                </a>
            </li>

            <li>
                <a href="#" onclick="gotourl(this)"   data-dataurl="./index.php?case=table&act=send&table=user&type=subscription&admin_dir={get('admin_dir')}&site=default
" data-dataurlname="<?php echo lang_admin('subscribe_to_group_distribution');?>">
                    <?php echo lang_admin('subscribe_to_group_distribution');?>
                </a>
            </li>
            {if file_exists(ROOT."/lib/admin/sms_admin.php")}
            <li>
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/sendsms/table/user',true);?>" data-dataurlname="<?php echo lang_admin('short_message');?>">
                    <?php echo lang_admin('short_message');?>
                </a>
            </li>
            {/if}
            <li >
                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/notification/table/user',true);?>" data-dataurlname="<?php echo lang_admin('notice');?>">

                    <?php echo lang_admin('notice');?>
                </a>
            </li>
        </ul>
        <div class="clearfix blank30"></div>
        <form name="listform" id="listform"  action="index.php?case=table&act=send&table=user&admin_dir={get('admin_dir')}&getSelect(this.form)" method="post" onsubmit="return returnform(this);">

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="th">
                        <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                        <th class="catid"><!--userid-->{lang_admin('id')}</th>
                        <th class="catname"><!--username-->{lang_admin('username')}</th>
                        <th class="catname"><!--nickname-->{lang_admin('nickname')}</th>
                        <th class="catname"><!--groupid-->{lang_admin('user_group')}</th>
                        <th class="manage">{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody>

                    {loop $data $d}
                    <tr>

                        <td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

                        <td class="catid">{cut($d['userid'])}</td>
                        <td class="catname">{cut($d['username'])}</td>
                        <td>{cut($d['nickname'])}</td>
                        <td>{usergroupname($d['groupid'])}</td>

                        <td class="manage">
                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("st/1/act/send/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('send_out')}" class="btn btn-gray">{lang_admin('send_out')}</a>
                        </td>
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
            <input  class="btn btn-primary btn-lg" type="button" value=" {lang_admin('submitted')} " name="sendall" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_give_id_as')}('+getSelect(this.form)+'){lang_admin('does_the_record_send_mail')}')){this.form.action='?case=table&act=send&table=user&admin_dir={get('admin_dir')}&st=1&id='+getSelect(this.form); returnform(this.form);}"/>



        </form>
        <div class="blank30"></div>
    </div>
</div>
