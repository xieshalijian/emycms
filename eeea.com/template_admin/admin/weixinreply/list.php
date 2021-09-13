<style type="text/css">
    .table {font-size:14px;}
    </style>


<div class="main-right-box">
<h5>{lang_admin('wechat_public_number')}<a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=weixin&act=list&admin_dir={get('admin_dir',true)}&site=default" class="btn btn-secondary pull-right" >{lang_admin('return')}</a></h5>
<div class="blank20"></div>
<div class="box" id="box">

<div id="tagscontent" class="right_box">
  <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this)"   >
      <div class="table-responsive">
          <table class="table table-hover">
      <thead>
        <tr class="th">
          <th colspan="4" align="left" style="padding-left:20px;">{lang_admin('added_automatic_reply')}</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td colspan="4" align="left" >
            <a class="btn btn-primary" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinreply/added/wid/'.intval(front::$get['id']));?>" >{lang_admin('set_up')}</a>
        </td>
        </tr>
        </tbody>
    
      <thead>
        <tr class="th">
          <th colspan="4" align="left" style="padding-left:20px;">{lang_admin('default_message_autoreply')}</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td colspan="4" align="left" >
            <a class="btn btn-primary" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinreply/msged/wid/'.intval(front::$get['id']));?>">{lang_admin('set_up')}</a>
        </td>
        </tr>
       </tbody>
   
      <thead>
        <tr class="th">
          <th>{lang_admin('id')}</th>
          <th>{lang_admin('key_word')}</th>
          <th>{lang_admin('complete_words')}</th>
          <th>{lang_admin('dosomething')}</th>
        </tr>
      </thead>
      <tbody>
      {loop $data $d}
      <tr>
        <td >{$d['id']}</td>
        <td align="left" style="padding-left:10px;">{$d['keyword']}</td>
        <td align="left" style="padding-left:10px;">{$d['word']}</td>
        <td align="left" style="padding-left:10px;">
		<span class="hotspot" onmouseover="tooltip.show('{lang_admin('edit')}');" onmouseout="tooltip.hide();"><a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinreply/edit/id/'.$d['id']);?>"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('{lang_admin('are_you_sure_you_want_to_delete_it')}');" onmouseout="tooltip.hide();"><a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"  data-dataurl="<?php echo url('weixinreply/del/wid/'.intval(front::$get['id']).'/id/'.$d['id']);?>"></a></span>
		</td>
      </tr>
      {/loop}
      <tr>
          <td colspan="4" align="left" >

              <a class="btn btn-primary" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('weixinreply/add/wid/'.intval(front::$get['id']));?>">{lang_admin('set_up')}</a>
          </td>
      </tr>
        </tbody>
         </table>
      </div>
          </div>
          
  </form>



<div class="blank30"></div>
</div>
</div>