

<div class="main-right-box">

    <h5>
        {lang_admin('website_security')}

    </h5>

<div class="box" id="box">
<style>
    .ui-datepicker-trigger {right:5px;left:auto;}
</style>
<div class="pull-right" style="position: relative;">
    {lang_admin('time_choice')}：<input type="text" onchange="setLogTime()" name="outtime" id="outtime" value="" class="form-control" style="width:auto;display:inline-block;" />
</div>
<ul class="nav nav-tabs" role="tablist">
    <li>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('config/system/set/security')}" data-dataurlname="{lang_admin('website_security')}">
            {lang_admin('website_security')}
        </a>
    </li>
    <li class="active">
        <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('adminlogs/manage')}" data-dataurlname="{lang_admin('log_manage')}">
            {lang_admin('log_manage')}
        </a>
    </li>
    <li>
        <a href="#" onclick="gotourl(this)"   data-dataurl="{url::create('database/str_replace')}" data-dataurlname="{lang_admin('replace_strings')}">
            {lang_admin('replace_strings')}
        </a>
    </li>
</ul>

<div class="blank30"></div>


<!--<form name="listform" id="listform"  action="<?php /*echo uri();*/?>" method="post">-->
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out">{lang_admin('id')}</th>
<th>{lang_admin('username')}</th>
<th>{lang_admin('operating_time')}</th>
<th>IP</th>
<th>{lang_admin('operating_method')}</th>
<th>{lang_admin('explain')}</th>
<th>{lang_admin('dosomething')}</th>
</tr>
</thead>
<tbody>
<?php
$filetime=$logTime;
$fileToName='log'.$filetime.'.txt';
$file  = 'data/event/'.$fileToName;//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
if(file_exists($file)){   //判断是否存在
    $cbody = file($file); //file（）函数作用是返回一行数组，txt里有三行数据，因此一行被识别为一个数组，三行被识别为三个数组
    $starPage=($logPage-1)*10;
    $endPage=$logPage*10>count($cbody)?count($cbody):$logPage*10;
    $j=1;
    for($i=$starPage;$i<$endPage;$i++){ //count函数就是获取数组的长度的，长度为3 因为一行被识别为一个数组 有三行
        echo '<tr>';
        echo '<td class="text-left">'.$j.'</td>';
        echo  $cbody[$i];//最后是循环输出每个数组，在每个数组输出完毕后 ，输出一个换行，这样就可以达到换行效果
        echo '<td class="text-left">';
        /*echo  '<a href="#" onclick="gotourl(this)"   data-dataurl=" '.url('adminlogs/delete/id/'.($i+1)).' "onclick="return confirm(\'确定要删除吗?\')"  title="{lang_admin('delete')}">';*/
        echo  '<a onclick="deletelog('.($i+1).')"  title="' . lang_admin('delete') . '" class="btn btn-gray">';
        echo lang_admin('delete');
        echo  '</a></td></tr>';
        $j++;
    }
}

?>
</table>
</div>






<input type="hidden" name="batch" value="">


        <select id="deletType" name="deletType" class="form-control select" style="display: inline; width: auto;">
            <option value="0">{lang_admin('today')}</option>
            <option value="1" selected>{lang_admin('this_week')}</option>
            <option value="2">{lang_admin('this_month')}</option>.
        </select>
    
   <input  class="btn btn-gray" type="button" value=" {lang_admin('delete')} " name="delete" onclick="deleteLogTxt()"/>

<input  class="btn btn-gray" type="button" value=" {lang_admin('all_emptied')} " name="delete" onclick="alldeleteLog()"/>

    <div class="blank30"></div>
    <div class="line"></div>
    <div class="page"><?php echo pagination::adminhtml(count($cbody)); ?></div>
<link rel="stylesheet" href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/common/js/jquery/ui/css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script language="javascript" src="{$base_url}/common/js/jquery/ui/js/ui.datepicker.js"></script>
<script type="text/javascript">
        $(function () {
            $('#outtime').val(<?php echo $logTime ?>);
        });
        function deleteLogTxt() {
            if(window.confirm('{lang_admin("are_you_sure_you_want_to_delete_it")}')){
                var urlPath = '{url("adminlogs/deleteLogTxt")}&deletType=' + $('#deletType').val();
                $.ajax({
                    url: urlPath,
                    type: 'GET',
                    dataType: 'text',
                    timeout: 1000,
                    error: function () {

                    },
                    success: function (data) {
                        alert('{lang_admin("successful_deletion")}');
                    }
                });
            }
        }
        function deletelog(id){
            if(window.confirm('{lang_admin("are_you_sure_you_want_to_delete_it")}')){
                var urlPath = '{url("adminlogs/delete")}&id=' + id;
                $.ajax({
                    url: urlPath,
                    type: 'GET',
                    dataType: 'text',
                    timeout: 1000,
                    error: function () {
                        var path= '<?php echo modify("adminlogs/manage"); ?>&logTime='+<?php echo $logTime ?>;
                        path=path+'&page='+<?php echo $logPage ?>;
                        gotoinurl(path);
                    },
                    success: function (data) {
                      var path= '<?php echo modify("adminlogs/manage"); ?>&logTime='+<?php echo $logTime ?>;
                      path=path+'&page='+<?php echo $logPage ?>;
                        gotoinurl(path);
                    }
                });
            }
        }
        function alldeleteLog() {
            if(window.confirm('{lang_admin("are_you_sure_its_empty")}')){
                $.ajax({
                    url: '{url("adminlogs/batch")}',
                    type: 'GET',
                    dataType: 'text',
                    timeout: 1000,
                    error: function () {
                        var path= '<?php echo modify("adminlogs/manage"); ?>&logTime='+<?php echo $logTime ?>;
                        path=path+'&page='+<?php echo $logPage ?>;
                         gotoinurl(path);
                    },
                    success: function (data) {
                        var path= '<?php echo modify("adminlogs/manage"); ?>&logTime='+<?php echo $logTime ?>;
                        path=path+'&page='+<?php echo $logPage ?>;
                         gotoinurl(path);
                    }
                });
            }
        }
        function setLogTime() {
            var logTime= $('#outtime').val();
            if(logTime.length>0){
                var path = '<?php echo modify("adminlogs/manage"); ?>&logTime='+logTime;
                gotoinurl(path);
            }
        }
        $(document).ready(function() {
                var yearFrom=1990;
                var date=new Date;
                var yearTo=date.getFullYear();
                $('#outtime').datepicker(
                    {
                        dateFormat: 'yymmdd',
                        buttonImage: '/images/calendar.png',
                        buttonText: '{lang_admin("please_choose_the_date")}',
                        buttonImageOnly: true,
                        showOn: 'both',
                        yearRange: yearFrom+':'+yearTo,
                        maxDate:date,
                        clearText:'{lang_admin("eliminate")}',
                        closeText:'{lang_admin("close")}',
                        prevText:'{lang_admin("previous_month")}',
                        nextText:'{lang_admin("next_month")}',
                        currentText:' ',
                        monthNames:['{lang_admin("january")}','{lang_admin("february")}','{lang_admin("march")}','{lang_admin("april")}','{lang_admin("may")}','{lang_admin("june")}','{lang_admin("july")}','{lang_admin("august")}','{lang_admin("september")}','{lang_admin("october")}','{lang_admin("november")}','{lang_admin("december")}']
                    }
                );
            });
</script>
<!--</form>-->

<div class="blank30"></div>
</div>
</div>

<!-- 日期 -->
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script language="javascript" src="{$base_url}/common/js/jquery/ui/js/ui.datepicker.js"></script>