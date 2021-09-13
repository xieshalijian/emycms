<?php $this->render('field/edit.php'); return;?>
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
    <div class="line"></div>
    <div class="blank30"></div>
    <div class="box" id="box">
        <input type="button" name="Submit" value="{lang_admin('return_list')}" class="btn btn-primary" onclick="gotourl(this)"   data-dataurl="{url('field/list/table/'.front::get('table'))}">

        <div class="line"></div>
        <div class="blank30"></div>


        <form name="fieldform" method="post" action="<?php echo modify("case/field/act/".front::$act."/table/".$table);?>" onsubmit="return returnform(this);">

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('name')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input name="name" value="my_" class="form-control">
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('mold')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <select name="type" class="form-control select">
                        <option value="int">{lang_admin('integer')}</option>
                        <option value="varchar">{lang_admin('one_line_text')}</option>
                        <option value="text" onclick="document.fieldform.len.hidden='hidden'">{lang_admin('multi_line_text')}</option>
                        <option value="mediumtext">{lang_admin('hypertext')}</option>

                        <option value="datetime">{lang_admin('date')}</option>
                        <option value="radio">[{lang_admin('monopoly')}]</option>
                        <option value="checkbox">[{lang_admin('multi_selection')}]</option>

                    </select>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('length')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input name="len" value="" class="form-control" oninput="value=value.replace(/[^\d]/g,'')">
                </div>
            </div>
            <div class="clearfix blank20"></div>


            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('chinese_name_in_field')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input name="cname" value="" class="form-control">
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('radio_multiple_options')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::textarea('select','',' rows="6" cols="40" ')}
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <input  name="submit" value="1" type="hidden">
            <input type="submit"  value=" {lang_admin('submitted')} " class="btn btn-primary" />

        </form>



        <div class="blank30"></div>
    </div>
</div>
