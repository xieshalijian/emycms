<div class="main-right-box">
<h5>{lang_admin('comment_list')}
    <!--工具栏-->
    <div class="content-eidt-nav pull-right">

        <span class="pull-right">

<input class="btn btn-primary" type="button" value=" {lang_admin('comment_manage_settings')} " onclick="gotourl(this)"   data-dataurl="{url::create('config/system/set/comment')}" data-dataurlname="{lang_admin('comment_manage_settings')}" />
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('expansion/index');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>


                </span>
    </div>
</h5>

<div class="box" id="box">


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<th class="catid"><!--id-->{lang_admin('id')}</th>
<th class="aid"><!--subordinate_title-->{lang_admin('subordinate_title')}</th>
<th class="catname"><!--content-->{lang_admin('content')}</th>
<th class="htmldir"><!--username-->{lang_admin('username')}</th>
<th class="htmldir">{lang_admin('time')}</th>
<th class="htmldir"><!--reply-->{lang_admin('reply')}</th>
<th class="htmldir text-center">{lang_admin('state')}</th>
<th class="manage">{lang_admin('dosomething')}</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr>
<td class="s_out" >
<input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" />
</td>

<td class="catid">{cut($d['id'])}</td>
    <td class="aid" align="left" style="padding-left:10px;"><a href="{url('archive/show/aid/'.$d['aid'],false)}"  target="_blank" >{archive::getarchivetitle($d['aid'])}</a></td>
<td class="catname" align="left" style="padding-left:10px;">{cut($d['content'])}</td>
<td class="htmldir" align="left">{cut($d['username'])}</td>
    <td class="htmldir" align="left">{cut($d['adddate'])}</td>
    <td class="htmldir">{$d['reply']}</td>
<td class="htmldir text-center">{if $d['state']}<i class="glyphicon glyphicon-ok"></i>{else}<i class="glyphicon glyphicon-remove"></i>{/if}</td>

<td class="manage">
    <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('reply')}" class="btn btn-gray">{lang_admin('reply')}</a>

    <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#" data-dataurl="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" title="{lang_admin('delete')}" class="btn btn-default">{lang_admin('delete')}</a>
</td>
</tr>
{/loop}

</tbody>
</table>




<input type="hidden" name="batch" value="">
   <input  class="btn btn-gray" type="button" value=" {lang_admin('delete')} " name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_delete_id_as')}('+getSelect(this.form)+'){lang_admin('is_it_recorded')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}"/>

    <div class="btn-group dropup">
        <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {lang_admin('to_examine')} <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-del">

            <li>
    <input class="btn btn-default" type="button" value=" {lang_admin('to_examine')} " name="docheck" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_audit_id_for')}('+getSelect(this.form)+'){lang_admin('is_it_recorded')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='docheck'; returnform(this.form);}"/>
            </li>

<li>
    <input class="btn btn-default" type="button" value="{lang_admin('cancellation_of_audit')}" name="douncheck" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_cancel_the_audit_id_for')}('+getSelect(this.form)+'){lang_admin('is_it_recorded')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='douncheck'; returnform(this.form);}"/>
</li>
        </ul>
    </div>

<input  class="btn btn-gray" type="button" value=" {lang_admin('empty')} " name="clearall" onclick="if(confirm('{lang_admin('do_you_really_want_to_empty')}')){this.form.action='<?php echo modify("/act/clearall/table/$table/token/$token");?>'; this.form.batch.value='clearall'; returnform(this.form);}"/>

    <div class="blank30"></div>
    <div class="line"></div>
    <div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); ?></div>

</div>


</form>
<div class="blank30"></div>
</div>
</div>

