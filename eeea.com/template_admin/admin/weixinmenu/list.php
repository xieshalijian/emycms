

<div class="main-right-box">
<h5>{lang_admin('wechat_public_number_menu')}<a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=weixin&act=list&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-secondary pull-right" >{lang_admin('return')}</a></h5>
<div class="blank20"></div>
<div class="box" id="box">

  <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this)">
  <input type="hidden" name="wid" id="wid" value="<?php echo intval(front::get('id'));?>" />

  <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th>{lang_admin('id')}</th>
          <th>{lang_admin('sort')}</th>
          <th>{lang_admin('name')}</th>
          <th>{lang_admin('mold')}</th>
          <th>{lang_admin('dosomething')}</th>
        </tr>
      </thead>
      <tbody>
      {loop $data $d}
      <tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">
        <td>{$d['id']}</td>
        <td><input type="text" name="sort[{$d['id']}]" value="{$d['sort']}" class="form-control" /></td>
        <td align="left"><input type="text" name="name[{$d['id']}]" value="{$d['name']}"class="form-control" /></td>
        <td align="left">{weixinmenu::getTypeName($d['typeid'])}</td>
        <td class="manage">
<a  href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('weixinmenu/edit/id/'.$d['id']);?>" title="{lang_admin('edit')}" data-dataurlname="{lang_admin('edit')}" class="btn btn-gray">{lang_admin('edit')}</a>

            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo lang_admin('more');?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinmenu/add/wid/'.intval(front::$get['id']).'/pid/'.$d['id']);?>" title="{lang_admin('submenu')}">
                            {lang_admin('submenu')}
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"   data-dataurl="<?php echo url('weixinmenu/del/wid/'.intval(front::$get['id']).'/id/'.$d['id']);?>" title="{lang_admin('delete')}"><?php echo lang_admin('delete');?></a>
                    </li>
                </ul>
            </div>


		</td>
      </tr>
      <?php
	  $weixinmenu = new weixinmenu();
	  $submenus = $weixinmenu->getsubmenu($d['id']);
	  if(is_array($submenus) && !empty($submenus)){
		  foreach($submenus as $submenu){
	  ?>
      <tr onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">
        <td >{$submenu['id']}</td>
        <td><input type="text" name="sort[{$submenu['id']}]" value="{$submenu['sort']}" class="form-control" /></td>
        <td align="left" class="htmldir">&nbsp;└&nbsp;<input type="text" name="name[{$submenu['id']}]" value="{$submenu['name']}" class="form-control" /></td>
        <td align="left">{weixinmenu::getTypeName($submenu['typeid'])}</td>
        <td class="manage">
<a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinmenu/edit/id/'.$submenu['id']);?>" title="{lang_admin('edit')}"><i class="glyphicon glyphicon-edit"></i></a>
<a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"  data-dataurl="<?php echo url('weixinmenu/del/wid/'.intval(front::$get['id']).'/id/'.$submenu['id']);?>" title="{lang_admin('delete')}"><i class="icon-action-redo"></i></a>
		</td>
      </tr>
      <?php
		  }
	  }
	  ?>
      {/loop}
</tbody>
</table>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
      <input  name="submit" value="1" type="hidden">
<input value=" {lang_admin('preservation')} " type="submit" class="btn btn-primary" />

<a title="{lang_admin('add_a_level_1_menu')}" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinmenu/add/wid/'.front::get('id').'/pid/0');?>;" class="btn btn-success">
      {lang_admin('add_a_level_1_menu')}
      </a>

<input type="button" name="button" id="button" value=" {lang_admin('release')} " class="btn btn-info" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinmenu/push/wid/'.intval(front::$get['id']));?>;" />

<div class="blank30"></div>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>{lang_admin('tips')}：</strong> 	[	{lang_admin('because_of_the_caching_of_wechat_it_is_necessary_to_cancel_the_public_numbers_attention_before_re_focusing_on_the_public_number_to_see_the_results_immediately_after_publication')}	]	
</div>

</form>



<div class="blank30"></div>
</div>
</div>