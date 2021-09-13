<!-- 多选框 -->
<link rel="stylesheet" href="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap-select.css">
<script type="text/javascript" src="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/js/bootstrap-select.js"></script>
<!-- 取色 -->
<link href="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet">
<script type="text/javascript" src="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript">
    $(function () {
        $('#slide_text_color').colorpicker();
        $('#slide_input_bg').colorpicker();
        $('#slide_input_color').colorpicker();
        $('#slide_btn_hover_color').colorpicker();
        $('#slide_btn_color').colorpicker();
        $('#slide_button_color').colorpicker();
    });
</script>

<div class="main-right-box">


        <form method="post" name="form1" action="<?php echo url('slide/add',true);?>"
              onsubmit="return checkform(this);">
            <input type="hidden" name="onlymodify" value=""/>
    


            <div class="box" id="box">
                <h5>{lang_admin('add_slide')}
                    <!--工具栏-->
                    <div class="content-eidt-nav pull-right">
                        <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                            <i class="icon-frame"></i>
                            {lang_admin('container_fluid')}
                        </a>

                        <span class="pull-right">

                    <input  name="submit" value="1" type="hidden">
                        <button class="btn btn-success" type="submit" onclick="mysave()">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>



                    <a href="#" onclick="gotourl(this)" data-dataurl="{$base_url}/index.php?case=slide&act=list&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="<?php echo lang_admin('slide');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>

 <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
					</a>
                </span>
                    </div>
                </h5>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_name')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('name',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_width')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_width',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_height')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_height',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_time')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_time',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_style_position')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_style_position',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
                <div class="row">
                    <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_title_size')}</div>
                    <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                        {form::getform('slide_title_size',$form,$field,$data)}
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_subtitle_size')}</div>
                    <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                        {form::getform('slide_subtitle_size',$form,$field,$data)}
                    </div>
                </div>
                <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_text_color')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div id="slide_text_color" class="input-group">
                        {form::getform('slide_text_color',$form,$field,$data)}
                        <span class="input-group-addon">
                            <i></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_input_bg')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div id="slide_input_bg" class="input-group">
                        {form::getform('slide_input_bg',$form,$field,$data)}
                        <span class="input-group-addon">
                            <i></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_input_color')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div id="slide_input_color" class="input-group">
                        {form::getform('slide_input_color',$form,$field,$data)}
                        <span class="input-group-addon">
                            <i></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_btn_hover_color')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div id="slide_btn_hover_color" class="input-group">
                        {form::getform('slide_btn_hover_color',$form,$field,$data)}
                        <span class="input-group-addon">
                            <i></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_btn_color')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div id="slide_btn_color" class="input-group">
                        {form::getform('slide_btn_color',$form,$field,$data)}
                        <span class="input-group-addon">
                            <i></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_btn_width')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_btn_width',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_btn_height')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_btn_height',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_btn_shape')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_btn_shape',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_button_size')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    {form::getform('slide_button_size',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('slide_button_color')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div id="slide_button_color" class="input-group">
                        {form::getform('slide_button_color',$form,$field,$data)}
                        <span class="input-group-addon">
                            <i></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>
                <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('binding_column')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div class="form-group">
                        <input name="banner_catid" type="hidden" value="">
                        <select  id="banner_catid"  class="selectpicker" multiple data-actions-box="true">
                            <option>Mustard</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <?php  if(file_exists(ROOT."/lib/table/type.php")) {?>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right">{lang_admin('分类')}</div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <div class="form-group">
                        <input name="banner_typeid" type="hidden" value="">
                        <select  id="banner_typeid" class="selectpicker" multiple data-actions-box="true">
                                 <option>option1</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <?php };?>

            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>

            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 text-right"></div>
                <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value="{lang_admin('submitted')}" class="btn btn-primary btn-lg"/>
                </div>
            </div>

            </div>
        </form>

<script>
$(function () {
    var search_catid="<?php echo isset($data['banner_catid'])?$data['banner_catid']:"";?>";
    var search_typeid="<?php echo isset($data['banner_typeid'])?$data['banner_typeid']:"";?>";
    $('.selectpicker').selectpicker();

    var getsearch_catid_static=false;
    if($('#banner_catid').length >0){
        if (!getsearch_catid_static){
            //加载栏目下拉
            var getsearch_catid_url='./index.php?case=slide&act=getsearch_catid&ajax=1&shopping='+public_shopping;
            getsearch_catid_url+='&catid='+search_catid;
            $.ajax({
                type: "get",
                url: getsearch_catid_url,
                async: true,
                success: function (data) {
                    $('#banner_catid').html(data);
                    $('#banner_catid').selectpicker("refresh");
                    $('#banner_catid').selectpicker('render');
                    getsearch_catid_static=true;
                }
            });
        }
    };

    <?php  if(file_exists(ROOT."/lib/table/type.php")) {?>
    //加载搜索条件  --分类
    var getsearch_typeid_static=false;
    if($('#banner_typeid').length >0){
        if (!getsearch_typeid_static){
            //加载栏目下拉
            var getsearch_typeid_url='./index.php?case=slide&act=getsearch_typeid&ajax=1&shopping='+public_shopping;
            getsearch_typeid_url+='&typeid='+search_typeid;
            $.ajax({
                type: "get",
                url: getsearch_typeid_url,
                async: true,
                success: function (data) {
                    $('#banner_typeid').html(data);
                    $('#banner_typeid').selectpicker("refresh");
                    $('#banner_typeid').selectpicker('render');
                    getsearch_typeid_static=true;
                }
            });
        }
    };
    <?php };?>

});

function checkform(obj) {
    var checkParam = $('#banner_catid').find('option:selected');
    // 选中的ID集合
    var checkId = [];
    for (var i=0;i<checkParam.length;i++) {
        checkId.push($(checkParam[i]).val());
    }
    var e_id = checkId.join(',');
    $('[name=banner_catid]').val(e_id);

    <?php  if(file_exists(ROOT."/lib/table/type.php")) {?>
    var checkParam = $('#banner_typeid').find('option:selected');
    // 选中的ID集合
    var checkId = [];
    for (var i=0;i<checkParam.length;i++) {
        checkId.push($(checkParam[i]).val());
    }
    var e_id = checkId.join(',');
    $('[name=banner_typeid]').val(e_id);
    <?php };?>

    if(!$("#name").val()) {
        alert("<?php echo lang_admin('please_fill_in_the_name');?>");
        $("#name").focus();
        return false;
    }
    returnform(obj);
    return  false;
}
</script>
        <div class="blank30"></div>

</div>

