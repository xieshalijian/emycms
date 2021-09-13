<style type="text/css">
	tr {margin:5px 0px;}
</style>

<div class="main-right-box">


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
    <h5>
        {lang_admin('form_data_list')}
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">
            <span class="pull-right">
 <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('form/listform');?>" data-dataurlname="<?php echo lang_admin('form');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div>
    </h5>


    <div class="box" id="box">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th class="catid"><!--id-->{lang_admin('id')}</th>
          <th class="catname"><!--username-->{lang_admin('user')}</th>
          <th class="htmldir"><!--adddate-->{lang_admin('time')}</th>
          <th class="htmldir"><!--title-->{lang_admin('title')}</th>
		  <th class="htmldir"><!--tel-->{lang_admin('tel')}</th>
		  <th class="htmldir"><!--tel-->{lang_admin('email')}</th>
		  <th class="htmldir"><!--tel-->{lang_admin('qq')}</th>
          <th class="htmldir"><!--content-->{lang_admin('content')}</th>
          <th class="htmldir"><!--reply-->{lang_admin('reply')}</th>
    <th class="htmldir"><!--checked-->{lang_admin('inside_page_title')}</th>
          <th class="manage">{lang_admin('dosomething')}</th>
        </tr>
</thead>
<tbody>

{loop $data $d}
<tr>

<td class="s_out" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td class="catid">{cut($d['fid'])}</td>
<td class="catname">{$d['username']}</td>
<td class="htmldir">{$d['adddate']}</td>
<td align="left"  class="htmldir">{$d['title']}</td>
<td class="htmldir">{$d['guesttel']}</td>
<td class="htmldir">{$d['guestemail']}</td>
<td class="htmldir">{$d['guestqq']}</td>
<td align="left" class="htmldir">{$d['content']}</td>
<td class="htmldir">{$d['reply']}</td>
<td align="left"  class="htmldir">{archive::getarchivename($d['archiveid'])}</td>
<td class="manage">
<a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/show/table/$table/id/$d[$primary_key]");?>" title="{lang_admin('form_data')}" class="btn btn-gray" data-dataurlname="{lang_admin('form_data')}">{lang_admin('see')}</a>
<a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"   data-dataurl="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" title="{lang_admin('delete')}" class="btn btn-default">{lang_admin('delete')}</a>
</td>
</tr>
{/loop}

</tbody>
</table>


<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>

</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="hidden" name="batch" value="" class="button" />
<input  class="btn btn-gray" type="button" value=" {lang_admin('delete')} " name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){this.form.action='<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>'; this.form.batch.value='delete'; returnform(this.form);}"/>
    </div>
</form>
<div class="blank30"></div>
</div>
