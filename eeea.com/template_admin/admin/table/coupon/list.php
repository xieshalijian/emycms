<div class="main-right-box">
<h5>{lang_admin('list_of_special')}</h5>
<div class="blank20"></div>
<div class="box" id="box">


<form name="listform" id="listform"  action="<?php echo uri(); ?>" method="post" onsubmit="return returnform(this);">

<input class="btn btn-primary" type="button" value=" {lang_admin('adding_preferential_offers')} " data-dataurlname="{lang_admin('adding_preferential_offers')}" onclick="gotourl(this)" data-dataurl="<?php echo url('table/add/table/coupon') ?>" />

<div class="blank10"></div>



<div class="table-responsive">
<table class="table table-hover ">
<thead>
<tr class="th">
<th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<!--<th>排序</th>-->
<th class="catid"><!--couponid-->{lang_admin('id')}</th>
<th class="catid"><!--coupontitle-->{lang_admin('title')}</th>
    <th class="catname"><!--overduedate-->{lang_admin('expiration_time')}</th>
<th class="catname"><!--statu-->{lang_admin('state')}</th>
    <th>{lang_admin('quantity_of_use')}</th>
<th class="manage">{lang_admin('dosomething')}</th>
</tr>
{loop $data $d}
<?php $couponid=$d['couponid']; ?>
<tr>
<td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$couponid}" name="select[]" class="checkbox"></td>
<!--<td>{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>-->
<td class="couponid">{cut($d['couponid'])}</td>
<td class="catname"><a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("/act/edit/table/$table/id/$couponid"); ?>">{$d['coupontitle']}</a></td>
    <td class="overduedate">{cut($d['overduedate'])}</td>

    <td class="statu"><?php echo $d['statu']=='1'?lang_admin('take_effect'):lang_admin('invalid');?></td>
    <td>{cut($d['usedquantity'])}</td>
<td class="manage">

<a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("/act/edit/table/$table/id/$couponid"); ?>" title="{lang_admin('edit')}" class="btn btn-gray" data-dataurlname="{lang_admin('edit')} {lang_admin('coupon')}">{lang_admin('edit')}</a>


<a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"   data-dataurl="<?php echo modify("/act/delete/table/coupon/id/$couponid/token/$token"); ?>" title="{lang_admin('delete')}" class="btn btn-default">{lang_admin('delete')}</a>

<!-- <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("/act/list/table/coupon/couponid/$couponid"); ?>" title="管理"><i class="glyphicon glyphicon-list-alt"></i></a> -->


    <a class="btn btn-default coupon-info-btn">{lang_admin('details')}</a>

</td>
</tr>
<tr class="coupon-info" style="display:none;">
    <td colspan="7">
        <div style="font-size:12px;">
            <div class="col-md-4 col-xs-12">
                {lang_admin('preference_code')}：{cut($d['couponyard'])}
            </div>
            <div class="col-md-4 col-xs-12">
                {lang_admin('purpose')}：{cut($d['couponuse'])}
            </div>
            <div class="col-md-4 col-xs-12">
                {lang_admin('scope_of_use')}：<?php
                $source = explode(":",trim($d['couponrange']));
                if($source[0]=='0'){
                    echo  lang_admin('all_columns');
                }else{
                    $catname=category::getcategoryname($source[0]);
                    echo $catname[0]['catname'];
                }
                if($source[1]=='0'){
                    echo '|'.lang_admin('all_products');
                }else{
                    $catname=archive::getarchivename($source[1]);
                    echo '|'.$catname;
                }
                ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 col-xs-12">
                {lang_admin('superposition')}：<?php echo $d['overlay']=='1'?lang_admin('yes'):lang_admin('no');?>
            </div>
            <div class="col-md-4 col-xs-12">
                {lang_admin('how_much_is_available')}：{cut($d['satisfy'])}
            </div>
            <div class="col-md-4 col-xs-12">
                {lang_admin('amount_of_invoice')}：{cut($d['moeny'])}
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 col-xs-12">
                {lang_admin('necessary_integral')}：<?php echo $d['isexchange']=='1'? $d['exchangepoints']:lang_admin('non_convertible');?>
            </div>

            <div class="col-md-4 col-xs-12">
                {lang_admin('number_of_vouchers_issued')}：{cut($d['quantity'])}
            </div>
            <div class="col-md-4 col-xs-12">
                {lang_admin('add_time')}：{cut($d['adddatatime'])}
            </div>


        </div>
    </td>
</tr>
{/loop}
</tbody>
</table>
</div>

<input type="button" value="{lang_admin('delete')}" name="delete"
       onclick="if(getSelect(this.form) && confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}" class="btn btn-gray"/>


    <div class="blank30"></div>
<div class="line"></div>


<div class="page"><?php echo pagination::adminhtml($record_count); ?></div>

<input type="hidden" name="batch" value=" " class="btn btn-primary" />

</form>

<div class="blank30"></div>
</div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $(".coupon-info").hide();
        $("a.coupon-info-btn").click(function(){
            $(this).parent().parent().next().slideToggle();
            $(this).parent().parent().prevAll(".coupon-info").slideUp("slow");
            $(this).parent().parent().next().nextAll(".coupon-info").slideUp("slow");
            return false;
        });
    });
</script>
