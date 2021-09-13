
<div class="main-right-box">
    <h5>
        <?php echo lang_admin('custom_fields');?>
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
                        subject=get('form1').select_cn.value;
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
                        subject=get('form1').select_cn.value;
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
                    $('#form_preview_title').html(get('form1').cname_cn.value);
                    $('#form_preview_tips').html(get('form1').tips_cn.value);
                }
            }

            function checkform(obj) {
                if (!$('#isshoping')[0].checked) {
                    if ($('#type').val() == 0 || $('#type').val() == undefined || $('#type').val() == '') {
                        alert("<?php echo lang_admin('please_select_the_type');?>");
                        return false;
                    }
                }
                if (!$('#isshoping')[0].checked) {
                    if ($('#len').val().length == 0 || $('#len').val() == undefined || $('#len').val() == '') {
                        alert("<?php echo lang_admin('length_cannot_be_empty');?>");
                        return false;
                    }
                }
                $('#select_preview').html('');
                returnform(obj);
                return false;

            }


        </script>


        <form method="post" action="<?php echo uri();?>" name="form1" id="form1" onsubmit="return checkform(this)">

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('field_name');?></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <?php if(front::$act=='edit') { ?>
                        <b><?php echo $field['name'];?></b>
                        <input type="hidden" class="form-control"  name="name" id="name" value="<?php echo $field['name'];?>" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('must_fill_in');?>"></span>
                    <?php } else { ?>
                        <input class="form-control" name="name" id="name" value="my_" onblur="form_preview()" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('must_fill_in');?>"></span>
                    <?php } ?>
                </div>
            </div>
            <div class="clearfix blank20"></div>


            <div class="row field-input-blank">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('chinese_name_in_field');?></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <?php  $langdata=lang::getlang();
                    if(is_array($langdata)){
                        foreach ($langdata as $key=>$value){
                            $newcname='cname_'.$value['langurlname'];
                            ?>
                            <input class="form-control" name=" <?php echo $newcname;?>" id=" <?php echo $newcname;?>" value="<?php echo isset($data[$newcname])?$data[$newcname]:"";?>" placeholder="<?php echo $value['langname'];?>"  onblur="form_preview()"/>
                        <?php    }
                    }
                    ?>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('must_fill_in');?>"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row field-input-blank">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('tips');?></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <?php
                    if(is_array($langdata)){
                        foreach ($langdata as $key=>$value){
                            $newtips='tips_'.$value['langurlname'];
                            ?>
                            <input class="form-control" name=" <?php echo $newtips;?>" id=" <?php echo $newtips;?>"  value="<?php echo @setting::$var[$table][$field['name']][$newtips];?>" placeholder="<?php echo $value['langname'];?>"  onblur="form_preview()"/>
                        <?php    }
                    }
                    ?>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('notes_on_the_right_side_of_the_input_box');?>"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>


            <?php
            if($table == 'archive' || $table == 'category' ) {
                ?>
                <?php
                    $langallname="";
                    if(is_array($langdata)){
                    foreach ($langdata as $key=>$value){
                        $langallname=($langallname==""?$value['langurlname']:$langallname.','.$value['langurlname']);
                        $newcatid='catid_'.$value['langurlname'];
                ?>
                    <div class="row" id="catidshow">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('binding_column');?><?php echo $value['langname'];?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <input type="hidden" id="catid_val_<?php echo $value['langurlname'];?>" value="<?php echo isset($data[$newcatid])?$data[$newcatid]:"";?>">
                            <?php  $field=isset($field)?$field:array();$data=isset($data)?$data:array();?>
                            <?php  echo form::getform($newcatid,$catidform,$field,$data);?>
                        </div>
                        <div class="clearfix blank20"></div>
                    </div>
                <?php    }
                }
                ?>
            <?php } ?>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('is_it_necessary_to_fill_in');?></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input type="checkbox" name="isnotnull" id="isnotnull" value="1" <?php echo @setting::$var[$table][$field['name']]['isnotnull']=='1'?'checked':''?>  onblur="form_preview()"/>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('is_it_a_required_item');?>"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <?php if((session::get('ver') == 'corp') ){ ?>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('is_it_a_commodity');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <input type="checkbox" name="isshoping" id="isshoping" value="1"  onclick="checkisshoping(this)" <?php echo @setting::$var[$table][$field['name']]['isshoping']=='1'?'checked':''?>  onblur="form_preview()"/>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('is_it_a_commodity');?>"></span>
                    </div>
                </div>
                <div class="clearfix blank20"></div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('is_tage');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <input type="checkbox" name="istage" id="istage" value="1"  onclick="checkistage(this)" <?php echo @setting::$var[$table][$field['name']]['istage']=='1'?'checked':''?>  onblur="form_preview()"/>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('is_it_a_commodity');?>"></span>
                    </div>
                </div>
                <div class="clearfix blank20"></div>
            <?php };?>
            <script type="text/javascript">
                function  checkisshoping(obj) {
                    if(obj.checked){
                        getcatid(1);  //商品栏目
                        $("#type").val("text");
                        $("#len").val("0");
                        $("#catid").val("0");
                        document.getElementById("typeshow").style.display="none";
                        document.getElementById("lengshow").style.display="none";
                        //document.getElementById("catidshow").style.display="none";
                    }else{
                        getcatid(0);  //普通栏目
                        document.getElementById("typeshow").style.display="";
                        document.getElementById("lengshow").style.display="";
                        // document.getElementById("catidshow").style.display="";
                    }
                }
                function  checkistage(obj) {
                    if(obj.checked){
                        $("#type").val("mediumtext");
                        $("#len").val("500");
                        $("#catid").val("0");
                        document.getElementById("typeshow").style.display="none";
                        document.getElementById("lengshow").style.display="none";
                        //document.getElementById("catidshow").style.display="none";
                    }else{
                        document.getElementById("typeshow").style.display="";
                        document.getElementById("lengshow").style.display="";
                        // document.getElementById("catidshow").style.display="";
                    }
                }

                $(function () {
                    var isshoping=<?php if(@setting::$var[$table][$field['name']]['isshoping']==""){echo  "0";}else{ echo @setting::$var[$table][$field['name']]['isshoping']; } ;?>;
                    var istage=<?php if(@setting::$var[$table][$field['name']]['istage']==""){echo  "0";}else{ echo @setting::$var[$table][$field['name']]['istage']; } ;?>;
                    if( isshoping=='1' || istage=='1'){
                        document.getElementById("typeshow").style.display="none";
                        document.getElementById("lengshow").style.display="none";
                        //  document.getElementById("catidshow").style.display="none";
                    }
                    else{
                        document.getElementById("typeshow").style.display="";
                        document.getElementById("lengshow").style.display="";
                        //document.getElementById("catidshow").style.display="";
                    }

                    if( isshoping=='1'){
                        getcatid(1);  //商品栏目
                    }else{
                        getcatid(0);  //普通栏目
                    }
                });

                function getcatid(isshopcatid){  //isshopcatid  是否商品栏目
                    var catidallname="<?php echo $langallname;?>";
                    var catidallnamearray=catidallname.split(",");
                    for(var index=0;index<catidallnamearray.length;index++){
                        $("#catid_"+catidallnamearray[index]).html("");
                    }

                    var hrefname = "<?php echo modify("/act/getfieldcatid/table/category"); ?>";
                    $.get(hrefname, {'isshopcatid': isshopcatid}, function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        for(var index=0;index<catidallnamearray.length;index++) {
                            $("#catid_"+catidallnamearray[index]).html(data[catidallnamearray[index]]);
                            var catid_val_data=$("#catid_val_"+catidallnamearray[index]).val();
                            $("#catid_"+catidallnamearray[index]+" option[value='"+catid_val_data+"']").attr("selected", true);
                        }
                    });
                }
            </script>

            <div  class="varchar2" >
                <div class="row" id="typeshow">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('mold');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <select name="type" id="type" onchange="checktoselect(); form_preview();" class="form-control select">
                            <option value="int" <?php echo @setting::$var[$table][$field['name']]['type']=='int'?'selected':''?>><?php echo lang_admin('integer');?></option>
                            <option value="varchar" <?php echo @setting::$var[$table][$field['name']]['type']=='varchar'?'selected':''?>><?php echo lang_admin('one_line_text');?></option>
                            <option value="text" <?php echo @setting::$var[$table][$field['name']]['type']=='text'?'selected':''?>><?php echo lang_admin('multi_line_text');?></option>
                            <option value="mediumtext" <?php echo @setting::$var[$table][$field['name']]['type']=='mediumtext'?'selected':''?>><?php echo lang_admin('hypertext');?></option>
                            <option value="datetime" <?php echo @setting::$var[$table][$field['name']]['type']=='datetime'?'selected':''?>><?php echo lang_admin('date');?></option>
                            <option value="_image" <?php echo @setting::$var[$table][$field['name']]['filetype']=='image'?'selected':''?>><?php echo lang_admin('single_graph');?></option>
                            <option value="_pic" <?php echo @setting::$var[$table][$field['name']]['filetype']=='pic'?'selected':''?>><?php echo lang_admin('picture_library');?></option>
                            <option value="_file" <?php echo @setting::$var[$table][$field['name']]['filetype']=='file'?'selected':''?>><?php echo lang_admin('attachment');?></option>
                            <option value="0">[<?php echo lang_admin('selection_class');?>...]</option>
                        </select>
                    </div>
                    <div class="clearfix blank20"></div>
                </div>



                <div class="row"  id="lengshow">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('length');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <input class="form-control" name="len" id="len" value="<?php echo isset($field['len'])?$field['len']:"";?>" onblur="form_preview()" oninput="value=value.replace(/[^\d]/g,'')"/>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('please_enter_the_value');?>"></span>
                    </div>
                    <div class="clearfix blank20"></div>
                </div>


                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('allow_search');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <input <?php echo @setting::$var[$table][$field['name']]['type']!='varchar'?'disabled':''?> type="checkbox" size="10" name="issearch" id="issearch" value="1" <?php echo @setting::$var[$table][$field['name']]['issearch']=='1'?'checked':''?>  onblur="form_preview()"/>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('are_keywords_allowed_to_be_searched');?>,<br /><?php echo lang_admin('only_valid_if_the_field_type_is_single');?>"></span>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

            </div>

            <div class="select2" style="display:none">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('mold');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <select name="selecttype"  id="selecttype" onchange="checktovarchar(); form_preview();" class="form-control select">
                            <option value="radio" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='radio'?'selected':''?>><?php echo lang_admin('monopoly');?></option>
                            <option value="checkbox" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='checkbox'?'selected':''?>><?php echo lang_admin('multi_selection');?></option>
                            <option value="select" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='select'?'selected':''?>><?php echo lang_admin('dropdown_selection_line_text');?></option>
                            <option value="0">[<?php echo lang_admin('non_selective_classes');?>...]</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix blank20"></div>


                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('option_selective_classes');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php  $langdata=lang::getlang();
                        if(is_array($langdata)){
                            foreach ($langdata as $key=>$value){
                                $newselect='select_'.$value['langurlname'];
                                ?>
                                <?php echo $value['langname'];?>:<?php echo form::textarea($newselect,@setting::$var[$table][$field['name']][$newselect],' rows="6" cols="40" property="'.lang_admin('item_per_line_format__value__item_such_as_1_very_good').'" onblur="form_preview();" p ');?>
                            <?php    }
                        }
                        ?>

                        <p><i class="icon-info"></i> <?php echo lang_admin('item_per_line_format__value__item_such_as_1_very_good');?></p>
                    </div>
                </div>
                <div class="clearfix blank20"></div>
            </div>


            <div class="select2" style="display:none" id="select_preview">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('preview');?></div>
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
                <?php if(@setting::$var[$table][$field['name']]['selecttype']) { ?>
                $(".select2").show("fast");
                $(".varchar2").hide("fast");
                $("#selecttype").attr('value','<?php echo @setting::$var[$table][$field['name']]['selecttype'];?>');
                $("#type").val('0');
                form_preview();
                <?php } else { ?>
                $("#selecttype").val('0');
                <?php } ?>
            </script>



            <?php if($table == 'user') { ?>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('whether_the_registration_page_is_displayed_or_not');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php echo form::checkbox('showinreg', 1,@setting::$var[$table][$field['name']]['showinreg']);?>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('is_the_user_defined_field_displayed_on_the_registration_page');?>"></span>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

            <?php } ?>



            <input type="hidden" value="<?php echo @setting::$var[$table][$field['name']]['id'];?> " id="id" name="id">
            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value=" <?php echo lang_admin('submitted');?> " class="btn btn-primary btn-lg" />
                </div>
            </div>
        </form>


        <div class="blank30"></div>
    </div>
</div>
