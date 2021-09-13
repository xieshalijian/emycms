<div class="main-right-box">


    <div class="box" id="box">



        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
            <h5>
                <!--工具栏-->
                <div class="content-eidt-nav pull-right">
                    <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=add&table=friendlink&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-primary" data-dataurlname="{lang_admin('add_friendship_links')}">{lang_admin('add_friendship_links')}</a>
                    <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=setting&table=friendlink&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-gray" data-dataurlname="{lang_admin('friendship_link_configuration')}">{lang_admin('friendship_link_configuration')}</a>
                </div>
                {lang_admin('friendship_link_list')}
            </h5>


                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr class="th">
                            <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                            <th class="text-center"><!--id-->{lang_admin('id')}</th>
                            <th class="catname"><!--name-->{lang_admin('name')}</th>
                            <th class="htmldir text-center"><!--listorder-->{lang_admin('sort')}</th>
                            <th class="htmldir"><!--logo-->LOGO</th>
                            <th class="htmldir"><!--username-->{lang_admin('username')}</th>
                            <th class="htmldir text-center"><!--adddate-->{lang_admin('add_time')}</th>
                            <!-- <th class="htmldir"><!--hits--点击数</th> -->
                            <th class="manage">{lang_admin('dosomething')}</th>
                        </tr>


                        {loop $data $d}
                        <tr>

                            <td >
                                <input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" />
                            </td>

                            <td class="text-center">{cut($d['id'])}</td>
                            <td class="catname">{cut($d['name'])}</td>
                            <td class="htmldir text-center">{cut($d['listorder'])}</td>
                            <td class="htmldir">{if $d['logo']}<?php if($d['logo']) echo helper::img($d['logo'], 100); ?>{else}{lang_admin('nothing')}{/if}</td>
                            <td class="htmldir">{cut($d['username'])}</td>
                            <td class="htmldir">{cut($d['adddate'])}</td>
                            <!-- <td>{cut($d['hits'])}</td> -->

                            <td class="manage">
                                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('edit')}" class="btn btn-gray" data-dataurlname="{lang_admin('editing_friendship_links')}">{lang_admin('edit')}</a>
                                <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"
                                   data-dataurl="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" title="{lang_admin('delete')}" class="btn btn-default">{lang_admin('delete')}</a>
                            </td>
                        </tr>
                        {/loop}


                        </tbody>
                    </table>
                </div>


                <input type="hidden" name="batch" value="" class="button" />
                <input class="btn btn-default" type="button" value=" {lang_admin('delete')} " name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_delete_id_as')}('+getSelect(this.form)+'){lang_admin('is_it_recorded')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}" />
                <div class="blank30"></div>
                <div class="line"></div>

                <div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); ?></div>

        </form>
        <div class="blank30"></div>
    </div>
</div>

