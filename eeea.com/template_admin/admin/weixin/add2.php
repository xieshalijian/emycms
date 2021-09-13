
<style type="text/css">
	.alert span {font-weight:bold; color:red;}
</style>

<style type="text/css">
.main .main-right-box {
position: absolute;
top:130px;
right:30px;
left:30px;
bottom:30px;
}
</style>


<div class="main-right-box">
<h5>{lang_admin('wechat_public_number')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>{lang_admin('add_wechat_public_number')}：</strong><div class="blank10"></div>


<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
      onsubmit="return returnform(this);">
<p>{lang_admin('log_on_to_wechat_public_platform_to_configure_the_interface_information_which_will_automatically_jump_after_successful_configuration')}</p>
<p><span>URL: </span><?php echo config::getadmin('site_url');?>index.php?case=weixin&act=interface&wid={$data['oldid']}</p>
<p><span>TOKEN: </span>{$data['token']}</p>
</form>
</div>
    <script type="text/javascript">
        $(document).ready(function () {
            setInterval(startRequest(),1000);
        });

        function startRequest()
        {
            $.ajax({
                url: '<?php echo url('weixin/chktest/id/'.$data['id']);?>',
                type: 'GET',
                cache: false,
                success: function(data) {
                    if(data==2){
                        //alert('验证成功');
                        gotoinurl("<?php echo url('weixin/add3/id/'.$data['id']);?>");
                    }
                }
            });
        }
    </script>

    <div class="blank30"></div>
</div>
</div>