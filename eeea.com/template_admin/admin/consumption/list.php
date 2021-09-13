<div class="main-right-box">
<h5>{lang_admin('recharge_record_list')}</h5>
<div class="blank20"></div>
<div class="box" id="box">
<div class="archive-list">

     <form name="searchform" id="searchform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
			{lang_admin('user')}&nbsp;
			<?php echo form::select('search_userid',get('search_userid')?get('search_userid'):0,user::option()); ?>

            {lang_admin('date')}&nbsp;
             <select id="search_deletType" name="search_deletType" class="form-control select" style="display: inline; width: auto;">
                 <option value="0">{lang_admin('please_choose')}</option>
                 <option value="1">{lang_admin('today')}</option>
                 <option value="2">{lang_admin('this_week')}</option>
                 <option value="3">{lang_admin('this_month')}</option>.
             </select>
            <script type="text/javascript">
                $(function () {
                    //选中日期
                    $('#search_deletType').val('{$search_deletType}');
                });
            </script>
            <input  name="submit" value="1" type="hidden">
            <input type="submit" value="{lang_admin('search')}"   onclick="this.form.action='{url::modify('table/'.get('table').'/type/search')}'" class="btn btn-info search-btn" />
            <div class="blank10"></div>
        </form>


<div class="linebreak"><div class="blank10"></div></div>


</div>
<div class="blank30"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">




<div class="table-responsive">
<table class="table table-hover">
<thead>
        <tr class="th">
            <th class="sort"><!--aid-->{lang_admin('id')}</th>
            <th class="sort"><!--aid-->{lang_admin('user')}</th>
            <th class="htmldir"><!--catid-->{lang_admin('recharge_amount')}</th>
            <th class="catname"><!--title-->{lang_admin('state')}</th>
            <th class="htmldir"><!--adddate-->{lang_admin('add_time')}</th>
            <th class="manage">{lang_admin('dosomething')}</th>
        </tr>
</thead>
<tbody>
            {loop $data $d}
            <tr>
                <td class="sort">{cut($d['oid'])}</td>
                <td class="sort">{getusername($d['mid'])}</td>
                <td class="menoy">{cut($d['menoy'])}</td>
                <td class="htmldir">
                    <?php
                    switch($d['status']){
                        case 1:
                            echo "<span class='btn-soft-success'>".lang('complete')."</span>";
                            break;
                        default:
                            echo "<span class='btn-icon-inner'>".lang('processing')."</span>";
                            break;
                    }
                    ?>
                </td>
                <td class="htmldir">{cut($d['adddate'])}</td>
                <td class="manage">
                    <a href="<?php echo url("archive/consumption/oid/".$d['oid'],false);?>' target="_blank" title="{lang_admin('see')}" class="btn btn-gray">{lang_admin('see')}</a>
                    <?php
                    if($d['status']==0){ ?>
                        <a class="btn btn-default" href="#" onclick="gotourl(this)"   data-dataurl='<?php echo url("archive/payconsumption/oid/".$d['oid'],false);?>' target="_blank">{lang_admin('immediate_payment')}</a>
                    <?php };?>  </td>
            </tr>
            {/loop}


        </tbody>
    </table>
</div>


    <input type="hidden" name="batch" value="">
<div class="blank30"></div>
<div class="line"></div>

	<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
	<div class="blank10"></div>

</form>
<div class="blank30"></div>
</div>
</div>
