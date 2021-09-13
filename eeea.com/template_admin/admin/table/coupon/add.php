<div class="main-right-box">

<div class="box add-category" id="box">


<style type="text/css">
	
	
	@media(max-width:468px) {
	input#title {width:100%;}
	.add-category .text-left {margin:0px; padding:0px 5px;}
	}
	span.hotspot {float:right; padding-left:10px;}
</style>



<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>" +
      enctype="multipart/form-data" onsubmit="return returnform(this);">
<input type="hidden" name="onlymodify" value=""/>

    <h5>
        {lang_admin('adding_preferential_offers')}
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
    </h5>
    <div id="content-eidt-nav"></div>
    <div class="blank20"></div>

<script type="text/javascript" src="{$base_url}/common/js/upimg/dialog.js"></script>
<link href="{$skin_admin_path}/css/dialog.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/css/ui.datepicker.css" type="text/css" />
<script language="javascript" src="{$base_url}/common/js/jquery/ui/js/ui.datepicker.js"></script>

<script type="text/javascript">
var base_url = '{$base_url}';
</script>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('title')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('coupontitle',$form,$field,$data)}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preferential_name')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('purpose')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('couponuse',$form,$field,$data)}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preferential_usepreferential_use')}"></span>
</div>
</div>
    <div class="clearfix blank20"></div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('scope_of_use')}</div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
            <input type="text" name="couponrange" id="couponrange" value="0:0"  style="display: none" class="form-control">

            <select id="tolast" name="tolast" onchange="setoverlay()" class="form-control select tolast"></select>
			<div class="clearfix blank20"></div>
            <select id="categoryid" name="categoryid" onchange="setoverlay()" class="form-control select tolast"><option value="0">{lang_admin('all_commodities')}</option></select>

            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preferential_voucher_scope_of_use')}"></span>
        </div>
    </div>
    <div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('superposition')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('overlay',$form,$field,$data)}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('whether_the_concessions_are_superimposed_or_not')}"></span>
</div>
</div>
    <div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('how_much_is_available')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('satisfy',$form,$field,$data)}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('how_many_discounts_are_available')}"></span>
</div>
</div>
    <div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('amount_of_invoice')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('moeny',$form,$field,$data)}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preferential_voucher_amount')}"></span>
</div>
</div>
    <div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('number_of_vouchers_issued')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('quantity',$form,$field,$data)}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preferential_number_of_vouchers')}"></span>
</div>
</div>
    <div class="clearfix blank20"></div>

<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('convertibility_or_not')}</div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        {form::getform('isexchange',$form,$field,$data)}
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('can_the_coupon_be_converted_into_points')}"></span>
    </div>
</div>
    <div class="clearfix blank20"></div>

<div class="row" id="exchangepointsdiv">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('necessary_integral')}</div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        {form::getform('exchangepoints',$form,$field,$data)}
        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preferential_points_conversion_ratio')}"></span>
    </div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('release_time')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    <input type="text" readonly  name="adddatatime" id="adddatatime" value="<?php echo date('Y-m-d H:i:s'); ?>" class="skey form-control" />
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preferential_promulgation_time_can_not_be_modified')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('expiration_time')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    <script language="javascript">
        $(document).ready(function()
            {
                var yearFrom=1990;
                var yearTo=2030;
                $("#overduedate").datepicker(
                    {
                        dateFormat: "yy-mm-dd",
                        buttonImage: "/images/calendar.png",
                        buttonText: "{lang_admin('please_choose_the_date')}",
                        buttonImageOnly: true,
                        showOn: "both",
                        yearRange: yearFrom+":"+yearTo,
                        clearText:"{lang_admin('eliminate')}",
                        closeText:"{lang_admin('close')}",
                        prevText:"{lang_admin('previous_month')}",
                        nextText:"{lang_admin('next_month')}",
                        currentText:" ",
                        monthNames:["{lang_admin('january')}","{lang_admin('february')}","{lang_admin('march')}","{lang_admin('april')}","{lang_admin('')}","{lang_admin('june')}","{lang_admin('july')}","{lang_admin('august')}","{lang_admin('september')}","{lang_admin('october')}","{lang_admin('november')}","{lang_admin('december')}"]
                    }
                );
            }
        );
    </script>
    {form::getform('overduedate',$form,$field,$data)}
    <img class="ui-datepicker-trigger" readonly="true" src="/images/calendar.png" alt="{lang_admin('please_choose_the_date')}" title="{lang_admin('please_choose_the_date')}">
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('preference_expiration_time')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('state')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('statu',$form,$field,$data)}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('status')}"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row" style="display: none">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('language_package_binding')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    {form::getform('langid',$form,$field,$data,'class="form-control"')}
    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title=""></span>
</div>
</div>
<div class="clearfix blank20"></div>



<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right" >
</div>
<div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
    <input  name="submit" value="1" type="hidden">
    <input type="submit"   value=" {lang_admin('submitted')} " onclick="setcouponrange()" class="btn btn-primary btn-lg" />
</div>
</div>
</form>
    <script type="text/javascript">
        function setoverlay(){
            if($("#tolast").val() == '0' && $("#categoryid").val() == '0'){
                $("#overlay").val(0);
                $("#overlay").attr("disabled","disabled");
            }else{
                $("#overlay").removeAttr("disabled");
            }
        }

        $(function(){
            if($("#overlay").val()=='0'){
              $("#overlay").attr("disabled","disabled");
            }
            setexchangepointsdiv();

            <?php  $tolast= category::option(0,'tolast',$arr);?>
            <?php
                $html="<option value='0' >{lang_admin('all_columns')}</option>";
                if (is_array($tolast) && !empty($tolast))
                    foreach ($tolast as $key => $value){
                        $html.="<option value='".$key."' >".$value."</option>";
                    }
                ?>;
            $("#tolast").append("<?php echo $html?>");

            $("#isexchange").change(function () {
                setexchangepointsdiv();
            });
        });

        function setexchangepointsdiv(){
            if($("#isexchange").val()=='1'){
                $("#exchangepointsdiv").attr("style","display: block");
            }else{
                $("#exchangepointsdiv").attr("style","display: none");
            }
        }

        function setcouponrange(){
            $("#couponrange").val($("#tolast").val()+":"+$("#categoryid").val());
        }

        var tolastid=0;
        $("#tolast").change(function(){
            if($("#tolast").val().length==0){
                tolastid=0
            }else{
                tolastid=$("#tolast").val();
            }

            var hrefname="<?php echo modify("/act/gettolast/table/$table"); ?>";
            $.get(hrefname,{'tolastid':tolastid},function(data,status){
                $("#categoryid").html('');
                data=JSON.parse(data);
                var html="<option value='0'>{lang_admin('all_commodities')}</option>";
                for ( var i = 0; i <data.length; i++){
                    html+="<option value='"+data[i]['aid']+"'>"+data[i]['title']+"</option>";
                }
                $("#categoryid").append(html);
            });
        });


        function  checkform() {
            if($("#coupontitle").val() == ''){
                alert("{lang_admin('the_title_should_not_be_empty')}");
                return false;
            }

            if($("#couponuse").val() == ''){
                alert("{lang_admin('use_can_not_be_empty')}");
                return false;
            }

            var re = /^\d+(?=\.{0,1}\d+$|$)/;
            var res = /^\d+$/;
            if($("#satisfy").val() == ''){
                alert("{lang_admin('how_many_can_be_used_can_not_be_empty')}");
                return false;
            }else{
                if (!re.test($("#satisfy").val())) {
                    alert("{lang_admin('full_number_can_only_be_used_to_enter_numbers_or_decimals')}");
                    $("#satisfy").val('');
                    return false;
                }
            }

            if($("#moeny").val() == ''){
                alert("{lang_admin('use_the_amount_of_money_can_not_be_empty')}");
                return false;
            }else{
                if (!re.test($("#moeny").val())) {
                    alert("{lang_admin('only_numbers_or_decimals_can_be_entered_with_the_amount_of_the_voucher')}");
                    $("#moeny").val('');
                    return false;
                }
            }

            if($("#quantity").val() == ''){
                alert("{lang_admin('the_number_of_vouchers_can_not_be_empty')}");
                return false;
            }else{
                if (!res.test($("#quantity").val())) {
                    alert("{lang_admin('the_number_of_vouchers_can_only_be_entered_into_the_number')}");
                    $("#quantity").val('');
                    return false;
                }
            }

            if($("#overduedate").val() == ''){
                alert("{lang_admin('the_expiration_time_cant_be_empty')}");
                return false;
            }


            return  true;
        }
    </script>

</div>

<div class="blank30"></div>
</div>


