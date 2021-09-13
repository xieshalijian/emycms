<div class="main-right-box">


<div class="box" id="box">


    <h5>
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">

            <input class="btn btn-success" type="button" value=" {lang_admin('add_slide')}"
                   onclick="gotourl(this)" data-dataurl="index.php?case=slide&act=add&admin_dir={get('admin_dir',true)}" data-dataurlname="{lang_admin('add_slide')}" />

            <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=config&act=system&set=slide&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('old_slide')}" class="btn btn-default">
                {lang_admin('old_slide')}
            </a>

            </span>
        </div>
        {lang_admin('slide')}
    </h5>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">





<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
<th class="catid text-center">{lang_admin('id')}</th>
<th class="catid">{lang_admin('name')}</th>
<th class="catname">{lang_admin('adddate')}</th>
<th class="catname">{lang_admin('dosomething')}</th>
</tr>
</thead>
<tbody>
    {loop $data $d}
    <tr>
      <td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d['id']}" name="select[]" class="checkbox" /></td>
      <td class="catid text-center">{cut($d['id'])}</td>
      <td class="catname">{cut($d['name'])}</td>
      <td class="catname">{cut($d['addtime'])}</td>
      <td class="manage text-center">
        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/id/".$d['id']);?>" title="{lang_admin('edit')}" class="btn btn-gray" data-dataurlname="{lang_admin('edit_label')}">{lang_admin('edit')}</a>
        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/editview/id/".$d['id']);?>" title="{lang_admin('picture')}" class="btn btn-default" data-dataurlname="{lang_admin('edit_slide_pic')}">{lang_admin('picture')}</a>
          <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#" data-dataurl="<?php echo modify("/act/delete/id/".$d['id']."/token/$token");?>" title="{lang_admin('delete')}" class="btn btn-default"{if !$d['isdefault']}{else} style="visibility: hidden;"{/if}>{lang_admin('delete')}</a>
      </td>
    </tr>
    {/loop}
    </tbody>
    
  </table>
</div>
<input type="hidden" name="batch" value="" />
<input class="btn btn-gray" type="button" value=" {lang_admin('delete')} " name="delete"
onclick="if(getSelect(this.form) && confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}"/>

<div class="blank30"></div>
<div class="line"></div>

<div class="clear page">
  <?php  echo pagination::adminhtml($record_count); ?>
</div>

</form>
    <script>
        $(function () { $("[data-toggle='tooltip']").tooltip(); });
    </script>
<div class="blank30"></div>
</div>
</div>

