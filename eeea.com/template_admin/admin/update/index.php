
<style type="text/css">

    .tbl{margin:8px 0px 0px;border:1px solid #ddd;border-top:0;overflow:hidden;text-align:left;}
    .tbl_tbmax{ margin:5px 0; background:#fff; }
    .tbl_tbbox{ margin:5px 5px; padding:5px 0px;}

    .tbl_hr{padding:2px 0px;color:#666;font-weight:normal;}
    .tbl_hr{border-top:1px solid #ddd;margin:0px 0px 0px;padding:5px 5px 5px 15px;font-weight:bold;color:#333;font-size:14px;background:#f7f7f7;line-height:2;}
    .tbl_hr .hr_right{float:right;}
    .tbl_hr .tips{font-weight:normal;padding-left:20px;color:#999;}
    .tbl h3.v52fmbx_hr:first-child{border-top:1px solid #ddd;}
    .tbl_submit{ border-bottom:1px solid #ddd;border-top:1px solid #ddd;padding:5px 5px 5px 10px;}
    .showmoreset-btn{float: right;}
    .showmoreset-content{display: none;}

    .product_index{overflow:visible!important;}
    .tbl dl:after{display:block;clear:both;content:"";visibility:hidden;height:0;}
    .tbl dl{width:100%;zoom:1;background:#fff;font-size:14px;border-top:1px solid #ddd;margin:0px 0px;display:-webkit-box;display:-moz-box;display:box;display:-ms-flexbox;position:relative;padding:5px 0px;}
    .tbl dl dt{margin:15px 15px 10px 15px;width:105px;color:#333;text-align:left;font-weight:normal;overflow:hidden;line-height:1.2;}
    .tbl dl dd{color:#aaa;-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;-ms-flex:1;padding:2px 0px 0px 15px;margin:10px 0px;}
    .tbl dl dd label input{position:relative;top:1px;margin-right:3px;}
    .tbl dl dd .fbox{color:#aaa;color:#656565;}
    .tbl dl dd .tips{color:#aaa;}
    .tbl dl dd .tips:hover{color:#f00;}
    .tbl dl dd.labelinline label{display:inline;}
    .tbl dl dt.addimgdt{padding:10px 5px 10px;}
    .tbl dl dt.addimgdt p{height:30px;line-height:30px;margin-bottom:8px;}
    .tbl dl.noborder{border-bottom:0;}
    .formerror{margin-top:6px;height:20px;line-height:20px;}
    .formerror .fa-times{color:#fff;border-radius:3px;padding:1px 2px;font-size:16px;margin-right:5px;background:red;}
    .formerror .fa-check{color:#fff;border-radius:3px;padding:2px;font-size:14px;margin-right:5px;background:#10aa00;}
    .formerrorbox{border:2px solid #f00!important;}
    .tbl dl dd.ftype_description{color:#fff;padding:8px;margin:0px 5px;background:#6c6fbf;}
    .noborder a.lsblogin{display:inline-block;float:left;margin-left:200px;width:100px;white-space:nowrap;text-indent:-12px;line-height:34px;margin-top:-35px;}
    .noborder a.lsblogin:hover{color:#fff;}
    .lsbwarning{color:red;line-height:34px;}
    .newver {color:#3ca1ef;}
    .tbl a {color:#aaa;}

</style>

<!-- 上传 -->
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/ajaxfileupload/ThumbAjaxFileUpload.js"></script>
<!-- 上传框 -->
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/locales/zh.js" type="text/javascript"></script>
<link href="<?php echo $base_url;?>/common/plugins/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">

<?php if(isset($row['err']) &&  $row['err'] == 0) { ?>
    <!-- Button trigger modal -->
    <script type="text/javascript">
        var patch_size = 0;
        var i = 0;

        function repeat(str, num){
            return new Array( num + 1 ).join( str );
        }

        function getsize(){
            /*$.get('<?php echo url('update/getsize');?>',function(res){
            console.log(res);
        });*/
            $('.newver').html("<?php echo lang_admin('download_don_t_refresh');?>"+repeat('.',i));
            i++;
            if(i > 3) i = 0;
        }
        function start_down(url){
            var ct = window.setInterval('getsize()',1000);
            $.getJSON('<?php echo url('update/downfile');?>',{'url':url},function(res){
                clearInterval(ct);
                if(res['err'] == '0'){
                    $('.newver').html(res['data']);
                    window.location.href ="<?php echo url('index/index');?>";
                    // gotoinurl("<?php echo url('update/index');?>");
                }else {
                    $('.newver').html(res['data']);
                    gotoinurl("<?php echo url('update/index');?>");
                }
            });
        }

        $(function () {
            $('#btn_update').click(function(){
                $('#myModalupdate').modal('hide');
                $('.newver').html("<?php echo lang_admin('ready_to_start_updating');?>");
                $.getJSON('<?php echo url('update/getfile');?>',{code:<?php echo $row['data']['code'];?>},function(res){
                    if(res['err'] == '2' || res['err'] == '1' || res['err'] == '3'){
                        $('.newver').html(res['data']);
                    }else if(res['err'] == '0'){
                        patch_size = res['size'];
                        start_down(res['data']['url']);
                    }else{
                        $('.newver').html("<?php echo lang_admin('unknown_error');?>");
                    }
                });
            });
        });


    </script>
<?php } ?>
<script>
    function showmymodalupdate(){
        <?php if(!isset($file_erro)){ ?>
            $('#myModalupdate').find("h5").html("<?php echo (isset($row['data']['name'])?$row['data']['name']:"");?>");
            $('#myModalupdate').find("p").html($("#content_div").html());
            $('#myModalupdate').find("h8").html("<?php echo lang_admin('time');?> <?php echo isset($row['data']['addtime'])?$row['data']['addtime']:"";?>");
        <?php  } ?>
        $('#myModalupdate').modal('show');
    }
</script>
<?php
if (is_array($row['data'])) {
    $content = isset($row['data']['content']) ? $row['data']['content'] : "";
}else{
    $content="";
}
?>
<div style="display: none;" id="content_div"><?php echo str_replace(array("/r", "<br/>", ""), "",nl2br($content));?></div>

<div class="main-right-box">
    <h5><?php echo lang_admin('online_upgrade');?></h5>

    <div class="box" id="box">

        <div class="tbl">
            <h3 class="tbl_hr"><?php echo lang_admin('edition');?></h3>
            <dl>
                <dt><?php echo lang_admin('detection_update');?></dt>
                <dd>
<span class="newver">
                <?php
                if($row['err'] == '0'){
                    echo lang_admin('update_to').' V.'.$row['data']['code'];
                    echo ' <a style="cursor: pointer;padding:3px 10px;background:#3ca1ef;color:white;"   onclick="showmymodalupdate()" class="upload_download btn btn-steeblue btn-xs">' . lang_admin('online_upgrade') . '</a>';
                }elseif ($row['err'] == '2' || $row['err'] == '1' || $row['err'] == '3'){
                    echo $row['data'];
                }else{
                    echo lang_admin('unknown_error');
                    echo ' <a class="btn btn-default" style="cursor: pointer;padding:3px 10px;"  data-toggle="modal" data-target="#Mymanual_upgrade" href="#" >' . lang_admin('manual_upgrade') . '</a>';
                }
                ;?></span>

                </dd>
            </dl>
            <?php if(session::get('ver') != 'corp'){ ?>
                <dl>
                    <dt><?php echo lang_admin('name');?></dt>
                    <dd><?php echo lang_admin('software_name');?></dd>
                </dl>
            <?php } ?>
            <dl>
                <dt><?php echo lang_admin('current_version');?></dt>
                <dd>V.<?php echo _VERCODE;?> [ <?php echo _VERSION;?> ]</dd>
            </dl>
            <?php if(session::get('ver') != 'corp'){ ?>
                <dl>
                    <dt><?php echo lang_admin('journal');?></dt>
                    <dd>
                        <a href="https://www.cmseasy.cn/log/" target="_blank"><?php echo lang_admin('see');?></a>
                    </dd>
                </dl>
                <dl>
                    <dt><?php echo lang_admin('copyright');?></dt>
                    <dd>
                        <a href="#" onclick="gotourl(this)"   data-dataurl="https://www.cmseasy.cn/" target="_blank"><?php echo lang_admin('software_company');?></a>
                    </dd>
                </dl>
            <?php } ?>
            <h3 class="tbl_hr"><?php echo lang_admin('server_information');?></h3>
            <dl>
                <dt><?php echo lang_admin('operating_system');?></dt>
                <dd><?php echo php_uname('s');?> <?php echo php_uname('v');?></dd>
            </dl>
            <dl>
                <dt><?php echo lang_admin('web_server');?></dt>
                <dd><?php echo $_SERVER['SERVER_SOFTWARE'];?></dd>
            </dl>
            <dl>
                <dt><?php echo lang_admin('php_version');?></dt>
                <dd>PHP<?php echo PHP_VERSION;?></dd>
            </dl>
            <dl>
                <dt><?php echo lang_admin('database_version');?></dt>
                <dd><?php echo config::getadmin('database','type').'MySQL'.$dbversion;?></dd>
            </dl>
        </div>
        <div class="blank30"></div>
    </div>
</div>

<!-- 升级 -->
<div class="modal fade" id="myModalupdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('update');?></h4>
            </div>
            <?php if(isset($file_erro)){ ?>
                <div class="modal-body" style="padding:30px 50px;">
                    <?php foreach ($file_erro as $erro){ ?>
                        <p><?php echo $erro['path'];?>------------<?php echo $erro['erro_type']==1?lang_admin('directory_does_not_exist'):lang_admin('no_write_permission');?></p>
                    <?php  } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closmode" name="app_clos" class="btn btn-danger" data-dismiss="modal"><?php echo lang_admin("close");?></button>
                </div>
            <?php  }else{ ?>
            <div class="modal-body" style="padding:30px 50px;">
                <h5>
                    <?php if(isset($row['data']['name'])){ ?>
                    <?php echo $row['data']['name'];?>
                    <?php  } ?>
                </h5>
                <p>
                    <?php if(isset($row['data']['content'])){ ?>
                    <?php echo nl2br($row['data']['content']);?>
                    <?php  } ?>
                </p>
                <h8>
                    <?php echo lang_admin('time');?>
                    <?php if(isset($row['data']['addtime'])){ ?>
                    <?php echo $row['data']['addtime'];?>
                    <?php  } ?>
                </h8>
            </div>
            <div class="modal-footer">
                <span class="pull-left">
                <input type="checkbox" id="read" onclick="read()" /> <span style="font-size:14px;">我已阅读升级说明</span>
                    </span>
                <button type="button" id="btn_update" name="btn_update" class="btn btn-primary" disabled><?php echo lang_admin('please_read');?>(5)</button>
            </div>
            <?php  } ?>
        </div>
    </div>
</div>

<script language="javascript">
    <!--
    var i=5;
    var timehwnd=setInterval("Countdown()",1000);
    function Countdown(){
        i--;
        if(i == 0){
            $("button[id='btn_update']").html("<?php echo lang_admin('update');?>");
            clearInterval(timehwnd);
        }else{
            $("button[id='btn_update']").html("<?php echo lang_admin('please_read');?>("+i+")");
        }
    }
    function read()
    {
        //找到复选框
        var ck = document.getElementById("read");
        //找到按钮
        var btn = document.getElementById("btn_update");

        //判断复选框的选中状态
        if(ck.checked)
        {
            //移除按钮的不可用属性
            btn.removeAttribute("disabled");
        }
        else
        {
            //设置不可用属性
            btn.setAttribute("disabled","disabled");
        }
    }
    -->
</script>



<!-- 手动升级Modal -->
<div class="modal fade" id="Mymanual_upgrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('manual_upgrade');?><span id="file_info" style="color:red"></span></h4>
            </div>
            <div class="modal-body" >
                <div class="alert alert-warning alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="glyphicon glyphicon-warning-sign"></span>	<strong><?php echo lang_admin('tips');?></strong>
                    <div class="blank10"></div>
                    <p>
                        <strong>[ <?php echo lang_admin('manual_upgrade_info');?> ]</strong>
                    </p>
                </div>
                <div class="blank10"></div>
                <div class="form-group">
                    <label><?php echo lang_admin('route');?></label>
                    <input type="text" name="attachment_path" class="form-control"  id="attachment_path" value="<?php echo $data['attachment_path'];?>" />

                    <div class="blank10"></div>
                    <input type="hidden" name="attachment_id"  id="attachment_id" value=""  class="form-control" />
                </div>


                <div class="form-group">
                    <label><?php echo lang_admin('name');?></label>
                    <input type="text" name="attachment_intro"  id="attachment_intro"
                           value="<?php echo archive_attachment(@$data['aid'],'intro');?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label>
                        <a href="javascript:;" class="file"><?php echo lang_admin('select_files');?>
                            <input type="file" name="fileupload" id="fileupload" accept="application/zip">
                        </a></label>
                    <input type="button"  name="filebuttonUpload"  id="filebuttonUpload" onclick="return ajaxFileUpload('fileupload','<?php echo url("tool/uploadupdatefile",false);?>','#uploading');" value="<?php echo lang_admin('upload');?>" class="btn btn-default" />
                    <img id="uploading" src="<?php echo $base_url;?>/images/loading.gif" style="display:none;">
                    <input class="btn btn-default" value="<?php echo lang_admin('delete');?>" type="button" name="delbutton"  onclick="attachment_delect(get('attachment_id').value)" />
                </div>

                <div class="blank20"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="manual_upgrade_confirm" class="btn btn-primary"><?php echo lang_admin('confirm');?></button>
                <button type="button"  name="manual_upgrade_clos" class="btn btn-danger" data-dismiss="modal"><?php echo lang_admin("close");?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#manual_upgrade_confirm').click(function(){
            var zipurl=$("#attachment_path").val();
            if(zipurl=="" || zipurl==undefined){
                alert("请先上传升级文件！");
                return false;
            }

            $.ajax({
                type: "post",
                url: "<?php echo url('update/manualdownfile', true);?>",
                data: {
                    "zipurl": zipurl
                },
                dataType: 'json',
                async: true,
                success: function (res) {
                    $('#Mymanual_upgrade').modal('hide');  //关闭
                    if(res['err'] == '0'){
                        alert(res['data']);
                        //window.location.href ="<?php echo url('index/index');?>";
                    }else {
                        alert(res['data']);
                        // gotoinurl("<?php echo url('update/index');?>");
                    }
                }
            });
        });
    });
    function attachment_delect(id) {
        $.ajax({
            url: '<?php echo url('tool/deleteattachment/site/'.front::get('site'),false);?>&id='+id,
            type: 'GET',
            dataType: 'text',
            timeout: 10000,
            error: function(){
                //	alert('Error loading XML document');
            },
            success: function(data){
                get('attachment_id').value=0;
                get('attachment_path').value='';
                get('attachment_intro').value='';
                get('attachment_path_i').innerHTML='';
                get('file_info').innerHTML='';
            }
        });
    }
</script>

