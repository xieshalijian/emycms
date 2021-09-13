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
<h5>{lang_admin('hot_label_settings')}</h5>
<div class="blank20"></div>
<div class="box" id="box">

<div id="tagscontent" class="right_box">

  <form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">


<table border="0" cellspacing="2" cellpadding="4" class="list" name="table1" id="table1" width="100%">
<tbody>
            <tr>
                <td>
                <div  style="margin-left:10px; margin-top:10px;">
				       {form::textarea('hottag',$hottags['hottag'],'cols=50 rows=50 style="height:150px;"')}
				 <div class="blank20"></div>
                    <span>
                        <br/>{lang_admin('one_per_line')}
						<br/><br/>
						<strong>{lang_admin('for_example')}：</strong><br/>
                        <br/>(1){lang_admin('hot_label_one')}
                        <br/>(2){lang_admin('hot_label_tow')}
                        <br/>(3){lang_admin('hot_label_three')}
                        <br/>(4){lang_admin('hot_label_four')}
                        <br/>(5){lang_admin('hot_label_five')}
                    </span>
                  </div>
                </td>
            </tr>

</tbody>
</table>


<div class="blank20"></div>
    <div class="line"></div>
    <div class="blank20"></div>
<input  name="submit" value="1" type="hidden">
<input type="submit"   value="{lang_admin('submitted')}" class="btn btn-primary btn-lg"/>
</form>

</div>

<div class="blank30"></div>
</div>
</div>
