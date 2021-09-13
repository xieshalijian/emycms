<style type="text/css">
    .btn-group .nav-tabs>li.active>a,.btn-group .nav-tabs>li.active>a:focus, .btn-group  .nav-tabs>li.active>a:hover {border:none;}
    #data-backup .glyphicon-remove {color:#FF4961;}
    .main-right-box h5 .content-eidt-nav .pull-right .btn-success {
        display:none;
    }
    .main-right-box h5 .content-eidt-nav.sabit .pull-right .btn-success {
        display:inline-block;
    }
</style>
<div class="main-right-box">

    <div class="box" id="box">
        <h5>
            {lang_admin('manage_data')}
            <!--工具栏-->
            <div class="content-eidt-nav pull-right">
            <span class="pull-right">
 <input class="btn btn-primary" type="button" value=" {lang_admin('backup_manage_settings')} " onclick="gotourl(this)"   data-dataurl="{url::create('config/system/set/backupsite')}" />
                <input type="hidden" name="submit2"  value="1"/>
                    <input type="button"  onclick="returnform(this.form);" value=" {lang_admin('backups')} " class="btn btn-success" />
                <!--关闭工具栏-->
                    <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
                </a>
                </span>
            </div>
        </h5>
        <div class="alert alert-warning alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <span class="glyphicon glyphicon-warning-sign"></span>	{lang_admin('welcome_to_the_database_backup_page_you_can_backup_the_website_data_and_the_data_will_be_saved_in')}<strong style="color:red;">/data/backup-data</strong>{lang_admin('in_the_folder')}。
        </div>

        <?php
        $base_url = config::get('base_url');
        $patha = $base_url . 'data';
        $pathb =  $base_url . 'data/backup-data';
        $pathc =  $base_url . 'data/backup-template';
        $pathd =  $base_url . 'data/backup-upload';
        $pathe =  $base_url . 'data/backup-website';
        $file = array($patha,$pathb,$pathc,$pathd,$pathe);
        foreach($file as $val){
            $tips = '<div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;<strong>' . lang_admin("tips") . '</strong>&nbsp;&nbsp;' . $val . '&nbsp;&nbsp;' . lang_admin("no_write_permission") . '</div>';
            if(!is_writable($val)){
                echo $tips;
                exit;
            }else{
                echo '';
            }
        }
        ?>


      <!--  <button type="button" class="btn btn-default pull-right"><i class="glyphicon glyphicon-open"></i> {lang_admin('upload_and_backup')}</button>-->
        <div class="btn-group" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {lang_admin('backup_database')}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="tablist">
                    <li role="presentation"><a href="#data-backup" aria-controls="data-backup" role="tab" data-toggle="tab"
                       onclick="document.forms['listform'].chkall.checked=true;CheckAll(document.forms['listform']);returnform(document.forms['listform']);" >{lang_admin('back_up_all_data')}</a></li>
                    <li role="data-backup-custom"><a href="#data-backup-custom"
                         onclick="document.forms['listform'].chkall.checked=false;CheckAll(document.forms['listform']);" aria-controls="messages" role="tab" data-toggle="tab">{lang_admin('custom_backup_database')}</a></li>
                </ul>
            </div>
            <button type="button" id="upload_zip"  class="btn btn-default">{lang_admin('backup_attachments')}</button>
            <button type="button" id="template_zip" class="btn btn-default">{lang_admin('backup_template')}</button>
            <button type="button" id="btn_zip" class="btn btn-default">{lang_admin('whole_station_backup')}</button>
            <button type="button" onclick="gotourl(this)"  data-dataurl="<?php echo url('database/deletenocatgoty',true);?>" class="btn btn-default">{lang_admin('delete_invalid_content')}</button>
        </div>
        <div id="resinfo"></div>
        <script type="text/javascript">
            $(function(){
                $('#btn_zip').click(function(){
                    //$(this).attr('disabled',true);
                    $(this).addClass("btn_b").removeClass("btn_c");
                    $('#resinfo').html("<div class='blank30'></div><img src='./images/admin/loading.gif' /> {lang_admin('compressing')}");
                    $.get("{url('database/dobackAll',true)}", function(data){
                        if(data == 'ok'){
                            $('#resinfo').html("{lang_admin('compression_completion')}");
                            //window.location.reload();
                            gotoinurl("{url('database/baker',true)}");
                        }else{
                            $('#resinfo').html(data);
                        }
                    });
                });
                $('#upload_zip').click(function(){
                    $(this).addClass("btn_b").removeClass("btn_c");
                    $('#resinfo').html("<div class='blank30'></div><img src='images/admin/loading.gif' /> {lang_admin('compressing')}");
                    $.get("{url('database/dobackupload',true)}", function(data){
                        if(data == 'ok'){
                            $('#resinfo').html("{lang_admin('compression_completion')}");
                            //window.location.reload();
                            gotoinurl("{url('database/baker',true)}");
                        }else{
                            $('#resinfo').html(data);
                        }
                    });
                });
                $('#template_zip').click(function(){
                    $(this).addClass("btn_b").removeClass("btn_c");
                    $('#resinfo').html("<div class='blank30'></div><img src='images/admin/loading.gif' /> {lang_admin('compressing')}");
                    $.get("{url('database/dobacktemplate',true)}", function(data){
                        if(data == 'ok'){
                            $('#resinfo').html("{lang_admin('compression_completion')}");
                           // window.location.reload();
                            gotoinurl("{url('database/baker',true)}");
                        }else{
                            $('#resinfo').html(data);
                        }
                    });
                });
            });
        </script>
        <div class="blank30"></div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="data-backup">
                <!--数据库备份开始-->
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th clospan="7" style="border:none;"><h5>{lang_admin('database_backup')}</h5>
                        </th>
                    </tr>
                    </thead>
                    <thead>
                    <tr>
                        <th>{lang_admin('file_name')}</th>
                        <th>{lang_admin('date')}</th>
                        <th>{lang_admin('time')}</th>
                        <th>{lang_admin('size')}</th>
                        <th class="text-center">{lang_admin('reduction')}</th>
                        <th class="text-center">{lang_admin('download')}</th>
                        <th class="text-center">{lang_admin('delete')}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {loop $newdataback $dir}
                    <tr>
                        <td>{$dir} </td>
                        <?php
                        if(strpos($dir,'databack_') !== false){
                            $size=0;
                            $dirurl=ROOT.'/data/backup-data/'.$dir;
                            $a=filectime($dirurl);
                            //创建时间
                            $catetimeymd=date("Y-m-d",$a);
                            //创建分秒
                            $catetimehis=date("H:i:s",$a);
                            //文件夹大小
                            $handle = opendir($dirurl);
                            while (false!==($FolderOrFile = readdir($handle)))
                            {
                                if($FolderOrFile != "." && $FolderOrFile != "..")
                                {
                                    if(is_dir("$dirurl/$FolderOrFile"))
                                    {
                                        $size += getDirSize("$dirurl/$FolderOrFile");
                                    }
                                    else
                                    {
                                        $size += filesize("$dirurl/$FolderOrFile");
                                    }
                                }
                            }
                            closedir($handle);
                        }
                        //单位转换
                        $KB = 1024;
                        $MB = 1024 * $KB;
                        $GB = 1024 * $MB;
                        $TB = 1024 * $GB;
                        if ($size < $KB) {
                            $size= $size . "B";
                        } elseif ($size < $MB) {
                            $size= round($size / $KB, 2) . "KB";
                        } elseif ($size < $GB) {
                            $size= round($size / $MB, 2) . "MB";
                        } elseif ($size < $TB) {
                            $size= round($size / $GB, 2) . "GB";
                        } else {
                            $size= round($size / $TB, 2) . "TB";
                        }
                        ?>
                        <td><span class="mw-date">{$catetimeymd}</span></td>
                        <td><span class="mw-date">{$catetimehis}</span></td>
                        <td><span class="mw-date">{$size}</span></td>
                        <td class="mw-backup-download text-center">
                            <?php  if(strpos($dir,'databack_') !== false){ ?>
                                <a class="database-down" target="_blank" title="{lang_admin('reduction')}" onclick="javascript:if(confirm('{lang_admin('are_you_sure_about_reduction')}' )) gotoinurl('<?php echo url('database/dorestore/db_dir/'.$dir);?>');" title="{lang_admin('reduction')}"><i class="glyphicon glyphicon-refresh"></i></a></td>
                        <td class="mw-backup-download text-center">
                           </td>
                        <td class="mw-backup-download text-center">
                            <?php } ?>
                            <a title="{lang_admin('delete')}" class="database-restore" onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}' )) gotoinurl('<?php echo url('database/deletedir/db_dir/'.$dir);?>');" title="{lang_admin('delete')}"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                    {/loop}
                    </tbody>
                <!--数据库备份结束-->
                    <thead>
                    <tr>
                        <th clospan="7" style="border:none;"><h5>{lang_admin('attachment_backup')}</h5>
                        </th>
                    </tr>
                    </thead>
                <!--附件备份开始-->
                    <thead>
                    <tr>
                        <th>{lang_admin('file_name')}</th>
                        <th>{lang_admin('date')}</th>
                        <th>{lang_admin('time')}</th>
                        <th>{lang_admin('size')}</th>
                        <th class="text-center">{lang_admin('reduction')}</th>
                        <th class="text-center">{lang_admin('download')}</th>
                        <th class="text-center">{lang_admin('delete')}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {loop $newupload $dir}
                    <tr>
                        <td>{$dir} </td>
                        <?php
                        if(strpos($dir,'upload_') !== false){
                            $dirurl=ROOT.'/data/backup-upload/'.$dir;
                            $a=filectime($dirurl);
                            //创建时间
                            $catetimeymd=date("Y-m-d",$a);
                            //创建分秒
                            $catetimehis=date("H:i:s",$a);
                            //文件夹大小
                            $size=abs(filesize($dirurl));
                        }
                        //单位转换
                        $KB = 1024;
                        $MB = 1024 * $KB;
                        $GB = 1024 * $MB;
                        $TB = 1024 * $GB;
                        if ($size < $KB) {
                            $size= $size . "B";
                        } elseif ($size < $MB) {
                            $size= round($size / $KB, 2) . "KB";
                        } elseif ($size < $GB) {
                            $size= round($size / $MB, 2) . "MB";
                        } elseif ($size < $TB) {
                            $size= round($size / $GB, 2) . "GB";
                        } else {
                            $size= round($size / $TB, 2) . "TB";
                        }
                        ?>
                        <td><span class="mw-date">{$catetimeymd}</span></td>
                        <td><span class="mw-date">{$catetimehis}</span></td>
                        <td><span class="mw-date">{$size}</span></td>
                        <td class="mw-backup-download text-center">
                            <!--<a class="database-down" target="_blank" title="恢复" onclick="javascript:if(confirm('确定恢复吗' )) location.href='<?php /*echo url('database/doupload/db_dir/'.$dir);*/?>';"  >恢复<i class="glyphicon glyphicon-refresh"></i></a>-->
                           </td>
                        <td class="mw-backup-download text-center">
                                <?php  if(strpos($dir,'upload_') !== false){ ?>
                                <a href="<?php echo 'data/backup-upload/'.$dir;?>" target = "_blank" title = "{lang_admin('download')}" ><i class="glyphicon glyphicon-download-alt"></i ></a >
                            </td>
                        <td class="mw-backup-download text-center"><?php } ?>
                            <a title="{lang_admin('delete')}" class="database-restore" onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}' )) gotoinurl('<?php echo url('database/deletedir/db_dir/'.$dir);?>');" title="{lang_admin('delete')}"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                    {/loop}
                    </tbody>
                <!--附件备份结束-->
                    <thead>
                    <tr>
                        <th clospan="7" style="border:none;"><h5>{lang_admin('template_backup')}</h5>
                        </th>
                    </tr>
                    </thead>
                <!--模板备份开始-->
                    <thead>
                    <tr>
                        <th>{lang_admin('file_name')}</th>
                        <th>{lang_admin('date')}</th>
                        <th>{lang_admin('time')}</th>
                        <th>{lang_admin('size')}</th>
                        <th class="text-center">{lang_admin('reduction')}</th>
                        <th class="text-center">{lang_admin('download')}</th>
                        <th class="text-center">{lang_admin('delete')}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {loop $newtemplate $dir}
                    <tr>
                        <td>{$dir} </td>
                        <?php
                        if(strpos($dir,'template_') !== false){
                            $dirurl=ROOT.'/data/backup-template/'.$dir;
                            $a=filectime($dirurl);
                            //创建时间
                            $catetimeymd=date("Y-m-d",$a);
                            //创建分秒
                            $catetimehis=date("H:i:s",$a);
                            //文件夹大小
                            $size=abs(filesize($dirurl));
                        }
                        //单位转换
                        $KB = 1024;
                        $MB = 1024 * $KB;
                        $GB = 1024 * $MB;
                        $TB = 1024 * $GB;
                        if ($size < $KB) {
                            $size= $size . "B";
                        } elseif ($size < $MB) {
                            $size= round($size / $KB, 2) . "KB";
                        } elseif ($size < $GB) {
                            $size= round($size / $MB, 2) . "MB";
                        } elseif ($size < $TB) {
                            $size= round($size / $GB, 2) . "GB";
                        } else {
                            $size= round($size / $TB, 2) . "TB";
                        }
                        ?>
                        <td><span class="mw-date">{$catetimeymd}</span></td>
                        <td><span class="mw-date">{$catetimehis}</span></td>
                        <td><span class="mw-date">{$size}</span></td>
                        <td class="mw-backup-download text-center">
                            <!-- <a class="database-down" target="_blank" title="恢复" onclick="javascript:if(confirm('确定恢复吗' )) location.href='<?php /*echo url('database/dotemplate/db_dir/'.$dir);*/?>';"  >恢复<i class="glyphicon glyphicon-refresh"></i></a>-->
                           </td>
                        <td class="mw-backup-download text-center">
                            <?php  if(strpos($dir,'template_') !== false){ ?>
                                <a href="<?php echo 'data/backup-template/'.$dir;?>" target = "_blank" title = "{lang_admin('download')}" ><i class="glyphicon glyphicon-download-alt"></i ></a >
                           </td>
                        <td class="mw-backup-download text-center">
                            <?php } ?>
                            <a title="{lang_admin('delete')}" class="database-restore" onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}' )) gotoinurl('<?php echo url('database/deletedir/db_dir/'.$dir);?>');" title="{lang_admin('delete')}"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                    {/loop}
                    </tbody>
                <!--模板备份结束-->
                <thead>
                <tr>
                    <th clospan="7" style="border:none;"><h5>{lang_admin('whole_station_backup')}</h5>
                    </th>
                </tr>
                </thead>
                <!--整站备份开始-->
                    <thead>
                    <tr>
                        <th>{lang_admin('file_name')}</th>
                        <th>{lang_admin('date')}</th>
                        <th>{lang_admin('time')}</th>
                        <th>{lang_admin('size')}</th>
                        <th class="text-center">{lang_admin('reduction')}</th>
                        <th class="text-center">{lang_admin('download')}</th>
                        <th class="text-center">{lang_admin('delete')}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {loop $newbackup $dir}
                    <tr>
                        <td>{$dir} </td>
                        <?php
                        if(strpos($dir,'backup_') !== false){
                            $dirurl=ROOT.'/data/backup-website/'.$dir;
                            $a=filectime($dirurl);
                            //创建时间
                            $catetimeymd=date("Y-m-d",$a);
                            //创建分秒
                            $catetimehis=date("H:i:s",$a);
                            //文件夹大小
                            $size=abs(filesize($dirurl));
                        }
                        //单位转换
                        $KB = 1024;
                        $MB = 1024 * $KB;
                        $GB = 1024 * $MB;
                        $TB = 1024 * $GB;
                        if ($size < $KB) {
                            $size= $size . "B";
                        } elseif ($size < $MB) {
                            $size= round($size / $KB, 2) . "KB";
                        } elseif ($size < $GB) {
                            $size= round($size / $MB, 2) . "MB";
                        } elseif ($size < $TB) {
                            $size= round($size / $GB, 2) . "GB";
                        } else {
                            $size= round($size / $TB, 2) . "TB";
                        }
                        ?>
                        <td><span class="mw-date">{$catetimeymd}</span></td>
                        <td><span class="mw-date">{$catetimehis}</span></td>
                        <td><span class="mw-date">{$size}</span></td>
                        <td class="mw-backup-download text-center">
                           </td>
                        <td class="mw-backup-download text-center">
                            <?php  if(strpos($dir,'backup_') !== false){ ?>
                                <a href="<?php echo 'data/backup-website/'.$dir;?>" target = "_blank" title = "{lang_admin('download')}" ><i class="glyphicon glyphicon-download-alt"></i ></a >
                            </td>
                        <td class="mw-backup-download text-center">
                            <?php } ?>
                            <a title="{lang_admin('delete')}" class="database-restore" onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}' )) gotoinurl('<?php echo url('database/deletedir/db_dir/'.$dir);?>');" title="{lang_admin('delete')}"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                    {/loop}
                    </tbody>
                </table>
                <!--整站备份结束-->
            </div>
            <div role="tabpanel" class="tab-pane" id="data-backup-custom">
                <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr class="th">
                                <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form);" type="checkbox" name="chkall" class="checkbox" /></th>
                                <th class="catname" align="left">{lang_admin('table_name')}</th>
                                <th class="catid">{lang_admin('number_of_records')}</th>
                                <th class="catid">{lang_admin('size')}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {loop tdatabase::getInstance()->getTables() $table}
                            <tr>
                                <td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$table.name}" name="select[]" class="checkbox" /></td>
                                <td class="catname" align="left">{$table.name}</td>
                                <td class="catid">{$table.count}</td>
                                <td class="catid">{=ceil($table['size']/1024)}K</td>
                            </tr>
                            {/loop}
                            </tbody>
                        </table>
                    </div>
                    <div class="blank30"></div>
{lang_admin('please_select_the_size_of_the_volume')}：
                    <?php /*兼容MySQL4<input type="checkbox" name="mysql4" value="1"> */ ?>
                    {form::select('bagsize',0,array(0=>'',1=>'1M',2=>'2M',5=>'5M',10=>'10M'))}
                    <div class="blank30"></div>
                    <div class="line"></div>
                    <div class="blank30"></div>
                    <input type="hidden" name="submit2"  value="1"/>
                    <input type="button"  onclick="returnform(this.form);" value=" {lang_admin('backups')} " class="btn btn-primary btn-lg" />
                </form>
            </div>
            <div class="blank30"></div>
        </div>
    </div>
<style type="text/css">
	#bagsize {display:inline-block; width:auto;}
</style>

    <script type="text/javascript">
        <!--
        $(document).ready(function(){
            $(window).scroll(function() {
                var top = $("#index_connent").offset().top; //获取指定位置
                var scrollTop = $(window).scrollTop();  //获取当前滑动位置
                if(scrollTop > top){                 //滑动到该位置时执行代码
                    $(".content-eidt-nav").addClass("sabit");
                    $(".sabit #fullscreen-btn").css("display","inline-block");
                    $(".sabit #content-eidt-nav-btn").css("display","inline-block");
                }else{
                    $(".content-eidt-nav").removeClass("sabit");
                    $("#fullscreen-btn").css("display","none");
                    $(".fixed #fullscreen-btn").css("display","inline-block");
                    $("#content-eidt-nav-btn").css("display","none");
                }
            });
        });
        $(document).ready(function(){
            $("#content-eidt-nav-btn").click(function(){
                $(".content-eidt-nav").removeClass("sabit");
            });
        });
        //-->
    </script>