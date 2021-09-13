<div class="main-right-box">
<h5>{lang_admin('template_structure_labeling')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	{lang_admin('you_can_edit_template_annotations_to_make_it_easier_to_categorize_and_select_templates_for_content')}
</div>




<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
<div class="page">{$link_str}</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<div class="table-responsive">
<table class="table table-hover">
<thead>
        <tr class="th">
          <th>{lang_admin('archives')}</th>
          <th>{lang_admin('name')}</th>
          <!-- <th>简短描述</th> -->
        </tr>
</thead>
<tbody>
        {loop $tps $tpl $tp}
        {php $_tp=str_replace('_html','.html',$tp);}
        {php $_tp=str_replace('_css','.css',$_tp);}
        {php $_tp=str_replace('_js','.js',$_tp);}
      <tr class="s_out">
          <td align="left" style="padding-left:10px;">{$_tp}</td>
           <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_name" class="form-control" value="{=@help::$var['template_note'][$tpl.'_name']}">
           </td>
           <!-- <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_note" class="form-control" value="{=@help::$var['template_note'][$tpl.'_note']}">
           </td> -->
        </tr>
       {/loop}

      </tbody>
    </table>

</div>

<div class="page">{$link_str}</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
    <input  name="submit" value="1" type="hidden">
    <input type="submit" value=" {lang_admin('modify')} "  class="btn btn-primary btn-lg" />

</form>

<div class="blank30"></div>
</div>
</div>