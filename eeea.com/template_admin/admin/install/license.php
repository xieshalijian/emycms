<style type="text/css">
#info {padding:10px; background:#eee;border:1px solid #CCC;line-height:200%;}
.go {background:url({$skin_admin_path}/images/go_1.gif) center top no-repeat;}
.agreement {height:198px;overflow-y:auto; color:#555;}
.agreement strong {color:#000;}
</style>

<div id="info">
<div style="padding:10px 10px 10px 15px;background:white;">
<div class="agreement">
<div class="padding10">
<p style="font-size:14px;font-weight:bold;margin-bottom:10px;">{lang_admin('license_a')}</p>
<p>{lang_admin('license_b')}</p>
<p><strong>{lang_admin('database_name')}</strong>、<strong>{lang_admin('database_username')}</strong>、<strong>{lang_admin('database_password')}</strong>、<strong>{lang_admin('database_address')}</strong>。</p>
<p>{lang_admin('license_c')}</p>
<p>{lang_admin('license_d')}</p>
<p>{lang_admin('license_e')}</p>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<div class="blank30"></div>
<center><input type="checkbox" value="1" id="readpact" name="license_pass"  checked><label for="readpact">&nbsp;&nbsp;<a style="color:#0066cc;font-weight:bold;" href="https://www.cmseasy.cn/service/" target="_blank" title="{lang_admin('view_the_license_agreement')}">{lang_admin('i_have_read_and_agreed_to_this_agreement')}</a></label>


<input class="btn btn_a" style="margin-left:20px;" type="button" onclick="if(!document.getElementById('readpact').checked) {alert('{lang_admin('you_must_agree_to_the_software_license_agreement_to_install')}！'); return false;}else{window.location.href='<?php echo url('install/index/step/1',true); ?>';}" value="{lang_admin('start_installation')}" />
</center>
<div class="blank10"></div>
