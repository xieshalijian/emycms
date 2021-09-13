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

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
      onsubmit="return returnform(this);">
<input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>" class="form-control" />

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('name')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="name" id="name" value="<?php echo $data['name']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('original_id')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="oldid" id="oldid" value="<?php echo $data['oldid']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('wechat_number')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="weixinid" id="weixinid" value="<?php echo $data['weixinid']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">AppId</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="appid" id="appid" value="<?php echo $data['appid']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">AppSecret</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="appsecret" id="appsecret" value="<?php echo $data['appsecret']; ?>" class="form-control" /></div>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    <input  name="submit" value="1" type="hidden">
    <input type="submit"  value="{lang_admin('submitted')}" class="btn btn-primary btn-lg" />
        </div>
</form>

<div class="blank30"></div>
</div>
</div>
