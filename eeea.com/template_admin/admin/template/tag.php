<?php  //echo('【待续】');return;?>

<div class="main-right-box">
<h5>{lang_admin('template_structure_labeling')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

<div id="position">
<a href="#" onclick="gotourl(this)"   data-dataurl="javascript:history.back(-1)" title="{lang_admin('return_to_the_previous_page')}">
    <img alt="{lang_admin('return_to_the_previous_page')}" src="{$skin_admin_path}/undo.gif" style="float:right;" /></a>{lang_admin('current_location_template_annotations')}
</div>



<div class="padding10">
<img src="{$skin_admin_path}/wj.gif" style="margin-right:10px;" />{lang_admin('welcome_to_the_editing_template_annotation_page_you_can_edit_template_annotations_to_make_it_easier_to_categorize_and_select_templates_for_content')}
</div>

<div class="blank10"></div>

<script type="text/javascript" src="{$base_url}/js/list.js"></script>

<script src="{$base_url}/common/js/jquery/jquery-latest.js"></script>
<script src="{$base_url}/common/js/jquery/ui/ui.core.js"></script>
<script src="{$base_url}/common/js/jquery/ui/ui.sortable.js"></script>

  <script type="text/javascript">
  $(document).ready(function() {
    $("#myList").sortable({});
  });
  </script>

  <style>
  #myList tr{
   	cursor:move;
  }
  </style>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">

    <input  name="submit" value="1" type="hidden">
    <input type="submit" value="{lang_admin('modify')}"   style="float:right;" class="button" />

<div class="blank10"></div>

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table1" id="table1">
<thead>
 
        <tr>
          <th>{lang_admin('name')}</th>
          <th>{lang_admin('format')}</th>
          <th>{lang_admin('describe')}</th>
        </tr>
        </thead>

<tbody id="myList" >
        
       {loop $tags $i $tag}
       {if @help::$var['tag_note2']['name'][$i] || @help::$var['tag_note2']['format'][$i] || @help::$var['tag_note2']['note'][$i]}
      <tr class="s_out">
           <td>
           <input type="text" name="tag[name][]" size="15" value="{=@help::$var['tag_note2']['name'][$i]}">
           </td>
           <td>
            <textarea rows="3" cols="30" name="tag[format][]" wrap="hard">{=@help::$var['tag_note2']['format'][$i]}</textarea>
          </td>
           <td>
           <textarea rows="5" cols="45" name="tag[note][]">{=@help::$var['tag_note2']['note'][$i]}</textarea>
           </td>
        </tr>
        {/if}
       {/loop}


     <tr class="s_out">
           <td>
           <input type="text" name="tag[name][]" size="10" value="">
           </td>
           <td>
            <textarea rows="3" cols="30" name="tag[format][]" wrap="hard"></textarea>
          </td>
           <td>
           <textarea rows="5" cols="45" name="tag[note][]"></textarea>
           </td>
        </tr>
        
      </tbody>
    </table>



<div class="blank10"></div>
    <input type="submit" value=" {lang_admin('modify')} "  class="btn btn-primary btn-lg" />



</form> 

<div class="blank30"></div>
</div>
</div>

