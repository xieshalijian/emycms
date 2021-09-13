
<div class="main-right-box">
    <h5>{lang_admin('give_the_thumbsup')}</h5>
    <div class="blank20"></div>
    <div class="box" id="box">


        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
            <div class="blank20"></div>
            <div id="tagscontent" class="right_box">

                <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
                    <thead>
                    <tr class="th">
                        <th><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
                        <th><!--id-->{lang_admin('id')}</th>
                        <th><!--content-->{lang_admin('title')}</th>
                        <th><!--username-->{lang_admin('username')}</th>
                        <th>{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {loop $data $d}
                    <?php
                    $archive = archive::getInstance();
                    $news = $archive->getrow($d['aid']);
                    $aurl = $archive->url($news);
                    $user = new user();
                    $user = $user->getrow($d['uid']);
                    $username = $user['username'];
                    unset($user);
                    ?>
                    <tr>
                        <td >
                            <input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" />
                        </td>

                        <td>{cut($d['zlid'])}</td>
                        <td align="left" style="padding-left:10px;"><a href="{$aurl}" target="_blank">{$news['title']}</a></td>
                        <td align="left" style="padding-left:10px;">{$username}</td>

                        <td>
<span class="hotspot" onmouseover="tooltip.show('{lang_admin('click_edit_column_settings')}');" onmouseout="tooltip.hide();">
<a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>"></a>
</span>
                            <span class="hotspot" onmouseover="tooltip.show('{lang_admin('delete_this_column')}');" onmouseout="tooltip.hide();">
<a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"   data-dataurl="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>"></a>
</span>
                        </td>
                    </tr>
                    {/loop}
                    {lang_admin('is_it_recorded')}
                    </tbody>
                </table>

                <div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); ?></div>
                <div class="blank20"></div>
            </div>

            <div class="blank20"></div>

            <input type="hidden" name="batch" value="">
            <input class="btn btn-primary btn-lg" type="button" value=" {lang_admin('delete')} " name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_delete_id_as')}('+getSelect(this.form)+'){lang_admin('is_it_recorded')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}"/>


        </form>
        <div class="blank30"></div>
    </div>
</div>
