<div class="main-right-box">
    <h5>{lang_admin('custom_field_list')}</h5>
    <div class="blank20"></div>
    <div class="box" id="box">


        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=field&act=add&table=archive&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-primary">{lang_admin('adding_content_fields')}</a>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=field&act=list&table=archive&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-success">{lang_admin('content_field_list')}</a>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=field&act=add&table=user&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-info">{lang_admin('add_user_fields')}</a>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=field&act=list&table=user&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-warning">{lang_admin('user_field_list')}</a>

        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=field&act=add&table=category&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-info">{lang_admin('add_category_fields')}</a>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=field&act=list&table=category&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-warning">{lang_admin('category_field_list')}</a>




        <div class="blank30"></div>

        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="th">
                        <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                        <th class="sort">{lang_admin('sort')}</th>
                        <th class="catname">{lang_admin('field_name')}</th>
                        <th class="htmldir">{lang_admin('type')}</th>
                        <th class="htmldir">{lang_admin('length')}</th>
                        <th>{lang_admin('field_description')}</th>
                        <th class="manage">{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {loop $fields $f}
                   <?php if($f['name'] != 'my_field'){ ?>
                    <tr>

                        <?php if(!isset($f['listorder'])){ $f['listorder']=0; }  ?>
                        <td class="s_out" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$f.name}" name="select[]" class="checkbox" /> </td>
                        <td align="center" class="sort"><span class="hotspot" onmouseover="tooltip.show('{lang_admin('fill_in_the_sorting_number')}，<br />{lang_admin('the_smaller_the_number_the_higher_the_ranking')}');" onmouseout="tooltip.hide();"><?php $id=$f['name'];echo  form::input("listorder[$id]",$f['listorder'])?></span></td>
                        <td align="center" class="catname">{$f.name}</td>
                        <td align="center" class="htmldir"><?php
                            //var_dump(setting::$var);
                            $tmp = setting::$var[front::get('table')][$f['name']];
                            if($tmp['type'] == 'varchar'){
                                $s = lang_admin('one_line_text');
                            }
                            if($tmp['type'] == 'text'){
                                $s = lang_admin('multi_line_text');
                            }
                            if($tmp['type'] == 'mediumtext'){
                                $s = lang_admin('hypertext');
                            }
                            if($tmp['type'] == 'int'){
                                $s = lang_admin('integer');
                            }
                            if($tmp['type'] == 'datetime'){
                                $s = lang_admin('date_type');
                            }
                            if($tmp['selecttype'] == 'radio'){
                                $s = lang_admin('monopoly');
                            }
                            if($tmp['selecttype'] == 'checkbox'){
                                $s = lang_admin('multi_selection');
                            }
                            if($tmp['selecttype'] == 'select'){
                                $s = lang_admin('dropdown_selection_line_text');
                            }
                            if($tmp['filetype'] == 'image'){
                                $s = lang_admin('picture');
                            }
                            if($tmp['filetype'] == 'file'){
                                $s = lang_admin('enclosure');
                            }
                            echo $s;

                            ?></td>
                        <td align="center" class="htmldir">{$f.len}</td>
                        <td align="center"  class="htmldir"><?php echo @setting::$var[$table][$f['name']]['cname'];?></td>
                        <td align="center" class="manage">
                            <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("/act/edit/table/$table/name/".$f['name']);?>" title="{lang_admin('edit')}" data-dataurlname="{lang_admin('edit')} {lang_admin('custom_field')}" class="btn btn-gray">{lang_admin('edit')}</a>
                            <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#" data-dataurl="<?php echo modify("/act/delete/table/$table/name/".$f['name']);?>" title="{lang_admin('delete')}" class="btn btn-default">{lang_admin('delete')}</a>
                        </td>
                    </tr>
                    <?php } ?>
                    {/loop}
                    </tbody>
                </table>

                <div class="blank30"></div>
                <div class="line"></div>
                <div class="blank30"></div>
                <input type="hidden" name="batch" value="">
                <input class="btn btn-default" type="button" value=" {lang_admin('sort')} " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='listorder'; returnform(this.form);"/>
                <input type="button" value="{lang_admin('delete')}" name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}" class="btn btn-danger" />
        </form>


        <div class="blank30"></div>
    </div>
</div>
