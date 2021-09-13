
<div class="main-right-box">
    <h5>{lang_admin('user_list')}</h5>
    <div class="blank20"></div>
    <div class="box" id="box">
        <div class="clearfix blank30"></div>
        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">


            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="th">
                        <th class="catid"><!--userid-->{lang_admin('id')}</th>
                        <th class="catname"><!--username-->{lang_admin('consumption_content')}</th>
                        <th class="catid"><!--nickname-->{lang_admin('consumption_amount')}</th>
                        <th class="catid"><!--groupid-->{lang_admin('add_time')}</th>
                        <th>{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody>

                    {loop $data $d}
                    <tr>
                        <td class="catid">{cut($d['id'])}</td>
                        <td class="catname">{cut($d['content'])}</td>
                        <td class="catid">{cut($d['menoy'])}</td>
                        <td class="catid">{cut($d['adddate'])}</td>
                        <td class="manage">
                            <a href='{url("archive/consumption/oid/".$d["oid"],false)}' target="_blank" title="{lang_admin('see')}"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                    {/loop}

                    </tbody>
                </table>
            </div>
            <div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); ?></div>
            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>

            <input type="hidden" name="batch" value="" />

        </form>
        <div class="blank30"></div>
    </div>
</div>
