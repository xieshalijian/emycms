<div class="main-right-box">
    <h5>
        {lang_admin('user_group_list')}

        <!--工具栏-->
        <div class="content-eidt-nav pull-right">

            <span class="pull-right">

<a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=table&act=add&table=usergroup&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-success" data-dataurlname="{lang_admin('adding_user_groups')}">{lang_admin('adding_user_groups')}</a>

                </span>
        </div>
    </h5>

    <div class="box" id="box">



        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">


            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="th">
                        <th><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                        <th><!--id-->{lang_admin('id')}</th>
                        <th><!--groupid-->{lang_admin('user_group')}</th>
                        <th><!--isadministrator-->{lang_admin('mold')}</th>
                        <th><!--name-->{lang_admin('name')}</th>
                        <th><!--integrationclaim-->{lang_admin('integral_requirements')}</th>
                        <th>{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody>

                    {loop $data $d}
                    <tr class="s_out">

                        <td ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

                        <td>{cut($d['groupid'])}</td>
                        <td>{cut($d['groupid'])}</td>
                        <td>{cut($d['isadministrator']?lang_admin('manage_group'):lang_admin('user_group'))}</td>
                        <td>{cut($d['name'])}</td>
                        <td>{cut($d['isadministrator']?lang_admin('nothing'):cut($d['integrationclaim']))}</td>

                        <td>
                            <a title="{lang_admin('click_edit_user_group')}" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('edit')}" class="btn btn-gray" data-dataurlname="{lang_admin('editing_user_groups')}">{lang_admin('edit')}</a>
                            &nbsp;&nbsp;
                            <a title="{lang_admin('are_you_sure_you_want_to_delete_it')}" onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#" data-dataurl="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" title="{lang_admin('delete')}" class="btn btn-default">{lang_admin('delete')}</a>

                        </td>
                    </tr>
                    {/loop}

                    </tbody>
                </table>
            </div>

            <div class="line"></div>
            <div class="blank30"></div>
            <input type="hidden" name="batch" value="">
            <input  class="btn btn-gray" type="button" value="{lang_admin('delete')}" name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_delete_id_as')}('+getSelect(this.form)+'){lang_admin('is_it_recorded')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}" />

        </form>
        <div class="blank30"></div>
    </div>
</div>
