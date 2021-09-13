<div class="main-right-box">
<h5>{lang_admin('distribution_list')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

<input class="btn btn-primary" type="button" value=" {lang_admin('adding_distribution')} " name="add" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/add/table/$table");?>"/>

<div class="blank30"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">       
<th class="catname"><!--name-->{lang_admin('distribution_mode')}</th>
<th class="htmldir"><!--rate-->{lang_admin('distribution_cost')}</th>
<th class="htmldir"><!--ver-->{lang_admin('cash_on_delivery')}</th>
<th class="htmldir">{lang_admin('is_it_insured')}</th>
<th class="manage">{lang_admin('dosomething')}</th>
</tr>
</thead>
<tbody>
{loop $data $d}

<tr>


<td class="catname"><strong>{$d['title']}</strong><br /><font color="#666666">{$d['content']}</font></td>
<td class="htmldir">{$d['price']}</td>
<td class="htmldir">{if $d['cashondelivery'] == 0}<i class="glyphicon glyphicon-remove"></i>{else}<i class="glyphicon glyphicon-ok"></i>{/if}</td>
<td>{if $d['insure'] == 0}<i class="glyphicon glyphicon-remove"></i>{else}<i class="glyphicon glyphicon-ok"></i>{/if}</td>

<td class="manage">
<a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/table/$table/id/".$d['id']);?>" title="{lang_admin('edit')}"><i class="glyphicon glyphicon-edit"></i></a>
<a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"    data-dataurl="<?php echo modify("/act/delete/table/$table/id/".$d['id']);?>" title="{lang_admin('delete')}"><i class="icon-action-redo"></i></a>
</td>
</tr>
{/loop}


</tbody>
</table>

</div>


<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-default" type="button" value=" {lang_admin('delete')} " name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}"/>

</form>
<div class="blank30"></div>
</div>
</div></div>
