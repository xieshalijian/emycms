
<div class="main-right-box">
    <h5>
        {lang_admin('user_list')}
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">

            <span class="pull-right">



        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=add&table=user&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-success" data-dataurlname="{lang_admin('adding_users')}">{lang_admin('adding_users')}</a>

                 <input class="btn btn-primary" type="button" value=" {lang_admin('user_manage_settings')} " onclick="gotourl(this)"   data-dataurl="{url::create('config/system/set/user')}" data-dataurlname="{lang_admin('user_manage_settings')}" />

                <div class="backstage-search" style="display:inline-block;">
                           <form name="searchform" id="searchform"  action="" method="post" class="form-inline" onsubmit="return returnform(this);">
                                <input type="text" class="form-control" name="search_name_email_tel" id="search_name_email_tel" value="" placeholder="{lang_admin('enter_one_user_name')}" />
                                <input type="hidden" name="search_static" value="1" data-dataurlname="{lang_admin('search_user')}">
                                <button type="submit" class="btn btn-default search-btn" name="submit" onclick="this.form.action='<?php echo url::modify('table/'.get('table').'/type/search');?>'" data-dataurlname="{lang_admin('search_user')}">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>

                        </form>



                        </div>

                </span>
        </div>
    </h5>

    <div class="box" id="box">
        <div class="line"></div>
        <div class="blank20"></div>


        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">


            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="th">
                        <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                        <th class="catid text-center"><!--userid-->{lang_admin('id')}</th>
                        <th class="catname"><!--username-->{lang_admin('username')}</th>

                        <?php if(session::get('ver') == 'corp'){ ?>
                            <th class="catid text-center"><!--groupid-->{lang_admin('integral')}</th>
                        <?php } ?>
                        <th class="menoy" style="text-align:center;"><!--groupid-->{lang_admin('balance')}</th>
                        <th class="catid" style="text-align:center;"><!--groupid-->{lang_admin('user_group')}</th>
                        <th class="catid text-center"><!--groupid-->{lang_admin('registration_time')}</th>
                        <th class="catid" style="text-align:center;"><!--nickname-->{lang_admin('expiration_time')}</th>
                        <th style="text-align:center;">{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody>

                    {loop $data $d}
                    <tr>

                        <td class="s_out" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

                        <td class="catid text-center">{cut($d['userid'])}</td>
                        <td class="catname">{cut($d['username'])}</td>
                        <?php if(session::get('ver') == 'corp'){ ?>
                            <td class="text-center">{usergroupisadministrator($d['groupid'])?'无':cut($d['integration'])}</td>
                        <?php } ?>
                        <td class="catid" style="text-align:center;">{$d['menoy']}</td>
                        <td class="catid" style="text-align:center;">{usergroupname($d['groupid'])}</td>
                        <td class="catid text-center">{cut($d['adddatetime'])}</td>
                        <td class="catid text-center">{date("Y-m-d",$d['expired_time'])}</td>
                        <td class="manage">
                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php  echo modify("act/edit/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('edit')}" class="btn btn-gray" data-dataurlname="{lang_admin('editor_user')}">{lang_admin('edit')}</a>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {lang_admin('more')} <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">


                                    {if $d['isblock']}<li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/block/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('thaw')}">{lang_admin('thaw')}</a></li>
                                    {else}
                                    <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/block/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('frozen')}">{lang_admin('frozen')}</a></li>
                                    {/if}
                                    {if $d['isdelete']}
                                    <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/clean/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('pull_back')}">{lang_admin('pull_back')}</a></li>
                                    {else}
                                    <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/clean/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('retreat')}">{lang_admin('retreat')}</a></li>
                                    {/if}
                                    <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url("invite/list/ctname/".$d['username']);?>" title="{lang_admin('invitation')}">{lang_admin('invitation')}</a></li>
                                    <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/list/table/comment/uid/$d[$primary_key]");?>" title="{lang_admin('interaction')}">{lang_admin('interaction')}</a></li>
                                    <li><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/list/table/zanlog/uid/$d[$primary_key]");?>" title="{lang_admin('give_the_thumbsup')}" data-dataurlname="{lang_admin('give_the_thumbsup')}">{lang_admin('give_the_thumbsup')}</a></li>

                                    <li role="separator" class="divider"></li>
                                    <li><a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"   data-dataurl="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" title="{lang_admin('delete')}">{lang_admin('delete')}</a></li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                    {/loop}

                    </tbody>
                </table>
            </div>
            <input type="hidden" name="batch" value="" />
            <input  class="btn btn-gray" type="button" value=" {lang_admin('delete')} " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}"/>
            <div class="blank30"></div>
            <div class="line"></div>
            <div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); ?></div>
        </form>
        <div class="blank30"></div>
    </div>
</div>
