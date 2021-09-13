<div class="main-right-box">
<h5>
    {lang_admin('custom_fields')}
    <!--工具栏-->
    <div class="content-eidt-nav pull-right">

        <span class="pull-right">

                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('field/list/table/'.front::get('table'));?>" data-dataurlname="<?php echo lang_admin('custom_field_list');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>

                </span>
    </div>
</h5>

<div class="box" id="box">

<div class="line"></div>
<div class="blank30"></div>

<script type="text/javascript">
    function checktovarchar() {
        if($("#selecttype").val()=='0') {
            $(".varchar2").show("slow");
            $(".select2").hide("slow");
            $("#type").attr('value','varchar');
        }
    }
    function checktoselect() {
        $("#issearch").attr('checked',false);
        if($("#type").val()=='varchar'){
            $("#issearch").attr('disabled',false);
        }
        else
        {
            $("#issearch").attr('disabled',true);
        }
        if($("#type").val()=='0') {
            $(".select2").show("slow");
            $(".varchar2").hide("slow");
            $("#selecttype").attr('value','select');
        }
    }

    function form_preview() {
        if($("#type").val()=='0') {
            //$('#form_preview').html(get('form1').cname.value+'：<input name="'+get('form1').name.value+'" size="'+get('form1').len.value+'">');

            if($("#selecttype").val()=='select') {
                select='<select name="'+get('form1').name.value+ '">';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {
                    select += '<option value="'+match[1]+'">'+match[2]+'</option>';
                    match = myregexp.exec(subject);
                }
                select +='</select>';
            }
            else {
                select='';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {

                    if($("#selecttype").val()=='checkbox')
                        select += match[2]+'<input type="checkbox" value="'+match[1]+'" name="'+get('form1').name.value+ '[]">&nbsp;&nbsp;';
                    else
                        select += match[2]+'<input type="radio" value="'+match[1]+'" name="'+get('form1').name.value+ '">&nbsp;&nbsp;';
                    match = myregexp.exec(subject);
                }
            }

            $('#form_preview').html(select);
            $('#form_preview_title').html(get('form1').cname.value);
            $('#form_preview_tips').html(get('form1').tips.value);
        }
    }

    function checkform1(obj) {
        if(!$('#isshoping')[0].checked){
            if ($('#len').val().length==0 || $('#len').val()==undefined || $('#len').val()==''){
                alert("{lang_admin('length_cannot_be_empty')}");
                return  false;
            }
        }
        $('#select_preview').html('');
        returnform(obj);
        return false;
    }


</script>


<form method="post" action="" name="form1" id="form1" onsubmit="return returnform(this)">
    <!--工具栏-->
    <div class="content-eidt-nav pull-right">
        <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
            <i class="icon-frame"></i>
            {lang_admin('container_fluid')}
        </a>

        <span class="pull-right">



                <input  name="submit" value="1" type="hidden">
                    <button class="btn btn-success" onclick="mysave()" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>



                <a href="#" onclick="gotohome()" data-dataurlname="<?php echo lang_admin('home');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
             <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
					</a>

                </span>
    </div>
    <div id="content-eidt-nav"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('field_name')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{if front::$act=='edit'}
<b>{$field.name}</b>
<input type="hidden" class="form-control"  name="name" id="name" value="{$field.name}" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('must_fill_in')}"></span>
{else}
<input class="form-control" name="name" id="name" value="my_" onblur="form_preview()" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('must_fill_in')}"></span>
{/if}
</div>
</div>
<div class="clearfix blank20"></div>
			

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('chinese_name_in_field')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input class="form-control" name="cname" id="cname" value="{$data['cname']}"   onblur="form_preview()"/>
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('must_fill_in')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('tips')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input class="form-control" name="tips" id="tips" value="<?php echo @setting::$var[$table][$field['name']]['tips'];?>"   onblur="form_preview()"/>
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('notes_on_the_right_side_of_the_input_box')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<?php
if($table == 'archive') {
?>
<div class="row" id="catidshow">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('binding_column')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('catid',$form,$field,$data)}
</div>
    <div class="clearfix blank20"></div>
</div>
<?php } ?>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('is_it_necessary_to_fill_in')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="checkbox" name="isnotnull" id="isnotnull" value="1" <?php echo @setting::$var[$table][$field['name']]['isnotnull']=='1'?'checked':''?>  onblur="form_preview()"/>
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('is_it_a_required_item')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<?php if((session::get('ver') == 'corp') ){ ?>
<div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('is_it_a_commodity')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <input type="checkbox" name="isshoping" id="isshoping" value="1"  onclick="checkisshoping(this)" <?php echo @setting::$var[$table][$field['name']]['isshoping']=='1'?'checked':''?>  onblur="form_preview()"/>
            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('is_it_a_commodity')}"></span>
        </div>
</div>
<div class="clearfix blank20"></div>
<script type="text/javascript">
    function  checkisshoping(obj) {
       if(obj.checked){
           $("#type").val("text");
           $("#len").val("0");
           $("#catid").val("0");
           document.getElementById("typeshow").style.display="none";
           document.getElementById("lengshow").style.display="none";
           document.getElementById("catidshow").style.display="none";
       }else{
           document.getElementById("typeshow").style.display="";
           document.getElementById("lengshow").style.display="";
           document.getElementById("catidshow").style.display="";
       }
    }

    $(function () {
        var isshoping=<?php if(@setting::$var[$table][$field['name']]['isshoping']==""){echo  "0";}else{ echo @setting::$var[$table][$field['name']]['isshoping']; } ;?>;
        if( isshoping=='1'){
            document.getElementById("typeshow").style.display="none";
            document.getElementById("lengshow").style.display="none";
            document.getElementById("catidshow").style.display="none";
        }else{
            document.getElementById("typeshow").style.display="";
            document.getElementById("lengshow").style.display="";
            document.getElementById("catidshow").style.display="";
        }
    })
</script>
<?php };?>


<div  class="varchar2" >
<div class="row" id="typeshow">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('mold')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="type" id="type" onchange="checktoselect(); form_preview();" class="form-control select">
<option value="int" <?php echo @setting::$var[$table][$field['name']]['type']=='int'?'selected':''?>>{lang_admin('integer')}</option>
<option value="varchar" <?php echo @setting::$var[$table][$field['name']]['type']=='varchar'?'selected':''?>>{lang_admin('one_line_text')}</option>
<option value="text" <?php echo @setting::$var[$table][$field['name']]['type']=='text'?'selected':''?>>{lang_admin('multi_line_text')}</option>
<option value="mediumtext" <?php echo @setting::$var[$table][$field['name']]['type']=='mediumtext'?'selected':''?>>{lang_admin('hypertext')}</option>
<option value="datetime" <?php echo @setting::$var[$table][$field['name']]['type']=='datetime'?'selected':''?>>{lang_admin('date')}</option>
<option value="_image" <?php echo @setting::$var[$table][$field['name']]['filetype']=='image'?'selected':''?>>{lang_admin('picture')}</option>
<option value="_file" <?php echo @setting::$var[$table][$field['name']]['filetype']=='file'?'selected':''?>>{lang_admin('enclosure')}</option>
<option value="0">[{lang_admin('selection_class')}...]</option>
 </select>
 </div>
    <div class="clearfix blank20"></div>
</div>



<div class="row"  id="lengshow">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('length')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input class="form-control" name="len" id="len" value="{$field['len']}"  onblur="form_preview()"/>
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('please_enter_the_value')}"></span>
</div>
    <div class="clearfix blank20"></div>
</div>

               
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('allow_search')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input <?php echo @setting::$var[$table][$field['name']]['type']!='varchar'?'disabled':''?> type="checkbox" size="10" name="issearch" id="issearch" value="1" <?php echo @setting::$var[$table][$field['name']]['issearch']=='1'?'checked':''?>  onblur="form_preview()"/>
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('are_keywords_allowed_to_be_searched')},<br />{lang_admin('only_valid_if_the_field_type_is_single')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

</div>

<div class="select2" style="display:none">
 <div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('mold')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="selecttype"  id="selecttype" onchange="checktovarchar(); form_preview();" class="form-control select">
<option value="radio" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='radio'?'selected':''?>>{lang_admin('monopoly')}</option>
<option value="checkbox" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='checkbox'?'selected':''?>>{lang_admin('multi_selection')}</option>
<option value="select" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='select'?'selected':''?>>{lang_admin('dropdown_selection_line_text')}</option>
<option value="0">[{lang_admin('non_selective_classes')}...]</option>
</select>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('option_selective_classes')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('select',@setting::$var[$table][$field['name']]['select'],' rows="6" cols="40" onblur="form_preview();" ')}
<p><i class="icon-info"></i> {lang_admin('item_per_line_format__value__item_such_as_1_very_good')}</p>
</div>
</div>
<div class="clearfix blank20"></div>
</div>


<div class="select2" style="display:none" id="select_preview">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('preview')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<span id="form_preview_title">
</span>&nbsp;
<span id="form_preview">
</span>
<span id="form_preview_tips">&nbsp;&nbsp;
</span>
</div>
</div>
<div class="clearfix blank20"></div>
</div>



    <script type="text/javascript">
        {if @setting::$var[$table][$field['name']]['selecttype']}
        $(".select2").show("fast");
        $(".varchar2").hide("fast");
        $("#selecttype").attr('value','{=@setting::$var[$table][$field['name']]['selecttype']}');
        $("#type").val('0');
        form_preview();
        {else}
        $("#selecttype").val('0');
        {/if}
    </script>

  

<?php if($table == 'user') { ?>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('whether_the_registration_page_is_displayed_or_not')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<?php echo form::checkbox('showinreg', 1,@setting::$var[$table][$field['name']]['showinreg']);?>
<span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('is_the_user_defined_field_displayed_on_the_registration_page')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<?php } ?>




<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input  name="submit" value="1" type="hidden">
    <input type="submit"   value=" {lang_admin('submitted')} " class="btn btn-primary btn-lg" />

</form>


<div class="blank30"></div>
</div>
</div>


